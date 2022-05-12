$(document).ready( function () {
    $('.modal_form').hide();

    $('#data').DataTable({
        "order": [[ 0, "desc" ]],
        responsive: true
    });

    $('button.add_data').click(function() {
        $('.modal_form').show();
    })
    $('.close').click(function() {
        $('.modal_form').hide();
    })
    $('input[type=file]').change(function() {
        var f = this.files;
        var el = $(this).parent();
        $('.label_file span').hide();

        el.append(f[0].name + '<br>' +
                '<span class="sml">' +
                'type: ' + f[0].type + ', ' +
                Math.round(f[0].size / 1024) + ' KB</span>');
    });


});


