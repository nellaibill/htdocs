<?php
include '../../session.php';
include 'globalfunctions.php';
$xCurrentQty = 0;
$xTempPurchaseQty = $GLOBALS ['xTempPurchaseQty'];
$GLOBALS ['xDateRecieved'] = $GLOBALS ['xCurrentDate'];
$GLOBALS ['xDateExpired'] = date ( 'Y-m-d', strtotime ( '+1 years' ) );
$xReportDate = date ( 'Y-m-d' );
function finditemqty($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_stockentry where itemno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xAvailableQty'] = $row ['stock'];
	}
}

if (isset ( $_GET ['txno'] ) && ! empty ( $_GET ['txno'] )) {
	$no = $_GET ['txno'];
	if ($_GET ['xmode'] == 'edit') {


				$GLOBALS ['xMode'] = 'F';
				DataFetch ( $_GET ['txno'] );
				
	} else {
		finditemqty ( $xItemNo );
		$xQty = $_GET ['passqty'];
		if ($xQty < $GLOBALS ['xAvailableQty']) {
			$xQry = "DELETE FROM inv_temppurchaseentry WHERE txno= $no";
			mysql_query ( $xQry );
			fn_TempPurchaseQty ( 0 );
			UpdateStockValues ( - $_GET ['passqty'], $_GET ['passitemno'], '' );
			header ( 'Location: inv_ht003purchaseentry.php' );
		}
else
{
//echo '<script language="javascript">';
//			echo 'alert("Please Check Stock Before Delete")';
//			echo '</script>';
echo "Please Check Stock Before Delete";
}
	}
} else {
	GetMaxIdNo ();
}
if (isset ( $_POST ['add'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['save'] )) {
	GetMaxIdNo ();
} 

elseif (isset ( $_POST ['editpurchaseinvoiceno'] )) {
	$xSearchPurchaseInvoiceNo = $_POST ['f_searchpurchaseinvoiceno'];
	/* Check Sales Entries */
	
	$result = mysql_query ( "SELECT *  FROM inv_temppurchaseentry " ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			echo '<script language="javascript">';
			echo 'alert("Please Delete the Current Purchase Entries")';
			echo '</script>';
		}
	} 

	else {
		/* ----- User Edit Purchase Entry for the Current Day Only--- */
		
		if ($login_session == "admin") {
			$xQry = "SELECT * FROM inv_purchaseentry where purchaseinvoiceno=$xSearchPurchaseInvoiceNo";
		} else {
			$xQry = "SELECT * FROM inv_purchaseentry where purchaseinvoiceno=$xSearchPurchaseInvoiceNo and date='$xReportDate'";
		}
		
		/* ----- User Edit Purchase Entry for the Current Day Only Ended --- */
		
		$result = mysql_query ( $xQry ) or die ( mysql_error () );
		$count = mysql_num_rows ( $result );
		if ($count > 0) {
			while ( $row = mysql_fetch_array ( $result ) ) {
				/* To Assign Values For Stock Point and Employee because it get changed on the edit */
				if ($row ['date'] = $GLOBALS ['xCurrentDate'])
					$xSupplierNo = $row ['supplierno'];
				mysql_query ( "update  config_inventory set supplierno=$xSupplierNo" ) or die ( mysql_error () );
			}
			mysql_query ( "LOCK TABLES inv_temppurchaseentry WRITE, inv_purchaseentry WRITE" ) or die ( mysql_error () );
			mysql_query ( "INSERT INTO inv_temppurchaseentry(purchaseinvoiceno,date,companyinvoiceno,itemno,daterecieved,                             dateexpired,batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit,createdason,updatedason)
                          SELECT purchaseinvoiceno,date,companyinvoiceno,itemno,daterecieved,dateexpired,
                          batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit,createdason,updatedason  
                          FROM inv_purchaseentry where purchaseinvoiceno=$xSearchPurchaseInvoiceNo" ) or die ( mysql_error () );
			mysql_query ( "DELETE FROM inv_purchaseentry where purchaseinvoiceno=$xSearchPurchaseInvoiceNo" ) or die ( mysql_error () );
			mysql_query ( "UNLOCK TABLES" ) or die ( mysql_error () );
			GetMaxIdNo ();
		} else {
			echo '<script language="javascript">';
			echo 'alert("Entries Not Found-Please Contact Admin")';
			echo '</script>';
		}
	}
}
function GetMaxIdNo() {
	$xQry = "SELECT  CASE WHEN max(purchaseinvoiceno)IS NULL OR max(purchaseinvoiceno)= '' THEN '1' 
                        ELSE max(purchaseinvoiceno)+1 END AS purchaseinvoiceno FROM inv_purchaseentry";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
	}
	GetMaxTxNo ();
}
function GetMaxTxNo() {
	$xQry = "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' ELSE max(txno)+1 END AS txno FROM inv_temppurchaseentry";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTxno'] = $row ['txno'];
	}
}
function fn_TempPurchaseCount() {
	$result = mysql_query ( "SELECT *  FROM inv_temppurchaseentry" ) or die ( mysql_error () );
	$GLOBALS ['xTempPurchaseCount'] = mysql_num_rows ( $result );
}
function DataFetch($xTxno) {
	$result = mysql_query ( "SELECT *  FROM inv_temppurchaseentry where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xTxno'] = $row ['txno'];
			$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
			$GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xDateRecieved'] = $row ['daterecieved'];
			$GLOBALS ['xDateExpired'] = $row ['dateexpired'];
			$GLOBALS ['xBatchId'] = $row ['batchid'];
			$GLOBALS ['xQty'] = $row ['qty'];
			$GLOBALS ['xFreeQty'] = $row ['freeqty'];
			$GLOBALS ['xOriginalPrice'] = $row ['originalprice'];
			$GLOBALS ['xSellingPrice'] = $row ['sellingprice'];
			$GLOBALS ['xDiscount'] = $row ['discount'];
			$GLOBALS ['xVat'] = $row ['vat'];
			$GLOBALS ['xProfit'] = $row ['profit'];
			$GLOBALS ['xTotal'] = $row ['total'];
			// To Check Edit Purchase After sales has been made
			$xItemNo = $row ['itemno'];
			$xQty = $row ['qty'];
			finditemstockqty ( $xItemNo );
			$xItemStockQty = $GLOBALS ['xSelectedItemStock'];
			$xCheckQty = $xItemStockQty - $xQty;
			// echo " Qty:".$xQty;
			// echo " ItemStockQty:".$xItemStockQty;
			// echo "ItemStockQty-Qty=:".$xCheckQty;
			//if ($xCheckQty >= 0) {
				fn_TempPurchaseQty ( $row ['qty'] );
				$xQry = "DELETE FROM inv_temppurchaseentry WHERE txno= $xTxno";
				mysql_query ( $xQry ) or die ( mysql_error () );
				fn_TempPurchaseQty ( 0 );
				UpdateStockValues ( - $row ['qty'], $row ['itemno'], '' );
			//} else {
				//echo "<script language='javascript'>alert('Please Check Sales and Stock !');</script>";
			//}
		}
	}
}
function DataProcess($mode) {
	$xVat = 0;
	$xCreatedDate = $GLOBALS ['xCurrentDateTime'];
	$xUpdatedDate = $GLOBALS ['xCurrentDateTime'];
	$xTxno = $_POST ['f_txno'];
	$xPurchaseInvoiceNo = $_POST ['f_purchaseinvoiceno'];
	$xDate = $GLOBALS ['xCurrentDate'];
	$xItemNo = $_POST ['f_itemno'];
	$xDateRecieved = $_POST ['f_daterecieved'];
	$xExpiredDate = $_POST ['f_dateexpired'];
	if (empty ( $_POST ['f_batchid'] )) {
		$xBatchId = "";
	} else {
		$xBatchId = $_POST ['f_batchid'];
	}
	$xQty = $_POST ['f_qty'];
	if (empty ( $_POST ['f_freeqty'] )) {
		$xFreeQty = 0;
	} else {
		$xFreeQty = $_POST ['f_freeqty'];
	}
	$xOriginalPrice = $_POST ['f_originalprice'];
	$xSellingPrice = $_POST ['f_sellingprice'];
	if (empty ( $_POST ['f_discount'] )) {
		$xDiscount = 0;
	} else {
		$xDiscount = $_POST ['f_discount'];
	}
	if (empty ( $_POST ['f_vat'] )) {
		$xVat = "";
	} else {
		$xVat = ($_POST ['f_vat']);
	}
	$xTotal = ((($xQty + $xFreeQty) * $xOriginalPrice) - $xDiscount / 100 * (($xQty + $xFreeQty) * $xOriginalPrice)) + $xVat / 100 * (($xQty + $xFreeQty) * $xOriginalPrice);
	$xNetTotal = ((($xQty + $xFreeQty) * $xSellingPrice) - $xDiscount / 100 * (($xQty + $xFreeQty) * $xSellingPrice)) + $xVat / 100 * (($xQty + $xFreeQty) * $xSellingPrice);
	
	$xProfit = $xNetTotal - $xTotal;
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO inv_temppurchaseentry (txno,purchaseinvoiceno,date,itemno,daterecieved,dateexpired,
		batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit,createdason,updatedason) VALUES
		($xTxno,$xPurchaseInvoiceNo,'$xDate',$xItemNo,'$xDateRecieved','$xExpiredDate',
		'$xBatchId',$xQty,$xFreeQty,$xOriginalPrice,$xSellingPrice,$xDiscount,'$xVat',$xTotal,$xNetTotal,$xProfit,'$xCreatedDate','$xUpdatedDate')";
		finditemqty ( $xItemNo );
		if ($GLOBALS ['xAvailableQty'] + $xQty >=0)
			{
				$retval = mysql_query ( $xQry ) or die ( mysql_error () );
			
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		} else {
			$xMsg = "Inserted";
			fn_TempPurchaseQty ( 0 );
			UpdateStockValues ( $xQty, $xItemNo, '' );
		}
}
		else
			{
			//echo '<script language="javascript">';
			//echo 'alert("Please Check Stock Before Update")';
			//echo '</script>';

	$GLOBALS ['xTxno'] = $_POST ['f_txno'];
			$GLOBALS ['xPurchaseInvoiceNo'] = $_POST ['f_purchaseinvoiceno'];
			$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
			$GLOBALS ['xItemNo'] = $_POST ['f_itemno'];
			$GLOBALS ['xDateRecieved'] =$_POST ['f_daterecieved'];
			$GLOBALS ['xDateExpired'] = $_POST ['f_dateexpired'];
				$GLOBALS ['xBatchId'] = $_POST ['f_batchid'];
			$GLOBALS ['xQty'] =$_POST ['f_qty'];
			$GLOBALS ['xFreeQty'] = $_POST ['f_freeqty'];
			$GLOBALS ['xOriginalPrice'] =$_POST ['f_originalprice'];
			$GLOBALS ['xSellingPrice'] = $_POST ['f_sellingprice'];
			$GLOBALS ['xDiscount'] = $_POST ['f_discount'];
			$GLOBALS ['xVat'] = $_POST ['f_vat'];

echo "Please Check Stock Before Update";
			}
	}
	/*
	 * elseif ($mode == 'U')
	 * {
	 *
	 * $xQry = "INSERT INTO inv_temppurchaseentry (txno,purchaseinvoiceno,date,itemno,daterecieved,dateexpired,batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit,createdason,updatedason) VALUES ($xTxno,$xPurchaseInvoiceNo,'$xDate',$xItemNo,'$xDateRecieved','$xExpiredDate','$xBatchId',$xQty,$xFreeQty,$xOriginalPrice,$xSellingPrice,$xDiscount,'$xVat',$xTotal,$xNetTotal,$xProfit,'$xCreatedDate','$xUpdatedDate')";
	 * $retval = mysql_query ( $xQry ) or die ( mysql_error () );
	 *
	 * if (! $retval)
	 * {
	 * die ( 'Could not enter data: ' . mysql_error () );
	 * }
	 * else
	 * {
	 * UpdateStockValues($xQty,$xItemNo,'');
	 * header('Location: inv_ht003purchaseentry.php');
	 * }
	 *
	 * }
	 */
	GetMaxIdNo ();
	ShowAlert ( $xMsg );
}
function fn_TempPurchaseQty($xTempPurQty) {
	$xQry = "update config_purchase set temppurchaseqty=$xTempPurQty";
	mysql_query ( $xQry ) or die ( mysql_error () );
}
function UpdateStockValues($xCurrentQty, $xCurrentItemNo, $mode) {
	if ($mode == "") {
		$xTempPurchaseQty = 0;
		$xQry = "update inv_stockentry set stock=stock+($xCurrentQty)-$xTempPurchaseQty where itemno=$xCurrentItemNo";
		mysql_query ( $xQry ) or die ( mysql_error () );
	} else {
		$xTempPurchaseQty = $GLOBALS ['xTempPurchaseQty'];
		$xQry = "update inv_stockentry set stock=stock+($xCurrentQty)-$xTempPurchaseQty where itemno=$xCurrentItemNo";
		mysql_query ( $xQry ) or die ( mysql_error () );
	}
	
	fn_TempPurchaseQty ( 0 );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PURCHASE-ENTRY</title>
</head>

<script type="text/javascript">
/* code from qodo.co.uk */
// create as many regular expressions here as you need:
var digitsOnly = /[1234567890]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;

function restrictCharacters(myfield, e, restrictionType) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
			return false;
		}
		
	}
}
</script>



<script type="text/javascript">
$('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});



// JavaScript popup window function

function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=900,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
	}
function parent_disable() {
if(popupWindow && !popupWindow.closed)
popupWindow.focus();
}
function validateForm() 
 {
 var xItemNo= document.forms["purchaseentryform"]["f_itemno"].value;
 var xDateRecieved= document.forms["purchaseentryform"]["f_daterecieved"].value;
 var xDateExpired= document.forms["purchaseentryform"]["f_dateexpired"].value;
 var xQty= document.forms["purchaseentryform"]["f_qty"].value;
 var xOriginalPrice= document.forms["purchaseentryform"]["f_originalprice"].value;
 var xSellingPrice= document.forms["purchaseentryform"]["f_sellingprice"].value;

if (xItemNo== null || xItemNo== "0") 
    {
        alert("Item Name to be Filled");
        document.purchaseentryform.f_itemno.focus();
        return false;
    }
 if (xDateRecieved== null || xDateRecieved== "") 
    {
        alert("Recieving Date to be Filled");
        document.purchaseentryform.f_daterecieved.focus();
        return false;
    }
    if (xDateExpired== null || xDateExpired== "") 
    {
        alert("Expiry Date to be Filled");
        document.purchaseentryform.f_dateexpired.focus();
        return false;
    }
	
	if (xQty== null || xQty== "") 
    {
        alert("Qty Not Filled");
        document.purchaseentryform.f_qty.focus();
        return false;
    }
    if (xOriginalPrice== null || xOriginalPrice== "") 
    {
        alert("Original Price Not Filled");
        document.purchaseentryform.f_originalprice.focus();
        return false;
    }
	
	    if (xSellingPrice== null || xSellingPrice== "") 
    {
        alert("Selling Price Not Filled");
        document.purchaseentryform.f_sellingprice.focus();
        return false;
    }

}



  function SearchValidateForm() 
	 {
	 var xSearchPurchaseInvoiceNo= document.forms["purchaseentryform"]["f_searchpurchaseinvoiceno"].value;
	  if (xSearchPurchaseInvoiceNo== "") 
	   {
		alert("Please Enter Invoice No");
			document.purchaseentryform.f_searchpurchaseinvoiceno.focus();
		return false;
	   }

	}

</script>

<body>
	<form class="form" name="purchaseentryform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">PURCHASE-ENTRY</h3>
			</div>
			<div class="panel-body">

				<div class="col-xs-2">
					<label>Tx.No :</label> <input type="text" class="form-control"
						name="f_txno" value="<?php echo $GLOBALS ['xTxno']; ?>" readonly>
				</div>

				<div class="col-xs-2">
					<label>Invoice No :</label> <input type="text" class="form-control"
						name="f_purchaseinvoiceno"
						value="<?php echo $GLOBALS ['xPurchaseInvoiceNo']; ?>" readonly>
				</div>


				<div class="col-xs-4">
					<label>Item Name:</label> <select class="form-control" value=""
						name="f_itemno">
						<option value="0">Choose Item</option>
<?php
$result = mysql_query ( "SELECT *  FROM m_item as i,inv_stockentry as se  where i.itemno=se.itemno and i.stockpointno=31 order by i.itemname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
    <option value="<?php echo $row['itemno']; ?>"
							<?php
	if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
		echo 'selected="selected"';
	}
	?>>
     <?php echo $row['itemname']. " - " .$row['stock'] ?> 
    </option>
    <?

}
?>
</select>
					<!--
<span class="input-group-btn">
<a class="btn btn-warning" href="inv_hr003_a_oldpurchasehistory.php<?php echo '?itemno='.$_POST ['f_itemno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false">Old Purchase</a>
  </span>
!-->
				</div>

				<div class="col-xs-3">
					<label>Date Recieved:</label> <input type="date"
						class="form-control" name="f_daterecieved"
						value="<?php echo $GLOBALS ['xDateRecieved']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Expiry-Date:</label> <input type="date" class="form-control"
						name="f_dateexpired"
						value="<?php echo $GLOBALS ['xDateExpired']; ?>">
				</div>

				<div class="col-xs-3 ">
					<label>BatchId:</label> <input type="text" class="form-control"
						name="f_batchid" value="<?php echo $GLOBALS ['xBatchId']; ?>">
				</div>

				<div class="col-xs-3 has-warning">
					<label>Qty:</label> <input type="number" class="form-control"
						name="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>"
						style="text-align: right;">
				</div>


				<div class="col-xs-3 has-warning">
					<label>FreeQty:</label> <input type="number" class="form-control"
						name="f_freeqty" value="<?php echo $GLOBALS ['xFreeQty']; ?>"
						style="text-align: right;">
				</div>



				<div class="col-xs-3 has-warning">
					<label>OriginalPrice:</label> <input type="text"
						class="form-control" name="f_originalprice"
						value="<?php echo $GLOBALS ['xOriginalPrice']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>



				<div class="col-xs-3 has-warning">
					<label>SellingPrice:</label> <input type="text"
						class="form-control" name="f_sellingprice"
						value="<?php echo $GLOBALS ['xSellingPrice']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>

				<div class="col-xs-3 has-warning">
					<label>Discount:(%)</label> <input type="text" class="form-control"
						name="f_discount" value="<?php echo $GLOBALS ['xDiscount']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>


				<div class="col-xs-3">
					<label>Vat(%):</label>
					<!--<input type="text" class="form-control" name="f_vat" value="<?php echo $GLOBALS ['xVat']; ?>" style="text-align:right;">!-->
					<select class="form-control" name="f_vat">
						<option value="0"
							<?php if( $GLOBALS ['xVat']=="0") echo 'selected="selected"'; ?>>0%</option>
						<option value="5"
							<?php if( $GLOBALS ['xVat']=="5") echo 'selected="selected"'; ?>>5%</option>
													<option value="12"
							<?php if( $GLOBALS ['xVat']=="12") echo 'selected="selected"'; ?>>12%</option>
						<option value="14.5"
							<?php if( $GLOBALS ['xVat']=="14.5") echo 'selected="selected"'; ?>>14.5%</option>
							
										<option value="18"
							<?php if( $GLOBALS ['xVat']=="18") echo 'selected="selected"'; ?>>18%</option>
							
										<option value="28"
							<?php if( $GLOBALS ['xVat']=="28") echo 'selected="selected"'; ?>>28%</option>
					</select>
				</div>


			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
					<input type="submit" name="add" class="btn btn-primary" value="ADD"
						id="add" onclick="return validateForm()">
				</div>
			</div>

		</div>
		</br>
		<!-- Report Starts here !-->



		<div class="col-xs-3">
			<input type="text" class="form-control"
				name="f_searchpurchaseinvoiceno" placeholder="Purchase Invoice No">
		</div>

		<div class="col-xs-2">
			<input type="submit" name="editpurchaseinvoiceno"
				class="btn btn-primary" value="Edit Previous Invoice No" id="save"
				onclick="return SearchValidateForm()">
		</div>

<?php
fn_TempPurchaseCount ();
$xCount = $GLOBALS ['xTempPurchaseCount'];
if ($xCount > 0) {
	?>
<div id="divToPrint">
			<div class="container">
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="5%">S.NO</th>
							<th width="40%">ITEMNAME</th>
							<th width="15%">QTY</th>
							<th width="10%">PRICE</th>
							<th width="10%">VAT</th>
							<th width="10%">DISCOUNT</th>
							<th width="10%">HSR</th>
							<th width="10%">MRP</th>
							<th width="15%">PROFIT</th>
							<th colspan="2" width="10%">ACTIONS
							
							</td>
						</tr>
					</thead>
					<tbody>	
<?php
	$xSlNo = 0;
	$xGrandVat = 0;
	$xGrandDiscount = 0;
	$xGrandTotal = 0;
	$xGrandNetTotal = 0;
	$xGrandProfit = 0;
	$xQry = "SELECT *  from inv_temppurchaseentry ;";
	$result2 = mysql_query ( $xQry );
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		echo '<tr>';
		finditemname ( $row ['itemno'] );
		echo '<td>' . $xSlNo . '</td>';
		?>
<td><a
							href="inv_hr003_a_oldpurchasehistory.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName']?>
</a></td>
<?php
		echo '<td>' . $row ['qty'] . '</td>';
		echo '<td align=right>' . $row ['originalprice'] . '</td>';
		echo '<td align=right>' . $row ['vat'] . " %" . '</td>';
		echo '<td align=right>' . $row ['discount'] . " %" . '</td>';
		echo '<td align=right>' . $row ['total'] . '</td>';
		echo '<td align=right>' . $row ['nettotal'] . '</td>';
		echo '<td align=right>' . $row ['profit'] . '</td>';
		$xGrandTotal = $row ['total'] + $xGrandTotal;
		$xGrandNetTotal = $row ['nettotal'] + $xGrandNetTotal;
		$xGrandProfit = $row ['profit'] + $xGrandProfit;
		$xGrandVat += ($row ['qty'] * $row ['originalprice']) * ($row ['vat'] / 100);
		$xGrandDiscount += ($row ['qty'] * $row ['originalprice']) * ($row ['discount'] / 100);
		
		?>
<td><a
							href="inv_ht003purchaseentry.php<?php echo '?txno='.$row['txno'] . '&xmode=edit
&passqty='.$row['qty']. ' &passitemno='.$row['itemno']  ?>"
							onclick="return confirm_edit()"> <img src="../images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
						
<!--<td><a
							href="inv_ht003purchaseentry.php<?php echo '?txno='.$row['txno']. '&xmode=delete &passqty='.$row['qty']. ' &passitemno='.$row['itemno']  ?>"
							onclick="return confirm_delete()"> <img
								src="../images/delete.png" alt="HTML tutorial"
								style="width: 30px; height: 30px; border: 0">
						</a></td>!-->
<?
		echo '</tr>';
	}
	echo '<tr>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td align=right>' . money_format ( "%!n", $xGrandVat ) . '</td>';
	echo '<td align=right>' . money_format ( "%!n", $xGrandDiscount ) . '</td>';
	echo '<td align=right>' . money_format ( "%!n", $xGrandTotal ) . '</td>';
	echo '<td align=right>' . money_format ( "%!n", $xGrandNetTotal ) . '</td>';
	echo '<td align=right>' . money_format("%!n", $xGrandProfit). '</td>';
    echo '</tr>';
?>	
Success!
</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
		<div class="panel-footer clearfix">
			<div class="pull-right">
				<!--<a href="inv_ht003_c_purchasecheckout.php"  onclick="basicPopup(this.href);return false" class="btn btn-primary">SAVE</a> !-->
				<a href="inv_ht003_c_purchasecheckout.php" class="btn btn-primary">SAVE</a>
			</div>
		</div>
<?php
}
?>