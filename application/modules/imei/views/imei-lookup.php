  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>IMEI TAC Code Lookup</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>IMEI TAC Code Lookup</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>
  
    <div class="row">
    <form class="form-horizontal validation"> 
    
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Device Start</h5></div>
          
          <div class="ibox-content">
          
            <div class="form-group">
              <div class="col-lg-4 col-lg-offset-3">
              <input type="text" placeholder="Enter IMEI" class="form-control"  maxlength="15" name="imei"/><br />
              <p class="text-navy">Please enter IMEI for Mobile Phones, and Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
              <div class="col-lg-3">
              	<button class="btn btn-primary">Look up device</button>
              </div>
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
      
    
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Initial IMEI TAC Code Lookup:</h5></div>
          
          <div class="ibox-content" style="padding-top:0;padding-bottom:10px">
          
            <div class="form-group">              
              <label class="col-lg-2 control-label">Make</label>
              <div class="col-lg-2">
                <p class="form-control-static">Apple Inc</p>
              </div>
              
              <label class="col-lg-2 control-label">Marketing Name</label>
              <div class="col-lg-6">
                <p class="form-control-static">Apple iPhone 6 Plus (A1524)</p>
              </div>
              
              <label class="col-lg-2 control-label">Model</label>
              <div class="col-lg-2">
                <p class="form-control-static">iPhone 6 Plus (A1524)</p>
              </div>
              
              <label class="col-lg-2 control-label">OS</label>
              <div class="col-lg-6">
                <p class="form-control-static">iOS</p>
              </div>
              
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
    
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title"><h5>ImeiHPI checks:</h5></div>
          
          <div class="ibox-content" style="padding-top:0;padding-bottom:10px">
          
            <div class="form-group">              
              <label class="col-lg-8 control-label" style="text-align:left;font-size:2em">0 ImeiHPI checks found</label>
              <div class="col-lg-4">
              	<button class="btn btn-primary">Submit to ImeiHpi</button>
              </div>
              
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
    
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title"><h5>Unlocks:</h5></div>
          
          <div class="ibox-content" style="padding-top:0;padding-bottom:10px">
          
            <div class="form-group">              
              <label class="col-lg-12 control-label" style="text-align:left;font-size:2em">0 Activities Found</label>
              
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
    
    </form>  
    </div>  <!-- /row -->
    
          
  </div><!-- /Wrapper -->  

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