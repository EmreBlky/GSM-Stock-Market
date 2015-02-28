	
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
                            <li><a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Company Bio</span><!-- <span class="label label-warning pull-right">7</span> --></a></li>
                            <li><a href="admin/feed"><i class="fa fa-cog"></i> <span class="nav-label">Profile Feed</span><?php $this->load->module('feed'); $this->feed->admin_feed_count();?></a></li>
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
                        </ul>
                    </li>
                    
                </ul>

            </div>
        </nav>
