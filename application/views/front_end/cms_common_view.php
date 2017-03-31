<?php
	$page_title = '';
	$page_desc = '';
	if(isset($page_name) && $page_name !='')
	{
		$where_arra = array('Status'=>'A','Alias'=>$page_name);
    	$cms_arr = $this->common_model->get_count_data_manual('cms_page',$where_arra,1);
		if(isset($cms_arr['Title']) && $cms_arr['Title'] !='')
		{
			$page_title = $cms_arr['Title'];
		}
		if(isset($cms_arr['Content']) && $cms_arr['Content'] !='')
		{
			$page_desc = $cms_arr['Content'];
		}
		//print_r($cms_arr);
	}
?>


 

<div class="top_panel_title top_panel_style_1 title_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1  title_present_inner breadcrumbs_present_inner">
                <div class="content_wrap">
                    <h1 class="page_title"><?php echo $this->common_model->display_data_na($page_title); ?></h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="<?php echo $base_url;?>">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <a class="breadcrumbs_item cat_post">CMS</a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single post_featured_default post_format_standard post type-post format-standard has-post-thumbnail hentry">
						<?php if($page_name=='about-us')
						{
							
		if(isset($config_data['about_us_image']) && $config_data['about_us_image'] !='' && file_exists($this->common_model->path_banner.$config_data['about_us_image']))
		{
			$img_cover = $this->common_model->path_banner.$config_data['about_us_image'];
		}
		else
		{	
			$img_cover = 'assets/front_end/images/s8.jpeg';
		}
							?>
						<section class="post_featured">
                            <div class="post_thumb" data-image="<?php echo $base_url.$img_cover;?>" data-title="Welcome to Al Aman Goat Farm">
                                <a class="hover_icon hover_icon_view" href="<?php echo $base_url;?>assets/front_end/images/s.jpeg" title="Welcome to Al Aman Goat Farm">
                                    <img alt="" src="<?php echo $base_url.$img_cover;?>">
                                </a>
                            </div>
                        </section>
							<?php
						}
						?>
                        
                        <section class="post_content">
                            
                            <p>
                                <?php echo $this->common_model->display_data_na($page_desc); ?>
                            </p>
                            
                            

                        </section>
                        
                        
                    </article>
                    
                </div>
                
            </div>
        </div>
        
