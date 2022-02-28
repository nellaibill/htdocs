<?php
include('globalfile.php');
//$xFromDate= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
//$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));  
	$xFromDate=$GLOBALS ['xFromDate'];
	$xToDate=$GLOBALS ['xToDate']; 
?>
<html>
<title> V-Employee-Salary</title>
<form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "Contribution Deifference FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
</div>
</div>


<div class="panel-body">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
           <th width="10%">S.NO</th>

           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="10%">CURRENT SALARY</th>
 <th width="10%">HIKE (15%)</th>
 <th width="10%">HIKE TOTAL</th>
 <th width="10%">PF(12%)</th>
 <th width="10%">ESI(1.75%)</th>
 <th width="10%">PF AND ESI</th>
           <th width="5%">Government Pay</th>
           <th width="5%">EPF(13.61%)</th>
           <th width="5%">ESI(4.75%)</th>
          </tr>
      </thead>
      <tfoot>
        <tr>
            <th width="20%">S.NO</th>
           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="5%">TOTAL</th>
           <th width="5%">EPF(13.61%)</th>
           <th width="5%">ESI(4.75%)</th>
          </tr>
      </tfoot>
      <tbody>

<?php
$xQryFilter='';
    $xEmpBasic=0;
    $xEmpDa=0;;
    $xEmpAllowance=0;
    $xEmpHra=0;
    $xEmpTotal=0;
    $xEmpEpf=0;
    $xEmpEsi=0;
    $xEmpNetPay=0;
    $xSlNo=0;

$xHikeSalary=0;
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

$xQry="SELECT *  from employeedetails where emppfno!='' and txno in
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
    findempname($row ['txno']);
    echo '<td>' . $GLOBALS ['xEmpName']  . '</td>';
    finddepartmentname($row ['departmentno']);
    echo '<td >' . $GLOBALS ['xEmpDepartment']  . '</td>';
  echo '<td align=right>' . $row['empbasicsalary']  . '</td>';

$xHikeSalary=$row['empbasicsalary']+($row['empbasicsalary']*15/100);
  echo '<td align=right>' . ($row['empbasicsalary']*15/100). '</td>';

  echo '<td align=right>' . $xHikeSalary. '</td>';
  echo '<td align=right>' . round($xHikeSalary*0.12). '</td>';
  echo '<td align=right>' . round($xHikeSalary*0.00175). '</td>';
  echo '<td align=right>' . round($xHikeSalary*0.1375). '</td>';
    echo '<td align=right>' . money_format("%!n", $row['emptotal'])  . '</td>';
      $xEpfPercent=13.61;
      $xEsiPercent=4.75;
      $xEmpEpf=(($row['empbasic']+$row['empda'])/100)*$xEpfPercent;
      $xEmpEsi=($row['emptotal']/100)*$xEsiPercent;

    echo '<td align=right>' . money_format("%!n", $xEmpEpf)  . '</td>';
    echo '<td align=right>' . money_format("%!n", $xEmpEsi)  . '</td>';
    $xNetPay= $row['emptotal']-$xEmpEpf-$xEmpEsi;
    $xEmpBasic+=$row['empbasic'];
    $xEmpDa+=$row['empda'];
    $xEmpAllowance+=$row['empallowance'];
    $xEmpTotal+=$row['emptotal'];
    $xTotalEmpEpf+=$xEmpEpf;
    $xTotalEmpEsi+=$xEmpEsi;
echo '</tr>'; 
}

  echo '<tr style=font-weight:bold;>';
  echo '<td>  </td>'; 
 
  echo '<td colspan=2> GRAND -TOTAL </td>'; 
  echo '<td align=right>' . money_format("%!n", round($xEmpTotal)) . ' </td>';
  echo '<td align=right>' . money_format("%!n",  $xTotalEmpEpf). ' </td>'; 
  echo '<td align=right>' . money_format("%!n", $xTotalEmpEsi) . '</td>'; 
  echo '</tr>';
?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	