<?php
$current_datetime = strtotime(date('d-m-Y H:i:s'));
$end_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->listing_end_datetime)));
$start_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->schedule_date_time)));

if($current_datetime > $end_datetime || $value->qty_available == 0){
    ?> <span class="label label-danger">Inactive</span><?php
} elseif($current_datetime >= $start_datetime){?>
    <span class="label label-primary">Active</span>
<?php }else{ if($value->scheduled_status){ ?>
    <span class="label label-success">Scheduled</span>
<?php }}?>