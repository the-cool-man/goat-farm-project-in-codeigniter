 <footer class="call_wrap">
            
        </footer>
        <footer class="footer_wrap widget_area scheme_original">
            <div class="footer_wrap_inner widget_area_inner">
                <div class="content_wrap">
                    <div class="columns_wrap">
                        <?php
						$logo_url = 'assets/front_end/logo/logo.png';
						if(isset($config_data['SiteLogo']) && $config_data['SiteLogo'] !='')
						{
							$logo_url = 'assets/logo/'.$config_data['SiteLogo'];
						}
						?>
                        <aside class="column-1_4 widget widget_socials">
                            <div class="widget_inner">
                                <div class="logo">
                                    <a href="<?php echo $base_url;?>home">
                                        <img src="<?php echo $base_url.$logo_url;?>" style="width: 100px; height: 80px;">
                                    </a>
                                </div>
                            </div>
                        </aside>
                        <aside class="column-1_2 widget widget_text">
                            <div class="textwidget"><?php echo $config_data['FullAdress'];?>
                                <br>
                                <span class="accent1">Mobile: <?php echo $config_data['ContactNumber'];?></span>
                                <br> Whatsapp: <?php echo $config_data['WhatsappNumber'];?>
                                <br> Email: <a href="mailto:alamangoatfarm@gmail.com">alamangoatfarm@gmail.com</a>
                            </div>
                        </aside>
                        
                        <aside class="column-1_4 widget widget_socials">
                            <div class="widget_inner">
                                <div class="sc_socials sc_socials_type_icons sc_socials_shape_round sc_socials_size_tiny">
                                
                                 <?php
			if(isset($config_data['social_media']) && $config_data['social_media'] !='' && count($config_data['social_media'])> 0)
			{
				foreach($config_data['social_media'] as $social_media_val)
				{
					if(isset($social_media_val['SocialLink']) && $social_media_val['SocialLink'] !='' && isset($social_media_val['SocialLogo']) && $social_media_val['SocialLogo'] !='' )
			?>
                            
                					<div class="sc_socials_item">
                                        <a target="_blank" href="<?php echo $social_media_val['SocialLink']; ?>"  class="social_icons" title="<?php echo $social_media_val['SocialName'];?>"><i class="<?php echo $social_media_val['SocialLogo']; ?>"></i>
                                        </a>
                                    </div>
                                    
            <?php
					}
				}
			?>  
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copyright_wrap copyright_style_menu scheme_original">
            <div class="copyright_wrap_inner">
                <div class="content_wrap">
                    <ul id="menu_footer" class="menu_footer_nav">
                        <li class="menu-item"><a href="<?php echo $base_url;?>cms/terms-conditions"><span>Terms & Conditions</span></a></li>
                        <li class="menu-item"><a href="<?php echo $base_url;?>cms/privacy-policy"><span>Privacy Policy</span></a></li>
						<li class="menu-item"><a href="<?php echo $base_url;?>cms/refund-policy"><span>Refund Policy</span></a></li>
                        <li class="menu-item"><a href="<?php echo $base_url;?>contact"><span>Contact Us</span></a></li>
                    </ul>
                    <div class="copyright_text">
                        <p><?php if(isset($config_data['CopyRightContent']) && $config_data['CopyRightContent'] !=''){ echo $config_data['CopyRightContent'];} ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>
<div class="custom_html_section"></div>


<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/jquery/jquery.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/jquery/jquery-migrate.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/custom.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/esg/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/extensions/revolution.extension.actions.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/extensions/revolution.extension.layeranimation.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/extensions/revolution.extension.navigation.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/revslider/extensions/revolution.extension.slideanims.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/modernizr.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/jquery/js.cookie.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/superfish.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/core.utils.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/core.init.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/init.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/core.debug.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/embed.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/custom/shortcodes.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/comp/comp_front.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/ui/core.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/ui/widget.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/ui/tabs.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/isotope.pkgd.min.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/swiper/swiper.js'></script>
<script type='text/javascript' src='<?php echo $base_url;?>assets/front_end/js/vendor/prettyPhoto/jquery.prettyPhoto.min.js'></script>

<?php
	if(isset($this->common_model->extra_js_fr) && $this->common_model->extra_js_fr !='' && count($this->common_model->extra_js_fr) > 0)
	{
		$extra_js_fr = $this->common_model->extra_js_fr;
		foreach($extra_js_fr as $extra_js_val)
		{
	?>
		<script type="text/javascript" src="<?php echo $base_url;?>assets/front_end/js/<?php echo $extra_js_val;?>"
				</script>
	<?php
		}
	}
	?>

<?php
	if(isset($this->common_model->js_extra_code_fr) && $this->common_model->js_extra_code_fr !='')
	{
		echo $this->common_model->js_extra_code_fr;
	}
?>
</script>
<?php
if(isset($this->common_model->share_page) && $this->common_model->share_page =='yes')
	{
?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ac075b5edab058b"></script>
<?php
	}
?>
<div style="display:none;">	
<?php echo htmlspecialchars_decode($config_data['GoogleAnalyticsCode'],ENT_QUOTES);?>
</div>

</body>



</html>