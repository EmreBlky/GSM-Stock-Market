			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>IMEI Services</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>IMEI Services</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <?php if($this->session->userdata('membership') > 3) {?>
            
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="alert alert-warning" style="margin-bottom:10px;">
                      <p>Terms of service for mobicode here</p>
                      <button class="btn btn-primary" id='create-mobicode-account'>Accept (Create Account)</button>
                      <a href=""><button class="btn btn-danger">Decline</button></a>
                    </div>
                   
                </div>
            </div>
        
      <script type="text/javascript">
      $(document).ready(function(){
        $('#create-mobicode-account').click(function(e)
        {
          e.preventDefault();

          $.ajax(
          {
              url:'/ajax/create_mobicode_account/',
              dataType: "json",
              success: function(data)
              { 
                if (data.account_created == true)
                {
                  alert('Account Creation Successful - Data is now recorded in the archive section');
                }
              }
          });
            
        })
      })
      </script>
      
      <?php }?>
	  <?php if($this->session->userdata('membership') < 4) {?>
		                    <div class="alert alert-warning" style="margin-top:15px;">
		                      This feature is currently unavailable. The IMEI services will launch soon
		                    </div>
	                  <?php }?>