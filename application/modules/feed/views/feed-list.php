<?php

//echo '<pre>';
//print_r($feed);
//exit;
function days($var)
{
    $var = str_replace('-', '', $var);
    return $var;
}
                        
$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
?>

<div>
    <div class="chat-activity-list">
        <?php if($feed_count > 0){ 
                foreach($feed as $feed){
        ?>
        <div class="chat-element">
<!--            <a href="#" class="pull-left">-->
               <?php if(file_exists("public/main/template/gsm/images/members/".$feed->member_id.".jpg")){?>
                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $feed->member_id; ?>.jpg" height="38" width="38">
                <?php } else {?>
                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg" height="38" width="38">
                <?php }?> 
<!--            </a>-->
            <div class="media-body ">
                <small class="pull-right text-navy">
                    <?php 
                        $date1 = strtotime($feed->approved_date);
                        $date2 = time();
                        $subTime = $date1 - $date2;
                        $y = ($subTime/(60*60*24*365));
                        $d = ($subTime/(60*60*24))%365;
                        $h = ($subTime/(60*60))%24;
                        $m = ($subTime/60)%60;
                        
                        if($d < 0 && $d <= -2){
                            echo days($d).' Days ';
                        }
                        elseif($d < 0 && $d > -2){
                            echo days($d).' Day ';
                        }
                        if($h < 0 && $h <= -2){
                            echo days($h).' Hours and ';
                        }
                        elseif($h < 0 && $h > -2){
                            echo days($h).' Hour and ';
                        }
                        if($m < 0 && $m <= -2){
                            echo days($m).' Minutes ago';
                        }
                        elseif($m < 0 && $m > -2){
                            echo days($m).' Minute ago';
                        }
                        //echo "Difference between ".date('Y-m-d H:i:s',$date1)." and ".date('Y-m-d H:i:s',$date2)." is:\n";
                        //echo $y." years\n";
                        //echo $d." days\n";
                        //echo $d.' days '.$h.' hours '.$m.' minutes';
                    ?>
                </small>
                <strong><?php echo $this->member_model->get_where($feed->member_id)->firstname.' '.$this->member_model->get_where($feed->member_id)->lastname; ?></strong>
                <p class="m-b-xs">
                    <?php echo $feed->content; ?>
                </p>
                <small class="text-muted"><?php echo $feed->time; ?> - <?php echo $feed->date; ?></small>
            </div>
        </div>
        <?php 
                }
            }else{
        ?>
        <div class="chat-element">
            <?php echo $feed_message; ?>
        </div>
        <?php
                
            }
        ?> 
<!--        <div class="chat-element right">
            <a href="#" class="pull-right">
                <img alt="image" class="img-circle" src="public/main/template/core/img/a4.jpg">
            </a>
            <div class="media-body text-right ">
                <small class="pull-left">5m ago</small>
                <strong>John Smith</strong>
                <p class="m-b-xs">
                    Lorem Ipsum is simply dummy text of the printing.
                </p>
                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
            </div>
        </div>-->
        
    </div><!-- /chat-activity-list-->
</div>