<?php //echo $this->uri->segment(1); ?>
<div>
    <?php 
        
        echo $this->session->flashdata('resend');

    ?>
    <div style="margin-bottom:30px">

        <img src="public/main/template/gsm/images/gsm.png">

    </div>
    <h3>Welcome to GSMStockMarket</h3>
    <p>The worlds most innovative B2B trading platform
    </p>
    <?php echo form_open('login/login_validation'); ?>
        <div class="form-group">
            <?php

                $data = array(
                                'name'          => 'username',
                                'class'         => 'form-control',
                                'placeholder'   => 'Email',
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
        <input type="hidden" name="login" value="user"/>
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
    <?php echo form_close(); ?>
        <a href="login/forgotten_password"><small>Forgot password?</small></a>
        <p class="text-muted text-center"><small>Do not have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="join/">Create an account</a>
        <?php if(isset($error)){echo $error;} ?>
    <p class="m-t"> <small>GSMStockMarket.com Limited &copy; <?php echo date("Y");?></small> </p>
</div>

<script>
$( document ).ready(function() {
        var url = '<?php echo $base; ?>/login/';
		$(location).attr('href',url);
    });
</script>
