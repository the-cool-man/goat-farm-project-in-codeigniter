<div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            <!-- Main Title (hidden on small devices for the statistics to fit) -->
            		<?php
					$user_data = $this->common_model->get_session_data();					
					?>
            <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                <h1>Howdy, <strong>Mr. <?php echo $user_data['Username'];?></strong><br><small>You Look Awesome!!!   Here is some site quick summary.</small></h1>
            </div>
            <!-- END Main Title -->

            
        </div>
    </div>
    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
    <img src="<?php echo $base_url;?>assets/back_end/img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
</div>
<div class="row">
	<div class="col-sm-6">
        <!-- Widget -->
        <a href="<?php echo $base_url.$admin_path.'/breed/breed_list/';?>" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background animation-fadeIn">
                   <i class="fa fa-vk"></i>
                </div>
                <div class="pull-right">
                   
                    <span id="mini-chart-sales"></span>
                </div>
                <h3 class="widget-content animation-pullDown text-right">
                    Total <strong>Goat Breed</strong>
                    <small><?php echo $this->common_model->get_count_data_manual('goat_breed',array("IsDeleted"=>"N"));?></small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6">
        <!-- Widget -->
        <a href="<?php echo $base_url.$admin_path.'/gallery/photo-list/';?>" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background animation-fadeIn">
                   <i class="fa fa-file-image-o"></i>
                </div>
                <div class="pull-right">
                   
                    <span id="mini-chart-brand"></span>
                </div>
                <h3 class="widget-content animation-pullDown text-right">
                    Total <strong>Gallery Images</strong>
                    <small><?php echo $this->common_model->get_count_data_manual('gallery_master',array("IsDeleted"=>"N"));?></small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
</div>
