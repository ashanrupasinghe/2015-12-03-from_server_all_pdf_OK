
<table id="example" class="display" width="100%"></table>

<script>
var dataSet = [
				               [ "Tiger Nixon" ],
				               [ "Garrett Winters" ],
				               [ "Ashton Cox" ],
				               [ "Cedric Kelly" ],
				               [ "Airi Satou" ],
				               [ "Brielle Williamson" ],
				               [ "Herrod Chandler" ]				               
				           ];
				            
				           $(document).ready(function() {
				               $('#example').DataTable( {
				                   data: dataSet,
				                   columns: [				                       
				                       { title: "Salary" }
				                   ]
				               } );
				           } );
</script>	
