            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>Access Denied</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>Access Denied</strong>
                        </li>
                    </ol>
                </div>
            </div>
            
            
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
				  <?php if($this->session->userdata('membership') > 0) {?>
                    <div class="alert alert-danger" style="margin-bottom:10px;">
                      Your subscription is unable to view this page. Upgrade to <a class="alert-link" href="preferences/subscription">Silver Member</a> to access the full features on the site. <a class="alert-link" href="preferences/subscription">UPGRADE NOW</a>
                    </div>
                    <div class="ibox-content p-xl" style="margin-bottom:50px">
                    	<div class="row">
                        	<h1 style="text-align:center;margin-bottom:20px">Marketplace launch coming soon!</h1>
                              <div class="col-md-12 nopadding">
                                <div class="col-md-7 nopadding">
                                <h1>SPECIAL OFFER - SAVE £500</h1>
                                <h2>Upgrade to Silver now for only £1295 per year</h2>
                                <p class="small">Offer until 31st April 2015. Normal price £1795</p>
                                </div>
                                <div class="col-md-5 nopadding">
                                  <time style="margin:-10px auto;display:block;width:383px" class="countdown">2015-05-01T10:00:00+0000</time>
                                </div>
                              </div>
                            <div class="col-md-12" style="text-align:center">
                			<a href="preferences/subscription" class="btn btn-primary navbar-btn" style="font-size:36px;margin-top:40px">Upgrade Today!</a>
                            </div>
                        </div>
                    </div>
                  <?php }?>
				  <?php if($this->session->userdata('membership') > 0) {?>
                    <div class="alert alert-warning" style="margin-bottom:10px;">
                      This feature is currently unavailable. The marketplace will launch 1st May 2015.
                    </div>
                    <div class="ibox-content p-xl">
                    	<div class="row">
                        	<h1 style="text-align:center;margin-bottom:20px">Marketplace launch coming soon!</h1>
                              <div class="col-md-12 nopadding">
                                  <time style="margin:-10px auto;display:block;width:383px" class="countdown">2015-05-01T10:00:00+0000</time>
                              </div>
                        </div>
                    </div>
                  <?php }?>
                    
                </div>
            </div>

		
        <script src="public/main/template/www/js/jquery.countdown.js"></script>
        <script>
        window.jQuery(function ($) {
            "use strict";

            $('time').countDown({
                with_separators: false
            });

        });
        </script>
        
        <style>

/* COUNTDOWN - Inspiration http://fff.cmiscm.com/#!/section/flipclock */
/* ----------------------------------------------------------------------------------------- */
.countdown {
    display: table-cell;
    font-weight: normal;
}
.countdown .item {
    display: inline-block;
    vertical-align: bottom;
    position: relative;
    font-weight: 700;
    font-size: 60px;
    line-height: 80px;
    text-align: center;
    color: #FFF;
    border-radius: 10px;
    margin: 30px 10px 20px 0;
    padding: 0 10px;
    background: #2A2A2A;
    background: -webkit-linear-gradient(#2A2A2A, #000);
    background: linear-gradient(#2A2A2A, #000);
    overflow: hidden;
}
.countdown .item-ss {
    font-size: 50px;
    line-height: 70px;
}
.countdown .item:after {
    content: '';
    display: block;
    height: 1px;
    border-top: 3px solid #111;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
}
.countdown .label {
    text-transform: uppercase;
    display: block;
    position: absolute;
    font-family: 'Open Sans', cursive;
    font-weight: 700;
    line-height: normal;
    right: 6px;
    bottom: 0px;
    font-size: 10px;
	background-color:black;
    color: #FFF;
	padding:0
}
.countdown .item-hh .label,
.countdown .item-mm .label,
.countdown .item-ss .label {
    display: none;
}
.dd {font-size:60px;line-height:80px}
</style>