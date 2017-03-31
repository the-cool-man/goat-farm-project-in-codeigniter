<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Employer extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin();
		$this->load->model('back_end/Employer_model','employer_model');
	}
	public function index()
	{
		$this->employer_list();
	}
	public function employer_list($status ='ALL', $page =1,$clear_search='no')
	{
		if($clear_search =='yes')
		{
			$this->clear_filter('no');
		}
		$this->employer_model->employer_list_model($status,$page);
	}
	public function active_employer_list($status ='ALL', $page =1,$clear_search='no')
	{
		if($clear_search =='yes')
		{
			$this->clear_filter('no');
		}
		$this->common_model->button_array[] = array('onClick'=>"return display_payment(#id#,'employer')",'class'=>'success','label'=>'Approve as Paid');
		$personal_where = array();
		$personal_where['where_per'] = " plan_status ='Active' ";
		$personal_where['label_disp'] = "Active Employer";
		$this->employer_model->employer_list_model($status,$page,$personal_where);
	}
	public function paid_employer_list($status ='ALL', $page =1,$clear_search='no')
	{
		if($clear_search =='yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$personal_where['where_per'] = " plan_status ='Paid' ";
		$personal_where['label_disp'] = "Paid Employer";
		$this->employer_model->employer_list_model($status,$page,$personal_where);
	}
	public function expired_employer_list($status ='ALL', $page =1,$clear_search='no')
	{
		if($clear_search =='yes')
		{
			$this->clear_filter('no');
		}
		$this->common_model->button_array[] = array('onClick'=>"return display_payment(#id#,'employer')",'class'=>'success','label'=>'Renew Plan');
		$personal_where = array();
		$personal_where['where_per'] = " plan_status ='Expired' ";
		$personal_where['label_disp'] = "Expired Employer";
		$this->employer_model->employer_list_model($status,$page,$personal_where);
	}
	public function employer_detail($id = '',$mode='view')
	{
		if($id =='')
		{
			redirect($this->common_model->base_url_admin.'employer/employer-list');
			exit;
		}
		$this->common_model->__load_header('Employer Detail');
		$this->data = $this->common_model->data;
		$this->data['id'] = $id;
		$this->data['view_edit_mode'] = $mode;
		$this->data['employer_data'] = $this->employer_model->get_data($id);
		$this->data['plan_data'] = $this->common_model->get_count_data_manual('plan_employer',array('emp_id'=>$id,'is_deleted'=>'No','current_plan'=>'Yes'),1,'','',0,'',0);
		$this->load->view('back_end/employer_detail',$this->data);
		$this->common_model->__load_footer('');
	}
	public function save_new_emp()
	{
		$id = $this->employer_model->save_new_emp();
		if($id !='')
		{
			redirect($this->common_model->base_url_admin.'employer/employer_detail/'.$id.'/edit');
		}
		else
		{
			redirect($this->common_model->base_url_admin.'employer/employer-list');
		}
	}
	public function view_detail($id = '',$mode='',$disp_mode = 'view')
	{
		if($id !='' && $mode != '')
		{
			$data['id'] = $id;
			$data['disp_mode'] = $disp_mode;
			$this->load->view('back_end/employer_'.$mode,$data);
		}
	}

	public function save_detail($id = '',$mode='')
	{
		if($this->input->post('industry_hire') && $this->input->post('industry_hire') !='')
		{
			$data['respones'] = $this->employer_model->save_emp_hire($id);
		}
		else if($this->input->post('success_url') && $this->input->post('success_url') !='')
		{
			$data['respones'] = $this->employer_model->update_empl_detail();
		}
		if($id !='' && $mode != '')
		{
			$data['id'] = $id;
			$this->load->view('back_end/employer_'.$mode,$data);
		}
	}
	public function plan_list()
	{
		$data['base_url'] = $this->common_model->base_url;
		$this->load->view('back_end/payment_display',$data);
	}
	public function plan_update()
	{
		$data_return = $this->common_model->update_plan_member_call();
		$data['data'] =  json_encode($data_return);
		$this->load->view('common_file_echo',$data);
	}
	public function search_model()
	{
		$this->employer_model->save_session_search();
	}
	public function clear_filter($return='yes')
	{
		$this->common_model->return_tocken_clear('emp_save_search',$return);
	}
}