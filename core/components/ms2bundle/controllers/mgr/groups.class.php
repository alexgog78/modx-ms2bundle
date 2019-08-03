<?php

if (!class_exists('ms2BundleManagerController')) {
    require_once dirname(__FILE__) . '/manager.class.php';
}

class ms2BundleMgrGroupsManagerController extends ms2BundleManagerController
{
    const ASSETS_CATEGORY = 'group/';

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2bundle.section.groups');
    }

    public function loadCustomCssJs()
    {
        $this->addLastJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/sections/' . self::ASSETS_CATEGORY . 'groups.panel.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/widgets/' . self::ASSETS_CATEGORY . 'groups.grid.js');
    }
}