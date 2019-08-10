//TODO Ext component


/*ms2Bundle.panel.productTab = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    ms2Bundle.page.productTab.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.panel.productTab, MODx.Component, {

});
Ext.reg('ms2bundle-panel-product-tab', ms2Bundle.panel.productTab);*/

ms2Bundle.productTab = {
    getTab: function () {
        return {
            title: _('ms2bundle.tab.ingredients'),
            bodyCssClass: 'main-wrapper',
            items: this.getPanel()
        };
    },

    getPanel: function () {
        console.log(ms2Bundle.record)
        var panel = [];

        if (ms2Bundle.record.record_id === '' || ms2Bundle.record.record_id === 0) {
            return {
                html: _('ms2bundle.field.undefined'),
                cls: 'panel-desc',
                style: {
                    fontSize: '170%',
                    textAlign: 'center'
                }
            };
        }



        Ext.each(ms2Bundle.record.bundleGroups, function(groupId) {
            console.log(groupId);
            panel.push({
                xtype:'fieldset',
                title: 'ms2_product_color_textile',
                border:false,
                anchor:'100%',
                items: []
            });
        });


        return panel;
    }
}

Ext.ComponentMgr.onAvailable('minishop2-product-tabs', function () {
    this.on('beforerender', function () {
        var panel = this;
        console.log(this.config);
        panel.add(ms2Bundle.productTab.getTab());
    });
});