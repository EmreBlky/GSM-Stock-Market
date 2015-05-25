<div class="col-md-4">
    <div id="primary-business">

        <?php
        $SelectedBiz = array();
        $SelectedBiz[] = $company->business_sector_1;
        $SelectedBiz[] = $company->business_sector_2;
        $SelectedBiz[] = $company->business_sector_3;
        $SelectedBiz[] = $other_business1;
        $SelectedBiz[] = $other_business2;
        ?>
        <label class="col-md-12">Primary Business <span style="color:red">*</span></label>

        <select class="form-control m-b" id="bprimary" name="bprimary" style="float:left"
                onchange="updateSelects1(this.value)">
            <?php
            if (isset($company->business_sector_1)) {
                foreach ($SelectedBiz As $SelectedBizOne) {
                    if(!empty($SelectedBizOne)){
                        ?>
                        <option
                            value="<?php echo $SelectedBizOne; ?>" <?php echo (isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_1)) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>

                    <?php } ?>
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
        <select class="form-control m-b" name="bsecondary" id="bsecondary" style="float:left"
                onchange="updateSelects2(this.value)">
            <?php
            if (isset($company->business_sector_2)) {
                foreach ($SelectedBiz As $SelectedBizOne) {
                    if(!empty($SelectedBizOne)) {
                        $selected = isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_2) ? ' selected="selected"' : '';
                        ?>
                        <option value="<?php echo $SelectedBizOne; ?>" <?php echo $selected; ?> >
                            <?php echo $SelectedBizOne; ?>
                        </option>
                    <?php
                    }
                }
            } else {
                ?>
                <option value="">[Select One]</option>
            <?php } ?>
        </select>


    </div>

    <div id="tertiary-business">
        <label class="col-md-12">Tertiary Business <span style="color:red">*</span></label>
        <select class="form-control m-b" name="btertiary" id="btertiary" style="float:left"
                onchange="updateSelects3(this.value)">
            <?php
            if (isset($company->business_sector_3)) {
                foreach ($SelectedBiz As $SelectedBizOne) {
                    if(!empty($SelectedBizOne)) {
                        ?>
                        <option
                            value="<?php echo $SelectedBizOne; ?>" <?php echo isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_3) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>

                    <?php
                    }
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