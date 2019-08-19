ms2Bundle.combo.selectIngredient = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/ingredient/getlist',
            combo: true,
            group_id: config.group_id,
        },
        fields: ['id', 'name'],
        displayField: 'name',
        valueField: 'id',
    });
    ms2Bundle.combo.selectIngredient.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.combo.selectIngredient, ms2Bundle.combo.selectRemote);
Ext.reg('ms2bundle-combo-select-ingredient', ms2Bundle.combo.selectIngredient);