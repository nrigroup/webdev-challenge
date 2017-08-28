$( document ).ready(function(){

	$("#file_name").val("No file selected");
    
	$("#browse_file").change(function(){
		var filename = $("#browse_file").val();
		$("#file_name").val(filename);

		$("#upload_label").removeAttr("disabled");
		$("#upload_button").removeAttr("disabled");
	});

});

