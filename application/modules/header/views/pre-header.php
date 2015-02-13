<!doctype html>
<html lang="en">

<head>

    <base href="<?php echo $base;?>">
    
    <!-- Meta Data --> 
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="GSM Stock Market The ultimate trading platform for mobile phone trade companies globally. Members are retailers, wholesalers, distributors, manufacturers, network operators and service centres from all over the world." />
	<meta name="keywords" content="gsm stock market, gsm trading, gsm market, gsm stock, mobile trading, phone trading, mobile phone, phone companies, mobile phone directory" />
    <meta name="google-translate-customization" content=""/>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>
       
        $(function() {

            autoRefresh();

        });
        
        function autoRefresh()
        {
            
            setTimeout("autoRefresh()",10000);
            
            $.get("mailbox/messages_count", function(data) {                
                $("#result").html(data);    
            });  
            $.get("mailbox/new_message", function(data) {
                $("#inbox_count").html(data);    
            });
            $.get("mailbox/mail_dropdown/3", function(data) {
                $(".dropdown-messages").html(data);    
            });
            
         }

    </script>
    
    <script type="text/javascript">
        
            $(function() {

                getStatus();

            });
            
            function getStatus() { 
                $('#status').load('<?php echo $base;?>mailbox/mail_recent/10'); 
                setTimeout("getStatus()",10000);
            }
            
        </script>

	<!-- Styling -->
    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <!-- Morris -->
    <link href="public/main/template/core/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="public/main/template/core/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="public/main/template/core/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/style.css" rel="stylesheet">
    <link href="public/main/template/gsm/css/style.css" rel="stylesheet"> <!-- GSM Override -->
    
    <!-- Mainly scripts -->
    <script src="public/main/template/core/js/jquery-2.1.1.js"></script>
    <script src="public/main/template/core/js/bootstrap.min.js"></script>
    <script src="public/main/template/core/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="public/main/template/core/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="public/main/template/core/js/inspinia.js"></script>
    <script src="public/main/template/core/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="public/main/template/core/js/plugins/jquery-ui/jquery-ui.min.js"></script>

   
</head>

<body class="skin-1">


	