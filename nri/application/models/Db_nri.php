<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_nri extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function insert_csv_data($csv_array, $csv_file_orignal_name, $csv_file_new_name){
        $this->db->trans_start();
		
        $csv_file_id = $this->insert_csv_file($csv_file_orignal_name, $csv_file_new_name, count($csv_array));
        
        foreach($csv_array as $item){
            $item_category_id = $this->insert_item_category($item[1]);
            $item_condition_id = $this->insert_item_condition($item[4]);
            $auction_item_id = $this->insert_auction_item($item[0], $item_category_id, $item[2], $item[3], $item_condition_id, $item[5], $item[6], $item[7]);
            $id = $this->insert_csv_file_to_auction_item($csv_file_id, $auction_item_id);
        }
        
		$this->db->trans_complete();
        
        if($this->db->trans_status() === false){
            return 0;
        }
        return $csv_file_id; 
    }
    
    public function select_expense_by_month(){
        $query = "SELECT MONTH(auction_item_date) AS auction_month, SUM(auction_item_pre_tax_amount) AS pre_tax_amount, SUM(auction_item_tax_amount) AS tax_amount 
        FROM auction_items 
        GROUP BY auction_month";
        $results = $this->db->query($query);
        return $results->result_array();
    }
    
    public function select_expense_by_category(){
        $query = "SELECT ic.item_category_name AS category_name, SUM(ai.auction_item_pre_tax_amount) AS pre_tax_amount, SUM(ai.auction_item_tax_amount) AS tax_amount 
        FROM auction_items AS ai
        INNER JOIN items_categories AS ic ON (ic.item_category_id = ai.item_category_id)
        GROUP BY ai.item_category_id
        ORDER BY category_name ASC";
        $results = $this->db->query($query);
        return $results->result_array();
    }
    
    public function select_expense_by_month_i($csv_file_id){
        $csv_file_id = $this->db->escape($csv_file_id);
        $query = "SELECT MONTH(ai.auction_item_date) AS auction_month, SUM(ai.auction_item_pre_tax_amount) AS pre_tax_amount, SUM(ai.auction_item_tax_amount) AS tax_amount 
        FROM auction_items AS ai
        INNER JOIN csv_files_to_auction_items AS tbl ON (ai.auction_item_id = tbl.auction_item_id)
        WHERE tbl.csv_file_id = $csv_file_id
        GROUP BY auction_month";
        $results = $this->db->query($query);
        return $results->result_array();
    }
    
    public function select_expense_by_category_i($csv_file_id){
        $csv_file_id = $this->db->escape($csv_file_id);
        $query = "SELECT ic.item_category_name AS category_name, SUM(ai.auction_item_pre_tax_amount) AS pre_tax_amount, SUM(ai.auction_item_tax_amount) AS tax_amount 
        FROM auction_items AS ai
        INNER JOIN items_categories AS ic ON (ic.item_category_id = ai.item_category_id)
        INNER JOIN csv_files_to_auction_items AS tbl ON (ai.auction_item_id = tbl.auction_item_id)
        WHERE tbl.csv_file_id = $csv_file_id
        GROUP BY ai.item_category_id
        ORDER BY category_name ASC";
        $results = $this->db->query($query);
        return $results->result_array();
    }
    
    private function insert_csv_file($csv_file_orignal_name, $csv_file_new_name, $csv_file_items_count){
        $csv_file_orignal_name = $this->db->escape($csv_file_orignal_name);
        $csv_file_new_name = $this->db->escape($csv_file_new_name);
        $csv_file_items_count = $this->db->escape(intval($csv_file_items_count));
        
        $query = "INSERT INTO csv_files (csv_file_orignal_name, csv_file_new_name, csv_file_items_count) 
		VALUES ($csv_file_orignal_name, $csv_file_new_name, $csv_file_items_count)";
		
		$results = $this->db->query($query);
		return $this->db->insert_id();
    }
    
    private function insert_csv_file_to_auction_item($csv_file_id, $auction_item_id){
        $csv_file_id = $this->db->escape($csv_file_id);
        $auction_item_id = $this->db->escape($auction_item_id);
        
        $query = "INSERT INTO csv_files_to_auction_items (csv_file_id, auction_item_id) 
		VALUES ($csv_file_id, $auction_item_id)";
		
		$results = $this->db->query($query);
		return $this->db->insert_id();
    }
    
    private function insert_item_condition($item_condition_name){
        $item_condition_name = $this->db->escape($item_condition_name);
        
        $query = "INSERT INTO items_conditions (item_condition_name) 
		VALUES ($item_condition_name)
        ON DUPLICATE KEY UPDATE item_condition_count = (item_condition_count + 1)";
		
		$results = $this->db->query($query);
		return $this->db->insert_id();
    }
    
    private function insert_item_category($item_category_name){
        $item_category_name = $this->db->escape($item_category_name);
        
        $query = "INSERT INTO items_categories (item_category_name) 
		VALUES ($item_category_name)
        ON DUPLICATE KEY UPDATE item_category_count = (item_category_count + 1)";
		
		$results = $this->db->query($query);
		return $this->db->insert_id();
    }
    
    private function insert_auction_item($auction_item_date, $item_category_id, $auction_item_lot_title, $auction_item_lot_location, $item_condition_id, $auction_item_pre_tax_amount, $auction_item_tax_name, $auction_item_tax_amount){
        $auction_item_date = $this->db->escape($auction_item_date);
        $item_category_id = $this->db->escape($item_category_id);
        $auction_item_lot_title = $this->db->escape($auction_item_lot_title);
        $auction_item_lot_location = $this->db->escape($auction_item_lot_location);
        $item_condition_id = $this->db->escape($item_condition_id);
        $auction_item_pre_tax_amount = $this->db->escape($auction_item_pre_tax_amount);
        $auction_item_tax_name = $this->db->escape($auction_item_tax_name);
        $auction_item_tax_amount = $this->db->escape($auction_item_tax_amount);
        
        $query = "INSERT INTO auction_items (auction_item_date, item_category_id, auction_item_lot_title, auction_item_lot_location, item_condition_id, auction_item_pre_tax_amount, auction_item_tax_name, auction_item_tax_amount) 
		VALUES ($auction_item_date, $item_category_id, $auction_item_lot_title, $auction_item_lot_location, $item_condition_id, $auction_item_pre_tax_amount, $auction_item_tax_name, $auction_item_tax_amount)";
		
		$results = $this->db->query($query);
		return $this->db->insert_id();
    }
}