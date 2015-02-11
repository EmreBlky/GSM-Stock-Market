<select class="form-control m-b" name="country">
    <?php 
        if(isset($cid) && $cid > 0){
    ?>
        <option value="<?php echo $cid; ?>"><?php echo 'Selected Country: '.$country; ?></option>
    <?php 

        } else{
    ?>
        <option value="">Please Select</option>
    <?php        
        }?>
    <?php foreach ($select_country as $country_name) {?>
        <option value="<?php echo $country_name->id; ?>"><?php echo $country_name->country; ?></option>
    <?php }?>                                         
</select>
