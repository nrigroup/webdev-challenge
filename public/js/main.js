$(document).ready(function () {

    $('input[type=file]').change(function() {
        $('#btnParseAndSave').removeClass('d-none');
    });
});