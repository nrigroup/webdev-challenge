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

            // hide headers
            $("#months-header").hide();
            $("#categories-header").hide();
            
            // hide content
            $("#data-months").hide();
            $("#data-categories").hide();
            
            // create form data
            var formData = new FormData();
            
            // append file to the form data
            formData.append('file', $('#file')[0].files[0]);

            // submit the file
            $.ajax({
                url: '/api/insertData',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success : function(data) {
                    // check for status
                    if (data.status) {
                        // hide error
                        $(".error").hide();

                        // show headers
                        $("#months-header").show();
                        $("#categories-header").show();

                        // clear previous data
                        $("#data-months-content").html("");
                        $("#data-categories-content").html("");

                        // loop the months
                        for (var i = 0; i < data.total_per_month.length; i ++) {
                            var item = data.total_per_month[i];

                            $("#data-months-content").append(
                                "<tr>" +
                                "    <th>" + item.year + "</th>" +
                                "    <td>" + getMonthName(item.month) + "</td>" +
                                "    <td>$" + Math.round(item.amount).toFixed(2) + "</td>" +
                                "</tr>"
                            );
                        }

                        // loop the categories
                        for (var i = 0; i < data.total_per_category.length; i ++) {
                            var item = data.total_per_category[i];

                            $("#data-categories-content").append(
                                "<tr>" +
                                "    <th>" + item.category + "</th>" +
                                "    <td>$" + Math.round(item.amount).toFixed(2) + "</td>" +
                                "</tr>"
                            );
                        }

                        // show data
                        $("#data-months").show();
                        $("#data-categories").show();

                    }
                    // clear if any error
                    else {
                        // show error
                        $(".error").show();

                        // hide headers
                        $("#months-header").hide();
                        $("#categories-header").hide();
                    }

                    // hide processing message
                    $(".processing").hide();

                    // show button label
                    $("#button-label").show();

                    // hide button spinner
                    $("#button-spinner").hide();
                }
            });
        }
    });
});

// get month name by number
function getMonthName(month) {
    switch(month) {
        case 1: return "January";
        case 2: return "February";
        case 3: return "March";
        case 4: return "April";
        case 5: return "May";
        case 6: return "June";
        case 7: return "July";
        case 8: return "August";
        case 9: return "September";
        case 10: return "October";
        case 11: return "November";
        case 12: return "December";
    }
}