<?php

abstract class ms2BundleManagerController extends modExtraManagerController
{
    /** @var ms2Bundle */
    protected $ms2Bundle;

    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['ms2bundle:default'];
    }

    public function initialize()
    {
        $this->ms2Bundle = $this->modx->getService('ms2bundle', 'ms2Bundle', $this->modx->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/', []);

        //Base JS and CSS
        $this->addCss($this->ms2Bundle->config['cssUrl'] . 'mgr/default.css');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/ms2bundle.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/misc/renderer.list.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/misc/combo.list.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/misc/function.list.js');
        $this->addHtml('
            <script type="text/javascript">
                Ext.onReady(function () {
                    ms2Bundle.config = ' . $this->modx->toJSON($this->ms2Bundle->config ?? []) . ';
                });
            </script>'
        );

        parent::initialize();
    }
}