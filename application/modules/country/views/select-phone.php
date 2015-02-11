<select class="form-control" name="phone_number">
    
    <?php foreach ($select_phone as $country_phone) {?>
    <option value="<?php echo $country_phone->id; ?>"><?php echo $country_phone->country; ?> (<?php echo $country_phone->dial_code; ?>)</option>
    <?php }?>
</select>
