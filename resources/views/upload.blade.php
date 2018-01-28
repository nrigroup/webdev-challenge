@extends('layouts.master')

@section('content')

<div class="container">
<fieldset>
<legend>Upload a Lot CSV</legend>
<form id="CSVForm" method="post"
enctype="multipart/form-data">
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />

<div>
	<div id="filedrag">Drop CSV here or click to upload.</div>	
<div id="backup" style="display:none;">
<label id='fileselectlabel' for='fileselect'>Files to upload:</label>
<input type='file' accept='.csv' id='fileselect' name='fileselect[]' multiple='multiple' />
</div>
</div>
</form>
</fieldset>
</div>
@endsection