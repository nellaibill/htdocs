<?php
ob_start ();
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['pfesiid'] ) && ! empty ( $_GET ['pfesiid'] )) {
	$no = $_GET ['pfesiid'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['pfesiid'] );
	} else {
		$xQry = "DELETE FROM employee_salary WHERE pfesiid= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		header ( 'Location: employee_salary.php' );
		// header("refresh:3;");
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 

else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xEmployeeName'] = '';
	$GLOBALS ['xSalary'] = '';
	$GLOBALS ['xGovernmentPay'] = '';
}
function findempname($xNo) {
	$result = mysql_query("SELECT *  FROM employeedetails where txno=$xNo") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$GLOBALS['xEmpName'] = $row['empname'];

	}
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(pfesiid)IS NULL OR max(pfesiid)= ''
   THEN '1'
   ELSE max(pfesiid)+1 END AS pfesiid
FROM employee_salary";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPfEsiId'] = $row ['pfesiid'];
	}
}
function DataFetch($xPfEsiId) {
	$result = mysql_query ( "SELECT *  FROM employee_salary where pfesiid=$xPfEsiId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xPfEsiId'] = $row ['pfesiid'];
		}
	}
}
function DataProcess($mode) {
	$xPfEsiId = $_POST ['f_pfesiid'];
	$xEmployeeNo = $_POST ['f_EmployeeNo'];
	$xSalary = $_POST ['f_salary'];
	$xGovernmentPay = $_POST ['f_governamentpay'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		
		$xQry = "INSERT INTO employee_salary(pfesiid,employeeno,salary,governmentpay)
		VALUES ($xPfEsiId,$xEmployeeNo,$xSalary,$xGovernmentPay)";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE employee_salary
		SET
		employeeno=$xEmployeeNo,salary=$xSalary,
		governmentpay=$xGovernmentPay WHERE pfesiid=$xPfEsiId";
	}
	// echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	GetMaxIdNo ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employer</title>
<script type="text/javascript">
function validateForm() {
	var xEmpName= document.forms["employerregistration"]["f_EmployeeName"].value;
	if (xEmpName== null || xEmpName== "") 
	{
	  alert("Employee Name must be filled out");
	  document.employerregistration.f_EmployeeName.focus();
	   return false;
	}
}
</script>
</head>

<body onload='document.employerregistration.f_EmployeeName.focus()'>
	<form class="form" name="employerregistration"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Increment Details</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">

						<div class="col-xs-2" style="display: none;">
							<label>No</label> <input type="text" class="form-control"
								id="f_pfesiid" name="f_pfesiid"
								value="<?php echo $GLOBALS ['xPfEsiId']; ?>" readonly>
						</div>

						<div class="col-xs-4">
							<label>Employee Name</label> <select class="form-control"
								name="f_EmployeeNo">
  <?php
		echo "<option value=''>CHOOSE EMPLOYEE HERE</option>";
		$dd_res = mysql_query ( "select * from employeedetails where empstatus='ACTIVE' and emppfno!=0 order by departmentno" );
		while ( $r = mysql_fetch_row ( $dd_res ) ) {
			echo "<option value='$r[0]'> $r[1] </option>";
		}
		?>


</select>



						</div>


						<div class="col-xs-2">
							<label>Salary</label> <input type="text" class="form-control"
								name="f_salary" value="<?php echo $GLOBALS ['xSalary']; ?>">
						</div>
						<div class="col-xs-2">
							<label>Government Pay</label> <input type="text"
								class="form-control" name="f_governamentpay"
								value="<?php echo $GLOBALS ['xGovernmentPay']; ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()"> 
	   <?php }  ?>
	</div>
			</div>

		</div>

	</form>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title"> REPORT
				
				</div>
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="10%">No</th>
							<th width="10%">EmployeeName</th>
							<th width="10%">Salary</th>
							<th width="10%">GovernemntPay</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from employee_salary";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . $row ['pfesiid'].  '</td>';
	findempname($row ['employeeno'] );
	echo '<td>' . $GLOBALS['xEmpName']. '</td>';
	echo '<td>' . $row ['salary'] . '</td>';
	echo '<td>' . $row ['governmentpay'] . '</td>';
	
	?>

							<td><a
								href="employee_salary.php<?php echo '?pfesiid='.$row['pfesiid']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

<?php
	echo '</tr>';
}

?>	

					
					
					
					
					
					
					
					
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>

	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<?php ob_end_flush(); ?>
</body>
</html>