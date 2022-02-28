<?php
include('globalfile.php');
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
<!--       <th width="30%">NAME</th>-->
           <th width="10%">Month/Year</th>
           <th width="10%">BASIC</th>
           <th width="10%">DA</th>
           <th width="10%">TOTAL</th>
           <th width="10%">PF</th>
           <th width="10%">ESI</th>          
          </tr>
      </thead>
     
      <tbody>

<?php

function findempdetails($xNo) {
  $result = mysql_query("SELECT *  FROM employeedetails where txno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xEmpName'] = $row['empname'];
    $GLOBALS['xEmpBasic'] = $row['empbasic'];
        $GLOBALS['xEmpDa'] = $row['empda'];
         $GLOBALS['xEmpTotal'] = $row['emptotal'];
          $GLOBALS['xEmpAllowance'] = $row['empallowance']; 
  }
}
$xTempYearMonth='';
$xSlNo=0;
$xGEmpBasic=0;
$xGEmpDa=0;
$xGTotal=0;
$xGEpf=0;
$xGEsi=0;

    $xGGEmpBasic=0;
    $xGGEmpDa=0;
    $xGGTotal=0;
    $xGGEpf=0;
    $xGGEsi=0;
	
$xQry="SELECT empno,date, YEAR(date) as year, MONTHNAME(date) as month FROM t_pfesi WHERE date BETWEEN '$xFromDate' AND '$xToDate' group by date,empno ORDER BY date ASC ";
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
$xYearMonth=$row['month']."/".$row['year'] ;
if($xYearMonth!=$xTempYearMonth && $xSlNo>0)
{
    echo '<tr>';
	echo '<td>' . $xTempYearMonth . '</td>';
    echo '<td>' . money_format("%!n", $xGEmpBasic) . '</td>';
    echo '<td>' . money_format("%!n", $xGEmpDa ). '</td>';
    echo '<td>' . money_format("%!n", $xGTotal) . '</td>';
    echo '<td>' . money_format("%!n", $xGEpf)  . '</td>';
    echo '<td>' . money_format("%!n", $xGEsi)   . '</td>';
	
	$xGGEmpBasic+=$xGEmpBasic;
    $xGGEmpDa+=$xGEmpDa;
    $xGGTotal+=$xGTotal;
    $xGGEpf+=$xGEpf;
    $xGGEsi+=$xGEsi;
	
    $xGEmpBasic=0;
    $xGEmpDa=0;
    $xGTotal=0;
    $xGEpf=0;
    $xGEsi=0;
    echo '</tr>'; 
}

    $xSlNo+=1;
    $xTempYearMonth=$xYearMonth;
    findempdetails($row ['empno']);
    echo '<tr style=display:none;>';
    echo '<td>' . $GLOBALS ['xEmpName']  . '</td>';
    echo '<td>' . $xYearMonth .'</td>';
    echo '<td>' . $GLOBALS ['xEmpBasic']  . '</td>';
    $xGEmpBasic+=$GLOBALS ['xEmpBasic'] ;
    echo '<td>' . $GLOBALS ['xEmpDa']  . '</td>';
    $xGEmpDa+=$GLOBALS ['xEmpDa'] ;
    $xTotalll= $GLOBALS['xEmpTotal'] -$GLOBALS['xEmpAllowance'];
    $xGTotal+=$xTotalll;
    echo '<td align=right>' . money_format("%!n", $xTotalll)  . '</td>';
    $xEpfPercent=13.61;
    $xEsiPercent=4.75;
    $xEmpEpf=(($GLOBALS ['xEmpBasic']+$GLOBALS ['xEmpDa'])/100)*$xEpfPercent;
    $xEmpEsi=($xTotalll/100)*$xEsiPercent;
    echo '<td align=right>' . money_format("%!n", $xEmpEpf)  . '</td>';
    $xGEpf+=$xEmpEpf;
    echo '<td align=right>' . money_format("%!n", $xEmpEsi)  . '</td>';
    $xGEsi+=$xEmpEsi;
    echo '</tr>'; 
 
}
		echo '<tr>';
        echo '<td>' . $xTempYearMonth . '</td>';
        echo '<td>' . money_format("%!n", $xGEmpBasic) . '</td>';
        echo '<td>' . money_format("%!n", $xGEmpDa ). '</td>';
        echo '<td>' . money_format("%!n", $xGTotal) . '</td>';
        echo '<td>' . money_format("%!n", $xGEpf)  . '</td>';
        echo '<td>' . money_format("%!n", $xGEsi)   . '</td>';
        
        	$xGGEmpBasic+=$xGEmpBasic;
    $xGGEmpDa+=$xGEmpDa;
    $xGGTotal+=$xGTotal;
    $xGGEpf+=$xGEpf;
    $xGGEsi+=$xGEsi;
        $xGEmpBasic=0;
        $xGEmpDa=0;
        $xGTotal=0;
        $xGEpf=0;
        $xGEsi=0;
    echo '</tr>'; 
	
	echo '<tr>';
        echo '<td>GRAND TOTAL</td>';
        echo '<td>' . money_format("%!n", $xGGEmpBasic) . '</td>';
        echo '<td>' . money_format("%!n", $xGGEmpDa ). '</td>';
        echo '<td>' . money_format("%!n", $xGGTotal) . '</td>';
        echo '<td>' . money_format("%!n", $xGGEpf)  . '</td>';
        echo '<td>' . money_format("%!n", $xGGEsi)   . '</td>';
    $xGGEmpBasic=0;
    $xGGEmpDa=0;
    $xGGTotal=0;
    $xGGEpf=0;
    $xGGEsi=0;
    echo '</tr>'; 

?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	