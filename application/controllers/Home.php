<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	 
	public function index()
	{
		$this->common_front_model->__load_header("Al Aman Goat Farm : Home");		
		$this->load->view('front_end/home_view',$this->data);
		$this->common_front_model->__load_footer();
	}
}
