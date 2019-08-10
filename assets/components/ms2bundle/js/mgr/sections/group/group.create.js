Ext.onReady(function () {
    MODx.add({
        xtype: 'ms2bundle-page-group-create'
    });
});

ms2Bundle.page.groupCreate = function (config) {
    config = config || {};
    console.log(config);
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        formpanel: 'ms2bundle-formpanel-group',
        buttons: [{
            text: _('abstractmodule.controls.save'),
            process: 'mgr/group/create',
            method: 'remote',
            reload: true,
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        }, {
            text: _('abstractmodule.controls.cancel'),
            handler: function () {
                MODx.loadPage('mgr/groups', 'namespace=ms2bundle')
            }
        }],
        components: [{
            xtype: 'ms2bundle-formpanel-group',
            renderTo: 'modx-panel-holder',
            record_id: 0
        }]
    });
    ms2Bundle.page.groupCreate.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.page.groupCreate, MODx.Component);
Ext.reg('ms2bundle-page-group-create', ms2Bundle.page.groupCreate);