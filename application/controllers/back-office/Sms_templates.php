<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sms_templates extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->all_list($status, $page);
	}

	public function all_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'TemplateName'=>array('is_required'=>'required'),
			'Content'=>array('type'=>'textarea'),
			'Status'=>array('type'=>'radio')
		);
		$other = array('deleteAllow'=>'no');
		$this->common_model->common_rander('sms_template', $status, $page , 'SMS Templates',$ele_array,'TemplateName',1,$other);
	}
	
	public function sms_configuration($status ='ALL', $page =1)
	{
		$ele_array = array(
			'ApiContent'=>array('type'=>'textarea'),
			'ApiType'=>array('type'=>'radio','value_arr'=>array('Local'=>'Local','International'=>'International')),
			'Status'=>array('type'=>'radio')
		);
		$other = array('deleteAllow'=>'no');
		$this->common_model->common_rander('sms_api_config', $status, $page , 'SMS Configuration',$ele_array,'ID',1,$other);
	}
	public function send_sms($status ='ALL', $page =1)
	{
		$ele_array = array(
			'customer_list'=>array('is_required'=>'required','label'=>'Select Customer','placeholder'=>'Search Customer by user Id, Name, Mobile Number','type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'no'),
			'sms_content'=>array('type'=>'textarea','is_required'=>'required','label'=>'Message','placeholder'=>'Type your message here'),
		);				

		$this->common_model->js_extra_code.= " 
			$(document).ready(function(){ get_suggestion_list('customer_list','Select Customer') });";
		$other_conf = array('action'=>'sms-templates/send_sms_save');
		$this->common_model->common_rander('sms_template', $status, $page , 'Send SMS To Customer',$ele_array,'TemplateName',0,$other_conf);
	}
	public function send_sms_save()
	{
		$_REQUEST['is_ajax'] = 1;
		$this->common_model->set_table_name('sms_history');
		if(isset($_REQUEST['customer_list']) && $_REQUEST['customer_list'] !='')
		{
			$mobile_list = $_REQUEST['customer_list'];
			if(isset($mobile_list) && $mobile_list !='' && count($mobile_list) > 0)
			{
				foreach($mobile_list as $mobile_list_val)
				{
					if($mobile_list_val !='')
					{
						$_REQUEST['mobile'] = $mobile_list_val;
						$data = $this->common_model->save_update_data(0,1);
						$this->common_model->common_sms_send($_REQUEST['mobile'],$_REQUEST['sms_content']);			
					}
				}
				$this->session->set_userdata('success_message','Message Sent Successfully.');
			}
		}
		redirect($this->common_model->base_url_admin.'sms-templates/send_sms/add-data');
	}
}