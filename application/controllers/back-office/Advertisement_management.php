<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Advertisement_management extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->adv_pages($status, $page);
	}
	public function adv_pages($status ='ALL', $page =1)
	{
		$this->common_model->labelArr['AdsImage'] = 'Ad Image';
		$ele_array = array(
			'AdType'=>array('is_required'=>'required','type'=>'radio','value_arr'=>array('Image'=>'Image','Google'=>'Google'),'value'=>'Image','class'=>'adv_type','onclick'=>'chnageadvType()'),
			'AdLink'=>array('is_required'=>'required','input_type'=>'url','form_group_class'=>'image_adv'),
			'AdsImage'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_advertise,'form_group_class'=>'image_adv'),
			'GoogleAdsenseCode'=>array('is_required'=>'required','type'=>'textarea','form_group_class'=>'google_adv'),
			'ImageLevel'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>array('Level 1'=>'Level 1 size 357 x 192 for best result','Level 2'=>'Level 2','Level 3'=>'Level 3')),
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->js_extra_code = " chnageadvType(); ";
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('AdsImage'),'AdsImage'=>$this->common_model->path_advertise);
		$this->common_model->common_rander('advertisement', $status, $page , 'Advertisement List',$ele_array,'CreatedOn',0,$other_config);
	}
}