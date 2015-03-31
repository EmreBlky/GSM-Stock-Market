<head>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>The worlds best B2B mobile phone trading platform, trade with anyone at a click of a button -
        GSMStockMarket.com</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:600,700' rel='stylesheet' type='text/css'>
    <link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet" type="text/css">
    <style>@import url(//fonts.googleapis.com/css?family=Lato:300,400,700);</style>
    <link rel="stylesheet" type="text/css" href="../public/main/template/www/css/style.css"
          media="screen"/>
    <link href="../public/main/template/core/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(window).on('load resize', function () {
            if ($(window).width() > 768) {
                // Check the initial Poistion of the Sticky Header
                var gsmNaviMenu = $('#navi-bar-wrapper').offset().top;

                $(window).scroll(function () {
                    if ($(window).scrollTop() > gsmNaviMenu) {
                        $('#navi-bar-wrapper').css({position: 'fixed', top: '0px'});
                        $('.space').css({margin: '106px 0 0'});
                    } else {
                        $('#navi-bar-wrapper').css({position: 'static', top: '30px'})
                        $('.space').css({margin: '0'});
                    }
                });
            }
            else if ($(window).width() < 768) {
                // Check the initial Poistion of the Sticky Header
                var gsmNaviMenu = $('#navi-bar-wrapper').offset().top;

                $(window).scroll(function () {
                    if ($(window).scrollTop() > gsmNaviMenu) {
                        $('#navi-bar-wrapper').css({position: 'relative', top: '0px'});
                        $('.space').css({margin: '0'});
                        /* safari fix */
                    } else {
                        $('#navi-bar-wrapper').css({position: 'relative', top: '0px'});
                        $('.space').css({margin: '0'});
                        /* safari fix */
                    }
                });
            }
        });
    </script>
    <script type="text/javascript"> <!-- THIS SCRIPT NEEDS TO BE GOTTEN FROM FUNCTIONS FOR MOBILE DROPDOWN -->
        jQuery(document).ready(function () {
            jQuery(".select-menu").change(function () {
                window.location = jQuery(this).find("option:selected").val();
            });
        });
    </script>


    <script type="text/javascript">

        //bprimary, bsecondary, btertiary
        $(document).ready(function () {

            appendOptions();

            $(document).on("change", "input[name='bsectors[]']", function () {

                if ($("input[name='bsectors[]']:checked").length > 5) {
                    $(this).attr("checked", false);
                    return;
                }

                $("#bprimary, #bsecondary, #btertiary").html('<option value="">[Select One]</option>');
                appendOptions();
            });

            $(document).on("change", ".bsnssector", function () {
                $(".bsnssector option").show();
                $(".bsnssector option:selected").each(function () {
                    if ($(this).val() != "")
                        $(".bsnssector").not(this).find("option[value='" + $(this).val() + "']").hide();
                });

            });

        });

        function appendOptions() {
            var counter = 0;
            $("input[name='bsectors[]']:checked").each(function () {

                $("#bprimary, #bsecondary, #btertiary").append($("<option></option>")
                    .attr("value", $(this).val())
                    .text($(this).val()));
                counter++;
            });

            if (counter == 1) {
                $("#bprimary option:eq(1)").attr("selected", true);
            }

        }
    </script>
</head>
<html>

<body>
<header>
    <div id="tiny-menu-wrapper">
        <div class="tiny-menu container">
            <ul class="mini" style="list-style:none;margin-top:5px;float:right;width:auto;white-space:nowrap">
                <li>
                    <a href="//support.gsmstockmarket.com/">Support <i class="glyphicon glyphicon-search"></i></a>
                </li>
                <li>
                    <a href="//support.gsmstockmarket.com/customer/portal/emails/new">Contact <i
                            class="glyphicon glyphicon-envelope"></i></a>
                </li>
                <li>
                    <a href="https://secure.gsmstockmarket.com/login">Login <i class="glyphicon glyphicon-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tiny-menu-wrapper -->
    <div id="navi-bar-wrapper">
        <div class="navi-bar container">
            <div class="navi-logo">
                <a href="http://www.gsmstockmarket.com/"><img
                        src="https://secure.gsmstockmarket.com/public/main/template/gsm/images/navi-logo.png" height="76"
                        width="251" alt="Navi GSM Logo"></a>
            </div>
            <!-- /navi-logo -->
            <div class="navi-menu">
                <ul id="navi-menu">
                    <li id="menu-item-27"><a href="http://www.gsmstockmarket.com/membership/">Membership</a></li>
                    <li id="menu-item-34"><a
                            href="http://support.gsmstockmarket.com/customer/portal/topics/744522-frequently-asked-questions/questions">FAQ</a>
                    </li>
                    <li id="menu-item-23"><a href="https://secure.gsmstockmarket.com/join/">Sign Up</a></li>
                </ul>
            </div>
            <!-- /navi-menu -->

        </div>
        <!-- /navi-bar -->
    </div>
    <!-- /navi-bar-wrapper -->
</header>





<?php
//echo '<pre>';
//print_r($country);
//exit;
//echo "<pre>";
//print_r($company);
//echo "</pre>";
?>


<script type="text/javascript" xmlns="http://www.w3.org/1999/html">

    var is_primary_set = false;
    $(document).ready(function () {

        var counter = getCheckedBoxesCount();
        toggleChecks(counter)
        <?php
        $primarybusiness = 'none';
        $secondarybusiness = 'none';
        $tertiarybusiness = 'none';




        if (isset($company->business_sector_1) && !empty($company->business_sector_1))
            $primarybusiness = 'block';
        ?>
        $('#primary-business').css("display", '<?php echo $primarybusiness; ?>');
        <?php
        if (isset($company->business_sector_2) && !empty($company->business_sector_2))
            $secondarybusiness = 'block';
        ?>
        $('#secondary-business').css("display", '<?php echo $secondarybusiness ?>');
        <?php
        if (isset($company->business_sector_3) && !empty($company->business_sector_3))
            $tertiarybusiness = 'block';
        ?>
        $('#tertiary-business').css("display", '<?php echo $tertiarybusiness ?>');
        $('#selectMessage').css("display", 'none');
    });
    function updateCode(value) {
        $("#phone_number").val(value);
        $("#mobile_phone").val(value);
    }

    function validate_info() {

        var total = getCheckedBoxesCount();
        if (total <= 0) {
            //console.log(total);
            alert('Please Select atleast one Business Sector');
            return false;
        }
        if (total == 1) {
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            //console.log(total);
            if (primary == '') {
                alert('Please Select Primary Business Sector');
                return false;
            }
        }
        if (total == 2) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        if (total == 3) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
            var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (tertiary == '') {
                error = error + 'Please Select Tertiary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        if (total > 3) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
            var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (tertiary == '') {
                error = error + 'Please Select Tertiary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        updateHiddens();
        return true;
    }


    function getCheckedBoxesCount() {
        var count = 1;
        var total = 0;
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            if (chk == true) {
                total = total + 1;
            }
            count++;
        }
        return total;
    }


    function toggleChecks(counter) {
        // Function to disable or enable check boxes


        var count = 1;
        var ids = new Array();
        if (counter >= 5) {
            while (count <= 16) {
                var chk = $('#bsectors' + count).prop("checked");
                var id = $('#bsectors' + count).attr('id');
                if (chk == false) {
                    $('#bsectors' + count).iCheck('uncheck');
                    $('#bsectors' + count).iCheck('disable');
                }
                count++;
            }
        } else {
            while (count <= 16) {
                var chk = $('#bsectors' + count).prop("checked");
                var id = $('#bsectors' + count).attr('id');
                if (chk == false) {
                    $('#bsectors' + count).iCheck('uncheck');
                    $('#bsectors' + count).iCheck('enable');
                }
                count++;
            }
        }

    }

    function updateChecks(div_id) {

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var tertiary = $('#btertiary').val();
        var total_checked = getCheckedBoxesCount();
        var chk = $('#' + div_id).prop("checked"); // get state of current checkbox

        if (chk == false) {
            var total_checked = total_checked + 1;
        } else {
            var total_checked = total_checked - 1;
        }
        //console.log('Total Checked:'+total_checked);

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                if (id != div_id) {
                    ids[count] = id;
                }
            }
            count++;
        }


        var selectedValue = $('#' + div_id).val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        if (selectedValue == primary) {
            $('#bprimary').empty().append(str);
            $('#bsecondary option[value="' + selectedValue + '"]').remove();
            $('#btertiary option[value="' + selectedValue + '"]').remove();
        }

        if (selectedValue == secondary) {
            $('#bsecondary').empty().append(str);
            $('#bprimary option[value="' + selectedValue + '"]').remove();
            $('#btertiary option[value="' + selectedValue + '"]').remove();
        }

        if (selectedValue == tertiary) {
            $('#btertiary').empty().append(str);
            $('#bprimary option[value="' + selectedValue + '"]').remove();
            $('#bsecondary option[value="' + selectedValue + '"]').remove();
        }

        $('#bprimary option[value="' + selectedValue + '"]').remove();
        $('#bsecondary option[value="' + selectedValue + '"]').remove();
        $('#btertiary option[value="' + selectedValue + '"]').remove();


        ids.forEach(function (entry) {

            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');


            if (entry == primary) {
                var str1 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str1 = "<option value = '" + entry + "'>" + value + "</option>";


            }
            if (entry != secondary && entry != tertiary) {
                $('#bprimary option[value="' + entry + '"]').remove();
                $('#bprimary').append(str1);
            }


            if (entry == secondary) {
                var str2 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str2 = "<option value = '" + entry + "'>" + value + "</option>";
            }
            if (entry != primary && entry != tertiary) {

                $('#bsecondary option[value="' + entry + '"]').remove();
                $('#bsecondary').append(str2);
            }


            if (entry == tertiary) {
                var str3 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str3 = "<option value = '" + entry + "'>" + value + "</option>";
            }

            if (entry != primary && entry != secondary) {

                $('#btertiary option[value="' + entry + '"]').remove();
                $('#btertiary').append(str3);
            }

        });
    }

    function updateSelects1(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {		// Get all checkboxes ids
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
        var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

        var str = "<option value = ''>[SELECT ONE]</option>";
        // Append Empty options to secondary and tertiary select boxes
        $('#bsecondary').empty().append(str);
        $('#btertiary').empty().append(str);
        ids.forEach(function (entry) {

            var value = $('#' + entry).attr('value'); // Get value of selected option box
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == secondary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != tertiary) {
                    $('#bsecondary').append(str1);
                }
                if (entry == tertiary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != secondary) {
                    $('#btertiary').append(str2);
                }
            }
        });
        is_primary_set = true;
        updateHiddens();
    }

    function updateSelects2(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var primary = $('#bprimary').val();
        var tertiary = $('#btertiary').val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        $('#bprimary').empty().append(str);
        $('#btertiary').empty().append(str);
        ids.forEach(function (entry) {
            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == primary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != tertiary) {
                    $('#bprimary').append(str1);
                }
                if (entry == tertiary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != primary) {
                    $('#btertiary').append(str2);
                }
            }
        });
        updateHiddens();
    }

    function updateSelects3(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        $('#bprimary').empty().append(str);
        $('#bsecondary').empty().append(str);
        ids.forEach(function (entry) {
            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == primary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != secondary) {
                    $('#bprimary').append(str1);
                }
                if (entry == secondary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != primary) {
                    $('#bsecondary').append(str2);
                }
            }
        });
        updateHiddens();
    }

    function updateHiddens() {

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var tertiary = $('#btertiary').val();
        var value1 = $('#' + primary).attr('value');
        var value2 = $('#' + secondary).attr('value');
        var value3 = $('#' + tertiary).attr('value');
        //alert(value1 + value2 + value3);
        $('#primary_sector').val(value1);
        $('#secondary_sector').val(value2);
        $('#tertiary_sector').val(value3);
    }

    $(function () {

        $('.business_cycle').on('ifChecked', function (event) {		// If we just checked a checkbox

            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count
            toggleChecks(orig_counter); // disable or enable checkboxes if greater than 5
        });
        $('.business_cycle').on('ifUnchecked', function (event) {		// If we just unchecked a checkbox


            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count
            toggleChecks(orig_counter); // disable or enable checkboxes if greater than 5


            if (orig_counter <= 0) {
                is_primary_set = false; // If All checkboxes unchecked then primary should be reset if secondary is empty
            }
        });
        $('.business_cycle').on('ifClicked', function (event) {

            //var orig_counter = $('input[name="bsectors"]:checked').size();

            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count

            // get number of checked checkboxes

            var id = $(this).attr('id'); //	get ID of current checkbox
            var value = $(this).attr('value'); // get value of current checkbox
            var chk = $('#' + id).prop("checked"); // get state of current checkbox

            updateChecks(id); // update the selects

            if (chk == false) {
                var counter = orig_counter + 1;
            } else {
                var counter = orig_counter - 1;
            }

            var str = "<option value = '" + value + "'>" + value + "</option>"; // Create Option

            $('#bprimary option[value="' + value + '"]').remove();
            $('#bsecondary option[value="' + value + '"]').remove();
            $('#btertiary option[value="' + value + '"]').remove();


            if (counter < 1) {	// if No Checkbox is selected
                // Hide all Select boxes
                $('#primary-business').css("display", 'none');
                $('#secondary-business').css("display", 'none');
                $('#tertiary-business').css("display", 'none');
                $('#selectMessage').css("display", 'none');
            } else {
                if (counter == 1) {	// Only One Checkbox is selected
                    // Primary Select Box is displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'none');
                    $('#tertiary-business').css("display", 'none');
                    $('#selectMessage').css("display", 'block');
                    var str_prime = "<option value = '" + value + "' selected = 'selected'>" + value + "</option>"; // Create Option for primary select box

                    if (chk == false) {	// If Checkbox is checked
                        $('#bprimary').append(str_prime); // Append the value to Primary Select box
                    } else {
                        $("#bprimary option[value='" + value + "']").remove(); // Remove the value from Primary Select box
                    }
                }
                else if (counter == 2) {	// 2 Checkboxes are selected
                    // Primary and Secondary select boxes are displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'block');
                    $('#tertiary-business').css("display", 'none');
                    $('#selectMessage').css("display", 'block');
                    if (chk == false) {
                        // Append values to both Primary and Secondary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                    } else {
                        // Remove values from both Primary and Secondary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                    }

                }
                else if (counter == 3) {	// 3 Checkboxes are selected
                    // Primary, Secondary and Tertiary Select boxes are displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'block');
                    $('#tertiary-business').css("display", 'block');
                    $('#selectMessage').css("display", 'block');
                    if (chk == false) {
                        // Append values to Primary, Secondary and Tertiary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                        $('#btertiary').append(str);
                    } else {
                        // Remove values from Primary, Secondary and Tertiary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                        $("#btertiary option[value='" + value + "']").remove();
                    }
                }
                else {	// More than 3 Checkboxes are selected
                    if (chk == false) {
                        // Append values to Primary, Secondary and Tertiary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                        $('#btertiary').append(str);
                    } else {
                        // Remove values from Primary, Secondary and Tertiary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                        $("#btertiary option[value='" + value + "']").remove();
                    }
                }
            }

        });
    });
</script>



<div class="container">
<div class="space">
						  <?php
          $attributes = array('class' => 'form-horizontal validation');
          echo form_open('join/profileCreate', $attributes);
          ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Company Details</h2>
                </div>
                <div class="ibox-content">
                    <?php
                    $title = $this->session->flashdata('register_title');

                    if ($title == 'registered_not_activated' || $title == 'registered_activated') {

                        echo '<div class="alert alert-warning">' . $this->session->flashdata('message') . '</div>';
                    }

                    ?>

                    <div class="form-group"><label class="col-md-3 control-label">Company Name
                            <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Company Number</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">VAT/Tax Number</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="vat_tax">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 1 <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address_line_1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 2</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address_line_2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Town/City <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="town_city" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">County <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="county" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postal/Zip Code <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="post_code" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-md-3 control-label">Country
                            <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            $this->load->module('country');
                            $this->country->select_country();
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone Number <span style="color:red">*</span></label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_phone();
                            ?>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="telephone_number" required>
                        </div>
                    </div>

                    <?php
                    //$other_business = explode(',', $company->other_business);
                    //$other_business1 = isset($other_business[0]) ? trim($other_business[0]) : '';
                    //$other_business2 = isset($other_business[1]) ? trim($other_business[1]) : '';

                    //                    echo "<pre>";
                    //                    print_r($company);
                    //                    echo "</pre>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Business Sectors <span style="color:red">*</span><br/>
                            <small class="text-navy">Select up to 5</small>
                        </label>

                        <div class="col-md-4">
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'New Mobiles (Sim Free)' || $company->business_sector_2 == 'New Mobiles (Sim Free)' || $company->business_sector_3 == 'New Mobiles (Sim Free)' || $other_business1 == 'New Mobiles (Sim Free)' || $other_business2 == 'New Mobiles (Sim Free)')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="New Mobiles (Sim Free)" name="bsectors[]" id="bsectors1"
                                        class='business_cycle'> <i></i> New Mobiles (Sim Free) </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'New Mobiles (Network Stocks)' || $company->business_sector_2 == 'New Mobiles (Network Stocks)' || $company->business_sector_3 == 'New Mobiles (Network Stocks)' || $other_business1 == 'New Mobiles (Network Stocks)' || $other_business2 == 'New Mobiles (Network Stocks)')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="New Mobiles (Network Stocks)" name="bsectors[]"
                                        id="bsectors2" class='business_cycle'> <i></i> New Mobiles (Network Stocks)
                                </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == '14 Day Mobiles' || $company->business_sector_2 == '14 Day Mobiles' || $company->business_sector_3 == '14 Day Mobiles' || $other_business1 == '14 Day Mobiles' || $other_business2 == '14 Day Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="14 Day Mobiles" name="bsectors[]" id="bsectors3"
                                        class='business_cycle'> <i></i> 14 Day Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Refurbished Mobiles' || $company->business_sector_2 == 'Refurbished Mobiles' || $company->business_sector_3 == 'Refurbished Mobiles' || $other_business1 == 'Refurbished Mobiles' || $other_business2 == 'Refurbished Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Refurbished Mobiles" name="bsectors[]" id="bsectors4"
                                        class='business_cycle'> <i></i> Refurbished Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Used Mobiles' || $company->business_sector_2 == 'Used Mobiles' || $company->business_sector_3 == 'Used Mobiles' || $other_business1 == 'Used Mobiles' || $other_business2 == 'Used Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Used Mobiles" name="bsectors[]" id="bsectors5"
                                        class='business_cycle'> <i></i> Used Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'BER Mobiles' || $company->business_sector_2 == 'BER Mobiles' || $company->business_sector_3 == 'BER Mobiles' || $other_business1 == 'BER Mobiles' || $other_business2 == 'BER Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="BER Mobiles" name="bsectors[]" id="bsectors6"
                                        class='business_cycle'> <i></i> BER Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Accessories' || $company->business_sector_2 == 'Mobile Accessories' || $company->business_sector_3 == 'Mobile Accessories' || $other_business1 == 'Mobile Accessories' || $other_business2 == 'Mobile Accessories')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Accessories" name="bsectors[]" id="bsectors7"
                                        class='business_cycle'> <i></i> Mobile Accessories </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Wearable Technology' || $company->business_sector_2 == 'Wearable Technology' || $company->business_sector_3 == 'Wearable Technology' || $other_business1 == 'Wearable Technology' || $other_business2 == 'Wearable Technology')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Wearable Technology" name="bsectors[]" id="bsectors8"
                                        class='business_cycle'> <i></i> Wearable Technology </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Bluetooth Products' || $company->business_sector_2 == 'Bluetooth Products' || $company->business_sector_3 == 'Bluetooth Products' || $other_business1 == 'Bluetooth Products' || $other_business2 == 'Bluetooth Products')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Bluetooth Products" name="bsectors[]" id="bsectors9"
                                        class='business_cycle'> <i></i> Bluetooth Products </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Spare Parts' || $company->business_sector_2 == 'Mobile Spare Parts' || $company->business_sector_3 == 'Mobile Spare Parts' || $other_business1 == 'Mobile Spare Parts' || $other_business2 == 'Mobile Spare Parts')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Spare Parts" name="bsectors[]" id="bsectors10"
                                        class='business_cycle'> <i></i> Mobile Spare Parts </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Service and Repair Centre' || $company->business_sector_2 == 'Mobile Service and Repair Centre' || $company->business_sector_3 == 'Mobile Service and Repair Centre' || $other_business1 == 'Mobile Service and Repair Centre' || $other_business2 == 'Mobile Service and Repair Centre')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Service and Repair Centre" name="bsectors[]"
                                        id="bsectors11" class='business_cycle'> <i></i> Mobile Service and Repair Centre
                                </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Network Operator' || $company->business_sector_2 == 'Network Operator' || $company->business_sector_3 == 'Network Operator' || $other_business1 == 'Network Operator' || $other_business2 == 'Network Operator')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Network Operator" name="bsectors[]" id="bsectors12"
                                        class='business_cycle'> <i></i> Network Operator </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Freight Forwarding' || $company->business_sector_2 == 'Freight Forwarding' || $company->business_sector_3 == 'Freight Forwarding' || $other_business1 == 'Freight Forwarding' || $other_business2 == 'Freight Forwarding')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Freight Forwarding" name="bsectors[]" id="bsectors13"
                                        class='business_cycle'> <i></i> Freight Forwarding </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Insurance' || $company->business_sector_2 == 'Insurance' || $company->business_sector_3 == 'Insurance' || $other_business1 == 'Insurance' || $other_business2 == 'Insurance')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Insurance" name="bsectors[]" id="bsectors14"
                                        class='business_cycle'> <i></i> Insurance </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Tablets' || $company->business_sector_2 == 'Tablets' || $company->business_sector_3 == 'Tablets' || $other_business1 == 'Tablets' || $other_business2 == 'Tablets')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Tablets" name="bsectors[]" id="bsectors15"
                                        class='business_cycle'> <i></i> Tablets </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Sim Cards' || $company->business_sector_2 == 'Sim Cards' || $company->business_sector_3 == 'Sim Cards' || $other_business1 == 'Sim Cards' || $other_business2 == 'Sim Cards')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Sim Cards" name="bsectors[]" id="bsectors16"
                                        class='business_cycle'> <i></i> Sim Cards </label></div>
                        </div>

                        <div class="col-md-4">
                            <div id="primary-business">

                                <?php
                                $SelectedBiz = array();
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                ?>
                                <label class="col-md-12">Primary Business <span style="color:red">*</span></label>

                                <select class="form-control m-b bsnssector" required="required" id="bprimary" name="bprimary"
                                        style="float:left"
                                        onchange="updateSelects1(this.value)">
                                    <?php
                                    if (isset($company->business_sector_1)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo (isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_1)) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>
                                        <?php
                                        }
                                        ?>


                                    <?php } else { ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>


                            </div>

                            <div id="secondary-business">


                                <label class="col-md-12">Secondary Business <span style="color:red">*</span></label>
                                <select class="form-control m-b bsnssector" required="required" name="bsecondary" id="bsecondary"
                                        style="float:left"
                                        onchange="updateSelects2(this.value)">
                                    <?php
                                    if (isset($company->business_sector_2)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_2) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>


                            </div>

                            <div id="tertiary-business">
                                <label class="col-md-12">Tertiary Business <span style="color:red">*</span></label>
                                <select class="form-control m-b bsnssector" required="required" name="btertiary" id="btertiary"
                                        style="float:left"
                                        onchange="updateSelects3(this.value)">
                                    <?php
                                    if (isset($company->business_sector_3)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_3) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>
                            </div>


                            <small class="text-navy" id="selectMessage">Please make sure you select in order of actual
                                business relevance as this will affect search results and our dedicated account managers
                                will actively promote your business on your behalf with other suitable companies.
                            </small>
                        </div>
                    </div>


                    <input type="hidden" name="primary_sector" id="primary_sector" value=""/>
                    <input type="hidden" name="secondary_sector" id="secondary_sector" value=""/>
                    <input type="hidden" name="tertiary_sector" id="tertiary_sector" value=""/>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Website</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-globe"></i></span>
                                <input type="text" class="form-control" name="website" type="url">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Skype</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-skype"></i></span>
                                <input type="text" class="form-control" name="skype">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <input type="text" class="form-control" name="facebook">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Twitter</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-twitter"></i></span>
                                <input type="text" class="form-control" name="twitter">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Linkedin</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <input type="text" class="form-control" name="linkedin">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Google +</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-google-plus"></i></span>
                                <input type="text" class="form-control" name="gplus">
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Company Bio</label>

                        <div class="col-md-9">
                            <textarea class="form-control" name="company_profile" id="companybio" rows="5"></textarea>

                            <div id="charNum"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Personal Details</h2>
                </div>
                <div class="ibox-content form-horizontal">
                    <div class="form-group"><label class="col-md-3 control-label">Title <span style="color:red">*</span></label>

                        <div class="col-md-2">
                            <select class="form-control" name="title">
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
                            <input type="text" class="form-control" name="firstname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Company Role <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_role" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Email Address <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile Number</label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_phone();
                            ?>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="mobile_number">
                        </div>


                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Language <span style="color:red">*</span></label>

                        <div class="col-md-4">
                            <?php
                            $this->load->module('language');
                            $this->language->select();
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <div class="row" style="margin-bottom:30px">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="checkbox i-checks"><input type="checkbox" value="terms" name="terms" id="terms" required><label> I agree to the GSM Stock Market terms
                                and conditions </label></div>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-primary" name="submit_form" type="submit" id="submit_form"
                               value="Create Account"/>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<!-- </div> /row -->
</form>

</div>
</div>


<footer>
    <div class="row-responsive second">
        <div class="container">
            <div class="row"
            <div class="col-md-12">
                <p style="margin:15px 0;text-align:center">Copyright 2015 GSM Stock Market.com Limited. Registered in
                    England and Wales. Company No. 07458787</p>
            </div>
        </div>
    </div>
    </div>
</footer>


<!-- checkbox css -->
<link href="../public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

<!-- iCheck -->
<script src="../public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
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
<script src="../public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

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
<style>
    /* INPUTS */
    .inline {
        display: inline-block !important;
    }

    .input-s-sm {
        width: 120px;
    }

    .input-s {
        width: 200px;
    }

    .input-s-lg {
        width: 250px;
    }

    .i-checks {
        padding-left: 0;
    }

    .form-control,
    .single-line {
        background-color: #FFFFFF;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 1px;
        color: inherit;
        display: block;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
        font-size: 14px;
    }

    .form-control:focus,
    .single-line:focus {
        border-color: #1ab394;
    }

    .has-success .form-control {
        border-color: #1ab394;
    }

    .has-warning .form-control {
        border-color: #f8ac59;
    }

    .has-error .form-control {
        border-color: #ed5565;
    }

    .has-success .control-label {
        color: #1ab394;
    }

    .has-warning .control-label {
        color: #f8ac59;
    }

    .has-error .control-label {
        color: #ed5565;
    }

    .input-group-addon {
        background-color: #fff;
        border: 1px solid #E5E6E7;
        border-radius: 1px;
        color: inherit;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        padding: 6px 12px;
        text-align: center;
    }

    .spinner-buttons.input-group-btn .btn-xs {
        line-height: 1.13;
    }

    .spinner-buttons.input-group-btn {
        width: 20%;
    }

    .noUi-connect {
        background: none repeat scroll 0 0 #1ab394;
        box-shadow: none;
    }

    .slider_red .noUi-connect {
        background: none repeat scroll 0 0 #ed5565;
        box-shadow: none;
    }

    /* LINE */
    .hr-line-dashed {
        border-top: 1px dashed #e7eaec;
        color: #ffffff;
        background-color: #ffffff;
        height: 1px;
        margin: 20px 0;
    }  body {background:white}
</style>
</body>
</html>