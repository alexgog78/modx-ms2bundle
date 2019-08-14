ms2Bundle = function (config) {
    config = config || {};
    ms2Bundle.superclass.constructor.call(this, config);
};
Ext.extend(ms2Bundle, Ext.Component, abstractModule);
Ext.reg('ms2bundle', ms2Bundle);
ms2Bundle = new ms2Bundle();