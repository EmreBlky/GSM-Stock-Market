<?php 
    echo $this->session->flashdata('trade-confirmation'); 
?>

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Overview</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>Preferences</li>
          <li>Trade References</li>
          <li class="active"><strong>Overview</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
        
    <div class="row">
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title"><h5>Trade References</h5></div>
          
          <div class="ibox-content" style="min-height:170px">
          	<p>To gain access to the GSM Stock Market marketplace you will need to submit <strong>two (2)</strong> trade references for us to confirm your business</p>
            <p>When adding these trade references you will be able to track whether they have confirmed you or not.</p>
            <p>Once the companies have confirmed your trade references we will confirm also and you will then have complete access to our marketplace.</p>
          	 
          
                        
          </div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
      
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title"><h5>Reference Status</h5></div>
          
          <div class="ibox-content" style="min-height:170px">
          <div class="row">
          
          	<div class="col-md-12">            
              <label class="col-md-9 control-label" style="text-align:right">Silver Subscription</label>
              <div class="col-md-3">
                  <i class="fa fa-check" style="color:green"></i>
              </div>
            </div>
            
            <div class="col-md-12">            
              <label class="col-md-9 control-label" style="text-align:right">Add 2 Trade References</label>
              <div class="col-md-3">
                  <i class="fa fa-check" style="color:green"></i>
              </div>
            </div>
            
            <div class="col-md-12">             
              <label class="col-md-9 control-label" style="text-align:right">2 Trade references confirmed by companies</label>
              <div class="col-md-3">
                  <i class="fa fa-times" style="color:red"></i>
              </div>
            </div>
            
            <div class="col-md-12">             
              <label class="col-md-9 control-label" style="text-align:right">Trade references confirmed by GSM Stock Market</label>
              <div class="col-md-3">
                  <i class="fa fa-times" style="color:red"></i>
              </div>
             </div>
             
            </div> 
          	</div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
      
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Trade Reference Overview</h5></div>
          
          <div class="ibox-content">
              	 <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TebiHost Limited</td>
                                <td>danny@tebihost.com</td>
                                <td>+44 (0)7512245522</td>
                                <td>United Kingdom</td>
                                <td style="text-align:center"><span class="label label-warning">Awaiting Confirmation</span></td>
                                <td style="text-align:center"><a href="tradereference/submit_refs" class="btn btn-warning" style="font-size:10px">Edit</a> <a href="#" class="btn btn-success" style="font-size:10px">Resend Email</a></td>
                            </tr>
                            <tr>
                                <td>TebiHost Limited</td>
                                <td>danny@tebihost.com</td>
                                <td>+44 (0)7512245522</td>
                                <td>United Kingdom</td>
                                <td style="text-align:center"><span class="label label-primary">Confirmed</span></td>
                                <td style="text-align:center"><a href="tradereference/submit_refs" class="btn btn-warning" style="font-size:10px">Edit</a> <a href="#" class="btn btn-success" style="font-size:10px">Resend Email</a></td>
                            </tr>
                        </tbody>
                    </table>    
          
                        
          </div><!-- Ibox Content -->
          
          <div class="ibox-content" style="text-align:center">
          		<a href="tradereference/submit_refs" class="btn btn-primary" style="font-size:2em;text-align:center">Submit References Now</a>
          </div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
    
    </form>  
    </div>  <!-- /row -->
    
          
  </div><!-- /Wrapper -->
  