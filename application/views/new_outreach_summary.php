<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Monthly Outreach Activities Summary</h1>
		<?php if($user_role==1){?>
		<div class="col-xs-6"><label>Officer		:<?php echo $user->fld_firstname.' '.$user->fld_lastname;?></label></div>
		<div class="col-xs-6"><label>Location		:<?php echo $user->fld_location;?></label></div>
		<br><br>
		<?php }?>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php if($user_role!=1){?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Create New Monthly Summary
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<br>
						<?php
						 echo form_open('Activity_Form_Controller/insertNewSummary' , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						?>
							<div class="form-group">
								<label for="month">Month</label>
								<input type="text" name="month" class="form-control datepicker1 noDays" value="<?php echo set_value('month');?>">
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
<!--                            <div class="form-group">
                                <label>District</label>
								<select class="form-control" name="district">
                                    <option value="Ampara">Ampara</option>
                                    <option value="Anuradhapura">Anuradhapura</option>
									<option value="Badulla">Badulla</option>
                                    <option value="Batticaloa">Batticaloa</option>
									<option value="Colombo">Colombo</option>
									<option value="Galle">Galle</option>
                                    <option value="Gampaha">Gampaha</option>
									<option value="Hambanthota">Hambanthota</option>
									<option value="Jaffna">Jaffna</option>
                                    <option value="Kaluthara">Kaluthara</option>
									<option value="Kandy">Kandy</option>
                                    <option value="Kegalle">Kegalle</option>
                                    <option value="Kilinochchi">Kilinochchi</option>
                                    <option value="Kurunegala">Kurunegala</option>
									<option value="Mannar">Mannar</option>
									<option value="Matale">Matale</option>
                                    <option value="Matara">Matara</option>
									<option value="Monaragala">Monaragala</option>
									<option value="Mullativu">Mullativu</option>
									<option value="Nuwara Eliya">Nuwara Eliya</option>
									<option value="Polonnaruwa">Polonnaruwa</option>
									<option value="Puttalam">Puttalam</option>
									<option value="Rathnapura">Rathnapura</option>
									<option value="Trincomalee">Trincomalee</option>
									<option value="Vavuniya">Vavuniya</option>
								</select>
                            </div>-->
						<button type="submit" name="submit" value="save" class="btn btn-primary">Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-danger">Cancel</button>

						<?php echo form_close(); ?>
					</div>
					<!-- /.col-md-6 (nested) -->
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
<?php }?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Existing Summaries
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
										<div class="btn-group btn-group-sm" role="group" >
											<?php if($user_role!=1){ ?>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Activity_Form_Controller/monthlySummary/<?php echo $previous[$i]->form_id.'/1/'.$user->fld_username; ?>">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
<!--											.'/'.$previous[$i]->fld_month-->
											<?php } if($user_role==1){?>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Activity_Form_Controller/monthlySummary/<?php echo $previous[$i]->form_id.'/1/'.$user->fld_username; ?>">
												<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
											</a>
											<?php } ?>
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



