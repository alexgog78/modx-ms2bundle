<?php

require_once MODX_CORE_PATH . 'components/ms2bundle/processors/mgr/abstract/object/getlist.class.php';

class ms2bundleIngredientGetListProcessor extends ms2bundleGetListProcessor
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

        $groupId = $this->getProperty('group_id');
        if (!empty($groupId)) {
            $c->where(array(
                'group_id' => $groupId
            ));
        }
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @param string $query
     * @return xPDOQuery
     */
    public function searchQuery(xPDOQuery $c, $query)
    {
        $c->where(array(
            'name:LIKE' => '%' . $query . '%'
        ));
        return $c;
    }
}
return 'ms2bundleIngredientGetListProcessor';