
<?php
include ('globalfile.php');

?>
<html>
<head>

<body>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint" >
		<div class="container">
			<div class="panel panel-info">
  <div class="panel-heading  text-center">
        <h3 class="panel-title">VIEW-PATIENT DEAD REPORT</h3>
<div class="pull-right">
              <input id="filter" type="text" class="form-control" placeholder="Search here...">
            </div>
  </div>
				<!-- Default panel contents -->

				<table class="table">
					<thead>
						<tr>
							<th width="5%">SL.NO</th>
							<th width="5%">ID</th>
							<th width="20%">PATIENTNAME</th>
							<th width="20%">RELATIONNAME</th>
							<th width="5%">SEX</th>
							<th width="5%">AGE</th>
							<th width="20%">ADDRESS</th>
											<th width="10%">LRNO</th>
						    <th width="10%">STATUS</th>

	</tr>
					</thead>
					<tbody class="searchable">
<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from patient_data  order by id";
$xQry = "SELECT * from patient_data WHERE patient_status ='Dead'";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	?>
	<td><a href="index.php<?php echo '?id='.$row['id']  . '&xmode=edit'; ?>"><?php echo  $row ['id']; ?></a></td>
    <?php 
	echo '<td>' . $row ['patient_name'] . '</td>';
	echo '<td>' . $row ['relation_with'] .'  ' . $row ['relation_name'] . '</td>';
    echo '<td>' . $row ['sex'] . '</td>';
    echo '<td>' . $row ['age'] . '</td>';
    echo '<td>' . $row ['address_line_1'] . '</td>';
    echo '<td>' . $row ['lr_no'] . '</td>';
    echo '<td>' . $row ['patient_status'] . '</td>';
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