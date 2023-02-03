<?php
include "Connection.php";

class AuctionItemDao
{
    private $conn;
    private $tableName = "auctionItem";

    public function __construct() {
        $this->conn = CreateConnection();

        /*
         * Checking if there is a table is already in database
         * if not creating one
         * */
        $sql = "CREATE TABLE IF NOT EXISTS $this->tableName
(
    id             int auto_increment
        primary key,
    date           varchar(50)  not null,
    category       varchar(255) not null,
    lot_title      varchar(255) not null,
    lot_location   varchar(255) not null,
    lot_condition  varchar(255) not null,
    pre_tax_amount double       not null,
    tax_name       varchar(255) null,
    tax_amount     double       null
);";

        if ($this->conn->query($sql)) {
            // created successfully
        } else {
            die("error creating table");
        }
    }

    public function GetItems() {
        // creating sql query and storing in variable
        $sql = "SELECT * FROM $this->tableName";
        // executing mysql query and returning result
        $result = $this->conn->query($sql);

        /* Creating Json object to return */
        $json_object = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Temporary variable to store row data
                $temp = array(
                "id"=> $row["id"],
                "date"=> $row["date"],
                "category"=> $row["category"],
                "lotTitle"=> $row["lot_title"],
                "lotLocation"=> $row["lot_location"],
                "lotCondition"=> $row["lot_condition"],
                "preTaxAmount"=> $row["pre_tax_amount"],
                "taxName"=> $row["tax_name"],
                "taxAmount"=> $row["tax_amount"]
                );

                // pushing data to json_object
                array_push($json_object, $temp);
            }
        }
        // returning json_object
        return json_encode($json_object);
        mysqli_close($this->conn);
    }

    public function AddData($date, $category, $lot_title, $lot_location, $lot_condition, $pre_tax_amount, $tax_name=null, $tax_amount=null) {
        // creating sql query and storing in variable
        $sql = "INSERT INTO $this->tableName (date, category, lot_title, lot_location, lot_condition, pre_tax_amount, tax_name, tax_amount)
            VALUES ('$date', '$category', '$lot_title', '$lot_location', '$lot_condition', $pre_tax_amount, '$tax_name', $tax_amount)";

        $result = mysqli_query($this->conn, $sql);
        $result = $sql;
        return $result;
        mysqli_close($this->conn);
    }
}