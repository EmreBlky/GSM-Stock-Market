	<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                                <?php if(file_exists($base."public/main/images/members/".$this->session->userdata('members_id').".jpg")){?>
                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/images/members/<?php echo $this->session->userdata('members_id'); ?>.jpg">
                                <?php } else {?>
                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/images/members/no_profile.jpg" height="128" width="128">
                                <?php }?>                            
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname');?></strong>
                            	<span class="text-muted text-xs block">Gold Member</span>
                             </a>
                        </div>
                        <div class="logo-element">
                            GSM
                        </div>
                    </li>
                    
                    

                    <li>
                        <a href="<?php echo $base; ?>"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    
                    <li>
                        <a href="profile/"><i class="fa fa-user"></i> <span class="nav-label"> My Profile</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="profile/"><i class="fa fa-user"></i> View Profile</a></li>
                            <li><a href="profile/who_viewed"><i class="fa fa-eye"></i> Who's Viewed <span class="label label-primary pull-right">6</span></a></li>
                            <li><a href="profile/edit_profile"><i class="fa fa-cogs"></i> Edit Profile</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <?php $this->load->model('mailbox/mailbox_model', 'mailbox_model'); ?>
                        <a href="mailbox/inbox/all"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right"><div id="result"></div></span></a>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-wechat"></i> <span class="nav-label">Messenger</span><span class="label label-warning pull-right">0/1</span></a></a>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-book"></i> <span class="nav-label">Address Book</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="addressbook/individual"><i class="fa fa-user"></i> Individuals</a></li>
                            <li><a href="addressbook/company"><i class="fa fa-users"></i> Companies</a></li>
                            <li><a href="addressbook/favourite"><i class="fa fa-star"></i> Favourites</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-line-chart"></i> <span class="nav-label">Marketplace</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
                            <li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
                            <li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching</a></li>
                            <li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings</a></li>
                            <li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-search"></i> <span class="nav-label">Search</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="search/user"><i class="fa fa-user"></i> User Search</a></li>
                            <li><a href="search/company"><i class="fa fa-users"></i> Company Search</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-money"></i> <span class="nav-label">My Wallet</span><span class="label label-primary pull-right">£5.00</span></a>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-barcode"></i> <span class="nav-label">IMEI Services</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-unlock-alt"></i> Mobile Unlocking</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Social Hub</span></a>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-support"></i> <span class="nav-label">Support</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="support/faq"><i class="fa fa-question"></i> FAQ</a></li>
                            <li><a href="support/submit_ticket"><i class="fa fa-ticket"></i> Submit a Ticket</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-cog"></i> <span class="nav-label">Preferences</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="preferences/password"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li><a href="preferences/subscription"><i class="fa fa-cubes"></i> Manage Subscription</a></li>
                            <li><a href="preferences/newsletter"><i class="fa fa-newspaper-o"></i> Newsletter</a></li>
                        </ul>
                    </li>
                    
                    
                    
                </ul>

            </div>
        </nav>