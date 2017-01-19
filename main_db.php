<?php
class Main_db extends CI_Model {

	public $db_conn = FALSE;
	
	public $table_name='inventory';
	public $error_log;
	

	public function __construct() {

		parent::__construct();

		//Initialize the database connection
		$this->$db_conn = $this->load_db(); 
		
	}
	
	private function load_db(){
		
		$params['hostname']='hostname';
		$params['database']='dbname';
		$params['username']='username';
		$params['password']='password';
		
		try {
				$DB = new PDO($params['dbdriver'].':host='.$params['hostname'].';dbname='.$params['database'], $params['username'], $params['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			}
			catch (PDOException $e) {
				show_error('Unable to connect to database. Error: 546A '.$params['database']);
				return FALSE;
			}

			return $DB;
		
	}

	//Check Database connections.
	private function check_connection() {

		if($this->$db_conn === FALSE) {
			
			$this->error_log[] = "Database connection failed."; 
			return FALSE;
			
		}else	
			return TRUE;
		
	}

	//Function to execute queries
	
	private function execute_query($query, $params=FALSE) {
		
		if(!$this->check_connection()) return FALSE;
		
		if($params !== FALSE && is_array($params)) {
			
			$stmt = $this->db_conn->prepare($query);
			
			foreach($params as $key => $value) {
				$stmt->bindValue("$key", $value);
			}

			$stmt->execute(); 

		}
		else $stmt = $this->db_conn->query($query);

		if($stmt === FALSE) return FALSE; 

		if($stmt->errorCode() == "0")	{
			
			$result_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result_array;
		}
		else {

			$this->error_log[] = $stmt->errorInfo();
			return FALSE;
		}
	}
	
	public function import_inventry_file($filename)
	{
				
		if(($handle = fopen($filename,"r"))!==FALSE)
		{
			$count = 0;
			
			while(($line = fgetcsv($handle,0)) !== FALSE)
			{
								
				foreach($line as $key => $value)
				{
					$line[$key] = trim(strip_tags($line[$key]));
				}
				
				//using auction_date instead of date because date is a keyword in mYSQL
				$query = "INSERT INTO $this->table_name(auction_date,category,lot_title,lot_location,lot_condition,pre_tax_amount, tax_name, tax_amount)
				VALUES('{$line[0]}','{$line[1]}','{$line[2]}','{$line[3]}','{$line[4]}','{$line[5]}','{$line[6]}','{$line[7]}')";
				
				$result = $this->execute_query($query);							
				
				if($result === FALSE ) {
					$this->error_log[] = "Error or empty result while calling ".__FUNCTION__; break; 
				
				}else				
					$count++;
			
			}
			
			fclose($handle);
			return $count;
		}
		else
			return FALSE;
		
	}
	
	public function get_month_year()
	{		
		
		$query= "SELECT distinct MONTH(auction_date) as month, YEAR(auction_date) as year FROM $table_name
			 ORDER BY year,month DESC";
			 
		$result = $this->execute_query($query);	
		
		if($result === FALSE || sizeof($result) == 0) { $this->error_log[] = "Error or empty result while calling ".__FUNCTION__; return FALSE; }
		else
		{
			return $result;	
		}
	}

	//function return rows by category in given month and years
	function get_inventory_data($month,$year) {
		
		$query = "SELECT category,  MONTH(auction_date) AS month, YEAR(auction_date) as year,
		SUM(pre_tax_amount) as pre_tax_amount, SUM(tax_amount) AS tax_amount FROM $table_name
		WHERE MONTH(auction_date)=:month AND YEAR(auction_date)=:year
		GROUP BY category ORDER BY category ASC";
		
		$result = $this->execute_query($query,array(":year"=>$year,":month"=>$month));	
		
		if($result === FALSE ) { $this->error_log[] = "Error or empty result while calling ".__FUNCTION__; return FALSE; }
		else
		{
			return $result;	
		}
	}
}
		

	
