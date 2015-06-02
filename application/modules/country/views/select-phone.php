<select class="form-control" name="phone_number" id="phone_number">
    <?php 
        if(isset($pid) && $pid > 0){
    ?>
        <option value="<?php echo $pid; ?>"><?php echo $dial_code; ?></option>
    <?php 

        } else{
    ?>
        <option value="211" disabled selected>Please Select</option>
    <?php        
        }?>
    <?php foreach ($select_phone as $country_phone) {?>
    <option value="<?php echo $country_phone->id; ?>"><?php echo $country_phone->country; ?> (<?php echo $country_phone->dial_code; ?>)</option>
    <?php }?>
</select>
