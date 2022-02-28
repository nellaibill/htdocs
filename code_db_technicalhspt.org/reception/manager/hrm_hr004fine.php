<?php
include 'config.php';
include 'globalfile.php';
$GLOBALS ['xCurrentDate']=date('Y-m-d');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$xEmpNo=$GLOBALS ['xEmpNo'];
?>
<html>
<title> VIEW -FINE</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<!--<form action="hrm_hr004fine.php" method="post">
<p style="color:blue;text-align:right;font-weight: bold;">
</p>
</form>-->
	<?php 
	$xToday = date ( 'Y-m-d' );
	$xFromDate =$xToday;
	$xToDate = $xToday;
	?>
<form class="form" name="report_expenses"
	action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-body">
<div class="container">
<table class="table table-condensed" border="1" >
      <thead>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>AMOUNT</th>
          <th>DETAILS</th>

       </tr>
      </thead>
      <tbody>

<?php
$xLeaveCount=2;
$xLeaveIncentive=0;
$xDeductions=0;
$xOtherIncentive=0;
$xTotalSalary=0;
$xStatus='';
$xQry='';
$xQryFilter='';
if($xEmpNo=='0') 
{
    $xToday = date ( 'Y-m-d' );
if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
	
$xQry=" SELECT t.txno AS txno, date,fineamount,finedescription, e.empname as empname, d.departmentname AS departmentname FROM `t_finedetails` as t , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =t.employeeno  and d.departmentno=t.departmentno ";
}
}
else
{
$xQry=" SELECT t.txno AS txno, date,fineamount,finedescription, e.empname as empname, d.departmentname AS departmentname FROM `t_finedetails` as t , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =$xEmpNo  AND e.txno = t.employeeno  and d.departmentno=t.departmentno $xQryFilter";
}
$xQry.= $xQryFilter. ' ' . "order by txno;";
$result2=mysql_query($xQry);


if(mysql_num_rows($result2)){
    ?>
<b><h3 class="panel-title text-center"><?php echo "FINE REPORT GENERATED  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
<?php
while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    echo '<td>' . date('d-M-Y',strtotime($row['date']))  . '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
    echo '<td>' . $row['fineamount']  . '</td>';
    echo '<td>' . $row['finedescription']  . '</td>';
?>
<td width="5%"><a href="hrm_ht004fine.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hrm_ht004fine.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
    echo '</tr>';
}
}

else 
 {     
    fn_NoDataFound();
 }
?>	
</tbody>
    </table>	
  </div>
</div>
</div>
</div>
</body>
</form></html>	