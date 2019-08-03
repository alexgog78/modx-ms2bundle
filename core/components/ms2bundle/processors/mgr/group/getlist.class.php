<?php

require_once MODX_CORE_PATH . 'components/ms2bundle/processors/mgr/abstract/object/getlist.class.php';

class ms2bundleGroupGetListProcessor extends ms2bundleGetListProcessor
{
    /** @var string */
    public $classKey = 'ms2bundleGroup';

    /**
     * @param xPDOQuery $c
     * @param string $query
     * @return xPDOQuery
     */
    public function searchQuery(xPDOQuery $c, $query)
    {
        $c->where(array(
            'name:LIKE' => '%' . $query . '%'
        ));
        return $c;
    }
}
return 'ms2bundleGroupGetListProcessor';