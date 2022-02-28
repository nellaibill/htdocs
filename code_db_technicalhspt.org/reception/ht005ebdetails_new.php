
	<?php
	include 'globalfile.php';
	$GLOBALS ['xMode'] = '';
	if (isset ( $_GET ['txno'] ) && ! empty ( $_GET ['txno'] )) {
		$no = $_GET ['txno'];
		if ($_GET ['xmode'] == 'edit') {
			DataFetch ( $_GET ['txno'] );
		} else {
			$xQry = "DELETE FROM t_ebdetails_new WHERE txno= $no";
			mysql_query ( $xQry );
			header ( 'Location: hr008ebdetails_new.php' );
		}
	} else {
		GetMaxIdNo ();
		$GLOBALS ['xStockPointNo'] = '';
	}
	// $GLOBALS ['xCurrentDate']=date('Y-m-d');
	// $GLOBALS ['xTime']=date('H:i:s');
	
	if (isset ( $_POST ['save'] )) {
		
		DataProcess ( "S" );
	} elseif (isset ( $_POST ['update'] )) {
		DataProcess ( "U" );
	}
	function GetMaxIdNo() {
		$sql = "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
	       THEN '1' 
	       ELSE max(txno)+1 END AS txno
	FROM t_ebdetails_new";
		$result = mysql_query ( $sql ) or die ( mysql_error () );
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xTxNo'] = $row ['txno'];
		}
	}
	function DataFetch($xTxNo) {
		$GLOBALS ['xMode'] = 'F';
		$result = mysql_query ( "SELECT *  FROM t_ebdetails_new where txno=$xTxNo" ) or die ( mysql_error () );
		$count = mysql_num_rows ( $result );
		if ($count > 0) {
			while ( $row = mysql_fetch_array ( $result ) ) {
				
				$GLOBALS ['xTxNo'] = $row ['txno'];
				$GLOBALS ['xEbNo'] = $row ['ebno'];
				findebname ( $row ['ebno'] );
				$GLOBALS ['xDate'] = $row ['date'];
				$GLOBALS ['xTime'] = $row ['time'];
				$GLOBALS ['xOldReading'] = $row ['oldreading'];
				$GLOBALS ['xNewReading'] = $row ['newreading'];
				$GLOBALS ['xNewBorn'] = $row ['newborn'];
				$GLOBALS ['xCompressor'] = $row ['compressor'];
				$GLOBALS ['xSecurity'] = $row ['security'];
				$GLOBALS ['xMotorRoom'] = $row ['motorroom'];
				
				$GLOBALS ['xNbOne'] = $row ['nbone'];
				$GLOBALS ['xNbOneAc'] = $row ['nboneac'];
				$GLOBALS ['xNbTwoAc'] = $row ['nbtwoac'];
				$GLOBALS ['xNbTwoNonAc'] = $row ['nbtwononac'];
				$GLOBALS ['xLab'] = $row ['lab'];
				$GLOBALS ['xLwIn'] = $row ['lwin'];
				$GLOBALS ['xLwOut'] = $row ['lwout'];
				$GLOBALS ['xDrainageMotor'] = $row ['drainage_motor'];
				$GLOBALS ['xXrayMachine']= $row ['xray_machine'];
				$GLOBALS ['xPow'] = $row ['pow'];
				$GLOBALS ['xLift'] = $row ['lift'];
				$GLOBALS ['xHeater'] = $row ['heater'];
						
						
				
				$GLOBALS ['xOpAc'] = $row ['opac'];
				$GLOBALS ['xOpNonAc'] = $row ['opnonac'];
				
				$GLOBALS ['xWard'] = $row ['ward'];
				$GLOBALS ['xMotor'] = $row ['motor'];
				
				$GLOBALS ['xWardGroundFloor'] = $row ['wardgroundfloor'];
				$GLOBALS ['xWardFirstFloor'] = $row ['wardfirstfloor'];
				$GLOBALS ['xWardSecondFloor'] = $row ['wardsecondfloor'];
				
				$GLOBALS ['xRs'] = $row ['rs'];
				$GLOBALS ['xStaff'] = $row ['staff'];
				$GLOBALS ['xPharmacy'] = $row ['pharmacy'];
				
				$GLOBALS ['xOtAc'] = $row ['otac'];
				$GLOBALS ['xOtInst'] = $row ['otinst'];
				$GLOBALS ['xOtLight'] = $row ['otlight'];
				$GLOBALS ['xAutoClave'] = $row ['autoclave'];
				$GLOBALS ['xTopFloor'] = $row ['topfloor'];
			}
		}
	}
	function DataProcess($mode) {
		$xTxNo = $_POST ['f_txno'];
		$xCurrentDateTime = date ( 'Y-m-d H:i:s' );
		if (empty ( $_POST ['f_ebno'] )) {
			$xEbNo = $GLOBALS ['xEbNo'];
		} else {
			$xEbNo = $_POST ['f_ebno'];
		}
		
		$xDate = $_POST ['f_date'];
		$xTime = $_POST ['f_time'];
		$xOldReading = $_POST ['f_oldreading'];
		$xNewReading = $_POST ['f_newreading'];
		$xConsumption = doubleval ( $_POST ['f_newreading'] ) - doubleval ( $_POST ['f_oldreading'] );
		if (empty ( $_POST ['f_newborn'] )) {
			$xNewBorn = 0;
		} else {
			$xNewBorn = $_POST ['f_newborn'];
		}
		if (empty ( $_POST ['f_compressor'] )) {
			$xCompressor = 0;
		} else {
			$xCompressor = $_POST ['f_compressor'];
		}
		if (empty ( $_POST ['f_security'] )) {
			$xSecurity = 0;
		} else {
			$xSecurity = $_POST ['f_security'];
		}
		
		if (empty ( $_POST ['f_motorroom'] )) {
			$xMotorRoom = 0;
		} else {
			$xMotorRoom = $_POST ['f_motorroom'];
		}
		if (empty ( $_POST ['f_nbone'] )) {
			$xNbOne = 0;
		} else {
			$xNbOne = $_POST ['f_nbone'];
		}
		
		if (empty ( $_POST ['f_nboneac'] )) {
			$xNbOneAc = 0;
		} else {
			$xNbOneAc = $_POST ['f_nboneac'];
		}
		
		if (empty ( $_POST ['f_nbtwoac'] )) {
			$xNbTwoAc = 0;
		} else {
			$xNbTwoAc = $_POST ['f_nbtwoac'];
		}
		
		if (empty ( $_POST ['f_nbtwononac'] )) {
			$xNbTwoNonAc = 0;
		} else {
			$xNbTwoNonAc = $_POST ['f_nbtwononac'];
		}
		
		if (empty ( $_POST ['f_lab'] )) {
			$xLab = 0;
		} else {
			$xLab = $_POST ['f_lab'];
		}
		
		if (empty ( $_POST ['f_lwin'] )) {
			$xLwIn = 0;
		} else {
			$xLwIn = $_POST ['f_lwin'];
		}
		
				if (empty ( $_POST ['f_lwout'] )) {
			$xLwOut = 0;
		} else {
			$xLwOut = $_POST ['f_lwout'];
		}
		
		
		if (empty ( $_POST ['f_drainage_motor'] )) {
			$xDrainageMotor = 0;
		} else {
			$xDrainageMotor = $_POST ['f_drainage_motor'];
		}
		
		if (empty ( $_POST ['f_xray_machine'] )) {
			$xXrayMachine = 0;
		} else {
			$xXrayMachine = $_POST ['f_xray_machine'];
		}
		
		
		
		
		
		if (empty ( $_POST ['f_pow'] )) {
			$xPow = 0;
		} else {
			$xPow = $_POST ['f_pow'];
		}
		
			if (empty ( $_POST ['f_lift'] )) {
			$xLift = 0;
		} else {
			$xLift = $_POST ['f_lift'];
		}
			if (empty ( $_POST ['f_heater'] )) {
			$xHeater = 0;
		} else {
			$xHeater = $_POST ['f_heater'];
		}
		
		//op details
		
		if (empty ( $_POST ['f_opac'] )) {
			$xOpAc = 0;
		} else {
			$xOpAc = $_POST ['f_opac'];
		}
		if (empty ( $_POST ['f_opnonac'] )) {
			$xOpNonAc = 0;
		} else {
			$xOpNonAc = $_POST ['f_opnonac'];
		}
		
		if (empty ( $_POST ['f_ward'] )) {
			$xWard = 0;
		} else {
			$xWard = $_POST ['f_ward'];
		}
		
		if (empty ( $_POST ['f_motor'] )) {
			$xMotor = 0;
		} else {
			$xMotor = $_POST ['f_motor'];
		}
		
		if (empty ( $_POST ['f_rs'] )) {
			$xRs = 0;
		} else {
			$xRs = $_POST ['f_rs'];
		}
		
		if (empty ( $_POST ['f_staff'] )) {
			$xStaff = 0;
		} else {
			$xStaff = $_POST ['f_staff'];
		}
		
		
		if (empty ( $_POST ['f_wardgroundfloor'] )) {
			$xWardGroundFloor = 0;
		} else {
			$xWardGroundFloor = $_POST ['f_wardgroundfloor'];
		}
		
		if (empty ( $_POST ['f_wardfirstfloor'] )) {
			$xWardFirstFloor = 0;
		} else {
			$xWardFirstFloor = $_POST ['f_wardfirstfloor'];
		}
		
		if (empty ( $_POST ['f_wardsecondfloor'] )) {
			$xWardSecondFloor = 0;
		} else {
			$xWardSecondFloor = $_POST ['f_wardsecondfloor'];
		}
		
		if (empty ( $_POST ['f_pharmacy'] )) {
			$xPharmacy = 0;
		} else {
			$xPharmacy = $_POST ['f_pharmacy'];
		}
		
			if (empty ( $_POST ['f_otac'] )) {
			$xOtAc = 0;
		} else {
			$xOtAc = $_POST ['f_otac'];
		}
		
			if (empty ( $_POST ['f_otinst'] )) {
			$xOtInst = 0;
		} else {
			$xOtInst = $_POST ['f_otinst'];
		}
		
			if (empty ( $_POST ['f_otlight'] )) {
			$xOtLight = 0;
		} else {
			$xOtLight = $_POST ['f_otlight'];
		}
		
			if (empty ( $_POST ['f_autoclave'] )) {
			$xAutoClave = 0;
		} else {
			$xAutoClave = $_POST ['f_autoclave'];
		}
		
			if (empty ( $_POST ['f_topfloor'] )) {
			$xTopFloor = 0;
		} else {
			$xTopFloor = $_POST ['f_topfloor'];
		}
		
		
		
		$xQry = "";
		$xMsg = "";
		if ($mode == 'S') {
			$xQry = "INSERT INTO t_ebdetails_new VALUES                 
	           ($xTxNo,$xEbNo,'$xDate','$xTime','$xOldReading',
	           '$xNewReading','$xConsumption','$xCurrentDateTime','$xCurrentDateTime',
			   $xNewBorn,$xCompressor,
			$xSecurity,$xMotorRoom,$xNbOne,$xNbOneAc,
			$xNbTwoAc,$xNbTwoNonAc,$xLab,$xLwIn,$xLwOut,
			$xDrainageMotor,$xXrayMachine,
			$xPow,$xLift,$xHeater,
			$xOpAc,$xOpNonAc,$xWard,$xMotor,$xWardGroundFloor,
			$xWardFirstFloor,$xWardSecondFloor,$xRs,$xStaff,$xPharmacy,$xOtAc,$xOtInst,$xOtLight,$xAutoClave,$xTopFloor)";
			
			// echo $xQry;
			$xQryUpdated = "update m_eb set currentreading='$xNewReading' 
			where txno=$xEbNo";
			$retval1 = mysql_query ( $xQryUpdated ) or die ( mysql_error () );
			$xMsg = "Inserted";
		} elseif ($mode == 'U') {
			
			$xQry = "UPDATE t_ebdetails_new SET date='$xDate',
			time='$xTime',oldreading='$xOldReading',newreading='$xNewReading',
	consumption='$xConsumption',newborn=$xNewBorn,compressor=$xCompressor,
	security=$xSecurity,motorroom=$xMotorRoom,
	nbone=$xNbOne,nboneac=$xNbOneAc,nbtwoac=$xNbTwoAc,
	nbtwononac=$xNbTwoNonAc,lab=$xLab,
	lwin=$xLwIn,lwout=$xLwOut,
	drainage_motor=$xDrainageMotor,
	xray_machine=$xXrayMachine,
	pow=$xPow,lift=$xLift,heater=$xHeater,
	opac=$xOpAc,opnonac=$xOpNonAc,
	ward=$xWard,motor=$xMotor,
	rs=$xRs,staff=$xStaff,wardgroundfloor=$xWardGroundFloor,wardfirstfloor=$xWardFirstFloor,
			wardsecondfloor=$xWardSecondFloor,pharmacy=$xPharmacy,otac=$xOtAc,otinst=$xOtInst,otlight=$xOtLight,autoclave=$xAutoClave,topfloor=$xTopFloor,
			updatedason='$xCurrentDateTime' WHERE txno=$xTxNo";
			$xMsg = "Updated";
			$xQryUpdated = "update m_eb set currentreading='$xNewReading' where txno=$xEbNo";
			// echo $xQryUpdated;
			$retval1 = mysql_query ( $xQryUpdated ) or die ( mysql_error () );
			// header('Location: hr008ebdetails_new.php');
		} elseif ($mode == 'D') {
			$xQry = "DELETE FROM t_ebdetails_new WHERE txno=$xTxNo";
			$xMsg = "Deleted";
		}
		// echo $xQry;
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
		GetMaxIdNo ();
		ShowAlert ( $xMsg );
	}
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>EB-ENTRY[NEW]</title>
	</head>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<Script> 
	
	 function isNumberKey(evt)
	      {
	         var charCode = (evt.which) ? evt.which : event.keyCode
	         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
	            return false;
	
	         return true;
	      }
	
	 $(function() {
	        $('#ebno').change(function(){
	            $('.eb').hide();
	            $('#' + $(this).val()).show();
	        });
	    });
	
	
	function validateForm()
	 {
	var xDate= document.forms["ebentryform"]["f_date"].value;
	var xTime= document.forms["ebentryform"]["f_time"].value;
	var xOldReading= document.forms["ebentryform"]["f_oldreading"].value;
	var xNewReading= document.forms["ebentryform"]["f_newreading"].value;
	
	 if (xDate== null || xDate== "") {
	        alert("Date must be filled out");
	document.ebentryform.f_date.focus();
	        return false;
	    }
	 
	 if (xTime== null || xTime== "") {
	        alert("Time must be filled out");
	document.ebentryform.f_time.focus();
	        return false;
	    }  
	
	 if (xOldReading== null || xOldReading== "") {
	        alert("OldReading must be filled out-Choose an EB");
	document.ebentryform.f_ebno.focus();
	        return false;
	    }  
	
	 if (xNewReading== null || xNewReading== "") {
	        alert("NewReading must be filled out");
	document.ebentryform.f_newreading.focus();
	        return false;
	    } 
	}
	function FindCurrentReading(str) {
	var xEbNo=document.getElementById("ebno").value;
	var xMode = <?php echo json_encode($GLOBALS ['xMode']); ?>;
	if(xMode=='F')
	{
	var strconfirm = confirm("Could Not Change ");
	if (strconfirm == true)
	            {
	                return false;
	            }
	}
	else
	{
	
	  if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    document.getElementById('oldreading').value=xmlhttp.responseText;
	    }
	  }
	  xmlhttp.open("GET","findcurrentreading.php?ebno="+xEbNo, true);
	  xmlhttp.send();
	}
	}
	
	</Script>
	<body onload='document.ebentryform.f_stockpointno.focus()'>
	
	
	
	
		<div>
			<h3 id="headertext">EB-ENTRY(NEW)</h3>
			<form class="form" name="ebentryform"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="submit" name="save" class="btn btn-primary" value="SAVE"
					id="save" onclick="return validateForm()"> <input type="submit"
					name="update" class="btn btn-primary" value="UPDATE"
					onclick="return validateForm()"> </br>
	
				<div class="form-group" style="display: none">
	
					<label class="control-label col-xs-2">TX NO</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" name="f_txno"
							value="<?php echo $GLOBALS ['xTxNo']; ?>" placeholder="" readonly>
					</div>
	
				</div>
				<div class="form-group">
					<label for="lbltxno" class="control-label col-xs-2">CHOOSE EB</label>
					<div class="col-xs-4">
						<select class="form-control" name="f_ebno" id="ebno"
							onclick="FindCurrentReading()">
	            <?php
													$result = mysql_query ( "SELECT *  FROM m_eb" );
													echo "<option value=''>Select Your Option</option>";
													while ( $row = mysql_fetch_array ( $result ) ) {
														?>
	
	
	
	           <option value="<?php echo $row['txno']; ?>"
								<?php
														if ($row ['ebname'] == $GLOBALS ['xEbName']) {
															// echo 'selected="selected"';
														}
														?>>
	            <?php echo $row['ebname']; ?> 
	            </option>
	
	             <?
													}
													
													?>
	             </select>
					</div>
				</div>
				<br> <br>
	
	
				<div class="form-group">
					<label class="control-label col-xs-2">DATE AND TIME</label>
					<div class="col-xs-2">
	<?php
	if ($login_session == "admin") {
		?>
	<input type="date" class="form-control" id="xdate" name="f_date"
							value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="">
	<?php
	} else {
		?>
	<input type="date" class="form-control" id="xdate" name="f_date"
							readonly value="<?php echo $GLOBALS ['xCurrentDate']; ?>"
							placeholder="">
	<?php
	}
	?>
	        	        </div>
					<div class="col-xs-2">
						<input type="time" class="form-control" name="f_time"
							value="<?php echo $GLOBALS ['xTime']; ?>">
					</div>
				</div>
				<br> <br>
	
	
				<div class="form-group">
					<label class="control-label col-xs-2">READING</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" id="oldreading"
							name="f_oldreading"
							value="<?php echo $GLOBALS ['xOldReading']; ?>" readonly>
					</div>
					<div class="col-xs-2">
						<input type="text" class="form-control" id="newreading"
							name="f_newreading"
							value="<?php echo $GLOBALS ['xNewReading']; ?>"
							onkeypress="return isNumberKey(event)">
					</div>
	
				</div>
				<br> <br>
	
	
				<div id="1" class="eb">
					<fieldset>
						<legend>TKM- BUILDING</legend>
						<label class="control-label col-xs-2">NewBorn AND Compressor</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_newborn"
								value="<?php echo $GLOBALS ['xNewBorn']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_compressor"
								value="<?php echo $GLOBALS ['xCompressor']; ?>" placeholder=""
								onkeypress="return isNumberKey(event)">
						</div>
						<br> <br> <br> <label class="control-label col-xs-2">Security AND
							Motor Room</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_security"
								value="<?php echo $GLOBALS ['xSecurity']; ?>" placeholder=""
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_motorroom"
								value="<?php echo $GLOBALS ['xMotorRoom']; ?>" placeholder=""
								onkeypress="return isNumberKey(event)">
						</div>
						<br> <br> <br> <label class="control-label col-xs-2">N.B I NONAC
							AND N.B1 AC </label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_nbone"
								value="<?php echo $GLOBALS ['xNbOne']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_nboneac"
								value="<?php echo $GLOBALS ['xNbOneAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<br> <br> <label class="control-label col-xs-2">N.B 2 NONAC AND
							N.B2 AC AND LAB</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_nbtwononac"
								value="<?php echo $GLOBALS ['xNbTwoNonAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_nbtwoac"
								value="<?php echo $GLOBALS ['xNbTwoAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_lab"
								value="<?php echo $GLOBALS ['xLab']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
						<br> <br> <br> <br> <label class="control-label col-xs-2">L.W(IN)
							AND POW</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_lwin"
								value="<?php echo $GLOBALS ['xLwIn']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_pow"
								value="<?php echo $GLOBALS ['xPow']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
				<br> <br> <br> <br> <label class="control-label col-xs-2">L.W(OUT),LIFT,HEATER
							</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_lwout"
								value="<?php echo $GLOBALS ['xLwOut']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
				
							<div class="col-xs-2">
							<input type="text" class="form-control" name="f_lift"
								value="<?php echo $GLOBALS ['xLift']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
				
							<div class="col-xs-2">
							<input type="text" class="form-control" name="f_heater"
								value="<?php echo $GLOBALS ['xHeater']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
							<br> <br> <br> <br> <label class="control-label col-xs-2">DRAINAGE MOTOR
							</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_drainage_motor"
								value="<?php echo $GLOBALS ['xDrainageMotor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
				 <br> <br> <label class="control-label col-xs-2">XRAY MACHINE
							</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_xray_machine"
								value="<?php echo $GLOBALS ['xXrayMachine']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
					</fieldset>
					<br> <br>
				</div>
				<div id="2" class="eb">
					<fieldset>
						<legend>O-P BUILDING</legend>
	
	
						<label class="control-label col-xs-2">OP AC AND OP NONAC</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_opac"
								value="<?php echo $GLOBALS ['xOpAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_opnonac"
								value="<?php echo $GLOBALS ['xOpNonAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
						<br> <br> <label class="control-label col-xs-2">WARD AND
							MOTOR</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_ward"
								value="<?php echo $GLOBALS ['xWard']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_motor"
								value="<?php echo $GLOBALS ['xMotor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
						<br> <br> <br> <br> <label class="control-label col-xs-2">WG,WF,WS</label>
							
									<div class="col-xs-2">
							<input type="text" class="form-control" name="f_wardgroundfloor"
								value="<?php echo $GLOBALS ['xWardGroundFloor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_wardfirstfloor"
								value="<?php echo $GLOBALS ['xWardFirstFloor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_wardsecondfloor"
								value="<?php echo $GLOBALS ['xWardSecondFloor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
						<br> <br> <br> <br> <label class="control-label col-xs-2">RS
							ANDSTAFF</label>
	
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_rs"
								value="<?php echo $GLOBALS ['xRs']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-xs-2">
							<input type="text" class="form-control" name="f_staff"
								value="<?php echo $GLOBALS ['xStaff']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
	
	
						<br> <br>
	
<label class="control-label col-xs-2">PHARMACY</label>
						<div class="col-xs-2">
						
		
     
							<input type="text" class="form-control" name="f_pharmacy"
								value="<?php echo $GLOBALS ['xPharmacy']; ?>"
								onkeypress="return isNumberKey(event)">
						</div><br><br>

	<label class="control-label col-xs-2">OT AC,INST,LIGHT</label>
						<div class="col-xs-2">
						<input type="text" class="form-control" name="f_otac"
								value="<?php echo $GLOBALS ['xOtAc']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
							<div class="col-xs-2">
						<input type="text" class="form-control" name="f_otinst"
								value="<?php echo $GLOBALS ['xOtInst']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
							<div class="col-xs-2">
						<input type="text" class="form-control" name="f_otlight"
								value="<?php echo $GLOBALS ['xOtLight']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						<br><br><br><br>
						
							<label class="control-label col-xs-2">AUTOCLAVE,TOPFLOOR</label>
						<div class="col-xs-2">
						<input type="text" class="form-control" name="f_autoclave"
								value="<?php echo $GLOBALS ['xAutoClave']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
							<div class="col-xs-2">
						<input type="text" class="form-control" name="f_topfloor"
								value="<?php echo $GLOBALS ['xTopFloor']; ?>"
								onkeypress="return isNumberKey(event)">
						</div>
						
				
						<br><br>
					</fieldset>
				</div>
	
	
			</form>
		</div>
	
	
	
	</body>
	</html>