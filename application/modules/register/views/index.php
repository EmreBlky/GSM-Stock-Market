<div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>
            <?php echo form_open('register/validate'); ?>
                <div class="form-group">
                    <?php

                        $data = array(
                                        'name'          => 'firstname',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'First Name',
                                        'value'         => $this->input->post('firstname'),
                                        'required'      => 'required'
                                      );

                          echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php

                        $data = array(
                                        'name'          => 'lastname',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Surname',
                                        'value'         => $this->input->post('lastname'),
                                        'required'      => 'required'
                                      );

                          echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $this->input->post('email');?>" required="required">
                </div>
                <div class="form-group">
                    <?php

                        $data = array(
                                        'name'          => 'password',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Password',
                                        'required'      => 'required'
                                      );

                          echo form_password($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php

                        $data = array(
                                        'name'          => 'c_password',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Confirm Password',
                                        'required'      => 'required'
                                      );

                          echo form_password($data);
                    ?>
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login/">Login</a>
            <?php echo form_close(); ?>
            <?php if(isset($error)){echo $error;} ?>
            <?php if(isset($duplicate)){echo $duplicate;} ?>
            <?php echo $this->session->flashdata('message');?>    
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>