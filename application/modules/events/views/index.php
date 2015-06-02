<?php

//    echo '<pre>';
//    print_r($events);
//    exit;
    
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Events</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li class="active">
                <strong>Events</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content  animated fadeInRight">

<?php 	$id = $this->session->userdata('members_id');
		$member = $this->member_model->get_where($id);
		if($member->membership < 2 ){
?>
    <div class="alert alert-danger">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
<?php } ?>


<?php if($events_count > 0) { ?>
    
    <?php if($events_active > 0){?>
     <div class="row">
        <?php foreach($events as $event){ ?>
            <div class="col-lg-6">
                <div class="contact-box">
                            <div class="row">
                      <div class="col-md-4">
                          <?php if(file_exists("public/main/template/gsm/images/events/".$event->id.".jpg")){?>
                              <img class="img-responsive" style="margin:auto" src="public/main/template/gsm/images/events/<?php echo $event->id;?>.jpg">
                          <?php } else {?>
                              <img class="img-responsive" style="margin:auto" src="public/main/template/gsm/images/no_event_logo.png">
                          <?php } ?>    
                      </div>
                      <div class="col-md-8 element">
                          <h3 style="margin:0"><strong><?php echo $event->name;?></h3>
                          <p class="text-navy"><i class="fa fa-map-marker text-center" style="width:1em"></i> <?php echo $event->location;?>, <?php echo $event->venue;?><br /><i class="fa fa-calendar text-center" style="width:1em"></i> <?php echo $event->date;?></strong></p>
                          <p><?php echo $event->description;?></p>
                      </div>
                      <div class="col-md-12">
                          <?php $evcount = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE event_id = '".$event->id."'"); ?>
                          <?php //if($evcount[0]->count > 0){?>
                            <a href="events/attendees/<?php echo $event->id;?>"><button class="btn btn-info pull-right" type="button" style="font-size:10px"><i class="fa fa-users"></i>&nbsp;View Attendees (<?php echo $evcount[0]->count; ?>)</button></a>
                          <?php //} else {?>
<!--                            <button class="btn btn-info pull-right" type="button" style="font-size:10px"><i class="fa fa-users"></i>&nbsp;View Attendees (<?php echo $evcount[0]->count; ?>)</button>-->
                          <?php //}?>
                          <a href="<?php echo $event->website;?>" target="_blank"><button class="btn btn-primary pull-right" type="button" style="font-size:10px;margin-right:15px"><i class="fa fa-globe"></i>&nbsp;Visit Website</button></a>
                      </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div> 
    <?php } else {?>
    <div class="row">
        
        <div class="col-lg-12">
            <div class="contact-box">
    		<div class="row">
                    There are no events at present.
                </div>	
            </div>
		</div>
       
    </div> 
    <?php } ?> 
<?php } else { ?> 
    <div class="row">
        <div class="col-lg-12">
            <div class="contact-box">
                <div class="row">
                    There are no events at present.
                </div>
            </div>
        </div>
    </div> 
        
<?php }?>         
    
        
        

</div>


<script type="text/javascript" src="public/main/template/gsm/js/jquery.matchHeight-min.js"></script>

<script type="text/javascript">
	$(function() {
    $('.element').matchHeight();
});
</script>
