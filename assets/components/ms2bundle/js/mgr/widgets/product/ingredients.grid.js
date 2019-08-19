ms2Bundle.grid.productIngredients = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-grid-product-ingredients';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/productingredient/getlist',
            group_id: config.group_id,
            record_id: config.record_id,
        },
        autosave: false,
    });
    ms2Bundle.grid.productIngredients.superclass.constructor.call(this, config)
};
Ext.extend(ms2Bundle.grid.productIngredients, ms2Bundle.grid.abstract, {
    lexicons: {
        search: _('ms2bundle.controls.search'),
        search_clear: _('ms2bundle.controls.search_clear'),
        create: _('ms2bundle.controls.create'),
        update: _('ms2bundle.controls.update'),
        remove: _('ms2bundle.controls.remove'),
        remove_confirm: _('ms2bundle.controls.remove_confirm')
    },

    gridFields: [
        'product_id',
        'ingredient_id',
        'ingredient_group_id',
        'ingredient_name',
        'ingredient_description',
        'ingredient_image',
        'ingredient_price',
        'ingredient_weight',
        'ingredient_is_default',
        'ingredient_is_active',
        'ingredient_proteins',
        'ingredient_fats',
        'ingredient_carbohydrates',
        'ingredient_calories'
    ],

    gridColumns: [
        {header:_('ms2bundle.field.image'), dataIndex:'ingredient_image', sortable:false, width:0.1, renderer: ms2Bundle.renderer.image, editor: {xtype: false}},
        {header: _('ms2bundle.field.name'), dataIndex: 'ingredient_name', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.price'), dataIndex: 'ingredient_price', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.weight'), dataIndex: 'ingredient_weight', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.proteins'), dataIndex: 'ingredient_proteins', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.fats'), dataIndex: 'ingredient_fats', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.carbohydrates'), dataIndex: 'ingredient_carbohydrates', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.calories'), dataIndex: 'ingredient_calories', sortable: true, width: 0.1, editor: {xtype: false}},
        {header: _('ms2bundle.field.by_default'), dataIndex: 'ingredient_is_default', sortable: true, width: 0.1, renderer: ms2Bundle.renderer.boolean, editor: {xtype: false}},
        {header: _('ms2bundle.field.active'), dataIndex: 'ingredient_is_active', sortable: true, width: 0.1, renderer: ms2Bundle.renderer.boolean, editor: {xtype: false}}
    ],

    createRecordForm: {
        xtype: 'ms2bundle-window-product-ingredient',
        baseParams: {
            action: 'mgr/productingredient/create'
        }
    },

    removeRecordForm: {
        baseParams: {
            action: 'mgr/productingredient/remove'
        }
    },

    getMenu: function () {
        return [{
            text: this.lexicons.remove,
            handler: this.removeRecord,
            scope: this
        }];
    },

    createRecord: function (btn, e) {
        ms2Bundle.grid.productIngredients.superclass.createRecord.call(this, btn, e);
        var window = Ext.getCmp(this.createRecordForm.xtype);
        window.setValues({
            product_id: this.config.record_id,
        });
    },

    removeRecord: function (btn, e) {
        MODx.msg.confirm(Ext.apply({
            title: this.lexicons.remove,
            text: this.lexicons.remove_confirm,
            url: this.config.url,
            params: {
                action: this.removeRecordForm.baseParams.action,
                product_id: this.menu.record.product_id,
                ingredient_id: this.menu.record.ingredient_id,
            },
            listeners: {
                success: {fn: this.refresh, scope: this},
            },
        }, this.removeRecordForm));
    },
});
Ext.reg('ms2bundle-grid-product-ingredients', ms2Bundle.grid.productIngredients);