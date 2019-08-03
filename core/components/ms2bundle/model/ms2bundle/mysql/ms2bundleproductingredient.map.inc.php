<?php
$xpdo_meta_map['ms2bundleProductIngredient'] = array(
    'package' => 'ms2bundle',
    'version' => NULL,
    'table' => 'ms2bundle_product_ingredients',
    'extends' => 'xPDOObject',
    'tableMeta' =>
        array(
            'engine' => 'MyISAM',
        ),
    'fields' =>
        array(
            'product_id' => NULL,
            'ingredient_id' => NULL,
        ),
    'fieldMeta' =>
        array(
            'product_id' =>
                array(
                    'dbtype' => 'int',
                    'precision' => '10',
                    'phptype' => 'integer',
                    'null' => false,
                    'attributes' => 'unsigned',
                    'index' => 'pk',
                ),
            'ingredient_id' =>
                array(
                    'dbtype' => 'int',
                    'precision' => '10',
                    'phptype' => 'integer',
                    'null' => false,
                    'attributes' => 'unsigned',
                    'index' => 'pk',
                ),
        ),
    'indexes' =>
        array(
            'PRIMARY' =>
                array(
                    'alias' => 'PRIMARY',
                    'primary' => true,
                    'unique' => true,
                    'type' => 'BTREE',
                    'columns' =>
                        array(
                            'product_id' =>
                                array(
                                    'length' => '',
                                    'collation' => 'A',
                                    'null' => false,
                                ),
                            'ingredient_id' =>
                                array(
                                    'length' => '',
                                    'collation' => 'A',
                                    'null' => false,
                                ),
                        ),
                ),
        ),
    'aggregates' =>
        array(
            'Product' =>
                array(
                    'class' => 'msProduct',
                    'local' => 'product_id',
                    'foreign' => 'id',
                    'cardinality' => 'one',
                    'owner' => 'foreign',
                ),
            'Ingredient' =>
                array(
                    'class' => 'ms2bundleIngredient',
                    'local' => 'ingredient_id',
                    'foreign' => 'id',
                    'cardinality' => 'one',
                    'owner' => 'foreign',
                ),
        ),
);
