<?php
include 'globalfile.php';
fn_DataClear ();
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
if (isset ( $_GET ['birthreportid'] ) && ! empty ( $_GET ['birthreportid'] )) {
	$no = $_GET ['birthreportid'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['birthreportid'] );
	} else {
		$xQry = "DELETE FROM birth_report WHERE birthreportid= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		header ( 'Location: birth_report_entry.php' );
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} else {
	fn_GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xBirthReportId'] = '';
	$GLOBALS ['xMotherName'] = '';
	$GLOBALS ['xFatherName'] = '';
	$GLOBALS ['xGenderOfBaby'] = '';
	$GLOBALS ['xDob'] = '';
	$GLOBALS ['xTime'] = '';
	$GLOBALS ['xBabyWeight'] = '';
	$GLOBALS ['xKindOfDelivery'] = '';
	$GLOBALS ['xSupplierRegisterNo'] = '';
	$GLOBALS ['xAttendedByDr'] = '';
	$GLOBALS ['xAddress'] = '';
	$GLOBALS ['xPreparedBy'] = '';
	$GLOBALS ['xCollectedBy'] = '';
	$GLOBALS ['xRelationship'] = '';
}
function fn_GetMaxIdNo() {
	$xQry = "SELECT  CASE WHEN max(birthreportid)IS NULL OR max(birthreportid)= '' THEN '1' ELSE max(birthreportid)+1 END AS birthreportid FROM birth_report";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xBirthReportId'] = $row ['birthreportid'];
	}
}
function DataFetch($xBirthReportId) {
	$result = mysql_query ( "SELECT *  FROM birth_report where birthreportid=$xBirthReportId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xBirthReportId'] = $row ['birthreportid'];
			$GLOBALS ['xMotherName'] = $row ['mothername'];
			$GLOBALS ['xFatherName'] = $row ['fathername'];
			$GLOBALS ['xGenderOfBaby'] = $row ['gender'];
			$GLOBALS ['xDob'] = $row ['date'];
			$GLOBALS ['xTime'] = $row ['time'];
			$GLOBALS ['xBabyWeight'] = $row ['weight'];
			$GLOBALS ['xKindOfDelivery'] = $row ['delivery'];
			$GLOBALS ['xAttendedByDr'] = $row ['doctorname'];
			$GLOBALS ['xAddress'] = $row ['address'];
			$GLOBALS ['xPreparedBy'] = $row ['preparedby'];
			$GLOBALS ['xCollectedBy'] = $row ['collectedby'];
			$GLOBALS ['xRelationship'] = $row ['relationship'];
		}
	}
}
function DataProcess($mode) {
	$xBirthReportId = $_POST ['f_birthreportid'];
	$xMotherName = strtoupper ( $_POST ['f_mothername'] );
	$xFatherName = $_POST ['f_fathername'];
	$xGender = $_POST ['f_genderofbaby'];
	$xDob = $_POST ['f_dob'];
	$xTime = $_POST ['f_time'];
	$xBabyWeight = $_POST ['f_babyweight'];
	$xKindOfDelivery = $_POST ['f_kindofdelivery'];
	$xDoctorName = $_POST ['f_attendedbydr'];
	$xAddress = $_POST ['f_address'];
	$xPreparedBy = $_POST ['f_preparedby'];
	$xCollectedBy = $_POST ['f_collectedby'];
	$xRelationShip = $_POST ['f_relationship'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO birth_report  VALUES 
		($xBirthReportId,'$xMotherName','$xFatherName','$xGender',
		'$xDob','$xTime','$xBabyWeight','$xKindOfDelivery','$xDoctorName'
		,'$xAddress','$xPreparedBy','$xCollectedBy','$xRelationShip')";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE birth_report   SET mothername='$xMotherName',
		fathername='$xFatherName',gender='$xGender',
		date='$xDob',time='$xTime',weight='$xBabyWeight',
		delivery='$xKindOfDelivery',doctorname='$xDoctorName',
		address='$xAddress',preparedby='$xPreparedBy',collectedby='$xCollectedBy',relationship='$xRelationShip'
 WHERE birthreportid=$xBirthReportId";
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	fn_GetMaxIdNo ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BIRTH REPORT</title>
</head>
<script type="text/javascript">
        function validateForm() {

            var xMotherName = document.forms["birthreportentryform"]["f_mothername"].value;
            if (xMotherName == null || xMotherName == "") {
                alert("Mother-Name must be filled out");
                document
                    .birthreportentryform
                    .f_mothername
                    .focus();
                return false;
            }

        }
    </script>

	<div class="input-group">
		<span class="input-group-addon">Filter</span> <input id="filter"
			type="text" class="form-control" placeholder="Search here...">
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<h3 class="panel-title">VIEW-BIRTH REPORT</h3>

		</div>
		<div class="panel-body">
			<div id="divToPrint">
				<div class="container">

					<table class="table table-striped  table-bordered " border="1">
						<thead>
							<tr>
								<th>S.NO</th>
								<th>MOTHER NAME</th>
								<th>FATHER NAME</th>
								<th>GENDER</th>
								<th>DATE</th>
								<th>TIME</th>
								<th>WEIGHT</th>
								<th>DELIVERY</th>
								<th>DOCTOR</th>
									<th>ADDRESS</th>
								<th>PREPARED</th>
								<th>COLLECTED</th>
								<th>RELATIONSHIP</th>
								<th colspan="2" width="5%">ACTIONS</th>
							</tr>
						</thead>
						<tbody class="searchable">

                                <?php
																																$xSlNo = 0;
																																$xQry = '';
																															$xQry = "SELECT *  from birth_report  WHERE date >= '$xFromDate' AND date<= '$xToDate'  order by  mothername";
																															$result2 = mysql_query ( $xQry );
																																$rowCount = mysql_num_rows ( $result2 );
																																while ( $row = mysql_fetch_array ( $result2 ) ) {
																																	?>
																																	<tr>
																																	<?php
																																	
																																	echo '<td>' . $xSlNo += 1 . '</td>';
																																	echo '<td>' . $row ['mothername'] . '</td>';
																																	echo '<td>' . $row ['fathername'] . '</td>';
																																	echo '<td>' . $row ['gender'] . '</td>';
																																	echo '<td>' . $row ['date'] . '</td>';
																																	echo '<td>' . $row ['time'] . '</td>';
																																	echo '<td>' . $row ['weight'] . '</td>';
																																	echo '<td>' . $row ['delivery'] . '</td>';
																																	echo '<td>' . $row ['doctorname'] . '</td>';
																																	echo '<td>' . $row ['address'] . '</td>';
																																	echo '<td>' . $row ['preparedby'] . '</td>';
																																	echo '<td>' . $row ['collectedby'] . '</td>';
																																	echo '<td>' . $row ['relationship'] . '</td>';
																															
																																	
																																	?>
                                <td><a
									href="birth_report_entry.php<?php echo '?birthreportid='.$row['birthreportid'] . '&xmode=edit'; ?>"
									onclick="return confirm_edit()"> <img alt="HTML tutorial"
										src="images/edit.png"
										style="width: 30px; height: 30px; border: 0">
								</a></td>
  <!-- <td><a
									href="birth_report_entry.php<?php echo '?birthreportid='.$row['birthreportid'] . '&xmode=delete'; ?>"
									onclick="return confirm_delete()"> <img alt="HTML tutorial"
										src="images/delete.png"
										style="width: 30px; height: 30px; border: 0">
								</a></td>
				!-->
				
						<td><a
							href="birthreport.php<?php  echo '?birthreportid=' . $row ['birthreportid'] . '&xmode=print'; ?>">
								<img src="images/print.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
                                <?php
																																	echo '</tr>';
																																}
																																
																																?>
                            
					
					
						
						
						
						
						
						
						
						</tbody>
					</table>
				</div>
			</div>
			<!-- /container -->
		</div>

</body>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<script src="js/nextfocus.js"></script>