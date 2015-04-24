  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Mobile Unlocking</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>Unlocking</strong></li>
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
          <div class="ibox-title"><h5>Top up your account</h5></div>
          
          <div class="ibox-content">
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">IMEI <span style="color:red">*</span></label>
              <div class="col-lg-6">
              	<input type="text" class="form-control" maxlength="15" name="imei">
              </div>
            </div>
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">Service <span style="color:red">*</span></label>
              <div class="col-lg-6">
                  <select id="pay_option" class="form-control">
                    <option>Unlocking</option>
                    <option>Something else</option>
                  </select>
              </div>
            </div>
               
            <div class="form-group">              
              <label class="col-lg-3 col-lg-offset-1 control-label">Customer Email</label>
              <div class="col-lg-6">
              	<input type="text" class="form-control">
              </div>              
            </div>
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">Customer Moble Number</label>
              <div class="col-lg-2">
                  <select class="form-control">
                    <option>UK (+44)</option>
                    <option>USA (+1)</option>
                  </select>
              </div>
              <div class="col-lg-4">
              	<input type="text" class="form-control">
              </div>              
            </div>
               
            <div class="form-group">              
              <label class="col-lg-3 col-lg-offset-1 control-label">Optional Reference</label>
              <div class="col-lg-6">
              	<input type="text" class="form-control">
              </div>              
            </div>
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">Optional Notes</label>
              <div class="col-lg-6">
              	<textarea class="form-control" rows="5"></textarea>
              </div>
            </div>            
            
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-lg-3 col-lg-offset-4">
              	<label> <input type="checkbox" class="i-checks" name="agree" required> Confirm unlock charge of &pound;00.00 </label>
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
                },
                agree: {
                    required: true
                }
            }
        });
    });
</script>