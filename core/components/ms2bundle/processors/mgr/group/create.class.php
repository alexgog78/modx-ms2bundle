<?php

if (!class_exists('amObjectCreateProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/create.class.php';
}

class ms2bundleGroupCreateProcessor extends amObjectCreateProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    /** @var array */
    private $templates = [];

    /**
     * @return bool
     */
    public function beforeSave() {
        $this->addTemplates();
        return parent::beforeSave();
    }

    //TODO
    private function addTemplates() {
        $data = $this->getProperty('template_ids');
        if (empty($data)) {
            return;
        }
        foreach ($data as $item) {
            $template = $this->modx->newObject('ms2bundleGroupTemplate');
            $template->fromArray([
                'template_id' => $item
            ], '', true);
            $this->templates[] = $template;
        }
        $this->object->addMany($this->templates, 'Templates');
    }
}
return 'ms2bundleGroupCreateProcessor';