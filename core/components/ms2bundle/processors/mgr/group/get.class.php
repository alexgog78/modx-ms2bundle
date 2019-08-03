<?php

require_once MODX_CORE_PATH . 'components/ms2bundle/processors/mgr/abstract/object/get.class.php';

class ms2bundleGroupGetProcessor extends ms2bundleGetProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    private $templates = [];

    public function cleanup() {
        $this->getTemplates();
        return parent::cleanup();
    }

    private function getTemplates()
    {
        $collection = $this->object->getMany('Templates');
        foreach ($collection as $object) {
            $this->templates[] = $object->get('template_id');
        }
        $this->object->set('template_ids', implode(',', $this->templates));

        return $this->object;
    }
}
return 'ms2bundleGroupGetProcessor';