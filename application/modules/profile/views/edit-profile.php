<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>View Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            My Company
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
            <div class="row animated fadeInRight">
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                            <?php
                            
                                echo '<pre>';
                                print_r($member);
                                echo '</pre>';
                                
                                echo '<pre>';
                                print_r($company);
                                echo '</pre>';
                            
                            ?>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="ibox-content">
                            <?php echo form_open('profile/profileEdit'); ?>
                                <div id="wrapper">
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Email:</label></div>
                                        <?php

                                            if($member->email){

                                                $data = array(
                                                            'name'        => 'email',
                                                            'id'          => 'email',
                                                            'value'     => $member->email,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                            'name'        => 'email',
                                                            'id'          => 'email',
                                                            'value'     => $this->input->post('email'),     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Title:</label></div>
                                        <?php

                                            if($member->title){

                                                $data = array(
                                                            'name'        => 'title',
                                                            'id'          => 'title',
                                                            'value'     => $member->title,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                            'name'        => 'title',
                                                            'id'          => 'title',
                                                            'value'     => $this->input->post('title'),     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>First Name:</label></div>
                                        <?php

                                            if($member->firstname){

                                                $data = array(
                                                            'name'        => 'firstname',
                                                            'id'          => 'firstname',
                                                            'value'     => $member->firstname,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'firstname',
                                                        'id'          => 'firstname',
                                                        'value'     => $this->input->post('firstname'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Surname:</label></div>
                                        <?php

                                            if($member->lastname){

                                                $data = array(
                                                            'name'        => 'lastname',
                                                            'id'          => 'lastname',
                                                            'value'     => $member->lastname,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'lastname',
                                                        'id'          => 'lastname',
                                                        'value'     => $this->input->post('lastname'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Company Name:</label></div>
                                        <?php

                                            if($company->company_name){

                                                $data = array(
                                                            'name'        => 'company_name',
                                                            'id'          => 'company_name',
                                                            'value'     => $company->company_name,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'company_name',
                                                        'id'          => 'company_name',
                                                        'value'     => $this->input->post('company_name'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }    
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Phone:</label></div>
                                        <?php

                                            if($member->phone_number){

                                                $data = array(
                                                            'name'        => 'phone_number',
                                                            'id'          => 'phone_number',
                                                            'value'     => $member->phone_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'phone_number',
                                                        'id'          => 'phone_number',
                                                        'value'     => $this->input->post('phone_number'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Mobile:</label></div>
                                        <?php

                                            if($member->mobile_number){

                                                $data = array(
                                                            'name'        => 'mobile_number',
                                                            'id'          => 'mobile_number',
                                                            'value'     => $member->mobile_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'mobile_number',
                                                        'id'          => 'mobile_number',
                                                        'value'     => $this->input->post('mobile_number')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Address Line 1:</label></div>
                                        <?php

                                            if($company->address_line_1){

                                                $data = array(
                                                            'name'        => 'address_line_1',
                                                            'id'          => 'address_line_1',
                                                            'value'     => $company->address_line_1,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'address_line_1',
                                                        'id'          => 'address_line_1',
                                                        'value'     => $this->input->post('address_line_1'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Address Line 2:</label></div>
                                        <?php

                                            if($company->address_line_2){

                                                $data = array(
                                                            'name'        => 'address_line_2',
                                                            'id'          => 'address_line_2',
                                                            'value'     => $company->address_line_2,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'address_line_2',
                                                        'id'          => 'address_line_2',
                                                        'value'     => $this->input->post('address_line_2')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>City:</label></div>
                                        <?php

                                            if($company->town_city){

                                                $data = array(
                                                            'name'        => 'town_city',
                                                            'id'          => 'town_city',
                                                            'value'     => $company->town_city,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'town_city',
                                                        'id'          => 'town_city',
                                                        'value'     => $this->input->post('town_city'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>County:</label></div>
                                        <?php

                                            if($company->county){

                                                $data = array(
                                                            'name'        => 'county',
                                                            'id'          => 'county',
                                                            'value'     => $company->county,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'county',
                                                        'id'          => 'county',
                                                        'value'     => $this->input->post('county'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Country:</label></div>
                                        <?php

                                            if($company->country){

                                                $data = array(
                                                            'name'        => 'country',
                                                            'id'          => 'country',
                                                            'value'     => $company->country,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'country',
                                                        'id'          => 'country',
                                                        'value'     => $this->input->post('country'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Postcode:</label></div>
                                        <?php

                                            if($company->post_code){

                                                $data = array(
                                                            'name'        => 'post_code',
                                                            'id'          => 'post_code',
                                                            'value'     => $company->post_code,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'post_code',
                                                        'id'          => 'post_code',
                                                        'value'     => $this->input->post('post_code'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Website:</label></div>
                                        <?php

                                            if($company->website){

                                                $data = array(
                                                            'name'        => 'website',
                                                            'id'          => 'website',
                                                            'value'     => $company->website,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'website',
                                                        'id'          => 'website',
                                                        'value'     => $this->input->post('website')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Business Sector 1:</label></div>
                                        <?php

                                            if($company->business_sector_1){

                                                $data = array(
                                                            'name'        => 'business_sector_1',
                                                            'id'          => 'business_sector_1',
                                                            'value'     => $company->business_sector_1,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'business_sector_1',
                                                        'id'          => 'business_sector_1',
                                                        'value'     => $this->input->post('business_sector_1')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Business Sector 2:</label></div>
                                        <?php

                                            if($company->business_sector_2){

                                                $data = array(
                                                            'name'        => 'business_sector_2',
                                                            'id'          => 'business_sector_2',
                                                            'value'     => $company->business_sector_2,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'business_sector_2',
                                                        'id'          => 'business_sector_2',
                                                        'value'     => $this->input->post('business_sector_2')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>VAT Number:</label></div>
                                        <?php

                                            if($company->vat_tax){

                                                $data = array(
                                                            'name'        => 'vat_tax',
                                                            'id'          => 'vat_tax',
                                                            'value'     => $company->vat_tax,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'vat_tax',
                                                        'id'          => 'vat_tax',
                                                        'value'     => $this->input->post('vat_tax')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Company Number:</label></div>
                                        <?php

                                            if($company->company_number){

                                                $data = array(
                                                            'name'        => 'company_number',
                                                            'id'          => 'company_number',
                                                            'value'     => $company->company_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'company_number',
                                                        'id'          => 'company_number',
                                                        'value'     => $this->input->post('company_number')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Language:</label></div>
                                        <?php

                                            if($member->language){

                                                $data = array(
                                                            'name'        => 'language',
                                                            'id'          => 'language',
                                                            'value'     => $member->language,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'language',
                                                        'id'          => 'language',
                                                        'value'     => $this->input->post('language')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Facebook:</label></div>
                                        <?php

                                            if($member->facebook){

                                                $data = array(
                                                            'name'        => 'facebook',
                                                            'id'          => 'facebook',
                                                            'value'     => $member->facebook,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'facebook',
                                                        'id'          => 'facebook',
                                                        'value'     => $this->input->post('facebook')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Twitter:</label></div>
                                        <?php

                                            if($member->twitter){

                                                $data = array(
                                                            'name'        => 'twitter',
                                                            'id'          => 'twitter',
                                                            'value'     => $member->twitter,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'twitter',
                                                        'id'          => 'twitter',
                                                        'value'     => $this->input->post('twitter')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Google +:</label></div>
                                        <?php

                                            if($member->gplus){

                                                $data = array(
                                                            'name'        => 'gplus',
                                                            'id'          => 'gplus',
                                                            'value'     => $member->gplus,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'gplus',
                                                        'id'          => 'gplus',
                                                        'value'     => $this->input->post('gplus')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Linkedin:</label></div>
                                        <?php

                                            if($member->linkedin){

                                                $data = array(
                                                            'name'        => 'linkedin',
                                                            'id'          => 'linkedin',
                                                            'value'     => $member->linkedin,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'linkedin',
                                                        'id'          => 'linkedin',
                                                        'value'     => $this->input->post('linkedin')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Skype:</label></div>
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'skype',
                                                            'id'          => 'skype',
                                                            'value'     => $member->skype,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'skype',
                                                        'id'          => 'skype',
                                                        'value'     => $this->input->post('skype')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                        <div class="lable_wrap"><label>Role:</label></div>
                                        <?php

                                            if($member->role){

                                                $data = array(
                                                            'name'        => 'role',
                                                            'id'          => 'role',
                                                            'value'     => $member->role,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'role',
                                                        'id'          => 'role',
                                                        'value'     => $this->input->post('role'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                    <div class="wrap">
                                    <div class="lable_wrap"><label>&nbsp;</label></div>
                                    <div class="input_wrap"><input name="submit_form" type="submit" id="submit_form"/></div>
                                    </div>
                                </div>
                            <?php echo form_close()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>