<?php

if (!class_exists('amObjectRemoveProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/remove.class.php';
}

class ms2bundleProductIngredientRemoveProcessor extends amObjectRemoveProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleProductIngredient';

    public function initialize() {
        /*$primaryKey = $this->getProperty($this->primaryKeyField,false);
        if (empty($primaryKey)) return $this->modx->lexicon($this->objectType.'_err_ns');
        $this->object = $this->modx->getObject($this->classKey,$primaryKey);
        if (empty($this->object)) return $this->modx->lexicon($this->objectType.'_err_nfs',array($this->primaryKeyField => $primaryKey));*/
        $this->object = $this->modx->getObject($this->classKey, [
            'product_id' => $this->getProperty('product_id'),
            'ingredient_id' => $this->getProperty('ingredient_id'),
        ]);
        if (empty($this->object)) {
            return $this->modx->lexicon($this->objectType . '_err_nfs' . print_r($this->getProperties(), true));
        }

        if ($this->checkRemovePermission && $this->object instanceof modAccessibleObject && !$this->object->checkPolicy('remove')) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }
}
return 'ms2bundleProductIngredientRemoveProcessor';