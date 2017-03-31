<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	function get_data($id)
	{
		$data = '';
		if($id !='')
		{
			$where_arra = array('id'=>$id);
			$data = $this->common_model->get_count_data_manual('customer',$where_arra,1,'');			
			
		}
		return $data;
	}
	
	function get_history($id)
	{
		$data = '';
		if($id !='')
		{
			$where_arra = array('customer_id'=>$id,'status'=>'Executed');
			$data = $this->common_model->get_count_data_manual('trade_history',$where_arra,2);
			//echo $this->common_model->last_query(); 
		}
		return $data;
	}
	
	function customer_list_model($status ='ALL', $page =1,$personal_where='')
	{
		$where_country_code= " ( is_deleted ='No' )";
		/*'mobile'=>array('type'=>'manual','code'=>'
			<div class="form-group">
			  <label class="col-sm-'.$this->common_model->label_col.' col-lg-'.$this->common_model->label_col.' control-label">Mobile</label>
			  <div class="col-sm-9 col-lg-'.$this->common_model->form_control_col.'">
			  '.$mobile_ddr.'
			  <input type="hidden" name="mobile" id="mobile" value="" />
			  <input type="hidden" name="is_ajax" id="is_ajax" value="1" />
			  </div>
			</div>'),*/
		$test = $this->common_model->get_session_data();
		$admin_id = $test['id'];
		//print_r($test);
		
		
		//if($this->uri->segment(3)=="customer-list" && $this->uri->segment(4)=="edit-data")
//		{
//			 $condition_pass = false;
//		}
//		else
//		{
//			 $condition_pass = true;
//		}


		$ele_array = array(
			'full_name'=>array('is_required'=>'required','label'=>'Firm/Company/Person Name'),
			'email'=>array('input_type'=>'email','is_required'=>'required','check_duplicate'=>'Yes'),
			'generated_id'=>array('type'=>'manual','code'=>''),
			//'password'=>array('is_required'=>$condition_pass ? 'required' : '','type'=>'password'),
			'password'=>array('is_required'=>'required','type'=>'password'),
			'father_spouse_name'=>array('label'=>'Father/Spouse Name'),		
			'balance_amount'=>array('is_required'=>'required','type'=>'number'),
			'allotted_trade_limit'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>array('0'=>'0 Lot','1'=>'1 Lot','2'=>'2 Lots','3'=>'3 Lots','4'=>'4 Lots','5'=>'5 Lots','6'=>'6 Lots','7'=>'7 Lots','8'=>'8 Lots','9'=>'9 Lots','10'=>'10 Lots'),'value'=>0),
			'deposit_amount'=>array('is_required'=>'required','input_type'=>'number'),
			'margin_amount'=>array('is_required'=>'required','input_type'=>'number'),
			'profile_photo'=>array('type'=>'file','path_value'=>'assets/profile_photo/'),
			'address'=>array('type'=>'textarea'),			
			'mobile'=>array('is_required'=>'required','check_duplicate'=>'Yes'),
			'phone'=>array('label'=>'Office Ph. No.'),
			'voter_id'=>array(),
			'pan_number'=>array(),
			'aadhar_number'=>array(),
			'corpo_num_date'=>array('label'=>'Co.in Corpo. No. & Date'),
			'gst_num'=>array('label'=>'G.S.T No. (TIN No)'),
			'business_nature'=>array('label'=>'Nature Of Business'),
			
			'bank_name'=>array(),
			'branch_name'=>array(),
			'account_num'=>array('label'=>'Bank A/C No'),
			'ifsc_code'=>array(),
			'micr_code'=>array(),
			'bank_address'=>array('type'=>'textarea'),
			
			'authorised_name1'=>array(),
			'authorised_mobile1'=>array(),
			'authorised_name2'=>array(),
			'authorised_mobile2'=>array(),
			
			'customer_status'=>array(),
			'director_name'=>array('label'=>'Director/Partners/Propritoers/ Name'),
			'director_address'=>array('type'=>'textarea','label'=>'Director/Partners/Propritoers/ Address'),
			'director_pan_card'=>array('label'=>'Director/Partners/Propritoers/ Pan No'),
			'director_mobile'=>array('label'=>'Director/Partners/Propritoers/ Mobile'),
			'director_email'=>array('label'=>'Director/Partners/Propritoers/ Email'),
			'director_photo'=>array('type'=>'file','path_value'=>'assets/director_photo/'),
			'signature'=>array('type'=>'file','path_value'=>'assets/signature/'),
			'stamp'=>array('type'=>'file','path_value'=>'assets/stamp/'),
			'status'=>array('type'=>'radio')
		);
		if($status =='add-data')
		{
			$ele_array['upper_link_type']=array('type'=>'manual','code'=>'
				<input type="hidden" name="upper_link_type" value="Company" />
				<input type="hidden" name="upper_link_id" value="'.$admin_id.'" />');
			$filed_duplicate_arr = array('email','mobile');
		}
		else
		{
			$ele_array['generated_id'] = array('is_required'=>'required');
			$filed_duplicate_arr = array('email','mobile','generated_id');
		}
		$this->common_model->extra_css[] = 'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css?ver=1.1';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js?ver=1.1';
		$this->common_model->extra_js[] = 'vendor/bootstrap-datepicker/js/bootstrap-datepicker.js?ver=1.1';
		$data_table = array(
			'title_disp'=>'full_name',
			'sub_title_disp'=>'generated_id',
			'disp_column_array'=> array('email','mobile','phone','voter_id','pan_number','aadhar_number','corpo_num_date','gst_num','business_nature','deposit_amount','balance_amount','created_on','last_login')
		);
		// pass #id# it will replace with table primary key value in url
		$this->common_model->button_array[] = array('url'=>'customer/customer-list/edit-data/#id#','class'=>'info','label'=>'Edit Profile');
		$this->common_model->button_array[] = array('url'=>'customer/detail/#id#','class'=>'primary','label'=>'View Profile');
		$this->common_model->button_array[] = array('onClick'=>'return generate_cust_mini_statement(#id#)','class'=>'success','label'=>'Ledger Detail');
		$this->common_model->button_array[] = array('onClick'=>'return find_order_report(#id#)','class'=>'danger','btn_leg_class'=>'col-lg-3','label'=>'Open Order');
		/*$btn_arr = array(
			array('url'=>'customer/customer_detail/#id#/edit','class'=>'info','label'=>'Edit Profile','target'=>'_blank'),
			array('url'=>'customer/customer_detail/#id#','class'=>'primary','label'=>'View Profile','target'=>'_blank')
		);*/
		//$other = array( 'deleteAllow'=>'no','statusChangeAllow'=>'no');
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$this->common_model->button_array,'default_order'=>'desc','action'=>'customer/save_new_js','field_duplicate'=>$filed_duplicate_arr,'sort_column'=>array('created_on'=>'Latest','last_login'=>'Last Login','full_name'=>'Name'),'enctype'=>'enctype="multipart/form-data"','display_image'=>'profile_photo'); // load member for data table display member listing not table
		
		$label_disp = 'Customer';
		if(isset($personal_where) && $personal_where !='' && count($personal_where))
		{
			if(isset($personal_where['where_per']) && $personal_where['where_per'] !='')
			{
				$other_config['personal_where'] = $personal_where['where_per'];
			}
			if(isset($personal_where['label_disp']) && $personal_where['label_disp'] !='')
			{
				$label_disp = $personal_where['label_disp'];
			}
		}
		//$this->display_filter_form();
		
		$this->common_model->label_col = 3;
		$this->common_model->form_control_col =7;
		$this->common_model->addPopup = 0;
		$this->common_model->common_rander('customer', $status, $page ,$label_disp ,$ele_array,'created_on',0,$other_config);
	}
	
	function jobber_list_model($status ='ALL', $page =1,$personal_where='')
	{
		$where_country_code= " ( is_deleted ='No')";
		$test = $this->common_model->get_session_data();
		$admin_id = $test['id'];
		$ele_array = array(
			'full_name'=>array('is_required'=>'required'),
			'email'=>array('input_type'=>'email','check_duplicate'=>'Yes'),
			'generated_id'=>array('type'=>'manual','code'=>''),
			//'password'=>array('is_required'=>$condition_pass ? 'required' : '','type'=>'password'),
			'password'=>array('is_required'=>'required','type'=>'password'),
			'profile_photo'=>array('type'=>'file','path_value'=>'assets/profile_photo/'),
			'address'=>array('type'=>'textarea'),
			'mobile'=>array('is_required'=>'required','check_duplicate'=>'Yes'),		
			'status'=>array('type'=>'radio')
		);
		if($status =='add-data')
		{
			$ele_array['upper_link_type']=array('type'=>'manual','code'=>'
				<input type="hidden" name="upper_link_type" value="Company" />
				<input type="hidden" name="is_jobber" value="Yes" />
				<input type="hidden" name="upper_link_id" value="'.$admin_id.'" />');
			$filed_duplicate_arr = array('email','mobile');
		}
		else
		{
			$ele_array['generated_id'] = array('is_required'=>'required');
			$filed_duplicate_arr = array('email','mobile','generated_id');
		}
		$this->common_model->extra_css[] = 'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css?ver=1.1';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->extra_js[] = 'vendor/bootstrap-datepicker/js/bootstrap-datepicker.js?ver=1.1';
		$data_table = array(
			'title_disp'=>'full_name',
			'sub_title_disp'=>'generated_id',
			'disp_column_array'=> array('email','mobile','created_on','last_login','address')
		);
		// pass #id# it will replace with table primary key value in url
		$this->common_model->button_array[] = array('url'=>'customer/manage-jobber/edit-data/#id#','class'=>'info','label'=>'Edit Profile');
		/*$this->common_model->button_array[] = array('url'=>'customer/detail/#id#','class'=>'primary','label'=>'View Profile','target'=>'_blank');*/
		/*$btn_arr = array(
			array('url'=>'customer/customer_detail/#id#/edit','class'=>'info','label'=>'Edit Profile','target'=>'_blank'),
			array('url'=>'customer/customer_detail/#id#','class'=>'primary','label'=>'View Profile','target'=>'_blank')
		);*/
		//$other = array( 'deleteAllow'=>'no','statusChangeAllow'=>'no');
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$this->common_model->button_array,'default_order'=>'desc','action'=>'customer/save_new_jober','field_duplicate'=>$filed_duplicate_arr,'sort_column'=>array('created_on'=>'Latest','last_login'=>'Last Login','full_name'=>'Name'),'enctype'=>'enctype="multipart/form-data"','display_image'=>'profile_photo'); // load member for data table display member listing not table
		
		$label_disp = 'Jobber';
		if(isset($personal_where) && $personal_where !='' && count($personal_where))
		{
			if(isset($personal_where['where_per']) && $personal_where['where_per'] !='')
			{
				$other_config['personal_where'] = $personal_where['where_per'];
			}
			if(isset($personal_where['label_disp']) && $personal_where['label_disp'] !='')
			{
				$label_disp = $personal_where['label_disp'];
			}
		}
		//$this->display_filter_form();
		
		$this->common_model->label_col = 3;
		$this->common_model->form_control_col =7;
		$this->common_model->addPopup = 0;
		$this->common_model->common_rander('customer', $status, $page ,$label_disp ,$ele_array,'created_on',0,$other_config);
	}
	
	function display_filter_form()
	{	
		$this->common_model->extra_css[] = 'vendor/chosen_v1.4.0/chosen.min.css';
		$this->common_model->extra_js[] = 'vendor/chosen_v1.4.0/chosen.jquery.min.js';
		$this->common_model->js_extra_code.= " var config = {
			'.chosen-select': {},
			'.chosen-select-deselect': { allow_single_deselect: true },
			'.chosen-select-no-single': { disable_search_threshold: 10 },
			'.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
			'.chosen-select-width': { width: '100%' }			
			};
			$('#industry').chosen({placeholder_text_multiple:'Select Industry'});
			$('#functional_area').chosen({placeholder_text_multiple:'Select Functional Area'});
			$('#job_role').chosen({placeholder_text_multiple:'Select Job Role'});  ";

		$this->common_model->label_col = 3;
		$this->common_model->form_control_col =9;
		$this->common_model->addPopup = 1;
		$total_exp= '<div class="col-sm-5 col-lg-5 pl0">
			<select name="total_exp_from" id="total_exp_from" class="form-control">
				<option selected value="" >From</option>';
				for($i=0;$i <= 25 ; $i=$i+0.5)
				{
					$explode = explode('.',$i);
				  	$m_val = '0';
				  	if(isset($explode[1]) && $explode[1]!='')
				  	{
				  		$m_val = $explode[1] + 1;
				  	}
				  	$val = $explode[0].'-'.$m_val;
					$disp_val = '';
					if($explode[0]=='0' && $m_val=='0')
					{
						$disp_val = "Fresher";
					} 
					else
					{ 
						$disp_val = $explode[0] . ' Year '. $m_val . ' Month ';
					}
					$total_exp.= '<option value="'.$val.'" >'.$disp_val.'</option>';
				}
		$total_exp.='</select>
			</div>
			<div class="col-sm-1 col-lg-1">To</div>
			<div class="col-sm-5 col-lg-5 pr0">
			<select name="total_exp_to" id="total_exp_to" class="form-control">
				<option selected value="" >To</option>';
				for($i=0;$i <= 25 ; $i=$i+0.5)
				{
					$explode = explode('.',$i);
				  	$m_val = '0';
				  	if(isset($explode[1]) && $explode[1]!='')
				  	{
				  		$m_val = $explode[1] + 1;
				  	}
				  	$val = $explode[0].'-'.$m_val;
					$disp_val = '';
					if($explode[0]=='0' && $m_val=='0')
					{
						$disp_val = "Fresher";
					} 
					else
					{ 
						$disp_val = $explode[0] . ' Year '. $m_val . ' Month ';
					}
					$total_exp.= '<option value="'.$val.'" >'.$disp_val.'</option>';
				}
		$total_exp.='
		</select></div>';
		$anual_salary_str= '
			<div class="col-sm-5 col-lg-5 pl0">
				<select name="annual_salary_from" id="annual_salary_from" class="form-control">
				<option selected value="" >From</option>';
				for($ij=0;$ij<=99;$ij=$ij+0.5)
				{
					$anual_salary_str.= '<option value='.$ij.'>'.$ij.' Lacs</option>';
				}
				$anual_salary_str.='</select>
			</div>
			<div class="col-sm-1 col-lg-1">To</div>	
			<div class="col-sm-5 col-lg-5 pr0">
				<select name="annual_salary_to" id="annual_salary_to" class="form-control">
				<option selected value="" >To</option>';
				for($ij=0;$ij<=99;$ij=$ij+0.5)
				{
					$anual_salary_str.= '<option value='.$ij.'>'.$ij.' Lacs</option>';
				}
				$anual_salary_str.='</select>
			</div>';
			
			$exp_anual_salary_str= '			
			<div class="col-sm-5 col-lg-55  pl0">
				<select name="exp_annual_salary_from" id="exp_annual_salary_from" class="form-control">
				<option selected value="" >From</option>';
				for($ij=0;$ij<=99;$ij=$ij+0.5)
				{
					$exp_anual_salary_str.= '<option value='.$ij.'>'.$ij.' Lacs</option>';
				}
				$exp_anual_salary_str.='</select>
			</div>
			<div class="col-sm-1 col-lg-1">To</div>	
			<div class="col-sm-5 col-lg-5 pr0">
				<select name="exp_annual_salary_to" id="exp_annual_salary_to" class="form-control">
				<option selected value="" >To</option>';
				for($ij=0;$ij<=99;$ij=$ij+0.5)
				{
					$exp_anual_salary_str.= '<option value='.$ij.'>'.$ij.' Lacs</option>';
				}
				$exp_anual_salary_str.='</select>
			</div>';
	/*	'industry'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name')), */
		$ele_array = array(
			'keyword'=>array('placeholder'=>'Search with Full name, Email, Mobile, Resume Headline, Key Skill..'),
			'industry'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select'),
			'functional_area'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'functional_area_master','key_val'=>'id','key_disp'=>'functional_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select','onchange'=>"dropdownChange_mul('functional_area','job_role','role_master')"),
			'job_role'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select'),
			'total_experience'=>array('type'=>'manual','code'=>'
			<div class="form-group">
			  <label class="col-sm-'.$this->common_model->label_col.' col-lg-'.$this->common_model->label_col.' control-label">Total Experience</label>
			  <div class="col-sm-9 col-lg-'.$this->common_model->form_control_col.'">
			  '.$total_exp.'			  
			  </div>
			</div>'),
			'annual_salary'=>array('type'=>'manual','code'=>'
			<div class="form-group">
			  <label class="col-sm-'.$this->common_model->label_col.' col-lg-'.$this->common_model->label_col.' control-label">Annual Salary</label>
			  <div class="col-sm-9 col-lg-'.$this->common_model->form_control_col.'">
			  '.$anual_salary_str.'
			  </div>
			</div>'),
			'expected_annual_salary'=>array('type'=>'manual','code'=>'
			<div class="form-group">
			  <label class="col-sm-'.$this->common_model->label_col.' col-lg-'.$this->common_model->label_col.' control-label">Expected Annual Sal.</label>
			  <div class="col-sm-9 col-lg-'.$this->common_model->form_control_col.'">
			  '.$exp_anual_salary_str.'			  
			  </div>
			</div>'),
		);
		$other_config = array('mode'=>'add','id'=>'','action'=>'customer/search_model','form_id'=>'form_model_search');
		$this->common_model->set_table_name('customer');
		$data = $this->common_model->generate_form_main($ele_array,$other_config);
		$this->common_model->data['model_title_fil'] = 'Filter Data';
		$this->common_model->data['model_body_fil'] = $data;
	}
	function save_session_search()
	{
		$search_array = array(
			'keyword'=>'',
			'industry'=>'',
			'functional_area'=>'',
			'job_role'=>'',
			'total_exp_from'=>'',
			'total_exp_to'=>'',
			'annual_salary_from'=>'',
			'annual_salary_to'=>'',
			'exp_annual_salary_from'=>'',
			'exp_annual_salary_to'=>''
		);
		if($this->input->post('keyword') && $this->input->post('keyword') !='')
		{
			$keyword = $this->input->post('keyword');
			$search_array['keyword'] = $keyword;
		}
		if($this->input->post('industry') && $this->input->post('industry') !='')
		{
			$industry = $this->input->post('industry');
			$search_array['industry'] = $industry;
		}
		if($this->input->post('functional_area') && $this->input->post('functional_area') !='')
		{
			$functional_area = $this->input->post('functional_area');
			$search_array['functional_area'] = $functional_area;
		}
		if($this->input->post('job_role') && $this->input->post('job_role') !='')
		{
			$job_role = $this->input->post('job_role');
			$search_array['job_role'] = $job_role;
		}
		
		if($this->input->post('total_exp_from') && $this->input->post('total_exp_from') !='')
		{
			$total_exp_from = $this->input->post('total_exp_from');
			$search_array['total_exp_from'] = $total_exp_from;
		}
		if($this->input->post('total_exp_to') && $this->input->post('total_exp_to') !='')
		{
			$total_exp_to = $this->input->post('total_exp_to');
			$search_array['total_exp_to'] = $total_exp_to;
		}
		
		if($this->input->post('annual_salary_from') && $this->input->post('annual_salary_from') !='')
		{
			$annual_salary_from = $this->input->post('annual_salary_from');
			$annual_salary_from = number_format((float)$annual_salary_from, 2, '.', '');
			$search_array['annual_salary_from'] = str_replace('.','-',$annual_salary_from);
		}
		if($this->input->post('annual_salary_to') && $this->input->post('annual_salary_to') !='')
		{
			$annual_salary_to = $this->input->post('annual_salary_to');
			$annual_salary_to = number_format((float)$annual_salary_to, 2, '.', '');
			$search_array['annual_salary_to'] = str_replace('.','-',$annual_salary_to);
		}
		
		if($this->input->post('exp_annual_salary_from') && $this->input->post('exp_annual_salary_from') !='')
		{
			$exp_annual_salary_from = $this->input->post('exp_annual_salary_from');
			$exp_annual_salary_from = number_format((float)$exp_annual_salary_from, 2, '.', '');
			$search_array['exp_annual_salary_from'] = str_replace('.','-',$exp_annual_salary_from);
		}
		if($this->input->post('exp_annual_salary_to') && $this->input->post('exp_annual_salary_to') !='')
		{
			$exp_annual_salary_to = $this->input->post('exp_annual_salary_to');
			$exp_annual_salary_to = number_format((float)$exp_annual_salary_to, 2, '.', '');
			$search_array['exp_annual_salary_to'] = str_replace('.','-',$exp_annual_salary_to);
		}
		/*$total_exp_year = '';
		$total_exp_month = '';
		$total_experience='';
		if($this->input->post('total_exp_year') && $this->input->post('total_exp_year') !='')
		{
			$total_exp_year = $this->input->post('total_exp_year');
		}
		if($this->input->post('total_exp_month') && $this->input->post('total_exp_month') !='')
		{
			$total_exp_month = $this->input->post('total_exp_month');
		}
		if($total_exp_year !='' || $total_exp_month !='')
		{
			if($total_exp_year =='')
			{
				$total_exp_year = '0';
			}
			if($total_exp_month =='')
			{
				$total_exp_month = '0';
			}
			$search_array['total_experience'] = $total_exp_year.'-'.$total_exp_month;
		}		
		$annual_sal_lacs = '';
		$annual_sal_tho = '';
		$annual_salary ='';
		if($this->input->post('annual_sal_lacs') && $this->input->post('annual_sal_lacs') !='')
		{
			$annual_sal_lacs = $this->input->post('annual_sal_lacs');
		}
		if($this->input->post('annual_sal_tho') && $this->input->post('annual_sal_tho') !='')
		{
			$annual_sal_tho = $this->input->post('annual_sal_tho');
		}
		if($annual_sal_lacs !='' || $annual_sal_tho !='')
		{
			if($annual_sal_lacs =='')
			{
				$annual_sal_lacs = '0';
			}
			if($annual_sal_tho =='')
			{
				$annual_sal_tho = '0';
			}
			$search_array['annual_salary'] = $annual_sal_lacs.'-'.$annual_sal_tho;
		}
		
		$exp_annual_sal_lacs = '';
		$exp_annual_sal_tho = '';
		$exp_annual_salary ='';
		if($this->input->post('exp_annual_sal_lacs') && $this->input->post('exp_annual_sal_lacs') !='')
		{
			$exp_annual_sal_lacs = $this->input->post('exp_annual_sal_lacs');
		}
		if($this->input->post('exp_annual_sal_tho') && $this->input->post('exp_annual_sal_tho') !='')
		{
			$exp_annual_sal_tho = $this->input->post('exp_annual_sal_tho');
		}
		if($exp_annual_sal_lacs !='' || $exp_annual_sal_tho !='')
		{
			if($exp_annual_sal_lacs =='')
			{
				$exp_annual_sal_lacs = '0';
			}
			if($exp_annual_sal_tho =='')
			{
				$exp_annual_sal_tho = '0';
			}
			$search_array['exp_annual_salary'] = $exp_annual_sal_lacs.'-'.$exp_annual_sal_tho;
		}*/
		$this->session->set_userdata('js_save_search',$search_array);
		$this->common_model->return_tocken_clear();
	}
	function save_new_js()
	{
		$_REQUEST['is_ajax'] = 1;
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		
		if($this->input->post('password') && $this->input->post('password') !='')
		{
			$password = $this->input->post('password');
			$hashed_pass = md5($password);
			$_REQUEST['password'] = $hashed_pass;
		}
		else if(isset($_REQUEST['password']))
		{
			unset($_REQUEST['password']);
		}
		$sit_confing = $this->common_model->get_site_config();
		$prefix = $sit_confing['prefix'];
		
		if(isset($_REQUEST['mode']) && $_REQUEST['mode'] !='' && $_REQUEST['mode'] =='add')
		{
			$_REQUEST['balance_amount'] = $_REQUEST['deposit_amount'];
		}
		//$_REQUEST['generated_id'] = $prefix;
		$this->common_model->field_duplicate = array('email','mobile');
		$this->common_model->set_table_name('customer');
		$data = $this->common_model->save_update_data(0,1);
		$data = json_decode($data);
		//$this->session->flashdata('success_message');
		//print_r($data);
		//exit;
		if(isset($data->status) && $data->status !='' && $data->status =='success')
		{
			$this->session->set_userdata('success_message',$data->response);
			if(isset($_REQUEST['mode']) && $_REQUEST['mode'] !='' && $_REQUEST['mode'] =='add')
			{				
				// $insert_id = $this->db->insert_id();
				$insert_id = $this->common_model->last_insert_id;
				if(isset($_REQUEST['full_name']) && $_REQUEST['full_name'] !='')
				{
					$full_name = $_REQUEST['full_name'];
					$full_name_arr = explode(" ",$full_name);
					$fi_c = '';
					$se_c = '';
					$prefix ='';
					if(isset($full_name_arr[0][0]) && $full_name_arr[0][0] !='')
					{
						$fi_c = $full_name_arr[0][0];
					}
					if(isset($full_name_arr[1][0]) && $full_name_arr[1][0] !='')
					{
						$se_c = $full_name_arr[1][0];
					}
					$prefix = $fi_c.$se_c;
				}
				$data_array = array('generated_id'=>$prefix.$insert_id);
				$to_date = $this->common_model->getCurrentDate('Y-m-d');
				$created_on = $this->common_model->getCurrentDate();
				$data_array_cust_tra = array(
					'customer_id'=>$insert_id,
					'previous_amount'=>'0',
					'transact_amount'=>$_REQUEST['balance_amount'],
					'total_amount'=>$_REQUEST['balance_amount'],
					'transact_type'=>'Credit',
					'payment_mode'=>'Other',
					'comment'=>'Opening Balance',
					'payment_date'=>$to_date,
					'created_on'=>$created_on
				);
				$this->common_model->update_insert_data_common('customer_transactions',$data_array_cust_tra,'',0);
				
				if($email!='')
				{
					$email_temp_data = $this->common_front_model->getemailtemplate('Customer Registration');
					
					$trans = array("#ntl_id#" =>$prefix.$insert_id,"#ntl_password#"=>$password);
					
					$email_template  = $this->common_front_model->getstringreplaced($email_temp_data['email_content'],$trans);
					
					$response = $this->common_front_model->common_send_email($email,$email_temp_data['email_subject'],$email_template);
				}
				if($mobile!='')
				{
					$sms_temp_data = $this->common_front_model->get_sms_template('Customer Registration');
					
					$trans = array("#ntl_id#" =>$prefix.$insert_id,"#ntl_password#"=>$password);
					
					$sms_content  = $this->common_front_model->getstringreplaced($sms_temp_data['sms_content'],$trans);
					
					$response = $this->common_model->common_sms_send($mobile,$sms_content);	
				}
				
				$this->common_model->update_insert_data_common('customer',$data_array,array('id'=>$insert_id));
			}
			return 'success';
		}
		else
		{
			$this->session->set_flashdata('error_message',$data->response);
			return '';
		}
	}
	function save_edu_data($id)
	{
		$edu_id = '';
		$is_certificate_X_XII = '';
		$qualification_level = '';
		$specialization = '';
		$passing_year = '';
		$marks = '';
		$edu_total_count = 0;
		$certi_total_count = 0;
		if($this->input->post('edu_id') && $this->input->post('edu_id') !='')
		{
			$edu_id = $this->input->post('edu_id');
		}
		if($this->input->post('is_certificate_X_XII') && $this->input->post('is_certificate_X_XII') !='')
		{
			$is_certificate_X_XII = $this->input->post('is_certificate_X_XII');
		}
		if($this->input->post('qualification_level') && $this->input->post('qualification_level') !='')
		{
			$qualification_level = $this->input->post('qualification_level');
		}
		if($this->input->post('specialization') && $this->input->post('specialization') !='')
		{
			$specialization = $this->input->post('specialization');
		}
		if($this->input->post('institute') && $this->input->post('institute') !='')
		{
			$institute = $this->input->post('institute');
		}
		if($this->input->post('passing_year') && $this->input->post('passing_year') !='')
		{
			$passing_year = $this->input->post('passing_year');
		}
		if($this->input->post('marks') && $this->input->post('marks') !='')
		{
			$marks = $this->input->post('marks');
		}
		if($this->input->post('edu_total_count') && $this->input->post('edu_total_count') !='')
		{
			$edu_total_count = $this->input->post('edu_total_count');
		}
		if($this->input->post('certi_total_count') && $this->input->post('certi_total_count') !='')
		{
			$certi_total_count = $this->input->post('certi_total_count');
		}
		$i_total = count($edu_id);
		$update_on = $this->common_model->getCurrentDate();
		for($i=0;$i<$i_total;$i++)
		{
			$mode = 'add';
			$edu_id_curr = '';
			$passing_year_curr = '';
			$qualification_level_curr = '';
			$institute_curr = '';
			$specialization_curr = '';
			$marks_curr = '';
			$is_certificate_X_XII_curr = '';
			if(isset($edu_id[$i]) && $edu_id[$i] !='')
			{
				$mode ='edit';
				$edu_id_curr = $edu_id[$i];
			}
			if(isset($passing_year[$i]) && $passing_year[$i] !='')
			{
				$passing_year_curr = $passing_year[$i];
			}
			if(isset($qualification_level[$i]) && $qualification_level[$i] !='')
			{
				$qualification_level_curr = $qualification_level[$i];
			}
			if(isset($institute[$i]) && $institute[$i] !='')
			{
				$institute_curr = $institute[$i];
			}
			if(isset($specialization[$i]) && $specialization[$i] !='')
			{
				$specialization_curr = $specialization[$i];
			}
			if(isset($marks[$i]) && $marks[$i] !='')
			{
				$marks_curr = $marks[$i];
			}
			if(isset($is_certificate_X_XII[$i]) && $is_certificate_X_XII[$i] !='')
			{
				$is_certificate_X_XII_curr = $is_certificate_X_XII[$i];
			}
			if(isset($passing_year_curr) && $passing_year_curr !='')
			{
				$data_array = array(
					'js_id'=>$id,
					'passing_year'=>$passing_year_curr,
					'qualification_level'=>$qualification_level_curr,
					'institute'=>$institute_curr,
					'specialization'=>$specialization_curr,
					'marks'=>$marks_curr,
					'is_certificate_X_XII'=>$is_certificate_X_XII_curr,
					'update_on'=>$update_on
				);
				if($mode =='edit' && $edu_id_curr !='')
				{
					$where_arra = array('id'=>$edu_id_curr);
					$this->common_model->update_insert_data_common('customer_education',$data_array,$where_arra,1,1);
				}
				else
				{
					$this->common_model->update_insert_data_common('customer_education',$data_array,'',0);
				}
			}
		}
		$this->session->set_flashdata('success_message',$this->common_model->success_message['edit']);
		$data['data'] =  $this->common_model->getjson_response();
		return $data;
		/*echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';*/
	}
	function save_job_work($id)
	{
		$update_on = date('Y-m-d h:i:s');
		for($i=1;$i<=10;$i++)
	    {
			$work_id = '';
			$company_name='';
			$joining_date='';
			$leaving_date='';
			$industry='';
			$functional_area='';
			
			$job_role='';
			$currency_type='';
			$achievements='';
			$annual_salary='';
			$annual_sal_tho='';
			$annual_sal_lacs = '';
			
			$mode = 'add';
			if(isset($_REQUEST['work_id_'.$i]) && $_REQUEST['work_id_'.$i] !='')
			{
				$work_id = $_REQUEST['work_id_'.$i];
				$mode = 'edit';
			}
			if(isset($_REQUEST['company_name_'.$i]) && $_REQUEST['company_name_'.$i] !='')
			{
				$company_name = $_REQUEST['company_name_'.$i];
			}
			else
			{
				continue;
			}
			if(isset($_REQUEST['joining_date_'.$i]) && $_REQUEST['joining_date_'.$i] !='')
			{
				$joining_date = $_REQUEST['joining_date_'.$i];
			}
			if(isset($_REQUEST['leaving_date_'.$i]) && $_REQUEST['leaving_date_'.$i] !='')
			{
				$leaving_date = $_REQUEST['leaving_date_'.$i];
			}
			if(isset($_REQUEST['joining_date_'.$i]) && $_REQUEST['joining_date_'.$i] !='')
			{
				$joining_date = $_REQUEST['joining_date_'.$i];
			}
			if(isset($_REQUEST['industry_'.$i]) && $_REQUEST['industry_'.$i] !='')
			{
				$industry = $_REQUEST['industry_'.$i];
			}
			if(isset($_REQUEST['functional_area_'.$i]) && $_REQUEST['functional_area_'.$i] !='')
			{
				$functional_area = $_REQUEST['functional_area_'.$i];
			}
			if(isset($_REQUEST['job_role_'.$i]) && $_REQUEST['job_role_'.$i] !='')
			{
				$job_role = $_REQUEST['job_role_'.$i];
			}
			if(isset($_REQUEST['currency_type_'.$i]) && $_REQUEST['currency_type_'.$i] !='')
			{
				$currency_type = $_REQUEST['currency_type_'.$i];
			}
			if(isset($_REQUEST['annual_sal_lacs_'.$i]) && $_REQUEST['annual_sal_lacs_'.$i] !='')
			{
				$annual_sal_lacs = $_REQUEST['annual_sal_lacs_'.$i];
			}
			if(isset($_REQUEST['annual_sal_tho_'.$i]) && $_REQUEST['annual_sal_tho_'.$i] !='')
			{
				$annual_sal_tho = $_REQUEST['annual_sal_tho_'.$i];
			}
			$annual_salary = $annual_sal_lacs.'-'.$annual_sal_tho;
			if(isset($_REQUEST['achievements_'.$i]) && $_REQUEST['achievements_'.$i] !='')
			{
				$achievements = $_REQUEST['achievements_'.$i];
			}
			$data_array = array(
				'js_id'=>$id,
				'company_name'=>$company_name,
				'joining_date'=>$joining_date,
				'leaving_date'=>$leaving_date,
				'industry'=>$industry,
				'functional_area'=>$functional_area,
				'job_role'=>$job_role,
				'annual_salary'=>$annual_salary,
				'currency_type'=>$currency_type,
				'achievements'=>$achievements,
				'update_on'=>$update_on
			);
		//	print_r($data_array);
			if($mode =='add')
			{
				$response = $this->common_model->update_insert_data_common("customer_workhistory",$data_array,'',0);
			}
			else
			{
				$response = $this->common_model->update_insert_data_common("customer_workhistory",$data_array,array('id'=>$work_id),1,1);
			}
		}
		$this->session->set_flashdata('success_message',$this->common_model->success_message['edit']);
		$data['data'] =  $this->common_model->getjson_response();
		return $data;
	}
	function save_job_lan($id)
	{
		$update_on = date('Y-m-d h:i:s');
		for($i=1;$i<=5;$i++)
	    {
			$langu_id = '';
			$langu_name='';
			$proficiency='';
			$reading='No';
			$writing='No';
			$speaking='No';
			$mode = 'add';
			if(isset($_REQUEST['langu_id_'.$i]) && $_REQUEST['langu_id_'.$i] !='')
			{
				$langu_id = $_REQUEST['langu_id_'.$i];
				$mode = 'edit';
			}
			if(isset($_REQUEST['langu_name_'.$i]) && $_REQUEST['langu_name_'.$i] !='')
			{
				$langu_name = $_REQUEST['langu_name_'.$i];
			}
			else
			{
				continue;
			}
			if(isset($_REQUEST['proficiency_'.$i]) && $_REQUEST['proficiency_'.$i] !='')
			{
				$proficiency = $_REQUEST['proficiency_'.$i];
			}
			if(isset($_REQUEST['reading_'.$i]) && $_REQUEST['reading_'.$i] !='')
			{
				$reading = 'Yes';
			}
			if(isset($_REQUEST['writing_'.$i]) && $_REQUEST['writing_'.$i] !='')
			{
				$writing = 'Yes';
			}
			if(isset($_REQUEST['speaking_'.$i]) && $_REQUEST['speaking_'.$i] !='')
			{
				$speaking = 'Yes';
			}
			$data_array = array(
				'js_id'=>$id,
				'language'=>$langu_name,
				'proficiency_level'=>$proficiency,
				'reading'=>$reading,
				'writing'=>$writing,
				'speaking'=>$speaking,
				'update_on'=>$update_on
			);
			if($mode =='add')
			{
				$response = $this->common_model->update_insert_data_common("customer_language",$data_array,'',0);
			}
			else
			{
				$response = $this->common_model->update_insert_data_common("customer_language",$data_array,array('id'=>$langu_id),1,1);
			}
		}
		$this->session->set_flashdata('success_message',$this->common_model->success_message['edit']);
		$data['data'] =  $this->common_model->getjson_response();
		return $data;
	}
	function delete_job_lan($l_id)
	{
		$this->common_model->data_delete_common('customer_language',array('id'=>$l_id),1,'yes');
		$this->session->set_flashdata('success_message', 'language data deleted successfully');
	}
	function delete_job_work($l_id)
	{
		$this->common_model->data_delete_common('customer_workhistory',array('id'=>$l_id),1,'yes');
		$this->session->set_flashdata('success_message', 'Work History data deleted successfully');
	}
	function delete_edu_work($l_id)
	{
		$this->common_model->data_delete_common('customer_education',array('id'=>$l_id),1,'yes');
		$this->session->set_flashdata('success_message', 'Education data deleted successfully');
	}
	function update_job_detail()
	{
		if(isset($_REQUEST['preferred_city']) && $_REQUEST['preferred_city'] !='')
		{
			$val_req = $_REQUEST['preferred_city'];
			$tmp_val = implode(',',$val_req);
			$_REQUEST['preferred_city'] = $tmp_val;
		}
		if($this->input->post('password') && $this->input->post('password') !='')
		{
			$password = $this->input->post('password');
			$hashed_pass = $this->common_model->password_hash($password);
			$_REQUEST['password'] = $hashed_pass;
		}
		else if(isset($_REQUEST['password']))
		{
			unset($_REQUEST['password']);
		}
		$this->common_model->set_table_name('customer');
		$data = $this->common_model->save_update_data(0);
		return $data;
	}	
}