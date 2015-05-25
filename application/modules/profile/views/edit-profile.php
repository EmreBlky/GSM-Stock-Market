<?php
//echo '<pre>';
//print_r($events);
//exit;
//echo "<pre>";
//print_r($company);
//echo "</pre>";
//echo $admin_id;
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
<?php if($this->session->userdata('members_id') == 5 || $this->session->userdata('members_id') == $admin_id){ ?>
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

<?php } ?>
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
        $('.confirm-div-company').hide();
        $('.confirm-div-personal').hide();
        <?php if ($this->session->flashdata('msg_company')) { ?>
        $('.confirm-div-company').html('<?php echo $this->session->flashdata('msg_company'); ?>').show();
        <?php } ?>;
        <?php if ($this->session->flashdata('msg_personal')) { ?>
        $('.confirm-div-personal').html('<?php echo $this->session->flashdata('msg_personal'); ?>').show();
        <?php } ?>;
    });</script>
<?php
$attributes = array('class' => 'form-horizontal validation', 'onsubmit' => 'return validate_info()');
echo form_open_multipart('profile/profileEdit', $attributes);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>View Profile</h2>
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
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Completion (<?php echo $member->profile_completion; ?>%)</h5>
                </div>
                <div class="ibox-content">
                    <div class="progress progress-bar-default">
                        <div style="width: <?php echo $member->profile_completion; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar <?php if($member->profile_completion < 71){ ?>progress-bar-danger
							<?php } elseif($member->profile_completion > 70 && $member->profile_completion < 81) { ?>progress-bar-warning
							<?php } elseif($member->profile_completion > 80 && $member->profile_completion < 91) { ?>progress-bar-success
							<?php } elseif($member->profile_completion > 99) { ?>progress-bar-primary
                            <?php } ?>">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <?php if(isset($support_edit)){ echo '<div style="margin:0 15px">    
                                                                <div class="alert alert-warning">
                                                                    *** WARNING *** Support Edit Enabled
                                                                </div>
                                                            </div>';}?>
    
    <div class="row" <?php if($this->session->userdata('members_id') != 5 && $this->session->userdata('members_id') != $admin_id) {echo 'style="display:none;"';}?> >
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Company Details</h5>
                </div>
                <div class="ibox-content">
                    <?php
                    
                        $attributes = array('class' => 'form-horizontal validation', 'onsubmit' => 'return validate_info()');
                        echo form_open('profile/profileEdit', $attributes);
                    ?>

                    <div class="form-group"><label class="col-md-3 control-label">Company Name <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($company->company_name) {

                                $data = array(
                                    'name' => 'company_name',
                                    'class' => 'form-control',
                                    'value' => $company->company_name,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'company_name',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('company_name'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Company Number</label>

                        <div class="col-md-9">
                            <?php
                            if ($company->company_number) {

                                $data = array(
                                    'name' => 'company_number',
                                    'class' => 'form-control',
                                    'value' => $company->company_number,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'company_number',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('company_number')
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">VAT/Tax Number</label>

                        <div class="col-md-9">
                            <?php
                            if ($company->vat_tax) {

                                $data = array(
                                    'name' => 'vat_tax',
                                    'class' => 'form-control',
                                    'data-mask' => 'aa 999 999 99',
                                    'value' => $company->vat_tax,
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'vat_tax',
                                    'class' => 'form-control',
                                    'data-mask' => 'aa 999 999 99',
                                    'value' => $this->input->post('vat_tax')
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 1 <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($company->address_line_1) {

                                $data = array(
                                    'name' => 'address_line_1',
                                    'class' => 'form-control',
                                    'value' => $company->address_line_1,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'address_line_1',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('address_line_1'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 2</label>

                        <div class="col-md-9">
                            <?php
                            if ($company->address_line_2) {

                                $data = array(
                                    'name' => 'address_line_2',
                                    'class' => 'form-control',
                                    'value' => $company->address_line_2,
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'address_line_2',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('address_line_2'),
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Town/City <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($company->town_city) {

                                $data = array(
                                    'name' => 'town_city',
                                    'class' => 'form-control',
                                    'value' => $company->town_city,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'town_city',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('town_city'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">County <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($company->county) {

                                $data = array(
                                    'name' => 'county',
                                    'class' => 'form-control',
                                    'value' => $company->county,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'county',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('county'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postal/Zip Code <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            if ($company->post_code) {

                                $data = array(
                                    'name' => 'post_code',
                                    'class' => 'form-control',
                                    'value' => $company->post_code,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'post_code',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('post_code'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-md-3 control-label">Country <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <?php
                            $this->load->module('country');
                            $this->country->select_country($member->id);
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-md-3 control-label">Currency <span style="color:red">*</span></label>
                        <div class="col-md-3" style="padding-right:0">
                            <select class="form-control m-b" name="currency">
                                <?php if($company->currency == 'GBP'){ ?>
                                    <option value="<?php echo $company->currency?>" selected>GBP - British Pound (&pound;)</option>
                                	<option value="USD">USD - US Dollar ($)</option>
                                	<option value="EURO">EUR - Euro (&euro;)</option>   
                                <?php } elseif($company->currency == 'USD') {?>
                                	<option value="GBP">GBP - British Pound (&pound;)</option>
                                    <option value="<?php echo $company->currency?>" selected>USD - US Dollar ($)</option>
                               		<option value="EURO">EUR - Euro (&euro;)</option>  
                                <?php } else { ?>
                                	<option value="GBP">GBP - British Pound (&pound;)</option>
                                	<option value="USD">USD - US Dollar ($)</option>
                                    <option value="<?php echo $company->currency?>" selected>EUR - Euro (&euro;)</option>
                                <?php } ?>                                                                                            
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone Number <span style="color:red">*</span></label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_phone($member->id);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if ($company->phone_number) {

                                $data = array(
                                    'name' => 'telephone_number',
                                    'class' => 'form-control',
                                    'value' => $company->phone_number,
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            } else {

                                $data = array(
                                    'name' => 'telephone_number',
                                    'class' => 'form-control',
                                    'value' => $this->input->post('telephone_number'),
                                    'required' => 'required'
                                );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>
                    <!-- DYNAMO LOGIC - THIS IS EXAMPLE CODE I TRIED
                    <script type="text/javascript">
                                                    $(function() {
                                                            $( 'input[name=bsectors]' ).on( 'change', function() {
                                                                    var sel = $('#bprimary'), opt = $( '<option/>' );
                                                                    sel.html( opt.clone().text( '[Select One]' ) );
                                                                    $( 'input[name=besectors]:checked' ).each( function() {
                                                                            sel.append( opt.clone().text( this.value ) );
                                                                    });
                                                                    if( sel.find( 'option' ).length > 1 ) {
                                                                            $( '#primary-business' ).show();
                                                                            if( sel.find( 'option' ).length === 2 ) {
                                                                                    sel.find( 'option' ).eq( 1 ).attr( 'selected',true );
                                                                            }
                                                                    } else {
                                                                            $( '#primary-business' ).hide();
                                                                    }
                                                            });
                                                    });
                                                    </script>
                    -->

                    <?php
                    $other_business = explode(',', $company->other_business);
                    $other_business1 = isset($other_business[0]) ? trim($other_business[0]) : '';
                    $other_business2 = isset($other_business[1]) ? trim($other_business[1]) : '';

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

                        <?php require_once __DIR__."/snippets/primary_business_select.php" ?>

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
                                <?php
                                if ($company->website) {

                                    $data = array(
                                        'name' => 'website',
                                        'class' => 'form-control',
                                        'value' => $company->website,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'website',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('website')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Skype</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-skype"></i></span>
                                <?php
                                if ($member->skype) {

                                    $data = array(
                                        'name' => 'skype',
                                        'class' => 'form-control',
                                        'value' => $member->skype,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'skype',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('skype')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <?php
                                if ($member->facebook) {

                                    $data = array(
                                        'name' => 'facebook',
                                        'class' => 'form-control',
                                        'value' => $member->facebook,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'facebook',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('facebook')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Twitter</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-twitter"></i></span>
                                <?php
                                if ($member->twitter) {

                                    $data = array(
                                        'name' => 'twitter',
                                        'class' => 'form-control',
                                        'value' => $member->twitter,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'twitter',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('twitter')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Linkedin</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <?php
                                if ($member->linkedin) {

                                    $data = array(
                                        'name' => 'linkedin',
                                        'class' => 'form-control',
                                        'value' => $member->linkedin,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'linkedin',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('linkedin')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Google +</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-google-plus"></i></span>
                                <?php
                                if ($member->gplus) {

                                    $data = array(
                                        'name' => 'gplus',
                                        'class' => 'form-control',
                                        'value' => $member->gplus,
                                    );

                                    echo form_input($data);
                                } else {

                                    $data = array(
                                        'name' => 'gplus',
                                        'class' => 'form-control',
                                        'value' => $this->input->post('gplus')
                                    );

                                    echo form_input($data);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        
                        <?php if($bio_count > 0) {?>
                        
                            <label class="col-md-3 col-md-4 control-label">Company Bio</label>
                            
                            <span class="label label-warning">Company Bio awaiting approval.</span>
                            
                        <?php } else {?>
                            
                            <label class="col-md-3 col-md-4 control-label">Company Bio</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" id="companybio" name="company_profile"><?php echo strip_tags($company->company_profile); ?></textarea>

                                <div id="charNum"></div>
                            </div>
                            
                        <?php }?>
                        
                    </div>                    

                </div>
            </div>
        </div>
        <?php echo form_close() ?>

        <div class="col-lg-4" >
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Company Photo</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="confirm-div-company"></div>
                        <div class="col-md-12" style="text-align:center; display: none">
                            <?php if (file_exists("public/main/template/gsm/images/company/" . $member->company_id . ".png")) { ?>
                                <img
                                    src="public/main/template/gsm/images/company/<?php echo $member->company_id; ?>.png">
                            <?php } else { ?>
                                <img src="public/main/template/gsm/images/company/no_company.jpg" width="300"
                                     height="150">
                            <?php } ?>
                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top:20px; display: none">
                            <div class="btn-group">
                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                    <!-- <input type="file" accept="image" multiple name="userfile[]"/>Upload new -->
                                    image</label>
                                <label class="btn btn-danger">Delete</label>
                            </div>
                        </div>
                        <p class="small" style="text-align:center; display:none">Company profile image should be no
                            smaller than 300px
                            width x 150px height.<br/>Company Images are scaled twice the width of the height.</p>
                        <!-- Hammad sibtain Crop Functionality -->
                        
                        <div class="col-md-10 col-md-offset-1">
                        
                        <div class="containers" id="crop-avatar">

                            <!-- Current avatar -->
                            <div class="avatar-view" title="Change the avatar">
                                <?php if (file_exists("public/main/template/gsm/images/company/" . $member->company_id . ".png")) { ?>
                                    <img
                                        src="public/main/template/gsm/images/company/<?php echo $member->company_id; ?>.png" onload="$('.loading').hide()">
                                <?php } else { ?>
                                    <img src="public/main/template/gsm/images/company/no_company.jpg" onload="$('.loading').hide()" >
                                <?php } ?>
                            </div>
                            
                            
                            
                            <div style="margin-top: 10px;">
                                <label class="btn btn-danger mt-md pull-right" id="deleteCompanyImage">Delete</label>
                                <label class="btn btn-primary pull-left" id="changeCompanyImage">Upload</label>
                            </div>
                            <!-- Cropping modal -->
                            <?php require_once __DIR__."/snippets/cropping_modal.php" ?>
                            <!-- /.modal -->

                            <!-- Loading state -->
                            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                        </div>
                        <!-- /Hammad sibtain Crop Functionality -->
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Events Attending</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if($events_count > 0) {?>
                            
                            <?php if($events) {?>
                            
                            <?php foreach($events as $event) {?>
                            
                            <?php
                            
                                //$attending = $this->attending_model->get_where_multiple('event_id', $event->id, 'member_id', $this->session->userdata('members_id'))->id;
                                $att_count = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE member_id = '".$this->session->userdata('members_id')."' AND event_id = '".$event->id."'");
                                
                            ?>

                            <div class="form-group">                        
                                <div class="col-md-12 text-center">
                                    <label class="col-md-12"><?php echo $event->name; ?><br />
                                        <small class="text-navy"><?php echo $event->location; ?>, <?php echo $event->venue; ?> - <?php echo $event->date; ?></small>
                                    </label>
                                    <br />
                                    <?php if($att_count[0]->count > 0) {?>
                                        <div class="radio-inline i-checks small"><label> <input type="radio" value="attending" name="<?php echo $event->id; ?>" checked=""> <i></i> Attending </label></div>
                                        <div class="radio-inline i-checks small"><label> <input type="radio" value="not_attending" name="<?php echo $event->id; ?>"> <i></i> Not Attending </label></div>
                                    <?php } else {?>
                                        <div class="radio-inline i-checks small"><label> <input type="radio" value="attending" name="<?php echo $event->id; ?>"> <i></i> Attending </label></div>
                                        <div class="radio-inline i-checks small"><label> <input type="radio" value="not_attending" name="<?php echo $event->id; ?>" checked=""> <i></i> Not Attending </label></div>
                                    <?php }?>
                                </div>                        
                            </div>

                            <div class="hr-line-dashed"></div>
                            
                            <?php } ?>
                            
                            <?php } else {?>
                            
                                <div class="form-group">                        
                                    <div class="col-md-12 text-center">
                                        <label class="col-md-12">NO EVENTS</label>
                                    </div>
                                </div>
                            
                            <?php } ?>
                            
                            <?php } else { ?>
                            
                                <div class="form-group">                        
                                    <div class="col-md-12 text-center">
                                        <label class="col-md-12">NO EVENTS</label>
                                    </div>
                                </div>
                            
                            <?php }?>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Personal Details</h5>
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


        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Personal Photo</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="confirm-div-personal"></div>
                        <div class="col-md-12" style="text-align:center; display: none;">
                            <?php if (file_exists("public/main/template/gsm/images/members/" . $member->id . ".jpg")) { ?>
                                <img src="public/main/template/gsm/images/members/<?php echo $member->id; ?>.jpg" >
                            <?php } else { ?>
                                <img src="public/main/template/gsm/images/members/no_profile.jpg"  />
                            <?php } ?>

                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top:20px; display: none">
                            <div class="btn-group">
                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                    <!-- <input type="file" accept="image" multiple name="userfile[]"/>Upload new -->
                                    image</label>
                                <label class="btn btn-danger">Delete</label>
                            </div>
                        </div>
                        <p class="small" style="text-align:center; display: none;">Personal profile image should be no
                            smaller than
                            150px width x 150px height.<br/>Personal images are scaled 1:1 ratio.</p>

                        
                        <div class="col-md-8 col-md-offset-2">

                        <!-- Cropper -->
                        <div class="containers" id="crop-avatar1">

                            <!-- Current avatar -->
                            <div class="avatar-view" title="Change the avatar">
                                <?php if (file_exists("public/main/template/gsm/images/members/" . $member->id . ".png")) { ?>
                                    <img src="public/main/template/gsm/images/members/<?php echo $member->id; ?>.png" onload="$('.loading').hide()">
                                <?php } else { ?>
                                    <img src="public/main/template/gsm/images/members/no_profile.jpg" onload="$('.loading').hide()" />
                                <?php } ?>
                            </div>
                            <div style="margin-top: 10px;">
                                <label class="btn btn-danger mt-md pull-right" id="deleteMemberImage">Delete</label>
                                <label class="btn btn-primary pull-left" id="changeMemberImage">Upload</label>
                            </div>

                            <!-- Cropping modal -->
                            <?php require_once __DIR__."/snippets/cropping_modal_profile_pic.php" ?>
                            <!-- /.modal -->

                            <!-- Loading state -->
                            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                        </div>
                        <!-- /Cropper -->
                        <?php
                        if(isset($support_edit)){
                        ?>                        
                            <input type="hidden" name="support_edit" value="<?php echo $mid; ?>"/>                        
                        <?php                        
                        }  
                        ?>
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
            radioClass: 'iradio_square-green'
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