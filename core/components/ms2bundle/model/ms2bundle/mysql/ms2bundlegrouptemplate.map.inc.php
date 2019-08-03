<?php
$xpdo_meta_map['ms2bundleGroupTemplate'] = array(
    'package' => 'ms2bundle',
    'version' => NULL,
    'table' => 'ms2bundle_group_templates',
    'extends' => 'xPDOObject',
    'tableMeta' =>
        array(
            'engine' => 'MyISAM',
        ),
    'fields' =>
        array(
            'group_id' => NULL,
            'template_id' => NULL,
        ),
    'fieldMeta' =>
        array(
            'group_id' =>
                array(
                    'dbtype' => 'int',
                    'precision' => '10',
                    'phptype' => 'integer',
                    'null' => false,
                    'attributes' => 'unsigned',
                    'index' => 'pk',
                ),
            'template_id' =>
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
                            'group_id' =>
                                array(
                                    'length' => '',
                                    'collation' => 'A',
                                    'null' => false,
                                ),
                            'template_id' =>
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
            'Group' =>
                array(
                    'class' => 'ms2bundleGroup',
                    'local' => 'group_id',
                    'foreign' => 'id',
                    'cardinality' => 'one',
                    'owner' => 'foreign',
                ),
            'Template' =>
                array(
                    'class' => 'modTemplate',
                    'local' => 'template_id',
                    'foreign' => 'id',
                    'cardinality' => 'one',
                    'owner' => 'foreign',
                ),
        ),
);
