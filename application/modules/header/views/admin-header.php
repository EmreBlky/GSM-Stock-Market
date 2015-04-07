<div id="wrapper">
        <!-- SIDEBAR CODE HERE -->
    	<?php
                
            $this->load->module('header');
            $this->header->admin_sidebar();
                    
	?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="admin/#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome Admin User.</span>
                </li>
                
                <li>
                    <a href="login/admin_logout/">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>