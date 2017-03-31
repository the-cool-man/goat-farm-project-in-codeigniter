
        <div class="top_panel_title top_panel_style_1 title_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1 title_present_inner breadcrumbs_present_inner">
                <div class="content_wrap">
                    <h1 class="page_title">Goat</h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="<?php echo $base_url;?>">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <span class="breadcrumbs_item current">Breed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <div class="list_products shop_mode_thumbs">                      
                       
                        <ul class="products">
							<?php
			    $where_arra = array('Status'=>'A');
			  	$breed_arr = $this->common_model->get_count_data_manual('goat_breed',$where_arra,2,'','ID DESC');
				if(isset($breed_arr) && $breed_arr !='' && count($breed_arr)> 0)
				{
					foreach($breed_arr as $breed_arr_val)
					{
						$ID = $breed_arr_val['ID'];
			  ?>
                            <li class="product has-post-thumbnail column-1_3 instock purchasable">
                                <div class="post_item_wrap">
                                    <div class="post_featured">
                                        <div class="post_thumb">
                                            <a class="hover_icon hover_icon_link" href="<?php echo $base_url;?>goat_breed/detail/<?php echo $ID;?>">
                                                <img src="<?php echo $base_url;?>assets/goat_breed/<?php echo $breed_arr_val['Image'];?>" class="attachment-shop_catalog size-shop_catalog" style=" width: 250px; height: 180px;"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post_content">
                                        <h1 class="woocommerce-loop-product__title">
                                            <a href="<?php echo $base_url;?>goat_breed/detail/<?php echo $ID;?>"><?php echo $breed_arr_val['Title'];?></a>
                                        </h1>
                                       
                                        <a style="color: #fff; font-size: 15px;" rel="nofollow" href="<?php echo $base_url;?>goat_breed/detail/<?php echo $ID;?>" class="button add_to_cart_button">View More Detail</a>
                                    </div>
                                </div>
                            </li>
					<?php
					}
				}
							?>
                         
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        
                