<?php
ob_start ();
include 'globalfile.php';
function findempname($xNo) {
	$result = mysql_query ( "SELECT *  FROM employeedetails where txno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xEmpName'] = $row ['empname'];
	}
}
?>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

<div id="divToPrint">
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">REPORT</h3>
			</div>
			<table class="table table-hover" border="1">
				<thead>
					<tr>
						<th width="5%">S.NO</th>
						<th width="5%">EMPNAME</th>
						<th width="5%">OLD</th>
						<th width="5%">HIKE (15%)</th>
						<th width="5%">SALARY</th>
						<th width="5%">PF(12%)</th>
						<th width="5%">ESI(1.75%)</th>
						<th width="5%">PF&ESI</th>
						<th width="5%">NET SALARY</th>
						<th width="5%">Government Pay</th>
						<th width="5%">EPF(12%)</th>
						<th width="5%">ESI(1.75%)</th>
						<th width="5%">PF AND ESI</th>
						<th width="5%">PF-DIFF</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th width="5%">S.NO</th>
						<th width="5%">EMPNAME</th>
						<th width="5%">OLD</th>
						<th width="5%">HIKE (15%)</th>
						<th width="5%">SALARY</th>
						<th width="5%">PF(12%)</th>
						<th width="5%">ESI(1.75%)</th>
						<th width="5%">PF&ESI</th>
						<th width="5%">NET SALARY</th>
						<th width="5%">Government Pay</th>
						<th width="5%">EPF(12%)</th>
						<th width="5%">ESI(1.75%)</th>
						<th width="5%">PF AND ESI</th>
						<th width="5%">PF-DIFF</th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
<?php
$xQry = '';
$xSlNo = 1;
$xGrandOldSalary = 0;
$xHikeSalary=0;
$xGrandHikePercentageSalary = 0;
$xGrandHikeSalary=0;

$xGHikeSalaryPf=0;
$xGHikeSalaryEsi=0;

$xGrandNetSalary=0;

$xGovernmentSalary=0;
$xGovernmentPf=0;
$xGovernmentEsi=0;
$xPfDifference=0;
$today = date ( "Y-m-d" );

$xQry = "SELECT *  from employee_salary";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	findempname ( $row ['employeeno'] );
	
	echo '<td>' . $xSlNo . '</td>';
	$xSlNo += 1;
	echo '<td>' . $GLOBALS ['xEmpName'] . '</td>';
	
	echo '<td>' . $row ['salary'] . '</td>';
	$xGrandOldSalary += $row ['salary'];
	
	$xHikePercentageSalary = ($row ['salary'] * 15 / 100);
	$xGrandHikePercentageSalary += $xHikePercentageSalary;
	echo '<td>' . $xHikePercentageSalary . '</td>';
	
	$xHikeSalary=round ( $row ['salary'] + $xHikePercentageSalary );
	echo '<td>' . $xHikeSalary . '</td>';
	$xGrandHikeSalary+=$xHikeSalary;
	
	echo '<td>' . $xHikeSalary * 12 / 100 . '</td>';
	$xGHikeSalaryPf+=$xHikeSalary * 12 / 100;
	
	echo '<td >' . round ( $xHikeSalary * 1.75 / 100 ) . '</td>';
	$xGHikeSalaryEsi+=round ( $xHikeSalary * 1.75 / 100 ) ;
	echo '<td>' . round ( ($xHikeSalary * 12 / 100) + ($xHikeSalary * 1.75 / 100) ) . '</td>';
	
	echo '<td>' . round ( $xHikeSalary - (($xHikeSalary * 12 / 100) + ($xHikeSalary * 1.75 / 100)) ) . '</td>';
	$xGrandNetSalary+=round ( $xHikeSalary - (($xHikeSalary * 12 / 100) + ($xHikeSalary * 1.75 / 100)) );
	echo '<td>' . $row ['governmentpay'] . '</td>';
	$xGovernmentSalary+=$row ['governmentpay'];
	echo '<td>' . round ( $row ['governmentpay'] * 12 / 100 ) . '</td>';
	$xGovernmentPf += round ( $row ['governmentpay'] * 12 / 100 );
	
	echo '<td>' . round ( $row ['governmentpay'] * 1.75 / 100 ) . '</td>';
	$xGovernmentEsi += round ( $row ['governmentpay'] * 4.75 / 100 );
	echo '<td>' . round ( ($row ['governmentpay'] * 12 / 100) + ($row ['governmentpay'] * 1.75 / 100) ) . '</td>';
	
	echo '<td>' . round ( (($xHikeSalary * 12 / 100) + ($xHikeSalary * 1.75 / 100)) - (($row ['governmentpay'] * 12 / 100) + ($row ['governmentpay'] * 1.75 / 100)) ) . '</td>';
	$xPfDifference+=round ( (($xHikeSalary * 12 / 100) + ($xHikeSalary * 1.75 / 100)) - (($row ['governmentpay'] * 12 / 100) + ($row ['governmentpay'] * 1.75 / 100)) );
	echo '</tr>';
}

echo '<tr bgcolor=#00FF00;font-weight: bold;>';
echo '<td colspan=2></td>';
echo '<td>' . $xGrandOldSalary . '</td>';
echo '<td>' . $xGrandHikePercentageSalary . '</td>';
echo '<td>' . $xGrandHikeSalary . '</td>';
echo '<td>' . $xGHikeSalaryPf . '</td>';
echo '<td>' . $xGHikeSalaryEsi . '</td>';
echo '<td>' . ($xGHikeSalaryPf+$xGHikeSalaryEsi). '</td>';

echo '<td>' . $xGrandNetSalary . '</td>';
echo '<td>' . $xGovernmentSalary . '</td>';
echo '<td>' . $xGovernmentPf . '</td>';
echo '<td>' . $xGovernmentEsi . '</td>';
echo '<td>' . ($xGovernmentPf+$xGovernmentEsi). '</td>';
echo '<td>' . $xPfDifference . '</td>';

?>	

					<?php ob_end_flush(); ?>
</body>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</html>
