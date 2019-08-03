<?php
$xpdo_meta_map['ms2bundleGroup'] = array(
    'package' => 'ms2bundle',
    'version' => NULL,
    'table' => 'ms2bundle_groups',
    'extends' => 'xPDOSimpleObject',
    'tableMeta' =>
        array(
            'engine' => 'MyISAM',
        ),
    'fields' =>
        array(
            'name' => NULL,
            'description' => NULL,
            'active' => 1,
        ),
    'fieldMeta' =>
        array(
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
            'active' =>
                array(
                    'dbtype' => 'tinyint',
                    'precision' => '1',
                    'attributes' => 'unsigned',
                    'phptype' => 'boolean',
                    'null' => false,
                    'default' => 1,
                ),
        ),
    'composites' =>
        array(
            'Templates' =>
                array(
                    'class' => 'ms2bundleGroupTemplate',
                    'local' => 'id',
                    'foreign' => 'group_id',
                    'cardinality' => 'many',
                    'owner' => 'local',
                ),
            'Ingredients' =>
                array(
                    'class' => 'ms2bundleIngredient',
                    'local' => 'id',
                    'foreign' => 'group_id',
                    'cardinality' => 'many',
                    'owner' => 'local',
                ),
        ),
);
