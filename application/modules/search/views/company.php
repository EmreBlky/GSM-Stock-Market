<script type="text/javascript">
    var regions = <?php echo json_encode($regions); ?>;
    var countries = <?php echo json_encode($country); ?>;
    var searchedRegion = "<?php echo $this->input->get('region') ?>";
    var searchedCountry = "<?php echo $this->input->get('countries') ?>";

    $(document).ready(function () {
        changeOptions("continent");
        changeOptions("regions");
    })

    $(document).on("change", "#continent, #regions", function () {
        changeOptions($(this).attr("id"));
    })


    function changeOptions(id) {

        if (id == "continent") {
            $("#regions").html('<option value="">All Regions</option>');
            var selectedContinent = $("#continent option:selected").val();

            $.each(regions, function (index, value) {
                var selected = (searchedRegion == value.region) ? 'selected="selected"' : '';
                if (value.continent == selectedContinent || selectedContinent == "")
                    $("#regions").append('<option value="' + value.region + '" ' + selected + '>' + value.region + '</option>');
            });
        }
        if (id == "regions") {
            $("#countries").html('<option value="">All Countries</option>');
            var selectedRegion = $("#regions option:selected").val();
            $.each(countries, function (index, value) {
                var selected = (searchedCountry == value.id) ? 'selected="selected"' : '';
                if (value.region == selectedRegion || selectedRegion == "")
                    $("#countries").append('<option value="' + value.id + '" ' + selected + '>' + value.country + '</option>');
            });
        }
    }
    /*function changeOptions() {
     $("#regions").children("optgroup").show();
     var selectedval = $("#continent option:selected").val();
     if (selectedval != "")
     $("#regions").children("optgroup[label!='" + selectedval + "']").hide();

     $("#countries").children("optgroup").show();
     var selectedval = $("#regions option:selected").val();
     if (selectedval != "")
     $("#countries").children("optgroup[label!='" + selectedval + "']").hide();
     }*/
</script>
<style type="text/css">
    #pagination {
        margin-bottom: 30px;
    }

    ul.tsc_pagination li a {
        border: solid 1px;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        padding: 6px 9px 6px 9px;
    }

    ul.tsc_pagination li {
        padding-bottom: 1px;
    }

    ul.tsc_pagination li a:hover,
    ul.tsc_pagination li a.current {
        color: #FFFFFF;
        box-shadow: 0px 1px #EDEDED;
        -moz-box-shadow: 0px 1px #EDEDED;
        -webkit-box-shadow: 0px 1px #EDEDED;
    }

    ul.tsc_pagination {
        margin: 4px 0;
        padding: 0px;
        height: 100%;
        overflow: hidden;
        font: 12px 'Tahoma';
        list-style-type: none;
    }

    ul.tsc_pagination li {
        float: left;
        margin: 0px;
        padding: 0px;
        margin-left: 5px;
    }

    ul.tsc_pagination li a {
        color: black;
        display: block;
        text-decoration: none;
        padding: 7px 10px 7px 10px;
    }

    ul.tsc_pagination li a img {
        border: none;
    }

    ul.tsc_pagination li a {
        color: #0A7EC5;
        border-color: #8DC5E6;
        background: #F8FCFF;
    }

    ul.tsc_pagination li a:hover,
    ul.tsc_pagination li a.current {
        text-shadow: 0px 1px #388DBE;
        border-color: #3390CA;
        background: #58B0E7;
        background: -moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
        background: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
    }
</style>
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
            }
        });
    }

</script>

<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership > 1 && $member->marketplace == 'active'){ ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Search (<?php echo $total_results; ?>)</h2>
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
                            <select class="form-control" id="regions" name="region">
                                <option value="">All Regions</option>
                                <?php $i = 0;
                                foreach ($regions as $regions) {
                                    echo '<option value="' . $regions->region . '" data-continent="' . $regions->continent . '">' . $regions->region . '</option>';
                                    $i++;
                                } ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="countries" name="countries">
                                <option value="">All Countries</option>
                                <?php foreach ($country as $country) {
                                    echo '<option value="' . $country->id . '" data-region="' . $country->region . '">' . $country->country . '</option>';
                                } ?>
                            </select>

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

    if ($result->id != 5){
    ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="contact-box">


                <div class="col-md-2">
                    <div class="text-center">
                        <?php if (file_exists("public/main/template/gsm/images/company/" . $result->id . ".png")) { ?>
                            <img class="img-circle m-t-xs img-responsive" src="public/main/template/gsm/images/company/<?php echo $result->id; ?>.png" style="margin-bottom:10px">
                        <?php } else { ?>
                            <img class="img-circle m-t-xs img-responsive" src="public/main/template/gsm/images/company/no_company.jpg" style="margin-bottom:10px">
                        <?php } ?>
                        
                        <?php $overall = $result->rating; ?>
                        <?php if($overall >= 95){ ?>
                            <span class="label label-success"><?php echo $result->rating; ?></span>
                        <?php } elseif($overall <= 94 && $overall >= 80) {?>
                            <span class="label label-primary"><?php echo $result->rating; ?></span>
                        <?php } elseif($overall <= 79 && $overall >= 51) {?>
                            <span class="label label-warning"><?php echo $result->rating; ?></span>
                        <?php } elseif($overall <= 50 && $overall >= 1) {?>
                            <span class="label label-danger"><?php echo $result->rating; ?></span>
                        <?php } else { ?> 
                            <span class="label label-default"><?php echo $result->rating; ?></span>
                        <?php } ?>

                        <div class="m-t-xs font-bold"><?php echo $result->membership . " Member"; ?></div>

<?php /*
                        <input type="text" value="<?php echo $result->rating; ?>" class="dial m-r"
                               data-fgColor="#f8ac59"
                               data-width="50"
                               data-height="50" data-angleOffset=-125 data-angleArc=250 readonly/>
*/ ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3><strong><?php echo $result->company_name; ?></strong>
                        <?php if (file_exists("public/main/template/gsm/img/flags/" . str_replace(" ", "_", $result->country) . ".png")) { ?>
                            <img class="novert"
                                 alt="<?php echo $result->country; ?>"
                                 src="public/main/template/gsm/img/flags/<?php echo str_replace(" ", "_", $result->country); ?>.png"
                                 title="<?php echo $result->country; ?>"/>
                        <?php } ?>
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
}
?>
<div id="pagination" class="pull-right">
    <ul class="tsc_pagination">
        <?php foreach ($links as $link) {
            echo "<li>" . $link . "</li>";
        }
        ?>
    </ul>
</div>
<div class="clearfix"></div>
<?php
} else {
    echo 'No Record Found.';
} ?>


</div>

<?php } else {?>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Search (1)</h2>
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
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to company search feature. You can search for any company listed on our website and view their profile/send them a message. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>

<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to use our company search feature. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>

<?php }?>

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form>
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
                            <select class="form-control" id="regions" name="region">
                                <option value="">All Regions</option>
                                <?php $i = 0;
                                foreach ($regions as $regions) {
                                    echo '<option value="' . $regions->region . '" data-continent="' . $regions->continent . '">' . $regions->region . '</option>';
                                    $i++;
                                } ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="countries" name="countries">
                                <option value="">All Countries</option>
                                <?php foreach ($country as $country) {
                                    echo '<option value="' . $country->id . '" data-region="' . $country->region . '">' . $country->country . '</option>';
                                } ?>
                            </select>

                        </div>
                    </div>
                    <!-- row -->
                    </form>
                    <?php } ?>
                </div>
                <!-- ibox-content -->
            </div>
        </div>
    </div>
    <!-- row end -->
    
    <div class="row">

        <div class="col-lg-12">
            <div class="contact-box">
            <div class="row">


                <div class="col-md-2">
                    <div class="text-center">
                            <img class="img-circle m-t-xs img-responsive" src="public/main/template/gsm/images/company/5.png" style="margin-bottom:10px">
                            
                            <span class="label label-success">93</span>
                        	<div class="m-t-xs font-bold">Gold Member</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3><strong>GSMStockMarket.com Limited</strong>
                            <img class="novert" alt="United Kingdom" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom"/>
                    </h3>

                    <p>Welcome to GSMstockmarket.com. The ultimate B2B trading platform for companies who buy and sell mobile phones, accessories and spare parts.</p>

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
                        <dd>Business Sector 1</dd>
                        <dt>Secondary:</dt>
                        <dd>Business Sector 2</dd>
                        <dt>Tertiary:</dt>
                        <dd>Business Sector 3</dd>
                        <dt>Other:</dt>
                        <dd>Business Sector 4</dd>
                    </dl>
                    <a href="member/profile/5">
                        <div class="col-md-12" style="margin-top:15px">
                            <button class="btn btn-profile pull-right" type="button" style="font-size:10px"><i class="fa fa-user"></i>&nbsp;View Profile</button>
                    </a>

                    <button style="font-size:10px;margin-right:15px" class="btn btn-message pull-right" type="button"><i class="fa fa-envelope"></i>&nbsp;Message</button>

                </div>

            </div>
            </div>
        </div>    
        
    </div>

</div>


</div>