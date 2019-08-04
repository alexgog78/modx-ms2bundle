<?php

require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/amsimpleobject.class.php';

class ms2bundleIngredient extends amSimpleObject
{
    const REQUIRED_FIELDS = [
        'group_id',
        'name'
    ];

    const UNIQUE_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [
        'group_id:=' => 'group_id'
    ];
}