<?php

$xpdo_meta_map['ms2bundleGroup'] = [
    'package' => 'ms2bundle',
    'version' => '1.1',
    'table' => 'groups',
    'extends' => 'abstractSimpleObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'name' => NULL,
        'description' => NULL,
        'properties' => NULL,
    ],
    'fieldMeta' => [
        'name' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'description' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'properties' => [
            'dbtype' => 'text',
            'phptype' => 'json',
            'null' => true,
        ],
    ],
    'composites' => [
        'Categories' => [
            'class' => 'ms2bundleCategory',
            'local' => 'id',
            'foreign' => 'group_id',
            'cardinality' => 'many',
            'owner' => 'local',
        ],
    ],
    'aggregates' => [
        'Product' => [
            'class' => 'msProduct',
            'local' => 'resource_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'local',
            'criteria' => [
                'foreign' => [
                    'class_key' => 'msProduct',
                ],
            ],
        ],
    ],
    'validation' => [
        'rules' => [
            'name' => [
                'preventBlank' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOMinLengthValidationRule',
                    'value' => '1',
                    'message' => 'field_required',
                ],
            ],
        ],
    ],
];
