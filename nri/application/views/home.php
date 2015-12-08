<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
            <h2>Upload Auction Data</h2>
            <div><?php echo $message; ?></div>
            <p>Choose CSV file with the aution data</p>
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('inventory/upload_csv'); ?>">
                <input type="file" name="csv_file" />
                <input type="submit" value="Upload File" />
            </form>
            <br /><br />