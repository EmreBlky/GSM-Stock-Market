<?php echo $this->session->flashdata('confirm-login'); ?>
<div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Monthly</span>
                                <h5>Sales</h5>
                            </div>
                            <div class="ibox-content" style="min-height:89px">
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
                            <div class="ibox-content" style="min-height:89px">
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
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Good Standing</span>
                                <h5>My Rating</h5>
                            </div>
                            <div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
                              		<div class="m-r-md inline">
                            			<input type="text" value="94" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
                            		</div>
                            </div>
                        </div>
            </div>
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
                            <div class="ibox-content">
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
                                    <div class="ibox-content">
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
                                    <div class="ibox-content">
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
                                    <div class="ibox-content">
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
    <!-- EayPIE -->
    <script src="public/main/template/core/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="public/main/template/core/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="public/main/template/core/js/demo/sparkline-demo.js"></script>
