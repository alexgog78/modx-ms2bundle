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


//Successful states
$_lang['ms2bundle.success.create'] = 'Запись успешно создана';
$_lang['ms2bundle.success.update'] = 'Данные успешно обновлены';
$_lang['ms2bundle.success.delete'] = 'Данные успешно удалены';


//Error states
$_lang['ms2bundle.error.response'] = 'Неверный формат ответа';
$_lang['ms2bundle.error.action'] = 'Дейсвие не найдено: "[[+action]]"';
$_lang['ms2bundle.error.create'] = 'Ошибка создания записи';
$_lang['ms2bundle.error.update'] = 'Ошибка обновления данных. Проверьте заполненные поля';
$_lang['ms2bundle.error.delete'] = 'Ошибка удаления данных';
$_lang['ms2bundle.error.record'] = 'Запись "[[+record]]" не найдена';
$_lang['ms2bundle.error.data'] = 'Проверьте введенные данные';


//System errors
$_lang['ms2bundle_err_nfs'] = 'Произошла ошибка';
$_lang['ms2bundle_err_ae'] = 'Такая запись уже есть';
$_lang['ms2bundle_err_save'] = 'Произошла ошибка при сохранении';
$_lang['ms2bundle_err_remove'] = 'Произошла ошибка при удалении';
$_lang['ms2bundle_err_nf'] = 'Запись не найдена';
$_lang['ms2bundle_err_ns'] = 'Запись не определена';
$_lang['ms2bundle_action_err_ns'] = 'Не найден процессор';