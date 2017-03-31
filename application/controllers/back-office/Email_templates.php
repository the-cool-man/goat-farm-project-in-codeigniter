<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Email_templates extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{		
		$this->email_templates($status, $page);
	}
	public function email_templates($status ='ALL', $page =1)
	{
		$ele_array = array(
			'TemplateName'=>array('is_required'=>'required'),
			'EmailSubject'=>array('is_required'=>'required'),
			'EmailBody'=>array('type'=>'textarea'),
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		
		$btn_arr = array(
			array('url'=>'email-templates/view-detail/#id#','class'=>'info','label'=>'View Detail'),
		);
		$other_con = array('data_tab_btn'=>$btn_arr);
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted','EmailBody');
		$this->common_model->js_extra_code = " if($('#EmailBody').length > 0) {  $('.EmailBody_edit').removeClass(' col-lg-7 ');
			$('.EmailBody_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'EmailBody' ); } ";
		$this->common_model->common_rander('email_template', $status, $page , 'Email Templates',$ele_array,'TemplateName',0,$other_con);
	}
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['id'] = $id; // current row id for view detail
			
			$field_main_array = array(				
				array(
					'title_from_arr'=>'TemplateName',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'EmailBody'=>''
					),
				),
			);
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'email_template'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('Email Templates Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'email-templates/email-templates');
		}
	}
}