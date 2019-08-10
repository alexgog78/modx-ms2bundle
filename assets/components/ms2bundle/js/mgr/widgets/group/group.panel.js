ms2Bundle.formPanel.group = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-formpanel-group';
    }
    Ext.apply(config, {
        url: ms2Bundle.config.connectorUrl,
        title: _('ms2bundle.section.group')
    });
    ms2Bundle.formPanel.group.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.formPanel.group, ms2Bundle.formPanel.abstract, {
    formInputs: {
        id: {xtype: 'hidden'},
        name: {xtype: 'textfield', fieldLabel: _('abstractmodule.field.name')},
        description: {xtype: 'textarea', fieldLabel: _('abstractmodule.field.description'), height: 170},
        ingredients_min: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.ingredients_min'), decimalPrecision: 0},
        ingredients_max: {xtype: 'numberfield', fieldLabel: _('ms2bundle.field.ingredients_max'), decimalPrecision: 0},
        active: {xtype: 'combo-boolean', fieldLabel: _('abstractmodule.field.active'), value: 1},
        template_ids: {xtype: 'ms2bundle-combo-templates', fieldLabel: _('ms2bundle.field.templates')}
    },

    getPanelTabs: function (config) {
        var mainPanel = this.getPanelTab(
            _('ms2bundle.tab.group'),
            _('ms2bundle.tab.group.management'),
            this.getMainPanel(config)
        );
        var ingredientsPanel = this.getPanelTab(
            _('ms2bundle.tab.ingredients'),
            _('ms2bundle.tab.ingredients.management'),
            this.getIngredientsPanel(config)
        );
        return [mainPanel, ingredientsPanel];
    },

    setup: function () {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            this.fireEvent('ready');
            return false;
        }
        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/group/get',
                id: this.config.record_id
            },
            listeners: {
                success: {
                    fn: function (response) {
                        console.log(response.object);
                        this.getForm().setValues(response.object);

                        //Templates input
                        var templates = response.object['templates'];
                        var templatesInput = Ext.getCmp('templates-multiselect');
                        templatesInput.setValueEx(templates)

                        Ext.get(this.config.id + '-header').update('<h2>' + _('ms2bundle.section.group') + ': ' + response.object.name + '</h2>');
                        //this.fireEvent('ready', response.object);
                        MODx.fireEvent('ready');
                    }, scope: this
                }
            }
        });
    },

    success: function (o) {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            MODx.loadPage('mgr/group/update', 'namespace=ms2bundle&id=' + o.result.object.id);
        }
    },

    getMainPanel: function (config) {
        return [
            this.getFormInput('id'),
            {
                layout: 'column',
                items: [{
                    columnWidth: 0.5,
                    defaults: {
                        layout: 'column'
                    },
                    items: [{
                        defaults: {
                            layout: 'form'
                        },
                        items: [{
                            columnWidth: 0.5,
                            defaults: {
                                msgTarget: 'under',
                                anchor: '100%'
                            },
                            items: [
                                this.getFormInput('name')
                            ]
                        }, {
                            columnWidth: 0.5,
                            defaults: {
                                msgTarget: 'under',
                                anchor: '100%'
                            },
                            items: [
                                this.getFormInput('active')
                            ]
                        }]
                    }, {
                        defaults: {
                            layout: 'form'
                        },
                        items: [{
                            columnWidth: 1,
                            defaults: {
                                msgTarget: 'under',
                                anchor: '100%'
                            },
                            items: [
                                this.getFormInput('template_ids', {id: 'templates-multiselect'})
                            ]
                        }]
                    }, {
                        defaults: {
                            layout: 'form'
                        },
                        items: [{
                            columnWidth: 0.5,
                            defaults: {
                                msgTarget: 'under',
                                anchor: '100%'
                            },
                            items: [
                                this.getFormInput('ingredients_min')
                            ]
                        }, {
                            columnWidth: 0.5,
                            defaults: {
                                msgTarget: 'under',
                                anchor: '100%'
                            },
                            items: [
                                this.getFormInput('ingredients_max')
                            ]
                        }]
                    }]
                }, {
                    columnWidth: 0.5,
                    layout: 'form',
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        this.getFormInput('description')
                    ]
                }]
            }
        ];
    },

    getIngredientsPanel: function (config) {
        var panel = [];
        panel.push((config.record_id === '' || config.record_id === 0) ? {
            html: _('abstractmodule.field.undefined'),
            cls: 'panel-desc',
            style: {
                fontSize: '170%',
                textAlign: 'center'
            }
        } : {xtype: 'ms2bundle-grid-group-ingredients', group_id: config.record_id, anchor: '100%'});
        /*var panel = [
            {xtype: 'ms2bundle-combo-undefined'}
        ];*/
        return panel;
    }
});
Ext.reg('ms2bundle-formpanel-group', ms2Bundle.formPanel.group);