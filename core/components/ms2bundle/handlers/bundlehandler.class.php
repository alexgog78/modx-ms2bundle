<?php

namespace ms2Bundle\Handlers;

use \abstractModule\Handlers\abstractHandler;

//use \modX;
use \PDO;

if (!class_exists('\abstractModule\Handlers\abstractHandler')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/handlers/handler.class.php';
}

class bundleHandler extends abstractHandler
{
    const BUNDLE_GROUP_CLASS_KEY = 'ms2bundleGroup';

    const BUNDLE_INGREDIENT_CLASS_KEY = 'ms2bundleIngredient';

    /**
     * @param int $templateId
     * @return array|bool
     */
    public function getTemplateGroups($templateId)
    {
        $query = $this->modx->newQuery(self::BUNDLE_GROUP_CLASS_KEY);
        $query->select($this->modx->getSelectColumns(
            self::BUNDLE_GROUP_CLASS_KEY,
            self::BUNDLE_GROUP_CLASS_KEY,
            '',
            ['id']
        ));
        $query->leftJoin(
            'ms2bundleGroupTemplate',
            'Template',
            'Template.group_id = ' . self::BUNDLE_GROUP_CLASS_KEY . '.id'
        );
        $query->where([[
            self::BUNDLE_GROUP_CLASS_KEY . '.active' => 1
        ], [
            'Template.template_id:=' => $templateId,
            'OR:Template.template_id:IS' => null
        ]]);
        $query->sortby(self::BUNDLE_GROUP_CLASS_KEY . '.id','ASC');
        $query->prepare();
        $query->stmt->execute();

        $total = $this->modx->getCount(self::BUNDLE_GROUP_CLASS_KEY, $query);
        if (!$total) {
            return false;
        }
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_column($result, 'id');
    }

    /**
     * @param int $groupId
     * @return \ms2bundleGroup|bool
     */
    public function getGroup($groupId)
    {
        $group = $this->modx->getObject(self::BUNDLE_GROUP_CLASS_KEY, [
            'id' => $groupId,
            'active' => 1
        ]);
        if (!$group) {
            return false;
        }
        return $group;
    }

    /**
     * @param $ingredientId
     * @param int $groupId
     * @param int $productId
     * @return \ms2bundleIngredient|bool
     */
    public function getIngredient($ingredientId, $groupId =0, $productId = 0)
    {
        $query = $this->modx->newQuery(self::BUNDLE_INGREDIENT_CLASS_KEY);
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
                'productIngredient.ingredient_id=' . self::BUNDLE_INGREDIENT_CLASS_KEY . '.id && productIngredient.product_id=' . $productId
            );
        }

        $ingredient = $this->modx->getObject(self::BUNDLE_INGREDIENT_CLASS_KEY, $query);
        if (!$ingredient) {
            return false;
        }
        return $ingredient;
    }
}