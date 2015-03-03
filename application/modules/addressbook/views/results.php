<?php

//echo '<pre>';
//print_r($results);
//exit;

$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
$this->load->model('favourite/favourite_model', 'favourite_model');


?>
<script type="text/javascript">

    function sendMessage(mid, sid)
    {
        //alert(mid);
        //alert(sid);
        //var mid     = $('#sent_by').val();
        //var sid     = $("#sent_to").val();
        $("#submit_message_"+sid+"").hide();
        var subject = $("#subject").val();
        var body    = $("#body_"+sid+"").val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
        var body    = body.replace(/\//g, 'SLASH1');
        var body    = body.replace(/\?/g, 'QUEST1');
        var body    = body.replace(/\%/g, 'PERCENT1');
        
         $.ajax({
                type: "POST",
                url: "mailbox/composeAjaxMail/"+ mid +"/"+ sid +"/"+ subject +"/"+body +"",
                dataType: "html",
                success:function(data){
                    
                  $("#body_"+sid+"").val('');   
                  $('#profile_message_'+sid+'').modal('hide');
                  toastr.success('Your message has been sent.', 'Message Alert');
                  $("#submit_message_"+sid+"").show('slow');
                },
            });    
    }
    
</script>
<script type="text/javascript">    
            
            function faveAdd(mid)
            {
                //var cust_added     = $('#cust_added').val();
                //alert(mid);
                var member      = "'"+ mid +"'";
                 $.ajax({
                        type: "POST",
                        url: "favourite/add/"+ mid +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_added_'+mid+'').replaceWith('<button  onclick="faveRemove('+ member +');" type="button" class="btn btn-favourite" id="favourite_removed_'+mid+'"><i class="fa fa-star"></i> Remove Favourite</button>');                             
                          toastr.success('This user has been added to your favourites.', 'Favourite Added');
                        },
                });
            }
            
            function faveRemove(mid)
            {
                //var cust_added     = $('#cust_added').val();
                //alert(mid);
                 var member      = "'"+ mid +"'";
                 $.ajax({
                        type: "POST",
                        url: "favourite/remove/"+ mid +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_removed_'+mid+'').replaceWith('<button  onclick="faveAdd('+ member +');"  type="button" class="btn btn-favourite" id="favourite_added_'+mid+'"><i class="fa fa-star"></i> Add Favourite</button>');                             
                          toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
                        },
                });
            }


</script>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Address Book</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>Address Book</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        
        <div class="row">
            <div class="col-lg-12">
            	<div class="ibox float-e-margins">
                    <div class="ibox-content">
            			<div class="row">
                        <div class="col-lg-2">
                            <label class="checkbox-inline i-checks" style="margin:10px"> <input type="checkbox"> Favourites </label> 
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control m-b dropdown_one" name="dropdown_one">
                                <option value="ORDER BY company ASC" selected="selected">A - Z Company</option>
                                <option value="ORDER BY company DESC">Z - A Company</option>
                                <option value="ORDER BY individual ASC">A - Z Individual</option>
                                <option value="ORDER BY individual DESC">Z - A Individual</option>
                                <option value="ORDER BY date DESC">Date Added</option>
                            </select>    
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control m-b dropdown_two" name="dropdown_two">
                                <option value="ALL" selected="selected">All Business Activities</option>
                                <option value="New Mobiles (Sim Free)">New Mobiles (Sim Free)</option>
                                <option value="New Mobiles (Network Stocks)">New Mobiles (Network Stocks)</option>
                                <option value="14 Day Mobiles">14 Day Mobiles</option>
                                <option value="Refurbished Mobiles">Refurbished Mobiles</option>
                                <option value="Used Mobiles">Used Mobiles</option>
                                <option value="BER Mobiles">BER Mobiles</option>
                                <option value="Mobile Accessories">Mobile Accessories</option>
                                <option value="Wearable Technology">Wearable Technology</option>
                                <option value="Bluetooth Products">Bluetooth Products</option>
                                <option value="Mobile Spare Parts">Mobile Spare Parts</option>
                                <option value="Mobile Service and Repair Centre">Mobile Service and Repair Centre</option>
                                <option value="Network Operator">Network Operator</option>
                                <option value="Freight Forwarding">Freight Forwarding</option>
                                <option value="Insurance">Insurance</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control m-b dropdown_three" name="dropdown_three">
                                <option value="ALL" selected="selected">All Countries</option>
                                <?php foreach($country as $country){?>
                                <option value="<?php echo $country->id?>"><?php echo $country->country?></option>
                                <?php }?>                                
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <?php

                                $this->load->module('search');
                                $this->search->addressbook();

                            ?>
                        </div>
                    	</div><!-- row -->
                    </div><!-- ibox-content -->
            </div>
        </div><!-- row end --> 
        <div id="results"></div>
        <div class="row original">
        <?php 
            if($results['search_addressbook'] != 'NO RESULTS WERE FOUND!'){
            foreach ($results['search_addressbook'] as $address) {
            $f_count = $this->favourite_model->count_where_multiple('member_id', $this->session->userdata('members_id'), 'favourite_id' ,$address->address_member_id); 
            
        ?>        
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="member/profile/<?php echo $address->address_member_id?>">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <?php if(file_exists("public/main/template/gsm/images/members/".$address->address_member_id.".jpg")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $address->address_member_id; ?>.jpg" height="128" width="128"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                             <?php if($this->member_model->get_where_multiple('id', $address->address_member_id)->online_status == 'online'){?>
                                <span class="label label-primary">Online</span>
                            <?php } else {?>
                                <span class="label label-danger">Offline</span>
                                
                            <?php }?>
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                        <h3 style="margin-bottom:0"><strong><?php echo $this->member_model->get_where_multiple('id', $address->address_member_id)->firstname.' '.$this->member_model->get_where_multiple('id', $address->address_member_id)->lastname ?></strong></h3>
                        <?php echo $this->member_model->get_where_multiple('id', $address->address_member_id)->role ?>
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong><?php $address->address_member_id ?></strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $address->address_member_id)->company_id)->business_sector_1; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $address->address_member_id)->company_id)->business_sector_2; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $address->address_member_id)->company_id)->business_sector_3; ?></li>
                            <?php 
                                if($this->member_model->get_where_multiple('id', $address->address_member_id)->online_status != 'online'){
                                    $logged = $this->login_model->get_where_multiple('member_id', $address->address_member_id, 'logged', 'no');
                                    //echo '<pre>';
                                    //print_r($logged);
                                    //exit;
                            ?>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li><b>Last Logged in: </b><?php echo $logged->time; ?> on <?php echo $logged->date; ?></li>
                            <?php }?>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <input type="hidden" name="cust_added_<?php echo $address->address_member_id;?>" id="cust_added_<?php echo $address->address_member_id;?>" value="<?php echo $address->address_member_id;?>"/> 
                                                            
                            <?php if($f_count < 1){?>
                                <div> 
                                <button onclick="faveAdd(<?php echo $address->address_member_id; ?>);" class="btn btn-favourite" type="button" id="favourite_added_<?php echo $address->address_member_id; ?>"><i class="fa fa-star"></i>&nbsp;Add Favourite</button>
                                </div>
                            <?php }else{?>
                            <div>
                                 <button onclick="faveRemove(<?php echo $address->address_member_id; ?>);" class="btn btn-favourite" type="button" id="favourite_removed_<?php echo $address->address_member_id; ?>"><i class="fa fa-star"></i>&nbsp;Remove Favourite</button>
                            </div>
                            <?php }?>                           
                            
                            <?php if($this->member_model->get_where_multiple('id', $address->address_member_id)->online_status == 'online'){?>
                            <div>    
                                 <button class="btn btn-messenger" type="button"><i class="fa fa-wechat"></i>&nbsp;Messenger</button>  
                            </div>     
                            <?php }?>                           
                            
                            <div>
                            <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_<?php echo $address->address_member_id;?>" value="<?php echo $address->address_member_id;?>"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button  onclick="location.href='<?php echo $base; ?>member/profile/<?php echo $address->address_member_id ?>'" class="btn btn-profile" type="button"><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            <div class="modal inmodal fade" id="profile_message_<?php echo $address->address_member_id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <?php
                            //$test = $address->address_member_id;
                            //exit;
                            $this->load->model('member/member_model', 'member_model');
                            $this->load->model('company/company_model', 'company_model');
                            $membs = $this->member_model->get_where($address->address_member_id);
                            $member_company = $this->company_model->get_where($address->address_member_id);
                        ?>
                        <?php
                             $attributes = array('id' => 'form');
                             echo form_open('mailbox/composeMail', $attributes); 
                        ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                            <small class="font-bold">Send a message to <?php echo $member_company->company_name?></small>
                            <input type="hidden" id="sent_by" name="sent_by" value="<?php echo $this->session->userdata('members_id'); ?>"/>
                            <input type="hidden" id="sent_to" name="sent_to" value="<?php echo $membs->id; ?>"/>                
                            <input type="hidden" id="email_address" name="email_address" value="<?php echo $membs->email; ?>"/>
                            <input type="hidden" id="subject" name="subject" value="Profile Message"/>
                        </div>
                        <div class="modal-body">
                            <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                            <?php 

                                $data = array(
                                            'name'          => 'body_'.$address->address_member_id,
                                            'id'            => 'body_'.$address->address_member_id,
                                            'class'         => 'form-control', 
                                            'style'         => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);

                            ?>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="submit" value="Send Message"/>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button onclick="sendMessage(<?php echo $this->session->userdata('members_id');?>, <?php echo $address->address_member_id;?>);" type="button" id="submit_message_<?php echo $address->address_member_id;?>" class="btn btn-primary">Send Message</button>
            <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        
        <?php 
                //unset($address->address_member_id);
                }
                
            }
            else{
                
                echo '
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">'.$results['search_addressbook'].'</div>   
                        </div>
                    </div>
                     ';
            }
            ?>    
            
       	</div><!-- Row End -->
        <?php 
            //if($addressbook_count > 0){
                //echo $pagination;
            //}
        ?>
           
         
        </div>
        </div>

        <!-- iCheck -->
    	<link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">
        <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
        
        <script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script>
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
            
        })
    </script> 
    <script type="text/javascript">

    $(".dropdown_one").change(function () {
        var one = this.value;
        var two = $('.dropdown_two').val();
        var three = $('.dropdown_three').val();
        //var firstDropVal = $('#pick').val();
        //alert(one);
        //alert(two);
        //alert(three);
        
        $.ajax
            ({
            type: "POST",
            url: "addressbook/searchQuery/" + one + "/" + two + "/" + three + "",
            dataType: "html",		 
            success: function(html)
            {
               $('.original').hide();    
               $("#results").html(html);
            } 
            });
    });
    
    $(".dropdown_two").change(function () {
        var one = $('.dropdown_one').val();
        var two = this.value;
        var three = $('.dropdown_three').val();
        //var firstDropVal = $('#pick').val();
        //alert(one);
        //alert(two);
        //alert(three);
        
        $.ajax
            ({
            type: "POST",
            url: "addressbook/searchQuery/" + one + "/" + two + "/" + three + "",
            dataType: "html",		 
            success: function(html)
            {
               $('.original').hide();    
               $("#results").html(html);
            } 
            });
    });
    
    $(".dropdown_three").change(function () {
        var one = $('.dropdown_one').val();
        var two = $('.dropdown_two').val();
        var three = this.value;
        //var firstDropVal = $('#pick').val();
        //alert(one);
        //alert(two);
        //alert(three);
        
        $.ajax
            ({
            type: "POST",
            url: "addressbook/searchQuery/" + one + "/" + two + "/" + three + "",
            dataType: "html",		 
            success: function(html)
            {
               $('.original').hide();    
               $("#results").html(html);
            } 
            });
    });

    </script>