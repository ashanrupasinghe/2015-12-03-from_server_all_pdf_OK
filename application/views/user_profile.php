<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $user[0]->fld_firstname.' '.$user[0]->fld_lastname;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon glyphicon-user black-icon" aria-hidden="true"></span>User Details</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">First Name</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_firstname;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Last Name</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_lastname;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Username</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_username;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Email</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_email;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Location</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_location;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Contact No.</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_contactno;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">User role</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_role;?>
                </div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-2 col-lg-2 col-xs-4">
						<label for="title">Center</label>
					</div>
					<div class="col-sm-8 col-md-10 col-lg-10 col-xs-8">
                    <?php echo ': '.$user[0]->fld_center_name;?>
                </div>
				</div>


			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<a class="btn btn-warning password-change-button" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Change Your Password
</a>	
	
<?php if ($this->session->flashdata('aaa')) { ?>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
	Your password has been changed
</div>
<?php } ?>

<div class="row collapse" id="collapseExample">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">					

						<?php
						echo form_open ( 'Registration_Controller/changePassword', array (
								'name' => 'myform',
								'id' => 'myform',
								'class' => 'mws-form' 
						) );
						?>
							<div class="form-group">
							<label for="old_pw">Current Password</label> <input
								type="password" name="old_pw" class="form-control"
								value="<?php echo set_value('old_pw'); ?>">
							<div class="error_msg"><?php echo form_error('old_pw'); ?></div>
						</div>

						<div class="form-group">
							<label for="new_pw">New Password</label> <input type="password"
								name="new_pw" class="form-control"
								value="<?php echo set_value('new_pw'); ?>">
							<div class="error_msg"><?php echo form_error('new_pw'); ?></div>
						</div>

						<div class="form-group">
							<label for="confirm_pw">Confirm Password</label> <input
								type="password" name="confirm_pw" class="form-control"
								value="<?php echo set_value('confirm_pw'); ?>">
							<div class="error_msg"><?php echo form_error('confirm_pw'); ?></div>
						</div>



						<button type="submit" name="submit" value="save"
							class="btn btn-primary">Submit</button>
						<button type="submit" name="submit" value="cancel"
							class="btn btn-danger">Cancel</button>

						<?php echo form_close(); ?>
					</div>
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>

<?php 
if (validation_errors()){
?>	
<script>
$(document).ready(function(){
	$('#collapseExample')
	.collapse('show');   
});
</script>
<?php 	
}
?>


