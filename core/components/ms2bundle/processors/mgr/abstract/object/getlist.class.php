<?php

abstract class ms2bundleGetListProcessor extends modObjectGetListProcessor
{
    /**
     * @var array
     */
    public $languageTopics = array('ms2bundle:default');

    /**
     * @var string
     */
    public $defaultSortField = 'id';

    /**
     * @var string
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        $valuesqry = $this->getProperty('valuesqry');
        if (!empty($query) && empty($valuesqry)) {
            $c = $this->searchQuery($c, $query);
        }
        return $c;
    }

    /**
     * @param xPDOQuery $c
     * @param string $query
     * @return xPDOQuery
     */
    public function searchQuery(xPDOQuery $c, $query)
    {
        return $c;
    }
}