<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['salesbillno'] ) && ! empty ( $_GET ['salesbillno'] )) {
	$no = $_GET ['salesbillno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['salesbillno'] );
	} else {
		$xQry = "DELETE FROM m_itemcategory WHERE salesbillno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: inv_hm002itemcategory.php' );
	}
} 

elseif (isset ( $_POST ['savesection1'] )) {
	GetMaxIdNo ();
	$xSalesBillNo=$GLOBALS ['xSalesBillNo'];
	$xCustomerNo = $_POST ['f_customerno'];
	$xInvoiceNo1 = $_POST ['f_invoiceno1'];
	$xDate = $_POST ['f_date'];
	$xTransporter = $_POST ['f_transporter'];
	$xDespto = $_POST ['f_despto'];
	$xDeliveryAt = $_POST ['f_deliveryat'];
	$xAmountOfDuty="";//Fixed on 19/03/2021
    $xEwayBillNo = $_POST ['f_eway_bill_no'];
	$xQry="INSERT INTO bill_suryatraders_section1
	(salesbillno,customerno,invoiceno1,date,transporter,despto,
	deliveryat,amountofduty,eway_bill_no) 
		 VALUES ($xSalesBillNo,$xCustomerNo,$xInvoiceNo1,'$xDate',
	'$xTransporter','$xDespto','$xDeliveryAt',
	'$xAmountOfDuty',
	'$xEwayBillNo')";
	//echo $xQry;
	$retval = mysql_query ($xQry) or die ( mysql_error () );
} 
elseif (isset ( $_POST ['savesection2'] )) {
	GetMaxIdNo ();
	$xSalesBillNo = $GLOBALS ['xSalesBillNo'];
	$CategoryNo = $_POST ['f_itemcategoryno'];
	$xItemNo = $_POST ['f_itemno'];
	$xHsnCode = $_POST ['f_hsncode'];
	$xSizeNo = $_POST ['f_sizeno'];
	$xGsmNo = $_POST ['f_gsmno'];
	$xRmWt = $_POST ['f_rmwt'];
	$xQty = $_POST ['f_qty'];
	$xTotalWt = $_POST ['f_totalwt'];
	$xRate = $_POST ['f_rate'];
	$xAmount = $_POST ['f_amount'];
	$xDiscount = $_POST ['f_discount'];
	$xCgst = $_POST ['f_cgst'];
	$xSgst = $_POST ['f_sgst'];
	$xTotal = $_POST ['f_total'];
	$xTaxinWords = $_POST ['f_taxinwords'];
	
	$xQry="INSERT INTO bill_suryatraders_section2
			(salesbillno,categoryno,itemno,hsncode,sizeno,gsmno,
			rmwt,qty,totalwt,rate,amount,discount,cgst,sgst,total,taxinwords)
			VALUES ($xSalesBillNo,$CategoryNo,'$xItemNo','$xHsnCode',$xSizeNo,$xGsmNo,
			'$xRmWt',$xQty,'$xTotalWt','$xRate','$xAmount',$xDiscount,$xCgst,$xSgst,$xTotal,
			'$xTaxinWords')" ;
			//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
}


elseif (isset ( $_POST ['save_section_3_new'] )) {
	GetMaxIdNo ();
	$xSalesBillNo = $GLOBALS ['xSalesBillNo'];
	$CategoryNo = $_POST ['f_itemcategoryno_Section3'];
	$xItemNo = 0;
	$xHsnCode = $_POST ['f_hsncode_Section3'];
	$xSizeNo = 0;
	$xGsmNo = 0;
	//Rmwt -Weight per Bag
	$xRmWt = $_POST ['f_weight_per_bag_Section3'];
	$xQty = $_POST ['f_qty_Section3'];
	$xTotalWt = $_POST ['f_totalwt_Section3'];
	$xRate = $_POST ['f_rate_Section3'];
	$xAmount = $_POST ['f_amount_Section3'];
	$xDiscount = $_POST ['f_discount_Section3'];
	$xCgst = $_POST ['f_cgst_Section3'];
	$xSgst = $_POST ['f_sgst_Section3'];
	$xTotal = $_POST ['f_total_Section3'];
    $xTaxinWords = $_POST ['f_taxinwords_Section3'];
	$xQry="INSERT INTO bill_suryatraders_section3_new
			(salesbillno,categoryno,itemno,hsncode,sizeno,gsmno,
			rmwt,qty,totalwt,rate,amount,discount,cgst,sgst,total,taxinwords)
			VALUES ($xSalesBillNo,$CategoryNo,'$xItemNo','$xHsnCode',$xSizeNo,$xGsmNo,
			'$xRmWt',$xQty,'$xTotalWt','$xRate','$xAmount',$xDiscount,$xCgst,$xSgst,$xTotal,
			'$xTaxinWords')" ;
			//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
}

/*
elseif (isset ( $_POST ['savesection3'] )) {
	GetMaxIdNo ();
	
	$xManufacturerNo = $_POST ['f_manufacturerno'];
	$xSalesBillNo=$GLOBALS ['xSalesBillNo'];
	$xInvoiceNo2 = $_POST ['f_invoiceno2'];
	$xSection3Date = $_POST ['f_section3date'];
	$xWeight = $_POST ["f_weight"];
	$xAccesableValue= $_POST ['f_assesablevalue'];
	$xDutyPaid = $_POST ['f_dutypaid'];
	$xCessPaid = $_POST ['f_cesspaid'];
	$xVehicleNo = $_POST ['f_vehicleno'];

	$xQry= "INSERT INTO bill_suryatraders_section3
			(salesbillno,manufacturerno,invoiceno2,date,weight,assesablevalue,dutypaid,cesspaid,vehicleno)
		 VALUES ($xSalesBillNo,$xManufacturerNo,$xInvoiceNo2,'$xSection3Date','$xWeight',
			'$xAccesableValue','$xDutyPaid','$xCessPaid','$xVehicleNo')" ;
	echo $xQry;
	$retval = mysql_query ($xQry) or die ( mysql_error () );
}*/

elseif (isset ( $_POST ['savesection4'] )) {
	GetMaxIdNo ();
	$xSalesBillNo=$GLOBALS ['xSalesBillNo'];
	$xQry= "INSERT INTO bill_suryatraders
	(salesbillno)
	VALUES ($xSalesBillNo)" ;
	$retval = mysql_query ($xQry) or die ( mysql_error () );
}
else {
	GetMaxIdNo ();
}

function fn_DataClear() {
	$GLOBALS ['xItemNo'] = '';
	$GLOBALS ['xItemCategoryNo'] = '';
	$GLOBALS ['xItemGroupNo'] = '';
	$GLOBALS ['xItemSubGroupNo'] = '';
	$GLOBALS ['xItemName'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(salesbillno)IS NULL OR max(salesbillno)= '' 
   THEN '1' 
   ELSE max(salesbillno)+1 END AS salesbillno
FROM bill_suryatraders";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSalesBillNo'] = $row ['salesbillno'];
	}
}
function DataFetch($xItemCategoryNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemcategory where itemcategoryno=$xItemCategoryNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
			$GLOBALS ['xItemCategoryName'] = $row ['itemcategoryname'];
			$GLOBALS ['xItemCategoryShortName'] = $row ['itemcategoryshortname'];
			$GLOBALS ['xItemCategoryColor'] = $row ['itemcategorycolor'];
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>BILL</title>
<link type="text/css" rel="stylesheet" href="css/responsive-tabs.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
<script type="text/javascript">
function sum() {
    var txtFirstNumberValue = document.getElementById('f_totalwt').value;
    var txtSecondNumberValue = document.getElementById('f_rate').value;
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
    if (!isNaN(result)) {
       document.getElementById('f_amount').value = result;
    }
}
function Calculate_Amount_Section3() {
    var txtFirstNumberValue = document.getElementById('f_totalwt_Section3').value;
    var txtSecondNumberValue = document.getElementById('f_rate_Section3').value;
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
    if (!isNaN(result)) {
       document.getElementById('f_amount_Section3').value = result;
    }
}
function calculategst_Section3() {
	
    var xAmount = document.getElementById('f_amount_Section3').value;
    var xDiscount = document.getElementById('f_discount_Section3').value;
var xAmountMinusDiscount=xAmount-xDiscount;
    var xCgst = xAmountMinusDiscount*0.09;
   var xSgst = xAmountMinusDiscount*0.09;
   var xTotal = xAmountMinusDiscount+xCgst+xSgst;
 
       document.getElementById('f_cgst_Section3').value = xCgst;
       document.getElementById('f_sgst_Section3').value = xSgst;
       document.getElementById('f_total_Section3').value = xTotal.toFixed(2);
   
}
function calculategst() {
	
    var xAmount = document.getElementById('f_amount').value;
    var xDiscount = document.getElementById('f_discount').value;
var xAmountMinusDiscount=xAmount-xDiscount;
    var xCgst = xAmountMinusDiscount*0.06;
   var xSgst = xAmountMinusDiscount*0.06;
   var xTotal = xAmountMinusDiscount+xCgst+xSgst;
 
       document.getElementById('f_cgst').value = xCgst;
       document.getElementById('f_sgst').value = xSgst;
       document.getElementById('f_total').value = xTotal.toFixed(2);
   
}

function CalculateRmWt() {
    var txtFirstNumberValue = document.getElementById('f_totalwt').value;
    var txtSecondNumberValue = document.getElementById('f_rate').value;
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
    if (!isNaN(result)) {
       document.getElementById('f_amount').value = result.toFixed(2);
    }
}
</script>
</head>
<body>
</br>

		

	<!--Horizontal Tab-->
	<div id="horizontalTab">
		<ul>
			<li><a href="#tab-1">Section-1</a></li>
			<li><a href="#tab-2">Section-2</a></li>
			<li><a href="#tab-3">Section-3</a></li>
			<li><a href="#tab-4">Completed</a></li>


		</ul>

	
		<div id="tab-1">
		    
		    
		    <form class="form" name="itemform"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

				<div class="panel panel-primary">

					<div class="panel-body">
				<div class="col-xs-4">
							<label>Choose Customer</label> <select class="form-control"
								name="f_customerno">
		<?php
		$result = mysql_query ( "SELECT *  FROM inv_customer" );
		echo "<option value=''>Select Your Option</option>";
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>

  <option value="<?php echo $row['customerid']; ?>"
				>
		<?php echo $row['customername']; ?> 
		</option>

		 <?php
		}
		?>
		 </select>
						</div>
						<div class="col-xs-2">
							<label>Invoice No1</label> <input type="text"
								class="form-control" name="f_invoiceno1">
						</div>
						<div class="col-xs-2">
							<label>Date</label> <input type="date" class="form-control"
								name="f_date">
						</div>

						<div class="col-xs-2">
							<label>Transporter</label> <input type="text"
								class="form-control" name="f_transporter">
						</div>


						<div class="col-xs-2">
							<label>Desp To</label> <input type="text" class="form-control"
								name="f_despto">
						</div>

	<div class="col-xs-2">
							<label>Delivery At</label> <input type="text" 
							class="form-control"
							
							
								name="f_deliveryat">
						</div>
					<div class="col-xs-2">
							<label>Eway Bill No</label> <input type="text" 
							class="form-control"
							
							
								name="f_eway_bill_no">
						</div>
				
					</div>
					<div class="panel-footer clearfix">
						<div class="pull-right">

							<input type="submit" name="savesection1" class="btn btn-primary"
								value="SAVE" onclick="return validateForm()">

						</div>
					</div>
				</div>
			</form>
			
		</div>

		<div id="tab-2">
			
			<form class="form" name="itemform"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="panel panel-primary">

				<div class="panel-body">

					<div class="col-xs-3">
						<label>Category:</label> <select class="form-control"
							name="f_itemcategoryno">
<?php
$result = mysql_query ( "SELECT *  FROM m_itemcategory  order by itemcategoryname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemcategoryno']; ?>"
								<?php
	if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemcategoryname']; ?> 
</option>
<?php
}
?>
</select>
					</div>

					<div class="col-xs-3">
						<label>Item:</label> <select class="form-control" name="f_itemno">
							<option value="Duplex Reel">Duplex Reel</option>
							<option value="Duplex Sheet">Duplex Sheet</option>
							<option value="Reel">Reel</option>
							<option value="Sheet">Sheet</option>
						</select>
					</div>

					<div class="col-xs-2">
						<label>Hsn Code:</label> <select class="form-control" name="f_hsncode">
<?php
$result = mysql_query ( "SELECT *  FROM m_hsncode " );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['hsncode']; ?>" 	>
 <?php echo $row['hsncode']; ?> 
</option>
<?php
}
?>
</select>
					</div>
					<div class="col-xs-2">
						<label>Size:</label> <select class="form-control" name="f_sizeno">
<?php
$result = mysql_query ( "SELECT *  FROM m_size order by sizename" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['sizeno']; ?>" 	>
 <?php echo $row['sizename']; ?> 
</option>
<?php
}
?>
</select>
					</div>

					<div class="col-xs-2">
						<label>Gsm:</label> <select class="form-control" name="f_gsmno">
<?php
$result = mysql_query ( "SELECT *  FROM m_gsm order by gsmname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['gsmno']; ?>">
 <?php echo $row['gsmname']; ?> 
</option>
<?php } ?>
</select>
					</div>

					<div class="col-xs-2" >
						<label>Rm Wt</label> <input type="text" class="form-control"
							name="f_rmwt" value="0">
					</div>

					<div class="col-xs-2">

						<label>Qty</label> <input type="text" class="form-control"
							name="f_qty">
					</div>
				
					<div class="col-xs-2">
						<label>Total Wt</label> <input type="text" class="form-control"
							name="f_totalwt" id="f_totalwt">
					</div>

					<div class="col-xs-2">

						<label>Rate</label> <input type="text" class="form-control"
							name="f_rate" id="f_rate" onkeyup="sum();">
					</div>
					
					<div class="col-xs-2" >
						<label>Amount</label> <input type="text" class="form-control"
							name="f_amount" id="f_amount" readonly>
					</div>

		<div class="col-xs-2" >
						<label>Discount</label> <input type="text" class="form-control"
							name="f_discount" id="f_discount" value="0" onblur="calculategst();">
					</div>
					
							<div class="col-xs-2" >
						<label>CGST</label> <input type="text" class="form-control"
							name="f_cgst" id="f_cgst" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>SGST</label> <input type="text" class="form-control"
							name="f_sgst" id="f_sgst" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>Total</label> <input type="text" class="form-control"
							name="f_total" id="f_total" readonly >
					</div>
					
						<div class="col-xs-6" >
						<label>Tax in Words</label> <input type="text" class="form-control"
							name="f_taxinwords"   >
					</div>
				</div>
					<div class="panel-footer clearfix">
						<div class="pull-right">

							<input type="submit" name="savesection2" class="btn btn-primary"
								value="ADD" onclick="return validateForm()">

						</div>
					</div>
			</div>
			
				</form>
		</div>
<div id="tab-3">
			
			<form class="form" name="itemform"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="panel panel-primary">

				<div class="panel-body">

					<div class="col-xs-3">
						<label>Category:</label> <select class="form-control"
							name="f_itemcategoryno_Section3">
<?php
$result = mysql_query ( "SELECT *  FROM m_itemcategory where itemcategoryno in (13,18) order by itemcategoryname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemcategoryno']; ?>"
								<?php
	if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemcategoryname']; ?> 
</option>
<?php
}
?>
</select>
					</div>

					
					<div class="col-xs-2">
						<label>Hsn Code:</label> <select class="form-control" name="f_hsncode_Section3">
<?php
$result = mysql_query ( "SELECT *  FROM m_hsncode where hsncodeid=11" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['hsncode']; ?>" 	>
 <?php echo $row['hsncode']; ?> 
</option>
<?php
}
?>
</select>
					</div>
	
<div class="col-xs-2">

						<label>Weight Per Bag</label> <input type="text" class="form-control"
							name="f_weight_per_bag_Section3">
					</div>
					<div class="col-xs-2">

						<label>Qty</label> <input type="text" class="form-control"
							name="f_qty_Section3">
					</div>
				
					<div class="col-xs-2">
						<label>Total Wt</label> <input type="text" class="form-control"
							name="f_totalwt_Section3" id="f_totalwt_Section3">
					</div>

					<div class="col-xs-2">

						<label>Destination Rate</label> <input type="text" class="form-control"
							name="f_rate_Section3" id="f_rate_Section3" onkeyup="Calculate_Amount_Section3();">
					</div>
					
					<div class="col-xs-2" >
						<label>Amount</label> <input type="text" class="form-control"
							name="f_amount_Section3" id="f_amount_Section3" readonly>
					</div>

		<div class="col-xs-2" >
						<label>Discount</label> <input type="text" class="form-control"
							name="f_discount_Section3" id="f_discount_Section3" value="0" onblur="calculategst_Section3();">
					</div>
					
							<div class="col-xs-2" >
						<label>CGST</label> <input type="text" class="form-control"
							name="f_cgst_Section3" id="f_cgst_Section3" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>SGST</label> <input type="text" class="form-control"
							name="f_sgst_Section3" id="f_sgst_Section3" readonly >
					</div>
					
							<div class="col-xs-2" >
						<label>Total</label> <input type="text" class="form-control"
							name="f_total_Section3" id="f_total_Section3" readonly >
					</div>
					
						<div class="col-xs-6" >
						<label>Tax in Words</label> <input type="text" class="form-control"
							name="f_taxinwords_Section3"   >
					</div>
				</div>
					<div class="panel-footer clearfix">
						<div class="pull-right">

							<input type="submit" name="save_section_3_new" class="btn btn-primary"
								value="ADD" onclick="return validateForm()">

						</div>
					</div>
			</div>
			
				</form>
		</div>

			<div id="tab-4">
			<form class="form" name="itemform"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

				<div class="panel panel-primary">

			
					<div class="panel-footer clearfix">
						<div class="pull-center">

							<input type="submit" name="savesection4" class="btn btn-primary"
								value="CLICK HERE" onclick="return validateForm()">

						</div>
					</div>
				</div>
			</form>
		</div>

	<!-- jQuery with fallback to the 1.* for old IE -->
	<!--[if lt IE 9]>
        <script src="js/jquery-1.11.0.min.js"></script>
    <![endif]-->
	<!--[if gte IE 9]><!-->
	<script src="js/jquery-2.1.0.min.js"></script>
	<!--<![endif]-->

	<!-- Responsive Tabs JS -->
	<script src="js/jquery.responsiveTabs.js" type="text/javascript"></script>

	<script type="text/javascript">
        $(document).ready(function () {
            var $tabs = $('#horizontalTab');
            $tabs.responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                disabled: [4,5],
                click: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> clicked!');
                },
                activate: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                },
                activateState: function(e, state) {
                    //console.log(state);
                    $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                }
            });

            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('startRotation', 1000);
            });
            $('#stop-rotation').on('click', function() {
                $tabs.responsiveTabs('stopRotation');
            });
            $('#start-rotation').on('click', function() {
                $tabs.responsiveTabs('active');
            });
            $('#enable-tab').on('click', function() {
                $tabs.responsiveTabs('enable', 3);
            });
            $('#disable-tab').on('click', function() {
                $tabs.responsiveTabs('disable', 3);
            });
            $('.select-tab').on('click', function() {
                $tabs.responsiveTabs('activate', $(this).val());
            });

        });
    </script>
</body>
</html>
<?php 
/*$xMaxBillNo=$GLOBALS ['xSalesBillNo']+1;
$result1 = mysql_query ( "SELECT *  FROM bill_suryatraders_section1 WHERE salesbillno=". $xMaxBillNo) or die ( mysql_error () );
while($row1 = mysql_fetch_array($result1))
$num_rows = mysql_num_rows($result1);
{
    if(empty($num_rows)) {
        echo "Section 1 is Not Filled";
        echo "</br>";
    }
}

$result2 = mysql_query ( "SELECT *  FROM bill_suryatraders_section2 WHERE salesbillno=". $xMaxBillNo) or die ( mysql_error () );
while($row2 = mysql_fetch_array($result2))
	$num_rows = mysql_num_rows($result2);
{
	if(empty($num_rows)) {
		echo "Section 2 is Not Filled";
		echo "</br>";
	}
}

$result3 = mysql_query ( "SELECT *  FROM bill_suryatraders_section3 WHERE salesbillno=". $xMaxBillNo) or die ( mysql_error () );
while($row3 = mysql_fetch_array($result3))
	$num_rows = mysql_num_rows($result3);
{
	if(empty($num_rows)) {
		echo "Section 3 is Not Filled";
	}
}*/

?>
