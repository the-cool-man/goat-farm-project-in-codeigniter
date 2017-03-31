<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SiteSetting_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function save_change_password()
	{
		
		$user_data = $this->common_model->get_session_data();
		if($this->input->post('success_url'))
		{
			$this->success_url = $this->input->post('success_url');
		}
		if($this->input->post('password') && $this->input->post('new_password'))
		{			
			$old_pass = md5(trim($this->input->post('password')));
			$new_pass = md5(trim($this->input->post('new_password')));
			
			$where_arr = array('Password' => $old_pass,'id'=>$user_data['ID']);
			$row_data = $this->common_model->get_count_data_manual('admin_login',$where_arr,0,'ID');
			if(isset($row_data) && $row_data > 0)
			{
				$where_arr = array('ID'=>$user_data['ID']);
				$data_array = array('Password'=>$new_pass);
				$response = $this->common_model->update_insert_data_common('admin_login',$data_array,$where_arr);
				$this->session->set_flashdata('success_message', 'Your password successfully changed.');
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please enter correct old password.');
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', ' Please enter password.');
		}
	}
	function update_color( )
	{
		if($this->input->post('colour_name'))
		{			
			$colour_name = trim($this->input->post('colour_name'));
			$rgba_color = $this->hex2rgb($colour_name);
			$temp = file_get_contents("assets/front_end/css/colors/custom_scss.css");
			$temp_arr = array("#color_code#"=>$colour_name,"#color_code_rgba#"=>$rgba_color);
			
			$final_css = strtr($temp,$temp_arr);
			file_put_contents("assets/front_end/css/colors/custom.css",$final_css);
		}
		$this->session->set_flashdata('success_message', 'Your have successfully changed color for main site.');
	}
	function hex2rgb( $colour )
	{
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        //return array( 'red' => $r, 'green' => $g, 'blue' => $b );
		$temp_val = $r.','.$g.','.$b;
		return $temp_val;
	}
}