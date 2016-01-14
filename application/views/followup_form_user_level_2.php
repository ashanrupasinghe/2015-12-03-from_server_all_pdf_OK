<?php
/*
 * echo 'user level 2';
 * print '<pre>';
 * print_r($outreach_officer_list);
 * die();
 */
// print '<pre>';
// print_r($user);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Add a New Client</h1>
		<?php //echo validation_errors();?>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">

		<div>
			<!-- <h4>CLIENT FOLLOW UP REPORT</h4> -->
			<?php
			if ($this->session->flashdata ( 'msg' )) {
				$msg = $this->session->flashdata ( 'msg' );
				$bool = $this->session->flashdata ( 'bool' );
				if ($bool == true) {
					?>
					<div class="alert alert-success">
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
			
			
			<?php $attributes = array('class' => 'form-horizontal','name'=>'followform','id'=>'followform');?>
                            <?php echo form_open('Follow_Up_Form_Controller/addfollowup',$attributes);?>
<div class="row">
			<!--  -->
			<div class="panel-group" id="accordion" role="tablist"
				aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion"
								href="#collapseOne" aria-expanded="true"
								aria-controls="collapseOne" class="callrespons-table supermenu"> Personal Details </a>
								<?php if (form_error('name')||form_error('divisional-sec')||form_error('childunder18')){echo '<span class="glyphicon glyphicon-thumbs-down validation-err" aria-hidden="true"></span>';}?>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in personl-tab"
						role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<!--  -->



							<!-- <div class="col-sm-3 col-sm-offset-4">
						<h4 align="center">Personal Details</h4>
					</div> -->
							<!-- </div> -->
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-8">
									<input type="text" name="name" id="name" class="form-control"
										value="<?php echo set_value('name'); ?>" />
									<?php echo form_error('name'); ?>
								</div>

							</div>

							<div class="form-group">
								<label for="cliendid" class="col-sm-3 control-label">Client ID</label>
								<div class="col-sm-2">
									<input type="text" name="cliendid" id="cliendid"
										class="form-control"
										value="<?php echo set_value('cliendid'); ?>" />
									<?php echo form_error('cliendid'); ?>
								</div>
								<label class="col-sm-1 control-label" for="gender">Gender</label>
								<div class="col-sm-2">
									<?php $selected_gender = ($this->input->post('gende')) ? $this->input->post('gende') : 'Male';?>
									<select class="form-control" name="gende" id="gende">
										<option value="Male"
											<?php if ($selected_gender=="Male"){echo "selected";}?>>Male</option>
										<option value="Female"
											<?php if ($selected_gender=="Female"){echo "selected";}?>>Female</option>
									</select>
									<?php echo form_error('gender'); ?>
								</div>
								<label class="col-sm-1 control-label" for="race">Race</label>
								<div class="col-sm-2">
								<?php $selected_race = ($this->input->post('race')) ? $this->input->post('race') : $race[0][0];?>
									<select class="form-control" name="race">
									<?php foreach ($race as $arace):?>
										<option value="<?php echo $arace;?>"
											<?php if ($selected_race==$arace){echo "selected";}?>><?php echo $arace;?></option>
									<?php endforeach;?>										
									</select>
									<?php echo form_error('race'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="religion" class="col-sm-3 control-label">Religion</label>
								<div class="col-sm-8">
								<?php $selected_religion = ($this->input->post('religion')) ? $this->input->post('religion') : $religion[0][0];?>
									<select class="form-control" name="religion">									
									<?php foreach ($religion as $areligion):?>
										<option value="<?php echo $areligion;?>"
											<?php if ($selected_religion==$areligion){echo "selected";}?>><?php echo $areligion;?></option>
									<?php endforeach;?>										
									</select>
									<?php echo form_error('religion'); ?>
								</div>

							</div>


							<div class="form-group">
								<label for="id" class="col-sm-3 control-label">ID</label>
								<div class="col-sm-8">
									<input type="text" name="id" id="id" class="form-control"
										value="<?php echo $this->input->post('id'); ?>" />
									<?php echo form_error('id'); ?>
								</div>

							</div>

							<div class="form-group">
								<label for="address" class="col-sm-3 control-label">address</label>
								<div class="col-sm-8">
									<input type="text" name="address" class="form-control"
										value="<?php echo $this->input->post('address'); ?>" />
									<?php echo form_error('address'); ?>
								</div>


							</div>

							<div class="form-group">
								<label for="map" class="col-sm-3 control-label">Road Map</label>
								<div class="col-sm-8">
									<textarea rows="2" cols="" name="map" class="form-control"><?php echo $this->input->post("map");?></textarea>
									<?php echo form_error('map'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="availablelink" class="col-sm-3 control-label">if
									available link</label>
								<div class="col-sm-8">
									<input type="text" name="availablelink" class="form-control"
										value="<?php echo $this->input->post('availablelink'); ?>" />
									<?php echo form_error('availablelink'); ?>
								</div>

							</div>


							<div class="form-group">
								<label for="district" class="col-sm-3 control-label">District</label>
								<div class="col-sm-3">
								<?php $selected_district = ($this->input->post('district')) ? $this->input->post('district') : $districts[0][0];?>
									<select class="form-control" name="district">
									<?php foreach ($districts as $district):?>
									<option value="<?php echo $district;?>"
											<?php if ($selected_district==$district){echo "selected";}?>><?php echo $district;?></option>
									<?php endforeach;?>										
									</select>
									<?php echo form_error('district'); ?>
								</div>
								<label for="divisional-sec" class="col-sm-2 control-label">Divisional
									Secretariats</label>
								<div class="col-sm-3">
									<input type="text" name="divisional-sec" class="form-control"
										value="<?php echo set_value("divisional-sec");?>" />
									<?php echo form_error('divisional-sec'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="bday" class="col-sm-3 control-label">Birth Day</label>
								<div class="col-sm-3">
									<input type="text" name="bday" class="form-control datepicker"
										value="<?php echo $this->input->post('bday');?>" />
									<?php echo form_error('bday'); ?>
								</div>
								<label for="age" class="col-sm-2 control-label">Age</label>
								<div class="col-sm-3">
									<input name="age" class="form-control" type="text"
										value="<?php echo $this->input->post('age');?>">
									<?php echo form_error('age'); ?>
								</div>


							</div>
							<div class="form-group">
								<label for="edu" class="col-sm-3 control-label">Education Status</label>


								<div class="col-sm-2">
									<label for="edu">School Attempted</label> 
									<?php $selected_scl = ($this->input->post('edu')) ? $this->input->post('edu') : 'Yes';?>
									<select class="form-control" name="edu">
										<option value="Yes"
											<?php if ($selected_scl=="Yes"){echo "selected";}?>>Yes</option>
										<option value="No"
											<?php if ($selected_scl=="No"){echo "selected";}?>>No</option>
									</select>
									<?php echo form_error('edu'); ?>
								</div>
								<div class="col-sm-2">
									<label for="scl-level">Level</label> 
									<?php $selected_scl_level = ($this->input->post('edu-level')) ? $this->input->post('edu-level') : $school_evel[0][0];?>
									<select class="form-control" name="edu-level" id="edu-level">
										<?php foreach ($school_evel as $level):?>
										<option value="<?php echo $level?>"
											<?php if ($selected_scl_level==$level){echo "selected";}?>><?php echo $level;?></option>
										<?php endforeach;?>
										
									</select>
									<?php echo form_error('scl-level'); ?>
								</div>
								<div class="col-sm-4 showhide-container"
									id="scl-other-container">
									<label for="scl-other">if Other</label> <input type="text"
										name="scl-other" class="form-control"
										value="<?php echo $this->input->post('scl-other');?>" />
									<?php echo form_error('scl-other'); ?>
								</div>




							</div>
							<div class="form-group">
								<label for="contact" class="col-sm-3 control-label">Contact
									Details</label>
								<div class="col-sm-3">
									<label for="mobile">Mobile</label> <input type="text"
										name="mobile" class="form-control"
										value="<?php echo $this->input->post('mobile');?>" />
									<?php echo form_error('mobile'); ?>
								</div>
								<div class="col-sm-3">
									<label for="fixed">Fixed</label> <input type="text"
										name="fixed" class="form-control"
										value="<?php echo $this->input->post('fixed');?>" />
									<?php echo form_error('fixed'); ?>
								</div>
								<div class="col-sm-2">
									<label for="marrystatus">Status</label>
									<?php $selected_status = ($this->input->post('marrystatus')) ? $this->input->post('marrystatus') : $status[0][0];?>
									 <select class="form-control" name="marrystatus">
										<?php foreach ($status as $astatus):?>
										<option value="<?php echo $astatus;?>"
											<?php if ($selected_status==$astatus){echo "selected";}?>><?php echo $astatus;?></option>
										<?php endforeach;?>									

									</select>
									<?php echo form_error('marrystatus'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="children" class="col-sm-3 control-label">How many
									children do you have</label>
								<div class="col-sm-2">
									<input type="text" name="children" class="form-control"
										value="<?php echo $this->input->post('children');?>" />
									<?php echo form_error('children'); ?>
								</div>
								<label for="childunder18" class="col-sm-4 control-label">How
									many of these are under age 18</label>
								<div class="col-sm-2">
									<input type="text" name="childunder18" class="form-control"
										value="<?php echo $this->input->post('childunder18');?>" />
									<?php echo form_error('childunder18'); ?>
								</div>

							</div>

							<div class="form-group">
								<label for="medical" class="col-sm-3 control-label">Medical
									Status</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-12">
											<label for="med1">How many times in your life have been
												hospitalized for medical problem </label><input type="text"
												name="med1" class="form-control"
												value="<?php echo $this->input->post('med1');?>" />
											<?php echo form_error('med1'); ?>
										</div>
									</div>
									<div class="row">

										<div class="col-sm-6">
											<label for="med2">Do you have any chronic medical</label> 
											<?php $selected_med2 = ($this->input->post('med2')) ? $this->input->post('med2') : 'No';?>
											<select name="med2" id="med2" class="form-control">
												<option value="No"
												<?php if ($selected_med2=="No"){echo "selected";}?>
												>No</option>
												<option value="Yes"
													<?php if ($selected_med2=="Yes"){echo "selected";}?>>Yes</option>

											</select>
											<?php echo form_error('med2'); ?>
										</div>
										<div class="col-sm-6 showhide-container" id="med3-container">
											<label for="med3">If Yes</label><input type="text"
												name="med3" class="form-control"
												value="<?php echo $this->input->post('med3');?>" />
											<?php echo form_error('med3'); ?>
										</div>

									</div>
									<div id="client-pregnacy" class="showhide-container">
										<div class="row">

											<div class="col-sm-6">
												<label for="med4">Are you currently pregnant</label>
												<?php $selected_med4 = ($this->input->post('med4')) ? $this->input->post('med4') : 'No';?>
												 <select name="med4" id="med4" class="form-control">
													<option value="No"
														<?php if ($selected_med4=="No"){echo "selected";}?>>No</option>
													<option value="Yes"
														<?php if ($selected_med4=="Yes"){echo "selected";}?>>Yes</option>

												</select>
											<?php echo form_error('med4'); ?>
										</div>
											<div class="col-sm-6 showhide-container" id="med5-container">
												<label for="med5">If pregnant,Have you seen a doctor</label>
												<?php $selected_med5 = ($this->input->post('med5')) ? $this->input->post('med5') : 'No';?>
												<select name="med5" class="form-control">
													<option value="Yes"
														<?php if ($selected_med5=="Yes"){echo "selected";}?>>Yes</option>
													<option value="No"
														<?php if ($selected_med5=="No"){echo "selected";}?>>No</option>
												</select>
											<?php echo form_error('med5'); ?>
										</div>

										</div>
									</div>
								</div>


							</div>
							<div class="form-group">
								<label for="employment" class="col-sm-3 control-label">Employment</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<?php
											
											$selected_employement = ($this->input->post ( 'employment' )) ? $this->input->post ( 'employment' ) : $employments [0] [0];
											?> <select name="employment" class="form-control">
											<?php foreach ($employments as $employment):?>
											<option value="<?php echo $employment?>"
													<?php if ($selected_employement==$employment){echo "selected";}?>><?php echo $employment;?></option>
											<?php endforeach;?>												
											</select>
											<?php echo form_error('employment'); ?>
										</div>

									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-3">
									<label for="income1">Income(Rs.)</label> 
									<?php $selected_income1 = ($this->input->post('income1')) ? $this->input->post('income1') : $income_list[0][0];?>
									<select class="form-control" name="income1">
										<?php foreach ($income_list as $income):?>
											<option value="<?php echo $income;?>"
											<?php if ($selected_income1==$income){echo "selected";}?>><?php echo $income;?></option>
											<?php endforeach;?>										
									</select>
									<?php echo form_error('income1'); ?>
								</div>

								<div class="col-sm-4">
									<label for="capital-for-recovery">Capital for Recovery</label>
									<?php $selected_Capital_Recovery = ($this->input->post('capital-for-recovery')) ? $this->input->post('capital-for-recovery') : 'Available';?>
									<select name="capital-for-recovery" class="form-control">
										<option value="Available"
											<?php if ($selected_Capital_Recovery=="Available"){echo "selected";}?>>Available</option>
										<option value="Not Available"
											<?php if ($selected_Capital_Recovery=="Not Available"){echo "selected";}?>>Not
											Available</option>
									</select>
									<?php echo form_error('capital-for-recovery'); ?>
								</div>

							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-3">
									<label for="people-depend-on">How many people depend on you</label>
									<input name="people-depend-on" class="form-control" type="text"
										value="<?php echo $this->input->post('people-depend-on');?>">
									<?php echo form_error('people-depend-on'); ?>
								</div>
								<div class="col-sm-4 ">
									<label for="nature-of-asset">Nature of Asset</label> 
									<?php $selected_nature_assets = ($this->input->post('nature-of-asset')) ? $this->input->post('nature-of-asset') : $nature_assets[0][0];?>
									<select class="form-control" name="nature-of-asset">
										<?php foreach ($nature_assets as $nature_asset):?>
											<option value="<?php echo $nature_asset;?>"
											<?php if ($selected_nature_assets==$nature_asset){echo "selected";}?>><?php echo $nature_asset;?></option>
											<?php endforeach;?>										
									</select>
									<?php echo form_error('nature-of-asset'); ?>
								</div>

							</div>


							<div class="form-group">
								<label for="legalstatus" class="col-sm-3 control-label">Legal
									Status</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-12">
											<label for="legalstatus">Was the admission prompted or
												suggested by the criminal justice system </label> 
												<?php $selected_legalstatus = ($this->input->post('legalstatus')) ? $this->input->post('legalstatus') : 'Yes';?>
												<select class="form-control" name="legalstatus">
												<option value="Yes"
													<?php if ($selected_legalstatus=="Yes"){echo "selected";}?>>Yes</option>
												<option value="No"
													<?php if ($selected_legalstatus=="No"){echo "selected";}?>>No</option>
											</select>
											<?php echo form_error('legalstatus'); ?>
										</div>
									</div>
								</div>

							</div>

							<div class="form-group">
								<label for="alc_drug" class="col-sm-3 control-label">Alcohol/Drugs</label>
								<div class="col-sm-8">



									<div class="row">

										<div class="col-sm-6">
											<label for="alc_drug1">Nature of Depend</label> 
											<?php $selected_alc_drug1 = ($this->input->post('alc_drug1')) ? $this->input->post('alc_drug1') : $Nature_of_Depends[0][0];?>
											<select name="alc_drug1" class="form-control" required>
												<?php foreach ($Nature_of_Depends as $Nature_of_Depend ):?>
												<option value="<?php echo $Nature_of_Depend;?>"
													<?php if ($selected_alc_drug1==$Nature_of_Depend){echo "selected";}?>><?php echo $Nature_of_Depend; ?></option>
												<?php endforeach;?>											
											</select>
											<?php echo form_error('alc_drug1'); ?>
										</div>
										<div class="col-sm-6">
											<label for="alc_drug2">Route of Administration</label> 
											<?php $selected_alc_drug2 = ($this->input->post('alc_drug2')) ? $this->input->post('alc_drug2') : $administration_routes[0][0];?>
											<select name="alc_drug2" class="form-control">
												<?php foreach ($administration_routes as $administration_route):?>
												<option value="<?php echo $administration_route;?>"
													<?php if ($selected_alc_drug2==$administration_route){echo "selected";}?>><?php echo $administration_route;?></option>
												<?php endforeach;?>												
											</select>
											<?php echo form_error('alc_drug2'); ?>
										</div>

									</div>
									<div class="row">
										<div class="col-sm-6">
											<label for="alc_drug3">Age of 1st use</label> <input
												type="text" name="alc_drug3" class="form-control"
												value="<?php echo $this->input->post('alc_drug3');?>" />
											<?php echo form_error('alc_drug3'); ?>
										</div>
										<div class="col-sm-6">
											<label for="alc_drug4">How many times use per day</label> <input
												type="text" name="alc_drug4" class="form-control"
												value="<?php echo $this->input->post('alc_drug4');?>" />
											<?php echo form_error('alc_drug4'); ?>
										</div>

									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="my-checkbox" class="col-sm-3 control-label">Accept To follow</label>
								<div class="col-sm-4">

									<input type="checkbox" name="follow-up-accept"
										id="follow-up-accept" data-off-color="warning"
										data-on-text="Yes" data-off-text="No" <?php if($this->input->post('follow-up-accept')){echo 'checked';}?>>

								</div>
								<label for="assign-center" class="col-sm-2 control-label">Assign
									Center</label>
								<div class="col-sm-2">
									<?php
									
									$selected_center = ($this->input->post ( 'outrich-assigned-center' )) ? $this->input->post ( 'outrich-assigned-center' ) : $follow_centers_Ids [0] ['id'];
									?>
									<select name="outrich-assigned-center"
										id="outrich-assigned-center" class="form-control">
										<?php foreach ($follow_centers_Ids as $follow_centers_Id):?>
										<option value="<?php echo $follow_centers_Id['id'];?>"
											<?php if ($user_center==$follow_centers_Id['id']):echo 'selected';endif;?>
											<?php if ($selected_center==$follow_centers_Id['id']){echo "selected";}?>><?php echo $follow_centers_Id['fld_center_name'];?></option>
									<?php endforeach;?>																			
									</select>
								</div>
							</div>



							<!--  -->
						</div>
					</div>
				</div>

				<!--  -->
				<!--  -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="callrespons-table supermenu" role="button" data-toggle="collapse"
								data-parent="#accordion" href="#collapseTwo"
								aria-expanded="false" aria-controls="collapseTwo"> Details about
								Custodian </a>
								<?php if (form_error('cust_contact_mobile')||form_error('cust_contact_fixed')){echo '<span class="glyphicon glyphicon-thumbs-down validation-err" aria-hidden="true"></span>';}?>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse in"
						role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="cust_name" class="col-sm-3 control-label">Custodian's
									Name</label>
								<div class="col-sm-8">
									<input type="text" name="cust_name" class="form-control" value="<?php echo $this->input->post('cust_name');?>" />
									<?php echo form_error('cust_name'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="cust_address" class="col-sm-3 control-label">Custodian's
									Address</label>
								<div class="col-sm-8">
									<input type="text" name="cust_address" class="form-control" value="<?php echo $this->input->post('cust_address');?>" />
									<?php echo form_error('cust_address'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="cust_contact" class="col-sm-3 control-label">Custodian's
									Contact Details</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<label for="cust_contact_mobile">Mobile</label> <input
												type="text" name="cust_contact_mobile" class="form-control" value="<?php echo $this->input->post('cust_contact_mobile');?>" />
											<?php echo form_error('cust_contact_mobile'); ?>
										</div>
										<div class="col-sm-6">
											<label for="cust_contact_fixed">Fixed</label> <input
												type="text" name="cust_contact_fixed" class="form-control" value="<?php echo $this->input->post('cust_contact_fixed');?>" />
											<?php echo form_error('cust_contact_fixed'); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<label for="relationship">What is the Relationship with
												Client </label> <select name="relationship"
												id="relationship" class="form-control">
												<?php $selected_relationship = ($this->input->post('relationship')) ? $this->input->post('relationship') : 'Mother';?>
												<?php foreach ($custodion_rilationships as $rilationship):?>
										<option value="<?php echo $rilationship;?>"
													<?php if ($selected_relationship==$rilationship){echo "selected";}?>><?php echo $rilationship;?></option>
									<?php endforeach;?>											

											</select>
											<?php echo form_error('relationship'); ?>
										</div>
										<div class="col-sm-6 showhide-container"
											id="other-relationship-container">
											<label for="other-relationship">If Other</label> <input
												type="text" name="other-relationship" class="form-control" value="<?php echo $this->input->post('other-relationship');?>" />
											<?php echo form_error('other-relationship'); ?>
										</div>

									</div>
								</div>

							</div>

							<!-- end form content 2 -->
						</div>
					</div>
				</div>
				<!--  -->
				<!--  -->
				<!--  -->
				<div id="butonsubmit">
					<input type="submit" name="submit"
						class="btn btn-primary btn-submit" value="Submit Form"
						id="fllowup-submit" />
					<!-- <button name="button" id="button" class="btn btn-danger"
						value="true" type="reset">Reset</button> -->

				</div>
				<!--  -->


				</form>


			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<script>

window.onload=function showhideCondition(){
	dropdownShowhide('edu-level','Other','scl-other-container');
	dropdownShowhide('med2','Yes','med3-container');
	dropdownShowhide('med4','Yes','med5-container');
	dropdownShowhide('relationship','Other','other-relationship-container');
	setClientID();
	//dropdownShowhidePregnacy('gende','Female','client-pregnacy');
	//dropdownShowhide2();
	//dropdownShowhide('Status-of-Client1','Abstinent','Status-of-Client1-if-abstinent-container');
	dropdownShowhideEdit('edu-level','Other','scl-other-container');
	dropdownShowhideEdit('med2','Yes','med3-container');
	dropdownShowhideEdit('med4','Yes','med5-container');
	dropdownShowhideEdit('relationship','Other','other-relationship-container');
	//IDEA:: remove all class and inser "panel-collapse collapse" for all collaps
	/* $(document).ready(function(){
		$('.panel-collapse.in').collapse('hide');   
	}); */


	$("div:not('.personl-tab')").collapse('hide');

	}


$(".datepicker").datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	changeYear: true,
	dateFormat: 'mm/dd/yy'
	
});

$("[name='follow-up-accept']").bootstrapSwitch();


</script>

		<!-- jQuery Version 1.11.0 -->
		<script
			src="http://demo.webdemosites.com/ecolatex/assets/js/jquery-1.11.0.js"></script>

		<!-- JQuery Valdate -->
		<script
			src="http://demo.webdemosites.com/ecolatex/assets/js/jquery.validate.js"></script>
		<script type="text/javascript">

/* $().ready(function() {

	// validate signup form on keyup and submit
	$("#followform").validate({
		rules: {
			map: "required"
		},
		messages: {
			map: '<p style="color:red">*Please enter a valid email address</p>',
			
		}
	});
}); */

</script>
		<script type="text/javascript">
		

			/*on click chiled accordion menu cloase other opend child siblings*/
			$('.panel-heading a.childmenu').on('click',function(){
				
				$("div#accordion-c6 > div div.in").collapse('hide');
				
			})
			/*on click parent accordion menu cloase other opend siblings*/
			$('.panel-heading a.supermenu').on('click',function(){	
				
				$("div#accordion > div div.in").collapse('hide');
			})

</script>