<?php

/**
 * @var modX $modx
 * @var xPDOManager $manager
 * @var xPDOGenerator $generator
 */

$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, PKG_MODEL_PATH);
$mapFile = $service->modelPath . $service::PKG_NAMESPACE . '/metadata.' . DB_TYPE . '.php';

/**
 * @noinspection PhpIncludeInspection
 * @var $xpdo_meta_map
 */
include $mapFile;
foreach ($xpdo_meta_map as $baseClass => $extends) {
    foreach ($extends as $className) {
        $manager->createObjectContainer($className);
    }
}
