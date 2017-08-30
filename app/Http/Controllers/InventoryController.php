<?php

namespace App\Http\Controllers;

use App\NRI\CsvParser;
use Illuminate\Support\Facades\Input;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class InventoryController extends Controller
{
	/**
	 * shows the inventory page
	 * @return view the inventory page
	 */
	public function show()
	{
		$csv = new CsvParser($this->getCsv());
		$columns = $csv->getHeaders();
		$csvData = $csv->getBody();

		// save in sessions so we can use the csvData to post and store to DB
		Session::put('csvData', $csvData);

		return view('pages.inventory', ['cols'=>$columns, 'body'=>$csvData]);
	}

	/**
	 * gets the path of the uploaded csv file
	 * @return string the path
	 */
	function getCsv()
	{
		return storage_path('app/public/data.csv');
	}

	/**
	 * stores the csv data in DB using Inventory models
	 * @return view redirects to category report
	 */
	public function store()
	{
		$csvData = Session::get('csvData');
		foreach ($csvData as $inventory) {
			Inventory::create([
				'date' => $inventory['date'],
				'category' => $inventory['category'],
				'lot_title' => $inventory['lot_title'],
				'lot_location' => $inventory['lot_location'],
				'lot_condition' => $inventory['lot_condition'],
				'pre_tax' => $inventory['pre-tax_amount'],
				'tax_name' => $inventory['tax_name'],
				'tax_amount' => $inventory['tax_amount'],
			]);
		}
		return redirect('/category-report');
	}

	/**
	 * shows the category report
	 * @return view the category report
	 */
	function categoryReport()
	{
		$categorized = Inventory::groupByCategory();
		$categories = array_keys($categorized);
		$categoryTotal = $this->getGroupTotal($categorized, $categories);

		return view('pages.report', [
			'categorized' => $categorized,
			'categories' => $categories,
			'groupTotal' => $categoryTotal,
			'title' => 'Category Cost Report'
		]);
	}

	/**
	 * shows the monthly report
	 * @return view the monthly report
	 */
	function monthlyReport()
	{
		$categorized = Inventory::groupByMonth();
		$months = array_keys($categorized);
		$montlyTotal = $this->getGroupTotal($categorized, $months);

		return view('pages.report', [
			'categorized' => $categorized,
			'categories' => $months,
			'groupTotal' => $montlyTotal,
			'title' => 'Monthly Cost Report'
		]);
	}

	/**
	 * totals the cost of groups of Inventory items
	 * @param  array $grouped the grouped Inventory items
	 * @param  array $groups  the array of groups
	 * @return array          array of format [group => [Inventory]]
	 */
	function getGroupTotal($grouped, $groups)
	{
		$groupTotals = [];
		foreach ($groups as $group) {
			$total = 0;
			foreach ($grouped[$group] as $inventory) {
				$total += $inventory->getTotalCost();
			}
			array_push($groupTotals, $total);
		}
		return array_combine($groups, $groupTotals);
	}
}
