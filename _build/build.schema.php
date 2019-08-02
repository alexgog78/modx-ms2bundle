<?php
$tstart = explode(' ', microtime());
$tstart = $tstart[1] + $tstart[0];
set_time_limit(0);


//Initialize
require_once dirname(__FILE__) . '/build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder', '', false, true);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');
echo '<pre>';


//Settings
$sources = array(
    'model' => MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/',
    'schema_file' => MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/schema/' . PKG_NAME_LOWER . '.mysql.schema.xml',
);


//Validation
if (!is_dir($sources['model'])) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Model directory not found!');
    die();
}
if (!file_exists($sources['schema_file'])) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Schema file not found!');
    die();
}


//Model generation
$manager = $modx->getManager();
$generator = $manager->getGenerator();
$generator->parseSchema($sources['schema_file'], $sources['model']);


//Result
$tend = explode(" ", microtime());
$tend = $tend[1] + $tend[0];
$totalTime = sprintf("%2 . 4f s", ($tend - $tstart));
$modx->log(modX::LOG_LEVEL_INFO, '<br>Model Built.<br>Execution time: {' . $totalTime . '}');
exit();