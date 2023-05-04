(function($) {
	"use strict";

	jQuery.noConflict();

	jQuery('[data-toggle="tooltip"]').tooltip()

	jQuery(".upload-file-input").on('change', function() {
	    var file = this.files;
	    if (file.length > 0) {
	        var file = file[0];
	        jQuery(this).siblings().eq(0).text(file.name);
	    } else {
	        jQuery(this).siblings().eq(0).text('Choose file');
	    }
	});

    jQuery(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });

    if (jQuery.fn.DataTable) {
    	jQuery('#dataTable').DataTable();
    }

    if (jQuery.fn.datepicker) {
	    jQuery('.datepicker').datepicker({
	    	format: 'dd-mm-yyyy',
	    	autoclose: true
	    });
	}

    if (jQuery.fn.summernote) {
		jQuery('#description').summernote({
	        toolbar: [
	            // [groupName, [list of button]]
	            ['style', ['bold', 'italic', 'underline', 'clear']],
	            ['font', ['strikethrough', 'superscript', 'subscript']],
	            ['fontsize', ['fontsize']],
	            ['color', ['color']],
	            ['para', ['ul', 'ol', 'paragraph']],
	            ['height', ['height']]
	        ],
	        height: 150
	    });
	}

    jQuery('.multiple-file input').on('change',function (e) {
        var files = [];
        for (var i = 0; i < jQuery(this)[0].files.length; i++) {
            files.push(jQuery(this)[0].files[i].name);
        }
        jQuery(this).next('.custom-file-label').html(files.join(', '));
    });

    jQuery('#userrole').on('change',function (e) {
        var userrole = jQuery(this).val();
        window.location.href='/admin/user?role=' + userrole;
    });

    jQuery('#permissionrole').on('change',function (e) {
        var permissionrole = jQuery(this).val();
        window.location.href='/admin/permission/' + permissionrole;
    });

    jQuery('.ChangeStatusButton').on('click', function() {
        var ticketid = jQuery(this).data('ticketid');
        jQuery('#ticketid').val(ticketid);

        var statusid = jQuery(this).data('statusid');
        jQuery('#ticketStatus').val(statusid);
    });

})(jQuery);
