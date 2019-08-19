ms2Bundle.grid.groupIngredients = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-grid-group-ingredients';
    }
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/ingredient/getlist',
            group_id: config.group_id
        }
    });
    ms2Bundle.grid.groupIngredients.superclass.constructor.call(this, config)
};
Ext.extend(ms2Bundle.grid.groupIngredients, ms2Bundle.grid.ingredients, {
    createRecord: function (btn, e) {
        ms2Bundle.grid.groupIngredients.superclass.createRecord.call(this, btn, e);
        var window = Ext.getCmp(this.createRecordForm.xtype);
        window.setValues({
            group_id: this.config.group_id
        });
    },
});
Ext.reg('ms2bundle-grid-group-ingredients', ms2Bundle.grid.groupIngredients);