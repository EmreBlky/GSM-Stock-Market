<?php $url = $this->uri->segment(2);?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
                <li class="nav-header">

                <div class="logo-element">
                    GSM
                </div>
            </li>
            <li>
                <a href="admin/"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php if($url == 'user_level' || $url == 'subscription_access') {?>
            <li class="active">
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit Subscriptions</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/user_level"><i class="fa fa-cog"></i> <span class="nav-label">User Level</span></a></li>
                    <li><a href="admin/subscription_access"><i class="fa fa-cog"></i> <span class="nav-label">Subscription Access</span></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit Subscriptions</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/user_level"><i class="fa fa-cog"></i> <span class="nav-label">User Level</span></a></li>
                    <li><a href="admin/subscription_access"><i class="fa fa-cog"></i> <span class="nav-label">Subscription Access</span></a></li>
                </ul>
            </li>
            <?php }?>
            
            <?php if($url == 'company_bio' || $url == 'feed' || $url == 'feedback' || $url == 'upgrades') {?>
            <li class="active">
                <a href="#"><i class="fa fa-wechat"></i> <span class="nav-label">Profile Updates</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/company_bio"><i class="fa fa-cog"></i> <span class="nav-label">Company Bio</span><?php $this->load->module('company'); $this->company->admin_companybio_count();?></a></li>
                    <li><a href="admin/feed"><i class="fa fa-cog"></i> <span class="nav-label">Profile Feed</span><?php $this->load->module('feed'); $this->feed->admin_feed_count();?></a></li>
                    <li><a href="admin/feedback"><i class="fa fa-cog"></i> <span class="nav-label">Feedback</span><?php $this->load->module('feedback'); $this->feedback->admin_feed_count();?></a></li>
                    <li><a href="admin/upgrades"><i class="fa fa-cog"></i> <span class="nav-label">Account Upgrade</span><?php $this->load->module('transaction'); $this->transaction->admin_transaction_count();?></a></li>
                
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa-wechat"></i> <span class="nav-label">Profile Updates</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/company_bio"><i class="fa fa-cog"></i> <span class="nav-label">Company Bio</span><?php $this->load->module('company'); $this->company->admin_companybio_count();?></a></li>
                    <li><a href="admin/feed"><i class="fa fa-cog"></i> <span class="nav-label">Profile Feed</span><?php $this->load->module('feed'); $this->feed->admin_feed_count();?></a></li>
                    <li><a href="admin/feedback"><i class="fa fa-cog"></i> <span class="nav-label">Feedback</span><?php $this->load->module('feedback'); $this->feedback->admin_feed_count();?></a></li>
                    <li><a href="admin/upgrades"><i class="fa fa-cog"></i> <span class="nav-label">Account Upgrade</span><?php $this->load->module('transaction'); $this->transaction->admin_transaction_count();?></a></li>
                
                </ul>
            </li>
            <?php } ?>
            
            <?php if($url == 'edit_use' || $url == 'edit_company') {?>
            <li class="active">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Edit Profiles</span><span class="fa arrow"></span></a></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/edit_user"><i class="fa fa-user"></i> <span class="nav-label">Edit User</span></a></li>
                    <li><a href="admin/edit_company"><i class="fa fa-users"></i> <span class="nav-label">Edit Company</span></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Edit Profiles</span><span class="fa arrow"></span></a></a>
                <ul class="nav nav-second-level">
                    <li><a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit User</span></a></li>
                    <li><a href="#"><i class="fa fa-users"></i> <span class="nav-label">Edit Company</span></a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($url == 'add_listing_attribute' || $url == 'listing_attributes' || $url == 'listing' || $url == 'product_make' || $url == 'product_model' || $url == 'product_color' || $url == 'couriers' || $url == 'shippings' || $url == 'product_types'|| $url == 'color_attributes'|| $url == 'edit_color_attribute'|| $url == 'add_color_attribute'|| $url == 'add_spec_attribute'|| $url == 'spec_attributes'|| $url == 'edit_spec_attribute'|| $url == 'add_condition_attribute'|| $url == 'edit_condition_attribute'|| $url == 'condition') {?>
            <li class="active">
                <a href="#"><i class="fa fa-shoppig-cart"></i> <span class="nav-label">Marketplace</span><span class="fa arrow"></span></a></a>
                <ul class="nav nav-second-level">
                     <li><a href="<?php echo base_url().'admin/add_color_attribute';?>"><span class="nav-label">Add Color </span></a></li>
                    <li><a href="<?php echo base_url().'admin/color_attributes';?>"><span class="nav-label">View Color </span></a></li>

                    <li><a href="<?php echo base_url().'admin/add_spec_attribute';?>"><span class="nav-label">Add Specification </span></a></li>
                    <li><a href="<?php echo base_url().'admin/spec_attributes';?>"><span class="nav-label">View Specification </span></a></li>

                    <li><a href="<?php echo base_url().'admin/add_condition_attribute';?>"><span class="nav-label">Add Condition </span></a></li>
                    <li><a href="<?php echo base_url().'admin/condition';?>"><span class="nav-label">View Condition </span></a></li>

                    <li><a href="<?php echo base_url().'admin/add_listing_attribute';?>"><span class="nav-label">Add Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing_attributes';?>"><span class="nav-label">View Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing';?>"><span class="nav-label">View Listing</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_make';?>"><span class="nav-label">View Product Make</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_model';?>"><span class="nav-label">View Prouduct Model</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_color';?>"><span class="nav-label">View Prouduct Color</span></a></li>
                    <li><a href="<?php echo base_url().'admin/couriers';?>"><span class="nav-label">Couriers</span></a></li>
                    <li><a href="<?php echo base_url().'admin/shippings';?>"><span class="nav-label">Shipping terms</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_types';?>"><span class="nav-label">Product Types</span></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Marketplace</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                     <li><a href="<?php echo base_url().'admin/add_color_attribute';?>"><span class="nav-label">Add Color </span></a></li>
                    <li><a href="<?php echo base_url().'admin/color_attributes';?>"><span class="nav-label">View Color </span></a></li>

                    <li><a href="<?php echo base_url().'admin/add_spec_attribute';?>"><span class="nav-label">Add Specification </span></a></li>
                    <li><a href="<?php echo base_url().'admin/spec_attributes';?>"><span class="nav-label">View Specification </span></a></li>

                    <li><a href="<?php echo base_url().'admin/add_condition_attribute';?>"><span class="nav-label">Add Condition </span></a></li>
                    <li><a href="<?php echo base_url().'admin/condition';?>"><span class="nav-label">View Condition </span></a></li>
                    
                    <li><a href="<?php echo base_url().'admin/add_listing_attribute';?>"><span class="nav-label">Add Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing_attributes';?>"><span class="nav-label">View Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing';?>"><span class="nav-label">View Listing</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_make';?>"><span class="nav-label">View Product Make</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_model';?>"><span class="nav-label">View Prouduct Model</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_color';?>"><span class="nav-label">View Prouduct Color</span></a></li>
                    <li><a href="<?php echo base_url().'admin/couriers';?>"><span class="nav-label">Couriers</span></a></li>
                    <li><a href="<?php echo base_url().'admin/shippings';?>"><span class="nav-label">Shipping terms</span></a></li>
                    <li><a href="<?php echo base_url().'admin/product_types';?>"><span class="nav-label">Product Types</span></a></li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="admin/trade_ref"><i class="fa fa-slideshare"></i> <span class="nav-label">Trade References</span></a>
            </li>
            <?php if($url == 'add_event' || $url == 'edit_event') {?>
            <li class="active">
                <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Events</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url().'admin/add_event';?>"><span class="nav-label">Add Event</span></a></li>
                    <li><a href="<?php echo base_url().'admin/edit_event';?>"><span class="nav-label">Edit Event</span></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa fa-calendar"></i> <span class="nav-label">Events</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url().'admin/add_event';?>"><span class="nav-label">Add Event</span></a></li>
                    <li><a href="<?php echo base_url().'admin/edit_event';?>"><span class="nav-label">Edit Event</span></a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($url == 'terms_conditions' || $url == 'privacy_policy') {?>
            <li class="active">
                <a href="#"><i class="fa fa-legal"></i> <span class="nav-label">Legal</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url().'admin/terms_conditions';?>"><span class="nav-label">Terms & Conditions</span></a></li>
                    <li><a href="<?php echo base_url().'admin/privacy_policy';?>"><span class="nav-label">Privacy Policy</span></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#"><i class="fa fa fa-legal"></i> <span class="nav-label">Legal</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url().'admin/terms_conditions';?>"><span class="nav-label">Terms & Conditions</span></a></li>
                    <li><a href="<?php echo base_url().'admin/privacy_policy';?>"><span class="nav-label">Privacy Policy</span></a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>