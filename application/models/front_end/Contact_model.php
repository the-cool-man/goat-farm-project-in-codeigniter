<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function validate_form()
	{
		$this->load->library('form_validation');
		$page_type = 'contact';
		if(isset($_REQUEST['page_type']) && $_REQUEST['page_type'] !='')
		{
			$page_type = $_REQUEST['page_type'];
		}
		if($page_type == 'contact')
		{
			$this->form_validation->set_rules('username', 'Name', 'required');
		}

		if($page_type == 'contact')
		{
			$this->form_validation->set_rules('contact', 'Contact No', 'required');
		}
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		$user_agent = 'NI-WEB';
		if($this->input->post('user_agent'))
		{
			$user_agent = $this->input->post('user_agent');
		}		
		$data1['token'] = $this->security->get_csrf_hash();
		if ($this->form_validation->run() == FALSE)
        {
			$data1['errmessage'] =  validation_errors();
			$data1['status'] = 'error';
		}
		else
		{
			$this->contact_email_send($page_type);
			$data1['errmessage'] =  "Contact request submitted successfully.";
			$data1['status'] = 'success';
		}
		return $data1;
	}
	public function contact_email_send($page_type)
	{
		// Working for send contact us email to admin
		$config_arra = $this->common_model->get_site_config();
		$web_name = $config_arra['WebUrl'];
		$webfriendlyname = $config_arra['FriendlyName'];
		$contact_email = $config_arra['ToEmail'];
		$description = $this->input->post('message');		
		if($page_type == 'contact')
		{
			$name 	= $this->input->post('username');			
			$phone 	= $this->input->post('contact');

			$memmmm="
					Name : $name<br />
					Contact No : $phone<br />
					Message : $description<br />";
		}
		
		
		
		$message= "<html>
					<body>
						<p>Dear admin,</p>
						<p>This mail is to inform you that someone has tried to contact you from your website $webfriendlyname.</p>
						
						<p>Following are the details that has been provided by sender.</p>
						
						<p>$memmmm
						</p>
						<br /><br />
						<p>Regards ,<br />
						   $webfriendlyname
					    </p>
					</body>
					</html>";
		$subject  = "$name sent you an enquiry on $webfriendlyname";
		if($contact_email !="" && $message !="")
		{
			$this->common_model->common_send_email($contact_email,$subject,$message);
		}
	}
}