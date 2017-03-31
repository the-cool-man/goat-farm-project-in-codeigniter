<?php defined('BASEPATH') OR exit('No direct script access allowed');
class News_management extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->news_list($status, $page);
	}
	public function news_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'NewsTitle'=>array('is_required'=>'required'),
			'NewsDescription'=>array('type'=>'textarea'),
			'Alias'=>array('input_type'=>'hidden'),
			'genrate_url'=>array('type'=>'manual','code'=>'<input type="hidden" value="NewsTitle-|-Alias" name="genrate_url" />'), // for generate url from page title title ,
			'CoverImage'=>array('type'=>'file','path_value'=>$this->common_model->path_news),
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		
		$this->common_model->js_extra_code = " if($('#NewsDescription').length > 0) { $('.page_NewsDescription_edit').removeClass(' col-lg-7 ');
			$('.page_NewsDescription_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'NewsDescription' ); }";
		$btn_arr = array(
			array('url'=>'news-management/view-detail/#id#','class'=>'info','label'=>'View Detail'),
		);
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('CoverImage'),'data_tab_btn'=>$btn_arr);
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted','NewsDescription','Alias');
		$this->common_model->common_rander('news', $status, $page , 'News List',$ele_array,'CreatedOn',0,$other_config);
	}
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['id'] = $id; // current row id for view detail
			$image_arra = array(
			array(
				'filed_arr' => array('CoverImage'),
				'path_value'=>$this->common_model->path_news,
				'title'=>'News Image',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'NewsTitle',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'NewsDescription'=>''
					),
				),
			);
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'news'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('News Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'news-management/news-list');
		}
	}
}