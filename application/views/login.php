<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>NDDCB Outreach</title>

<!-- Bootstrap Core CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">

<!-- MetisMenu CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.css"
	rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo base_url();?>asset/dist/css/sb-admin-2.css"
	rel="stylesheet">

<!-- Custom Fonts -->
<link
	href="<?php echo base_url();?>asset/bower_components/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">
<style type="text/css">
.login-button {
	margin-bottom: 20px;
}
</style>

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				<div class="login-panel panel panel-default login-panel-home"
					style="margin-top: 45%;">

					<div>
						<img style="padding: 10px;"
							src="<?php echo base_url();?>/asset/images/logo.png"
							class="img-responsive" alt="Cinque Terre" height="" width="">
					</div>
					<?php
					$this->load->library ( 'session' );
					$msg = $this->session->flashdata ( 'item' );
					$success = $this->session->flashdata ( 'success' );
					if (! empty ( $msg )) {
						?>
					<?php
						
					if ($success) {
							?>
						<div class="alert alert-success login-err-msg"
						style="margin-left: 14px; margin-right: 15px; padding-bottom: 7px; padding-top: 7px; margin-bottom: 1px; text-align: center">
					<?php }else{?>
						<div class="alert alert-danger login-err-msg"
							style="margin-left: 14px; margin-right: 15px; padding-bottom: 7px; padding-top: 7px; margin-bottom: 1px; text-align: center">
						
					<?php }?>	
					
						<button type="button" class="close" data-dismiss="alert"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						<?php echo $msg;?>
					</div>
					<?php 	} ?>
					<!-- 
					<div class="panel-heading" style="text-align: center;">
						<h3 class="panel-title">Please Sign In</h3>
					</div> -->
						<div class="panel-body">
							<form id="login_form" class="form"
								action="<?php echo site_url();?>/Login_Controller/submit"
								method="post">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="UserName"
											name="username" id="username" type="text" autofocus required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password"
											name="password" id="password" type="password" required>
									</div>
									<div class="checkbox">
										<label> <input name="remember" type="checkbox"
											value="Remember Me">Remember Me
										</label> <a
											href="<?php echo base_url();?>index.php/Login_Controller/forgetpassword"
											style="float: right">forget password</a>
									</div>

									<!-- Change this to a button or input when using this as a form -->
									<button class="btn btn-sm btn-primary btn-block login-button">Login</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="<?php echo base_url();?>asset/bower_components/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="<?php echo base_url();?>asset/dist/js/sb-admin-2.js"></script>

</body>

</html>
