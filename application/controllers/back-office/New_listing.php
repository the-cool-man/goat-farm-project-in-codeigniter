<?php defined('BASEPATH') OR exit('No direct script access allowed');
class New_listing extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->common_model->checkLogin(); // here check for login or not
	}
	public function index()
	{
		$this->city_list();
	}
		
	public function country_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'CountryName'=>array('is_required'=>'required','check_duplicate'=>'Yes'),
			'CountryCode'=>array('is_required'=>'required'),
			'Status'=>array('type'=>'radio')
		);
		$other_config = array(
			'field_duplicate'=>array('CountryName'),
			/*'addAllow'=>'no',
			'display_status'=>'no',
			'editAllow'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no'*/
		);
		$this->common_model->common_rander('country_master', $status, $page , 'Country',$ele_array,'CountryName',1,$other_config);
	}
	
	public function mm_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'oldvalue'=>array('is_required'=>'required'),
			'status'=>array('type'=>'radio')
		);
		$this->common_model->common_rander('edit_history', $status, $page , 'Heading',$ele_array,'newvalue',0);
	}
	
	public function state_list($status ='ALL', $page =1)
	{
		$ele_array = array(			
			'CountryID'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown','relation'=>array('rel_table'=>'country_master','key_val'=>'id','key_disp'=>'CountryName')),	// for relation dropdown
			'StateName'=>array('is_required'=>'required'),
			'Status'=>array('type'=>'radio')
		);
		
		$join_tab_array = array();
		$join_tab_array[] = array( 'rel_table'=>'country_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'CountryName','rel_filed_org'=>'CountryID');
		$this->common_model->dup_where_con = 'and';
		$other_config = array('default_order'=>'DESC','filed_notdisp'=>array(),'field_duplicate'=>array('CountryID','StateName'));
		$this->common_model->common_rander('state_master', $status, $page , 'State',$ele_array,'StateName',1,$other_config,$join_tab_array);
	}	
	public function city_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'CountryId'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown','onchange'=>"dropdownChange('countryid','stateid','state_list')",
			'relation'=>array('rel_table'=>'country_master','key_val'=>'ID','key_disp'=>'CountryName')),	// for relation dropdown
			'StateId'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'ID','key_disp'=>'StateName')),	// for relation dropdown
			'CityName'=>array('is_required'=>'required'),
			'Status'=>array('type'=>'radio')
		);
		
		$join_tab_array = array();
		$join_tab_array[] = array( 'rel_table'=>'state_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'StateName','rel_filed_org'=>'StateId');
		$this->common_model->dup_where_con = 'and';
		$join_tab_array[] = array( 'rel_table'=>'country_master', 'rel_filed'=>'ID', 'rel_filed_disp'=>'CountryName',			'rel_filed_org'=>'CountryId','join_manual'=>' country_master.ID = state_master.CountryId ');
		
		$other_config = array('default_order'=>'ASC','field_duplicate'=>array('CountryId','StateId','CityName'));
		$this->common_model->common_rander('city_master', $status, $page , 'City',$ele_array,'CityName',1,$other_config,$join_tab_array);
	}
	
	public function currency_man($status ='ALL', $page =1)
	{
		$ele_array = array(
			'CurrencyName'=>array('is_required'=>'required'),
			'CurrencyCode'=>array('is_required'=>'required'),
			'Status'=>array('type'=>'radio')
		);
		$other_config = array('field_duplicate'=>array('CurrencyName'));
		$this->common_model->common_rander('currency', $status, $page , 'Currency',$ele_array,'CurrencyName',1,$other_config);
	}
}