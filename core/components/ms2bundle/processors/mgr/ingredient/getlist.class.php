<?php

if (!class_exists('amObjectGetListProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/getlist.class.php';
}

class ms2bundleIngredientGetListProcessor extends amObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleIngredient';

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);
        $this->filterByGroup($c);
        return $c;
    }

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
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    private function filterByGroup(xPDOQuery $c)
    {
        $groupId = $this->getProperty('group_id');
        if (!empty($groupId)) {
            $c->where([
                'group_id' => $groupId
            ]);
        }
        return $c;
    }
}
return 'ms2bundleIngredientGetListProcessor';