<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Content_management extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->cms_pages($status, $page);
	}
	public function cms_pages($status ='ALL', $page =1)
	{
		$ele_array = array(
			'Title'=>array('is_required'=>'required'),
			'Content'=>array('type'=>'textarea'),
			'Alias'=>array('input_type'=>'hidden'),
			'genrate_url'=>array('type'=>'manual','code'=>'<input type="hidden" value="Title-|-Alias" name="genrate_url" />'), // for generate url from page title title 
			'Status'=>array('type'=>'radio')
		);
		$btn_arr = array(
			array('url'=>'content-management/view-detail/#id#','class'=>'info','label'=>'View Detail'),
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
			$this->common_model->js_extra_code = " if($('#Content').length > 0) {  $('.Content_edit').removeClass(' col-lg-7 ');
			$('.Content_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'Content' ); } ";
		$other_con = array('data_tab_btn'=>$btn_arr);
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted','Content');
		$this->common_model->common_rander('cms_page', $status, $page , 'CMS Page',$ele_array,'CreatedOn',0,$other_con);
	}
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['id'] = $id; // current row id for view detail
			
			$field_main_array = array(				
				array(
					'title_from_arr'=>'Title',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'Content'=>''
					),
				),
			);
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'cms_page'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('CMS Page Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'content-management/cms-pages');
		}
	}
}