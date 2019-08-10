<?php

if (!class_exists('ms2BundleManagerController')) {
    require_once dirname(__FILE__) . '/manager.class.php';
}

class ms2BundleMgrGroupsManagerController extends ms2BundleManagerController
{
    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2bundle.section.groups');
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/group/groups.grid.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/group/groups.panel.js');
    }
}