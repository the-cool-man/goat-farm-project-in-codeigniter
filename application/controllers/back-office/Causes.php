<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Causes extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('back_end/Cause_model','cause_model');
	}
	public function index($status ='ALL', $page =1)
	{
		$this->causes_list($status, $page);
	}
	
	public function causes_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'CauseTitle'=>array('is_required'=>'required'),
			'CoverImage'=>array('type'=>'file','path_value'=>$this->common_model->path_cause),
			'FundTarget'=>array('type_num_alph'=>'num'),
			'CauseDescription'=>array('type'=>'textarea'),
			'Alias'=>array('input_type'=>'hidden'),
			'genrate_url'=>array('type'=>'manual','code'=>'<input type="hidden" value="CauseTitle-|-Alias" name="genrate_url" />'), 
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		
		$this->common_model->js_extra_code.= " if($('#CauseDescription').length > 0) {  $('.CauseDescription_edit').removeClass(' col-lg-7 ');
			$('.CauseDescription_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'CauseDescription' ); } ";
			
		$data_table = array(
			'title_disp'=>'CauseTitle',
			'post_title_disp'=>'',
			'disp_column_array'=> array('FundTarget','CreatedOn')
		);
		
		$edit_btn_arr = array('url'=>'causes/causes-list/edit-data/#id#','class'=>'info','label'=>'Edit');
		$view_btn_arr = array('url'=>'causes/view-detail/#id#','class'=>'info','label'=>'View Detail');
		$upload_btn_arr = array('url'=>'causes/upload-gallary/#id#','class'=>'info','label'=>'Upload Gallary');
		
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->button_array[] = $edit_btn_arr;
		$this->common_model->button_array[] = $view_btn_arr;
		$this->common_model->button_array[] = $upload_btn_arr;
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'enctype'=>'enctype="multipart/form-data"','display_image'=>'CoverImage','CoverImage'=>$this->common_model->path_cause,'default_order'=>'desc');
		
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted');
		$other_config['data_tab_btn'] = $this->common_model->button_array;
		
		$this->common_model->label_col = 2;
		$this->common_model->form_control_col =7;
		
		$this->common_model->common_rander('causes', $status, $page , 'Manage Causes',$ele_array,'CreatedOn',0,$other_config);
	}
	
	public function causes_payment_list($status ='ALL', $page =1, $clear_search='no')
	{
		if($clear_search =='yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$this->common_model->data_tabel_data = '';
		$this->cause_model->list_model($status,$page);
	}
	public function view_invoice($pay_id ='')
	{
		if($pay_id !='')
		{	
			$this->common_model->is_delete_fild = '';	
			$this->db->join('causes','cause_payment.ID = causes.ID','left');
			$payment_data = $this->common_model->get_count_data_manual('cause_payment',array('cause_payment.ID'=>$pay_id),1,'cause_payment.*,causes.CauseTitle');
				
			
			if($payment_data !='' && count($payment_data) > 0)
			{
				$this->data['payment_data'] = $payment_data;
				$this->common_model->__load_header('View Receipt');
				$this->data['data'] = 'test';
				$this->load->view('back_end/member_invoice',$this->data);
				$this->common_model->__load_footer();
			}
			else
			{
				redirect($this->common_model->base_url_admin.'causes/causes-list');
			}
		}
	}
	
	public function search_model()
	{
		$this->cause_model->save_session_search();
	}
	public function clear_filter($return='yes')
	{
		if($this->cause_model->session_search_name !='')
		{
			$session_search_name = $this->cause_model->session_search_name;
			$this->common_model->return_tocken_clear($session_search_name,$return);
		}
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
				'path_value'=>$this->common_model->path_cause,
				'title'=>'Cause Image',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'CauseTitle',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'CauseDescription'=>''
					),
				),
			);
			$data['img_list_tab_arr'] = array(
				'filed_arr' => array(
					'tabel_name'=>'cause_gallery',
					'rel_column'=>'CauseID',
					'rel_column_val'=>$id,
					'img_column_name'=>'Image',
				),
				'path_value'=>$this->common_model->path_cause_gallery,
				'title'=>'Cause Gallery',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>'',
			);
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list'] = $field_main_array;			
			$this->common_model->table_name = 'causes'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('Causes Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'causes/causes_list');
		}
	}
	
	public function upload_gallary($id='')
	{	
		$this->common_model->extra_js[] = 'vendor/dropzone_shop/dropzone.js';
		$this->common_model->extra_css[] = 'vendor/dropzone_shop/dropzone.css';
		$data = array('back_detail_url'=>'causes_list','causes_id'=>$id,'tabel_name'=>'cause_gallery','coulmn_main_name'=>'CauseID','main_id'=>$id,'upload_path_file'=>'causes/upload_photo','delet_path'=>'causes/delete_photo');
		$this->common_model->__load_header('Upload Gallry');
		$this->load->view('back_end/upload_file',$data);
		$this->common_model->__load_footer();
	}
	public function upload_photo()
	{
		$causes_id = '';
		if(isset($_REQUEST['CauseID']) && $_REQUEST['CauseID'] !='')
		{
			$upload_data = array('upload_path'=>$this->common_model->path_cause_gallery,'file_name'=>'file','allowed_types'=>'gif|jpg|png|jpeg|bmp');
			$upload_data = $this->common_model->upload_file($upload_data);
			if(isset($upload_data) && $upload_data !='' && count($upload_data) > 0 && isset($upload_data['status']) && $upload_data['status'] =='success')
			{
				$causes_id = $_REQUEST['CauseID'];
				$file_data = $upload_data['file_data'];
				$file_name = $file_data['file_name'];
				$data_arr = array(
					'CauseID'=>$causes_id,
					'Image'=>$file_name,
					'CreatedOn'=>$this->common_model->getCurrentDate(),
					'Status'=>'A'
				);
				$this->common_model->update_insert_data_common('cause_gallery',$data_arr,'',0);
			}
		}
	}
	public function get_list($cause_id='')
	{
		$result  = array();
		$where_arra = array('CauseID'=>$cause_id);
		$photo_arr = $this->common_model->get_count_data_manual('cause_gallery',$where_arra,2);
		if(isset($photo_arr) && $photo_arr && count($photo_arr) > 0)
		{
			foreach($photo_arr as $photo_arr_val)
			{
				$obj['name'] = $photo_arr_val['Image'];
                $obj['size'] = filesize($this->common_model->path_cause_gallery.$photo_arr_val['Image']);
				$obj['full_path'] = base_url().$this->common_model->path_cause_gallery.$photo_arr_val['Image'];
				$obj['id']= $photo_arr_val['ID'];
				$result[] = $obj;
			}
		}
		header('Content-type: text/json');
		header('Content-type: application/json');
		echo json_encode($result);
	}
	public function delete_photo($photo_id,$cause_id,$photo_name)
	{
		if($photo_name !='' && file_exists($this->common_model->path_cause_gallery.$photo_name))
		{
			unlink($this->common_model->path_cause_gallery.$photo_name);
		}
		$where_arra = array('ID'=>$photo_id);
		$this->common_model->data_delete_common('cause_gallery',$where_arra,1,'yes');
	}
}
