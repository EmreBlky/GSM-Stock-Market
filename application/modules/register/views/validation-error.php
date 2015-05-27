<!DOCTYPE html>
<html>

<head>
<base href="<?php echo $base; ?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>GSM Stockmarket: Valdation Error.</title>

<link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
<link href="public/main/template/core/font/css/font-awesome.css" rel="stylesheet">

<link href="public/main/template/core/css/animate.css" rel="stylesheet">
<link href="public/main/template/core/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content">
  <div class="row">
    <div style="margin-bottom:30px;text-align:center"><img src="public/main/template/gsm/images/gsm.png"></div>
    
      <div class="col-lg-6 col-lg-offset-3">
        <div class="ibox">
          <div class="ibox-title"><h5>Expired Validation Code</h5></div>
        	
          <div class="ibox-content" style="padding-bottom:5px">
          	<p>Your account has been validated. The code you are trying to use has expired.</p>
          </div><!-- Ibox Content -->
        
        </div>        
      </div>

  </div>
</div>
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