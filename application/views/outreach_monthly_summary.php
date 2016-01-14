<?php ?>
<div class="row">
	<div id="topic" class="col-lg-12">
		<h1 class="page-header">Monthly Outreach Activities Summary <?php echo '('.$month.')';?></h1>
	</div>
	<?php if($user_role==1){?>
		<div class="col-xs-6"><label>Officer		:<?php echo $user->fld_firstname.' '.$user->fld_lastname;?></label></div>
		<div class="col-xs-6"><label>Location		:<?php echo $user->fld_location;?></label></div>
		<br><br>
	<?php }?>
</div>


<div class="row">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php $links = array('1'=>"Drug Users",'2'=>"Community",'3'=>"Family",'4'=>"From Treatment center",'5'=>"From Prison", '6'=>"Three wheel",'7'=>"Van",'8'=>"Bus",'9'=>"Community",'10'=>"Schools",'11'=>"SQS",'12'=>"Daham School",'13'=>"Tuition Class",'14'=>"Community Society",'15'=>"Government And Non Government Institute",'16'=>"Mobile",'17'=>"Pharmacy",'18'=>"Media");
	//try this one
	//$links = array('1'=>"Drug Users",'2'=>"Community",'3'=>"Family",'4'=>"From Treatment center",'5'=>"From Prison", '6'=> array("three_wheel","van","bus"),'7'=>"Community",'8'=>"Schools",'9'=>"SQS",'10'=>"Daham School",'11'=>"Tuition Class",'12'=>"Community Society",'13'=>"Government And Non Government Institute",'14'=>"Mobile",'15'=>"Pharmacy",'16'=>"Mobile");
//    var_dump($activity_data['previous'][10][1]);

	# get the current activity form_id
	$current=1;
	if($current_form!=''){
		$current=$current_form;
	}
	?>

	<?php for ($i = 1; $i <=18; $i++) { ?>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="heading<?php echo $i;?>">
			<h4 class="panel-title">
				<a role="button" id="link<?php echo $i;?>" class="aa" <?php if($i!=$current){echo 'class="collapsed"';}?>data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="<?php if($i==$current){ echo 'true';}else{echo 'false';}?>" aria-controls="collapse<?php echo $i;?>">
					<?php echo $links[$i];?>
				</a>
			</h4>
		</div>
		<div id="collapse<?php echo $i;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $i;?>">
			<div class="panel-body">
				<?php if($i==$current_form) {?>
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
				<?php }?>

				<?php if($i != 1){?>
				<!-- from_outreach_activity_form view-->
				<?php if($user_role!=1){?>
				<div class="row">
					<div class="col-md-6">
						<?php
						if ((preg_match('/Edit/', $activity_data['title']) || preg_match('/View/', $activity_data['title']))&& isset($activity_data['results'][$i][0]->tbl_id)) {
							echo form_open('Activity_Form_Controller/updateForm/' . $i . '/' .$form_id.'/'. $activity_data['results'][$i][0]->tbl_id, array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						} else {
							echo form_open('Activity_Form_Controller/insertForm/' . $i .'/'.$form_id ,array('name' => 'myform', 'id' => 'myform', 'class' => 'form'));
						}
						?>
						<?php for ($j = 0; $j < count($activity_data['headers'][$i]); $j++) { ?>
							<div class="form-group">
							<?php
								if ($activity_data['headers'][$i][$j]->fld_heading_name == "Type") {
								$val = $activity_data['headers'][$i][$j]->fld_save_column;
								if($i==6){$vehicle="three_wheel";}
								if($i==7){$vehicle="van";}
								if($i==8){$vehicle="bus";}
							?>
								<input type="hidden" name="<?php echo $val; ?>" id="<?php echo $val; ?>" value="<?php if (preg_match('/Add/', $activity_data['title'])){echo $vehicle;} else if ((preg_match('/Edit/', $activity_data['title']) || preg_match('/View/', $activity_data['title']))&& isset ($activity_data['results'][$i][0]->$val)) {echo $activity_data['results'][$i][0]->$val;} ?>">
							<?php }
								else if ($activity_data['headers'][$i][$j]->fld_heading_name == "Date") {
								$val = $activity_data['headers'][$i][$j]->fld_save_column;
							?>
								<label><?php echo $activity_data['headers'][$i][$j]->fld_heading_name ?></label>
								<input class="form-control datepicker" name="<?php echo $val ?>" id="<?php echo $val.$i ?>" value="<?php if ((preg_match('/Edit/', $activity_data['title'] ) || preg_match('/View/', $activity_data['title']))&& isset($activity_data['results'][$i][0]->$val)){echo $activity_data['results'][$i][0]->$val; } ?>" <?php if (preg_match('/View/', $activity_data['title'])&&$i==$current_form){echo 'disabled';} ?>>
							<?php }
								else if ($activity_data['headers'][$i][$j]->fld_heading_name == "Time Period") {
								$val = $activity_data['headers'][$i][$j]->fld_save_column;
								if ((preg_match('/Edit/', $activity_data['title']) || preg_match('/View/', $activity_data['title']))&& isset($activity_data['results'][$i][0]->$val)) {
									$datetext = $activity_data['results'][$i][0]->$val;
									$dates = explode(" to ", $datetext);
								}
							?>
								<label><?php echo $activity_data['headers'][$i][$j]->fld_heading_name ?></label>
									<div class="row">
										<div class="form-group">
											<div class="col-xs-1"><label for="title">From</label></div>
											<div class="col-xs-5">
												<input type="text" name="from" class="form-control from" id="<?php echo 'from'.$i?>" value="<?php if ((preg_match('/Edit/', $activity_data['title']) || preg_match('/View/', $activity_data['title']))&& isset($dates[0])){echo $dates[0];} ?>" <?php if (preg_match('/View/', $activity_data['title']) && $i==$current_form){echo 'disabled';} ?>>
											</div>
											<div class="col-xs-1"><label for="title" class="pull-right">To</label></div>
											<div class="col-xs-5">
												<input type="text" name="to" class="form-control to" id="<?php echo 'to'.$i?>" value="<?php if ((preg_match('/Edit/', $activity_data['title']) || preg_match('/View/', $activity_data['title']))&& isset($dates[1])){echo $dates[1];} ?>" <?php if (preg_match('/View/', $activity_data['title']) && $i==$current_form){ echo 'disabled';} ?>>
											</div>
										</div>
									</div>
							<?php }
								else {
								$val = $activity_data['headers'][$i][$j]->fld_save_column;
							?>
								<label><?php echo $activity_data['headers'][$i][$j]->fld_heading_name; ?></label>
								<input class="form-control" name="<?php echo $val ?>" id="<?php echo $val ?>" value="<?php if ((preg_match('/Edit/', $activity_data['title'] ) || preg_match('/View/', $activity_data['title']))&& isset($activity_data['results'][$i][0]->$val)){echo $activity_data['results'][$i][0]->$val; } ?>" <?php if (preg_match('/View/', $activity_data['title']) && $i==$current_form){echo 'disabled';} ?>>
								<?php } ?>

							</div>
						<?php } ?>
						<button type="submit" name="submit" value="save" class="btn btn-primary" <?php if (preg_match('/View/', $activity_data['title']) && $i==$current_form){echo 'disabled';} ?>>Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-danger" <?php if (preg_match('/View/', $activity_data['title']) && $i==$current_form){echo 'disabled';} ?>>Cancel</button>

						<?php echo form_close(); ?>
					</div>
					<!-- /.col-lg-6 (nested) -->
				</div>
				<?php }?>
				<!-- form end -->
				<?php }?>

				<?php if($i==1){?>
				<div class="row">

				<div class="row">
					<div class="col-lg-12">
						<div id="<?php echo 'form'.$i;?>" class="dataTable_wrapper" style="overflow:auto">
							<table id="<?php echo 'from'.$i?>" border="1" cellspacing="0" class="table table-striped table-bordered table-hover display responsive nowrap dataTables-example">
							<thead>
							<tr>
								<?php for ($j = 0; $j < count($activity_data['headers'][$i]); $j++){  ?>
									<th><?php echo $activity_data['headers'][$i][$j]->fld_heading_name ?></th><?php } ?>
							</tr>
							</thead>

							<tbody>
								<?php for ($k=0; $k<5;$k++){?>
								<tr>
									<td><b><?php echo $drugUsersFormData['drugs'][$k]->drug_name;?></b></td>
									<td><?php echo $drugUsersFormData[$k]['new_identity'];?></td>
									<td><?php echo $drugUsersFormData[$k]['cum_iden'];?></td>
									<td><?php echo $drugUsersFormData[$k]['new_regis'];?></td>
									<td><?php echo $drugUsersFormData[$k]['cum_regis'];?></td>
									<td><?php echo $drugUsersFormData[$k]['new_identity'];?></td>
									<td></td>
									<td><?php echo $drugUsersFormData[$k]['new_free'];?></td>
									<td><?php echo $drugUsersFormData[$k]['cum_free'];?></td>
								</tr>
								<?php }?>
							</tbody>

						</table>
						</div>

					</div>
					<!-- /.col-lg-6 (nested) -->
				</div>
				</div>


				<?php }else{?>
				<?php if($user_role!=1){?>
				<hr>
				<?php }?>
				<!-- previous data -->
				<div class="row">

				<div class="row">
					<div class="col-lg-12">
						<div id="<?php echo 'form'.$i;?>" class="dataTable_wrapper" style="overflow:auto">
							<table id="<?php echo 'from'.$i?>" border="1" cellspacing="0" class="table table-striped table-bordered table-hover display responsive nowrap dataTables-example">
							<thead>
							<tr>
								<?php for ($j = 0; $j < count($activity_data['headers'][$i]); $j++){  ?>
									<th><?php echo $activity_data['headers'][$i][$j]->fld_heading_name ?></th><?php } ?>
									<?php if($user_role!=1){?>
									<th>Actions</th>
									<?php }?>
							</tr>
							</thead>

							<tbody>
								<?php for ($k = 0; $k < count($activity_data['previous'][$i]); $k++) { ?>
							<tr>
								<?php for ($m = 0; $m < count($activity_data['headers'][$i]); $m++) { ?>
									<td>
										<?php
										$val = $activity_data['headers'][$i][$m]->fld_save_column;
										echo $activity_data['previous'][$i][$k]->$val;
										?>
									</td>
								<?php } ?>
									<?php if($user_role!=1){?>
									<td>
										<div class="btn-group btn-group-xs" role="group" >
											<a class='btn btn-default btn-xs' href="<?php echo site_url(); ?>/Activity_Form_Controller/editForm/<?php echo $form_id.'/'.$activity_data['previous'][$i][$k]->tbl_id.'/'.$i;  ?>">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
											<a class='btn btn-default btn-xs' href="<?php echo site_url(); ?>/Activity_Form_Controller/viewForm/<?php echo $form_id.'/'.$activity_data['previous'][$i][$k]->tbl_id.'/'.$i;  ?>">
												<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
											</a>
										</div>
									</td>
									<?php }?>
							</tr>

							<?php } ?>
							</tbody>
							<?php
							### print the total no of participants in a month ###
							if($i==6||$i==7||$i==8){
							?>
							<tfoot>
							<tr>

								<td colspan="2" align="center"><b>Total</b></td>
								<td>
								<?php
									$total=0;
									for ($k = 0; $k < count($activity_data['previous'][$i]); $k++) {
										$total=$total+$activity_data['previous'][$i][$k]->fld_participant_no;
									}
									echo $total;
								?>
								</td>
								<?php if($user_role!=1){?>
								<td colspan="2"></td>
								<?php }else{?>
								<td></td>
								<?php }?>
							</tr>
							</tfoot>
							<?php }?>


						</table>
						</div>

					</div>
					<!-- /.col-lg-6 (nested) -->
				</div>
				</div>
				<!-- end of the table -->
				<?php }?>

			</div>
		</div>
	</div>
	<?php } ?>
</div>
<!-- /.accordion -->

<a class='btn btn-default btn-primary' onclick="pdfMake();">Get pdf
</a>

</div>
<!-- /.row -->
<script>
	var current= <?php echo $current; ?>;


//	var tables =[];


	var title = <?php echo json_encode($links); ?>;
//    var title=["Drug Users","Community","Family","From Treatment center","From Prison","Three wheel", "Van","Bus", "Community", "Schools","SQS", "Daham School", "Tuition Class", "Community Society", "Government And Non Government Institute","Mobile", "Pharmacy", "Media" ];
	var html="<style> table {width: 100%;}</style>"+
			"<h1 align='center'>Monthly Outreach Activities Summary</h1>\n\
			<h3 align='center'>"+<?php echo json_encode($month);?>+"</h3>"+
			"<label>Officer		:"+<?php echo json_encode($user->fld_firstname);?>+' '+<?php echo json_encode($user->fld_lastname);?>+"</label><br>"+"<label>Location		:"+<?php echo json_encode($user->fld_location);?>+"</label><br>";

	for (i = 1; i < 19; i++) {
		html = html+"<h4>"+title[i]+"</h4>"+$("#form"+i).html()+"<br>";
	}

//	alert(html);

	window.onload = function abc() {

//IDEA:: remove all class and inser "panel-collapse collapse" for all collaps
		$(document).ready(function () {

			$("div:not(#collapse"+current+")").collapse('hide');
		});

		//go to this opened div after load page
		$('html, body').animate({
	        scrollTop: $("#heading"+current).offset().top
	    }, 1000);

		$('.panel-heading a.aa').on('click', function () {

			$("div#accordion > div div.in").collapse('hide');
		})
	}

//	var uname = <?php #echo json_encode($user->fld_username);?>;
//	var month = <?php #echo json_encode($month);?>;
//	var newpdfname = uname+"-"+month+"-monthly_summary";



	function pdfMake() {
	var uname = <?php echo json_encode($user->fld_username);?>;
	var month = <?php echo json_encode($month);?>;
	var newpdf = uname+"-"+month+"-monthly_summary";
	var newpdfname= newpdf.replace(/\s/g,"-");


//	var newpdfname = "newpdf";
	// alert(html);
	if (html) {
		var xmlhttp = createRequestObject();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//				alert('success');
                                window.location = controler_url+"Activity_Form_Controller/redirect/" + newpdfname;
                               // window.location = "http://sdu.ucsc.lk/nddcb_outreach/index.php/Follow_Up_Form_Controller/redirect/" + newpdfname;
			}
		}
		// var new_html = encodeURIComponent(html);
		var params = "html=" + html + "&pdfname=" + newpdfname;

		xmlhttp.open("POST", controler_url+"Activity_Form_Controller/pdf", true);
		//xmlhttp.open("POST", "http://sdu.ucsc.lk/nddcb_outreach/index.php/Follow_Up_Form_Controller/pdf", true);


		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		/*xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");*/
		xmlhttp.send(params);
		// http://stackoverflow.com/questions/9713058/sending-post-data-with-a-xmlhttprequest

	}
}


</script>