 <div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row"> 
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <?php echo $this->session->flashdata('admin-events');?>
                    <div class="ibox-title">
                        <h5>Add New Events</h5>
                    </div>    
                      
                    <div style="margin-top:10px;">
                       
                        <?php echo form_open_multipart('admin/eventAdd'); ?>
                         <div class="form-group">
                            <input type="file" name="userfile" size="20" />
                         </div>
                         <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Name',
                                                'value'         => $this->input->post('name'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'date',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Date',
                                                'value'         => $this->input->post('date'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'venue',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Venue',
                                                'value'         => $this->input->post('venue'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'location',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Location',
                                                'value'         => $this->input->post('location'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'website',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Website',
                                                'value'         => $this->input->post('website'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php

                                $data = array(
                                                'name'          => 'description',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Description',
                                                'value'         => $this->input->post('description'),
                                                'required'      => 'required'
                                              );

                                  echo form_textarea($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary block full-width m-b" value="Submit"</input>
                        </div>    
                    <?php echo form_close(); ?>
                            </div>
                        
                </div>
         </div>
    </div>

