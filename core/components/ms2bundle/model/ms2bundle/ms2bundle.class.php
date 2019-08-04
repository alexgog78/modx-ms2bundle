<?php

if (!class_exists('abstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class ms2Bundle extends abstractModule
{
    /** @var string */
    public $package = 'ms2bundle';

    /** @var array */
    public $handlers = [
        'mgr' => ['mgrLayoutHandler'],
        'default' => []
    ];

    /**
     * @return bool
     */
    protected function initializeBackend()
    {
        //Add JS and CSS
        $configJs = $this->modx->toJSON($this->config);
        $this->modx->regClientStartupScript('<script type="text/javascript">ms2Bundle = ' . $configJs . ';</script>', true);
        return parent::initializeBackend();
    }
}