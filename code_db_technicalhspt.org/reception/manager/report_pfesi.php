	<?php 
	include 'globalfile.php';
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
<?php
$xQry = '';
$xSlNo = 0;
$xToday = date ( 'Y-m-d' );
if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
	
	$xQry="SELECT a.sno AS sno, date,esi,pf, e.empname as empname, d.departmentname AS departmentname FROM `t_pfesi` as a , employeedetails AS e ,m_department as d WHERE  e.txno=a.empno and d.departmentno=a.departmentno 
		and date<='$xToDate' 
	and date >='$xFromDate' 
	order by a.sno desc";

} 
else {
    	$xQry="SELECT a.sno AS sno, date,esi,pf, e.empname as empname, d.departmentname AS departmentname FROM `t_pfesi` as a , employeedetails AS e ,m_department as d WHERE  e.txno=a.empno and d.departmentno=a.departmentno 
	and date='$xToday'
	order by a.sno desc";
}
//echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';
?>
	<?php include 'customtable.html';?>
				<table class="table table-hover" border="1" id="example" width="100%">
      <thead>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>PF</th>
          <th>ESI</th>
          	<th  width="5%">EDIT</th>
								<th  width="5%">DELETE</th>
        </tr>
      </thead>
            <tfoot>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>PF</th>
          <th>ESI</th>
          	<th  width="5%">EDIT</th>
								<th  width="5%">DELETE</th>
        </tr>
      </tfoot>
      <tbody>

<?php

$result2=mysql_query($xQry);
//echo $xQry;
while ($row = mysql_fetch_array($result2)) {
echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
    echo '<td>' . $row['pf']  . '</td>';
    echo '<td>' . $row['esi']  . '</td>';
?>
<td width="5%"><a href="hrm_ht005_pfesi.php<?php echo '?sno='.$row['sno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hrm_ht005_pfesi.php<?php echo '?sno='.$row['sno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
echo '</tr>'; 
}

?>	
</tbody>
 </table>	
  </div><!-- /container -->
</div>
</body>
</html>