<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Buying Request</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<div class="wrapper wrapper-content">

  
<div class="row">
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data"/>

<div class="col-lg-7">
<?php msg_alert(); ?>
<div class="ibox float-e-margins">
<div class="ibox-title">

<h5>Listing Details</h5>

</div>

<div class="ibox-content"> <!-- Selling -->
            <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
         <div class="col-md-9"> 
            <div class="input-group date form_datetime " data-date="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo date('Y').'-'.date('m').'-'.date('d') ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                <input class="form-control" size="16" type="text" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time'); ?>" readonly >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
            </div>
            <?php echo form_error('schedule_date_time'); ?>
            </div>
            <input type="hidden" id="dtp_input1" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time');?>" name="schedule_date_time"/><br/>
    </div>   
        <div class="hr-line-dashed"></div>

        <div class="form-group"><label class="col-md-3 control-label">MPN/ISBN</label>
        <div class="col-md-9">
            <input type="text" id="mpn1" list="mpn" class="form-control check_record" placeholder="Auto fill the rest of the data if MPN/ISBN is found in the database"  name="product_mpn" value="<?php if(!empty($product_list->product_mpn_isbn)) echo $product_list->product_mpn_isbn; ?><?php if(!empty($_POST['product_mpn'])) echo $_POST['product_mpn']; ?>"/>
            <datalist id="mpn">
            <?php if(!empty($listing_attributes)){
                 foreach ($listing_attributes as $row) { ?>
                   <?php if (!empty($row->product_mpn_isbn)): ?>
                    <option value="<?php echo $row->product_mpn_isbn; ?>"  <?php if(!empty($_POST['product_mpn']) && $row->product_mpn_isbn == $_POST['product_mpn']){ echo'selected';}?>><?php echo $row->product_mpn_isbn; ?></option>
                  <?php endif ?>
                 <?php } } ?>
            </datalist>
             <?php echo form_error('product_mpn'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Make</label>
        <div class="col-md-9">
         <input type="text" list="make" id="product_make" class="form-control check_record" placeholder="Auto fill the rest of the data if Product Makers is found in the database"  name="product_make" value="<?php if(!empty($product_list->product_make)) echo $product_list->product_make; else echo set_value('product_make');?>"/>
           <datalist id="make">
            <?php if(!empty($product_makes)){ 
                 foreach ($product_makes as $row) { ?>
                <option value="<?php echo $row->product_make; ?>" <?php if(!empty($_POST) && $row->product_make==$_POST['product_make']){ echo'selected';}?><?php if(!empty($product_list->product_make) && $row->product_make == $product_list->product_make){ echo'selected';}?>><?php echo $row->product_make; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_make'); ?>
        </div>
    </div>

    <div class="form-group"><label class="col-md-3 control-label">Model</label>
        <div class="col-md-9">
         <input type="text" list="model" id="product_model" class="form-control check_record" placeholder="Auto fill the rest of the data if Product Model is found in the database"  name="product_model" value="<?php if(!empty($product_list->product_model)) echo $product_list->product_model; else echo set_value('product_model');?>"/>
           <datalist id="model">
            <?php if(!empty($product_models)){ 
                 foreach ($product_models as $row) { ?>
                <option value="<?php echo $row->product_model; ?>" <?php if(!empty($_POST) && $row->product_model==$_POST['product_model']){ echo'selected';}?><?php if(!empty($product_list->product_model) && $row->product_model == $product_list->product_model){ echo'selected';}?>><?php echo $row->product_model; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_model'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
         <input type="text" list="color" id="product_color" class="form-control check_record" placeholder="Auto fill the rest of the data if Product Color is found in the database"  name="product_color" value="<?php if(!empty($product_list->product_color)) echo $product_list->product_color; else echo set_value('product_color');?>"/>
           <datalist id="color">
            <?php if(!empty($product_colors)){ 
                 foreach ($product_colors as $row) { ?>
                <option value="<?php echo $row->product_color; ?>" <?php if(!empty($_POST) && $row->product_color==$_POST['product_color']){ echo'selected';}?><?php if(!empty($product_list->product_color) && $row->product_color == $product_list->product_color){ echo'selected';}?>><?php echo $row->product_color; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_color'); ?>
        </div>
    </div>

     <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
        <div class="col-md-9"> 
        <select  name="product_type" id="product_type" class="form-control check_record">
                <option selected value="0" >-Select Product Type-</option>
                <?php if (!empty($product_types)): ?>
                <?php foreach ($product_types as $row): ?>
                    <optgroup label="<?php echo $row->category_name ?>">
                        <?php if (!empty($row->childs)): ?>
                            <?php foreach ($row->childs as $child): ?>
                                <option value="<?php echo $child->category_name ?>" <?php if(!empty($_POST['product_type']) && $child->category_name==$_POST['product_type']){ echo'selected';}?> 
                                <?php if(!empty($product_list->product_type) && $child->category_name==$product_list->product_type){ echo'selected="selected"';}?>>- <?php echo $child->category_name ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </optgroup>
                <?php endforeach ?>
                <?php endif ?>

            </select>
            <?php echo form_error('product_type'); ?>
        </div>
    </div>

       <!--  <div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
            <select class="form-control check_record" name="product_color" id="product_color">
            <option selected value="">Select Color</option>
            <?php //if(!empty($product_colors)){ 
                 //foreach ($product_colors as $row) { ?>
                <option value="<?php //echo $row->product_color; ?>" <?php //if(!empty($_POST) && $row->product_color==$_POST['product_color']){ echo'selected';}?>
                <?php //if(!empty($product_list->product_color) && $row->product_color==$product_list->product_color){ echo'selected';}?>><?php //echo $row->product_color; ?></option>
                 <?php// }} ?>
        </select>           
            <?php //echo form_error('product_color'); ?>
        </div>
    </div> -->
    
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">Condition</label>
            <div class="col-md-9">
                <select class="form-control" name="condition">
                <option value="">Condition</option>
                <?php $condition = condition(); 
                if($condition){
                    foreach ($condition as $key => $value){ ?>
                      <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['condition']){ echo'selected';}?><?php if(!empty($product_list->condition) && $value == $product_list->condition){ echo'selected="selected"';}?>><?php echo $value; ?></option>
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
                          <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['spec']){ echo'selected';}?><?php if(!empty($product_list->spec) && $value==$product_list->spec){ echo'selected';}?>><?php echo $value; ?></option>
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
                        $i=1;
                    foreach ($currency as $key => $value){ ?>
                      <option <?php if(!empty($_POST) && $i==$_POST['currency']){ echo'selected';}?><?php if(!empty($product_list->currency) && $i==$product_list->currency){ echo'selected';}?> value="<?php echo $i;?>"><?php echo $value; ?></option>
                      <?php $i++;} 
                    } ?>
                </select>
                <p class="small">Select the currency you wish this listing to be sold in.</p>
                <?php echo form_error('currency'); ?>
            </div>
        </div>
        

        <div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
            <div class="col-md-9">
                <input type="type" class="form-control" name="unit_price" value="<?php if(!empty($product_list->unit_price)) echo $product_list->unit_price; else echo set_value('unit_price');?>"/>
                <?php echo form_error('unit_price'); ?>
            </div>
        </div>
        
        <div class="form-group"><label class="col-md-3 control-label">Min Unit Price</label>
            <div class="col-md-9">
                <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="minimum_checkbox" id="minimum_checkbox" <?php if(!empty($_POST['minimum_checkbox']) ){ echo'checked';}?><?php if(!empty($product_list->min_price)){ echo'checked';}?>/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_price" value="<?php if(!empty($product_list->min_price)) echo $product_list->min_price; else echo set_value('min_price');?>" <?php if(empty($product_list->min_price) ){ echo'disabled';}?>></div>
                <p class="small">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
                <?php echo form_error('min_price'); ?>
            </div>
        </div>

         <div class="form-group"><label class="col-md-3 control-label">Max Unit Price</label>
            <div class="col-md-9">
                <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="maximum_checkbox" id="maximum_checkbox" <?php if(!empty($_POST['maximum_checkbox']) ){ echo'checked';}?><?php if(!empty($product_list->min_price)){ echo'checked';}?>/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="max_price" value="<?php if(!empty($product_list->max_price)) echo $product_list->max_price; else echo set_value('max_price');?>" <?php if(empty($product_list->max_price) ){ echo'disabled';}?>></div>
                <p class="small">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
                <?php echo form_error('max_price'); ?>
            </div>
        </div>
        
        <div class="form-group"><label class="col-md-3 control-label">Quantity requested</label>
            <div class="col-md-9">
                <input type="type" class="form-control" name="total_qty" value="<?php if(!empty($product_list->total_qty)) echo $product_list->total_qty; else  echo set_value('total_qty');?>"/>
                <?php echo form_error('total_qty'); ?>
            </div>
        </div>
        
        <div class="hr-line-dashed"></div>
        
        
        <div class="form-group"><label class="col-md-3 control-label">Shipping Terms <button class="btn btn-success btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0" data-toggle="modal" data-target="#shipping" title="Click for more information"><i class="fa fa-question"></i></button></label>
         <?php $product = array(); if(!empty($product_list->courier)){ $product = explode(',', $product_list->courier);  } ?>
        <div class="col-md-9">
                <label class="checkbox-inline i-checks" title="EXW (Ex Works)"><input type="checkbox" value="EXW" name="courier[]" <?php if(!empty($product) && in_array('EXW', $product)){ echo'checked';}?>/> EXW</label>
                <label class="checkbox-inline i-checks" title="FOB (Freight on Board)"><input type="checkbox" value="FOB" name="courier[]" <?php if(!empty($product) && in_array('FOB', $product)){ echo'checked';}?>/> FOB</label>
                <label class="checkbox-inline i-checks" title="CIP (Carriage and Insurance Paid to)"><input type="checkbox" value="CIP" name="courier[]" <?php if(!empty($product) && in_array('CIP', $product)){ echo'checked';}?>/> CIP</label>
                <label class="checkbox-inline i-checks" title="CPT (Carriage Paid to)"><input type="checkbox" value="CPT" name="courier[]" <?php if(!empty($product) && in_array('CPT', $product)){ echo'checked';}?>/> CPT</label>
        </div>
        </div>
    
    

        <div class="form-group"><label class="col-md-3 control-label">Shipping Charges</label>
        <div class="col-md-9">
                <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="shipping_checkbox" id="shipping_checkbox" <?php if(!empty($product_list->shipping_charges)) echo 'checked'; ?>/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="shipping_charges" value="<?php if(!empty($product_list->shipping_charges)) echo $product_list->shipping_charges; else  echo set_value('shipping_charges');?>" disabled></div>
                <p class="small">Allow additional shipping charges. Leave unticked for all quotes to include free shipping</p>
        </div>
        </div>
        <div class="hr-line-dashed"></div>                                
        
        <div class="form-group"><label class="col-md-3 control-label">Product Description</label>
            <div class="col-md-9">
                <textarea type="type" class="form-control" rows="5" id="product_desc" name="product_desc"><?php if(!empty($product_list->product_desc)) echo $product_list->product_desc; else echo set_value('product_desc');?></textarea>
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
                      <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['duration']){ echo'selected';}?><?php if(isset($product_list->duration) && $value==$product_list->duration){ echo'selected';}?>><?php echo $value; ?> day</option>
                      <?php } 
                } ?>
                </select>
                <?php echo form_error('duration'); ?>
            </div> 
        </div> 

       <?php if (empty($product_list->id)): ?>
        <div class="form-group"><label class="col-md-3 control-label">Terms &amp; Conditions</label>
            <div class="col-md-9">
            <input type="checkbox" class="checkbox-inline i-checks" name="termsandcondition" <?php if(!empty($_POST['termsandcondition']) ){ echo'checked';}?>/> I agree to the GSMStockMarket.com Limited Terms and Conditions
             <?php echo form_error('termsandcondition'); ?>
            </div>
        </div>
       <?php endif ?>
    
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <a class="btn btn-danger" href="<?php echo base_url().'marketplace/listing/'; ?>">Cancel</a>
                 <?php if($this->uri->segment(3)==''): ?>
                    <button class="btn btn-warning" type="submit" name="status" value="2">Save for later</button>
                <?php endif; ?>
                <button class="btn btn-primary" type="submit" name="status" value="1">List Now</button>
            </div>
        </div>
    </div> 
    
    
 </div>
</div>

    <div class="col-lg-5">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Listing Pictures</h5>
            </div>
            <div class="ibox-content">
            <div class="row">
                <div class="col-md-12" style="text-align:center">
               
                <label  class="col-md-4" >Image 1</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image1) && file_exists($product_list->image1)): 
                $img1 = explode('/', $product_list->image1)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" class="thumbnail"/>
                <?php endif ?>
                 <input type="file" name="image1" class="btn default btn-file">
                </div>
                 <?php echo form_error('image1'); ?>
                 <label  class="col-md-4" >Image 2</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image2) && file_exists($product_list->image2)): 
                $img2 = explode('/', $product_list->image2)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img2[3]; ?>" class="thumbnail"/>
                <?php endif ?>
                 <input type="file" name="image2" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image2'); ?>
                 <label  class="col-md-4" >Image 3</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image3)&& file_exists($product_list->image3)): 
                $img3 = explode('/', $product_list->image3)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" class="thumbnail"/>
                <?php endif ?>
                 <input type="file" name="image3" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image3'); ?>
                 <label  class="col-md-4" >Image 4</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image4)&& file_exists($product_list->image4)): 
                $img4 = explode('/', $product_list->image4)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" class="thumbnail"/>
                <?php endif ?>
                 <input type="file" name="image4" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image4'); ?>

                  <label  class="col-md-4" >Image 5</label>
                <div  class="col-md-8">
                 <?php if (!empty($product_list->image5)&& file_exists($product_list->image5)): 
                $img5 = explode('/', $product_list->image5)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" class="thumbnail"/>
                <?php endif ?>
                 <input type="file" name="image5" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image5'); ?>

                </div>
                <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
            </div>
            </div>
        </div>
    </div>        
</form>
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

    <script>
    function shippings_to_couriers (ship_id) {
        $.get('<?php echo base_url() ?>marketplace/shippings_to_couriers_data/'+ship_id, function(data) {
            $('#couriers_data').html(data);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    }
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
        jQuery.post('<?php echo base_url()?>marketplace/get_attributes_info/MPN',{product_mpn_isbn:product_mpn_isbn},
        function(data){
         var prod_make= <?php echo json_encode($product_makes); ?>;
         var producttypes= <?php echo json_encode($pro_type); ?>;
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
             //$('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);
            $('input[name="product_make"]').val(data.product_make);
            $('input[name="product_color"]').val(data.product_color);
           
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

    $(document).ready(function() {
        $('#shipping_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('input[name="shipping_charges"]').prop('disabled', false);
            }
            else{
               $('input[name="shipping_charges"]').prop('disabled', true); 
            }
        });

        $('#allowoffer_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('select[name="allow_offer"]').prop('disabled', false);
            }
            else{
               $('select[name="allow_offer"]').prop('disabled', true); 
            }
        });

        $('#orderqunatity_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('input[name="min_qty_order"]').prop('disabled', false);
            }
            else{
               $('input[name="min_qty_order"]').prop('disabled', true); 
            }
        });

         $('#minimum_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('input[name="min_price"]').prop('disabled', false);
            }
            else{
               $('input[name="min_price"]').prop('disabled', true); 
            }
        });

          $('#maximum_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('input[name="max_price"]').prop('disabled', false);
            }
            else{
               $('input[name="max_price"]').prop('disabled', true); 
            }
        });


        $('#listing_type').on('change', function(){
            if($(this).val() == 1){
            $('.sell-offer').hide();
            $('.buying').show();
            }else if($(this).val() == 2){
            $('.sell-offer').show();
            $('.buying').hide();
            }else{
            $('.sell-offer').show();
            $('.buying').show(); 
            }
        });
    });
 </script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: today 
    });
    </script>

    <style>
.error{
  color:rgba(255, 0, 0, 0.7);
  color: rgba(255, 0, 0, 0.81);
  padding: 7px 0px 0px 0px;
}
.error:before{
    content: "*";
    padding: 3px;
}
</style>




                            <div class="modal inmodal fade" id="shipping" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Shipping Terms</h4>
                                            <small class="font-bold">Incoterms rules or International Commercial Terms</small>
                                        </div>

                                        <div class="modal-body">
                                          <strong>EXW – Ex Works (named place)</strong><br />
                                          <p>The seller makes the goods available at his/her premises. This term places the maximum obligation on the buyer and minimum obligations on the seller. The Ex Works term is often used when making an initial quotation for the sale of goods without any costs included. EXW means that a buyer incurs the risks for bringing the goods to their final destination. The seller does not load the goods on collecting vehicles and does not clear them for export. If the seller does load the goods, he does so at buyer's risk and cost. If parties wish seller to be responsible for the loading of the goods on departure and to bear the risk and all costs of such loading, this must be made clear by adding explicit wording to this effect in the contract of sale.</p>
                                          <p>The buyer arranges the pickup of the freight from the supplier's designated ship site, owns the in-transit freight, and is responsible for clearing the goods through Customs. The buyer is also responsible for completing all the export documentation.</p>
                                          <p>These documentary requirements may cause two principal issues. Firstly, the stipulation for the buyer to complete the export declaration can be an issue in certain jurisdictions (not least the European Union) where the customs regulations require the declarant to be either an individual or corporation resident within the jurisdiction. Secondly, most jurisdictions require companies to provide proof of export for tax purposes. In an Ex-Works shipment the buyer is under no obligation to provide such proof, or indeed to even export the goods. It is therefore of utmost importance that these matters are discussed with the buyer before the contract is agreed. It may well be that another Incoterm, such as FCA seller's premises, may be more suitable.</p>
                                          
                                          
                                          <strong>FOB – Free on Board (named port of shipment)</strong><br />
                                          <p>The seller must advance government tax in the country of origin as of commitment to load the goods on board a vessel designated by the buyer. Cost and risk are divided when the goods are sea transport in containers (see Incoterms 2010, ICC publication 715). The seller must instruct the buyer the details of the vessel and the port where the goods are to be loaded, and there is no reference to, or provision for, the use of a carrier or forwarder. This term has been greatly misused over the last three decades ever since Incoterms 1980 explained that FCA should be used for container shipments.</p>
                                          <p>It means the seller pays for transportation of goods to the port of shipment, loading cost. The buyer pays cost of marine freight transportation, insurance, unloading and transportation cost from the arrival port to destination. The passing of risk occurs when the goods are in buyer account. The buyer arranges for the vessel and the shipper has to load the goods and the named vessel at the named port of shipment with the dates stipulated in the contract of sale as informed by the buyer.</p>
                                          
                                          <strong>CPT – Carriage Paid To (named place of destination)</strong><br />
                                          <p>CPT replaces the venerable C&F (cost and freight) and CFR terms for all shipping modes outside of non-containerised seafreight.</p>
                                          <p>The seller pays for the carriage of the goods up to the named place of destination. Risk transfers to buyer upon handing goods over to the first carrier at the place of shipment in the country of Export. The Shipper is responsible for origin costs including export clearance and freight costs for carriage to named place (usually a destination port or airport). The shipper is not responsible for delivery to the final destination (generally the buyer's facilities), or for buying insurance. If the buyer does require the seller to obtain insurance, the Incoterm CIP should be considered.</p>
                                          
                                          <strong>CIP – Carriage and Insurance Paid to (named place of destination)</strong><br />
                                          <p>This term is broadly similar to the above CPT term, with the exception that the seller is required to obtain insurance for the goods while in transit. CIP requires the seller to insure the goods for 110% of their value under at least the minimum cover of the Institute Cargo Clauses of the Institute of London Underwriters (which would be Institute Cargo Clauses (C)), or any similar set of clauses. The policy should be in the same currency as the contract.</p>
                                          
                                          <p>CIP can be used for all modes of transport, whereas the equivalent term CIF can only be used for non-containerised seafreight.</p>
                                          <strong>Data Source</strong><br />
                                          <p>Taken from <a href="http://en.wikipedia.org/wiki/Incoterms" target="_blank">Incoterms Wikipedia page</a></p>


                                        
                                        
                                        
                                        
                                        
                                        </div>
                                        
                                    </dl>
                                </div>
                            </div><!-- /row -->
              </div></div></div></div>
            <!--<div class="col-lg-3">
                <img alt="image" class="img-circle" src="public/main/template/gsm/images/members/no_profile.jpg">  
            </div>-->