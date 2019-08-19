<?php

if (!class_exists('amObjectGetListProcessor')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/processors/mgr/object/getlist.class.php';
}

class ms2bundleProductIngredientGetListProcessor extends amObjectGetListProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleProductIngredient';

    /** @var string */
    public $defaultSortField = 'ingredient_id';

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);
        $c->innerJoin('ms2bundleIngredient', 'Ingredient');
        $this->filterByRecord($c);
        $this->filterByGroup($c);
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c) {
        $c->select($this->modx->getSelectColumns(
            $this->classKey,
            $this->classKey
        ));
        $c->select($this->modx->getSelectColumns(
            'ms2bundleIngredient',
            'Ingredient',
            'ingredient_'
        ));
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
            'Ingredient.name:LIKE' => '%' . $query . '%'
        ]);
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    private function filterByRecord(xPDOQuery $c)
    {
        $recordId = $this->getProperty('record_id');
        if (empty($recordId)) {
            return $c;
        }
        $c->where([
            'product_id' => $recordId
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
        if (empty($groupId)) {
            return $c;
        }
        $c->where([
            'Ingredient.group_id' => $groupId
        ]);
        return $c;
    }
}
return 'ms2bundleProductIngredientGetListProcessor';