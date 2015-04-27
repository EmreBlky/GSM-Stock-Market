<?php

//    echo '<pre>';
//    print_r($feed_list);
//    exit;
$five = '
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        ';
$four = '
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star"></i>
        ';
$three = '
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        ';
$two = '
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        ';
$one = '
        <i class="fa fa-star" style="color:#FC6"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        ';

?>

<?php if($feedback_count > 0) {?> 

<div class="feed-activity-list">
    <?php foreach($feed_list as $list) {?>
    <?php
    $overall = $list->feedback_score/20*100;
    ?>
    <div class="feed-element"> 
        <a href="#" class="pull-left">
<!--            <img alt="image" class="img-circle" src="public/main/template/core/img/profile_small.jpg">-->
            &nbsp;
        </a>
        <div class="media-body ">
            <div class="row">
                <div class="col-md-7">
<!--                    <strong>Daniel Gregory</strong> from <strong>GSMStockMarket.com Limited</strong> <br>
                    <small>2h ago</small>-->
                <p><?php echo $list->comments; ?></p>
                </div>
                <div class="col-md-5">
                    <style>
                    div#feedback dl.dl-horizontal {float:right}
                    div#feedback dt {width:120px}
                    div#feedback dd {margin-left:130px}
                    </style>
                    <?php if($list->type == 'sell') {?>
                    <dl class="dl-horizontal">
                        <dt>Type:</dt> 
                        <dd>  
                            Buyer
                        </dd>
                        <dt>Communication:</dt> 
                        <dd>  
                            <?php 
                                if($list->communication == 5) {  
                                    echo $five;
                                } 
                                elseif($list->communication == 4) {  
                                    echo $four;
                                } 
                                elseif($list->communication == 3) { 
                                    echo $three;
                                } 
                                elseif($list->communication == 2) {
                                    echo $two;
                                } 
                                elseif($list->communication == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        <dt>Payment:</dt> 
                        <dd>  
                            <?php 
                                if($list->shipping == 5) {  
                                    echo $five;
                                } 
                                elseif($list->shipping == 4) {  
                                    echo $four;
                                } 
                                elseif($list->shipping == 3) { 
                                    echo $three;
                                } 
                                elseif($list->shipping == 2) {
                                    echo $two;
                                } 
                                elseif($list->shipping == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        <dt>Company:</dt> 
                        <dd>  
                            <?php 
                                if($list->company == 5) {  
                                    echo $five;
                                } 
                                elseif($list->company == 4) {  
                                    echo $four;
                                } 
                                elseif($list->company == 3) { 
                                    echo $three;
                                } 
                                elseif($list->company == 2) {
                                    echo $two;
                                } 
                                elseif($list->company == 1) { 
                                    echo $one;
                                }
                            ?>
                        <!--
                        </dd><dt>Description:</dt> 
                        <dd>  
                            <?php 
                                if($list->description == 5) {  
                                    echo $five;
                                } 
                                elseif($list->description == 4) {  
                                    echo $four;
                                } 
                                elseif($list->description == 3) { 
                                    echo $three;
                                } 
                                elseif($list->description == 2) {
                                    echo $two;
                                } 
                                elseif($list->description == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        -->
                        <dt>Final Rating:</dt> 
                        <dd>
                            <?php if($overall >= 95){ ?>
                                <span class="label label-success"><?php echo $overall; ?></span>
                            <?php } elseif($overall <= 94 && $overall >= 80) {?>
                                <span class="label label-primary"><?php echo $overall; ?></span>
                            <?php } elseif($overall <= 79 && $overall >= 51) {?>
                            <span class="label label-warning"><?php echo $overall; ?></span>
                            <?php } else {?>
                                <span class="label label-danger"><?php echo $overall; ?></span>
                            <?php }?>
                            
                        </dd>
                    </dl>
                    <?php } else { ?>
                    <dl class="dl-horizontal">
                        <dt>Type:</dt> 
                        <dd>  
                            Seller
                        </dd>
                        <dt>Communication:</dt> 
                        <dd>  
                            <?php 
                                if($list->communication == 5) {  
                                    echo $five;
                                } 
                                elseif($list->communication == 4) {  
                                    echo $four;
                                } 
                                elseif($list->communication == 3) { 
                                    echo $three;
                                } 
                                elseif($list->communication == 2) {
                                    echo $two;
                                } 
                                elseif($list->communication == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        <dt>Shipping:</dt> 
                        <dd>  
                            <?php 
                                if($list->shipping == 5) {  
                                    echo $five;
                                } 
                                elseif($list->shipping == 4) {  
                                    echo $four;
                                } 
                                elseif($list->shipping == 3) { 
                                    echo $three;
                                } 
                                elseif($list->shipping == 2) {
                                    echo $two;
                                } 
                                elseif($list->shipping == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        <dt>Company:</dt> 
                        <dd>  
                            <?php 
                                if($list->company == 5) {  
                                    echo $five;
                                } 
                                elseif($list->company == 4) {  
                                    echo $four;
                                } 
                                elseif($list->company == 3) { 
                                    echo $three;
                                } 
                                elseif($list->company == 2) {
                                    echo $two;
                                } 
                                elseif($list->company == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd><dt>Description:</dt> 
                        <dd>  
                            <?php 
                                if($list->description == 5) {  
                                    echo $five;
                                } 
                                elseif($list->description == 4) {  
                                    echo $four;
                                } 
                                elseif($list->description == 3) { 
                                    echo $three;
                                } 
                                elseif($list->description == 2) {
                                    echo $two;
                                } 
                                elseif($list->description == 1) { 
                                    echo $one;
                                }
                            ?>
                        </dd>
                        <dt>Final Rating:</dt> 
                        <dd>
                            <?php if($overall >= 95){ ?>
                                <span class="label label-success"><?php echo $overall; ?></span>
                            <?php } elseif($overall <= 94 && $overall >= 80) {?>
                                <span class="label label-primary"><?php echo $overall; ?></span>
                            <?php } elseif($overall <= 79 && $overall >= 51) {?>
                            <span class="label label-warning"><?php echo $overall; ?></span>
                            <?php } else {?>
                                <span class="label label-danger"><?php echo $overall; ?></span>
                            <?php }?>
                            
                        </dd>
                    </dl>
                    <?php }?>
               </div>
            </div>
        </div> 
        
    </div>
    <?php }?>
</div>
<?php } else { ?>
<div class="feed-activity-list">
    <div class="feed-element">
        <p>You do not have any feedback at present.</p>
    </div>
</div>    
<?php }?>