<?php if ($this->session->flashdata('index_no')) { ?>
	<div class="alert alert-success alert-dismissable" >
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		You have successfully inserted the entry. &nbsp;<strong> Index No : <?php echo $this->session->flashdata('index_no') ?></strong>

	</div>
<?php } ?>

<!-- success msg when updated-->
<?php if ($this->session->flashdata('tbl_id')) { ?>
	<div class="alert alert-success alert-dismissable" >
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		You have successfully updated the entry &nbsp;<strong><?php echo $this->session->flashdata('tbl_id') ?></strong>
	</div>
<?php } ?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Forms</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Basic Form Elements
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<?php
						if (preg_match('/Edit/', $title) || preg_match('/View/', $title)) {
							echo form_open('Activity_Form_Controller/updateForm/' . $type . '/' . $results[0]->tbl_id, array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						} else {
							echo form_open('Activity_Form_Controller/insertForm/' . $type , array('name' => 'myform', 'id' => 'myform', 'class' => 'form'));
						}
						?>
						<?php for ($i = 0; $i < count($headers); $i++) { ?>
							<div class="form-group">
							<?php
								if ($headers[$i]->fld_heading_name == "Type") {
								$val = $headers[$i]->fld_save_column;
							?>
								<input type="hidden" name="<?php echo $headers[$i]->fld_save_column ?>" id="<?php echo $headers[$i]->fld_save_column ?>" value="<?php if (preg_match('/Add/', $title)){echo $vehicle;} else if (preg_match('/Edit/', $title) || preg_match('/View/', $title)) {echo $results[0]->$val;} ?>">
							<?php }
								else if ($headers[$i]->fld_heading_name == "Date") {
								$val = $headers[$i]->fld_save_column;
							?>
								<label><?php echo $headers[$i]->fld_heading_name ?></label>
								<input id="datepicker" class="form-control" name="<?php echo $headers[$i]->fld_save_column ?>" id="<?php echo $headers[$i]->fld_save_column ?>" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)) {echo $results[0]->$val;} ?>" <?php if (preg_match('/View/', $title)){echo 'disabled';} ?>>
							<?php }
								else if ($headers[$i]->fld_heading_name == "Time Period") {
								$val = $headers[$i]->fld_save_column;
								if (preg_match('/Edit/', $title) || preg_match('/View/', $title)) {
									$datetext = $results[0]->$val;
									$dates = explode(" to ", $datetext);
								}
							?>
								<label><?php echo $headers[$i]->fld_heading_name ?></label>
									<div class="row">
										<div class="form-group">
											<div class="col-xs-1"><label for="title">From</label></div>
											<div class="col-xs-5">
												<input type="text" id="from" name="from" class="form-control" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $dates[0];} ?>" <?php if (preg_match('/View/', $title)){echo 'disabled';} ?>>
											</div>
											<div class="col-xs-1"><label for="title" class="pull-right">To</label></div>
											<div class="col-xs-5">
												<input type="text" id="to" name="to" class="form-control" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $dates[1];} ?>" <?php if (preg_match('/View/', $title)){ echo 'disabled';} ?>>
											</div>
										</div>
									</div>
							<?php }
								else {
								$val = $headers[$i]->fld_save_column;
							?>
								<label><?php echo $headers[$i]->fld_heading_name ?></label>
								<input class="form-control" name="<?php echo $headers[$i]->fld_save_column ?>" id="<?php echo $headers[$i]->fld_save_column ?>" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->$val; } ?>" <?php if (preg_match('/View/', $title)){echo 'disabled';} ?>>
								<?php } ?>

							</div>
						<?php } ?>
						<button type="submit" name="submit" value="save" class="btn btn-default" <?php if (preg_match('/View/', $title)){echo 'disabled';} ?>>Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-default" <?php if (preg_match('/View/', $title)){echo 'disabled';} ?>>Cancel</button>

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
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Basic Form Elements
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="dataTable_wrapper">
						<table id="dataTables-example" class="table table-striped table-bordered table-hover display responsive nowrap">
							<thead>
							<tr>
								<?php for ($j = 0; $j < count($headers); $j++){ 30 ?>
									<th><?php echo $headers[$j]->fld_heading_name ?></th><?php } ?>
									<th>Actions</th>
							</tr>
							</thead>

							<tbody>
								<?php for ($k = 0; $k < count($previous); $k++) { ?>
							<tr>
								<?php for ($i = 0; $i < count($headers); $i++) { ?>
									<td>
										<?php
										$val = $headers[$i]->fld_save_column;
										echo $previous[$k]->$val;
										?>
									</td>
								<?php } ?>
									<td>
										<div class="btn-group" role="group" >
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Activity_Form_Controller/viewForm/<?php echo $type; ?>/<?php echo $previous[$k]->tbl_id ?>/<?php if ($type == 6) {echo $previous[$k]->fld_type; } ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Activity_Form_Controller/viewCallCenterForm/<?php echo $type; ?>/<?php echo $previous[$k]->tbl_id ?>/<?php if ($type == 6){echo $previous[$k]->fld_type;} ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
										</div>
									</td>
							</tr>
								<?php } ?>
							</tbody>

						</table>
						</div>

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

