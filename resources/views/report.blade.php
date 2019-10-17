@extends ('layout')
@section ('content')

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

   total spending amount per-month : 
   <table class="table table-dark">
      <tbody>
        @foreach($lots as $lot)
        <tr>
          <th scope="row">Lot date: {{$lot->date_lot}}</th>
          <td>Total amount: {{$lot->total_amount_per_month}} $</td>
        </tr>
        @endforeach     
      </tbody>
   </table>
</div>
@endsection

