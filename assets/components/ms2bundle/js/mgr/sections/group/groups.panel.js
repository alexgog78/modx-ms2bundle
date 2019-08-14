Ext.onReady(function () {
    MODx.add({
        xtype: 'ms2bundle-panel-groups'
    });
});
ms2Bundle.panel.groups = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-panel-groups';
    }
    Ext.apply(config, {});
    ms2Bundle.panel.groups.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.panel.groups, ms2Bundle.panel.abstract, {
    pageHeader: _('ms2bundle.section.groups'),

    panelTabs: [{
        title: _('ms2bundle.tab.groups'),
        description: _('ms2bundle.tab.groups.management'),
        xtype: 'ms2bundle-grid-groups'
    }]
});
Ext.reg('ms2bundle-panel-groups', ms2Bundle.panel.groups);