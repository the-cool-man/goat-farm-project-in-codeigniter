<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->photo_list($status, $page);
	}
	public function photo_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'Image'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_gallery,'form_group_class'=>'image_adv'),			
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';		
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('Image'));
		$this->common_model->common_rander('gallery_master', $status, $page , 'Photo Gallery List',$ele_array,'CreatedOn',0,$other_config);
	}
	
	public function video_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'Video'=>array('type'=>'textarea','is_required'=>'required','placeholder'=>'Paste iFrame Code'),		
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';		
		$this->common_model->common_rander('video_gallery_master', $status, $page , 'Video Gallery List',$ele_array,'CreatedOn',0);
	}
}