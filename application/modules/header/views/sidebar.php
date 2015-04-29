<?php
$this->load->model('member/member_model', 'member_model');
$this->load->model('membership/membership_model', 'membership_model');
$member = $this->member_model->get_where($this->session->userdata('members_id'));
//echo $member->membership;
//exit;
?>
<?php $url = $this->uri->segment(1);?>
<nav class="navbar-default navbar-static-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav" id="side-menu">                    
        <li class="nav-header <?php echo $member->membership; ?>">                                
        <div class="dropdown profile-element">
            <span>
                <?php if(file_exists("public/main/template/gsm/images/members/".$this->session->userdata('members_id').".png")){?>
                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $this->session->userdata('members_id'); ?>.png" height="48" width="48">
                <?php } else {?>
                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="48" width="48">
                <?php }?>                            
            </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname');?></strong>
                <span class="text-muted text-xs block"><?php echo $this->membership_model->get_where($member->membership)->membership; ?> Member</span>
             </a>
        </div>
        <div class="logo-element">
            GSM
        </div>
    </li>
    
    <li>
        <a href="<?php echo $base; ?>"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
    </li>
    
    <?php if($url == 'profile') {?>
    <li class="active">
        <a href="profile/"><i class="fa fa-user"></i> <span class="nav-label"> My Profile</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="profile/"><i class="fa fa-user"></i> View Profile</a></li>
            <li><a href="profile/who_viewed"><i class="fa fa-eye"></i> Who's Viewed                                     
                    <div id="who_viewed_remove" style="float: right;">
                    <?php
                        $this->load->module('profile');
                        $this->profile->who_viewed_count();
                    ?>
                </div>
                    <div id="who_viewed"></div>
                </a>
            </li>
            <li><a href="profile/edit_profile"><i class="fa fa-cogs"></i> Edit Profile</a></li>
        </ul>
    </li>
    <?php } else {?>
    <li>
        <a href="profile/"><i class="fa fa-user"></i> <span class="nav-label"> My Profile</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="profile/"><i class="fa fa-user"></i> View Profile</a></li>
            <li><a href="profile/who_viewed"><i class="fa fa-eye"></i> Who's Viewed                                     
                    <div id="who_viewed_remove" style="float: right;">
                    <?php
                        $this->load->module('profile');
                        $this->profile->who_viewed_count();
                    ?>
                </div>
                    <div id="who_viewed"></div>
                </a>
            </li>
            <li><a href="profile/edit_profile"><i class="fa fa-cogs"></i> Edit Profile</a></li>
        </ul>
    </li>
    <?php } ?>
    
    <?php if($url == 'mailbox') {?>
    <li class="active">
        <?php $this->load->model('mailbox/mailbox_model', 'mailbox_model'); ?>
        <a href="mailbox/inbox/all">
            <i class="fa fa-envelope"></i> 
            <span class="nav-label">Mailbox </span>
            <span class="label label-warning pull-right">
                
                <div id="result">
                    <?php
                        $this->load->module('mailbox');
                        $this->mailbox->messages_count();
                    ?>
                </div>
            </span>
        </a>
    </li>
    <?php } else {?>
    <li>
        <?php $this->load->model('mailbox/mailbox_model', 'mailbox_model'); ?>
        <a href="mailbox/inbox/all">
            <i class="fa fa-envelope"></i> 
            <span class="nav-label">Mailbox </span>
            <span class="label label-warning pull-right">
                
                <div id="result">
                    <?php
                        $this->load->module('mailbox');
                        $this->mailbox->messages_count();
                    ?>
                </div>
            </span>
        </a>
    </li>
    <?php } ?>
    <!--
    <li>
        <a href="messenger"><i class="fa fa-wechat"></i> <span class="nav-label">Messenger</span>
            <span class="label label-warning pull-right">0/1</span>
        </a>
    </li>
    -->
    
    <li>
        <a href="addressbook"><i class="fa fa-book"></i> <span class="nav-label">Address Book</span></a>
    </li>
   
    <?php if($url == 'marketplace') {?>
    <li class="active">
        <a href="marketplace/notice">
            <i class="fa fa-line-chart"></i> 
            <span class="nav-label">Marketplace</span>
            <span class="fa arrow"></span>
        </a>
       <ul class="nav nav-second-level">
            <li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
            <li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
            
            <?php $count_watch_listing=count_watch_listing(); 
            if($count_watch_listing){ ?>
            <li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching <span class="label label-warning pull-right" id="count_watch_listing">
            <?php  echo $count_watch_listing; ?>
            </span>
            </a></li> <?php }
    					
						$counteroffer=all_offer(); 
            if($counteroffer){
						?>
            <li><a href="marketplace/offers"><i class="fa fa-list"></i> All Offers<span class="label label-info pull-right" id="count_offer"><?php  echo $counteroffer; ?></span></a></li><?php }
            
						$countopen_order=count_open_order(); 
            if($countopen_order){
						?>
            <li><a href="marketplace/open_orders"><i class="fa fa-book"></i> Open Orders <span class="label label-warning pull-right" id="count_open_order">
                <?php  echo $countopen_order; ?>
            </span></a></li><?php }
						?>
            <li><a href="marketplace/negotiation"><i class="fa fa-book"></i> Negotiation </a></li>
						
            <?php $countmy_listing=countmy_listing(); 
            if($countmy_listing){ ?>
            
            <li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings <span class="label label-warning pull-right" id="countmy_listing">
            <?php echo $countmy_listing; ?>
            </span></a></li>
            <?php } ?>
            <li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-plus"></i> Create Listing  <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">		                                    <li><a href="marketplace/buy_listing"> Create Buy Listing</a></li>
                        <li><a href="marketplace/sell_listing"> Create Sell Listing</a></li>
                    </ul>
                </li>
        <?php $count_save_listing=count_save_listing(); 
            if($count_save_listing){ ?>        
        <li><a href="marketplace/saved_listing"><i class="fa fa-save"></i> Saved Listings <span class="label label-success pull-right" id="count_save_listing">
        <?php  echo $count_save_listing; ?></span></a></li>
        <?php } ?>
        </ul>
    </li>
    <?php }?>
  
    
    <li>
        <a href="search/company"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a>
        <!--
        <ul class="nav nav-second-level">
            <li><a href="search/user"><i class="fa fa-user"></i> User Search</a></li>
            <li><a href="search/company"><i class="fa fa-users"></i> Company Search</a></li>
        </ul>
        -->
    </li>
    <!--
    <li>
        <a href=""><i class="fa fa-money"></i> <span class="nav-label">My Wallet</span><span class="label label-primary pull-right">£5.00</span></a>
    </li>
    -->
    
    <li>
        <a href="events"><i class="fa fa-calendar"></i> <span class="nav-label">Events</span></a>
    </li>
    
    <?php if($url == 'imei') {?>
    <li class="active">
        <a href="imei/"><i class="fa fa-barcode"></i> <span class="nav-label">IMEI Services</span> 
            <span class="fa arrow"></span>
        </a>
       <ul class="nav nav-second-level">
            <li><a href="imei/imei_lookup/"><i class="fa fa-eye"></i> IMEI Lookup</a></li>
            <li><a href="imei/unlocking/"><i class="fa fa-unlock-alt"></i> Unlocking</a></li>
            <li><a href="imei/archive/"><i class="fa fa-book"></i> Archive</a></li>
            <li><a href="imei/top_up/"><i class="fa fa-money"></i> <span class="nav-label">Top up</span><span class="label label-primary pull-right">£5.00</span></a></li>
        </ul>
    </li>                    
    <!--
    <li>
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Social Hub</span></a>
    </li>
    -->
    <?php } else {?>
    <li>
        <a href="imei/"><i class="fa fa-barcode"></i> <span class="nav-label">IMEI Services</span> 
            <span class="fa arrow"></span>
        </a>
       <ul class="nav nav-second-level">
            <li><a href="imei/imei_lookup/"><i class="fa fa-eye"></i> IMEI Lookup</a></li>
            <li><a href="imei/unlocking/"><i class="fa fa-unlock-alt"></i> Unlocking</a></li>
            <li><a href="imei/archive/"><i class="fa fa-book"></i> Archive</a></li>
            <li><a href="imei/top_up/"><i class="fa fa-money"></i> <span class="nav-label">Top up</span><span class="label label-primary pull-right">£5.00</span></a></li>
        </ul>
    </li>                    
    <!--
    <li>
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Social Hub</span></a>
    </li>
    -->
    <?php } ?>
    
    <?php if($url == 'support') {?>
    <li class="active">
        <a href=""><i class="fa fa-support"></i> <span class="nav-label">Support</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="http://support.gsmstockmarket.com/customer/portal/topics/744522-frequently-asked-questions/questions" target="_blank"><i class="fa fa-question"></i> FAQ</a></li>
            <li><a href="support/submit_ticket"><i class="fa fa-ticket"></i> Submit a Ticket</a></li>
        </ul>
    </li>
    <?php } else {?>
    <li>
        <a href=""><i class="fa fa-support"></i> <span class="nav-label">Support</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="http://support.gsmstockmarket.com/customer/portal/topics/744522-frequently-asked-questions/questions" target="_blank"><i class="fa fa-question"></i> FAQ</a></li>
            <li><a href="support/submit_ticket"><i class="fa fa-ticket"></i> Submit a Ticket</a></li>
        </ul>
    </li>
    <?php } ?>
    
    <?php if($url == 'preferences' || $url == 'tradereference') {?>
    <li class="active">
        <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Preferences</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="preferences/password"><i class="fa fa-lock"></i> Change Password</a></li>
            <li><a href="preferences/subscription"><i class="fa fa-cubes"></i> My Subscription</a></li>
            <li><a href="preferences/notification"><i class="fa fa-newspaper-o"></i> Notifications</a></li>
            <li><a href="tradereference/"><i class="fa fa-slideshare"></i> Trade Reference</a></li>
            <!-- <li><a href="preferences/newsletter"><i class="fa fa-newspaper-o"></i> Newsletter</a></li> -->
        </ul>
    </li>
    <?php } else {?>
    <li>
        <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Preferences</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="preferences/password"><i class="fa fa-lock"></i> Change Password</a></li>
            <li><a href="preferences/subscription"><i class="fa fa-cubes"></i> My Subscription</a></li>
            <li><a href="preferences/notification"><i class="fa fa-newspaper-o"></i> Notifications</a></li>
            <li><a href="tradereference/"><i class="fa fa-slideshare"></i> Trade Reference</a></li>
        </ul>
    </li>
    <?php } ?>
    
</ul>

</div>
</nav>
<script type="text/javascript">
 function autoRefresh_div()
 {
      $("#count_offer").load("<?php echo base_url().'header/ajax/offer'; ?>");
      $("#count_watch_listing").load("<?php echo base_url().'header/ajax/watch_listing'; ?>");
      $("#count_open_order").load("<?php echo base_url().'header/ajax/open_order'; ?>");
      $("#countmy_listing").load("<?php echo base_url().'header/ajax/my_listing'; ?>");
      $("#count_save_listing").load("<?php echo base_url().'header/ajax/save_listing'; ?>");
      $("#count_watch_listing").load("<?php echo base_url().'header/ajax/watch_listing'; ?>");
			
  }
	
 
  setInterval('autoRefresh_div()', 3000); // refresh div after 5 secs
</script>