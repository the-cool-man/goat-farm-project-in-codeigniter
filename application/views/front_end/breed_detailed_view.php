<?php
$where_arra = array('Status'=>'A','ID'=>$breed_id);
$breed_arr = $this->common_model->get_count_data_manual('goat_breed',$where_arra,1);


?>
        <div class="top_panel_title top_panel_style_1 title_present navi_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1 title_present_inner breadcrumbs_present_inner">
                <div class="content_wrap">
                    <div class="post_navi"></div>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="<?php echo $base_url;?>">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <a class="breadcrumbs_item all"><?php echo $breed_arr['Title'];?></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single post_item_product">
                        <nav class="woocommerce-breadcrumb">
                            <a href="<?php echo $base_url;?>">Home</a>&nbsp;&#47;&nbsp;
                            <?php echo $breed_arr['Title'];?>
                        </nav>
                        <div class="product has-post-thumbnail first instock purchasable">
						
                            <div class="images">
								
                                <div class="post_thumb" data-image="<?php echo $base_url;?>assets/goat_breed/<?php echo $breed_arr['Image'];?>">
									<a class="hover_icon hover_icon_view" href="<?php echo $base_url;?>assets/goat_breed/<?php echo $breed_arr['Image'];?>"><img alt="" src="<?php echo $base_url;?>assets/goat_breed/<?php echo $breed_arr['Image'];?>">
									</a>
									
								</div>
								
								
                            </div>
                            <div class="summary entry-summary">
                                <h1 class="product_title entry-title"><?php echo $breed_arr['Title'];?></h1>
                                
                                <div class="woocommerce-product-details__short-description">
                                    <p>
                                       <?php echo $breed_arr['Description'];?>
                                    </p>
                                </div>
                               
                                   
								
                                  <span class="posted_in">Approx Body Weight : <?php echo $breed_arr['BodyWeight'];?></span><br><br>
								
                                    <span class="tagged_as">Price per KG : <?php echo $breed_arr['Price'];?></span><br><br>
								
                                    <span class="product_id">Delivery Time : <span><?php echo $breed_arr['DeliveryTime'];?></span></span><br><br>
								
									<span class="product_id">Call : <?php echo $config_data['ContactNumber'];?></span><br><br>
								
									<span class="product_id">Whatsapp : <?php echo $config_data['WhatsappNumber'];?></span>
                               

                            </div>

                            <div class="woocommerce-tabs wc-tabs-wrapper">
                                <ul class="tabs wc-tabs" role="tablist">                                   
                                    <li class="additional_information_tab active" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information">
                                        <a href="#tab-additional_information">Additional information</a>
                                    </li>                                   
                                </ul>
                                
                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information" style="display: block;">
                                    
                                    <table class="shop_attributes" >
                                        <tr>
                                            <th style="text-align: left;">Once confirmed, we will send a Photo/Video of the goat of your choice</th>
                                            
                                        </tr>
                                        <tr>
                                            <th style="text-align: left;">Payment method Cash/ NEFT/ RTGS and goat prices are per Kg</th>
                                            
                                        </tr>
										
										<tr>
                                            <th style="text-align: left;">Transport / delivery charges are NOT included</th>
                                            
                                        </tr>
										
										<tr>
                                            <th style="text-align: left;">Prices may change as per market conditions</th>
                                            
                                        </tr>
                                    </table>
                                </div>
                                
                            </div>
                            
                        </div>
                    </article>
                </div>
            </div>
        </div>
        
        
