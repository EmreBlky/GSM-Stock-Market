<?php

//echo '<pre>';
//print_r($address_book);
//echo '</pre>';

$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
$this->load->model('favourite/favourite_model', 'favourite_model');


?>

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
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked"> Favourites </label> 
                            <label class="checkbox-inline"> <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked"> Individuals </label>
                            <label class="checkbox-inline"> <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked"> Companies </label>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control m-b" name="business_activity">
                                <option selected="selected">All Business Activities</option>
                                <option>Insurance</option>
                                <option>Mobile Repair</option>
                                <option>Network Operator</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control m-b" name="country">
                                <option selected="selected">All Countries</option>
                                <option>France</option>
                                <option>United Kingdom</option>
                                <option>United States</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group"><input type="text" class="form-control"> <span class="input-group-btn"> <button type="button" class="btn btn-primary">Search</button> </span></div>
                        </div>
                    	</div><!-- row -->
                    </div><!-- ibox-content -->
            </div>
        </div><!-- row end --> 
        
        <div class="row">
        <?php 
            if($addressbook_count > 0){
            foreach ($address_book as $address) {
            $f_count = $this->favourite_model->count_where_multiple('member_id', $this->session->userdata('members_id'), 'favourite_id' ,$address->address_member_id); 
            
        ?>
            <script type="text/javascript">    

                        function faveAdd()
                        {
                            //var cust_added     = $('#cust_added').val();
                            var cust_added = "<?php echo $address->address_member_id;?>";
                             $.ajax({
                                    type: "POST",
                                    url: "favourite/add/"+ cust_added +"",
                                    dataType: "html",
                                    success:function(data){
                                      $('#favourite_added').replaceWith('<button  onclick="faveRemove();"  type="button" class="btn btn-favourite" id="favourite_removed"><i class="fa fa-star"></i> Remove Favourite</button>');                             
                                      toastr.success('This user has been added to your favourites.', 'Favourite Added');
                                    },
                            });
                        }

                        function faveRemove()
                        {
                            //var cust_added     = $('#cust_added').val();
                            var cust_added = "<?php echo $address->address_member_id;?>";
                             $.ajax({
                                    type: "POST",
                                    url: "favourite/remove/"+ cust_added +"",
                                    dataType: "html",
                                    success:function(data){
                                      $('#favourite_removed').replaceWith('<button  onclick="faveAdd();"  type="button" class="btn btn-favourite" id="favourite_added"><i class="fa fa-star"></i> Add Favourite</button>');                             
                                      toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
                                    },
                            });
                        }


            </script>
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
                                <span class="label label-secondary">Offline</span>
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
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <input type="hidden" name="cust_added" id="cust_added" value="<?php echo $address->address_member_id;?>"/> 
                                                            
                            <?php if($f_count < 1){?>
                                <div> 
                                <button onclick="faveAdd();" class="btn btn-favourite" type="button" id="favourite_added"><i class="fa fa-star"></i>&nbsp;Add Favourite</button>
                                </div>
                            <?php }else{?>
                            <div>
                                 <button onclick="faveRemove();" class="btn btn-favourite" type="button" id="favourite_removed"><i class="fa fa-star"></i>&nbsp;Remove Favourite</button>
                            </div>
                            <?php }?>                           
                            
                            <?php if($this->member_model->get_where_multiple('id', $address->address_member_id)->online_status == 'online'){?>
                            <div>    
                                 <button class="btn btn-messenger" type="button"><i class="fa fa-wechat"></i>&nbsp;Messenger</button>  
                            </div>     
                            <?php }?>                           
                            
                            <div>
<!--                            <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i>&nbsp;Message</button>-->
                            <button  onclick="location.href='member/profile/<?php echo $address->address_member_id ?>'" class="btn btn-profile" type="button"><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            <?php
        
            $this->load->module('profile');
            $this->profile->send_message($address->address_member_id);
            ?>
        
        <?php 
        
                }
                
            }?>    
            
       	</div><!-- Row End -->
        <?php 
            if($addressbook_count > 0){
                echo $pagination;
            }
        ?>
           
         
        </div>
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