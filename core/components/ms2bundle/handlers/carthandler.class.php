<?php

namespace ms2Bundle\Handlers;

use \abstractModule\Handlers\abstractHandler;
use \modX;
use \PDO;

if (!class_exists('\abstractModule\Handlers\abstractHandler')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/handlers/handler.class.php';
}

class cartHandler extends abstractHandler
{
    /** @var array */
    //private $bundleGroups = [];

    /** @var array */
    private $productBundle = [];

    /**
     * TODO maybe refactor
     * @param \msProduct $product
     * @param array $bundleData
     * @return array|bool
     */
    public function getProductBundle(\msProduct $product, $options = [])
    {
        $productId = $product->get('id');
        $templateId = $product->get('template');
        $templateGroups = $this->module->bundleHandler->getTemplateGroups($templateId);
        if (!$templateGroups) {
            return $this->module->success();
        }
        $this->module->log($templateGroups);

        $bundleData = $options['bundle'] ?? [];
        foreach ($templateGroups as $groupId) {
            $group = $this->module->bundleHandler->getGroup($groupId);
            $this->productBundle[$groupId] = [
                'id' => $group->get('id'),
                'name' => $group->get('name'),
                'ingredients' => []
            ];

            if ($bundleData[$groupId]) {
                $ingredients = $bundleData[$groupId];
                foreach ($ingredients as $ingredientId) {
                    if (!$ingredient = $this->module->bundleHandler->getIngredient($ingredientId, $groupId, $productId)) {
                        return $this->module->error('error.undefined_ingredient');
                    }
                    $this->productBundle[$groupId]['ingredients'][] = $ingredient->toArray('', false, true, true);
                }
            }


            $validate = $this->validateIngredientsCount($group, count($this->productBundle[$groupId]['ingredients']));
            if (!$validate['success']){
                return $this->module->error($validate['message']);
            }
            unset($bundleData[$groupId]);
        }
        $this->module->log($this->productBundle);

        $this->module->log($bundleData);
        if ($bundleData){
            return $this->module->error('error.undefined_ingredient');
        }





        return $this->module->success('', ['bundle' => $this->productBundle]);
    }

    /**
     * @param \msProduct $product
     * @param array $bundle
     * @return float
     */
    public function calculateProductPrice(\msProduct $product, $productBundle = [])
    {
        $price = $product->getPrice();
        foreach ($productBundle as $bundleGroup) {
            if (empty($bundleGroup['ingredients'])) {
                continue;
            }
            foreach ($bundleGroup['ingredients'] as $ingredient) {
                $price += $ingredient['price'];
            }
        }
        return $price;
    }

    /*private function validateGroup($groupId)
    {
        if (!in_array($groupId, array_column($this->bundleGroups, 'id'))) {
            return false;
        }
        return true;
    }*/

    /**
     * @param \ms2bundleGroup $group
     * @param int $count
     * @return array
     */
    private function validateIngredientsCount($group, $count = 0)
    {
        $ingredientsMin = $group->get('ingredients_min');
        $ingredientsMax = $group->get('ingredients_max');
        $this->module->log([
            '$groupId' => $group->get('id'),
            '$ingredientsMin' => $ingredientsMin,
            '$ingredientsMax' => $ingredientsMax,
            '$count' => $count,
        ]);
        if ($ingredientsMin && $count < $ingredientsMin) {
            return $this->module->error('error.min_ingredients');
        }
        if ($ingredientsMax && $count > $ingredientsMax) {
            return $this->module->error('error.max_ingredients');
        }
        return $this->module->success();
    }
}