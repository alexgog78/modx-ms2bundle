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
        'default' => []
    ];

    /**
     * @return bool
     */
    protected function initializeBackend()
    {
        //Add JS and CSS
        $configJs = $this->modx->toJSON($this->config);
        $this->modx->regClientStartupScript('<script type="text/javascript">' . get_class($this->module) . ' = ' . $configJs . ';</script>', true);
        return parent::initializeBackend();
    }

    /**
     * @return bool
     */
    protected function initializeFrontend()
    {
        //Add JS and CSS
        $configJs = $this->modx->toJSON(array(
            'cssUrl' => $this->config['cssUrl'] . 'web/',
            'jsUrl' => $this->config['jsUrl'] . 'web/',
            'actionUrl' => $this->config['actionUrl']
        ));
        $this->modx->regClientStartupScript('<script type="text/javascript">' . get_class($this->module) . 'Config = ' . $configJs . ';</script>', true);

        $config = $this->pdoTools->makePlaceholders($this->config);
        if ($frontendCss = $this->modx->getOption(get_class($this->module) . '_frontend_css')) {
            $this->modx->regClientCSS(str_replace($config['pl'], $config['vl'], $frontendCss));
        }
        if ($frontendJs = $this->modx->getOption(get_class($this->module) . '_frontend_js')) {
            $this->modx->regClientScript(str_replace($config['pl'], $config['vl'], $frontendJs));
        }
        return true;
    }
}