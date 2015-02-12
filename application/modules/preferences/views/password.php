
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
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Password (INCOMPLETE)</h5>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="form" class="form-horizontal">
                        		<div class="form-group"><label class="col-md-3 control-label">Current Password</label>
                                    <div class="col-md-9">
                                        <input type="password" placeholder="Current Password" id="password" class="form-control" name="old_password">
                                    </div>
                                </div>  
                        		<div class="form-group"><label class="col-md-3 control-label">New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" placeholder="New Password" id="password" class="form-control" name="new_password">
                                    </div>
                                </div>  
                        		<div class="form-group"><label class="col-md-3 control-label">Repeat New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" placeholder="Repeat New Password" id="password" class="form-control" name="new_password_repeat">
                                    </div>
                                </div> 
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-3">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" name="submit_form" type="submit" id="submit_form">Update Password</button>
                                    </div>
                                </div> 
                                </form>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    <!-- Jquery Validate -->
    <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
	<script>
	// just for the demos, avoids form submit
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$( "#form" ).validate({
	  rules: {
		new_password: "required",
		New_password_again: {
		  equalTo: "#password"
		}
	  }
	});
	</script>