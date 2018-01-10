<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;


class MasterController extends Controller
{
	/**
	* The validation function makes a custom validation rule based on Validator class
	* @var \Illuminate\Validation\Validator
	* @param file $csvfile
	* @return $validator
	*/
	public function validation($csvfile)
	{
		$validator = Validator::make(
			[
				'file'      => $csvfile,
				'extension' => strtolower($csvfile->getClientOriginalExtension()),
			],
			[
				'file'          => 'required',
				'extension'      => 'required|in:csv',
			]
		);
		return $validator;
	}

	/**
	* The readcsv function utilizes fopen, fgetcsv, fclose to initialize a handler and return
	* an array with contents of csv
	* @package fgetcsv
	* @param csv $csvFile
	* @return array $rows
	*/
	public function readcsv($csvFile) : array
	{
		$handler = fopen($csvFile, 'r');
		while (!feof($handler) ) {
			$rows[] = fgetcsv($handler, 1024);
		}
		fclose($handler);
		return $rows;
	}

	/**
	* The maparray function is reponsible to rename the array keys respectively. This 
	* enhances readbility, and makes it easier to debug problems.
	* @param array $csvbody
	* @return array $renamedarray
	*/
	public function maparray($csvbody)
	{
		$renamedarray = array_map(function($body){
    		return array(
    			'date' => $body[0],
    			'category' => $body[1],
    			'lot_title' => $body[2],
    			'lot_location' => $body[3],
    			'lot_condition' => $body[4],
    			'pre_tax_amount' => $body[5],
    			'tax_name' => $body[6],
    			'tax_amount' => $body[7]
    		);
    	}, $csvbody);

    	return $renamedarray;
	}
}
