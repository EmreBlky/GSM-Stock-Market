<?php

//echo '<pre>';
//print_r($terms);
//exit;

?>
<h1><?php echo $terms->title;?></h1>
<?php echo $terms->content;?>
<?php echo form_open_multipart('legal/acceptTerms/'.$this->session->userdata('members_id')); ?>
    <div class="form-group">        
        <span>Do you accept these Terms &amp; Conditions?</span>
        <input type="radio" name="user_terms" value="yes" checked="checked"/>Yes or <input type="radio" name="user_terms" value="no"/>No        
    </div>
    <div class="form-group">
        <div class="mail-body text-right tooltip-demo">
            <input type="submit" class="btn btn-sm btn-white" value="Update"/>
        </div>
    </div> 
<?php echo form_close(); ?>