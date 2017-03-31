<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}	
	public function index()
	{
		$this->common_front_model->__load_header("Al Aman Goat Farm : Contact us");		
		$this->load->view('front_end/contact_view',$this->data);
		$this->common_front_model->__load_footer();
	}
	
	public function submit_contact()
	{	
		//print_r($_POST);
		
		$this->load->model('front_end/contact_model');
		$is_post = 0;
		if($this->input->post('is_post'))
		{
			$is_post = trim($this->input->post('is_post'));
		}
		$data = $this->contact_model->validate_form();
		if($is_post ==0)
		{
			$data1['data'] = json_encode($data);
			$this->load->view('common_file_echo',$data1);
		}
		else
		{
			if($data['status'] =='success')
			{
				$this->session->set_flashdata('email_success_message',$data['errmessage']);
			}
			else
			{
				$this->session->set_flashdata('email_error_message', $data['errmessage']);
			}
			redirect(base_url().'contact');
		}
	}
}