<?php

if (!class_exists('amObjectGetProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/get.class.php';
}

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
     * TODO
     */
    private function getTemplates()
    {
        $collection = $this->object->getMany('Templates');
        foreach ($collection as $object) {
            if ($object->get('template_id') == 0){
                $template = $this->modx->newObject('modTemplate');
                $template->fromArray([
                    'id' => 0,
                    'templatename' => $this->modx->lexicon('template_empty'),
                    'description' => '',
                    'editor_type' => 0,
                    'icon' => '',
                    'template_type' => 0,
                    'content' => '',
                    'locked' => false,
                ], '', true);
            } else {
                $template = $object->getOne('Template');
            }
            $this->templates[] = $template->toArray();
        }
        $this->object->set('templates', $this->templates);

        return $this->object;
    }
}
return 'ms2bundleGroupGetProcessor';