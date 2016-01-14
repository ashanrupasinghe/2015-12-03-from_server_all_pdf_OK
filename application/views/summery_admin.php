<!-- beloe styling call in this page for generating PDF,
     if do not wand cut past these in to 'style.css in' 'asset' folder
 -->
<style>
table.summery {
	border-collapse: collapse;
}

td.summery, th.summery {
	border: 1px solid black;
}

.search-i {
	background-color: #FBE9E9;
}

.search-fdu {
	background-color: rgb(233, 233, 255);
}

.search-a {
	background-color: rgb(255, 241, 241);
}

.search-r {
	background-color: rgb(252, 232, 232);
}

.search-t {
	background-color: #FBDDDD;
}

.search-f {
	background-color: rgb(233, 233, 255);
}
</style>
<div class="from-to-date">
	<h3 align="center">
		<u><?php echo $starting_date.' to '.$ending_date;?></u>
	</h3>
</div>
<?php
switch ($user_level) {
	
	case 1 :
		
		// admin level summery
		$totalMale_center_vice_acc = 0;
		$totalMale_center_vice_rej = 0;
		$totalFemale_center_vice_acc = 0;
		$totalFemale_center_vice_rej = 0;
		$totalMale_Island = 0; // total followup accepted
		$totalFemale_Island = 0; // total followup accepted
		                         // drug free
		$totalMale_drug_free_center_vice = 0;
		$totalFemale_drug_free_center_vice = 0;
		$totalMale_drug_free_Island = 0;
		$totalFemale_drug_free_Island = 0;
		$totalMale_free_drug_center_vice = 0;
		$totalFemale_free_drug_center_vice = 0;
		
		?>
<div>
	<h4>Center Vice</h4>
	<!-- 
identified user between date one and date2	
	show center vice,gender vice:
		* follow up accepted
		* follow up rejected
		* total identifyand
		how many of them free from drug	
	 -->
</div>
<?php if (!empty($summery['center_one_to_more'])):?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery">Center Name</th>
				<th class="summery" colspan="4">Male</th>
				<th class="summery" colspan="4">Female</th>
				<th class="summery" colspan="4">Total</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"></td>

				<td class="search-a summery">Accept</td>
				<td class="search-r summery">Reject</td>
				<td class="search-t summery">Total Identify</td>
				<td class="search-f summery">Free from drug</td>

				<td class="search-a summery">Accept</td>
				<td class="search-r summery">Reject</td>
				<td class="search-t summery">Total Identify</td>
				<td class="search-f summery">Free from drug</td>

				<td class="search-a summery">Accept</td>
				<td class="search-r summery">Reject</td>
				<td class="search-t summery">Total Identify</td>
				<td class="search-f summery">Free from drug</td>
			</tr>
		</thead>
		<tbody>
			<?php $totalMale_center_vice=0;$totalFemale_center_vice=0;?>
			<?php foreach ($summery['center_one_to_more'] as $center_name=>$val):?>
			<tr style="background-color: rgb(255, 249, 249);" class=" summery">
				<td class=" summery"><?php echo $center_name;?></td>
				<td class="search-a summery"><?php if (isset($val['Male'][1])){echo $val['Male'][1];}else{$val['Male'][1]=0;echo 0;}?></td>
				<td class="search-r summery"><?php if (isset($val['Male'][0])){echo $val['Male'][0];}else{$val['Male'][0]=0;echo 0;}?></td>
				<td class="search-t summery"><?php echo $val['Male'][1]+$val['Male'][0]?></td>
				<td class="search-f summery">
				<?php
				if (isset ( $summery ['center_free_drug_one_to_more'] [$center_name] ['Male'] )) {
					echo $summery ['center_free_drug_one_to_more'] [$center_name] ['Male'];
				} else {
					$summery ['center_free_drug_one_to_more'] [$center_name] ['Male'] = 0;
					echo 0;
				}
				
				?>				
				</td>
				<td class="search-a summery"><?php if (isset($val['Female'][1])){echo $val['Female'][1];}else{$val['Female'][1]=0;echo 0;}?></td>
				<td class="search-r summery"><?php if (isset($val['Female'][0])){echo $val['Female'][0];}else{$val['Female'][0]=0;echo 0;}?></td>
				<td class="search-t summery"><?php echo $val['Female'][1]+$val['Female'][0]?></td>
				<td class="search-f summery">
				<?php
				if (isset ( $summery ['center_free_drug_one_to_more'] [$center_name] ['Female'] )) {
					echo $summery ['center_free_drug_one_to_more'] [$center_name] ['Female'];
				} else {
					$summery ['center_free_drug_one_to_more'] [$center_name] ['Female'] = 0;
					echo 0;
				}
				?>
				</td>
				<td class="search-a summery"><?php echo $val['Male'][1]+$val['Female'][1];?></td>
				<td class="search-r summery"><?php echo $val['Male'][0]+$val['Female'][0];?></td>
				<td class="search-t summery"><?php echo $val['Male'][0]+$val['Female'][0]+$val['Male'][1]+$val['Female'][1];?></td>
					<?php
				
				/*
				 * $totalMale_center_vice += $val ['Male'];
				 * $totalFemale_center_vice += $val ['Female'];
				 */
				$totalMale_center_vice_acc += $val ['Male'] [1];
				$totalMale_center_vice_rej += $val ['Male'] [0];
				$totalFemale_center_vice_acc += $val ['Female'] [0];
				$totalFemale_center_vice_rej += $val ['Female'] [1];
				?>
				<td class="search-f summery"><?php
				echo $summery ['center_free_drug_one_to_more'] [$center_name] ['Female'] + $summery ['center_free_drug_one_to_more'] [$center_name] ['Male'];
				$totalMale_drug_free_center_vice += $summery ['center_free_drug_one_to_more'] [$center_name] ['Male'];
				$totalFemale_drug_free_center_vice += $summery ['center_free_drug_one_to_more'] [$center_name] ['Female'];
				
				?></td>
			</tr>
			<?php endforeach;?>	
				<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"><b>Total</b></td>
				<td class="search-a summery"><b><?php echo $totalMale_center_vice_acc;?></b></td>
				<td class="search-r summery"><b><?php echo $totalMale_center_vice_rej;?></b></td>
				<td class="search-t summery"><b><?php echo $totalMale_center_vice_acc+$totalMale_center_vice_rej;?></b></td>
				<td class="search-f summery"><b><?php echo $totalMale_drug_free_center_vice;?></b></td>
				<td class="search-a summery"><b><?php echo $totalFemale_center_vice_acc;?></b></td>
				<td class="search-r summery"><b><?php echo $totalFemale_center_vice_rej;?></b></td>
				<td class="search-t summery"><b><?php echo $totalFemale_center_vice_acc+$totalFemale_center_vice_rej;?></b></td>
				<td class="search-f summery"><b><?php echo $totalFemale_drug_free_center_vice;?></b></td>
				<td class="search-a summery"><b><?php echo $totalMale_center_vice_acc+$totalFemale_center_vice_acc;?></b></td>
				<td class="search-r summery"><b><?php echo $totalMale_center_vice_rej+$totalFemale_center_vice_rej;?></b></td>
				<td class="search-t summery"><b><?php echo $totalMale_center_vice_acc+$totalFemale_center_vice_acc+$totalMale_center_vice_rej+$totalFemale_center_vice_rej;?></b></td>
				<td class="search-f summery"><b><?php echo $totalFemale_drug_free_center_vice;?></b></td>
			</tr>

		</tbody>

	</table>

</div>
<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>
<div>
	<h4>Island Vice</h4>
</div>
<?php if (!empty($summery) && !empty($summery['accept_not_assign_to_center']) && !empty($summery['center_one_to_more']) && !empty($summery['reject_not_assign_to_center'])):?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery"></th>
				<th class="summery" colspan="2">Male</th>
				<th class="summery" colspan="2">Female</th>
				<th class="summery" colspan="2">Total</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"></td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
			</tr>
		</thead>
		<tbody>
		<?php if (!empty($summery['accept_not_assign_to_center'])):?>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">follow up accepted-not assign to the centers</td>
				<td class="search-r summery"><?php if (isset($summery['accept_not_assign_to_center']['not assign']['Male'])):$male=$summery['accept_not_assign_to_center']['not assign']['Male'];else:$male=0;endif;echo $male;?></td>
				<td class="search-f summery">
				<?php if (isset($summery['accept_free_drug_not_assign_to_center']['not assign']['Male'])):$free_drug_male=$summery['accept_free_drug_not_assign_to_center']['not assign']['Male'];else:$free_drug_male=0;endif;echo $free_drug_male;?>
				</td>
				<td class="search-r summery"><?php if (isset($summery['accept_not_assign_to_center']['not assign']['Female'])):$female=$summery['accept_not_assign_to_center']['not assign']['Female'];else:$female=0;endif;echo $female;?></td>
				<td class="search-f summery">
				<?php if (isset($summery['accept_free_drug_not_assign_to_center']['not assign']['Female'])):$free_drug_female=$summery['accept_free_drug_not_assign_to_center']['not assign']['Female'];else:$free_drug_female=0;endif;echo $free_drug_female;?></td>
				<td class="search-r summery"><?php echo $male+$female;?></td>
				<td class="search-f summery"><?php echo $free_drug_male+$free_drug_female;?></td>
			</tr>
			<?php
				$totalMale_Island += $male;
				$totalFemale_Island += $female;
				$totalMale_drug_free_Island += $free_drug_male;
				$totalFemale_drug_free_Island += $free_drug_female;
				?>
			<?php endif;?>
			<?php  if (!empty($summery['center_one_to_more'])):?>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">follow up accepted-assign to the centers</td>
				<td class="search-r summery"><?php echo $totalMale_center_vice_acc;?></td>
				<td class="search-f summery"><?php echo $totalMale_drug_free_center_vice;?></td>
				<td class="search-r summery"><?php echo $totalFemale_center_vice_acc;?></td>
				<td class="search-f summery"><?php echo $totalFemale_drug_free_center_vice;?></td>
				<td class="search-r summery"><?php echo $totalMale_center_vice_acc+$totalFemale_center_vice_acc;?></td>
				<td class="search-f summery"><?php echo $totalMale_drug_free_center_vice+$totalFemale_drug_free_center_vice;?></td>
			</tr>
			<?php
				$totalMale_Island += $totalMale_center_vice_acc;
				$totalFemale_Island += $totalFemale_center_vice_acc;
				$totalMale_drug_free_Island += $totalMale_drug_free_center_vice;
				$totalFemale_drug_free_Island += $totalFemale_drug_free_center_vice;
				?>
			<?php endif;?>
			<?php if (!empty($summery['reject_not_assign_to_center'])):?>
			 <tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">follow up rejected</td>
				<td class="search-r summery"> 
			<?php if (isset($summery['reject_not_assign_to_center']['not assign']['Male'])):$male=$summery['reject_not_assign_to_center']['not assign']['Male'];else:$male=0;endif; echo $male;?>
			 </td>
				<td class="search-f summery">-</td>
				<td class="search-r summery"> 
			<?php if (isset($summery['reject_not_assign_to_center']['not assign']['Female'])):$female=$summery['reject_not_assign_to_center']['not assign']['Female'];else: $female=0;endif;echo $female;?>
			 </td>
				<td class="search-f summery">-</td>
				<td class="search-r summery">
			<?php echo $male+$female;?>
			</td>
				<td class="search-f summery">-</td>
			</tr>
<?php
				/*
				 * ?>
				 * <tr style="background-color: rgb(255, 249, 249);" class="summery">
				 * <td class="summery">follow up rejected</td>
				 * <td class="search-r summery"><?php echo $totalMale_center_vice_rej ;?></td>
				 * <td class="search-f summery">-</td>
				 * <td class="search-r summery"><?php echo $totalFemale_center_vice_rej ; ?></td>
				 * <td class="search-f summery">-</td>
				 * <td class="search-r summery"><?php echo $totalMale_center_vice_rej+$totalFemale_center_vice_rej;?></td>
				 * <td class="search-f summery">-</td>
				 * </tr>
				 * <?php
				 */
				?>			
			<?php
				
				/*
				 * $totalMale_Island += $totalMale_center_vice_rej;
				 * $totalFemale_Island += $totalFemale_center_vice_rej;
				 */
				$totalMale_Island += $male;
				$totalFemale_Island += $female;
				?>
			<?php endif;?>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"><b>Total</b></td>
				<td class="search-r summery"><b><?php echo $totalMale_Island;?></b></td>
				<td class="search-f summery"><b><?php echo $totalMale_drug_free_Island;?></b></td>
				<td class="search-r summery"><b><?php echo $totalFemale_Island;?></b></td>
				<td class="search-f summery"><b><?php echo $totalFemale_drug_free_Island;?></b></td>
				<td class="search-r summery"><b><?php echo $totalMale_Island+$totalFemale_Island; ?></b></td>
				<td class="search-f summery"><b><?php echo $totalMale_drug_free_Island+$totalFemale_drug_free_Island;?></b></td>
			</tr>
		</tbody>

	</table>
</div>
<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>

<div>
	<h4>Drug Vice</h4>
</div>
<?php if (!empty($summery)):?>
<?php

			$first4_identy = 0;
			$first4_regis = 0;
			$first4_free = 0;
			$other_identy = 0;
			$other_regist = 0;
			$other_free = 0;
			$all_identy = 0;
			$all_regis = 0;
			$all_free = 0;
			if (isset ( $summery ['drug_vice_free_admin'] ) && ! empty ( $summery ['drug_vice_free_admin'] )) {
				foreach ( $summery ['drug_vice_free_admin'] as $freedrug ) {
					$all_free += $freedrug;
				}
			}
			if (isset ( $summery ['drug_vice_accept_admin'] ) && ! empty ( $summery ['drug_vice_accept_admin'] )) {
				foreach ( $summery ['drug_vice_accept_admin'] as $acceptdrug ) {
					$all_regis += $acceptdrug;
				}
			}
			if (isset ( $summery ['drug_vice_all_admin'] ) && ! empty ( $summery ['drug_vice_all_admin'] )) {
				foreach ( $summery ['drug_vice_all_admin'] as $alldrug ) {
					$all_identy += $alldrug;
				}
			}
			?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery">Drug Name</th>
				<th class="summery" colspan="">New Identity</th>
				<th class="summery" colspan="">New Regis</th>
				<th class="summery" colspan="">Free From Drug</th>
			</tr>
		</thead>

		<tbody>

			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Heroin</td>
				<td class="search-a summery">
					<?php
			if (isset ( $summery ['drug_vice_all_admin'] ['Heroin'] ) && ! empty ( $summery ['drug_vice_all_admin'] ['Heroin'] )) {
				echo $summery ['drug_vice_all_admin'] ['Heroin'];
			} else {
				$summery ['drug_vice_all_admin'] ['Heroin'] = 0;
				echo 0;
			}
			$first4_identy += $summery ['drug_vice_all_admin'] ['Heroin'];
			?>
					
					</td>
				<td class="search-r summery">
					
					<?php
			
			if (isset ( $summery ['drug_vice_accept_admin'] ['Heroin'] ) && ! empty ( $summery ['drug_vice_accept_admin'] ['Heroin'] )) {
				echo $summery ['drug_vice_accept_admin'] ['Heroin'];
			} else {
				$summery ['drug_vice_accept_admin'] ['Heroin'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_admin'] ['Heroin'];
			?>					
				
					</td>

				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_admin'] ['Heroin'] ) && ! empty ( $summery ['drug_vice_free_admin'] ['Heroin'] )) {
				echo $summery ['drug_vice_free_admin'] ['Heroin'];
			} else {
				$summery ['drug_vice_free_admin'] ['Heroin'] = 0;
				echo 0;
			}
			
			$first4_free += $summery ['drug_vice_free_admin'] ['Heroin'];
			?>
					</td>


			</tr>

			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Cannabis</td>
				<td class="search-a summery">
					<?php
			
			if (isset ( $summery ['drug_vice_all_admin'] ['Cannabis'] ) && ! empty ( $summery ['drug_vice_all_admin'] ['Cannabis'] )) {
				echo $summery ['drug_vice_all_admin'] ['Cannabis'];
			} else {
				$summery ['drug_vice_all_admin'] ['Cannabis'] = 0;
				echo 0;
			}
			$first4_identy += $summery ['drug_vice_all_admin'] ['Cannabis'];
			
			?>
					</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_admin'] ['Cannabis'] ) && ! empty ( $summery ['drug_vice_accept_admin'] ['Cannabis'] )) {
				echo $summery ['drug_vice_accept_admin'] ['Cannabis'];
			} else {
				$summery ['drug_vice_accept_admin'] ['Cannabis'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_admin'] ['Cannabis'];
			?>
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_admin'] ['Cannabis'] ) && ! empty ( $summery ['drug_vice_free_admin'] ['Cannabis'] )) {
				echo $summery ['drug_vice_free_admin'] ['Cannabis'];
			} else {
				$summery ['drug_vice_free_admin'] ['Cannabis'] = 0;
				echo 0;
			}
			$first4_free += $summery ['drug_vice_free_admin'] ['Cannabis'];
			?>
					</td>


			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Alcohol</td>
				<td class="search-a summery">
					<?php
			
			if (isset ( $summery ['drug_vice_all_admin'] ['Alcohol'] ) && ! empty ( $summery ['drug_vice_all_admin'] ['Alcohol'] )) {
				echo $summery ['drug_vice_all_admin'] ['Alcohol'];
			} else {
				$summery ['drug_vice_all_admin'] ['Alcohol'] = 0;
				echo 0;
			}
			$first4_identy += $summery ['drug_vice_all_admin'] ['Alcohol'];
			
			?>
					</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_admin'] ['Alcohol'] ) && ! empty ( $summery ['drug_vice_accept_admin'] ['Alcohol'] )) {
				echo $summery ['drug_vice_accept_admin'] ['Alcohol'];
			} else {
				$summery ['drug_vice_accept_admin'] ['Alcohol'] = 0;
				echo 0;
			}
			
			$first4_regis += $summery ['drug_vice_accept_admin'] ['Alcohol'];
			?>
					</td>


				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_admin'] ['Alcohol'] ) && ! empty ( $summery ['drug_vice_accept_admin'] ['Alcohol'] )) {
				echo $summery ['drug_vice_free_admin'] ['Alcohol'];
			} else {
				$summery ['drug_vice_free_admin'] ['Alcohol'] = 0;
				echo 0;
			}
			
			$first4_free += $summery ['drug_vice_free_admin'] ['Alcohol'];
			?>
					</td
			
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Illicit</td>
				<td class="search-a summery">
					<?php
			
			if (isset ( $summery ['drug_vice_all_admin'] ['Illicit'] ) && ! empty ( $summery ['drug_vice_all_admin'] ['Illicit'] )) {
				echo $summery ['drug_vice_all_admin'] ['Illicit'];
			} else {
				$summery ['drug_vice_all_admin'] ['Illicit'] = 0;
				echo 0;
			}
			
			$first4_identy += $summery ['drug_vice_all_admin'] ['Illicit'];
			?>
					</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_admin'] ['Illicit'] ) && ! empty ( $summery ['drug_vice_accept_admin'] ['Illicit'] )) {
				echo $summery ['drug_vice_accept_admin'] ['Illicit'];
			} else {
				$summery ['drug_vice_accept_admin'] ['Illicit'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_admin'] ['Illicit'];
			?>
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_admin'] ['Illicit'] ) && ! empty ( $summery ['drug_vice_free_admin'] ['Illicit'] )) {
				echo $summery ['drug_vice_free_admin'] ['Illicit'];
			} else {
				$summery ['drug_vice_free_admin'] ['Illicit'] = 0;
				echo 0;
			}
			$first4_free += $summery ['drug_vice_free_admin'] ['Illicit'];
			
			?>
					</td>


			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Other</td>
				<td class="search-a summery"><?php echo $all_identy-$first4_identy;?></td>
				<td class="search-r summery"><?php echo $all_regis-$first4_regis;?></td>
				<td class="search-f summery"><?php echo $all_free-$first4_free;?></td>

			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"><b>Total</b>
				
				</th>
				<td class="search-a summery"><b><?php echo $all_identy;?></b></td>
				<td class="search-r summery"><b><?php echo $all_regis ;?></b></td>
				<td class="search-f summery"><b><?php echo $all_free;?></b></td>
			</tr>
		</tbody>
	</table>
</div>
<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>		
<?php
		break;
	case 2 :
		// outreach officer summery
		$accept_my_male = 0;
		$accept_my_female = 0;
		
		$reject_my_male = 0;
		$reject_my_female = 0;
		
		$accept_other_male = 0;
		$accept_other_female = 0;
		
		$reject_other_male = 0;
		$reject_other_female = 0;
		
		$assigned_female = 0;
		$assigned_male = 0;
		
		$assigned_other_female = 0;
		$assigned_other_male = 0;
		
		$total_male = 0;
		$total_female = 0;
		
		// free drug summery
		$free_drug_accept_my_male = 0;
		$free_drug_accept_my_female = 0;
		
		$free_drug_accept_other_male = 0;
		$free_drug_accept_other_female = 0;
		
		$free_drug_assigned_female = 0;
		$free_drug_assigned_male = 0;
		
		$free_drug_other_assigned_female = 0;
		$free_drug_other_assigned_male = 0;
		
		$free_drug_total_male = 0;
		$free_drug_total_female = 0;
		
		?>
<div>
	<h4>Summery</h4>
</div>
<?php
		
if (! empty ( $summery )) :
			?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery"></th>
				<th class="summery" colspan="2">Male</th>
				<th class="summery" colspan="2">Female</th>
				<th class="summery" colspan="2">Total</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"></td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
			</tr>
		</thead>
		<tbody>

			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">My Client Follow Up Accepted</td>
				<td class="search-r summery"><?php if (isset($summery['my_accepted']['Male'])){$accept_my_male =$summery['my_accepted']['Male'];}echo $accept_my_male ;?></td>
				<td class="search-f summery"><?php if (isset($summery['my_free_drug']['Male'] )) {  $free_drug_accept_my_male=$summery ['my_free_drug'] ['Male']; }echo $free_drug_accept_my_male;?></td>
				<td class="search-r summery"><?php if (isset($summery['my_accepted']['Female'])){$accept_my_female =$summery['my_accepted']['Female'];}echo $accept_my_female ;?></td>
				<td class="search-f summery"><?php if (isset ( $summery ['my_accepted'] ['Male'] )) {$free_drug_accept_my_female=$summery ['my_accepted'] ['Male']; }echo $free_drug_accept_my_female;?></td>
				<td class="search-r summery"><?php
			
			echo $accept_my_male + $accept_my_female;
			$total_male += $accept_my_male;
			$total_female += $accept_my_female;
			?></td>
				<td class="search-f summery"><?php
			
			echo $free_drug_accept_my_male + $free_drug_accept_my_female;
			$free_drug_total_male += $free_drug_accept_my_male;
			$free_drug_total_female += $free_drug_accept_my_female;
			?></td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">My Client Follow Up Rejected</td>
				<td class="search-r summery"><?php if (isset($summery['my_rejected']['Male'])){$reject_my_male =$summery['my_rejected']['Male'];}echo $reject_my_male ;?></td>
				<td class="search-f summery">-</td>
				<td class="search-r summery"><?php if (isset($summery['my_rejected']['Female'])){$reject_my_female =$summery['my_rejected']['Female'];}echo $reject_my_female ;?></td>
				<td class="search-f summery">-</td>
				<td class="search-r summery"><?php
			
			echo $reject_my_male + $reject_my_female;
			$total_male += $reject_my_male;
			$total_female += $reject_my_female;
			?></td>
				<td class="search-f summery">-</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Others Client Follow Up Accepted</td>
				<td class="search-r summery"><?php if (isset($summery['other_accept']['Male'])){$accept_other_male =$summery['other_accept']['Male'];}echo $accept_other_male ;?></td>
				<td class="search-f summery"><?php
			if (isset ( $summery ['other_free_drug'] ['Male'] )) {
				$free_drug_accept_other_male = $summery ['other_free_drug'] ['Male'];
			}
			echo $free_drug_accept_other_male;
			?></td>
				<td class="search-r summery"><?php if (isset($summery['other_accept']['Female'])){$accept_other_female =$summery['other_accept']['Female'];}echo $accept_other_female ;?></td>
				<td class="search-f summery">
				<?php
			if (isset ( $summery ['other_free_drug'] ['Female'] )) {
				$free_drug_accept_other_female = $summery ['other_free_drug'] ['Female'];
			}
			echo $free_drug_accept_other_female;
			?>
				</td>
				<td class="search-r summery"><?php
			
			echo $accept_other_male + $accept_other_female;
			$total_male += $accept_other_male;
			$total_female += $accept_other_female;
			?></td>
				<td class="search-f summery">
				<?php
			echo $free_drug_accept_other_male + $free_drug_accept_other_female;
			$free_drug_total_male += $free_drug_accept_other_male;
			$free_drug_total_female += $free_drug_accept_other_female;
			?>
				</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Other's Client Follow Up Rejected</td>
				<td class="search-r summery"><?php if (isset($summery['other_rejct']['Male'])){$reject_other_male =$summery['other_rejct']['Male'];}echo $reject_other_male ;?></td>
				<td class="search-f summery">-</td>
				<td class="search-r summery"><?php if (isset($summery['other_rejct']['Female'])){$reject_other_female =$summery['other_rejct']['Female'];}echo $reject_other_female ;?></td>
				<td class="search-f summery">-</td>
				<td class="search-r summery"><?php
			
			echo $reject_other_male + $reject_other_female;
			$total_male += $reject_other_male;
			$total_female += $reject_other_female;
			?></td>
				<td class="search-f summery">-</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Other's Assigned Client By admin/Center</td>
				<td class="search-r summery"><?php if (isset($summery['other_assigned']['Male'])){$assigned_other_male  =$summery['other_assigned']['Male'];}echo $assigned_other_male ;?></td>
				<td class="search-f summery">
				<?php
			if (isset ( $summery ['assigned_other_free_drug'] ['Male'] )) {
				$free_drug_other_assigned_male = $summery ['assigned_other_free_drug'] ['Male'];
			}
			echo $free_drug_other_assigned_male;
			?>
				</td>
				<td class="search-r summery"><?php if (isset($summery['other_assigned']['Female'])){$assigned_other_female =$summery['other_assigned']['Female'];}echo $assigned_other_female ;?></td>
				<td class="search-f summery">
				<?php
			if (isset ( $summery ['assigned_other_free_drug'] ['Female'] )) {
				$free_drug_other_assigned_female = $summery ['assigned_other_free_drug'] ['Female'];
			}
			echo $free_drug_other_assigned_female;
			?>
				
				</td>
				<td class="search-r summery">
			<?php
			echo $assigned_other_male + $assigned_other_female;
			$total_male += $assigned_other_male;
			$total_female += $assigned_other_female;
			
			?>
			</td>
				<td class="search-f summery">
				<?php
			echo $free_drug_other_assigned_male + $free_drug_other_assigned_female;
			$free_drug_total_male += $free_drug_other_assigned_male;
			$free_drug_total_female += $free_drug_other_assigned_female;
			?>
				</td>
			</tr>



			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Assigned to me from center/admin</td>
				<td class="search-r summery"><?php if (isset($summery['assigned']['Male'])){$assigned_male  =$summery['assigned']['Male'];}echo $assigned_male ;?></td>
				<td class="search-f summery"><?php
			if (isset ( $summery ['assigned_free_drug'] ['Male'] )) {
				$free_drug_assigned_male = $summery ['assigned_free_drug'] ['Male'];
			}
			echo $free_drug_assigned_male;
			?></td>
				<td class="search-r summery"><?php if (isset($summery['assigned']['Female'])){$assigned_female =$summery['assigned']['Female'];}echo $assigned_female ;?></td>
				<td class="search-f summery">
				<?php
			if (isset ( $summery ['assigned_free_drug'] ['Female'] )) {
				$free_drug_assigned_female = $summery ['assigned_free_drug'] ['Female'];
			}
			echo $free_drug_assigned_female;
			?>
				</td>
				<td class="search-r summery"><?php
			
			echo $assigned_female + $assigned_male;
			$total_male += $assigned_male;
			$total_female += $assigned_female;
			?></td>
				<td class="search-f summery"><?php
			echo $free_drug_assigned_male + $free_drug_assigned_female;
			$free_drug_total_male += $free_drug_assigned_male;
			$free_drug_total_female += $free_drug_assigned_female;
			?></td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"><b>Total</td>
				<td class="search-r summery"><b><?php echo $total_male;?></b></td>
				<td class="search-f summery"><b><?php echo $free_drug_total_male;?></b></td>
				<td class="search-r summery"><b><?php echo $total_female;?></b></td>
				<td class="search-f summery"><b><?php echo $free_drug_total_female;?></b></td>
				<td class="search-r summery"><b><?php echo $total_male+$total_female;?></b></td>
				<td class="search-f summery"><b><?php echo $free_drug_total_male+$free_drug_total_female?></b></td>
			</tr>


		</tbody>
	</table>
</div>
<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>	
<?php
		break;
	case 3 :
		// center level summery
		$center_male = 0;
		$center_female = 0;
		
		// free drug
		$free_drug_center_male = 0;
		$free_drug_center_female = 0;
		// echo '1<br>';print_r ( $summery ['drug_vice_all_center'] );//all user asigned to the center in given period
		// echo '<br>2<br>';print_r ( $summery ['drug_vice_free_center'] );//all user that assigned to the center- free from drug in given period
		// echo '<br>3<br>';print_r ( $summery ['drug_vice_accept_center'] );//all user accept follow, but all user assigned to a center always accepted following
		
		?>
<div>
	<h4>Summery</h4>
</div>
<?php if (!empty($summery)):?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery"></th>
				<th class="summery" colspan="2">Male</th>
				<th class="summery" colspan="2">Female</th>
				<th class="summery" colspan="2">Total</th>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery"></th>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
				<td class="search-r summery">Identify</td>
				<td class="search-f summery">Free from drug</td>
			</tr>
		</thead>

		<tbody>

			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Clients Assigned to Center</td>
				<td class="search-r summery"><?php if (isset($summery['center_clients']['Male'])){$center_male=$summery['center_clients']['Male'];} echo $center_male;?></td>
				<td class="search-f summery"><?php if (isset($summery['free_drug_center_clients']['Male'])){$free_drug_center_male=$summery['free_drug_center_clients']['Male'];} echo $free_drug_center_male;?></td>
				<td class="search-r summery"><?php if (isset($summery['center_clients']['Female'])){$center_female=$summery['center_clients']['Female'];} echo $center_female;?></td>
				<td class="search-f summery"><?php if (isset($summery['free_drug_center_clients']['Female'])){$free_drug_center_female=$summery['free_drug_center_clients']['Female'];} echo $free_drug_center_female;?></td>
				<td class="search-r summery"><?php echo $center_male+$center_female;?></td>
				<td class="search-f summery"><?php echo $free_drug_center_male+$free_drug_center_female;?></td>
			</tr>



		</tbody>
	</table>
</div>
<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>
<div>
	<h4>Drug Vice</h4>
</div>
<?php if (!empty($summery)):?>
<?php

			$first4_regis = 0;
			$first4_free = 0;
			$other_regist = 0;
			$other_free = 0;
			$all_regis = 0;
			$all_free = 0;
			if (isset ( $summery ['drug_vice_free_center'] ) && ! empty ( $summery ['drug_vice_free_center'] )) {
				foreach ( $summery ['drug_vice_free_center'] as $freedrug ) {
					$all_free += $freedrug;
				}
			}
			if (isset ( $summery ['drug_vice_accept_center'] ) && ! empty ( $summery ['drug_vice_accept_center'] )) {
				foreach ( $summery ['drug_vice_accept_center'] as $acceptdrug ) {
					$all_regis += $acceptdrug;
				}
			}
			
			?>
<div class="table-responsive">
	<table class="table table-bordered summery">
		<thead>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<th class="summery">Drug Name</th>
				<th class="summery" colspan="">New Regis</th>
				<th class="summery" colspan="">Free From Drug</th>
			</tr>
		</thead>

		<tbody>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Heroin</td>
				<td class="search-r summery">
					
					<?php
			
			if (isset ( $summery ['drug_vice_accept_center'] ['Heroin'] ) && ! empty ( $summery ['drug_vice_accept_center'] ['Heroin'] )) {
				echo $summery ['drug_vice_accept_center'] ['Heroin'];
			} else {
				$summery ['drug_vice_accept_center'] ['Heroin'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_center'] ['Heroin'];
			?>					
				
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_center'] ['Heroin'] ) && ! empty ( $summery ['drug_vice_free_center'] ['Heroin'] )) {
				echo $summery ['drug_vice_free_center'] ['Heroin'];
			} else {
				$summery ['drug_vice_free_center'] ['Heroin'] = 0;
				echo 0;
			}
			
			$first4_free += $summery ['drug_vice_free_center'] ['Heroin'];
			?>
					</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Cannabis</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_center'] ['Cannabis'] ) && ! empty ( $summery ['drug_vice_accept_center'] ['Cannabis'] )) {
				echo $summery ['drug_vice_accept_center'] ['Cannabis'];
			} else {
				$summery ['drug_vice_accept_center'] ['Cannabis'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_center'] ['Cannabis'];
			?>
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_center'] ['Cannabis'] ) && ! empty ( $summery ['drug_vice_free_center'] ['Cannabis'] )) {
				echo $summery ['drug_vice_free_center'] ['Cannabis'];
			} else {
				$summery ['drug_vice_free_center'] ['Cannabis'] = 0;
				echo 0;
			}
			$first4_free += $summery ['drug_vice_free_center'] ['Cannabis'];
			?>
					</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Alcohol</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_center'] ['Alcohol'] ) && ! empty ( $summery ['drug_vice_accept_center'] ['Alcohol'] )) {
				echo $summery ['drug_vice_accept_center'] ['Alcohol'];
			} else {
				$summery ['drug_vice_accept_center'] ['Alcohol'] = 0;
				echo 0;
			}
			
			$first4_regis += $summery ['drug_vice_accept_center'] ['Alcohol'];
			?>
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_center'] ['Alcohol'] ) && ! empty ( $summery ['drug_vice_free_center'] ['Alcohol'] )) {
				echo $summery ['drug_vice_free_center'] ['Alcohol'];
			} else {
				$summery ['drug_vice_free_center'] ['Alcohol'] = 0;
				echo 0;
			}
			
			$first4_free += $summery ['drug_vice_free_center'] ['Alcohol'];
			?>
					</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Illicit</td>
				<td class="search-r summery">
					<?php
			
			if (isset ( $summery ['drug_vice_accept_center'] ['Illicit'] ) && ! empty ( $summery ['drug_vice_accept_center'] ['Illicit'] )) {
				echo $summery ['drug_vice_accept_center'] ['Illicit'];
			} else {
				$summery ['drug_vice_accept_center'] ['Illicit'] = 0;
				echo 0;
			}
			$first4_regis += $summery ['drug_vice_accept_center'] ['Illicit'];
			?>
					</td>
				<td class="search-f summery">
					<?php
			
			if (isset ( $summery ['drug_vice_free_center'] ['Illicit'] ) && ! empty ( $summery ['drug_vice_free_center'] ['Illicit'] )) {
				echo $summery ['drug_vice_free_center'] ['Illicit'];
			} else {
				$summery ['drug_vice_free_center'] ['Illicit'] = 0;
				echo 0;
			}
			$first4_free += $summery ['drug_vice_free_center'] ['Illicit'];
			
			?>
					</td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery">Other</td>
				<td class="search-r summery"><?php echo $all_regis-$first4_regis;?></td>
				<td class="search-f summery"><?php echo $all_free-$first4_free;?></td>
			</tr>
			<tr style="background-color: rgb(255, 249, 249);" class="summery">
				<td class="summery"><b>Total</b></td>
				<td class="search-r summery"><b><?php echo $all_regis ;?></b></td>
				<td class="search-f summery"><b><?php echo $all_free;?></b></td>
			</tr>
		</tbody>
	</table>
</div>

<?php else:?>
<?php echo "<p>No Results Found</p>";?>
<?php endif;?>			

<?php
		break;
	default :
		?>
default level	
	<?php
}

?>
<div style="position: absolute; bottom: 5px;" class="pdf-footer">PDF Generated:: <?php echo $report_user."/ Date: ".$generated_date;?>


</div>