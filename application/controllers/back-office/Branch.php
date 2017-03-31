<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Branch extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index($status ='ALL', $page =1)
	{
		$this->branch_list($status, $page);
	}
	public function branch_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'BranchName'=>array('is_required'=>'required'),
			'Country'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown','onchange'=>"dropdownChange('Country','State','state_list')",
			'relation'=>array('rel_table'=>'country_master','key_val'=>'ID','key_disp'=>'CountryName')),	// for relation dropdown
			'State'=>array('is_required'=>'required','class'=>' not_reset ','not_load_add'=>'yes','type'=>'dropdown','onchange'=>"dropdownChange('State','City','city_list')",
			'relation'=>array('rel_table'=>'state_master','key_val'=>'ID','key_disp'=>'StateName','not_load_add'=>'yes','cus_rel_col_name'=>'CountryID','cus_rel_col_val'=>'Country')),
			'City'=>array('is_required'=>'required','class'=>' not_reset ','not_load_add'=>'yes','type'=>'dropdown',
			'relation'=>array('rel_table'=>'city_master','key_val'=>'ID','key_disp'=>'CityName','not_load_add'=>'yes','cus_rel_col_name'=>'StateID','cus_rel_col_val'=>'State')),
			
			'Address'=>array('type'=>'textarea'),
			'Status'=>array('type'=>'radio')
		);
		$join_tab_array = array();
		//$join_tab_array[] = array( 'rel_table'=>'state_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'StateName','rel_filed_org'=>'State');
		$this->common_model->dup_where_con = 'and';
		/*$join_tab_array[] = array( 'rel_table'=>'country_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'CountryName',			'rel_filed_org'=>'Country','join_manual'=>' country_master.ID = state_master.CountryId ');*/
		$join_tab_array[] = array( 'rel_table'=>'country_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'CountryName','rel_filed_org'=>'Country','join_manual'=>' branch.Country = country_master.ID ');
		$join_tab_array[] = array( 'rel_table'=>'state_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'StateName',			'rel_filed_org'=>'State','join_manual'=>' branch.State = state_master.ID ');
		$join_tab_array[] = array( 'rel_table'=>'city_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'CityName',			'rel_filed_org'=>'City','join_manual'=>' branch.City = city_master.ID');
		
		$other_config = array(
			'field_duplicate'=>array('BranchName')
		);
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted');
		$this->common_model->common_rander('branch', $status, $page , 'Branch',$ele_array,'CreatedOn',0,$other_config,$join_tab_array);
	}
	
	public function volunteer($status ='ALL', $page =1)
	{
		$ele_array = array(
			'SelectedBranch'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown',
			'relation'=>array('rel_table'=>'branch','key_val'=>'ID','key_disp'=>'BranchName')),
			'Name'=>array('is_required'=>'required'),
			'Email'=>array('is_required'=>'required','input_type'=>'email'),
			'Contact'=>array('is_required'=>'required'),
			'Gender'=>array('type'=>'radio','value_arr'=>array('Male'=>'Male','Female'=>'Female'),'value'=>'Male'),
			'Address'=>array('type'=>'textarea','is_required'=>'required'),
			'Photo'=>array('type'=>'file','path_value'=>$this->common_model->path_volunteer),
			'CV'=>array('type'=>'file','path_value'=>$this->common_model->path_cv,'extension'=>'txt|pdf|doc|docx|rtf','display_img'=>'no'),
			'Occupation'=>array('is_required'=>'required'),
			'Education'=>array('is_required'=>'required'),
			'AboutMe'=>array('type'=>'textarea'),
			'Message'=>array('type'=>'textarea','placeholder'=>'Message from volunteer, sent to the employer'),
			'FacebookID'=>array('label'=>'Facebook ID'),
			'GooglePlusID'=>array('label'=>'Google Plus ID'),
			'TwitterID'=>array('label'=>'Twitter ID'),
			'SkypeID'=>array('label'=>'Skype ID'),
			'Status'=>array('type'=>'radio')
		);	
		
		$data_table = array(
			'title_disp'=>'Name',
			'post_title_disp'=>'',
			'disp_column_array'=> array('Email','CreatedOn','Contact','Gender','Occupation','Education')
		);
		
		$edit_btn_arr = array('url'=>'branch/volunteer/edit-data/#id#','class'=>'info','label'=>'Edit');
		$view_btn_arr = array('url'=>'branch/view-detail/#id#','class'=>'info','label'=>'View Detail');
		
		
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->button_array[] = $edit_btn_arr;
		$this->common_model->button_array[] = $view_btn_arr;
				
		
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'field_duplicate'=>array('Email'),
			'enctype'=>'enctype="multipart/form-data"','display_image'=>'Photo','Photo'=>$this->common_model->path_volunteer,'default_order'=>'desc');
		$join_tab_array = array();
		$join_tab_array[] = array( 'rel_table'=>'branch', 'rel_filed'=>'ID', 'rel_filed_disp'=>'BranchName','rel_filed_org'=>'SelectedBranch','join_manual'=>' volunteer.SelectedBranch = branch.ID');
		
		$this->common_model->data_tabel_filedIgnore = array('ID','IsDeleted','Address','Occupation','Education','AboutMe','Message');
		$other_config['data_tab_btn'] = $this->common_model->button_array;
		
		$this->common_model->common_rander('volunteer', $status, $page , 'Volunteer',$ele_array,'CreatedOn',0,$other_config,$join_tab_array);
	}
	
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['back_detail_url'] = 'volunteer';
			$data['id'] = $id; // current row id for view detail
			$image_arra = array(
			array(
				'filed_arr' => array('Photo'),
				'path_value'=>$this->common_model->path_volunteer,
				'title'=>'Photo',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'Name',
					'field_array'=>array(
						'Email'=>'',
						'Contact'=>'',
						'Gender'=>'',
						'Address'=>'',
						'Occupation'=>'',
						'Education'=>'',						
						'CreatedOn'=>array('type'=>'date'),
						'SelectedBranch'=>array('type'=>'relation','table_name'=>'branch','prim_id'=>'ID','disp_column_name'=>'BranchName'),														
					),
				),
				
				array(
					'title'=>'Introduction',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'AboutMe'=>'',											
					),
				),
				
				array(
					'title'=>'Message For Employer',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'Message'=>'',											
					),
				),
				
				array(
					'title'=>'Social Address',	
					'class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12 ',
								
					'field_array'=>array(
						'FacebookID'=>array('label'=>'Facebook ID'),
						'GooglePlusID'=>array('label'=>'GooglePlus ID'),
						'TwitterID'=>array('label'=>'Twitter ID'),
						'SkypeID'=>array('label'=>'Skype ID'),
						'CV'=>array('label'=>'Download CV','type'=>'link','path_value'=>$this->common_model->path_cv,'display_img'=>'no'),		
					),
				),
			);
			
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list']   = $field_main_array;			
			$this->common_model->table_name = 'volunteer'; // set table name for get data from wich table 
			$this->common_model->common_view_detail('Volunteer Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'branch/volunteer');
		}
	}
	
}