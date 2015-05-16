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
                        <h5>ImeiHPI Check Archive</h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Order ID</th>
                            <th>Service</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if (count($bulk_orders) > 0 && is_array($bulk_orders))
                        {
                            foreach($bulk_orders as $bulk)
                            {
                                echo '<tr>';
                                echo '<td>' . $bulk->created_at . '</td>';
                                echo '<td>' . $bulk->order_id . '</td>';
                                echo '<td>ImeiHPI Bulk Check</td>';
                                echo '<td>' . $bulk->reference . '</td>';
                                echo '<td class="text-center"><label class="label label-primary" >Complete</label></td>';
                                echo '<td class="text-center"><a class="btn btn-primary" style="font-size:10px" href="imei/report/' . $bulk->order_id . '">View Report</a></td>';
                                echo '</tr>';
                            }
                        }
                        
                        if (count($hpi_checks) > 0 && is_array($hpi_checks))
                        {
                            foreach($hpi_checks as $single)
                            {
                                echo '<tr>';
                                echo '<td>' . $single->created_at . '</td>';
                                echo '<td>' . $single->id . '</td>';
                                echo '<td>ImeiHPI Single Lookup</td>';
                                echo '<td>' . $single->make . '/' . $single->model . '</td>';
                                echo '<td class="text-center"><label class="label label-primary" >Complete</label></td>';
                                echo '<td class="text-center"><a class="btn btn-primary" style="font-size:10px" href="imei/report/' . $single->id . '">View Report</a></td>';
                                echo '</tr>';
                            }    
                        }
                        ?>
                     
                        <?php /*
                            if (isset($hpi_checks) && is_array($hpi_checks) && count($hpi_checks) > 0)
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
                                        echo '<td>' . $hpi_check->expired_owner_temp_block . '</td>'; 
                                        echo '<td style="color:' . $hpi_check->colour . '">' . $hpi_check->result . '</td>';
                                        echo '<td>' . $hpi_check->recycled_previously . '</td>';
                                        echo '<td class="text-center"><a target="_blank" class="label label-warning" href="' . $hpi_check->report_path . '">View Report</a> <a target="_blank" class="label label-primary" download href="' . $hpi_check->report_path . '">Download Report</a></td>';
                                    echo '</tr>';
                                }
                            }
                       */ ?>
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