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
        save_action: 'mgr/group/updatefromgrid',
        fields: [
            'id',
            'name',
            'description',
            //'template_id',
            'active'
        ],
        columns: [
            {header: _('id'), dataIndex: 'id', sortable: true, width: 0.05},
            {header: _('abstractmodule.field.name'), dataIndex: 'name', sortable: true, width: 0.2, editor: {xtype: 'textfield'}},
            //{header: _('ms2bundle.field.template'), dataIndex: 'template_id', sortable: true, width: 0.2},
            {header: _('abstractmodule.field.active'), dataIndex: 'active', sortable: true, width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}}
        ],

        //Toolbar
        tbar: [
            //Search panel
            {
                xtype: 'textfield',
                id: config.id + '-search-filter',
                emptyText: _('abstractmodule.controls.search'),
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
                text: _('abstractmodule.controls.create'),
                handler: this.createFunction,
                scope: this,
                cls: 'primary-button'
            }
        ],

        //Grid row additional classes
        /*viewConfig: {
            forceFit: true,
            getRowClass: function (record, index, rowParams, store) {
                var rowClass = [];
                if (record.get('active') == 0 || record.get('blocked') == 1) {
                    rowClass.push('grid-row-inactive');
                }
                return rowClass.join(' ');
            }
        }*/
    });
    ms2Bundle.grid.groups.superclass.constructor.call(this, config)
};
Ext.extend(ms2Bundle.grid.groups, ms2Bundle.grid.abstract, {
    //Context menu function
    getMenu: function () {
        return [{
            text: _('abstractmodule.controls.update'),
            handler: this.updateFunction
        }, '-', {
            text: _('abstractmodule.controls.remove'),
            handler: ms2Bundle.function.removeRecord,
            baseParams: {
                action: 'mgr/group/remove'
            }
        }];
    },

    //Create function
    createFunction: function (btn, e) {
        MODx.loadPage('mgr/group/create', 'namespace=ms2bundle');
    },

    //Update function
    updateFunction: function (btn, e) {
        MODx.loadPage('mgr/group/update', 'namespace=ms2bundle&id=' + this.menu.record.id);
    }
});
Ext.reg('ms2bundle-grid-groups', ms2Bundle.grid.groups);