<?php

namespace ms2Bundle\Handlers;

class mgrLayoutHandler extends \abstractModule\Handlers\abstractHandler
{
    /** @var ms2bundleGroup|null */
    private $bundleGroupFactory;

    /**
     * cartHandler constructor.
     * @param $module
     * @param array $config
     */
    public function __construct(& $module, array $config = [])
    {
        parent::__construct($module, $config);
        $this->bundleGroupFactory = $this->modx->newObject('ms2bundleGroup');
        $this->modx->controller->addLexiconTopic($this->module->package . ':default');
    }

    /**
     * @param $resource
     * return void
     */
    public function getProductLayout($resource)
    {
        $templateId = $resource->template;
        $templateGroups = $this->bundleGroupFactory->getTemplateGroupIds($templateId);
        if (!$templateGroups) {
            return;
        }
        $configJs = $this->modx->toJSON([
            'record_id' => $resource->id,
            'bundleGroups' => $templateGroups
        ]);
        $this->modx->controller->addHtml('<script type="text/javascript">' . get_class($this->module) . '.record = ' . $configJs . ';</script>');
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/ms2/product/product.common.js');
    }
}