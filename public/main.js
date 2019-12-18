$(function() {
    //
    // INPUT FILES EVENTS
    // ====================================================================

    // get change event for all input files
    $(document).on('change', ':file', function() {
        // get current input
        var input = $(this);

        // get the selected filename
        var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        // check for csv
        if (label.indexOf(".csv") < 1) {
            // show error
            $(".error").show();

            // clear label
            label = "";

            // clear file
            input.val("");

            // add disabled from button
            $("#submit-button").addClass("disabled");
        }
        else {
            // hide error
            $(".error").hide();

            // remove disabled from button
            $("#submit-button").removeClass("disabled");
        }

        // manually trigger the event
        input.trigger('fileselect', label);
    });

    // document ready constructor
    $(document).ready(function() {
        // get fileselect event for all input files
        $(':file').on('fileselect', function(event, label) {
            // get the input text
            var input = $(this).parents('.input-group').find(':text');

            // check for it's length
            if (input.length) {
                // change the input text
                input.val(label);
            }
        });
    });

    //
    // SUBMIT FILE
    // ====================================================================

    // submit button event
    $("#submit-button").click(function() {
        // get file path
        var file = $(':file').val();

        // check if there is a file
        if (file != "") {
            // hide button label
            $("#button-label").hide();

            // show button spinner
            $("#button-spinner").show();

            // show processing message
            $(".processing").show();

            // process the file
            
        }
    });
});