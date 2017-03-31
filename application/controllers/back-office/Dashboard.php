<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->base_url = base_url();
		$this->data['base_url'] = $this->base_url;
		$this->admin_path = $this->common_model->getconfingValue('admin_path');
		$this->data['admin_path'] = $this->admin_path;
		if(!$this->session->userdata(ADMINSESSION) || $this->session->userdata(ADMINSESSION) =="" && count($this->session->userdata(ADMINSESSION)) ==0 )
		{
			redirect($this->base_url.$this->admin_path.'/login');
		}
	}
	public function index()
	{
		$this->data['page_title'] = 'Dashboard';
		$this->data['config_data'] = $this->common_model->get_site_config();
		$this->load->view('back_end/page_part/header',$this->data);
		$this->load->view('back_end/dashboard_view',$this->data);
		$this->load->view('back_end/page_part/footer',$this->data);
	}
}