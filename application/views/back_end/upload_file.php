<style type="text/css">
.panel-primary .panel-heading div
{
	margin-top: -10px;
}
</style>
<?php
if(!isset($back_detail_url))
{
	$back_detail_url = '';
}
?>
<div align="left no-print">
	<a class="btn btn-info" href="<?php echo $base_url.$this->common_model->admin_path.'/'.$this->common_model->class_name.'/'.$back_detail_url; ?>"><i class="fa fa-arrow-left"></i> Back to list</a>
    <div class="row">
    <div class="col-xs-12">
       	<div align="left">
        	<h1>Drag and drop your file here</h1>
            <form action="<?php echo $this->common_model->base_url_admin.$upload_path_file; ?>" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" id="hash_tocken_id" class="hash_tocken_id" />
                <input type="hidden" name="<?php echo $coulmn_main_name; ?>" value="<?php echo $main_id;?>" id="main_id" />
                <input type="hidden" name="class_name" value="<?php echo $this->router->fetch_class();?>" id="class_name" />
                <input type="hidden" name="base_url_admin" value="<?php echo $this->common_model->base_url_admin;?>" id="base_url_admin" />
            </form>
        </div>
    </div>
    <br/><br/>
</div>
</div>
<?php
$size = $this->common_model->max_size_file_upload;
$def_size = 5;
if($size !='' && $size > 0)
{
	$def_size = round(($size / 1024),2);
}
$total_allowed_up = 50;
$where_arra = array($coulmn_main_name=>$main_id);
$photo_count = $this->common_model->get_count_data_manual($tabel_name,$where_arra,0);
$total_allowed_up = $total_allowed_up - $photo_count;
/*
	Dropzone.options.imageUpload = {
		maxFilesize:'.$def_size.',
		acceptedFiles: ".jpeg,.jpg,.png,.gif"
};*/

$this->common_model->js_extra_code.= '
	 Dropzone.options.imageUpload = {
		maxFilesize:'.$def_size.',
		acceptedFiles: ".jpeg,.jpg,.png,.gif",
		maxFiles:'.$total_allowed_up.',		
	};
';
?>	