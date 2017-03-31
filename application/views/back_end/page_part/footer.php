		  </div>
          <footer class="clearfix">
            <div class="pull-right">
                Developed by <a href="http://www.emaad-infotech.com" target="_blank">Emaad Infotech</a>
            </div>
            <div class="pull-left">
            	  <span> <i class="fa fa-copyright"></i>      <?php if(isset($config_data['CopyRightContent'])) {echo $config_data['CopyRightContent'];}?></span>            
            </div>
        </footer>
	</div>
    
    </div>
    </div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id" class="hash_tocken_id" />
<input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url; ?>" />
<div id="lightbox-panel-mask"></div>
<div id="lightbox-panel-loader" style="text-align:center"><img alt="Please wait.." title="Please wait.." src='<?php echo $base_url; ?>assets/back_end/images/loading.gif' /></div>
 <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button onClick="close_popup()" type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="model_title">
        	<?php if(isset($model_title) && $model_title !=''){ echo $model_title;} ?>
        </h4>
      </div>
      <div class="modal-body" id="model_body">
      	<?php if(isset($model_body) && $model_body !=''){ echo $model_body;} ?>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>
<div id="myModal_filter" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="model_title_fil">
        	<?php if(isset($model_title_fil) && $model_title_fil !=''){ echo $model_title_fil;} ?>
        </h4>
      </div>
      <div class="modal-body" id="model_body_fil">
      	<?php if(isset($model_body_fil) && $model_body_fil !=''){ echo $model_body_fil;} ?>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>

<!-- Common model for all ajax response data display-->
<div id="myModal_common" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="model_title_common">
        	
        </h4>
      </div>
      <div class="modal-body" id="model_body_common">
      	
      </div>
      <div class="modal-footer">
		
      </div>      
    </div>
  </div>
</div>

<script src="<?php echo $base_url; ?>assets/back_end/js/vendor/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>assets/back_end/js/vendor/bootstrap.min.js"></script> 

<script src="<?php echo $base_url; ?>assets/back_end/js/app.js"></script>
<script src="<?php echo $base_url; ?>assets/back_end/js/plugins.js"></script>


<script src="<?php echo $base_url; ?>assets/back_end/js/common.js?ver=2.3"></script>

<?php if(isset($page_title) && $page_title =='Dashboard')
	{
?>
<?php
}
if(isset($this->common_model->extra_js) && $this->common_model->extra_js !='' && count($this->common_model->extra_js) > 0)
{
	$extra_js = $this->common_model->extra_js;
	foreach($extra_js as $extra_js_val)
	{
?>
<script src="<?php echo $base_url.'assets/back_end/'.$extra_js_val; ?>"></script>
<?php
	}
}
?>
<script type="text/javascript">

if($("#form_model_search").length > 0)
{
	$("#form_model_search").validate({
		submitHandler: function(form)
	  	{
			model_search();
			return false;
	  	}
	});
}
if($("#common_insert_update").length > 0)
{
	$("#common_insert_update").validate({
	  /*rules: {
			file: {
				required: true, 
				extension: "png|jpeg|jpg",
			}
		},
		 messages: 
		   { 
			file: "File must be JPEG or PNG, less than 1MB" 
		  },
	  */
	  <?php
		if(isset($this->common_model->js_validation_extra) && $this->common_model->js_validation_extra !='')
		{
			echo $this->common_model->js_validation_extra;
		}
	  ?>
	  submitHandler: function(form) 
	  {
		<?php
			if(isset($this->common_model->addPopup) && $this->common_model->addPopup =='1')
			{
		?>
		  common_submit_fomr();
		  return false;
		<?php
			}
			else
			{
		?>
		  return true;
		<?php
			}
		?>
		//form.submit();
	  }
	});
}
$(function()
{
	//  $('html').checkBo();
	  //$('html').checkBo({checkAllButton:"#all_check",checkAllTarget:".checkbox-row",checkAllTextDefault:"Check All",checkAllTextToggle:"Un-check All"});
	<?php
	$class_name = $this->router->fetch_class();
	$method_name = $this->router->fetch_method();
	
	if($class_name !=''  && $method_name !='')
	{
	?>
		$("#<?php echo $class_name; ?>").addClass(' active ');
		<?php
		if($method_name =='add_data')
		{
	?>
	
		$("#<?php echo $class_name; ?> .<?php echo $class_name.'_add'; ?>").addClass(' active ');
	<?php
		}
		else
		{
	?>
		$("#<?php echo $class_name; ?> #<?php echo $method_name; ?>").addClass(' active ');
		$("#<?php echo $class_name; ?> .<?php echo $method_name; ?>").addClass(' active ');
	<?php
		}
	}
	else
	{
	?>
		$("#<?php echo $class_name; ?>").addClass(' active ');
	<?php
	}
	?>
	if($("#ajax_pagin_ul").length > 0)
	{
		load_pagination_code();
	}
	else
	{
		load_checkbo();
	}
	$(document).on('input', '.clearable', function()
	{
		$(this)[tog(this.value)]('x');
	}).on('mousemove', '.x', function( e )
	{
		$(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');   
	}).on('touchstart click', '.onX', function( ev )
	{
		ev.preventDefault();
		$(this).removeClass('x onX').val('').change();
	});

	/* for scroll to top*/
     $(window).scroll(function () 
	 {
     	if ($(this).scrollTop() > 50) 
		{
        	$('#back-to-top').fadeIn();
        }
		else 
		{
            $('#back-to-top').fadeOut();
        }
     });
     // scroll body to 0px on click
     $('#back-to-top').click(function () 
	 {
        $('body,html').animate({
        	scrollTop: 0
        }, 1000);
        return false;
     });
	/* for scroll to top*/
});
<?php
	if(isset($this->common_model->js_extra_code) && $this->common_model->js_extra_code !='')
	{
		echo $this->common_model->js_extra_code;
	}
?>
</script>
</body>
</html>