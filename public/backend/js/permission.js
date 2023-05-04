"use strict";


jQuery('.mainmodule').each(function() {
    var mainmodule  = jQuery(this).attr('id');

    var mainidCreate  = mainmodule+"_create";
    var mainidEdit    = mainmodule+"_edit";
    var mainidDestroy = mainmodule+"_destroy";
    var mainidShow    = mainmodule+"_show";

    if (!jQuery('#'+mainmodule).is(':checked')) {
        jQuery('#'+mainidCreate).prop('disabled', true);
        jQuery('#'+mainidCreate).prop('checked', false);
    
        jQuery('#'+mainidEdit).prop('disabled', true);
        jQuery('#'+mainidEdit).prop('checked', false);
    
        jQuery('#'+mainidDestroy).prop('disabled', true);
        jQuery('#'+mainidDestroy).prop('checked', false);
    
        jQuery('#'+mainidShow).prop('disabled', true);
        jQuery('#'+mainidShow).prop('checked', false);
    }
});


function processCheck(event) {
    var mainmodule  = jQuery(event).attr('id');

    var mainidCreate = mainmodule+"_create";
    var mainidEdit   = mainmodule+"_edit";
    var mainidDestroy = mainmodule+"_destroy";
    var mainidShow   = mainmodule+"_show";

    if(jQuery('#'+mainmodule).is(':checked')) {
        jQuery('#'+mainidCreate).prop('disabled', false);
        jQuery('#'+mainidCreate).prop('checked', true);

        jQuery('#'+mainidEdit).prop('disabled', false);
        jQuery('#'+mainidEdit).prop('checked', true);

        jQuery('#'+mainidDestroy).prop('disabled', false);
        jQuery('#'+mainidDestroy).prop('checked', true);

        jQuery('#'+mainidShow).prop('disabled', false);
        jQuery('#'+mainidShow).prop('checked', true);
      } else {
        jQuery('#'+mainidCreate).prop('disabled', true);
        jQuery('#'+mainidCreate).prop('checked', false);
    
        jQuery('#'+mainidEdit).prop('disabled', true);
        jQuery('#'+mainidEdit).prop('checked', false);
    
        jQuery('#'+mainidDestroy).prop('disabled', true);
        jQuery('#'+mainidDestroy).prop('checked', false);
    
        jQuery('#'+mainidShow).prop('disabled', true);
        jQuery('#'+mainidShow).prop('checked', false);
    }
};
