<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CMS extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
	}	
	public function index()
	{
		$this->about_us();		
	}	 
	public function about_us()
	{
		$this->common_front_model->data['page_name'] = 'about-us';
		$this->common_front_model->__load_header("Al Aman Goat Farm : About us");
		$this->load->view('front_end/cms_common_view',$this->common_front_model->data);
		$this->common_front_model->__load_footer();
	}
	public function terms_conditions()
	{
		$this->data['page_name'] = 'terms-conditions';
		$this->common_front_model->__load_header("Al Aman Goat Farm : Terms & Condition");		
		$this->load->view('front_end/cms_common_view',$this->data);
		$this->common_front_model->__load_footer();
	}
	public function privacy_policy()
	{
		$this->data['page_name'] = 'privacy-policy';
		$this->common_front_model->__load_header("Al Aman Goat Farm : Privacy Policy");		
		$this->load->view('front_end/cms_common_view',$this->data);
		$this->common_front_model->__load_footer();
	}
	public function refund_policy()
	{
		$this->data['page_name'] = 'refund-policy';
		$this->common_front_model->__load_header("Al Aman Goat Farm : Refund Policy");		
		$this->load->view('front_end/cms_common_view',$this->data);
		$this->common_front_model->__load_footer();
	}
	
}
