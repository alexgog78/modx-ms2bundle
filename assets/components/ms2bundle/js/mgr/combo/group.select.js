ms2Bundle.combo.selectGroup = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/group/getlist',
            combo: true
        },
        fields: ['id', 'name'],
        displayField: 'name',
        valueField: 'id',
    });
    ms2Bundle.combo.selectGroup.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.combo.selectGroup, ms2Bundle.combo.selectRemote);
Ext.reg('ms2bundle-combo-select-group', ms2Bundle.combo.selectGroup);