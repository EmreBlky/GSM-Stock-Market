<?php

//echo '<pre>';
//echo $invoice;
//exit;

?>            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>My Subcription</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            Preferences
                        </li>
                        <li class="active">
                            <strong>My Subscription</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Current Subscription</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="row">
                        	<div class="col-md-12">
                            		<style>
										dl.full-width dt, dl.full-width dd {width:50%}
										dl.full-width dd {margin-left:51%}
									</style>
                                    <dl class="dl-horizontal full-width">
                                        <dt>Current Subscription:</dt> <dd>  Bronze Member</dd>
                                        <dt>Join Date:</dt> <dd>  N/A</dd>
                                        <dt>Renewal Date</dt> <dd>  N/A</dd>
                                        <dt>Payment Method:</dt> <dd>  PayPal</dd>
                                        <dt>Close Account</dt> <dd>  PayPal</dd>
                                    </dl>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change your Plan</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="row">
                        <div class="row db-padding-btm db-attached col-lg-10 col-lg-offset-1">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="db-wrapper">
                    <div class="db-pricing-eleven db-bk-color-one">
                        <div class="price">
                            FREE
                                <small>Limited Accounts</small>
                        </div>
                        <div class="type">
                            BRONZE
                        </div>
                        <ul>

                            <li><i class="glyphicon glyphicon-user"></i>Full Profile Editor</li>
                            <li><i class="glyphicon glyphicon-envelope"></i>Recieve Messages </li>
                            <li><i class="glyphicon glyphicon-barcode"></i>IMEI Services</li>
                            <li><i class="glyphicon glyphicon-ok"></i>Free Company Listing</li>
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg">CURRENT</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-two popular">
                    <div class="price">
                        <sup>&pound;</sup>1295
                                <small>per year</small>
                    </div>
                    <div class="type">
                        SILVER
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>Bronze Access + </li>
                        <li><i class="glyphicon glyphicon-time"></i>Company Search </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Address Book </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Marketplace </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Marketplace </li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver" class="btn db-button-color-square btn-lg">UPGRADE</a>
                    </div>
                </div>
                     </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-three">
                    <div class="price">
                        <sup></sup>INVITE
                                <small>per year</small>
                    </div>
                    <div class="type">
                        GOLD
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>30+ Accounts </li>
                        <li><i class="glyphicon glyphicon-time"></i>150+ Projects </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Lead Required</li>
                        <li><i class="glyphicon glyphicon-ok"></i>Free Company Listing</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">INVITE ONLY</a>
                    </div>
                </div>
                     </div>
            </div>

        </div>
        </div>
                        
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        
        <style>
/*=============================================================
    Authour URL: www.designbootstrap.com
    
    http://www.designbootstrap.com/

    License: MIT     
========================================================  */

/*============================================================
BACKGROUND COLORS
============================================================*/
.db-bk-color-one {
    background-color: #A0895E;
}

.db-bk-color-two {
    background-color: #c0c0c0;
}

.db-bk-color-three {
    background-color: #DBDB70;
}

.db-bk-color-six {
    background-color: #F59B24;
}
/*============================================================
PRICING STYLES
==========================================================*/
.db-padding-btm {
    padding-bottom: 50px;
}
.db-button-color-square {
    color: #fff;
    background-color: rgba(0, 0, 0, 0.50);
    border: none;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
}

    .db-button-color-square:hover {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.50);
        border: none;
    }


.db-pricing-eleven {
    margin-bottom: 30px;
    margin-top: 50px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, .5);
    color: #fff;
    line-height: 30px;
}

    .db-pricing-eleven ul {
        list-style: none;
        margin: 0;
        text-align: center;
        padding-left: 0px;
    }

        .db-pricing-eleven ul li {
            padding-top: 20px;
            padding-bottom: 20px;
            cursor: pointer;
        }

            .db-pricing-eleven ul li i {
                margin-right: 5px;
            }


    .db-pricing-eleven .price {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 40px 20px 20px 20px;
        font-size: 60px;
        font-weight: 900;
        color: #FFFFFF;
    }

        .db-pricing-eleven .price small {
            color: #B8B8B8;
            display: block;
            font-size: 12px;
            margin-top: 22px;
        }

    .db-pricing-eleven .type {
        background-color: #52E89E;
        padding: 50px 20px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 30px;
    }

    .db-pricing-eleven .pricing-footer {
        padding: 20px;
    }

.db-attached > .col-lg-4,
.db-attached > .col-lg-3,
.db-attached > .col-md-4,
.db-attached > .col-md-3,
.db-attached > .col-sm-4,
.db-attached > .col-sm-3 {
    padding-left: 0;
    padding-right: 0;
}

.db-pricing-eleven.popular {
    margin-top: 10px;
}

    .db-pricing-eleven.popular .price {
        padding-top: 80px;
    }
	</style>
