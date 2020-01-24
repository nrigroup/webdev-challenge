@include('partials.header')
  <div class="container text-center mt-5">
    <h3 class="mb-2">Import datasets into central inventory system:</h3>
    <div class="row">
      <div class="col-1 col-lg-3"></div>
      <div class="col-10 col-lg-6 shadow-lg p-3 my-5 bg-white rounded">
        <form action="/handle" method="post" enctype="multipart/form-data" class="pt-3 form-group">
          @csrf
          <label class="mb-3" for="fileToUpload">Select a CSV file to upload:</label>
          <div id="inp">
            <input type="file" name="file" id="fileToUpload" class="mb-3">
          </div>
          <div class="mx-2 mx-md-5 px-md-5 px-2">
            <input class="mr-3 btn btn-primary btn-block" type="submit" value="Upload File" name="submit">
          </div>
        </form>
        <h5 class="mb-3">Check out the current summary in database:</h5>
        <div class="mx-2 mx-md-5 px-md-5 px-2">
          <button class="btn btn-primary btn-block">
            <a href="/total" class="text-white">Check it out</a>
          </button>
        </div>
      </div>
      <div class="col-1 col-lg-3"></div>
    </div>
  </div>
@include('partials.footer')