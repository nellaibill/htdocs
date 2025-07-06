<table>
	<tr>

		<td width="80%" align="center"><b><font size="4">BARANI DATA SOLUTIONS
					PVT LTD</font></b><br> No 237,Prabhu Complex<br> Tiruchendur Main
			Road,M.K.P Nagar<br> Palayamkottai Tirunelveli-627002<br>Phone :
			0462-2584848<br>GSTIN : 33AAGCB3609R1ZE</td>
		<td width="20%"><img src="images/baranilogo.png" height="82"
			width="150"></td>
	</tr>
</table><hr>

<?php
require_once 'globalfile.php';
// taking number as parameter
function convert_digit_to_words($no) {
	
	// creating array of word for each digit
	$words = array (
			'0' => 'Zero',
			'1' => 'one',
			'2' => 'two',
			'3' => 'three',
			'4' => 'four',
			'5' => 'five',
			'6' => 'six',
			'7' => 'seven',
			'8' => 'eight',
			'9' => 'nine',
			'10' => 'ten',
			'11' => 'eleven',
			'12' => 'twelve',
			'13' => 'thirteen',
			'14' => 'fourteen',
			'15' => 'fifteen',
			'16' => 'sixteen',
			'17' => 'seventeen',
			'18' => 'eighteen',
			'19' => 'nineteen',
			'20' => 'twenty',
			'30' => 'thirty',
			'40' => 'forty',
			'50' => 'fifty',
			'60' => 'sixty',
			'70' => 'seventy',
			'80' => 'eighty',
			'90' => 'ninty',
			'100' => 'hundred',
			'1000' => 'thousand',
			'100000' => 'lac',
			'10000000' => 'crore' 
	);
	// $words = array('0'=> '0' ,'1'=> '1' ,'2'=> '2' ,'3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','30' => '30','40' => '40','50' => '50','60' => '60','70' => '70','80' => '80','90' => '90','100' => '100','1000' => '1000','100000' => '100000','10000000' => '10000000');
	
	// for decimal number taking decimal part
	
	$cash = ( int ) $no; // take number wihout decimal
	$decpart = $no - $cash; // get decimal part of number
	
	$decpart = sprintf ( "%01.2f", $decpart ); // take only two digit after decimal
	
	$decpart1 = substr ( $decpart, 2, 1 ); // take first digit after decimal
	$decpart2 = substr ( $decpart, 3, 1 ); // take second digit after decimal
	
	$decimalstr = '';
	
	// if given no. is decimal than preparing string for decimal digit's word
	
	if ($decpart > 0) {
		$decimalstr .= "point " . $numbers [$decpart1] . " " . $numbers [$decpart2];
	}
	
	if ($no == 0)
		return ' ';
	else {
		$novalue = '';
		$highno = $no;
		$remainno = 0;
		$value = 100;
		$value1 = 1000;
		while ( $no >= 100 ) {
			if (($value <= $no) && ($no < $value1)) {
				$novalue = $words ["$value"];
				$highno = ( int ) ($no / $value);
				$remainno = $no % $value;
				break;
			}
			$value = $value1;
			$value1 = $value * 100;
		}
		if (array_key_exists ( "$highno", $words )) // check if $high value is in $words array
			return $words ["$highno"] . " " . $novalue . " " . convert_digit_to_words ( $remainno ) . $decimalstr; // recursion
		else {
			$unit = $highno % 10;
			$ten = ( int ) ($highno / 10) * 10;
			return $words ["$ten"] . " " . $words ["$unit"] . " " . $novalue . " " . convert_digit_to_words ( $remainno ) . $decimalstr; // recursion
		}
	}
}

function SendMail($xEmailId, $xMessage) {
	require_once ('phpmailer/class.phpmailer.php');
	
	$mail = new PHPMailer ();
	$mail->CharSet =  "utf-8";
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "testtcssnellai@gmail.com";
	$mail->Password = "nellaitcss";
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "465";

	$mail->setFrom('testtcssnellai@gmail.com', ' Johnson Steels');
	$mail->AddAddress($xEmailId, 'TCSS');

	$mail->Subject  =  'BARANI ';
	$mail->IsHTML(true);
	$mail->Body    = '' .$xMessage;

	if($mail->Send())
	{
		//echo "Mail  Successfully Send :)";
	}
	else
	{
		echo "Mail Error - >".$mail->ErrorInfo;
	}
}

$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xSalesInvoiceNoForPrint=0;
$result = mysqli_query ( $con, "SELECT *  FROM inv_sales WHERE salesinvoiceno=".$xSalesInvoiceNo ) or die ( mysqli_error ( $con ) );
if ($row = mysqli_fetch_array ( $result )) {

	$xDate = $row ['date'];
	$xItemName = $row ['itemname'];
	$xParticulars = $row ['particulars'];
	$xPoNo = $row ['po_no'];
	$xQty = $row ['qty'];
	$xUnitRate = $row ['unitrate'];
	$xTotalAmount=$row ['totalamount'];
	$xSalesInvoiceNoForPrint=$row ['print_bill_no'];
	$xTax=$xTotalAmount-($xTotalAmount/1.18);
	
	$CGST=$xTax/2;
		$SGST=$xTax/2;
	
$xUnitAmount=$xTotalAmount-($CGST+$SGST);
	
	//$xRoundOff=$xTotalAmount-(fn_RupeeFormat($CGST)+fn_RupeeFormat($SGST)+fn_RupeeFormat($xUnitAmount));
	



//$xTotal=$xAmount+$CGST+$SGST+$xRoundOff;

findcustomername ($row['customerno']);
$xCustomerName=$GLOBALS ['xCustomerName'];
$xCustomerAddress=$GLOBALS ['xCustomerAddress'];
$xCustomerMobileNo=$GLOBALS ['xCustomerMobileNo'];
$xCustomerGstNo=$GLOBALS ['xCustomerGstNo'];
if($xPoNo=="")
{
	$table = '
		<table border="0"  width="100%">

		<tr >
			<td width="70%" align="left"> '
. $xCustomerName  .' <BR>
	'.$xCustomerAddress.'<br>
		Gst No :'.$xCustomerGstNo.'<br>
		Mobile No :'.$xCustomerMobileNo.'

						</td>
			
					<td  width="30%" align="right"> 
					Bill  No : BDS - ' . $xSalesInvoiceNoForPrint . ' <br>
					Bill Date : ' .date("d/M/Y", strtotime($xDate)) . '	
			</td>
		</tr>	
</table>
			<hr>
		<table width="100%" >
			<tr><td width="40%">Description</td><td width="40%" align="left">Period</td><td align="left">Days</td><td align="right">Amount</td></tr>
			</table>
			<hr >
			<table width="100%">
						<tr><td width="40%">'.$xItemName.'</td>
					<td width="40%" align="left">'.$xParticulars.'</td>
								<td width="10%" align="left">'.$xQty.'</td><td width="10%" align="right">'.fn_RupeeFormat($xUnitAmount).'</td></tr>		
		</table>
			<br>	<table width="100%">
	<tr><td width="40%"></td><td width="40%" align="right"> CGST 9%</td><td width="10%"></td><td width="10%" align="right">'.fn_RupeeFormat($CGST).'</td></tr>	
							<tr><td></td><td align="right"> SGST 9%</td><td></td><td align="right">'.fn_RupeeFormat($SGST).'</td></tr>	
	
								<tr><td></td><td align="right"> TOTAL </td><td></td><td align="right">'.fn_RupeeFormat($xTotalAmount).'</td></tr>

							</table>
							<hr>
							<table width="100%">
			<tr><td width="50%">'. ucwords(convert_digit_to_words($xTotalAmount)).' Only</td>
									<td width="50%" align="right"> For BARANI DATA SOLUTIONS PVT LTD </td>
									</tr>
				</table>
									<table width="100%">
							
								<tr><td align="left" width="80%" >Company & Bank Details 
										<br>Name :BARANI DATA SOLUTIONS PVT LTD
										<br>Bank :STATE BANK OF INDIA /CA No:35353978568
										<br>Branch :KEELANATHAM TIRUNELVELI
										<br>IFSC Code :SBIN0015983
										
										</td>
										
										<td width="20%"><img src="images/baraniseal.png" height="82"
			width="150"></td</tr>

											<tr><td align="right" colspan="4">Authorized Signatory</td>		
										</tr>
								
</table>

		


 ';
}
else{
	$table = '
		<table border="0"  width="100%">

		<tr >
			<td width="70%" align="left"> '
. $xCustomerName  .' <BR>
	'.$xCustomerAddress.'<br>
		Gst No :'.$xCustomerGstNo.'<br>
		Mobile No :'.$xCustomerMobileNo.'

						</td>
			
					<td  width="30%" align="right"> 
					Bill  No : BDS - ' . $xSalesInvoiceNoForPrint . ' <br>
					Bill Date : ' .date("d/M/Y", strtotime($xDate)) . '	<br>
					
					PoNo : ' .$xPoNo . '	
			</td>
		</tr>	
</table>
			<hr>
		<table width="100%" >
			<tr><td width="40%">Description</td><td width="40%" align="left">Period</td><td align="left">Days</td><td align="right">Amount</td></tr>
			</table>
			<hr >
			<table width="100%">
						<tr><td width="40%">'.$xItemName.'</td>
					<td width="40%" align="left">'.$xParticulars.'</td>
								<td width="10%" align="left">'.$xQty.'</td><td width="10%" align="right">'.fn_RupeeFormat($xUnitAmount).'</td></tr>		
		</table>
			<br>	<table width="100%">
	<tr><td width="40%"></td><td width="40%" align="right"> CGST 9%</td><td width="10%"></td><td width="10%" align="right">'.fn_RupeeFormat($CGST).'</td></tr>	
							<tr><td></td><td align="right"> SGST 9%</td><td></td><td align="right">'.fn_RupeeFormat($SGST).'</td></tr>	
	
								<tr><td></td><td align="right"> TOTAL </td><td></td><td align="right">'.fn_RupeeFormat($xTotalAmount).'</td></tr>

							</table>
							<hr>
							<table width="100%">
			<tr><td width="50%">'. ucwords(convert_digit_to_words($xTotalAmount)).' Only</td>
									<td width="50%" align="right"> For BARANI DATA SOLUTIONS PVT LTD </td>
									</tr>
				</table>
									<table width="100%">
							
								<tr><td align="left" width="80%" >Company & Bank Details 
										<br>Name :BARANI DATA SOLUTIONS PVT LTD
										<br>Bank :STATE BANK OF INDIA /CA No:35353978568
										<br>Branch :KEELANATHAM TIRUNELVELI
										<br>IFSC Code :SBIN0015983
										
										</td>
										
										<td width="20%"><img src="images/baraniseal.png" height="82"
			width="150"></td</tr>

											<tr><td align="right" colspan="4">Authorized Signatory</td>		
										</tr>
								
</table>

		


 ';
}
	
}
//$connect->close ();

echo $table;

/* Mail and Message Code */
//SendMail("tcssnellai@gmail.com",$table );


/* if($grandTotal>1500)
{
	$xNumber="9578795653";
	$xMessageArea="Johnson Steels : Invoice No - $orderId , Amount - Rs . $grandTotal";
	$request = 'http://login.bulksmsindia.biz/messageapi.asp?username=mdsaleem1804&password=tcssnellai&sender=TCSSTC&mobile=' . $xNumber. '&message=' .  urlencode($xMessageArea);
	$my_var = file_get_contents ( $request );
	echo $my_var;
} */
/* Ended */

?>
