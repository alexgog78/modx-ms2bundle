<?php

$xpdo_meta_map['ms2bundleOrderItem'] = [
    'package' => 'ms2bundle',
    'version' => '1.1',
    'table' => 'order_items',
    'extends' => 'abstractSimpleObject',
    'tableMeta' => [
        'engine' => 'InnoDB',
    ],
    'fields' => [
        'order_id' => NULL,
        'item_id' => NULL,
        'name' => NULL,
        'price' => 0.0,
        'properties' => NULL,
    ],
    'fieldMeta' => [
        'order_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
        ],
        'item_id' => [
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
        'price' => [
            'dbtype' => 'decimal',
            'precision' => '12,2',
            'phptype' => 'float',
            'default' => 0.0,
        ],
        'properties' => [
            'dbtype' => 'text',
            'phptype' => 'json',
            'null' => true,
        ],
    ],
    'indexes' => [
        'order_id' => [
            'alias' => 'order_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'order_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
        'item_id' => [
            'alias' => 'item_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'item_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'aggregates' => [
        'Order' => [
            'class' => 'msOrder',
            'local' => 'order_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
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
            'order_id' => [
                'checkOrder' => [
                    'type' => 'xPDOValidationRule',
                    'rule' => 'xPDOForeignKeyConstraint',
                    'foreign' => 'id',
                    'local' => 'order_id',
                    'alias' => 'Order',
                    'class' => 'msOrder',
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
