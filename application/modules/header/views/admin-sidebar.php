
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
                <li class="nav-header">

                <div class="logo-element">
                    GSM
                </div>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit Subscriptions</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/user_level"><i class="fa fa-cog"></i> <span class="nav-label">User Level</span></a></li>
                    <li><a href="admin/subscription_access"><i class="fa fa-cog"></i> <span class="nav-label">Subscription Access</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wechat"></i> <span class="nav-label">Profile Updates</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="admin/company_bio"><i class="fa fa-cog"></i> <span class="nav-label">Company Bio</span><?php $this->load->module('company'); $this->company->admin_companybio_count();?></a></li>
                    <li><a href="admin/feed"><i class="fa fa-cog"></i> <span class="nav-label">Profile Feed</span><?php $this->load->module('feed'); $this->feed->admin_feed_count();?></a></li>
                    <li><a href="admin/feedback"><i class="fa fa-cog"></i> <span class="nav-label">Feedback</span><?php $this->load->module('feedback'); $this->feedback->admin_feed_count();?></a></li>
                
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Edit Profiles</span><span class="fa arrow"></span></a></a>
                <ul class="nav nav-second-level">
                    <li><a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit User</span></a></li>
                    <li><a href="#"><i class="fa fa-users"></i> <span class="nav-label">Edit Company</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-shoppig-cart"></i> <span class="nav-label">Marketplace</span><span class="fa arrow"></span></a></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url().'admin/add_listing_attribute';?>"><span class="nav-label">Add Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing_attributes';?>"><span class="nav-label">View Listing Attributes</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing';?>"><span class="nav-label">View Listing</span></a></li>
                    <li><a href="<?php echo base_url().'admin/couriers';?>"><span class="nav-label">Couriers</span></a></li>
                    <li><a href="<?php echo base_url().'admin/shippings';?>"><span class="nav-label">Shipping terms</span></a></li>
                    <li><a href="<?php echo base_url().'admin/listing_categories';?>"><span class="nav-label">Listing Categories</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>