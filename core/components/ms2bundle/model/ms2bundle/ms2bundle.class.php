<?php

if (!class_exists('abstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class ms2Bundle extends abstractModule
{
    /** @var string */
    public $package = 'ms2bundle';

    /** @var array */
    public $handlers = [
        'mgr' => ['mgrLayoutHandler'],
        'default' => ['cartHandler']
    ];

    /**
     * @return bool
     */
    public function initializeBackend()
    {
        parent::initializeBackend();

        //Base JS and CSS
        $this->modx->controller->addCss($this->config['cssUrl'] . 'mgr/default.css');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/ms2bundle.js');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/renderer.list.js');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/combo.list.js');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/function.list.js');

        $configJs = $this->modx->toJSON($this->config ?? []);
        $this->modx->controller->addHtml('
            <script type="text/javascript">
                Ext.onReady(function () {
                    ' . get_class($this) . '.config = ' . $configJs . ';
                });
            </script>'
        );

        return true;
    }

    /**
     * @return bool
     */
    public function initializeFrontend()
    {
        //Add JS and CSS
        $configJs = $this->modx->toJSON(array(
            'cssUrl' => $this->config['cssUrl'] . 'web/',
            'jsUrl' => $this->config['jsUrl'] . 'web/',
            'actionUrl' => $this->config['actionUrl']
        ));
        //TODO ms2BundleConfig
        $this->modx->regClientStartupScript('<script type="text/javascript">' . get_class($this) . 'Config = ' . $configJs . ';</script>', true);

        $config = $this->pdoTools->makePlaceholders($this->config);
        if ($frontendCss = $this->modx->getOption($this->package . '_frontend_css')) {
            $this->modx->regClientCSS(str_replace($config['pl'], $config['vl'], $frontendCss));
        }
        if ($frontendJs = $this->modx->getOption($this->package . '_frontend_js')) {
            $this->modx->regClientScript(str_replace($config['pl'], $config['vl'], $frontendJs));
        }
        return true;
    }
}