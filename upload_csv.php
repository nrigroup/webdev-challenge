<?php
/**
 * PHP script to upload csv files only.
 * Max allowed file size is 2MB
 * Database connection library being used is "PHP activerecord"
 * 
 * @author Vipul Prajapati
 * @since Dec 29, 2016
 * @copyright (c) 2016, NRI Global
 */
//Turn off error reporting on production environment
ini_set('error_reporting', NULL);
ini_set('display_error', 0);

require __DIR__ . '/vendor/autoload.php';

use Database\Model\UploadCsv;

//Establish database connection. (This can go in separate config.php)
$db_host = 'localhost';
$db_user_name = 'root';
$db_pwd = '';
$db_name = 'nri';

$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory(__DIR__ . '/lib/Database/Model');
$cfg->set_connections(
    array(
        'development' => "mysql://" . $db_user_name . ":" . $db_pwd . "@" . $db_host . "/" . $db_name
    )
);

//Initialize variables
$processed_data = array();
$errors = array();

//Process the submitted form
if (isset($_POST["submit"])) {
    if (isset($_FILES["file"])) {
		//Upload the file to below directory
		$upload_dir = 'upload/';
					
        //If there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            $errors[] = 'Return Code: ' . $_FILES["file"]["error"];
        } else {
            //Only csv file is permitted
            $mimes_accepted = array(
                'application/vnd.ms-excel',
                'text/csv',
            );

            //Max allowed file size is 2 MB
            $maxsize = 2097152;

            //Make sure that file being uploaded doesn't exceed max allowed size
            if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                $errors[] = 'File too large. File must be less than 2 MB.';
            }

            //Allow only csv file
            if (!in_array($_FILES['file']['type'], $mimes_accepted)) {
                $errors[] = 'Sorry, invalid file type. Only csv type is accepted.';
            } else {
                $storage_name = $_FILES["file"]["name"];

                //Validate if file already exists
                if (file_exists("upload/" . $storage_name)) {
                    $errors[] = $storage_name . ' already exists.';
                } else {
					//Grant access just in case
					chmod($upload_dir, 0666);

                    //Upload the file now
                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storage_name);

					//Grant access to uploaded file
					chmod($upload_dir . $storage_name, 0666);
					
                    echo "Stored in: " . $upload_dir . $storage_name . "<br />";

                    //Read csv file
                    $fh = fopen($upload_dir . $storage_name, 'r+');
                    $lines = array();
                    $cnt = 0;

					//Read csv files after successfull upload
                    while (($row = fgetcsv($fh, 8192)) !== FALSE) {
                        //Skip the first (header) line
                        if (0 == $cnt) {
							if (
								'date' != trim($row[0])
								|| 'category' != trim($row[1])
								|| 'lot title' != trim($row[2])
								|| 'lot location' != trim($row[3])
								|| 'lot condition' != trim($row[4])
								|| 'pre-tax amount' != trim($row[5])
								|| 'tax name' != trim($row[6])
								|| 'tax amount' != trim($row[7])
							) {
								$errors[] = 'Invalid column names';
							}
							
                            $cnt++;
                            continue;
                        }

                        //Write csv data into database
                        $csv_obj = new UploadCsv();

						//Set object properties
                        $csv_obj->csv_date = date('Y-m-d', strtotime($row[0]));
                        $csv_obj->category = trim($row[1]);
                        $csv_obj->lot_title = trim($row[2]);
                        $csv_obj->lot_location = trim($row[3]);
                        $csv_obj->lot_condition = trim($row[4]);
                        $csv_obj->pre_tax_amount = trim($row[5]);
                        $csv_obj->tax_name = trim($row[6]);
                        $csv_obj->tax_amount = trim($row[7]);

                        $csv_obj->save();

                        //Populate array to display a report
						$arr_year_month_key = date('Y', strtotime($row[0]))
											. '-'
											. date('m', strtotime($row[0]));
						$arr_category_key = trim($row[1]);
						$category_total =  trim($row[5]) + trim($row[7]);
						
                        $processed_data[$arr_year_month_key][$arr_category_key] += $category_total;
                    }
                }
            }
        }
    } else {
        $errors[] = 'No file selected.';
    }

    //Display results if everything went well
    if (!count($errors)) {
        ksort($processed_data);

        #Display results
        if (is_array($processed_data) && count($processed_data)) {
            foreach ($processed_data as $year_month => $arr_cat_total) {
                echo '<br><br><b>' . date('M Y', strtotime($year_month)) . '</b>';
                if (is_array($arr_cat_total) && count($arr_cat_total)) {
                    foreach ($arr_cat_total as $category => $total) {
                        echo '<br><b>' . $category . '</b>:' . $total;
                    }
                }
            }
        }
    } else {
		//Delete the uploaded file in case of error
		unlink($upload_dir . $storage_name);
		
        //Display errors if any
        $err_str = implode('<br>', $errors);
        echo '<br /><b>Errors:</b><br />' . $err_str;
        echo '<br />';
    }
}
?>

<!-- Form to upload files, starts here -->
<div style='font-weight: bold; margin-top: 20px;'>Upload Csv:</div>
<form name='upload_csv_frm' action="<?php echo $_SERVER["PHP_SELF"]; ?>"
      method="post" enctype="multipart/form-data">
    <table width="600">
        <tr>
            <td width="20%">
				Select CSV file
			</td>
            <td width="80%">
                <input type="file" name="file" id="file" />
            </td>
        </tr>

        <tr>
            <td>
				&nbsp;
			</td>
            <td>
				<input type="submit" name="submit" value='Upload'/>
			</td>
        </tr>
    </table>
</form>
<!-- Form to upload files, ends here -->