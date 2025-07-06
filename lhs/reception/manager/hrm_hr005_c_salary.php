<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xFromDate'];
$xToDate = $GLOBALS ['xToDate'];
$xEmpNo = $GLOBALS ['xEmployeeNo'];
$xDeparmentNo = $GLOBALS ['xDepartmentNo'];
$xDays = $GLOBALS ['xDays'];
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$xCurrentDate = date ( 'Y-m-d' );
$xTdsValue=0.10;
function fn_FindLeaveCount($xEmpNo,$xFrom,$xTo)
{

$xQry="SELECT sum(status) as leavecount FROM `attendence` 
WHERE date >= '$xFrom' AND date<= '$xTo' AND empno = $xEmpNo";
//echo $xQry;
$result = mysql_query($xQry) or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xLeaveCount'] = $row['leavecount'];
  }
}
?>
<html>
<title>VIEW -SALARY</title>

<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<!--<form action="hrm_hr005_c_salary.php" method="post">-->
	<?php 
	$xToday = date ( 'Y-m-d' );
//	$xFromDate =$xToday;
//	$xToDate = $xToday;
	$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
	?>
<form class="form" name="report_expenses"
	action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    </br>
    </br>
	<div class="form-group">



		<div class="col-xs-3">
			<label>From Date:</label> <input class="form-control"
				name="f_fromdate" type="date"
				value="<?php echo $GLOBALS ['xFromDate']; ?>">
		</div>

		<div class="col-xs-3">
			<label>To Date:</label> <input class="form-control" name="f_todate"
				type="date" value="<?php echo $GLOBALS ['xToDate']; ?>">
		</div>
		</br>
		<div>
			<input type="submit" name="search" class="btn btn-primary"
				value="SEARCH" id="search">
		</div>



	</div>
	
</form>
	<body>
		<div id="divToPrint">
						<table class="table table-condensed" border="1" id="lastrow">
							<thead>
								<tr>
									<th>S.N</th>
									<th>EMPLOYEE</th>
									<th>DEPARTMENT</th>
									<th>BASIC</th>
									<th>PF12%</th>
									<th>ESI0.75%</th>
										<th>ALLOW</th>
									<th>NETSALARY</th>	
										<th>Leave</th>	
									<th>INC(L)</th>
									<th>INC(O)</th>
								<th>DED</th>
									<th>TOTAL</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
					<th>S.NO</th>
									<th>EMPLOYEE</th>
									<th>DEPARTMENT</th>
									<th>BASIC</th>
									<th>PF12%</th>
									<th>ESI0.75%</th>
									<th>ALLOW</th>
									<th>NETSALARY</th>
									<th>Leave</th>
									<th>INCENTIVE(L)</th>
									<th>INCENTIVE(O)</th>
								<th>DEDUCTIONS</th>
									<th>TOTAL</th>
								</tr>
							</tfoot>

							<tbody>

	<?php
	$xSlNo = 0;
	$xZeroValue = 0;
	$xQryFilter = '';
	/* Department No 13 Refers to Doctors they have 4 days leave */
	if ($row ['departmentno'] == 13) {
		$xLeaveCount = 4;
	} 	

	/* 8 -Manager, 16-Duty Doctors [No Leave Salary ] */
	else if ($row ['departmentno'] == 8 || $row ['departmentno'] == 19 || $row ['departmentno'] == 16) {
		$xLeaveCount = 0;
	}  /* Others Having 2 Days Leave Count */
else {
		$xLeaveCount = 2;
	}
	$xLeaveIncentive = 0;
	$xDeductions = 0;
	$xTotalSalary = 0;
	$xQry = '';
	/* --------------------- Execute All Employees-------------------- */
	if ($xEmpNo == 0) {
		if ($xDeparmentNo != 0) {
			$xQryFilter = " and a.departmentno=$xDeparmentNo";
		}
		
		/* 06/nov/2015 departmentno get from employee insteadof depatment */
		    if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
		$xQry = "SELECT SUM( 
	STATUS ) AS 
	status , e.empname, e.empdol,e.empstatus,e.empbasicsalary AS basicsalary,e.departmentno as departmentno,e.empfinededuction as empfinededuction,
e.txno as empno,e.empincentive,e.empallowance,e.emppfno
	FROM  `attendence` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate' 
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') $xQryFilter
	GROUP BY empno
	ORDER BY departmentno,empname";
		    }
		    //echo $xQry;
		$result2 = mysql_query ( $xQry );
		$xGrandBasicSalary = 0;
		$xGrandLeaveIncentive = 0;
		$xGrandDeductions = 0;
		$xGrandFineDeduction = 0;
		$xGrandEmpIncentiveOthers = 0;
		$xGrandTotalSalary = 0;
		$xGrandPf = 0;
		$xGrandEsi = 0;
		$xGrandNetSalary = 0;
	?>	
			<b><h3 class="panel-title text-center"><?php echo "Salary Generated FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
		<?php	
		while ( $row = mysql_fetch_array ( $result2 ) ) {
			/* Department No 13 Refers to Doctors they have 4 days leave */
			if ($row ['departmentno'] == 13) {
				$xLeaveCount = 4;
			} 			

			/* 8 -Manager 16-Duty Doctors [No Leave Salary ]  14 - Electrician*/
			else if ($row ['departmentno'] == 8 || $row ['departmentno'] == 19 || $row ['departmentno'] == 16 || $row ['departmentno'] == 14) {
				$xLeaveCount = 0;
			}  /* Others Having 2 Days Leave Count */
else {
				$xLeaveCount = 2;
			}
			$xLeaveIncentive = 0;
			$xEmpIncentiveOthers = 0;
			$xDeductions = 0;
			$xTotalSalary = 0;
			$xBasicSalary = $row ['basicsalary'];
			$xAllowance = $row ['empallowance'];
			
			$xOneDaySalary = ($xBasicSalary + $xAllowance) / 30;
			$xLeaveCount -= $row ['status'];
			$xEmpIncentiveOthers = $row ['empincentive'];
			if ($xLeaveCount > 0) {
				/* Op-Sister Department No -9 One Day Salary Only Watch Man Added 10/01/2017-Ganesan Sir 
				Driver Added as on 27Agu2020 Discussed with Ponni Sister*/
				if ($row ['departmentno'] == 9 || $row ['departmentno'] == 17 ||$row ['departmentno'] == 21 ) {
					$xLeaveIncentive = $xLeaveCount * $xOneDaySalary;
				} else {
					$xLeaveIncentive = $xLeaveCount * $xOneDaySalary * 2;
				}
			} else {
				$xDeductions = $xLeaveCount * $xOneDaySalary;
			}
			
			finddepartmentname ( $row ['departmentno'] );
			echo '<tr bgcolor="' . $GLOBALS ['xDepartmentColor'] . '">';
			echo '<td >' . $xSlNo += 1 . '</td>';
			echo '<td style=font-weight:bold>' . $row ['empname'] . '</td>';
			finddepartmentname ( $row ['departmentno'] );
			echo '<td >' . $GLOBALS ['xEmpDepartment'] . '</td>';
			echo '<td align=right>' . money_format ( "%!n", $row ['basicsalary'] ) . '</td>';
			
			$xPf = 0;
			if ($row ['emppfno'] != "")
				$xPf = ($row ['basicsalary'] * 12 / 100);
			echo '<td>' . round ( $xPf ) . '</td>';
			
			$xGrandPf += $xPf;
			
			$xEsi = 0;
			if ($row ['emppfno'] != "")
				$xEsi = ($row ['basicsalary'] * 0.75 / 100);
			echo '<td >' . round ( $xEsi ) . '</td>';
			$xGrandEsi += $xEsi;
			
			$xNetSalary = 0;
			$xTdsDeducted=0;
			
			if ($row ['departmentno'] == 13) {
				//$xTdsDeducted=(($row ['basicsalary'])-($row ['basicsalary']//*$xTdsValue));
				//Tds Remove as on 01 may 2018 by ponni mada conversation
					$xTdsDeducted=(($row ['basicsalary']));
				$xNetSalary = $xTdsDeducted + $row ['empallowance'] - $xPf - $xEsi;
			}
			else {
				$xNetSalary = $row ['basicsalary'] + $row ['empallowance'] - $xPf - $xEsi;
			}
			echo '<td align=right>' . $row ['empallowance'] . '</td>';
			echo '<td align=right>' . round ( $xNetSalary ) . '</td>';
			$xGrandNetSalary += round ( $xNetSalary );
						fn_FindLeaveCount($row ['empno'],$xFromDate,$xToDate);
					echo '<td align=right>' . $GLOBALS['xLeaveCount'] . '</td>';
			$xTotalSalary = $xNetSalary + $xLeaveIncentive + $xDeductions + $xEmpIncentiveOthers;
			
			if ($row ['departmentno'] == 12) {
				echo '<td align=right>' . money_format ( "%!n", round ( $xLeaveIncentive ) ) . '</td>';
			} else {
				echo '<td align=right>' . money_format ( "%!n", round ( $xLeaveIncentive ) ) . '</td>';
			}
			echo '<td align=right>' . money_format ( "%!n", $xEmpIncentiveOthers ) . '</td>';
			echo '<td align=right>' . money_format ( "%!n", round ( $xDeductions ) ) . '</td>';
			getemployeefineamount ( $row ['empno'], $xFromDate, $xToDate );

			
			// echo '<td align=right>' . money_format ( "%!n", round ( $GLOBALS ['xSingleEmployeeTotalFineAmount'] ) ) . '</td>';
			echo '<td align=right>' . money_format ( "%!n", round ( $xTotalSalary - $GLOBALS ['xSingleEmployeeTotalFineAmount'] ) ) . '</td>';
			echo '</tr>';
			$xGrandBasicSalary += $row ['basicsalary'];
			if ($row ['departmentno'] == 12) {
				$xGrandLeaveIncentive += $xLeaveIncentive;
			} else {
				$xGrandLeaveIncentive += $xLeaveIncentive;
			}
			$xGrandDeductions += $xDeductions;
			$xGrandFineDeduction += $GLOBALS ['xSingleEmployeeTotalFineAmount'];
			$xGrandTotalSalary += $xTotalSalary;
			$xGrandEmpIncentiveOthers += $xEmpIncentiveOthers;
		}
		echo '<tr style=font-weight:bold;>';
		echo '<td> </td>';
		echo '<td> </td>';
		echo '<td> GRAND -TOTAL </td>';
		echo '<td align=right>' . money_format ( "%!n", round ( $xGrandBasicSalary ) ) . '</td>';
		echo '<td>' . money_format ( "%!n", $xGrandPf ) . '</td>';
		echo '<td>' . money_format ( "%!n", $xGrandEsi ) . '</td>';
			echo '<td></td>';
			
		echo '<td>' . money_format ( "%!n", $xGrandNetSalary ) . '</td>';
			echo '<td> </td>';
		echo '<td align=right>' . money_format ( "%!n", round ( $xGrandLeaveIncentive ) ) . '</td>';
		echo '<td align=right>' . money_format ( "%!n", round ( $xGrandEmpIncentiveOthers ) ) . '</td>';
		echo '<td align=right>' . money_format ( "%!n", round ( $xGrandDeductions ) ) . '</td>';
		// echo '<td align=right>' . money_format ( "%!n", round ( $xGrandFineDeduction ) ) . ' </td>';
		echo '<td align=right>' . money_format ( "%!n", round ( $xGrandTotalSalary ) ) . ' </td>';
		echo '</tr>';
	}  /* --------------------- Execute All Employees Ended-------------------- */
	

	?>


	</tbody>


						</table>

		</div>
	</body>
</form>
</html>
