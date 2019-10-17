@extends ('layout')
@section ('content')
<div class="container">
    <h1>Report page: </h1>
</div>                

    <div class="text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/upload/">Upload a file</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/categories/">Manage categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/conditions/">Manage conditions</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/lots/">Manage lots</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://github.com/laravel/laravel">GitHub</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>

    <table class="table table-dark">
  	  <tbody>
  	    <tr>
  	      <th scope="row">Number of lots in database: </th>
  	      <td>{{$total_lots}}</td>
  	    </tr>
  	    <tr>
  	      <th scope="row">Number of categories in database: </th>
  	      <td>{{$total_categories}}</td>
  	    </tr>
  	    <tr>
  	      <th scope="row">Number of conditions in database: </th>
  	      <td>{{$total_conditions}}</td>
  	    </tr>
  	    <tr>
  	      <th scope="row">Number of taxe regions in database: </th>
  	      <td>{{$total_taxes}}</td>
  	    </tr>	    
  	  </tbody>
	 </table>
   total spending amount per-category : 
   <table class="table table-dark">
      <tbody>
        @foreach($categories as $categorie)
        <tr>
          <th scope="row">Category name: {{$categorie->name}}</th>
          <td>Total amount: {{$categorie->total_amount}} $</td>
        </tr>
        @endforeach     
      </tbody>
   </table>
</div>
@endsection

