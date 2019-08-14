ms2Bundle.grid.groups = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-grid-groups';
    }
    Ext.applyIf(config, {
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/group/getlist'
        },
        save_action: 'mgr/group/updatefromgrid'
    });
    ms2Bundle.grid.groups.superclass.constructor.call(this, config)
};
Ext.extend(ms2Bundle.grid.groups, ms2Bundle.grid.abstract, {
    lexicons: {
        search: _('ms2bundle.controls.search'),
        search_clear: _('ms2bundle.controls.search_clear'),
        create: _('ms2bundle.controls.create'),
        update: _('ms2bundle.controls.update'),
        remove: _('ms2bundle.controls.remove'),
        remove_confirm: _('ms2bundle.controls.remove_confirm')
    },

    gridFields: [
        'id',
        'name',
        'description',
        //'template_id',
        'is_active'
    ],

    gridColumns: [
        {header: _('id'), dataIndex: 'id', sortable: true, width: 0.05},
        {header: _('ms2bundle.field.name'), dataIndex: 'name', sortable: true, width: 0.9, editor: {xtype: 'textfield'}},
        //{header: _('ms2bundle.field.template'), dataIndex: 'template_id', sortable: true, width: 0.2},
        {header: _('ms2bundle.field.active'), dataIndex: 'is_active', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}}
    ],

    removeRecordForm: {
        baseParams: {
            action: 'mgr/group/remove'
        }
    },

    createRecord: function (btn, e) {
        MODx.loadPage('mgr/group/create', 'namespace=ms2bundle');
    },

    updateRecord: function (btn, e) {
        MODx.loadPage('mgr/group/update', 'namespace=ms2bundle&id=' + this.menu.record.id);
    }
});
Ext.reg('ms2bundle-grid-groups', ms2Bundle.grid.groups);