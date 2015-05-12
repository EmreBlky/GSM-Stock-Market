<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>View Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Support
            </li>
            <li class="active">
                <strong>Feedback</strong>
            </li>
        </ol>
    </div>
</div>

<?php
$attributes = array('class' => 'form-horizontal validation');
?>
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Platform Feedback</h5>
                </div>
                <div class="ibox-content form-horizontal">
                    <div class="form-group"><label class="col-md-3 control-label">Title <span style="color:red">*</span></label>

                        <div class="col-md-2">
                            <?php /*

                              if($member->title){

                              $data = array(
                              'name'        => 'title',
                              'class'          => 'form-control',
                              'value'     => $member->title,
                              'required'  => 'required'
                              );

                              echo form_input($data);

                              }
                              else{

                              $data = array(
                              'name'        => 'title',
                              'class'          => 'form-control',
                              'value'     => $this->input->post('title'),
                              'required'  => 'required'
                              );

                              echo form_input($data);
                              }
                             */ ?>
                            <select class="form-control" name="title">
                                <option value="<?php echo $member->title;?>" selected><?php echo $member->title;?>
                                <option value="Mr.">Mr.
                                <option value="Mrs.">Mrs.
                                <option value="Miss.">Miss.
                                <option value="Ms.">Ms.
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($member->firstname) {

                                $data = array(
                                    'name' => 'firstname',
                                    'class' => 'form-control',
                                    'value' => $member->firstname,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'firstname',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('firstname'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($member->lastname) {

                                $data = array(
                                    'name' => 'lastname',
                                    'class' => 'form-control',
                                    'value' => $member->lastname,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'lastname',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('lastname'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Company Role <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($member->role) {

                                $data = array(
                                    'name' => 'role',
                                    'class' => 'form-control',
                                    'value' => $member->role,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'role',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('role'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Email Address <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($member->email) {

                                $data = array(
                                    'name' => 'email',
                                    'class' => 'form-control',
                                    'value' => $member->email,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'email',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('email'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile Number</label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_mobile($member->id);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if ($member->mobile_number) {

                                $data = array(
                                    'name' => 'mobile_number',
                                    'class' => 'form-control',
                                    'value' => $member->mobile_number,
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'mobile_number',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('mobile_number')
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Language <span style="color:red">*</span></label>

                        <div class="col-md-4">
                            <?php
                            $this->load->module('language');
                            $this->language->select($member->id);
                            ?>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <!--
<button class="btn btn-primary" name="submit_form" type="submit" id="submit_form"
                            >Save changes</button>
                            -->
                            <input class="btn btn-primary" name="submit_form" type="submit" id="submit_form"
                                   value="Save changes"/>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        
    </div>
</div><!-- /row -->
<?php //echo form_close() ?>






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
    });</script>

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
    });</script>


<!-- Jquery Validate -->
<script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

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
