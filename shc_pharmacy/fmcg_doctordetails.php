<?php
include 'globalfile.php';
IniSetup ();
function IniSetup() {
	fn_DataClear ();
	if (isset ( $_GET ['doctorno'] ) && ! empty ( $_GET ['doctorno'] )) {
		$no = $_GET ['doctorno'];
		if ($_GET ['xmode'] == 'edit') {
			$GLOBALS ['xMode'] = 'F';
			DataFetch ( $_GET ['doctorno'] );
		} else {
			$xQry = "DELETE FROM fmcg_doctor WHERE doctorno= $no";
			mysql_query ( $xQry ) or die ( mysql_error () );
			header ( 'Location: fmcg_doctordetails.php' );
		}
	} else {
		GetMaxIdNo ();
	}
	if (isset ( $_POST ['save'] )) {
		
		DataProcess ( "S" );
	} elseif (isset ( $_POST ['update'] )) {
		DataProcess ( "U" );
	}
}
function fn_DataClear() {
	$GLOBALS ['xDoctorName'] = '';
	$GLOBALS ['xMode'] = '';
	$GLOBALS ['xSpecialist'] = '';
	$GLOBALS ['xStatus'] = '';
	$GLOBALS ['xMobileNo'] = '';
	$GLOBALS ['xAddress'] = '';
	$GLOBALS ['xColor'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(doctorno)IS NULL OR max(doctorno)= '' 
       THEN '1' 
       ELSE max(doctorno)+1 END AS doctorno
FROM fmcg_doctor";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xtxno'] = $row ['doctorno'];
	}
}
function DataFetch($xtxno) {
	$result = mysql_query ( "SELECT *  FROM fmcg_doctor where doctorno=$xtxno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xtxno'] = $row ['doctorno'];
			$GLOBALS ['xDoctorName'] = $row ['doctorname'];
			$GLOBALS ['xSpecialist'] = $row ['specialist'];
			$GLOBALS ['xStatus'] = $row ['status'];
			$GLOBALS ['xMobileNo'] = $row ['mobileno'];
			$GLOBALS ['xAddress'] = $row ['address'];
			$GLOBALS ['xColor'] = $row ['color'];
		}
	}
}
function DataProcess($mode) {
	$xTxNo = $_POST ['f_txno'];
	$xDoctorName =  $_POST ['f_doctorname'] ;
	$xSpecialist = $_POST ['f_specialist'] ;
	$xStatus = strtoupper ( $_POST ['f_status'] );
	if (empty ( $_POST ['f_mobileno'] )) {
		$xMobileNo = 0;
	} else {
		$xMobileNo = strtoupper ( $_POST ['f_mobileno'] );
	}
	$xAddress = strtoupper ( $_POST ['f_address'] );
	$xColor = $_POST ['f_color'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO fmcg_doctor  VALUES ($xTxNo,'$xDoctorName','$xSpecialist','$xStatus',$xMobileNo,'$xAddress','$xColor')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE fmcg_doctor   SET doctorname='$xDoctorName',specialist='$xSpecialist',status='$xStatus',mobileno='$xMobileNo',address='$xAddress' ,color='$xColor' WHERE doctorno=$xTxNo";
		$xMsg = "Updated";
	} elseif ($mode == 'D') {
		$xQry = "DELETE FROM fmcg_doctor   WHERE doctorno=$xTxNo";
		$xMsg = "Deleted";
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	GetMaxIdNo ();
	//ShowAlert ( $xMsg );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>M-DOCTOR</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 var xDoctorName= document.forms["doctorform"]["f_doctorname"].value;
 if (xDoctorName== null || xDoctorName== "") 
    {
        alert("Doctor-Name must be filled out");
        document.doctorform.f_doctorname.focus();
        return false;
    }
}


</script>

<body background="images/bg.jpg"
	onload='document.doctorform.f_doctorname.focus()'>
	<form class="form" name="doctorform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success" data-bind="nextFieldOnEnter:true">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MASTER - DOCTOR DATA ENTRY</h3>
			</div>
			<div class="panel-body">
				<div class="form-group" style="display: none;">
					<label class="control-label col-xs-3"> NO</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" id="f_txno" name="f_txno"
							value="<?php echo $GLOBALS ['xtxno']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-3">
						<label>Doctor Name:</label> <input type="text"
							class="form-control" name="f_doctorname"
							value="<?php echo $GLOBALS ['xDoctorName']; ?>"
							
							maxlength="50">
					</div>

					<div class="col-xs-3">
						<label>Specialist:</label> <input type="text" class="form-control"
							name="f_specialist"
							value="<?php echo $GLOBALS ['xSpecialist']; ?>"
							onkeypress="return restrictCharacters(this, event, alphaOnly);"
							maxlength="50">
					</div>


					<div class="col-xs-2">
						<label>Status[DOCTOR]:</label> <select class="form-control" id=""
							name="f_status">
							<option value="VISITING"
								<?php if($GLOBALS ['xStatus']=="VISITING") echo 'selected="selected"'; ?>>VISITING
							</option>
							<option value="FAMILY"
								<?php if( $GLOBALS ['xStatus']=="FAMILY") echo 'selected="selected"'; ?>>FAMILY</option>
						</select>
					</div>

					<div class="col-xs-3">
						<label>Mobile No:</label> <input type="text" class="form-control"
							name="f_mobileno" value="<?php echo $GLOBALS ['xMobileNo']; ?>"
							onkeypress="return restrictCharacters(this, event, integerOnly);"
							maxlength="10">
					</div>

					<div class="col-xs-4" style="text-align: left;">
						<label>Address </label>
						<textarea class="form-control" rows="3" cols="15" name="f_address"
							style="float: right"><?php echo $GLOBALS ['xAddress']; ?></textarea>
					</div>

					<div class="col-xs-1">
						<label>Color:</label> <input type="color" class="form-control"
							name="f_color" value="<?php echo $GLOBALS ['xColor']; ?>"
							onkeydown="if (event.keyCode == 13) document.getElementById('save').click()" />
					</div>
					<br></br> <br></br> <br></br> <br></br> <br></br>
					<div class="panel-footer clearfix">
						<div class="pull-right">
               <?php if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit" name="save" class="btn btn-primary"
								value="SAVE" id="save" onclick="return validateForm()"> 
        <?php } else{ ?>
               <input type="submit" name="update"
								class="btn btn-primary" value="UPDATE"
								onclick="return validateForm()"> 
        <?php }  ?>
        </div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">VIEW DOCTORS</h3>
				</div>
				<table class="table table-striped  table-bordered ">  
<?php
$xQry = "SELECT *  from fmcg_doctor where doctorno!=0 order by doctorname;";
$result2 = mysql_query ( $xQry );
if (mysql_num_rows ( $result2 ) > 0) {
	?>

<thead>
						<tr>
							<th>DOCTOR NAME</th>
							<th>SPECIALIST</th>
							<th>MOBILE NO</th>
							<th>ADDRESS</th>
							<th colspan="2">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
<?php
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		echo '<td >' . $row ['doctorname'] . '</td>';
		echo '<td >' . $row ['specialist'] . '</td>';
		echo '<td >' . $row ['mobileno'] . '</td>';
		echo '<td >' . $row ['address'] . '</td>';
		//if ($login_session == "admin") {
			?>
<td width="5%"><a
								href="fmcg_doctordetails.php<?php echo '?doctorno='.$row['doctorno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0"></a></td>
							<td width="5%"><a
								href="fmcg_doctordetails.php<?php echo '?doctorno='.$row['doctorno']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0"></a></td>
<?php
		//}
		echo '</tr>';
}
} else {
	fn_NoDataFound ();
}

?>	

					
					
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>

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
</body>

</html>