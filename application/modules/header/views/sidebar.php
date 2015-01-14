	<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/public/main/img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname');?></strong>
                             </span> <span class="text-muted text-xs block">GSM Stock Market <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="/">Profile</a></li>
                                <li><a href="/">Contacts</a></li>
                                <li><a href="/">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="/">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            GSM
                        </div>
                    </li>
                    
                    

                    <li>
                        <a href="/"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-user"></i> <span class="nav-label"> My Profile</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-eye"></i> Who's Viewed <span class="label label-primary pull-right">6</span></a></li>
                            <li><a href="#"><i class="fa fa-user"></i> View Profile</a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i> Edit Profile</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-users"></i> <span class="nav-label">My Company</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-eye"></i> Who's Viewed <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#"><i class="fa fa-users"></i> View Profile</a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i> Edit Profile</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/mailbox"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                            <li><a href="#"><i class="fa fa-pencil"></i> Compose Email</a></li>
                            <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-book"></i> <span class="nav-label">Address Book</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-user"></i> Individuals</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> Companies</a></li>
                            <li><a href="#"><i class="fa fa-star"></i> Favourites</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-money"></i> <span class="nav-label">Marketplace</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-shopping-cart"></i> Buy</a></li>
                            <li><a href="#"><i class="fa fa-tag"></i> Sell</a></li>
                            <li><a href="#"><i class="fa fa-list"></i> My Listings</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-search"></i> <span class="nav-label">Search</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-user"></i> User Search</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> Company Search</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-support"></i> <span class="nav-label">Support</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-question"></i> FAQ</a></li>
                            <li><a href="#"><i class="fa fa-ticket"></i> Submit a Ticket</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-cog"></i> <span class="nav-label">Preferences</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li><a href="#"><i class="fa fa-cubes"></i> Manage Subscription</a></li>
                            <li><a href="#"><i class="fa fa-newspaper-o"></i> Newsletter</a></li>
                        </ul>
                    </li>
                    
                    
                    
                </ul>

            </div>
        </nav>