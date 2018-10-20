$(document).ready(function() {
    $('form').submit(function(event) {
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    if (json.status == 'OK') {
                        $('.alert-danger').hide();
                        $('.alert-success').text(json.message).show('slow');
                        $('.form-control').val('');
                    } else {
                        $('.alert-success').hide();
                        $('.alert-danger').text(json.message).show('slow');
                    }
                    // $('#'+json.status).text(json.message).show('slow');
                }
            },
        });
    });
});