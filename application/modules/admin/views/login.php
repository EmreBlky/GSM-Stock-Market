
<div>    
    <h2>Admin Login</h2>
    <?php echo form_open('login/admin_login_validation'); ?>
        <div class="form-group">
            <?php

                $data = array(
                                'name'          => 'username',
                                'class'         => 'form-control',
                                'placeholder'   => 'Username',
                                'value'         => $this->input->post('username'),
                                'required'      => 'required'
                              );

                  echo form_input($data);
            ?>
        </div>
        <div class="form-group">
            <?php

                $data = array(
                                'name'        => 'password',
                                'class'       => 'form-control',
                                'placeholder'   => 'Password',
                                'required'    => 'required'
                              );

                  echo form_password($data);
            ?>
        </div>
        <input type="hidden" name="login" value="admin"/>
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
    <?php echo form_close(); ?> 
    <?php if(isset($error)){echo $error;} ?>
</div>