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
<li>
<a href="addressbook"><i class="fa fa-book"></i> <span class="nav-label">Address Book</span></a>
</li>
<?php 
$id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
$count_watch_listing=count_watch_listing();
$counteroffer=all_offer();  
$countopen_order=count_open_order(); 
$countmy_listing=countmy_listing(); 
$count_order_history=count_order_history();
$count_negotiation=count_negotiation();

if($member->membership > 1 && $member->marketplace == 'active'){ ?>
<?php if($url == 'marketplace') {?>
<li class="active">
<a href="marketplace/notice">
		<i class="fa fa-line-chart"></i> 
		<span class="nav-label">Marketplace</span>
		<span class="fa arrow"></span>
</a>
<ul class="nav nav-second-level">

	<li><a href="javascript:void(0)"><i class="fa fa-plus"></i> Create Listing  <span class="fa arrow"></span></a>
		<ul class="nav nav-second-level">		
		<li><a href="marketplace/buy_listing"><i class="fa fa-level-up"></i> Buying Request</a></li>
		<li><a href="marketplace/sell_listing"><i class="fa fa-level-down"></i> Selling Offer</a></li>
		</ul>
	</li>
    
	<li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
	<li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
	<li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching <span class="count_watch_listing_class">
	<?php 
	if($count_watch_listing){ ?>
	 <span class="label label-warning pull-right">
	<?php  echo $count_watch_listing; ?>
	</span><?php } ?>
	</span></a></li>
    
	<li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings<span class="countmy_listing_class_ajax">
<?php 
if($countmy_listing){ ?>
<span class="label label-warning pull-right">
		<?php echo $countmy_listing; ?>
		</span>
<?php } ?>
</span></a></li>

	<li><a href="marketplace/offers"><i class="fa fa-list"></i> All Offers<span class="count_offer_sidbar_ajax">
	<?php  if($counteroffer){ ?>
		<span class="label label-warning pull-right">
	<?php  echo $counteroffer; ?></span>
	<?php } ?></span></a></li>

<li><a href="marketplace/negotiation"><i class="fa fa-book"></i> Negotiations 
<span class="count_negotiation_ajax">
<?php 
if($count_negotiation){ ?>
<span class="label label-warning pull-right">
		<?php echo $count_negotiation; ?>
		</span>
<?php } ?>
</span>
</a></li>
	<li><a href="marketplace/open_orders"><i class="fa fa-book"></i> Open Orders <span class="count_open_order_class">
<?php 
if($countopen_order){ ?>
<span class="label label-warning pull-right">
		<?php  echo $countopen_order; ?>
	</span><?php }?></span></a></li>
	<li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History<span class="count_order_history">
<?php 
if($count_order_history){ ?>
<span class="label label-warning pull-right">
		<?php echo $count_order_history; ?>
		</span>
<?php } ?>
</span></a></li>
						
</ul>
</li>
<?php } else {?>
<li>
<a href="marketplace/notice">
		<i class="fa fa-line-chart"></i> 
		<span class="nav-label">Marketplace</span>
		<span class="fa arrow"></span>
</a>
<ul class="nav nav-second-level">

	<li><a href="javascript:void(0)"><i class="fa fa-plus"></i> Create Listing  <span class="fa arrow"></span></a>
		<ul class="nav nav-second-level">		
		<li><a href="marketplace/buy_listing"><i class="fa fa-level-up"></i> Buying Request</a></li>
		<li><a href="marketplace/sell_listing"><i class="fa fa-level-down"></i> Selling Offer</a></li>
		</ul>
	</li>
    
	<li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
	<li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
	<li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching <span class="count_watch_listing_class">
	<?php 
	if($count_watch_listing){ ?>
	 <span class="label label-warning pull-right">
	<?php  echo $count_watch_listing; ?>
	</span><?php } ?>
	</span></a></li>
    
	<li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings<span class="countmy_listing_class_ajax">
<?php 
if($countmy_listing){ ?>
<span class="label label-warning pull-right">
		<?php echo $countmy_listing; ?>
		</span>
<?php } ?>
</span></a></li>

	<li><a href="marketplace/offers"><i class="fa fa-list"></i> All Offers<span class="count_offer_sidbar_ajax">
	<?php  if($counteroffer){ ?>
		<span class="label label-warning pull-right">
	<?php  echo $counteroffer; ?></span>
	<?php } ?></span></a></li>

<li><a href="marketplace/negotiation"><i class="fa fa-book"></i> Negotiations 
<span class="count_negotiation_ajax">
<?php 
if($count_negotiation){ ?>
<span class="label label-warning pull-right">
		<?php echo $count_negotiation; ?>
		</span>
<?php } ?>
</span>
</a></li>
	<li><a href="marketplace/open_orders"><i class="fa fa-book"></i> Open Orders <span class="count_open_order_class">
<?php 
if($countopen_order){ ?>
<span class="label label-warning pull-right">
		<?php  echo $countopen_order; ?>
	</span><?php }?></span></a></li>
	<li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History<span class="count_order_history">
<?php 
if($count_order_history){ ?>
<span class="label label-warning pull-right">
		<?php echo $count_order_history; ?>
		</span>
<?php } ?>
</span></a></li>
						
</ul>
</li>
<?php } ?>
<?php } else {?>
<?php if($url == 'marketplace') {?>
<li class="active">
<a href="marketplace/notice"><i class="fa fa-line-chart"></i> <span class="nav-label">Marketplace</span> <span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#upgrade"><i class="fa fa-plus"></i> Create Listing</a></li>
<li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
<li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
<li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching <span class="label label-warning pull-right">4</span></a></li>
<li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings</a></li>
<li><a href="marketplace/offers"><i class="fa fa-list"></i> All Offers<span class="label label-info pull-right">15</span></a></li>
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#upgrade"><i class="fa fa-eye"></i> Negotiations <span class="label label-warning pull-right">2</span></a></li>
<li><a href="marketplace/open_orders"><i class="fa fa-book"></i> Open Orders <span class="label label-warning pull-right">2/5</span></a></li>
<li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History</a></li>
</ul>
</li>
<?php } else {?>
<li>
<a href="marketplace/notice"><i class="fa fa-line-chart"></i> <span class="nav-label">Marketplace</span> <span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#upgrade"><i class="fa fa-plus"></i> Create Listing</a></li>
<li><a href="marketplace/buy"><i class="fa fa-shopping-cart"></i> Buy</a></li>
<li><a href="marketplace/sell"><i class="fa fa-tag"></i> Sell</a></li>
<li><a href="marketplace/watching"><i class="fa fa-eye"></i> Watching <span class="label label-warning pull-right">4</span></a></li>
<li><a href="marketplace/listing"><i class="fa fa-list"></i> My Listings</a></li>
<li><a href="marketplace/offers"><i class="fa fa-list"></i> All Offers<span class="label label-info pull-right">15</span></a></li>
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#upgrade"><i class="fa fa-eye"></i> Negotiations <span class="label label-warning pull-right">2</span></a></li>
<li><a href="marketplace/open_orders"><i class="fa fa-book"></i> Open Orders <span class="label label-warning pull-right">2/5</span></a></li>
<li><a href="marketplace/history"><i class="fa fa-file-text"></i> Order History</a></li>
</ul>
</li>
<?php }} ?>

<li>
<a href="search/company"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a>
</li>

<?php if($url == 'creditdata') {?>
<li class="active">
        <a href=""><i class="fa fa-clipboard"></i> <span class="nav-label">Credit Check</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
            <?php
                $this->load->module('creditdata');
            $this->creditdata->request_count();
            $this->creditdata->accept_count();
            ?>
</ul>
</li>         
<?php } else {?>
<li>
        <a href="creditcheck"><i class="fa fa-clipboard"></i> <span class="nav-label">Credit Check</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
                                <?php
                                    $this->load->module('creditdata');
                                    $this->creditdata->request_count();
                                $this->creditdata->accept_count();
                                ?>
        </ul>
</li>         
<?php } ?>


<?php $mem_id = $this->member_model->get_where($this->session->userdata('members_id'))->membership; if($mem_id < 2){?>
<!--
<li>
        <a href="demo"><i class="fa fa-desktop"></i> <span class="nav-label">Request a Demo</span></a>
</li>
-->


<?php
if($member->date_activated < '2015-05-15'){
?>
<li>
        <a href="preferences/subscription"><i class="fa fa-desktop"></i> <span class="nav-label">30 Day Trial</span></a>
</li>
<?php
	}
?>
<?php } else{} ?>



<li>
<a href="events"><i class="fa fa-calendar"></i> <span class="nav-label">Events</span></a>
</li>

<?php if($url == 'imei') {?>
<li class="active">
<a href="imei/"><i class="fa fa-barcode"></i> <span class="nav-label">IMEI Services</span> 
		<!--<span class="fa arrow"></span>-->
</a>
<ul class="nav nav-second-level">
		<li><a href="imei/imei_lookup/"><i class="fa fa-eye"></i> IMEI HPI</a></li><!--
		<li><a href="imei/unlocking/"><i class="fa fa-unlock-alt"></i> Unlocking</a></li>-->
		<li><a href="imei/archive/"><i class="fa fa-book"></i> Archive</a></li>
		<li><a href="imei/top_up/"><i class="fa fa-money"></i> <span class="nav-label">Top up</span><span class="label label-primary pull-right">5.00</span></a></li>
</ul>
</li>     
<?php } else {?>
<li>
<a href="imei/"><i class="fa fa-barcode"></i> <span class="nav-label">IMEI Services</span> 
		<span class="fa arrow"></span>
</a>
<ul class="nav nav-second-level">
		<li><a href="imei/imei_lookup/"><i class="fa fa-eye"></i> IMEI HPI</a></li><!--
		<li><a href="imei/unlocking/"><i class="fa fa-unlock-alt"></i> Unlocking</a></li>-->
		<li><a href="imei/archive/"><i class="fa fa-book"></i> Archive</a></li>
		<li><a href="imei/top_up/"><i class="fa fa-money"></i> <span class="nav-label">Top up</span><span class="label label-primary pull-right">5.00</span></a></li>
</ul>
</li>   
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
		<li><a href="tradereference/"><i class="fa fa-slideshare"></i> Trade Reference</a></li><!-- 
                <li><a href="preferences/invitation"><i class="fa fa-sitemap"></i> Invitations</a></li> -->
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
		<li><a href="tradereference/"><i class="fa fa-slideshare"></i> Trade Reference</a></li><!-- 
                <li><a href="preferences/invitation"><i class="fa fa-sitemap"></i> Invitations</a></li> -->
</ul>
</li>
<?php } ?>

</ul>

</div>
</nav>
<script type="text/javascript">
function autoRefresh_div()
{	
	$(".count_offer_sidbar_ajax").load("<?php echo base_url().'header/ajax/offer'; ?>");
	$(".count_watch_listing_class").load("<?php echo base_url().'header/ajax/watch_listing'; ?>");
	$(".count_open_order_class").load("<?php echo base_url().'header/ajax/open_order'; ?>");
	//$(".count_order_history").load("<?php echo base_url().'header/ajax/count_order_history'; ?>");
	$(".count_negotiation_ajax").load("<?php echo base_url().'header/ajax/count_negotiation_ajax'; ?>");
	
}


setInterval('autoRefresh_div()', 50000); 
</script>

<!-- Modal Upgrade -->
<div class="modal inmodal fade" id="upgrade" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Upgrade Subscription</h4>
        <small class="font-bold">Access unavailble</small>
    </div>

    <div class="modal-body">
      <p>The <strong>Upgrade your subscription</strong> to silver membership to access this page.</p>
      <p>Get started today by submitted two (2) trade references and upgrading to silver to membership to use our marketplace and search for companies on our platform</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <a href="preferences/subscription" class="btn btn-primary">Upgrade Now</a>
    </div>
</div>
</div>
</div>