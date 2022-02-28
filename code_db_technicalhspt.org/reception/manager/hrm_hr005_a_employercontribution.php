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
<b><h3 class="panel-title text-center"><?php echo "Employer Contribution FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
</div>
</div>


<div class="panel-body">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
           <th width="20%">S.NO</th>
           <th width="10%">PFNO</th>
           <th width="20%">ESINO</th>
           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="10%">BASIC</th>
           <th width="5%">D.A</th>
           <th width="5%">TOTAL</th>
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(3.25%)</th>
           <th width="10%">ALLOW</th>
                      <th width="5%">NETPAY</th>
          </tr>
      </thead>
      <tfoot>
        <tr>
           <th width="20%">S.NO</th>
           <th width="10%">PFNO</th>
           <th width="20%">ESINO</th>
           <th width="20%">EMPNAME</th>
           <th width="10%">DEPARTMENT</th>
           <th width="10%">BASIC</th>
           <th width="5%">D.A</th>
           <th width="5%">TOTAL</th>
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(3.25%)</th>
           <th width="10%">ALLOW</th>
                      <th width="5%">NETPAY</th>
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
     $xEmpAllowance=0;
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
    echo '<td>' . $row['emppfno']  . '</td>';
    echo '<td>' . $row['empesino']  . '</td>';
    findempname($row ['txno']);
    echo '<td>' . $GLOBALS ['xEmpName']  . '</td>';
    finddepartmentname($row ['departmentno']);
    echo '<td >' . $GLOBALS ['xEmpDepartment']  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empbasic'])  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empda']) . '</td>';
    $xTotalll=$row['emptotal']-$row['empallowance'];
    echo '<td align=right>' . money_format("%!n", $xTotalll)  . '</td>';
      $xEpfPercent=12;
      $xEsiPercent=3.25;
      $xEmpEpf=(($row['empbasic']+$row['empda'])/100)*$xEpfPercent;
      $xEmpEsi=($xTotalll/100)*$xEsiPercent;

    echo '<td align=right>' . money_format("%!n", $xEmpEpf)  . '</td>';
    echo '<td align=right>' . money_format("%!n", $xEmpEsi)  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empallowance'])  . '</td>';
    $xNetPay= $xTotalll-$xEmpEpf-$xEmpEsi+$row['empallowance'];
            echo '<td align=right>' . money_format("%!n", $xNetPay)  . '</td>';
    $xEmpBasic+=$row['empbasic'];
    $xEmpDa+=$row['empda'];
    $xEmpTotal+=$row['emptotal']-$row['empallowance'];
        $xEmpAllowance+=$row['empallowance'];
    $xTotalEmpEpf+=$xEmpEpf;
    $xTotalEmpEsi+=$xEmpEsi;
        $xEmpNetPay+=$xNetPay;
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
  echo '<td align=right>' . money_format("%!n",  $xTotalEmpEpf). ' </td>'; 
  echo '<td align=right>' . money_format("%!n", $xTotalEmpEsi) . '</td>'; 
    echo '<td align=right>' . money_format("%!n", $xEmpAllowance) . '</td>'; 
    echo '<td align=right>' . money_format("%!n", $xEmpNetPay) . '</td>'; 
  echo '</tr>';
?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	