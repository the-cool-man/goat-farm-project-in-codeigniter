<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}	
	public function index($status ='ALL', $page =1, $personal_where='')
	{
		$ele_array = array();
		$this->common_model->is_delete_fild = '';	
		
		
		$other_config = array('addAllow'=>'no','editAllow'=>'no','deleteAllow'=>'no','display_status'=>'no','statusChangeAllow'=>'no','default_order'=>'DESC','filed_notdisp'=>array('Status'));
		
		if(isset($personal_where['where_per']) && $personal_where['where_per'] !='')
		{
			$other_config['personal_where'] = $personal_where['where_per'];
		}
				
		$this->common_model->common_rander('appointment', $status, $page , 'Appointment System',$ele_array,'ID',1,$other_config);
	}	 
	
		
}
