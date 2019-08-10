Ext.onReady(function () {
    MODx.add({
        xtype: 'ms2bundle-page-group-update',
        record_id: MODx.request.id
    });
});

ms2Bundle.page.groupUpdate = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        formpanel: 'ms2bundle-formpanel-group',
        buttons: [{
            text: _('abstractmodule.controls.save'),
            process: 'mgr/group/update',
            method: 'remote',
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        }, {
            text: _('abstractmodule.controls.remove'),
            scope: this,
            handler: ms2Bundle.function.removeRecord,
            options: {
                baseParams: {
                    action: 'mgr/group/remove',
                    record: config.record_id,
                    redirect: 'mgr/groups'
                }
            }
        }, {
            text: _('abstractmodule.controls.return'),
            handler: function () {
                MODx.loadPage('mgr/groups', 'namespace=ms2bundle')
            }
        }],
        components: [{
            xtype: 'ms2bundle-formpanel-group',
            renderTo: 'modx-panel-holder',
            record_id: config.record_id
        }]
    });
    ms2Bundle.page.groupUpdate.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.page.groupUpdate, MODx.Component);
Ext.reg('ms2bundle-page-group-update', ms2Bundle.page.groupUpdate);