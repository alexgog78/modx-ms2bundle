ms2Bundle.window.productIngredient = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-window-product-ingredient';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
    });
    ms2Bundle.window.productIngredient.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.window.productIngredient, ms2Bundle.window.abstract, {
    formInputs: {
        product_id: {xtype: 'hidden'},
        ingredient_id: {xtype: 'ms2bundle-combo-select-ingredient', fieldLabel: _('ms2bundle.field.ingredient')},
    },

    renderFormFields: function (config) {
        return [
            this.renderFormInput('product_id'),
            this.renderFormInput('ingredient_id', {group_id: config.parent.config.group_id}),
        ];
    },
});
Ext.reg('ms2bundle-window-product-ingredient', ms2Bundle.window.productIngredient);