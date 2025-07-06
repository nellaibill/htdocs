	
<?php
include ('config.php');
include ('globalfunctions.php');
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$GLOBALS ['xDatePEnt1'] = '';
?>
<title>Prescription </title>
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css">
table {
  border-spacing: 0;
}
th, td {
  border: 1px solid #000;
  padding: 0.5em 1em;
}
</style>

<body onload="window.print(); setTimeout(window.close, 0);"> 
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
<?php

				echo "<table width=100% border=1> ";
				echo "<tr>
		
			
				<td style='font-size: 30pt; font-family:Arial' align=center  colspan=2> <img src=images/logo.jpg
		width=70px height=60px>" . $GLOBALS ['xCompanyTitle'] . " </td>


		</tr>";		
				echo "<tr><td align=center style='font-size: 14pt; font-family:Arial' colspan=2> " . $GLOBALS ['xCompanyAddress1'] . " </td></tr>";
				echo "<tr><td align=center colspan=2>" . $GLOBALS ['xCompanyAddress2'] . " " . $GLOBALS ['xCompanyAddress3'] . " </td></tr>";
				echo "<tr><td align=left >" . $GLOBALS ['xCompanyContactNo'] . "   </td><td>" . $GLOBALS ['xCompanyGSTINNo'] . "</td></tr>";
				
				//echo "<tr><td align=center style='font-size: 20pt; font-family:Arial' > GSTIN No : " . $GLOBALS ['xCompanyGSTINNo'] . " </td></tr>";
				echo "</table>";
				?>


				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
			<?php 				echo "<table  width=100% border=1> "; ?>
					<thead>
						<tr>
							<th width="2%">Sl.No</th>
							<th width="5%">Date</th>
							<th width="5%">BillNo</th>
							
							<th width="10%">Doctor Name & Address</th>
							<th width="10%">PatientName/Address</th>
							<th width="20%">Drug Name</th>
							<th width="2%">Qty</th>
							<th width="10%">Batch</th>
							<th width="10%">ExpDate</th>
							<th width="10%">Manufacturer</th>
							<th width="10%">Sign of Pharmacist</th>
						</tr>
					</thead>

					<tbody>

<?php
function GetSalesEntry1Details($xSalesInvoiceNo) {
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1
			 where salesinvoiceno=" . $xSalesInvoiceNo ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		findcustomername ( $row ['customerno'] );
		$GLOBALS ['xDateSEnt1'] = $row ['date'];
		$GLOBALS ['xStatusSEnt1'] = $row ['termsofdelivery'];
		$GLOBALS ['xBillBySEnt1'] = $row ['salesperson_id'];
	}
}

function findUserName($xPassword) {
	$result = mysql_query ( "SELECT *  FROM m_login
			 where password='" . $xPassword ."'" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xUserName'] = $row ['username'];
	}
}
function checkSalesEntriesAvailable($xSalesInvoiceNo, $xFrom, $xTo) {
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1
			where salesinvoiceno=" . $xSalesInvoiceNo . " and
			date>='$xFrom' and date<='$xTo' " ) or die ( mysql_error () );
	$num_rows = mysql_num_rows ( $result );
	if ($num_rows >= 1) {
		return true;
	} else {
		return false;
	}
}
$xQry = '';
$xSlNo = 1;
$xGrandVat = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xVatValue = 0;
$xNetTotal = 0;
$xQryFilter = '';
if (isSet ( $_POST ['save'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	$xQry = "update config_inventory set fromdate='$xFromDate',todate='$xToDate'";
	mysql_query ( $xQry );
	header ( 'Location: inv_hr004_c_prescription_register.php' );
} else {
	$xFromDate = $GLOBALS ['xInvFromDate'];
	$xToDate = $GLOBALS ['xInvToDate'];
}
$xQry = "SELECT *  from inv_salesentry 
 order by salesinvoiceno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

if (mysql_num_rows ( $result2 )) {
	$xTempPatientId='';
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		
		finditemname ( $row ['itemno'] );
		$xSalesInvForTable = $row ['salesinvoiceno'];
		GetSalesEntry1Details ( $xSalesInvForTable );
		if (checkSalesEntriesAvailable ( $row ['salesinvoiceno'], $xFromDate, $xToDate )) {
			
			?>

 <?php
			
			fn_FindAccountLedgerDetails ( $row ['customerno'] );
			finditemname ( $row ['itemno'] );
			fn_FindDoctor(1);
			if ($row ['customerno'] != $xTempPatientId) {
				echo '<tr>';
				echo "<td style='color:blue; border-bottom-style: none;'>" . $xSlNo . "</td>";
				echo "<td style='color:blue; border-bottom-style: none;'>" . date ( 'd/M/y', strtotime ( $GLOBALS ['xDateSEnt1'] ) ) . "</td>";
				echo "<td style='color:blue; border-bottom-style: none;'>" . $row ['salesinvoiceno']   . "</td>";
			    echo "<td style='color:blue; border-bottom-style: none;'>" . $GLOBALS ['xDoctorName'] . "  Southern Heart Centre".  "</td>";
				echo "<td style='color:blue; border-bottom-style: none;'>" . $GLOBALS ['xAccountLedgerName']  . "</td>";
				echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
				echo '<td>' . $row ['qty'] . '</td>';
				echo '<td>' . $row ['batchid'] . '</td>';
				echo '<td>' . date ( 'd/m/y', strtotime ( $row ['dateexpired'] ) ) . '</td>';
				findUserName($GLOBALS ['xBillBySEnt1']);
				echo '<td>' . $GLOBALS ['xManufacturerName']  .'</td>';
				echo "<td style='color:blue; border-bottom-style: none;'></td>";
				echo '</tr>';
				$xTempPatientId = $row ['customerno'];
				$xSlNo += 1;
			} else {
				?>
				<tr>
					<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
					<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
					<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
					<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
					<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
				<?php
				echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
				echo '<td>' . $row ['qty'] . '</td>';
				echo '<td>' . $row ['batchid'] . '</td>';
				echo '<td>' . date ( 'd/m/y', strtotime ( $row ['dateexpired'] ) ) . '</td>';
				findUserName($GLOBALS ['xBillBySEnt1']);
				echo '<td>' . $GLOBALS ['xManufacturerName']  .'</td>';
				?>
						
				<td style='border-top-style: none;border-right-style: none;border-bottom-style: none;'></td>
				<?php
				echo '</tr>';
				$xTempPatientId = $row ['customerno'];	
			}	
		}
	}
} 

else {
	fn_NoDataFound ();
}

?>	

					
					
					
					</tbody>
				</table>

	
</div>
</body>