<?php
$files = scandir(dirname(__FILE__));
foreach ($files as $file) {
    if (strpos($file, '.inc.php')) {
        @include_once($file);
    }
}


//Common
$_lang['ms2bundle'] = 'ms2Bundle';
$_lang['ms2bundle.management'] = 'Управление свойствами составных товаров';