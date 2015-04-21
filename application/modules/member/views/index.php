<?php

//echo '<pre>';
//print_r($list_member);
//echo '</pre>';
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Favourites</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>
                        <li class="active">
                            <strong>Members</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            
            <?php foreach ($list_member as $member){?> 
            
                <?php if($member->id != $this->session->userdata('members_id')){?>

                <div class="col-lg-4">
                    <div class="contact-box">
                        <a href="<?php echo $base;?>member/profile/<?php echo $member->id; ?>">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <?php if(file_exists("public/main/template/gsm/images/members/".$member->id.".jpg")){?>
                                    <img alt="image" class="img-circle m-t-xs img-responsive" src="public/main/template/gsm/images/members/<?php echo $member->id; ?>.jpg" height="128" width="128"/>
                                <?php } else {?>
                                    <img src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                                <?php }?>

                                <div class="m-t-xs font-bold"><?php echo $member->role;?></div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3><strong><?php echo $member->firstname.' '.$member->lastname;?></strong></h3>
                            <p><i class="fa fa-map-marker"></i> <?php echo $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($member->id)->company_id)->country)->country;?></p>
                            <p>
                                <i class="small">
                                    <?php 
                                    
                                        if($this->login_model->get_where_multiple('member_id', $member->id, 'logged', 'yes')){
                                            echo 'Last Logged In: '.$this->login_model->get_where_multiple('member_id', $member->id, 'logged', 'yes')->date.' @ '.$this->login_model->get_where_multiple('member_id', $member->id, 'logged', 'yes')->time;
                                        }
                                        else{
                                            echo '&nbsp;';
                                        }
                                    ?>
                                </i>
                            </p>
                            <address>
                                <strong>Contact Details</strong><br>
                                <abbr title="Phone">M:</abbr> <?php echo $member->phone_number;?><br/>
                                <abbr title="Phone">F:</abbr> <?php echo $member->mobile_number;?><br/>
                                <abbr title="Phone">E:</abbr> <?php echo $member->email;?><br/>
                            </address>
                        </div>
                        <div class="clearfix"></div>
                            </a>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
        </div>
        </div>
