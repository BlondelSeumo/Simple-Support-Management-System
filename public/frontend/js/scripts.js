(function($) {
    "use strict"; // Start of use strict

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
        $('.navbar-collapse').collapse('hide');
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#description').summernote({
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

    $('#demoadmin').click(function() {
        $('#demoemail').val('admin@example.com');
        $('#demopassword').val('123456');
        $('#demopassword').attr('type','text');
    });

    $('#demosupport').click(function() {
        $('#demoemail').val('supportengineer@example.com');
        $('#demopassword').val('123456');
        $('#demopassword').attr('type','text');
    });

    $('#democlient').click(function() {
        $('#demoemail').val('client@example.com');
        $('#demopassword').val('123456');
        $('#demopassword').attr('type','text');
    });

    $('.multiple-file input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));
    });

})(jQuery); // End of use strict
