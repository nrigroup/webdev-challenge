@include('partials.header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-0 col-md-1 col-xl-2"></div>
      <div class="col-12 col-md-10 col-xl-8">
        <table class="table table-dark text-center">
          <thead>
            <tr>
              <th scope="col">Time</th>
              <th scope="col">Category</th>
              <th scope="col">Total spending</th>
            </tr>
          </thead>
          <tbody>
            @foreach($summary as $row)
              <tr>
                <th scope="row">{{ $row["month"] }}</th>
                <td scope="col">{{ $row["category"] }}</th>
                <td scope="col">{{ $row["sum"] }}</th>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-0 col-md-1 col-xl-2"></div>
    </div>
    
    <div class="links">
      <a href="/">Go Back</a>
    </div>
  </div>
@include('partials.footer')