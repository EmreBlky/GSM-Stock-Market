<select class="form-control" name="country" onchange = "updateCode(this.value)">
    <?php 
        if(isset($cid) && $cid > 0){
    ?>
        <option value="<?php echo $cid; ?>"><?php echo $country; ?></option>
    <?php 

        } else{
    ?>
        <option value="" disabled selected>Please Select</option>
    <?php        
        }?>
    <?php foreach ($select_country as $country_name) {?>
        <option value="<?php echo $country_name->id; ?>"><?php echo $country_name->country; ?></option>
    <?php }?>                                         
</select>
