<?php
ob_start ();
include 'globalfile.php';
function findempname($xNo) {
	$result = mysql_query("SELECT *  FROM employeedetails where txno=$xNo") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$GLOBALS['xEmpName'] = $row['empname'];

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
						<th width="5%">Government Pay</th>
						<th width="5%">EPF(12%)</th>
<th width="5%">EPF(1.61%)</th>
						<th width="5%">ESI(4.75%)</th>
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
						<th width="5%">Government Pay</th>
						<th width="5%">EPF(12%)</th>
<th width="5%">EPF(1.61%)</th>
						<th width="5%">ESI(4.75%)</th>
						<th width="5%">PF AND ESI</th>
						<th width="5%">PF-DIFF</th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
<?php
$xQry = '';
$xSlNo = 1;
$xGrandLitres = 0;
$xGrandTotal = 0;
$xGp12=0;
$xGp161=0;
$xGp475=0;
$today = date ( "Y-m-d" );

$xQry = "SELECT *  from employee_salary";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	findempname($row ['employeeno'] );

echo '<td>' .$xSlNo. '</td>';
$xSlNo+=1;
	echo '<td>' . $GLOBALS['xEmpName']. '</td>';
	echo '<td>' . $row ['salary'] . '</td>';
	$xHikeSalary = ($row ['salary'] * 15 / 100);
	echo '<td>' . $xHikeSalary . '</td>';
	echo '<td>' . round ( $row ['salary'] + $xHikeSalary ) . '</td>';
if(($row ['salary'] + $xHikeSalary )<$row ['governmentpay'])
{
echo '<td>' . round ( $row ['salary'] + $xHikeSalary ) * 12 / 100 . '</td>';
	echo '<td >' . round (( $row ['salary'] + $xHikeSalary ) * 1.75 / 100) . '</td>';
	echo '<td>' . round ( (($row ['salary'] + $xHikeSalary) * 12 / 100) + (($row ['salary'] + $xHikeSalary) * 1.75 / 100) ) . '</td>';
}
	
else
{
	echo '<td bgcolor=#FF0000></td>';
	echo '<td bgcolor=#FF0000></td>';
	echo '<td bgcolor=#FF0000></td>';
}
	echo '<td>' . $row ['governmentpay'] . '</td>';
	echo '<td>' . round ( $row ['governmentpay'] * 12 / 100 ) . '</td>';
$xGp12+=round ( $row ['governmentpay'] * 12 / 100 );
	echo '<td>' . round ( $row ['governmentpay'] * 1.61 / 100 ) . '</td>';
$xGp161+=round ( $row ['governmentpay'] * 1.61 / 100 );
	echo '<td>' . round ( $row ['governmentpay'] * 4.75 / 100 ) . '</td>';
$xGp475+=round ( $row ['governmentpay'] * 4.75 / 100 );
	echo '<td>' . round ( ($row ['governmentpay'] * 12 / 100) + ($row ['governmentpay'] * 4.75 / 100) ) . '</td>';

if(($row ['salary'] + $xHikeSalary )<$row ['governmentpay'])
{

		echo '<td>' . round (( ($row ['governmentpay'] * 12 / 100)  ) -( (($row ['salary'] + $xHikeSalary) * 12 / 100)  )) . '</td>';
$xGrandTotal+=round (( ($row ['governmentpay'] * 12 / 100)  ) -( (($row ['salary'] + $xHikeSalary) * 12 / 100)  ));


}
	
else
{
	echo '<td  >0.00</td>';
	
}

	
	echo '</tr>';
}

echo '<tr bgcolor=#00FF00;font-weight: bold;>';
echo '<td colspan=9></td>';

echo '<td>'.$xGp12.'</td>';
echo '<td>'.$xGp161.'</td>';
echo '<td>'.$xGp475.'</td>';
echo '<td>'.($xGp12 + $xGp475).'</td>';
echo '<td>'.$xGrandTotal.'</td>';
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