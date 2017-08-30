<form id="upload" method="POST" action="/upload" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row">
		<div class="col-sm-4 col-md-offset-3">
			<div class="form-group">
				<label for="csvfile" class="label-control">Select CSV file to upload</label>
				<input  type="file" name="csvfile">
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<button class="btn btn-primary">Upload</button>
			</div>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12">
		@include('partials.errors')
	</div>
</div>