<?php
include ('globalfile.php');
if ($login_session == "admin") {
	$xFromDate = $GLOBALS ['xFromDate'];
	$xToDate = $GLOBALS ['xToDate'];
} else {
	$xFromDate = $GLOBALS ['xCurrentDate'];
	$xToDate = $GLOBALS ['xCurrentDate'];
}
$xEbNo = $GLOBALS ['xEbNo'];
$xTotalConsumes = 0;
$xTotalLabUnits = 0;
$xRsUnits = 0; /* Mark Saleem 02/November/2015 Srinivasan Sir - */
?>
<html>
<title>V-EB</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
<style>
hr {
	display: block;
	margin-top: 0.5em;
	margin-bottom: 0.5em;
	margin-left: auto;
	margin-right: auto;
	border-style: inset;
	border-width: 3px;
}
</style>
</head>

<body>
	<hr>
	<p>
		<!--  <b>NB-NEW BORN,C-COMPRESSOR,S-SECURITY,M-MOTOR ROOM,NB1-NEW BULILDING
			IST FLOOR,NB2A-NEW BUILDING 2ND FLOOR AC, NB2NA-NEW BUILDING 2ND
			FLOOR NONAC,L-LAB</b>!-->
	</p>
	<hr>
	<div id="divToPrint">
		</br> </br> </br>
		<div class="container">
<?php

ReportHeader ( "EB" );

if (isset ( $_GET ['xmode'] )) {
	$xFromDate = $GLOBALS ['xCurrentDate'];
	$xToDate = $GLOBALS ['xCurrentDate'];
	$xEbNo = $GLOBALS ['ebno'];
}
?>
<table class="table table-hover" border="1" id="lastrow">
				<thead>
					<tr>

						<th width="10%">DATE</th>
						<th>EB</th>
						<th>TIME</th>
						<th>READING</th>
						<th>CONSUMES</th>


<?
if ($xEbNo == 0 || $xEbNo == 1) {
	?>
                        <th>LWOUT</th>
						<th>C</th>
						<th>S</th>
						<th>M</th>
						<th>NB1</th>
						<th>NB1A</th>
						<th>NB2A</th>
						<th>NB2NA</th>
						<th>L</th>
						<th>LWIN</th>
						<th>NB</th>
						<th>DM</th>
						<th>XRAY</th>
						<th>POW</th>
								<th>LIFT</th>
								<th>HEATER</th>
     
<?
}
if ($xEbNo == 0 || $xEbNo == 2) {
	?>
      	<th>OPAC</th>
						<th>OPNONAC</th>
						<th>WARD</th>
						<th>MOTOR</th>
						<th>W.G</th>
						<th>W.F</th>
						<th>W.S</th>
						<th>RS</th>
						<th>STAFF</th>
						<th>OUTER LIFT</th>
						<th>OTAC</th>
						<th>INST</th>
						<th>LIGHT</th>
						<th>AU.C</th>
						<th>T.FL</th>
						


<?
}
if ($login_session == "admin") {
	?>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th>
							CREATEDASON</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th>
							UPDATEDASON</th> <? } ?>
   
<?
}
?>
 <th  width="10%">TOTAL</th>
           <th colspan="2" width="10%">ACTIONS
						
						</td>
					</tr>
				</thead>


				<tfoot>
					<tr>

						<th width="10%">DATE</th>
						<th>EB</th>
						<th>TIME</th>
						<th>READING</th>
						<th>CONSUMES</th>
<?
if ($xEbNo == 0 || $xEbNo == 1) {
	?>

           <th>LWOUT</th>
						<th>C</th>
						<th>S</th>
						<th>M</th>
						<th>NB1</th>
						<th>NB1A</th>
						<th>NB2A</th>
						<th>NB2NA</th>
						<th>L</th>
						<th>LWIN</th>
						<th>NB</th>
						<th>DM</th>
						<th>XRAY</th>
						<th>POW</th>
							<th>LIFT</th>
								<th>HEATER</th>
     

<?
}
if ($xEbNo == 0 || $xEbNo == 2) {
	?>
	<th>OPAC</th>
											<th>OPNONAC</th>
						<th>WARD</th>
						<th>MOTOR</th>
						<th>W.G</th>
						<th>W.F</th>
												<th>W.S</th>
						<th>RS</th>
						<th>STAFF</th>
							<th>OUTER LIFT</th>
		<th>OTAC</th>
						<th>INST</th>
						<th>LIGHT</th>
						<th>AU.C</th>
						<th>T.FL</th>
         
<?
}
if ($login_session == "admin") {
	?>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th>
							CREATEDASON</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th>
							UPDATEDASON</th> <? } ?>
   
<?
}
?>
   <th  width="10%">TOTAL</th>
           <th colspan="2" width="10%">ACTIONS</th>
						
						</td>
					</tr>
				</tfoot>

				<tbody>

<?php
$xQryFilter = '';
$xGrandConsumes = 0;
$xGrandNewBorn = 0;
$xGrandCompressor = 0;
$xGrandSecurity = 0;
$xGrandMotorRoom = 0;
$xGrandNbOne = 0;
$xGrandNbOneAc = 0;
$xGrandNbTwoAc = 0;
$xGrandNbNonAc = 0;
$xGrandLab = 0;
$xGrandLWin = 0;
$xGrandLWOut = 0;
$xGrandDrainageMotor=0;
$xGrandXrayMachine=0;
$xGrandPow = 0;

		$xGrandLift = 0;
		$xGrandHeater = 0;
		
$xGrandOpAc = 0;
$xGrandOpNonAc = 0;
$xGrandWard = 0;
$xGrandMotor = 0;

$xGrandWardGroundFloor = 0;
$xGrandWardFirstFloor = 0;
$xGrandWardSecondtFloor = 0;

$xGrandRs = 0;
$xGrandStaff = 0;

$xGrandPharmacy = 0;

$xGrandOtAc = 0;
$xGrandOtInst = 0;
$xGrandOtLight = 0;
$xGrandAutoClave = 0;
$xGrandTopFloor = 0;


if ($xEbNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and ebno=$xEbNo";
}
$xQry = "SELECT *  from t_ebdetails_new where date>='$xFromDate' and date<='$xToDate'";
$xQry .= $xQryFilter . ' ' . " order by date,txno ;";
// echo $xQry;
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	echo '<td>' . date ( 'd-M-Y', strtotime ( $row ['date'] ) ) . '</td>';
	findebname ( $row ['ebno'] );
	echo '<td>' . $GLOBALS ['xEbShortName'] . '</td>';
	echo '<td>' . strftime ( '%I:%M %p', strtotime ( $row ['time'] ) ) . '</td>';
	echo '<td>' . $row ['newreading'] . '</td>';
	echo '<td>' . round ( $row ['consumption'] ) . '</td>';
	$xGrandConsumes += $row ['consumption'];
	
	if ($xEbNo == 0 || $xEbNo == 1) {
	    	    $xTkmTotal=0;
	    	    
		echo '<td bgcolor=#888888>' . $row ['lwout'] . '</td>';
		echo '<td bgcolor=#888888>' . $row ['compressor'] . '</td>';
		echo '<td bgcolor=#888888>' . $row ['security'] . '</td>';
		echo '<td bgcolor=#888888>' . $row ['motorroom'] . '</td>';
		echo '<td bgcolor=#888888>' . $row ['nbone'] . '</td>';
		echo '<td bgcolor=#888888>' . $row ['nboneac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['nbtwoac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['nbtwononac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['lab'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['lwin'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['newborn'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['drainage_motor'] . '</td>';
	    echo '<td bgcolor=#888888 >' . $row ['xray_machine'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['pow'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['lift'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['heater'] . '</td>';
		
			    $xTkmTotal=0;
			    
			    
			    		$xTkmTotal=$row ['newborn']+$row ['compressor'] +$row ['security']+
		$row ['motorroom']+$row ['nbone']+$row ['nboneac']+$row ['nbtwoac']+
		$row ['nbtwononac']+$row ['lab']+$row ['lwin']+$row ['lwout']+$row ['pow']+$row ['lift']+$row ['heater']+$row ['drainage_motor']+$row ['xray_machine'];
		 
		 
				echo '<td bgcolor=#888888 >'.$xTkmTotal.'</td>';
		$xGrandNewBorn += $row ['newborn'];
		$xGrandCompressor += $row ['compressor'];
		$xGrandSecurity += $row ['security'];
		$xGrandMotorRoom += $row ['motorroom'];
		$xGrandNbOne += $row ['nbone'];
		$xGrandNbOneAc += $row ['nboneac'];
		$xGrandNbTwoAc += $row ['nbtwoac'];
		$xGrandNbNonAc += $row ['nbtwononac'];
		$xGrandLab += $row ['lab'];
		$xGrandLWin += $row ['lwin'];
		$xGrandLWOut += $row ['lwout'];
		$xGrandDrainageMotor += $row ['drainage_motor'];
		$xGrandXrayMachine+=$row ['xray_machine'];
		$xGrandPow += $row ['pow'];
		$xGrandLift += $row ['lift'];
		$xGrandHeater += $row ['heater'];
	}
	
	if ($xEbNo == 0 || $xEbNo == 2) {
	    $xOpTotal=0;
		echo '<td bgcolor=#888888 >' . $row ['opac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['opnonac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['ward'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['motor'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['wardgroundfloor'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['wardfirstfloor'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['wardsecondfloor'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['rs'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['staff'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['pharmacy'] . '</td>';
		
		echo '<td bgcolor=#888888 >' . $row ['otac'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['otinst'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['otlight'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['autoclave'] . '</td>';
		echo '<td bgcolor=#888888 >' . $row ['topfloor'] . '</td>';
		
		$xOpTotal=$row ['opac']+$row ['opnonac'] +$row ['ward']+$row ['pharmacy']+$row ['otac']+$row ['otinst']+ $row ['otlight']+$row ['autoclave'] +$row ['topfloor'] ;
		
		echo '<td bgcolor=#888888 >' . $xOpTotal . '</td>';
		
		$xGrandOpAc += $row ['opac'];
		$xGrandOpNonAc += $row ['opnonac'];
		
		$xGrandWard += $row ['ward'];
		$xGrandMotor += $row ['motor'];
		
		$xGrandWardGroundFloor+=$row ['wardgroundfloor'];
		$xGrandWardFirstFloor += $row ['wardfirstfloor'];
		$xGrandWardSecondtFloor += $row ['wardsecondfloor'];
		
		$xGrandRs += $row ['rs'];
		$xGrandStaff += $row ['staff'];
		
		$xGrandPharmacy += $row ['pharmacy'];
		
		$xGrandOtAc += $row ['otac'];
$xGrandOtInst += $row ['otinst'];
$xGrandOtLight += $row ['otlight'];
$xGrandAutoClave += $row ['autoclave'];
$xGrandTopFloor += $row ['topfloor'];

	}
	if ($login_session == "admin") {
		if ($GLOBALS ['xViewCreatedAsOn'] == 0) {
			echo '<td>' . $row ['createdason'] . '</td>';
		}
		if ($GLOBALS ['xViewUpdatedAsOn'] == 0) {
			echo '<td>' . $row ['updatedason'] . '</td>';
		}
	}
	$xTotalConsumes += round ( $row ['consumption'] );
	?>

<td><a
						href="ht005ebdetails_new.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"
						onclick="return confirm_edit()"> <img src="../images/edit.png"
							alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
					</a></td>
					<td><a
						href="ht005ebdetails_new.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"
						onclick="return confirm_delete()"> <img src="../images/delete.png"
							alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
					</a></td>

<?
	echo '</tr>';
}

echo '<tr style=font-weight:bold;>';
echo '<td colspan=3>GRAND TOTAL</td>';
echo '<td></td>';
echo '<td>' . round ( $xGrandConsumes ) . '</td>';
if ($xEbNo == 0 || $xEbNo == 1) {
	
	echo '<td>' . $xGrandNewBorn . '</td>';
	echo '<td>' . $xGrandCompressor . '</td>';
	echo '<td>' . $xGrandSecurity . '</td>';
	echo '<td>' . $xGrandMotorRoom . '</td>';
	echo '<td>' . $xGrandNbOne . '</td>';
	echo '<td>' . $xGrandNbOneAc . '</td>';
	echo '<td>' . $xGrandNbTwoAc . '</td>';
	echo '<td>' . $xGrandNbNonAc . '</td>';
	echo '<td>' . $xGrandLab . '</td>';
	echo '<td>' . $xGrandLWin . '</td>';
	echo '<td>' . $xGrandLWOut . '</td>';
	echo '<td>' . $xGrandDrainageMotor . '</td>';
	echo '<td>' . $xGrandXrayMachine . '</td>';
	echo '<td>' . $xGrandPow . '</td>';
	echo '<td>' . $xGrandLift . '</td>';
	echo '<td>' . $xGrandHeater . '</td>';
	
}

if ($xEbNo == 0 || $xEbNo == 2) {
	echo '<td>' . $xGrandOpAc . '</td>';
	echo '<td>' . $xGrandOpNonAc . '</td>';
	echo '<td>' . $xGrandWard . '</td>';
	echo '<td>' . $xGrandMotor . '</td>';
	
	echo '<td>' . $xGrandWardGroundFloor . '</td>';
	echo '<td>' . $xGrandWardFirstFloor . '</td>';
	echo '<td>' . $xGrandWardSecondtFloor . '</td>';
	
	echo '<td>' . $xGrandRs . '</td>';
	echo '<td>' . $xGrandStaff . '</td>';
	
	echo '<td>' . $xGrandPharmacy . '</td>';
	
	echo '<td>' . $xGrandOtAc . '</td>';
	echo '<td>' . $xGrandOtInst . '</td>';
	echo '<td>' . $xGrandOtLight . '</td>';
	echo '<td>' . $xGrandAutoClave . '</td>';
	echo '<td>' . $xGrandTopFloor . '</td>';
	
}

echo '<td></td>';
echo '<td></td>';
echo '</tr>';
?>
</tbody>
			</table>
		</div>
		<!-- /container -->
	</div>
</body>
</html>
