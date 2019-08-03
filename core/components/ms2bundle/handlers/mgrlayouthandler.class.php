<?php

namespace ms2Bundle\Handlers;

class mgrLayoutHandler
{
    /** @var ms2Bundle */
    private $ms2Bundle;

    /** @var array */
    private $config = array();

    /** @var modX */
    private $modx;

    /**
     * ms2extMgrLayoutHandler constructor.
     * @param ms2Extend $ms2Extend
     * @param array $config
     */
    function __construct(\ms2Bundle & $ms2Bundle, array $config = array())
    {
        $this->ms2bundle = &$ms2Bundle;
        $this->config = $config;
        $this->modx = &$ms2Bundle->modx;
    }

    public function getProductLayout()
    {
        /*$query = $this->modx->newQuery('ms2extProductTab');
        $query->select($this->modx->getSelectColumns('ms2extProductTab', 'ms2extProductTab', ''));

        if (!empty($tabsIds)) {
            $query->where(array(
                'id:IN' => $tabsIds
            ));
        }

        $query->prepare();
        $query->stmt->execute();
        $mas = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($mas as $item) {
            $item['fields'] = explode(',', $item['fields']);
            $tabs[] = $item;
        }

        $configJs .= preg_replace(array('/^\n/', '/\t{5}/'), '', '
            ms2Extend.tabs = ' . $this->modx->toJSON($tabs) . ';
        ');
        $this->modx->controller->addHtml('<script type="text/javascript">' . $configJs . '</script>');*/
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/ms2/product/product.common.js');
    }
}