  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Archive</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>Archive</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="alert alert-warning" style="margin-bottom:10px;">
      <p>This feature is currently unavailable. The IMEI services will launch soon</p>
    </div>

                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>ImeiHPI Check</h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Certificate ID</th>
                            <th>IMEI Number</th>
                            <th>Make &amp; Model</th><!--
                            <th>Colour Code</th>
                            <th>Colour</th>
                            <th>CR Count</th>
                            <th>Police Lost Property</th>
                            <th>Owner Temporary Block</th>
                            <th>Expired Owner Temporary Block</th> -->
                            <th>Result</th><!--
                            <th>Recycled Previously</th>-->
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            if (isset($hpi_checks))
                            {
                                foreach($hpi_checks as $hpi_check)
                                {
                                    echo '<tr>';
                                        echo '<td>' . $hpi_check->created_at . '</td>';
                                        echo '<td>' . $hpi_check->cert_id . '</td>';
                                        echo '<td>' . $hpi_check->serial . '</td>';
                                        echo '<td>' . $hpi_check->make . ' ' . $hpi_check->model . '</td>'; /*
                                        echo '<td>' . $hpi_check->colour_code . '</td>';
                                        echo '<td>' . $hpi_check->colour . '</td>';
                                        echo '<td>' . $hpi_check->cr_count . '</td>';
                                        echo '<td>' . $hpi_check->police_lost_property . '</td>';
                                        echo '<td>' . $hpi_check->owner_temp_block . '</td>';
                                        echo '<td>' . $hpi_check->expired_owner_temp_block . '</td>'; */
                                        echo '<td style="color:' . $hpi_check->colour . '">' . $hpi_check->result . '</td>';/*
                                        echo '<td>' . $hpi_check->recycled_previously . '</td>';*/
                                        echo '<td class="text-center"><a target="_blank" class="label label-primary" download href="' . $hpi_check->report_path . '">Download Report</a></td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                        </tbody>
                    </table>                       
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>    
    
    <!--
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List code requests</h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Date Submitted</th>
                            <th>Order ID</th>
                            <th>Acc ID</th>
                            <th>Account</th>
                            <th>Sales Cat</th>
                            <th>IMEI</th>
                            <th>Service</th>
                            <th>Model</th>
                            <th>Status</th>
                            <th>ImeiHPI</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#order_id"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#imei"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#order_id"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#imei"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#order_id"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#imei"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#order_id"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td style="text-align:center"><button type="button" class="btn btn-outline btn-info" style="font-size:10px" data-toggle="modal" data-target="#imei"><i class="fa fa-search"></i> 123456789</button></td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>                       
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>
    -->
          
  </div><!-- /Wrapper -->
  

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

<div class="modal inmodal fade" id="order_id" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Order Details</h4>
                <small class="font-bold">IMEI: 353043057303813, ORDERNO: 1068072</small>
            </div>
            <div class="modal-body">
            
            <div class="row"> 
                  <div class="ibox-content col-xs-12">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <th>IMEI</th>
                    <td>353043057303813</td>
                    <th>Requested By</th>
                    <td>2103</td>
                  </tr>
                  <tr>
                    <th>Order ID</th>
                    <td>1068072</td>
                    <td>&nbsp;</td>
                    <td>GSMstockmarket</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>solved</td>
                    <td>&nbsp;</td>
                    <td>tim@gsmstockmarket.com</td>
                  </tr>
                  <tr>
                    <th>Date Submitted</th>
                    <td>2015-04-01 14:08:34</td>
                    <th>Credits Deducted from</th>
                    <td>2103 GSMstockmarket</td>
                  </tr>
                  <tr>
                    <th>Date Returned</th>
                    <td>2015-04-01 14:08:36</td>
                    <th>Cost</th>
                    <td>0.10</td>
                  </tr>
                  <tr>
                    <th>Service</th>
                    <td>ImeiHPI Check</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                   <tr>
                    <th valign="top">File</th>
                    <td colspan="3">
                      <a href="/files/mobiguard/2103/2015/Apr/946873-E66B5745.pdf" class="menu_1b" target="_blank">/files/mobiguard/2103/2015/Apr/946873-E66B5745.pdf</a></td>
                  </tr></tbody></table>
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            <div class="hr-line-dashed"></div>
            
            <div class="row"> 
                  <div class="ibox-content">
                  	<table width="100%" cellspacing="0" cellpadding="2">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Imei</th>
                        <th>Recheck Order ID</th>
                        <th>Status</th>
                        <th>Result</th>
                    </tr>
                    </thead>
                      <tbody>
                      <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1599809</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1599872</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1600038</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1600076</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr></tbody></table>
                                      
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            <div class="hr-line-dashed"></div>
            
            <div class="row"> 
                  <div class="ibox-content">
                  	<h4>Order details</h4>
                    <p>lorem bla bla</p>                                      
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="imei" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Order Details</h4>
                <small class="font-bold">IMEI: 353043057303813, ORDERNO: 1068072</small>
            </div>
            <div class="modal-body">
            
            <div class="row"> 
                  <div class="ibox-content col-xs-12">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <th>IMEI</th>
                    <td>353043057303813</td>
                    <th>Requested By</th>
                    <td>2103</td>
                  </tr>
                  <tr>
                    <th>Order ID</th>
                    <td>1068072</td>
                    <td>&nbsp;</td>
                    <td>GSMstockmarket</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>solved</td>
                    <td>&nbsp;</td>
                    <td>tim@gsmstockmarket.com</td>
                  </tr>
                  <tr>
                    <th>Date Submitted</th>
                    <td>2015-04-01 14:08:34</td>
                    <th>Credits Deducted from</th>
                    <td>2103 GSMstockmarket</td>
                  </tr>
                  <tr>
                    <th>Date Returned</th>
                    <td>2015-04-01 14:08:36</td>
                    <th>Cost</th>
                    <td>0.10</td>
                  </tr>
                  <tr>
                    <th>Service</th>
                    <td>ImeiHPI Check</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  </tbody></table>
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            <div class="hr-line-dashed"></div>
            
            <div class="row"> 
                  <div class="ibox-content">
                  	<table width="100%" cellspacing="0" cellpadding="2">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Imei</th>
                        <th>Recheck Order ID</th>
                        <th>Status</th>
                        <th>Result</th>
                    </tr>
                    </thead>
                      <tbody>
                      <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1599809</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1599872</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1600038</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr>  <tr>
                        <td>2015-03-20</td>
                        <td>353043057303813</td>
                        <td>1600076</td>
                        <td>solved</td>
                        <td>GREEN</td>
                      </tr></tbody></table>
                                      
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            <div class="hr-line-dashed"></div>
            
            <div class="row"> 
                  <div class="ibox-content">
                  	<h4>Order details</h4>
                    <p>Order ID: 1043021</p>
                    <p>Your unlock codes have been returned.</p>
                    <p>IMEI: 354683302058487</p>
                    <p>Codes: #pw+872851602703477+1#</p>
                    <p>Service: Nokia DCT 2/3/4</p>   
                  </div><!-- Ibox Content -->
              
    		</div>  <!-- /row -->
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>