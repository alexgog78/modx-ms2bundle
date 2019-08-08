<?php
//TODO refactor ALL!!!!!!!!!!!!!!! ¯\_(ツ)_/¯
$output = [];


/** @var modX $modx */
/** @var array $scriptProperties */
/** @var ms2Bundle $ms2Bundle */
$ms2Bundle = $modx->getService('ms2bundle', 'ms2Bundle', $modx->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/', []);
$ms2Bundle->initialize($modx->context->key, []);
if (!($ms2Bundle instanceof ms2Bundle)) {
    exit('Could not initialize ms2Bundle');
}
/** @var pdoFetch $pdoFetch */
if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
    return false;
}
$pdoFetch = new pdoFetch($modx, $scriptProperties);
$pdoFetch->addTime('pdoTools loaded.');




$productId = $productId ?? $modx->resource->id;



/** @var ms2bundleGroup $group */
$bundleGroup = $pdoFetch->getArray('ms2bundleGroup', [
    'id' => $groupId,
    //'active' => 1
]);
if (!$bundleGroup) {
    return $modx->lexicon('ms2bundle_err_nf');
}






//Config
$config = [
    'class' => $class,
    'leftJoin' => [],
    /*'innerJoin' => [
        'Product' => [
            'class' => 'ms2bundleProductIngredient',
            'on' => 'Product.ingredient_id = ' . $class . '.id && Product.product_id=' . $productId
        ]
    ],*/
    'select' => [
        $class => $modx->getSelectColumns($class, $class),
    ],
    'where' => [
        $class . '.group_id' => $groupId
    ]
];


//Additional filtering
if (empty($showInactive)) {
    //$config['where'][$class . '.active:>'] = 0;
}


//User config
$userConfig = array('where', 'leftJoin', 'innerJoin', 'select');
foreach ($userConfig as $key) {
    if (!empty($scriptProperties[$key])) {
        $tmp = $modx->fromJSON($scriptProperties[$key]);
        if (is_array($tmp)) {
            $config[$key] = array_merge($config[$key], $tmp);
        }
    }
    unset($scriptProperties[$key]);
}


//Get rows
$default = array(
    'class' => $config['class'],
    'where' => $modx->toJSON($config['where']),
    'leftJoin' => $modx->toJSON($config['leftJoin']),
    'innerJoin' => $modx->toJSON($config['innerJoin']),
    'select' => $modx->toJSON($config['select']),
    'sortby' => $config['class'] . 'id',
    'sortdir' => 'ASC',
    'groupby' => $config['class'] . '.id',
    'fastMode' => false,
    'return' => !empty($returnIds) ? 'ids' : 'data'
);
$properties = array_merge($default, $scriptProperties);
$pdoFetch->setConfig($properties);
$rows = $pdoFetch->run();


//Return records Ids
if (!empty($returnIds)) {
    return print_r($rows);
}


//Prepare and parse rows
if (!empty($rows) && is_array($rows)) {
    foreach ($rows as $key => $row) {
        $row['idx'] = $pdoFetch->idx++;
        $row['input'] = [
            'name' => 'options[bundle][' . $bundleGroup['id'] . '][]',
            'value' => $row['id'],
            'checked' => $row['by_default'] ? 'checked' : '',
            'selected' => $row['by_default'] ? 'selected' : '',
        ];
        $row['group'] = $bundleGroup;

        $tpl = $scriptProperties['tplCheckbox'];
        if ($bundleGroup['ingredients_max']==1) {
            $tpl = $scriptProperties['tplRadio'];
        }

        //Chunk parsing
        /*$tpl = $pdoFetch->defineChunk($row);
        $output[] .= empty($tpl)
            ? $pdoFetch->getChunk(
                '',
                $row
            )
            : $pdoFetch->getChunk(
                $tpl,
                $row,
                $pdoFetch->config['fastMode']
            );*/
        //$tpl = $pdoFetch->defineChunk($row);
        $output['rows'][] = $pdoFetch->getChunk($tpl, $row);
    }
}


//Log
if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
    $output['log'] .= '<pre class="msAreaOrder">' . print_r($pdoFetch->getTime(), 1) . '</pre>';
}



/*echo '<pre>';
print_r($output);
echo '</pre>';*/


//Output to placeholders
if (!empty($toSeparatePlaceholders)) {
    $modx->setPlaceholders($output, $toSeparatePlaceholders);
    return;
}


//Records delimeter
if (empty($outputSeparator)) {
    $outputSeparator = "\n";
}
//$output['rows'] = implode($outputSeparator, $output['rows']);
$output['rows'] = is_array($output['rows']) ? implode($outputSeparator, $output['rows']) : '';





//Wrapper chunk
if (!empty($tplWrapper) && (!empty($wrapIfEmpty) || !empty($output))) {
    $output['rows'] = $pdoFetch->getChunk(
        $tplWrapper,
        array(
            'rows' => $output['rows'],
            'group' => $bundleGroup
        ),
        $pdoFetch->config['fastMode']
    );
}
$output = is_array($output) ? implode($outputSeparator, $output) : $output;


//Output to placeholder
if(!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder, $output);
    return;
}



return $output;


//Output
/*if (!empty($toSeparatePlaceholders)) {
    //Output to placeholders
    $output = $modx->setPlaceholders($output, $toSeparatePlaceholders);
} else {
    //Records delimeter
    if (empty($outputSeparator)) {
        $outputSeparator = "\n";
    }
    $output = is_array($output) ? implode($outputSeparator, $output) : $output;
    $output .= $log;

    //Wrapper chunk
    if (!empty($tplWrapper) && (!empty($wrapIfEmpty) || !empty($output))) {
        $output = $pdoFetch->getChunk(
            $tplWrapper,
            array('rows' => $output),
            $pdoFetch->config['fastMode']
        );
    }

    //Output to placeholder
    if(!empty($toPlaceholder)) {
        $output = $modx->setPlaceholder($toPlaceholder, $output);
    }
}
return $output;*/