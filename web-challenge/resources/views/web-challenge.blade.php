<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NRI - Web Challenge</title>
	<link rel="stylesheet" href={{ asset("css/style.css") }}>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src={{ asset("/js/main.js") }}></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<!-- Preloader Start -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<!-- Preloader End -->
<div class="frame">
	<div class="center">
        <form id="csvupload">
            <div class="title">
                <h1>Drop file to upload</h1>
            </div>

            <div class="dropzone">
                <img src="data:image/png;base64,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" class="upload-icon" />
                <input type="file" class="upload-input" id="uploadfile" name="uploadfile" />
            </div>

            <button type="submit" class="btn" id="upload-btn">Upload file</button>
        </form>
	</div>
	<div id="upload-message"></div>
</div>
<div class="table">
<button type="button" class="btn" id="return">Back </button>
</div>
</body>
</html>