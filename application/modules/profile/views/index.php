<?php
//
//echo '<pre>';
//print_r($company_users);
//exit;

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
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
            <div class="col-lg-9">
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
                                        <a href="profile/edit_profile" class="btn btn-white btn-xs pull-right">Edit Profile</a>
                                        <h2><?php echo $member_company->company_name;?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                                        <dt>Subscription:</dt> <dd>Gold Member</dd>
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
                                            <?php echo $member_company->country;?></dd>
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
                                        <dd><?php echo $member_company->other_activity;?></dd>
                                    </dl>
                                    
                                </div>
                                <div class="col-lg-5" id="cluster_info">
                              		<div class="m-r-md" style="text-align:center">
                            			<input type="text" value="94" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                        <div style="display:inline;height:65px;width:65px;padding:10px;margin-left:20px;"><i class="fa fa-star" style="font-size:75px;color:#FC6;vertical-align:top"></i></div>
                            		</div>
                                    <dl class="dl-horizontal" >

                                        <dt>Date Created:</dt> <dd> <?php echo $member_info->date?></dd>
                                        <dt>Last Online:</dt> <dd> 	10.07.2014 23:36:57 </dd>
                                        <dt>Company Users:</dt>
                                        <dd class="project-people">
                                            <?php if($company_users){
                                                
                                                foreach($company_users as $user){
                                                    
                                            ?>
                                            
                                                <a href="#"><img alt="image" class="img-circle" src="public/main/images/members/<?php echo $user->id;?>.jpg"></a>
                                            
                                            <?php

                                                    }
                                                }
                                            ?>  
                                        
                                        </dd>
                                    </dl>
                                    <div class="row">
                                        <div class="col-md-6" style="margin-top:15px">
                                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i> Send Message</button>
                                        </div>
                                        <div class="col-md-6" style="margin-top:15px">
                                            <button type="button" class="btn btn-default btn-sm btn-block" id="conversation"><i class="fa fa-wechat"></i> Start Conversation</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="margin-top:15px">
                                            <button type="button" class="btn btn-success btn-sm btn-block" id="contact_added"><i class="fa fa-book"></i> Add Contact</button>
                                        </div>
                                        <div class="col-md-6" style="margin-top:15px">
                                            <button type="button" class="btn btn-warning btn-sm btn-block" id="favourite_added"><i class="fa fa-star"></i> Add Favourite</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo $member_company->company_profile;?>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#feedposts" data-toggle="tab">Feed Posts</a></li>
                                            <li class=""><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li class=""><a href="#selling-offers" data-toggle="tab">Selling Offers</a></li>
                                            <li class=""><a href="#buying-requests" data-toggle="tab">Buying Requests</a></li>
                                            <li class=""><a href="#credit-information" data-toggle="tab">Credit Info</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="feedposts">
                                    <div>
                							<div class="chat-activity-list">
											<div class="chat-element">
                                               	<a href="#" class="pull-left">
                                                    <img alt="image" class="img-circle" src="/public/main/img/a2.jpg">
                                                </a>
                                                <div class="media-body ">
                                                    <small class="pull-right text-navy">1m ago</small>
                                                    <strong>Mike Smith</strong>
                                                    <p class="m-b-xs">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                                    </p>
                                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                                </div>
                                            </div>
                                            <div class="chat-element right">
                                                <a href="#" class="pull-right">
                                                    <img alt="image" class="img-circle" src="/public/main/img/a4.jpg">
                                                </a>
                                                <div class="media-body text-right ">
                                                    <small class="pull-left">5m ago</small>
                                                    <strong>John Smith</strong>
                                                    <p class="m-b-xs">
                                                        Lorem Ipsum is simply dummy text of the printing.
                                                    </p>
                                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                                </div>
                                            </div>
                                            <div class="chat-element ">
                                                <a href="#" class="pull-left">
                                                    <img alt="image" class="img-circle" src="/public/main/img/a2.jpg">
                                                </a>
                                                <div class="media-body ">
                                                    <small class="pull-right">2h ago</small>
                                                    <strong>Mike Smith</strong>
                                                    <p class="m-b-xs">
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                                    </p>
                                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                                </div>
                                            </div>
                                            
                                        </div><!-- /chat-activity-list-->
                            	</div>
                                            
                            <div class="chat-form"><!-- Profile Owner Only -->
                                <form role="form">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Post to Feed</strong></button>
                                    </div>
                                </form>
                            </div>

                            </div>
                                
                                <div class="tab-pane" id="feedback">
                                    <div class="feed-activity-list">
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="/public/main/img/profile_small.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <div class="row">
                    							<div class="col-md-7">
                                                	<strong>Daniel Gregory</strong> from <strong>GSMStockMarket.com Limited</strong> <br>
                                                	<small>2h ago</small>
                        							<p>Fantastic customer to do business with. Would highly recommend and look forward to dealing with them again in the future.</p>
                        						</div>
                    							<div class="col-md-5">
                                    <style>
									div#feedback dl.dl-horizontal {float:right}
									div#feedback dt {width:120px}
									div#feedback dd {margin-left:130px}
									</style>
									
                                    <dl class="dl-horizontal">
                                        <dt>Communication:</dt> <dd>  <i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i></dd>
                                        <dt>Shipping:</dt> <dd>  <i class="fa fa-star"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i></dd>
                                        <dt>Accuracy:</dt> <dd>  <i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i><i class="fa fa-star" style="color:#FC6"></i></dd>
                                        <dt>Final Rating:</dt> <dd>  <span class="label label-primary">95</span></dd>
                                    </dl>
                        						</div>
                                                </div>
                                                    
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="tab-pane" id="selling-offers">
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="buying-requests">
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4>Company Bio</h4>
                    <?php if(file_exists("public/main/images/company/".$member_company->id.".jpg")){?>
                        <img src="public/main/images/company/<?php echo $member_company->id; ?>.jpg" class="img-responsive" style="margin:0 auto">
                    <?php } else {?>
                        <img src="public/main/images/company/no_company.jpg" class="img-responsive" style="margin:0 auto">
                    <?php }?>
                    
                    <dl class="dl-horizontal">
                    	<dt><i class="fa fa-linkedin"></i></dt> <dd>  @gsmstockmarket</dd>
                    	<dt><i class="fa fa-facebook"></i></dt> <dd>  @gsmstockmarket</dd>
                    	<dt><i class="fa fa-twitter"></i></dt> <dd>  @gsmstockmarket</dd>
                    </dl>
					<div class="row">
                    	<div class="col-lg-12">
                        	<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#buycreditcheck"><i class="fa fa-check-square-o"></i> Credit Check</button>
                        </div>
                   </div>
					<div class="row">
                        <div class="col-lg-6" style="margin-top:15px">
                         	<button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#report_user"><i class="fa fa-exclamation"></i> Report</button>
                        </div>
                        <div class="col-lg-6" style="margin-top:15px">
                         	<button type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>
                        </div>
                   </div>
                </div>
            </div>
        </div>
        
        
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
                            
                            <?php
                            
                                $this->load->module('profile');
                                $this->profile->send_message();
                            
                            ?>   
                                 
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
    <!-- Toastr script -->
    <script src="public/main/js/plugins/toastr/toastr.min.js"></script>
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
        })
    </script>
            
            
            
            
            
        