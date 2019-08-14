ms2Bundle.window.ingredient = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-window-ingredient';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl
    });
    ms2Bundle.window.ingredient.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.window.ingredient, ms2Bundle.window.abstract, {
    formFields: [
        {xtype: 'hidden', name: 'id'},
        {xtype: 'hidden', name: 'group_id'},
        {
            xtype: 'modx-tabs'
            ,defaults: {
                autoHeight: true
                ,layout: 'form'
                ,labelWidth: 150
                ,msgTarget: 'under'
                ,layoutOnTabChange: true
            }
            ,deferredRender: false
            ,items: [{
                title: _('ms2bundle.tab.ingredients.general')
                ,layout: 'form'
                ,items: [
                    //{xtype: 'ms2bundle-combo-group', name: 'group_id', fieldLabel: _('ms2bundle.field.group'), anchor: '100%', readOnly: true},
                    {xtype: 'textfield', name: 'name', fieldLabel: _('ms2bundle.field.name'), anchor: '100%'},
                    {xtype: 'textarea', name: 'description', fieldLabel: _('ms2bundle.field.description'), anchor: '100%'},
                    //TODO source
                    {xtype:'ms2bundle-combo-browser', name:'image', fieldLabel:_('ms2bundle.field.image'), anchor:'100%', source: 3},
                    {
                        layout: 'column',
                        items: [{
                            columnWidth: .5,
                            layout: 'form',
                            defaults: {msgTarget: 'under'},
                            items: [
                                {xtype: 'numberfield', name: 'price', fieldLabel: _('ms2bundle.field.price'), anchor: '100%', decimalPrecision: 2},
                                {xtype:'combo-boolean', name:'is_default', fieldLabel:_('ms2bundle.field.by_default'), anchor:'100%'},
                            ],
                        }, {
                            columnWidth: .5,
                            layout: 'form',
                            items: [
                                {xtype: 'numberfield', name: 'weight', fieldLabel: _('ms2bundle.field.weight'), anchor: '100%', decimalPrecision: 3},
                                {xtype:'combo-boolean', name:'is_active', fieldLabel:_('ms2bundle.field.active'), anchor:'100%'},
                            ],
                        }]
                    }
                ]
            },{
                title: _('ms2bundle.tab.ingredients.custom')
                ,layout: 'form'
                ,items: [
                    {
                        layout: 'column',
                        items: [{
                            columnWidth: .5,
                            layout: 'form',
                            defaults: {msgTarget: 'under'},
                            items: [
                                {xtype: 'numberfield', name: 'proteins', fieldLabel: _('ms2bundle.field.proteins'), anchor: '100%', decimalPrecision: 2},
                                {xtype: 'numberfield', name: 'carbohydrates', fieldLabel: _('ms2bundle.field.carbohydrates'), anchor: '100%', decimalPrecision: 2},
                            ],
                        }, {
                            columnWidth: .5,
                            layout: 'form',
                            items: [
                                {xtype: 'numberfield', name: 'fats', fieldLabel: _('ms2bundle.field.fats'), anchor: '100%', decimalPrecision: 2},
                                {xtype: 'numberfield', name: 'calories', fieldLabel: _('ms2bundle.field.calories'), anchor: '100%', decimalPrecision: 2},
                            ],
                        }]
                    }
                ]
            }]
        }
    ],

    defaultValues: {
        is_default: 0,
        is_active: 1
    },

    /*setRecord: function (record) {
        console
        ms2Bundle.window.ingredient.superclass.setRecord.call(this, record);
        //this.setValues({fields: record.fields_array});
    }*/
});
Ext.reg('ms2bundle-window-ingredient', ms2Bundle.window.ingredient);