<?php

$this->loadClass('abstractSimpleObject', MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/', true, true);

class ms2bundleGroup extends abstractSimpleObject
{
    /** @var bool */
    protected $timestamps = false;

    /** @var bool */
    protected $sortOrder = false;
}
