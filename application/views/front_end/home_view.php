
        <section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_slider-1">
            <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
                <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" data-version="5.2.6">
                    <ul>
						<?php
			    $where_arra = array('Status'=>'A');
			  	$banner_arr = $this->common_model->get_count_data_manual('homepage_banner',$where_arra,2,'','ID ASC');
				if(isset($banner_arr) && $banner_arr !='' && count($banner_arr)> 0)
				{
					foreach($banner_arr as $banner_arr_val)
					{
						$id = $banner_arr_val['ID'];
			  ?>
                        <li data-index="rs-<?php echo $id; ?>" data-transition="cube" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?php echo $base_url;?>assets/banner/<?php echo $banner_arr_val['Banner']; ?>" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <img src="<?php echo $base_url;?>assets/banner/<?php echo $banner_arr_val['Banner']; ?>" alt="" title="home-1-slide-1" width="1903" height="873" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption BigWhiteText tp-resizeme" id="slide-1-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-60" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1000;e:Back.easeOut;" data-transform_out="opacity:0;s:300;" data-start="730" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.1"><?php echo $banner_arr_val['Title'];?></div>
                            <div class="tp-caption SmallWhiteText tp-resizeme" id="slide-1-layer-2" data-x="center" data-hoffset="" data-y="center" data-voffset="35" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:800;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="3030" data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $banner_arr_val['Description'];?></div>
                            
                        </li>
                   
					<?php
					}
				}
						?>
                        
                    </ul>
                    <div class="tp-bannertimer tp-bottom"></div>
                </div>
            </div>
        </section>
        <div class="page_content_wrap page_paddings_no">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single post_featured_default post_format_standard page type-page hentry">
                        <section class="post_content">
                            <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1475063547001">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="sc_section section_style_dark_text" data-animation="animated fadeInUp normal">
                                                <div class="sc_section_inner">
                                                    <h2 style="color: #fff;" class="sc_section_title sc_item_title sc_item_title_without_descr"><?php if(isset($config_data['home_page_content_h2']) && $config_data['home_page_content_h2']!='') { echo $config_data['home_page_content_h2'];} ?><br>
<br><a href="<?php echo $base_url;?>goat-breed" style="text-decoration: underline;">Book Now</a>
</h2>
                                                    <div class="sc_section_content_wrap">
                                                        <div class="sc_section sc_section_block aligncenter mw800">
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width"></div>
                            <div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="sc_section aligncenter" data-animation="animated fadeInUp normal">
                                                <div class="sc_section_inner">
                                                    <div class="sc_section_content_wrap">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            <div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="sc_section sc_section_block aligncenter" data-animation="animated fadeInUp normal">
                                                <div class="sc_section_inner">
                                                    <h2 class="sc_section_title sc_item_title sc_item_title_without_descr">Our Goats<!--<span></span>--></h2>
                                                    <div class="sc_section_content_wrap">
                                                        <div class="columns_wrap sc_columns columns_nofluid sc_columns_count_4">
						<?php
							$where_arra = array('Status'=>'A');
							$breed_arr = $this->common_model->get_count_data_manual('goat_breed',$where_arra,2,'','rand()',1,4);
							if(isset($breed_arr) && $breed_arr !='' && is_array($breed_arr) && count($breed_arr) > 0)
							{
								
								foreach($breed_arr as $breed_arr_val)
								{
									$BreedID = $breed_arr_val['ID'];
										?>
                                     <div class="column-1_4 sc_column_item sc_column_item_1 odd first">
                                                                <figure class="sc_image  sc_image_shape_round">
																	<a href="<?php echo $base_url;?>goat-breed/detail/<?php echo $BreedID;?>">
                                                                    <img src="<?php echo $base_url;?>assets/goat_breed/<?php echo $breed_arr_val['Image'];?>" style=" height: 150px; width: 200px;" />
																	</a>
                                                                </figure>
                                                                <h4 class="sc_title sc_title_regular cmrg_2">
                                                                    <a href="<?php echo $base_url;?>goat-breed/detail/<?php echo $BreedID;?>"><?php echo $breed_arr_val['Title'];?></a>
                                                                </h4>
                                                                
                                                            </div>
                            <?php
								}
							}
										?>
															
															<h4 class="sc_section_title sc_item_title sc_item_title_without_descr">
															<a href="<?php echo $base_url;?>goat-breed" class="button add_to_cart_button" style="border-color: #007f00; text-decoration: underline;">View All</a>
															</h4>
														
                                                        </div>
														
														
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                           
                            
                            
                            
                            <div class="vc_row-full-width"></div>
							
							<div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="sc_section" data-animation="animated fadeInUp normal">
                                               
                                                    <h4 class="sc_section_title sc_item_title sc_item_title_without_descr"><?php if(isset($config_data['home_page_content_h4']) && $config_data['home_page_content_h4']!='') { echo $config_data['home_page_content_h4'];} ?> <br><br>
											<a href="<?php echo $base_url;?>contact" style="text-decoration: underline;">Contact us</a></h4>
                                                    
                                                    
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                            <!--<div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="sc_section" data-animation="animated fadeInUp normal">
                                                <div class="sc_section_inner">
                                                    <h2 class="sc_section_title sc_item_title sc_item_title_without_descr">Blog<span></span></h2>
                                                    <div class="sc_section_content_wrap">
                                                        <div id="sc_blogger_608" class="sc_blogger layout_classic_3 template_masonry  sc_blogger_horizontal">
                                                            <div class="isotope_wrap" data-columns="3">
                                                                <div class="isotope_item isotope_item_classic isotope_item_classic_3 isotope_column_3">
                                                                    <div class="post_item post_item_classic post_item_classic_3 post_format_standard odd">
                                                                        <div class="post_featured">
                                                                            <div class="post_thumb" data-image="<?php echo $base_url;?>assets/front_end/images/post-6.jpg" data-title="It Was Delicious">
                                                                                <a class="hover_icon hover_icon_link" href="single-post.html">
                                                                                    <img alt="" src="<?php echo $base_url;?>assets/front_end/images/post-6-370x300.jpg">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="post_content isotope_item_content">
                                                                            <div class="post_info">
                                                                                <span class="post_info_item post_info_posted">
                                                                                    <a href="single-post.html" class="post_info_date">August 23, 2016</a>
                                                                                </span>
                                                                            </div>
                                                                            <h4 class="post_title">
                                                                                <a href="single-post.html">It Was Delicious</a>
                                                                            </h4>
                                                                            <div class="post_descr">
                                                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta.</p>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="isotope_item isotope_item_classic isotope_item_classic_3 isotope_column_3">
                                                                    <div class="post_item post_item_classic post_item_classic_3 post_format_standard even">
                                                                        <div class="post_featured">
                                                                            <div class="post_thumb" data-image="<?php echo $base_url;?>assets/front_end/images/post-5.jpg" data-title="A Better Cream Life">
                                                                                <a class="hover_icon hover_icon_link" href="single-post.html">
                                                                                    <img alt="" src="<?php echo $base_url;?>assets/front_end/images/post-5-370x300.jpg">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="post_content isotope_item_content">
                                                                            <div class="post_info">
                                                                                <span class="post_info_item post_info_posted">
                                                                                    <a href="single-post.html" class="post_info_date">August 14, 2016</a>
                                                                                </span>
                                                                            </div>
                                                                            <h4 class="post_title">
                                                                                <a href="single-post.html">A Better Cream Life</a>
                                                                            </h4>
                                                                            <div class="post_descr">
                                                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta.</p>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="isotope_item isotope_item_classic isotope_item_classic_3 isotope_column_3">
                                                                    <div class="post_item post_item_classic post_item_classic_3 post_format_standard odd last">
                                                                        <div class="post_featured">
                                                                            <div class="post_thumb" data-image="<?php echo $base_url;?>assets/front_end/images/post-4.jpg" data-title="Butter of a Dream">
                                                                                <a class="hover_icon hover_icon_link" href="single-post.html">
                                                                                    <img alt="" src="<?php echo $base_url;?>assets/front_end/images/post-4-370x300.jpg">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="post_content isotope_item_content">
                                                                            <div class="post_info">
                                                                                <span class="post_info_item post_info_posted">
                                                                                    <a href="single-post.html" class="post_info_date">August 5, 2016</a>
                                                                                </span>
                                                                            </div>
                                                                            <h4 class="post_title">
                                                                                <a href="single-post.html">Butter of a Dream</a>
                                                                            </h4>
                                                                            <div class="post_descr">
                                                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta.</p>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            
                           
                        </section>
                    </article>
                  
                </div>
            </div>
        </div>

       