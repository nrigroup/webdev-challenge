<?php

namespace App\Http\Controllers;

use App\Utils;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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
            $headline = $rows[0];
            $amt_item = count($headline);

            $dataset = [];

            try {
                foreach (array_slice($rows, 1) as $row) {
                    $data = array();

                    for ($i = 0; $i < $amt_item; $i++) {
                        if (empty($headline[$i])) {
                            throw new \Exception("Headline contain empty name at column $i, index starts from 0.");
                            break 2;
                        }
                        if ($headline[$i] === "tax name" || $headline[$i] === "tax amount") {
                            $data[$headline[$i]] = empty($row[$i]) ? null : $row[$i];
                        } else {
                            if (empty($row[$i])) {
                                throw new \Exception("Empty value for column $headline[$i] which is mandatory.");
                                break 2;
                            } else {
                                $data[$headline[$i]] = $row[$i];
                            }
                        }
                    }

                    $data["user_id"] = auth()->user()->id;
                    $data["created_at"] = $datetime->format("Y-m-d H:i:s");
                    $data["updated_at"] = $datetime->format("Y-m-d H:i:s");

                    $dataset[] = $data;
                }
            } catch (\Exception $e) {
                $this->print_to_log(__FILE__, __FUNCTION__, __LINE__, $e->getMessage());
                $response->status = "error";
                $response->data = $e->getMessage();
                return json_encode($response);
            }
            
            foreach ($dataset as $data) {
                DB::table("items")->insert($data);
                $response->status = "ok";
            }
        } else {
            $this->print_to_error(__FILE__, __FUNCTION__, __LINE__, "file upload fail.");
            $response->status = "error";
            $response->data = "file uploaded failed.";
        }

        return json_encode($response);
    }

    /**
     * Fetch existing data from database
     */
    public function fetch_data()
    {
        $rows = DB::table("items")->where("user_id", auth()->user()->id)->orderBy("date", "desc")->get()->toArray();

        $rpt_total_amt_by_date = $this->generate_report($rows, "date", "pre-tax amount", true);
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
