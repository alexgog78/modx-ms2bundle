<?php

class ms2bundleIngredient extends xPDOSimpleObject
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