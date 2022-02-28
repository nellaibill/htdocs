<?php
	include 'globalfile.php';
	$xFromDate=$GLOBALS ['xFromDate'];
	$xToDate=$GLOBALS ['xToDate'];
	$xEmpNo=$GLOBALS ['xEmployeeNo'];
	$xDeparmentNo=$GLOBALS['xDepartmentNo'];
	$xDays=$GLOBALS ['xDays'];
	$GLOBALS ['xCurrentDate']=date('Y-m-d');
        $xCurrentDate=date('Y-m-d');

	?>
	<html>
	<title> VIEW -SALARY</title>

	<head><link href="bootstrap.css" rel="stylesheet">
	<link href="css/reportstyle.css" rel="stylesheet">
	</head>
	<form action="hrm_hr005_c_salary.php" method="post">
	<body>
	<div id="divToPrint" >
	<div class="panel panel-success">
	<div class="panel-heading">
	<b><h3 class="panel-title text-center"><?php echo "Salary Generated FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
	</div>
	<div class="panel-body">
	<div class="container">
	<table class="table table-condensed" border="1" id="lastrow">
		  <thead>
			<tr>
				  <th>S.NO</th>
			  <th>EMPLOYEE NAME</th>
			  <th>DEPARTMENT NAME</th>
			  <th>BASIC SALARY</th>
  <th>PF</th>
 <th>ESI</th>
			  <th>INCENTIVE(L)</th>
			  <th>DEDUCTIONS</th>
			  <th>FINE</th>
			  <th>TOTAL</th>
		   </tr>
		  </thead>
	  <tfoot>
			<tr>
			  <th>S.NO</th>
			  <th>EMPLOYEE NAME</th>
			  <th>DEPARTMENT NAME</th>
			  <th>BASIC SALARY</th>

 <th>PF</th>
 <th>ESI</th>
			  <th>INCENTIVE(L)</th>
			  <th>DEDUCTIONS</th>
			  <th>FINE</th>
			  <th>TOTAL</th>
		   </tr>
		  </tfoot>

		  <tbody>

	<?php
	$xSlNo=0;
	$xZeroValue=0;
	$xQryFilter='';
	/* Department No 13 Refers to Doctors they have 4 days leave */
	if($row['departmentno']==13)
	{
	$xLeaveCount=4;
	}

	/* 8 -Manager 14 -Electrician 16-Duty Doctors 17-Watch Man [No Leave Salary ] */
	else if($row['departmentno']==8 || $row['departmentno']==14  ||$row['departmentno']==16 || $row['departmentno']==17 )
	{
	$xLeaveCount=0;
	}
	/*Others Having 2 Days Leave Count */
	else
	{
	$xLeaveCount=2;
	}
	$xLeaveIncentive=0;
	$xDeductions=0;
	$xTotalSalary=0;
	$xQry='';
	/*--------------------- Execute All Employees-------------------- */
	if ($xEmpNo==0) {
	if($xDeparmentNo!=0)
	{
	$xQryFilter=" and a.departmentno=$xDeparmentNo";
	}

        /* 06/nov/2015 departmentno get from employee insteadof depatment  */

	$xQry="SELECT SUM( 
	STATUS ) AS 
	status , e.empname, e.empdol,e.empstatus,e.empbasicsalary AS basicsalary,e.departmentno as departmentno,empfinededuction,e.txno as empno,emppaymentmode,empepf,empesi
	FROM  `attendence` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate'
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') $xQryFilter
	GROUP BY empno
	ORDER BY departmentno,empname";
	$result2=mysql_query($xQry);
	$xGrandBasicSalary=0;
	$xGrandLeaveIncentive=0;
	$xGrandDeductions=0;
	$xGrandFineDeduction=0;
	$xGrandTotalSalary=0;
$xGrandPf=0;
$xGrandEsi=0;
	while ($row = mysql_fetch_array($result2)) {
	/* Department No 13 Refers to Doctors they have 4 days leave */
	if($row['departmentno']==13)
	{
	$xLeaveCount=4;
	}

	/* 8 -Manager 14 -Electrician 16-Duty Doctors 17-Watch Man [No Leave Salary ] */
	else if($row['departmentno']==8 || $row['departmentno']==14  ||$row['departmentno']==16 || $row['departmentno']==17 )
	{
	$xLeaveCount=0;
	}
	/*Others Having 2 Days Leave Count */
	else
	{
	$xLeaveCount=2;
	}
	$xLeaveIncentive=0;
	$xDeductions=0;
	$xTotalSalary=0;
	$xBasicSalary=$row['basicsalary'];
	$xOneDaySalary=($xBasicSalary)/30;
	$xLeaveCount-=$row['status'];
	if($xLeaveCount>0)
	{
          /* Op-Sister Department No -9 One Day Salary Only */
	  if($row['departmentno']==9)
	   {
	    $xLeaveIncentive=$xLeaveCount*$xOneDaySalary;
	   }
          else
	   {
	    $xLeaveIncentive=$xLeaveCount*$xOneDaySalary*2;
	   }
	}
	else
	{
	$xDeductions=$xLeaveCount*$xOneDaySalary;
	}

           /* Mark Saleem 01/November/2015 -Changes By Ponni Madam  
                 1)Sweepers Monthly two days leave 
                 2)Extra Leave Salary Should  be deducted
                 3)Fine  amount should be deducted
                 4)No Incentive  

          */
                

 
                if($row['departmentno']==12)
	          {
	           $xTotalSalary=$xBasicSalary+$xDeductions;
	          } 
                else
                  {
	            $xTotalSalary=$xBasicSalary+$xLeaveIncentive+$xDeductions;
                  }

            /* Mark Saleem 01/November/2015 Ended */

		finddepartmentname($row['departmentno']);
		echo '<tr bgcolor="' . $GLOBALS['xDepartmentColor'].  '">';
		echo '<td >' .  $xSlNo+=1 . '</td>';;
		echo '<td style=font-weight:bold>' .  $row['empname'] . '</td>';
		finddepartmentname( $row['departmentno'] );
		echo '<td >' .  $GLOBALS['xEmpDepartment'] . '</td>';

 /* Mark Saleem 25/August/2016-Changes By Ponni Madam*/

if($row['emppaymentmode']=='CHEQUE'){	
echo '<td align=right>' .money_format("%!n", $row['basicsalary']) .  '</td>';
echo '<td align=right>' .money_format("%!n", $row['empepf']) .  '</td>';
echo '<td align=right>' .money_format("%!n", $row['empesi']) .  '</td>';
$xGrandPf+=$row['empepf'];
$xGrandEsi+=$row['empesi'];
}else
{
echo '<td align=right>' .money_format("%!n", $row['basicsalary']) .  '</td>';
echo '<td align=right>0.00</td>';
echo '<td align=right>0.00</td>';
}

	if($row['departmentno']==12)
	{
		echo '<td align=right>' .money_format("%!n", round($xZeroValue)). '</td>';
	}
	else
	{
		echo '<td align=right>' .money_format("%!n", round($xLeaveIncentive)). '</td>';
	}
                echo '<td align=right>' . money_format("%!n", round($xDeductions)). '</td>';
		getemployeefineamount($row['empno'],$xFromDate,$xToDate);
		echo '<td align=right>' .money_format("%!n", round($GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
if($row['emppaymentmode']=='CHEQUE'){	
		echo '<td align=right>' .money_format("%!n", round($xTotalSalary-$row['empepf']-$row['empesi']-$GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
}
else
{
echo '<td align=right>' .money_format("%!n", round($xTotalSalary-$GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
}
		echo '</tr>';
	$xGrandBasicSalary+=$row['basicsalary'];
	if($row['departmentno']==12)
	{
	$xGrandLeaveIncentive+=$xZeroValue;
	}
	else
	{
	$xGrandLeaveIncentive+=$xLeaveIncentive;
	}
        $xGrandDeductions+=$xDeductions;
	$xGrandFineDeduction+=$GLOBALS ['xSingleEmployeeTotalFineAmount'];
	$xGrandTotalSalary+=$xTotalSalary;
      }
	 echo '<tr style=font-weight:bold;>';
	 echo '<td> </td>'; 
	 echo '<td> </td>'; 
	 echo '<td> GRAND -TOTAL </td>'; 
	 echo '<td align=right>' . money_format("%!n", round($xGrandBasicSalary)). '</td>';  
	 echo '<td>'.money_format("%!n", round($xGrandPf)).' </td>'; 
	 echo '<td>'.money_format("%!n", round($xGrandEsi)).' </td>'; 
	 echo '<td align=right>' . money_format("%!n", round($xGrandLeaveIncentive )). '</td>'; 
	 echo '<td align=right>' . money_format("%!n", round($xGrandDeductions)) . '</td>'; 
	 echo'<td align=right>'  . money_format("%!n", round( $xGrandFineDeduction )). ' </td>'; 
	 echo '<td align=right>' . money_format("%!n", round($xGrandTotalSalary-$xGrandPf-$xGrandEsi)) . ' </td>';
	 echo '</tr>';
	}
	/*--------------------- Execute All Employees Ended-------------------- */

	/*--------------------- Execute Single Employees-------------------- */
	else {
	$xQry="SELECT SUM( STATUS ) AS status ,e.txno as empno, e.empname, e.empbasicsalary AS basicsalary,
         e.departmentno as departmentno,empfinededuction FROM `attendence` as a , employeedetails AS e 
         WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =$xEmpNo and empno=$xEmpNo 
         and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') order by departmentno,empname";
	$result2=mysql_query($xQry);
	echo '<b>'; 
	echo  " Salary Generated  FROM $xFromDate TO $xToDate  AT ". date(" Y-m-d h:i:sa");
	echo '</br>'; 
	while ($row = mysql_fetch_array($result2)) {
	$xBasicSalary=$row['basicsalary'];
	$xOneDaySalary=($xBasicSalary)/30;
	$xLeaveCount-=$row['status'];
	if($xLeaveCount>0)
	{
	if($row['departmentno']==9)
	{
	$xLeaveIncentive=$xLeaveCount*$xOneDaySalary;
	}else
	{
	$xLeaveIncentive=$xLeaveCount*$xOneDaySalary*2;
	}
	}
	else
	{
	$xDeductions=$xLeaveCount*$xOneDaySalary;
	}
	$xTotalSalary=$xBasicSalary+$xLeaveIncentive+$xDeductions;
		echo '<tr>';-
		findempname($xEmpNo);

	 echo '<td> </td>'; 
		echo '<td>' .  $GLOBALS ['xEmpName'] . '</td>';
		finddepartmentname( $row['departmentno'] );
		echo '<td >' .  $GLOBALS['xEmpDepartment'] . '</td>';
		echo  '<td align=right>' .money_format("%!n", $row['basicsalary']) .  '</td>';
	if($row['departmentno']==12)
	{
		echo '<td align=right>' .money_format("%!n", round($xZeroValue)). '</td>';
	}
	else
	{
		echo '<td align=right>' .money_format("%!n", round($xLeaveIncentive)). '</td>';
	}
		echo '<td align=right>' .money_format("%!n", round( $xLeaveDeduction)). '</td>';
		echo '<td align=right>' .money_format("%!n",  round($xDeductions)). '</td>';
		getemployeefineamount($row['empno'],$xFromDate,$xToDate);
		echo '<td align=right>' .money_format("%!n", round($GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
		echo '<td align=right>' .money_format("%!n", round($xTotalSalary-$GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
		echo '</tr>';
		echo '</tr>'; 
	}
	}
	/*--------------------- Execute Single  Employees Ended -------------------- */	
	?>


	</tbody>


		</table>	
	  </div>
	</div>
	</div>
	</div>
	</body>
	</form></html>	