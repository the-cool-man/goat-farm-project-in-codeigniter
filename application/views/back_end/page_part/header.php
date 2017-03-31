<!DOCTYPE html>
<html class=no-js>
<head>
	<meta charset="utf-8" />
	<title><?php if(isset($page_title) && $page_title !=''){ echo $page_title;} ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width" />
	<?php if(isset($config_data['SiteFavicon']) && $config_data['SiteFavicon'] !=''){ ?>
		<link rel="shortcut icon" href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" />
	<?php } ?>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    	
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/plugins.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/main.css?ver=1">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/back_end/css/themes.css">
    <script src="<?php echo $base_url; ?>assets/back_end/js/vendor/modernizr.min.js"></script>
    
	<?php
	if(isset($this->common_model->extra_css) && $this->common_model->extra_css !='' && count($this->common_model->extra_css) > 0)
	{
		$extra_css = $this->common_model->extra_css;
		foreach($extra_css as $extra_css_val)
		{
	?>
	    <link rel="stylesheet" href="<?php echo $base_url.'assets/back_end/'.$extra_css_val; ?>" />
	<?php
		}
	}
	?>
</head>
<body>	
	 <div id="page-wrapper">
             
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">                 
                <div id="sidebar">
                    <div id="sidebar-scroll">
                        <div class="sidebar-content">                            
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                               <span>   <b>Welcome,</b> 
                                    <?php
                                        $user_daat = $this->common_model->get_session_data();
                                        $Username_dip = 'Admin';
                                        if(isset($user_daat['Username']) && $user_daat['Username'] !='')
                                        {
                                            
                                            echo 'Mr. '.$Username_dip = $user_daat['Username'];
                                        }
                                    ?>
                               </span>
                            </div>
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="<?php echo $base_url.$admin_path.'/dashboard';?>" <?php if(isset($page_title) && $page_title =='Dashboard'){ echo 'class="active"';} ?> ><i class="fa fa-tachometer sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                                <li id="site_setting">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Site Settings</span></a>
                                    <ul>
                                     	<li> <a id="logo_favicon" href="<?php echo $base_url.$admin_path.'/site-setting/logo-favicon';?>"> <span>Logo &amp; Favicon</span> </a> </li>
                                        <li> <a id="update_email" href="<?php echo $base_url.$admin_path.'/site-setting/update-email';?>"> <span>Email Settings</span> </a> </li> 
                                        <li> <a id="basic_setting" href="<?php echo $base_url.$admin_path.'/site-setting/basic-setting';?>"> <span>Basic Site Settings</span> </a> </li>
                                         <li> <a id="change_password" href="<?php echo $base_url.$admin_path.'/site-setting/change-password';?>"> <span>Change Password</span> </a> </li>
                                        <li> <a id="social_site_setting" href="<?php echo $base_url.$admin_path.'/site-setting/social-site-setting';?>"> <span>Social Media Link</span> </a> </li>
                                        <li> <a id="analytics_code_setting" href="<?php echo $base_url.$admin_path.'/site-setting/analytics-code-setting';?>"> <span>Google Analytics Code</span> </a> </li>
                                        <li> <a id="homepage_banners" href="<?php echo $base_url.$admin_path.'/site-setting/homepage-banners';?>"> <span>Home Page Banners</span> </a> </li>
                                        
                                        
                                    </ul>
                                </li>
                                <li id="breed">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Goat Breed</span></a>
                                    <ul>
                                       <li> <a id="breed_list" href="<?php echo $base_url.$admin_path.'/breed/breed_list';?>"> <span>All Goat Breed</span> </a> </li>                           
                                    </ul>
                                </li>
								
								<li id="gallery">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Gallery Management</span></a>
                                    <ul>
                                        <li id="photo_list">
											<a href="<?php echo $base_url.$admin_path.'/gallery/photo-list';?>"><i class="fa fa-photo sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Photo Gallery</span></a>
										</li>

										<li id="video_list">
											<a href="<?php echo $base_url.$admin_path.'/gallery/video-list';?>"><i class="fa fa-photo sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Video Gallery</span></a>
										</li>                         
                                    </ul>
                                </li>
                                
                                
                               
                                
                                
                                <li id="content_management">
                                    <a href="<?php echo $base_url.$admin_path.'/content-management/cms-pages';?>"><i class="fa fa-bars sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Content Management</span></a>
                                </li>
                                
                               
                              
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="main-container">                    
                    <header class="navbar navbar-default">                       
                         <ul class="nav navbar-nav-custom">
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li>
                            <li><a><?php echo $this->common_model->label_page; ?></a></li>
                         </ul>   
                        <ul class="nav navbar-nav-custom pull-right">
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <b>My Account <i class="fa fa-angle-down"></i></b>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li>
                                                                          
                                        <a href="<?php echo $base_url.$admin_path;?>/site-setting/basic-setting" data-toggle="modal">
                                            <i class="fa fa-cog fa-fw pull-right"></i> Settings
                                        </a>
                                         <a href="<?php echo $base_url;?>" target="_blank">
                                            <i class="fa fa-reply pull-right"></i>Front End
                                        </a>  
                                    </li>
                                    <li class="divider"></li>
                                    <li>
          								<a class="alert alert-danger" href="<?php echo $base_url.$admin_path;?>/login/log_out"><i class="fa fa-power-off pull-right"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </header>
                    <div id="page-content">