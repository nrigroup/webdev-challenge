(function() {
$('#filedrag').click(function(){ $('#fileselect').trigger('click'); });
	
	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}
	
	// file selection
	function FileSelectHandler(e) {

		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;
		
		var file_data = files[0];
		var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });
		$.ajax({
            url: "lotset/store", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
				alert("success");
            }
        });
	}
	// initialize
	function init() {

		// file select
		document.getElementById("fileselect").addEventListener("change", FileSelectHandler, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			// file drop
			document.getElementById("filedrag").addEventListener("dragover", FileDragHover, false);
			document.getElementById("filedrag").addEventListener("dragleave", FileDragHover, false);
			document.getElementById("filedrag").addEventListener("drop", FileSelectHandler, false);
			document.getElementById("filedrag").style.display = "block";
		}

	}
	// call init file
	if (window.File && window.FileList && window.FileReader) {
		init();
	}


})();