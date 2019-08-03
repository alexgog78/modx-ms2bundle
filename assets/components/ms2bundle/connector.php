<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';

/** @var modX $modx */
/** @var ms2Bundle $ms2Bundle */
$ms2Bundle = $modx->getService('ms2bundle', 'ms2Bundle', $modx->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/', []);
$modx->lexicon->load('minishop2:default', 'minishop2:manager');

$path = $modx->getOption('processorsPath', $ms2Bundle->config, MODX_CORE_PATH . 'components/ms2bundle/processors/');
/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest(array(
    'processors_path' => $path,
    'location' => ''
));