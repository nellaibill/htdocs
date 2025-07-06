<?php
include 'globalfile.php';
fn_DataClear ();
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
$GLOBALS ['xStatus'] = "";
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
$GLOBALS ['xStatus'] = $row ['status'];
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
$xStatus = $_POST ['status'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO birth_report  VALUES 
		($xBirthReportId,'$xMotherName','$xFatherName','$xGender',
		'$xDob','$xTime','$xBabyWeight','$xKindOfDelivery','$xDoctorName'
		,'$xAddress','$xPreparedBy','$xCollectedBy','$xRelationShip','$xStatus')";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE birth_report   SET mothername='$xMotherName',
		fathername='$xFatherName',gender='$xGender',
		date='$xDob',time='$xTime',weight='$xBabyWeight',
		delivery='$xKindOfDelivery',doctorname='$xDoctorName',
		address='$xAddress',preparedby='$xPreparedBy',
collectedby='$xCollectedBy',relationship='$xRelationShip',status='$xStatus'
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
<body onload='document.birthreportentryform.f_mothername.focus()'>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form"
		method="post" name="birthreportentryform">
		<div class="panel panel-primary" data-bind="nextFieldOnEnter:true">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">BIRTH REPORT ENTRY</h3>
			</div>

			<div class="panel-body">

				<div class="col-xs-2">
					<label>Birth Report Id:</label> <input type="text"
						class="form-control" name="f_birthreportid"
						value="<?php echo $GLOBALS ['xBirthReportId']; ?>" readonly>
				</div>
				<div class="col-xs-3">
					<label>Mother Name :</label> <input class="form-control"
						name="f_mothername" type="text"
						value="<?php echo $GLOBALS ['xMotherName']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Father Name:</label> <input class="form-control"
						name="f_fathername" type="text"
						value="<?php echo $GLOBALS ['xFatherName']; ?>">
				</div>

			

				<div class="col-xs-3">
			<label>Gender Of Baby</label>
						<select class="form-control"  name="f_genderofbaby">
							<option value="MALE"
								<?php if($GLOBALS ['xGenderOfBaby']=="MALE") echo 'selected="selected"'; ?>>MALE</option>
							<option value="FEMALE"
								<?php if( $GLOBALS ['xGenderOfBaby']=="FEMALE") echo 'selected="selected"'; ?>>FEMALE</option>
		
						</select>

					</div>

				<div class="col-xs-3">
					<label>Date Of Birth:</label> <input class="form-control"
						name="f_dob" type="date" value="<?php echo $GLOBALS ['xDob']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Time Of Birth:</label> <input class="form-control"
						name="f_time" type="text"
						value="<?php echo $GLOBALS ['xTime']; ?>">
				</div>


				<div class="col-xs-3">
					<label>Baby Weight:</label> <input class="form-control"
						name="f_babyweight" type="text"
						value="<?php echo $GLOBALS ['xBabyWeight']; ?>">
				</div>

			
							<div class="col-xs-3">
			<label>Kind Of Delivery</label>
						<select class="form-control"  name="f_kindofdelivery">
							<option value="NORMAL"
								<?php if($GLOBALS ['xKindOfDelivery']=="NORMAL") echo 'selected="selected"'; ?>>NORMAL</option>
							<option value="LSCS"
								<?php if( $GLOBALS ['xKindOfDelivery']=="LSCS") echo 'selected="selected"'; ?>>LSCS</option>
			<option value="VACCUM"
								<?php if( $GLOBALS ['xKindOfDelivery']=="VACCUM") echo 'selected="selected"'; ?>>VACCUM</option>
		
						</select>

					</div>

			
				
						<div class="col-xs-3">
			<label>Attended By Dr</label>
						<select class="form-control"  name="f_attendedbydr">
							<option value="Dr.MEENA"
								<?php if($GLOBALS ['xAttendedByDr']=="Dr.MEENA") echo 'selected="selected"'; ?>>Dr.MEENA</option>
							<option value="Dr.RAMALAKSHMI"
								<?php if( $GLOBALS ['xAttendedByDr']=="Dr.RAMALAKSHMI") echo 'selected="selected"'; ?>>Dr.RAMALAKSHMI</option>
		
						</select>

					</div>
				<div class="col-xs-3">
					<label>Address:</label> <input class="form-control"
						name="f_address" type="text"
						value="<?php echo $GLOBALS ['xAddress']; ?>">
				</div>


						<div class="col-xs-3">
			<label>Prepared By:</label>
						<select class="form-control"  name="f_preparedby">
							<option value="SUGANTHI"
								<?php if($GLOBALS ['xPreparedBy']=="SUGANTHI") echo 'selected="selected"'; ?>>SUGANTHI</option>
							<option value="MARIAMMAL"
								<?php if( $GLOBALS ['xPreparedBy']=="MARIAMMAL") echo 'selected="selected"'; ?>>MARIAMMAL</option>
		
						</select>

					</div>

				<div class="col-xs-3">
					<label>Collected By:</label> <input class="form-control"
						name="f_collectedby" type="text"
						value="<?php echo $GLOBALS ['xCollectedBy']; ?>">
				</div>


				<div class="col-xs-3">
					<label>RelationShip:</label> <input class="form-control"
						name="f_relationship" type="text"
						value="<?php echo $GLOBALS ['xRelationship']; ?>">
				</div>

 <div class="col-xs-3">
  					<label> STATUS</label>
   <select class="form-control" id="xStatus" value="" name="status">
    <option value="PROCESSING" <?php if($GLOBALS ['xStatus']=="PROCESSING") echo 'selected="selected"'; ?>>PROCESSING</option>
    <option value="COMPLETED" <?php if( $GLOBALS ['xStatus']=="COMPLETED") echo 'selected="selected"'; ?>>COMPLETED</option>
    <option value="CANCELLED" <?php if( $GLOBALS ['xStatus']=="CANCELLED") echo 'selected="selected"'; ?>>CANCELLED</option>
   </select>
  </div>
			</div>
			<div class="panel-footer clearfix">
				<div class="pull-right">
                        <?php if ($GLOBALS ['xMode'] == "") {  ?>
                        <input class="btn btn-primary" id="save"
						name="save" onclick="return validateForm()" type="submit"
						value="SAVE">
                    <?php } else{ ?>
                        <input class="btn btn-primary" name="update"
						onclick="return validateForm()" type="submit" value="UPDATE">
                        <?php }  ?>
                    </div>
			</div>
		</div>
	</form>
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
$xFromDate=$GLOBALS ['xCurrentDate'];																																$xQry = "SELECT *  from birth_report WHERE date >= '$xFromDate' or status='PROCESSING'  order by  mothername";
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