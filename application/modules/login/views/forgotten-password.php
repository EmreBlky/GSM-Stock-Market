
<div>
    <div>

        <h1 class="logo-name">IN+</h1>

    </div>
    <h3>Welcome to IN+</h3>
    <p>Please complete the form below with your email address.</p>
    <?php echo form_open('login/password_validation'); ?>
        <div class="form-group">
            <?php

            $data = array(
                            'name'          => 'email',
                            'class'         => 'form-control',
                            'placeholder'   => 'Email Adress',
                            'value'         => $this->input->post('email'),
                            'required'      => 'required'
                          );

              echo form_input($data);
        ?>
        </div>
        
        <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
    <?php echo form_close(); ?>
        <p>Alternatively, if you remember your username and password.</p>
        <a class="btn btn-sm btn-white btn-block" href="login/">Login</a>
    <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
</div>