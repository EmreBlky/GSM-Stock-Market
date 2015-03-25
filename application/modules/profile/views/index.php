<?php
//
//echo '<pre>';
//print_r($company_users);
//exit;
$this->load->model('membership/membership_model', 'membership_model');


?>	
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>View Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>
                        <li>
                            My Profile
                        </li>
                        <li class="active">
                            <strong>View Profile</strong>
                        </li>
                    </ol>
                </div><!-- /col-lg-10 -->
                <div class="col-lg-2"></div>
            </div>
            
            <div class="row">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--<div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <i class="fa fa-ban"></i> You have blocked this company. They are unable to communicate or see you in anyway on this website. <a class="alert-link" href="#">Unblock</a>.
                                    </div> -->
                                    <div class="m-b-md">
                                        <?php if($member_company->admin_member_id == $this->session->userdata('members_id')){?>
                                            <a href="profile/edit_profile" class="btn btn-white btn-xs pull-right">Edit Profile</a>
                                        <?php }?>
                                        <h2><?php echo $member_company->company_name;?></h2>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-5 col-lg-offset-1">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                                        <dt>Subscription:</dt> <dd><?php echo $this->membership_model->get_where($member_info->membership)->membership; ?> Member</dd>
                                    </dl>
                                    <dl class="dl-horizontal">
                                        <dt>Company Number:</dt> <dd><?php echo $member_company->company_number;?></dd>
                                        <dt>VAT/Tax Number:</dt> <dd><?php echo $member_company->vat_tax;?></dd>
                                    </dl>                                    
                                    <dl class="dl-horizontal">
                                        <dt>Address:</dt> <dd>  
                                            <?php echo $member_company->address_line_1;?><br/>
                                            <?php echo $member_company->address_line_2;?><br />
                                            <?php echo $member_company->town_city;?><br />
                                            <?php echo $member_company->county;?><br />
                                            <?php echo $member_company->post_code;?><br />
                                            <?php echo $this->country_model->get_where($member_company->country)->country;?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal">
                                        <dt>Phone:</dt> <dd>  <?php echo $member_info->phone_number;?></dd>
                                        <dt>Skype:</dt> <dd>  <?php echo $member_info->skype;?></dd>
                                        <dt>Website:</dt> <dd>  <?php echo $member_company->website;?></dd>
                                        <dt>Facebook:</dt> <dd>  <?php echo $member_info->facebook;?></dd>
                                        <dt>Twitter:</dt> <dd>  <?php echo $member_info->twitter;?></dd>
                                        <dt>Linkedin:</dt> <dd>  <?php echo $member_info->linkedin;?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal">
                                        <dt>Primary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_1;?></dd>
                                        <dt>Secondary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_2;?></dd>
                                        <dt>Tertiary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_3;?></dd>
                                        <dt>Other Activities:</dt>
                                        <dd><?php echo $member_company->other_business;?></dd>
                                    </dl>
                                    
                                </div>
                                <div class="col-lg-5 col-lg-offset-1">
									<?php if(file_exists("public/main/template/gsm/images/company/".$member_company->id.".jpg")){?>
                                        <img src="public/main/template/gsm/images/company/<?php echo $member_company->id; ?>.jpg" class="img-responsive" style="margin:0 auto">
                                    <?php } else {?>
                                        <img src="public/main/template/gsm/images/company/no_company.jpg" class="img-responsive" style="margin:0 auto">
                                    <?php }?>
                                
                                
                              		<div class="m-r-md" style="text-align:center">
                                        
                                            <?php
                                            
                                                $this->load->module('feedback');
                                                $this->feedback->member_feedback($member_info->id);
                                            ?>
                                            
                                            
                            		<div style="display:inline;height:65px;width:65px;padding:10px;margin-left:20px;"><i class="fa fa-star" style="font-size:75px;color:#FC6;vertical-align:top"></i></div>
                            		</div>
                                    <dl class="dl-horizontal" >

                                        <dt>Date Created:</dt> <dd> <?php echo $member_info->date?></dd>
                                        <dt>Last Online:</dt> <dd><?php echo $last_logged->date.' '.$last_logged->time?></dd>
                                        <dt>Company Users:</dt>
                                        <dd class="project-people">
                                            <?php if($company_users){
                                                
                                                foreach($company_users as $user){
                                                    
                                            ?>
                                            
                                                <a data-toggle="modal" data-target="#profile-<?php echo $user->id;?>"><img alt="image" class="img-circle" src="public/main/template/gsm/images/members/<?php echo $user->id;?>.jpg"></a>
                                            
                                            <?php

                                                    }
                                                }
                                            ?>  
                                        
                                        </dd>
                                    </dl>
                                    
                                </div>
                                
                                <div class="row">
                                	<div class="col-lg-10 col-lg-offset-1">
                            <?php echo $member_company->company_profile;?>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#feedposts" data-toggle="tab">Feed Posts</a></li>
                                            <li class=""><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li class=""><a href="#credit-information" data-toggle="tab">Credit Info</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="feedposts">
                                <?php
                                
                                    $this->load->module('feed');
                                    $this->feed->feed_list();
                                    $this->feed->post_feed();
                                ?>                                
                                </div>
                                
                                <div class="tab-pane" id="feedback">
                                <?php
                                
                                    $this->load->module('feedback');
                                    $this->feedback->feedback_list();
                                ?>
                                </div>
                                
                                <div class="tab-pane" id="credit-information">
									<div class="row">
                    					<div class="col-lg-12" style="text-align:center;margin:15px 0">
                        					<p>Request a credit check to be done on this company.</p>
                                            <p>Payment will be taken from your GSM Wallet and the credit data for this company will be viewable from your account while your subscription lasts.</p>
                        				</div>
                   					</div>
									<div class="row">
                    					<div class="col-lg-4" style="float:none;margin:0 auto">
                        					<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#buycreditcheck"><i class="fa fa-check-square-o"></i>Buy Credit Check</button>
                        				</div>
                   					</div>
                                	
                                </div>
                                
                                </div>

                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
                                            <?php if($company_users){
                                                
                                                foreach($company_users as $user){
                                                    
                                            ?>
        					<div class="modal inmodal fade" id="profile-<?php echo $user->id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">User Name</h4>
                                            <small class="font-bold">Role</small>
                                        </div>
                                        <div class="modal-body">
                                            <p><img alt="image" class="img-circle" src="public/main/template/gsm/images/members/<?php echo $user->id;?>.jpg"></p>
                                            <p><strong>£5.00 Credit available</strong></p>
                                            <p><strong>£5.00 Credit required</strong></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                            
                                            <?php

                                                    }
                                                }
                                            ?>    
        
                            <div class="modal inmodal fade" id="buycreditcheck" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Buy Credit Check</h4>
                                            <small class="font-bold">This transaction will buy you the credit data for GSMStockMarket.com Limited.</small>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Payment will be taken from your GSM Wallet</strong> and the credit data for this company will be viewable from your account while your subscription lasts.</p>
                                            <p><strong>£5.00 Credit available</strong></p>
                                            <p><strong>£5.00 Credit required</strong></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Confirm Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            
                            <div class="modal inmodal fade" id="report_user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Report this user!</h4>
                                            <small class="font-bold">Please fill in the form below to submit a report</small>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Form to support service.</strong></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
	<!-- Page Specific Scripts -->    
    
	<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>
        
    <!-- Toastr script -->
    <script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script><!-- ALERTS -->
    
    <script type="text/javascript">
        $(function () {
                toastr.options = {
                    closeButton: false,
                    debug:false,
                    progressBar: false,
                    positionClass: 'toast-bottom-right',
                    onclick: null,
					showDuration: 400,
					hideDuration: 1000,
					timeOut: 7000,
					extendedTimeOut: 1000,
					showEasing: 'swing',
					hideEasing: 'linear',
					showMethod: 'fadeIn',
					hideMethod: 'fadeOut',
				};
            $('#contact_added').click(function (){
                toastr.success('This user has been added to your address book.', 'Contact Added');
            });
            $('#contact_removed').click(function (){
                toastr.error('This user has been removed from your address book.', 'Contact Removed');
            });
            $('#favourite_added').click(function (){
                toastr.success('This user has been added to your favourites.', 'Favourite Added');
            });
            $('#favourite_removed').click(function (){
                toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
            });
            $('#blocked').click(function (){
                toastr.error('They are unable to communicate or see you in anyway on this website.', 'User Blocked!');
            });
            $('#unblocked').click(function (){
                toastr.success('You will now be visible to this user again and can communicate with them.', 'User Unblocked');
            });
            $('#conversation').click(function (){
                toastr.warning('Both users need to add each other as a contact before they can use GSM Messenger!', 'Chat Unavailable');
            });
        	$(".dial").knob();
        })
    </script>
    <script type="text/javascript">
		$(function() {
		if (window.location.hash.indexOf("reportuser/") !== -1) {
			$("#report_user").modal();
		}
		});
	</script>
            
            
            
            
            
        