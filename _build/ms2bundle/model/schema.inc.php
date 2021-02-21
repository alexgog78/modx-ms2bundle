<?php

/**
 * @var modX $modx
 * @var xPDOManager $manager
 * @var xPDOGenerator $generator
 */

$status = $generator->parseSchema(PKG_SCHEMA_PATH, PKG_MODEL_PATH);
if (!$status) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Error generating model');
    exit();
}
