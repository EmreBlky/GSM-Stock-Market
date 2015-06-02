<?php

//echo '<pre>';
//echo $credit_count;
//print_r($credit);
//exit;

?>
<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row">
<?php 
$id = $this->uri->segment(3);
if(is_numeric($id)){?>
       
    <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">                
                <h2>
                    <strong>Company: </strong><?php echo $company->company_name; ?>
                </h2>
                <br/>
                <p><strong>VAT Number: </strong><span style="margin-left: 40px;"><?php echo $company->vat_tax; ?></span></p>                
                <p><strong>Company Number: </strong><span style="margin-left: 5px;"><?php echo $company->company_number; ?></span></p>
                <p><strong>Company Address: </strong><span style="margin-left: 5px;"><?php echo $company->address_line_1; ?>, <?php echo $company->town_city; ?>, <?php echo $company->county; ?>. <?php echo $company->post_code; ?>. <?php echo $this->country_model->get_where($company->country)->country; ?>.</span></p>
            </div>
                <div class="mail-box">
                    <?php echo form_open_multipart('admin/creditAdd/'.$company->id.''); ?>
                    <div class="mail-body">
                        
                         <div class="form-group">
                            <input type="file" name="userfile" size="20" />
                         </div>
                         <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Document Name',
                                                'value'         => $this->input->post('name'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                    </div>                    
                    <div class="mail-body text-right tooltip-demo">                        
                        <button type="submit" class="btn btn-sm btn-white"><i class="fa fa-check text-navy"></i> UPDATE</button>                        
                    </div>
                    <div class="clearfix"></div>
                    <?php form_close();?>
                </div>
            </div>
        
<?php 

} else {
    if($credit_count > 0){
?>
    <?php echo $this->session->flashdata('message');?>     
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
                                <th>Company</th>
                                <th>Membership Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($credit as $credit) {?>    
                            <tr>                            
                                <td>
                                    <span class="pie"><?php echo $credit->company_name; ?></span>
                                </td>
                                <td>
                                   <span class="pie"><?php echo $this->membership_model->get_where($this->member_model->get_where($credit->admin_member_id)->membership)->membership; ?></span> 
                                </td>
                                <td>
                                    <a href="admin/edit_credit/<?php echo $credit->id;?>"><i class="fa fa-book"></i> Edit</a>
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
        <?php echo $this->session->flashdata('message');?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>There are no companies that require credit checks. </h5>
                </div>
            </div>
        </div>    
        
<?php
    }
}
?>
        
    </div>

</div>
