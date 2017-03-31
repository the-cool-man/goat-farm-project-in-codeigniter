<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Breed extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('back_end/Breed_model','breed_model');
		
	}
	public function index($status ='ALL', $page =1)
	{
		$this->breed_list($status, $page);
	}
	
	public function breed_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'Title'=>array('is_required'=>'required'),
			'BodyWeight'=>array('is_required'=>'required',''),			
			'Price'=>array('is_required'=>'required'),
			'DeliveryTime'=>array('is_required'=>'required'),				
			'Image'=>array('type'=>'file','path_value'=>$this->common_model->path_goat_breed),
			'Description'=>array('type'=>'textarea'),
			'Status'=>array('type'=>'radio'), 
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		
		$this->common_model->js_extra_code.= " if($('#Description').length > 0) {  $('.EventDescription_edit').removeClass(' col-lg-7 ');
			$('.EventDescription_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'Description' ); } ";
		
		
		$data_table = array(
			'title_disp'=>'Title',
			'post_title_disp'=>'',
			'disp_column_array'=> array('Price','BodyWeight','DeliveryTime','CreatedOn')
		);
		
		$edit_btn_arr = array('url'=>'breed/breed-list/edit-data/#id#','class'=>'info','label'=>'Edit');
		$view_btn_arr = array('url'=>'breed/view-detail/#id#','class'=>'info','label'=>'View Detail');
		
		
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->button_array[] = $edit_btn_arr;
		$this->common_model->button_array[] = $view_btn_arr;
		
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'enctype'=>'enctype="multipart/form-data"','display_image'=>'Image','Image'=>$this->common_model->path_goat_breed,'default_order'=>'desc');
		
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted');
		$other_config['data_tab_btn'] = $this->common_model->button_array;
		
		$this->common_model->label_col = 2;
		$this->common_model->form_control_col =7;
		
		$this->common_model->common_rander('goat_breed', $status, $page , 'Manage Goat Breed',$ele_array,'CreatedOn',0,$other_config);
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
				'path_value'=>$this->common_model->path_goat_breed,
				'title'=>'Image',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'Title',
					'class_width'=>' col-lg-6 col-md-6 col-sm-6  col-xs-12 ',
					'field_array'=>array(
						'BodyWeight'=>'',
						'Price'=>'',
						'DeliveryTime'=>'',						
						'CreatedOn'=>array('type'=>'date'),											
					),
				),
				array(
					'title'=>'Description',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'Description'=>''
					),
				),
			);
			
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'goat_breed'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('Breed Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'event/event-list');
		}
	}
	
	public function upload_gallary($id='')
	{
		$this->common_model->extra_js[] = 'vendor/dropzone_shop/dropzone.js';
		$this->common_model->extra_css[] = 'vendor/dropzone_shop/dropzone.css';
		$data = array('back_detail_url'=>'event_list','event_id'=>$id,'tabel_name'=>'event_gallery','coulmn_main_name'=>'EventID','main_id'=>$id,'upload_path_file'=>'event/upload_photo','delet_path'=>'event/delete_photo');
		$this->common_model->__load_header('Upload Gallry');
		$this->load->view('back_end/upload_file',$data);
		$this->common_model->__load_footer();
	}
	public function upload_photo()
	{
		$event_id = '';
		if(isset($_REQUEST['EventID']) && $_REQUEST['EventID'] !='')
		{
			$upload_data = array('upload_path'=>$this->common_model->path_event_gallery,'file_name'=>'file','allowed_types'=>'gif|jpg|png|jpeg|bmp');
			$upload_data = $this->common_model->upload_file($upload_data);
			if(isset($upload_data) && $upload_data !='' && count($upload_data) > 0 && isset($upload_data['status']) && $upload_data['status'] =='success')
			{
				$event_id = $_REQUEST['EventID'];
				$file_data = $upload_data['file_data'];
				$file_name = $file_data['file_name'];
				$data_arr = array(
					'EventID'=>$event_id,
					'Image'=>$file_name,
					'CreatedOn'=>$this->common_model->getCurrentDate(),
					'Status'=>'A'
				);
				$this->common_model->update_insert_data_common('event_gallery',$data_arr,'',0);
			}
		}
	}
	public function get_list($event_id='')
	{
		$result  = array();
		$where_arra = array('EventID'=>$event_id);
		$photo_arr = $this->common_model->get_count_data_manual('event_gallery',$where_arra,2);
		if(isset($photo_arr) && $photo_arr && count($photo_arr) > 0)
		{
			foreach($photo_arr as $photo_arr_val)
			{
				$obj['name'] = $photo_arr_val['Image'];
                $obj['size'] = filesize($this->common_model->path_event_gallery.$photo_arr_val['Image']);
				$obj['full_path'] = base_url().$this->common_model->path_event_gallery.$photo_arr_val['Image'];
				$obj['id']= $photo_arr_val['ID'];
				$result[] = $obj;
			}
		}
		header('Content-type: text/json');
		header('Content-type: application/json');
		echo json_encode($result);
	}
	public function delete_photo($photo_id,$event_id,$photo_name)
	{
		if($photo_name !='' && file_exists($this->common_model->path_event_gallery.$photo_name))
		{
			unlink($this->common_model->path_event_gallery.$photo_name);
		}
		$where_arra = array('ID'=>$photo_id);
		$this->common_model->data_delete_common('event_gallery',$where_arra,1,'yes');
	}
	
	
	
	
	public function search_model()
	{
		$this->event_model->save_session_search();
	}
	public function clear_filter($return='yes')
	{
		if($this->event_model->session_search_name !='')
		{
			$session_search_name = $this->event_model->session_search_name;
			$this->common_model->return_tocken_clear($session_search_name,$return);
		}
	}	
}
