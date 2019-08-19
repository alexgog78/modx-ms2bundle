ms2Bundle.window.ingredient = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-window-ingredient';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl
    });
    console.log(config);
    ms2Bundle.window.ingredient.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.window.ingredient, ms2Bundle.window.abstract, {
    formInputs: {
        id: {xtype: 'hidden'},
        group_id: {xtype: 'hidden'},
        name: {xtype: 'textfield', fieldLabel: _('ms2bundle.field.name')},
        description: {xtype: 'textarea', fieldLabel: _('ms2bundle.field.description')},
        image: {xtype:'ms2bundle-combo-browser', fieldLabel:_('ms2bundle.field.image'), source: 3},//TODO source
        price: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.price'), decimalPrecision: 2},
        weight: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.weight'), decimalPrecision: 3},
        is_default: {xtype:'combo-boolean', fieldLabel:_('ms2bundle.field.by_default')},
        is_active: {xtype:'combo-boolean', fieldLabel:_('ms2bundle.field.active')},
        proteins: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.proteins'), decimalPrecision: 2},
        fats: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.fats'), decimalPrecision: 2},
        carbohydrates: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.carbohydrates'), decimalPrecision: 2},
        calories: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.calories'), decimalPrecision: 2}
    },

    defaultValues: {
        is_default: 0,
        is_active: 1
    },

    renderFormFields: function (config) {
        return [
            this.renderFormInput('id'),
            this.renderFormInput('group_id'),
            {
                xtype: 'modx-tabs',
                defaults: {
                    layout: 'form'
                },
                deferredRender: false,
                items: [{
                    title: _('ms2bundle.tab.ingredients.general'),
                    defaults: {msgTarget: 'under', anchor: '100%'},
                    items: [
                        this.renderFormInput('name'),
                        this.renderFormInput('description'),
                        this.renderFormInput('image'),
                        {
                            layout: 'column',
                            items: [{
                                columnWidth: .5,
                                layout: 'form',
                                defaults: {msgTarget: 'under', anchor: '100%'},
                                items: [
                                    this.renderFormInput('price'),
                                    this.renderFormInput('is_default')
                                ]
                            }, {
                                columnWidth: .5,
                                layout: 'form',
                                defaults: {msgTarget: 'under', anchor: '100%'},
                                items: [
                                    this.renderFormInput('weight'),
                                    this.renderFormInput('is_active')
                                ]
                            }]
                        }
                    ]
                }, {
                    title: _('ms2bundle.tab.ingredients.custom'),
                    defaults: {msgTarget: 'under', anchor: '100%'},
                    items: [
                        {
                            layout: 'column',
                            items: [{
                                columnWidth: .5,
                                layout: 'form',
                                defaults: {msgTarget: 'under', anchor: '100%'},
                                items: [
                                    this.renderFormInput('proteins'),
                                    this.renderFormInput('carbohydrates')
                                ],
                            }, {
                                columnWidth: .5,
                                layout: 'form',
                                defaults: {msgTarget: 'under', anchor: '100%'},
                                items: [
                                    this.renderFormInput('fats'),
                                    this.renderFormInput('calories')
                                ]
                            }]
                        }
                    ]
                }]
            }
        ];
    }
});
Ext.reg('ms2bundle-window-ingredient', ms2Bundle.window.ingredient);