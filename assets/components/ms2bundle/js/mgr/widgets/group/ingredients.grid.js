ms2Bundle.grid.groupIngredients = function (config) {
    config = config || {};
    console.log(config);
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/ingredient/getlist',
            group_id: config.group_id
        },
        tbar: [
            //Search panel
            {
                xtype: 'textfield',
                id: 'ms2bundle-ingredients-search-filter',
                emptyText: _('ms2bundle.controls.search'),
                listeners: {
                    'change': {fn: ms2Bundle.function.search, scope: this},
                    'render': {
                        fn: function (cmp) {
                            new Ext.KeyMap(cmp.getEl(), {
                                key: Ext.EventObject.ENTER,
                                fn: function () {
                                    this.fireEvent('change', this);
                                    this.blur();
                                    return true;
                                },
                                scope: cmp
                            });
                        }, scope: this
                    }
                }
            },
            //Create button
            {
                text: _('ms2bundle.controls.create'),
                cls: 'primary-button',
                scope: this,
                handler: ms2Bundle.function.createRecord,
                baseParams: {
                    action: 'mgr/ingredient/create',
                    fields: this.getFields(),
                    defaults: {
                        group_id: config.group_id,
                        by_default: false,
                        active: true
                    }
                }
            }
        ]
    });
    ms2Bundle.grid.groupIngredients.superclass.constructor.call(this, config)
};
Ext.extend(ms2Bundle.grid.groupIngredients, ms2Bundle.grid.ingredients, {

});
Ext.reg('ms2bundle-grid-group-ingredients', ms2Bundle.grid.groupIngredients);