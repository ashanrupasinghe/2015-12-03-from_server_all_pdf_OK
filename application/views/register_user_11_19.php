
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Users</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php if(preg_match('/Register/', $title)|| preg_match('/Update/',$title)|| preg_match('/View/', $title)){?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php
				if (preg_match('/Register/', $title)){
					echo 'Register new User';
				} if (preg_match('/Update/', $title)){
					echo 'Update User';
				}
				?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<?php if ($this->session->flashdata('user')) { ?>
						<div class="alert alert-success alert-dismissable" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Successfully Registered User&nbsp;<strong> <?php echo $this->session->flashdata('user') ?></strong>
						</div>
						<?php } ?>

						<?php if ($this->session->flashdata('update')) { ?>
						<div class="alert alert-success alert-dismissable" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Successfully Updated User&nbsp;<strong> <?php echo $this->session->flashdata('update') ?></strong>
						</div>
						<?php } ?>

						<?php
						if(preg_match('/Register/', $title)){
						 echo form_open('Registration_Controller/insertNewUser' , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						?>

							<div class="form-group">
								<label for="fname">First Name</label>
								<input type="text" name="fname" class="form-control" value="<?php echo set_value('fname');?>">
								<div class="error_msg"><?php echo form_error('fname'); ?></div>
							</div>

							<div class="form-group">
								<label for="lname">Last Name</label>
								<input type="text" name="lname" class="form-control" value="<?php echo set_value('lname');?>">
								<div class="error_msg"><?php echo form_error('lname'); ?></div>
							</div>

							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo set_value('email');?>">
								<div class="error_msg"><?php echo form_error('email'); ?></div>
							</div>

							<div class="form-group">
								<label for="nic_no">NIC No.</label>
								<input type="text" name="nic_no" class="form-control" value="<?php echo set_value('nic');?>">
								<div class="error_msg"><?php echo form_error('nic_no'); ?></div>
							</div>

							<div class="form-group">
								<label for="contact">Contact No.</label>
								<input type="text" name="contact" class="form-control" value="<?php echo set_value('contact');?>">
								<div class="error_msg"><?php echo form_error('contact'); ?></div>
							</div>

							<div class="form-group">
								<label>District</label>
								<select class="form-control" name="district" value="<?php echo set_value('district');?>">
									<option value="">--Please Select--</option>
									<?php  foreach ($districts as $district):?>
									<option value="<?php  echo $district->fld_district_name;?>" <?php echo set_select('district', $district->fld_district_name); ?>><?php  echo $district->fld_district_name;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('district'); ?></div>
							</div>

							<div class="form-group">
								<label for="user_role">User Role</label>
								<select class="form-control" name="user_role" value="<?php echo set_value('user_role');?>">
									<option value="">--Please Select--</option>
									<?php  foreach ($user_role as $row):?>
									<option value="<?php  echo $row->fld_role_id;?>" <?php echo set_select('user_role', $row->fld_role_id); ?>><?php  echo $row->fld_role;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('user_role'); ?></div>
							</div>

							<div class="form-group">
								<label for="assigned_to">Assigned To</label>
								<select class="form-control" name="assigned_to" value="<?php echo set_value('assigned_to');?>">
									<option value="">--Please Select--</option>
									<?php  foreach ($assigned_to as $row):?>
									<option value="<?php  echo $row->fld_username;?>" <?php echo set_select('assigned_to', $row->fld_username); ?>><?php  echo $row->fld_username;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('assigned_to'); ?></div>
							</div>

							<div class="form-group">
								<label for="center">Center</label>
								<select class="form-control" name="center" value="<?php echo set_value('center');?>">
									<option value="">--Please Select--</option>
									<?php  foreach ($center as $row):?>
									<option value="<?php  echo $row->id;?>" <?php echo set_select('center', $row->id); ?>><?php  echo $row->fld_center_name;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('center'); ?></div>
							</div>

						<button type="submit" name="submit" value="save" class="btn btn-default btn-primary">Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-default btn-danger">Cancel</button>

						<?php echo form_close(); ?>
						<?php } ?>

						<?php
						if(preg_match('/Update/', $title)||preg_match('/View/',$title)){
						 echo form_open('Registration_Controller/updateUser/'.$user[0]->fld_username , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						?>
							<div class="form-group">
								<label for="fname">First Name</label>
								<input type="text" name="fname" class="form-control" value="<?php echo set_value('fname',$user[0]->fld_firstname);?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
								<div class="error_msg"><?php echo form_error('fname'); ?></div>
							</div>

							<div class="form-group">
								<label for="lname">Last Name</label>
								<input type="text" name="lname" class="form-control" value="<?php echo set_value('lname',$user[0]->fld_lastname);?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
								<div class="error_msg"><?php echo form_error('lname'); ?></div>
							</div>

							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo set_value('email',$user[0]->fld_email);?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
								<div class="error_msg"><?php echo form_error('email'); ?></div>
							</div>

							<div class="form-group">
								<label for="nic_no">NIC No.</label>
								<input type="text" name="nic_no" class="form-control" value="<?php echo set_value('nic',$user[0]->fld_username);?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
								<div class="error_msg"><?php echo form_error('nic_no'); ?></div>
							</div>


							<div class="form-group">
								<label for="contact">Contact No.</label>
								<input type="text" name="contact" class="form-control" value="<?php echo set_value('contact',$user[0]->fld_contactno);?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
								<div class="error_msg"><?php echo form_error('contact'); ?></div>
							</div>

							<div class="form-group">
								<label for="is_active">Is Active?</label>
									<br>
									<div class="input-group input-group-lg">
										<label class="radio-inline">
											<input type="radio" name="is_active" <?php if(preg_match('/Update/', $title)&&$user[0]->is_active==1){echo "checked";}?><?php if (preg_match('/View/', $title)){ if($user[0]->is_active==1){echo 'checked';}else {echo 'disabled';}} ?>>Active
										</label>
										<label class="radio-inline">
											<input type="radio" name="is_active" <?php if(preg_match('/Update/', $title)&&$user[0]->is_active==0){echo "checked";}?><?php if (preg_match('/View/', $title)){ if($user[0]->is_active==0){echo 'checked';}else {echo 'disabled';}} ?>>Inactive
										</label>
									</div>
							</div>

							<div class="form-group">
								<label>District</label>
								<select class="form-control" name="district" value="<?php echo set_value('district');?>"<?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
									<option value="">--Please Select--</option>
									<?php  foreach ($districts as $district):?>
									<option value="<?php  echo $district->fld_district_name;?>" <?php if($user[0]->fld_location==$district->fld_district_name ){echo "selected";}else {echo set_select('district', $district->fld_district_name);} ?>><?php  echo $district->fld_district_name;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('district'); ?></div>
							</div>

							<div class="form-group">
								<label for="user_role">User Role</label>
								<select class="form-control" name="user_role" value="<?php echo set_value('user_role');?>"<?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
									<option value="">--Please Select--</option>
									<?php  foreach ($user_role as $row):?>
									<option value="<?php  echo $row->fld_role_id;?>" <?php if($user[0]->role_id==$row->fld_role_id ){echo "selected";}else { echo set_select('user_role', $row->fld_role_id);} ?>><?php  echo $row->fld_role;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('user_role'); ?></div>
							</div>

							<div class="form-group">
								<label for="assigned_to">Assigned To</label>
								<select class="form-control" name="assigned_to" value="<?php echo set_value('assigned_to');?>"<?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
									<option value="">--Please Select--</option>
									<?php  foreach ($assigned_to as $row):?>
									<option value="<?php  echo $row->fld_username;?>" <?php if($user[0]->fld_username==$row->fld_username ){echo "selected";}else { echo set_select('assigned_to', $row->fld_username);} ?>><?php  echo $row->fld_username;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('assigned_to'); ?></div>
							</div>

							<div class="form-group">
								<label for="center">Center</label>
								<select class="form-control" name="center" value="<?php echo set_value('center');?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
									<option value="">--Please Select--</option>
									<?php  foreach ($center as $row):?>

									<option value="<?php  echo $row->id;?>" <?php if($user[0]->fld_user_center==$row->id ){echo "selected";}else { echo set_select('center', $row->id);} ?>><?php  echo $row->fld_center_name;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('center'); ?></div>
							</div>

						<button type="submit" name="submit" value="save" class="btn btn-default btn-primary" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-default btn-danger" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>Cancel</button>

						<?php echo form_close(); ?>
						<?php }?>
					</div>
					<!-- /.col-lg-6 (nested) -->
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php }else {?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Existing users
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover display responsive nowrap dataTable1">
							<thead>
								<tr>
									<th>User</th>
									<th>Username</th>
									<th>Update</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i < count($users); $i++) { ?>
								<tr>
									<td>
										<?php echo $users[$i]->fld_firstname.' '.$users[$i]->fld_lastname; ?>
									</td>
									<td>
										<?php echo $users[$i]->fld_username; ?>
									</td>

									<td>
										<div class="btn-group" role="group" >
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Registration_Controller/updateUserForm/<?php echo $users[$i]->fld_username; ?>">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Registration_Controller/viewUserForm/<?php echo $users[$i]->fld_username; ?>">
												<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
											</a>
											<?php if($users[$i]->role_id==2){?>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Monthly_Work_Plan_Form_Controller/createNewPlan/<?php echo $users[$i]->fld_username; ?>">
												<span class="glyphicon" aria-hidden="true">Plans</span>
											</a>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Activity_Form_Controller/createNewSummary/<?php echo $users[$i]->fld_username; ?>">
												<span class="glyphicon" aria-hidden="true">Summaries</span>
											</a>
											<?php }?>
										</div>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
					<!-- /.col-lg-6 (nested) -->
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>


<?php }?>

