<?php

/**
 * @var modX $modx
 */
require_once dirname(__DIR__) . '/modx.php';
require_once __DIR__ . '/build.config.php';

/**
 * @var xPDOManager $manager
 * @var xPDOGenerator $generator
 */
$manager = $modx->getManager();
$generator = $modx->manager->getGenerator();

/** Generate model files */
require_once PKG_BUILD_PATH . 'model/schema.inc.php';

/** Create DB tables */
require_once PKG_BUILD_PATH . 'model/db.inc.php';

exit();
