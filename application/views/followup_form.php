<?php
//echo 'user level 1';
// print '<pre>';
// print_r($user);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">NATIONAL DANGEROUS DRUGS CONTROL</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">

		<div>
			<h4>CLIENT FOLLOW UP REPORT</h4>
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
								aria-controls="collapseOne"> Personal Details </a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in"
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
									<input type="text" name="cliendid" name="id"
										class="form-control"
										value="<?php echo set_value('cliendid'); ?>" />
									<?php echo form_error('cliendid'); ?>
								</div>
								<label class="col-sm-1 control-label" for="gender">Gender</label>
								<div class="col-sm-2">
									<select class="form-control" name="gende">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
									<?php echo form_error('gender'); ?>
								</div>
								<label class="col-sm-1 control-label" for="race">Race</label>
								<div class="col-sm-2">
									<select class="form-control" name="race">
									<?php foreach ($race as $arace):?>
										<option value="<?php echo $arace;?>"><?php echo $arace;?></option>
									<?php endforeach;?>
										<!-- <option value="Sinhalese">Sinhalese</option>
										<option value="Sri Lankan Tamil">Sri Lankan Tamil</option>
										<option value="Indian Tamil">Indian Tamil</option>
										<option value="Moor">Moor</option>
										<option value="Burgher">Burgher</option>
										<option value="Malay">Malay</option>
										<option value="Kaffir">Kaffir</option>
										<option value="Vedda">Vedda</option> -->
									</select>
									<?php echo form_error('race'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="religion" class="col-sm-3 control-label">Religion</label>
								<div class="col-sm-8">
									<select class="form-control" name="religion">
									<?php foreach ($religion as $areligion):?>
										<option value="<?php echo $areligion;?>"><?php echo $areligion;?></option>
									<?php endforeach;?>
										<!-- <option value="Buddhism">Buddhism</option>
										<option value="Hinduism">Hinduism</option>
										<option value="Islam">Islam</option>
										<option value="Cristianity">Cristianity</option> -->
									</select>
									<?php echo form_error('religion'); ?>
								</div>

							</div>


							<div class="form-group">
								<label for="id" class="col-sm-3 control-label">ID</label>
								<div class="col-sm-8">
									<input type="text" name="id" id="id" class="form-control"
										value="<?php echo set_value('id'); ?>" />
									<?php echo form_error('id'); ?>
								</div>

							</div>

							<div class="form-group">
								<label for="address" class="col-sm-3 control-label">address</label>
								<div class="col-sm-8">
									<input type="text" name="address" class="form-control"
										value="<?php echo set_value('address'); ?>" />
									<?php echo form_error('address'); ?>
								</div>


							</div>

							<div class="form-group">
								<label for="map" class="col-sm-3 control-label">Road Map</label>
								<div class="col-sm-8">
									<textarea rows="2" cols="" name="map" class="form-control"><?php echo set_value('map'); ?></textarea>
									<?php echo form_error('map'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="availablelink" class="col-sm-3 control-label">if
									available link</label>
								<div class="col-sm-8">
									<input type="text" name="availablelink" class="form-control"
										value="<?php echo set_value('availablelink'); ?>" />
									<?php echo form_error('availablelink'); ?>
								</div>

							</div>


							<div class="form-group">
								<label for="district" class="col-sm-3 control-label">District</label>
								<div class="col-sm-3">
									<select class="form-control" name="district">
									<?php foreach ($districts as $district):?>
									<option value="<?php echo $district;?>"><?php echo $district;?></option>
									<?php endforeach;?>
										<!-- <option value="Ampara">Ampara</option>
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
										<option value="Vavuniya">Vavuniya</option> -->
									</select>
									<?php echo form_error('district'); ?>
								</div>
								<label for="divisional-sec" class="col-sm-2 control-label">Divisional
									Secretariats</label>
								<div class="col-sm-3">
									<input type="text" name="divisional-sec" class="form-control" />
									<?php echo form_error('divisional-sec'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="bday" class="col-sm-3 control-label">Birth Day</label>
								<div class="col-sm-3">
									<input type="date" name="bday" class="form-control datepicker" />
									<?php echo form_error('bday'); ?>
								</div>
								<label for="age" class="col-sm-2 control-label">Age</label>
								<div class="col-sm-3">
									<input name="age" class="form-control" type="text">
									<?php echo form_error('age'); ?>
								</div>


							</div>
							<div class="form-group">
								<label for="edu" class="col-sm-3 control-label">Education Status</label>


								<div class="col-sm-2">
									<label for="edu">School Attempted</label> <select
										class="form-control" name="edu">
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<?php echo form_error('edu'); ?>
								</div>
								<div class="col-sm-2">
									<label for="scl-level">Level</label> <select
										class="form-control" name="edu-level" id="edu-level">
										<?php foreach ($school_evel as $level):?>
										<option value="<?php echo $level?>"><?php echo $level;?></option>
										<?php endforeach;?>
										<!-- <option value="Grade 5">Grade 5</option>
										<option value="Grade 6">Grade 6</option>
										<option value="Grade 7">Grade 7</option>
										<option value="Grade 8">Grade 8</option>
										<option value="Grade 9">Grade 9</option>
										<option value="Grade 10">Grade 10</option>
										<option value="O/L">O/L</option>
										<option value="A/L">A/L</option>
										<option value="Diploma">Diploma</option>
										<option value="Degree">Degree</option>
										<option value="Other">Other</option> -->
									</select>
									<?php echo form_error('scl-level'); ?>
								</div>
								<div class="col-sm-4 showhide-container"
									id="scl-other-container">
									<label for="scl-other">if Other</label> <input type="text"
										name="scl-other" class="form-control" />
									<?php echo form_error('scl-other'); ?>
								</div>




							</div>
							<div class="form-group">
								<label for="contact" class="col-sm-3 control-label">Contact
									Details</label>
								<div class="col-sm-3">
									<label for="mobile">Mobile</label> <input type="text"
										name="mobile" class="form-control" />
									<?php echo form_error('mobile'); ?>
								</div>
								<div class="col-sm-3">
									<label for="fixed">Fixed</label> <input type="text"
										name="fixed" class="form-control" />
									<?php echo form_error('fixed'); ?>
								</div>
								<div class="col-sm-2">
									<label for="marrystatus">Status</label> <select
										class="form-control" name="marrystatus">
										<?php foreach ($status as $astatus):?>
										<option value="<?php echo $astatus;?>"><?php echo $astatus;?></option>
										<?php endforeach;?>
										<!-- <option value="Married">Married</option>
										<option value="Single">Single</option>
										<option value="Widowed">Widowed</option>
										<option value="Divorced">Divorced</option>
										<option value="Remarried">Remarried</option>
										<option value="Separated">Separated</option> -->

									</select>
									<?php echo form_error('marrystatus'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="children" class="col-sm-3 control-label">How many
									children do you have</label>
								<div class="col-sm-2">
									<input type="text" name="children" class="form-control" />
									<?php echo form_error('children'); ?>
								</div>
								<label for="childunder18" class="col-sm-4 control-label">How
									many of these are under age 18</label>
								<div class="col-sm-2">
									<input type="text" name="childunder18" class="form-control" />
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
												name="med1" class="form-control" />
											<?php echo form_error('med1'); ?>
										</div>
									</div>
									<div class="row">

										<div class="col-sm-6">
											<label for="med2">Do you have any chronic medical</label> <select
												name="med2" id="med2" class="form-control">
												<option value="No">No</option>
												<option value="Yes">Yes</option>

											</select>
											<?php echo form_error('med2'); ?>
										</div>
										<div class="col-sm-6 showhide-container" id="med3-container">
											<label for="med3">If Yes</label><input type="text"
												name="med3" class="form-control" />
											<?php echo form_error('med3'); ?>
										</div>

									</div>
									<div class="row">

										<div class="col-sm-6">
											<label for="med4">Are you currently pregnant</label> <select
												name="med4" id="med4" class="form-control">
												<option value="No">No</option>
												<option value="Yes">Yes</option>

											</select>
											<?php echo form_error('med4'); ?>
										</div>
										<div class="col-sm-6 showhide-container" id="med5-container">
											<label for="med5">If pregnant,Have you seen a doctor</label>
											<select name="med5" class="form-control">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
											<?php echo form_error('med5'); ?>
										</div>

									</div>

								</div>


							</div>
							<div class="form-group">
								<label for="employment" class="col-sm-3 control-label">Employment</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<select name="employment" class="form-control">
											<?php foreach ($employments as $employment):?>
											<option value="<?php echo $employment?>"><?php echo $employment;?></option>
											<?php endforeach;?>
												<!-- <option value="Full-time (More 40 Hours)">Full-time (More 40
													Hours)</option>
												<option value="Part-time (Regular Hours)">Part-time (Regular
													Hours)</option>
												<option value="Part-time (Irregular Hours)">Part-time
													(Irregular Hours)</option>
												<option value="Student">Student</option>
												<option value="Military">Military</option>
												<option value="Retired/Disablility">Retired/Disablility</option>
												<option value="Self employment">Self employment</option>
												<option value="Unemployed">Unemployed</option>
												<option value="In controlled environment">In controlled
													environment</option>
												<option value="Homemaker">Homemaker</option>
												<option value="Begging">Begging</option> -->
											</select>
											<?php echo form_error('employment'); ?>
										</div>

									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-3">
									<label for="income1">Income(Rs.)</label> <select
										class="form-control" name="income1">
										<?php foreach ($income_list as $income):?>
											<option value="<?php echo $income;?>"><?php echo $income;?></option>
											<?php endforeach;?>
										
										<!-- <option value="Below 5000">Below 5000</option>
										<option value="5001-10000">5001-10000</option>
										<option value="10001-15000">10001-15000</option>
										<option value="15001-20000">15001-20000</option>
										<option value="20001-25000">20001-25000</option>
										<option value="More 25001">More 25001</option> -->
									</select>
									<?php echo form_error('income1'); ?>
								</div>

								<div class="col-sm-4">
									<label for="capital-for-recovery">Capital for Recovery</label>
									<select name="capital-for-recovery" class="form-control">
										<option value="Available">Available</option>
										<option value="Not Available">Not Available</option>
									</select>
									<?php echo form_error('capital-for-recovery'); ?>
								</div>

							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-3">
									<label for="people-depend-on">How many people depend on you</label>
									<input name="people-depend-on" class="form-control" type="text">
									<?php echo form_error('people-depend-on'); ?>
								</div>
								<div class="col-sm-4 ">
									<label for="nature-of-asset">Nature of Asset</label> <select
										class="form-control" name="nature-of-asset">
										<?php foreach ($nature_assets as $nature_asset):?>
											<option value="<?php echo $nature_asset;?>"><?php echo $nature_asset;?></option>
											<?php endforeach;?>
											
										<!-- <option value="Own Property">Own Property</option>
										<option value="Parents Property">Parents Property</option>
										<option value="Spouse's Property">Spouse's Property</option>
										<option value="Other">Other</option> -->
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
												suggested by the criminal justice system </label> <select
												class="form-control" name="legalstatus">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
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
											<label for="alc_drug1">Nature of Depend</label> <select
												name="alc_drug1" class="form-control" required>
												<?php foreach ($Nature_of_Depends as $Nature_of_Depend ):?>
												<option value="<?php echo $Nature_of_Depend;?>"><?php echo $Nature_of_Depend; ?></option>
												<?php endforeach;?>
												<!-- <option value="Heroin">Heroin</option>
												<option value="Cannabis">Cannabis</option>
												<option value="Alcohol">Alcohol</option>
												<option value="Opium">Opium</option>
												<option value="Cocain">Cocain</option>
												<option value="Tablet">Tablet</option>
												<option value="Babul">Babul</option>
												<option value="More than one source">More than one source</option>
												<option value="Other">Other</option> -->
											</select>
											<?php echo form_error('alc_drug1'); ?>
										</div>
										<div class="col-sm-6">
											<label for="alc_drug2">Route of Administration</label> <select
												name="alc_drug2" class="form-control">
												<?php foreach ($administration_routes as $administration_route):?>
												<option value="<?php echo $administration_route;?>"><?php echo $administration_route;?></option>
												<?php endforeach;?>
												<!-- <option value="Oral	">Oral</option>
												<option value="Nasal">Nasal</option>
												<option value="Smoking">Smoking</option>
												<option value="Non-IV Injection">Non-IV Injection</option>
												<option value="IV Injection">IV Injection</option>
												<option value="Under tongue">Under tongue</option> -->
											</select>
											<?php echo form_error('alc_drug2'); ?>
										</div>

									</div>
									<div class="row">
										<div class="col-sm-6">
											<label for="alc_drug3">Age of 1st use</label> <input
												type="text" name="alc_drug3" class="form-control" />
											<?php echo form_error('alc_drug3'); ?>
										</div>
										<div class="col-sm-6">
											<label for="alc_drug4">How many times use per day</label> <input
												type="text" name="alc_drug4" class="form-control" />
											<?php echo form_error('alc_drug4'); ?>
										</div>

									</div>




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
							<a class="collapsed" role="button" data-toggle="collapse"
								data-parent="#accordion" href="#collapseTwo"
								aria-expanded="false" aria-controls="collapseTwo"> Details about
								Custodian </a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse"
						role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<!-- forms content -->
							<div class="form-group">
								<label for="cust_name" class="col-sm-3 control-label">Custodian's
									Name</label>
								<div class="col-sm-8">
									<input type="text" name="cust_name" class="form-control" />
									<?php echo form_error('cust_name'); ?>
								</div>

							</div>
							<div class="form-group">
								<label for="cust_address" class="col-sm-3 control-label">Custodian's
									Address</label>
								<div class="col-sm-8">
									<input type="text" name="cust_address" class="form-control" />
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
												type="text" name="cust_contact_mobile" class="form-control" />
											<?php echo form_error('cust_contact_mobile'); ?>
										</div>
										<div class="col-sm-6">
											<label for="cust_contact_fixed">Fixed</label> <input
												type="text" name="cust_contact_fixed" class="form-control" />
											<?php echo form_error('cust_contact_fixed'); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<label for="relationship">What is the Relationship with
												Client </label> <select name="relationship"
												id="relationship" class="form-control">
												<?php foreach ($custodion_rilationships as $rilationship):?>
										<option value="<?php echo $rilationship;?>"><?php echo $rilationship;?></option>
									<?php endforeach;?>
												<!-- <option value="Mother">Mother</option>
												<option value="Father">Father</option>
												<option value="Brother">Brother</option>
												<option value="Sister">Sister</option>
												<option value="Partner">Partner</option>
												<option value="Spouse">Spouse</option>
												<option value="Children">Children</option>
												<option value="Mother in Law">Mother in Law</option>
												<option value="Father in Law">Father in Law</option>
												<option value="Other">Other</option> -->

											</select>
											<?php echo form_error('relationship'); ?>
										</div>
										<div class="col-sm-6 showhide-container"
											id="other-relationship-container">
											<label for="other-relationship">If Other</label> <input
												type="text" name="other-relationship" class="form-control" />
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
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse"
								data-parent="#accordion" href="#collapseThree"
								aria-expanded="false" aria-controls="collapseThree"> Progress of
								Treatment </a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse"
						role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<!-- start the fields of the ith pgress of treatement up -->
							<div id="progressOfTreatement1" class="progress-start">
								<div class="form-group">
									<label for="attempt_center1" class="col-sm-3 control-label"> <!-- 1<sup>st</sup> -->
										Attempt Center
									</label>
									<div class="col-sm-8">
										<select class="form-control" id="attempt_center1"
											name="attempt_center1">
											<?php $icount=1;?>
											<?php foreach ($follow_centers_Ids as $follow_center):?>
											<?php if ($icount!=1){?>
												<option
												value="<?php echo $follow_center['fld_center_name'];?>"
												<?php  if ($follow_center['id']==$client['follow_status'][0]->fld_assigned_cente):echo 'selected';endif;?>><?php echo $follow_center['fld_center_name'];?></option>
											<?php
												
}
												$icount ++;
												?>											
											<?php endforeach;?>
											<?php //foreach ($attempt_centers as $attempt_center):?>
											<!-- <option value=" -->
											<?php //echo $attempt_center;?>
											<!-- "> -->
											<?php //echo $attempt_center;?>
											<!-- </option> -->
											<?php //endforeach;?>
											<!-- <option value="Galle">Galle</option>
											<option value="Colombo">Colombo</option>
											<option value="Kandy">Kandy</option>
											<option value="Gampaha">Gampaha</option>
											<option value="Prison-Pallekale">Prison-Pallekale</option>
											<option value="Prison-Pallansena">Prison-Pallansena</option>
											<option value="Prison-Weerawila">Prison-Weerawila</option>
											<option value="Prison-Anuradhapura">Prison-Anuradhapura</option>
											<option value="Prison-Thaldena">Prison-Thaldena</option>
											<option value="Kandakadu">Kandakadu</option> -->
										</select>

										<?php echo form_error('attempt_center1'); ?>
									</div>

								</div>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-3">
										<label for="entered-date1">Entered Date</label> <input
											type="text" id="entered-date1" name="entered-date1"
											class="form-control datepicker" />
										<div class="errmsg"></div>
									</div>

									<div class="col-sm-4">
										<label for="discharge-date1">Discharge Date</label> <input
											type="text" id="discharge-date1" name="discharge-date1"
											class="form-control datepicker" />
										<div class="errmsg"></div>
									</div>

								</div>
								<div class="form-group">
									<label for="counsellor_name1" class="col-sm-3 control-label">Counsellor's
										Name </label>
									<div class="col-sm-8">
										<input type="text" id="counsellor_name1"
											name="counsellor_name1" class="form-control" />
										<?php echo form_error('counsellor_name1'); ?>
									</div>

								</div>
								<div class="form-group">
									<label for="counsellor_observ1" class="col-sm-3 control-label">Counsellor's
										Observation </label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="2"
											id="counsellor_observ1" name="counsellor_observ1"></textarea>
										<?php echo form_error('counsellor_observ1'); ?>
									</div>

								</div>
								<div class="form-group">
									<label for="counsellor_observ_summery1"
										class="col-sm-3 control-label">Counsellor's Observation's
										summary </label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="2"
											name="counsellor_observ_summery1"
											id="counsellor_observ_summery1"></textarea>
										<?php echo form_error('counsellor_observ_summery1'); ?>
									</div>

								</div>
							</div>

							<!-- treatements progress form fields -->

							<!-- end treatements forgress form fields -->
							<!-- 
							<input id="toggleButton1" class="btn btn-primary" type="button"
								value="Add new progress"
								onclick="counter1++; toggle41('progressOfTreatement');">
							-->
							<input id="toggleButton1" class="btn btn-primary" type="button"
								value="Add new progress"
								onclick="progIncreasecount(); progAddrows('progressOfTreatement1');progShowrow('progress-table-row-');">


						</div>
						<!-- progress of treat table -->
						<div class="progressOfTreat" style="overflow: auto">
							<div id="no-more-tables">
								<table id="progressoftreattable"
									class="table table-striped table-bordered" cellspacing="0"
									width="100%" style="display: none;">
									<thead>
										<tr>
											<th>#</th>
											<th>Attempt Center</th>
											<th>Entered Date</th>
											<th>Discharge Date</th>
											<th>Counsellor's Name</th>
											<th>Counsellor's Observation</th>
											<th>Counsellor's Observation's summary</th>
											<th>options</th>
										</tr>
									</thead>

									<tbody>
								<?php for($i=1;$i<=15;$i++):?>
									<tr id="progress-table-row-<?php echo $i;?>"
											style="display: none;">
											<td id="progress-count-table-<?php echo $i;?>" data-title="#"></td>
											<td id="progress-attempt-center-<?php echo $i;?>"
												data-title="Attempt Center"></td>
											<!--  -->
											<td id="progress-entered-date-<?php echo $i;?>"
												data-title="Entered Date"></td>
											<td id="progress-discharge-date-<?php echo $i;?>"
												data-title="Discharge Date"></td>
											<!--  -->


											<td id="progress-counsellor-name-<?php echo $i;?>"
												data-title="Counsellor's Name"></td>
											<td id="progress-counsellor-observ-<?php echo $i;?>"
												data-title="Counsellor's Observation"></td>
											<td id="progress-counsellor-observ-summery-<?php echo $i;?>"
												data-title="Counsellor's Observation's summary"></td>
											<td data-title="options">
												<div class="btn-group buttondiv-widht" role="group"">
													<button type="button" class="btn btn-default btn-sm"
														onclick="progEdit(<?php echo $i-1;?>);">
														<span class="glyphicon glyphicon-pencil"></span>
													</button>

													<button type="button" class="btn btn-default btn-sm"
														onclick="progDlete(<?php echo $i-1;?>);">
														<span class="glyphicon glyphicon-trash"></span>
													</button>
												</div>
											</td>

										</tr>
								<?php endfor;?>									
								</tbody>
								</table>
							</div>
				<?php for($i=1;$i<=15;$i++):?>
				<textarea rows="1" cols=""
								id="progress-count-table-p<?php echo $i;?>"
								name="progress-count-table-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>
							<textarea rows="1" cols=""
								id="progress-attempt-center-p<?php echo $i;?>"
								name="progress-attempt-center-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>

							<textarea rows="1" cols=""
								id="progress-entered-date-p<?php echo $i;?>"
								name="progress-entered-date-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>
							<textarea rows="1" cols=""
								id="progress-discharge-date-p<?php echo $i;?>"
								name="progress-discharge-date-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>
							<textarea rows="1" cols=""
								id="progress-counsellor-name-p<?php echo $i;?>"
								name="progress-counsellor-name-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>
							<textarea rows="1" cols=""
								id="progress-counsellor-observ-p<?php echo $i;?>"
								name="progress-counsellor-observ-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>
							<textarea rows="1" cols=""
								id="progress-counsellor-observ-summery-p<?php echo $i;?>"
								name="progress-counsellor-observ-summery-p<?php echo $i;?>"
								class="tabletextarea" readonly></textarea>	
				<?php endfor;?>
						</div>

						<!-- end progress of treate table -->
					</div>
				</div>
				<!--  -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse"
								data-parent="#accordion" href="#collapseFour"
								aria-expanded="false" aria-controls="collapseFour"> Feedback
								about Follow Ups </a>
						</h4>
					</div>
					<div id="collapseFour" class="panel-collapse collapse"
						role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
							<!-- start the fields of the ith follow up -->
							<div id="followup1" class="followup-start">
								<div class="form-group">
									<label for="ithfollowup" class="col-sm-3 control-label"> <!-- 1<sup>st</sup> -->Follow
										Up Form
									</label>
									<div class="col-sm-8">
										<!--  -->
										<div class="row">
											<div class="col-sm-6">
												<label for="feed-back-date">Date</label> <input
													name="feed-back-date1" id="feed-back-date1"
													class="form-control datepicker" type="text">
												<?php echo form_error('feed-back-date1'); ?>
											</div>
											<div class="col-sm-6">
												<label for="feed-back-place1">Place</label> <input
													name="feed-back-place1" id="feed-back-place1"
													class="form-control" type="text">
												<?php echo form_error('feed-back-place1'); ?>
											</div>
										</div>
										<!--  -->

										<div class="row">
											<div class="col-sm-12">
												<label for="Name-of-Follow-up-Officer1">Name of Follow up
													Officer</label> <input type="text"
													name="Name-of-Follow-up-Officer1"
													id="Name-of-Follow-up-Officer1" class="form-control" />
											<?php $Name_of_Follow_up_Officer='Name-of-Follow-up-Officer1';?>
										<?php echo form_error($Name_of_Follow_up_Officer); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label for="activities1" class="control-label">Activities</label>
												<select id="activities1" name="activities1"
													class="form-control">
													<?php foreach ($activities_list as $activity):?>
											<option value="<?php echo $activity;?>"
														<?php //if ($relationship==$client['personal'][0]->fld_relationship): echo 'selected'; endif;?>><?php echo $activity;?></option>
											<?php endforeach;?>
													<!-- <option value="Economic buildup activities">Economic
														buildup activities</option>
													<option value="Helthly activities">Helthly activities</option>
													<option value="Social Recognized buildup activities">Social
														Recognized buildup activities</option> -->
												</select>
											<?php $activities='activities1';?>
										<?php echo form_error($activities); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<label for="Status-of-Client1" class="control-label">Status
													of Client</label> <select id="Status-of-Client1"
													name="Status-of-Client1" class="form-control">
													<option value="Relabse">Relabse</option>
													<option value="Abstinent">Abstinent</option>

												</select>
											<?php $Status_of_Client='Status-of-Client1';?>
										<?php echo form_error($Status_of_Client); ?>
											</div>
											<div class="col-sm-6 showhide-container"
												id="Status-of-Client1-if-abstinent-container">
												<label for="Status-of-Client1-if-abstinent"
													class="control-label">If Abstinent</label> <select
													id="Status-of-Client1-if-abstinent"
													name="Status-of-Client1-if-abstinent" class="form-control">
													<option value="Permanent">Permanent</option>
													<option value="Occasalion">Occasalion</option>
												</select>
											<?php $Status_of_Client_if_absent='Status-of-Client1-if-abstinent';?>
										<?php echo form_error($Status_of_Client_if_absent); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label for="Respect-and-Honour1">Respect and Honour</label>
												<div class="row">
													<div class="col-sm-4">
														<label for="from-family-members" class="control-label">From
															Family Members</label> <select id="from-family-members"
															name="from-family-members" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $from_family_members='from-family-members';?>
										<?php echo form_error($from_family_members); ?>
													</div>
													<div class="col-sm-4">
														<label for="from-relation" class="control-label">From
															Relation </label> <select id="from-relation"
															name="from-relation" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $from_relation='from-relation';?>
										<?php echo form_error($from_relation); ?>
													</div>
													<div class="col-sm-4">
														<label for="from-neighbour" class="control-label">From
															Neighbour </label> <select id="from-neighbour"
															name="from-neighbour" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $from_neighbour='from-neighbour';?>
										<?php echo form_error($from_neighbour); ?>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<label for="to-family-members" class="control-label">To
															Family Members</label> <select id="to-family-members"
															name="to-family-members" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $to_family_members='to-family-members';?>
										<?php echo form_error($to_family_members); ?>
													</div>
													<div class="col-sm-4">
														<label for="from-relation" class="control-label">To
															Relation </label> <select id="to-relation"
															name="to-relation" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $to_relation='to-relation';?>
										<?php echo form_error($to_relation); ?>
													</div>
													<div class="col-sm-4">
														<label for="from-neighbour" class="control-label">To
															Neighbour </label> <select id="to-neighbour"
															name="to-neighbour" class="form-control">
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
											<?php $to_neighbour='to-neighbour';?>
										<?php echo form_error($to_neighbour); ?>
													</div>
												</div>

												<div class="row">

													<div class="col-sm-8">
														<label for="feedback-employment" class="control-label">Employment
														</label> <select id="feedback-employment"
															name="feedback-employment" class="form-control">
															<?php foreach ($employments as $employment):?>
															<option value="<?php echo $employment;?>"><?php echo $employment;?></option>
															<?php endforeach;?>
															<!-- <option value="Full-time (More 40 Hours)">Full-time (More
																40 Hours)</option>
															<option value="Part-time (Regular Hours)">Part-time
																(Regular Hours)</option>
															<option value="Part-time (Irregular Hours)">Part-time
																(Irregular Hours)</option>
															<option value="Student">Student</option>
															<option value="Military">Military</option>
															<option value="Retired/Disablility">Retired/Disablility</option>
															<option value="Self employment">Self employment</option>
															<option value="Unemployed">Unemployed</option>
															<option value="In controlled environment">In controlled
																environment</option>
															<option value="Homemaker">Homemaker</option>
															<option value="Begging">Begging</option> -->
														</select>
											<?php $feedback_employment='feedback-employment';?>
										<?php echo form_error($feedback_employment); ?>
													</div>
													<div class="col-sm-4">
														<label for="feedback-income" class="control-label">Income
															(Rs.) </label> <select id="feedback-income"
															name="feedback-income" class="form-control">
															<?php foreach ($income_list as $income):?>
											<option value="<?php echo $income;?>"><?php echo $income;?></option>
											<?php endforeach;?>
											
															<!-- <option value="Below 5000">Below 5000</option>
															<option value="5001-10000">5001-10000</option>
															<option value="10001-15000">10001-15000</option>
															<option value="15001-20000">15001-20000</option>
															<option value="20001-25000">20001-25000</option>
															<option value="More 25001">More 25001</option> -->
														</select>
											<?php $feedback_income='feedback-income';?>
										<?php echo form_error($feedback_income); ?>
													</div>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label for="Clients-Feedback1">Client's Feedback</label>
												<textarea class="form-control" rows="2"
													name="Clients-Feedback1" id="Clients-Feedback1"></textarea>
											<?php $Clients_Feedback='Clients-Feedback1'; ?>
										<?php echo form_error($Clients_Feedback); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label for="Officers-Observations1">Officer's Observations</label>
												<textarea class="form-control" rows="2"
													name="Officers-Observations1" id="Officers-Observations1"></textarea>
											<?php $Officers_Observations='Officers-Observations1';?>
										<?php echo form_error($Officers_Observations); ?>
											</div>
										</div>
										<!--  -->
									</div>


								</div>


							</div>


							<div>
								<input id="toggleButton" class="btn btn-primary" type="button"
									value="Add the follow up"
									onclick="increasecount(); addrows('followup1');showrow('follow-table-row-');">


								<!-- finish ith follow up -->

							</div>
							<br>
							<!-- table for follow up details -->
							<div class="fllowuptableone" style="overflow: auto">
								<div id="no-more-tables1">
									<table id="followuptable"
										class="table table-striped table-bordered" cellspacing="0"
										width="100%" style="display: none;">
										<thead class="">
											<tr>
												<th>#</th>
												<th>Date</th>
												<th>Place</th>
												<th>Name of Follow up Officer</th>
												<th>Activities</th>
												<th>Status of Client</th>
												<th>If Abstinent</th>
												<th>R&amp;H from Family</th>
												<th>R&amp;H from Relation</th>
												<th>R&amp;H from Neighbour</th>
												<th>R&amp;H to family</th>
												<th>R&amp;H to Relation</th>
												<th>R&amp;H to Neighbour</th>
												<th>Employment</th>
												<th>Income (Rs.)</th>
												<th>Client's Feedback</th>
												<th>Officer's Observations</th>
												<th>options</th>
											</tr>
										</thead>

										<tbody>
								<?php for($i=1;$i<=15;$i++):?>
									<tr id="follow-table-row-<?php echo $i;?>"
												style="display: none;">
												<td id="count-table-<?php echo $i;?>" data-title="#"></td>
												<!--  -->
												<td id="feed-back-date-table-<?php echo $i;?>"
													data-title="Date"></td>

												<td id="feed-back-place-table-<?php echo $i;?>"
													data-title="Place"></td>
												<!--  -->
												<td id="Name-of-Follow-up-Officer-table-<?php echo $i;?>"
													data-title="Name of Follow up Officer"></td>

												<td id="activities-table-<?php echo $i;?>"
													data-title="Activities"></td>
												<td id="Status-of-Client-table-<?php echo $i;?>"
													data-title="Status of Client"></td>
												<td
													id="Status-of-Client-if-abstinent-table-<?php echo $i;?>"
													data-title="If Abstinent"></td>

												<td id="from-family-members-table-<?php echo $i;?>"
													data-title="R&amp;H from Family"></td>
												<td id="from-relation-table-<?php echo $i;?>"
													data-title="R&amp;H from Relation"></td>
												<td id="from-neighbour-table-<?php echo $i;?>"
													data-title="R&amp;H from Neighbour"></td>

												<td id="to-family-members-table-<?php echo $i;?>"
													data-title="R&amp;H to family"></td>
												<td id="to-relation-table-<?php echo $i;?>"
													data-title="R&amp;H to Relation"></td>
												<td id="to-neighbour-table-<?php echo $i;?>"
													data-title="R&amp;H to Neighbour"></td>

												<td id="feedback-employment-table-<?php echo $i;?>"
													data-title="Employment"></td>
												<td id="feedback-income-table-<?php echo $i;?>"
													data-title="Income (Rs.)"></td>

												<td id="Clients-Feedback-table-<?php echo $i;?>"
													data-title="Client's Feedback"></td>
												<td id="Officers-Observations-table-<?php echo $i;?>"
													data-title="Officer's Observations"></td>
												<td data-title="options">
													<div class="btn-group buttondiv-widht" role="group">
														<button type="button" class="btn btn-default btn-sm"
															onclick="editflowup(<?php echo $i-1;?>);">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
														<button type="button" class="btn btn-default btn-sm"
															onclick="dlete(<?php echo $i-1;?>);">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</div>
												</td>

											</tr>
								<?php endfor;?>	
								</tbody>
									</table>
								</div>
								<?php for($i=1;$i<=15;$i++):?>
								<textarea rows="1" cols="" class="tabletextarea"
									id="count-table-f<?php echo $i;?>"
									name="count-table-f<?php echo $i;?>"></textarea>
								<textarea rows="1" cols="" class="tabletextarea"
									id="feed-back-date-table-f<?php echo $i;?>"
									name="feed-back-date-table-f<?php echo $i;?>"></textarea>
								<textarea rows="1" cols="" class="tabletextarea"
									id="feed-back-place-table-f<?php echo $i;?>"
									name="feed-back-place-table-f<?php echo $i;?>"></textarea>
								<textarea rows="1" cols="23" class="tabletextarea"
									id="Name-of-Follow-up-Officer-table-f<?php echo $i;?>"
									name="Name-of-Follow-up-Officer-table-f<?php echo $i;?>"
									readonly></textarea>
								<textarea rows="1" cols="10"
									id="activities-table-f<?php echo $i;?>"
									name="activities-table-f<?php echo $i;?>" class="tabletextarea"
									readonly></textarea>
								<textarea rows="1" cols="10"
									id="Status-of-Client-table-f<?php echo $i;?>"
									name="Status-of-Client-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="10"
									id="Status-of-Client-if-abstinent-table-f<?php echo $i;?>"
									name="Status-of-Client-if-abstinent-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>

								<!-- respect -->
								<textarea rows="1" cols="15"
									id="from-family-members-table-f<?php echo $i;?>"
									name="from-family-members-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="15"
									id="from-relation-table-f<?php echo $i;?>"
									name="from-relation-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="15"
									id="from-neighbour-table-f<?php echo $i;?>"
									name="from-neighbour-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>

								<textarea rows="1" cols="15"
									id="to-family-members-table-f<?php echo $i;?>"
									name="to-family-members-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="15"
									id="to-relation-table-f<?php echo $i;?>"
									name="to-relation-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="15"
									id="to-neighbour-table-f<?php echo $i;?>"
									name="to-neighbour-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>


								<textarea rows="1" cols="15"
									id="feedback-employment-table-f<?php echo $i;?>"
									name="feedback-employment-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="15"
									id="feedback-income-table-f<?php echo $i;?>"
									name="feedback-income-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>

								<!-- #respect -->
								<textarea rows="1" cols="13"
									id="Clients-Feedback-table-f<?php echo $i;?>"
									name="Clients-Feedback-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<textarea rows="1" cols="16"
									id="Officers-Observations-table-f<?php echo $i;?>"
									name="Officers-Observations-table-f<?php echo $i;?>"
									class="tabletextarea" readonly></textarea>
								<?php endfor;?>	
							</div>
							<!-- end table for follow up details -->
						</div>
					</div>
					<!--  -->
				</div>
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
	dropdownShowhide('Status-of-Client1','Abstinent','Status-of-Client1-if-abstinent-container');
	

	}


$('.datepicker').datepicker();

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

</script>