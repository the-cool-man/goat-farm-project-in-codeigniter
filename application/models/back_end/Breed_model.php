<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Breed_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->session_search_name = 'event_payment_filter';
		$this->common_model->session_search_name = $this->session_search_name;
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
			$('#eventid').chosen({placeholder_text_multiple:'Select Event(s)'});
		";
					
		$this->common_model->js_extra_code.= " 
			$('#event_from_date').datepicker({ 
				format: 'yyyy-mm-dd',
				autoclose: true
			});
			$('#to_date').datepicker({ 
				format: 'yyyy-mm-dd',
				autoclose: true
			}); ";	
		
		$ele_array = array(
			'keyword'=>array('placeholder'=>'Search with Person Name, Email, Contact No.'),			
			'event_from_date'=>array('input_type'=>'date','class'=>'input-datepicker'),
			'to_date'=>array('input_type'=>'date','class'=>'input-datepicker'),
			'eventid'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'events','key_val'=>'ID','key_disp'=>'EventTitle'),'is_multiple'=>'yes','label'=>'Event Title','display_placeholder'=>'No','class'=>'chosen-select'),
		);
		
				
		
		$other_config = array('mode'=>'add','id'=>'','action'=>'event/search_model','form_id'=>'form_model_search');
		$this->common_model->set_table_name('events_registered_people');
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
			$where_search[]= " ( PersonName like '%$keyword%' or PersonEmail like '%$keyword%' or  PersonAddress like '%$keyword%' or  BookingID like '%$keyword%' or  TransactionID like '%$keyword%' ) ";
		}
		if($this->input->post('event_from_date') && $this->input->post('event_from_date') !='')
		{
			$event_from_date = $this->input->post('event_from_date');
			$where_search[]= " ( DATE_FORMAT(BookingDate, '%Y-%m-%d') >='$event_from_date') ";
		}
		if($this->input->post('to_date') && $this->input->post('to_date') !='')
		{
			$to_date = $this->input->post('to_date');
			$where_search[]= " ( DATE_FORMAT(BookingDate, '%Y-%m-%d') <='$to_date') ";
		}
		
		if($this->input->post('eventid') && $this->input->post('eventid') !='')
		{
			$event_name = $this->input->post('eventid');
			$event_name = $this->common_model->trim_array_remove($event_name);
			if(isset($event_name) && count($event_name) > 0)
			{
				$event_name_str = implode("','",$event_name);
				$where_search[]= " ( EventID in ( '$event_name_str') ) ";
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