<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo $base; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>
    <meta name="apple-mobile-web-app-title" content="Trading">
    
    <!-- Icons -->    
    <link href="public/main/template/gsm/images/icons/favicon.png" rel="shortcut icon" type="image/x-icon" />
	<link href="public/main/template/gsm/images/icons/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
	<link href="public/main/template/gsm/images/icons/icon-hires.png" rel="icon" sizes="192x192" />

    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font/css/font-awesome.css" rel="stylesheet">

    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/style.css" rel="stylesheet">
    
    <style>

@media (max-height: 700px) {
	.loginscreen.middle-box {margin-top:-250px}
}
</style>

</head>

<?php if($page != 'invoice-print') {?>
<body class="gray-bg">
<?php } else {?>
<body class="white-bg">
<?php } ?>
