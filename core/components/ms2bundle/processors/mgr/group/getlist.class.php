<?php

if (!class_exists('amObjectGetListProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/getlist.class.php';
}

class ms2bundleGroupGetListProcessor extends amObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    /**
     * @param xPDOQuery $c
     * @param string $query
     * @return xPDOQuery
     */
    public function searchQuery(xPDOQuery $c, $query)
    {
        $c->where([
            'name:LIKE' => '%' . $query . '%'
        ]);
        return $c;
    }

    /**
     * @param xPDOObject $object
     * @return array
     * TODO templates
     */
    /*public function prepareRow(xPDOObject $object) {
        $objectArray = parent::prepareRow($object);



        return $objectArray;
    }*/
    public function prepareRow(xPDOObject $object) {
        $objectArray = parent::prepareRow($object);
        //$objectArray['templates'] = $object->getFieldsArray();
        return $objectArray;
    }

    /*private function getTemplates()
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
    }*/
}
return 'ms2bundleGroupGetListProcessor';