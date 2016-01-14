<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>NDDCB Outreach Services</title>
<!-- div-vidu -->
<link href="<?php echo base_url();?>asset/dist/css/jquery-ui.css"
	rel="stylesheet">
<!-- *** -->
<!-- Bootstrap Core CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
<!-- *** -->

<!--Bootstrap Databicker CSS -->
<?php
/*
 * ?>
 * <link
 * href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap-datepicker3.min.css"
 * rel="stylesheet">
 * <?php
 */
?>
<!-- MetisMenu CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.css"
	rel="stylesheet">
<!-- *** -->


<!-- DataTables CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
	rel="stylesheet">
<!-- *** -->

<!-- DataTables Responsive CSS -->
<link
	href="<?php echo base_url();?>asset/bower_components/datatables-responsive/css/dataTables.responsive.css"
	rel="stylesheet">
<!-- *** -->

<!-- Custom CSS -->
<link href="<?php echo base_url();?>asset/dist/css/sb-admin-2.css"
	rel="stylesheet">
<!-- *** -->


<!-- Custom Fonts -->
<link
	href="<?php echo base_url();?>asset/bower_components/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">
<!-- *** -->
<!-- table styling -->
<link
	href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/tablestyle.css"
	rel="stylesheet">
<link
	href="<?php echo base_url();?>asset/datatable/css/jquery.dataTables.min.css"
	rel="stylesheet">
<!-- *** -->
<link
	href="<?php echo base_url();?>asset/datatable/css/responsive.dataTables.min.css"
	rel="stylesheet">
<!-- *** -->
<link href="<?php echo base_url();?>asset/css/style.css"
	rel="stylesheet">
<link
	href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap-switch.css"
	rel="stylesheet">
<!-- vidu -->
<!-- time-picker-->
<link
	href="<?php echo base_url();?>asset/dist/css/bootstrap-timepicker.css"
	rel="stylesheet">
<style>
div.noDays table {
	display: none;
}

div.error_msg {
	color: red;
}

div.ui-datepicker {
	font-size: 13px;
}
</style>
<!--pdf css -->
<link
	href="<?php echo base_url();?>asset/datatable/css/buttons.dataTables.min.css"
	rel="stylesheet">
<!-- end vidu -->
<script type="text/javascript">
//this variable will use in "followupform.js" and "search.js" files
var controler_url="<?php echo base_url();?>index.php/";
</script>
<script
	src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!--****-->

<script src="<?php echo base_url();?>asset/js/followupform.js"></script>

<script
	src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/jquery-1.11.1.min.js"></script>
<!-- vidu -->
<script src="<?php echo base_url();?>asset/js/jquery-ui.min.js"></script>
<!-- end vidu -->
<?php
/*
 * ?>
 * <script
 * src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap-datepicker.min.js"></script>
 * <?php
 */
?>


<script
	src="<?php echo base_url();?>asset/datatable/js/jquery.dataTables.min.js"></script>
<!--****-->
<script
	src="<?php echo base_url();?>asset/datatable/js/dataTables.responsive.min.js"></script>
<!--****-->
<script
	src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap-switch.js"></script>
<script src="<?php echo base_url();?>asset/js/search.js"></script>
<!-- pdf data table -->
<script
	src="<?php echo base_url();?>asset/datatable/js/dataTables.buttons.min.js"></script>
<!--****-->
<script src="<?php echo base_url();?>asset/datatable/js/jszip.min.js"></script>
<!--****-->
<script src="<?php echo base_url();?>asset/datatable/js/pdfmake.min.js"></script>
<!--****-->
<script src="<?php echo base_url();?>asset/datatable/js/vfs_fonts.js"></script>
<!--****-->
<script
	src="<?php echo base_url();?>asset/datatable/js/buttons.html5.min.js"></script>
<!--****-->
</head>
<body>

	<div id="wrapper">
		<!-- <img src=" -->
		<?php //echo base_url();?>
		<!-- /asset/images/logo.png"
					class="img-responsive banner2"> -->

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top nav-head-changed"
			role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="#"> <img src=" -->
				<?php //echo base_url();?>
				<!-- /asset/images/logo.png"
					class="img-responsive banner" alt="Cinque Terre">
				</a>-->
				<img src="<?php echo base_url();?>/asset/images/logo.png"
					class="img-responsive banner2">
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right navbar-right-changed">

				<li><lable class="hi-xlass">Hi <?php echo $first_name; ?>	(<?php echo $user_name;?>)</lable></li>

				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i
						class="fa fa-caret-down"></i>
				</a>
					<ul class="dropdown-menu dropdown-messages" style="width: 165px;">
						<!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> -->
						<?php //echo $user_name;?>
						<!-- </a> -->

						<li><a href="#"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo $role_name;?></a>

							<!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> -->
							<?php //echo $role_id;?>
							<!-- </a> --> <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> -->
							<?php //echo $user_center;?>
							<!-- </a> -->

						<li><a
							href="<?php echo site_url();?>/Registration_Controller/userProfile"><i
								class="fa fa-user fa-fw"></i> User Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url();?>/Login_Controller/logout"><i
								class="fa fa-power-off fa-fw"></i> Logout</a></li>
					</ul> <!-- /.dropdown-user --></li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar sidebar-change mysidebar"
				role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">

						<li><a
							href="<?php echo base_url();?>/index.php/Follow_Up_Form_Controller/showClientsDetails"><i
								class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

						<!-- <li><a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="#">Flot Charts</a></li>
								<li><a href="#">Morris.js Charts</a></li>
							</ul> -->
						<!-- /.nav-second-level -->
						<!-- </li> -->


						<!-- <li><a href="#"><i class="fa fa-table fa-fw"></i> Tables</a></li> -->
						<?php if($this->session->userdata('role')!=3){?>
						<li><a href="#"><i class="fa fa-edit fa-fw"></i> Forms<span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->session->userdata('role')==1){?>
								<li><a href="<?php echo site_url();?>/Registration_Controller"><i
										class="fa fa-male fa-fw"></i> Register New User</a></li>
								<li><a
									href="<?php echo site_url();?>/Registration_Controller/existingUsers"><i
										class="fa fa-file-text fa-fw"></i> User List</a></li>
								<?php } elseif ($this->session->userdata('role')==2){ ?>
								<li><a
									href="<?php echo site_url();?>/Monthly_Work_Plan_Form_Controller/createNewPlan"><i
										class="fa fa-list-alt fa-fw"></i> Monthly Work Plan</a></li>
								<li><a
									href="<?php echo site_url();?>/Activity_Form_Controller/createNewSummary"><i
										class="fa fa-file-o fa-fw"></i> Monthly Summary</a></li>
								<?php } ?>
                            </ul></li>
<?php }?>
						<li><a href="#"><i class="fa fa-line-chart fa-fw"></i> Follow Up<span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a
									href="<?php echo base_url();?>index.php/Follow_Up_Form_Controller/addfollowup"><i
										class="fa fa-male fa-fw"></i> Add New Client</a></li>
								<li><a
									href="<?php echo base_url();?>index.php/Follow_Up_Form_Controller/showClientsDetails/"><i
										class="fa fa-file-text fa-fw"></i> Clients Details</a></li>
							</ul> <!-- /.nav-second-level --></li>
						<li>
							<div class="color-boxes">
								<span class="">NOTATIONS</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								<span class="color-box-lue1-des">free from drug</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
								<span class="color-box-lue1-des">still following</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								<span class="color-box-lue1-des">reject following</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-pencil black-icon"
									aria-hidden="true"></span> <span class="color-box-lue1-des">edit
									details</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-list-alt black-icon"
									aria-hidden="true"></span> <span class="color-box-lue1-des">view
									details</span>
							</div>
						</li>
						<li>
							<div class="color-boxes">
								<span class="glyphicon glyphicon-thumbs-down black-icon"
									aria-hidden="true" style="color: #D9534F"></span> <span
									class="color-box-lue1-des">validation error in the area</span>
							</div>
						</li>
					</ul>

				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">