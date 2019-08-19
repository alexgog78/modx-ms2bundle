<?php

if (!class_exists('amManagerController')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/controllers/mgr/manager.class.php';
}

abstract class ms2BundleManagerController extends amManagerController
{
    /**
     * @var array
     */
    protected $languageTopics = ['ms2bundle:default'];

    /**
     * @return void
     */
    protected function getService()
    {
        $this->module = $this->modx->getService(
            'ms2bundle',
            'ms2Bundle',
            $this->modx->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/',
            []
        );
    }
}