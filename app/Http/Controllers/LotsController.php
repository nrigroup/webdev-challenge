<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Lot;

class LotsController extends Controller
{
    public function show(Lot $lot)
    {
        return view('Lots.show', ['lot' => $lot]);
    }
    public function upload()
    {
        return view('Lots.upload');
    }

    public function getMonthlyReport($from, $to)
    {
        //$from1  = strtotime('2013-01-01');
        //ddd($from["date_from"]);
        //ddd('getmonthly', $from, $to);

        //$from = strtotime(substr($from["date_from"], 0, 10));


        //$to = strtotime(substr($to["date_to"], 0, 10));
        //ddd($from, $to);
        $monthlySpending = DB::table('lots')
            ->select(DB::raw('SUM(tax_amount + pretax_amount) as total, year(date_won) year, month(date_won) month'))
            ->where('date_won', '>=', Carbon::createFromDate(date("Y", $from), date("m", $from), date("d", $from)))
            ->where('date_won', '<=', Carbon::createFromDate(date("Y", $to), date("m", $to), date("d", $to)))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        //ddd($monthlySpending);

        return $monthlySpending;
    }

    public function getMonthlySpendingPerCategory($from, $to)
    {

        $monthlySpendingPerCategory = DB::table('lots')
            ->select(DB::raw('SUM(tax_amount + pretax_amount) as total, category, month(date_won) month, year(date_won) year'))
            ->where('date_won', '>=', Carbon::createFromDate(date("Y", $from), date("m", $from), date("d", $from)))
            ->where('date_won', '<=', Carbon::createFromDate(date("Y", $to), date("m", $to), date("d", $to)))
            ->groupBy(['category', 'month', 'year'])
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        //ddd('mspc', $monthlySpendingPerCategory);
        return $monthlySpendingPerCategory;
    }


    public function index()
    {
        return view('Lots.index', ['lots' => Lot::latest()->get()]);
    }

    public function create()
    {
        return view('Lots.edit', ['UPDATE_CREATE' => 'create']);
    }

    public function report()
    {

        $from = request(["date_from"]);
        $to = request(["date_to"]);
        $dates = '';

        //ddd('zzz', $from, $to);
        if ((count($from) == 0)  || count($to) == 0) {
            //ddd('not set');
            $date_from = '2012-01-01';
            $from = strtotime($date_from);
            $to = strtotime(date('Y-m-d'));
            $dates = date("F", mktime(0, 0, 0, 1, 10)) . ' 1, 2012';
            $date_to = date('F d, Y');
            //$dates = ' for all Lots';
        } else {
            $dates = ' for ' . substr($from["date_from"], 0, 10) . ' to ' . substr($to["date_to"], 0, 10);
            //ddd('xxx', $from, $to);
            $from = strtotime(substr($from["date_from"], 0, 10));
            $to = strtotime(substr($to["date_to"], 0, 10));
            $date_from = substr(request(["date_from"])["date_from"], 0, 10);

            $date_to = substr(request(["date_to"])["date_to"], 0, 10);           //ddd('zzz', $from, $to);

        }
        //ddd('dates ', $dates);

        $rep =  $this->getMonthlyReport($from, $to);
        $rep = ['title' => 'Monthly Report' . $dates, 'report' => $rep];

        $rep2 =  $this->getMonthlySpendingPerCategory($from, $to);
        $rep2 =  ['title' => 'Category Report' . $dates, 'report' => $rep2];

        //ddd(request(["date_from"])["date_from"],  request(["date_to"])["date_to"]);


        return view('Lots.report', [
            'date_from' => $date_from,
            'date_to' => $date_to,
            'monthly' => $rep,
            'category' => $rep2
        ]);
    }

    public function about()
    {
        return view('Lots.about');
    }

    public function store()
    {
        $this->validateLot();
        $lot = new Lot(request([
            'date_won',
            'category',
            'lot_condition',
            'lot_title',
            'lot_location',
            'pretax_amount',
            'tax_name',
            'tax_amount',
        ]));
        $lot->save();

        return redirect('/lots');
    }

    public function edit(Lot $lot)
    {
        return view('Lots.edit', ['lot' => $lot, 'UPDATE_CREATE' => 'update']);
    }

    public function delete(Lot $lot)
    {
        DB::table('lots')->where('id', '=', $lot->id)->delete();
        return redirect()->action('LotsController@index');
    }

    public function update(Lot $lot)
    {
        $lot->update($this->validateLot());
        return redirect($lot->path());
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = [
            'date_won',
            'category',
            'lot_title',
            'lot_location',
            'lot_condition',
            'pretax_amount',
            'tax_name',
            'tax_amount'
        ];
        $data = array();
        $count = 0;
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if ($count != 0) { //skip header row and there will always be one
                    if (count($header) == count($row)) {
                        $data[] = array_combine($header, $row);
                    }
                }
                $count++;
            }
            fclose($handle);
        }

        return $data;
    }

    public function loadcsv()
    {

        if (request()->hasFile('csvfile')) {
            $file = request()->file('csvfile')->getRealPath();
            $customerArr = $this->csvToArray($file);

            for ($i = 0; $i < count($customerArr); $i++) {
                $date = \DateTime::createFromFormat('m/d/Y', $customerArr[$i]['date_won']);
                $customerArr[$i]['date_won'] = $date->format('Y-m-d');
                Lot::firstOrCreate($customerArr[$i]);
            }
        }

        return redirect('/lots/report');
    }


    protected function  validateLot()
    {
        return request()->validate([
            'date_won' => 'required',
            'category' => 'required',
            'lot_condition' => 'required',
            'lot_title' => 'required',
            'lot_location' => 'required',
            'pretax_amount' => 'required',
            'tax_name' => 'required',
            'tax_amount' => 'required'
        ]);

        /*
        //date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount
            $table->timestamp('date_won');
            $table->string('category');
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->decimal('pretax_amount',9,3);
            $table->string('tax_name');
            $table->decimal('tax_amount',9,3);

        */
    }
}
