ms2Bundle.formPanel.group = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-formpanel-group';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            getAction: 'mgr/group/get'
        }
    });
    ms2Bundle.formPanel.group.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.formPanel.group, ms2Bundle.formPanel.abstract, {
    pageHeader: _('ms2bundle.section.group'),

    formInputs: {
        id: {xtype: 'hidden'},
        name: {xtype: 'textfield', fieldLabel: _('ms2bundle.field.name')},
        description: {xtype: 'textarea', fieldLabel: _('ms2bundle.field.description'), height: 170},
        ingredients_min: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.ingredients_min'), decimalPrecision: 0},
        ingredients_max: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.ingredients_max'), decimalPrecision: 0},
        is_active: {xtype: 'combo-boolean', hiddenName: 'is_active', fieldLabel: _('ms2bundle.field.active'), value: 1},
        template_ids: {xtype: 'ms2bundle-combo-multiselect-templates', fieldLabel: _('ms2bundle.field.templates')}
    },

    renderPanelTabs: function (config) {
        var mainTab = this.renderPanelTab(_('ms2bundle.tab.group'), [
            this.renderPanelDescription(_('ms2bundle.tab.group.management')),
            this.renderPanelContent(
                this.renderMainPanel(config)
            )
        ]);
        var ingredientsTab = this.renderPanelTab(_('ms2bundle.tab.ingredients'), [
            this.renderPanelDescription(_('ms2bundle.tab.ingredients.management')),
            this.renderPanelContent(
                this.renderIngredientsPanel(config)
            )
        ]);
        return [mainTab, ingredientsTab];
    },

    //TODO
    /*setRecordData: function () {

    },*/

    setup: function () {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            this.fireEvent('ready');
            return false;
        }
        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: this.config.baseParams.getAction,
                //action: 'mgr/group/get',
                id: this.config.record_id
            },
            listeners: {
                success: {fn: function (response) {
                    console.log(response.object);
                    this.getForm().setValues(response.object);

                    //Templates input
                    var templates = response.object['templates'];
                    var templatesInput = Ext.getCmp('templates-multiselect');
                    templatesInput.setValueEx(templates)

                    Ext.get(this.config.id + '-header').update('<h2>' + this.pageHeader + ': ' + response.object.name + '</h2>');
                    this.fireEvent('ready', response.object);
                    MODx.fireEvent('ready');
                }, scope: this}
            }
        });
    },

    success: function (o) {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            MODx.loadPage('mgr/group/update', 'namespace=ms2bundle&id=' + o.result.object.id);
        }
    },

    renderMainPanel: function (config) {
        return [
            this.renderFormInput('id'),
            {
                layout: 'column',
                items: [{
                    columnWidth: 0.5,
                    defaults: {layout: 'column'},
                    items: [{
                        defaults: {layout: 'form'},
                        items: [{
                            columnWidth: 0.5,
                            defaults: {msgTarget: 'under', anchor: '100%'},
                            items: [
                                this.renderFormInput('name')
                            ]
                        }, {
                            columnWidth: 0.5,
                            defaults: {msgTarget: 'under', anchor: '100%'},
                            items: [
                                this.renderFormInput('is_active')
                            ]
                        }]
                    }, {
                        defaults: {layout: 'form'},
                        items: [{
                            columnWidth: 1,
                            defaults: {msgTarget: 'under', anchor: '100%'},
                            items: [
                                this.renderFormInput('template_ids', {id: 'templates-multiselect'})
                            ]
                        }]
                    }, {
                        defaults: {layout: 'form'},
                        items: [{
                            columnWidth: 0.5,
                            defaults: {msgTarget: 'under', anchor: '100%'},
                            items: [
                                this.renderFormInput('ingredients_min')
                            ]
                        }, {
                            columnWidth: 0.5,
                            defaults: {msgTarget: 'under', anchor: '100%'},
                            items: [
                                this.renderFormInput('ingredients_max')
                            ]
                        }]
                    }]
                }, {
                    columnWidth: 0.5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', anchor: '100%'},
                    items: [
                        this.renderFormInput('description')
                    ]
                }]
            }
        ];
    },

    renderIngredientsPanel: function (config) {
        return (config.record_id === '' || config.record_id === 0) ?
            {xtype: 'ms2bundle-util-panelnotice-undefined'} :
            {xtype: 'ms2bundle-grid-group-ingredients', group_id: config.record_id, anchor: '100%'};
    }
});
Ext.reg('ms2bundle-formpanel-group', ms2Bundle.formPanel.group);

