<?php

namespace App\Http\Controllers;

use App\Utils;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Utils;

    public function upload_file(Request $request)
    {
        $response = new \stdClass();
        $file = $request->file("file");
        if ($file) {
            $rows = $this->parse_csv($file, ",");
            $datetime = new DateTime();

            foreach ($rows as $row) {
                if ($row && preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $row[0])) {
                    $data = array(
                        "date" => $row[0],
                        "category" => $row[1],
                        "lot title" => $row[2],
                        "lot location" => $row[3],
                        "lot condition" => $row[4],
                        "pre-tax amount" => floatval($row[5]),
                        "tax name" => isset($row[6]) ? $row[6] : null,
                        "tax amount" => isset($row[7]) ? floatval($row[7]) : 0,
                        "created_at" => $datetime->format("Y-m-d H:i:s"),
                        "updated_at" => $datetime->format("Y-m-d H:i:s"),
                    );
                    try {
                        DB::table("items")->insert($data);
                    } catch (\Exception $e) {
                        $this->print_to_error(__FILE__, __FUNCTION__, __LINE__, $e->getMessage());
                    }
                }
            }
        } else {
            $this->print_to_error(__FILE__, __FUNCTION__, __LINE__, "file upload fail.");
        }

        $response->status = "ok";

        return json_encode($response);
    }
    
    public function fetch_data(Request $request) {
        $rows = DB::table("items")->get();       

        $response = new \stdClass();
        $response->status = "ok";
        $response->result = $rows;
        return json_encode($response);
    }
}
