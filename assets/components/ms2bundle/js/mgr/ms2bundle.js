ms2Bundle = function (config) {
    config = config || {};
    config.namespace = 'ms2bundle';
    ms2Bundle.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle, Ext.Component, abstractModule);
Ext.reg('ms2bundle', ms2Bundle);
ms2Bundle = new ms2Bundle();


/*ms2Bundle = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    ms2Bundle.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle, zzz);*/

/*ms2Bundle = abstractModule;
Ext.reg('ms2bundle', ms2Bundle);*/
//ms2Bundle = new ms2Bundle();

/*Ext.extend(abstractModule, Ext.Component, {
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
});
Ext.reg('ms2bundle', abstractModule);
abstractModule = new abstractModule();*/