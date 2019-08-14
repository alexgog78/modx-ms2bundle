//Modal window
/*ms2Bundle.window.recordWindow = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        width: config.width || 600
    });
    ms2Bundle.window.recordWindow.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.window.recordWindow, MODx.Window);
Ext.reg('ms2bundle-window-record', ms2Bundle.window.recordWindow);*/


/*ms2Bundle.combo.zzz = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        html: _('ms2bundle.field.undefined'),
        cls: 'panel-desc',
        style: {
            fontSize: '170%',
            textAlign: 'center'
        }
    });
    ms2Bundle.combo.zzz.superclass.constructor.call(this,config);
};
//Ext.extend(ms2Bundle.combo.zzz, Ext.panel);
Ext.reg('ms2bundle-combo-undefined', ms2Bundle.combo.zzz);*/


ms2Bundle.combo.groupSelect = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        name: config.name || 'group_id',
        hiddenName: config.name || 'group_id',
        displayField: 'name',
        valueField: 'id',
        editable: true,
        fields: ['id', 'name'],
        pageSize: 20,
        emptyText: _('no'),
        hideMode: 'offsets',
        url: ms2Bundle.config.connectorUrl,
        baseParams: {
            action: 'mgr/group/getlist',
            combo: true
        }
    });
    ms2Bundle.combo.groupSelect.superclass.constructor.call(this,config);
};
Ext.extend(ms2Bundle.combo.groupSelect, MODx.combo.ComboBox);
Ext.reg('ms2bundle-combo-group', ms2Bundle.combo.groupSelect);


ms2Bundle.combo.templateMultiselect = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype:'superboxselect',
        allowBlank: true,
        msgTarget: 'under',
        allowAddNewData: true,
        addNewDataOnBlur : true,
        resizable: true,
        name: config.name || 'template_ids',
        anchor:'99%',
        minChars: 1,
        pageSize: 200,
        store: new Ext.data.JsonStore({
            id: (config.id || 'template_ids') + '-store',
            root:'results',
            autoLoad: true,
            autoSave: false,
            totalProperty:'total',
            fields:['id', 'templatename'],
            url: MODx.config.connector_url,
            baseParams: {
                action: 'element/template/getlist',
                combo: 1
            }
        }),
        mode: 'remote',
        displayField: 'templatename',
        valueField: 'id',
        triggerAction: 'all',
        extraItemCls: 'x-tag',
        expandBtnCls: 'x-form-trigger',
        clearBtnCls: 'x-form-trigger',
        listeners: {}
    });
    config.name += '[]';
    ms2Bundle.combo.templateMultiselect.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.combo.templateMultiselect, Ext.ux.form.SuperBoxSelect);
Ext.reg('ms2bundle-combo-templates', ms2Bundle.combo.templateMultiselect);


ms2Bundle.combo.Browser = function(config){
    config = config || {};

    if (config.length != 0 && typeof config.openTo !== "undefined") {
        if (!/^\//.test(config.openTo)) {
            config.openTo = '/' + config.openTo;
        }
        if (!/$\//.test(config.openTo)) {
            var tmp = config.openTo.split('/')
            delete tmp[tmp.length - 1];
            tmp = tmp.join('/');
            config.openTo = tmp.substr(1)
        }
    }

    Ext.applyIf(config,{
        width: 300
        ,triggerAction: 'all'
    });
    ms2Bundle.combo.Browser.superclass.constructor.call(this,config);
    this.config = config;
};
Ext.extend(ms2Bundle.combo.Browser, Ext.form.TriggerField,{
    browser: null

    ,onTriggerClick : function(btn){
        if (this.disabled){
            return false;
        }

        if (this.browser === null) {
            this.browser = MODx.load({
                xtype: 'modx-browser'
                ,id: Ext.id()
                ,multiple: true
                ,source: this.config.source || MODx.config.default_media_source
                ,rootVisible: this.config.rootVisible || false
                ,allowedFileTypes: this.config.allowedFileTypes || ''
                ,wctx: this.config.wctx || 'web'
                ,openTo: this.config.openTo || ''
                ,rootId: this.config.rootId || '/'
                ,hideSourceCombo: this.config.hideSourceCombo || false
                ,hideFiles: this.config.hideFiles || true
                ,listeners: {
                    'select': {fn: function(data) {
                            this.setValue(data.fullRelativeUrl);
                            var field = Ext.getCmp('imgbrowser-'+this.config.name);
                            if(field){
                                field.setValue('<img src="/connectors/system/phpthumb.php?&w=150&aoe=0&far=0&src='+data.fullRelativeUrl+'" alt="">');
                            }
                        },scope:this}
                }
            });
        }
        this.browser.win.buttons[0].on('disable',function(e) {this.enable()})
        this.browser.win.tree.on('click', function(n,e) {
                path = this.getPath(n);
                this.setValue(path);
            },this
        );
        this.browser.win.tree.on('dblclick', function(n,e) {
                path = this.getPath(n);
                this.setValue(path);
                this.browser.hide()
            },this
        );
        this.browser.show(btn);
        return true;
    }
    ,onDestroy: function(){
        ms2Bundle.combo.Browser.superclass.onDestroy.call(this);
    }
    ,getPath: function(n) {
        if (n.id == '/') {return '';}
        data = n.attributes;
        path = data.path + '/';

        return path;
    }
});
Ext.reg('ms2bundle-combo-browser', ms2Bundle.combo.Browser);