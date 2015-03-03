<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Create listing</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<div class="wrapper wrapper-content">

<div class="row">
<div class="col-lg-8">
<?php msg_alert(); ?>
    <div class="ibox float-e-margins">
<div class="ibox-title">

<h5>Listing Details</h5>

</div>
<div class="ibox-content">
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />  
     <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
     <div class="col-md-9">
          <div class="input-group date form_datetime " data-date="<?php echo date('Y').'-'.date('m').'-'.date('d')?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
            <input class="form-control" size="16" type="text" value="<?php echo set_value('schedule_date_time');?>" readonly >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
        </div>
        <?php echo form_error('schedule_date_time'); ?>
        </div>
        <input type="hidden" id="dtp_input1" value="<?php echo set_value('schedule_date_time');?>" name="schedule_date_time"/><br/>
    </div>

    <div class="form-group"><label class="col-md-3 control-label">Listing Type</label>
        <div class="col-md-9">
            <select class="form-control" name="listing_type">
                <option selected value="" >Buying or Selling?</option>
                <option value="1" <?php if(!empty($_POST) && 1==$_POST['listing_type']){ echo'selected';}?>>Buying Request</option>
                <option <?php if(!empty($_POST) && 2==$_POST['listing_type']){ echo'selected';}?> value="2">Selling Offer</option>
            </select>
            <?php echo form_error('listing_type'); ?>
            
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group"><label class="col-md-3 control-label">MPN/ISBN</label>
        <div class="col-md-9">
            <input type="type" id="mpn1" list="mpn" class="form-control check_record" placeholder="Auto fill the rest of the data if MPN/ISBN is found in the database"  name="product_mpn_isbn" value="<?php echo set_value('product_mpn_isbn');?>"/>
            <datalist id="mpn">
            <?php if(!empty($listing_attributes)){ 
                 foreach ($listing_attributes as $row) { ?>
                <option value="<?php echo $row->product_mpn_isbn; ?>"><?php echo $row->product_mpn_isbn; ?></option>
                 <?php }} ?>
            </datalist>
             <?php echo form_error('product_mpn_isbn'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Make</label>
        <div class="col-md-9">
        <select class="form-control check_record" name="product_make" id="product_make">
            <option  selected value="">Select Make</option>
            <?php if(!empty($product_makes)){ 
                 foreach ($product_makes as $row) { ?>
                <option value="<?php echo $row->product_make; ?>" <?php if(!empty($_POST) && $row->product_make==$_POST['product_make']){ echo'selected';}?>><?php echo $row->product_make; ?></option>
                 <?php }} ?>
        </select>
        <?php echo form_error('product_make'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Model</label>
        <div class="col-md-9">
            <input type="type" class="form-control check_record" placeholder="When make is selected list models associated with make" name="product_model" value="<?php echo set_value('product_model');?>"/>
            <?php echo form_error('product_model'); ?>
        </div>
    </div>
    


    <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
        <div class="col-md-9">
        <select class="form-control check_record" name="product_type" id="product_type">
            <option  selected  value="">Select Make</option>
            <?php if(!empty($product_types)){ 
                 foreach ($product_types as $row) { ?>
                <option value="<?php echo $row->product_type; ?>" <?php if(!empty($_POST) && $row->product_type==$_POST['product_type']){ echo'selected';}?>><?php echo $row->product_type; ?></option>
                 <?php }} ?>
        </select>
        <?php echo form_error('product_type'); ?>
        </div>
    </div>

    <div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
            <select class="form-control check_record" name="product_color" id="product_color">
            <option selected value="">Select Color</option>
            <?php if(!empty($product_colors)){ 
                 foreach ($product_colors as $row) { ?>
                <option value="<?php echo $row->product_color; ?>" <?php if(!empty($_POST) && $row->product_color==$_POST['product_color']){ echo'selected';}?>><?php echo $row->product_color; ?></option>
                 <?php }} ?>
        </select>           
            <?php echo form_error('product_color'); ?>
        </div>
    </div>
    
    
    <div class="hr-line-dashed"></div>
    <div class="form-group"><label class="col-md-3 control-label">Condition</label>
        <div class="col-md-9">
            <select class="form-control" name="condition">
            <option selected value="">Condition</option>
            <?php $condition = condition(); 
            if($condition){
                foreach ($condition as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['condition']){ echo'selected';}?>><?php echo $value; ?></option>
                  <?php } 
            } ?>
            </select>
            <?php echo form_error('condition'); ?>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Spec</label>
    <div class="col-md-9">
        <select class="form-control" name="spec">
            <option selected value="">Spec</option>
            <?php $spec = spec(); 
            if($spec){
                foreach ($spec as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['spec']){ echo'selected';}?>><?php echo $value; ?></option>
                  <?php } 
            } ?>
        </select>
        <?php echo form_error('spec'); ?>
    </div>
</div>    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group"><label class="col-md-3 control-label">Currency</label>
        <div class="col-md-9">
            <select class="form-control" name="currency">
                <option selected value="">Default (account preference defalut)</option>
                <?php $currency = currency(); 
                if($currency){
                foreach ($currency as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['currency']){ echo'selected';}?>><?php echo $value; ?></option>
                  <?php } 
                } ?>
            </select>
            <p class="small">Select the currency you wish this listing to be sold in.</p>
            <?php echo form_error('currency'); ?>
        </div>
    </div>
    

    <div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
        <div class="col-md-9">
            <input type="type" class="form-control" name="unit_price" value="<?php echo set_value('unit_price');?>"/>
            <?php echo form_error('unit_price'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Minimum Price</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_price" value="<?php echo set_value('min_price');?>"></div>
            <p class="small">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
            <?php echo form_error('min_price'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Allow Offers</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span>
            <select class="form-control" name="allow_offer">
                <option selected value="">default</option>
                <?php for($i=4; $i<=10; $i++){
                    ?><option <?php if(!empty($_POST) && $i==$_POST['allow_offer']){ echo'selected';}?>><?php echo $i;?></option>
                    <?php }?>
            </select>
            </div>
            <?php echo form_error('allow_offer'); ?>
            <p class="small">Allow people to make offers and how many per 24 hour period. (default is 3)</p>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Quantity Available</label>
        <div class="col-md-9">
            <input type="type" class="form-control" name="total_qty" value="<?php echo set_value('total_qty');?>"/>
            <?php echo form_error('total_qty'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Min Order Quantity</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_qty_order" value="<?php echo set_value('min_qty_order');?>"></div>
            <p class="small">Allow minimum order quantity else full quantity sale available only</p>
            <?php echo form_error('min_qty_order'); ?>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Terms</label>
    <div class="col-md-9">
        <select class="form-control" name="shipping_term">
            <option selected value="">Select Terms</option>
            <?php $shipping = shipping_term(); 
            if($shipping){
                foreach ($shipping as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['shipping_term']){ echo'selected';}?>><?php echo $value; ?></option>
                  <?php } 
            } ?>
        </select>
        <?php echo form_error('shipping_term'); ?>
    </div>
</div>
    
    <div class="form-group"><label class="col-md-3 control-label">Courier</label>

        <div class="col-md-9">
            <?php $courier = courier(); 
            if($courier){
            $i=1;
            foreach ($courier as $key => $value){ ?>
            <label class="checkbox-inline i-checks"><input type="checkbox" value="option<?php echo $i; ?>" id="inlineCheckbox<?php echo $i; ?>" name="courier[]" <?php if(!empty($_POST['courier']) && in_array('option'.$i, $_POST['courier'])){ echo'checked';}?>/> <?php echo $value;?> </label>
            <?php $i++;}} ?>
        <?php echo form_error('courier[]'); ?>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>                                
    
    <div class="form-group"><label class="col-md-3 control-label">Product Description</label>
        <div class="col-md-9">
            <textarea type="type" class="form-control" rows="5" id="product_desc" name="product_desc"><?php echo set_value('product_desc');?></textarea>
            <?php echo form_error('product_desc'); ?>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group"><label class="col-md-3 control-label">List Duration</label>
        <div class="col-md-9">
            <select class="form-control" name="duration">
            <?php $duration = list_duration(); 
            if($duration){
                foreach ($duration as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['duration']){ echo'selected';}?>><?php echo $value; ?> day</option>
                  <?php } 
            } ?>
            </select>
            <?php echo form_error('duration'); ?>
        </div> 
    </div>  
    
    <div class="form-group"><label class="col-md-3 control-label">Terms &amp; Conditions</label>
        <div class="col-md-9">
        <input type="checkbox" class="checkbox-inline i-checks" name="termsandcondition" <?php if(!empty($_POST['termsandcondition']) ){ echo'checked';}?>/> I agree to the GSMStockMarket.com Limited Terms and Conditions
         <?php echo form_error('termsandcondition'); ?>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <a href="">Cancel</a>
            <button class="btn btn-warning" type="submit" name="status" value="2">Save for later</button>
            <button class="btn btn-primary" type="submit" name="status" value="1">List Now</button>
        </div>
    </div>
                
  </form>
  </div>
 </div> 
</div>       
<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Listing Pictures</h5>
        </div>
        <div class="ibox-content">
        <div class="row">
            <div class="col-md-12" style="text-align:center">                                
                    <img src="public/main/template/gsm/images/members/no_profile.jpg" width="150" height="150">
            </div>
            <div class="col-md-12" style="text-align:center;margin-top:20px">
            <div class="btn-group">
                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                    <input type="file" accept="image/*" name="file" class="hide">Upload new image</label>
                    <label class="btn btn-danger">Delete</label>
            </div>
            </div>
            <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
        </div>
        </div>

</div></div>        
       
</div>
</div>
            
    <!-- checkbox css -->
    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- iCheck -->
    <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>

   <script>/**
 * Character counter and limiter plugin for textfield and textarea form elements
 * @author Sk8erPeter
 */ (function ($) {
    $.fn.characterCounter = function (params) {
        // merge default and user parameters
        params = $.extend({
            // define maximum characters
            maximumCharacters: 1000,
            // create typed character counter DOM element on the fly
            characterCounterNeeded: true,
            // create remaining character counter DOM element on the fly
            charactersRemainingNeeded: true,
            // chop text to the maximum characters
            chopText: false,
            // place character counter before input or textarea element
            positionBefore: false,
            // class for limit excess
            limitExceededClass: "character-counter-limit-exceeded",
            // suffix text for typed characters
            charactersTypedSuffix: " characters typed",
            // suffix text for remaining characters
            charactersRemainingSuffixText: " characters left",
            // whether to use the short format (e.g. 123/1000)
            shortFormat: false,
            // separator for the short format
            shortFormatSeparator: "/"
        }, params);

        // traverse all nodes
        this.each(function () {
            var $this = $(this),
                $pluginElementsWrapper,
                $characterCounterSpan,
                $charactersRemainingSpan;

            // return if the given element is not a textfield or textarea
            if (!$this.is("input[type=text]") && !$this.is("textarea")) {
                return this;
            }

            // create main parent div
            if (params.characterCounterNeeded || params.charactersRemainingNeeded) {
                // create the character counter element wrapper
                $pluginElementsWrapper = $('<div>', {
                    'class': 'character-counter-main-wrapper'
                });

                if (params.positionBefore) {
                    $pluginElementsWrapper.insertBefore($this);
                } else {
                    $pluginElementsWrapper.insertAfter($this);
                }
            }

            if (params.characterCounterNeeded) {
                $characterCounterSpan = $('<span>', {
                    'class': 'counter character-counter',
                        'text': 0
                });

                if (params.shortFormat) {
                    $characterCounterSpan.appendTo($pluginElementsWrapper);

                    var $shortFormatSeparatorSpan = $('<span>', {
                        'html': params.shortFormatSeparator
                    }).appendTo($pluginElementsWrapper);

                } else {
                    // create the character counter element wrapper
                    var $characterCounterWrapper = $('<div>', {
                        'class': 'character-counter-wrapper',
                            'html': params.charactersTypedSuffix
                    });

                    $characterCounterWrapper.prepend($characterCounterSpan);
                    $characterCounterWrapper.appendTo($pluginElementsWrapper);
                }
            }

            if (params.charactersRemainingNeeded) {

                $charactersRemainingSpan = $('<span>', {
                    'class': 'counter characters-remaining',
                        'text': params.maximumCharacters
                });

                if (params.shortFormat) {
                    $charactersRemainingSpan.appendTo($pluginElementsWrapper);
                } else {
                    // create the character counter element wrapper
                    var $charactersRemainingWrapper = $('<div>', {
                        'class': 'characters-remaining-wrapper',
                            'html': params.charactersRemainingSuffixText
                    });
                    $charactersRemainingWrapper.prepend($charactersRemainingSpan);
                    $charactersRemainingWrapper.appendTo($pluginElementsWrapper);
                }
            }

            $this.keyup(function () {

                var typedText = $this.val();
                var textLength = typedText.length;
                var charactersRemaining = params.maximumCharacters - textLength;

                // chop the text to the desired length
                if (charactersRemaining < 0 && params.chopText) {
                    $this.val(typedText.substr(0, params.maximumCharacters));
                    charactersRemaining = 0;
                    textLength = params.maximumCharacters;
                }

                if (params.characterCounterNeeded) {
                    $characterCounterSpan.text(textLength);
                }

                if (params.charactersRemainingNeeded) {
                    $charactersRemainingSpan.text(charactersRemaining);

                    if (charactersRemaining <= 0) {
                        if (!$charactersRemainingSpan.hasClass(params.limitExceededClass)) {
                            $charactersRemainingSpan.addClass(params.limitExceededClass);
                        }
                    } else {
                        $charactersRemainingSpan.removeClass(params.limitExceededClass);
                    }
                }
            });

        });

        // allow jQuery chaining
        return this;

    };
})(jQuery);

$(document).ready(function () {
    $('#product_desc').characterCounter({
        maximumCharacters: 500,
        characterCounterNeeded: false,
        chopText: true
    });

});
    </script>
    
    

    <!-- Jquery Validate -->
    <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

      <script>
         $(document).ready(function(){

             $(".validation").validate({
                 rules: {
                     password: {
                         required: true,
                         minlength: 3
                     },
                     url: {
                         required: true,
                         url: true
                     },
                     number: {
                         required: true,
                         number: true
                     },
                     min: {
                         required: true,
                         minlength: 6
                     },
                     max: {
                         required: true,
                         maxlength: 4
                     }
                 }
             });
        });
</script>
<script>
   $(document).ready(function(){
     $("#mpn1").change(function(){
     var product_mpn_isbn = $(this).val(); 
     if(product_mpn_isbn){
        $('.check_record').attr("disabled", "disabled");
        jQuery.post('<?php echo base_url()?>marketplace/get_attributes_info/',{product_mpn_isbn:product_mpn_isbn},
        function(data){ 
         var prod_make= <?php echo json_encode($product_makes); ?>;
         var producttypes= <?php echo json_encode($product_types); ?>;
         var productcolors= <?php echo json_encode($product_colors); ?>;
        if(data.STATUS=='true'){
          if(prod_make){
          var productmakehtml='<option  selected value="">Product Make</option>';
            $.each(prod_make, function(index, val) {
                productmakehtml +='<option value="'+val.product_make+'"';
                if(val.product_make==data.product_make)
                productmakehtml +=' Selected';
                productmakehtml +=' >'+val.product_make+'</option>';
             });
             $('#product_make').html(productmakehtml);
            }
            
            if(producttypes){
            var producttypehtml='<option  selected value="">Product Type</option>';
            $.each(producttypes, function(index, val) {
                producttypehtml +='<option';
                if(val.product_type==data.product_type)
                producttypehtml +=' Selected';
                producttypehtml +=' >'+val.product_type+'</option>';
             });
             $('#product_type').html(producttypehtml);
            }

             if(productcolors){
            var productcolorhtml='<option  selected value="">Product Color</option>';
            $.each(productcolors, function(index, val) {
                productcolorhtml +='<option value="'+val.product_color+'"';
                if(val.product_color==data.product_color)
                productcolorhtml +=' Selected';
                productcolorhtml +=' >'+val.product_color+'</option>';
             });
             $('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);
           
           } 
            /* else{

            if(prod_make){
            var productmakehtml='<option "selected">Product Make</option>';
            $.each(prod_make, function(index, val) {
                productmakehtml +='<option value="'+val.product_make+'">'+val.product_make+'</option>';
             });
             $('#product_make').html(productmakehtml);
            }
            
            if(producttypes){
            var producttypehtml='<option "selected">Product Type</option>';
            $.each(producttypes, function(index, val) {
                producttypehtml +='<option value="'+val.product_type+'">'+val.product_type+'</option>';
             });
             $('#product_type').html(producttypehtml);
            }

            if(productcolors){
            var productcolorhtml='<option "selected">Product Color</option>';
            $.each(productcolors, function(index, val) {
                productcolorhtml +='<option value="'+val.product_color+'">'+val.product_color+'</option>';
             });
             $('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);
           } */
          });
           $('.check_record').removeAttr("disabled");   
         }
        });
     });
 </script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    </script>

    <style>
.error{
  color:rgba(255, 0, 0, 0.7);
  padding-left: 5px;
}
.error:before{
    content: "*";
    padding: 3px;
}
</style>