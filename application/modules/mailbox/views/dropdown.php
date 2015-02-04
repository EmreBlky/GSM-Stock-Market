
<ul class="dropdown-menu dropdown-messages">
    <?php if($count > 0){?>
        <?php foreach($inbox_message as $inbox){?>
            <li>
                <div class="dropdown-messages-box">
                    <a href="mailbox/inbox/all/<?php echo $inbox->member_id; ?>" class="pull-left">
                        <?php if(file_exists($base."public/main/images/members/'.$inbox->member_id.'.jpg")){?>
                            <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/images/members/<?php echo $inbox->member_id; ?>.jpg" height="128" width="128">
                        <?php } else {?>
                            <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/images/members/no_profile.jpg" height="128" width="128">
                        <?php }?>
                    </a>
                    <div>
                        <a href="mailbox/inbox/all/<?php echo $inbox->member_id; ?>">
                        <small class="pull-right"><?php echo $inbox->time; ?> <?php echo $inbox->date; ?></small>
                        <strong><?php echo $inbox->subject; ?></strong>. <br>
                        <!-- <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small> -->
                        </a>
                    </div>
                </div>
            </li>
            <li class="divider"></li>
        <?php } ?>
            
    <?php } else {?> 
    <li>
        <div class="text-center link-block">           
                No New Messages           
        </div>
    </li>
    <li class="divider"></li>
    <?php }?>        
    <li>
        <div class="text-center link-block">
            <a href="mailbox/inbox">
                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
            </a>
        </div>
    </li>
</ul>