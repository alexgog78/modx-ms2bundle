ms2Bundle.panel.product = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-panel-product';
    }
    Ext.applyIf(config, {
        items: [{
            xtype: 'modx-vtabs',
            autoTabs: true,
            border: false,
            plain: true,
            deferredRender: false,
            id: config.id + '-vtabs',
            items: this.getPanelTabs(config),
        }],
    });
    ms2Bundle.panel.product.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.panel.product, MODx.Panel, {
    getPanelTabs: function (config) {
        return (config.bundle.record_id === '' || config.bundle.record_id === 0) ?
            this.getUndefinedPanel(config) :
            this.getIngredientsGrids(config);
    },

    getUndefinedPanel: function (config) {
        return {
            title: _('ms2bundle.tab.ingredients'),
            layout: 'form',
            labelAlign: 'top',
            bodyCssClass: 'main-wrapper',
            items: [
                {xtype: 'ms2bundle-util-panelnotice-undefined'}
            ],
        };
    },

    getIngredientsGrids: function (config) {
        var panel = [];
        Ext.each(config.bundle.bundleGroups, function (group) {
            panel.push({
                title: group.name,
                layout: 'form',
                labelAlign: 'top',
                bodyCssClass: 'main-wrapper',
                items: [{
                    xtype: 'ms2bundle-grid-product-ingredients',
                    id: 'ms2bundle-grid-product-ingredients-' + group.id,
                    record_id: config.bundle.record_id,
                    group_id: group.id,
                }],
            });
        });
        return panel;
    },
});
Ext.reg('ms2bundle-panel-product', ms2Bundle.panel.product);