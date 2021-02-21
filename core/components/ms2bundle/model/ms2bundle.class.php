<?php

$this->loadClass('abstractModule', MODX_CORE_PATH . 'components/abstractmodule/model/', true, true);

class ms2Bundle extends abstractModule
{
    const PKG_VERSION = '1.0.0';
    const PKG_RELEASE = 'beta';
    const PKG_NAMESPACE = 'ms2bundle';
    const TABLE_PREFIX = 'ms2bundle_';

    /**
     * @param array $config
     */
    protected function setConfig($config = [])
    {
        parent::setConfig($config);
        $this->config['fileSource'] = $this->getOption('file_source');
        $this->config['ms2assetsUrl'] = $this->assetsUrl . 'ms2/';
    }
}
