<?php

if (!class_exists('amObjectCreateProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/create.class.php';
}

class ms2bundleProductIngredientCreateProcessor extends amObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleProductIngredient';

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->object->fromArray($this->getProperties(), '', true);
        return parent::beforeSave();
    }
}
return 'ms2bundleProductIngredientCreateProcessor';