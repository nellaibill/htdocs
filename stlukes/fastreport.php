<?php
include('menu.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PATIENT REGISTRATION DETAILS</title>
	<link rel="stylesheet" id="font-awesome-style-css" href="fast/bootstrap3.min.css" type="text/css" media="all">
	<script type="text/javascript" charset="utf8" src="fast/jquery-1.11.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="fast/jquery.dataTables.min.css" />

	<script type="text/javascript" src="fast/jquery.dataTables.min.js"></script>
	<table id="grid" class="display" width="100%" cellspacing="0">
		<thead>
			<tr>

				<th width="5%">ID</th>
				<th width="5%">P.NAME</th>
				<th width="5%">RELATION</th>
				<th width="5%">R.NAME</th>
				<th width="5%">OCCUPATION</th>
				<th width="5%">SEX</th>
				<th width="5%">AGE</th>
				<th width="5%">RELIGION</th>
				<th width="5%">CASTE</th>
				<th width="5%">MARITALSTATUS</th>
				<th width="5%">DATE</th>
				<th width="5%">ADDR1</th>
				<th width="5%">ADDR2</th>
				<th width="5%">ADDR3</th>
				<th width="5%">ADDR4</th>
				<th width="5%">ADDR5</th>
				<th width="5%">PIN</th>
				<th width="5%">PHONE</th>
				<th width="5%">HOSPITALNO</th>
				<th width="5%">STATUS</th>
				<th width="5%">LRNO</th>

			</tr>
		</thead>


	</table>


	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#grid').DataTable({
				"scrollY": "600px",
				"scrollX": true,
				"scrollCollapse": true,
				"fixedColumns": {
					left: 1,
					right: 1
				},
				"bProcessing": true,
				"serverSide": true,
				"ajax": {
					url: "response.php", // json datasource
					type: "post", // type of method  ,GET/POST/DELETE
					error: function() {
						$("#grid_processing").css("display", "none");
					}
				},
				"columnDefs": [{
					"targets": 0,
					"data": null,
					"render": function(data, type, full, meta) {
						return '<a href=index.php?id=' + data[0] + '&xmode=edit> ' + data[0] + ' - Edit</a>';
					}
				}]
			});
		});
	</script>
	<style>
		table.display {
			padding-left: 2em;
			padding-right: 2em;
		}
	</style>