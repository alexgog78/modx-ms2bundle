<?php

$xpdo_meta_map['ms2bundleItem'] = [
    'package' => 'ms2bundle',
    'version' => '1.1',
    'table' => 'items',
    'extends' => 'abstractSimpleObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'category_id' => NULL,
        'name' => NULL,
        'description' => NULL,
        'image' => NULL,
        'price' => 0.0,
        'weight' => 0.0,
        'sort_order' => 0,
        'is_default' => 0,
        'is_active' => 0,
        'properties' => NULL,
    ],
    'fieldMeta' => [
        'category_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
        ],
        'name' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'description' => [
            'dbtype' => 'text',
            'phptype' => 'string',
            'null' => true,
        ],
        'image' => [
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
        ],
        'price' => [
            'dbtype' => 'decimal',
            'precision' => '12,2',
            'phptype' => 'float',
            'default' => 0.0,
        ],
        'weight' => [
            'dbtype' => 'decimal',
            'precision' => '13,3',
            'phptype' => 'float',
            'default' => 0.0,
        ],
        'sort_order' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'default' => 0,
        ],
        'is_default' => [
            'dbtype' => 'tinyint',
            'precision' => '1',
            'attributes' => 'unsigned',
            'phptype' => 'boolean',
            'null' => false,
            'default' => 0,
        ],
        'is_active' => [
            'dbtype' => 'tinyint',
            'precision' => '1',
            'attributes' => 'unsigned',
            'phptype' => 'boolean',
            'null' => false,
            'default' => 0,
        ],
        'properties' => [
            'dbtype' => 'text',
            'phptype' => 'json',
            'null' => true,
        ],
    ],
    'indexes' => [
        'category_id' => [
            'alias' => 'category_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'category_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'price' => [
            'alias' => 'price',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'price' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'sort_order' => [
            'alias' => 'sort_order',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'sort_order' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'is_default' => [
            'alias' => 'is_default',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'is_default' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'is_active' => [
            'alias' => 'is_active',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'is_active' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'composites' => [
        'ProductIds' => [
            'class' => 'ms2bundleProductItem',
            'local' => 'id',
            'foreign' => 'item_id',
            'cardinality' => 'many',
            'owner' => 'local',
        ],
    ],
    'aggregates' => [
        'Category' => [
            'class' => 'ms2bundleCategory',
            'local' => 'category_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
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
            'category_id' => [
                'checkCategory' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'category_id',
                    'alias' => 'Category',
                    'class' => 'ms2bundleCategory',
                    'message' => 'no_records_found',
                ],
            ],
        ],
    ],
];
