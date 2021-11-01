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

    public function fetch_data()
    {
        $rows = DB::table("items")->orderBy("date", "desc")->get()->toArray();

        $rpt_total_amt_by_date = $this->generate_report($rows, "date", "pre-tax amount", true);
        Log::info($rpt_total_amt_by_date);
        $rpt_total_amt_by_category = $this->generate_report($rows, "category", "pre-tax amount");
        $rpt_total_amt_by_condition = $this->generate_report($rows, "lot condition", "pre-tax amount");

        $response = new \stdClass();
        $response->status = "ok";
        $response->result = array(
            "amt_date" => empty($rpt_total_amt_by_date) ? null : $rpt_total_amt_by_date,
            "amt_category" => empty($rpt_total_amt_by_category) ? null : $rpt_total_amt_by_category,
            "amt_condition" => empty($rpt_total_amt_by_condition) ? null : $rpt_total_amt_by_condition
        );
        return json_encode($response);
    }
}
