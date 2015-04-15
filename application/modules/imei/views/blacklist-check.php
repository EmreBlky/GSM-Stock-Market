  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Blacklist Check</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>Blacklist Check</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>
  
    <div class="row">
    <form class="form-horizontal"> 
    
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Device Start</h5></div>
          
          <div class="ibox-content">
          
          
            <div class="form-group">
              <div class="col-lg-2 col-lg-offset-2">
                            <select id="quantity" class="form-control pull-right" style="width:auto">
                              <option value="option1" selected>Individual IMEI</option>
                              <option value="option2">Bulk IMEI</option>
                            </select>
              </div>
              
              <div class="col-lg-3">
              <input type="text" placeholder="Enter IMEI" class="form-control" /><br />
              <p class="text-navy">Please enter IMEI for Mobile Phones, and Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
              <div class="col-lg-4">
              	<button class="btn btn-primary">Blacklist Check</button>
              </div>
              
            </div>
            
          
            <div id="option1" class="form-group quantity">
              <div class="col-lg-4 col-lg-offset-3">
              <input type="text" placeholder="Enter IMEI" class="form-control" /><br />
              <p class="text-navy">Please enter IMEI for Mobile Phones, and Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
              <div class="col-lg-3">
              	<button class="btn btn-primary">Blacklist Check</button>
              </div>
            </div>
            
          
            <div id="option2" class="form-group quantity">
              <div class="col-lg-4 col-lg-offset-3">
              	<button class="btn btn-primary">Blacklist Check</button><br />
              <p class="text-navy">s Serial Numbers for all other Devices, Consoles, Laptops etc</p>
              </div>
              <div class="col-lg-3">
              	<button class="btn btn-primary">Blacklist Check</button>
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
  $('.quantity').hide();
  $('#option1').show();
  $('#quantity').change(function () {
    $('.quantity').hide();
    $('#'+$(this).val()).show();
  })
});
</script>