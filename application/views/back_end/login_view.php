<!DOCTYPE html>
<html class=no-js>
<head>
<meta charset=utf-8>
<title><?php if(isset($config_data['FriendlyName']) && $config_data['FriendlyName'] !=''){ echo $config_data['FriendlyName']; } ?> - Login</title>
<meta name=viewport content="width=device-width">
<?php if(isset($config_data['SiteFavicon']) && $config_data['SiteFavicon'] !=''){
?>
<link rel="shortcut icon" href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>">
<?php } 
$data_session = $this->session->userdata(ADMINSESSION);
?>
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/plugins.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/main.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/themes.css">
<script src="<?php echo $base_url; ?>assets/back_end/js/vendor/modernizr.min.js"></script>

<body>
 <div id="login-background">           
    <img src="<?php echo $base_url;?>assets/back_end/img/placeholders/headers/login_header.jpg" alt="Login Background" class="animation-pulseSlow">
 </div>
 <div id="login-container" class="animation-fadeIn" style="top:85px">
            <!-- Login Title -->
            <div class="login-title text-center">
            	<?php 
			  		echo '<h1>Login Panel</h1>';
			  
			  ?>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <form action="<?php echo $base_url.$admin_path.'/login/check_login';?>" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                 	<div class="form-group">
                	<?php
					if($this->session->flashdata('user_log_err'))
					{
					?>
					<div class="alert alert-danger"><?php
						echo $this->session->flashdata('user_log_err'); ?>
					</div>
					<?php
						}
					?>
					<div class="alert alert-danger" id="login_message" style="display:none"></div>
					<?php
						if($this->session->flashdata('user_log_out'))
						{
					?>
					<div class="alert alert-success" id="log_out_succ">
						<?php echo $this->session->flashdata('user_log_out'); ?>
					</div>
					<?php
						}
					?>
                    </div> 
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <div class="input-group">
                            	<img src="<?php echo $base_url; ?>captcha.php?captch_code=<?php echo $this->session->userdata['captcha_code']; ?>" /> 
                            </div>
                        </div>
                        <div class="col-xs-8">
                        	<div class="input-group">
	                        	<input required type="text" name="code_captcha" id="code_captcha" class="form-control input-lg" placeholder="Enter Captcha Code" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <!--<div class="col-xs-4">
                            <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me" checked>
                                <span></span>
                            </label>
                        </div>-->
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to Dashboard</button>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-xs-12 text-center">
                            <a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a>                        </div>
                    </div>-->
                    <input class="hash_tocken_id" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id_login" />
                </form>
                <!-- END Login Form -->

                <!-- Reminder Form -->
                <form action="<?php echo $base_url.$admin_path.'/login/check_email_forgot';?>" method="post" id="form-reminder" class="form-horizontal form-bordered form-control-borderless display-none">
                	<div class="alert alert-danger" id="check_email_message" style="display:none"></div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="reminder-email" name="reminder-email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Reset Password</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <small>Did you remember your password?</small> <a href="javascript:void(0)" id="link-reminder"><small>Login</small></a>
                        </div>
                    </div>
             		<input class="hash_tocken_id" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id_reset" />
             		<input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url.$admin_path; ?>/" />
                </form>                
            </div>
            <footer class="text-muted text-center">
                <small><span><?php echo $config_data['CopyRightContent'];?></span></small>
            </footer>
            <!-- END Footer -->
        </div>
    <div id="lightbox-panel-mask"></div>
    <div id="lightbox-panel-loader" style="text-align:center"><img alt="Please wait.." title="Please wait.." src='<?php echo $base_url; ?>assets/back_end/images/loading.gif' /></div>

	<script src="<?php echo $base_url; ?>assets/back_end/js/vendor/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/back_end/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/back_end/js/plugins.js"></script>
    <script src="<?php echo $base_url; ?>assets/back_end/js/app.js"></script>
    
    <script src="<?php echo $base_url; ?>assets/back_end/js/pages/login.js"></script>
    <script>$(function(){ Login.init(); });</script>

	<script src="<?php echo $base_url; ?>assets/back_end/js/common.js"></script>
	<!--<script src="<?php echo $base_url; ?>assets/back_end/vendor/jquery-validation/dist/jquery.validate.min.js"></script>-->
	<script type="text/javascript">
		/*$("#login_form").validate({
		  submitHandler: function(form) 
		  {
			//form.submit();
			check_validation();
		  }
		});*/
		function check_validation()
		{
			var username = $("#login-email").val();
			var password = $("#login-password").val();        
			var code_captcha = $("#code_captcha").val();
			show_comm_mask();
			var hash_tocken_id = $("#hash_tocken_id_login").val();
			var base_url = $("#base_url").val();
			var url = base_url+"login/check_login";
			$("#log_out_succ").hide();
			$.ajax({
			   url: url,
			   type: "post",
			   data: {'username':username,'password':password,'<?php echo $this->security->get_csrf_token_name(); ?>':hash_tocken_id,'is_post':0,'code_captcha':code_captcha},
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
						update_tocken(data.token);

					}
					hide_comm_mask();
			   }
			});
			return false;
		}
	</script>