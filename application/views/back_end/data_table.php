<?php
$data_table_parameter = array();
if(isset($this->common_model->data_table_parameter) && $this->common_model->data_table_parameter !='')
{
	$data_table_parameter = $this->common_model->data_table_parameter;
}
$other_config_data = '';
$display_image_arr = '';
$ele_array = '';
$disp_check_box = 0;
if(!isset($this->common_model->status_arr_change) || $this->common_model->status_arr_change =='')
{
	$this->common_model->status_arr_change = $this->common_model->status_arr;
}
if(isset($this->common_model->ele_array) && $this->common_model->ele_array !='')
{
	$ele_array = $this->common_model->ele_array;
}
$display_date_arr = array();
$display_currency_arr = array();
if(isset($this->common_model->display_date_arr) && $this->common_model->display_date_arr !='')
{
	$display_date_arr = $this->common_model->display_date_arr;
}
if(isset($this->common_model->display_currency_arr) && $this->common_model->display_currency_arr !='')
{
	$display_currency_arr = $this->common_model->display_currency_arr;
}
	if(isset($this->common_model->other_config) && $this->common_model->other_config !='')
	{
		$other_config_data = $this->common_model->other_config;
		
		if(isset($other_config_data['display_image']) && $other_config_data['display_image'] !='' && is_array($other_config_data['display_image']))
		{
			$display_image_arr = $other_config_data['display_image'];
			$temp_arr = array();
			foreach($display_image_arr as $display_image_arr_val)
			{
				if(isset($ele_array[$display_image_arr_val]) && $ele_array[$display_image_arr_val] !='')
				{
					$temp_arr[$display_image_arr_val] = $ele_array[$display_image_arr_val]['path_value'];
				}
			}
			$display_image_arr = $temp_arr;
		}
	
	}
	
$admin_path = $this->common_model->getconfingValue('admin_path');
$base_url = base_url();
$status_arr_faList = array('A'=>'fa fa-thumbs-up','I'=>'fa fa-thumbs-down ','Paid'=>'fa fa-money','Suspended'=>'fa fa-user-times');
$status_arr_colorList = array('A'=>'btn-success','I'=>'btn-warning','Paid'=>'btn-success','Suspended'=>'btn-danger');
$status_arr_color_dm = array('A'=>'text-success','I'=>'text-warning','Paid'=>'text-success','Suspended'=>'text-danger');
$data_tabel_all_count = 0;
if(isset($this->common_model->data_tabel_all_count) && $this->common_model->data_tabel_all_count !='')
{
	$data_tabel_all_count = $this->common_model->data_tabel_all_count;
}
$data_tabel_filed = array();
if(isset($this->common_model->data_tabel_filed) && $this->common_model->data_tabel_filed !='')
{
	$data_tabel_filed = $this->common_model->data_tabel_filed;
}
$data_table_not_disp = array();
if(isset($this->common_model->join_tab_array_filed_disp) && $this->common_model->join_tab_array_filed_disp !='')
{
	$join_tab_array_filed_disp = $this->common_model->join_tab_array_filed_disp;
	if(count($join_tab_array_filed_disp) > 0)
	{
		foreach($join_tab_array_filed_disp as $key_lab=>$join_tab_array_filed_disp_val)
		{
			$data_tabel_filed[] = $join_tab_array_filed_disp_val;
		}
	}
}
if(isset($this->common_model->filed_notdisp) && $this->common_model->filed_notdisp !='')
{
	$data_table_not_disp = $this->common_model->filed_notdisp;
}
$data_tab_btn_arr = '';
if(isset($other_config_data['data_tab_btn']) && $other_config_data['data_tab_btn'] !='')
{
	$data_tab_btn_arr = $other_config_data['data_tab_btn'];
}
if(isset($other_config_data['load_member']) && $other_config_data['load_member'] =='yes')
{
	include_once("data_table_member.php");
	//$this->load->view('back_end/data_table_member');
}
else
{
?>
<!--<style type="text/css">
table{
    width: 200px;
}
table td{ width: 100px !important;}
</style>-->

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
						$add_label = 'Add New';
						if(isset($other_config_data['addNewLabel']) && $other_config_data['addNewLabel'] !='')
						{
							$add_label = $other_config_data['addNewLabel'];
						}
						if(isset($addPopup) && $addPopup =='1')
						{
					?>
						<a id="new" onClick="add_data_popup()" data-toggle="modal" data-target="#myModal" class="btn btn-default mb15 ml15"><i class="fa fa-plus fa-fw"></i>&nbsp;&nbsp;<?php echo $add_label;?>&nbsp;</a>
					<?php		
						}
						else
						{
					?>
						<a id="new" href="<?php echo $this->common_model->base_url_admin_cm;?>add-data" class="btn btn-default mb15 ml15"><i class="fa fa-plus fa-fw"></i>&nbsp;&nbsp;<?php echo $add_label;?>&nbsp;</a>
					<?php		
						}
					}
					?>
						<a href="<?php echo $this->common_model->base_url_admin_cm;?>" class="btn btn-primary mb15 ml15"><i class="fa fa-list fa-fw"></i>&nbsp;&nbsp;All (<?php echo $data_tabel_all_count; ?>)&nbsp;</a>
                        
                        
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
					if(isset($other_config_data['display_notes']) && $other_config_data['display_notes'] !='')
					{
				?>
                <div class="pull-right"><?php echo $other_config_data['display_notes']; ?></div>
                <?php
					}
				?>
                <hr style="border:1px solid rgba(0,0,0,.06);height:0px;margin-bottom:0px" />
                </div>
                <?php
                if($this->session->flashdata('success_message'))
                {
                   echo $message_div='<div class="alert alert-success  alert-dismissable"><div class="fa fa-check">&nbsp;</div><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$this->session->flashdata('success_message').'</div>';
				   $this->session->unset_userdata('success_message');
                }
				if($this->session->flashdata('error_message'))
				{
					echo $message_div='<div class="alert alert-danger alert-dismissable"><div class="fa fa-warning"></div><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$this->session->flashdata('error_message').'</div>';
					$this->session->unset_userdata('error_message');
				}
				if(isset($this->common_model->data_tabel_filtered_count) && $this->common_model->data_tabel_filtered_count !='' && $this->common_model->data_tabel_filtered_count > 0)
				{
				?>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                <?php
					if(!isset($other_config_data['deleteAllow']) || $other_config_data['deleteAllow'] !='no')
					{
						$disp_check_box = 1;
				?>	
                    <a onClick="return update_status('DELETE')" href="#" class="btn btn-danger mb15 ml15"><i class="fa fa-trash fa-fw"></i>&nbsp;&nbsp;Delete&nbsp;</a>
                <?php
					}
					if(!isset($other_config_data['statusChangeAllow']) || $other_config_data['statusChangeAllow'] !='no')
					{
						$disp_check_box = 1;
						$status_arr = $this->common_model->status_arr_change;
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
                
                
                </form>
            </div>
            <div class="row">
            	<div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered bordered table-striped table-condensed datatable">
                            <thead>
                              <tr>
                              <?php
							  	$count_filed = 0;
							  	if(isset($data_tabel_filed) && $data_tabel_filed !='' && count($data_tabel_filed) > 0)
								{
									$count_filed = count($data_tabel_filed);
									if($disp_check_box == 1)
									{
										echo '<th><label class="cb-checkbox mb0" id="all_check"><input class="all_check " type="checkbox" id="all" /></label></th>';
										$count_filed++;
									}
									if(isset($data_tab_btn_arr) && $data_tab_btn_arr !='' && count($data_tab_btn_arr) > 0)
									{
										foreach($data_tab_btn_arr as $data_tab_btn_arr_val)
										{
											echo '<th>'.$data_tab_btn_arr_val['label'].'</th>';
											$count_filed++;
										}
									}
									$remove_sort_array = array();
									if(isset($data_table_parameter['remove_sort']))
									{
										$remove_sort_array = $data_table_parameter['remove_sort'];
									}
									$editAllow = 0;
									if(!isset($other_config_data['editAllow']) || $other_config_data['editAllow'] !='no')
									{
										$editAllow = 1;
									}
									
									/* onclick="check_all()" */
									if($editAllow ==1)
									{
										echo '<th>Edit</th>';
										$count_filed++;
									}
									foreach($data_tabel_filed as $data_filed_val)
									{
										if(isset($data_table_not_disp) && in_array($data_filed_val,$data_table_not_disp))
										{
											continue;
										}
										$data_filed_disp = $this->common_model->get_label('',$data_filed_val);
										if(isset($remove_sort_array) && !in_array($data_filed_val,$remove_sort_array))
										{
											if(isset($data_table_parameter['default_sort']) && $data_filed_val == $data_table_parameter['default_sort'])
											{
												if($data_table_parameter['default_order'] =='ASC')
												{
													echo '<th style="cursor: pointer;max-width:20%;min-width:15%" title="Click to sort DESC" onClick="change_order('."'".$data_filed_val."',"."'DESC'".')">';
													echo ''.$data_filed_disp;
										?>
											&nbsp;<i style="font-weight:bold" class="fa fa-caret-up" aria-hidden="true"></i>
										<?php
												}
												else
												{
													echo '<th style="cursor: pointer;max-width:20%;min-width:15%" title="Click to sort ASC" onClick="change_order('."'".$data_filed_val."',"."'ASC'".')">';
													echo ''.$data_filed_disp;
										?>
											&nbsp;<i style="font-weight:bold" class="fa fa-caret-down" aria-hidden="true"></i>
										<?php
												}
											}
											else
											{
												echo '<th style="cursor: pointer;max-width:20%;min-width:15%" title="Click to sort ASC" onClick="change_order('."'".$data_filed_val."',"."'ASC'".')">';
												echo ''.$data_filed_disp;
											}
										}
										else
										{
											echo '<th>'.$data_filed_disp;
										}
								?>
                                </th>
                              <?php
									}
								}
							  ?>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php 
								if(isset($this->common_model->data_tabel_data) && $this->common_model->data_tabel_data !='' && count($this->common_model->data_tabel_data) > 0)
								{
									foreach($this->common_model->data_tabel_data as $data_val)
									{
										$temp_id = $data_val[$this->common_model->primary_key];
										$temp_edit_pop = '';
										$temp_edit_pop.= 'data-'.$this->common_model->primary_key.'="'.$data_val[$this->common_model->primary_key].'" ';
								?>
                                <tr>
                                	<?php
										if(isset($disp_check_box) && $disp_check_box == 1)
										{
											echo '<td class="checkbox-row" style="width:5%;"><label class="cb-checkbox"><input type="checkbox" class="checkbox_val" name="checkbox_val[]" value="'.$temp_id.'" ></label></td>'; /* onclick="check_uncheck_all()"  */
										}
										if(isset($data_tab_btn_arr) && $data_tab_btn_arr !='' && count($data_tab_btn_arr) > 0)
										{
											foreach($data_tab_btn_arr as $data_tab_btn_arr_val)
											{
												if(isset($data_tab_btn_arr_val['own_only']) && $data_tab_btn_arr_val['own_only'] =='yes')
												{
													if(isset($data_val[$user_id_check_filed]) && isset($user_logged_id) && $data_val[$user_id_check_filed] == $user_logged_id)
													{														
													}
													else
													{
														echo '<td>-</td>';
														continue;
													}
												}
												$class = 'info';
												if(isset($data_tab_btn_arr_val['class']) && $data_tab_btn_arr_val['class'] !='')
												{
													$class = $data_tab_btn_arr_val['class'];
												}
												$href = '';
												$onClick_btn = '';
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
                                       	<td>
                                       		<a target="<?php echo $target; ?>" onClick="<?php echo $onClick_btn; ?>" class="btn btn-<?php echo $class; ?> " href="<?php echo $href; ?>"><?php echo $data_tab_btn_arr_val['label']; ?></a>
                                       	</td>
                                        <?php
											}
										}
										
										$temp_data_display = '';
										foreach($data_tabel_filed as $data_filed_val)
										{
											$data_val_disp = '-';
											if($editAllow ==1)
											{
												if(isset($addPopup) && $addPopup =='1')
												{
													$temp_edit_pop.= 'data-'.$data_filed_val.'="'.$data_val[$data_filed_val].'" ';
												}
											}
											if(isset($data_val[$data_filed_val]) && $data_val[$data_filed_val] !='')
											{
												$data_val_disp = htmlspecialchars_decode($data_val[$data_filed_val],ENT_QUOTES);
											}
											
											if($this->common_model->status_column == $data_filed_val)
											{
												if(isset($data_val[$data_filed_val]) && $data_val[$data_filed_val] !='')
												{
													if(isset($status_arr_faList[$data_val[$data_filed_val]]) && $status_arr_faList[$data_val[$data_filed_val]] !='') 
													{
														$data_val_disp = '<i class="'.$status_arr_faList[$data_val[$data_filed_val]].'"></i>';
													}
												}
											}
											else if($data_filed_val =='SocialLogo')
											{
												$data_val_disp = '<i class="'.$data_val[$data_filed_val].'"></i>';
											}
											else if(isset($display_date_arr) && in_array($data_filed_val,$display_date_arr))
											{
												$data_val_disp = $this->common_model->displayDate($data_val_disp);
											}
											else if(isset($display_currency_arr) && in_array($data_filed_val,$display_currency_arr))
											{
												$currency='';
												if(isset($data_val['Currency']) && $data_val['Currency'] !='')
												{
													$currency = $data_val['Currency'];
												}
												elseif(!isset($data_val['Currency']))
												{
													$currency = $this->common_front_model->get_current_currency();
												}
												 $data_val_disp =  $currency.' '.$data_val_disp;
											}
											else if(isset($display_image_arr[$data_filed_val]) && $display_image_arr[$data_filed_val] !='' && $data_val_disp !='' && file_exists($display_image_arr[$data_filed_val].$data_val_disp))
											{
												$data_filed_val_path = $display_image_arr[$data_filed_val];
												if($data_filed_val =='resume_file')
												{
													$data_val_disp = '<a target="_blank" href="'.$base_url.$data_filed_val_path.$data_val_disp.'" >View Resume</a>';
												}
												else
												{
													$data_val_disp = '<img style="max-height:150px;max-width:150px" class="lazyload img-responsive magniflier img-thumbnail" data-src="'.$base_url.$data_filed_val_path.$data_val_disp.'" />';
												}
											}
											if(isset($data_table_not_disp) && in_array($data_filed_val,$data_table_not_disp))
											{
												//continue;
											}
											else
											{
												$temp_data_display.= '<td>'.$data_val_disp.'</td>';
											}
										}
										if($editAllow ==1)
										{
											if(isset($addPopup) && $addPopup =='1')
											{
												echo '<td style="width:10%;"><a id="id_'.$temp_id.'" onclick="return edit_data_popup('.$temp_id.')" class="btn btn-info" data-toggle="modal" data-target="#myModal" '.$temp_edit_pop.' ><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit</a></td>';
											}
											else
											{
												echo '<td style="width:10%;"><a class="btn btn-info" href="'.$this->common_model->base_url_admin_cm.'edit-data/'.$temp_id.'"><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit</a></td>';
											}
										}
										echo $temp_data_display; 
									?>
                                </tr>
                                <?php
									}
								}
								else
								{
								?>
                                <tr><td colspan="<?php if(isset($count_filed) && $count_filed !=''){ echo $count_filed;} ?>"><div class="alert alert-danger">No Record found</div></td></tr>
                                <?php
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
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
    	</div>
    </div>
<?php
}
?>
<input type="hidden" name="base_url_admin" id="base_url_admin" value="<?php echo $this->common_model->base_url_admin.$this->common_model->class_name; ?>" />
<input type="hidden" name="base_url_ajax" id="base_url_ajax" value="<?php echo $this->common_model->base_url_admin_cm_status; ?>" />
<input type="hidden" id="hash_tocken_id_temp" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="default_sort" id="default_sort" value="<?php if(isset($data_table_parameter['default_sort']) && $data_table_parameter['default_sort'] !=''){ echo $data_table_parameter['default_sort']; };?>" />
<input type="hidden" name="default_order" id="default_order" value="<?php if(isset($data_table_parameter['default_order']) && $data_table_parameter['default_order'] !=''){ echo $data_table_parameter['default_order']; };?>" />
<input type="hidden" id="status_mode" value="<?php echo $this->common_model->status_mode; ?>" />
