<?php
ob_start();
include 'globalfile.php';
getconfig_sales();
$xPrintTemplate = $GLOBALS ['xPrintTemplate'];
fn_DataClear();
$xCurrentQty = 0;
$xTotalAmount = 0;
$xTempSalesQty = $GLOBALS ['xTempSalesQty'];
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
if (isset($_GET ['passsalesinvoiceno']) && !empty($_GET ['passsalesinvoiceno'])) {
    $xPassSalesInvoiceNo = $_GET ['passsalesinvoiceno'];
    mysql_query("update config_inventory set
			sales_invoice_no= $xPassSalesInvoiceNo");
}
if (isset($_POST ['btn_new'])) {
	GetMaxIdNo();
}

if (isset($_POST ['btn_edit'])) {
	
	$xSalesInvoiceNo=$_POST ['f_edit_id'];	
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1 where salesinvoiceno=" . $xSalesInvoiceNo ) or die ( mysql_error () );
	$xCount= mysql_num_rows($result);
	if($xCount==0)
	{
		echo '<script type="text/javascript">alert("Sales Details Not Found");</script>';
	}
	else {
	mysql_query("update config_inventory set sales_invoice_no= $xSalesInvoiceNo");
	fn_GetSalesEntry1($xSalesInvoiceNo);
	}
}

function fn_GetSalesEntry1($xSalesInvoiceNo){
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1 where salesinvoiceno=" . $xSalesInvoiceNo) or die ( mysql_error () );
	$xCount= mysql_num_rows($result);
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerNo']=$row ['customerno'];
		$GLOBALS ['xDate']=$row ['date'];
	}
}

fn_GetSalesInvoiceNo();

if (isset($_GET ['txno']) && !empty($_GET ['txno'])) {
    $no = $_GET ['txno'];
    if ($_GET ['xmode'] == 'edit') {
        $GLOBALS ['xMode'] = 'F';
        DataFetch($_GET ['txno']);
    } else {
        $xQry = "DELETE FROM inv_salesentry WHERE txno= $no";
        mysql_query($xQry);
        fn_TempSalesQty(0);
        UpdateStockValues(- $_GET ['passqty'], $_GET ['passitemno'], '', $_GET ['passbatch']);
      //  fn_UpdateSalesEntry1();
        
     $result = mysql_query("SELECT   qty,unitmrp FROM inv_salesentry where salesinvoiceno=$xSalesInvoiceNo");

        while ($row = mysql_fetch_array($result)) {
            $xUnitMrp = $row ['unitmrp'];
            $xQty = $row ['qty'];
            $xTotalAmount+= $xUnitMrp * $xQty;
        }

        $result = mysql_query("SELECT * FROM inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo");
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            mysql_query("update  inv_salesentry1 set date=totalamount=$xTotalAmount where salesinvoiceno=$xSalesInvoiceNo");
        } else {
            mysql_query("insert into  inv_salesentry1(salesinvoiceno,totalamount)values($xSalesInvoiceNo,$xTotalAmount)");
        }
        header('Location: inv_ht004salesentry.php');
    }
} else if (isset($_POST ['saveall'])) {
    $xCustomerNo = $_POST ['f_customerno'];
    $xTotalAmount = $_POST ['f_totalamount'];
    $xLessAmount = 0;
    $xDate = $_POST ['f_date'];
    $xDespatch = $_POST ['f_despatch'];
    $xDestination = $_POST ['f_destination'];
    $xModeofPayment = $_POST ['f_modeofpayment'];
    $xTermsofDelivery = $_POST ['f_termsofdelivery'];
    $xVehicleNo = $_POST ['f_vehicleno'];
    
    $xServiceCharges = $_POST ['f_servicecharges'];
    $xsalesperson_Id = $_POST ['username'];
    fn_GetSalesInvoiceNo();
    $xSalesInvoiceNo = $GLOBALS ['xSalesInvoiceNo'];
    $xQry = "update  inv_salesentry1 
	set date='$xDate',
	customerno=$xCustomerNo,
	totalamount=$xTotalAmount,
	lessamount=$xLessAmount,
	despatch='$xDespatch',
	destination='$xDestination',
	modeofpayment='$xModeofPayment',
	termsofdelivery='$xTermsofDelivery',
	vehicleno='$xVehicleNo',
	servicecharges='$xServiceCharges',
	salesperson_id='$xsalesperson_Id'
	where salesinvoiceno=$xSalesInvoiceNo";
    $xQ1 = mysql_query($xQry);


    $xQry = "update inv_salesentry
	set customerno=$xCustomerNo,date='$xDate'
	where  salesinvoiceno=$xSalesInvoiceNo";
    $xQ2 = mysql_query($xQry);

    if ($xQ1 and $xQ2) {
        mysql_query("COMMIT");
        echo "<meta http-equiv='refresh' content='0'>";
        // unset($_POST);
        $xPrintLink = "<script>window.open('$xPrintTemplate?salesinvoiceno=$xSalesInvoiceNo')</script>";
        GetMaxIdNo();
        echo $xPrintLink;
       if ($xPrintLink) {
            echo "<script>window.close();</script>";
        }
    } else {
        mysql_query("ROLLBACK");
    }
        $xTotalAmount = 0;
} else {
   // GetMaxIdNo();
}
$GLOBALS ['xCurrentDate'] = date('Y-m-d H:i:s');
if (isset($_POST ['additemtosales'])) {

    DataProcess("S");
} elseif (isset($_POST ['updateitemtosales'])) {
    DataProcess("U");
}

function fn_UpdateSalesEntry1()
{
     $result = mysql_query("SELECT   qty,unitmrp FROM inv_salesentry where salesinvoiceno=$xSalesInvoiceNo");

        while ($row = mysql_fetch_array($result)) {
            $xUnitMrp = $row ['unitmrp'];
            $xQty = $row ['qty'];
            $xTotalAmount+= $xUnitMrp * $xQty;
        }

        $result = mysql_query("SELECT * FROM inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo");
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            mysql_query("update  inv_salesentry1 set totalamount=$xTotalAmount where salesinvoiceno=$xSalesInvoiceNo");
        } else {
            mysql_query("insert into  inv_salesentry1(salesinvoiceno,totalamount)values($xSalesInvoiceNo,$xTotalAmount)");
        }
    
}
function fn_DataClear() {
    $GLOBALS ['xTxNo'] = '';
    $GLOBALS ['xSalesInvoiceNo'] = '';
    $GLOBALS ['xQty'] = '';
    $GLOBALS ['xItemNo'] = '';
    $GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
    $GLOBALS ['xUsageStockDetails'] = '';
    $GLOBALS ['xUnitRate'] = '';
    $GLOBALS ['xExpDate'] = '';
    $GLOBALS ['xAmount'] = '';
    $GLOBALS ['xVat'] = '';
    $GLOBALS ['xBatch'] = '';
    $GLOBALS ['xStock'] = '';
    $GLOBALS ['xExpiryDate'] = '';
    $GLOBALS ['xGst'] = '';
    $GLOBALS ['xMrp'] = '';
}

function GetMaxIdNo() {
    $xQry = "SELECT  CASE WHEN max(salesinvoiceno)IS NULL OR max(salesinvoiceno)= ''
   THEN '1' 
   ELSE max(salesinvoiceno)+1 END AS salesinvoiceno
FROM inv_salesentry1";

    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
        $xSalesInvoiceNo = $GLOBALS ['xSalesInvoiceNo'] ;
        mysql_query("update config_inventory set
			sales_invoice_no= $xSalesInvoiceNo");
    }
    GetMaxTxNo();
}

function fn_GetSalesInvoiceNo() {
    $result = mysql_query("SELECT  sales_invoice_no from  config_inventory");
    $row = mysql_fetch_array($result);
    $GLOBALS ['xSalesInvoiceNo'] = $row ['sales_invoice_no'];
    $xSalesInvoiceNo = $GLOBALS ['xSalesInvoiceNo'];
    GetMaxTxNo();
}
function GetMaxTxNo() {
    $xQry = "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= ''
				THEN '1' ELSE max(txno)+1 END AS txno FROM inv_salesentry";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xTxNo'] = $row ['txno'];
    }
}

function fn_TempSalesCount() {
    $xSalesInvoiceNo = $GLOBALS ['xSalesInvoiceNo'];
    $result = mysql_query("SELECT *  FROM inv_salesentry where salesinvoiceno=" . $xSalesInvoiceNo) or die(mysql_error());
    $GLOBALS ['xTempSalesCount'] = mysql_num_rows($result);
}

function DataFetch($xTxNo) {
    $xQry = "SELECT *  FROM inv_salesentry where txno=$xTxNo";
    $result = mysql_query($xQry) or die(mysql_error());
    $count = mysql_num_rows($result);
    if ($count > 0) {
        while ($row = mysql_fetch_array($result)) {
            $GLOBALS ['xTxNo'] = $row ['txno'];
            $GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
            $GLOBALS ['xQty'] = $row ['qty'];
            $GLOBALS ['xItemNo'] = $row ['itemno'];
            $GLOBALS ['xDate'] = $row ['date'];
            $GLOBALS ['xUsageStockDetails'] = $row ['usagestockdetails'];
            $GLOBALS ['xBatch'] = $row ['batchid'];
            finditemstock($GLOBALS ['xItemNo'],$GLOBALS ['xBatch']);
            $GLOBALS ['xStock']= $GLOBALS ['xCurrentStock'];
            $GLOBALS ['xExpiryDate'] = $row ['dateexpired'];
            $GLOBALS ['xGst'] = $row ['vat'];
            $GLOBALS ['xMrp'] = $row ['unitmrp'];
            fn_TempSalesQty($row ['qty']);
        }
    }
}

function finditemqty($xNo) {
    $result = mysql_query("SELECT *  FROM inv_stockentry where itemno=$xNo") or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xAvailableQty'] = $row ['stock'];
    }
}

function DataProcess($mode) {
    $xTxNo = $_POST ['f_txno'];
    $xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
    $xItemNo = $_POST ['f_itemno'];
    $xPurchaseInvoiceTxNo = 0;
    $xPurchaseInvoiceNo = 0;
    $xBatchId = $_POST ['f_batch'];
    $xDateExpired = $_POST ['f_date_expired'];
    $xQty = $_POST ['f_qty'];
    $xCreatedDate = $GLOBALS ['xCurrentDate'];
    $xUpdatedDate = $GLOBALS ['xCurrentDate'];
    
    $xVat = $_POST ['f_gst'];
    $xDiscountPercentage = $_POST ['f_discountpercentage'];
    $xItemDescription = $_POST ['f_itemdescription'];
    $xUnitMrp = $_POST ['f_taxincluded'];
    $xGst = $xVat / 100 + 1;
     $xUnitRate =   ((($xUnitMrp / $xGst)));
   
    finditemstock($xItemNo, $xBatchId);
    $xCurrentStock = $GLOBALS ['xCurrentStock'];

    // $xAmount = $_POST ['f_amount'];

    $xAmount = $xQty * $xUnitRate;

    /*
     * $xUnitTotal = $xQty * $xUnitRate;
     * $xDiscountValue=$xUnitTotal*($xDiscountPercentage/100);
     * $xTotalAfterDiscount=$xUnitTotal-$xDiscountValue;
     * $xGstValue=$xTotalAfterDiscount*($xVat/100);
     * $xAmount=$xTotalAfterDiscount+$xGstValue;
     */

    $xQry = "";
    $xMsg = "";
    if ($mode == 'S') {

        if ($xQty <= $xCurrentStock) {
            $xQry = "INSERT INTO inv_salesentry
	   (txno,salesinvoiceno,purchaseinvoiceno,purchaseinvoicetxno,date,itemno,batchid,
	   dateexpired,qty,unitrate,amount,vat,discountpercentage,usagestockdetails,createdason,updatedason,unitmrp)
		VALUES ($xTxNo,$xSalesInvoiceNo,$xPurchaseInvoiceNo,$xPurchaseInvoiceTxNo,
		'',$xItemNo,'$xBatchId','$xDateExpired',$xQty,$xUnitRate,"
                    . "$xAmount,$xVat,$xDiscountPercentage,'$xItemDescription',
			'$xCreatedDate','$xUpdatedDate',$xUnitMrp)";
            $xMsg = "Inserted";
//echo $xQry;
            $retval = mysql_query($xQry) or die(mysql_error());
            if (!$retval) {
                die('Could not enter data: ' . mysql_error());
            } else {
                UpdateStockValues($xQty, $xItemNo, '', $xBatchId);
                fn_TempSalesQty(0);
            }

            header('Location: inv_ht004salesentry.php');
        } else {
            echo '<script type="text/javascript">swal("Stock Not Enough ! ", "Please Verify Opening Stock and Purchase Entries", "error");</script>';
        }
    } elseif ($mode == 'U') {
  $xQry = "UPDATE inv_salesentry set qty=$xQty,itemno=$xItemNo,"
          . "discountpercentage=$xDiscountPercentage,unitrate=$xUnitRate,amount=$xAmount,unitmrp=$xUnitMrp,updatedason='$xUpdatedDate' WHERE txno=$xTxNo";
        $xMsg = "Updated";
        $retval = mysql_query($xQry) or die(mysql_error());
        if (!$retval) {
            die('Could not enter data: ' . mysql_error());
        } else {
            UpdateStockValues($xQty, $xItemNo, 'F', $xBatchId);
            header('Location: inv_ht004salesentry.php');
        }
    }
//fn_UpdateSalesEntry1();
//
     $result = mysql_query("SELECT   qty,unitmrp FROM inv_salesentry where salesinvoiceno=$xSalesInvoiceNo");

        while ($row = mysql_fetch_array($result)) {
            $xUnitMrp = $row ['unitmrp'];
            $xQty = $row ['qty'];
            $xTotalAmount+= $xUnitMrp * $xQty;
        }

        $result = mysql_query("SELECT * FROM inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo");
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            mysql_query("update  inv_salesentry1 set totalamount=$xTotalAmount where salesinvoiceno=$xSalesInvoiceNo");
        } else {
            mysql_query("insert into  inv_salesentry1(salesinvoiceno,totalamount)values($xSalesInvoiceNo,$xTotalAmount)");
        }
    //GetMaxIdNo();
}

function UpdateStockValues($xCurrentQty, $xCurrentItemNo, $mode, $xBatch) {
    if ($mode == "") {

        $xQry = "update inv_stockentry set stock=stock-($xCurrentQty)
		where itemno=$xCurrentItemNo and batch='" . $xBatch . "'";
        mysql_query($xQry);
    } else {
        $xTempSalesQty = $GLOBALS ['xTempSalesQty'];

        $xQry = "update inv_stockentry set stock=stock+($xTempSalesQty)
		where itemno=$xCurrentItemNo and batch='" . $xBatch . "'";
        mysql_query($xQry);
        $xQry1 = "update inv_stockentry set stock=stock-($xCurrentQty)
		where itemno=$xCurrentItemNo and batch='" . $xBatch . "'";
        mysql_query($xQry1);
    }
}

function fn_TempSalesQty($xTempSalesQty) {
    $xQry = "update config_inventory set tempsalesqty=$xTempSalesQty";
    mysql_query($xQry) or die(mysql_error());
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SALES-ENTRY</title>
          
<script type="text/javascript">
       
$(function()
{
     $("#saveall").attr("disabled", true);
  $('.username').keyup(function()
  {
  var username=$(this).val();
  username=trim(username);
  if(username!=''){
  $('.check').show();
  $('.check').fadeIn(400).html('<img src="image/ajax-loading.gif" /> ');

  var dataString = 'username='+ username;
  $.ajax({
          type: "POST",
          url: "check_password.php",
          data: dataString,
          cache: false,
          success: function(result){
               var result=trim(result);
               if(result==''){
                       $('.check').html('Wrong');
                       $(".username").removeClass("red");
                       $(".username").addClass("white");
                          $("#saveall").attr("disabled", true);
               }else{
                       $('.check').html(' '+result);
                          $("#saveall").attr("disabled", false);
                       $(".username").removeClass("white");
                       $(".username").addClass("red");

               }
          }
      });
   }else{
       $('.check').html('');
       $('#submit').attr('disabled', 'disabled');
       $('#submit').attr('value', 'Deactive');
   }
  });
});

function trim(str){
     var str=str.replace(/^\s+|\s+$/,'');
     return str;
}
function CalculateBalance()
            {
            	 document.getElementById("f_balanceamount").value = "";
                 var xPaid = document.getElementById("f_paidamount").value;
                 var xTotalAmount = document.getElementById("f_totalamount").value;
                 var xBalance=xPaid-xTotalAmount;
                 document.getElementById("f_balanceamount").value = Number(xBalance.toFixed(2));
        
            }
          
            function basicPopup(url) {
                popupWindow = window.open(url, 'popUpWindow', 'height=400,width=800,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
            }


            function GetBatch() {

                //document.getElementById('f_batch').value="";
                var xItemNo = document.getElementById("f_itemno").value;
                document.getElementById("f_batch").value = '';
                document.getElementById("f_taxincluded").value = '';
                document.getElementById("f_stock").value = '';
                document.getElementById("f_date_expired").value = '';
   

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var a = xmlhttp.responseText.split("||");
                        document.getElementById("f_batch").value = a[0];
                        document.getElementById("f_taxincluded").value = a[1];
                        document.getElementById("f_stock").value = a[2];
                        document.getElementById("f_date_expired").value = a[3];

                        //document.getElementById('f_batch').value=xmlhttp.responseText;
                        GetGst();
                    }

                }

                xmlhttp.open("GET", "getbatch.php?itemno=" + xItemNo, true);
                xmlhttp.send();
            }




            function GetGst() {
                document.getElementById('f_gst').value = "";
                var xItemNo = document.getElementById("f_itemno").value;
                var xBatch = document.getElementById("f_batch").value;
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('f_gst').value = xmlhttp.responseText;
                        GetMrp();
                    }
                }
                xmlhttp.open("GET", "getgst.php?itemno=" + xItemNo + "&batch=" + xBatch, true);
                xmlhttp.send();
            }


            function validateForm()
            {
                var xItemNo = document.forms["salesentryform"]["f_itemno"].value;
                if (xItemNo == "0")
                {
                    alert("Please Choose an Item");
                    document.salesentryform.f_itemno.focus();
                    return false;
                }

                var xGst = document.forms["salesentryform"]["f_gst"].value;

                if (xGst == "")
                {
                    alert("Enter Gst in MasterItem");
                    document.salesentryform.f_gst.focus();
                    return false;
                }

                var xQty = document.forms["salesentryform"]["f_qty"].value;

                if (xQty == "")
                {
                    alert("Enter Qty");
                    document.salesentryform.f_qty.focus();
                    return false;
                }

                var xtaxincluded = document.forms["salesentryform"]["f_taxincluded"].value;

                if (xtaxincluded == "")
                {
                    alert("Enter value");
                    document.salesentryform.f_taxincluded.focus();
                    return false;
                }
				if (confirm("Confirmation to add or  update record into database!") == true) {
                return true;
            } else {
                return false;
            }
            }


    

       
        </script>

    </head>
    <body onLoad="document.salesentryform.f_itemno.focus()">

        <form class="form" name="salesentryform"
              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="panel panel-danger">

                <div class="panel-heading  text-center">
               
                        SALES-NO <B> <?php echo $GLOBALS ['xSalesInvoiceNo']; ?> </B>
                   
                     <?php if ($xRole == 'A') { ?>
                    <input type="text" name="f_edit_id">
                       <input type="submit" name="btn_edit" class="btn btn-primary"
                                       value="EDIT"> <?php } ?>
                          <input type="submit" name="btn_new" class="btn btn-primary"
                                       value="NEW"> 
						<a href="" class="btn btn-primary" onclick="RefreshPage(); return false">REFRESH </a>
                </div>


                <div class="panel-body">
                    <div class="row">

                            <div class="col-xs-2" style="display: none">
                                <label>Tx.No :</label> <input type="text" class="form-control"
                                                              name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>" readonly>
                            </div>
                            <?php
                            if ($GLOBALS ['xConfigSales_InvoiceNo'] == 'Yes') {
                                echo "<div >";
                                ?>

                            <?php } else { ?>
                                <div style="display: none;">
                                <?php } ?>

                                <label>InvNo:</label> <input type="text" class="form-control"
                                                             name="f_salesinvoiceno"
                                                             value="<?php echo $GLOBALS ['xSalesInvoiceNo']; ?>" readonly>
                            </div>

                            <div class="col-xs-6">
                                <label>Item Name:</label> <select class="form-control"
                                                                  name="f_itemno" id="f_itemno" onchange="GetBatch();">
                                    <option value="0">Choose Item</option>
                                    <?php
                                    $result = mysql_query("SELECT *  FROM m_item  where itemno in(select itemno from inv_stockentry where stock>0) order by itemname");
                                    while ($row = mysql_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['itemno']; ?>"
                                        <?php
                                        if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
                                            echo 'selected="selected"';
                                        }
                                        ?>>
                                                     <?php echo $row['itemname'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>


                            <div class="col-xs-2" >
                                <label>Batch</label>

                                <input type="text" class="form-control"
                                       name="f_batch" readonly
                                       id="f_batch"
                                       value="<?php echo $GLOBALS ['xBatch']; ?>">
                            </div>
  <div class="col-xs-2" >
                            <label>Expiry Date</label>
                            <input type="text" class="form-control"
                                   readonly name="f_date_expired" 
                                   id="f_date_expired"
                                   value="<?php echo $GLOBALS ['xExpiryDate']; ?>">
                        </div>


                            <?php
                            if ($GLOBALS ['xConfigSales_Stock'] == 'Yes') {
                                echo "<div class=col-xs-2>";
                                ?>

                            <?php } else { ?>
                                <div class="col-xs-2" style="display: none;">
                                <?php } ?>
                                <label>Stock:</label> 
                                <input type="text" class="form-control"
                                       readonly name="f_stock" 
                                       id="f_stock"
                                       value="<?php echo $GLOBALS ['xStock']; ?>">
                            </div>
</div>
   <div class="row">

                            <?php
                            if ($GLOBALS ['xConfigSales_Gst'] == 'Yes') {
                                echo "<div class=col-xs-2>";
                                ?>

                            <?php } else { ?>
                                <div class="col-xs-2" 
                                     style="display: none;">
                                     <?php } ?>

                                <label>Gst%:</label> <input type="text" class="form-control"
                                                            name="f_gst" 
                                                            id="f_gst" 
                                                            value="<?php echo $GLOBALS ['xGst']; ?>"readonly>
                            </div>


               





                    <div class="col-xs-2">
                        <label>Qty:</label> <input type="number" class="form-control"
                                                   name="f_qty" id="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>"
                                                   style="text-align: right;"
                                                   value="<?php echo $GLOBALS ['xQty']; ?>">
                    </div>

                    <?php
                    if ($GLOBALS ['xConfigSales_Discount'] == 'Yes') {
                        ?>
                        <div class="col-xs-1">
                        <?php } else { ?>
                            <div class="col-xs-1" style="display: none;">
                            <?php } ?>

                            <label>Disc %:</label> <input type="text" class="form-control"
                                                          name="f_discountpercentage" value="0">
                        </div>

                        <div class="col-xs-6" style="display: none">
                            <label>Description</label> <input type="text" class="form-control"
                                                              name="f_itemdescription">
                        </div>
                      



                        <div class="col-xs-2">
                            <label>MRP:</label> <input type="text" 
                                                       class="form-control" 
                                                       name="f_taxincluded" id="f_taxincluded" readonly
                                                       value="<?php echo $GLOBALS ['xMrp']; ?>"
                                                           onkeydown="javascript:if (event.which || event.keyCode) {
                                                                    if ((event.which == 13) || (event.keyCode == 13)) {
                                                                        document.getElementById('additemtosales').click();
                                                                    }
                                                                }
                                                                ;">
                        </div>
                    
                       
                    </div>

                    <div class="pull-right">

                        <div class="pull-right">
                            <?php if ($GLOBALS ['xMode'] == "") {
                                ?> 
                                <input type="submit" name="additemtosales" id="additemtosales" class="btn btn-danger"
                                       value="SAVE" id="save" accesskey="a"
                                       onclick="return validateForm()"> 
<?php } else { ?>
                                <input type="submit" name="updateitemtosales" id="updateitemtosales" class="btn btn-danger"
                                       value="UPDATE" accesskey="a" onclick="return validateForm()"> 
<?php } ?>
                        </div>
                        <!--
                            <input type="submit" name="additemtosales" class="btn btn-danger"
                                    value="ADD MORE" id="additemtosales" accesskey="a"
                                    onclick="return validateForm()">
!-->
                    </div>
                </div>

            </div>



<?php
fn_TempSalesCount();
$xCount = $GLOBALS ['xTempSalesCount'];
if ($xCount > 0) {
    ?>


                <table border="1">
                    <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="40%">Product Name</th>
                            <th width="10%">Qty</th>
                            <th width="10%">Rate</th>
    <?php if ($GLOBALS ['xConfigSales_Discount'] == 'Yes') { ?>
                                <th width="10%">Total Before Discount</th>
                                <th width="5%">Disc%</th>
                                <th width="5%">Disc Value</th>
                                <th width="10%">Total After Discount</th>
    <?php } ?>
                                             <?php
                            if ($GLOBALS ['xConfigSales_Gst'] == 'Yes') {
                              
                                ?>
                <th width="10%">GST%</th>
                            <th width="10%">GST Value</th>
                            <?php } ?>
            
                            <th width="10%">Amount</th>
                            <th colspan="2" width="5%">ACTIONS

                        </tr>
                    </thead>
                    <tbody>


    <?php
    $xSlNo = 0;
    $xQry = "SELECT *  from inv_salesentry WHERE salesinvoiceno=$xSalesInvoiceNo;";
    $result2 = mysql_query($xQry);
    while ($row = mysql_fetch_array($result2)) {
        $xSlNo += 1;
        echo '<tr>';
        finditemname($row ['itemno']);
         echo '<tr>';
        echo '<td>' . $xSlNo . '</td>';
        echo '<td>' . $GLOBALS ['xItemName'] . '</td>';

        $xQty = $row ['qty'];
        $xUnitRate = $row ['unitrate'];
        $xTotalBeforeDiscount = $xQty * $xUnitRate;
        $xDiscountPercentage = $row ['discountpercentage'];
        $xDiscountValue = round(($xTotalBeforeDiscount * ($xDiscountPercentage / 100)), 2);

        $xTotalAfterDiscount = $xTotalBeforeDiscount - $xDiscountValue;
        $xGst = $row ['vat'];

        $xGstValue = (round($xTotalAfterDiscount * ($xGst / 100), 2));

        // $xAmount = $row ['amount'];
        $xAmount = ($xTotalAfterDiscount + $xGstValue);
        $xTotalAmount += $xAmount;

        echo '<td align=left>' . $row ['qty'] . '</td>';
        echo '<td align=left>' . $row ['unitrate'] . '</td>';

        if ($GLOBALS ['xConfigSales_Discount'] == 'Yes') {
            echo '<td align=left>' . $xTotalBeforeDiscount . '</td>';
            echo '<td align=left>' . $row ['discountpercentage'] . '</td>';
            echo '<td align=left>' . $xDiscountValue . '</td>';
            echo '<td align=left>' . $xTotalAfterDiscount . '</td>';
        }
        echo '<td align=left>' . $row ['vat'] . '</td>';
        echo '<td align=left>' . $xGstValue . '</td>';
        echo '<td align=right>' . fn_RupeeFormat($xAmount) . '</td>';
        ?>   <td><a
                                        href="inv_ht004salesentry.php<?php echo '?txno=' . $row['txno'] . '&xmode=edit' ?>"
                                        onclick="return confirm_edit()" class="btn btn-info"> EDIT
                                    </a></td>

                                <td><a
                                        href="inv_ht004salesentry.php<?php echo '?txno=' . $row['txno'] . '&xmode=delete &passqty=' . $row['qty'] . ' &passitemno=' . $row['itemno'] . ' &passbatch=' . $row['batchid'] ?>"
                                        onclick="return confirm_delete()" class="btn btn-danger"> DELETE
                                    </a></td>

        <?php
        echo '</tr>';
    }
    ?>

                    </tbody>
                </table>

                <hr>

                <div class="panel panel-primary">

                    <div class="panel-body">
					 <div class="row">
                        <div class="col-xs-2">
                            <label>Date:</label> <input type="date" class="form-control" READONLY
                                                        id="txtDate"  name="f_date" value="<?php echo $GLOBALS ['xDate']; ?>"
                                                        placeholder="">
                         </div>





                        <div class="col-xs-6">


                            <label>Customer Name:</label> 
                            <a href="inv_hm007_customer.php" 
                               onclick="basicPopup(this.href);
                                       return false">New Customer</a>
                            <select class="form-control"
                                    name="f_customerno" id="f_customerno" >
                                <option>Choose Customer</option>
                               <?php
                               $result = mysql_query("SELECT *  FROM account_ledger
		where ledger_undergroup_no=5 
		order by ledger_name");
                               while ($row = mysql_fetch_array($result)) {
                                   ?>

                                    
                                    <option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
		if ($row ['account_ledger_id'] == $GLOBALS ['xCustomerNo']) {
			echo 'selected="selected"';
		}
		?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
                                        <?php
                                    }
                                    ?>
                            </select> 
                        </div>
                        <div class="col-xs-4">
                            <label>Mode of Payment</label> <select class="form-control"
                                                                   name="f_modeofpayment">
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Credit">Credit</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-xs-2" style="display: none;">
                            <label>Less Amount:</label> <input type="number" class="form-control"
                                                               value="0" name="f_lessamount">
                        </div>



    <?php
    if ($GLOBALS ['xConfigDespatch'] == 'Yes') {
        echo "<div class=col-xs-2>";
        ?>

                        <?php } else { ?>
                            <div class="col-xs-2" style="display: none;">
                        <?php } ?>

                            <label>Despatch Through</label> <input type="text"
                                                                   class="form-control" name="f_despatch">
                        </div>

    <?php
    if ($GLOBALS ['xConfigDestination'] == 'Yes') {
        echo "<div class=col-xs-2>";
        ?>

                        <?php } else { ?>
                            <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                            <label>Destination</label> <input type="text" class="form-control"
                                                              name="f_destination">
                        </div>


    <?php
    if ($GLOBALS ['xConfigDeliveryTerms'] == 'Yes') {
        echo "<div class=col-xs-2>";
        ?>
                        <?php } else { ?>
                            <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                           <label>Type</label> <select class="form-control"
				name="f_termsofdelivery">
				<option value="OP">OP</option>
				<option value="IP">IP</option>
				<option value="NON-OP">NON-OP</option>
				<option value="COURIER">COURIER</option>
			</select>
                        </div>
							<div class="col-xs-2" >
				<label>Paid</label> <input type="text"  
                                                           class="form-control"
					name="f_paidamount" id="f_paidamount"
					value="" onchange="CalculateBalance()">
			</div>
			
				<div class="col-xs-2">
                                    <label>Balance</label> <input type="text" readonly=""
                                                 class="form-control"
					name="f_balanceamount" id="f_balanceamount"
					value="">
                               
			</div>
                        <?php
    if ($GLOBALS ['xConfigSalesPerson'] == 'Yes') {
        echo "<div class=col-xs-2>";
        ?>

                        <?php } else { ?>
                            <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                
<label>Password</label> <span class="check" style="color:red;" ></span>
                        
                              <input type="password" name="username" value="user" class="form-control username" autocomplete="off" required="">
             
                        </div>

    <?php
    if ($GLOBALS ['xConfigVehicleNo'] == 'Yes') {
        echo "<div class=col-xs-2>";
        ?>

                        <?php } else { ?>
                            <div class="col-xs-2" style="display: none;">
                        <?php } ?>
                            <label>Vehicle No</label> <input type="text" class="form-control"
                                                             name="f_vehicleno">
                        </div>

    <?php
    if ($GLOBALS ['xConfigServiceCharges'] == 'Yes') {
        ?>
                            <div class="col-xs-2">
                        <?php } else { ?>
                                <div class="col-xs-2" style="display: none;">
                            <?php } ?>
                                <label>Service Charges</label> <input type="text"
                                                                      class="form-control" name="f_servicecharges">
                            </div>

                            <div class="col-xs-3" >
                                <label>Total Amount</label> <input type="text" readonly
                                                                   class="form-control" name="f_totalamount"
                                                                   id="f_totalamount"
                                                                   value="<?php echo $xTotalAmount ?>">
                            </div>
                                
                        </div>
                    </div>


                    <div class="pull-right">
                        <h1>
                            Rs
    <?php echo fn_RupeeFormat($xTotalAmount); ?>
                        </h1>
                        <input type="submit" name="saveall" id="saveall" class="btn btn-primary"
                               accesskey="s" value="CREATE BILL">

                    </div>


            </form>
    <?php
}
?>