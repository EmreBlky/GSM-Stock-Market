<?php
$cust_id = $this->uri->segment(3);
//echo '<pre>';
//print_r($member);
//print_r($blocked);
//print_r($company_users);
//exit;
$comp_member_count = count($company_users);
?>
<script type="text/javascript">

    $(document).ready(function(){
        /*
        $("#submit_report").click(function(){
            
                var from                = $('#from').val();
                var cust_name           = $('#cust_name').val();
                var report              = $('#report').val();
                var report_message      = $('#report_message').val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
                var report_message      = report_message.replace(/\//g, 'SLASH1');
                var report_message      = report_message.replace(/\?/g, 'QUEST1');
                var report_message      = report_message.replace(/\%/g, 'PERCENT1');
                
                $.ajax({
                        type: "POST",
                        url: "mailbox/reportUser/"+ from +"/"+ cust_name +"/"+ report +"/"+ report_message +"",
                        dataType: "html",
                        success:function(data){
                            $('#message').val('');  
                            $('#report_user').modal('hide');                  
                            toastr.success('Your message has been sent.', 'Message Alert');
                            $("#submit_report").show('slow');
                    },
                });
            });
            */
           $("#report_user").click(function(){
            
                window.location.replace("support/submit_ticket");
               
            });
            
           
          
  });
</script>
<script type="text/javascript">
    
            function contactAdd()
            {
                 //alert('ADD');
                 
                var cust_added          = $('#cust_added').val();                
                var cust_individual     = $('#cust_individual').val();
                var cust_company        = $('#cust_company').val();
                var cust_business1      = $('#cust_business1').val();
                var cust_business2      = $('#cust_business2').val();
                var cust_business3      = $('#cust_business3').val();
                var cust_country        = $('#cust_country').val();
                
                 $.ajax({
                        type: "POST",
                        url: "addressbook/add/"+ cust_added +"/"+ cust_individual +"/"+ cust_company +"/"+ cust_business1 +"/"+ cust_business2 +"/"+ cust_business3 +"/"+ cust_country +"",
                        dataType: "html",
                        success:function(data){
                          $('#contact_added').replaceWith('<button onclick="contactRemove();" type="button" class="btn btn-success btn-sm btn-block" id="contact_removed"><i class="fa fa-book"></i> Remove Contact</button>');                             
                          toastr.success('This user has been added to your address book.', 'Contact Added');
                        },
                });
            }           
           
            function contactRemove()
            {                
                var cust_added     = $('#cust_added').val();
                
                $.ajax({
                        type: "POST",
                        url: "addressbook/remove/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#contact_removed').replaceWith('<button onclick="contactAdd();" type="button" class="btn btn-success btn-sm btn-block" id="contact_added"><i class="fa fa-book"></i> Add Contact</button>');  
                          toastr.error('This user has been removed from your address book.', 'Contact Removed');
                        },
                });
            }
            
            function faveAdd()
            {
                var cust_added     = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "favourite/add/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_added').replaceWith('<button  onclick="faveRemove();"  type="button" class="btn btn-warning btn-sm btn-block" id="favourite_removed"><i class="fa fa-star"></i> Remove Favourite</button>');                             
                          toastr.success('This user has been added to your favourites.', 'Favourite Added');
                        },
                });
            }
            
            function faveRemove()
            {
                var cust_added     = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "favourite/remove/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_removed').replaceWith('<button  onclick="faveAdd();"  type="button" class="btn btn-warning btn-sm btn-block" id="favourite_added"><i class="fa fa-star"></i> Add Favourite</button>');                             
                          toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
                        },
                });
            }
            
            function block()
            {
                var cust_id         = "<?php echo $this->session->userdata('members_id');?>";
                var cust_blocked    = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "block/customerBlock/"+ cust_id +"/"+ cust_blocked +"",
                        dataType: "html",
                        success:function(data){
                          $('#blocked').replaceWith('<button onclick="unblock();" type="button" class="btn btn-warning btn-sm btn-block" id="unblocked"><i class="fa fa-thumbs-up"></i> Unblock</button>');                             
                         toastr.error('They are unable to communicate or see you in anywhere on this website.', 'User Blocked!');                    
                        },
                });
            }
            
            function unblock()
            {
                var cust_id         = "<?php echo $this->session->userdata('members_id');?>";
                var cust_blocked    = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "block/customerUnblock/"+ cust_id +"/"+ cust_blocked +"",
                        dataType: "html",
                        success:function(data){
                          $('#unblocked').replaceWith('<button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>');                             
                          toastr.success('You will now be visible to this user and you can communicate with them.', 'User Unblocked');
                        },
                });
            }
            
             function editProfile(id){
            
                    var answer = confirm("Are you sure you would like to edit this account?");
                        if (answer) {
                            window.location = "profile/edit_profile/" + id;
                            return true;
                        }else{
                            return false;
                        }
            };
            
            function deleteProfile(id){
            
                    var answer = confirm("Are you sure you would like to delete this account?");
                        if (answer) {
                            window.location = "profile/delete_profile/" + id;
                            return true;
                        }else{
                            return false;
                        }
            };
            
</script>
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->marketplace == 'inactive'){ ?>

			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>View Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>                            
                        <li>
                            View Profile
                        </li>              
                        <li class="active">
                            <strong>GSMStockMarket.com Limited</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
<?php if($member->membership == 1){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
                <p><i class="fa fa-info-circle"></i> <strong>Only approved silver members can view company profiles.</strong> Here you can view a company profile in great detail, you can see all their business activities and even view their feedback, trade rating, feed posts, marketplace listings and even do credit checks on the user which are available for Silver to Silver or above users included a apart of the subscription. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
<?php } else { ?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>
<?php } ?>
            <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <div class="m-b-md">                                        
                                        <h2>GSMStockMarket.com Limited</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                            		<style>
                                                dl.full-width dt, dl.full-width dd {width:50%}
                                                dl.full-width dd {margin-left:51%}
                                        </style>
                                    
                              		<div class="m-r-md" style="text-align:center">
										<?php if(file_exists("public/main/template/gsm/images/company/5.png")){?>
                                            <img src="public/main/template/gsm/images/company/5.png" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php } else {?>
                                            <img src="public/main/template/gsm/images/company/no_company.jpg" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php }?>
                            		</div>                                        
                                        
                                    <dl class="dl-horizontal full-width" style="margin-top:20px">
                                        <dt>Company Number:</dt> 
                                        <dd>07458787</dd>
                                        <dt>VAT/Tax Number:</dt> 
                                        <dd>GB 000 000 00</dd>
                                    </dl>                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Address:</dt> <dd>  
                                            The Old Dairy<br/>
                                            Hazlemere<br />
                                            High Wycombe<br />
                                            Buckinghamshire<br />
                                            HP15 7JB<br />
                                            United Kingdom</dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">                                    
                                        <dt>Phone Number:</dt>
                                        <dd>+44 (0)1494 717321</dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Primary Business:</dt>
                                        <dd>Business Sector 1</dd>
                                        <dt>Secondary Business:</dt>
                                        <dd>Business Sector 2</dd>
                                        <dt>Tertiary Business:</dt>
                                        <dd>Business Sector 3</dd>
                                        <dt>Other Activities:</dt>
                                        <dd>Business Sector 4,<br />Business Sector 5</dd>
                                    </dl>
                                    
                                </div>
                                <div class="col-lg-6" id="cluster_info">
                                
                                    
                                    
                                    <dl class="dl-horizontal full-width" >
                                        <div style="margin-top:40px;text-align:center;margin-bottom:41px">
        <input type="text" value="93" class="dial m-r" data-fgColor="#1c84c6" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                        <div style="display:inline;height:65px;width:65px;padding:10px;margin-left:20px;"><i class="fa fa-star star-Gold" style="font-size:75px;vertical-align:top"></i></div>
                                    </div>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Status:  </dt>
                                            <dd><span class="label label-primary">Online</span></dd>                                  
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Subscription:</dt> 
                                        <dd>Gold Member</dd>

                                        <dt>Member Since:</dt> <dd> 31-03-2015</dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width" >
                                        <dt>Facebook:</dt> 
                                        <dd> gsmstockmarket</dd>
                                        <dt>Twitter:</dt> 
                                        <dd> gsmstockmarket</dd>
                                        <dt>Google Plus:</dt>
                                        <dd> 115267224782612734999</dd>
                                        <dt>LinkedIn:</dt> 
                                        <dd> gsmstockmarket-com</dd>
                                        <dt>Skype:</dt> 
                                        <dd> n/a</dd>
                                        
                                    </dl>
                                    
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1" style="margin-top:15px">
                                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i> Send Message</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-5 col-md-offset-1" style="margin-top:15px">
                                                <button type="button" class="btn btn-success btn-sm btn-block"><i class="fa fa-book"></i> Add Contact</button>
                                            </div>
                                            <div class="col-md-5" style="margin-top:15px">
                                                <button type="button" class="btn btn-warning btn-sm btn-block"><i class="fa fa-star"></i> Add Favourite</button>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-10 col-lg-offset-1">
                                    <h4>Company Bio</h4>
                                	<p style="margin-top:20px">Welcome to GSMstockmarket.com. The ultimate B2B trading platform for companies who buy and sell mobile phones, accessories and spare parts.</p>
                                </div>
                                
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#feedposts" data-toggle="tab">Feed Posts</a>
                                                <p>Exceptional quality! Delivery was high-standard. Very, very delightful packaging. Wish all sellers were this first-rate.
                                                    Item was of first-class quality. Ever so splendid packaging. Exceptionally high-standard delivery. Service was superior.
                                                    The item was splendid. Swift to send. Quality of the wrapping was high-standard. Very, very pleased. Outstanding seller.</p>
                                                <?php  ?>
                                            </li>
                                            <li class="">
                                                <a href="#feedback" data-toggle="tab">Feedback</a>
                                            </li>
                                            <li class="">
                                                <a href="#selling-offers" data-toggle="tab">Selling Offers</a>
                                            </li>
                                            <li class="">
                                                <a href="#buying-requests" data-toggle="tab">Buying Requests</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="feedposts"><div>
            <div class="alert alert-info">
                <p><i class="fa fa-info-circle"></i> Post to your feed and display your 10 latest posts for anyone who views your profile to advertise your services. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
    <div class="chat-activity-list">
        <div class="chat-element">
               <?php if(file_exists("public/main/template/gsm/images/members/5.png")){?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/5.png" height="38" width="38">
                <?php } else {?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="38" width="38">
                <?php }?> 
            <div class="media-body ">
                <small class="pull-right text-navy">
                </small>
                <strong>GSMStockMarket.com</strong>
                <p class="m-b-xs">
                    Looking to buy Samsung Galaxy LCD's, view my listings for more information.
                </p>
                <small class="text-muted">
                   31st March 2014 - 12:00pm
                </small>
            </div>
        </div>
        <div class="chat-element">
               <?php if(file_exists("public/main/template/gsm/images/members/5.png")){?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/5.png" height="38" width="38">
                <?php } else {?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="38" width="38">
                <?php }?> 
            <div class="media-body ">
                <small class="pull-right text-navy">
                </small>
                <strong>GSMStockMarket.com</strong>
                <p class="m-b-xs">
                    Offering high grade Apple spare parts direct to all over Europe with fast shipping.
                </p>
                <small class="text-muted">
                   1st April 2015 - 2:21pm
                </small>
            </div>
        </div>
        <div class="chat-element">
               <?php if(file_exists("public/main/template/gsm/images/members/5.png")){?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/5.png" height="38" width="38">
                <?php } else {?>
                    <img alt="image" class="img-circle pull-left" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="38" width="38">
                <?php }?> 
            <div class="media-body ">
                <small class="pull-right text-navy">
                </small>
                <strong>GSMStockMarket.com</strong>
                <p class="m-b-xs">
                    We can supply Nokia refurbishment services and now offer high quality shipping services for quality mobile devices.
                </p>
                <small class="text-muted">
                   2nd April 2015 - 8:34am
                </small>
            </div>
        </div>
        
    </div><!-- /chat-activity-list-->
</div>
                                </div>
                                
                                <div class="tab-pane" id="feedback">
                                    
                                    <div class="feed-activity-list">
    <div class="feed-element"> 
        <div class="media-body ">
            <div class="alert alert-info">
                <p><i class="fa fa-info-circle"></i> View the users marketplace feedback to make sure you're dealing with a trusted user. Our feedback system calculates a rating which is displayed on their profile. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
            <div class="row">
                <div class="col-md-7">
                <p>Exceptional quality! Delivery was high-standard. Very, very delightful packaging. Wish all sellers were this first-rate. 
Item was of first-class quality. Ever so splendid packaging. Exceptionally high-standard delivery. Service was superior. 
The item was splendid. Swift to send. Quality of the wrapping was high-standard. Very, very pleased. Outstanding seller.</p>
                </div>
                <div class="col-md-5">
                    <style>
                    div#feedback dl.dl-horizontal {float:right}
                    div#feedback dt {width:120px}
                    div#feedback dd {margin-left:130px}
                    </style>

                    <dl class="dl-horizontal">
                        <dt>Communication:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Shipping:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Company:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd><dt>Description:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Final Rating:</dt> 
                        <dd>
                                <span class="label label-success">100</span>
                        </dd>
                    </dl>
               </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                <p>Item was of the most passable quality. Very, very simple packaging. Remarkably typical delivery. 
Item was of the most middling quality. Very plain packaging. Notably typical delivery. An exceptionally moderate seller. 
Item was of reasonable quality. Delivery was notably neither fast nor slow. Packaging was passable. Notably indifferent. </p>
                </div>
                <div class="col-md-5">
                    <style>
                    div#feedback dl.dl-horizontal {float:right}
                    div#feedback dt {width:120px}
                    div#feedback dd {margin-left:130px}
                    </style>

                    <dl class="dl-horizontal">
                        <dt>Communication:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" ></i>
                        </dd>
                        <dt>Shipping:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" ></i>
        <i class="fa fa-star" ></i>
                        </dd>
                        <dt>Company:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd><dt>Description:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Final Rating:</dt> 
                        <dd>
                                <span class="label label-primary">85</span>
                        </dd>
                    </dl>
               </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                <p>Item superb. Delivery was notably speedy. Quality of the wrapping was first-rate. Seller is excellent and high-standard. 
The item was superior! Quality of the wrapping was outstanding. Splendid delivery. Seller is first-rate and first-class. 
Item was of exceptional quality. High-standard packaging. Ever so excellent delivery. Recommended. Would buy from again.</p>
                </div>
                <div class="col-md-5">
                    <style>
                    div#feedback dl.dl-horizontal {float:right}
                    div#feedback dt {width:120px}
                    div#feedback dd {margin-left:130px}
                    </style>

                    <dl class="dl-horizontal">
                        <dt>Communication:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Shipping:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd>
                        <dt>Company:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
                        </dd><dt>Description:</dt> 
                        <dd>  
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" ></i>
                        </dd>
                        <dt>Final Rating:</dt> 
                        <dd>
                                <span class="label label-success">95</span>
                        </dd>
                    </dl>
               </div>
            </div>
        </div> 
        
    </div>
    
</div>

                                </div>
                                <div class="tab-pane no_sub" id="selling-offers">
            <div class="alert alert-info">
                <p><i class="fa fa-info-circle"></i> See what this user has for sale on the marketplace, visit their listings from this page to make offers and trade instantly. Our marketplace and order management system will make trading easy. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Unit Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>Galaxy S4 (i9505)</td>
                                                <td>£194.00</td>
                                                <td class="mobihide">325</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>Galaxy S4 Mini (i9515)</td>
                                                <td>£117.00</td>
                                                <td class="mobihide">219</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>Galaxy S5 (i9600)</td>
                                                <td>£245.00</td>
                                                <td class="mobihide">95</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Apple</td>
                                                <td>Iphone 5C 16GB</td>
                                                <td>£250.00</td>
                                                <td class="mobihide">216</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Apple</td>
                                                <td>iPhone 5 64GB</td>
                                                <td>£24.00</td>
                                                <td class="mobihide">100</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Apple</td>
                                                <td>iPhone 6 16GB</td>
                                                <td>£454.00</td>
                                                <td class="mobihide">46</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">BlackBerry</td>
                                                <td>9720</td>
                                                <td>£74.00</td>
                                                <td class="mobihide">34</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Motorla</td>
                                                <td>Nexus 6 32GB</td>
                                                <td>£355.00</td>
                                                <td class="mobihide">23</td>
                                                <td><span class="label label-danger">Ended</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane no_sub" id="buying-requests">
            <div class="alert alert-info">
                <p><i class="fa fa-info-circle"></i> This is what the user would like to buy displaying their desired price and quantity, if you have stock available matching their requirements then simply click on the listing, offer your stock and setup a deal within minutes. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Unit Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>Note 3 (N9000)</td>
                                                <td>£285.00</td>
                                                <td class="mobihide">91</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Amazon</td>
                                                <td>Fire Phone</td>
                                                <td>£115.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">BlackBerry</td>
                                                <td>9810</td>
                                                <td>£95.00</td>
                                                <td class="mobihide">200</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">BlackBerry</td>
                                                <td>Q10</td>
                                                <td>£127.00</td>
                                                <td class="mobihide">100</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">BlackBerry</td>
                                                <td>Z30</td>
                                                <td>£165.00</td>
                                                <td class="mobihide">74</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Sony</td>
                                                <td>Z3 Compact</td>
                                                <td>£230</td>
                                                <td class="mobihide">60</td>
                                                <td><span class="label label-danger">Ended</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>P3110 Tab</td>
                                                <td>£56</td>
                                                <td class="mobihide">10</td>
                                                <td><span class="label label-danger">Ended</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>Galaxy S3 (i9300)</td>
                                                <td>£106.00</td>
                                                <td class="mobihide">45</td>
                                                <td><span class="label label-danger">Ended</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                    <h2>Company User</h2>
                    	<div class="m-r-md" style="text-align:center;margin-top:20px;margin-bottom:20px;">
                                                <?php if(file_exists("public/main/template/gsm/images/members/".$member_info->id.".png")){?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $member_info->id; ?>.png">
                                                <?php } else {?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg">
                                                <?php }?>  
                            		</div>
                                                                     
                                        
                                    <dl class="dl-horizontal full-width">
                                        <dt>Name:</dt> 
                                        <dd> Mr. GSM</dd>
                                        <dt>Role:</dt> 
                                        <dd> Website</dd>
                                        <dt>Mobile Number:</dt> 
                                        <dd> +44 (0)1494 717321</dd>
                                    </dl>
                    
                    
                    <div class="row" style="margin-top:20px">
                    	<div class="col-lg-12">
                        	<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#creditdata"><i class="fa fa-check-square-o"></i> Request Credit Check</button>         
                        </div>
                   </div>
                   
                   <div class="row">
                        <div class="col-lg-6" style="margin-top:15px">
                            <button type="button" class="btn btn-warning btn-sm btn-block" id="report_user"><i class="fa fa-exclamation"></i> Report</button>
                        </div>
                        <div class="col-lg-6" style="margin-top:15px">
                        <?php if($blocked){?>    
                            <?php if($blocked[0]->block_member_id > 0){?>
                                <button onclick="unblock();" type="button" class="btn btn-warning btn-sm btn-block" id="unblocked"><i class="fa fa-thumbs-up"></i> Unblock</button>
                            <?php } else { ?>
                                <button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>                        
                            <?php }?>
                        <?php } else { ?>  
                                <button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>
                        <?php }?>        
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
                                            <h4 class="modal-title">Credit Check</h4>
                                            <small class="font-bold">This is GSMStockMarket.com's credit information.</small>
                                        </div>
                                        <div class="modal-body example">
                                            <p><img src="public/main/template/gsm/images/credit_example.png" class="img-responsive"/></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            
                            
                                 
                            <div class="modal inmodal fade" id="creditdata" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Request a Credit Check</h4>
                                            <small class="font-bold">You will need to get permission from this user to access their credit data</small>
                                        </div>
                                        <input type="hidden" name="from" id="from" value="" />
                                        <input type="hidden" name="cust_name" id="cust_name" value="" />
                                        <input type="hidden" name="report" id="report" value="" />
                                        <div class="modal-body">
                                        <div class="alert alert-info">
                                            <p><i class="fa fa-info-circle"></i> Request a credit check from any user silver or above. Available to silver membership only <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
                                        </div>
                                        <p class="text-navy"><strong>Notice:</strong> Please be aware although credit reports are free you will still need permission from the users company first.<br />The user can accept or decline at their own discretion, It is ideal to message them first before requesting a credit check so they know your intentions.</p><br />
                                        <div class="radio i-checks"><label> <input type="radio" value="option1" name="creditdata"> <i></i> Request their company credit report and <strong>deny</strong> them access to yours.</label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="option2" name="creditdata"> <i></i> Request their company credit report and <strong>allow</strong> them access to yours. (Recommended)</label></div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="submit" data-dismiss="modal">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <?php
                            
                                $this->load->module('profile');
                                $this->profile->send_message($member_company->id);
                            
                            ?>   


<?php } else {?>
<!-- Daniel Added End -->


			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>View Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>                            
                        <li>
                            View Profile
                        </li>              
                        <li class="active">
                            <strong><?php echo $member_company->company_name;?></strong>
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
                                        <?php if($this->session->userdata('members_id') == 5){?>
                                            <button type="button" onclick="editProfile('<?php echo $member_info->id;?>');" class="btn btn-white btn-xs pull-right" style="margin-left:5px;">Edit Profile</button>                                            
                                        <?php }?>
                                        <?php if($this->session->userdata('admin_logged_in')){?>
                                            <button type="button" onclick="deleteProfile('<?php echo $member_info->id;?>');" class="btn btn-white btn-xs pull-right">Delete Profile</button>
                                        <?php }?>
                                            <div class="pull-right" style="margin-right: 5px;">
                                                <?php if($member_company->marketplace == 'active') {?>
                                                <span class="label label-primary">VERIFIED</span>
                                                <?php } else {?>
                                                <span class="label label-danger">UNVERIFIED</span>
                                                <?php } ?>
                                            </div>
                                        <h2><?php echo $member_company->company_name;?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                            		<style>
                                                dl.full-width dt, dl.full-width dd {width:50%}
                                                dl.full-width dd {margin-left:51%}
                                        </style>
                                    
                              		<div class="m-r-md" style="text-align:center">
										<?php if(file_exists("public/main/template/gsm/images/company/".$member_company->id.".png")){?>
                                            <img src="public/main/template/gsm/images/company/<?php echo $member_company->id; ?>.png" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php } else {?>
                                            <img src="public/main/template/gsm/images/company/no_company.jpg" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php }?>
                            		</div>                                        
                                    
                                    <dl class="dl-horizontal full-width" style="margin-top:20px">
                                        <dt>Company Number:</dt> 
                                        <dd><?php echo $member_company->company_number;?></dd>
                                        <dt>VAT/Tax Number:</dt> 
                                        <dd><?php echo $member_company->vat_tax;?></dd>
                                    </dl>             
                                        
                                    <?php if($member->membership > 3){ ?>                   
                                    <dl class="dl-horizontal full-width">
                                        <dt>Address:</dt> <dd>  
                                            <?php echo $member_company->address_line_1;?><br/>
                                            <?php echo $member_company->address_line_2;?><br />
                                            <?php echo $member_company->town_city;?><br />
                                            <?php echo $member_company->county;?><br />
                                            <?php echo $member_company->post_code;?><br />
                                            <?php echo $this->country_model->get_where($member_company->country)->country;?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">                                    
                                        <dt>Phone Number:</dt>
                                        <dd>
                                            <?php 
                                                $mcount = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE id = '".$member_info->id."' AND dial_phone != ''");
                                                if($mcount[0]->count > 0) { 
                                            ?>
                                                (<?php echo $this->country_model->get_where($member_info->dial_phone)->dial_code; ?>)
                                            <?php } ?>
                                            <?php echo $member_info->phone_number?>
                                        </dd>
                                    </dl>
                                    <?php } else {} ?>
                                    
                                    <dl class="dl-horizontal full-width">
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
                                <div class="col-lg-6" id="cluster_info">
                                
                                    
                                    
                                    <dl class="dl-horizontal full-width" >
                                        <div style="margin-top:40px;text-align:center;margin-bottom:41px">
                                        <?php
                    
                                            $this->load->module('feedback');
                                            $this->feedback->member_feedback($member_info->id);
                                        
                                        ?>
                                        <div style="display:inline;height:65px;width:65px;padding:10px;margin-left:20px;"><i class="fa fa-star star-<?php echo $this->membership_model->get_where($member_info->membership)->membership;?>" class="star-" style="font-size:75px;vertical-align:top"></i></div>
                                    </div>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Status:  </dt>
                                        <?php if($member_info->online_status == 'online') {?>
                                            <dd><span class="label label-primary">Online</span></dd>
                                        <?php } else { ?>
                                            <dd><span class="label label-danger">Offline</span></dd>
                                            <?php if($this->login_model->get_where_multiple('member_id', $member_info->id, 'logged', 'yes')) {?>
                                            <dt>Last Logged:  </dt>
                                            <dd><?php echo $this->login_model->get_where_multiple('member_id', $member_info->id, 'logged', 'yes')->date?></dd>
                                            <?php }?>
                                        <?php } ?>                                        
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Subscription:</dt> 
                                        <dd><?php echo $this->membership_model->get_where($member_info->membership)->membership;?> Member</dd>

                                        <dt>Member Since:</dt> <dd> <?php echo $member_info->date?></dd>
                                    </dl>
                                    
                                    <?php if($member->membership > 3){ ?>                                    
                                    <dl class="dl-horizontal full-width" >
                                        <dt>Facebook:</dt> 
                                        <dd> <?php echo $member_info->facebook?></dd>
                                        <dt>Twitter:</dt> 
                                        <dd> <?php echo $member_info->twitter?></dd>
                                        <dt>Google Plus:</dt>
                                        <dd> <?php echo $member_info->gplus?></dd>
                                        <dt>LinkedIn:</dt> 
                                        <dd> <?php echo $member_info->linkedin?></dd>
                                        <dt>Skype:</dt> 
                                        <dd> <?php echo $member_info->skype?></dd>
                                        
                                    </dl>
                                    <?php } else {} ?>
                                    
                                    <div class="row">
                                        <?php ?>
                                        <?php if($this->session->userdata('membership') != 1) {?>
                                        <div class="col-md-10 col-md-offset-1" style="margin-top:15px">
                                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i> Send Message</button>
                                        </div>
                                        <?php } ?>
                                        <!--
                                        <div class="col-md-6" style="margin-top:15px">
                                            <button type="button" class="btn btn-default btn-sm btn-block" id="conversation"><i class="fa fa-wechat"></i> Start Conversation</button>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <input type="hidden" id="cust_added" name="cust_added" value="<?php echo $member_info->id;?>"/>
                                        <input type="hidden" id="cust_individual" name="cust_individual" value="<?php echo $member_info->firstname.' '.$member_info->lastname;?>"/>
                                        <input type="hidden" id="cust_company" name="cust_company" value="<?php echo $member_company->company_name;?>"/>
                                        <input type="hidden" id="cust_business1" name="cust_business1" value="<?php if($member_company->business_sector_1 != ''){echo $member_company->business_sector_1;} else{ if($member_company->other_business != ''){echo $member_company->other_business;}else{ echo 'NULL';}}?>"/>
                                        <input type="hidden" id="cust_business2" name="cust_business2" value="<?php echo $member_company->business_sector_2; ?>"/>
                                        <input type="hidden" id="cust_business3" name="cust_business3" value="<?php echo $member_company->business_sector_3; ?>"/>
                                        <input type="hidden" id="cust_country" name="cust_country" value="<?php echo $member_company->country?>"/>
                                        <?php 
                                        
                                        $this->load->model('addressbook/addressbook_model', 'addressbook_model');
                                        $a_count =  $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'), 'address_member_id', $member_info->id);
                                        
                                        if($a_count < 1){
                                        ?>
                                            <div class="col-md-5 col-md-offset-1" style="margin-top:15px">
                                                <button type="button" onclick="contactAdd();" class="btn btn-success btn-sm btn-block" id="contact_added"><i class="fa fa-book"></i> Add Contact</button>
                                            </div>
                                        <?php
                                        } else{
                                        ?>
                                            <div class="col-md-5 col-md-offset-1" style="margin-top:15px">
                                                <button type="button" onclick="contactRemove();" class="btn btn-success btn-sm btn-block" id="contact_removed"><i class="fa fa-book"></i> Remove Contact</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php 
                                        
                                        $this->load->model('favourite/favourite_model', 'favourite_model');
                                        $f_count =  $this->favourite_model->count_where('member_id', $this->session->userdata('members_id'), 'favourite_id', $member_info->id);
                                        
                                        if($f_count < 1){
                                        ?>
                                            <div class="col-md-5" style="margin-top:15px">
                                                <button  onclick="faveAdd();"  type="button" class="btn btn-warning btn-sm btn-block" id="favourite_added"><i class="fa fa-star"></i> Add Favourite</button>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-md-5" style="margin-top:15px">
                                                <button  onclick="faveRemove();"  type="button" class="btn btn-warning btn-sm btn-block" id="favourite_removed"><i class="fa fa-star"></i> Remove Favourite</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-10 col-lg-offset-1">
                                    <h4>Company Bio</h4>
                                	<p style="margin-top:20px"><?php echo $member_company->company_profile;?></p>
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
                                            <li class=""><a href="#selling-offers" data-toggle="tab">Selling Offers</a></li>
                                            <li class=""><a href="#buying-requests" data-toggle="tab">Buying Requests</a></li>
                                            <li class=""><a href="#events" data-toggle="tab">Events Attending</a></li>
                                            <?php if($comp_member_count > 1) {?>
                                                <li class=""><a href="#company_users" data-toggle="tab">Company Members</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                    
                                <div class="tab-pane active" id="feedposts">
                                    
                                <?php
                                
                                    $this->load->module('feed');
                                    $this->feed->feed_list($member_info->id);
                                ?>    
                                </div>
                                
                                <div class="tab-pane" id="feedback">
                                    
                                    <?php
                                    
                                        $this->load->module('feedback');
                                        $this->feedback->feedback_list($member_info->id);
                                    ?>

                                </div>
                                <div class="tab-pane no_sub" id="selling-offers">
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make &amp; Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php if($sellingOffers) foreach ( $sellingOffers as $key => $value ){ ?>
                                            <tr>
                                                <td><?=$value->product_make?> <?=$value->product_model?></td>
                                                <td><?=$value->unit_price?></td>
                                                <td><?=$value->qty_available?></td>
                                                <td><?php
                                                    require __DIR__."/../../marketplace/views/snippets/get_status_of_the_listing.php";
                                                    ?></td>
                                                <td><a href="<?=base_url()?>marketplace/listing_detail/<?=$value->id?>" target="_blank">
                                                        <button style="font-size:10px" class="btn btn-primary" type="button">More Info</button>
                                                </a></td>
                                            </tr>
                                        <?php } ?></tbody>
                                    </table>
                                </div>
                                <div class="tab-pane no_sub" id="buying-requests">
                                	<table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                            	<th class="mobihide">Make &amp; Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php if($buyingRequests) foreach ( $buyingRequests as $key => $value ){ ?>
                                            <tr>
                                                <td><?=$value->product_make?> <?=$value->product_model?></td>
                                                <td><?=$value->unit_price?></td>
                                                <td><?=$value->qty_available?></td>
                                                <td><?php
                                                    require __DIR__."/../../marketplace/views/snippets/get_status_of_the_listing.php";
                                                ?></td>
                                                <td><a href="<?=base_url()?>marketplace/listing_detail/<?=$value->id?>" target="_blank">
                                                        <button style="font-size:10px" class="btn btn-primary" type="button">More Info</button>
                                                    </a></td>
                                            </tr>
                                        <?php } ?></tbody>
                                    </table>
                                </div>
                                
                                <div class="tab-pane" id="events">
                                
                                    <?php
                                    
                                        $this->load->module('attending');
                                        $this->attending->attending_list($member_info->id);
                                    ?>
                                    
                                </div>
                                    
                                <div class="tab-pane" id="company_users">
                                
                                   <?php

                                        foreach($company_users as $cu){
                                            if($cu->id != $pid){
                                    ?>

                                        <div class="feed-element">
                                            <a href="member/profile/<?php echo $cu->id; ?>" class="pull-left">
                <!--                                <img alt="image" class="img-circle" src="img/a1.jpg">-->
                                                <?php if(file_exists("public/main/template/gsm/images/members/".$cu->id.".png")){?>
                                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $cu->id; ?>.png">
                                                <?php } else {?>
                                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg">
                                                <?php }?>  
                                            </a>
                                            <div class="media-body">
                                                <b>Name:</b> <?php echo $this->member_model->get_where($cu->id)->title; ?> <?php echo $this->member_model->get_where($cu->id)->firstname; ?> <?php echo $this->member_model->get_where($cu->id)->lastname; ?>
                                                <br/>
                                                <b>Role:</b> <?php echo $this->member_model->get_where($cu->id)->role; ?>
                                                <br/>
                                                <b>Mobile:</b> <?php echo $this->member_model->get_where($cu->id)->mobile_number; ?>                                
                                            </div>
                                        </div>

                                    <?php
                                            }
                                            //echo $cu->id.'<br/>';
                                        }
                                    ?>
                                    
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
                    <h2>Company User</h2>
                    	<div class="m-r-md" style="text-align:center;margin-top:20px;margin-bottom:20px;">
                                                <?php if(file_exists("public/main/template/gsm/images/members/".$member_info->id.".png")){?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $member_info->id; ?>.png">
                                                <?php } else {?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg">
                                                <?php }?>  
                            		</div>
                                                                     
                                        
                                    <dl class="dl-horizontal full-width">
                                        <dt>Name:</dt> 
                                        <dd> <?php echo $member_info->title?> <?php echo $member_info->firstname?> <?php echo $member_info->lastname?></dd>
                                        <dt>Role:</dt> 
                                        <dd> <?php echo $member_info->role?></dd>
                                    	<?php if($member->membership > 3){ ?> 
                                        <dt>Mobile Number:</dt> 
                                        <dd> <?php echo $member_info->mobile_number?></dd>
                                        <?php } else {} ?>
                                    </dl>  
                                    
                    
                    
                    <div class="row" style="margin-top:20px">
                    	<div class="col-lg-12">
                            <?php if(file_exists("public/main/template/gsm/creditdata/".$member_company->credit_report.".pdf")){?>
                        	<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#creditdata"><i class="fa fa-check-square-o"></i> Request Credit Check</button>         
                            <?php } else {?>
                                <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-check-square-o"></i> No Credit Data</button>                            
                            <?php } ?>    
                        </div>
                   </div>
                   
                   
                   
			<div class="row">
                        <div class="col-lg-6" style="margin-top:15px">
<!--                         	<button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#report_user"><i class="fa fa-exclamation"></i> Report</button>-->
                            <button type="button" class="btn btn-warning btn-sm btn-block" id="report_user"><i class="fa fa-exclamation"></i> Report</button>
                        </div>
                        <div class="col-lg-6" style="margin-top:15px">
                        <?php if($blocked){?>    
                            <?php if($blocked[0]->block_member_id > 0){?>
                                <button onclick="unblock();" type="button" class="btn btn-warning btn-sm btn-block" id="unblocked"><i class="fa fa-thumbs-up"></i>Unblock</button>
                            <?php } else { ?>
                                <button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>                        
                            <?php }?>
                        <?php } else { ?>  
                                <button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>
                        <?php }?>        
                         </div>
                   </div>
                    
                </div>
            </div>
        </div>   
                            
                            <?php
                            
                                $this->load->module('profile');
                                $this->profile->send_message($member_company->id);
                            
                            ?>   
                                 
                            <div class="modal inmodal fade" id="report_user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Report this user!</h4>
                                            <small class="font-bold">Please fill in the form below to submit a report</small>
                                        </div>
                                        
                                        <input type="hidden" name="from" id="from" value="<?php echo $this->member_model->get_where($this->session->userdata('members_id'))->email; ?>" />
                                        <input type="hidden" name="cust_name" id="cust_name" value="<?php echo $this->member_model->get_where($this->session->userdata('members_id'))->firstname. ' '.$this->member_model->get_where($this->session->userdata('members_id'))->lastname; ?>" />
                                        <input type="hidden" name="report" id="report" value="<?php echo $member_info->id; ?>" />
                                        <div class="modal-body">
                                                <p><strong>Form to support service.</strong></p>
<!--                                                <select class="form-control" name="subject" class="subject">
                                                    <option value="General">General Enquiry</option>
                                                    <option value="Billing">Billing &amp; Accounts</option>
                                                    <option value="Complaint">Abuse &amp; Complaints</option>
                                                    <option value="Market Issue">Marketplace Issue</option>                                
                                                    <option value="Feedback">Website Feedback</option>
                                                    <option value="Other">Other</option>
                                                </select>-->
                                                <br/>
<!--                                                <textarea class="form-control" rows="8" name="report_message" id="message"></textarea>-->
                                                <?php 

                                                    $data = array(
                                                                'name'          => 'report_message',
                                                                'id'            => 'report_message',
                                                                'class'         => 'form-control', 
                                                                'style'         => 'border:none',
                                                                'required'      => 'required'
                                                              );

                                                    echo form_textarea($data);

                                                ?>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="submit_report">Send Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                 
                            <?php
                            
                                $this->load->module('creditdata');
                                $this->creditdata->request_creditcheck($cust_id);
                            ?>
<!-- Daniel Added Start -->
<?php } ?> 
<!-- Daniel Added End -->
            
            
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
        
    <!-- checkbox css -->
    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">
    
    <!-- iCheck -->
    <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
        
