<!--  
Form Name  Declaration Started as "f_pat"FieldName
-->

<?php
include 'globalfile.php';
// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['pat_id'] ) && ! empty ( $_GET ['pat_id'] )) {
	$xGetpat_id = $_GET ['pat_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['pat_id'] );
	} else {
		$xQry = "DELETE FROM m_patientregistration where pat_id=$xGetpat_id";
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
	$GLOBALS ['xpat_id'] = "";
	$GLOBALS ['xTitle'] = "";
	$GLOBALS ['xFirstName'] = "";
	GetMaxIdNo ();
}
function DataFetch($xpat_id) {
	$result = mysql_query ( "SELECT *  FROM m_patientregistration where pat_id=$xpat_id" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xPatId'] = $row ['pat_id'];
			$GLOBALS ['xPatName'] = $row ['pat_name'];
			$GLOBALS ['xPatGender'] = $row ['pat_gender'];
			$GLOBALS ['xPatDob'] = $row ['pat_dob'];
			$GLOBALS ['xPatAddress'] = $row ['pat_address'];
			$GLOBALS ['xPatMobileNo'] = $row ['pat_mobile_no'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xPatId = $_POST ['f_patid'];
    $xUniqueId=vsprintf("%02d-%02d-%02d",str_split(sprintf("%06d", $xPatId), 2));
	$xPatName =$_POST ['f_pat_name'];
	$xPatGender =$_POST ['f_pat_gender'];
	$xPatDob =$_POST ['f_pat_dob'];
	$xPatAddress =$_POST ['f_pat_address'];
	$xPatMobileNo =$_POST ['f_pat_mobile_no'];

	if ($mode == 'S') {
		$xQry = "INSERT INTO m_patientregistration 
		(pat_id,pat_unique_id,pat_name,pat_gender,pat_dob,pat_address,pat_mobile_no)VALUES 
		($xPatId,' $xUniqueId','$xPatName','$xPatGender','$xPatDob','$xPatAddress','$xPatMobileNo')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_patientregistration   set 
		pat_name='$xPatName',
		pat_gender='$xPatGender',
		pat_dob='$xPatDob',
		pat_address='$xPatAddress',
		pat_mobile_no='$xPatMobileNo'
		where pat_id='$xPatId'";
		$xMsg = "Updated";
	} 
	 //echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	echo "<h1 color='red'>".$xMsg."</h1>";
	ShowAlert ( $xMsg );
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(pat_id)IS NULL OR max(pat_id)= '' 
       THEN '1' 
       ELSE max(pat_id)+1 END AS pat_id
FROM m_patientregistration";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPatId'] = $row ['pat_id'];
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

						<div class="col-xs-3" style="display:none">
							<label>Patient Id:</label> <input type="text"
								class="form-control" id="f_patid" name="f_patid"
								value="<?php echo $GLOBALS ['xPatId']; ?>">
						</div>

					

						<div class="col-xs-4">
							<label>Name*</label> <input type="text"
								class="form-control" name="f_pat_name"
								value="<?php echo $GLOBALS ['xPatName']; ?>" maxlength="50"
								onkeypress="return restrictCharacters(this, event, alphaOnly);"
								maxlength="25" required>
						</div>

	<div class="col-xs-2">
							<label>Gender*</label> <select class="form-control"
								name="f_pat_gender">
								<option value="MALE">MALE</option>
								<option value="FEMALE">FEMALE</option>
							</select>
						</div>
					
						<div class="col-xs-3" style="display:none">
							<label>Birth date *</label> <input type="date"
								class="form-control" name="f_pat_dob" 		value="<?php echo $GLOBALS ['xPatDob']; ?>" >
						</div>
<div class="col-xs-3">
							<label>Mobile*</label>
						<input type="text"
								class="form-control" name="f_pat_mobile_no" value="<?php echo $GLOBALS ['xPatMobileNo']; ?>" required>
						</div>
					
						<div class="col-xs-4">
							<label>Address*</label>
								<input type="text"
								class="form-control" name="f_pat_address"
								value="<?php echo $GLOBALS ['xPatAddress']; ?>"required>
						</div>
						
							

			</div>

			<!-- Panel -Patient General Information Ended !-->

		</div>
	
			<!-- Panel -Emergency Contact Ended !-->

	
			
			
			<div class="panel-footer clearfix">
       <div class="pull-right">
  
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="f_btnpatsave"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="f_btnpatupdate"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
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
								<th width="10%">UNIQUE ID</th>
								<th width="10%">NAME</th>
								<th width="10%">GENDER</th>	
									<th width="10%">MOBILE_NO</th>
							<!--	<th width="10%">DOB</th>!-->
								<th width="10%">ADDRESS</th>
							
								
								<th width="5%">ACTIONS</th>


</tr>
						</thead>
						<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from m_patientregistration  order by  pat_id";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';
function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}


while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['pat_unique_id'] . '</td>';
	echo '<td>' . $row ['pat_name'] . '</td>';
	echo '<td>' . $row ['pat_gender'] . '</td>';
	$xAge=ageCalculator($row ['pat_dob']);
//	echo '<td>' . $row ['pat_dob'] .' / '. $xAge;'</td>';
	echo '<td>' . $row ['pat_mobile_no'] . '</td>';
	echo '<td>' . $row ['pat_address'] . '</td>';


	?>
<td><a
								href="hm001patientregistration.php<?php echo '?pat_id='.$row['pat_id'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
						<!--	<td><a
								href="ht001outpatient_new.php<?php echo '?pat_id='.$row['pat_id'];  ?>"> GO TO OP
							</a></td>!-->
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