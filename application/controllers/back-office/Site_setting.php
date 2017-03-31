<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Site_setting extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
		$this->load->model('back_end/SiteSetting_model','SiteSetting_model');
		$this->table_name = 'site_setting'; 	// *need to set here tabel name //
		$this->common_model->set_table_name($this->table_name);
	}
	public function index()
	{
		$this->city_list();
	}
	public function logo_favicon($status ='')
	{
		$this->label_page = 'Update Logo & Favicon';
		if(isset($status) && $status == 'save-data')
		{
			$this->common_model->save_update_data();
			redirect($this->common_model->data['base_url_admin'].'site-setting/logo-favicon');
		}
		else
		{
			$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
			$ele_array = array(
				'SiteLogo'=>array('type'=>'file','path_value'=>$this->common_model->path_logo),
				'SiteFavicon'=>array('type'=>'file','path_value'=>$this->common_model->path_logo)
			);
			$other_config = array('mode'=>'edit','id'=>'1','enctype'=>'enctype="multipart/form-data"');
			$this->data['data'] = $this->common_model->generate_form_main($ele_array,$other_config);

			$this->common_model->__load_header($this->label_page);
			$this->load->view('common_file_echo',$this->data);
			$this->common_model->__load_footer();
		}
	}
	
	
	
	public function update_email($status ='')
	{
		$this->label_page = 'Update Email';
		if(isset($status) && $status == 'save-data')
		{
			$this->common_model->save_update_data();
		}
		else
		{
			$ele_array = array(
				'FromEmail'=>array('is_required'=>'required','input_type'=>'email'),				
				'ToEmail'=>array('is_required'=>'required','input_type'=>'email','label'=>'To Email')
			);
			$other_config = array('mode'=>'edit','id'=>'1');
			$this->data['data'] = $this->common_model->generate_form_main($ele_array,$other_config);

			$this->common_model->__load_header($this->label_page);
			$this->load->view('common_file_echo',$this->data);
			$this->common_model->__load_footer();
		}
	}
	
	public function change_password($status ='')
	{
		$this->label_page = 'Change Password';
		if(isset($status) && $status == 'save-data')
		{
			$this->common_model->save_update_data();
		}
		else
		{
			$extra_js = $this->common_model->extra_js;
			$extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
			$this->common_model->extra_js = $extra_js;
			$this->common_model->js_validation_extra = " rules: 
			  {
				confirm_password:
				{
					equalTo:'#new_password'
				},
			  },";
			$ele_array = array(
				'password'=>array('is_required'=>'required','other'=>'minlength="3" ','input_type'=>'password'),
				'new_password'=>array('is_required'=>'required','other'=>'minlength="3" ','input_type'=>'password'),
				'confirm_password'=>array('is_required'=>'required','other'=>'minlength="3" ','input_type'=>'password')
			);
			
			$other_config = array('mode'=>'edit','id'=>'1','action'=>'site-setting/save-change-password');
			$this->data['data'] = $this->common_model->generate_form_main($ele_array,$other_config);

			$this->common_model->__load_header($this->label_page);
			$this->load->view('common_file_echo',$this->data);
			$this->common_model->__load_footer();
		}
	}
	
	public function save_change_password()
	{
		$this->SiteSetting_model->save_change_password();		
		redirect($this->common_model->base_url_admin.'site-setting/change-password');
	}
	
	public function basic_setting($status ='')
	{
		$this->label_page = 'Update Basic Site Settings';
		if(isset($status) && $status == 'save-data')
		{
			$this->common_model->save_update_data();
		}
		else
		{
			$ele_array = array(
				'WebUrl'=>array('is_required'=>'required','input_type'=>'url'),
				'FriendlyName'=>array('is_required'=>'required'),				
				'ContactNumber'=>array('is_required'=>'required'),
				'WhatsappNumber'=>array('is_required'=>'required'),
				'FullAdress'=>array('type'=>'textarea','is_required'=>'required'),	
				'BankAccountDetail'=>array('type'=>'textarea','is_required'=>'required'),			
				'SiteTitle'=>array('is_required'=>'required'),
				'SiteDescription'=>array('type'=>'textarea','is_required'=>'required'),
				'SiteKeyword'=>array('type'=>'textarea','is_required'=>'required'),
				'home_page_content_h2'=>array('type'=>'textarea','is_required'=>'required'),
				'home_page_content_h4'=>array('type'=>'textarea','is_required'=>'required'),
				'CopyRightContent'=>array('type'=>'textarea','is_required'=>'required'),
				'about_us_image'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_banner,'form_group_class'=>'image_adv')
				
			);
			$other_config = array('mode'=>'edit','id'=>'1','enctype'=>'enctype="multipart/form-data"');
			$this->data['data'] = $this->common_model->generate_form_main($ele_array,$other_config);

			$this->common_model->__load_header($this->label_page);
			$this->load->view('common_file_echo',$this->data);
			$this->common_model->__load_footer();
		}
	}
	
	public function social_site_setting($status ='ALL', $page =1)
	{
		$this->common_model->extra_js[] = 'js/fontawesome-iconpicker.js';
		$this->common_model->extra_css[] = 'css/fontawesome-iconpicker.min.css';
		
		$this->common_model->js_extra_code.= "$('.icp-auto').iconpicker()";
		
		$ele_array = array(
			'SocialName'=>array('is_required'=>'required'),
			'SocialLink'=>array('input_type'=>'url'),
			'SocialLogo'=>array('is_required'=>'required','class'=>'icp-auto','placeholder'=>'Select Social Logo'),
			'Status'=>array('type'=>'radio')
		);
		$other_config = array();
		$this->common_model->common_rander('social_networking_link', $status, $page , 'Social Media Link',$ele_array,'ID',0,$other_config);
	}
	
	public function analytics_code_setting($status ='')
	{
		$this->label_page = 'Update Google Analytics Code';
		if(isset($status) && $status == 'save-data')
		{
			$this->common_model->save_update_data();
		}
		else
		{
			$ele_array = array(
				'GoogleAnalyticsCode'=>array('type'=>'textarea')
			);
			$other_config = array('mode'=>'edit','id'=>'1');
			$this->data['data'] = $this->common_model->generate_form_main($ele_array,$other_config);

			$this->common_model->__load_header($this->label_page);
			$this->load->view('common_file_echo',$this->data);
			$this->common_model->__load_footer();
		}
	
	}
	
	public function homepage_banners($status ='ALL', $page =1)
	{
		$ele_array = array(
			'Title'=>array('is_required'=>'required'),
			'Description'=>array('type'=>'textarea','is_required'=>'required'),
			'Banner'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_banner,'form_group_class'=>'image_adv'),			
			'Status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';		
		$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('Banner'));
		$this->common_model->common_rander('homepage_banner', $status, $page , 'Homepage Banner List',$ele_array,'CreatedOn',0,$other_config);
	}
	
	
	
}