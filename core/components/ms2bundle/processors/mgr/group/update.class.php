<?php

require_once MODX_CORE_PATH . 'components/ms2bundle/processors/mgr/abstract/object/update.class.php';

class ms2bundleGroupUpdateProcessor extends ms2bundleUpdateProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    /** @var array */
    private $templates = [];

    /**
     * @return bool
     */
    public function beforeSave() {
        $this->setTemplates();
        return parent::beforeSave();
    }

    private function setTemplates()
    {
        $data = $this->getProperty('template_ids');

        $remaining = [];
        $existing = $this->object->getMany('Templates');
        foreach ($existing as $object) {
            if (!in_array($object->get('template_id'), $data)) {
                $object->remove();
            } else {
                $remaining[] = $object->get('template_id');
            }
        }

        $new = array_diff($data, $remaining);
        foreach ($new as $item) {
            if (empty($item)) {
                continue;
            }
            $template = $this->modx->newObject('ms2bundleGroupTemplate');
            $template->fromArray(array(
                'template_id' => $item
            ), '', true);
            $this->templates[] = $template;
        }

        if (!empty($this->templates)) {
            $this->object->addMany($this->templates, 'Templates');
        }
    }
}
return 'ms2bundleGroupUpdateProcessor';