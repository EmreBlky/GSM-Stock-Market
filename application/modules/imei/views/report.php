  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>View Report</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li><a href="imei/archive/">Archive</a></li>
          <li class="active"><strong>View Report</strong></li>
        </ol>
    </div>
  </div>
  <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Order Number: <?=$order_id?></h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>IMEI Number</th>
                            <th>Certificate ID</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Reference</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (!isset($order_info) || !is_array($order_info))
                            {
                                echo '<tr>This order is in a queue for processing. Please try again later.</tr>';
                            }
                            else
                            {
                                foreach($order_info as $row)
                                { /*
                                    switch($row->result)
                                    {
                                        case 'passed':
                                            $row->result = '<label class="label label-primary"><i class="fa fa-check"></i> Passed</label>';
                                            break;
                                        case 'failed':
                                            $row->result = '<label class="label label-danger" ><i class="fa fa-times"></i> Failed</label>';
                                            break;
                                        default:
                                            break;
                                    } */
                                    switch(isset($row->checkColour) ? $row->checkColour : 'n/a')
                                    {
                                        case 'green':
                                            $row->result = '<label class="label label-primary"><i class="fa fa-check"></i> Passed</label>';
                                            break;
                                        case 'red':
                                            $row->result = '<label class="label label-danger" ><i class="fa fa-times"></i> Failed</label>';
                                            break;
                                        case 'amber':
                                            $row->result = '<label class="label label-warning" ><i class="fa fa-exclamation"></i> Warning</label>';
                                            break;
                                        default:
                                            break;
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $row->serial . '</td>';
                                    echo '<td>' . (isset($row->cert_id) ? $row->cert_id : 'n/a') . '</td>';
                                    echo '<td>' . $row->make . '</td>';
                                    echo '<td>' . $row->model . '</td>';
                                    echo '<td>' . (isset($row->ref) ? $row->ref : 'n/a') . '</td>';
                                    echo '<td class="text-center">' . $row->result . '</td>';
                                    echo '</tr>';
                                }
                            }
                        ?>

                        <!--<tr>
                        	<td>01928379202333</td>
                            <td>UHD29072-08SJI99</td>
                            <td>Samsung</td>
                            <td>SM-G900</td>
                            <td>A13</td>
                            <td class="text-center"><label class="label label-danger" ><i class="fa fa-times"></i> Failed</label></td>
						</tr>-->
                        </tbody>
                    </table>                       
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>
                      
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

});
</script>