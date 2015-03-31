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
                    View Company Bio
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
                    <h5>
                        
                        <span class="font-noraml">From: </span><?php echo $this->member_model->get_where($company->admin_member_id)->firstname.' '.$this->member_model->get_where($company->admin_member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($company->admin_member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <p>
                        <?php echo $company->company_profile_approval; ?>
                    </p>
                </div>                    
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-sm btn-white" href="admin/edit_bio/<?php echo $company->id;?>"><i class="fa fa-book"></i> Edit</a>
                    <a class="btn btn-sm btn-white" href="admin/bioApprove/<?php echo $company->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                    <a class="btn btn-sm btn-white" href="admin/bioDecline/<?php echo $company->id;?>"><i class="fa fa-times text-warning"></i> Decline</a>
                </div>
                <div class="clearfix"></div>
                
                </div>
            </div>
        
<?php 

} else {
    if($company_count > 0){
?>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Customer Bio Approval Table</h5>
                
            </div>
            <div class="ibox-content">
               
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>                           
                            <th>Customer</th>
                            <th>Company Bio</th>
                            <th>More</th>
                            <th>Action</th>
<!--                            <th>More</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($company as $company) {?>    
                        <tr>                            
                            <td>
                                <span class="pie"><?php echo $this->member_model->get_where($company->admin_member_id)->firstname.' '.$this->member_model->get_where($company->admin_member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($company->admin_member_id)->company_id)->company_name.')'; ?></span>
                            </td>
                            <td>
<!--                                Project<small>This is example of project</small>-->
                                <?php echo substr($company->company_profile_approval,0,20).'...'; ?>
                            </td>
                            <td>
                                <a href="admin/company_bio/<?php echo $company->id; ?>">CLICK HERE</a>
                            </td>
                            <td>
                                <a href="admin/edit_bio/<?php echo $company->id;?>"><i class="fa fa-book"></i> Edit</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="admin/bioApprove/<?php echo $company->id;?>"><i class="fa fa-check text-navy"></i> Approve</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="admin/bioDecline/<?php echo $company->id;?>"><i class="fa fa-times text-warning"></i> Decline</a>
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

