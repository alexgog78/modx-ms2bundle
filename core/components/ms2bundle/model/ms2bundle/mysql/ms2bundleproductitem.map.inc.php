<?php

$xpdo_meta_map['ms2bundleProductItem'] = [
    'package' => 'ms2bundle',
    'version' => '1.1',
    'table' => 'product_items',
    'extends' => 'abstractObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'product_id' => NULL,
        'item_id' => NULL,
    ],
    'fieldMeta' => [
        'product_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'phptype' => 'integer',
            'null' => false,
            'attributes' => 'unsigned',
            'index' => 'pk',
        ],
        'item_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'phptype' => 'integer',
            'null' => false,
            'attributes' => 'unsigned',
            'index' => 'pk',
        ],
    ],
    'indexes' => [
        'PRIMARY' => [
            'alias' => 'PRIMARY',
            'primary' => true,
            'unique' => true,
            'type' => 'BTREE',
            'columns' => [
                'product_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
                'item_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'aggregates' => [
        'Product' => [
            'class' => 'msProduct',
            'local' => 'product_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'local',
            'criteria' => [
                'foreign' => [
                    'class_key' => 'msProduct',
                ],
            ],
        ],
        'Item' => [
            'class' => 'ms2bundleItem',
            'local' => 'item_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
    ],
    'validation' => [
        'rules' => [
            'product_id' => [
                'checkProduct' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'product_id',
                    'alias' => 'Product',
                    'class' => 'msProduct',
                    'message' => 'no_records_found',
                ],
            ],
            'item_id' => [
                'checkItem' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'item_id',
                    'alias' => 'Item',
                    'class' => 'ms2bundleItem',
                    'message' => 'no_records_found',
                ],
            ],
        ],
    ],
];
