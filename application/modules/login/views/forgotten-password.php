
<div>
    <div style="margin-bottom:30px">

        <img src="public/main/template/gsm/images/gsm.png">

    </div>
    <h3>Welcome to GSMStockMarket</h3>
    <p>The worlds best B2B trading platform.
    </p>
    <?php echo form_open('login/password_validation'); ?>
        <div class="form-group">
            <?php

            $data = array(
                            'name'          => 'email',
                            'class'         => 'form-control',
                            'placeholder'   => 'Email',
                            'value'         => $this->input->post('email'),
                            'required'      => 'required'
                          );

              echo form_input($data);
        ?>
        </div>
        
        <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
    <?php echo form_close(); ?>
        <p>Alternatively, if you remember your email and password.</p>
        <a class="btn btn-sm btn-white btn-block" href="login/">Login</a>
    <p class="m-t"> <small>GSMStockMarket.com Limited &copy; <?php echo date("Y");?></small> </p>
</div>