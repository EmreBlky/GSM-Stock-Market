<div class="row original">
        <?php 
        
//            if($addressbook_count > 0){
//                echo '<pre>';
//                print_r($address_book);
//            }
//            else{
//                echo 'NO RESULTS FOUND';
//            }
        
        ?>
    <?php 
           if($addressbook_count > 0){
            foreach ($address_book as $address) {
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
                            <li><strong><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $address->address_member_id)->company_id)->company_name; ?></strong></li>
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
                            <div class="ibox-content">There are '.$addressbook_count.' Results.</div>   
                        </div>
                    </div>
                     ';
            }
            ?>    
            
</div><!-- Row End -->
<?php 
    if($addressbook_count > 0){
        echo $pagination;
    }
?>