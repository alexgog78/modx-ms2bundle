<?php

require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/get.class.php';

class ms2bundleGroupGetProcessor extends amObjectGetProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    /** @var array */
    private $templates = [];

    /**
     * @return array
     */
    public function cleanup() {
        $this->getTemplates();
        return parent::cleanup();
    }

    /**
     * @return modAccessibleObject|xPDOObject
     */
    private function getTemplates()
    {
        $collection = $this->object->getMany('Templates');
        foreach ($collection as $object) {
            $template = $object->getOne('Template');
            $this->templates[] = $template->toArray();
        }
        $this->object->set('templates', $this->templates);

        return $this->object;
    }
}
return 'ms2bundleGroupGetProcessor';