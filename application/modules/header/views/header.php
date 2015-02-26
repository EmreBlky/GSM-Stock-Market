<div id="wrapper">
        <!-- SIDEBAR CODE HERE -->
    	<?php
                
            $this->load->module('header');
            $this->header->sidebar();
                    
	?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <style>
			div#world-clock {float:left;margin-top:20px}
			
#world-clock DL {
	padding: 0px;
	margin: 0px;
	list-style: none;
	float: left;
	clear: none;
	font-size:0.9em
}

#world-clock DT {
	margin-left:1em;
	border-left:#CCC 1px solid;
	padding:0 0.5em 0 1em;
	display:inline;
}

#world-clock DT:first-child {
	border:none
}

#world-clock DD {
	display:inline
}

@media (max-width: 1675px) {
	div#world-clock dt.clock-fr, div#world-clock dd#timeParis
		 {display:none}
}
@media (max-width: 1550px) {
	div#world-clock dt.clock-nd, div#world-clock dd#timeDelhi
		 {display:none}
}

@media (max-width: 1425px) {
	div#world-clock dt.clock-syd, div#world-clock dd#timeSydney
	 {display:none}
}


@media (max-width: 1325px) {
	div#world-clock dt.clock-la, div#world-clock dd#timeLA {display:none}
	div#world-clock dt.clock-ny {
	border:none
}
}

@media (max-width: 1175px) {
	div#world-clock dt.clock-dub, div#world-clock dd#timeDubai
	 {display:none}
	div#world-clock dt.clock-ny {
	border:none
}
}

@media (max-width: 1075px) {
	div#world-clock {display:none}
}
			</style>
            
            
  	<div id="world-clock">
			<dl>
			<dt class="clock-la">Los Angeles</dt>
			<dd id="timeLA"></dd>
			<dt class="clock-ny">New York</dt>
			<dd id="timeNY"></dd>
			<dt class="clock-lon">London</dt>
			<dd id="timeLondon"></dd>
			<dt class="clock-fr">Paris</dt>
			<dd id="timeParis"></dd>
			<dt class="clock-dub">Dubai</dt>
			<dd id="timeDubai"></dd>
			<dt class="clock-nd">New Dehli</dt>
			<dd id="timeDelhi"></dd>
			<dt class="clock-hk">Hong-Kong</dt>
			<dd id="timeHongKong"></dd>
			<dt class="clock-syd">Sydney</dt>
			<dd id="timeSydney"></dd>
			</dl>
		</div><!-- /world-clock -->
		<script type="text/javascript">
			new showLocalTime("timeLA", "server-php", -420, "short")
			new showLocalTime("timeNY", "server-php", -240, "short")
			new showLocalTime("timeLondon", "server-php", 60, "short")
			new showLocalTime("timeParis", "server-php", 60, "short")
			new showLocalTime("timeDubai", "server-php", 240, "short")
			new showLocalTime("timeDelhi", "server-php", 60, "short")
			new showLocalTime("timeHongKong", "server-php", 480, "short")
			new showLocalTime("timeSydney", "server-php", 600, "short")
		</script>
        
        
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome, <?php echo $this->session->userdata('firstname');?>.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>
                        <div id="inbox_count">
                            <?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message();
                            ?>
                        </div>                            
                    </a>
                    <ul class="dropdown-menu dropdown-messages"></ul>
                    
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-wechat"></i>  <!-- <span class="label label-warning">3</span> -->
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="public/main/template/core/img/a7.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="public/main/template/core/img/a4.jpg">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="public/main/template/core/img/profile.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <!-- <span class="label label-primary">8</span> -->
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="login/logout/">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>