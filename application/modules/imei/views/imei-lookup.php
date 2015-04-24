  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>IMEI TAC Code Lookup</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>IMEI HPI Check</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>
    
      <div class="alert alert-danger" style="margin-bottom:10px;">
      <p>Insufficient fund in your IMEI Services account. <a class="alert-link" href="imei/top_up">Top up now.</a></p>
    </div>
  
    <div class="row">
    <form class="form-horizontal validation"> 
    
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Device Start</h5></div>
          
          <div class="ibox-content">
          
            <div class="form-group">
              <div class="col-lg-6 col-lg-offset-3">
              <input type="text" placeholder="Enter IMEI" class="form-control" maxlength="15" name="imei"/><br />
              <p class="text-navy">Please enter IMEI for Mobile Phones, and Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
            </div>        
            
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-lg-3 col-lg-offset-3">
              	<label> <input type="checkbox" class="i-checks" name="agree" required> Confirm IMEI HPI charge of &pound;1.12 </label>
              </div>
              <div class="col-lg-3">
              	<button class="btn btn-primary pull-right">Place Order</button>
              </div>
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
    
    </form>  
    </div>  <!-- /row -->
    
          
  </div><!-- /Wrapper -->

    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

  <!-- iCheck -->
  <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
  <script>
      $(document).ready(function () {
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
          });
      });
  </script>

<!-- Jquery Validate -->
<script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

        $(".validation").validate({
            rules: {
                imei: {
                    required: true,
                    digits: true,
                    minlength: 15,
					maxlength: 15
                }
            }
        });
    });
</script>