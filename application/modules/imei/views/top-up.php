  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Top up</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>Top up</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>


<?php
if ($encrypted != false)
{
?>
  <form name="form2" id="form2" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_self"> 
  <input type="hidden" name="encrypted" value="<?=$encrypted; ?>">
  <input type="hidden" name="cmd" value="_s-xclick">
  <label>
  <input type="submit" name="button" id="button" class='hidden' value="off we go to paypal" />
  </label> </form>
  <script type="text/javascript">

    $('#form2').submit();

  </script>
<?php
}
?>

    <div class="row">
    <form method="POST" action='' class="form-horizontal"> 
    
      <div class="col-lg-7">
        <div class="ibox">
          <div class="ibox-title"><h5>Top up your account</h5></div>
          
          <div class="ibox-content">  
               
            <div class="form-group">
              <label class="col-lg-6 control-label">Credits (top up amount)</label>
              <div class="col-lg-4">
              <input type="text" class="form-control" name='credit-amount' id='credit-amount' />
              </div>
            </div>
               
            <div class="form-group">
              <label class="col-lg-6 control-label">Minimum top up amount</label>
              <div class="col-lg-6">
                <p class="form-control-static">&pound;10.00</p>
              </div>
              
              <label class="col-lg-6 control-label">Price Per Credit</label>
              <div class="col-lg-6">
                <p class="form-control-static">&pound;1.00 (GBP)</p>
              </div>
              
              <label class="col-lg-6 control-label">Sub Total</label>
              <div class="col-lg-6">
                <p class="form-control-static">&pound;<span id='topup-subtotal'>0.00</span></p>
              </div>
              
              <label class="col-lg-6 control-label">VAT @ 20.00%</label>
              <div class="col-lg-6">
                <p class="form-control-static">&pound;<span id='topup-vat'>0.00</span></p>
              </div>
              
              <label class="col-lg-6 control-label">Order Total</label>
              <div class="col-lg-6">
                <p class="form-control-static">&pound;<span id='topup-total'>0.00</span></p>
              </div>
            </div>

            <script type="text/javascript">
            $(document).ready(function(){
              $('#credit-amount').on('input propertychange paste', function() {
                var amount = $('#credit-amount').val();
                var amount = amount.replace(/\D/g,'');

                var subtotal = parseFloat(amount).toFixed(2);
                var vat = parseFloat((amount / 100 * 20)).toFixed(2);
                var total = (parseFloat(subtotal) + parseFloat(vat)).toFixed(2);

                if (isNaN(subtotal))
                {
                  subtotal = 0;
                }
                if (isNaN(vat))
                {
                  vat = 0;
                }
                if (isNaN(total))
                {
                  total = 0;
                }

                $('#credit-amount').val(amount);
                $('#topup-subtotal').text(subtotal);
                $('#topup-vat').text(vat);
                $('#topup-total').text(total);
              })
            })
            </script>
            
            
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-lg-4 col-lg-offset-2">
                            <select id="pay_option" class="form-control pull-right" style="width:auto">
                              <option value="option1" selected>Payment Method</option>
                              <option value="option2">PayPal</option>
                              <option value="option3">Credit/Debit Card</option>
                            </select>
              </div>
              <div class="col-lg-6">
              				<p id="option1" class="pay_button text-danger" style="margin:8px 0">Select payment method.</p>
                            <button id="option2" class="pay_button btn btn-primary" name='top-up-account'>Pay Now</button>
                            <!--<button id="option3" class="pay_button btn btn-primary">Pay Now</button>-->
              </div>
            </div>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
      </form>
    
      <div class="col-lg-5">
        <div class="ibox">
          <div class="ibox-title">
          	<a class="pull-right"><button type="button" class="btn btn-white btn-xs"><i class="fa fa-refresh"></i> Refresh Balance</button></a>
            <h5>Current Balance</h5>
          </div>
          
          <div class="ibox-content">                    
            <p class="text-center" style="font-size:4em">&pound;0.00</p>
            
          </div><!-- Ibox Content -->
        </div>        
      </div><!-- /col -->
      
    </div>  <!-- /row -->
    
    
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Top up invoices</h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Date Time</th>
                            <th>Type</th>
                            <th>Number</th>
                            <th>Processor</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Transaction ID</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td style="text-align:center"><a href="" class="btn btn-primary" style="font-size:10px">View Invoice</a></td>
                            </tr>
                        </tbody>
                    </table>                       
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>
    
          
  </div><!-- /Wrapper -->
  
  
<script>
$(document).ready(function () {
  //$('.pay_button').hide();
  $('#option1').show();
  $('#pay_option').change(function () {
    $('.pay_button').hide();
    $('#'+$(this).val()).show();
  })
});
</script>

<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>

<!-- Data Tables -->
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>


<!-- Page-Level Scripts -->
<script type="text/javascript">
$(document).ready(function() {
    $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });
	/* multi select */
	var config = {
        '.chosen-select'           : {search_contains:true},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }			

});
</script>