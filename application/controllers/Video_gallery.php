<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_gallery extends CI_Controller {

	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($page = 1)
	{
		$is_ajax = 0;
		if(isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] !='')
		{
			$is_ajax = $_REQUEST['is_ajax'];
		}
		$data = $this->common_front_model->data;
		$data['page_number'] = $page;
		if($is_ajax  == 0)
		{
			$this->common_front_model->__load_header("Al Aman Goat Farm : Video Gallery");
			$this->load->view('front_end/video_gallery_view',$data);
			$this->common_front_model->__load_footer();
		}
		else
		{			
			$this->load->view('front_end/video_gallery_listing',$data);
		}
	}
	
		
}
