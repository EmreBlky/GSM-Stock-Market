 <?php
                        
//    echo '<pre>';
//    print_r($events_count);
//    exit;

?>
<?php 
$id = $this->uri->segment(3);
if(is_numeric($id)){?>
        
     <div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row"> 
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <?php echo $this->session->flashdata('admin-events');?>
                    <div class="ibox-title">
                        <h5>Edit Event - <?php echo $name; ?></h5>
                    </div>    
                      
                    <div style="margin-top:10px;">
                       
                        <?php echo form_open_multipart('admin/eventEdit/'.$id.''); ?>
                         <div class="form-group">
                             <img src="<?php echo $base; ?>/public/main/template/gsm/images/events/<?php echo $id; ?>.jpg" width="250" height="250" title="" alt=""/>
                            <input type="file" name="userfile" size="20" />
                         </div>
                         <div class="form-group">
                            <?php
                            
                            if($name){
                                
                                $data = array(
                                                'name'          => 'name',
                                                'class'         => 'form-control',
                                                'value'         => $name,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                
                            }
                            else{

                                $data = array(
                                                'name'          => 'name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Name',
                                                'value'         => $this->input->post('name'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            
                            if($date){
                                
                                $data = array(
                                                'name'          => 'date',
                                                'class'         => 'form-control',
                                                'value'         => $date,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'date',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Date',
                                                'value'         => $this->input->post('date'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            
                            if($venue){
                                
                                $data = array(
                                                'name'          => 'venue',
                                                'class'         => 'form-control',
                                                'value'         => $venue,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'venue',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Venue',
                                                'value'         => $this->input->post('venue'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            
                            if($location){
                                
                                $data = array(
                                                'name'          => 'location',
                                                'class'         => 'form-control',
                                                'value'         => $location,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'location',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Location',
                                                'value'         => $this->input->post('location'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            
                            if($website){
                                
                                $data = array(
                                                'name'          => 'website',
                                                'class'         => 'form-control',
                                                'value'         => $website,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'website',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Website',
                                                'value'         => $this->input->post('website'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            
                            if($description){
                                
                                $data = array(
                                                'name'          => 'description',
                                                'class'         => 'form-control',
                                                'value'         => $description,
                                                'required'      => 'required'
                                              );

                                  echo form_textarea($data);
                                
                            }else{

                                $data = array(
                                                'name'          => 'description',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Description',
                                                'value'         => $this->input->post('description'),
                                                'required'      => 'required'
                                              );

                                  echo form_textarea($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <div class="mail-body text-right tooltip-demo">
<!--                    <a class="btn btn-sm btn-white" href="admin/edit_bio/<?php //echo $company->id;?>"><i class="fa fa-book"></i> Edit</a>-->
                                <input type="submit" class="btn btn-sm btn-white" value="Update"/>
                                <?php if($status == 'active'){ ?>
                                    <a class="btn btn-sm btn-white" href="admin/eventActivation/<?php echo $id;?>/inactive"><i class="fa fa-times text-warning"></i> Inactive</a>
                                <?php }else{ ?>
                                    <a class="btn btn-sm btn-white" href="admin/eventActivation/<?php echo $id;?>/active"><i class="fa fa-check text-navy"></i> Active</a>
                                <?php } ?>
                </div>
                        </div>    
                    <?php echo form_close(); ?>
                            </div>
                        
                </div>
         </div>
    </div>
                
                
                
        
<?php 

} else {
    if($events_count > 0){
?>
<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row"> 
        <div class="col-lg-12">
             <?php echo $this->session->flashdata('admin-events');?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Events</h5>                        
                    </div>
                    <div class="ibox-content">
               
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Action</th>
        <!--                            <th>More</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($events as $event) {?>    
                                <tr>
                                    <td>
                                        <img src="<?php echo $base; ?>/public/main/template/gsm/images/events/<?php echo $event->id; ?>.jpg" width="25" height="25" title="" alt=""/>
                                    </td>
                                    <td>
                                        <span class="pie"><?php echo $event->name; ?></span>
                                    </td>
                                    <td>
                                        <?php echo $event->date; ?>
                                    </td>
                                    <td>
                                        <?php echo $event->location; ?>
                                    </td>
                                    <td>
                                        <a href="admin/edit_event/<?php echo $event->id;?>"><i class="fa fa-pencil"></i> Edit</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                        
                                        <a href="admin/bioDecline/<?php echo $event->id;?>"><i class="fa fa-times text-warning"></i> Delete</a>
                                    </td>
        <!--                            <td>A</td>-->
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
         </div>
    </div>
    <?php 
    }else{
?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>There are no events to edit. </h5>

                </div>
            </div>
        </div>    
        
<?php
    }
}
?>