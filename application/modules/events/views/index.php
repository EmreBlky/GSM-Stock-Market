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
<?php if($events_count > 0) { ?>
    
    <?php if($events_active > 0){?>
     <div class="row">
        <?php foreach($events as $event){ ?>
            <div class="col-lg-6">
                <div class="contact-box">
                            <div class="row">
                      <div class="col-md-4">
                          <?php if(file_exists("public/main/template/gsm/images/events/".$event->id.".jpg")){?>
                              <img class="img-responsive" src="public/main/template/gsm/images/events/<?php echo $event->id;?>.jpg">
                          <?php } else {?>
                              <img class="img-responsive" src="public/main/template/gsm/images/events/no_image.png">
                          <?php } ?>    
                      </div>
                      <div class="col-md-8 element">
                          <h3 style="margin:0"><strong><?php echo $event->name;?></h3>
                          <p class="text-navy"><i class="fa fa-map-marker text-center" style="width:1em"></i> <?php echo $event->location;?>, <?php echo $event->venue;?><br /><i class="fa fa-calendar text-center" style="width:1em"></i> <?php echo $event->date;?></strong></p>
                          <p><?php echo $event->description;?></p>
                      </div>
                      <div class="col-md-12">
                          <a href="events/attendees/<?php echo $event->id;?>"><button class="btn btn-info pull-right" type="button" style="font-size:10px"><i class="fa fa-users"></i>&nbsp;View Atendees (12)</button></a>
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


<script type="text/javascript" src="public/main/template/gsm/js/grids.min.js"></script>

<script type="text/javascript">
	jQuery(function($) {
		$('.element').responsiveEqualHeightGrid();	
	});
</script>