  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>IMEI Blacklist Checking</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>IMEI Blacklist Checking</strong></li>
        </ol>
    </div>
  </div>


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
                          alert('Lookup failed. IMEI Code may be invalid or you may not have enough credit.');
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

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>
    
      <div class="alert alert-danger" style="margin-bottom:10px;">
      <p>Insufficient fund in your IMEI Services account. <a class="alert-link" href="imei/top_up">Top up now.</a></p>
    </div>

    <?php if ($lookup_results != false) { ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Lookup Results</h5></div>    
          <div class="ibox-content">

            <?php
              if (array_key_exists('Bulk_ID', $lookup_results))
              {
            ?>
            <p>Order ID : <?=$lookup_results['Order_ID']?></p>
            <p>Bulk ID : <?=$lookup_results['Bulk_ID']?></p>
            <p>Checks Submitted : <?=$lookup_results['Checks_Submitted']?></p>
            <p>Duplicates : <?=$lookup_results['Duplicates']?></p>
            <p>Rejected : <?=count($lookup_results['Rejected'])?></p>
            <?=var_dump($lookup_results)?>
            <p>
              <?php foreach($lookup_results['Rejected'] as $rejected)
              {
                echo '- ' . $rejected['imei'] . '<br />';
              } 
              ?>
            </p>
            <?php 
            } 
            else if (array_key_exists('report_path', $lookup_results))
            {
              ?>
              <p>Lookup Success!</p>
              <p>Please check the archive for the report path</p>
              <?php
            }

            ?>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  
    <div class="row">
    <form class="form-horizontal validation" method='POST' name='unlocking-service-form' action=''> 
    
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>IMEI HPI &amp; Unlocking Services</h5></div>
          
          <div class="ibox-content">
               
            <div class="form-group">
              <label class="col-lg-3 col-lg-offset-1 control-label">Service <span style="color:red">*</span></label>
              <div class="col-lg-6">
              	<select id="service" class="form-control" name='lookup-service'>
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

            <script type='text/javascript'>
              $(document).ready(function(){
                $('#bulk_imeis').on('input propertychange paste', function() {
                  var text = $("#bulk_imeis").val();   
                  var lines = text.split(/\r|\r\n|\n/);
                  var count = lines.length;

                  var value = parseFloat((count * 0.10)).toFixed(2);
                  $('#lookup-cost').text(value);
                });
              });
            </script>
               
            <div class="imei_input form-group" id="1-62">
              <label class="col-lg-3 col-lg-offset-1 control-label">IMEI <span style="color:red">*</span></label>
              <div class="col-lg-6">
              	<input type="text" id="1-62" class="form-control imei_single" maxlength="15" name="imei">
              </div>
            </div>
               
            <div class="imei_input form-group" id="1-129">
              <label class="col-lg-3 col-lg-offset-1 control-label">IMEI Bulk<span style="color:red">*</span><br /><p class="text-navy">Enter one (1) IMEI number per line. Seperate with a comma to add a reference to each IMEI report e.g<br />012345678910123, IMEI1<br />012345678910123, IMEI2</p></label>
              <div class="col-lg-6">
              	<textarea class="form-control" name="imei_bulk" rows="5" id='bulk_imeis'></textarea><!--
              	<button class="btn btn-primary imei_bulk pull-right" style="margin-top:10px">.CSV Bulk Import IMEI</button>-->
              </div>
            </div>
               
            <div class="form-group" id="1-129">              
              <label class="col-lg-3 col-lg-offset-1 control-label">Bulk IMEI Reference</label>
              <div class="col-lg-6">
              	<input type="text" class="form-control">
              </div>              
            </div>
               
            <div class="form-group" id="1-129">
              <label class="col-lg-3 col-lg-offset-1 control-label">Optional Notes</label>
              <div class="col-lg-6">
              	<textarea class="form-control" rows="5"></textarea>
              </div>
            </div>            
            
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-lg-4 col-lg-offset-4">
              	<label> <input type="checkbox" class="i-checks" name="agree" required> Confirm charge of <span id='lookup-cost'>0.10</span> credits (* this is an approximation, imeis of incorrect formats will not be billed)</label>
              </div>
              <div class="col-lg-2">
              	<button class="btn btn-primary pull-right" name='place-imei-order'>Place Order</button>
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
