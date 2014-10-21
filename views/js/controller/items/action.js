
define([
    'layout/actions/binder',
    'uri',
    'taoItems/preview/preview'
], function(binder, uri, preview){

    binder.register('itemPreview', function itemPreview(actionContext){
        preview.init(uri.decode(actionContext.uri));
        preview.show();
    });

});