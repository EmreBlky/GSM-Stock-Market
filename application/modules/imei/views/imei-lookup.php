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

              <input type="text" placeholder="Enter IMEI" class="form-control"  maxlength="15" name="imei" id="lookup-imei"/><br />

              <p class="text-navy">Please enter IMEI for Mobile Phones, and Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
              <div class="col-lg-3">
              	<button class="btn btn-primary" id="lookup-imei-submit">Submit IMEI HPI</button>
              </div>
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
      
      <script type="text/javascript">
      $(document).ready(function(){
        $('#lookup-imei-submit').click(function(e)
        {
          e.preventDefault();
          var imei = $('#lookup-imei').val();
          if (imei != '')
          {          
            var r = confirm('The ImeiHPI check costs £1.10, do you wish to proceed?');
            if (r)
            {
              $.ajax(
              {
                  url:'/ajax/lookup_imei/' + imei,
                  dataType: "json",
                  success: function(data)
                  { 
                        if (data.imei_code == false)
                        {
                          alert('IMEI code invalid.');
                        }
                        else if (data.imei_code == true)
                        {
                          alert('Lookup Successful - Data is now recorded in the archive section');
                        }
                  }
              });
            }
          }
          else
          {
            alert('No IMEI was entered.');
          }
        })
      })
      </script>
    <?php /*
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
      </div><!-- /col -->*/?>
    
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
          <div class="ibox-title"><h5>IMEI HPI &amp; Unlocking Services</h5></div>
          
          <div class="ibox-content">
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">Service <span style="color:red">*</span></label>
              <div class="col-lg-6">
              	<select id="service" class="form-control">
                  <optgroup label="0">
                  <option value="0" id="service-0-0">Please Select Service ....</option>
                  </optgroup>
                  <optgroup label="Device Check Services">
                  <option value="1-62" id="service-1-0">1-62 - ImeiHPI Check (0.10 Credits)</option>
                  <option value="1-129" id="service-1-1">1-129 - ImeiHPI Bulk Check (0.10 Credits)</option>
                  </optgroup>
                  </select>
              </div>
            </div>
               
            <div class="imei_input form-group" id="1-62">
              <label class="col-lg-3 col-lg-offset-1 control-label">IMEI <span style="color:red">*</span></label>
              <div class="col-lg-6">
              	<input type="text" id="1-62" class="form-control imei_single" maxlength="15" name="imei">
              </div>
            </div>
               
            <div class="imei_input form-group" id="1-129">
              <label class="col-lg-3 col-lg-offset-1 control-label">IMEI Bulk<span style="color:red">*</span><br /><p class="text-navy"></p></label>
              <div class="col-lg-6">
              	<textarea class="form-control" name="imei" rows="5"></textarea>
              	<button class="btn btn-primary imei_bulk pull-right" style="margin-top:10px">.CSV Bulk Import IMEI</button>
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
              	<label> <input type="checkbox" class="i-checks" name="agree" required> Confirm charge of &pound;00.00 (whatever total is)</label>
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
  
<script>
$(document).ready(function () {
  $('.imei_input').hide();
  $('#1-62').show();
  $('#service').change(function () {
    $('.imei_input').hide();
    $('#'+$(this).val()).show();
  })
});
</script>


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