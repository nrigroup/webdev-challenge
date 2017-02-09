$( document ).ready(function() {
	$('#fileToUpload').change(function() {

		var filename = $('#fileToUpload').val();
		var fileExtension = ['csv'];
		if ($.inArray($('#fileToUpload').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Only csv files are allowed.");
		}else{
			$('#file_name_wrapper').addClass("file_name_wrapper_color");
			$('#file_name_wrapper').html(filename);
		}
	});
	
	 $("#uploadFile").change(function () {
        var fileExtension = ['csv'];
        if ($.inArray($('#fileToUpload').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only csv files are allowed.");
        }
    });
	
	$('#csv_submission_form').submit(function() {
		if ($.trim($("#file_name_wrapper").html()) === "") {
			alert('Pleae select a file prior to upload.');
			return false;
		}
	});
});

