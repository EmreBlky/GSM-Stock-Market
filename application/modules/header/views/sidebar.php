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
                        <a href="/"><i class="fa fa-user"></i> <span class="nav-label"> My Profile</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Who's Viewed <span class="label label-primary pull-right">6</span></a></li>
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-users"></i> <span class="nav-label">My Company</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Who's Viewed <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/mailbox"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Inbox</a></li>
                            <li><a href="#">Compose Email</a></li>
                            <li><a href="#">Archive</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-book"></i> <span class="nav-label">Address Book</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Individuals</a></li>
                            <li><a href="#">Companies</a></li>
                            <li><a href="#">Favourites</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-money"></i> <span class="nav-label">Marketplace</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Buy</a></li>
                            <li><a href="#">Sell</a></li>
                            <li><a href="#">My Listings</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">User Search</a></li>
                            <li><a href="#">Company Search</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Submit a Ticket</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/"><i class="fa fa-cog"></i> <span class="nav-label">Preferences</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Change Password</a></li>
                            <li><a href="#">Manage Subscription</a></li>
                            <li><a href="#">Newsletter</a></li>
                        </ul>
                    </li>
                    
                    
                    
                </ul>

            </div>
        </nav>