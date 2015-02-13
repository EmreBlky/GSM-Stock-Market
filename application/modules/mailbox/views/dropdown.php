
    <?php if($count > 0){?>
        <?php foreach($inbox_message as $inbox){?>
			<a href="mailbox/inbox/all/<?php echo $inbox->id; ?>" class="message_alert">
            <li>
                <div class="dropdown-messages-box">
                        <?php if(file_exists($base."public/main/template/gsm/images/members/'.$inbox->member_id.'.jpg")){?>
                            <img alt="image" class="img-circle pull-left message_alert" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $inbox->member_id; ?>.jpg" height="128" width="128">
                        <?php } else {?>
                            <img alt="image" class="img-circle pull-left message_alert" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128">
                        <?php }?>
                    <div class="media-body">
                        <strong><?php echo $inbox->subject; ?></strong>. <br>
                        <small class="text-muted"><?php echo $inbox->time; ?> - <?php echo $inbox->date; ?></small>
                    </div>
                </div>
            </li>
            </a>
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
