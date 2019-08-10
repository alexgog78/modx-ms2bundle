<?php

namespace ms2Bundle\Handlers;

use \msProduct;
use \ms2bundleGroup;

class cartHandler extends \abstractModule\Handlers\abstractHandler
{
    /** @var ms2bundleGroup|null */
    private $bundleGroupFactory;

    /** @var ms2bundleIngredient|null */
    private $bundleIngredientFactory;

    /** @var array */
    private $productBundle = [];

    /**
     * cartHandler constructor.
     * @param $module
     * @param array $config
     */
    public function __construct(& $module, array $config = [])
    {
        parent::__construct($module, $config);
        $this->bundleGroupFactory = $this->modx->newObject('ms2bundleGroup');
        $this->bundleIngredientFactory = $this->modx->newObject('ms2bundleIngredient');
    }

    /**
     * TODO refactor
     * @param msProduct $product
     * @param array $options
     * @return array|bool
     */
    public function getProductBundle(msProduct $product, $options = [])
    {
        $productId = $product->get('id');
        $templateId = $product->get('template');
        $templateGroups = $this->bundleGroupFactory->getTemplateGroupIds($templateId);
        if (!$templateGroups) {
            return $this->module->success();
        }
        $this->module->log($templateGroups);

        $bundleData = $options['bundle'] ?? [];
        foreach ($templateGroups as $groupId) {
            $group = $this->bundleGroupFactory->getGroup($groupId);
            $this->productBundle[$groupId] = [
                'id' => $group->get('id'),
                'name' => $group->get('name'),
                'ingredients' => []
            ];

            if ($bundleData[$groupId]) {
                foreach ($bundleData[$groupId] as $ingredientId) {
                    $ingredient = $this->bundleIngredientFactory->getIngredient($ingredientId, $groupId, $productId);
                    if (!$ingredient) {
                        return $this->module->error('error.undefined_ingredient');
                    }
                    $this->productBundle[$groupId]['ingredients'][] = $ingredient->toArray('', false, true, true);
                }
            }

            $count = count($this->productBundle[$groupId]['ingredients']);
            $validate = $this->bundleGroupFactory->validateIngredientsCount($group, $count);
            if (!$validate['success']) {
                return $validate;
            }
            unset($bundleData[$groupId]);
        }
        $this->module->log($this->productBundle);

        $this->module->log($bundleData);
        if ($bundleData) {
            return $this->module->error('error.undefined_ingredient');
        }

        return $this->module->success('', ['bundle' => $this->productBundle]);
    }

    /**
     * @param msProduct $product
     * @param array $productBundle
     * @return float
     */
    public function calculateProductPrice(msProduct $product, $productBundle = [])
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
}