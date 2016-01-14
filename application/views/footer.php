</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script src="<?php echo base_url(); ?>asset/js/bootstrap-timepicker.js"></script>
<?php
$function = $this->uri->segment ( 2 ); // get current function
$controller = $this->uri->segment ( 1 ); // get current controller
?>
<?php

if ($controller == "Follow_Up_Form_Controller") {
	?>
<!-- below part add for fixing multiple data tables responsive JS issues dev-2-as-->
<script>

// $('.datepicker').datepicker();
$(".datepicker").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'mm/dd/yy'

	});
/*activate responsive data table*/
 $('table.responsivetable').DataTable( {
    responsive: true,
    "autoWidth": false
} );

 var searchResults=$('#search-result-table').DataTable( {
    responsive: true,
    "autoWidth": false
} );

/*close all collapse menu*/
window.onload=function abc(){
//IDEA:: remove all class and inser "panel-collapse collapse" for all collaps
$(document).ready(function(){
	$('.panel-collapse.in')
	.collapse('hide');
});
}

/*on click chiled accordion menu cloase other opend child siblings*/
$('.panel-heading a.childmenu').on('click',function(){

	$("div#accordion-c6 > div div.in").collapse('hide');

})
/*on click parent accordion menu cloase other opend siblings*/
$('.panel-heading a.supermenu').on('click',function(){

	$("div#accordion > div div.in").collapse('hide');
})
</script>
<!-- finiish responsive data table part dev-2-as-->
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<?php }else{?>

<script>
	$(function () {
		$(".datepicker").datepicker({
			dateFormat: 'yy-mm-dd',
			buttonImageOnly: true
		});
	});

	$('.datepicker1').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'MM yy',
		beforeShow: function (input, inst) {
			if ($(input).hasClass('noDays')) {
				$('#ui-datepicker-div').addClass('noDays');
			} else {
				$('#ui-datepicker-div').removeClass('noDays');
				$(this).datepicker('option', 'dateFormat', 'yy-mm-dd');
			}
		},
		onClose: function (dateText, inst) {
			if ($('#ui-datepicker-div').hasClass('noDays')) {
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			}
		}
	});

	$(".from").datepicker({
		changeMonth: true,
		dateFormat: 'yy-mm-dd',
		onClose: function (selectedDate) {
			$(".to").datepicker("option", "minDate", selectedDate);
		}
	});
	$(".to").datepicker({
		changeMonth: true,
		dateFormat: 'yy-mm-dd',
		onClose: function (selectedDate) {
			$(".from").datepicker("option", "maxDate", selectedDate);
		}
	});

	$(document).ready(function () {
		$('table.dataTables-example').DataTable({
			responsive: true
//			dom: 'Bfrtip',
//			buttons: ['pdf']

		});
	});

	$(document).ready(function () {
		$('table.dataTable1').DataTable({
			responsive: true,
		});
	});

	$('.timepicker1').timepicker({
		defaultTime: false,
		disableFocus: false
	});
</script>
<?php }?>
<!-- jQuery -->
<!-- Bootstrap Core JavaScript -->
<script
	src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script
	src="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script
	src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- div-vidu -->
<!-- <script src=" -->
<?php //echo base_url();?>
<!-- asset/bower_components/datatables-responsive/js/jquery.dataTables.responsive.js"></script> -->
<script
	src="<?php echo base_url();?>asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>asset/dist/js/sb-admin-2.js"></script>

<script src="<?php echo base_url();?>asset/js/jquery.validate.js"></script>

</body>
</html>