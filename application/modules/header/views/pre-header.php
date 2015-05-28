<!doctype html>
<html lang="en">

<head>

    <base href="<?php echo $base; ?>">

    <!-- Meta Data -->
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="GSM Stock Market The ultimate trading platform for mobile phone trade companies globally. Members are retailers, wholesalers, distributors, manufacturers, network operators and service centres from all over the world."/>
    <meta name="keywords" content="gsm stock market, gsm trading, gsm market, gsm stock, mobile trading, phone trading, mobile phone, phone companies, mobile phone directory"/>
    <meta name="google-translate-customization" content=""/>
    <meta name="apple-mobile-web-app-title" content="Trading">
    
    <!-- Icons -->    
    <link href="public/main/template/gsm/images/icons/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="public/main/template/gsm/images/icons/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="public/main/template/gsm/images/icons/icon-hires.png" rel="icon" sizes="192x192" />

    <!-- Main Stylesheets -->
    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Alert Styles -->
    
    <!-- Multi Select -->
    <link href="public/main/template/core/css/plugins/chosen/chosen.css" rel="stylesheet">
    
    <link href="public/main/template/core/css/style.min.css" rel="stylesheet">
    <link href="public/main/template/gsm/css/style.css" rel="stylesheet">
    <!-- GSM Override -->

    <!-- datepicker chapter247 -->
    <link href="public/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <!-- Main jQuery-->
    <script src="public/main/template/core/js/jquery-2.1.1.js"></script>
    <script src="public/main/template/core/js/bootstrap.min.js"></script>


    <!-- Cropper -->
    <link href="public/main/template/gsm/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="public/main/template/gsm/css/plugins/cropper/main.css" rel="stylesheet">
    <script src="public/main/template/gsm/js/plugins/cropper/cropper.js"></script>
    <script src="public/main/template/gsm/js/plugins/cropper/main.js"></script>

    <script type="text/javascript">
        // naveed: initialize tooltip
        $(function(){
            var td = $("td[data-toggle=tooltip]");
            var placement = td.data("placement");
            var tdHtml = td.html();
            var tdTitle = td.attr("title");
            var childOfTd = "<span data-toggle='tooltip' data-placement='"+placement+"' title='"+tdTitle+"'>"+tdHtml+"</span>";
            td.html(childOfTd).removeAttr("data-toggle").removeAttr("data-placement").removeAttr("title");
            $("[data-toggle=tooltip]").tooltip();
        });


        $(document).on("click", "#deleteMemberImage", function () {
            $(this).parent().prev('.avatar-view').html('<img src="public/main/template/gsm/images/members/no_profile.jpg" />');
            $.ajax('profile/profileImage', {type: 'post', data: {'reset': 1}, dataType: 'json'});
        });
        $(document).on("click", "#changeMemberImage", function () {
            $(this).parent().prev('.avatar-view').click();
        });


        $(document).on("click", "#deleteCompanyImage", function () {
            $(this).parent().prev('.avatar-view').html('<img src="public/main/template/gsm/images/company/no_company.jpg" />');
            $.ajax('profile/companyImage', {type: 'post', data: {'reset': 1}, dataType: 'json'});
        });
        $(document).on("click", "#changeCompanyImage", function () {
            $(this).parent().prev('.avatar-view').click();
        })
    </script>


    <script src="public/main/template/core/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="public/main/template/core/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="public/main/template/core/js/inspinia.js"></script>
    <!-- datepicker chapter247 -->
    <script type="text/javascript" src="public/admin/js/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="public/admin/js/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" href="public/main/template/gsm/css/jquery.fancybox.css" />
    <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="public/main/template/gsm/js/common.js"></script>

    
    <script type="text/javascript">
        var weekdaystxt=["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"]
        function showLocalTime(container, servermode, offsetMinutes, displayversion){
        if (!document.getElementById || !document.getElementById(container)) return
        this.container=document.getElementById(container)
        this.displayversion=displayversion
        var servertimestring=(servermode=="server-php")? '<? print date("F d, Y H:i:s", time())?>' : (servermode=="server-ssi")? '<!--#config timefmt="%B %d, %Y %H:%M:%S"-->               <!--#echo var="DATE_LOCAL" -->' : '<%= Now() %>'
        this.localtime=this.serverdate=new Date(servertimestring)
        this.localtime.setTime(this.serverdate.getTime()+offsetMinutes*300*1000) //add user offset to server time
        this.updateTime()
        this.updateContainer()
        }
        showLocalTime.prototype.updateTime = function () {
            var thisobj = this
            this.localtime.setSeconds(this.localtime.getSeconds() + 1)
            setTimeout(function () {
                thisobj.updateTime()
            }, 1000) //update time every second
        }
        showLocalTime.prototype.updateContainer = function () {
            var thisobj = this
            if (this.displayversion == "long")
                this.container.innerHTML = this.localtime.toLocaleString()
            else {
                var hour = this.localtime.getHours()
                var minutes = this.localtime.getMinutes()
                var seconds = this.localtime.getSeconds()
                var ampm = "";
                var dayofweek = weekdaystxt[this.localtime.getDay()]
                this.container.innerHTML = formatField(hour) + ":" + formatField(minutes) + " " + ampm + ""
            }
            setTimeout(function () {
                thisobj.updateContainer()
            }, 1000) //update container every second
        }
        function formatField(num, isHour) {
            if (typeof isHour != "undefined") { //if this is the hour field
                var hour = num;
                return (hour == 0) ? 12 : hour
            }
            return (num <= 9) ? "0" + num : num//if this is minute or sec field
        }
    </script>


</head>
<?php
            $this->load->model('member/member_model', 'member_model');
            $this->load->model('membership/membership_model', 'membership_model');
            $member = $this->member_model->get_where($this->session->userdata('members_id'));
            //echo $member->membership;
            //exit;
        ?>
<body class="<?php echo strtolower($this->membership_model->get_where($member->membership)->membership); ?>">


    