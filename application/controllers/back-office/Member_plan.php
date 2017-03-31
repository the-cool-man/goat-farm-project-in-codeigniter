<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Member_plan extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index()
	{
		$this->job_seeker_plan();
	}
		
	public function job_seeker_plan($status ='ALL', $page =1)
	{
		$ele_array = array(
			'plan_name'=>array('is_required'=>'required'),
			'plan_currency'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'currency_master','key_val'=>'currency_code','key_disp'=>'currency_name')),
			'plan_amount'=>array('is_required'=>'required','input_type'=>'number'),
			'plan_duration'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>'Plan Duration In Days'),
			'message'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'contacts'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'highlight_application'=>array('type'=>'radio','is_required'=>'required','value_arr'=>array('Yes'=>'Yes','No'=>'No'),'value'=>'No'),
			'relevant_jobs'=>array('type'=>'radio','is_required'=>'required','value_arr'=>array('Yes'=>'Yes','No'=>'No'),'value'=>'No'),
			'performance_report'=>array('type'=>'radio','is_required'=>'required','value_arr'=>array('Yes'=>'Yes','No'=>'No'),'value'=>'No'),
			'job_post_notification'=>array('type'=>'radio','is_required'=>'required','value_arr'=>array('Yes'=>'Yes','No'=>'No'),'value'=>'No'),
			'plan_offers'=>array('type'=>'textarea'),
			'status'=>array('type'=>'radio'),
		);
		$this->common_model->js_extra_code.= '';
		$btn_arr = array(
			array('url'=>'member_plan/job-seeker-plan/edit-data/#id#','class'=>'info','label'=>'Edit Plan','target'=>'_blank'),
		);
		$data_table = array(
			'title_disp'=>'plan_name',
			'disp_column_array'=> array('plan_currency','plan_duration','plan_amount','message','highlight_application','relevant_jobs','performance_report','contacts','job_post_notification','plan_offers','created_on')
		);
		$other_config = array('hide_display_image'=>'No','load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$btn_arr,'default_order'=>'DESC','filed_notdisp'=>array('plan_type',),'field_duplicate'=>array('plan_name'));
		//$this->common_model->display_selected_field = array('id','profile_pic_approval','profile_pic','fullname','email');
		$this->common_model->common_rander('credit_plan_jobseeker', $status, $page , 'Job Seeker Plan',$ele_array,'created_on',0,$other_config);
	}
	
	public function employer_plan($status ='ALL', $page =1)
	{
		$ele_array = array(
			'plan_name'=>array('is_required'=>'required'),
			'plan_currency'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'currency_master','key_val'=>'currency_code','key_disp'=>'currency_name')),
			'plan_amount'=>array('is_required'=>'required','input_type'=>'number'),
			'plan_duration'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>'Plan Duration In Days'),
			'job_post_limit'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'cv_access_limit'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'message'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'highlight_job_limit'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'contacts'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>''),
			'job_life'=>array('is_required'=>'required','input_type'=>'number','placeholder'=>'Job Life In Days'),
			'plan_offers'=>array('type'=>'textarea'),
			'status'=>array('type'=>'radio'),
		);
		$this->common_model->js_extra_code.= '';
		$data_table = array(
			'title_disp'=>'plan_name',
			'disp_column_array'=> array('plan_currency','plan_duration','plan_amount','message','job_post_limit','cv_access_limit','highlight_job_limit','contacts','job_life','plan_offers','created_on')
		);
		$btn_arr = array(
			array('url'=>'member_plan/employer_plan/edit-data/#id#','class'=>'info','label'=>'Edit Plan','target'=>'_blank'),
		);
		$other_config = array('hide_display_image'=>'No','load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$btn_arr,'default_order'=>'DESC','filed_notdisp'=>array('plan_type',),'field_duplicate'=>array('plan_name'));
		//$this->common_model->display_selected_field = array('id','profile_pic_approval','profile_pic','fullname','email');
		$this->common_model->common_rander('credit_plan_employer', $status, $page , 'Employer Plan',$ele_array,'created_on',0,$other_config);
	}
	
}