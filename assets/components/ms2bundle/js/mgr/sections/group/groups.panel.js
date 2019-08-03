Ext.onReady(function () {
    MODx.add({
        xtype: 'ms2bundle-panel-groups'
    });
});

ms2Bundle.panel.groups = function (config) {
    config = config || {};
    Ext.apply(config, {
        border: false,
        baseCls: 'modx-formpanel',
        cls: 'container',
        items: [{
            html: '<h2>' + _('ms2bundle.section.groups') + '</h2>',
            border: false,
            cls: 'modx-page-header'
        }, {
            xtype: 'modx-tabs',
            defaults: {
                border: false,
                autoHeight: true
            },
            border: true,

            items: [{
                title: _('ms2bundle.tab.groups'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('ms2bundle.tab.groups.management') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'ms2bundle-grid-groups',
                    cls: 'main-wrapper',
                    preventRender: true
                }]
            }]
        }]
    });
    ms2Bundle.panel.groups.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.panel.groups, MODx.Panel);
Ext.reg('ms2bundle-panel-groups', ms2Bundle.panel.groups);