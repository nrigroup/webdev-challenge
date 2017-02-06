@extends('layouts.app')

@section('content')

<h1 class="page-header">Upload - ID: {{ $id }} <small>{{ $timestamp }}</h1>

<h2>Summary</h2>


<div class="row">
<div class="col-lg-6 col-lg-offset-3">

@php

echo "<table class=\"table table-hover\">";

$prevMonth = "";
$monthlyTotal = 0;
foreach($monthly as $key => $month) {

    $yearMonth = $month->yearmonth;

    if(empty($prevMonth) || $yearMonth != $prevMonth) {

        if($key != 0) {
            echo "<tr>
            <td><strong>Monthly Total</strong></td>
            <td align=\"right\"><strong>" . number_format($monthlyTotal, 2) . "</strong></td>";
            echo "</tr>";
        }
        $prevMonth = $yearMonth;
        echo "<tr>
            <td colspan=\"2\">
                <h3>$yearMonth</h3>
            </td>
        </tr>";
        $monthlyTotal = 0;
    }
    $category = $month->category;
    $total = $month->total;
    $monthlyTotal += $total;
    echo "<tr>
        <td>$category</td>
        <td align=\"right\">" . number_format($total, 2) . "</td>
        </tr>";

    if($key == count($monthly)-1) {
             echo "<tr>
            <td><strong>Monthly Total</strong></td>
            <td align=\"right\"><strong>" . number_format($monthlyTotal, 2) . "</strong></td>";
            echo "</tr>";
    }
}
@endphp
</table>
</div>
</div>
<h2>Detailed</h2>
@include('items.display_items', $items)
@endsection