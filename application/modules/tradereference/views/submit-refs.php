<?php

//    echo '<pre>';
//    print_r($trade_ref);
//    exit;

?>


<?php echo form_open('tradereference/updateRef'); ?>
    
<h1>Trade References</h1>
<h2>We require:  (all mandatory fields)</h2>
<h3>Trade Reference One (a company you have done business with within the last 90 days)</h3>
<?php if($trade_ref->trade_1_confirm != 'yes'){?>

Company Name:
<div class="form-group">
    <?php
    
        if($trade_ref->trade_1_company != ''){
            
            $data = array(
                        'name'          => 'trade_1_company',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $trade_ref->trade_1_company,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_1_company',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $this->input->post('trade_1_company'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Contact Name:
<div class="form-group">
    <?php
        
        if($trade_ref->trade_1_name != ''){
            
            $data = array(
                        'name'          => 'trade_1_name',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $trade_ref->trade_1_name,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_1_name',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $this->input->post('trade_1_name'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Email:
<div class="form-group">
    <?php if($trade_ref->trade_1_email != ''){ ?>
        <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $trade_ref->trade_1_email;?>" required="required">
    <?php } else { ?>
        <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $this->input->post('trade_1_email');?>" required="required">
    <?php } ?></div>
Phone:
<div class="form-group">
    <?php

        if($trade_ref->trade_1_phone != ''){
            
            $data = array(
                        'name'          => 'trade_1_phone',
                        'class'         => 'form-control',
                        'placeholder'   => 'Phone',
                        'value'         => $trade_ref->trade_1_phone,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_1_phone',
                        'class'         => 'form-control',
                        'placeholder'   => 'Phone',
                        'value'         => $this->input->post('trade_1_phone'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Country:
<br/>
<select name="trade_1_country">
    <?php if($trade_ref->trade_1_country != '') {?>
        <option value="<?php echo $trade_ref->trade_1_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_1_country)->country; ?></option>
        <?php } else {?>
        <option value="">Please select country</option>
        <?php } ?>
    <?php foreach ($country_one as $country_one) {?>        
        <option value="<?php echo $country_one->id; ?>"><?php echo $country_one->country; ?></option>
    <?php }?> 
</select>
<?php } else { ?>
<strong>CONFIRMED</strong>
<?php }?>
<br/>
<br/>
<h3>Trade Reference Two (a company you have done business with within the last 90 days)</h3>
<?php if($trade_ref->trade_2_confirm != 'yes'){?>
Company Name:
<div class="form-group">
    <?php
    
        if($trade_ref->trade_2_company != ''){
            
            $data = array(
                        'name'          => 'trade_2_company',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $trade_ref->trade_2_company,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_2_company',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $this->input->post('trade_2_company'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Contact Name:
<div class="form-group">
    <?php
        
        if($trade_ref->trade_2_name != ''){
            
            $data = array(
                        'name'          => 'trade_2_name',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $trade_ref->trade_2_name,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_2_name',
                        'class'         => 'form-control',
                        'placeholder'   => 'Company Name',
                        'value'         => $this->input->post('trade_2_name'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Email:
<div class="form-group">
    <?php if($trade_ref->trade_2_email != ''){ ?>
        <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $trade_ref->trade_2_email;?>" required="required">
    <?php } else { ?>
        <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $this->input->post('trade_2_email');?>" required="required">
    <?php } ?></div>
Phone:
<div class="form-group">
    <?php

        if($trade_ref->trade_2_phone != ''){
            
            $data = array(
                        'name'          => 'trade_2_phone',
                        'class'         => 'form-control',
                        'placeholder'   => 'Phone',
                        'value'         => $trade_ref->trade_2_phone,
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        else{
            
            $data = array(
                        'name'          => 'trade_2_phone',
                        'class'         => 'form-control',
                        'placeholder'   => 'Phone',
                        'value'         => $this->input->post('trade_2_phone'),
                        'required'      => 'required'
                      );

            echo form_input($data);
            
        }
        
    ?>
</div>
Country:
<br/>
<select name="trade_2_country">
    <?php if($trade_ref->trade_2_country != '') {?>
        <option value="<?php echo $trade_ref->trade_2_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_2_country)->country; ?></option>
        <?php } else {?>
        <option value="">Please select country</option>
        <?php } ?>
    <?php foreach ($country_two as $country_two) {?>        
        <option value="<?php echo $country_two->id; ?>"><?php echo $country_two->country; ?></option>
    <?php }?> 
</select>
<?php } else { ?>
<strong>CONFIRMED</strong>
<?php }?>
<br/>
<br/>
<?php if($trade_ref->trade_1_confirm != 'yes' || $trade_ref->trade_2_confirm != 'yes') {?>
<input type="submit" value="submit"/>
<?php }?>
<?php echo form_close(); ?>

