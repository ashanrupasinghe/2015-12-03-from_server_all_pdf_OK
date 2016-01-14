<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Clients Details</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12 table-bg">

		<div>
			<!-- <h4>CLIENT FOLLOW UP REPORT</h4> -->
			<?php
			if ($this->session->flashdata ( 'msg' )) {
				$msg = $this->session->flashdata ( 'msg' );
				$bool = $this->session->flashdata ( 'bool' );
				if ($bool == true) {
					?>
					<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success! </strong><?php echo $msg;?>
			</div>
					<?php
				} else {
					?>
<div class="alert alert-danger">
				<strong>OOPS..</strong> <?php echo $msg;?>
</div>
<?php
				}
			}
			?>
		</div>



		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a id="accor1" data-toggle="collapse" data-parent="#accordion"
							class="supermenu" href="#collapse2"><?php if ($user_center!=1){echo 'Clients Assign to the Center';}else{echo 'My Clients List-Accepted follows';}?></a>
					</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse in">
					<div class="panel-body">
					<?php  if (empty($clent_details['clients_data_My_accept'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





					<?php
							endif;
					?>
<?php if (!empty($clent_details['clients_data_My_accept'])):?>
						<table id="myTable-2" class="table responsivetable"
							style="width: auto !important">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

						$count2 = 1;
						// $state=$data['follow_statuse'];

						?>
<?php foreach ($clent_details['clients_data_My_accept'] as $clent_accept):?>


			<tr
									class="<?php if ($count2%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($clent_accept->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($clent_accept->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-refresh'; endif;?>"
										aria-hidden="true"></span><?php echo $count2;?></td>
									<td><?php echo $clent_accept->fld_client_id ;?></td>
									<td><?php echo $clent_accept->fld_gender ;?></td>
									<td><?php echo $clent_accept->fld_name ; ?></td>
									<td><?php echo $clent_accept->fld_address ; ?></td>
									<td><?php echo $clent_accept->fld_id ; ?></td>
									<td><?php echo $clent_accept->fld_contact_mobile ; ?></td>
									<td><?php echo $clent_accept->fld_contact_fixed ; ?></td>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_accept->form_id.'/1');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_accept->form_id.'/1/1');?>" class="btn btn-default btn-sm" role="button"><span
											class="glyphicon glyphicon-list-alt"></span></a></td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count2++;?>

<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>
					</div>
				</div>
			</div>
<?php if ($user_center==1):?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a id="accor2" data-toggle="collapse" class="supermenu"
							data-parent="#accordion" href="#collapse1">My Clients
							List-Rejected follows</a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">
					<?php  if (empty($clent_details['clients_data_My_reject'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





	<?php
							endif;
	?>
<?php if (!empty($clent_details['clients_data_My_reject'])):?>
						<table id="myTable-1" class="table responsivetable">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

		$count1 = 1;
		// $state=$data['follow_statuse'];

		?>
<?php foreach ($clent_details['clients_data_My_reject'] as $clent_reject):?>
			<tr
									class="<?php if ($count1%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($clent_reject->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($clent_reject->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-remove'; endif;?>"
										aria-hidden="true"></span><?php echo $count1;?></td>
									<td><?php echo $clent_reject->fld_client_id ;?></td>
									<td><?php echo $clent_reject->fld_gender ;?></td>
									<td><?php echo $clent_reject->fld_name ; ?></td>
									<td><?php echo $clent_reject->fld_address ; ?></td>
									<td><?php echo $clent_reject->fld_id ; ?></td>
									<td><?php echo $clent_reject->fld_contact_mobile ; ?></td>
									<td><?php echo $clent_reject->fld_contact_fixed ; ?></td>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_reject->form_id.'/0');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_reject->form_id.'/0/1');?>" class="btn btn-default btn-sm" role="button"><span
											class="glyphicon glyphicon-list-alt"></span></a></td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count1++;?>
<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>

					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							class="supermenu" href="#collapse4">Other's Clients List-Accepted
							follows</a>
					</h4>
				</div>
				<div id="collapse4" class="panel-collapse collapse in">
					<div class="panel-body">
<?php  if (empty($clent_details['clients_data_others_accept'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





	<?php
							endif;
	?>

<?php if (!empty($clent_details['clients_data_others_accept'])):?>
						<table id="myTable-4" class="table responsivetable">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

		$count4 = 1;
		// $state=$data['follow_statuse'];

		?>
<?php foreach ($clent_details['clients_data_others_accept'] as $clent_others_accept):?>
			<tr
									class="<?php if ($count4%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($clent_others_accept->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($clent_others_accept->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-refresh'; endif;?>"
										aria-hidden="true"></span><?php echo $count4;?></td>
									<td><?php echo $clent_others_accept->fld_client_id ;?></td>
									<td><?php echo $clent_others_accept->fld_gender ;?></td>
									<td><?php echo $clent_others_accept->fld_name ; ?></td>
									<td><?php echo $clent_others_accept->fld_address ; ?></td>
									<td><?php echo $clent_others_accept->fld_id ; ?></td>
									<td><?php echo $clent_others_accept->fld_contact_mobile ; ?></td>
									<td><?php echo $clent_others_accept->fld_contact_fixed ; ?></td>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_others_accept->form_id.'/1');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_others_accept->form_id.'/1/1');?>" class="btn btn-default btn-sm" role="button"><span
											class="glyphicon glyphicon-list-alt"></span></a></td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count4++;?>
<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							class="supermenu" href="#collapse3">Other's Clients List-Rejected
							follows</a>
					</h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse in">
					<div class="panel-body">

					<?php  if (empty($clent_details['clients_data_others_reject'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





	<?php
							endif;
	?>


<?php if ($clent_details['clients_data_others_reject']):?>
						<table id="myTable-3" class="table responsivetable">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

		$count3 = 1;
		// $state=$data['follow_statuse'];

		?>
<?php foreach ($clent_details['clients_data_others_reject'] as $clent_other_reject):?>
			<tr
									class="<?php if ($count3%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($clent_other_reject->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($clent_other_reject->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-remove'; endif;?>"
										aria-hidden="true"></span><?php echo $count3;?></td>
									<td><?php echo $clent_other_reject->fld_client_id ;?></td>
									<td><?php echo $clent_other_reject->fld_gender ;?></td>
									<td><?php echo $clent_other_reject->fld_name ; ?></td>
									<td><?php echo $clent_other_reject->fld_address ; ?></td>
									<td><?php echo $clent_other_reject->fld_id ; ?></td>
									<td><?php echo $clent_other_reject->fld_contact_mobile ; ?></td>
									<td><?php echo $clent_other_reject->fld_contact_fixed ; ?></td>
									<?php $url_segment3=array('Follow_Up_Form_Controller','editClientDetails','$clent_other_reject->form_id');?>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_other_reject->form_id.'/0');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_other_reject->form_id.'/0/1');?>" class="btn btn-default btn-sm" role="button"><span
											class="glyphicon glyphicon-list-alt"></span></a></td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count3++;?>
<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							class="supermenu" href="#collapse3f">Other's Clients
							List-assigned to them by admin/center</a>
					</h4>
				</div>
				<div id="collapse3f" class="panel-collapse collapse in">
					<div class="panel-body">

					<?php  if (empty($clent_details['clients_data_others_assigned_to_other'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





	<?php
							endif;
	?>


<?php if ($clent_details['clients_data_others_assigned_to_other']):?>
						<table id="myTable-3" class="table responsivetable">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

		$count3f = 1;
		// $state=$data['follow_statuse'];

		?>
<?php foreach ($clent_details['clients_data_others_assigned_to_other'] as $clent_other_assigned):?>
			<tr
									class="<?php if ($count3f%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($clent_other_assigned->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($clent_other_assigned->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-refresh'; endif;?>"
										aria-hidden="true"></span><?php echo $count3f;?></td>
									<td><?php echo $clent_other_assigned->fld_client_id ;?></td>
									<td><?php echo $clent_other_assigned->fld_gender ;?></td>
									<td><?php echo $clent_other_assigned->fld_name ; ?></td>
									<td><?php echo $clent_other_assigned->fld_address ; ?></td>
									<td><?php echo $clent_other_assigned->fld_id ; ?></td>
									<td><?php echo $clent_other_assigned->fld_contact_mobile ; ?></td>
									<td><?php echo $clent_other_assigned->fld_contact_fixed ; ?></td>
									<?php $url_segment3=array('Follow_Up_Form_Controller','editClientDetails','$clent_other_assigned->form_id');?>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_other_assigned->form_id.'/1');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent_other_assigned->form_id.'/1/1');?>" class="btn btn-default btn-sm" role="button"><span
											class="glyphicon glyphicon-list-alt"></span></a></td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count3f++;?>
<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>
					</div>
				</div>
			</div>


			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							class="supermenu" href="#collapse5">Assigned Clients To Me By
							Centers and Admin</a>
					</h4>
				</div>
				<div id="collapse5" class="panel-collapse collapse in">
					<div class="panel-body">
					<?php  if (empty($clent_details['clients_data_assigned_to_me'])):?>
							<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="no-result-treatment-progress"
									class="col-sm-3 control-label">No Result to Display</label>
							</div>
						</div>





	<?php
							endif;
	?>


					<?php if ($clent_details['clients_data_assigned_to_me']):?>
						<table id="myTable-5" class="table responsivetable">
							<thead>
								<tr>
									<th>index</th>
									<th>Client ID</th>
									<th>Gender</th>
									<th>Name</th>
									<th>Address</th>
									<th>NIC</th>
									<th>Mobile</th>
									<th>Fixed</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
<?php

		$count5 = 1;
		// $state=$data['follow_statuse'];

		?>
<?php foreach ($clent_details['clients_data_assigned_to_me'] as $client_data_assigned_to_me):?>
			<tr
									class="<?php if ($count5%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?> <?php if ($client_data_assigned_to_me->fld_free_drug==1): echo 'free-from-drug';endif;?>">
									<td><span
										class="<?php if ($client_data_assigned_to_me->fld_free_drug==1): echo 'glyphicon glyphicon-ok'; else: echo 'glyphicon glyphicon-refresh'; endif;?>"
										aria-hidden="true"></span><?php echo $count5;?></td>
									<td><?php echo $client_data_assigned_to_me->fld_client_id ;?></td>
									<td><?php echo $client_data_assigned_to_me->fld_gender ;?></td>
									<td><?php echo $client_data_assigned_to_me->fld_name ; ?></td>
									<td><?php echo $client_data_assigned_to_me->fld_address ; ?></td>
									<td><?php echo $client_data_assigned_to_me->fld_id ; ?></td>
									<td><?php echo $client_data_assigned_to_me->fld_contact_mobile ; ?></td>
									<td><?php echo $client_data_assigned_to_me->fld_contact_fixed ; ?></td>
									<?php $url_segment3=array('Follow_Up_Form_Controller','editClientDetails','$clent_other_reject->form_id');?>
									<td><a class="btn btn-default btn-sm"
										href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$client_data_assigned_to_me->form_id.'/1');?>"
										role="button"><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$client_data_assigned_to_me->form_id.'/1/1');?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-list-alt"></span></a>
										</td>
						<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
				</tr>
			<?php $count5++;?>
<?php endforeach;?>
		</tbody>
						</table>
<?php endif;?>
					</div>
				</div>
			</div>
<?php endif;?>


			<!--  -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapse8" class="callrespons-table supermenu">Summary</a>
					</h4>
				</div>
				<div id="collapse8" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="row summery-form" id="summery-form">
							<div class="form-group">
								<div class="col-xs-3">
									<input id="start-date" name="start-date"
										class="form-control datepicker" type="text"
										placeholder="Start Date">
								</div>

								<div class="col-xs-3">
									<input id="end-date" name="end-date"
										class="form-control datepicker" type="text"
										placeholder="End Date">
								</div>
								<div class="col-xs-3">
									<button type="button" class="btn btn-primary btn-block" data-toggle="tooltip" title="Get summary"
										onclick="getsummery('start-date','end-date');">
									<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
									</button>
								</div>
								<div class="col-xs-3">
									<button type="button" class="btn btn-warning btn-block" data-toggle="tooltip" title="Get summary pdf"
										onclick="getpdf('summery-admin','<?php echo $pdf_name;?>');">
									<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
									</button>
								</div>
							</div>
							</form>
						</div>

						<div id="summery-admin" style=""></div>
					</div>
				</div>
			</div>
			<!--  -->

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapse7" class="supermenu">Search user</a>
					</h4>
				</div>
				<div id="collapse7" class="panel-collapse collapse in">
					<div class="panel-body">
						<!--start  search form -->
						<div class="row" style="background-color: rgb(245, 245, 245);">
							<div class="col-lg-2 col-md-2 search-option"
								style="padding-top: 15px; background-color: rgb(245, 245, 245);">
								<form class="form-horizontal">
									<div class="form-group">
										<!-- <label for="search-gender" class="col-sm-3 control-label">Gender</label> -->
										<div class="col-sm-12">
											<select name="search-gender" id="search-gender"
												class="form-control">
												<option value="">Gender</option>
												<option vlaue="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<!-- <label for="search-form-id" class="col-sm-3 control-label">Form
											ID</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-form-id" id="search-form-id"
												class="form-control" placeholder="Form Id">
										</div>
									</div>

									<div class="form-group">
										<!-- <label for="search-name" class="col-sm-3 control-label">Name</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-name" id="search-name"
												class="form-control" placeholder="Name">
										</div>
									</div>

									<div class="form-group">
										<!-- <label for="search-address" class="col-sm-3 control-label">Area</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-address" id="search-address"
												class="form-control" placeholder="Area">
										</div>
									</div>

									<div class="form-group">
										<!-- <label for="search-nic" class="col-sm-3 control-label">NIC</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-nic" id="search-nic"
												class="form-control" placeholder="NIC">
										</div>
									</div>
									<div class="form-group">
										<!-- <label for="search-client-id" class="col-sm-3 control-label">Client
											ID</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-client-id"
												id="search-client-id" class="form-control"
												placeholder="Client ID">
										</div>
									</div>

									<div class="form-group">
										<!-- <label for="search-phone" class="col-sm-3 control-label">Phone</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-phone" id="search-phone"
												class="form-control" placeholder="Mobile">
										</div>
									</div>
									<div class="form-group">
										<!-- <label for="search-phone" class="col-sm-3 control-label">Phone</label> -->
										<div class="col-sm-12">
											<input type="text" name="search-phone-f" id="search-phone-f"
												class="form-control" placeholder="Fixed">
										</div>
									</div>
									<div class="form-group">
										<!-- <label for="search-submit" class="col-sm-3 control-label"></label> -->
										<div class="col-sm-12">
											<button type="button"
												class="btn btn-primary btn-sm btn-block"
												onclick="searchUsers('<?php echo $user_role;?>');">Search</button>
										</div>
									</div>

									<!-- end search form -->
								</form>
							</div>
							<div class="col-lg-10 col-md-10" id="search-results"
								class="table-responsive"
								style="overflow: auto; height: 426px; border: medium none beige; border-color: rgb(255, 255, 255); border-width: 4px; border-style: double; margin-top: 15px; margin-bottom: 0px; margin-left: -7px; text-align: center;">
								<!-- <h1 style="margin-top: 190px;">search results will be displayed
									here</h1> -->
								<!--
									http://stackoverflow.com/questions/19701728/call-javascript-function-after-ajax-load

									 -->


								<table id="search-result-table"
									class="table search-result-table">
									<thead>
										<tr>

											<th>Form id</th>
											<th>Client ID</th>
											<th>Name</th>
											<th>Address</th>
											<th>NIC</th>
											<th>Mobile</th>
											<th>Fixed</th>
											<th>Options</th>

										</tr>
									</thead>
								</table>

							</div>

						</div>


					</div>
				</div>
			</div>
		</div>

	<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
    });
    </script>