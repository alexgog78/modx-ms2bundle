<?php
/** @var modX $modx */
/** @var ms2Bundle $ms2Bundle */
$ms2Bundle = $modx->getService('ms2bundle', 'ms2Bundle', $modx->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/', []);
$ms2Bundle->initialize($modx->context->key, []);
if (!($ms2Bundle instanceof ms2Bundle)) {
    exit('Could not initialize ms2Bundle');
}

$modxEvent = $modx->event->name;
switch ($modxEvent) {
    /*case 'OnWebPageInit':
        break;*/
    case 'msOnManagerCustomCssJs':
        //Product form extend
        if (in_array($page, ['product_create', 'product_update'])) {
            //$ms2Bundle->mgrLayoutHandler->getProductLayout();
        }
        break;
    case 'msOnBeforeAddToCart':
        //$modx->event->output('Error');

        $values = &$modx->event->returnedValues;
        $options = &$options;
        $modx->log(modX::LOG_LEVEL_ERROR, print_r([
            $options
        ], true));
        if (empty($options['bundle'])) {
            return;
        }

        $product = &$product;
        $price = $product->getPrice();
        foreach ($options['bundle'] as $groupId => $ingredient) {
            //TODO refactor ¯\_(ツ)_/¯
            if (is_array($ingredient)) {
                foreach ($ingredient as $ingredientId) {
                    $ingredient = $modx->getObject('ms2bundleIngredient', [
                        'id' => $ingredientId,
                        'group_id' => $groupId
                    ]);
                    if (!$ingredient) {
                        $modx->log(modX::LOG_LEVEL_ERROR, 'Could not find ingredient(' . $ingredientId . ') in group(' . $groupId . ')');
                        return;
                    }
                    $price += $ingredient->get('price');
                    $values['options']['bundle'][$groupId][] = $ingredient->toArray();
                }
            } else {
                $ingredientId = $ingredient;
                $ingredient = $modx->getObject('ms2bundleIngredient', [
                    'id' => $ingredientId,
                    'group_id' => $groupId
                ]);
                if (!$ingredient) {
                    $modx->log(modX::LOG_LEVEL_ERROR, 'Could not find ingredient(' . $ingredientId . ') in group(' . $groupId . ')');
                    return;
                }
                $price += $ingredient->get('price');
                $values['options']['bundle'][$groupId] = $ingredient->toArray();
            }
        }
        $modx->log(modX::LOG_LEVEL_ERROR, print_r([
            $values['options'],
            $price
        ], true));
        $product->set('price', $price);

        /*$values['count'] = $count + 10;
        $values['options'] = array('size' => '99');*/

        /*'product' => $product,
        'count' => $count,
        'options' => $options,
        'cart' => $this,*/
        /*$values = &$modx->event->returnedValues;





        */

        break;
}
return;