<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo $base; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font/css/font-awesome.css" rel="stylesheet">

    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
    
    <?php if($message == 'yes') {?>
        <?php echo $this->session->flashdata('confirm-reference');?>
    <?php } else { ?>
    <?php echo form_open('tradereference/tradeRef/'.$cc.''); ?>
    <div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                //echo '<pre>';
                //print_r($members);
                //echo '</pre>';
            ?>
            <h3>Trade Reference for <?php echo $this->company_model->get_where_multiple('admin_member_id', $member)->company_name;?> </h3>
            Hello <?php echo $name; ?> (<?php echo $company?>).
            <br/>
            Please could you comment on your previous transactions with the above company.
            <div class="form-group">
                <?php

                    $data = array(
                                    'name'          => 'comment',
                                    'class'         => 'form-control',
                                    'value'         => $this->input->post('comment'),
                                    'required'      => 'required'
                                  );

                        echo form_textarea($data);

                ?>
            </div>
            <input type="hidden" name="member_id" value="<?php echo $member; ?>"/>
            <input type="hidden" name="confirm" value="<?php echo $confirm; ?>"/>
            <input type="submit" value="submit"/>
        </div>
    </div>
    <?php echo form_close(); ?>
    <?php } ?>
</body>
</html>


