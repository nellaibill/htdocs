<?php
include 'config.php';
include 'globalfile.php';
$GLOBALS ['xCurrentDate']=date('Y-m-d');
/*$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];*/
$xEmpNo=$GLOBALS ['xEmpNo'];
$xStatus1=$GLOBALS ['xStatus'];
$xDepartmentNo=$GLOBALS['xDepartmentNo'];
?>
<html>
<title> VIEW -ATTENDENCE</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<!--<form action="hrm_hr003attendence.php" method="post">
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
              <th>Ref.No</th>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>STATUS</th>

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
if($xStatus1!=10)
{
$xQryFilter= $xQryFilter. ' ' . "and status=$xStatus1";
}

if($xDepartmentNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and a.departmentno=$xDepartmentNo";
}
if($xEmpNo=='0') 
{
    if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
$xQry=" SELECT a.txno AS txno, date, e.empname as empname, d.departmentname AS departmentname,status FROM `attendence` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =a.empno  and d.departmentno=a.departmentno and e.empstatus='ACTIVE'";
}
}
else
{
$xQry=" SELECT a.txno AS txno, date, e.empname as empname, d.departmentname AS departmentname,status FROM `attendence` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =$xEmpNo  AND e.txno = a.empno and d.departmentno=a.departmentno  and e.empstatus='ACTIVE' $xQryFilter";
}
$xQry.= $xQryFilter. ' ' . "order by date;";
//echo $xQry;
$result2=mysql_query($xQry);

if(mysql_num_rows($result2)){
    ?>
    <b><h3 class="panel-title text-center"><?php echo "Attendence Report Generated From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
    <?php
while ($row = mysql_fetch_array($result2)) {
if( $row['status']=='0'){
$xStatus='PRESENT';
}
if( $row['status']=='0.5'){
$xStatus='HALFDAY';
}
if( $row['status']=='1'){
$xStatus='LEAVE';
}

if( $row['status']=='2'){
$xStatus='ABSENT';
}

    echo '<tr>';
        echo '<td>' . $row['txno']  . '</td>';
    echo '<td>' . date('d-M-Y',strtotime($row['date']))  . '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
    echo '<td>' . $xStatus  . '</td>';
?>
<td width="5%"><a href="hrm_ht003attendence.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hrm_ht003attendence.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
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