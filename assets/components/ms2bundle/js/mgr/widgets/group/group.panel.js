ms2Bundle.panel.group = function (config) {
    config = config || {};
    Ext.apply(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {},
        border: false,
        id: 'ms2bundle-panel-group',
        baseCls: 'modx-formpanel',
        cls: 'container',
        useLoadingMask: true,
        items: [{
            html: '<h2>' + _('ms2bundle.section.group') + '</h2>',
            border: false,
            cls: 'modx-page-header',
            id: 'ms2bundle-panel-group-header'
        }, {
            xtype: 'modx-tabs',
            defaults: {
                autoHeight: true,
                layout: 'form',
                labelWidth: 150,
                msgTarget: 'under',
                bodyCssClass: 'tab-panel-wrapper',
                layoutOnTabChange: true
            },
            items: this.getTabs(config)
        }],
        listeners: {
            'setup': {fn: this.setup, scope: this},
            'success': {fn: this.success, scope: this},
            //'failure': {fn:this.failure, scope:this},
            'beforeSubmit': {fn: this.beforeSubmit, scope: this},
            //'fieldChange': {fn:this.onFieldChange, scope:this},
            //'failureSubmit': {fn:this.failureSubmit, scope:this}
        }
    });
    ms2Bundle.panel.group.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.panel.group, MODx.FormPanel, {
    setup: function () {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            this.fireEvent('ready');
            return false;
        }


        /*this.fireEvent('ready');
        this.initialized = true;

        MODx.fireEvent('ready');
        //MODx.sleep(4);
        //if (MODx.afterTVLoad) { MODx.afterTVLoad(); }
        this.fireEvent('load');*/

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
                        var templatesIds = response.object['template_ids'];
                        var templatesInput = Ext.getCmp('templates-multiselect');
                        templatesInput.setValue(templatesIds);

                        Ext.get('ms2bundle-panel-group-header').update('<h2>' + _('ms2bundle.section.group') + ': ' + response.object.name + '</h2>');
                        this.fireEvent('ready', response.object);
                        MODx.fireEvent('ready');
                    }, scope: this
                }
            }
        });
    },

    beforeSubmit: function (o) {

    },

    success: function (o) {
        if (this.config.record_id === '' || this.config.record_id === 0) {
            MODx.loadPage('mgr/group/update', 'namespace=ms2bundle&id=' + o.result.object.id);
        }
    },

    getTabs: function (config) {
        var tabs = [];
        tabs.push({
            title: _('ms2bundle.tab.group'),
            items: [{
                html: '<p>' + _('ms2bundle.tab.group.management') + '</p>',
                bodyCssClass: 'panel-desc'
            }, {
                cls: 'main-wrapper form-with-labels',
                labelAlign: 'top',
                items: this.getMainPanel(config)
            }]
        }, {
            title: _('ms2bundle.tab.ingridients')
            , items: [{
                html: '<p>' + _('ms2bundle.tab.ingridients.management') + '</p>',
                bodyCssClass: 'panel-desc'
            }, {
                cls: 'main-wrapper form-with-labels',
                labelAlign: 'top',
                items: [
                    (config.record_id === '' || config.record_id === 0) ? {
                        html: _('ms2bundle.field.undefined'),
                        cls: 'panel-desc',
                        style: {
                            fontSize: '170%',
                            textAlign: 'center'
                        }
                    } : {xtype: 'ms2bundle-grid-ingredients', group_id: config.record_id, anchor: '100%'}
                ]
            }]
        });
        return tabs;
    },

    getMainPanel: function (config) {
        var panel = [];
        panel.push(
            {xtype: 'hidden', name: 'id'},
            {
                layout: 'column',
                defaults: {
                    layout: 'form',
                    labelAlign: 'top',
                    labelSeparator: '',
                    border: false
                },
                style: 'margin-bottom:25px;',
                items: [{
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        {xtype: 'textfield', name: 'name', fieldLabel: _('ms2bundle.field.name'), anchor: '100%'},
                        {xtype: 'textarea', name: 'description', fieldLabel: _('ms2bundle.field.description'), anchor: '100%', height: 101}
                    ]
                }, {
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        {xtype: 'xcheckbox', name: 'active', boxLabel: _('ms2bundle.field.active'), inputValue: 1, checked: (config.record_id === '' || config.record_id === 0) ? true : false},
                        {xtype: 'ms2bundle-combo-templates', name: 'template_ids', fieldLabel: _('ms2bundle.field.template'), anchor: '100%', id:'templates-multiselect'}
                    ]
                }]
            }
        );
        return panel;
    }
});
Ext.reg('ms2bundle-panel-group', ms2Bundle.panel.group);