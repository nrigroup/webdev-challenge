<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Inventory controller
 * Handles all the business logic
 */
class Inventory extends CI_Controller {
    
    /**
     * index, front page function
     * This function is called when the upload pages is requested for
     */
	public function index(){
        $data = array(
            'html' => $this->session->flashdata('html'),
            'message' => $this->session->flashdata('message')
        );
        
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}
    
    /**
     * expenses, this function is called when the expenses
     * page is requested for
     */
    public function expenses(){
        $expenses_message = 'All expenses captured by the system';
        $per_month = $this->db_nri->select_expense_by_month();
        $per_category = $this->db_nri->select_expense_by_category();
        $expenses_html = $this->expenses_html($expenses_message, $per_month, $per_category);
        $data = array('html' => $expenses_html);
        
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

            $sanitized_csv_array = $this->sanitize_data($csv_array);

            $csv_file_id = $this->db_nri->insert_csv_data($sanitized_csv_array, $this->upload->data('client_name'), $config['file_name']);
            $message = '<div class="green-text">Successfully added</div>';
            $expenses_message = 'Expenses as captured from the file <strong>'.$this->upload->data('client_name').'</strong> that has been uploaded';
            $per_month = $this->db_nri->select_expense_by_month_i($csv_file_id);
            $per_category = $this->db_nri->select_expense_by_category_i($csv_file_id);
            $expenses_html = $this->expenses_html($expenses_message, $per_month, $per_category);
            $this->session->set_flashdata('html', $expenses_html);
        }
        else{
            $message = '<div class="red-text">'.$this->upload->display_errors().'</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url());
    }
    
    /**
     * prepared_db_date, this function formats the dates 
     * into standard date format that can is valid with mysql
     *
     * @param $date string mm/dd/yyyy
     * @return string yyyy-mm-dd
     */
    private function prepared_db_date($date){
        $date_parts = explode('/', $date);
        $year = $date_parts[2];
        $month = sprintf('%02d', intval($date_parts[0]));
        $day = sprintf('%02d', intval($date_parts[1]));
        $new_date = $year.'-'.$month.'-'.$day;
        return $new_date;
    }
    
    /**
     * sanitize_data, this function sanitizes the data 
     */
    private function sanitize_data($csv_array){
        for($i = 0; $i < count($csv_array); $i++){
            $csv_array[$i][0] = $this->prepared_db_date($csv_array[$i][0]);
            $csv_array[$i][1] = trim($csv_array[$i][1]);
            $csv_array[$i][2] = trim($csv_array[$i][2]);
            $csv_array[$i][3] = trim($csv_array[$i][3]);
            $csv_array[$i][4] = trim($csv_array[$i][4]);
            $csv_array[$i][5] = floatval($csv_array[$i][5]);
            $csv_array[$i][6] = trim($csv_array[$i][6]);
            $csv_array[$i][7] = floatval($csv_array[$i][7]);
        }
        return $csv_array;
    }
    
    /**
     * expenses_html, this function generates the markup
     * for expenses
     */
    private function expenses_html($expenses_message, $expense_per_month_array, $expense_per_category_array){
        $html = '<h2>Expenses</h2>';
        $html .= '<p>'.$expenses_message.'</p>';
        $html .= '<div class="tabs-container">';
        $html .= '<ul class="tabs">';
        $html .= '<li id="per-month" class="tab-trigger active">Per Month</li>';
        $html .= '<li id="per-category" class="tab-trigger">Per Category</li>';
        $html .= '</ul>';
        $html .= '<div class="content">';
        $html .= $this->expense_per_month_table($expense_per_month_array);
        $html .= $this->expense_per_category_table($expense_per_category_array);
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
    
    /**
     * expenses_html, this function generates the markup
     * for expenses per month
     */
    private function expense_per_month_table($array_data){
        $calender_info = cal_info(0);
        $html = '';
        if(count($array_data) > 0){
            $html .= '<div id="per-month-content" class="tab-content db">';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<td class="col-1">Month</td>';
            $html .= '<td class="col-2">Pre-Tax Amount ($)</td>';
            $html .= '<td class="col-3">Tax Amount ($)</td>';
            $html .= '<td class="col-4">Post-Tax Amount ($)</td>';
            $html .= '</tr>';
            $html .= '<tbody>';
            $total_pre_tax_amount = 0;
            $total_tax_amount = 0;
            $total_post_tax_amount = 0;
            foreach($calender_info['months'] as $key => $val){
                $pre_tax_amount = 0;
                $tax_amount = 0;
                $post_tax_amount = 0;
                foreach($array_data as $data){
                    if($data['auction_month'] == $key){
                        $pre_tax_amount = $data['pre_tax_amount'];
                        $tax_amount = $data['tax_amount'];
                        $post_tax_amount = $data['pre_tax_amount'] + $data['tax_amount'];
                        break;
                    }
                }

                $html .= '<tr>';
                $html .= '<td>'.$val.'</td>';
                $html .= '<td class="col-num">'.number_format($pre_tax_amount, 2).'</td>';
                $html .= '<td class="col-num">'.number_format($tax_amount, 2).'</td>';
                $html .= '<td class="col-num">'.number_format($post_tax_amount, 2).'</td>';
                $html .= '</tr>';

                $total_pre_tax_amount += $pre_tax_amount;
                $total_tax_amount += $tax_amount;
                $total_post_tax_amount += $post_tax_amount;
            }

            $html .= '<tfoot>';
            $html .= '<tr>';
            $html .= '<td>Total</td>';
            $html .= '<td class="col-num">'.number_format($total_pre_tax_amount, 2).'</td>';
            $html .= '<td class="col-num">'.number_format($total_tax_amount, 2).'</td>';
            $html .= '<td class="col-num">'.number_format($total_post_tax_amount, 2).'</td>';
            $html .= '</tr>';
            $html .= '</tfoot>';
            $html .= '</table>';
            $html .= '</div>';
        }
        else{
            $html = 'No expense information information in the system yet.';
        }
        
        return $html;
    }
    
    /**
     * expenses_html, this function generates the markup
     * for expenses per category
     */
    private function expense_per_category_table($array_data){
        $html = '';
        if(count($array_data) > 0){
            $html .= '<div id="per-category-content" class="tab-content dn">';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<td class="col-1">Month</td>';
            $html .= '<td class="col-2">Pre-Tax Amount ($)</td>';
            $html .= '<td class="col-3">Tax Amount ($)</td>';
            $html .= '<td class="col-4">Post-Tax Amount ($)</td>';
            $html .= '</tr>';
            $html .= '<tbody>';

            $total_pre_tax_amount = 0;
            $total_tax_amount = 0;
            $total_post_tax_amount = 0;
            foreach($array_data as $data){
                $post_tax_amount = $data['pre_tax_amount'] + $data['tax_amount'];
                $html .= '<tr>';
                $html .= '<td>'.$data['category_name'].'</td>';
                $html .= '<td class="col-num">'.number_format($data['pre_tax_amount'], 2).'</td>';
                $html .= '<td class="col-num">'.number_format($data['tax_amount'], 2).'</td>';
                $html .= '<td class="col-num">'.number_format($post_tax_amount, 2).'</td>';
                $html .= '</tr>';

                $total_pre_tax_amount += $data['pre_tax_amount'];
                $total_tax_amount += $data['tax_amount'];
                $total_post_tax_amount += $post_tax_amount;
            }

            $html .= '<tfoot>';
            $html .= '<tr>';
            $html .= '<td>Total</td>';
            $html .= '<td class="col-num">'.number_format($total_pre_tax_amount, 2).'</td>';
            $html .= '<td class="col-num">'.number_format($total_tax_amount, 2).'</td>';
            $html .= '<td class="col-num">'.number_format($total_post_tax_amount, 2).'</td>';
            $html .= '</tr>';
            $html .= '</tfoot>';
            $html .= '</table>';
            $html .= '</div>';
        }
        else{
            $html = 'No expense information information in the system yet.';
        }
        
        return $html;
    }
}
