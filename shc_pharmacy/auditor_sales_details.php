<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
?>
<title>AUD-SALES</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading text-center">
		FILTER[GROUP]
			<div class="btn-group pull-right"></div>
		</div>
		<div class="panel-body">
			<div class="form-group">

				<div class="row">
                    <div class="col-xs-4">
						From Date:<input type="date" class="form-control"
							name="f_fromdate"
							value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
					</div>

					<div class="col-xs-4">
						To Date:<input type="date" class="form-control" name="f_todate"
							value="<?php echo $GLOBALS ['xInvToDate']; ?>">
					</div>

					<div class="col-xs-4">
						<input type="submit" name="save" class="btn btn-primary"
							value="VIEW">
					</div>

				</div>
				<br />
				<div class="row">
					<div class="col-xs-4">
						<input type="text" class="form-control" name="f_email">
					</div>
					<div class="col-xs-4">
						<input type="submit" name="sendmail" class="btn btn-primary"
							value="SEND REPROT TO AUDITOR">
					</div>
				</div>


			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Sales Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table" border="1">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Bill No</th>
							<th>Date</th>
							<th>Name Of the Party</th>
							<th>GSTIN</th>
							<th>Qty</th>
							<th>Price</th>
	<th>Product Value</th>
							<th>GST%</th>
							<th>GST Value</th>
							<th>Total</th>
							
						</tr>
					</thead>


					<tbody>

<?php
function SendMail($xEmailId, $xMessage) {
	require_once ('phpmailer/class.phpmailer.php');
	
	$mail = new PHPMailer ();
	$mail->CharSet = "utf-8";
	$mail->IsSMTP ();
	$mail->SMTPAuth = true;
	$mail->Username = "testtcssnellai@gmail.com";
	$mail->Password = "nellaitcss";
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "465";
	
	$mail->setFrom ( 'testtcssnellai@gmail.com', ' QrCode' );
	$mail->AddAddress ( $xEmailId, 'TCSS' );
	
	$mail->Subject = 'QR CODE VERIFICATION';
	$mail->IsHTML ( true );
	$mail->Body = 'Welcome Check QrCode By the Link' . $xMessage;
	
	if ($mail->Send ()) {
		echo "Qr Code  Successfully Send :)";
	} else {
		echo "Mail Error - >" . $mail->ErrorInfo;
	}
}
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xVatValue = 0;
$xNetTotal = 0;
$xQryFilter = '';
$xVatZeroValue=0;
$xVatFiveValue=0;
$xVatTwelveValue=0;
$xVatEighteenValue=0;
$xVatTwentyEightValue=0;

$xVatItemZeroValue=0;
$xVatItemFiveValue=0;
$xVatItemTwelveValue=0;
$xVatItemEighteenValue=0;
$xVatItemTwentyEightValue=0;


if (isSet ( $_POST ['save'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	$xQry = "update config_inventory set fromdate='$xFromDate',todate='$xToDate'";
	mysql_query ( $xQry );
	header ( 'Location: auditor_sales_details.php' );
} else if (isSet ( $_POST ['sendmail'] )) {
	$xEmail = $_POST ['f_email'];
	$xMessage="Welcome";
	SendMail ( $xEmail, $xMessage );
} else {
	$xFromDate = $GLOBALS ['xInvFromDate'];
	$xToDate = $GLOBALS ['xInvToDate'];
}

$xQry = "SELECT *
from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'
and customerno>0
 and salesinvoiceno>0 order by salesinvoiceno";

// $xQry="SELECT itemno,batchid,salesinvoiceno,date, qty,unitrate,patientid
// from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate' order by salesinvoiceno";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

if (mysql_num_rows ( $result2 )) {
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		finditemname ( $row ['itemno'] );
		// fn_PatientDetails($row['patientid']);
		// findsuppliername($row['supplierno']);
		findcustomername ( $row ['customerno'] );
		finditempricevat ( $row ['itemno'], $row ['batchid'] )?>
 <tr>
 <?php
		
		$xItemVat = $row ['vat'];
		echo '<td>' . $xSlNo . '</td>';
		echo '<td>' . $row ['salesinvoiceno'] . '</td>';
		echo '<td>' . date ( 'd/M/y', strtotime ( $row ['date'] ) ) . '</td>';
		echo '<td>' . $GLOBALS ['xCustomerName'] . '</td>';
		echo '<td>' . $GLOBALS ['xCustomerGSTINNo'] . '</td>';
		echo '<td align=right>' . $row ['qty'] . '</td>';
		$xQty=$row ['qty'];
		//$xUnitMrp=$row ['unitmrp'];
			$xDiscountDiscountPercentage=$row ['discountpercentage'];
			$xUnitRate=$row ['unitrate'];
			if($xDiscountDiscountPercentage==50.00)
			{
				$xUnitRate=$xUnitRate/2;
			}
			if($xDiscountDiscountPercentage==100.00)
			{
				$xUnitRate=0;
			}
		$xInvoiceItemValue = $xQty*$xUnitRate;
		$xItemVatValue= $xInvoiceItemValue * ($xItemVat / 100) ;
		//echo '<td align=right>' . fn_RupeeFormat ( $xInvoiceItemValue-$xItemVatValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xUnitRate ) . '</td>';
				echo '<td align=right>' . $xQty*$xUnitRate . '</td>';
		echo '<td align=right>' . $row ['vat'] . '</td>';

		echo '<td align=right>' . $xItemVatValue. '</td>';
		if($row ['vat']==0.00)
		{
			$xVatZeroValue+=$xItemVatValue;
			$xVatItemZeroValue+=$xInvoiceItemValue;
		}
		if($row ['vat']==5.00)
		{
			$xVatFiveValue+=$xItemVatValue;
			$xVatItemFiveValue+=$xInvoiceItemValue;
		}
		if($row ['vat']==12.00)
		{
			$xVatTwelveValue+=$xItemVatValue;
			$xVatItemTwelveValue+=$xInvoiceItemValue;
		}
			if($row ['vat']==18.00)
		{
			$xVatEighteenValue+=$xItemVatValue;
						$xVatItemEighteenValue+=$xInvoiceItemValue;
		}
		
			if($row ['vat']==28.00)
		{
			$xVatTwentyEightValue+=$xItemVatValue;
				$xVatItemTwentyEightValue+=$xInvoiceItemValue;
		}
		$xNetTotal =  $xInvoiceItemValue+$xItemVatValue;
		echo '<td align=right>' . fn_RupeeFormat ( $xNetTotal ) . '</td>';
		$xGrandTotal += $xInvoiceItemValue;
		$xGrandVat += $xInvoiceItemValue * ($xItemVat / 100);
		$xGrandNetTotal += $xNetTotal;
		$xOldSalesInvoiceNo = $row ['salesinvoiceno'];
	}
	echo '</tr>';
echo '<tr>';
	echo '<td colspan=7> TOTAL .  </td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '<td></td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandVat ) . '</td>';
	
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandNetTotal ) . '</td>';
	
	echo '</tr>';
			echo '<tr>';
	echo '<td colspan=6> .  </td>';
		echo '<td align=right>PRODUCT VALUE</td>';
	echo '<td align=right>CGST</td>';
	echo '<td align=right>SGST</td>';
	echo '<td align=right>TAX-TOTAL</td>';
	echo '<td align=right>GROSS-TOTAL</td>';
	echo '</tr>';
			echo '<tr>';

			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE 0 %  </td>';
			echo '<td align=right>' . fn_RupeeFormat ( $xVatItemZeroValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatZeroValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatZeroValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatZeroValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatItemZeroValue+$xVatZeroValue ) . '</td>';
	echo '</tr>';
			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE 5 % .  </td>';
			echo '<td align=right>' . fn_RupeeFormat ( $xVatItemFiveValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatFiveValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatFiveValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatFiveValue ) . '</td>';
				echo '<td align=right>' . fn_RupeeFormat ( $xVatItemFiveValue+$xVatFiveValue ) . '</td>';
	echo '</tr>';
			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE 12 % .  </td>';
				echo '<td align=right>' . fn_RupeeFormat ( $xVatItemTwelveValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatTwelveValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatTwelveValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatTwelveValue ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatItemTwelveValue+$xVatTwelveValue ) . '</td>';
	echo '</tr>';
			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE 18 % .  </td>'; 
				echo '<td align=right>' . fn_RupeeFormat ( $xVatItemEighteenValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatEighteenValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatEighteenValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatEighteenValue ) . '</td>';
					echo '<td align=right>' . fn_RupeeFormat ( $xVatItemEighteenValue +$xVatEighteenValue). '</td>';
	echo '</tr>';
			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE 28 % .  </td>';
				echo '<td align=right>' . fn_RupeeFormat ( $xVatItemTwentyEightValue ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xVatTwentyEightValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatTwentyEightValue/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatTwentyEightValue ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xVatItemTwentyEightValue+$xVatTwentyEightValue ) . '</td>';
	echo '</tr>';
	
			echo '<tr>';
	echo '<td colspan=6 align=right> TAX RATE TOTAL.  </td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandVat/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandVat/2 ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandVat ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ($xGrandTotal+ $xGrandVat ) . '</td>';
	echo '</tr>';
			echo '<tr>';
} 

else {
	fn_NoDataFound ();
}

?>	

					
					</tbody>
				</table>

			</div>
			<!-- /container -->
		</div>
	</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
