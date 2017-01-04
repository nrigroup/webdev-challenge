<html>
    <body>
		@if (session()->has('msg'))
			<div style='color: green;'>{{ session('msg') }}</div>
		@endif
		
		@if (session()->has('err'))
			<div style='color: red;'>{{ session('err') }}</div>
		@endif
		<!-- Form to upload files, starts here -->
		<div style='font-weight: bold; margin-top: 20px;'>Upload Csv:</div>
		<form name='uploadCsvFrm' action="{{ URL::to('csv/upload_csv') }}"
			  method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<table width="600">
				<tr>
					<td width="20%">
						Select CSV file:
					</td>
					<td width="80%">
						<input type="file" name="file" id="file" />
					</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
					<td>
						<input type="submit" name="submit" value='Upload'/>
					</td>
				</tr>
			</table>
		</form>
		<!-- Form to upload files, ends here -->
		
		<br/>
		@if (session()->has('msg'))
			<h2 style='color: green;'>{{ $results }}</h2>
		@endif
		
		@foreach($data as $yearMonth => $arrCategoryWiseCost)
			<h2>{{ $yearMonth }}</h2>
			<div>
				@foreach($arrCategoryWiseCost as $category => $cost)
					<div>
						<b>{{ $category }}</b> : {{ $cost }}
					</div>
				@endforeach
			</div>
			<br />
		@endforeach
		{{ session()->forget('msg') }}
		{{ session()->forget('err') }}
    </body>
</html>
