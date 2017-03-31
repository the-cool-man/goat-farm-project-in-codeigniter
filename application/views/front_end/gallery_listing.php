<?php
if(!isset($page_number) || $page_number =='')
{
	$page_number = 1;
}
$gallery_list_count = $this->common_front_model->get_gallery_list(0);
$gallery_list = $this->common_front_model->get_gallery_list(2,$page_number);
?>
<div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
<?php
if(isset($gallery_list) && $gallery_list !='' && count($gallery_list)> 0)
{	
	foreach($gallery_list as $gallerys_arr_val)
	{
		$galleryID = $gallerys_arr_val['ID'];
		$img_cover = $this->common_model->photo_avtar;
		if(isset($gallerys_arr_val['Image']) && $gallerys_arr_val['Image'] !='' && file_exists($this->common_model->path_gallery.$gallerys_arr_val['Image']))
		{
			$img_cover = $this->common_model->path_gallery.$gallerys_arr_val['Image'];
		}
		
?>	
		<div class="isotope_item isotope_item_masonry isotope_item_masonry_3 isotope_column_3">
                                                        <div class="post_item post_item_masonry post_item_masonry_3 post_format_standard odd">
                                                            <div class="post_featured">
                                                                <div class="post_thumb" data-image="<?php echo $base_url.$img_cover;?>">
																	<a class="hover_icon hover_icon_view" href="<?php echo $base_url.$img_cover;?>">
										<img alt="" src="<?php echo $base_url.$img_cover;?>" style="width: 300px; height: 250px;">
																	</a>
																</div>
																
																
                                                            </div>
                                                            
														</div>	
                                                    </div>
<?php		
	}
	
}
?>
</div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" class="hash_tocken_id" id="hash_tocken_id_temp" />