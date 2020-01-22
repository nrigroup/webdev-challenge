$(document).ready(function () {
    $('#deletelot').on('click', function () {
        /*
         if (confirm('Delete this Lot?')) {
             let id = $('#deletelot').attr('data-id');
             window.location.replace("/lots/delete/" + id);
         }
         */
        $.confirm({
            title: 'Delete this Lot?',
            content: 'Are you sure?',
            buttons: {
                confirm: function () {
                    let id = $('#deletelot').attr('data-id');
                    window.location.replace("/lots/delete/" + id);
                    //window.location.replace("/lots/delete/2");
                },
                cancel: function () {
                    //$.alert('Canceled delete!');
                }
            }
        });

    });

});
