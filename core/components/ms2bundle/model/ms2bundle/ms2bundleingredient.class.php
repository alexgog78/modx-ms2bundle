<?php

require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/amsimpleobject.class.php';

class ms2bundleIngredient extends amSimpleObject
{
    const REQUIRED_FIELDS = [
        'group_id',
        'name'
    ];

    const UNIQUE_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [
        'group_id:=' => 'group_id'
    ];

    /**
     * @param $ingredientId
     * @param int $groupId
     * @param int $productId
     * @return ms2bundleIngredient|null
     */
    public function getIngredient($ingredientId, $groupId = 0, $productId = 0)
    {
        $query = $this->xpdo->newQuery($this->_class);
        $query->where([
            'id' => $ingredientId,
            'active' => 1
        ]);

        if ($groupId) {
            $query->where([
                'group_id' => $groupId
            ]);
        }

        if ($productId) {
            $query->innerJoin(
                'ms2bundleProductIngredient',
                'productIngredient',
                'productIngredient.ingredient_id=' . $this->_class . '.id && productIngredient.product_id=' . $productId
            );
        }

        $ingredient = $this->xpdo->getObject($this->_class, $query);
        return $ingredient;
    }
}