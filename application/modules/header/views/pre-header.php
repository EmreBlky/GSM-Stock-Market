<!doctype html>
<html lang="en">

<head>

    <base href="<?php echo $base;?>">
    
    <!-- Meta Data --> 
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
	<meta name="description" content="GSM Stock Market The ultimate trading platform for mobile phone trade companies globally. Members are retailers, wholesalers, distributors, manufacturers, network operators and service centres from all over the world." />
	<meta name="keywords" content="gsm stock market, gsm trading, gsm market, gsm stock, mobile trading, phone trading, mobile phone, phone companies, mobile phone directory" />
    <meta name="google-translate-customization" content=""/>
    
    <script src="public/main/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>
        function autoRefresh_div()
        {
            var result = "<?php
                            $this->load->module('mailbox');
                            $this->mailbox->messages_count();
                        ?>";
            $("#result_remove").replaceWith('<div id="result">'+result+'</div>');
            $("#result").load("mailbox/messages_count");
            
            var inbox_count = "<?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message();
                            ?>";
            $("#inbox_count_remove").replaceWith('<div id="inbox_count">'+inbox_count+'</div>');
            $("#inbox_count").load("mailbox/new_message");
            
            var inbox_all_message = "<?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message_all();
                            ?>";
            $("#inbox_all_message_remove").replaceWith('<div id="inbox_all_message" style="float: right;">'+inbox_all_message+'</div>');            
            $("#inbox_all_message").load("mailbox/new_message_all");
            
            var inbox_market = "<?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message_market();
                            ?>";
            $("#inbox_market_remove").replaceWith('<div id="inbox_market" style="float: right;">'+inbox_market+'</div>'); 
            $("#inbox_market").load("mailbox/new_message_market");
            
            var inbox_member = "<?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message_member();
                            ?>";
            $("#inbox_member_remove").replaceWith('<div id="inbox_member" style="float: right;">'+inbox_member+'</div>'); 
            $("#inbox_member").load("mailbox/new_message_member");
            
            var inbox_support = "<?php
                                $this->load->module('mailbox');
                                $this->mailbox->new_message_support();
                            ?>";
            $("#inbox_support_remove").replaceWith('<div id="inbox_support" style="float: right;">'+inbox_support+'</div>'); 
            $("#inbox_support").load("mailbox/new_message_support");
         }

         setInterval('autoRefresh_div()', 500);
    </script>
    
    <script type="text/javascript">
        
            $(function() {

                getStatus();

            });
            
            function getStatus() {

                $('#status').load('<?php echo $base;?>mailbox/mail_recent/10'); 
                setTimeout("getStatus()",500);
            }
            
        </script>

    <!-- Styling -->
    <link href="public/main/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <!-- Morris -->
    <link href="public/main/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="public/main/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="public/main/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="public/main/css/animate.css" rel="stylesheet">
    <link href="public/main/css/style.css" rel="stylesheet">
    <link href="public/main/css/gsm.css" rel="stylesheet"> <!-- GSM Overrides -->
    
    <!-- Mainly scripts -->
    <script src="public/main/js/jquery-2.1.1.js"></script>
    <script src="public/main/js/bootstrap.min.js"></script>
    
    <script src="public/main/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Toastr script -->
    <script src="public/main/js/plugins/toastr/toastr.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="public/main/js/inspinia.js"></script>
    <script src="public/main/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="public/main/js/plugins/jquery-ui/jquery-ui.min.js"></script>

   
</head>

<body class="skin-1">
    


	