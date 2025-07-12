<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = "";
fn_DataClear ();
if (isset ( $_POST ['BtnSave'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['BtnUpdate'] )) {
	DataProcess ( "U" );
} elseif (isset ( $_POST ['BtnEdit'] )) {
	$xId = $_POST ['f_id'];
	DataFetch ( $xId );
} elseif (isset ( $_POST ['BtnDelete'] )) {
	DataProcess ( "D" );
}
if (isset ( $_GET ['id'] ) && ! empty ( $_GET ['id'] )) {
	$xId = $_GET ['id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['id'] );
	} else {
		DataProcess ( "D" );
	}
}
function fn_DataClear() {
	$GLOBALS ['xId'] = '';
	$GLOBALS ['xPatientName'] = '';
	$GLOBALS ['xRelationWith'] = '';
	$GLOBALS ['xRelationName'] = '';
	$GLOBALS ['xOccupation'] = '';
	$GLOBALS ['xSex'] = '';
	$GLOBALS ['xAge'] = '';
	$GLOBALS ['xReligion'] = '';
	$GLOBALS ['xCaste'] = '';
	$GLOBALS ['xMaritalStatus'] = '';
	$GLOBALS ['xDate'] =date ( 'Y-m-d' );
	$GLOBALS ['xAddressLine1'] = '';
	$GLOBALS ['xAddressLine2'] = '';
	$GLOBALS ['xAddressLine3'] = '';
	$GLOBALS ['xAddressLine4'] = '';
	$GLOBALS ['xAddressLine5'] = '';
	$GLOBALS ['xPinCode'] = '';
	$GLOBALS ['xPhoneNo'] = '';
	$GLOBALS ['xHospitalNo'] = '';
	$GLOBALS ['xPatientStatus'] = '';
	$GLOBALS ['xLRNo'] = '';
	fn_GetMaxIdNo ();
}
function fn_GetMaxIdNo() {
	global $con;
	$xQry = "SELECT  CASE WHEN max(id)IS NULL OR max(id)= '' THEN '1' ELSE max(id)+1 END AS id FROM patient_data";
	$result = mysqli_query ( $con, $xQry ) or die ( mysqli_error ( $con ) );
	while ( $row = mysqli_fetch_array ( $result ) ) {
		$GLOBALS ['xId'] = $row ['id'];
	}
}
function DataFetch($xId) {
	global $con;
	$result = mysqli_query ( $con, "SELECT *  FROM patient_data where id=$xId" ) or die ( mysqli_error ( $con ) );
	$count = mysqli_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysqli_fetch_array ( $result ) ) {
			$GLOBALS ['xId'] = $row ['id'];
			$GLOBALS ['xPatientName'] = $row ['patient_name'];
			$GLOBALS ['xRelationWith'] = $row ['relation_with'];
			$GLOBALS ['xRelationName'] = $row ['relation_name'];
			$GLOBALS ['xOccupation'] = $row ['occupation'];
			$GLOBALS ['xSex'] = $row ['sex'];
			$GLOBALS ['xAge'] = $row ['age'];
			$GLOBALS ['xReligion'] = $row ['religion'];
			$GLOBALS ['xCaste'] = $row ['caste'];
			$GLOBALS ['xMaritalStatus'] = $row ['marital_status'];
			$GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xAddressLine1'] = $row ['address_line_1'];
			$GLOBALS ['xAddressLine2'] = $row ['address_line_2'];
			$GLOBALS ['xAddressLine3'] = $row ['address_line_3'];
			$GLOBALS ['xAddressLine4'] = $row ['address_line_4'];
			$GLOBALS ['xAddressLine5'] = $row ['address_line_5'];
			$GLOBALS ['xPinCode'] = $row ['pincode'];
			$GLOBALS ['xPhoneNo'] = $row ['phone_no'];
			$GLOBALS ['xHospitalNo'] = $row ['hospital_no'];
			$GLOBALS ['xPatientStatus'] = $row ['patient_status'];
			$GLOBALS ['xLRNo'] = $row ['lr_no'];
		}
	}
}
function DataProcess($mode) {
	$xId = $_POST ['f_id'];
	$xPatientName = preg_replace ( '/[^A-Za-z0-9\-]/', '', $_POST ['f_patient_name'] );
	// $xPatientName = strtoupper ( $_POST ['f_patient_name'] );
	$xRelationWith = $_POST ['f_relation_with'];
	$xRelationName = $_POST ['f_relation_name'];
	$xOccupation = $_POST ['f_occupation'];
	$xSex = $_POST ['f_sex'];
	$xAge = $_POST ['f_age'];
	$xReligion = $_POST ['f_religion'];
	$xCaste = $_POST ['f_caste'];
	$xMaritalStatus = $_POST ['f_marital_status'];
	$xDate = $_POST ['f_date'];
	$xAddressLine1 = $_POST ['f_address_line_1'];
	$xAddressLine2 = $_POST ['f_address_line_2'];
	$xAddressLine3 = $_POST ['f_address_line_3'];
	$xAddressLine4 = $_POST ['f_address_line_4'];
	$xAddressLine5 = $_POST ['f_address_line_5'];
	$xPincode = $_POST ['f_pincode'];
	$xPhoneNo = $_POST ['f_phone_no'];
	$xHospitalNo = $_POST ['f_hospital_no'];
	$xPatientStatus = $_POST ['f_patient_status'];
	$xLrNo = $_POST ['f_lr_no'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO patient_data  VALUES
		($xId,'$xPatientName','$xRelationWith','$xRelationName','$xOccupation','$xSex',$xAge,
		'$xReligion','$xCaste','$xMaritalStatus','$xDate','$xAddressLine1',
		'$xAddressLine2','$xAddressLine3','$xAddressLine4','$xAddressLine5',
		'$xPincode','$xPhoneNo','$xHospitalNo','$xPatientStatus','$xLrNo')";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE patient_data   SET patient_name='$xPatientName',
		relation_with='$xRelationWith',
		relation_name='$xRelationName',
		occupation='$xOccupation',
		sex='$xSex',
		age=$xAge,
		religion='$xReligion',
		caste='$xCaste',
		marital_status='$xMaritalStatus',
		date='$xDate',
		address_line_1='$xAddressLine1',
		address_line_2='$xAddressLine2',
		address_line_3='$xAddressLine3',
		address_line_4='$xAddressLine4',
		address_line_5='$xAddressLine5',
		pincode='$xPincode',
		phone_no='$xPhoneNo',
		hospital_no='$xHospitalNo',
		patient_status='$xPatientStatus',
		lr_no='$xLrNo'
		WHERE id=$xId";
	} elseif ($mode == 'D') {
		$xQry = "delete from  patient_data  WHERE id=$xId";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	fn_GetMaxIdNo ();
}

?>
<html>
<head>
<script
	src="js/jquery.min.js"
	type="text/javascript"></script>
<script src="js/knockout-2.2.1.js"
	type="text/javascript"></script>
<script type="text/javascript">

function fn_Validate_Form_Controls() 
     {

		  var xPatientName= document.forms["patient_data"]["f_patient_name"].value;
	      var xRelationWith= document.forms["patient_data"]["f_relation_with"].value;
	      var xRelationName= document.forms["patient_data"]["f_relation_name"].value;
	      var xAge= document.forms["patient_data"]["f_age"].value;
      if (xPatientName== null || xPatientName== "") 
           {
          	alert("Please Enter Patient Name");
            document.patient_data.f_patient_name.focus();
	        return false;
           }

      if (xRelationWith== "0") 
           {
          	alert("Please Choose Relation");
            document.patient_data.f_relation_with.focus();
	        return false;
           }

      if (xRelationName== null || xRelationName== "") 
           {
          	alert("Please Enter Relation Name");
            document.patient_data.f_relation_name.focus();
	        return false;
           }

      if (xAge== null || xAge== "") 
           {
          	alert("Please Enter Patient Age");
            document.patient_data.f_age.focus();
	        return false;
           }
      if (xAge>99) 
      {
     	alert("Please Enter Age Below 100");
       document.patient_data.f_age.focus();
       return false;
      }
      }
      </script>
</head>


<body onload='document.patient_data.f_patient_name.focus()'>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form"
		method="post" name="patient_data">
		<div class="panel panel-success" data-bind="nextFieldOnEnter:true">
			<div class="panel-heading">
				<h3 class="panel-title text-center">PATIENT-DATA</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-xs-2">
						<label>Id:</label> <input type="text" class="form-control"
							name="f_id" value="<?php echo $GLOBALS ['xId']; ?>" readonly>
					</div>
					<div class="col-xs-3">
						<label>Patient Name :</label> <input class="form-control"
							name="f_patient_name" type="text"
							value="<?php echo $GLOBALS ['xPatientName']; ?>">
					</div>
					<div class="col-xs-2">
						<label>Relation With :</label> <select class="form-control"
							name="f_relation_with">
							<option value="0">Choose Relation</option>
							<option value="S/O"
								<?php if($GLOBALS ['xRelationWith']  == 'S/O') echo 'selected="selected"'; ?>>S/O</option>
							<option value="D/O"
								<?php if($GLOBALS ['xRelationWith']  == 'D/O') echo 'selected="selected"'; ?>>D/O</option>
							<option value="F/O"
								<?php if($GLOBALS ['xRelationWith']  == 'F/O') echo 'selected="selected"'; ?>>F/O</option>
							<option value="W/O"
								<?php if($GLOBALS ['xRelationWith']  == 'W/O') echo 'selected="selected"'; ?>>W/O</option>
						</select>
					</div>
					<div class="col-xs-3">
						<label>Relation Name :</label> <input class="form-control"
							name="f_relation_name" type="text"
							value="<?php echo $GLOBALS ['xRelationName']; ?>">
					</div>
					<div class="col-xs-3">
						<label>Occupation:</label> <input class="form-control"
							name="f_occupation" type="text"
							value="<?php echo $GLOBALS ['xOccupation']; ?>">
					</div>
					<div class="col-xs-2">
						<label>Sex:</label> <select class="form-control" name="f_sex">

							<option value="Male"
								<?php if($GLOBALS ['xSex']  == 'Male') echo 'selected="selected"'; ?>>Male</option>
							<option value="FeMale"
								<?php if($GLOBALS ['xSex']  == 'FeMale') echo 'selected="selected"'; ?>>FeMale</option>
							<option value="Transend"
								<?php if($GLOBALS ['xSex']  == 'Transend') echo 'selected="selected"'; ?>>Transend</option>

						</select>
					</div>
					<div class="col-xs-2">
						<label>Age:</label> <input type="number" class="form-control"
							name="f_age" value="<?php echo $GLOBALS ['xAge']; ?>"
							style="text-align: right;"
							onkeypress="return restrictCharacters(this, event, integerOnly);">
					</div>
					<div class="col-xs-2">
						<label>Religion:</label> <select class="form-control"
							name="f_religion">
							<option value="Hindu"
								<?php if($GLOBALS ['xReligion']  == 'Hindu') echo 'selected="selected"'; ?>>Hindu</option>
							<option value="Muslim"
								<?php if($GLOBALS ['xReligion']  == 'Muslim') echo 'selected="selected"'; ?>>Muslim</option>
							<option value="Christian"
								<?php if($GLOBALS ['xReligion']  == 'Christian') echo 'selected="selected"'; ?>>Christian</option>

						</select>
					</div>
					<div class="col-xs-2">
						<label>Caste:</label> <input class="form-control" name="f_caste"
							type="text" value="<?php echo $GLOBALS ['xCaste']; ?>">
					</div>
					<div class="col-xs-2">
						<label>Marital Status:</label> <select class="form-control"
							name="f_marital_status">
							<option value="Married"
								<?php if($GLOBALS ['xMaritalStatus']  == 'Married') echo 'selected="selected"'; ?>>Married</option>
							<option value="UnMarried"
								<?php if($GLOBALS ['xMaritalStatus']  == 'UnMarried') echo 'selected="selected"'; ?>>UnMarried</option>
						</select>
					</div>

					<div class="col-xs-2">
						<label>Date:</label> <input class="form-control" name="f_date"
							type="date" value="<?php echo $GLOBALS ['xDate']; ?>">
					</div>

					<div class="col-xs-3">
						<label>D.No And Street:</label> <input class="form-control"
							name="f_address_line_1" type="text"
							value="<?php echo $GLOBALS ['xAddressLine1']; ?>">
					</div>

					<div class="col-xs-3">
						<label>Place:</label> <input class="form-control"
							name="f_address_line_2" type="text"
							value="<?php echo $GLOBALS ['xAddressLine2']; ?>">
					</div>

					<div class="col-xs-3">
						<label>Post:</label> <input class="form-control"
							name="f_address_line_3" type="text"
							value="<?php echo $GLOBALS ['xAddressLine3']; ?>">
					</div>

					<div class="col-xs-3">
						<label>Taluk:</label> <input class="form-control"
							name="f_address_line_4" type="text"
							value="<?php echo $GLOBALS ['xAddressLine4']; ?>">
					</div>

					<div class="col-xs-3">
						<label>District:</label> <input class="form-control"
							name="f_address_line_5" type="text"
							value="<?php echo $GLOBALS ['xAddressLine5']; ?>">
					</div>

					<div class="col-xs-2">
						<label>Pin-Code:</label> <input class="form-control"
							name="f_pincode" type="text"
							value="<?php echo $GLOBALS ['xPinCode']; ?>">
					</div>


					<div class="col-xs-2">
						<label>Phone-No:</label> <input class="form-control"
							name="f_phone_no" type="text"
							value="<?php echo $GLOBALS ['xPhoneNo']; ?>">
					</div>
					<div class="col-xs-2">
						<label>Hospital-No:</label> <input class="form-control"
							name="f_hospital_no" type="text"
							value="<?php echo $GLOBALS ['xHospitalNo']; ?>">
					</div>

					<div class="col-xs-2">
						<label>Patient Status:</label> <select class="form-control"
							name="f_patient_status">
							<option value="Alive"
								<?php if($GLOBALS ['xPatientStatus']  == 'Alive') echo 'selected="selected"'; ?>>Alive</option>
							<option value="Dead"
								<?php if($GLOBALS ['xPatientStatus']  == 'Dead') echo 'selected="selected"'; ?>>Dead</option>

						</select>
					</div>

					<div class="col-xs-2">
						<label>LR-No:</label> <input class="form-control" name="f_lr_no"
							type="text" value="<?php echo $GLOBALS ['xLRNo']; ?>"
							onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('BtnSave').click();}};">
					</div>
				</div>

			</div>
			<div class="panel-footer clearfix">
				<div class="pull-right">
<?php if ($GLOBALS ['xMode'] == "") {  ?> 
					<input class="btn btn-primary" name="BtnSave" id="BtnSave"
						onclick="return fn_Validate_Form_Controls()" type="submit"
						value="SAVE"> 
						          <?php } else{ ?><input class="btn btn-primary"
						name="BtnUpdate" onclick="return fn_Validate_Form_Controls()"
						type="submit" value="UPDATE"> <input class="btn btn-primary"
						name="BtnDelete" type="submit" value="DELETE">
           <?php }  ?>
				</div>
			</div>


		</div>

			
	
	</form>
	
</body>
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
</html>

