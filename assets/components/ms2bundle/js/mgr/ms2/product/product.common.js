Ext.override(miniShop2.panel.Product, {
    originals: {
        getFields: miniShop2.panel.Product.prototype.getFields
    },

    /*getFields: function (config) {
        var _this = this;
        var originals = _this.originals.getFields.call(_this, config);
        var resourceTabs = originals.find(item => item.id === 'modx-resource-tabs');
        var productTabWrapper = resourceTabs.items.find(item => item.id === 'minishop2-product-tab');
        var productTabs = productTabWrapper.items.find(item => item.id === 'minishop2-product-tabs');

        //Ext.each(ms2ExtendConfig.tabs, function(item) {
            var newTab = _this.addTab(config);
            productTabs.items.splice(3, 0, newTab);
        //});

        return originals;
    },*/

    addTab: function (config) {
        /*var enabled = miniShop2.config.data_fields;
        var available = tab.fields;

        var product_fields = this.getAllProductFields(config);
        var col1 = [];
        var col2 = [];
        var tmp;
        for (var i = 0; i < available.length; i++) {
            var field = available[i];
            if ((enabled.length > 0 && enabled.indexOf(field) === -1) || this.active_fields.indexOf(field) !== -1) {
                continue;
            }
            if (tmp = product_fields[field]) {
                this.active_fields.push(field);
                tmp = this.getExtField(config, field, tmp);
                if (i % 2) {
                    col2.push(tmp);
                } else {
                    col1.push(tmp);
                }
            }
        }*/

        return {
            title: 'zzz',
            bodyCssClass: 'main-wrapper',
            items: [],
            listeners: {},
        };
    }
});