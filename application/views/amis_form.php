<?php if ($this->session->flashdata('index_no')) { ?>
<div class="mws-form-message success" role="alert">
	You have successfully inserted the entry. &nbsp;<strong> Index No : <?php echo $this->session->flashdata('index_no') ?></strong>
</div>
<?php } ?>
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span>Arrested Monitoring Information System Data Capture Form</span>
	</div>
	<div class="mws-panel-body no-padding">
                         <?php
																									if (preg_match ( '/Edit/', $title ) || preg_match ( '/View/', $title )) {
																										echo form_open ( 'AMIS_Form_Controller/updateForm/' . $results [0]->amis_form_id, array (
																												'name' => 'myform',
																												'id' => 'myform',
																												'class' => 'mws-form' 
																										) );
																									} else if (preg_match ( '/Approve/', $title )) {
																										echo form_open ( 'AMIS_Form_Controller/approveForm/' . $results [0]->amis_form_id, array (
																												'name' => 'myform',
																												'id' => 'myform',
																												'class' => 'mws-form' 
																										) );
																									} else {
																										echo form_open ( 'AMIS_Form_Controller/insertForm', array (
																												'name' => 'myform',
																												'id' => 'myform',
																												'class' => 'mws-form' 
																										) );
																									}
																									?>         <?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){?>
                        <input type="hidden"
			value="<?php echo $results[0]->fld_ref_no; ?>" name="fld_ref_no"
			id="fld_ref_no"> <input type="hidden"
			value="<?php echo $results[0]->fld_from; ?>" name="fld_from"
			id="fld_from">
                        
                        <?php } ?>
                                
                    		<div class="mws-form">
			<input type="hidden" id="row_count" name="row_count"
				<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){?>
				value="<?php echo count($other_name)?>" <?php } else { ?> value="1"
				<?php }?>>
			<div class="mws-form-row">
				<label for="suspect_name" class="mws-form-label"><?php echo lang('Full Name of the Suspect') ?></label>
				<div class="mws-form-item">
					<input type="text" class="small required" id="suspect_name"
						placeholder="" name="suspect_name"
						value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_suspect_name; } ?>"
						required>
				</div>
			</div>

			<div class="mws-form-row">
				<label for="other_names" class="mws-form-label"><?php echo lang('Other Names') ?></label>
				<div class="mws-form-item" id="other">
					<div class="mws-form-cols">
						<div class="mws-form-col-4-8" style="padding-bottom: 10px;">
							<input type="text" class="small" id="other_names_1"
								placeholder="" name="other_names_1[]"
								value="<?php if((preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title))&& count($other_name)>0){ echo $other_name[0]->fld_other_name; } ?>">
						</div>
						<div class="mws-form-col-1">
							<button type="button" id="btAdd">
								<i class="icon-plus"></i>
							</button>
						</div>
						<div class="mws-form-col-1">
							<button type="button" id="btRemove">
								<i class="icon-minus"></i>
							</button>
						</div>

					</div>
                   <?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ ?>
                                               <?php for($k=1;$k< count($other_name);$k++){?>
                                                 <div
						id="add_<?php echo $k+1;?>" class="mws-form-cols">
						<div class="mws-form-col-4-8" style="padding-bottom: 10px;">
							<input type="text" class="small"
								id="other_names_<?php echo $k+1;?>" placeholder=""
								name="other_names_<?php echo $k+1;?>[]"
								value="<?php  echo $other_name[$k]->fld_other_name; ?>">
						</div>
					</div>
                                                <?php }?>
                                            <?php } ?>
                    
                </div>
			</div>

			<div class="mws-form-row">
				<label for="special_description" class="mws-form-label"><?php echo lang('Any other special description to identify the suspect') ?></label>
				<div class="mws-form-item">
					<textarea type="text" class="small" id="special_description"
						placeholder="" name="special_description"><?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_special_desc; } ?></textarea>
				</div>
			</div>

			<div class="mws-form-row">

				<label for="sex" class="mws-form-label"><?php echo lang('Sex') ?></label>

				<div class="mws-form-item">
					<ul class="mws-form-list inline">
						<li><input id="gender_male" type="radio" name="gender"
							value="Male"
							<?php if((preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)) &&   "Male" == $results[0]->fld_sex){ echo 'checked' ;} ?>>
							<label for="gender_male" style="padding-right: 40px;">Male</label></li>
						<li><input id="gender_female" type="radio" name="gender"
							value="Female"
							<?php if((preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)) &&   "Female" == $results[0]->fld_sex){ echo 'checked' ;} ?>>
							<label for="gender_female">Female</label></li>
					</ul>
				</div>
			</div>


			<div class="mws-form-row">
				<label for="age" class="mws-form-label"><?php echo lang('Age') ?></label>

				<div class="mws-form-item">
					<div class="small">
						<input type="text" class="mws-spinner" id="age" name="age" min="0"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_age; } ?>">
					</div>
				</div>
			</div>


			<div class="mws-form-row">
				<label for="nationality" class="mws-form-label"><?php echo lang('Nationality') ?></label>
				<div class="mws-form-item">
					<input type="text" class="small" id="other_names" placeholder=""
						name="nationality"
						value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_nationality; } ?>">
				</div>
			</div>

			<div class="mws-form-row">
				<label for="address" class="mws-form-label"><?php echo lang('Address') ?></label>
				<div class="mws-form-item">
					<input type="text" class="small" id="other_names" placeholder=""
						name="address"
						value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_address; } ?>">
				</div>

			</div>

			<div class="mws-form-row">
				<label for="nic" class="mws-form-label"><?php echo lang('NIC No') ?></label>
				<div class="mws-form-item">
					<input type="text" class="small" id="nic" placeholder="" name="nic"
						value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_nic; } ?>"
						required>
				</div>
			</div>

			<div class="mws-form-row">
				<label for="place_arrested" class="mws-form-label"><?php echo lang('Place arrested & Police Area') ?></label>
				<div class="mws-form-cols">
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Place Arrested') ?></label> <input
							type="text" class="small" id="" placeholder=""
							name="place_arrested"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_place_arrested; } ?>">
					</div>
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Police Area') ?></label> <select
							id="police_area" class="small" name="police_area">

							<option value="0">Select option</option>
                                            <?php foreach ($policestations as $policestation) { ?>

                                                <option
								<?php if((preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)) &&   $policestation->code == $results[0]->fld_police_area_arrested){ echo 'selected' ;} ?>
								value="<?php echo $policestation->code ?>">
                                                    <?php
																																													echo $policestation->station;
																																													?>
                                                </option>
                                            <?php } ?>
                  </select>
					</div>

				</div>
			</div>

			<div class="mws-form-row">
				<label for="suspect_name" class="mws-form-label"><?php echo lang('Date of arrest & Time') ?></label>
				<div class="mws-form-cols">
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Date') ?></label> <input type="text"
							class="small" id="datepicker" placeholder="" name="arrested_date"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_date_of_arrest; } ?>">
					</div>
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Time') ?></label><input type="text"
							class="small" id="timepicker" placeholder="" name="arrested_time"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_time_of_arrest; } ?>">
					</div>

				</div>
			</div>



			<div class="mws-form-row">
				<label for="police_station" class="mws-form-label"><?php echo lang('Arrested Police Station') ?></label>
				<div class="mws-form-item">
					<select id="police_station" class="small" name="police_station">

						<option value="0">Select option</option>
                                            <?php foreach ($policestations as $policestation) { ?>

                                                <option
							<?php if((preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)) &&   $policestation->code == $results[0]->fld_police_station){ echo 'selected' ;} ?>
							value="<?php echo $policestation->code ?>">
                                                    <?php
																																													echo $policestation->station;
																																													?>
                                                </option>
                                            <?php } ?>
                  </select>
				</div>
			</div>

			<div class="mws-form-row">
				<label for="name_rank" class="mws-form-label"><?php echo lang('Arrested by :- (Name/Reg. No. & Rank)') ?></label>
				<div class="mws-form-cols">
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Name') ?></label> <input type="text"
							class="small" id="" placeholder="" name="arrested_by_name"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_arrested_by_name; } ?>">
					</div>
					<div class="mws-form-col-2-8">
						<label><?php echo lang('Rank') ?></label><input type="text"
							class="small" id="" placeholder="" name="arrested_by_rank"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_arrested_by_rank; } ?>">
					</div>

				</div>
			</div>

			<div class="mws-form-row">
				<label for="reason" class="mws-form-label"><?php echo lang('Reason for the arrest/Nature of offence') ?></label>
				<div class="mws-form-item">
					<textarea type="text" class="small" id="special_description"
						placeholder="" name="reason"><?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_reason; } ?></textarea>
				</div>
			</div>

			<div class="mws-form-row">
				<label for="releasedornot" class="mws-form-label"><?php echo lang('Whether suspect released from the Police Station/Produced to courts or not/Date, ect.') ?></label>
				<div class="mws-form-cols">
					<div class="mws-form-col-2-8">
						<textarea type="text" class="small" id="special_description"
							placeholder="" name="released_or_not"><?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_released_desc; } ?></textarea>
					</div>

					<div class="mws-form-col-2-8">
						<label><?php echo lang('Date') ?></label> <input type="text"
							class="small" id="datepicker1" placeholder=""
							name="released_date"
							value="<?php if(preg_match('/Edit/',$title)||preg_match('/Approve/',$title)||preg_match('/View/',$title)){ echo $results[0]->fld_released_date; } ?>">
					</div>
				</div>

			</div>
             
          
                    		<?php if(!preg_match('/Approve/',$title)){ ?>
                                <div class="mws-button-row">
				<button type="submit"
					class='btn btn-submit btn-fill btn-info btn-wd btn-md'
					name="submit" value="save">Save</button>
				<button type="submit" class='btn btn-fill btn-default btn-wd btn-md'
					name="submit" value="cancel">Cancel</button>
			</div>
                                <?php }else if(!preg_match('/View/',$title)){?>
                                 <div class="mws-button-row">
				<button type="submit"
					class='btn btn-submit btn-fill btn-info btn-wd btn-md'
					name="submit" value="approve">Approve</button>
				<button type="submit"
					class='btn btn-submit btn-fill btn-danger btn-wd btn-md'
					name="submit" value="disapprove">Disapprove</button>
				<button type="submit" class='btn btn-fill btn-default btn-wd btn-md'
					name="submit" value="cancel">Cancel</button>
			</div>
                                <?php }?>
                        
                    	 <?php echo form_close(); ?>
                    </div>
	</div>