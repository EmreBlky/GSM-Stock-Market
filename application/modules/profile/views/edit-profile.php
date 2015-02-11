	
<?php

//echo '<pre>';
//print_r($country);
//exit;

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
					$attributes = array('class' => 'form-horizontal validation');
					echo form_open('profile/profileEdit', $attributes);
							?>
                            	<div class="form-group"><label class="col-md-3 control-label">Company Name</label>
                                    <div class="col-md-9">
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
                                        ?>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Company Number</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 col-md-4 control-label">VAT/Tax Number</label>
                                    <div class="col-md-9">
                                        <?php

                                            if($company->vat_tax){

                                                $data = array(
                                                            'name'        => 'vat_tax',
                                                        	'class'          => 'form-control',
															'data-mask'		=> 'aa 999 999 99',
                                                            'value'     => $company->vat_tax,     
                                                            'required'  => 'required'
                                                          );

                                                echo form_input($data);

                                            }
                                            else{

                                                $data = array(
                                                        'name'        => 'vat_tax',
                                                        'class'          => 'form-control',
														'data-mask'		=> 'aa 999 999 99',
                                                        'value'     => $this->input->post('vat_tax')
                                                      );

                                                echo form_input($data);
                                            }
                                        ?>
                                    </div>  
                                </div>  
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address Line 1</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Address Line 2</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Town/City</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">County</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Postal/Zip Code</label>
                                    <div class="col-md-9">
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
                                
                                <div class="form-group"><label class="col-md-3 control-label">Country</label>

                                    <div class="col-md-9">                                       
                                    <?php
                                        $this->load->module('country');
                                        $this->country->select_country($member->id);
                                    ?>
                                    </div>
                                </div>    
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone Number</label>
                                    <div class="col-md-3" style="padding-right:0">
                                    <?php
                                        $this->load->module('country');
                                        $this->country->select_phone($member->id);
                                    ?>
                                    </div>
                                    <div class="col-md-6">
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
                                
                                <div class="form-group">
                                	<label class="col-md-3 control-label">Business Sectors <br/><small class="text-navy">Select up to 5</small></label>
									<div class="col-md-4">
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="New Mobiles (Sim Free)" name="bsectors"> <i></i> New Mobiles (Sim Free) </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="New Mobiles (Network Stocks)" name="bsectors"> <i></i> New Mobiles (Network Stocks) </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="14 Day Mobiles" name="bsectors"> <i></i> 14 Day Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Refurbished Mobiles" name="bsectors"> <i></i> Refurbished Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Used Mobiles" name="bsectors"> <i></i> Used Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="BER Mobiles" name="bsectors"> <i></i> BER Mobiles </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Mobile Accessories" name="bsectors"> <i></i> Mobile Accessories </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Wearable Technology" name="bsectors"> <i></i> Wearable Technology </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Bluetooth Products" name="bsectors"> <i></i> Bluetooth Products </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Mobile Spare Parts" name="bsectors"> <i></i> Mobile Spare Parts </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Mobile Service and Repair Centre" name="bsectors"> <i></i> Mobile Service and Repair Centre </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Network Operator" name="bsectors"> <i></i> Network Operator </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Freight Forwarding" name="bsectors"> <i></i> Freight Forwarding </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="Insurance" name="bsectors"> <i></i> Insurance </label></div>
                                	</div>
									<div class="col-md-4">
                                    <div id="primary-business">
                                    <label class="col-md-12">Primary Business</label>
                                    <select class="form-control m-b" id="bprimary">
                                        <option>[Select One]</option>
                                    </select>
                                    </div>
                                    <div id="secondary-business">
                                    <label class="col-md-12">Secondary Business</label>
                                    <select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    </div>
                                    <div id="tertiary-business">
                                    <label class="col-md-12">Tertiary Business</label>
                                    <select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    </div>
                                    <small class="text-navy">Please make sure you select in order of actual business relevance as this will affect search results and our dedicated account managers will actively promote your business on your behalf with other suitable companies.</small>
                                	</div>
                               </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Other Sectors<br /><small class="text-navy">List seperated by commas</small></label>
                                    <div class="col-md-9">  
                                        <input type="text" class="form-control" />
                                        <span class="help-block m-b-none">e.g Mobile Phones, Broken LCDs, e.t.c</span>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Website</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Skype</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Facebook</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Twitter</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Linkedin</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Google +</label>
                                    <div class="col-md-9">
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
                                
                                <div class="hr-line-dashed"></div>
                                
                                                            
                                <div class="form-group">
                                    <label class="col-md-3 col-md-4 control-label">Company Bio</label>
                                    <div class="col-md-9">
                                    <textarea class="form-control" rows="5" id="companybio"></textarea>
                                    <div id="charNum"></div>
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
                                <div class="form-group"><label class="col-md-3 control-label">Title</label>
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
                                        <option>Mr.</option>
                                        <option>Mrs.</option>
                                        <option>Miss.</option>
                                        <option>Ms.</option>
                                    </select>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 col-md-4 control-label">Company Role</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 col-md-4 control-label">Email Address</label>
                                    <div class="col-md-9">
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
                                    <label class="col-md-3 control-label">Mobile Number</label>
                                    <div class="col-md-3" style="padding-right:0">
                                    <?php
                                        $this->load->module('country');
                                        $this->country->select_mobile($member->id);
                                    ?>
                                    </div>
                                    <div class="col-md-6">
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
                                    <label class="col-md-3 col-md-4 control-label">Language</label>
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
