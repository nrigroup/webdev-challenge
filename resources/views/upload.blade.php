<form action="/result" method="POST" enctype="multipart/form-data">
 	{{ csrf_field() }}

 	<label class="btn btn-primary" for="my-file-selector">

 		<!-- Form will be submitted as soon as the file is uploaded -->
 		<input id="my-file-selector" type="file" accept=".csv,text/csv" style="display:none;" name="csvfile" required onchange="this.form.submit()"/>

 		Click here to upload your CSV file ...

 	</label>

</form>