<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Inventory controller
 * Handles all the business logic
 */
class Inventory extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->library('nri');
    }
    
    /**
     * index, front page function
     * This function is called when the upload pages is requested for
     */
	public function index(){
        $data = array(
            'expenses_message' => $this->session->flashdata('expenses_message'),
            'expense_per_month_array' => $this->session->flashdata('expense_per_month_array'),
            'expense_per_category_array' => $this->session->flashdata('expense_per_category_array'),
            'message' => $this->session->flashdata('message')
        );
        
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('expenses', $data);
		$this->load->view('footer');
	}
    
    /**
     * expenses, this function is called when the expenses
     * page is requested for
     */
    public function expenses(){
        $data = array(
            'expenses_message' => 'All expenses captured by the system',
            'expense_per_month_array' => $this->db_nri->select_expense_by_month(),
            'expense_per_category_array' => $this->db_nri->select_expense_by_category()
        );
        
		$this->load->view('header');
		$this->load->view('expenses', $data);
		$this->load->view('footer');
	}
    
    /**
     * upload_csv, this function handles the logic for
     * uploading the csv file and inserting the data into the database
     */
    public function upload_csv(){
        $config['upload_path']    = FCPATH.'uploads/';
        $config['allowed_types']  = 'csv';
        $config['file_name'] = strtotime('now').'.'.$config['allowed_types'];
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('csv_file')){
            $csv_array = array_map('str_getcsv', file($config['upload_path'].$config['file_name']));

            // Remove CSV heading row
            $csv_array_first_element = array_shift($csv_array);

            echo $this->upload->display_errors();

            $sanitized_csv_array = $this->nri->sanitize_data($csv_array);

            $csv_file_id = $this->db_nri->insert_csv_data($sanitized_csv_array, $this->upload->data('client_name'), $config['file_name']);
            $message = '<div class="green-text">Successfully added</div>';
            $expenses_message = 'Expenses as captured from the file <strong>'.$this->upload->data('client_name').'</strong> that has been uploaded';
            $per_month = $this->db_nri->select_expense_by_month_i($csv_file_id);
            $per_category = $this->db_nri->select_expense_by_category_i($csv_file_id);
            $this->session->set_flashdata('expenses_message', $expenses_message);
            $this->session->set_flashdata('expense_per_month_array', $per_month);
            $this->session->set_flashdata('expense_per_category_array', $per_category);
        }
        else{
            $message = '<div class="red-text">'.$this->upload->display_errors().'</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url());
    }
}
