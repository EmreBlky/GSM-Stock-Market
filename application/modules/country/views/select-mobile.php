<?php 

//echo '<pre>';
//print_r($language);
//exit;

?>

<select class="form-control" name="mobile_phone">
    <
    <?php foreach ($select_mobile as $country_mobile) {?>
    <option value="<?php echo $country_mobile->id; ?>"><?php echo $country_mobile->country; ?> (<?php echo $country_mobile->dial_code; ?>)</option>
    <?php }?>
</select>
