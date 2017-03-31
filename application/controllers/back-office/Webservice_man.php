<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Webservice_man extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index()
	{
		$this->service_list();
	}
	public function service_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'service_name'=>array('is_required'=>'required'),
			'service_url'=>array('is_required'=>'required'),
			'service_name'=>array('is_required'=>'required'),
			'method'=>array('type'=>'radio','value_arr'=>array('POST'=>'POST','GET'=>'GET'),'value'=>'POST'),
			'description'=>array('type'=>'textarea'),
			'parameter'=>array('type'=>'textarea'),
			'success_response'=>array('type'=>'textarea'),
			'error_response'=>array('type'=>'textarea')
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		
		$this->common_model->js_extra_code = " if($('#description').length > 0) { $('.page_content_edit').removeClass(' col-lg-7 ');
			$('.page_content_edit').addClass(' col-lg-10 ');
				CKEDITOR.replace( 'description' ); 
				CKEDITOR.replace( 'parameter' ); 
				CKEDITOR.replace( 'success_response' );
				CKEDITOR.replace( 'error_response' );
			}";
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('blog_image'));
		$this->common_model->common_rander('web_service', $status, $page , 'Web Service List',$ele_array,'service_name',0,$other_config);
	}
}