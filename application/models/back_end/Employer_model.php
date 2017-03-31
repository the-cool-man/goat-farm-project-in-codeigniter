<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Employer_model extends CI_Model {
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
			$data = $this->common_model->get_count_data_manual('employer_master_view',$where_arra,1,'');
		}
		return $data;
	}
	function employer_list_model($status ='ALL', $page =1,$personal_where='')
	{
		$where_country_code= " ( is_deleted ='No' )";
		$country_code_arr = $this->common_model->get_count_data_manual('country_master',$where_country_code,2,'country_code,country_name','','','',"");
		
		$mobile_ddr= '<div class="col-sm-6 col-lg-6 pl0">
			<select name="country_code" id="country_code" required class="form-control" >
			<option value="">Select Country Code</option>';
			foreach($country_code_arr as $country_code_arr)
			{				
				$mobile_ddr.= '<option value='.$country_code_arr['country_code'].'>'.$country_code_arr['country_code'].' ('.$country_code_arr['country_name'].')'.'</option>';
			}
		$mobile_ddr.='</select>
			</div>
			<div class="col-sm-6 col-lg-6 ">
				<input type="text" required name="mobile_num" minlength="8" id="mobile_num" class="form-control" placeholder="Mobile Number" value ="" />
			</div>';
				
		$ele_array = array(
			'title'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'personal_titles_master','key_val'=>'id','key_disp'=>'personal_titles'),'value'=>'1'),
			'fullname'=>array('is_required'=>'required'),
			'email'=>array('is_required'=>'required','input_type'=>'email'),
			'password'=>array('type'=>'password','is_required'=>'required'),
			'company_name'=>array('is_required'=>'required'),
			'industry_temp'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name'),'label'=>'Industry'),
			'company_type'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'company_type_master','key_val'=>'id','key_disp'=>'company_type'),'label'=>'Company Type'),
			'company_size'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'company_size_master','key_val'=>'id','key_disp'=>'company_size'),'label'=>'Company Size'),
			'company_email'=>array('is_required'=>'required','input_type'=>'email'),
			'mobile'=>array('type'=>'manual','code'=>'
			<div class="form-group">
			  <label class="col-sm-'.$this->common_model->label_col.' col-lg-'.$this->common_model->label_col.' control-label">Company Mobile</label>
			  <div class="col-sm-9 col-lg-'.$this->common_model->form_control_col.'">
			  '.$mobile_ddr.'
			  <input type="hidden" name="mobile" id="mobile" value="" />
			  <input type="hidden" name="is_ajax" id="is_ajax" value="1" />
			  </div>
			</div>'),
			'address'=>array('type'=>'textarea','label'=>'Company Address'),
			'country'=>array('is_required'=>'required','type'=>'dropdown','onchange'=>"dropdownChange('country','city','city_list')",'relation'=>array('rel_table'=>'country_master','key_val'=>'id','key_disp'=>'country_name'),'label'=>'Company Country'),	// for relation dropdown
			'city'=>array('is_required'=>'required','type'=>'dropdown','label'=>'Company City'),
			'pincode'=>array('is_required'=>'required','label'=>'Company Pincode'),

		);
		/*$this->common_model->extra_css[] = 'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css';*/
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		/*$this->common_model->extra_js[] = 'vendor/bootstrap-datepicker/js/bootstrap-datepicker.js';*/
		$data_table = array(
			'title_disp'=>'fullname',
			'disp_column_array'=> array('email','mobile','designation','company_name','company_type_name','industries_name','function_area_hire','skill_hire','city_name','country_name','plan_status','plan_name','register_date','last_login')
		);
		if($this->input->post('status_update'))
		{
			$status_update = trim($this->input->post('status_update'));
			if($status_update == 'DELETE')
			{
				$selected_val = $this->input->post('selected_val');
				$selected_val = $this->input->post('selected_val');
				if($status !='' && $selected_val !='' && count($selected_val) > 0 )
				{
					$this->db->where_in('posted_by', $selected_val);
					$data_array = array('is_deleted' =>'Yes');
					$this->db->update('job_posting',$data_array);
				}
			}
		}
		// pass #id# it will replace with table primary key value in url
		$this->common_model->button_array[] = array('url'=>'employer/employer_detail/#id#/edit','class'=>'info','label'=>'Edit Profile','target'=>'_blank');
		$this->common_model->button_array[] = array('url'=>'employer/employer_detail/#id#','class'=>'primary','label'=>'View Profile','target'=>'_blank');
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$this->common_model->button_array,'default_order'=>'desc','action'=>'employer/save_new_emp','field_duplicate'=>array('email','mobile'),'sort_column'=>array('register_date'=>'Latest','last_login'=>'Last Login','fullname'=>'Name'),'display_image'=>'emp_photos','display_image'=>'profile_pic','profile_pic'=>'assets/emp_photos/'); // load member for data table display member listing not table
		
		$label_disp = 'Employer';
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
		$this->display_filter_form();
		
		$this->common_model->label_col = 2;
		$this->common_model->form_control_col =7;
		$this->common_model->addPopup = 0;
		$this->common_model->common_rander('employer_master_view', $status, $page , $label_disp ,$ele_array,'register_date',0,$other_config);
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
			$('#country_search').chosen({placeholder_text_multiple:'Select Country'});
			$('#city_search').chosen({placeholder_text_multiple:'Select City'});
			
			$('#industry').chosen({placeholder_text_multiple:'Select Industry'});
			$('#industry_hire').chosen({placeholder_text_multiple:'Select Industry Hire'});
			$('#functional_area_hire').chosen({placeholder_text_multiple:'Select Functional Area Hire'});
			$('#designation').chosen({placeholder_text_multiple:'Select Designation'});
			$('#company_type_search').chosen({placeholder_text_multiple:'Select Company Type'}); 
			";
			

		$this->common_model->label_col = 3;
		$this->common_model->form_control_col =9;
		$this->common_model->addPopup = 1;
	/*	'industry'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name')), */
		$ele_array = array(
			'keyword'=>array('placeholder'=>'Search with Full name, Email, Mobile, Personal Email..'),
			'country_search'=>array('type'=>'dropdown','onchange'=>"dropdownChange_mul('country_search','city_search','city_list')",'relation'=>array('rel_table'=>'country_master','key_val'=>'id','key_disp'=>'country_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select','label'=>'Country'),	// for relation dropdown
			'city_search'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select','label'=>'City'),
			'industry'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select'),
			'industry_hire'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'industries_master','key_val'=>'id','key_disp'=>'industries_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select'),
			'functional_area_hire'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'functional_area_master','key_val'=>'id','key_disp'=>'functional_name'),'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select','onchange'=>"dropdownChange_mul('functional_area_hire','designation','role_master')"),
			'designation'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select'),
			'company_type_search'=>array('is_required'=>'required','type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'chosen-select','relation'=>array('rel_table'=>'company_type_master','key_val'=>'id','key_disp'=>'company_type'),'label'=>'Company Type')
		);
		$other_config = array('mode'=>'add','id'=>'','action'=>'employer/search_model','form_id'=>'form_model_search');
		$this->common_model->set_table_name('employer_master');
		$data = $this->common_model->generate_form_main($ele_array,$other_config);
		$this->common_model->data['model_title_fil'] = 'Filter Data';
		$this->common_model->data['model_body_fil'] = $data;
	}
	function save_session_search()
	{
		$search_array = array(
			'keyword'=>'',
			'country'=>'',
			'city'=>'',
			'industry'=>'',
			'industry_hire'=>'',
			'functional_area_hire'=>'',
			'designation'=>'',
			'company_type'=>''			
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
		if($this->input->post('industry_hire') && $this->input->post('industry_hire') !='')
		{
			$industry_hire = $this->input->post('industry_hire');
			$search_array['industry_hire'] = $industry_hire;
		}
		if($this->input->post('functional_area_hire') && $this->input->post('functional_area_hire') !='')
		{
			$functional_area_hire = $this->input->post('functional_area_hire');
			$search_array['functional_area_hire'] = $functional_area_hire;
		}
		if($this->input->post('country_search') && $this->input->post('country_search') !='')
		{
			$country = $this->input->post('country_search');
			$search_array['country'] = $country;
		}
		
		if($this->input->post('city_search') && $this->input->post('city_search') !='')
		{
			$city = $this->input->post('city_search');
			$search_array['city'] = $city;
		}
		if($this->input->post('company_type_search') && $this->input->post('company_type_search') !='')
		{
			$company_type = $this->input->post('company_type_search');
			$search_array['company_type'] = $company_type;
		}
		if($this->input->post('designation') && $this->input->post('designation') !='')
		{
			$designation = $this->input->post('designation');
			$search_array['designation'] = $designation;
		}
		$this->session->set_userdata('emp_save_search',$search_array);
		$this->common_model->return_tocken_clear();
	}
	function save_new_emp()
	{
		$mobile_num = '';
		$country_code = '';
		if(isset($_REQUEST['mobile_num']) && $_REQUEST['mobile_num'] !='')
		{
			$mobile_num = $_REQUEST['mobile_num'];
		}
		if(isset($_REQUEST['country_code']) && $_REQUEST['country_code'] !='')
		{
			$country_code = $_REQUEST['country_code'];
		}
		$industry_temp = '';
		if(isset($_REQUEST['industry_temp']) && $_REQUEST['industry_temp'] !='')
		{
			$industry_temp = $_REQUEST['industry_temp'];
		}
		
		
		$mobile = $country_code.'-'.$mobile_num;
		$_REQUEST['industry'] = $industry_temp;
		$_REQUEST['mobile'] = $mobile;
		$_REQUEST['is_ajax'] = 1;
		$this->common_model->created_on_fild = 'register_date';
		
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
		
		$this->common_model->field_duplicate = array('email');
		$this->common_model->set_table_name('employer_master');
		$data = $this->common_model->save_update_data(0,1);
		$data = json_decode($data);
		$this->session->flashdata('success_message');
		//print_r($data);
		//exit;
		if(isset($data->status) && $data->status !='' && $data->status =='success')
		{
			$this->session->set_userdata('success_message_js',$data->response);
			//$insert_id = $this->db->insert_id();
			$insert_id = $this->common_model->last_insert_id;
			$this->common_model->update_plan_employer($insert_id,1);
			
			return $insert_id;
		}
		else
		{
			$this->session->set_flashdata('error_message_js',$data->response);
			return '';
		}
	}
	function save_emp_hire($id)
	{
		$industry_hire = '';
		$function_area_hire = '';
		$skill_hire = '';
		if(isset($_REQUEST['industry_hire']) && $_REQUEST['industry_hire'] !='')
		{
			$industry_hire = $_REQUEST['industry_hire'];
			$industry_hire = implode(',',$industry_hire);
		}
		if(isset($_REQUEST['function_area_hire']) && $_REQUEST['function_area_hire'] !='')
		{
			$function_area_hire = $_REQUEST['function_area_hire'];
			$function_area_hire = implode(',',$function_area_hire);
		}
		if(isset($_REQUEST['skill_hire']) && $_REQUEST['skill_hire'] !='')
		{
			$skill_hire = $_REQUEST['skill_hire'];
			$skill_hire = implode(',',$skill_hire);
		}
		$data_array = array(
			'industry_hire'=>$industry_hire,
			'function_area_hire'=>$function_area_hire,
			'skill_hire'=>$skill_hire
		);
		//print_r($data_array);
		$response = $this->common_model->update_insert_data_common("employer_master",$data_array,array('id'=>$id),1,1);
		//echo $this->common_model->last_query();
		$this->session->set_flashdata('success_message',$this->common_model->success_message['edit']);
		$data['data'] =  $this->common_model->getjson_response();
		return $data;
	}
	function update_empl_detail()
	{
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
		if(isset($_REQUEST['functional_area']) && $_REQUEST['functional_area'] !='')
		{
			$designation = $_REQUEST['functional_area'];
			$designation = implode(',',$designation);
			$_REQUEST['functional_area'] = $designation;
		}
		if(isset($_REQUEST['designation']) && $_REQUEST['designation'] !='')
		{
			$designation = $_REQUEST['designation'];
			$designation = implode(',',$designation);
			$_REQUEST['designation'] = $designation;
		}
		$this->common_model->set_table_name('employer_master');
		$data = $this->common_model->save_update_data(0);
		return $data;
	}
}