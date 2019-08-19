Ext.ComponentMgr.onAvailable('minishop2-product-tabs', function () {
    this.on('beforerender', function () {
        var panel = this;
        if (!ms2Bundle.bundle.bundleGroups.length) {
            return;
        }
        panel.add({
            title: _('ms2bundle.tab.ingredients'),
            items: [{
                xtype: 'ms2bundle-panel-product',
                bundle: ms2Bundle.bundle,
            }]
        });
    });
});