<?php

if (!class_exists('ms2BundleManagerController')) {
    require_once dirname(dirname(__FILE__)) . '/manager.class.php';
}

class ms2BundleMgrGroupCreateManagerController extends ms2BundleManagerController
{
    const ASSETS_CATEGORY = 'group/';

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2bundle.section.group');
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/' . self::ASSETS_CATEGORY . 'group.panel.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/' . self::ASSETS_CATEGORY . 'group.create.js');
    }
}