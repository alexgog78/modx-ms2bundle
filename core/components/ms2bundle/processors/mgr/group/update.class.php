<?php

require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/update.class.php';

class ms2bundleGroupUpdateProcessor extends amObjectUpdateProcessor
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

    //TODO
    private function setTemplates()
    {
        $data = $this->getProperty('template_ids');
        //$this->modx->log(xPDO::LOG_LEVEL_ERROR, print_r($data, true));

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
            if ($item === '') {
                continue;
            }
            $template = $this->modx->newObject('ms2bundleGroupTemplate');
            $template->fromArray([
                'template_id' => $item
            ], '', true);
            $this->templates[] = $template;
        }

        if (!empty($this->templates)) {
            $this->object->addMany($this->templates, 'Templates');
        }
    }
}
return 'ms2bundleGroupUpdateProcessor';