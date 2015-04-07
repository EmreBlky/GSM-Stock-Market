<?php

//echo '<pre>';
//print_r($feed);
//exit;
$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
?>
<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row">
<?php 
$id = $this->uri->segment(3);
if(is_numeric($id)){?>
        
    <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                
                <h2>
                    View Feedback
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
                    <h5>
                        <span class="pull-right font-noraml"><?php echo $feedback->time.' '.$feedback->date;?></span>
                        <span class="font-noraml">From: </span><?php echo $this->member_model->get_where($feedback->member_id)->firstname.' '.$this->member_model->get_where($feedback->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($feedback->member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <p>
                        <?php echo $feedback->comments; ?>
                    </p>
                </div>                    
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-sm btn-white" href="admin/edit_feedback/<?php echo $feedback->id;?>"><i class="fa fa-book"></i> Edit</a>
                    <a class="btn btn-sm btn-white" href="admin/feedbackApprove/<?php echo $feedback->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                    <a class="btn btn-sm btn-white" href="admin/feedbackDecline/<?php echo $feedback->id;?>"><i class="fa fa-times text-warning"></i> Decline</a>
                </div>
                <div class="clearfix"></div>
                
                </div>
            </div>
        
<?php 

} else {
    if($feedback_count > 0){
?>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Feedback Approval Table</h5>
                
            </div>
            <div class="ibox-content">
               
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Comments</th>
                            <th>Communication</th>
                            <th>Shipping</th>
                            <th>Description</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>More</th>
                            <th>Action</th>
<!--                            <th>More</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($feedback as $feed) {?>    
                        <tr>
                            <td>                                
                                <?php echo substr($feed->comments,0,20).'...'; ?>
                            </td>
                            <td>
                                <span class="pie">
                                    <?php if($feed->communication == 5) { ?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                    <?php } elseif($feed->communication == 4) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->communication == 3) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->communication == 2) {?> 
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->communication == 1) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php }?>
                                </span>
                            </td>
                            <td>
                                <span class="pie">
                                    <?php if($feed->shipping == 5) { ?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                    <?php } elseif($feed->shipping == 4) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->shipping == 3) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->shipping == 2) {?> 
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->shipping == 1) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php }?>
                                </span>
                            </td>
                            <td>
                                <span class="pie">
                                    <?php if($feed->description == 5) { ?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                    <?php } elseif($feed->description == 4) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->description == 3) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->description == 2) {?> 
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->description == 1) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php }?>
                                </span>
                            </td>
                            <td>
                                <span class="pie">
                                    <?php if($feed->company == 5) { ?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                    <?php } elseif($feed->company == 4) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->company == 3) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->company == 2) {?> 
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php } elseif($feed->company == 1) {?>
                                        <i class="fa fa-star" style="color:#FC6"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php }?>
                                </span>
                            </td>
                            <td><?php echo $feed->date; ?></td>
                            <td>
                                <a href="admin/feedback/<?php echo $feed->id; ?>">CLICK HERE</a>
                            </td>
                            <td>
                                <a href="admin/edit_feedback/<?php echo $feed->id;?>"><i class="fa fa-book"></i> Edit</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="admin/feedbackApprove/<?php echo $feed->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="admin/feedbackDecline/<?php echo $feed->id;?>"><i class="fa fa-times text-warning"></i> Decline</a>
                            </td>
<!--                            <td>A</td>-->
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
<?php 
    }else{
?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>There are no feeds for approval. </h5>

                </div>
            </div>
        </div>    
        
<?php
    }
}
?>
        
    </div>

</div>

