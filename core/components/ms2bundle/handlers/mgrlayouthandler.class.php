<?php

namespace ms2Bundle\Handlers;

use \PDO;

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
        //$templateId = $resource->template;
        $query = $this->modx->newQuery('ms2bundleGroup');
        $query->select($this->modx->getSelectColumns(
            'ms2bundleGroup',
            'ms2bundleGroup',
            ''
        ));
        $query->where([
            'is_active' => 1
        ]);
        /*if (!empty($tabsIds)) {
            $query->where([
                'id:IN' => $tabsIds
            ]);
        }*/
        $query->prepare();
        $query->stmt->execute();
        $bundleGroups = $query->stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->modx->controller->addLexiconTopic($this->module->package . ':default');
        $configJs = $this->modx->toJSON([
            'record_id' => $resource->id,
            'bundleGroups' => $bundleGroups ?? []
        ]);
        $this->modx->controller->addHtml(
            '<script type="text/javascript">' . get_class($this->module) . '.bundle = ' . $configJs . ';</script>'
        );
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/widgets/product/ingredients.grid.js');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/widgets/product/ingredient.window.js');
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/sections/product/product.panel.js');
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/ms2/product/product.common.js');
    }
}