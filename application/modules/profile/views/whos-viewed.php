<?php

//echo '<pre>';
//print_r($viewed);
//echo '</pre>';
//exit;

?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Who's Viewed</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            Profile
                        </li>
                        <li class="active">
                            <strong>Who's Viewed</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            
            <?php 
            
            foreach ($viewed as $view) {
                
            ?>
            
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="member/profile/<?php echo $view->viewer_id?>">
                    <div class="col-sm-4">
                        <div class="text-center">
<!--                            <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/img/daniel_big.jpg">-->
                            <?php if(file_exists("public/main/template/gsm/images/members/".$view->viewer_id.".jpg")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $view->viewer_id; ?>.jpg" height="128" width="128"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                            <span class="label label-primary">Online</span>
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong><?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->firstname.' '.$this->member_model->get_where_multiple('id', $view->viewer_id)->lastname;?></strong></h3>
                        	<?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->role; ?>
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->company_name; ?></strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_1; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_2; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_3; ?></li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                            <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='member/profile/<?php echo $view->viewer_id?>'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            <?php
                            
                                $this->load->module('profile');
                                $this->profile->send_message($view->viewer_id);
                            
                            ?>
            <?php } ?>
       	</div><!-- Row End -->
        <div class="row" style="margin:0 0 25px 0">
        <div class="btn-group pull-right">
        	<button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i></button>
            <button class="btn btn-white">1</button>
            <button class="btn btn-white  active">2</button>
            <button class="btn btn-white">3</button>
            <button class="btn btn-white">4</button>
            <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i> </button>
        </div>
        </div>
        
           
        </div>
                            
                               
            