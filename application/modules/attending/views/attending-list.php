
<div class="feed-activity-list">
    <?php if($list_count > 0) {?>
    
        <?php foreach($lists as $list) {?>
        <!-- Each Event Start -->
        <div class="feed-element">
            <div class="col-md-3">
                <?php if(file_exists("public/main/template/gsm/images/events/".$list->event_id.".jpg")){?>
                    <img src="public/main/template/gsm/images/events/<?php echo $list->event_id; ?>.jpg" class="img-responsive" style="margin:0 auto;max-height:150px">
                <?php } else {?>
                    <img src="public/main/template/gsm/images/no_events_logo.jpg" class="img-responsive" style="margin:0 auto;max-height:150px">
                <?php }?>                
            </div>
            <div class="col-md-9">
            <div class="media-body">
                <a class="label label-primary pull-right" href="<?php echo $this->events_model->get_where($list->event_id)->website; ?>" target="_blank">Visit Website</a>
                <strong><?php echo $this->events_model->get_where($list->event_id)->name; ?><br />
                    <small class="text-navy"><?php echo $this->events_model->get_where($list->event_id)->venue; ?>, <?php echo $this->events_model->get_where($list->event_id)->location; ?> - <?php echo $this->events_model->get_where($list->event_id)->date; ?></small></strong><br />
                    <p><?php echo $this->events_model->get_where($list->event_id)->description; ?></p>
            </div>
            </div>
        </div>
        <!-- Each Event End -->  
        <?php }?>
    
    <?php } else { ?>
    <div class="feed-element">
        The company is not attending any events.
    </div>
    <?php }?>
</div>