<!DOCTYPE h3 PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link
	href="<?php echo base_url();?>asset/datatable/css/responsive.dataTables.min.css"
	rel="stylesheet">
<link
	href="<?php echo base_url();?>asset/datatable/css/jquery.dataTables.min.css"
	rel="stylesheet">


<script
	src="<?php echo base_url();?>asset/datatable/js/jquery.dataTables.min.js"></script>

<script
	src="<?php echo base_url();?>asset/datatable/js/dataTables.responsive.min.js"></script>
</head>
<body>
<?php
if (isset ( $search_result )) {
	if (! empty ( $search_result )) {
		/*
		 * print '<pre>';
		 * print_r($search_result);
		 *
		 * die();
		 */
		
		?>
<h3><?php echo $no_of_search_result;?>-serach result found</h3>
	<table id="search-result-table" class="table search-result-table">
		<thead>
			<tr>
				<th>index</th>
				<th>Options</th>
				<th>form id</th>
				<th>Client ID</th>
				<th>Gender</th>
				<th>Name</th>
				<th>Address</th>
				<th>NIC</th>
				<th>Mobile</th>
				<th>Fixed</th>

			</tr>
		</thead>
		<tbody>
		<?php
		
		$count4 = 1;
		// $state=$data['follow_statuse'];
		
		?>		
		<?php foreach ($search_result as $clent):?>			
					<tr
				class="<?php if ($count4%2==0){echo 'tbl-color-odd';}else{echo 'tbl-color-even';}?>">
				<td><?php echo $count4;?></td>
				<td><a class="btn btn-default btn-sm"
					href="<?php echo site_url('Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/1');?>"
					role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
				<td><?php echo $clent->form_id;?></td>
				<td><?php echo $clent->fld_client_id ;?></td>
				<td><?php echo $clent->fld_gender ;?></td>
				<td><?php echo $clent->fld_name ; ?></td>
				<td><?php echo $clent->fld_address ; ?></td>
				<td><?php echo $clent->fld_id ; ?></td>
				<td><?php echo $clent->fld_contact_mobile ; ?></td>
				<td><?php echo $clent->fld_contact_fixed ; ?></td>
			
								<?php //echo 'http://localhost/NDDCB_merged/index.php/Follow_Up_Form_Controller/editClientDetails/'.$clent->form_id.'/'.$follow_statuse;?>
						</tr>
					<?php $count4++;?>
		<?php endforeach;?>	
				</tbody>
	</table>


<?php
	} else {
		echo '<h1 style="margin-top: 160px;">No Result Found</h1>';
	}
}
?>
</body>
</html>

