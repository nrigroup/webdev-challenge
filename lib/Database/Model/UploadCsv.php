<?php
namespace Database\Model;
use ActiveRecord\Model;;

class UploadCsv extends Model {
	//Override default table name
	static public $table_name = 'csv';
}