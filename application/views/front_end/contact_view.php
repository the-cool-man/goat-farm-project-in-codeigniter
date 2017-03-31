<!-- Start main-content -->
   <div class="top_panel_title top_panel_style_1 title_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1 title_present_inner breadcrumbs_present_inner">
                <div class="content_wrap">
                    <h1 class="page_title">Contacts</h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="<?php echo $base_url;?>">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <span class="breadcrumbs_item current">Contacts</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap page_paddings_no">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single post_featured_default post_format_standard page type-page hentry">
                        <section class="post_content">
                            <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div id="sc_googlemap_571_wrap" class="sc_googlemap_wrap">
												
												
												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29208.01901742714!2d72.86480423708855!3d23.78292968457329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ2JzU4LjYiTiA3MsKwNTInNTYuMyJF!5e0!3m2!1sen!2sin!4v1529931531726" frameborder="0" style="border:0; width: 100%; height: 630px;" allowfullscreen></iframe>
												
												
												
                                                <div class="sc_googlemap_content">
                                                    <div id="sc_form_282_wrap" class="sc_form_wrap">
                                                        <div id="sc_form_282" class="sc_form sc_form_style_form_1">
                                                            <h2 class="sc_form_title sc_item_title sc_item_title_without_descr">Contact Us</h2>
															<div id="result" style="color:white; margin-bottom:0.4em"></div>
                                                            
                                                            
                                                            <form id="contact_form" name="contact_form"  method="post">
                                                                <div class="sc_form_info">
                                                                    <div class="sc_form_item sc_form_field label_over">
                                                                        <input type="text"  name="username" placeholder="Name *" >
                                                                    </div>
                                                                    <div class="sc_form_item sc_form_field label_over">
                                                                        <input type="text" name="contact" placeholder="Contact *" >
                                                                    </div>
                                                                </div>
                                                                <div class="sc_form_item sc_form_message">
                                                                    <textarea name="message" placeholder="Message"></textarea>
                                                                </div>
                                                                <div class="sc_form_item sc_form_button">
                                                                <button type="submit" >Send Message</button>
																	
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id" class="hash_tocken_id" />
					<input type="hidden" name="is_post" id="is_post" value="0"/>
					<input type="hidden" name="page_type" id="page_type" value="contact"/>
                                                                </div>
                                                                
                                                            </form>
															
															
															 <!-- Contact Form Validation-->
                                                               
              <script type="text/javascript">
                jQuery("#contact_form").submit(function(e) 
				{
					var form = jQuery(this);
					var url = '<?php echo $base_url;?>contact/submit-contact';
				
					jQuery.ajax({
						   type: "POST",
						   url: url,
						   data: form.serialize(), // serializes the form's elements.
						   success: function(data)
						   {
							   var res =  JSON.parse(data);
							   jQuery("#result").html(res.errmessage); // show response from the php script.
							   jQuery("#contact_form")[0].reset(); // show response from the php script.
							  
						   }
						 });
				
					e.preventDefault(); // avoid to execute the actual submit of the form.
				});
              </script>
															
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
                                            <div class="columns_wrap sc_columns columns_nofluid sc_columns_count_3 margin_top_huge margin_bottom_huge">
                                                <div class="column-1_3 sc_column_item sc_column_item_1 odd first centext" >
                                                    <div class="sc_section section_style_bordered_section">
                                                        <div class="sc_section_inner" style="height: 150px !important;">
                                                            <div class="sc_section_content_wrap">
                                                                <h4 class="sc_title sc_title_regular sc_align_center">Address</h4>
                                                                <span class="sc_highlight"><?php echo nl2br($config_data['FullAdress']);?></span>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column-1_3 sc_column_item sc_column_item_2 even centext">
                                                    <div class="sc_section section_style_bordered_section">
                                                        <div class="sc_section_inner" style="height: 150px !important;">
                                                            <div class="sc_section_content_wrap">
                                                                <h4 class="sc_title sc_title_regular sc_align_center">Phone</h4>
                                                                <span class="sc_highlight"><?php echo $config_data['ContactNumber'];?></span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column-1_3 sc_column_item sc_column_item_3 odd centext">
                                                    <div class="sc_section section_style_bordered_section">
                                                        <div class="sc_section_inner" style="height: 150px !important;">
                                                            <div class="sc_section_content_wrap">
                                                                <h4 class="sc_title sc_title_regular sc_align_center">Email</h4>
                                                                <span class="sc_highlight"><a href="mailto:alamangoatfarm@gmail.com" class="__cf_email__">alamangoatfarm@gmail.com</a></span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </article>
                    <section class="related_wrap related_wrap_empty"></section>
                </div>
            </div>
        </div>