<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cause_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->session_search_name = 'cause_payment_filter';
		$this->common_model->session_search_name = $this->session_search_name;
	}
	
	function list_model($status ='ALL', $page =1,$personal_where='')
	{
		$ele_array = array(
			'PaymentStatus'=>array('type'=>'radio')
		);
		$btn_arr = array(
			array('url'=>'causes/view-invoice/#id#','class'=>'info','label'=>'Receipt','target'=>'_blank'),
		);
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'deleteAllow'=>'no',
			'display_status'=>'no',
			'statusChangeAllow'=>'no',
			'default_order'=>'desc',
			'data_tab_btn'=>$btn_arr
		);
		
		$data_table = array(
			'title_disp'=>'DonerName',
			'post_title_disp'=>'',
			'disp_status'=>'no',
			'disp_column_array'=> array('DonationAmount','DonerName','DonerContact','DonerEmail','PaymentStatus','ProcessID','CompletionDate','CauseID')
		);
		if(isset($personal_where['disp_column_array']) && $personal_where['disp_column_array'] !='' && count($personal_where['disp_column_array']) > 0)
		{
			$data_table['disp_column_array'] = $personal_where['disp_column_array'];
		}
		
		
		$table_Name = 'cause_payment';
		$label_disp = 'Cause Payment History Report';
		if(isset($personal_where['table_Name']) && $personal_where['table_Name'] !='')
		{
			$table_Name = $personal_where['table_Name'];
		}
		if(isset($personal_where['label_disp']) && $personal_where['label_disp'] !='')
		{
			$label_disp = $personal_where['label_disp'];
		}
		$other_config = array('hide_display_image'=>'No','load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$btn_arr,'default_order'=>'DESC','addAllow'=>'no', 'editAllow'=>'no','deleteAllow'=>'no', 'display_status'=>'no', 'statusChangeAllow'=>'no','display_filter'=>'Yes');
		if(isset($personal_where['where_per']) && $personal_where['where_per'] !='')
		{
			$other_config['personal_where'] = $personal_where['where_per'];
		}
		$this->display_filter_form($personal_where);
		
		$this->common_model->is_delete_fild = '';
		$this->common_model->label_col = 2;
		$this->common_model->form_control_col =7;
		$this->common_model->addPopup = 0;
		$this->common_model->common_rander($table_Name, $status, $page , $label_disp,$ele_array,'CompletionDate',0,$other_config);
	}
	
	function display_filter_form($personal_where='')
	{	
		$this->common_model->label_col = 3;
		$this->common_model->form_control_col =9;
		$this->common_model->addPopup = 1;
		
		$this->common_model->extra_css[] = 'vendor/chosen_v1.4.0/chosen.min.css';
		$this->common_model->extra_js[] = 'vendor/chosen_v1.4.0/chosen.jquery.min.js';
		$this->common_model->extra_css[] = 'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->extra_js[] = 'vendor/bootstrap-datepicker/js/bootstrap-datepicker.js';
		$this->common_model->js_extra_code.= " var config = {
			'.chosen-select': {},
			'.chosen-select-deselect': { allow_single_deselect: true },
			'.chosen-select-no-single': { disable_search_threshold: 10 },
			'.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
			'.chosen-select-width': { width: '100%' }			
			};
			$('#causeid').chosen({placeholder_text_multiple:'Select Cause(s)'});
		";
					
		$this->common_model->js_extra_code.= " 
			$('#payment_from_date').datepicker({ 
				format: 'yyyy-mm-dd',
				autoclose: true
			});
			$('#to_date').datepicker({ 
				format: 'yyyy-mm-dd',
				autoclose: true
			}); ";	
		
		$ele_array = array(
			'keyword'=>array('placeholder'=>'Search with Donor Name, Email, Contact No.'),			
			'payment_from_date'=>array('input_type'=>'date','class'=>'input-datepicker'),
			'to_date'=>array('input_type'=>'date','class'=>'input-datepicker'),
			'causeid'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'causes','key_val'=>'ID','key_disp'=>'CauseTitle'),'is_multiple'=>'yes','label'=>'Cause Title','display_placeholder'=>'No','class'=>'chosen-select'),
		);
		
				
		
		$other_config = array('mode'=>'add','id'=>'','action'=>'causes/search_model','form_id'=>'form_model_search');
		$this->common_model->set_table_name('cause_payment');
		$data = $this->common_model->generate_form_main($ele_array,$other_config);
		$this->common_model->data['model_title_fil'] = 'Filter Data';
		$this->common_model->data['model_body_fil'] = $data;
	}
	
	function save_session_search()
	{		
		$where_search = array();
		
		if($this->input->post('keyword') && $this->input->post('keyword') !='')
		{
			$keyword = trim($this->input->post('keyword'));
			$where_search[]= " ( DonerName like '%$keyword%' or DonerContact like '%$keyword%' or  DonerEmail like '%$keyword%' or  DonationAmount like '%$keyword%' ) ";
		}
		if($this->input->post('payment_from_date') && $this->input->post('payment_from_date') !='')
		{
			$payment_from_date = $this->input->post('payment_from_date');
			$where_search[]= " ( DATE_FORMAT(CompletionDate, '%Y-%m-%d') >='$payment_from_date') ";
		}
		if($this->input->post('to_date') && $this->input->post('to_date') !='')
		{
			$to_date = $this->input->post('to_date');
			$where_search[]= " ( DATE_FORMAT(CompletionDate, '%Y-%m-%d') <='$to_date') ";
		}
		
		if($this->input->post('causeid') && $this->input->post('causeid') !='')
		{
			$Cause_name = $this->input->post('causeid');
			$Cause_name = $this->common_model->trim_array_remove($Cause_name);
			if(isset($Cause_name) && count($Cause_name) > 0)
			{
				$Cause_name_str = implode("','",$Cause_name);
				$where_search[]= " ( CauseID in ( '$Cause_name_str') ) ";
			}
		}
		
		$where_search_str = '';
		if(isset($where_search) && $where_search !='' && count($where_search) > 0)
		{
			$where_search_str = implode(" and ",$where_search);
		}
		if($this->session_search_name !='')
		{
			$this->session->set_userdata($this->session_search_name,$where_search_str);
		}
		$this->common_model->return_tocken_clear();
	}
}