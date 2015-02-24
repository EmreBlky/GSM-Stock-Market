<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo $base; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font/css/font-awesome.css" rel="stylesheet">

    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/style.css" rel="stylesheet">

</head>

<?php if($page != 'invoice-print') {?>
<body class="gray-bg">
<?php } else {?>
<body style="background-color: #FFF">
<?php } ?>
