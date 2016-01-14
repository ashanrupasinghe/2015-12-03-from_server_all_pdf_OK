<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Monthly Work Plan</h1>
	</div>

	<?php if($user_role==1){?>
		<div class="col-xs-6"><label>Officer		:<?php echo $user->fld_firstname.' '.$user->fld_lastname;?></label></div>
		<div class="col-xs-6"><label>Location		:<?php echo $user->fld_location;?></label></div>
		<br><br>
	<?php }?>

	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
$role=$this->session->userdata('role');
if($role!=1){?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Create New Plan
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<br>
						<?php
						 echo form_open('Monthly_Work_Plan_Form_Controller/insertNewPlan' , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						?>
							<div class="form-group">
								<label for="month">Month</label>
								<input type="text" name="month" class="form-control datepicker1 noDays" value="<?php echo set_value('month'); ?>">
								<div class="error_msg"><?php echo form_error('month'); ?></div>
							</div>

							<div class="form-group">
								<label>District</label>
								<select class="form-control" name="district">
									<option value="">--Please Select--</option>
									<?php  foreach ($district as $row):?>
									<option value="<?php  echo $row->fld_district_name;?>" <?php echo  set_select('district', $row->fld_district_name); ?>><?php  echo $row->fld_district_name;?></option>
									<?php endforeach;?>
								</select>
								<div class="error_msg"><?php echo form_error('district'); ?></div>
							</div>

						<button type="submit" name="submit" value="save" class="btn btn-primary">Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-danger">Cancel</button>

						<?php echo form_close(); ?>
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
<?php } ?>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Existing Monthly Plans
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover display responsive nowrap dataTable1">
							<thead>
								<tr>
									<th>Month</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i < count($previous); $i++) { ?>
								<tr>
									<td>
										<?php echo $previous[$i]->fld_month; ?>
									</td>
									<td>
										<div class="btn-group" role="group" >
											<?php if($role!=1){ ?>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Monthly_Work_Plan_Form_Controller/monthlyPlan/<?php echo $previous[$i]->form_id.'/'.$user->fld_username; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<?php } if($role==1){?>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Monthly_Work_Plan_Form_Controller/monthlyPlan/<?php echo $previous[$i]->form_id.'/'.$user->fld_username; ?>"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
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




