<?php
include 'config.php';
include 'globalfile.php';
setControlProperties ();
$xFromDate = $GLOBALS ['xCurrentDate'];
$xToDate = $GLOBALS ['xCurrentDate'];
$xStatus1 = $GLOBALS ['xStatus'];
$xEmpNo = $GLOBALS ['xEmployeeNo'];

if (isset ( $_GET ['txno'] ) && ! empty ( $_GET ['txno'] )) {
	$no = $_GET ['txno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['txno'] );
	} else {
		$xQry = "DELETE FROM attendence WHERE txno= $no";
		mysql_query ( $xQry );
		header ( 'Location: hrm_hr003attendence.php' );
	}
} else {
	GetMaxIdNo ();
}
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );

if (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
function setControlProperties() {
	$xIdno;
	$xDate;
	$xGroupName = "";
	$xComment = "";
	$xAmount = 0;
	$GLOBALS ['xMode'] = "";
	$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
	// $GLOBALS['xEmpName'] = "";
	$GLOBALS ['xShift'] = "";
	$GLOBALS ['xInTime'] = "";
	$GLOBALS ['xOutTime'] = "";
	$GLOBALS ['xTotalTime'] = "";
	$GLOBALS ['xResponsiblePerson'] = "";
	$GLOBALS ['xDepartmentNo'] = "";
}
function GetMaxEmpNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS maxempno FROM employeedetails" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xMaxEmpNo'] = $row ['maxempno'];
	}
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM attendence" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xMaxId'] = $row ['txno'];
	}
}
function finddepartmentno($xNo) {
	$result = mysql_query ( "SELECT *  FROM employeedetails where txno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xDepartmentNoforMultiple'] = $row ['departmentno'];
	}
}
function DataFetch($xTxno) {
	$result = mysql_query ( "SELECT *  FROM attendence where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xIdno'] = $row ['txno'];
			$GLOBALS ['xDate'] = $row ['date'];
			// findempname($row['empno']);
			$GLOBALS ['xDepartmentNo'] = $row ['departmentno'];
			finddepartmentname ( $row ['departmentno'] );
			$GLOBALS ['xShift'] = $row ['shift'];
			$GLOBALS ['xStatus'] = $row ['status'];
			$GLOBALS ['xInTime'] = $row ['intime'];
			$GLOBALS ['xOutTime'] = $row ['outtime'];
			$GLOBALS ['xTotalTime'] = $row ['totaltime'];
			$xEmpNo = $row ['empno'];
			mysql_query ( "update config set employeeno=$xEmpNo" );
		}
	}
}
function fn_FindEmployeeDetails($xNo) {
	$result = mysql_query ( "SELECT *  FROM employeedetails where txno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['empbasicsalary'] = $row ['empbasicsalary'];
		$GLOBALS ['empbasic'] = $row ['empbasic'];
		$GLOBALS ['empda'] = $row ['empda'];
		$GLOBALS ['empallowance'] = $row ['empallowance'];
		$GLOBALS ['emphra'] = $row ['emphra'];
		
		$GLOBALS ['emptotal'] = $row ['emptotal'];
		$GLOBALS ['empepf'] = $row ['empepf'];
		$GLOBALS ['empesi'] = $row ['empesi'];
		$GLOBALS ['empnetpay'] = $row ['empnetpay'];
		$GLOBALS ['empincentive'] = $row ['empincentive'];
		$GLOBALS ['empfinededuction'] = $row ['empfinededuction'];
		$GLOBALS ['empstatus'] = $row ['empstatus'];
	}
}
function DataProcess($xMode) {
	$xMaxEmpNo = 0;
	$xDepartmentNoforMultiple = 0;
	$IdNo = $_POST ['txtTxNo'];
	$xDate = $_POST ['date'];
	$xDepartmentNo = $_POST ['departmentno'];
	$xEmpNo = $_POST ['empno'];
	findempname ( $xEmpNo );
	$xShift = $_POST ['shift'];
	$xStatus = $_POST ['status'];
	$xInTime = $_POST ['intime'];
	$xOutTime = $_POST ['outtime'];
	$xTotalTime = $_POST ['totaltime'];
	$CurrentDate = $GLOBALS ['xCurrentDate'];
	
	fn_FindEmployeeDetails ( $xEmpNo );
	$xEmpBasicSalary = $GLOBALS ['empbasicsalary'];
	$xEmpBasic = $GLOBALS ['empbasic'];
	$xEmpDa = $GLOBALS ['empda'];
	$xEmpAllowance = $GLOBALS ['empallowance'];
	$xEmpHra = $GLOBALS ['emphra'];
	
	$xEmpTotal = $GLOBALS ['emptotal'];
	$xEmpEpf = $GLOBALS ['empepf'];
	$xEmpEsi = $GLOBALS ['empesi'];
	$xEmpNetPay = $GLOBALS ['empnetpay'];
	$xEmpIncentive = $GLOBALS ['empincentive'];
	$xEmpFineDeduction = $GLOBALS ['empfinededuction'];
	$xEmpStatus = $GLOBALS ['empstatus'];
	
	if ($xMode == 'S') {
		if ($xDepartmentNo == 0) {
			GetMaxEmpNo ();
			$xMaxEmpNo = $GLOBALS ['xMaxEmpNo'];
			for($i = 1; $i < $xMaxEmpNo; $i ++) {
				
				fn_FindEmployeeDetails ( $i );
				$xEmpBasicSalary = $GLOBALS ['empbasicsalary'];
				$xEmpBasic = $GLOBALS ['empbasic'];
				$xEmpDa = $GLOBALS ['empda'];
				$xEmpAllowance = $GLOBALS ['empallowance'];
				$xEmpHra = $GLOBALS ['emphra'];
				
				$xEmpTotal = $GLOBALS ['emptotal'];
				$xEmpEpf = $GLOBALS ['empepf'];
				$xEmpEsi = $GLOBALS ['empesi'];
				$xEmpNetPay = $GLOBALS ['empnetpay'];
				$xEmpIncentive = $GLOBALS ['empincentive'];
				$xEmpFineDeduction = $GLOBALS ['empfinededuction'];
				$xEmpStatus = $GLOBALS ['empstatus'];
				
				
				finddepartmentno ( $i );
				$xDepartmentNoforMultiple = $GLOBALS ['xDepartmentNoforMultiple'];
				$xQry = "INSERT INTO attendence 
               VALUES ($IdNo, '$xDate',$xDepartmentNoforMultiple,$i,
				'$xShift',$xStatus,'00:00:00','00:00:00','00:00:00', 
				$xEmpBasicSalary, $xEmpBasic,$xEmpDa, $xEmpAllowance, 
				$xEmpHra,$xEmpTotal,$xEmpEpf,$xEmpEsi,$xEmpNetPay,
				$xEmpIncentive,$xEmpFineDeduction,'$xEmpStatus')";
				//echo $xQry;
				$xExecuteMultipleEmployees = mysql_query ( $xQry ) or die ( mysql_error () );
				if (! $xExecuteMultipleEmployees) {
					die ( 'Could not enter data: ' . mysql_error () );
				}
				$IdNo += 1;
			}
			
			echo '<script language="javascript">';
			echo 'alert("Inserted Multiple Records Successfully")';
			echo '</script>';
		} else {
			$count = 0;
			$xQry1 = "select count(empno) as count from attendence where date='$xDate' and empno=$xEmpNo";
			$result = mysql_query ( $xQry1 ) or die ( mysql_error () );
			while ( $row = mysql_fetch_array ( $result ) ) {
				$GLOBALS ['xCount'] = $row ['count'];
			}
			$count = $GLOBALS ['xCount'];
			if ($count == 0) {
				$xQry = "INSERT INTO attendence VALUES (
				$IdNo, '$xDate',$xDepartmentNo,$xEmpNo,
				'$xShift',$xStatus,'00:00:00','00:00:00','00:00:00', 
				$xEmpBasicSalary, $xEmpBasic,$xEmpDa, $xEmpAllowance,
				 $xEmpHra,$xEmpTotal,$xEmpEpf,$xEmpEsi,$xEmpNetPay,
				$xEmpIncentive,$xEmpFineDeduction,'$xEmpStatus')";
				$xExecuteSingleEmployees = mysql_query ( $xQry ) or die ( mysql_error () );
				if (! $xExecuteSingleEmployees) {
					die ( 'Could not enter data: ' . mysql_error () );
				}
				GetMaxIdNo ();
				echo '<script language="javascript">';
				echo 'alert("Inserted Successfully")';
				echo '</script>';
			} else {
				echo '<script language="javascript">';
				echo 'alert("EMPLOYEE ALREADY MARKED")';
				echo '</script>';
			}
		}
	} elseif ($xMode == 'U') {
		$IdNo = $_POST ['txtTxNo'];
		$Date = $_POST ['date'];
		$GroupName = $_POST ['groupname'];
		$Details = $_POST ['comment'];
		$Amount = $_POST ['amount'];
		// sql to update a record
		if ($GLOBALS ['xCurrentUser'] == 'admin') {
			$sql = "UPDATE attendence SET  date='$Date',departmentno=$xDepartmentNo,empno=$xEmpNo,shift='$xShift ',status=$xStatus,empbasicsalary=$xEmpBasicSalary,empbasic=$xEmpBasic,empda=$xEmpDa, empallowance=$xEmpAllowance,emphra=$xEmpHra,
       emptotal=$xEmpTotal,empepf=$xEmpEpf,empesi=$xEmpEsi,empnetpay=$xEmpNetPay,empincentive=$xEmpIncentive,empfinededuction=$xEmpFineDeduction,empstatus='$xEmpStatus' WHERE txno=$IdNo";
		} else {
			$sql = "UPDATE attendence SET  date='$Date',departmentno=$xDepartmentNo,empno=$xEmpNo,shift='$xShift ',status=$xStatus,empbasicsalary=$xEmpBasicSalary,empbasic=$xEmpBasic,empda=$xEmpDa, empallowance=$xEmpAllowance,emphra=$xEmpHra,
       emptotal=$xEmpTotal,empepf=$xEmpEpf,empesi=$xEmpEsi,empnetpay=$xEmpNetPay,empincentive=$xEmpIncentive,empfinededuction=$xEmpFineDeduction,empstatus='$xEmpStatus' WHERE txno=$IdNo";
		}
		// echo $sql;
		$retval = mysql_query ( $sql ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		GetMaxIdNo ();
		echo '<script language="javascript">';
		echo 'alert("Updated Successfully")';
		echo '</script>';
	} elseif ($xMode == 'D') {
		$sql = "DELETE FROM attendence WHERE txno=$IdNo";
		$retval = mysql_query ( $sql ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		GetMaxIdNo ();
		echo '<script language="javascript">';
		echo 'alert("Deleted Successfully")';
		echo '</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ATTENDENCE</title>
<script type="text/javascript">
function onchangeajax(employeeid)
 {
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
 
 var url="ajax_filteremployee.php"
 url=url+"?employeeid="+employeeid
 url=url+"&sid="+Math.random()
document.getElementById("employeediv").innerHTML='Please wait..<img border="0" src="../images/load.png">'
 if(xmlHttp.onreadystatechange=stateChanged)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }
 
 function stateChanged()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("employeediv").innerHTML=xmlHttp.responseText
 return true;
 }
 }
 
 function GetXmlHttpObject()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }
</script>


</head>

<?php
if (($GLOBALS ['xCurrentUserRole'] == 'S') || ($GLOBALS ['xCurrentUser'] == "admin")) {
	?>

<body>
	<form class="form" action="<?php echo $_SERVER['PHP_SELF'];?>"
		method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MARK-ATTENDENCE</h3>
			</div>
			<div class="panel-body">

				<div class="form-group" style="display: none;">
					<label for="lbltxno" class="control-label col-xs-2">SL.NO</label>
					<div class="col-xs-1">
						<input type="text" class="form-control" id="xtxtTxNo"
							style="text-align: right" name="txtTxNo"
							value="<?php echo $GLOBALS['xIdno'];?>">
					</div>
				</div>
				<div class=""form-group"">
					<label for="lblAmount" class="control-label col-xs-3">DEPARTMENT &
						EMPLOYEE</label>

					<div class="col-xs-3">
						<select class="form-control" name="departmentno"
							autofocus="autofocus" onfocus="return onchangeajax(this.value);"
							onchange="return onchangeajax(this.value);">
  <?php
	
	$result = mysql_query ( "SELECT departmentno,departmentname FROM m_department ORDER BY departmentno" );
	echo "<option value=''>CHOOSE DEPARTMENT HERE</option>";
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
               <option value="<?php echo $row['departmentno']; ?>"
								<?php   if ($row['departmentno']== $GLOBALS ['xDepartmentNo']){ echo 'selected="selected"';} ?>>
            <?php echo $row['departmentname']; ?> 
            </option>

             <?
	}
	echo "</select>";
	?>

					
					
					
					</div>
					<div id="employeediv">
						<input type="text" name="empno" readonly />
					</div>
				</div>
				<br> <br>
				<div class=""form-group"">
					<label for="lblAmount" class="control-label col-xs-3">DATE & SHIFT
						& STATUS</label>
					<div class="col-xs-2">
						<input type="date" class="form-control" id="xdate" name="date"
							value="<?php echo $GLOBALS['xDate'];?>" placeholder="">
					</div>
					<div class="col-xs-2">
						<select class="form-control" id="shift" value="" name="shift">

							<option value="DAY"
								<?php if ($GLOBALS['xShift'] == "DAY") echo 'selected="selected"';?>>DAY</option>
							<option value="NIGHT"
								<?php if ($GLOBALS['xShift'] == "NIGHT") echo 'selected="selected"';?>>NIGHT</option>
							<option value="DAYNIGHT"
								<?php if ($GLOBALS['xShift'] == "DAYNIGHT") echo 'selected="selected"';?>>DAYNIGHT</option>


						</select>
					</div>
					<div class="col-xs-2">
						<select class="form-control" id="status" value="" name="status">

							<option value="0"
								<?php if ($GLOBALS['xStatus'] == "0") echo 'selected="selected"';?>>PRESENT</option>
							<option value="0.5"
								<?php if ($GLOBALS['xStatus'] == "0.5") echo 'selected="selected"';?>>HALFDAY</option>
							<option value="1"
								<?php if ($GLOBALS['xStatus'] == "1") echo 'selected="selected"';?>>LEAVE</option>
							<option value="2"
								<?php if ($GLOBALS['xStatus'] == "2") echo 'selected="selected"';?>>ABSENT</option>


						</select>
					</div>
				</div>
				<br> <br>
				<!--
<div class="form-group">

					<label for="comment" class="control-label col-xs-2">IN-TIME</label>
				   <div class="col-xs-3">
						<input type="text" class="form-control" name="intime"
							id="intime" value="<?php echo $GLOBALS['xInTime'];?>"
							placeholder="">

</div>
<button type='button' onclick="setontime()">SET</button></br></br>

<label for="comment" class="control-label col-xs-2">OUT-TIME</label>
					   <div class="col-xs-3">
						<input type="text" class="form-control" name="outtime"
							id="outtime" value="<?php echo $GLOBALS['xOutTime'];?>"
							placeholder="">
					</div>
<button type='button' onclick="setofftime()">SET</button></div>
</br>



				<div class=""form-group"">
					<label for="lblAmount" class="control-label col-xs-2">TOTAL TIME(H:M)</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" name="totaltime"
							id="totaltime" value="<?php echo $GLOBALS['xTotalTime'];?>"
							placeholder="" onclick="timedifference()">
					</div><button type='button' onclick="timedifference()">CALCULATE</button>
				</div></div><br> !-->
				<br>

				<div class="panel-footer clearfix">
					<div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit" name="save" class="btn btn-primary"
							value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit" name="update"
							class="btn btn-primary" value="UPDATE"
							onclick="return validateForm()"> 
           <? }  ?>
        </div>
				</div>
				</fieldset>
	
	</form>
	</div>
	<!--             ----------------------- REPORT STARTS HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">TODAY'S ATTENDENCE STATUS</h3>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>S.NO</th>
							<th>DATE</th>
							<th>EMPLOYEE NAME</th>
							<th>DEPARTMENT NAME</th>
							<th>STATUS</th>

						</tr>
					</thead>
					<tbody>

<?php
	$xSlNo = 0;
	$xLeaveCount = 2;
	$xLeaveIncentive = 0;
	$xDeductions = 0;
	$xOtherIncentive = 0;
	$xTotalSalary = 0;
	$xStatus = '';
	$xQry = '';
	$xQryFilter = '';
	if ($xStatus1 != 10) {
		$xQryFilter = $xQryFilter . ' ' . "and status=$xStatus1";
	}
	/*
	 * if($xEmpNo=='0')
	 * {
	 * $xQry=" SELECT a.txno AS txno, date, e.empname as empname, d.departmentname AS departmentname,status FROM `attendence` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =a.empno and d.departmentno=a.departmentno and e.empstatus='ACTIVE'";
	 * }
	 * else
	 * {
	 * $xQry=" SELECT a.txno AS txno, date, e.empname as empname, d.departmentname AS departmentname,status FROM `attendence` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =$xEmpNo AND e.txno = a.empno and d.departmentno=a.departmentno and e.empstatus='ACTIVE' $xQryFilter";
	 * }
	 */
	
	$xQry = "SELECT a.txno AS txno, date, e.empname as empname, d.departmentname AS departmentname,status FROM `attendence` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =a.empno  and d.departmentno=a.departmentno  and e.empstatus='ACTIVE' order by txno";
	// echo $xQry;
	$result2 = mysql_query ( $xQry );
	
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		if ($row ['status'] == '0') {
			$xStatus = 'PRESENT';
		}
		if ($row ['status'] == '0.5') {
			$xStatus = 'HALFDAY';
		}
		if ($row ['status'] == '1') {
			$xStatus = 'LEAVE';
		}
		
		if ($row ['status'] == '2') {
			$xStatus = 'ABSENT';
		}
		
		echo '<tr>';
		echo '<td>' . $xSlNo += 1 . '</td>';
		echo '<td>' . $row ['date'] . '</td>';
		echo '<td>' . $row ['empname'] . '</td>';
		echo '<td>' . $row ['departmentname'] . '</td>';
		echo '<td>' . $xStatus . '</td>';
		?>
<td width="5%"><a
							href="hrm_ht003attendence.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="../images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0"></a></td>
						<td width="5%"><a
							href="hrm_ht003attendence.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img
								src="../images/delete.png" alt="HTML tutorial"
								style="width: 30px; height: 30px; border: 0"></a></td>
<?
		echo '</tr>';
	}
	
	?>	
</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>

</body>
</html>
<?php
}
?>
