ms2Bundle.util.panelNotice.undefined = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-util-panelnotice-undefined';
    }
    Ext.applyIf(config, {});
    ms2Bundle.util.panelNotice.undefined.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.util.panelNotice.undefined, ms2Bundle.util.panelNotice.abstract, {
    panelHtml: _('ms2bundle.field.undefined')
});
Ext.reg('ms2bundle-util-panelnotice-undefined', ms2Bundle.util.panelNotice.undefined);