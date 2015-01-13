
<div>
    <div>

        <h1 class="logo-name">IN+</h1>

    </div>
    <h3>Welcome to IN+</h3>
    <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
        <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
    </p>
    <p>Login in. To see it in action.</p>
    <?php echo form_open('login/login_validation'); ?>
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
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
    <?php echo form_close(); ?>
        <a href="login/forgotten_password"><small>Forgot password?</small></a>
        <p class="text-muted text-center"><small>Do not have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="register/">Create an account</a>
        <?php if(isset($error)){echo $error;} ?>
    <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
</div>