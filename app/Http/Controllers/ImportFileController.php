<?php

namespace App\Http\Controllers;

use App\Models\CsvData;
use App\Models\Contact;
use App\Models\DataInfo;
use Illuminate\Http\Request;
use App\Imports\DataInfoImport;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;


class ImportFileController extends Controller
{
    public function importFile()
    {
       return view('import');
    }

    public function importParse(CsvImportRequest $request)
    {

        if ($request->has('header')) {
            $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
            $data = Excel::toArray(new DataInfoImport, $request->file('csv_file'))[0];
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 2);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('import_fields', [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file
        ]);
    }
      public function importProcess(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $dataInfos = new DataInfo();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $dataInfos->$field = $row[$request->fields[$field]];
                } else {
                    $dataInfos->$field = $row[$request->fields[$index]];
                }
            }
            $dataInfos->save();
        }
        $dataInfos = DataInfo::paginate();
         return view('import_success', compact('dataInfos'));
    }

    public function successImport(){
        $dataInfos = Contact::paginate();
         return view('import_success', compact('dataInfos'));
    }
}
