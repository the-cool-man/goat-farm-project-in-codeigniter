<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function check_login()
	{
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$password_md5 = md5($password);
		$where_arra = array(
			'Email'=>$username,
			'Password'=>$password_md5
		);
		$row_data = $this->common_model->get_count_data_manual('admin_login',$where_arra,1);
		$return_message = "";
		$status = 'error';		
		if(isset($row_data) && $row_data !='' && count($row_data) > 0)
		{
			$login_dt = $this->common_model->getCurrentDate();
			$status  = 'success';
			$ip = $this->input->ip_address();
			$data_array = array('AccessedOn'=>$login_dt,'IpAddress'=>$ip,'UserID'=>$row_data['ID'],'UserType'=>'Admin');
			$row_data1 = $this->common_model->update_insert_data_common('access_location', $data_array, '',0);
			$this->session->set_userdata(ADMINSESSION, $row_data);
		}
		else
		{
			$return_message = "Your username and password is wrong. Please try again...";
		}
		$return_arr = array('status'=>$status,'errmessage'=>$return_message,'token'=>$this->security->get_csrf_hash());
		return $return_arr;
	}
	public function check_reset_forgot_password()
	{
		$username = trim($this->input->post('username'));
		$username_where = " ( Email ='$username') ";
		$this->db->select('*');
		$this->db->where($username_where);
		$this->db->where('IsDeleted','N');
		$this->db->limit(1);
		$query = $this->db->get('admin_login');
		$return_message = "";
		$status = 'error';
		if($query->num_rows() == 1)
		{
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$row_data = $query->row_array();
			$password_md5 = md5($password);
			
			$user_data_array = array(
				'user_name'	=> $row_data['Username'],
				'uname'		=> $row_data['Username'],
				'uid'		=> $row_data['ID'],
				'email'		=> $row_data['Email'],
			);
			
			$this->db->set('Password', $password_md5);
			$this->db->where('ID', $row_data['ID']);
			$this->db->update('register');
			$status = 'success';
			$data_email = array(
				'password'=>$password,
				'email'=>$row_data['Email'],
				'username'=>$row_data['Username']
			);
			$this->forgot_email_send($data_email);
			$return_message = 'New Password has been sent to your email id, Please check your Email Inbox.';
		}
		else
		{
			$return_message = "Your have enter Wrong Email Address. Please enter valid email address and Try again...";
		}
		$return_arr = array('status'=>$status,'errmessage'=>$return_message,'token'=>$this->security->get_csrf_hash());
		return json_encode($return_arr);
	}
	public function forgot_email_send($data_email)
	{
		$config_arra = $this->common_model->get_site_config();
		$webfriendlyname = $config_arra['FriendlyName'];
		$username = $data_email['username'];
		$email = $data_email['email'];
		$pswd = $data_email['password'];
		$date = date('Y-m-d');
		$message = "<html>
					<head>
					<title><h1>Your new password</h1></title>
					</head>
					<body>
						<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
						  <tbody>
						  <tr>
							<td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
							  <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
								<tbody>
									<tr style='background:#f9f9f9'>
										<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
											<span tabindex='0' class='aBn' data-term='goog_849968294'>
											<span class='aQJ'>$date</span></span></td>
							<td style='float:left;margin-top:30px;color:#048c2e;font-size:26px;padding-left:15px'>$webfriendlyname</td>
							
						  </tr>
						  
						</tbody></table>
							</td>
						  </tr>
						  <tr>
							<td style='float:left;width:710px;min-height:auto'>
							
							<h6 style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px'>Hello, $username</h6><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Message : Your forgot password request has been received in our system.Given below is your profile login details,</p>
								<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'><b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>Matri ID : $matri_id (or) <a style='text-decoration:none;color:#096b53;outline:none'>$email</a><br>New Password : $pswd </b></p>
							<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thanks & Regards ,<br>Team At $webfriendlyname</p>
							
							</td>
						  </tr>
						</tbody></table>
					</body>
					</html>";
		$to_email = $email;
		$subject  = 'Your new password -'.$webfriendlyname;
		if($to_email !="" && $message !="")
		{
			$msg = $this->common_model->common_send_email($to_email,$subject,$message);
		}
	}
}