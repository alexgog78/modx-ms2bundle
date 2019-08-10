<?php

if (!class_exists('amSimpleObject')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/amsimpleobject.class.php';
}

class ms2bundleGroup extends amSimpleObject
{
    const REQUIRED_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS = [
        'name'
    ];

    const UNIQUE_FIELDS_CHECK_BY_CONDITIONS = [];

    /**
     * @param int $templateId
     * @return array|bool
     */
    public function getTemplateGroupIds($templateId)
    {
        $query = $this->xpdo->newQuery($this->_class);
        $query->select($this->xpdo->getSelectColumns(
            $this->_class,
            $this->_class,
            '',
            ['id']
        ));
        $query->leftJoin(
            'ms2bundleGroupTemplate',
            'Template',
            'Template.group_id = ' . $this->_class . '.id'
        );
        $query->where([[
            $this->_class . '.active' => 1
        ], [
            'Template.template_id:=' => $templateId,
            'OR:Template.template_id:IS' => null
        ]]);
        $query->sortby($this->_class . '.id', 'ASC');
        $query->prepare();
        $query->stmt->execute();

        $total = $this->xpdo->getCount($this->_class, $query);
        if (!$total) {
            return false;
        }
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_column($result, 'id');
    }

    /**
     * @param int $groupId
     * @return ms2bundleGroup|null
     */
    public function getGroup($groupId)
    {
        $group = $this->xpdo->getObject($this->_class, [
            'id' => $groupId,
            'active' => 1
        ]);
        return $group;
    }

    /**
     * @param ms2bundleGroup $group
     * @param int $count
     * @return array
     */
    public function validateIngredientsCount($group, $count = 0)
    {
        $ms2Bundle = $this->xpdo->getService(
            'ms2bundle',
            'ms2Bundle',
            $this->xpdo->getOption('core_path') . 'components/ms2bundle/model/ms2bundle/',
            []
        );

        $ingredientsMin = $group->get('ingredients_min');
        $ingredientsMax = $group->get('ingredients_max');
        if ($ingredientsMin && $count < $ingredientsMin) {
            return $ms2Bundle->error('error.min_ingredients', [], [
                'group' => $group->get('name'),
                'count' => $ingredientsMin
            ]);
        }
        if ($ingredientsMax && $count > $ingredientsMax) {
            return $ms2Bundle->error('error.max_ingredients', [], [
                'group' => $group->get('name'),
                'count' => $ingredientsMax
            ]);
        }
        return $ms2Bundle->success();
    }
}