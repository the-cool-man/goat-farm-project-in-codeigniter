<!DOCTYPE html>
<html class=no-js>
<head>
<meta charset=utf-8>
<title><?php if(isset($config_data['FriendlyName']) && $config_data['FriendlyName'] !=''){ echo $config_data['FriendlyName']; } ?> - Forgot Password</title>
<meta name=viewport content="width=device-width">
<?php if(isset($config_data['SiteFavicon']) && $config_data['SiteFavicon'] !=''){
?>
<link rel="shortcut icon" href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>">
<?php } 
$data_session = $this->session->userdata(ADMINSESSION);
?>
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/styles/app.min.df5e9cc9.css">
<body>
<div class="app layout-fixed-header bg-white usersession">
  <div class=full-height>
    <div class=center-wrapper>
      <div class=center-content>
        <div class="row no-margin">
          <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <form id="login_form" method="post" role="form" action="<?php echo $base_url.$admin_path.'login/check_login';?>" class="form-layout" ><!--onSubmit="return check_validation()"-->
            	<input type="hidden" name="is_post" id="is_post" value="1" />
              <div class="text-center mb15"> 
              <?php 
			  if(isset($config_data['upload_logo']) && $config_data['upload_logo'] !=''){ ?>
              <img src="<?php echo $base_url.'assets/logo/'.$config_data['upload_logo']; ?>"/> 
              <?php
			  }
			  else
			  {
				  echo $config_data['FriendlyName'];
			  }
			  ?>
              </div>
              <p class="text-center mb30">
              Welcome to <?php if(isset($config_data['FriendlyName']) && $config_data['FriendlyName'] !=''){ echo $config_data['FriendlyName']; } ?>, Please enter your email to get Change Password Link</p>
			 <div class="alert alert-danger" id="login_message" style="display:none"></div>
             <div class="alert alert-success" id="login_message_succ" style="display:none"></div>
             <div class=form-inputs>
                <input required type="email" name="username" id="username" class="form-control input-lg" placeholder="Email Address" value="" />
              	<button class="btn btn-success btn-block btn-lg mb15" type="submit"> Send Password Reset </button>
             </div>
             <p> <a href="<?php echo $base_url.$admin_path.'/login/index';?>">Back to Login</a> </p>
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id" />
             <input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url.$admin_path; ?>/" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="lightbox-panel-mask"></div>
<div id="lightbox-panel-loader" style="text-align:center"><img alt="Please wait.." title="Please wait.." src='<?php echo $base_url; ?>assets/back_end/images/loading.gif' /></div>
<script src="<?php echo $base_url; ?>assets/back_end/scripts/app.min.4fc8dd6e.js"></script>
<script src="<?php echo $base_url; ?>assets/back_end/scripts/common.js"></script>
<script src="<?php echo $base_url; ?>assets/back_end/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$("#login_form").validate({
  submitHandler: function(form) 
  {
	//form.submit();
	check_validation();
  }
});
function check_validation()
{
    var username = $("#username").val();
    show_comm_mask();
    var hash_tocken_id = $("#hash_tocken_id").val();
    var base_url = $("#base_url").val();
    var url = base_url+"login/check_email_forgot";
	$("#log_out_succ").hide();
    $.ajax({
       url: url,
       type: "post",
       data: {'username':username,'<?php echo $this->security->get_csrf_token_name(); ?>':hash_tocken_id,'is_post':0},
       dataType:"json",
       success:function(data)
       {
            //alert(data.status);
            if(data.status == 'success')
            {
                window.location.href = base_url+"dashboard";
                return false;
            }
            else
            {
                $("#login_message").html(data.errmessage);
                $("#login_message").slideDown();
                $("#hash_tocken_id").val(data.token);
            }
            hide_comm_mask();
       }
    });
    return false;
}
</script>