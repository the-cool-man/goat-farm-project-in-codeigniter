<?php if(isset($config_data['SiteTitle']) && $config_data['SiteTitle'] !='' && $page_title =='')
{ 
	$page_title = $config_data['SiteTitle'];
}
if(isset($config_data['SiteDescription']) && $config_data['SiteDescription'] !='' && (!isset($website_description) || $website_description ==''))
{
	$website_description = $config_data['SiteDescription'];
}
if(isset($config_data['SiteKeyword']) && $config_data['SiteKeyword'] !='' && (!isset($website_keywords) || $website_keywords ==''))
{ 
	$website_keywords = $config_data['SiteKeyword'];
}
?>

<!DOCTYPE html>
<html lang="en-US" class="scheme_original">



<head>
<title><?php if(isset($page_title) && $page_title !=''){ echo $page_title;}?></title>
<meta name="description" content="<?php if(isset($website_description) && $website_description !=''){ echo $website_description;}?>">
<meta name="keywords" content="<?php if(isset($website_keywords) && $website_keywords !=''){ echo $website_keywords;}?>" />

<meta property="og:title" content="<?php echo $page_title; ?>" />
<?php if(isset($og_img) && $og_img !='' && file_exists($og_img))
{ ?>
<meta property="og:image" content="<?php echo $base_url.$og_img; ?>" />
<?php 
}
if(isset($og_description) && $og_description !='')
{ ?>
<meta property="og:description" content='<?php echo $og_description; ?>' />
<?php } ?>

<?php if(isset($config_data['SiteFavicon']) && $config_data['SiteFavicon'] !=''){ ?>
<!-- Favicon and Touch Icons -->
<link href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" rel="shortcut icon" type="image/png">
<link href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" rel="apple-touch-icon">
<link href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" rel="apple-touch-icon">
<link href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" rel="apple-touch-icon">
<link href="<?php echo $base_url.'assets/logo/'.$config_data['SiteFavicon']; ?>" rel="apple-touch-icon">
<?php } ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Average|Droid+Serif:400,700|Libre+Baskerville:400,400i,700|Open+Sans:300,400,600,700,800|Oswald:300,400,700|Raleway:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/layout.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/woo/woocommerce-layout.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/woo/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/woo/woocommerce.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/core.animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/theme.css?ver=1' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/woo/plugin.woocommerce.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/custom.css' type='text/css' media='all' /> 
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/comp/comp.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="all">
	<link rel='stylesheet' href='<?php echo $base_url;?>assets/front_end/js/vendor/prettyPhoto/prettyPhoto.css' type='text/css' media='all' />
    
    <script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/jquery/jquery.js'></script>
	<?php
	if(isset($this->common_model->extra_css_fr) && $this->common_model->extra_css_fr !='' && count($this->common_model->extra_css_fr) > 0)
	{
		$extra_css = $this->common_model->extra_css_fr;
		foreach($extra_css as $extra_css_val)
		{
	?>
	    <link rel="stylesheet" href="<?php echo $base_url.'assets/back_end/'.$extra_css_val; ?>" />
	<?php
		}
	}
	?>
</head>

<body class="index home page body_style_wide body_filled article_style_stretch layout_single-standard template_single-standard scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide vc_responsive">


<div class="body_wrap">
    <div class="page_wrap">
        <div class="top_panel_fixed_wrap"></div>
        <header class="top_panel_wrap top_panel_style_4 scheme_original">
            <div class="top_panel_wrap_inner top_panel_inner_style_4 top_panel_position_above">
                <div class="top_panel_middle">
                    <div class="content_wrap">
                        <div class="contact_logo">
                            <div class="logo">
                            
                             <?php
    $logo_url = 'assets/front_end/logo/logo.png';
    if(isset($config_data['SiteLogo']) && $config_data['SiteLogo'] !='')
    {
		$logo_url = 'assets/logo/'.$config_data['SiteLogo'];
    }
	$page_name_menu = 'home';
	if(isset($page_name) && $page_name !='')
	{
		$page_name_menu = $page_name;
	}
	else
	{
		$page_name_menu = $this->common_model->class_name;
	}
	?>
    
                                <a href="<?php echo $base_url;?>">
                                    <img src="<?php echo $base_url.$logo_url;?>" class="logo_main" alt="<?php echo $page_title;?>">
                                    <img src="<?php echo $base_url.$logo_url;?>" class="logo_fixed" alt="<?php echo $page_title;?>">
                                </a>
                            </div>
                        </div>
                        
                        <div class="menu_main_wrap">
                            <nav class="menu_main_nav_area menu_hover_fade">
                                <ul id="menu_main" class="menu_main_nav">
                                    <li class="menu-item current-menu-ancestor current-menu-parent menu-item-has-children"><a href="<?php echo $base_url;?>home"><span>Home</span></a></li>
									
                                    <li class="menu-item menu-item-has-children"><a href="<?php echo $base_url;?>cms/about-us"><span>About us</span></a></li>
									
                                    <li class="menu-item"><a href="<?php echo $base_url;?>goat-breed"><span>Goat's Breed</span></a></li>
									
                                    <li class="menu-item"><a href="<?php echo $base_url;?>gallery"><span>Photo Gallery</span></a></li>	
									
									<li class="menu-item"><a href="<?php echo $base_url;?>video-gallery"><span>Video Gallery</span></a></li>	
                                    									
                                    <li class="menu-item"><a href="<?php echo $base_url;?>contact"><span>Contact us</span></a></li>
									
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="header_mobile">
            <div class="content_wrap">
                <div class="menu_button icon-menu"></div>
                <div class="logo">
                   <a href="<?php echo $base_url;?>">
                        <img src="<?php echo $base_url.$logo_url;?>" class="logo_main" style="min-height: 100px;">
                    </a>
                </div>
            </div>
            <div class="side_wrap">
                <div class="close">Close</div>
                <div class="panel_top">
                    <nav class="menu_main_nav_area">
                        <ul id="menu_mobile" class="menu_main_nav">
                           <li class="menu-item"><a href="<?php echo $base_url;?>home"><span>Home</span></a></li>
									
                           <li class="menu-item"><a href="<?php echo $base_url;?>cms/about-us"><span>About us</span></a></li>
									
                           <li class="menu-item"><a href="<?php echo $base_url;?>goat-breed"><span>Goat's Breed</span></a></li>
									
                           <li class="menu-item"><a href="<?php echo $base_url;?>gallery"><span>Photo Gallery</span></a></li>	
							
							<li class="menu-item"><a href="<?php echo $base_url;?>video-gallery"><span>Video Gallery</span></a></li>	
                                    									
                           <li class="menu-item"><a href="<?php echo $base_url;?>contact"><span>Contact us</span></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="panel_bottom">
                </div>
            </div>
            <div class="mask"></div>
        </div>