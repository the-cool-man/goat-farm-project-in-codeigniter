
        <div class="top_panel_title top_panel_style_1 title_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1  title_present_inner breadcrumbs_present_inner">
                <div class="content_wrap">
                    <h1 class="page_title">Gallery</h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="<?php echo $base_url;?>">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <span class="breadcrumbs_item current">Video Gallery</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single post_featured_default post_format_standard page type-page hentry">
                        <section class="post_content">
                            <div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div id="sc_blogger_089" class="sc_blogger layout_masonry_3 template_masonry margin_bottom_small-  sc_blogger_horizontal">
                                                <div class="isotope_wrap" data-columns="3">
													
													<?php include_once("video_gallery_listing.php"); ?>
													
                                                                                                  
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </article>
					
					
					<nav id="pagination" class="pagination_wrap pagination_pages">						
					<?php
					if(isset($gallery_list_count) && $gallery_list_count !='' && $gallery_list_count > 0)
					{
					echo $this->common_model->rander_pagination_front('video_gallery/index/',$gallery_list_count);
					}
					?>						
                        <!--<span class="pager_current active ">1</span>
                        <a href="#" class="">2</a>
                        <a href="#" class="">3</a>
                        <a href="#" class="pager_dot ">&hellip;</a>
                        <a href="#" class="pager_next "></a>
                        <a href="#" class="pager_last "></a>-->
                    </nav>
					
                    <section class="related_wrap related_wrap_empty"></section>

                </div>
            </div>
        </div>