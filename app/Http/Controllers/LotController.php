<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class LotController extends Controller
{
    public function view($id)
    {
        $lot = Lot::with('lotItems')->findOrFail($id);
        $spendingAmountByMonth = $lot->spendingAmount('month');
        $spendingAmountByCategory = $lot->spendingAmount('category');

        //for reconciliation purposes
        $lotPreTaxBalance = $lot->sumTaxBalance('pre_tax_amount');
        $lotTaxBalance = $lot->sumTaxBalance('tax_amount');
        $lotBalance = $lotPreTaxBalance + $lotTaxBalance;
        return view('lots.view')
            ->with('lot', $lot)
            ->with('spendingAmountByMonth', $spendingAmountByMonth)
            ->with('spendingAmountByCategory', $spendingAmountByCategory)
            ->with('lotPreTaxBalance', $lotPreTaxBalance)
            ->with('lotTaxBalance', $lotTaxBalance)
            ->with('lotBalance', $lotBalance);
    }

    public function index()
    {
        $lots = Lot::paginate(5);
        if (Request::ajax()) {
            return Response::json(View::make('lots.list', array('lots' => $lots))->render());
        }

        return view('lots.index')
            ->with('lots', $lots);
    }
}
