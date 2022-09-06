<?php $data_table_mem = '';
$disp_column_array ='';
$data_tab_btn_arr = '';
if(isset($other_config_data['data_table_mem']) && $other_config_data['data_table_mem'] !='')
{
	$data_table_mem = $other_config_data['data_table_mem'];
}
if(isset($other_config_data['data_tab_btn']) && $other_config_data['data_tab_btn'] !='')
{
	$data_tab_btn_arr = $other_config_data['data_tab_btn'];
}
if(isset($data_table_mem['disp_column_array']) && $data_table_mem['disp_column_array'] !='')
{
	$disp_column_array = $data_table_mem['disp_column_array'];
}
$display_image_clm = 'profile_photo';
$path_img = 'assets/profile_photo/';

$display_img = 'Yes';
if(isset($other_config_data['hide_display_image']) && $other_config_data['hide_display_image'] !='')
{
	$display_img = 'No';
}
if(isset($other_config_data['display_image']) && $other_config_data['display_image'] !='')
{
	$display_image_clm = $other_config_data['display_image'];
}
if(isset($display_img) && $display_img !='' && $display_img =='Yes')
{
	if(isset($other_config_data[$display_image_clm]) && $other_config_data[$display_image_clm] !='')
	{
		$path_img = $other_config_data[$display_image_clm];
	}
}
?>
<div class="panel mb25">
    <div class="panel-body">
        <div class="row">
            <form method="post" action="<?php if(isset($this->common_model->base_url_admin_cm) && $this->common_model->base_url_admin_cm !=''){ echo $this->common_model->base_url_admin_cm;} ?>" onSubmit="return search_change_limit()">
            <div class="panel col-sm-12">
            <?php
                $addPopup = 0;
                if(isset($this->common_model->addPopup) && $this->common_model->addPopup =='1')
                {
                    $addPopup = 1;
                }
                if(!isset($other_config_data['addAllow']) || $other_config_data['addAllow'] !='no')
                {
                    if(isset($this->common_model->add_fun) && $this->common_model->add_fun !='')
                    {
                        $add_fun = $this->common_model->add_fun;
                    }
                    
                    if(isset($addPopup) && $addPopup =='1')
                    {
                ?>
                    <a id="new" onClick="add_data_popup()" data-toggle="modal" data-target="#myModal" class="btn btn-default mb15 ml15"><i class="fa fa-plus fa-fw"></i>&nbsp;&nbsp;Add New&nbsp;</a>
                <?php		
                    }
                    else
                    {
							$add_url_btn = $this->common_model->base_url_admin_cm.'add-data';
						if(isset($other_config_data['add_url']) && $other_config_data['add_url'] !='')
						{
							$add_url_btn = $this->common_model->data['base_url_admin'].$other_config_data['add_url'];
						}
                ?>
                    <a id="new" href="<?php echo $add_url_btn;?>" class="btn btn-default mb15 ml15"><i class="fa fa-plus fa-fw"></i>&nbsp;&nbsp;Add New&nbsp;</a>
                <?php		
                    }
                ?>
                    <!--<a id="new"  data-toggle="modal" data-target="#myModal" href="<?php //echo $add_url;?>" class="btn btn-default mb15 ml15"><i class="fa fa-plus fa-fw"></i>&nbsp;&nbsp;Add New&nbsp;</a>-->
                <?php				
                }
				?>
                    <a href="<?php echo $this->common_model->base_url_admin_cm;?>" class="btn btn-primary mb15 ml15"><i class="fa fa-list fa-fw"></i>&nbsp;&nbsp;All (<?php echo $data_tabel_all_count; ?>)&nbsp;</a>
                <?php
                if(!isset($other_config_data['display_status']) || $other_config_data['display_status'] !='no')
                {
                    $status_arr = array();
                    if(isset($this->common_model->status_arr) && $this->common_model->status_arr !='')
                    {
                        $status_arr = $this->common_model->status_arr;
                        if(isset($status_arr) && count($status_arr) > 0)
                        {
                            foreach($status_arr as $key=>$val)
                            {
                                $class_fa = '';
                                if(isset($status_arr_faList[$key]) && $status_arr_faList[$key] !='')
                                {
                                    $class_fa = $status_arr_faList[$key];
                                }
                                $class_colr = 'btn-primary';
                                if(isset($status_arr_colorList[$key]) && $status_arr_colorList[$key] !='')
                                {
                                    $class_colr = $status_arr_colorList[$key];
                                }
                                $key_d = ucfirst(strtolower($val));
                                $data_status_count = 0;
                                if(in_array($this->common_model->status_column,$data_tabel_filed))
                                {
                                    $where_arr = array($this->common_model->status_column=>$key);
									$this->common_model->add_personal_where();
                                    $data_status_count = $this->common_model->get_count_data_manual($this->common_model->table_name,$where_arr,0,$this->common_model->primary_key);
                                }
                        ?>
                            <a href="<?php echo $this->common_model->base_url_admin_cm.$key;?>" class="btn <?php echo $class_colr; ?> mb15 ml15"><i class=" <?php echo $class_fa; ?> "></i>&nbsp;&nbsp;<?php echo $key_d; ?> List (<?php echo $data_status_count; ?>)&nbsp;</a>
                        <?php
                            }
                        }
                    }
                }
            ?>
            <hr style="border:1px solid rgba(0,0,0,.06);height:0px;margin-bottom:0px" />
            </div>
            <?php
            if($this->session->flashdata('success_message'))
            {
				$success_message = $this->session->flashdata('success_message');
				if (strpos($success_message, 'alert-success') !== false) {
					echo $success_message;
				}
				else
				{
               		echo $message_div='<div class="alert alert-success  alert-dismissable"><div class="fa fa-check">&nbsp;</div><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$this->session->flashdata('success_message').'</div>';
				}
               $this->session->unset_userdata('success_message');
            }
            if($this->session->flashdata('error_message'))
            {
                echo $message_div='<div class="alert alert-danger alert-dismissable"><div class="fa fa-warning"></div><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$this->session->flashdata('error_message').'</div>';
                $this->session->unset_userdata('error_message');
            }
			if($this->session->flashdata('error_message_js'))
			{
				echo $this->session->flashdata('error_message_js');
				$this->session->unset_userdata('error_message_js');
			}

            if(isset($this->common_model->data_tabel_filtered_count) && $this->common_model->data_tabel_filtered_count !='' && $this->common_model->data_tabel_filtered_count > 0)
            {
				$disp_select_all = 0;
				if((!isset($other_config_data['deleteAllow']) || $other_config_data['deleteAllow'] !='no')|| (!isset($other_config_data['statusChangeAllow']) || $other_config_data['statusChangeAllow'] !='no'))
				{
					$disp_select_all = 1;
				}
            ?>
            <div class="clearfix"></div>
            <div class="col-sm-12">
            	<?php
				if($disp_select_all == 1)
				{
				?>
                <div class="btn btn-default pb0pt3 mb15 ml15">
                    <label class="cb-checkbox mb0 pb1pt5" id="all_check"><input class="all_check " type="checkbox" id="all" /> Select All
                    </label>
                </div>
            <?php
				}
			if(!isset($other_config_data['deleteAllow']) || $other_config_data['deleteAllow'] !='no')
			{
			?>    
                <a onClick="return update_status('DELETE')" href="#" class="btn btn-danger mb15 ml15"><i class="fa fa-trash fa-fw"></i>&nbsp;&nbsp;Delete&nbsp;</a>
            <?php
			}
			$status_arr = $this->common_model->status_arr_change;
            
			if(!isset($other_config_data['statusChangeAllow']) || $other_config_data['statusChangeAllow'] !='no')
			{
				if(isset($status_arr) && count($status_arr) > 0)
				{
					foreach($status_arr as $key=>$val)
					{
						$class_fa = '';
						if(isset($status_arr_faList[$key]) && $status_arr_faList[$key] !='')
						{
							$class_fa = $status_arr_faList[$key];
						}
						$class_colr = 'btn-primary';
						if(isset($status_arr_colorList[$key]) && $status_arr_colorList[$key] !='')
						{
							$class_colr = $status_arr_colorList[$key];
						}
						$key_d = ucfirst(strtolower($val));
				?>		
					<a onClick="return update_status('<?php echo $key; ?>')" href="#" class="btn <?php echo $class_colr; ?> mb15 ml15"><i class="<?php echo $class_fa; ?>"></i>&nbsp;&nbsp;<?php echo $key_d; ?>&nbsp;</a>
				<?php
					}
				}
			}
            ?>
            </div>
            <?php
            }
            ?>
            <div class="col-sm-2">
                <label>
                    Show
                </label>
                <label>
                    <?php
                        $limit_per_page = $this->common_model->limit_per_page;
                    ?>
                    <select name="limit_per_page" id="limit_per_page" class="form-control" onChange="search_change_limit()">
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==1){ echo 'selected';} ?> value="1">1</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==2){ echo 'selected';} ?> value="2">2</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==3){ echo 'selected';} ?> value="3">3</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==5){ echo 'selected';} ?> value="5">5</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==10){ echo 'selected';} ?> value="10">10</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==25){ echo 'selected';} ?> value="25">25</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==50){ echo 'selected';} ?> value="50">50</option>
                        <option <?php if(isset($limit_per_page) && $limit_per_page ==100){ echo 'selected';} ?> value="100">100</option>
                    </select>
                </label>
                <label>
                    entries
                </label>                    
            </div>
            <div class="col-sm-2">
            <?php
            $search_filed = '';
            $class_clear = '';
            if(isset($this->common_model->search_filed) && $this->common_model->search_filed !='')
            {
                $search_filed = htmlentities(stripcslashes($this->common_model->search_filed));
                $class_clear = 'x onX';
            }
            ?>    
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4 input-group mb15">
                <?php 
					if(!isset($other_config_data['searchAllow']) || $other_config_data['searchAllow'] !='no')
					{
				?>
                <input type="search" name="search_filed" id="search_filed" class="form-control clearable <?php echo $class_clear; ?>" value="<?php echo $search_filed; ?>" placeholder="Search here.." />
                <span class="input-group-btn pr10">
                  <button type="submit" class="btn btn-primary">Search</button>
                </span>
                <?php
					}
					else
					{
				?>
				<input type="hidden" name="search_filed" id="search_filed" />
				<?php
					}
				?>
            </div>
            <div class="clearfix clear-fix "></div>
			<div class="col-sm-6">
           <?php
				if(isset($other_config_data['display_filter']) && $other_config_data['display_filter'] !='' && $other_config_data['display_filter'] =='Yes')
				{
			?>
                    <a data-toggle="modal" data-target="#myModal_filter" class="btn btn-info mb15"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter&nbsp;</a>
                   <?php
                    if($this->common_model->session_search_name !='')
                    {
                        $session_search_name = $this->common_model->session_search_name;
                        if(isset($session_search_name) && $session_search_name !='')
                        {
                            $session_search_name_val = $this->session->userdata($session_search_name);
                            if($session_search_name_val !='')
                            {
				  ?>				
                    <a href="javascript:;" onClick="clear_model_filter()" class="btn btn-info mb15"><i class="fa fa-filter"></i>&nbsp;&nbsp;Clear filter&nbsp;</a>
                  <?php
							}
						}
					}
				  ?>  
            <?php
				}
			?>
            </div>
            <?php
			$sort_column_dt = '';
			$sort_order_dt = '';
			if(isset($data_table_parameter['default_sort']) && $data_table_parameter['default_sort'] !='')
			{
				$sort_column_dt = $data_table_parameter['default_sort'];
			}
			if(isset($data_table_parameter['default_order']) && $data_table_parameter['default_order'] !='')
			{
				$sort_order_dt = $data_table_parameter['default_order'];
			}
			$sort_column_arr = '';
			if(isset($other_config_data['sort_column']) && $other_config_data['sort_column'] !='' && count($other_config_data['sort_column'])> 0)
			{
				$sort_column_arr = $other_config_data['sort_column'];
			}
			//print_r($sort_column_arr);
			if($sort_column_arr !='')
			{
			?>
            <div class="col-sm-6 text-right">
            	<label>
                    Sort
                </label>
                <label>
                <select name="sort_order_js" id="sort_order_js" class="form-control" onChange="change_sort_order(this.value)">
                <?php
					foreach($sort_column_arr as $keysc=>$valsc)
					{
				?>    
                    <option value="<?php echo $keysc; ?>-desc" <?php if($sort_column_dt ==$keysc && $sort_order_dt =='desc'){ echo 'selected';} ?>><?php echo $valsc; ?> Descending</option>
                    <option value="<?php echo $keysc; ?>-asc" <?php if($sort_column_dt ==$keysc && $sort_order_dt =='asc'){ echo 'selected';} ?>><?php echo $valsc; ?> Ascending</option>
                <?php
					}
				?>
                </select>
                </label>
            </div>
			<?php
			}
			?>
            </form>
        </div>
        <!-- for jobseeker data -->
		<?php
        if(isset($this->common_model->data_tabel_data) && $this->common_model->data_tabel_data !='' && count($this->common_model->data_tabel_data) > 0)
       	{
           	foreach($this->common_model->data_tabel_data as $data_val)
           	{
			$temp_id = $data_val[$this->common_model->primary_key];
			$temp_edit_pop = '';
			$temp_edit_pop.= 'data-'.$this->common_model->primary_key.'="'.$data_val[$this->common_model->primary_key].'" ';
        ?>
        <div class="col-lg-12 col-xs-12 col-md-12 neAdminResult">
			<div class="row mar_rowm15">
                <div class="col-lg-2 col-xs-2 col-md-1 neMrgAbottom10 neMrgATop10 checkbox-row">
                   <?php 
                    if($disp_select_all == 1)
					{
				   ?>	
                    <label class="cb-checkbox"><input type="checkbox" class="checkbox_val" name="checkbox_val[]" value="<?php echo $temp_id;?>" ></label>
                   <?php
					}
				   ?> 
                </div>
                <h3 class="col-lg-7 col-xs-10 col-md-5" style="font-weight:bold">
                   <?php 
				   	$tool_tip_img = 'No Image';
				   	$personal_title = '';
				   	if(isset($data_table_mem['post_title_disp']) && isset($data_val[$data_table_mem['post_title_disp']]) && $data_val[$data_table_mem['post_title_disp']] !='')
					{
						$personal_title = '<small> ( '.$data_val[$data_table_mem['post_title_disp']].' )</small>';
					}
					
				   	if(isset($data_val[$data_table_mem['title_disp']]) && $data_val[$data_table_mem['title_disp']] !='')
					{
						echo $tool_tip_img = strip_tags($data_val[$data_table_mem['title_disp']].$personal_title);
					}
					else
					{
						echo '-';
					}
					$status_filed ='status';
				   	if(isset($this->common_model->status_field) && $this->common_model->status_field !='')
				   	{
						$status_filed = $this->common_model->status_field;
				   	}
					
					$status_val = 'UNAPPROVED';
					if(isset($data_val[$status_filed]) && $data_val[$status_filed] !='')
					{
						$status_val = $data_val[$status_filed];
					}
					if(isset($status_arr_faList[$status_val]) && $status_arr_faList[$status_val] !='')
					{
						$thumb_val = $status_arr_faList[$status_val];
					}
					if(isset($status_arr_color_dm[$status_val]) && $status_arr_color_dm[$status_val] !='')
					{
						$thumb_val_color = $status_arr_color_dm[$status_val];
					}
					
					
					/*if($status_val =='Paid')
					{
						$thumb_val ='money text-success';
					}
					else if($status_val =='APPROVED')
					{
						$thumb_val ='thumbs-up text-success';
					}
					else
					{
						$thumb_val ='thumbs-down text-danger';
					}*/
				   ?>
                </h3>
                <?php
					$status_arr_comm = $this->common_model->status_arr;
					$status_val_disp = $status_val;
					if(isset($status_arr_comm[$status_val]) && $status_arr_comm[$status_val] !='')
					{
						$status_val_disp = $status_arr_comm[$status_val];
					}
					if(!isset($data_table_mem['disp_status']) || $data_table_mem['disp_status'] !='no')
					{
				?>		
   			  <ul class="col-lg-3 col-lg-4 col-xs-12 col-md-6 topRightDetail">
                    
                    <li class="col-lg-3 col-xs-4 text-right imgPaddingRightZero">
                        <i class="<?php echo $thumb_val.' '.$thumb_val_color; ?>"></i>
                    </li>
                    
				    <li class="col-lg-8 col-xs-8 text-left ">
                        <span class="<?php echo $thumb_val_color;?> text-bold"><?php echo $status_val_disp; ?> </span>
                    </li>
                </ul>
                <?php
					}
				?>
                <div class="clearfix"></div>
                <?php
				if(isset($display_img) && $display_img !='' && $display_img =='Yes')
				{
				?>
                <div class="col-lg-2 col-xs-12 col-sm-6 col-md-3 imgPaddingRightZero">
                	<?php
						$avatar = $this->common_model->photo_avtar;
						if(isset($data_val[$display_image_clm]) && $data_val[$display_image_clm] !='')
						{
							$temp_img = $data_val[$display_image_clm];
							if(file_exists($path_img.$temp_img))
							{
								$avatar = $path_img.$temp_img;
							}
						}
					?>
                    <img data-src="<?php echo $base_url.$avatar; ?>" title="<?php echo $tool_tip_img; ?>" alt="<?php echo $tool_tip_img; ?>" class=" img-responsive lazyload img-thumbnail" style="max-height:130px;">
                </div>
                <?php
					$lg_cl = 10;
					$md_cl = 9;
				}
				else
				{
					$lg_cl = 12;
					$md_cl = 12;
				}
				?>
                <div class="col-lg-<?php echo $lg_cl; ?> col-xs-12 col-md-<?php echo $md_cl; ?> neMarTop10-xs PaddingLftRigZero-xs ">
                	<?php
						if(isset($disp_column_array) && $disp_column_array !='' && count($disp_column_array) >0)
						{
							foreach($disp_column_array as $disp_column_array_val)
							{
					?>	
                    <div class="col-lg-6 col-xs-12 neAdminResultDetail">
                        <div class="col-lg-5 col-xs-4">
                            <?php echo $this->common_model->get_label('',$disp_column_array_val); ?>
                        </div>
                        <div class="col-lg-7 col-xs-8">:&nbsp;
                            <?php 
							if(isset($data_val[$disp_column_array_val]) && $data_val[$disp_column_array_val] !='')
							{
								if(isset($display_date_arr) && in_array($disp_column_array_val,$display_date_arr))
								{
									echo $this->common_model->displayDate($data_val[$disp_column_array_val]);
								}
								else if(isset($display_currency_arr) && in_array($disp_column_array_val,$display_currency_arr))
								{
									$currency ='';
									if(isset($data_val['Currency']) && $data_val['Currency'] !='')
									{
										$currency = $data_val['Currency'];
									}
									elseif(!isset($data_val['Currency']))
									{
										$currency = $this->common_front_model->get_current_currency();
									}
									echo $currency.' '.$data_val[$disp_column_array_val];
								}
								else if($disp_column_array_val =='CauseID')
								{
									echo $this->common_model->valueFromId('causes',$data_val[$disp_column_array_val],'CauseTitle','ID');
								}
								else
								{
									echo $data_val[$disp_column_array_val];
								}
							}
							else
							{
								echo 'N/A';
							}
							?>
                        </div>
                    </div>
                    <?php
							}
						}
					?>
                    <div class="clearfix"></div>
                    <?php
					if(isset($data_tab_btn_arr) && $data_tab_btn_arr !='' && count($data_tab_btn_arr) > 0)
					{
						
						foreach($data_tab_btn_arr as $data_tab_btn_arr_val)
						{
							$class = 'info';
							if(isset($data_tab_btn_arr_val['class']) && $data_tab_btn_arr_val['class'] !='')
							{
								$class = $data_tab_btn_arr_val['class'];
							}
							$href = '';
							$onClick_btn = '';
							$btn_leg_class = 'col-lg-2';
							if(isset($data_tab_btn_arr_val['btn_leg_class']) && $data_tab_btn_arr_val['btn_leg_class'] !='')
							{
								$btn_leg_class = $data_tab_btn_arr_val['btn_leg_class'];
							}
							if(isset($data_tab_btn_arr_val['url']) && $data_tab_btn_arr_val['url'] !='')
							{
								$href = $data_tab_btn_arr_val['url'];
								$href = str_replace('#id#',$temp_id,$href);
								$href = $base_url.$admin_path.'/'.$href;
							}
							if(isset($data_tab_btn_arr_val['onClick']) && $data_tab_btn_arr_val['onClick'] !='')
							{
								$onClick = $data_tab_btn_arr_val['onClick'];
								$onClick_btn = str_replace('#id#',$temp_id,$onClick);
							}
							$target ='';
							if(isset($data_tab_btn_arr_val['target']) && $data_tab_btn_arr_val['target'] !='')
							{
								$target = $data_tab_btn_arr_val['target'];
							}
					?>
                    <div class="<?php echo $btn_leg_class;?> col-xs-6 pull-right neMrgATop10" style="margin-top: 20px !important;">
                        <a target="<?php echo $target; ?>" onClick="<?php echo $onClick_btn; ?>" class="btn btn-<?php echo $class; ?> btn-flat btn-block" href="<?php echo $href; ?>">
                            <?php echo $data_tab_btn_arr_val['label']; ?>
                        </a>
                    </div>
                    <?php
						}
					}
					?>
        </div>
             </div>
              <hr/>
		</div>
       
        <?php
			}
		?>
        	<div class="clearfix"></div>
            <div>
	            <br/>
            	<div class="pull-left">
                    <div id="show_record_message">
                        <?php
						if(isset($this->common_model->data_tabel_filtered_count) && $this->common_model->data_tabel_filtered_count !='')
						{
							$data_tabel_filtered_count = $this->common_model->data_tabel_filtered_count;
							$limit_per_page = $this->common_model->limit_per_page;
							$start = 1;
							if(isset($this->common_model->start) && $this->common_model->start !='')
							{
								$start = $this->common_model->start;
								$start++;
							}
							$total_disp = $start + $limit_per_page -1;
							if($data_tabel_filtered_count < $total_disp)
							{
								$total_disp = $data_tabel_filtered_count;
							}
							echo 'Showing '.$start.' to '.$total_disp.' of '.$data_tabel_filtered_count.' entries';
							if($data_tabel_all_count > $data_tabel_filtered_count)
							{
								echo ' (filtered from '.$data_tabel_all_count.' total entries)';
							}
						}
						else if($data_tabel_all_count > 0)
						{
							echo "Showing 0 to 0 of 0 entries (filtered from $data_tabel_all_count total entries)";
						}
						?>
                    </div>
                </div>
                <div class="pull-right">
                    <?php
						if(isset($this->common_model->pagination_link) && $this->common_model->pagination_link !='')
						{
							echo $this->common_model->pagination_link;
						}
					?>
                </div>
            </div>
        <?php
		}
		else
		{
		?>
        <div>
        	<div class="alert alert-danger">No Record found</div>
        </div>
        <?php
		}
		?>
		<!-- for jobseeker data -->
    </div>
</div>