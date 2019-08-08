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
    //TODO WTF ¯\_(ツ)_/¯
    case 'OnWebPageInit':
        //$ms2Bundle->cartHandler->test();
        break;
    case 'msOnManagerCustomCssJs':
        //Product form extend
        if (in_array($page, ['product_create', 'product_update'])) {
            //$ms2Bundle->mgrLayoutHandler->getProductLayout();
        }
        break;
    case 'msOnBeforeAddToCart':
        $values = &$modx->event->returnedValues;

        $getBundle = $ms2Bundle->cartHandler->getProductBundle($product, $options);
        if (!$getBundle['success']) {
            $modx->event->output($getBundle['message']);
            return;
        }
        $bundle = $getBundle['data']['bundle'];
        if (!$bundle) {
            return;
        }

        $price = $ms2Bundle->cartHandler->calculateProductPrice($product, $bundle);
        $product->set('price', $price);
        $values['options']['bundle'] = $bundle;
        break;
}
return;