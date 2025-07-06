
<?php
ob_start();
include 'globalfile.php';
$xPrintTemplate="print_format_estimate.php";
fn_DataClear();
$xCurrentQty = 0;
$xTotalAmount = 0;
$xTempSalesQty = $GLOBALS ['xTempSalesQty'];
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
if (isset($_GET ['estimate_txno']) && !empty($_GET ['estimate_txno'])) {
    $xEstimate_TxNo = $_GET ['estimate_txno'];
    if ($_GET ['xmode'] == 'edit') {
        $GLOBALS ['xMode'] = 'F';
        DataFetch($_GET ['estimate_txno']);
    } else {
        $xQry = "DELETE FROM inv_estimateentry WHERE estimate_txno= $xEstimate_TxNo";
        mysql_query($xQry);
        GetMaxIdNo();
        header('Location: estimate_entry.php');
    }
} else if (isset($_POST ['saveall'])) {
    $xCustomerNo = $_POST ['f_customerno'];
    $xTotalAmount = $_POST ['f_totalamount'];
    $xDate = $_POST ['f_date'];

    fn_GetSalesInvoiceNo();
    $xEstimateId = $GLOBALS ['xEstimateId'];
    
    $xQry = "insert into inv_estimateentry1 (estimate_id,estimate_date,estimate_customerno,
	estimate_totalamount)
	values($xEstimateId,'$xDate',$xCustomerNo,$xTotalAmount)";
    echo $xQry;
    $xQ1 = mysql_query($xQry);

    $xQry = "update inv_estimateentry
	set estimate_date='$xDate'
	where  estimate_id=$xEstimateId";
       echo $xQry;
    $xQ2 = mysql_query($xQry);

    if ($xQ1 and $xQ2) {
        mysql_query("COMMIT");
        echo "<meta http-equiv='refresh' content='0'>";
        // unset($_POST);
        $xPrintLink = "<script>window.open('$xPrintTemplate?estimate_id=$xEstimateId')</script>";
        echo $xPrintLink;
        if ($xPrintLink) {
            echo "<script>window.close();</script>";
        }
    } else {
        mysql_query("ROLLBACK");
    }
} else {
    GetMaxIdNo();
}
$GLOBALS ['xCurrentDate'] = date('Y-m-d H:i:s');
if (isset($_POST ['additemtoestimate'])) {

    DataProcess("S");
} elseif (isset($_POST ['updateitemtoestimate'])) {
    DataProcess("U");
}

function fn_DataClear() {
    $GLOBALS ['xEstimateTxNo'] = '';
    $GLOBALS ['xEstimateId'] = '';
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
    $xQry = "SELECT  CASE WHEN max(estimate_id)IS NULL OR max(estimate_id)= ''
   THEN '1' 
   ELSE max(estimate_id)+1 END AS estimate_id
FROM inv_estimateentry1";

    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xEstimateId'] = $row ['estimate_id'];
        $xEstimateId = $GLOBALS ['xEstimateId'] + 1;
    }
    GetMaxEstimateTxNo();
}

function fn_GetSalesInvoiceNo() {
    $xQry = "SELECT  estimate_id from inv_estimateentry";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xEstimateId'] = $row ['estimate_id'];
    }
}

function GetMaxEstimateTxNo() {
    $xQry = "SELECT  CASE WHEN max(estimate_txno)IS NULL OR max(estimate_txno)= ''
				THEN '1' ELSE max(estimate_txno)+1 END AS estimate_txno FROM inv_estimateentry";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xEstimateTxNo'] = $row ['estimate_txno'];
    }
}

function fn_TempSalesCount() {
    $xEstimateId = $GLOBALS ['xEstimateId'];
    $result = mysql_query("SELECT *  FROM inv_estimateentry where estimate_id=" . $xEstimateId) or die(mysql_error());
    $GLOBALS ['xTempSalesCount'] = mysql_num_rows($result);
}

function DataFetch($xEstimateTxNo) {
    $xQry = "SELECT *  FROM inv_estimateentry where estimate_txno=$xEstimateTxNo";
    $result = mysql_query($xQry) or die(mysql_error());
    $count = mysql_num_rows($result);
    if ($count > 0) {
        while ($row = mysql_fetch_array($result)) {
            $GLOBALS ['xEstimateTxNo'] = $row ['estimate_txno'];
            $GLOBALS ['xEstimateId'] = $row ['estimate_id'];
            $GLOBALS ['xQty'] = $row ['qty'];
            $GLOBALS ['xItemNo'] = $row ['itemno'];
            $GLOBALS ['xMrp'] = $row ['amount'];
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
    $xEstimateTxNo = $_POST ['f_estimate_txno'];
    $xEstimateId = $_POST ['f_estimate_id'];
    $xItemNo = $_POST ['f_itemno'];
    $xQty = $_POST ['f_qty'];
    $xMrp = $_POST ['f_mrp'];

    //$xCreatedDate = $GLOBALS ['xCurrentDate'];
    //$xUpdatedDate = $GLOBALS ['xCurrentDate'];
    $xQry = "";
    $xMsg = "";
    if ($mode == 'S') {


        $xQry = "INSERT INTO inv_estimateentry
	   (estimate_txno,estimate_id, itemno,qty,amount)
		VALUES ($xEstimateTxNo,$xEstimateId,$xItemNo,$xQty,$xMrp)";
        $xMsg = "Inserted";

        $retval = mysql_query($xQry) or die(mysql_error());
        if (!$retval) {
            die('Could not enter data: ' . mysql_error());
        } else {
            
        }

        header('Location: estimate_entry.php');
    } elseif ($mode == 'U') {
        $xQry = "UPDATE inv_estimateentry
			set qty=$xQty,amount=$xMrp WHERE estimate_txno=$xEstimateTxNo";
        $xMsg = "Updated";
        $retval = mysql_query($xQry) or die(mysql_error());
        if (!$retval) {
            die('Could not enter data: ' . mysql_error());
        } else {

            header('Location: estimate_entry.php');
        }
    }

    GetMaxIdNo();
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SALES-ENTRY</title>

        <script type="text/javascript">

            function basicPopup(url) {
                popupWindow = window.open(url, 'popUpWindow', 'height=400,width=800,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
            }
            function validateForm()
            {
                var xItemNo = document.forms["estimateentryform"]["f_itemno"].value;
                if (xItemNo == "0")
                {
                    alert("Please Choose an Item");
                    document.estimateentryform.f_itemno.focus();
                    return false;
                }


                var xQty = document.forms["estimateentryform"]["f_qty"].value;

                if (xQty == "")
                {
                    alert("Enter Qty");
                    document.estimateentryform.f_qty.focus();
                    return false;
                }

            }


        </script>
    </head>
    <body onLoad="document.estimateentryform.f_itemno.focus()">
        <form class="form" name="estimateentryform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="panel panel-default">

                <div class="panel-heading  text-center">
                    <h1 class="panel-title">
                        ESTIMATE-NO <B> <?php echo $GLOBALS ['xEstimateId']; ?> </B>
                    </h1>
                </div>


                <div class="panel-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="col-xs-1">
                                <label>Tx.No :</label> <input type="text" class="form-control"
                                                              name="f_estimate_txno" value="<?php echo $GLOBALS ['xEstimateTxNo']; ?>" readonly>
                            </div>


                            <div class="col-xs-1">


                                <label>InvNo:</label> <input type="text" class="form-control"
                                                             name="f_estimate_id"
                                                             value="<?php echo $GLOBALS ['xEstimateId']; ?>" readonly>
                            </div>

                            <div class="col-xs-6">
                                <label>Item Name:</label> <select class="form-control"
                                                                  name="f_itemno" id="f_itemno" onchange="GetBatch();">
                                    <option value="0">Choose Item</option>
                                    <?php
                                    $result = mysql_query("SELECT *  FROM m_item  order by itemname");
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



                            <div class="col-xs-2">
                                <label>Qty:</label> <input type="number" class="form-control"
                                                           name="f_qty" id="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>"
                                                           style="text-align: right;"
                                                           value="<?php echo $GLOBALS ['xQty']; ?>">
                            </div>




                            <div class="col-xs-2">
                                <label>MRP:</label> <input type="text" 
                                                           class="form-control" 
                                                           name="f_mrp" id="f_mrp"
                                                           value="<?php echo $GLOBALS ['xMrp']; ?>"
                                                           onblur="CalculateUnitRate()"
                                                           onkeydown="javascript:if (event.which || event.keyCode) {
                                                                         if ((event.which == 13) || (event.keyCode == 13)) {
                                                                             document.getElementById('additemtoestimate').click();
                                                                         }
                                                                     }
                                                                     ;">
                            </div>


                        </div>
                    </div>
                </div>
                <div class="pull-right">

                    <div class="pull-right">
                        <?php if ($GLOBALS ['xMode'] == "") {
                            ?> 
                            <input type="submit" name="additemtoestimate" id="additemtoestimate" class="btn btn-danger"
                                   value="SAVE" id="save" accesskey="a"
                                   onclick="return validateForm()"> 
                               <?php } else { ?>
                            <input type="submit" name="updateitemtoestimate" id="updateitemtoestimate" class="btn btn-danger"
                                   value="UPDATE" accesskey="a" onclick="return validateForm()"> 
                               <?php } ?>
                    </div>
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

                        <th width="10%">Amount</th>
                        <th colspan="2" width="5%">ACTIONS

                    </tr>
                </thead>
                <tbody>


                    <?php
                    $xSlNo = 0;
                    $xQry = "SELECT *  from inv_estimateentry WHERE estimate_id=$xEstimateId;";
                    $result2 = mysql_query($xQry);
                    while ($row = mysql_fetch_array($result2)) {
                        $xSlNo += 1;
                        echo '<tr>';
                        finditemname($row ['itemno']);
                        ?>
                        <tr class='clickable-row'
                            data-href="estimate_entry.php<?php echo '?estimate_id=' . $row['estimate_id'] . '&xmode=edit'; ?>">
                                <?php
                                echo '<td>' . $xSlNo . '</td>';
                                echo '<td>' . $GLOBALS ['xItemName'] . '</td>';

                                $xQty = $row ['qty'];
                                $xAmount = $row ['amount'];
                                $xNetTotal = $xQty * $xAmount;
                                  $xTotalAmount  += $xQty * $xAmount;
                                echo '<td align=left>' . $row ['qty'] . '</td>';
                                echo '<td align=left>' . $row ['amount'] . '</td>';
                                echo '<td align=right>' . fn_RupeeFormat($xNetTotal) . '</td>';
                                ?>

                            <td><a
                                    href="estimate_entry.php<?php echo '?estimate_txno=' . $row['estimate_txno'] . '&xmode=delete '?>"
                                    onclick="return confirm_delete()"> <img src="images/delete.png"
                                                                        style="width: 30px; height: 30px; border: 0">
                                </a></td>

                            <?php
                            echo '</tr>';
                        }
                        ?>

                </tbody>
            </table>

            <hr>

                <div class="row">

                    <div class="col-xs-2">
                        <label>Date:</label> <input type="date" class="form-control"
                                                    id="txtDate"  name="f_date" value="<?php echo $GLOBALS ['xDate']; ?>"
                                                    >

                    </div>

                    <div class="col-xs-6">
                        <label>Customer Name:</label> 
                        <a href="inv_hm007_customer_mini.php" 
                           onclick="basicPopup(this.href);
                                   return false">New Customer</a>
                        <select class="form-control"
                                name="f_customerno" id="f_customerno">
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

                                    <?php echo $row['ledger_name'] . "-" . $row['ledger_unique_no']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select> 
                    </div>

     
                <div class="col-xs-3">
                    <input type="hidden" name="f_totalamount"  id="f_totalamount" value="<?php echo $xTotalAmount; ?>">
                              <h1 >
                        Rs
                        <?php echo fn_RupeeFormat($xTotalAmount); ?>
                    </h1>
                                          <input type="submit" name="saveall" id="saveall" class="btn btn-primary"
                           accesskey="s" value="CREATE ESTIMATE">
                    </div>

                </div>

        </form>
        <?php
    }
    ?>