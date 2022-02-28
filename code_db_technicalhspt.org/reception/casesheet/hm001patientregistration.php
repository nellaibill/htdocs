<!--  
Form Name  Declaration Started as "f_pat"FieldName
-->

<?php
include 'globalfile.php';

// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['patientid'] ) && ! empty ( $_GET ['patientid'] )) {
	$xGetPatientId = $_GET ['patientid'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['patientid'] );
	} else {
		$xQry = "DELETE FROM m_patientregistration where patientid=$xGetPatientId";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: hm001patientregistration.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_btnpatsave'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_btnpatupdate'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xPatientId'] = "";
	$GLOBALS ['xTitle'] = "";
	$GLOBALS ['xFirstName'] = "";
	GetMaxIdNo ();
}
function DataFetch($xPatientId) {
	$result = mysql_query ( "SELECT *  FROM m_patientregistration where patientid=$xPatientId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xPatientId'] = $row ['patientid'];
			$GLOBALS ['xTitle'] = $row ['title'];
			$GLOBALS ['xFirstName'] = $row ['firstname'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xPatientId = $_POST ['f_patid'];
	$xTitle =$_POST ['f_pattitle'];
	$xFirstName = strtoupper ( $_POST ['f_patfirstname'] );
	$xLastName = strtoupper ( $_POST ['f_patlastname'] );
	$xInitials = strtoupper ( $_POST ['f_patinitials'] );
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_patientregistration 
		(patientid,title,firstname,lastname,initials) VALUES 
		($xPatientId,'$xTitle','$xFirstName','$xLastName','$xInitials')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_patientregistration   SET title='$xTitle',firstname='$xFirstName',
		lastname='$xLastName',initials'$xInitials' WHERE patientid='$xPatientId'";
		$xMsg = "Updated";
	} 
	// echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	ShowAlert ( $xMsg );
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(patientid)IS NULL OR max(patientid)= '' 
       THEN '1' 
       ELSE max(patientid)+1 END AS patientid
FROM m_patientregistration";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPatientId'] = $row ['patientid'];
	}
}

?>
<script>
function myFunction() {
    alert("I am an alert box!");
}
</script>
<body onload='document.testform.f_testtypename.focus()'>
	<form class="form" name="patientregistration"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div>

			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title  text-center">PATIENT REGISTRATION FORM</h3>
				</div>

				<!-- Panel Body !-->

				<div class="panel-body">

					<!-- Panel -Patient General Information !-->

					<div class="form-group">

						<div class="col-xs-3">
							<label>Patient Id:</label> <input type="text"
								class="form-control" id="f_patid" name="f_patid"
								value="<?php echo $GLOBALS ['xPatientId']; ?>">
						</div>

						<div class="col-xs-1">
							<label>Title*</label> <select class="form-control"
								name="f_pattitle">
								<option value="MR">MR.</option>
								<option value="MRS">MRS</option>
								<option value="MISS">MISS</option>
							</select>
						</div>

						<div class="col-xs-3">
							<label>First name*</label> <input type="text"
								class="form-control" name="f_patfirstname"
								value="<?php echo $GLOBALS ['xFirstName']; ?>" maxlength="50"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="25">
						</div>

						<div class="col-xs-3">
							<label>Last name</label> <input type="text" class="form-control"
								name="f_patlastname" maxlength="50"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="25">
						</div>

						<div class="col-xs-2">
							<label>Initials</label> <input type="text" class="form-control"
								name="f_patinitials" maxlength="10"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="10">
						</div>

						<div class="col-xs-3">
							<label>Birth date *</label> <input type="date"
								class="form-control" name="f_patbirthdate">
						</div>

						<div class="col-xs-1">
							<label>Age*</label> <input type="text" class="form-control"
								name="f_patage" maxlength="3"
								onkeypress="return restrictCharacters(this, event, integerOnly);"
								maxlength="3">
						</div>

						<div class="col-xs-1">
							<label>Sex*</label> <select class="form-control"
								name="f_patgender">
								<option value="NONE">Male</option>
								<option value="NONE">Female</option>
								<option value="NONE">Others</option>
							</select>
						</div>

						<div class="col-xs-3">
							<label>Unique references no*</label> <input type="text"
								class="form-control" name="f_patuniquereferncesno"
								maxlength="25"
								onkeypress="return restrictCharacters(this, event, integerOnly);"
								maxlength="25">
						</div>

						<div class="col-xs-3">
							<label>Addressline1*</label>
							<textarea class="form-control" name="f_addressline1"
								maxlength="100"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="50"></textarea>
						</div>

						<div class="col-xs-3">
							<label>Addressline2</label>
							<textarea class="form-control" name="f_addressline2"
								maxlength="100"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="50"></textarea>
						</div>

						<div class="col-xs-3">
							<label>city*</label> <input type="text" class="form-control"
								name="f_city" maxlength="25"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="50">
						</div>

						<div class="col-xs-2">
							<label>State*</label> <input type="text" class="form-control"
								name="f_patstate" maxlength="25"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="25">
						</div>

						<div class="col-xs-2">
							<label>Zipcode*</label> <input type="text" class="form-control"
								name="f_patzipcode" maxlength="7"
								onkeypress="return restrictCharacters(this, event, integerOnly);"
								maxlength="25">
						</div>
					</div>

					<div class="col-xs-3">
						<label>Primaryphoneno*</label> <input type="text"
							class="form-control" name="f_patprimaryphoneno" maxlength="10"
							onkeypress="return restrictCharacters(this, event, integerOnly);"
							maxlength="10">
					</div>
				</div>

				<div class="col-xs-3">
					<label>cellphone</label> <input type="text" class="form-control"
						name="f_patcellphone" maxlength="10"
						onkeypress="return restrictCharacters(this, event, integerOnly);"
						maxlength="10">
				</div>

				<div class="col-xs-3">
					<label>Emailaddress</label> <input type="text" class="form-control"
						name="f_patemailaddress" maxlength="50">
				</div>

				<div class="col-xs-1">
					<label>Maritalstatus*</label> <select class="form-control"
						name="f_patmaritalstatus">
						<option value="NONE">Single</option>
						<option value="NONE">Married</option>
					</select>
				</div>

				<div class="col-xs-3">
					<label>Spousename</label> <input type="text" class="form-control"
						name="f_patspousename" maxlength="50"
						onkeypress="return restrictCharacters(this, event, alphaOnly);"
						maxlength="50">
				</div>

			</div>

			<!-- Panel -Patient General Information Ended !-->

		</div>
		<br></br> <br></br> <br></br>

		<!-- Panel -Emergency Contact Start !-->
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">EMERGENCY CONTACT DETAILS</h3>
			</div>

			<div class="col-xs-3">
				<label>Name*</label> <input type="text" class="form-control"
					name="f_patname" maxlength="50"
					onkeypress="return restrictCharacters(this, event, alphaOnly);"
					maxlength="50">
			</div>

			<div class="col-xs-3">
				<label>Relationship*</label> <select class="form-control"
					name="f_patrelationship"
					onkeypress="return restrictCharacters(this, event, alphaOnly);">
					<option value="NONE">Father</option>
					<option value="NONE">MOM</option>
					<option value="NONE">FRIENDS</option>
					<option value="NONE">GUARDIAN</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Contactno*</label> <input type="text" class="form-control"
					name="f_patcontactnumber" maxlength="10"
					onkeypress="return restrictCharacters(this, event, integerOnly);"
					maxlength="10">
			</div>
			<br></br> <br></br> <br></br>
			<!-- Panel -Emergency Contact Ended !-->

			<div class="panel-footer clearfix">
				<div class="pull-right">

					<input type="submit" name="f_btnpatsave" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()"> <input
						type="submit" name="f_btnpatupdate" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()">

				</div>
			</div>
		</div>



		<hr>
		<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
		<div id="divToPrint">
			<div class="container">
				<div class="panel panel-info">

					<!-- Default panel contents -->
					<div class="panel-heading  text-center">
						<h3 class="panel-title">VIEW PATIENTS</h3>
					</div>
									<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
					<table class="table" >
						<thead>
							<tr>
								<th width="5%">SL.NO</th>
								<th width="10%">PATIENT ID</th>
								<th width="10%">TITLE</th>
								<th width="20%">FIRST NAME</th>
                                <th width="20%">LAST NAME</th>
                                <th width="20%">INITIALS</th>
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
$xQry = "SELECT *  from m_patientregistration  order by  patientid";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['patientid'] . '</td>';
	echo '<td>' . $row ['title'] . '</td>';
	echo '<td>' . $row ['firstname'] . '</td>';
	echo '<td>' . $row ['lastname'] . '</td>';
	echo '<td>' . $row ['initials'] . '</td>';
	?>
<td><a
								href="hm001patientregistration.php<?php echo '?patientid='.$row['patientid'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="hm001patientregistration.php<?php echo '?patientid='.$row['patientid']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
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