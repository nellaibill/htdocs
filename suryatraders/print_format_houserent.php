<?php
include 'config.php';
include 'functions.php';

$xCopyName=$GLOBALS ['xPrintBillType'];
if (isset ( $_GET ['bill_house_rent_id'] ) && ! empty ( $_GET ['bill_house_rent_id'] )) {
$xId=$_GET ['bill_house_rent_id'] ;
}
?>
<html>
<head>
<link href="css/servicebill.css" rel="stylesheet">
<script type="text/javascript"> 
//window.onload=PrintDiv;     
function PrintDiv() 
 {    
       window.close();
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=600,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
       popupWin.close();
}
</script>
<style>
.noborder {
	border: none;
}
</style>
</head>
<body>
	
	<div id="divToPrint">
		<div class="container">

<?php


$ones =array('',' One',' Two',' Three',' Four',' Five',' Six',' Seven',' Eight',' Nine',' Ten',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen');
$tens = array('','',' Twenty',' Thirty',' Fourty',' Fifty',' Sixty',' Seventy',' Eighty',' Ninety',);
$triplets = array('',' Thousand',' Lac',' Crore',' Arab',' Kharab');


function Show_Amount_In_Words($num) {
  global $ones, $tens, $triplets;
$str ="";


//$num =(int)$num;
$th= (int)($num/1000); 
$x = (int)($num/100) %10;
$fo= explode('.',$num);

if($fo[0] !=null){
$y=(int) substr($fo[0],-2);

}else{
    $y=0;
}

if($x > 0){
    $str =$ones[$x].' Hundred';

}
if($y>0){
if($y<20)
{
 $str .=$ones[$y];

}
else {
    $str .=$tens[($y/10)].$ones[($y%10)];
   }
}
$tri=1;
while($th!=0){

    $lk = $th%100;
    $th = (int)($th/100);
    $count =$tri;

    if($lk<20){
        if($lk == 0){
        $tri =0;}
        $str = $ones[$lk].$triplets[$tri].$str;
        $tri=$count;
        $tri++;
    }else{
        $str = $tens[$lk/10].$ones[$lk%10].$triplets[$tri].$str;
        $tri++;
    }
}
$num =(float)$num;
if(is_float($num)){
     $fo= (String) $num;
      $fo= explode('.',$fo);
       $fo1= @$fo[1];

}else{
    $fo1 =0;
}
$check = (int) $num;
 if($check !=0){
          return $str.' And Paise '.forDecimal($fo1);
    }else{
       return forDecimal($fo1);
    }
}//End function Show_Amount_In_Words

if(isset($_POST['num'])){
   $num = $_POST['num'];
 echo Show_Amount_In_Words($num);
 }



//function for decimal parts
 function forDecimal($num){
    global $ones,$tens;
    $str="";
    $len = strlen($num);
    if($len==1){
        $num=$num*10;
    }
    $x= $num%100;
    if($x>0){
    if($x<20){
        $str = $ones[$x].' ';
    }else{
        $str = $tens[$x/10].$ones[$x%10].' ';
    }
    }
     return $str;
 }  

$xHsnCode = '';
$xTaxInWords='';

echo "<center><img src=images/uh.png></br></br>";
echo "		<font size=3><b>
TAX INVOICE</b></center>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";

echo "<tr>";
echo "<td width=10%  style='border-right:none;border-left:none;border-bottom:none;border-top:none'><img src=images/logo1.png> </td>";
echo "<td width=90% style='font-size: 36pt; font-family:Algerian'  ><center>SRI SURIYA TRADERS</center></td>";

echo "</tr>";

echo "<tr>";

echo "<td style='border-right:none;border-left:none;border-bottom:none;border-top:none'></td>";
echo "<td colspan=8 align=center>		
					
	
		<b>			
186/3, Ettayapuram Road, KOVILPATTI - 628 501.		</b>	</br>			
CELLNo.9176769823  gmail - sreedhanalakshmi2011@gmail.com		</br>				
<b>	GSTIN NO. 33ACMFS1308R1ZP	</b>
";
echo "</td>";

echo "</tr></b>";

echo "</table>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";

// Invoice Section


$result = mysql_query ( "SELECT *  FROM bill_house_rent WHERE bill_house_rent_id=" .$xId ) or die ( mysql_error () );
if ($row = mysql_fetch_array ( $result )) {
	// Buyer Section
	
	findcustomerdata ( $row ['customer_id'] );
	$xCustomerName = $GLOBALS ['xCustomerName'];
	$xCustomerAddress1 = $GLOBALS ['xCustomerAddress1'];
	$xCustomerAddress2 = $GLOBALS ['xCustomerAddress2'];
	$xCustomerAddress3 = $GLOBALS ['xCustomerAddress3'];
	$xCustomerCstNo = $GLOBALS ['xCustomerCstNo'];
	$xCustomerTinNo = $GLOBALS ['xCustomerTinNo'];
	$xCustomerCExNo = $GLOBALS ['xCustomerCexNo'];
	$xInvoiceNo1 = $row ['invoice_no_1'];
	$originalDate = $row ['inv_date'];
	$xDate = date ( "d.m.Y", strtotime ( $originalDate ) );
	
	$xTransporter   ='';
	$xDespto        ='';
	$xDeliveryAt    ='';
    $xEwayBillNo    ='';
	$xAmountofDuty  ='';
	$xInvIssueDate  ='';
	$xInvIssueTime  ='';
	$xInvRemoveDate ='';
	$xInvRemoveTime ='';	
	echo "<tr >";
	echo "<td width=33% colspan=3 style='border-right:none;border-left:none;border-bottom:none;border-top:none'>Party</td>";
	echo "<td width=7.5% colspan=4></td>";
	echo "<td width=11% ><font size=2>Inv No.</font></td>";
	echo "<td width=11%>$xInvoiceNo1</td> </font>";
	echo "</tr>";
	
	echo "<tr >";
	echo "<td width=33% colspan=3 style='border-right:none;border-left:none;border-bottom:none;border-top:none'
			 align=left style='font-size: 11pt; font-family:Arial'><b></b></td>";
	echo "<td width=11%  colspan=4></td>";
	echo "<td width=11% >Inv Date</td>";
	echo "<td width=11% >$xDate</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<b>	<td colspan=3 style='border-right:none;border-left:none;
	border-bottom:none;border-top:none' style='font-size: 14pt; font-family:Arial'><b>
	$xCustomerName</br>
$xCustomerAddress1</br>
$xCustomerAddress2</br>
$xCustomerAddress3</br>
GSTIN No $xCustomerTinNo</br></b>	
</td>";
	echo "<td colspan=6 style='font-size: 11pt; font-family:Arial'>

</br>
  
</br>
</br>
		</td>";
	echo "</tr>";
}

echo "</table>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";
echo "<tr>";

echo "<td width=22% colspan=8 style='font-size: 11pt; font-family:Arial'><b>DESCRIPTION OF RENT </b>	</td>";

echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>HSN/SAC</b></td>";

echo "<td width=7.5% colspan=2 style='font-size: 11pt; font-family:Arial'><b>Amount</b></td>";


echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>CGST(9%)</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>SGST(9%)</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>TOTAL</b></td>";

echo "</tr>";
for($i = 1; $i <= 1; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>&nbsp</td>";
	echo "</tr>";
}
$xGrandTotalWt = 0;
$xGrandTotalQty = 0;
$xGrandDisc = 0;
$xGrandAmount = 0;

$xGrandCgst = 0;
$xGrandSgst = 0;
$xGrandTotalPer = 0;

$xRowCount = 0;
// $result = mysql_query ( "SELECT * FROM bill_suryatraders_section2 WHERE salesbillno=".$xMaxSalesBillNo ) or die ( mysql_error () );
// while ( $row = mysql_fetch_array ( $result ) ) {

$result = mysql_query ( "SELECT *  FROM  
bill_house_rent WHERE 
bill_house_rent_id=" .$xId ) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) {
	$font = "fonts/trichy.ttf";
	finditemcategoryname ( $row ['category_id'] );

	$xHsnCode = $row['hsn_code'];
	$xParticulars = $row['particulars'];
	$xAmount =$row ['amount'];
				$xGst = $row ['gst'];
				$xGstValue=$xAmount * $xGst/100; 
				$xCgst=$xGstValue/2; 
				$xSgst=$xGstValue/2; 
				$xTotalAmount=$xAmount+$xCgst+$xSgst;
	echo "<tr>";
	
	echo "<td width=22% colspan=8 style='font-size: 8pt; font-family:Arial'>  $xParticulars</td>";
	
	echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>$xHsnCode</td>";
	echo "<td width=7.5% colspan=2 align=right style='font-size: 8pt; font-family:Arial'>$xAmount</td>";
	

	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xCgst</td>";
	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xSgst</td>";
	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xTotalAmount</td>";
	
	echo "</tr>";

	$xGrandCgst += $xCgst;
	$xGrandSgst += $xSgst;
	$xGrandTotalPer += $xTotalAmount;
	
	$xRowCount += 1;
}
$xGrandTotalPerAfterRoundOff = round ( $xGrandTotalPer );
$xRoundOffValue=$xGrandTotalPerAfterRoundOff-$xGrandTotalPer;
$xRoundOffValue= number_format($xRoundOffValue, 2);
for($i = $xRowCount; $i <= 6; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>&nbsp</td>";
	echo "</tr>";
}
// }

// $xVatValue = ceil ( $xGrandAmount * 0.05 );
// $xRupeeString = ucwords ( convert_number_to_words ( $xGrandAmount + ceil ( $xGrandAmount * 0.05 ) ) );
$xRupeeString = ucwords ( getStringOfAmount ( round ( $xGrandTotalPerAfterRoundOff ) ) );
// $xGrandTotal = moneyFormatIndia($row ['total']);
// $xRupeeString = ucwords ( getStringOfAmount ($xGrandTotal) );

echo "<td style='font-size: 11pt; font-family:Algerian'width=22% colspan=2>Total Bill  Rupees.</td>";
echo "<td width=44% colspan=4 style='font-size: 11pt; font-family:Arial'>$xRupeeString  Only</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'></td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'></td>";
echo "<td width=7.5%></td>";
echo "<td width=7.5% colspan=2 align=right style='font-size: 11pt; font-family:Arial'>$xGrandAmount</td>";


echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandCgst</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandSgst</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'> $xGrandTotalPerAfterRoundOff</td>";
echo "</tr>";

echo "</tr>";
for($i = 1; $i <= 1; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>&nbsp</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td width=40% colspan=4  align=center  style='font-size: 11pt; font-family:Arial'>HSN/SAC</td>";
echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>Taxable Value</td>";
echo "<td width=20% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>Central Tax</td>";
echo "<td width=20% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>State Tax</td>";
echo "</tr>";
$Gst = $xGrandCgst + $xGrandSgst;
$xRupeeString1 = ucwords ( Show_Amount_In_Words (  $Gst  ) );
//$xRupeeString1 = ucwords ($xTaxInWords);
$xGrandAmount=$xGrandAmount-$xGrandDisc;
echo "<tr>";
echo "<td width=40% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>$xHsnCode</td>";
echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>$xAmount</td>";
echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>9%</td>";
echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>$xGrandCgst</td>";
echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>9%</td>";
echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>$xGrandSgst</td>";
echo "</tr>";

echo "<tr >";
echo "<td width=22% colspan=14  style='font-size: 11pt; font-family:Arial'>Tax Amount in Words Rupees $xRupeeString1 Only</td>";
echo "</tr>";

echo "<tr style='border-right:none;border-left:none;border-bottom:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25%   colspan=3 style=' font-weight: bold; font-size: 11pt; font-family:Arial'><b>Name</td>";
echo "<td width=25% 
	' align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>M/s. Sri Suriya Traders </td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Account No</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>175700050900119</td>";
echo "</tr>";

echo "<tr  style='border-right:none;border-left:none;border-bottom:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Bank Name</td>";
echo "<td width=25%
	' align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Tamilnadu Mercandile Bank</td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>IFSC No</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>TMBL0000175</td>";
echo "</tr>";

echo "<tr style='border-right:none;border-left:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25% colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>A/c Type </td>";
echo "<td width=25% colspan=4 align=center style='font-weight: bold; font-size: 11pt; font-family:Arial'>OD </td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Branch</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Pasuvandanai Road, Kovilpatti</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=5><font size=1>
		</br>
		</font>
		</td>";

echo "<td colspan=3 align=center><font size=1 ></br>Prepared By</br>
</br><hr>Checked By </br></td></font>";

echo "<td colspan=6 align=center><font size=1></br>For SRI SURIYA TRADERS		
		</br></br></br>
	
		 </br>Partner / Authorised Signatory		
		 </br></br></br></td></font>";

echo "</tr>";

echo "</table>";

?>	
</div>
		<!-- /container -->
	</div>
</body>
</html>
