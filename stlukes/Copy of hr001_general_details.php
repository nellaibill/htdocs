<?php
include ('globalfile.php');
?>
<html>
<body>

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">GENERAL DETAILS</h3>
					<div class="pull-right">
						<input id="filter" type="text" class="form-control"
							placeholder="Search here...">
					</div>
				</div>

				<!-- Default panel contents -->

				<table class="table">
					<thead>
						<tr>
							<th width="5%">SL.NO</th>
							<th width="5%">ID</th>
							<th width="5%">PATIENT NAME</th>
							<th width="5%">RELATION NAME</th>
							<th width="5%">SEX</th>
							<th width="5%">AGE</th>
							<th width="5%">ADDRESS</th>


						</tr>
					</thead>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT id,patient_name,relation_with,relation_name,sex,age,address_line_1,address_line_2  from patient_data  order by id";

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	?>
			<td><a
								href="index.php<?php echo '?id='.$row['id']  . '&xmode=edit'; ?>"><?php echo  $row ['id']; ?></a></td>
		    <?php
	echo '<td>' . $row ['patient_name'] . '</td>';
	echo '<td>' . $row ['relation_with'] . '  ' . $row ['relation_name'] . '</td>';
	echo '<td>' . $row ['sex'] . '</td>';
	echo '<td>' . $row ['age'] . '</td>';
	echo '<td>' . $row ['address_line_1'] ." , " . $row ['address_line_2'] . '</td>';
	?>

<?php
	echo '</tr>';
}
?>	
			
									
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>

</body>

</html>