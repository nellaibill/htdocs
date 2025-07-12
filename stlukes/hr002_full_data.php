<?php
ob_start();
ob_flush();
/* Error Ended */
include('globalfile.php');

?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<CENTER>
	<h3>PATIENT REGISTRATION DETAILS</h3>
</CENTER>
<table id="example" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%">Id</th>
			<th width="5%">PATIENT-NAME</th>
            <th width="5%">RELATIONS</th>
            <th width="5%">OCCUPATION</th>
            <th width="5%">AGE-SEX</th>
            <th width="5%">RELIGION-CASTE</th>
            <th width="5%">MARITAL STATUS</th>
            <th width="5%">DATE</th>
            <th width="5%">D.NO AND STREET</th>
            <th width="5%">PLACE</th>
            <th width="5%">POST</th>
            <th width="5%">TALUK</th>
            <th width="5%">DISTRICT</th>
            <th width="5%">PINCODE</th>
            <th width="5%">PHONE NO</th>
            <th width="5%">PATIENT STATUS</th>
            <th width="5%">HOSPITAL NO</th>
            <th width="5%">LR NO</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th width="5%">Id</th>
			<th width="5%">PATIENT-NAME</th>
           <th width="5%">RELATIONS</th>
           <th width="5%">OCCUPATION</th>
           <th width="5%">AGE-SEX</th>
           <th width="5%">RELIGION-CASTE</th>
           <th width="5%">MARITAL STATUS</th>
           <th width="5%">DATE</th>
           <th width="5%">D.NO AND STREET</th>
           <th width="5%">PLACE</th>
           <th width="5%">POST</th>
           <th width="5%">TALUK</th>
           <th width="5%">DISTRICT</th>
           <th width="5%">PINCODE</th>
           <th width="5%">PHONENO</th>
           <th width="5%">PATIENT STATUS</th>
           <th width="5%">HOSPITAL NO</th>
           <th width="5%">LR NO</th> 
		</tr>
	</tfoot>
	<tbody>
<?php
$xQry = "SELECT *  
from patient_data";
$result2 = mysqli_query($con, $xQry);
$rowCount = mysqli_num_rows($result2);
$xSlNo = 0;
while ( $row = mysqli_fetch_array ( $result2 ) ) {
	$xSlNo++;
	?>
	<tr>
	<td><a href="index.php<?php echo '?id='.$row['id']  . '&xmode=edit'; ?>"><?php echo  $row ['id']; ?></a></td>
    <?php 
	echo '<td align=left>' . $row ['patient_name'] . '</td>';
	echo '<td align=left>' . $row ['relation_with'] . "-" . $row ['relation_name'] . '</td>';
	echo '<td align=left>' . $row ['occupation'] . '</td>';
	echo '<td align=left>' . $row ['age'] . "-" . $row ['sex'] . '</td>';
	echo '<td align=left>' . $row ['religion'] . "-" . $row ['caste'] . '</td>';
	echo '<td align=left>' . $row ['marital_status'] . '</td>';
	echo '<td align=left>' . $row ['date'] . '</td>';
	echo '<td align=left>' . $row ['address_line_1'] . '</td>';
	echo '<td align=left>' . $row ['address_line_2'] . '</td>';
	echo '<td align=left>' . $row ['address_line_3'] . '</td>';
	echo '<td align=left>' . $row ['address_line_4'] . '</td>';
	echo '<td align=left>' . $row ['address_line_5'] . '</td>';
	echo '<td align=left>' . $row ['pincode'] . '</td>';
	echo '<td align=left>' . $row ['phone_no'] . '</td>';
	echo '<td align=left>' . $row ['patient_status'] . '</td>';
	echo '<td align=left>' . $row ['hospital_no'] . '</td>';
	echo '<td align=left>' . $row ['lr_no'] . '</td>';
	?>
	</tr>
	<?php 
}	

?>
					</tbody>

</table>