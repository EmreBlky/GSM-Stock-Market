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
                            <h5>Company Details</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Company Name</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label">Company Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>     
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">VAT/Tax Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" >
                                        <span class="help-block">e.g GB 029 392 23</span>
                                    </div>  
                                </div>  
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Address Line 1</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label">Address Line 2</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label">Town/City</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>     
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">County</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Postal/Zip Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>   
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Country</label>

                                    <div class="col-sm-10"><select class="form-control m-b" name="country">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
                                    </div>
                                </div>    
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Website</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label">Skype</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <div class="input-group m-b"><span class="input-group-addon">http://www.facebook.com/</span>  
                                        <?php

                                            if($member->skype){

                                                $data = array(
                                                            'name'        => 'facebook',
                                                        	'class'          => 'form-control',
                                                            'value'     => $member->skype,     
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
                                    <label class="col-sm-2 control-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <div class="input-group m-b"><span class="input-group-addon">@</span>  
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
						</div>
                        </div>
                                
                                
           <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Personal Details</h5>
                        </div>
                        <div class="ibox-content form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
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
                                        ?></div>
                                </div>  
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>     
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" >
                                    </div>  
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" >
                                    </div>  
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Language</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" >
                                        <span class="help-block">e.g GB 029 392 23</span>
                                    </div>  
                                </div>
						</div>
                                
                                <!-- 
                                
                                
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Help text</label>
                                    <div class="col-sm-10"><input type="text" class="form-control"> <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10"><input type="password" class="form-control" name="password"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Placeholder</label>

                                    <div class="col-sm-10"><input type="text" placeholder="placeholder" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label">Disabled</label>

                                    <div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label">Static control</label>

                                    <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes and radios <br/>
                                    <small class="text-navy">Normal Bootstrap elements</small></label>

                                    <div class="col-sm-10">
                                        <div class="checkbox"><label> <input type="checkbox" value=""> Option one is this and that&mdash;be sure to include why it's great </label></div>
                                        <div class="radio"><label> <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one is this and that&mdash;be sure to
                                            include why it's great </label></div>
                                        <div class="radio"><label> <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Option two can be something else and selecting it will
                                            deselect option one </label></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                                    <div class="col-sm-10"><label class="checkbox-inline"> <input type="checkbox" value="option1" id="inlineCheckbox1"> a </label> <label class="checkbox-inline">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2"> b </label> <label class="checkbox-inline">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3"> c </label></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes &amp; radios <br/><small class="text-navy">Custom elements</small></label>

                                    <div class="col-sm-10">
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value=""> <i></i> Option one </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" checked=""> <i></i> Option two checked </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" disabled="" checked=""> <i></i> Option three checked and disabled </label></div>
                                        <div class="checkbox i-checks"><label> <input type="checkbox" value="" disabled=""> <i></i> Option four disabled </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" value="option1" name="a"> <i></i> Option one </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="option2" name="a"> <i></i> Option two checked </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" disabled="" checked="" value="option2"> <i></i> Option three checked and disabled </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" disabled="" name="a"> <i></i> Option four disabled </label></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                                    <div class="col-sm-10"><label class="checkbox-inline i-checks"> <input type="checkbox" value="option1">a </label>
                                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="option2"> b </label>
                                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="option3"> c </label></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Select</label>

                                    <div class="col-sm-10"><select class="form-control m-b" name="account">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>

                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-success"><label class="col-sm-2 control-label">Input with success</label>

                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-warning"><label class="col-sm-2 control-label">Input with warning</label>

                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group has-error"><label class="col-sm-2 control-label">Input with error</label>

                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Control sizing</label>

                                    <div class="col-sm-10"><input type="text" placeholder=".input-lg" class="form-control input-lg m-b">
                                        <input type="text" placeholder="Default input" class="form-control m-b"> <input type="text" placeholder=".input-sm" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Column sizing</label>

                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-2"><input type="text" placeholder=".col-md-2" class="form-control"></div>
                                            <div class="col-md-3"><input type="text" placeholder=".col-md-3" class="form-control"></div>
                                            <div class="col-md-4"><input type="text" placeholder=".col-md-4" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Input groups</label>

                                    <div class="col-sm-10">
                                        <div class="input-group m-b"><span class="input-group-addon">@</span> <input type="text" placeholder="Username" class="form-control"></div>
                                        <div class="input-group m-b"><input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                                        <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                                        <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control"></div>
                                        <div class="input-group"><span class="input-group-addon"> <input type="radio"> </span> <input type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Button addons</label>

                                    <div class="col-sm-10">
                                        <div class="input-group m-b"><span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">Go!</button> </span> <input type="text" class="form-control">
                                        </div>
                                        <div class="input-group"><input type="text" class="form-control"> <span class="input-group-btn"> <button type="button" class="btn btn-primary">Go!
                                        </button> </span></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">With dropdowns</label>

                                    <div class="col-sm-10">
                                        <div class="input-group m-b">
                                            <div class="input-group-btn">
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                             <input type="text" class="form-control"></div>
                                        <div class="input-group"><input type="text" class="form-control">

                                            <div class="input-group-btn">
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Segmented</label>

                                    <div class="col-sm-10">
                                        <div class="input-group m-b">
                                            <div class="input-group-btn">
                                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                            <input type="text" class="form-control"></div>
                                        <div class="input-group"><input type="text" class="form-control">

                                            <div class="input-group-btn">
                                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        
        
        
        
        
        
        
        
        
        
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
        
        

   <!-- Input Mask-->
    <script src="public/main/js/plugins/jasny/jasny-bootstrap.min.js"></script>