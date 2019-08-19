ms2Bundle.util.panelNotice.indevelopment = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2bundle-util-panelnotice-indevelopment';
    }
    Ext.applyIf(config, {});
    ms2Bundle.util.panelNotice.indevelopment.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle.util.panelNotice.indevelopment, ms2Bundle.util.panelNotice.abstract, {
    panelHtml: _('ms2bundle.field.indevelopment')
});
Ext.reg('ms2bundle-util-panelnotice-indevelopment', ms2Bundle.util.panelNotice.indevelopment);