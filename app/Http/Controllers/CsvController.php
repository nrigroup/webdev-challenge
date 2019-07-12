<?php

namespace App\Http\Controllers;

use App\Address;
use App\Category;
use App\Condition;
use App\Http\Requests\CsvParse;
use App\Item;
use App\TaxType;
use App\Util\CsvParser;
use Carbon\Carbon;


class CsvController extends Controller
{
    /**
     * Parses Csv file and saves its content to database
     * @param CsvParse $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function parseAndSave(CsvParse $request)
    {
        //Validate .csv ext
        if ($request->file('doc')->getClientOriginalExtension() != 'csv') {
            return redirect()->back()->with('danger', 'file must be .csv extension');
        }

        //array parsed as ["column name": "value"] for each row
        $parsedArray = CsvParser::toArray($request->file('doc'));

        //Headers must include required columns
        if (!CsvParser::hasValidHeaders(array_keys($parsedArray[0]))) {
            return redirect()->back()->with('danger', 'file headers must include these columns: date, category, lot title, lot location, lot condition, pre-tax amount, tax name, tax amount');
        }

        for ($i=1;$i<count($parsedArray);$i++) {
            //Find or create category
            $category = Category::firstOrCreate(['title'=>$parsedArray[$i]['category']]);
            //Find or create condition
            $condition = Condition::firstOrCreate(['title'=>$parsedArray[$i]['lot condition']]);
            //Find or create tax_type
            $tax_type = TaxType::firstOrCreate(['title'=>$parsedArray[$i]['tax name']]);

            //Create item
            Item::create([
                'title' => $parsedArray[$i]['lot title'],
                'purchase_date' => Carbon::parse($parsedArray[$i]['date']),
                'pre_tax_amount' =>  $parsedArray[$i]['pre-tax amount'],
                'address' => $parsedArray[$i]['lot location'],
                'tax_amount' =>  $parsedArray[$i]['tax amount'],
                'category_id' => $category->id,
                'tax_type_id' => $tax_type->id,
                'condition_id' => $condition->id,
            ]);
        }

        //Parse csv file to string for preview purposes
        $parsedString = CsvParser::toString($request->file('doc'));

        return redirect()->back()->with('parsedCsv', $parsedString);

    }
}