<?php 	$id = $this->session->userdata('members_id');
		$member = $this->member_model->get_where($id);
		if($member->membership > 1){
?>

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
        padding: 6px 9px 6px 9px;
    }
    ul.tsc_pagination li {
        padding-bottom: 1px;
    }

    ul.tsc_pagination li a:hover,
    ul.tsc_pagination li a.current {
        border: solid 1px;
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
        background-color: #FFFFFF;
		border: 1px solid #DDDDDD;
		color: inherit;
		float: left;
		line-height: 1.42857;
		padding: 4px 10px;
		position: relative;
		text-decoration: none;
    }

    ul.tsc_pagination li a:hover,
    ul.tsc_pagination li a.current {
          background-color: #f4f4f4;
		  border-color: #DDDDDD;
		  color: inherit;
			cursor:pointer;
		  z-index: 2;
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
                        
                        <?php                        
                            $this->load->module('feedback');
                            $overall = $this->feedback->overallScore($result->id);
                        ?>
                        <?php if($overall >= 95){ ?>
                            <span class="label label-success"><?php echo $overall; ?></span>
                        <?php } elseif($overall <= 94 && $overall >= 80) {?>
                            <span class="label label-primary"><?php echo $overall; ?></span>
                        <?php } elseif($overall <= 79 && $overall >= 51) {?>
                            <span class="label label-warning"><?php echo $overall; ?></span>
                        <?php } elseif($overall <= 50 && $overall >= 1) {?>
                            <span class="label label-danger"><?php echo $overall; ?></span>
                        <?php } else { ?> 
                            <span class="label label-default"><?php echo $overall; ?></span>
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

<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="alert alert-danger">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
        

<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form>                    
                    <div class="row">
                        <div class="col-lg-3">
                            <select name="sort" class="form-control">
                            <option value="primary-business">Sort by (Primary Business)</option>
                            <option value="new-user">Sort by (Newest Users)</option>
                            <option value="last-online">Sort by (Last Online)</option>
                            <option value="high-rating">Sort by (Highest Rating)</option>
                        </select>                        
                        </div>
                        <div class="col-lg-4" style="padding:0">
                            <select name="business" class="form-control">
<option value="" selected="selected">All Business Activites</option>
<option value="New Mobiles (Sim Free)">New Mobiles (Sim Free)</option>
<option value="New Mobiles (Network Stocks)">New Mobiles (Network Stocks)</option>
<option value="14 Day Mobiles">14 Day Mobiles</option>
<option value="Refurbished Mobiles">Refurbished Mobiles</option>
<option value="Used Mobiles">Used Mobiles</option>
<option value="BER Mobiles">BER Mobiles</option>
<option value="Mobile Accessories">Mobile Accessories</option>
<option value="Wearable Technology">Wearable Technology</option>
<option value="Bluetooth Products">Bluetooth Products</option>
<option value="Mobile Spare Parts">Mobile Spare Parts</option>
<option value="Mobile Service and Repair Centre">Mobile Service and Repair Centre</option>
<option value="Network Operator">Network Operator</option>
<option value="Freight Forwarding">Freight Forwarding</option>
<option value="Insurance">Insurance</option>
<option value="Tablets">Tablets</option>
<option value="Sim Cards">Sim Cards</option>
</select>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="text" name="term" value="" placeholder="Enter company name..." class="form-control">                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Search</button> 
                            </span>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin-top:10px">

                        <div class="col-lg-4">
                            <select name="continent" class="form-control" id="continent">
<option value="" selected="selected">All Continents</option>
<option value="Africa">Africa</option>
<option value="Asia">Asia</option>
<option value="Europe">Europe</option>
<option value="Missing Info">Missing Info</option>
<option value="Oceania">Oceania</option>
<option value="The Americas">The Americas</option>
</select>
                        </div>
                        <div class="col-lg-4" style="padding:0">
                            <select class="form-control" id="regions" name="region"><option value="">All Regions</option><option value="Australia and New Zealand">Australia and New Zealand</option><option value="Central Africa">Central Africa</option><option value="Central America">Central America</option><option value="Central Asia">Central Asia</option><option value="Eastern Africa">Eastern Africa</option><option value="Eastern Asia">Eastern Asia</option><option value="Eastern Europe">Eastern Europe</option><option value="Melanesia">Melanesia</option><option value="Micronesia">Micronesia</option><option value="Missing Info">Missing Info</option><option value="North America">North America</option><option value="Northern Africa">Northern Africa</option><option value="Northern Europe">Northern Europe</option><option value="Polynesia">Polynesia</option><option value="South America">South America</option><option value="South-Eastern Asia">South-Eastern Asia</option><option value="Southern Africa">Southern Africa</option><option value="Southern Asia">Southern Asia</option><option value="Southern Europe">Southern Europe</option><option value="The Caribbean">The Caribbean</option><option value="Western Africa">Western Africa</option><option value="Western Asia">Western Asia</option><option value="Western Europe">Western Europe</option></select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="countries" name="countries"><option value="">All Countries</option><option value="1">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="4">American Samoa</option><option value="5">Andorra</option><option value="6">Angola</option><option value="7">Anguilla</option><option value="8">Antigua and Barbuda</option><option value="9">Argentina</option><option value="10">Armenia</option><option value="11">Aruba</option><option value="12">Australia</option><option value="13">Austria</option><option value="14">Azerbaijan</option><option value="15">Bahamas</option><option value="16">Bahrain</option><option value="17">Bangladesh</option><option value="18">Barbados</option><option value="19">Belarus</option><option value="20">Belgium</option><option value="21">Belize</option><option value="22">Benin</option><option value="23">Bermuda</option><option value="24">Bhutan</option><option value="25">Bolivia</option><option value="26">Bosnia Herzegovina</option><option value="27">Botswana</option><option value="28">Brazil</option><option value="29">Brunei</option><option value="30">Bulgaria</option><option value="31">Burkina Faso</option><option value="32">Burma (Myanmar)</option><option value="33">Burundi</option><option value="34">Cambodia</option><option value="35">Cameroon</option><option value="36">Canada</option><option value="37">Cape Verde</option><option value="38">Cayman Islands</option><option value="39">Central African Republic</option><option value="40">Chad</option><option value="41">Chile</option><option value="42">China</option><option value="43">Christmas Island</option><option value="44">Cocos (Keeling) Islands</option><option value="45">Colombia</option><option value="46">Comoros</option><option value="47">Congo (Democratic Republic of the)</option><option value="48">Congo (Republic of the)</option><option value="49">Cook Islands</option><option value="50">Costa Rica</option><option value="51">Cote d'Ivoire</option><option value="52">Croatia</option><option value="53">Cuba</option><option value="54">Cyprus</option><option value="55">Czech Republic</option><option value="56">Denmark</option><option value="57">Djibouti</option><option value="58">Dominica</option><option value="59">Dominican Republic</option><option value="60">Ecuador</option><option value="61">Egypt</option><option value="62">El Salvador</option><option value="63">Equatorial Guinea</option><option value="64">Eritrea</option><option value="65">Estonia</option><option value="66">Ethiopia</option><option value="67">Falkland Islands</option><option value="68">Faroe Islands</option><option value="69">Fiji</option><option value="70">Finland</option><option value="71">France</option><option value="72">French Polynesia</option><option value="73">Gabon</option><option value="74">Gambia</option><option value="75">Georgia</option><option value="76">Germany</option><option value="77">Ghana</option><option value="78">Gibraltar</option><option value="79">Greece</option><option value="80">Greenland</option><option value="81">Grenada</option><option value="82">Guam</option><option value="83">Guatemala</option><option value="84">Guinea</option><option value="85">Guinea-Bissau</option><option value="86">Guyana</option><option value="87">Haiti</option><option value="88">Honduras</option><option value="89">Hong Kong</option><option value="90">Hungary</option><option value="91">Iceland</option><option value="92">India</option><option value="93">Indonesia</option><option value="94">Iran</option><option value="95">Iraq</option><option value="96">Ireland</option><option value="97">Israel</option><option value="98">Italy</option><option value="99">Jamaica</option><option value="100">Japan</option><option value="101">Jordan</option><option value="102">Kazakhstan</option><option value="103">Kenya</option><option value="104">Kiribati</option><option value="105">Korea North</option><option value="106">Korea South</option><option value="107">Kuwait</option><option value="108">Kyrgyzstan</option><option value="109">Laos</option><option value="110">Latvia</option><option value="111">Lebanon</option><option value="112">Lesotho</option><option value="113">Liberia</option><option value="114">Libya</option><option value="115">Liechtenstein</option><option value="116">Lithuania</option><option value="117">Luxembourg</option><option value="118">Macau</option><option value="119">Macedonia</option><option value="120">Madagascar</option><option value="121">Malawi</option><option value="122">Malaysia</option><option value="123">Maldives</option><option value="124">Mali</option><option value="125">Malta</option><option value="126">Marshall Islands</option><option value="127">Mauritania</option><option value="128">Mauritius</option><option value="129">Mayotte</option><option value="130">Mexico</option><option value="225">Missing Info</option><option value="131">Moldova</option><option value="132">Monaco</option><option value="133">Mongolia</option><option value="134">Montenegro</option><option value="135">Montserrat</option><option value="136">Morocco</option><option value="137">Mozambique</option><option value="138">Namibia</option><option value="139">Nauru</option><option value="140">Nepal</option><option value="141">Netherland Antilles</option><option value="142">Netherlands</option><option value="143">New Caledonia</option><option value="144">New Zealand</option><option value="145">Nicaragua</option><option value="146">Niger</option><option value="147">Nigeria</option><option value="148">Niue</option><option value="149">Norway</option><option value="150">Oman</option><option value="151">Pakistan</option><option value="152">Palau</option><option value="153">Panama</option><option value="154">Papua New Guinea</option><option value="155">Paraguay</option><option value="156">Peru</option><option value="157">Philippines</option><option value="158">Pitcairn</option><option value="159">Poland</option><option value="160">Portugal</option><option value="161">Puerto Rico</option><option value="162">Qatar</option><option value="163">Romania</option><option value="164">Russia</option><option value="165">Rwanda</option><option value="166">Saint Barthelemy</option><option value="167">Saint Helena</option><option value="168">Saint Kitts and Nevis</option><option value="169">Saint Lucia</option><option value="170">Saint Pierre and Miquelon</option><option value="171">Saint Vincent and Grenadines</option><option value="172">Samoa</option><option value="173">San Marino</option><option value="174">Sao Tome and Principe</option><option value="175">Saudi Arabia</option><option value="176">Senegal</option><option value="177">Serbia</option><option value="178">Seychelles</option><option value="179">Sierra Leone</option><option value="180">Singapore</option><option value="181">Slovakia</option><option value="182">Slovenia</option><option value="183">Solomon Islands</option><option value="184">Somalia</option><option value="185">South Africa</option><option value="186">Spain</option><option value="187">Sri Lanka</option><option value="188">Sudan</option><option value="189">Suriname</option><option value="190">Swaziland</option><option value="191">Sweden</option><option value="192">Switzerland</option><option value="193">Syria</option><option value="194">Taiwan</option><option value="195">Tajikistan</option><option value="196">Tanzania</option><option value="197">Thailand</option><option value="198">Timor-Leste</option><option value="199">Togo</option><option value="200">Tokelau</option><option value="201">Tonga</option><option value="202">Trinidad and Tobago</option><option value="203">Tunisia</option><option value="204">Turkey</option><option value="205">Turkmenistan</option><option value="206">Turks and Caicos Islands</option><option value="207">Tuvalu</option><option value="208">Uganda</option><option value="209">Ukraine</option><option value="210">United Arab Emirates</option><option value="211">United Kingdom</option><option value="212">United States</option><option value="213">Uruguay</option><option value="214">Uzbekistan</option><option value="215">Vanuatu</option><option value="216">Vatican City State</option><option value="217">Venezuela</option><option value="218">Vietnam</option><option value="219">Virgin Islands (British)</option><option value="220">Virgin Islands (US)</option><option value="221">Wallis and Futana</option><option value="222">Yemen</option><option value="223">Zambia</option><option value="224">Zimbabwe</option></select>

                        </div>
                    </div>
                    <!-- row -->
                    </form>                </div>
                <!-- ibox-content -->
            </div>
        </div>
    </div>
    
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
<?php }?>