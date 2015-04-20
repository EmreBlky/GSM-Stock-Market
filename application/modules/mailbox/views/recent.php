<div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Messages</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content ibox-heading">
                                <h3><i class="fa fa-envelope-o"></i> Most Recent messages</h3>
                                <small>
                                    <?php if($n_count > 0){ echo '<i class="fa fa-tim"></i>You have '.$n_count.' new messages.<br/>'; }?>
                                    <?php if($d_count > 0){ echo '<i class="fa fa-tim"></i>You have '.$d_count.' waiting in draft folder.'; }?>
                                </small>
                            </div>
                            <div class="ibox-content">
                                <div class="feed-activity-list">
                                    
                                    <?php 
                                    if($inbox_count > 0){
                                        foreach($inbox_recent as $inbox) {
                                            $this->load->model('member/member_model', 'member_model');
                                    ?>
                                    
                                        <?php if($inbox->mail_read == 'no'){ ?>

                                            <div class="feed-element">
                                                <a href="mailbox/inbox/<?php echo $inbox->sent_from?>/<?php echo $inbox->id?>">
                                                    <div>
                                                        <!-- <small class="pull-right text-navy">1m ago</small> -->
                                                        <strong><?php echo $this->member_model->get_where($inbox->member_id)->firstname; ?> <?php echo $this->member_model->get_where($inbox->member_id)->lastname; ?></strong>
                                                        <div><strong><?php echo $inbox->subject; ?></strong></div>
                                                        <small class="text-muted"><strong><?php echo $inbox->time; ?> <?php echo $inbox->date; ?></strong></small>
                                                    </div>
                                                </a>    
                                            </div>

                                        <?php }else { ?>
                                    
                                            <div class="feed-element">
                                                <a href="mailbox/inbox/<?php echo $inbox->sent_from?>/<?php echo $inbox->id?>">
                                                    <div>
                                                        <!-- <small class="pull-right text-navy">1m ago</small> -->
                                                        <?php echo $this->member_model->get_where($inbox->member_id)->firstname; ?> <?php echo $this->member_model->get_where($inbox->member_id)->lastname; ?>
                                                        <div><?php echo $inbox->subject; ?></div>
                                                        <small class="text-muted"><?php echo $inbox->time; ?> <?php echo $inbox->date; ?></small>
                                                    </div>
                                                </a>    
                                            </div>

                                        <?php }?>
                                    
                                        <?php }} else {?>
                                        <table>
                                            <tr class="read">
                                                <td class="check-mail"></td>
                                                <td class="mail-ontact">&nbsp;</td>
                                                <td class="mail-subject">You have no messages in your inbox.</td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">&nbsp;</td>
                                            </tr>                                        
                                        </table>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>

