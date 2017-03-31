<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_option extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not		
	}
	public function index($status ='ALL', $page =1)
	{
		$this->payment_list($status, $page);
	}
/*	public function payment_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'name'=>array('is_required'=>'required'),
			'logo'=>array('type'=>'file','path_value'=>$this->common_model->path_payment_logo),
			'email_merchant_id'=>array('label'=>'Email or Merchant Id'),
			'key'=>array('label'=>''),
			'salt_access_code'=>array('label'=>'Salt or Access Code'),
			'description'=>array('type'=>'textarea'),			
			'status'=>array('type'=>'radio')
		);
		$_REQUEST['manage_display']='no';
		$this->common_model->labelArr['salt_access_code'] = 'Salt or Access Code';
		$this->common_model->labelArr['email_merchant_id'] = 'Email or Merchant Id';
		
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('logo'),'addAllow'=>'no','deleteAllow'=>'no','display_notes'=>'<span class="alert alert-info text-bold">Approve Payment option display in front end for Payment Option.</span>');
		$this->common_model->data_tabel_filedIgnore = array('id','is_deleted');
		$this->common_model->common_rander('payment_method', $status, $page , 'Manage Payment Option',$ele_array,'name',0,$other_config);
	}*/
	
	public function payment_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'PayName'=>array('is_required'=>'required'),
			'Logo'=>array('type'=>'file','path_value'=>$this->common_model->path_payment_logo),
			'EmailId'=>array('label'=>'Email or Merchant Id'),
			'MerchantData1'=>array('type'=>'textarea'),
			'MerchantData2'=>array('type'=>'textarea'),
			'MerchantData3'=>array('type'=>'textarea'),
			'Status'=>array('type'=>'radio')
		);
		
		$_REQUEST['manage_display']='no';
		$this->common_model->labelArr['MerchantData1'] = 'Salt or Access Code';
		$this->common_model->labelArr['MerchantData2'] = 'Key';
		
		$data_table = array(
			'title_disp'=>'PayName',
			'post_title_disp'=>'',
			'disp_column_array'=> array('email_merchant_id','key','salt_access_code','description')
		);
		
		$edit_btn_arr = array('url'=>'payment_option/payment_list/edit-data/#id#','class'=>'info','label'=>'Edit');
		$this->common_model->button_array[] = $edit_btn_arr;
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'enctype'=>'enctype="multipart/form-data"','display_image'=>'Logo','Logo'=>$this->common_model->path_payment_logo,'addAllow'=>'no','deleteAllow'=>'no','default_order'=>'desc','display_notes'=>'<span class="alert alert-info text-bold">Approve Payment option display in front end for Payment Option.</span>');
		
		$this->common_model->data_tabel_filedIgnore = array('id','is_deleted');
		$other_config['data_tab_btn'] = $this->common_model->button_array;
		
		$this->common_model->label_col = 2;
		$this->common_model->form_control_col =7;
		
		$this->common_model->common_rander('payment_option', $status, $page , 'Manage Payment Option',$ele_array,'PayName',0,$other_config);
	}
}
