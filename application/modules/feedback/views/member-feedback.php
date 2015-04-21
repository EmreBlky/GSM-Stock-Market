<?php 
                                            
    $this->load->module('feedback');
    $overall = $this->feedback->overallScore($mid);

    if($overall > 0) {

?>

    <?php if($overall >= 95){ ?>

        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1c84c6" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>


    <?php } elseif($overall <= 94 && $overall >= 80) {?>

        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>


    <?php } elseif($overall <= 79 && $overall >= 51) {?>

        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#f8ac59" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>


    <?php } else {?>

        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#ed5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>


    <?php } ?>

<?php } else { ?>                                          
        <input type="text" value="0" class="dial m-r" data-fgColor="#AAA" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>          
<?php } ?>
