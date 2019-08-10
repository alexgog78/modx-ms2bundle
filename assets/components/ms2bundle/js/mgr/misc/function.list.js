ms2Bundle.function = {
    search: function (tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },

    createRecord: function (btn, e) {
        var options = btn.baseParams;
        if (this.windows.createWindow) this.windows.createWindow.getEl().remove();
        if (this.windows.updateWindow) this.windows.updateWindow.getEl().remove();
        this.windows.createWindow = MODx.load({
            xtype: 'ms2bundle-window-record',
            title: _('abstractmodule.controls.create'),
            width: options.width || 600,
            url: this.config.url,
            baseParams: {
                action: options.action
            },
            fields: options.fields,
            listeners: {
                success: {fn: this.refresh, scope: this},
                hide: {
                    fn: function () {
                        this.refresh
                    }
                }
            }
        });
        this.windows.createWindow.fp.getForm().reset().setValues(options.defaults);
        this.windows.createWindow.show(e.target);
    },

    updateRecord: function (btn, e) {
        var options = btn.options.baseParams;
        if (this.windows.createWindow) this.windows.createWindow.getEl().remove();
        if (this.windows.updateWindow) this.windows.updateWindow.getEl().remove();
        this.windows.updateWindow = MODx.load({
            xtype: 'ms2bundle-window-record',
            title: _('abstractmodule.controls.update'),
            width: options.width || 600,
            url: this.config.url,
            baseParams: {
                action: options.action
            },
            record: this.menu.record,
            fields: options.fields,
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        this.windows.updateWindow.fp.getForm().reset();
        this.windows.updateWindow.show(e.target);
        this.windows.updateWindow.fp.getForm().setValues(this.menu.record);
    },

    removeRecord: function (btn, e) {
        var options = btn.options.baseParams;
        MODx.msg.confirm({
            title: _('abstractmodule.controls.remove'),
            text: _('abstractmodule.controls.remove_confirm'),
            url: this.config.url,
            params: {
                action: options.action,
                id: options.record != undefined ? options.record : this.menu.record.id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        if (options.redirect) {
                            MODx.loadPage(options.redirect, 'namespace=ms2bundle');
                        } else {
                            this.refresh();
                        }
                    }, scope: this
                }
            }
        });
    }
}