<?php
include('globalfile.php');
$xFromDate1= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
$xToDate1= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));  
	$xFromDate=$GLOBALS ['xFromDate'];
	$xToDate=$GLOBALS ['xToDate'];  
?>
<html>
<title> V-Employee-Contribution</title>
<form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "Employee Contribution Generated FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
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
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(0.75%)</th>
           <th width="5%">NETPAY</th>
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
           <th width="5%">EPF(12%)</th>
           <th width="5%">ESI(0.75%)</th>
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
/*
$xQry="SELECT *  from employeedetails where emppfno!='' and txno in
(SELECT e.txno as empno
	FROM  `attendence` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate'
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') 
	GROUP BY empno) "; 
$xQry.= $xQryFilter. ' ' . " order by txno ;";
*/
$xQry="SELECT *  from employeedetails where emppfno!='' and txno in
(SELECT e.txno as empno
	FROM  `t_pfesi` as a , employeedetails AS e
	WHERE date >= '$xFromDate' AND date<= '$xToDate'
	AND e.txno = empno and (e.empdol>= '$xFromDate' or e.empstatus='ACTIVE') 
	GROUP BY empno) "; 
$xQry.= $xQryFilter. ' ' . " order by txno ;";
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
    echo '<td>' . $GLOBALS ['xEmpDepartment']  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empbasic'])  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['empda']) . '</td>';
    /*Removed As on 18th Aug
    echo '<td>' . money_format("%!n", $row['empallowance'])  . '</td>';
    echo '<td>' . money_format("%!n", $row['emphra'])  . '</td>';*/

$xTotal=0.00;
//$xTotal=$row['empbasic']+$row['empda']-$row['empallowance'];
$xTotal=$row['empbasic']+$row['empda'];
    echo '<td align=right>' . money_format("%!n",$xTotal )  . '</td>';

$xEpfPercent=12;
      $xEsiPercent=0.75;

 $xEmpEpf=(($xTotal)/100)*$xEpfPercent;
      $xEmpEsi=($xTotal/100)*$xEsiPercent;
    echo '<td align=right>' . money_format("%!n", $xEmpEpf)  . '</td>';
    echo '<td align=right>' . money_format("%!n", $xEmpEsi)  . '</td>';

//    echo '<td align=right>' . money_format("%!n", $row['empepf'])  . '</td>';
  //  echo '<td align=right>' . money_format("%!n", $row['empesi'])  . '</td>';
    $xNetPay=$xTotal-$xEmpEpf-$xEmpEsi;
    echo '<td>' . money_format("%!n", $xNetPay)  . '</td>';
    $xEmpBasic+=$row['empbasic'];
    $xEmpDa+=$row['empda'];
    $xEmpHra+=$row['emphra'];
    $xEmpTotal+=$xTotal;
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
  echo '<td align=right>' .money_format("%!n", round((($xEmpTotal)/100)*$xEpfPercent)). ' </td>'; 
  echo '<td align=right>' . money_format("%!n", round((($xEmpTotal)/100)*$xEsiPercent)) . '</td>'; 
  echo '<td align=right>' . money_format("%!n", round($xEmpNetPay)) . ' </td>';

  echo '</tr>';
?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	