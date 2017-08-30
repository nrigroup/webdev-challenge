<?php

namespace App\NRI;

/**
* Parses a CSV File
*/
class CsvParser
{
	protected $file;
	protected $name;
	protected $size;
	
	protected $header;
	protected $body;
	/**
	 * accepts a csv file location
	 * @param file $file the csv file by location to be parsed
	 */
	function __construct($file)
	{
		$this->file = realpath($file);
	}

	/**
	 * gets the headers aka columns of the csv file
	 * @return array the headers
	 */
	function getHeaders()
	{
		if (!$this->header) {
			$this->readHeader();
		}
		return $this->header;
	}

	/**
	 * readers the header line of the file and sets it
	 * @return null
	 */
	function readHeader()
	{
		$file = fopen($this->file, 'r');
		$line = trim(fgets($file));
		$line = str_replace(' ', '_', $line);
		$this->header = explode(',', $line);
		fclose($file);
	}

	/**
	 * gets the data of the file
	 * @return array array of objects representing Inventory items
	 */
	function getBody()
	{
		if (!$this->body) {
			$this->readBody();
		}

		return $this->body;
	}

	/**
	 * parses the body of the file and sets it
	 * @return null
	 */
	function readBody()
	{
		$this->body = [];
		$file = file($this->file);
		array_shift($file); // removes the headers
		
		foreach($file as $line) {
			$exploded = [];

			$line = trim($line);
			// need to do this b/c of having commas in adderess
			$line = explode(',"', $line);

			$beforeAddress = $line[0];
			$incAddress = $line[1];

			$incAddressEx = explode('",', $incAddress);
			$address = $incAddressEx[0];
			$afterAddress = $incAddressEx[1];

			$exploded = array_merge($exploded, explode(',', $beforeAddress));
			array_push($exploded, $address);
			$exploded = array_merge($exploded, explode(',', $afterAddress));

			$exploded = array_combine($this->getHeaders(), $exploded);
			array_push($this->body, $exploded);
		}
	}
}