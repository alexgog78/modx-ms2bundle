<?php

$cultureKey = basename(dirname(__FILE__));
$baseLexicons = MODX_CORE_PATH . 'components/abstractmodule/lexicon/'. $cultureKey . '/default.inc.php';
if (file_exists($baseLexicons)) {
    require_once $baseLexicons;

}

if ($_abstract_lang) {
    foreach ($_abstract_lang as $key => $value) {
        $_lang['ms2bundle.' . $key] = $value;
    }
}

$files = scandir(dirname(__FILE__));
foreach ($files as $file) {
    if (strpos($file, '.inc.php')) {
        @include_once($file);
    }
}


//Common
$_lang['ms2bundle'] = 'ms2Bundle';
$_lang['ms2bundle.management'] = 'Управление свойствами составных товаров';