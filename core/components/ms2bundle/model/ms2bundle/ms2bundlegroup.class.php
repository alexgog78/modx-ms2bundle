<?php

class ms2bundleGroup extends xPDOSimpleObject
{
    const REQUIRED_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [];
}