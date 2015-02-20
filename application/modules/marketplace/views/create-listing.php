<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>Edit Profile</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
   
            
        <div class="wrapper wrapper-content">
        	
        	<div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Listing Details</h5>
                        </div>
                        <div class="ibox-content">
                        	<form class="validation form-horizontal">
                            	<div class="form-group"><label class="col-md-3 control-label">Make</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                            	<div class="form-group"><label class="col-md-3 control-label">Model</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                            	<div class="form-group"><label class="col-md-3 control-label">Product Type</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                            	<div class="form-group"><label class="col-md-3 control-label">Condition</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                            	<div class="form-group"><label class="col-md-3 control-label">Spec</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                            	<div class="form-group"><label class="col-md-3 control-label">Quantity</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                            	<div class="form-group"><label class="col-md-3 control-label">Currency</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    	<p class="small">Select the currency you wish this listing to be sold in.</p>
                                    </div>
                                </div>
                                
                            	<div class="form-group"><label class="col-md-3 control-label">Price</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    </div>
                                </div>
                                
                            	<div class="form-group"><label class="col-md-3 control-label">Minimum Price</label>
                                    <div class="col-md-9">
                                    	<input type="type" class="form-control" />
                                    	<p class="small">Any offers below this price will be auto rejected. (Leave blank for any offer)</p>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                
                            	<div class="form-group"><label class="col-md-3 control-label">Product Description</label>
                                    <div class="col-md-9">
                                    	<textarea type="type" class="form-control" rows="5" /></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-warning" type="submit">Save for later</button>
                                        <button class="btn btn-primary" type="submit">List Now</button>
                                    </div>
                                </div>
                                
                         
                        </div>
                        
                        </div></div>
                                
                                
                        
                        
                        
                
                        
                        
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
                        
                        
                        
                        </div><!-- /row -->
                            </form>
        
        
        
        
            
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
    $('#companybio').characterCounter({
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
