<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->base_url = base_url();
		$this->data['base_url'] = $this->base_url;
		$this->admin_path = $this->common_model->getconfingValue('admin_path');
		$this->data['admin_path'] = $this->admin_path;
		$this->base_url_admin = $this->base_url.$this->admin_path.'/';
		$this->load->model('back_end/login_model');
	}
	
	public function index()
	{
		if($this->session->userdata(ADMINSESSION) && $this->session->userdata(ADMINSESSION) !="" && count($this->session->userdata(ADMINSESSION)) >0 )
		{
			redirect($this->base_url_admin.'dashboard');
		}
		$this->data['page_title'] = ''; 
		$this->data['config_data'] = $this->common_model->get_site_config();
		
		// generate captcha
			$code = rand(100000,999999);
			$this->session->set_userdata('captcha_code',$code);
		// generate captcha
		
		//$this->load->view('admin/page_part/header',$this->data);
		$this->load->view('back_end/login_view',$this->data);
	}
	public function validate_captcha()
	{
		if($this->input->post('code_captcha') != $this->session->userdata['captcha_code'])
		{
			$this->form_validation->set_message('validate_captcha', 'Wrong captcha code, Please enter valid captcha code');
			return false;
		}else{
			return true;
		}
	
	}
	public function check_login()
	{
	  	$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('code_captcha', 'Captcha Code', 'callback_validate_captcha');
		$is_post = 0;
		if($this->input->post('is_post'))
		{
			$is_post = trim($this->input->post('is_post'));
		}
		if ($this->form_validation->run() == FALSE)
        {
			$data1['token'] = $this->security->get_csrf_hash();
			$data1['errmessage'] =  validation_errors();
			$data1['status'] = 'error';
			if($is_post == 0)
			{
				$data['data'] = json_encode($data1);
			}
		}
		else
		{
			$return_arr = $this->login_model->check_login();
			$data['data'] = json_encode($return_arr);
		}
		if($is_post == 0)
		{
			$this->load->view('common_file_echo',$data);
		}
		else
		{
			if($return_arr['status'] == 'success')
			{
				if($this->session->userdata('captcha_code'))
				{
					$this->session->unset_userdata('captcha_code');
				}
				redirect($this->base_url_admin.'dashboard');
			}
			else 
			{
				$this->session->set_flashdata('user_log_err', $return_arr['errmessage']);
				redirect($this->base_url_admin.'login');
			}
		}
	}
	public function log_out($per='')
	{
		if($this->session->userdata(ADMINSESSION))
		{
			$this->session->unset_userdata(ADMINSESSION);
		}
		$this->session->set_flashdata('user_log_out', 'You have successfully logged out');
		redirect($this->base_url_admin.'login');
	}
	public function forgot_password()
	{
		if($this->session->userdata(ADMINSESSION) && $this->session->userdata(ADMINSESSION) !="" && count($this->session->userdata(ADMINSESSION)) >0 )
		{
			redirect($this->base_url.'search');
		}
		
		$this->data['page_title'] = '';
		$this->data['config_data'] = $this->common_model->get_site_config();

		$this->load->view('back_end/forgot_password',$this->data);
	}
	public function validate_captcha_for()
	{
		if($this->input->post('code_captcha') != $this->session->userdata['for_captcha_code'])
		{
			$this->form_validation->set_message('validate_captcha_for', 'Wrong captcha code, Please enter valid captcha code');
			return false;
		}else{
			return true;
		}
	
	}
	public function check_email_forgot()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reminder-email', 'Email ID', 'required|valid_email');
		$this->form_validation->set_rules('code_captcha', 'Captcha Code', 'callback_validate_captcha_for');
		if ($this->form_validation->run() == FALSE)
        {
			$data1['token'] = $this->security->get_csrf_hash();
			$data1['errmessage'] =  validation_errors();
			$data1['status'] = 'error';
			$data['data'] = json_encode($data1);
		}
		else
		{
			$data['data'] = $this->login_model->check_reset_forgot_password();
			$this->session->set_flashdata('user_log_out', 'You password has been reset successfully, Now login with new password');
		}
		$this->load->view('common_file_echo',$data);
		
	}
		public function reset_password($password='',$email='')
	{
		if($password !='' && $email !='')
		{
			$response = $this->login_model->check_reset_link($password,$email);
			if($response =='success')
			{
				$this->data['page_title'] = '';
				$this->data['config_data'] = $this->common_model->get_site_config();
				$this->load->view('back_end/reset_password',$this->data);
			}
			else
			{
				redirect($this->base_url_admin.'login');
			}
		}
		else
		{
			redirect($this->base_url_admin.'login');
		}
	}
	public function reset_update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'New Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		$is_post = 0;
		if($this->input->post('is_post'))
		{
			$is_post = trim($this->input->post('is_post'));
		}
		if ($this->form_validation->run() == FALSE)
        {
			$data1['token'] = $this->security->get_csrf_hash();
			$data1['errmessage'] =  validation_errors();
			$data1['status'] = 'error';
			if($is_post == 0)
			{
				$data['data'] = json_encode($data1);
			}
		}
		else
		{
			$return_arr = $this->login_model->reset_update_pass();
			if($return_arr['status'] == 'success')
			{
				$this->session->unset_userdata('email_reset');
			}
			$data['data'] = json_encode($return_arr);
		}
		if($is_post == 0)
		{
			$this->load->view('common_file_echo',$data);
		}
		else
		{
			if($return_arr['status'] == 'success')
			{
				$this->session->set_flashdata('user_log_out', $return_arr['errmessage']);
				redirect($this->base_url_admin.'login');
			}
			else 
			{
				$this->session->set_flashdata('user_log_err', $return_arr['errmessage']);
				redirect($this->base_url_admin.'login');
			}
		}
	}
}