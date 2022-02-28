  <head>
    <style>@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}
.rowstyle
{
	font-size:8px;  
	font-weight: bold; 
	font-family: Times New Roman;
	align:center;
}
.row_heading_style
{
	font-size:10px;  
	font-weight: bold; 
	font-family: Times New Roman;
	align:center;
}
    </style>

  </head>
<?php
include 'config.php';

function fn_GetPurchaseCode($xNumber)
{
	
	if($xNumber=="1")
	{
		$xCode= "A";
	}
    if($xNumber=="2")
	{
		$xCode= "B";
	}
	if($xNumber=="3")
	{
		$xCode= "C";
	}
	if($xNumber=="4")
	{
		$xCode= "D";
	}
	if($xNumber=="5")
	{
		$xCode= "E";
	}
	if($xNumber=="6")
	{
		$xCode= "F";
	}
	if($xNumber=="7")
	{
		$xCode= "G";
	}
	if($xNumber=="8")
	{
		$xCode= "H";
	}
	if($xNumber=="9")
	{
		$xCode= "I";
	}
	if($xNumber=="0")
	{
		$xCode= "J";
	}
return $xCode;
}
		if (isSet ( $_POST ['save'] )) {
		include "Barcode39.php";
        $xFromNo= $_POST ['f_fromcode'];
		 $xToNo= $_POST ['f_tocode'];
		$xPrintCount = $_POST ['f_printcount'];
			for($xCode = $xFromNo; $xCode <= $xToNo; $xCode++) {
				$xPurchaseCode='';
        $resultitemname = mysql_query ( "SELECT *  from m_item where barcode= '".$xCode ."'");
		while ( $row = mysql_fetch_array ( $resultitemname ) ) {
		    $xBarCode = $row ['barcode'];
			$xItemName = $row ['itemname'];
			$xMrp = $row ['mrp'];
			$xDisAmount = $row ['disamount'];
			$OriginalPrice = $row ['originalprice'];
			$bc = new Barcode39 ( $xBarCode );
			$bc->barcode_height = 40;
			$bc->draw ( $xBarCode . ".gif" );
			$image = "<img src='barcodes/" . $xBarCode . ".gif'/>";
			$xSplittedString = $OriginalPrice;
			$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[0]);
			$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[1]);
			$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[2]);
		}
			
	
		for($i = 0; $i < $xPrintCount; $i ++) {
		?>
		
  <table width="100%">
  <tr>
    <td class ="row_heading_style" align=center>GLOBAL TRADERS</td>
    <td class ="row_heading_style" align=center>GLOBAL TRADERS</td>
	  </tr>
  <tr class=rowstyle>
  <td align=left><?php echo $xItemName."/Mrp".$xMrp."/GRP".$xDisAmount; ?></td>
<td align=right><?php echo $xItemName."/Mrp".$xMrp."/GRP".$xDisAmount; ?></td>
  </tr>
    <tr>
  <td align=left><?php echo $image."".$xPurchaseCode; ?></td>
  <td align=left><?php echo $image."".$xPurchaseCode; ?></td>
  </tr>
  </table>

<div class="page-break"></div>
		<?php }
		}
		}
		?>