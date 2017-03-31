<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Common_front_model extends CI_Model {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['base_url'] = $this->base_url = base_url();
		$this->data['config_data'] = $this->get_site_config();
		$this->data['custom_lable'] = $this->lang;
		$this->limit_per_page = 10;
		$this->field_duplicate='';
		$this->extra_css = array();
		$this->extra_js = array();
		$this->js_extra_code = '';
		$this->js_validation_extra = '';
		$this->front_session_name = 'user_session_name';
		$this->primary_key = 'ID';
		$this->app_user_agent = 'EI-AAPP';
	}
	public function get_current_currency()
	{
		$DefaultCurrency = 'INR';
		if(isset($this->data['config_data']['DefaultCurrency']) && $this->data['config_data']['DefaultCurrency'] !='')
		{
			$DefaultCurrency = $this->data['config_data']['DefaultCurrency'];
		}
		return $DefaultCurrency;
	}
	public function checkLoginfront()
	{
		$returnvar = false;
		if($this->session->userdata($this->front_session_name) && $this->session->userdata($this->front_session_name) !="" && count($this->session->userdata($this->front_session_name)) > 0 )
		{
				$returnvar = true;
		}
		else if($this->input->post('user_id'))
		{
			$user_id = $this->input->post('user_id');
			if($user_id !='') 
			{
				$returnvar = true;
			}
		}
		return $returnvar;
	}

	public function get_userid()
	{
		$user_id = '';
		if($this->input->post('user_id'))
		{
			$user_id = $this->input->post('user_id');
		}
		else if($this->session->userdata($this->front_session_name) && $this->session->userdata($this->front_session_name) !='' && count($this->session->userdata($this->front_session_name))> 0)
		{
			$user_data = $this->session->userdata($this->front_session_name);
			$user_id = $user_data['user_id'];
		}
		return $user_id;
	}

	public function get_user_data($table,$id,$select='*',$id_f ='id_prim')
	{
		if($id_f == 'id_prim')
		{
			$id_f = $this->common_model->primary_key;
		}
		$user_data = '';
		if($table !='' && $id!='' && $id_f !='')
		{
			$where = array($id_f=>$id);
			$user_data = $this->common_model->get_count_data_manual($table,$where,1,$select,'','',1);
		}
		return $user_data;
	}
	
	public function redirectLoginfront()
	{
		if($this->input->post('user_id'))
		{
			
		}
		else if(!$this->session->userdata($this->front_session_name) || $this->session->userdata($this->front_session_name) =="" && count($this->session->userdata($this->front_session_name)) ==0 )
		{
			$base_url = $this->base_url;
			redirect($base_url);
		}
	}
	
	public function __load_header($label_page='',$status='')
	{
		$this->label_page = $label_page;
		$page_title = $label_page;
		if($status !='')
		{
			$page_title = $page_title.' - '.$status;
		}
		$this->data['page_title'] = $page_title;
		$this->load->view('front_end/page-part/header',$this->data);
	}
	
	public function __load_header_temp($label_page='',$status='')
	{
		$this->label_page = $label_page;
		$page_title = $label_page;
		if($status !='')
		{
			$page_title = $page_title.' - '.$status;
		}
		$this->data['page_title'] = $page_title;
		$this->load->view('front_end/page-part/header_shop',$this->data);
	}
	
	public function __load_footer($model_body='')
	{
		$this->data['model_body'] = $model_body;
		$this->data['model_title'] = 'Add '.$this->label_page;
		$this->load->view('front_end/page-part/footer',$this->data);
	}
	
	public function get_site_config()
	{
		$site_config = $this->common_model->get_site_config();
		$site_config['social_media'] = $this->common_model->get_count_data_manual('social_networking_link',array('Status'=>'A'),2,'','','');
		return $site_config;
	}
	public function get_session_data()
	{
		return $this->session->userdata($this->front_session_name);
	}
	public function checkLogin()
	{
		if(!$this->session->userdata($this->front_session_name) || $this->session->userdata($this->front_session_name) =="" && count($this->session->userdata($this->front_session_name)) ==0 )
		{
			$base_url = base_url();
			redirect($base_url);
		}
	}

	public function rander_pagination($url='',$count=0,$set_limit = '')
	{
		$return_page = '';
		if($set_limit=='')
		{
			$set_limitvar = $this->limit_per_page;
		}
		else
		{
			$set_limitvar = $set_limit;
		}
		if($url !='' && $count !='' && $count > 0)
		{
			$this->load->library('pagination');
			$config = $this->common_model->getconfingValue('config_pag');
			$config['full_tag_open'] = '<ul id="ajax_pagin_ul">';
			$config['cur_tag_open'] = '<li><a href="#" class="current-page">';
			$config['first_tag_open'] = '<li class="prev page ci-pagination-first">';
    		$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="prev page ci-pagination-prev">';
   			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="next page ci-pagination-next">';
    		$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="next page ci-pagination-next">';
    		$config['last_tag_close'] = '</li>';
			$config['base_url'] = $this->base_url.$url;
			$config['per_page'] = $set_limitvar;
			$config['total_rows'] = $count;
			$this->pagination->initialize($config);
			$return_page = $this->pagination->create_links();
			$return_page ='<div class="pagination-container">
			<nav class="pagination">'.$return_page.'</nav></div>';
		}
		return $return_page;
	}

	function get_sms_template($tempname='')
	{
		$tempdata = '';
		if($tempname !='')
		{
			$where_arra = array('template_name'=>$tempname,'status'=>'APPROVED','is_deleted'=>'No');
			$tempdata = $this->get_count_data_manual('sms_templates',$where_arra,1,'','','','','');
		}
		return $tempdata;
	}
	function dataimage_fullurl($data='',$column_nam='',$datatype = 'multiple')
	{
		$tempdata = array();
		if($data !='' && $column_nam !='' && count($column_nam) > 0)
		{
			if($datatype!='single')
			{
				foreach($data as $data_val)
				{
					foreach($column_nam as $key=>$val)
					{
						if(isset($data_val[$key]) && $data_val[$key] !='')
						{
							$data_val[$key] = $this->base_url.$val.$data_val[$key];
						}
					}
					$tempdata[] = $data_val;
				}
			}
			else
			{
				foreach($column_nam as $key=>$val)
				{
					if(isset($data[$key]) && $data[$key] !='')
					{
						$data[$key] = $this->base_url.$val.$data[$key];
					}
				}
				$tempdata = $data;
			}
		}
		return $tempdata;
	}
	function checkfieldnotnull($filed='')
	{
		$returnvar = false;	
		if($filed!='' && !is_null($filed))
		{
			$returnvar = true;
		}
		return $returnvar;
	}
	public function get_list($get_list='',$return_opt='json',$currnet_val='',$retun_for = 'str',$selected_val ='',$tocken_val  =0)
	{
		$primary_key = $this->primary_key;
		$this->tabel_config = array(
			'state_list'=>array('table_name'=>'state_master','pri_key'=>$primary_key,'disp_clm'=>'StateName','rel_clm_name'=>'CountryId','label'=>'State'),
			'country_list'=>array('table_name'=>'country_master','pri_key'=>$primary_key,'disp_clm'=>'CountryName','label'=>'Country','rel_clm_name'=>''),
			'city_list'=>array('table_name'=>'city_master','pri_key'=>$primary_key,'disp_clm'=>'CityName','label'=>'City','rel_clm_name'=>'StateId'),
		);
		//
		
		$selected_arr = array();
		$str_ddr = '';
		if($selected_val !='')
		{
			if(!is_array($selected_val))
			{
				$selected_arr[] = explode(',',$selected_val);
				$selected_arr = $selected_arr[0];
			}
			else
			{
				$selected_arr[] = $selected_val;
				$selected_arr = $selected_arr[0];
			}
		}
		
		$opt_array = array();
		if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] == $this->app_user_agent)
		{
			$opt_array[] = array('id'=>'','val'=>'Select Option');
		}
		else
		{
			$opt_array[] = array('id'=>'0','val'=>'Select Option');
		}
		if($this->input->post('get_list'))
		{
			$get_list = trim($this->input->post('get_list'));
		}
		if($this->input->post('currnet_val'))
		{
			$currnet_val = trim($this->input->post('currnet_val'));
		}
		if($this->input->post('tocken_val'))
		{
			$tocken_val = trim($this->input->post('tocken_val'));
		}
		if($get_list  !='')
		{
			
			if(isset($this->tabel_config[$get_list]) && $this->tabel_config[$get_list] !='' && count($this->tabel_config[$get_list]) > 0)
			{ 
				$tabel_config = $this->tabel_config[$get_list];
				$label_sele = 'Select Option';
				if(isset($tabel_config['label']) && $tabel_config['label'] !='')
				{
					$label_sele = 'Select '.$tabel_config['label'];
				}
				$str_ddr = '<option value="">'.$label_sele.'</option>';	
				$elemt_array = array('relation'=>array('rel_table'=>$tabel_config['table_name'],'key_val'=>$tabel_config['pri_key'],'key_disp'=>$tabel_config['disp_clm'],'rel_col_name'=>$tabel_config['rel_clm_name'],'rel_col_val'=>$currnet_val));
				
				if($this->tabel_config[$get_list]['table_name'] == 'city_master1')
				{
					if($this->tabel_config[$get_list]['table_name'] == 'city_master1')
					{
						$elemt_array_state = array('relation'=>array('rel_table'=>'state_master','key_val'=>$primary_key,'key_disp'=>'StateName','rel_col_name'=>'CountryId','rel_col_val'=>$currnet_val));
					}
					$data_array = $this->common_model->getRelationDropdown($elemt_array_state);					
					
					if(isset($data_array) && count($data_array) > 0)
					{
						foreach($data_array as $key=>$val)
						{
							$opt_group_name = $val;
							$str_ddr .= "<optgroup label= \"".$val."\" data-optgrpid=\"".$key."\" class=\"".str_replace(' ','',$val)."\">";
							$elemt_array = array('relation'=>array('rel_table'=>$tabel_config['table_name'],'key_val'=>$tabel_config['pri_key'],'key_disp'=>$tabel_config['disp_clm'],'rel_col_name'=>$tabel_config['rel_clm_name'],'rel_col_val'=>$key));	
							$opt_array1 = array();
							$data_array = $this->common_model->getRelationDropdown($elemt_array);
							if(isset($data_array) && count($data_array) > 0)
							{
								foreach($data_array as $key=>$val)
								{
									$selected_val_str ='';
									if(isset($selected_arr) && count($selected_arr) > 0 && in_array($key,$selected_arr))
									{
										$selected_val_str =' selected ';
									}
									$str_ddr.= '<option '.$selected_val_str.' data-optval="'.$key.'" value="'.$key.'">'.$val.'</option>';
									$opt_array1[] = array('id'=>$key,'val'=>$val);
								}
							}
							$str_ddr .= "</optgroup>";
							$opt_array[] = array('state'=>$opt_group_name,'city'=>$opt_array1);
						}
					}
				}
				else
				{
					$data_array = $this->common_model->getRelationDropdown($elemt_array);
					$str_ddr = '<option value="">Select '.$tabel_config['label'].'</option>';
					if(isset($data_array) && count($data_array) > 0)
					{
						foreach($data_array as $key=>$val)
						{
							$selected_val_str = '';
							if(isset($selected_arr) &&  count($selected_arr) > 0 && in_array($key,$selected_arr) && ($this->tabel_config[$get_list]['table_name'] != 'currency_master' || $this->tabel_config[$get_list]['table_name'] != 'skill_level_master'))
							{
								$selected_val_str =' selected ';
							}
							elseif(isset($selected_arr) &&  count($selected_arr) > 0 && in_array($val,$selected_arr) && ($this->tabel_config[$get_list]['table_name'] == 'currency_master' || $this->tabel_config[$get_list]['table_name'] == 'skill_level_master'))
							{
								$selected_val_str =' selected ';
							}
							if($this->tabel_config[$get_list]['table_name'] == 'currency_master'  || $this->tabel_config[$get_list]['table_name'] == 'skill_level_master')
							{ 
							  $str_ddr.= '<option '.$selected_val_str.' value="'.$val.'">'.$val.'</option>';
							}
							else
							{
								$str_ddr.= '<option '.$selected_val_str.' value="'.$key.'">'.$val.'</option>';
							}
							
							if($tocken_val  == 1)
							{
								$opt_array[] = array('value'=>$val,'lable'=>$val);
							}
							else
							{
								$opt_array[] = array('id'=>$key,'val'=>$val);
							}
						}
					}
				}
			}
		}
		if($retun_for == 'str')
		{
			return $str_ddr;
		}
		else
		{
		    if($tocken_val  == 1)
			{
				array_splice($opt_array, 0, 1);
			}
			return $opt_array;
		}
	}
	public function get_list_multiple($get_list='',$return_opt='json',$currnet_val='',$retun_for = 'str',$selected_val ='',$tocken_val  =0,$singmult  ='single')
	{
		$primary_key = $this->primary_key;
		$this->tabel_config= array(
			'city_list'=>array('table_name'=>'city_master','pri_key'=>$primary_key,'disp_clm'=>'CityName','label'=>'City','rel_clm_name'=>'CountryId'),
		);
		$str_ddr = '';
		$opt_array = array();
		if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] == $this->app_user_agent)
		{
			$opt_array[] = array('id'=>'','val'=>'Select Option');
		}
		else
		{
			$opt_array[] = array('id'=>'0','val'=>'Select Option');
		}
		if($this->input->post('get_list'))
		{
			$get_list = trim($this->input->post('get_list'));
		}
		if($this->input->post('multivar'))
		{
			$singmult = trim($this->input->post('multivar'));
		}
		if($this->input->post('retun_for'))
		{
			$retun_for = trim($this->input->post('retun_for'));
		}		
		if($this->input->post('tocken_val'))
		{
			$tocken_val = trim($this->input->post('tocken_val'));
		}
		if($this->input->post('currnet_val'))
		{
			if($singmult=='multi')
			{
				if($retun_for=='json')
				{
					if($this->input->post('currnet_val') && $this->input->post('currnet_val')!='')
					{
						$currnet_val = explode(',',$this->input->post('currnet_val'));		
					}
					else
					{
						$currnet_val = '';
					}
				}
				else
				{
					$currnet_val = $this->input->post('currnet_val');
				}
				
			}
			else
			{
				$currnet_val = trim($this->input->post('currnet_val'));
			}
		}
		
		if($get_list!='')
		{
			if(isset($this->tabel_config[$get_list]) && $this->tabel_config[$get_list] !='' && count($this->tabel_config[$get_list]) > 0)
			{ 
				$tabel_config = $this->tabel_config[$get_list];
				$label_sele = 'Select Option';
				if(isset($tabel_config['label']) && $tabel_config['label'] !='')
				{
					$label_sele = 'Select '.$tabel_config['label'];
				}
				if($tocken_val==0)
				{
					$str_ddr = '<option value="">'.$label_sele.'</option>';
				}
				$elemt_array = array('relation'=>array('rel_table'=>$tabel_config['table_name'],'key_val'=>$tabel_config['pri_key'],'key_disp'=>$tabel_config['disp_clm'],'rel_col_name'=>$tabel_config['rel_clm_name'],'rel_col_val'=>$currnet_val));
					if($selected_val!='')
					{
						$selected_val_array = explode(",",$selected_val);
					}
					else
					{
						$selected_val_array = array();
					}
					if($singmult=='multi')
					{	
						$data_array = $this->getdropdown_multi_sing($elemt_array);
					}
					else
					{
						$data_array = $this->common_model->getRelationDropdown($elemt_array);
					}
					if($tocken_val==0)
					{
						$str_ddr = '<option value="">Select '.$tabel_config['label'].'</option>';
					}
					else
					{
						$str_ddr = '';
					}
					if(isset($data_array) && count($data_array) > 0)
					{
						foreach($data_array as $key=>$val)
						{
							$selected_val_str = '';
							if(isset($selected_val_array) && $selected_val_array!=''  && is_array($selected_val_array) && in_array($key,$selected_val_array))
							{
								$selected_val_str =' selected ';
							}
							
							$str_ddr.= '<option '.$selected_val_str.' value="'.$key.'">'.$val.'</option>';
							if($tocken_val  == 1)
							{
								$opt_array[] = array('value'=>$val,'lable'=>$val);
							}
							else
							{
								$opt_array[] = array('id'=>$key,'val'=>$val);
							}
						}
					}
			}
		}
		if($retun_for == 'str')
		{
			return $str_ddr;
		}
		else
		{
		    if($tocken_val  == 1)
			{
				array_splice($opt_array, 0, 1);
			}
			return $opt_array;
		}
	}
	
	function getdropdown_multi_sing($element_array_val)
	{
		$return_arr = '';
		$value_curr = $this->get_value_mult($element_array_val,'value','');
		$relation_arr = $this->get_value_mult($element_array_val,'relation','');
		if(isset($relation_arr) && $relation_arr !='' && count($relation_arr) > 0)
		{
			if(isset($relation_arr['rel_table']) && $relation_arr['rel_table'] !='' && isset($relation_arr['key_val']) && $relation_arr['key_val'] !='' && isset($relation_arr['key_disp']) && $relation_arr['key_disp'] !='' )
			{
				$select_field = $relation_arr['key_disp'].', '.$relation_arr['key_val'];
				
				$where_close = array();
				if($value_curr !='')
				{
					$where_close[] = $relation_arr['key_val']." = '".$value_curr."' ";
				}
				$status_filed = 'status';
				$status_val = 'APPROVED';
				if(isset($relation_arr['status_filed']) && $relation_arr['status_filed'] !='')
				{
					$status_filed = $relation_arr['status_filed'];
				}
				if(isset($relation_arr['status_val']) && $relation_arr['status_val'] !='')
				{
					$status_val = $relation_arr['status_val'];
				}
				if($status_filed !='' && $status_val !='')
				{
					$where_close[] = $status_filed." = '".$status_val."' ";
				}
				if(isset($where_close) && $where_close !='' && count($where_close) > 0 )
				{
					$where_close_str = implode(" OR ",$where_close);
					$this->db->where(" ( $where_close_str ) ");
				}	
				if(isset($relation_arr['rel_col_name']) && $relation_arr['rel_col_name'] !='' && isset($relation_arr['rel_col_val']) && $relation_arr['rel_col_val'] !='' && count($relation_arr['rel_col_val']) > 0)
				{
					//$this->db->where($relation_arr['rel_col_name'],$relation_arr['rel_col_val']);
					$this->db->where_in($relation_arr['rel_col_name'], $relation_arr['rel_col_val']);
					$row_data = $this->get_count_data_manual($relation_arr['rel_table'],"",2,$select_field,$relation_arr['key_disp'].' ASC ',0,'','');
				}
				$return_arr = array();
				if(isset($row_data) && $row_data !='' && count($row_data) > 0)
				{
					foreach($row_data as $row_data_val)
					{
						$return_arr[$row_data_val[$relation_arr['key_val']]] = $row_data_val[$relation_arr['key_disp']];
					}
				}
			}
		}
		return $return_arr;
	}
	
	function get_value_mult($element_array_val,$key='value',$defult='')
	{
		$value_curr = $defult;
		if(isset($element_array_val[$key]) && $element_array_val[$key] !='')
		{
			$value_curr = $element_array_val[$key];
		}
		return $value_curr;
	}
	
	public function get_country_code($return = '')
	{
		$where_arra = array($this->status_field=>$this->status_field_act_val,$this->is_delete_fild=>$this->is_delete_fild_val,"country_code!=''");		
		$data_arr = $this->get_count_data_manual('country_master',$where_arra,2,'country_code,country_name','','','',"");
		if($return == '')
		{
			return $data_arr;
		}
		else
		{
			$opt_array = array();
			if(isset($data_arr) && $data_arr !='' && count($data_arr) > 0)
			{
				if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] == $this->app_user_agent)
				{
					$opt_array[] = array('id'=>'','val'=>'Select Option');
				}
				else
				{
					$opt_array[] = array('id'=>'0','val'=>'Select Option');
				}
				foreach($data_arr as $data_arr_val)
				{
					$opt_array[] = array('id'=>$data_arr_val['country_code'],'val'=>$data_arr_val['country_code'].' ('.$data_arr_val['country_name'].')');
				}
			}
			return $opt_array;
		}
	}
			
		
	public function set_orgin()
	{
		 header('Access-Control-Allow-Origin: *');
	     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		 if (isset($_SERVER['HTTP_ORIGIN']))
		 {
			//header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		 }
     // Access-Control headers are received during OPTIONS requests
 	   	 if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
		 {
        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");         
 
        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        	exit(0);
	     }
		//$this->output->set_header('Access-Control-Allow-Origin: *');
	}
	
	public function get_user_id($return_session ='id',$app_return='member_id')
	{
		$member_id='';
		if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] ==$this->app_user_agent)
		{
			if(isset($_REQUEST[$app_return]) && $_REQUEST[$app_return] !='')
			{
				$member_id = $_REQUEST[$app_return];
			}
		}
		else
		{
			$member_id = $this->common_front_model->get_session_data($return_session);
		}
		return $member_id;
	}
	public function return_jsone_response($status='',$data='',$message='',$message_name='errmessage')
	{
		$data1 = array();
		$data1['token'] = $this->security->get_csrf_hash();
		$data1['tocken'] = $this->security->get_csrf_hash();
		if($message !='')
		{
			$data1[$message_name] =  $message;
		}
		if($status !='')
		{
			$data1['status'] = $status;
		}
		if($data !='')
		{
			$data1['data'] = $data;
		}
		else{
			$data1['data'] = "No data available";
		}
		$data['data'] = json_encode($data1);
		return $data;
	}	
	// for blog
	public function get_blog_list($return_type = 0,$page_number=1)
	{
		$where_arra = array('Status'=>'A');
		if($return_type == 0)
		{
			$return_type = 0;
		}
		else
		{
			$return_type = 2;
		}
	    $causes_arr = $this->common_model->get_count_data_manual('blog',$where_arra,$return_type,'','ID DESC',$page_number);
		return $causes_arr;
	}
	public function blog_detail($alias = '')
	{
		$causes_arr = '';
		if($alias !='')
		{
			$alias = $this->common_model->alias_replace($alias);
			$where_arra = array('Status'=>'A','Alias'=>$alias);
			$causes_arr = $this->common_model->get_count_data_manual('blog',$where_arra,1);
		}
		return $causes_arr;
	}
	// for blog
	
	// for news
	public function get_news_list($return_type = 0,$page_number=1)
	{
		$where_arra = array('Status'=>'A');
		if($return_type == 0)
		{
			$return_type = 0;
		}
		else
		{
			$return_type = 2;
		}
	    $news_arr = $this->common_model->get_count_data_manual('news',$where_arra,$return_type,'','ID DESC',$page_number);
		return $news_arr;
	}
	public function news_detail($alias = '')
	{
		$causes_arr = '';
		if($alias !='')
		{
			$alias = $this->common_model->alias_replace($alias);
			$where_arra = array('Status'=>'A','Alias'=>$alias);
			$news_arr = $this->common_model->get_count_data_manual('news',$where_arra,1);
		}
		return $news_arr;
	}
	// for news
	// for gallery
	public function get_gallery_list($return_type = 0,$page_number=1)
	{
		$where_arra = array('Status'=>'A');
		if($return_type == 0)
		{
			$return_type = 0;
		}
		else
		{
			$return_type = 2;
		}
	    $causes_arr = $this->common_model->get_count_data_manual('gallery_master',$where_arra,$return_type,'','ID DESC',$page_number);
		return $causes_arr;
	}
	
	public function get_video_gallery_list($return_type = 0,$page_number=1)
	{
		$where_arra = array('Status'=>'A');
		if($return_type == 0)
		{
			$return_type = 0;
		}
		else
		{
			$return_type = 2;
		}
	    $causes_arr = $this->common_model->get_count_data_manual('video_gallery_master',$where_arra,$return_type,'','ID DESC',$page_number);
		return $causes_arr;
	}
	
	// for news
	public function get_volunteers_list($return_type = 0,$page_number=1)
	{
		$where_arra = array('Status'=>'A');
		if($return_type == 0)
		{
			$return_type = 0;
		}
		else
		{
			$return_type = 2;
		}
	    $news_arr = $this->common_model->get_count_data_manual('volunteer',$where_arra,$return_type,'','ID DESC',$page_number);
		return $news_arr;
	}
	public function volunteers_detail($alias = '')
	{
		$causes_arr = '';
		if($alias !='')
		{
			$where_arra = array('Status'=>'A','ID'=>$alias);
			$news_arr = $this->common_model->get_count_data_manual('volunteer',$where_arra,1);
		}
		return $news_arr;
	}
	// for news
}
/**/

