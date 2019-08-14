ms2Bundle.grid.ingredients = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-grid-ingredients';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/ingredient/getlist'
        },
        save_action: 'mgr/ingredient/updatefromgrid'
    });
    ms2Bundle.grid.ingredients.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.grid.ingredients, ms2Bundle.grid.abstract, {
    lexicons: {
        search: _('ms2bundle.controls.search'),
        search_clear: _('ms2bundle.controls.search_clear'),
        create: _('ms2bundle.controls.create'),
        update: _('ms2bundle.controls.update'),
        remove: _('ms2bundle.controls.remove'),
        remove_confirm: _('ms2bundle.controls.remove_confirm')
    },

    gridFields: [
        'id',
        'group_id',
        'name',
        'description',
        'image',
        'price',
        'weight',
        'is_default',
        'is_active',
        'proteins',
        'fats',
        'carbohydrates',
        'calories'
    ],

    gridColumns: [
        {header: _('id'), dataIndex: 'id', sortable: true, width: 0.05},
        {header:_('ms2bundle.field.image'), dataIndex:'image', sortable:false, width:0.1, renderer: ms2Bundle.renderer.image},
        {header: _('ms2bundle.field.name'), dataIndex: 'name', sortable: true, width: 0.1, editor: {xtype: 'textfield'}},
        {header: _('ms2bundle.field.price'), dataIndex: 'price', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.weight'), dataIndex: 'weight', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.proteins'), dataIndex: 'proteins', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.fats'), dataIndex: 'fats', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.carbohydrates'), dataIndex: 'carbohydrates', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.calories'), dataIndex: 'calories', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
        {header: _('ms2bundle.field.by_default'), dataIndex: 'is_default', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}},
        {header: _('ms2bundle.field.active'), dataIndex: 'is_active', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}}
    ],

    createRecordForm: {
        xtype: 'ms2bundle-window-ingredient',
        baseParams: {
            action: 'mgr/ingredient/create'
        }
    },

    updateRecordForm: {
        xtype: 'ms2bundle-window-ingredient',
        baseParams: {
            action: 'mgr/ingredient/update'
        }
    },

    removeRecordForm: {
        baseParams: {
            action: 'mgr/ingredient/remove'
        }
    }
});
Ext.reg('ms2bundle-grid-ingredients', ms2Bundle.grid.ingredients);