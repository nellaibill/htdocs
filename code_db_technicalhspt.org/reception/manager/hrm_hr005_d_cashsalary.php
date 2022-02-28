<?php
include 'globalfile.php';
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$xEmpNo=$GLOBALS ['xEmployeeNo'];
$xDeparmentNo=$GLOBALS['xDepartmentNo'];
$xDays=$GLOBALS ['xDays'];
$GLOBALS ['xCurrentDate']=date('Y-m-d');
?>
<html>
<title> VIEW -SALARY</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "Cash Salary Generated FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
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
          <th>DEDUCTIONS</th>
          <th>FINE</th>
          <th>TOTAL</th>
       </tr>
      </tfoot>

      <tbody>

<?php
$xSlNo=0;
$xQryFilter='';
$xGrandTotalFine=0;
if($row['departmentno']==13)
{
$xLeaveCount=4;
}
else if($row['departmentno']==8 || $row['departmentno']==14  ||$row['departmentno']==16 || $row['departmentno']==17)
{
$xLeaveCount=0;
}
else
{
$xLeaveCount=2;
}
$xLeaveIncentive=0;
$xDeductions=0;
$xOtherIncentive=0;
$xTotalSalary=0;
$xQry='';
/*--------------------- Execute All Employees-------------------- */
if ($xEmpNo==0) {
if($xDeparmentNo!=0)
{
$xQryFilter=" and a.departmentno=$xDeparmentNo";
}

$xQry="SELECT SUM( 
STATUS ) AS 
status , e.empname, e.empbasicsalary AS basicsalary,a.departmentno as departmentno,e.txno as empno,empfinededuction
FROM  `attendence` as a , employeedetails AS e
WHERE date >= '$xFromDate' AND date<= '$xToDate'
AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') and emppaymentmode='CASH' $xQryFilter
GROUP BY empno
ORDER BY departmentno,empname";
$result2=mysql_query($xQry);
$xGrandBasicSalary=0;
$xGrandLeaveIncentive=0;
$xGrandDeductions=0;
$xGrandFineDeductions=0;
$xGrandOtherIncentive=0;
$xGrandTotalSalary=0;
while ($row = mysql_fetch_array($result2)) {
if($row['departmentno']==13)
{
$xLeaveCount=4;
}
else if($row['departmentno']==8 ||$row['departmentno']==14  ||$row['departmentno']==16 || $row['departmentno']==17)
{
$xLeaveCount=0;
}
else
{
$xLeaveCount=2;
}
$xLeaveIncentive=0;
$xDeductions=0;
$xOtherIncentive=$row['empotherincentive'];
$xTotalSalary=0;
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
//$xTotalSalary=$xBasicSalary+$xLeaveIncentive+$xDeductions+$xOtherIncentive;
$xTotalSalary=$xBasicSalary+$xDeductions;
    finddepartmentname($row['departmentno']);
    echo '<tr bgcolor="' . $GLOBALS['xDepartmentColor'].  '">';
    echo '<td>' . $xSlNo+=1 . '</td>';  
    echo '<td >' .  $row['empname'] . '</td>';
    finddepartmentname( $row['departmentno'] );
    echo '<td >' .  $GLOBALS['xEmpDepartment'] . '</td>';
    echo '<td align=right>' .money_format("%!n", $row['basicsalary']) .  '</td>';
    echo '<td align=right>' . money_format("%!n", round($xDeductions)). '</td>';
    getemployeefineamount($row['empno'],$xFromDate,$xToDate);
    echo '<td align=right>' .money_format("%!n", round($GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
    echo '<td align=right>' .money_format("%!n", round($xTotalSalary-$GLOBALS ['xSingleEmployeeTotalFineAmount'])) . '</td>';
    echo '</tr>';
$xGrandBasicSalary+=$row['basicsalary'];
$xGrandLeaveIncentive+=$xLeaveIncentive;
$xGrandDeductions+=round($xDeductions);
$xGrandOtherIncentive+=$xOtherIncentive;
$xGrandTotalSalary+=$xTotalSalary;
$xGrandTotalFine+=$GLOBALS ['xSingleEmployeeTotalFineAmount'];

}
 echo '<tr style=font-weight:bold;>';
 echo '<td> </td>'; 
 echo '<td> GRAND -TOTAL </td>'; 
 echo '<td></td>';
 echo '<td align=right>' . money_format("%!n", round($xGrandBasicSalary)). '</td>';  
 echo '<td align=right>' . money_format("%!n", round($xGrandDeductions)) . '</td>'; 
 echo '<td align=right>' . money_format("%!n", round($xGrandTotalFine)) . '</td>'; 
 echo '<td align=right>' . money_format("%!n", round($xGrandTotalSalary)) . ' </td>';
  echo '</tr>';
}
/*--------------------- Execute All Employees Ended-------------------- */

/*--------------------- Execute Single Employees-------------------- */
else {
$xQry="SELECT SUM( STATUS ) AS status , e.empname, e.empbasicsalary AS basicsalary,a.departmentno as departmentno,empfinededuction FROM `attendence` as a , employeedetails AS e WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =$xEmpNo and empno=$xEmpNo and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') and emppaymentmode='CASH' order by departmentno,empname";
$result2=mysql_query($xQry);
echo '<b>'; 
echo  " Salary Generated  FROM $xFromDate TO $xToDate  AT ". date(" Y-m-d h:i:sa");
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
$xBasicSalary=$row['basicsalary'];
$xOneDaySalary=($xBasicSalary)/30;
$xLeaveCount-=$row['status'];
$xOtherIncentive=$row['empotherincentive'];
/*$xLeaveCount-=$row['halfday']*0.5;
$xLeaveCount-=$row['leaveday']*1;
$xLeaveCount-=$row['absent']*2;*/
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
//$xTotalSalary=$xBasicSalary+$xLeaveIncentive+$xDeductions+$xOtherIncentive;
$xTotalSalary=$xBasicSalary+$xDeductions;
    echo '<tr>';-
    findempname($xEmpNo);
    echo '<td>' .  $GLOBALS ['xEmpName'] . '</td>';
    finddepartmentname( $row['departmentno'] );
    echo '<td >' .  $GLOBALS['xEmpDepartment'] . '</td>';
    echo  '<td align=right>' .money_format("%!n", $row['basicsalary']) .  '</td>';
    //echo '<td align=right>' .money_format("%!n", round($xLeaveIncentive)). '</td>';
    //echo '<td align=right>' .money_format("%!n", round( $xOtherIncentive)). '</td>';
    echo '<td align=right>' .money_format("%!n",  round($xDeductions)). '</td>';
    echo '<td >' .  $row['empfinededuction'] . '</td>';
    echo '<td align=right>' .money_format("%!n", round($xTotalSalary)) . '</td>';
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