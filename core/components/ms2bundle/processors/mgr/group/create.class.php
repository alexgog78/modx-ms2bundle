<?php

require_once MODX_CORE_PATH . 'components/ms2bundle/processors/mgr/abstract/object/create.class.php';

class ms2bundleGroupCreateProcessor extends ms2bundleCreateProcessor
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

    private function addTemplates() {
        $data = $this->getProperty('template_ids');
        if (empty($data)) {
            return;
        }
        foreach ($data as $item) {
            $template = $this->modx->newObject('ms2bundleGroupTemplate');
            $template->fromArray(array(
                'template_id' => $item
            ), '', true);
            $this->templates[] = $template;
        }
        $this->object->addMany($this->templates, 'Templates');
    }
}
return 'ms2bundleGroupCreateProcessor';