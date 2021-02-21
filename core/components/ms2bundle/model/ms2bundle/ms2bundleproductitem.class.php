<?php

$this->loadClass('abstractObject', MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/', true, true);

class ms2bundleProductItem extends abstractObject
{
    /** @var bool */
    protected $timestamps = false;

    /** @var bool */
    protected $sortOrder = false;
}
