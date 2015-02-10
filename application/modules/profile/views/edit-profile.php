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
    
    

    <link href="public/main/template/core/css/plugins/cropper/cropper.min.css" rel="stylesheet">
            
        <div class="wrapper wrapper-content">
        	<div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Company Details</h5>
                        </div>
                        <div class="ibox-content">
                            <?php 
					$attributes = array('class' => 'form-horizontal');
					echo form_open('profile/profileEdit', $attributes);
							?>
                            	<div class="form-group"><label class="col-md-4 control-label">Company Name</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->company_name){

                                                $data = array(
                                                            'name'        => 'company_name',
                                                            'class'          => 'form-control',
                                                            'value'     => $company->company_name,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'company_name',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('company_name'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }    
                                        ?></div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Company Number</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->company_number){

                                                $data = array(
                                                            'name'        => 'company_number',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->company_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'company_number',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('company_number')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>     
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-md-4 control-label">VAT/Tax Number</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->vat_tax){

                                                $data = array(
                                                            'name'        => 'vat_tax',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->vat_tax,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'vat_tax',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('vat_tax')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>  
                                
                                <div class="hr-line-dashed"></div>
                                
                                <h4 class="col-md-offset-4">Address</h4>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Line 1</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->address_line_1){

                                                $data = array(
                                                            'name'        => 'address_line_1',
                                                            'class'          => 'form-control',
                                                            'value'     => $company->address_line_1,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'address_line_1',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('address_line_1'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Line 2</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->address_line_2){

                                                $data = array(
                                                            'name'        => 'address_line_2',
                                                            'class'          => 'form-control',
                                                            'value'     => $company->address_line_2,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'address_line_2',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('address_line_2'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Town/City</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->town_city){

                                                $data = array(
                                                            'name'        => 'town_city',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->town_city,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'town_city',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('town_city'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>     
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">County</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->county){

                                                $data = array(
                                                            'name'        => 'county',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->county,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'county',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('county'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Postal/Zip Code</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($company->post_code){

                                                $data = array(
                                                            'name'        => 'post_code',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->post_code,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'post_code',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('post_code'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>   
                                
                                <div class="form-group"><label class="col-md-4 control-label">Country</label>

                                    <div class="col-md-8">
                                        <?php

                                            if($company->country){

                                                $data = array(
                                                            'name'        => 'country',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->country,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'country',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('country'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>                                    
                                    <!--
                                    <select class="form-control m-b" name="country">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    -->
                                    </div>
                                </div>    
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Phone Number</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->phone_number){

                                                $data = array(
                                                            'name'        => 'phone_number',
                                                        'class'          => 'form-control',
                                                            'value'     => $member->phone_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'phone_number',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('phone_number'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                	<label class="col-md-4 control-label">Business Sectors <br/><small class="text-navy">Select up to 5</small></label>
									<div class="col-md-4">
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> New Mobiles (Sim Free) </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> New Mobiles (Network Stocks) </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> 14 Day Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Refurbished Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Used Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> BER Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Mobile Accessories </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Wearable Technology </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Bluetooth Products </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Mobile Spare Parts </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Mobile Service and Repair Centre </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Network Operator </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Freight Forwarding </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" name="bsectors"> <i></i> Insurance </label></div>
                                	</div>
									<div class="col-md-4">
                                    <label class="col-md-12">Primary Business</label>
                                    <select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    <label class="col-md-12">Secondary Business</label>
                                    <select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    <label class="col-md-12">Tertiary Business</label>
                                    <select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                	</div>
                               </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Other Sectors<br /><small class="text-navy">List seperated by commas</small></label>
                                    <div class="col-md-8">  
                                        <input type="text" class="form-control" />
                                        <span class="help-block m-b-none">e.g Mobile Phones, Broken LCDs, e.t.c</span>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Website</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon">http://</span> 
                                        <?php

                                            if($company->website){

                                                $data = array(
                                                            'name'        => 'website',
                                                        	'class'          => 'form-control',
                                                            'value'     => $company->website,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'website',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('website')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Skype</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-skype"></i></span> 
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'skype',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->skype,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'skype',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('skype')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>      
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Facebook</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-facebook"></i></span> 
                                        <?php

                                            if($member->facebook){

                                                $data = array(
                                                            'name'        => 'facebook',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->facebook,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'facebook',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('facebook')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Twitter</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-twitter"></i></span>  
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'twitter',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->twitter,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'twitter',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('twitter')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Linkedin</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-linkedin"></i></span>  
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'linkedin',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->linkedin,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'linkedin',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('linkedin')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Google +</label>
                                    <div class="col-md-8">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-google-plus"></i></span>  
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'gplus',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->gplus,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'gplus',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('gplus')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
						</div>
                        </div></div>
                        
                        
                        
                
                        
                        
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Personal Photo</h5>
                        </div>
                        <div class="ibox-content form-horizontal">
                                <div class="form-group">
                        <div class="col-md-6 col-md-offset-3" style="text-align:center">
                                <h4>Preview image</h4>
                                <div class="img-preview img-preview-sm"></div>
                        </div>
                        <div class="col-md-12">
                                <div class="image-crop">                                
                                    <img src="public/main/template/core/img/p3.jpg">
                                </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top:20px">
                        	<div class="btn-group">
                           		<label title="Upload image file" for="inputImage" class="btn btn-primary">
                                	<input type="file" accept="image/*" name="file" id="inputImage" class="hide">Upload new image</label>
                                    <label title="Download image" id="download" class="btn btn-primary">Download</label>
                                    <label title="Revert" id="reset" class="btn btn-danger">Revert Changes</label>
                           	</div>
                        </div>
                        
                        </div>
                   </div>
                
                </div></div>
                                
                                
           <div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Personal Details</h5>
                        </div>
                        <div class="ibox-content form-horizontal">
                                <div class="form-group"><label class="col-md-4 control-label">Title</label>
                                    <div class="col-md-8">
                                        <?php

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
                                        ?>                                 
                                    <!--
                                    <select class="form-control m-b" name="country">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    -->
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">First Name</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->firstname){

                                                $data = array(
                                                            'name'        => 'firstname',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->firstname,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'firstname',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('firstname'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>    
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->lastname){

                                                $data = array(
                                                            'name'        => 'lastname',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->lastname,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'lastname',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('lastname'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-md-4 control-label">Company Role</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->role){

                                                $data = array(
                                                            'name'        => 'role',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->role,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'role',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('role'),     
                                                        'required'  => 'required'
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-md-4 control-label">Email Address</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->email){

                                                $data = array(
                                                            'name'        => 'email',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->email,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                            'name'        => 'email',
                                                        	'class'          => 'form-control',
                                                            'value'     => $this->input->post('email'),     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-md-4 control-label">Mobile Number</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->mobile_number){

                                                $data = array(
                                                            'name'        => 'mobile_number',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->mobile_number,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'mobile_number',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('mobile_number')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-md-4 control-label">Language</label>
                                    <div class="col-md-8">
                                        <?php

                                            if($member->language){

                                                $data = array(
                                                            'name'        => 'language',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->language,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'language',
                                                        'class'          => 'form-control',
                                                        'value'     => $this->input->post('language')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" name="submit_form" type="submit" id="submit_form">Save changes</button>
                                    </div>
                                </div>
                                
						</div>
                        
                        </div></div>
                        
                        
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Personal Photo</h5>
                        </div>
                        <div class="ibox-content form-horizontal">
                                <div class="form-group">
                        <div class="col-md-6 col-md-offset-3" style="text-align:center">
                                <h4>Preview image</h4>
                                <div class="img-preview img-preview-sm"></div>
                        </div>
                        <div class="col-md-12">
                                <div class="image-crop">                                
                                    <img src="public/main/template/core/img/p3.jpg">
                                </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top:20px">
                        	<div class="btn-group">
                           		<label title="Upload image file" for="inputImage" class="btn btn-primary">
                                	<input type="file" accept="image/*" name="file" id="inputImage" class="hide">Upload new image</label>
                                    <label title="Download image" id="download" class="btn btn-primary">Download</label>
                                    <label title="Revert" id="reset" class="btn btn-danger">Revert Changes</label>
                           	</div>
                        </div>
                        
                        </div>
                   </div>
                </div>
                        
                        
                        
                        </div><!-- /row -->
                            <?php echo form_close()?>
        
        
        
        
        
    <!-- checkbox css -->
    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>
           

   	<!-- Input Mask-->
    <script src="public/main/template/core/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Image cropper -->
    <script src="public/main/template/core/js/plugins/cropper/cropper.min.js"></script>

    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 2,
  				autoCropArea: 1, // Center 100%
				multiple: true,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });
			
			$("#reset").click(function() {
			  $image.cropper("reset");
			});
			
            });
    </script>
    
    <script type="text/javascript">
	$(document).ready(function () {
    $("input[name='bsectors']").change(function () {
        var maxAllowed = 5;
        var cnt = $("input[name='bsectors']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum a ' + maxAllowed + ' business sectors');
        }
    });
});
</script>