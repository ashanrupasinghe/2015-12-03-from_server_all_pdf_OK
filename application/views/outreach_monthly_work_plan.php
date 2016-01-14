<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Monthly Work Plan <?php echo '('.$month.')';?></h1>
	</div>
	<?php if($user_role==1){?>
		<div class="col-xs-6"><label>Officer		:<?php echo $user->fld_firstname.' '.$user->fld_lastname;?></label></div>
		<div class="col-xs-6"><label>Location		:<?php echo $user->fld_location;?></label></div>
		<br><br>
	<?php }?>
</div>
<!-- /.row -->
<?php
$role=$this->session->userdata('role');
if($role!=1){?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Basic Form Elements
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">

						<?php
						if(preg_match('/Edit/', $title)||preg_match('/View/',$title)){
						 echo form_open('Monthly_Work_Plan_Form_Controller/updateFormData/'.$form_id .'/'.$results[0]->tbl_id , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						}else{
						 echo form_open('Monthly_Work_Plan_Form_Controller/insertForm/'.$form_id , array('name' => 'myform', 'id' => 'myform', 'class' => 'mws-form'));
						}
						?>

							<div class="form-group">
								<label>Date</label>
								<input class="form-control datepick" name="date" id="date" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_date; } ?>" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>
							</div>
							<div class="form-group">
								<label>Target Group</label>
								<input class="form-control" name="target_grp" id="target_grp" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_target_group; } ?>" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>
							</div>
							<div class="form-group">
								<label>Location</label>
								<input class="form-control" name="location" id="location" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_location; } ?>" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>
							</div>
							<div class="form-group">
								<label>Name of the Program</label>
								<input class="form-control" name="program" id="program" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_program; } ?>" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>
							</div>
							<div class="form-group">
								<label>Starting Time</label>
								<input class="form-control timepicker1" name="start_time" id="start_time" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_start_time; } ?>" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>
							</div>
							<div class="form-group">
								<label>Concluding Time</label>
								<input class="form-control timepicker1" name="end_time" id="end_time" value="<?php if (preg_match('/Edit/', $title) || preg_match('/View/', $title)){echo $results[0]->fld_end_time; } ?>" <?php if(preg_match('/View/',$title)){echo 'disabled';}?>>
							</div>
						<button type="submit" name="submit" value="save" class="btn btn-primary" <?php if(preg_match('/View/', $title)){echo 'disabled';}?>>Submit</button>
						<button type="submit" name="submit" value="cancel" class="btn btn-danger"<?php if(preg_match('/View/', $title)){echo 'disabled';}?>>Cancel</button>

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
				Basic Form Elements
			</div>
			<div class="panel-body">
				<div class="row">
					<div id="monthly_plan" class="col-lg-12" style="overflow:auto">
						<table  class="table table-striped table-bordered table-hover display responsive nowrap dataTables-example" border="1" cellspacing="0">
							<thead>
								<tr>
									<th>Date</th>
									<th>Target Group</th>
									<th>Location</th>
									<th>Name of the Program</th>
									<th>Starting Time</th>
									<th>Concluding Time</th>
									<?php if($role!=1){?>
									<th>Actions</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i < count($previous); $i++) { ?>
								<tr>
									<td><?php echo $previous[$i]->fld_date; ?></td>
									<td><?php echo $previous[$i]->fld_target_group; ?></td>
									<td><?php echo $previous[$i]->fld_location; ?></td>
									<td><?php echo $previous[$i]->fld_program; ?></td>
									<td><?php echo $previous[$i]->fld_start_time; ?></td>
									<td><?php echo $previous[$i]->fld_end_time?></td>
									<?php if($role!=1){?>
									<td>
										<div class="btn-group" role="group" >
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Monthly_Work_Plan_Form_Controller/updatePlanForm/<?php echo $form_id.'/'.$previous[$i]->tbl_id; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<a class='btn btn-default btn-sm' href="<?php echo site_url(); ?>/Monthly_Work_Plan_Form_Controller/viewPlanForm/<?php echo $form_id.'/'.$previous[$i]->tbl_id; ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
										</div>
									</td>
									<?php }?>
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

		<a class='btn btn-default btn-primary' onclick="pdfMake();">Get pdf
</a>

	</div>
	<!-- /.col-lg-12 -->

</div>
<?php
$month_str = strtotime($month);
$month_timestamp = date("Y-m-d", $month_str);
$date_arr=  explode("-", $month_timestamp)
?>

<script>
	var html="<style> table {width: 100%;}</style>"+"<h1 align='center'>Monthly Work Plan</h1>\n\
			<h3 align='center'>"+<?php echo json_encode($month);?>+"</h3>"+
			"<label>Officer		:"+<?php echo json_encode($user->fld_firstname);?>+' '+<?php echo json_encode($user->fld_lastname);?>+"</label><br>"+"<label>Location		:"+<?php echo json_encode($user->fld_location);?>+"</label><br><br>";
	html = html+$("#monthly_plan").html();

	var uname = <?php echo json_encode($user->fld_username);?>;
	var month = <?php echo json_encode($month);?>;
	var newpdf = uname+"-"+month+"-monthly_work_plan";
	var newpdfname= newpdf.replace(/\s/g,"-");


	function pdfMake() {
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

<script>
	$(function () {
		var date=new Date(<?php echo $date_arr[0];?>,<?php echo $date_arr[1];?>-1,<?php echo $date_arr[2];?>);
		$(".datepick").datepicker({
			dateFormat: 'yy-mm-dd',
			defaultDate: date,
			changeMonth: false,
			changeYear: false,
			stepMonths:0
		});
	});
</script>


