//TODO
ms2Bundle.combo.templateMultiselect = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype:'superboxselect',
        allowBlank: true,
        msgTarget: 'under',
        allowAddNewData: true,
        addNewDataOnBlur : true,
        resizable: true,
        name: config.name || 'template_ids',
        anchor:'99%',
        minChars: 1,
        pageSize: 200,
        store: new Ext.data.JsonStore({
            id: (config.id || 'template_ids') + '-store',
            root:'results',
            autoLoad: true,
            autoSave: false,
            totalProperty:'total',
            fields:['id', 'templatename'],
            url: MODx.config.connector_url,
            baseParams: {
                action: 'element/template/getlist',
                combo: 1
            }
        }),
        mode: 'remote',
        displayField: 'templatename',
        valueField: 'id',
        triggerAction: 'all',
        extraItemCls: 'x-tag',
        expandBtnCls: 'x-form-trigger',
        clearBtnCls: 'x-form-trigger',
        listeners: {}
    });
    config.name += '[]';
    ms2Bundle.combo.templateMultiselect.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.combo.templateMultiselect, Ext.ux.form.SuperBoxSelect);
Ext.reg('ms2bundle-combo-multiselect-templates', ms2Bundle.combo.templateMultiselect);