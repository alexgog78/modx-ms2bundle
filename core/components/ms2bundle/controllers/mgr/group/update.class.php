<?php

if (!class_exists('ms2BundleManagerController')) {
    require_once dirname(dirname(__FILE__)) . '/manager.class.php';
}

class ms2BundleMgrGroupUpdateManagerController extends ms2BundleManagerController
{
    const ASSETS_CATEGORY = 'group/';

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2bundle.section.group');
    }

    public function process(array $scriptProperties = []) {
        //Check request for object
        if (empty($scriptProperties['id']) || strlen($scriptProperties['id']) !== strlen((integer) $scriptProperties['id'])) {
            return $this->failure($this->modx->lexicon('ms2bundle_err_ns'));
        }

        //Check for record
        $this->object = $this->modx->getObject('ms2bundleGroup', ['id' => $scriptProperties['id']]);
        if ($this->object == null) {
            return $this->failure($this->modx->lexicon('ms2bundle_err_nf'));
        }
    }

    public function loadCustomCssJs()
    {
        $this->addLastJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/sections/' . self::ASSETS_CATEGORY . 'group.update.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/widgets/' . self::ASSETS_CATEGORY . 'group.panel.js');
        $this->addIngredientsGrid();
    }

    private function addIngredientsGrid()
    {
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/widgets/ingredients/ingredients.grid.js');
        $this->addJavascript($this->ms2Bundle->config['jsUrl'] . 'mgr/widgets/' . self::ASSETS_CATEGORY . 'ingredients.grid.js');
    }
}