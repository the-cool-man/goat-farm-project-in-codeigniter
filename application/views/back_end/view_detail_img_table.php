 <?php $defult_not_upload_src = 'assets/images/no_image.jpg';
  if(isset($img_list_tab_arr) && $img_list_tab_arr !='' && count($img_list_tab_arr) > 0)
  {
		$gallary_title = $this->common_model->get_value($img_list_tab_arr,'title','No Title');
		$path_folder = $this->common_model->get_value($img_list_tab_arr,'path_value','');
		$filed_arr_img = $this->common_model->get_value($img_list_tab_arr,'filed_arr','');
		$class_width = $this->common_model->get_value($img_list_tab_arr,'class_width',' col-lg-3 col-md-4 col-sm-6  col-xs-12 ');
		$img_class = $this->common_model->get_value($img_list_tab_arr,'img_class',' img-responsive img-thumbnail');
		$inline_style = $this->common_model->get_value($img_list_tab_arr,'inline_style','');
		$display_status = $this->common_model->get_value($img_list_tab_arr,'display_status','');
		$display_name = $this->common_model->get_value($img_list_tab_arr,'display_name','');
		$not_upload_display = $this->common_model->get_value($img_list_tab_arr,'not_upload_display','');
		$list_data_arr = '';
		if(isset($filed_arr_img['tabel_name']) && $filed_arr_img['tabel_name'] !='' && isset($filed_arr_img['rel_column']) && $filed_arr_img['rel_column'] !='' && isset($filed_arr_img['rel_column_val']) && $filed_arr_img['rel_column_val'] !='' && isset($filed_arr_img['img_column_name']) && $filed_arr_img['img_column_name'] !='')
		{
			$where_arra = array($filed_arr_img['rel_column']=>$filed_arr_img['rel_column_val']);
			$list_data_arr = $this->common_model->get_count_data_manual($filed_arr_img['tabel_name'],$where_arra,2);
		}
?>
	<div class="panel panel-primary">
    	<div class="panel-heading">
        <div class="pull-left text-bold">
            <?php 
                if(isset($gallary_title) && $gallary_title !='')
                {
                    echo $gallary_title;
                }
                else
                {
                    echo $dna;
                } 
            ?>
        </div>
        <div class="panel-controls">
            <a href="#" class="panel-collapse" data-toggle="panel-collapse"> <i class="panel-icon-chevron"></i> </a>
         </div>
    </div>
    	<div class="panel-body form-horizontal ">
            <div class="row">
                <?php
                if(isset($list_data_arr) && $list_data_arr !='' && count($list_data_arr) > 0)
                {
					$error_message = 1;
                    foreach($list_data_arr as $list_data_arr_val)
                    { 
						$file_name = $list_data_arr_val[$filed_arr_img['img_column_name']];
						if($file_name !='' && file_exists($path_folder.$file_name))
						{
							$file_name_img = $file_name;
							$file_name_img = $path_folder.$file_name;
							$error_message = 0;
						}
						else if(isset($not_upload_display) && $not_upload_display =='yes')
						{
							$file_name_img = $defult_not_upload_src;
							$error_message = 0;
						}
						else
						{
							continue;
						}
                ?>
                <div class="<?php echo $class_width; ?> text-center mb20">
                    <img  style="width:240px;height:160px"  <?php echo $inline_style; ?> src="<?php echo $base_url.$file_name_img; ?>" class="<?php echo $img_class; ?>" alt="<?php echo $file_name_img;?>" />
                    <br/>
	                    <a target="_blank" href="<?php echo $base_url.$file_name_img; ?>" >Click to view enlarge</a>
				<?php                    
                ?>
                </div>
                <?php
                    }
				}
				else
				{
				?>
                <div class="alert alert-danger">Not uploaded yet.</div>
                <?php
				}
                ?>
            </div>
        	</div>
	    </div>
<?php
  }
 // $this->common_model->js_extra_code.= ' if($(".magniflier").length > 0){OnhoverMove();}';
?>	