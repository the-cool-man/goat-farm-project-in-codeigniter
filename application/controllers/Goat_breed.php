<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goat_breed extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}	
	public function index()
	{
		
		$this->common_front_model->__load_header_temp("Al Aman Goat Farm : Goat's Breed");	
		$this->load->view('front_end/breed_view',$this->data);
		$this->common_front_model->__load_footer();
		$this->common_front_model->extra_js_fr = array('vendor/woo/woocommerce.min.js','vendor/woo/jquery-ui-touch-punch.min.js');
	}
	
	public function detail($id)
	{
		$this->data['breed_id'] = $id;
		$this->common_front_model->__load_header_temp("Al Aman Goat Farm : Goat's Breed");	
		$this->load->view('front_end/breed_detailed_view',$this->data);
		$this->common_front_model->__load_footer();
	}
	
	
}