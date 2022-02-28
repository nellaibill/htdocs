<?php
include('globalfile.php');
//$xFromDate= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
//$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));  
	$xFromDate=$GLOBALS ['xFromDate'];
	$xToDate=$GLOBALS ['xToDate']; 
$GLOBALS['xLeaveCount']=0;

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
<title> V-Employee-Salary</title>
<form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "Employer Contribution FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
</div>
</div>


<div class="panel-body">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
                     <th width="20%">S.NO</th>
           <th width="20%">PFNO</th>
           <th width="20%">ESINO</th>
           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="10%">BASIC</th>
           <th width="5%">D.A</th>
           <th width="5%">TOTAL</th>
   <th width="5%">LEAVE</th>
   <th width="5%">DEDUCTION</th>
   <th width="5%">NET SALARY</th>
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(3.25%)</th>
          </tr>
      </thead>
      <tfoot>
        <tr>
                     <th width="20%">S.NO</th>
           <th width="20%">PFNO</th>
           <th width="20%">ESINO</th>
           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="10%">BASIC</th>
           <th width="5%">D.A</th>
           <th width="5%">TOTAL</th>
   <th width="5%">LEAVE</th>
   <th width="5%">DEDUCTION</th>
   <th width="5%">NET SALARY</th>
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(3.25%)</th>

          </tr>
      </tfoot>
      <tbody>

<?php
$xQryFilter='';
    $xEmpBasic=0;
    $xEmpDa=0;;
    $xEmpHra=0;
    $xEmpTotal=0;
    $xEmpEpf=0;
    $xEmpEsi=0;
    $xEmpNetPay=0;
    $xSlNo=0;
if($xEmployeeNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and txno=$xEmployeeNo ";
}

/*$xQry="SELECT *  from employeedetails where emppfno!='' and txno in
(SELECT e.txno as empno
	FROM  `attendence` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate'
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') 
	GROUP BY empno) "; */

$xQry="SELECT txno,emppfno, empesino, empname, departmentno,
empbasic, empda, emptotal,empallowance
 from employeedetails where emppfno!='' and txno in
(SELECT e.txno as empno
	FROM  `t_pfesi` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate'
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') 
	GROUP BY empno) "; 
$xQry.= $xQryFilter. ' ' . " order by txno ;";


//echo $xQry;
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    $xNetPay=0;
    $xSlNo+=1;
    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $row['emppfno']  . '</td>';
    echo '<td>' . $row['empesino']  . '</td>';
    findempname($row ['txno']);
    echo '<td>' . $GLOBALS ['xEmpName']  . '</td>';
    finddepartmentname($row ['departmentno']);
    echo '<td >' . $GLOBALS ['xEmpDepartment']  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empbasic'])  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empda']) . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['emptotal']-$row['empallowance'])  . '</td>';
 

fn_FindLeaveCount($row ['txno'],$xFromDate,$xToDate);
 echo '<td>' . $GLOBALS['xLeaveCount']  . '</td>';

$xDeductedSalary=0.00;
if($GLOBALS['xLeaveCount']>=4)
{

$xOneDaySalary=($row['emptotal']-$row['empallowance'])/30;

$xDeductedSalary=round(($GLOBALS['xLeaveCount']-4) * $xOneDaySalary);
 echo '<td>' . $xDeductedSalary  . '</td>';
}
else
{

 echo '<td> 0.00 </td>';
}
$xNetSalary=0.00;

$xNetSalary=$row['emptotal']-$row['empallowance']-$xDeductedSalary;
$xGrandNetSalary+=$xNetSalary;
    echo '<td align=right>' . money_format("%!n", $xNetSalary)  . '</td>';

      $xEpfPercent=12;
      $xEsiPercent=3.25;
      //$xEmpEpf=(($row['empbasic']+$row['empda'])/100)*$xEpfPercent;
     // $xEmpEsi=($row['emptotal']/100)*$xEsiPercent;
 $xEmpEpf=(($xNetSalary)/100)*$xEpfPercent;
      $xEmpEsi=($xNetSalary/100)*$xEsiPercent;
    echo '<td align=right>' . money_format("%!n", $xEmpEpf)  . '</td>';
    echo '<td align=right>' . money_format("%!n", $xEmpEsi)  . '</td>';
 echo '<td align=right>' . money_format("%!n", $xNetSalary-$xEmpEpf-$xEmpEsi)  . '</td>';

    $xNetPay= $row['emptotal']-$xEmpEpf-$xEmpEsi;
    $xEmpBasic+=$row['empbasic'];
    $xEmpDa+=$row['empda'];
    $xEmpTotal+=$row['emptotal']-$row['empallowance'];
    $xTotalEmpEpf+=$xEmpEpf;
    $xTotalEmpEsi+=$xEmpEsi;
echo '</tr>'; 
}

  echo '<tr style=font-weight:bold;>';
  echo '<td>  </td>'; 
  echo '<td>  </td>'; 
  echo '<td>  </td>'; 
  echo '<td colspan=2> GRAND -TOTAL </td>'; 
  echo '<td align=right>' . money_format("%!n", round($xEmpBasic)). '</td>';  
  echo '<td align=right>' . money_format("%!n", round($xEmpDa)). '</td>'; 
  echo '<td align=right>' . money_format("%!n", round($xEmpTotal)) . ' </td>';
  echo '<td>  </td>'; 
  echo '<td>  </td>';
  echo '<td> ' . money_format("%!n", round($xGrandNetSalary)) . '   </td>'; 
  echo '<td align=right>' . money_format("%!n",  $xTotalEmpEpf). ' </td>'; 
  echo '<td align=right>' . money_format("%!n", $xTotalEmpEsi) . '</td>'; 
  echo '<td align=right>' . money_format("%!n", $xGrandNetSalary-$xTotalEmpEpf-$xTotalEmpEsi) . '</td>'; 
  echo '</tr>';
?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	