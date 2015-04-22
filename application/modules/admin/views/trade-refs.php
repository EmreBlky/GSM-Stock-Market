<?php

//echo '<pre>';
//print_r($ref);
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
                    View Company Trade Reference
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
                    <h5>                        
                        <span class="font-noraml">From: <?php echo $ref->name; ?> (<?php echo $ref->company; ?>)</span>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <p>
                        <?php echo $ref->comments; ?>
                    </p>
                </div>                    
                <div class="mail-body text-right tooltip-demo">
                    <!-- <a class="btn btn-sm btn-white" href="admin/edit_tradeRef/<?php echo $ref->id;?>"><i class="fa fa-book"></i> Edit</a> -->
                    <a class="btn btn-sm btn-white" href="admin/tradeRefApprove/<?php echo $ref->id;?>/<?php echo $code?>"><i class="fa fa-check text-navy"></i> Approve</a>
                    <a class="btn btn-sm btn-white" href="admin/tradeRefDecline/<?php echo $ref->id;?>/<?php echo $code?>"><i class="fa fa-times text-warning"></i> Decline</a>
                </div>
                <div class="clearfix"></div>
                
                </div>
            </div>
        
<?php 

} else {
    if($ref_count > 0){
?>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Company Trade Reference Table</h5>
                
            </div>
            <div class="ibox-content">
               
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>                           
                            <th>Customer</th>
                            <th>Trader Name</th>
                            <th>Trader Company</th>
                            <th>More</th>
                            <th>Action</th>
<!--                            <th>More</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($tradereference as $ref) {?>
                            <?php if($ref->trade_1_confirm == 'yes') {?>
                                <tr>                            
                                    <td>
                                        <span class="pie"><?php echo $this->member_model->get_where($ref->member_id)->firstname.' '.$this->member_model->get_where($ref->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($ref->member_id)->company_id)->company_name.')'; ?></span>
                                    </td>
                                    <td>
        <!--                                Project<small>This is example of project</small>-->
                                        <?php echo $ref->trade_1_company; ?>
                                    </td>
                                    <td>
        <!--                                Project<small>This is example of project</small>-->
                                        <?php echo substr($ref->trade_1_comments,0,20).'...'; ?>
                                    </td>
                                    <td>
                                        <a href="admin/trade_ref/<?php echo $ref->id; ?>/trade_1">CLICK HERE</a>
                                    </td>
                                    <?php if($ref->trade_1_admin_approve == 'declined') {?>
                                    <td> DECLINED </td>
                                    <?php } else { ?>
                                    <td>
                                        AWAITING APPROVAL
                                        <!-- <a href="admin/edit_bio/<?php echo $ref->id;?>"><i class="fa fa-book"></i> Edit</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="admin/bioApprove/<?php echo $ref->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="admin/bioDecline/<?php echo $ref->id;?>"><i class="fa fa-times text-warning"></i> Decline</a> -->
                                    </td>
                                    <?php } ?>
                                   
        <!--                            <td>A</td>-->
                                </tr>
                                 <?php } ?>
                                <?php if($ref->trade_2_confirm == 'yes') {?>
                                <tr>                            
                                    <td>
                                        <span class="pie"><?php echo $this->member_model->get_where($ref->member_id)->firstname.' '.$this->member_model->get_where($ref->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($ref->member_id)->company_id)->company_name.')'; ?></span>
                                    </td>
                                    <td>
        <!--                                Project<small>This is example of project</small>-->
                                        <?php echo $ref->trade_2_company; ?>
                                    </td>
                                    <td>
        <!--                                Project<small>This is example of project</small>-->
                                        <?php echo substr($ref->trade_2_comments,0,20).'...'; ?>
                                    </td>
                                    <td>
                                        <a href="admin/trade_ref/<?php echo $ref->id; ?>/trade_2">CLICK HERE</a>
                                    </td>
                                    <?php if($ref->trade_2_admin_approve == 'declined') {?>
                                    <td> DECLINED </td>
                                    <?php } else { ?>
                                    <td>
                                        AWAITING APPROVAL
                                        <!-- <a href="admin/edit_bio/<?php echo $ref->id;?>"><i class="fa fa-book"></i> Edit</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="admin/bioApprove/<?php echo $ref->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="admin/bioDecline/<?php echo $ref->id;?>"><i class="fa fa-times text-warning"></i> Decline</a> -->
                                    </td>
                                    <?php } ?>
        <!--                            <td>A</td>-->
                                </tr>
                             <?php } ?>
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
                    <h5>There are no Company Trade Reference for approval. </h5>

                </div>
            </div>
        </div>    
        
<?php
    }
}
?>
        
    </div>

</div>

