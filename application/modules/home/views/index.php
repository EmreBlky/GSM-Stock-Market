<?php 
  echo $this->session->flashdata('confirm-login'); 
?>
<?php                                        
    $this->load->module('feedback');
    $overall = $this->feedback->overallScore($this->session->userdata('members_id'));
?>
<div class="wrapper wrapper-content">
    <?php if($this->session->userdata('membership') < 2) {?>
    <div class="alert alert-danger" style="margin-bottom:10px;">
        Upgrade your account to <a class="alert-link" href="preferences/subscription">Silver</a> to access the full features on the site. <a class="alert-link" href="preferences/subscription">UPGRADE NOW</a>
    </div>
    <?php }?>
        <div class="row">
            
                    <div class="col-lg-3">
                        
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Monthly</span>
                                <h5>Sales</h5>
                            </div>
                            <div class="ibox-content no_sub" style="min-height:89px">
                                <h1 class="no-margins">£886,200</h1>
                                <div class="stat-percent font-bold text-success">23% <i class="fa fa-level-up"></i></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Annual</span>
                                <h5>Purchases</h5>
                            </div>
                            <div class="ibox-content no_sub" style="min-height:89px">
                                <h1 class="no-margins">£275,800</h1>
                                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                                <small>My Purchases</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Monthly</span>
                                <h5>Visits</h5>
                            </div>
                            <div class="ibox-content" style="min-height:89px">
                                <h1 class="no-margins">1,320</h1>
                                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                <small>New visits</small>
                            </div>
                        </div>
                    </div>
            <?php if($overall > 0) {?>
                    <div class="col-lg-3">
                        <?php if($overall >= 95){ ?>
                        
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right">Excellent</span>
                                    <h5>My Rating</h5>
                                </div>
                                <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                                    <div class="m-r-md inline">                                            
                                            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1c84c6" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                    </div>
                                </div>
                            </div>
                        
                        <?php } elseif($overall <= 94 && $overall >= 80) {?>
                        
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-primary pull-right">Good</span>
                                    <h5>My Rating</h5>
                                </div>
                                <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                                    <div class="m-r-md inline">                                            
                                            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                    </div>
                                </div>
                            </div>
                        
                        <?php } elseif($overall <= 79 && $overall >= 51) {?>
                        
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-warning pull-right">Average</span>
                                    <h5>My Rating</h5>
                                </div>
                                <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                                    <div class="m-r-md inline">                                            
                                            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#f8ac59" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                    </div>
                                </div>
                            </div>
                        
                        <?php } else {?>
                        
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-danger pull-right">Poor</span>
                                    <h5>My Rating</h5>
                                </div>
                                <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                                    <div class="m-r-md inline">                                            
                                        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#ed5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                    </div>
                                </div>
                            </div>
                        
                        <?php }?>                        
            </div>
            <?php } else {?>
            
                <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label pull-right">No Rating</span>
                                    <h5>My Rating</h5>
                                </div>
                                <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                                    <div class="m-r-md inline">                                            
                                        <input type="text" value="0" class="dial m-r" data-fgColor="#AAA" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                                    </div>
                                </div>
                            </div>
                </div>    
            
            <?php }?>
        </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Orders</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content no_sub">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total sales orders in period</small>
                                            <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">9,180</h2>
                                            <small>Monthly income from orders</small>
                                            <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>


                <div class="row">
                    
                    <?php
                    
                        //$this->load->module('mailbox');
                        //$this->mailbox->mail_recent(10);
                        
                    ?>
                    <div id="status"></div>
                    
                    <div class="col-lg-8">

                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Buying Requests</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no_sub">
                                        <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Selling Offers</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no_sub">
                                        <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Watch List</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no_sub">
                                        <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                            	<th class="mobihide">Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th class="mobihide">Qty</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td class="mobihide">Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td class="mobihide">400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                       
                    
                    
                </div>
                </div>
                
        <!-- Page Specific Scripts -->
        <!-- Flot -->
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.js"></script>
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="public/main/template/core/js/plugins/flot/jquery.flot.symbol.js"></script>
    
        <!-- Peity -->
        <script src="public/main/template/core/js/plugins/peity/jquery.peity.min.js"></script>
        <script src="public/main/template/core/js/demo/peity-demo.js"></script>        
    
        <!-- jQuery UI -->
        <script src="public/main/template/core/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    
        <!-- Jvectormap -->
        <script src="public/main/template/core/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="public/main/template/core/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    
        <!-- EayPIE -->
        <script src="public/main/template/core/js/plugins/easypiechart/jquery.easypiechart.js"></script>
    
        <!-- Sparkline -->
        <script src="public/main/template/core/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    
        <!-- Sparkline demo data  -->
        <script src="public/main/template/core/js/demo/sparkline-demo.js"></script>
    
    	<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>

    	<script>
        $(document).ready(function() {
        	$(".dial").knob();
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Number of orders",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Payments",
                    data: data2,
                    yaxis: 2,
                    color: "#464f88",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.2
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>

	<script type="text/javascript"><!-- Message Box widget reload -->
        
            $(function() {

                getStatus();

            });
            
            function getStatus() { 
                $('#status').load('<?php echo $base;?>mailbox/mail_recent/10'); 
                setTimeout("getStatus()",10000);
            }
            
        </script>