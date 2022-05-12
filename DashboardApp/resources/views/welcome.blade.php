@extends('layouts.master')
@section('title', 'Home')
@section('content')
@include('modals.addData')

<div class="container">
    @if ($hasData == true)
        <div class="top_bar">
            <div class="top_left">
                <h1 class="head">
                    Sales
                </h1>
                <p class="head_meta">
                    Welcome to your dashboard
                </p>
            </div>

            <div class="top_right">
                <button class="add_data">
                    <span>+</span> Add new item
                </button>
                <form method="POST" action="/">
                    @csrf
                    <select name="yearFilter" id="">
                        @foreach ($allYears as $item)
                            @if ($overviewYear == $item->year)
                                <option value="{{$item->year}}" selected="selected">{{$item->year}}</option>
                            @else
                                <option value="{{$item->year}}">{{$item->year}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="submit" type="submit">Filter</button>
                </form>
            </div>
        </div>

        <div class="reports">
            <div class="main_reports">
                <div class="revenue">
                    <canvas id="revenueChart" aria-label="Sales, Tax and Shipping"></canvas>
                </div>
                <div class="count_cards">
                    <canvas id="amountCategoryChart" aria-label="Sales, Tax and Shipping"></canvas>
                </div>
            </div>
            <div class="secondary_reports">
                <div class="count_cards">
                    <canvas id="totalConditionChart" aria-label="Sales, Tax and Shipping"></canvas>
                </div>
                <div class="revenue">
                    <canvas id="taxChart" aria-label="Sales, Tax and Shipping"></canvas>
                </div>
            </div>

            <div class="mid_cards">
                <div class="total_cards">
                    <h1 class="card_headers">Total Sales</h1>
                    <p class="card_desc">${{number_format($totalSales, 2)}}</p>
                </div>
                <div class="total_cards">
                    <h1 class="card_headers">Total Products</h1>
                    <p class="card_desc">{{$totalItems}} Products</p>

                </div>
                <div class="total_cards">
                    <h1 class="card_headers">Total Lot Locations</h1>
                    <p class="card_desc">{{$totalLocationsCount}} Locations</p>

                </div>
            </div>

            <div class="recents_cards">
                <div class="recent_activity">
                    <h1 class="card_headers">Top 4 Locations</h1>
                    <table>
                        <thead>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Number of products</th>
                        </thead>
                        <tbody>
                            @foreach ($totalPricePerLocation as $item)
                                <tr>
                                    <td>{{$item->lot_location}}</td>
                                    <td>${{number_format($item->price, 2)}}</td>
                                    <td>{{$item->numberOfProducts}}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="recent_activity">
                    <h1 class="card_headers">Top 4 Items</h1>
                    <table>
                        <thead>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Number of products</th>
                        </thead>
                        <tbody>
                            @foreach ($topItems as $item)
                                <tr>
                                    <td>{{$item->lot_title}}</td>
                                    <td>${{number_format($item->price, 2)}}</td>
                                    <td>{{$item->numberOfProducts}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>

            // Function to create random colours for the chart
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);

                return "rgb(" + r + "," + g + "," + b + ",1)";
            };

            // Getting the Year for the filter
            var selectedYear = <?php echo $overviewYear?>

            /*
            * -------------------------------------------------------------------------------
            * Chart for the Sales Per month
            */

            // Month Calculation and initialization
            var month = ["January",
                     "February",
                     "March",
                     "April",
                     "May",
                     "June",
                     "July",
                     "August",
                     "September",
                     "October",
                     "November",
                     "December",
                    ]

            var yearFilter = <?php echo $yearFilter ?>;
            var monthName = [];
            var monthSales = [];
            var monthShipping = [];
            var monthtax = [];
            monthName = month;

            for (let i=0; i < monthName.length; ++i) {
                monthSales[i] = 0.0
                monthtax[i] = 0.0
            }

            for (let i = 0; i < yearFilter.length; i++) {
                index = parseInt(yearFilter[i].months) - 1

                monthSales[index] = parseFloat(yearFilter[i].preTaxAmount).toFixed(2);
                monthtax[index] = parseFloat(yearFilter[i].taxAmount).toFixed(2);
            }

            // Line Chart initialization
            var ctx = document.getElementById('revenueChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthName,
                    datasets: [{
                        label: 'Amount in Sales (CAD $)',
                        data: monthSales,
                        lineTension: 0.6,
                        backgroundColor: [
                            'rgba(255, 123, 225, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 123, 225, 1)'
                        ],
                        borderWidth: 2,
                        fill: 'start'
                    },
                    {
                        label: 'Amount in Tax (CAD $)',
                        data:monthtax,
                        lineTension: 0.6,
                        backgroundColor: [
                            'rgba(111, 135, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(111, 135, 86, 1)'
                        ],
                        borderWidth: 2,
                        fill: 'start'
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: selectedYear + ' Sales per month',
                            padding: {
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                }
            });

            /*
            * -------------------------------------------------------------------------------
            * Chart for the Sales Per Day
            */

            // Calculation and initialization
            var overallPreTaxTotalPerDay = <?php echo $overallPreTaxTotalPerDay ?>;
            var taxDate = [];
            var taxPrice = [];

            for (let i = 0; i < overallPreTaxTotalPerDay.length; i++) {
                taxDate[i] = overallPreTaxTotalPerDay[i].niceDate;
                taxPrice[i] = overallPreTaxTotalPerDay[i].price;

            }

            // Bar Chart initialization
            var ctx = document.getElementById('taxChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: taxDate,
                    datasets: [{
                        label: 'Amount in Sales (CAD $)',
                        data: taxPrice,
                        lineTension: 0.6,
                        backgroundColor: [
                            'rgba(255, 123, 225, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 123, 225, 1)'
                        ],
                        borderWidth: 2,
                        fill: 'start'
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: selectedYear + ' Sales per day',
                            padding: {
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                }
            });

            /*
            * -------------------------------------------------------------------------------
            * Chart for the Sales Per Category
            */

            // Calculation and initialization
            var overallPreTaxTotalPerCategory = <?php echo $overallPreTaxTotalPerCategory ?>;
            var categoryNames = [];
            var totalAmount = [];
            var salesCategoryColour = [];

            for (let i = 0; i < overallPreTaxTotalPerCategory.length; i++) {
                categoryNames[i] = overallPreTaxTotalPerCategory[i].category;
                totalAmount[i] = overallPreTaxTotalPerCategory[i].price;
                salesCategoryColour.push(dynamicColors());
            }

            // Pie Chart initialization
            var ctx = document.getElementById('amountCategoryChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: categoryNames,
                    datasets: [{
                        label: 'Amount in Sales (CAD $)',
                        data: totalAmount,
                        lineTension: 0.6,
                        backgroundColor: salesCategoryColour,
                        borderColor: [
                            'rgba(255, 255, 255, 1)'
                        ],
                        borderWidth: 2,
                        fill: 'start',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Sales per Category',
                            padding: {
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                }
            });

            /*
            * -------------------------------------------------------------------------------
            * Chart for the Sales Per Cndition
            */

            // Calculation and initialization
            var overallTotalPerCondition = <?php echo $overallTotalPerCondition ?>;
            var categoryNames = [];
            var totalAmount = [];
            var salesConditionColour = [];

            for (let i = 0; i < overallTotalPerCondition.length; i++) {
                categoryNames[i] = overallTotalPerCondition[i]['lot condition'];
                totalAmount[i] = overallTotalPerCondition[i]['price'];
                salesConditionColour.push(dynamicColors());
            }

            // Pie Chart initialization
            var ctx = document.getElementById('totalConditionChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: categoryNames,
                    datasets: [{
                        label: 'Amount in Sales (CAD $)',
                        data: totalAmount,
                        lineTension: 0.6,
                        backgroundColor:salesConditionColour,
                        borderColor: [
                            'rgba(255, 255, 255, 1)'
                        ],
                        borderWidth: 2,
                        fill: 'start',
                        hoverOffset: 4
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Sales per Condition',
                            padding: {
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                }
            });

        </script>
    @else
        <p>There's currently no data at the moment. Please <a href="/upload">upload</a> your file to view the reports</p>
    @endif

</div>
@endsection
</html>
