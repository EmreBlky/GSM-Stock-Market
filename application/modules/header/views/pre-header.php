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
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>
        function autoRefresh_div()
        {
            $("#result").load("mailbox/messages_count");
            $("#inbox_count").load("mailbox/new_message");
            $("#inbox_all").load("mailbox/new_message");
            $("#inbox_all_message").load("mailbox/new_message_all");
            $("#inbox_market").load("mailbox/new_message_market");
            $("#inbox_member").load("mailbox/new_message_member");
            $("#inbox_support").load("mailbox/new_message_support");
         }

         setInterval('autoRefresh_div()', 1000); // refresh div after 5 secs
    </script>

	<!-- Styling -->
    <link href="public/main/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <!-- Morris -->
    <link href="public/main/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="public/main/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/public/main/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="public/main/css/animate.css" rel="stylesheet">
    <link href="public/main/css/style.css" rel="stylesheet">
    
    <!-- Mainly scripts -->
    <script src="/public/main/js/jquery-2.1.1.js"></script>
    <script src="/public/main/js/bootstrap.min.js"></script>
    <script src="/public/main/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/public/main/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/public/main/js/inspinia.js"></script>
    <script src="/public/main/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/public/main/js/plugins/jquery-ui/jquery-ui.min.js"></script>

   
</head>

<body class="skin-1">
    


	