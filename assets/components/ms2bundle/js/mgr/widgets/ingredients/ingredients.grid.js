ms2Bundle.grid.ingredients = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-grid-ingredients';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/ingredient/getlist'
        },
        save_action: 'mgr/ingredient/updatefromgrid',
        fields: [
            'id',
            'group_id',
            'name',
            'description',
            'image',
            'price',
            'weight',
            'by_default',
            'active',
            'proteins',
            'fats',
            'carbohydrates',
            'calories',
        ],
        columns: [
            {header: _('id'), dataIndex: 'id', sortable: true, width: 0.05},
            {header:_('ms2bundle.field.image'), dataIndex:'image', sortable:false, width:0.1, renderer: ms2Bundle.renderer.image},
            {header: _('ms2bundle.field.name'), dataIndex: 'name', sortable: true, width: 0.1, editor: {xtype: 'textfield'}},
            {header: _('ms2bundle.field.price'), dataIndex: 'price', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.weight'), dataIndex: 'weight', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.proteins'), dataIndex: 'proteins', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.fats'), dataIndex: 'fats', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.carbohydrates'), dataIndex: 'carbohydrates', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.calories'), dataIndex: 'calories', sortable: true, width: 0.1, editor: {xtype: 'numberfield'}},
            {header: _('ms2bundle.field.by_default'), dataIndex: 'by_default', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}},
            {header: _('ms2bundle.field.active'), dataIndex: 'active', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}}
        ],

        //Toolbar
        tbar: [
            //Search panel
            {
                xtype: 'textfield',
                id: config.id + '-search-filter',
                emptyText: _('ms2bundle.controls.search'),
                listeners: {
                    'change': {fn: ms2Bundle.function.search, scope: this},
                    'render': {
                        fn: function (cmp) {
                            new Ext.KeyMap(cmp.getEl(), {
                                key: Ext.EventObject.ENTER,
                                fn: function () {
                                    this.fireEvent('change', this);
                                    this.blur();
                                    return true;
                                },
                                scope: cmp
                            });
                        }, scope: this
                    }
                }
            },
            //Create button
            {
                text: _('ms2bundle.controls.create'),
                cls: 'primary-button',
                scope: this,
                handler: ms2Bundle.function.createRecord,
                baseParams: {
                    action: 'mgr/ingredient/create',
                    fields: this.getFields(),
                    defaults: {
                        //group_id: config.group_id,
                        by_default: false,
                        active: true
                    }
                }
            }
        ]
    });
    ms2Bundle.grid.ingredients.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.grid.ingredients, ms2Bundle.grid.abstract, {
    //Context menu function
    getMenu: function () {
        return [{
            text: _('ms2bundle.controls.update'),
            handler: ms2Bundle.function.updateRecord,
            baseParams: {
                action: 'mgr/ingredient/update',
                fields: this.getFields('update')
            }
        }, '-', {
            text: _('ms2bundle.controls.remove'),
            handler: ms2Bundle.function.removeRecord,
            baseParams: {
                action: 'mgr/ingredient/remove'
            }
        }];
    },

    //Form fields function
    getFields: function (action) {
        var fields = [];
        fields.push(
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
                                    {xtype:'combo-boolean', name:'by_default', fieldLabel:_('ms2bundle.field.by_default'), anchor:'100%'},
                                ],
                            }, {
                                columnWidth: .5,
                                layout: 'form',
                                items: [
                                    {xtype: 'numberfield', name: 'weight', fieldLabel: _('ms2bundle.field.weight'), anchor: '100%', decimalPrecision: 3},
                                    {xtype:'combo-boolean', name:'active', fieldLabel:_('ms2bundle.field.active'), anchor:'100%'},
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







            //{xtype:'combo-boolean', name:'active', fieldLabel:_('ms2bundle.field.active'), anchor:'100%'},
            //{xtype:'datefield', name:'date_from', fieldLabel:_('ms2bundle.field.coupon.date_from'), anchor:'100%', startDay:1, format:'Y-m-d'},
            //{xtype:'datefield', name:'date_to', fieldLabel:_('ms2bundle.field.coupon.date_to'), anchor:'100%', startDay:1, format:'Y-m-d'}

            /*<field key="group_id" dbtype="int" precision="10" attributes="unsigned" phptype="integer" null="false"/>
            <field key="name" dbtype="varchar" precision="255" phptype="string" null="true"/>
            <field key="description" dbtype="varchar" precision="255" phptype="string" null="true"/>
            <field key="image" dbtype="varchar" precision="255" phptype="string" null="true"/>
            <field key="price" dbtype="decimal" precision="12,2" phptype="float" default="0"/>
            <field key="weight" dbtype="decimal" precision="13,3" phptype="float" default="0"/>
            <field key="by_default" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0"/>
            <field key="active" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1"/>*/
        );
        return fields;
    }
});
Ext.reg('ms2bundle-grid-ingredients', ms2Bundle.grid.ingredients);