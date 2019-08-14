<?php

if (!class_exists('ms2BundleManagerController')) {
    require_once dirname(dirname(__FILE__)) . '/manager.class.php';
}

class ms2BundleMgrGroupUpdateManagerController extends ms2BundleManagerController
{
    /** @var string */
    protected $recordClassKey = 'ms2bundleGroup';

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2bundle.section.group');
    }

    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = []) {
        $this->checkForRecord($scriptProperties);
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/group/group.panel.js');
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/ingredients/ingredients.grid.js');
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/ingredients/ingredient.window.js');
        $this->addJavascript($this->module->config['jsUrl'] . 'mgr/widgets/group/ingredients.grid.js');
        $this->addLastJavascript($this->module->config['jsUrl'] . 'mgr/sections/group/group.update.js');
    }
}