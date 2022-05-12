<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Checking if theres data in the table
        if (Dashboard::exists()) {

            $hasData = true;

            // Year Filter
            $allYears= DB::table('dashboards')
            ->selectRaw('YEAR(STR_TO_DATE(date,"%m/%d/%Y")) as year')
            ->distinct()
            ->get();

            $overviewYear = $allYears[0]->year;

            if($request->get('yearFilter')){
                $overviewYear = $request->get('yearFilter');
            }

            // Total Sales
            $totalSales = DB::table('dashboards')
            ->sum(DB::raw('`pre-tax amount`'));

            // Total Sales
            $totalItems = DB::table('dashboards')
                            ->count();

            // Total Pre-Tax Sales by date
            $overallPreTaxTotalPerDay = json_encode(DB::table('dashboards')
            ->groupBy('niceDate')
            ->selectRaw('STR_TO_DATE(date,"%m/%d/%Y") AS niceDate, sum(`pre-tax amount`) as price')
            ->whereYear(DB::raw('STR_TO_DATE(date,"%m/%d/%Y")'), $overviewYear)
            ->get());

            // Total Locations & Count
            $totalLocations = DB::table('dashboards')
            ->select('lot location')
            ->distinct()
            ->get();
            $totalLocationsCount = count($totalLocations);

            // Total Price per Location
            $totalPricePerLocation =DB::table('dashboards')
            ->groupBy('lot_location')
            ->selectRaw('`lot location` as lot_location, sum(`pre-tax amount`) as price, count(*) as numberOfProducts')
            ->limit(4)
            ->orderByDesc('price')
            ->get();

            // Top Items per Price
            $topItems =DB::table('dashboards')
            ->groupBy('lot_title')
            ->selectRaw('`lot title` as lot_title, sum(`pre-tax amount`) as price, count(*) as numberOfProducts')
            ->limit(4)
            ->orderByDesc('price')
            ->get();


            // Total Pre-Tax per Category
            $overallPreTaxTotalPerCategory = json_encode(DB::table('dashboards')
            ->groupBy('category')
            ->selectRaw('category, sum(`pre-tax amount`) as price')->get());

            // Total Price per Condition
            $overallTotalPerCondition = json_encode(DB::table('dashboards')
            ->groupBy('lot condition')
            ->selectRaw('`lot condition`, sum(`pre-tax amount`) as price')
            ->get());

            // Year Filter Data for graphs
            $yearFilter = json_encode(DB::table('dashboards')
                ->groupBy('months')
                ->select(DB::raw('MONTH(STR_TO_DATE(date,"%m/%d/%Y")) as months'), DB::raw('SUM(`pre-tax amount`) as preTaxAmount'), DB::raw('SUM(`tax amount`) as taxAmount'))
                ->whereYear(DB::raw('STR_TO_DATE(date,"%m/%d/%Y")'),$overviewYear)
                ->orderBy('months')
                ->get());


            return view('welcome', compact('hasData','topItems','overviewYear','allYears','totalLocationsCount','totalLocations','totalItems','totalSales','overallPreTaxTotalPerDay','totalPricePerLocation','overallPreTaxTotalPerCategory','overallTotalPerCondition','yearFilter'));
        } else {
            $hasData = false;
            return view('welcome', compact('hasData'));
        }
    }
}
