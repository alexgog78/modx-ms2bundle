ms2Bundle = function (config) {
    config = config || {};
    ms2Bundle.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle, abstractModule, {});
/*Ext.extend(ms2Bundle, abstractModule, {
    page: {},
    window: {},
    grid: {},
    tree: {},
    panel: {},
    formPanel: {},
    combo: {},
    config: {},
    renderer: {},
    function: {}
});*/
Ext.reg('ms2bundle', ms2Bundle);
var ms2Bundle = new ms2Bundle();