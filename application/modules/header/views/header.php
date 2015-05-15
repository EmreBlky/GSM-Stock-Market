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
              new showLocalTime("timeLA", "server-php", -96, "short")
              new showLocalTime("timeNY", "server-php", -60, "short")
              new showLocalTime("timeLondon", "server-php", 0, "short")
              new showLocalTime("timeParis", "server-php", 24, "short")
              new showLocalTime("timeDubai", "server-php", 36, "short")
              new showLocalTime("timeDelhi", "server-php", 66, "short")
              new showLocalTime("timeHongKong", "server-php", 84, "short")
              new showLocalTime("timeSydney", "server-php", 120, "short")
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
            <li class="dropdown" style="display:none">
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
            <li class="dropdown" style="display:none">
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