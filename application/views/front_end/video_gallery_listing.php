<?php
if(!isset($page_number) || $page_number =='')
{
	$page_number = 1;
}
$gallery_list_count = $this->common_front_model->get_video_gallery_list(0);
$gallery_list = $this->common_front_model->get_video_gallery_list(2,$page_number);
?>
<div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
<?php
if(isset($gallery_list) && $gallery_list !='' && count($gallery_list)> 0)
{	
	foreach($gallery_list as $gallerys_arr_val)
	{
		$galleryID = $gallerys_arr_val['ID'];
		
		if(isset($gallerys_arr_val['Video']) && $gallerys_arr_val['Video'] !='')
		{
			$Video = $gallerys_arr_val['Video'];
		}
		
?>	
		<div class="isotope_item isotope_item_masonry isotope_item_masonry_2 isotope_column_2">
                                                        <div class="post_item post_item_masonry post_item_masonry_2 post_format_standard odd">
                                                            <div class="post_featured">
                                                               <?php echo htmlspecialchars_decode($Video,ENT_QUOTES);?>
                                                            </div>
                                                            
														</div>	
                                                    </div>
<?php		
	}
	
}
?>
</div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" class="hash_tocken_id" id="hash_tocken_id_temp" />