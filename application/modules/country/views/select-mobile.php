<select class="form-control" name="mobile_phone" id="mobile_phone">
    <?php 
        if(isset($mpid) && $mpid > 0){
    ?>
        <option value="<?php echo $mpid; ?>"><?php echo $dialing_code; ?></option>
    <?php 

        } else{
    ?>
        <option value="">Please Select</option>
    <?php        
        }?>
    <?php foreach ($select_mobile as $country_mobile) {?>
    <option value="<?php echo $country_mobile->id; ?>"><?php echo $country_mobile->country; ?> (<?php echo $country_mobile->dial_code; ?>)</option>
    <?php }?>
</select>
