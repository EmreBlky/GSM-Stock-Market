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

<body class="gray-bg">

<?php if($message == 'yes') {?>
    
<div class="wrapper wrapper-content">
  <div class="row">
    <div style="margin-bottom:30px;text-align:center"><img src="public/main/template/gsm/images/gsm.png"></div>
    
      <div class="col-lg-6 col-lg-offset-3">
        <div class="ibox">
          <div class="ibox-title"><h5>Thank you for submitting a reference!</h5></div>
        	
          <div class="ibox-content" style="padding-bottom:5px">
          	<p>Thank you for your trade reference. Not a member of GSMStockMarket.com yourself? Why not join today!</p>
            <p><strong>GSMStockMarket.com</strong>, The worlds most innovative B2B trading platform for companies who buy and sell mobile phones, accessories and spare parts.</p>
            <br />
            <p><strong>Your business profile</strong><br />
            Signup and get a free company listing. This entitles you to a free listing on our search results and events pages.</p>
            <p><strong>Company Search</strong><br />
            Subscribe and find similar companies to do business with or even find new business areas to expand in!.</p>
            <p><strong>Mailbox System</strong><br />
            Allow other users to contact you and even be notified by email when a new message appears in your mailbox making trading easier.</p>
            <p><strong>The Marketplace</strong><br />
            Find items, list stock, request offers. Our multi currency enabled platform helps you request items you would like or sell stock to anywhere in the world. Negotiate a deal and our order management will help you deal with the logistics of the order letting you know where your deal stands.</p>
            <p><strong>IMEI Services</strong><br />
            Worried about your handsets being stolen or need to unlock a phone? No Problem! Our easy to use IMEI services you can request an IMEI HPI check and see if the phone has been blacklists with our extensive reports. We also offer unlocking services for a wide array of mobile phone carriers using a pre-paid service.</p>
            <p><strong>Events &amp; Exhibitions</strong><br />
            Check out the latest events in the mobile world and see which of our members maybe attending. Let them know you will be attending too!</p>
            <p class="text-center"><a class="btn btn-primary" href="https://secure.gsmstockmarket.com/join">Signup Now</a></p>
          </div><!-- Ibox Content -->
        
        </div>        
      </div>

  </div>
</div>

<?php } elseif($message == 'no') { ?>
<div class="wrapper wrapper-content">
  <div class="row">
    <div style="margin-bottom:30px;text-align:center"><img src="public/main/template/gsm/images/gsm.png"></div>
    
      <div class="col-lg-6 col-lg-offset-3">
        <div class="ibox">
          <div class="ibox-title"><h5>Trade Reference for <?php echo $this->company_model->get_where($this->member_model->get_where_multiple('id', $member)->company_id)->company_name;?></h5></div>
        	
          <div class="ibox-content" style="padding-bottom:5px">
			<?php 
            $attributes = array('class' => 'form-horizontal validation');
            echo form_open('tradereference/tradeRef/'.$cc.'', $attributes);
            ?>
            <?php
            
            //echo '<pre>';
            //print_r($members);
            //echo '</pre>';
            ?>
              <p>Hello <?php echo ucfirst($name); ?> of <?php echo $company?>,<br /><br /><?php echo $this->company_model->get_where($this->member_model->get_where_multiple('id', $member)->company_id)->company_name;?> have requested a trade reference from you.</p>
              <p>Please could you comment on your previous transactions with the above company.</p>
                <div class="form-group">
                <?php
                
                $data = array(
                'name'          => 'comment',
                'class'         => 'form-control',
                'value'         => $this->input->post('comment'),
                'required'      => 'required',
                );
                
                echo form_textarea($data);
                
                ?>
                </div>
                
                <div class="form-group text-center">
              <input type="hidden" name="member_id" value="<?php echo $member; ?>"/>
              <input type="hidden" name="confirm" value="<?php echo $confirm; ?>"/>
              <input type="submit" class="btn btn-primary" value="Submit Reference"/> 
              	</div>
			<?php echo form_close(); ?>   
          </div><!-- Ibox Content -->
        
        </div>        
      </div>

  </div>
</div>
<?php } else {?>
    
    <div class="wrapper wrapper-content">
  <div class="row">
    <div style="margin-bottom:30px;text-align:center"><img src="public/main/template/gsm/images/gsm.png"></div>
    
      <div class="col-lg-6 col-lg-offset-3">
        <div class="ibox">
          <div class="ibox-title"><h5>Expired Code</h5></div>
        	
          <div class="ibox-content" style="padding-bottom:5px">
          	<p>The code you are trying to use has expired. Please advise the trader to get a new one generated for you.</p>
          </div><!-- Ibox Content -->
        
        </div>        
      </div>

  </div>
</div>
    
<?php }?>
</body>
</html>


<script src="public/main/template/core/js/jquery-2.1.1.js"></script>

<!-- Jquery Validate -->
<script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

        $(".validation").validate({
            rules: {
                comment: {
                    required: true,
                    minlength: 25
                },
            }
        });
    });
</script>


