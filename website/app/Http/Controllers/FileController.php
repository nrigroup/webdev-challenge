<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class fileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = \App\File::orderBy('id', 'desc')->with('owner')->paginate();
        return view('admin/file/file_list', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uploadedFile=$request->file("csv");
        if($uploadedFile->isValid()){
            $fileName=Auth::id().'-'.time().'.csv';
            $uploadedFile->storeAs('uploadedFiles',$fileName);
            $file = new \App\File;
            $file->path=storage_path().'/app/uploadedFiles/'.$fileName;
            $file->name=$fileName;
            $file->size=$request->file('csv')->getClientSize();
            $file->owner_id=Auth::id();
            $file->save();
            return redirect('file')->withSuccess('The file has been uploaded');
        }else{
            return redirect()->back()->withDanger('Invalid file!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = \App\File::findOrFail($id);
        Storage::delete($file->path);
        $file->delete();
        return redirect('file')->withSuccess('The file has been deleted');
    }

    /**
     * Import from the file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import($id)
    {
        $fileRecord=\App\File::findOrFail($id);
        //Retrieve all categories and taxes in DB and put the result to two arraies
        $lotCats=\App\LotCategory::get();
        $lotCatsArray=[];
        $taxes=\App\Tax::get();
        $taxesArray=[];
        foreach ($lotCats as $cat) {
            $lotCatsArray[$cat->name]=$cat->id;
        }
        foreach ($taxes as $tax) {
            $lotCatsArray[$tax->name]=$tax->id;
        }
        $catsFromFile=[];
        $taxesFromFile=[];
        $lots=[];
        //Read data from the csv file
        $rows=Excel::load($fileRecord->path)->get();
        foreach ($rows as $row) {
            $date=explode('/', $row->date);
            if($date[0]<10){
                $date[0]='0'.$date[0];
            }
            if($date[1]<10){
                $date[1]='0'.$date[1];
            }
            $lots[]=['title'=>$row->lot_title,'location'=>$row->lot_location,
                    'condition'=>$row->lot_condition,'date'=>$date[2].'-'.$date[0].'-'.$date[1],
                    'category_id'=>$row->category,'pre_tax'=>$row->pre_tax_amount,
                    'tax_amount'=>$row->tax_amount,'tax_id'=>$row->tax_name,
                    'uploader_id'=>Auth::id(),'file_id'=>$fileRecord->id,
                    'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
            if(!array_key_exists($row->category,$lotCatsArray)){
                $catsFromFile[]=['name'=>$row->category,'parent_id'=>'0','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
            }
            if(!array_key_exists($row->tax_name,$taxesArray)){
                $taxesFromFile[]=['name'=>$row->tax_name,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
            }
        }
        //Remove duplicated categories from the file
        $catsFromFile=array_unique($catsFromFile,SORT_REGULAR);
        //Insert new categories to the DB
        DB::table('lot_category')->insert($catsFromFile);
        //Remove duplicated taxes from the file
        $taxesFromFile=array_unique($taxesFromFile,SORT_REGULAR);
        //Insert new taxes to the DB
        DB::table('tax')->insert($taxesFromFile);
        //Retrieve all taxes and put the result to an array
        $taxes=\App\Tax::get();
        $taxesArray=[];
        foreach ($taxes as $tax) {
            $taxesArray[$tax->name]=$tax->id;
        }
        //Retrieve all categories and put the result to an array
        $lotCats=\App\LotCategory::get();
        $lotCatsArray=[];
        foreach ($lotCats as $cat) {
            $lotCatsArray[$cat->name]=$cat->id;
        }
        //Update categories and taxes name for lots
        foreach ($lots as $index=>$lot) {
            $lot['category_id']=$lotCatsArray[$lot['category_id']];
            $lot['tax_id']=$taxesArray[$lot['tax_id']];
            $lots[$index]=$lot;
        }
        //Insert all lots
        DB::table('lot')->insert($lots);
        //Update the status of the file
        $fileRecord->status="1";
        $fileRecord->save();
        return redirect('lot')->withSuccess('The file has been uploaded');
    }

    /**
     * Import from the file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id){
        $fileRecord=\App\File::findOrFail($id);
        $lots = $fileRecord->lots()->get();
        foreach ($lots as $lot) {
            $lot->delete();
        }
        return response()->download($fileRecord->path,'yourFile.csv', ['content-type' => 'text/cvs']);
    }
}
