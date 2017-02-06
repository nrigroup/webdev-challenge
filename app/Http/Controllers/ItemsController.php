<?php

namespace App\Http\Controllers;

use App\Item;
use App\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ItemsController extends Controller
{
    //

	public function view() {
		$items = Item::orderBy('id', 'desc')->paginate(20);
  	 	return view('items.view', 
  	 		['items' => $items]);
	}

	public function summary() {
		$summary = Item::select('category', 
		DB::raw("DATE_FORMAT(date, '%Y-%m') AS yearmonth"), 
		DB::raw('sum(pretax_amount) as total'))
		->groupBy('yearmonth','category')->get();
		return view('items.summary', 
			['summary' => $summary]);
	}

	public function upload() {
		return view('items.upload');
	}


	public function uploads() {
		$uploads = Upload::orderBy('timestamp', 'desc')->paginate(20);
		return view('items.uploads', ['uploads' => $uploads]);
	}

	public function upload_detailed($id) {
		$timestamp = Upload::find($id)->timestamp;
		$items = Item::where('uploadid',$id)->orderBy('date','asc')->get();
		$summary = Item::select('category', 
				DB::raw("DATE_FORMAT(date, '%Y-%m') AS yearmonth"), 
				DB::raw('sum(pretax_amount) as total'))
				->where('uploadid', $id)->groupBy('yearmonth','category')->get();

		return view('items.upload_detailed', 
			['summary' => $summary, 
				'items' => $items, 
				'id' => $id, 
				'timestamp' => $timestamp]);
	}

	/*
	Stores CSV file in database.
	*/
	public function process(Request $request) {

		$this->validate($request, [
			'csv_file' => 'required|mimes:csv,txt'
		]);

		/*
		If file is valid, create entry in Uploads table.
		Uploads table will return an Upload ID.
		This Upload ID is used to identify which items came from which upload.	
		*/
		if($request->file('csv_file')->isValid()) {
			$path = $request->file('csv_file')->store('logs');
			$upload = new Upload;
			$upload->filename = $path;
			$upload->timestamp = date("Y-m-d H:i:s");
			$upload->userID = $request->ip();
			$upload->save();
			$key = $upload->id;

			DB::beginTransaction();

			try {
				$reader = Reader::createFromPath(storage_path() . "/app/" . $path);
				$results = $reader->fetchAssoc(0); // Skip header row
				
				foreach($results as $result) {
					$item = new Item;
					$item->uploadid = $key;

					$date = Carbon::createFromFormat('n/j/Y', $result["date"])->toDateString();
					$item->date = $date;
					$item->category = $result["category"];
					$item->lot_title = $result["lot title"];
					$item->lot_location = $result["lot location"];
					$item->lot_condition = $result["lot condition"];
					$item->pretax_amount = $result["pre-tax amount"];
					$item->tax_name = $result["tax name"];
					$item->tax_amount = $result["tax amount"];
					$item->save();
				}

			} catch(ValidationException $e) {
				DB::rollback();
			}

			DB::commit();
			return redirect()->action(
			    'ItemsController@upload_detailed', ['id' => $key]
			);		

		}
	}
}
