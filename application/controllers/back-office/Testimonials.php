<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonials extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->lists($status, $page);
	}
	public function lists($status ='ALL', $page =1)
	{
		$ele_array = array(			
			'Commenter'=>array('is_required'=>'required'),
			'Comment'=>array('is_required'=>'required','type'=>'textarea'),
			'Designation'=>array('is_required'=>'required'),
			'Image'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_testimonial),
			'Status'=>array('type'=>'radio')
		);
		
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		
		
		$btn_arr = array(
			array('url'=>'testimonials/view-detail/#id#','class'=>'info','label'=>'View Detail'),
		);
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('Image'),'data_tab_btn'=>$btn_arr);
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted','Comment');
		$this->common_model->common_rander('testimonial', $status, $page , 'Testimonial List',$ele_array,'CreatedOn',0,$other_config);
	}
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['id'] = $id; // current row id for view detail
			$image_arra = array(
			array(
				'filed_arr' => array('Image'),
				'path_value'=>$this->common_model->path_testimonial,
				'title'=>'Image',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'Commenter',
					'sub_title_from_arr'=>'Designation',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'Comment'=>''
					),
				),
			);
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'testimonial'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('Testimonial Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'testimonials/lists');
		}
	}
}