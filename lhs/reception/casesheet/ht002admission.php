<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = '';

// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['admissionno'] ) && ! empty ( $_GET ['admissionno'] )) {
	$xGetAdmissionNo = $_GET ['admissionno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['admissionno'] );
	} else {
		$xQry = "DELETE FROM t_admission WHERE admissionno=$xGetAdmissionNo";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: ht002admission.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnAdmissionSave'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnAdmissionUpdate'] )) {
	DataProcess ( "U" );
}
function DataFetch($xAdmissionNo) {
	$result = mysql_query ( "SELECT *  FROM t_admission WHERE admissionno=$xAdmissionNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xAdmissionNo'] = $row ['admissionno'];
			$GLOBALS ['$xPatientId'] = $row ['patientid'];
			$GLOBALS ['xAdmissionArea'] = $row ['admissionarea'];
			$GLOBALS ['xCaseTypeNo'] = $row ['casetypeno'];
			$GLOBALS ['$xRoomTypeNo'] = $row ['roomtypeno'];
			$GLOBALS ['xRoomNo'] = $row ['roomno'];
			$GLOBALS ['xAdvanceAmount'] = $row ['advanceamount'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xAdmissionNo = $_POST ['f_admissionno'];
	$xPatientId = $_POST ['f_patientid'];
	$xAdmissionArea = $_POST ['f_admissionarea'];
	$xCaseTypeNo = $_POST ['f_casetypeno'];
	$xRoomTypeNo = $_POST ['f_roomtypenno'];
	$xRoomNo = $_POST ['f_roomno'];
	$xAdvanceAmount = $_POST ['f_advanceamount'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO t_admission (admissionno,patientid,admissionarea,casetypeno,roomtypeno,roomno,advanceamount) 
		VALUES ($xAdmissionNo,$xPatientId,'$xAdmissionArea',$xCaseTypeNo,$xRoomTypeNo,$xRoomNo,$xAdvanceAmount)";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE t_admission   SET patientid=$xPatientId,
		admissionarea='$xAdmissionArea',casetypeno=$xCaseTypeNo,roomtypeno=$xRoomTypeNo,roomno=$xRoomNo,advanceamount=$xAdvanceAmount
		 WHERE admissionno=$xAdmissionNo";
		$xMsg = "Updated";
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	ShowAlert ( $xMsg );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['$xPatientId'] = "";
	$GLOBALS ['xAdmissionArea'] = "";
	$GLOBALS ['xCaseTypeNo'] = "";
	$GLOBALS ['$xRoomTypeNo'] = "";
	$GLOBALS ['xRoomNo'] = "";
	$GLOBALS ['xRoomTypeAmount'] = "";
	$GLOBALS ['xAdvanceAmount'] = "";
	
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(admissionno)IS NULL OR max(admissionno)= ''
       THEN '1'
       ELSE max(admissionno)+1 END AS admissionno
FROM t_admission";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xAdmissionNo'] = $row ['admissionno'];
	}
}
?>
<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<body onload='document.testform.f_testtypename.focus()'>
	<form class="form" name="testform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">ADMISSION</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group">

				<div class="col-xs-3">
					<label>Admission No</label> <input type="text" class="form-control"
						name="f_admissionno"
						value="<?php echo $GLOBALS ['xAdmissionNo']; ?>">
				</div>

				<div class="form-group">

					<div class="col-xs-3">
						<label>Patient Id:</label> <select class="form-control"
							name="f_patientid">
                         <?php
																									$result = mysql_query ( "SELECT *  FROM m_patientregistration" );
																									while ( $row = mysql_fetch_array ( $result ) ) {
																										?>
                           <option
								value="<?php echo $row['patientid']; ?>"
								<?php
																										if ($row['patientid']== $GLOBALS ['$xPatientId']){ echo 'selected="selected"'; }																										?>>
                           <?php echo $row['patientid']; ?> 
                          </option>
                         <?php }?>
                                                          </select>
					</div>

					<div class="col-xs-3">
						<label>Admission Area</label> <select class="form-control"
							name="f_admissionarea"
							onkeypress="return restrictCharacters(this, event, alphaOnly);">
							<option value="Room"
								<?php if($GLOBALS ['xAdmissionArea']=="Room") echo 'selected="selected"'; ?>>Room</option>
							<option value="Imcu"
								<?php if( $GLOBALS ['xAdmissionArea']=="Imcu") echo 'selected="selected"'; ?>>Imcu</option>
							<option value="LabourWard"
								<?php if($GLOBALS ['xAdmissionArea']=="LabourWard") echo 'selected="selected"'; ?>>LabourWard</option>
							<option value="Others"
								<?php if( $GLOBALS ['xAdmissionArea']=="Others") echo 'selected="selected"'; ?>>Others</option>
						</select>
					</div>

					<div class="col-xs-3">
						<label>Case Type:</label> <select class="form-control"
							name="f_casetypeno">
                                                      <?php
																																																						$result = mysql_query ( "SELECT *  FROM m_casetype" );
																																																						while ( $row = mysql_fetch_array ( $result ) ) {
																																																							?>
                                                         <option
								value="<?php echo $row['casetypeno']; ?>"
								<?php
																																																							if ($row ['casetypeno'] == $GLOBALS ['xCaseTypeNo']) {
																																																								echo 'selected="selected"';
																																																							}
																																																							?>>
                                                         <?php echo $row['casetypename']; ?> 
                                                         </option>
                                                         <?php
																																																						}
																																																						
																																																						?>
                                                          </select>
					</div>

					<div class="col-xs-3">
						<label>Room Type:</label> <select class="form-control"
							name="f_roomtypenno">
                                                      <?php
																																																						$result = mysql_query ( "SELECT *  FROM m_roomtype" );
																																																						while ( $row = mysql_fetch_array ( $result ) ) {
																																																							?>
                                                         <option
								value="<?php echo $row['roomtypeno']; ?>"
								<?php
																																																							if ($row ['roomtypeno'] == $GLOBALS ['$xRoomTypeNo']) {
																																																								echo 'selected="selected"';
																																																							}
																																																							?>>
                                                         <?php echo $row['roomtypename']; ?> 
                                                         </option>
                                                         <?php
																																																						}
																																																						
																																																						?>
                                                          </select>
					</div>

					<div class="col-xs-3">
						<label>Room:</label> <select class="form-control" name="f_roomno">
                                                      <?php
																																																						$result = mysql_query ( "SELECT *  FROM m_room" );
																																																						while ( $row = mysql_fetch_array ( $result ) ) {
																																																							?>
                                                         <option
								value="<?php echo $row['roomno']; ?>"
								<?php
																																																							if ($row ['roomno'] == $GLOBALS ['xRoomNo']) {
																																																								echo 'selected="selected"';
																																																							}
																																																							?>>
                                                         <?php echo $row['roomname']; ?> 
                                                         </option>
                                                         <?php
																																																						}
																																																						
																																																						?>
                                                          </select>
					</div>

					<div class="col-xs-3">
						<label>Advance Amount</label> <input type="text"
							class="form-control" name="f_advanceamount"
							value="<?php echo $GLOBALS ['xAdvanceAmount']; ?>">
					</div>

				</div>


			</div>
			<br> <br> <br> <br> <br> <br> <br> <br>
			<!-- Panel -Room Type Number Information Ended !-->

			<div class="panel-footer clearfix">
				<div class="pull-right">

					<input type="submit" name="f_BtnAdmissionSave"
						class="btn btn-primary" value="SAVE" id="save"
						onclick="return validateForm()"> <input type="submit"
						name="f_BtnAdmissionUpdate" class="btn btn-primary" value="UPDATE"
						onclick="return validateForm()">

				</div>
			</div>
		</div>

	</form>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">

				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">VIEW ADMISSION</h3>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Filter</span> <input id="filter"
						type="text" class="form-control" placeholder="Search here...">
				</div>
				<table class="table">
					<thead>
						<tr>
							<th width="5%">SL.NO</th>
							<th width="20%">PATIENT NAME</th>
							<th width="20%">ADMISSION AREA</th>
							<th width="20%">CASE TYPE</th>
							<th width="20%">ROOM NO</th>
							<th width="20%">AMOUNT</th>
							<th width="5%">ACTIONS</th>
<?php
if ($login_session == "admin") {
	?>
<th colspan="2" width="5%">ACTIONS
<?php
}
?>

						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						</tr>
					</thead>
					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from t_admission  order by admissionno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	fn_PatientDetails ( $row ['patientid'] );
	fn_CaseType ( $row ['casetypeno'] );
	fn_Room ( $row ['roomno'] );
	echo '<td>' . ucwords ( strtolower ( $GLOBALS ['xTitle'] ) ) . '.' . ucwords ( strtolower ( $GLOBALS ['xFirstName'] ) ) . ' ' . ucwords ( strtolower ( $GLOBALS ['xLastName'] ) ) . '</td>';
	echo '<td>' . $row ['admissionarea'] . '</td>';
	echo '<td>' . $GLOBALS ['xCaseTypeName'] . '</td>';
	echo '<td>' . $GLOBALS ['xRoomName'] . '</td>';
	echo '<td>' . $row ['advanceamount'] . '</td>';
	?>
<td><a
							href="ht002admission.php<?php echo '?admissionno='.$row['admissionno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
						<td><a
							href="ht002admission.php<?php echo '?admissionno='.$row['admissionno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
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
	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
	</form>
	<script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,select,button,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
    </script>