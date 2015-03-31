<script type="text/javascript">
    $(document).ready(function () {
        changeOptions();
    })

    $(document).on("change", "#continent, #regions", function () {
        changeOptions();
    })

    function changeOptions() {
        $("#regions").children("optgroup").show();
        var selectedval = $("#continent option:selected").val();
        if (selectedval != "")
            $("#regions").children("optgroup[label!='" + selectedval + "']").hide();

        $("#countries").children("optgroup").show();
        var selectedval = $("#regions option:selected").val();
        if (selectedval != "")
            $("#countries").children("optgroup[label!='" + selectedval + "']").hide();
    }
</script>
<script type="text/javascript">

    function sendMessage(mid, sid) {
        //alert(mid);
        //alert(sid);
        //var mid     = $('#sent_by').val();
        //var sid     = $("#sent_to").val();
        $("#submit_message_" + sid + "").hide();
        var subject = $("#subject").val();
        var body = $("#body_" + sid + "").val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
        var body = body.replace(/\//g, 'SLASH1');
        var body = body.replace(/\?/g, 'QUEST1');
        var body = body.replace(/\%/g, 'PERCENT1');

        $.ajax({
            type: "POST",
            url: "mailbox/composeAjaxMail/" + mid + "/" + sid + "/" + subject + "/" + body + "",
            dataType: "html",
            success: function (data) {

                $("#body_" + sid + "").val('');
                $('#profile_message_' + sid + '').modal('hide');
                toastr.success('Your message has been sent.', 'Message Alert');
                $("#submit_message_" + sid + "").show('slow');
            },
        });
    }

</script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Search</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li class="active">
                <strong>Search</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php echo form_open('search/company/', array("method" => 'get')); ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <?php
                            $options = array("primary-business" => "Sort by (Primary Business)",
                                "new-user" => "Sort by (Newest Users)",
                                "last-online" => "Sort by (Last Online)",
                                "high-rating" => "Sort by (Highest Rating)");
                            echo form_dropdown("sort", $options, $this->input->get('sort'), 'class="form-control"')
                            ?>
                        </div>
                        <div class="col-lg-4" style="padding:0">
                            <?php
                            $options = array("" => "All Business Activites",
                                "New Mobiles (Sim Free)" => "New Mobiles (Sim Free)",
                                "New Mobiles (Network Stocks)" => "New Mobiles (Network Stocks)",
                                "14 Day Mobiles" => "14 Day Mobiles",
                                "Refurbished Mobiles" => "Refurbished Mobiles",
                                "Used Mobiles" => "Used Mobiles",
                                "BER Mobiles" => "BER Mobiles",
                                "Mobile Accessories" => "Mobile Accessories",
                                "Wearable Technology" => "Wearable Technology",
                                "Bluetooth Products" => "Bluetooth Products",
                                "Mobile Spare Parts" => "Mobile Spare Parts",
                                "Mobile Service and Repair Centre" => "Mobile Service and Repair Centre",
                                "Network Operator" => "Network Operator",
                                "Freight Forwarding" => "Freight Forwarding",
                                "Insurance" => "Insurance",
                                "Tablets" => "Tablets",
                                "Sim Cards" => "Sim Cards");
                            echo form_dropdown("business", $options, $this->input->get('business'), 'class="form-control"')
                            ?>

                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <?php echo form_input(array("name" => 'term', "placeholder" => 'Enter company name...', "class" => 'form-control'), $this->input->get('term')) ?>
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Search</button> 
                            </span>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin-top:10px">

                        <div class="col-lg-4">
                            <?php
                            $options = array("" => "All Continents");
                            foreach ($continents as $continents) {
                                $options[$continents->continent] = $continents->continent;
                            }
                            echo form_dropdown("continent", $options, $this->input->get('continent'), 'class="form-control" id="continent"')
                            ?>
                        </div>
                        <div class="col-lg-4" style="padding:0">
                            <?php
                            $options = array("" => "All Regions");
                            foreach ($regions as $regions) {
                                $options[$regions->continent][$regions->region] = $regions->region;
                            }
                            echo form_dropdown("region", $options, $this->input->get('region'), 'class="form-control" id="regions"')
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            $options = array("" => "All Countries");
                            foreach ($country as $country) {
                                $options[$country->region][$country->id] = $country->country;
                            }
                            echo form_dropdown("countries", $options, $this->input->get('countries'), 'class="form-control" id="countries"')
                            ?>

                        </div>
                    </div>
                    <!-- row -->
                    <?php echo form_close() ?>
                </div>
                <!-- ibox-content -->
            </div>
        </div>
    </div>
    <!-- row end -->

    <?php if ($total_results > 0) {
    foreach ($results as $result) {
        
        if($result->id != 5){
    ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="contact-box">


                <div class="col-md-2">
                    <div class="text-center">
                        <?php if (file_exists("public/main/template/gsm/images/company/" . $result->id . ".png")) { ?>
                            <img class="img-circle m-t-xs img-responsive"
                                 src="public/main/template/gsm/images/company/<?php echo $result->id; ?>.png">
                        <?php } else { ?>
                            <img class="img-circle m-t-xs img-responsive"
                                 src="public/main/template/gsm/images/company/no_company.jpg">
                        <?php } ?>

                        <input type="text" value="<?php echo $result->rating; ?>" class="dial m-r"
                               data-fgColor="#f8ac59"
                               data-width="50"
                               data-height="50" data-angleOffset=-125 data-angleArc=250 readonly/>

                        <div class="m-t-xs font-bold"><?php echo $result->membership . " Member"; ?></div>

                    </div>
                </div>
                <div class="col-md-5">
                    <h3><strong><?php echo $result->company_name; ?></strong> <img class="novert"
                                                                                   alt="image"
                                                                                   src="public/main/template/gsm/img/flags/<?php echo str_replace(" ", "_", $result->country); ?>.png"
                                                                                   title="<?php echo $result->country; ?>"/>
                    </h3>

                    <p><?php echo $result->company_profile; ?></p>

                </div>
                <div class="col-md-5">
                    <style>
                        .novert {
                            vertical-align: baseline !important
                        }
                    </style>

                    <h4 style="text-align:center">Business Activities</h4>
                    <dl class="dl-horizontal">
                        <dt>Primary:</dt>
                        <dd><?php echo $result->business_sector_1; ?></dd>
                        <dt>Secondary:</dt>
                        <dd><?php echo $result->business_sector_2; ?></dd>
                        <dt>Tertiary:</dt>
                        <dd><?php echo $result->business_sector_3; ?></dd>
                        <dt>Other:</dt>
                        <dd><?php echo $result->other_business; ?></dd>
                    </dl>
                    <a href="<?php echo 'member/profile/' . $result->admin_member_id; ?>">
                        <div class="col-md-12" style="margin-top:15px">
                            <button class="btn btn-profile pull-right" type="button" style="font-size:10px"><i
                                    class="fa fa-user"></i>&nbsp;View Profile
                            </button>
                    </a>

                    <button style="font-size:10px;margin-right:15px" class="btn btn-message pull-right" type="button"
                            data-toggle="modal" data-target="#profile_message_<?php echo $result->admin_member_id; ?>"
                            value="<?php echo $result->admin_member_id; ?>"><i class="fa fa-envelope"></i>&nbsp;Message
                    </button>

                    <!-- Modal -->
                    <div class="modal inmodal fade" id="profile_message_<?php echo $result->admin_member_id; ?>"
                         tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <?php
                                $attributes = array('id' => 'form');
                                echo form_open('mailbox/composeMail', $attributes);
                                ?>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                                    <small class="font-bold">Send a message
                                        to <?php echo $result->company_name ?></small>
                                    <input type="hidden" id="sent_by" name="sent_by"
                                           value="<?php echo $this->session->userdata('members_id'); ?>"/>
                                    <input type="hidden" id="sent_to" name="sent_to"
                                           value="<?php echo $result->admin_member_id;; ?>"/>
                                    <input type="hidden" id="email_address" name="email_address"
                                           value="<?php echo $result->email; ?>"/>
                                    <input type="hidden" id="subject" name="subject" value="Profile Message"/>
                                </div>
                                <div class="modal-body">
                                    <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                                    <?php

                                    $data = array(
                                        'name' => 'body_' . $result->admin_member_id,
                                        'id' => 'body_' . $result->admin_member_id,
                                        'class' => 'form-control',
                                        'style' => 'border:none',
                                        'required' => 'required'
                                    );

                                    echo form_textarea($data);

                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="submit" value="Send Message"/>
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button
                                        onclick="sendMessage(<?php echo $this->session->userdata('members_id'); ?>, <?php echo $result->admin_member_id; ?>);"
                                        type="button" id="submit_message_<?php echo $result->admin_member_id; ?>"
                                        class="btn btn-primary">Send Message
                                    </button>
                                    <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                    <!-- /Modal -->

                </div>

            </div>


            <div class="clearfix"></div>

        </div>
    </div>

</div>
        <?php } ?>    
<?php
echo $pagination;
}
} else {
    echo 'No Record Found.';
} ?>


</div>


<!-- Page Specific Scripts -->

<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>

<script type="text/javascript">
    $(function () {
        $(".dial").knob();
    })
</script>
