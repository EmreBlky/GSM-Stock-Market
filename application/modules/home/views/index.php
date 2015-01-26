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
                                <h5>Feedback Score</h5>
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
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Messages</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content ibox-heading">
                                <h3><i class="fa fa-envelope-o"></i> 10 Most Recent messages</h3>
                                <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>
                            </div>
                            <div class="ibox-content">
                                <div class="feed-activity-list">

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right text-navy">1m ago</small>
                                            <strong>Monica Smith</strong>
                                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                            <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">2m ago</small>
                                            <strong>Jogn Angel</strong>
                                            <div>There are many variations of passages of Lorem Ipsum available</div>
                                            <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Jesica Ocean</strong>
                                            <div>Contrary to popular belief, Lorem Ipsum</div>
                                            <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Monica Jackson</strong>
                                            <div>The generated Lorem Ipsum is therefore </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>


                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Anna Legend</strong>
                                            <div>All the Lorem Ipsum generators on the Internet tend to repeat </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Damian Nowak</strong>
                                            <div>The standard chunk of Lorem Ipsum used </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Gary Smith</strong>
                                            <div>200 Latin words, combined with a handful</div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Gary Smith</strong>
                                            <div>200 Latin words, combined with a handful</div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Gary Smith</strong>
                                            <div>200 Latin words, combined with a handful</div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Gary Smith</strong>
                                            <div>200 Latin words, combined with a handful</div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">

                          <div class="col-lg-12">
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
                                            	<th>Make</th>
                                                <th>Model</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
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
                                            	<th>Make</th>
                                                <th>Model</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
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
                                            	<th>Make</th>
                                                <th>Model</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-primary">Active</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-success">Sold</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                            	<td>Samsung</td>
                                                <td>i9105 Galaxy S2 Plus</td>
                                                <td>£23,505.00</td>
                                                <td>400</td>
                                                <td><span class="label label-danger">Cancelled</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                       </div>
                       
                    
                    <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Newsfeed</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content inspinia-timeline">

                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-briefcase"></i>
                                    6:00 am
                                    <br/>
                                    <small class="text-navy">2 hour ago</small>
                                </div>
                                <div class="col-xs-9 content no-top-border">
                                    <p class="m-b-xs"><strong>Meeting</strong></p>

                                    <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the
                                        sale.</p>

                                    <p><span data-diameter="40" class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,4,7,3,2,9,8,7,4,5,1,2,9,5,4,7,2,7,7,3,5,2</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-file-text"></i>
                                    7:00 am
                                    <br/>
                                    <small class="text-navy">3 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-coffee"></i>
                                    8:00 am
                                    <br/>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                    <p>
                                     Go to shop and find some products.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-phone"></i>
                                    11:00 am
                                    <br/>
                                    <small class="text-navy">21 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                    <p>
                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-user-md"></i>
                                    09:00 pm
                                    <br/>
                                    <small>21 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Go to the doctor dr Smith</strong></p>
                                    <p>
                                        Find some issue and go to doctor.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-user-md"></i>
                                    11:10 pm
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Chat with Sandra</strong></p>
                                    <p>
                                        Lorem Ipsum has been the industry's standard dummy text ever since.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-comments"></i>
                                    12:50 pm
                                    <br/>
                                    <small class="text-navy">48 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Chat with Monica and Sandra</strong></p>
                                    <p>
                                        Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-phone"></i>
                                    08:50 pm
                                    <br/>
                                    <small class="text-navy">68 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Phone to James</strong></p>
                                    <p>
                                        Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-file-text"></i>
                                    7:00 am
                                    <br/>
                                    <small class="text-navy">3 hour ago</small>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                </div>
                </div>
