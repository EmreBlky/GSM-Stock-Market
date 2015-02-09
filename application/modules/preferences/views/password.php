
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Change Password</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>Change Password</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit Password (INCOMPLETE)</h5>
                        </div>
                        <div class="ibox-content">
                                <form role="form" id="form">
                                    <div class="form-group"><label>Old Password</label> <input type="password" placeholder="Password" id="password" class="form-control" name="password"></div>
                                    <div class="form-group"><label>New Password</label> <input type="password" placeholder="Password" id="password" class="form-control" name="password"></div>
                                    <div class="form-group"><label>Repeat New Password</label> <input type="password" placeholder="Password" id="passsword_again" class="form-control" name="password_again"></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Confirm Change</strong></button>
                                    </div>
                                </form>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
	<script>
	// just for the demos, avoids form submit
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$( "#form" ).validate({
	  rules: {
		password: "required",
		password_again: {
		  equalTo: "#password"
		}
	  }
	});
	</script>