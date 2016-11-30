<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Item;

class AdminController extends Controller {

    private $flylocal;

    public function getIndex(){
        return view( 'admin.home' );
    }

    public function getUpload(){
        return view( 'admin.uploadform' );
    }

    public function postUpload(){
        $files = $this->flyLocal()->listContents();

        foreach( $files as $file ){
            if( preg_match( '/.csv$/', $file['basename'] ) ){
                $contents = $this->flyLocal()->readAndDelete( $file['basename'] );
                $csv = Reader::createFromString( $contents );
                $rows = $csv->setOffset(1)->fetchAll();
                foreach( $rows as $row ){
                    $item = new Item;
                    $item->date       = strtotime( $row[0] );
                    $item->category   = $row[1];
                    $item->title      = $row[2];
                    $item->location   = $row[3];
                    $item->condition  = $row[4];
                    $item->amount     = $row[5];
                    $item->tax_name   = $row[6];
                    $item->tax_amount = $row[7];

                    $item->save();
                }                
            }
        }
        
        return redirect( 'admin' );
    }

    public function postUploadRemoveCsv( Request $request ){
        $name = $request->has('name') ? $request->input('name') : ''; 
        if( !$name ) return;
        
        if( $this->flyLocal()->has($name) ){
            $this->flyLocal()->delete($name);
        }
    }   

    public function postUploadCsv(){
        $this->uploadCsv();
    }   

    private function uploadCsv(){
        if (!empty($_FILES)) {
            if( !isset( $_FILES['file']['tmp_name'] ) ){
                foreach( $_FILES['file'] as $file ){
                    $this->uploadImage( $file );
                }
            }else{
                $this->uploadImage( $_FILES['file'] );
            }
        }
    }   

    private function uploadImage( $file ){
        $stream = fopen($file['tmp_name'], 'r+');
        $this->flyLocal()->writeStream($file['name'], $stream);
    }

    public function flyLocal(){
        if( !$this->flylocal ){
            $adapter = new \League\Flysystem\Adapter\Local(__DIR__.'/../../../storage/uploads');
            $this->flylocal = new \League\Flysystem\Filesystem($adapter);
        }

        return $this->flylocal;
    }

    public function getReport(){
        $months = \DB::select( \DB::raw("SELECT MONTHNAME(FROM_UNIXTIME(date)) as month, YEAR(FROM_UNIXTIME(date)) as year, SUM( amount + tax_amount ) as spending 
            FROM items GROUP BY month, year") );
        $categories = \DB::select( \DB::raw("SELECT category, SUM( amount + tax_amount ) as spending FROM items GROUP BY category") );
        
        return view( 'admin.report', [
            'months'     => $months,
            'categories' => $categories 
        ]);
    }
}
