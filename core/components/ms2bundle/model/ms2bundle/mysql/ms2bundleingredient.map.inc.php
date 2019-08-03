<?php
$xpdo_meta_map['ms2bundleIngredient'] = array(
    'package' => 'ms2bundle',
    'version' => NULL,
    'table' => 'ms2bundle_ingredients',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' =>
        array(
            'engine' => 'MyISAM',
        ),
    'fields' =>
        array(
            'group_id' => NULL,
            'name' => NULL,
            'description' => NULL,
            'image' => NULL,
            'price' => 0.0,
            'weight' => 0.0,
            'by_default' => 0,
            'active' => 1,
            'proteins' => 0.0,
            'fats' => 0.0,
            'carbohydrates' => 0.0,
            'calories' => 0.0,
        ),
    'fieldMeta' =>
        array(
            'group_id' =>
                array(
                    'dbtype' => 'int',
                    'precision' => '10',
                    'attributes' => 'unsigned',
                    'phptype' => 'integer',
                    'null' => false,
                ),
            'name' =>
                array(
                    'dbtype' => 'varchar',
                    'precision' => '255',
                    'phptype' => 'string',
                    'null' => true,
                ),
            'description' =>
                array(
                    'dbtype' => 'varchar',
                    'precision' => '255',
                    'phptype' => 'string',
                    'null' => true,
                ),
            'image' =>
                array(
                    'dbtype' => 'varchar',
                    'precision' => '255',
                    'phptype' => 'string',
                    'null' => true,
                ),
            'price' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '12,2',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
            'weight' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '13,3',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
            'by_default' =>
                array(
                    'dbtype' => 'tinyint',
                    'precision' => '1',
                    'attributes' => 'unsigned',
                    'phptype' => 'boolean',
                    'null' => false,
                    'default' => 0,
                ),
            'active' =>
                array(
                    'dbtype' => 'tinyint',
                    'precision' => '1',
                    'attributes' => 'unsigned',
                    'phptype' => 'boolean',
                    'null' => false,
                    'default' => 1,
                ),
            'proteins' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '12,2',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
            'fats' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '12,2',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
            'carbohydrates' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '12,2',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
            'calories' =>
                array(
                    'dbtype' => 'decimal',
                    'precision' => '12,2',
                    'phptype' => 'float',
                    'default' => 0.0,
                ),
        ),
    'indexes' =>
        array(
            'group_id' =>
                array(
                    'alias' => 'group_id',
                    'primary' => false,
                    'unique' => false,
                    'type' => 'BTREE',
                    'columns' =>
                        array(
                            'group_id' =>
                                array(
                                    'length' => '',
                                    'collation' => 'A',
                                    'null' => false,
                                ),
                        ),
                ),
            'price' =>
                array(
                    'alias' => 'price',
                    'primary' => false,
                    'unique' => false,
                    'type' => 'BTREE',
                    'columns' =>
                        array(
                            'price' =>
                                array(
                                    'length' => '',
                                    'collation' => 'A',
                                    'null' => false,
                                ),
                        ),
                ),
        ),
    'composites' =>
        array(
            'Products' =>
                array(
                    'class' => 'ms2bundleProductIngredient',
                    'local' => 'id',
                    'foreign' => 'ingredient_id',
                    'cardinality' => 'many',
                    'owner' => 'local',
                ),
        ),
    'aggregates' =>
        array(
            'Group' =>
                array(
                    'class' => 'ms2bundleGroup',
                    'local' => 'group_id',
                    'foreign' => 'id',
                    'cardinality' => 'one',
                    'owner' => 'foreign',
                ),
        ),
);
