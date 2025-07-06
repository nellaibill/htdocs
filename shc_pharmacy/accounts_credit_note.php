<?php
include 'globalfile.php';
$GLOBALS ['xcredit_note_date'] = $GLOBALS ['xCurrentDate'];

/*
 * $xPurchaseaccounts_credit_note_id=$_GET['passaccounts_credit_note_id'];
 * $xPurchaseInvoiceNo=$_GET['passpurchaseinvoiceno'];
 * $xItemNo=$_GET['passitemno'];
 */
fn_DataClear();
getconfig_purchase();

if (isset($_GET ['xmode']) && !empty($_GET ['xmode'])) {
$xMode=$_GET ['xmode'];
}
 else {
      $xMode='';  
 }

if (isset($_GET ['accounts_credit_note_id']) && !empty($_GET ['accounts_credit_note_id'])) {
    $no = $_GET ['accounts_credit_note_id'];
    if ($_GET ['xmode'] == 'edit') {
        $GLOBALS ['xMode'] = 'F';
        DataFetch($_GET ['accounts_credit_note_id']);
    } else {
        $xOldQty = $_GET ['qty'];
        $xItemNo = $_GET ['itemno'];
        $xBatchId = $_GET ['batchid'];
        $xExpDate = $_GET ['expdate'];
        $xMrp = $_GET ['mrp'];
        $xQry = "DELETE FROM accounts_credit_note 
		WHERE accounts_credit_note_id= $no";

        $xStockUpdateQry = "update inv_stockentry 
		set stock=stock-$xOldQty 
			where itemno=$xItemNo "
                . "and mrp=$xMrp "
                . "and batch='$xBatchId' "
                . "and expdate='$xExpDate'";
        // echo $xStockUpdateQry;
        $xQ1 = mysql_query($xQry);
        $xQ2 = mysql_query($xStockUpdateQry);


        if ($xQ1 and $xQ2) {
            mysql_query("COMMIT");
        } else {
            mysql_query("ROLLBACK");
        }


        header('Location: accounts_credit_note.php');
    }
} else if (isset($_POST ['save'])) {
    DataProcess("S");
} else if (isset($_POST ['update'])) {
    DataProcess("U");
} else if ($xMode == 'salesreturn') {
    $GLOBALS ['xDateExpired'] = $_GET ['expdate'];
    $GLOBALS ['xBatchId'] = $_GET ['batchid'];
    $GLOBALS ['xMrp'] = $_GET ['mrp'];
    $GLOBALS ['xItemNo'] = $_GET ['itemno'];
    $GLOBALS ['xCustomerNo'] = $_GET ['customerno'];
    $GLOBALS ['xOldQty'] = $_GET ['salesqty'];
    GetMaxIdNo();
} else {
  
    GetMaxIdNo();
}

function fn_DataClear() {
    $GLOBALS ['xaccounts_credit_note_id'] = '';
    $GLOBALS ['xItemNo'] = '';
    $GLOBALS ['xOldQty'] = '';
    $GLOBALS ['xReturnDetails'] = '';
    $GLOBALS ['xReturnQty'] = '';
    $GLOBALS ['xItemNo'] = 0;
    $GLOBALS ['xCustomerNo'] = 0;
    $GLOBALS ['xDateExpired'] = '';
    $GLOBALS ['xBatchId'] = '';
    $GLOBALS ['xMrp'] = '';
    $GLOBALS ['xOldQty'] = '';
}

function GetMaxIdNo() {
    $result = mysql_query("SELECT  CASE WHEN max(accounts_credit_note_id)IS NULL OR max(accounts_credit_note_id)= '' THEN '1' 
					  ELSE max(accounts_credit_note_id)+1 END AS accounts_credit_note_id FROM  accounts_credit_note") or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $GLOBALS ['xaccounts_credit_note_id'] = $row ['accounts_credit_note_id'];
    }
}

function DataFetch($xaccounts_credit_note_id) {
    $result = mysql_query("SELECT *  FROM accounts_credit_note where accounts_credit_note_id=$xaccounts_credit_note_id") or die(mysql_error());
    $count = mysql_num_rows($result);
    if ($count > 0) {
        while ($row = mysql_fetch_array($result)) {

            $GLOBALS ['xaccounts_credit_note_id'] = $row ['accounts_credit_note_id'];
            finditemname($row ['itemno']);
            $GLOBALS ['xItemNo'] = $row ['itemno'];
            /*
             * $GLOBALS ['xPurchaseaccounts_credit_note_id'] = $row ['purchaseaccounts_credit_note_id'];
             * $GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
             */
            $GLOBALS ['xOldQty'] = $row ['returnqty'];
            $GLOBALS ['xReturnDetails'] = $row ['returndetails'];
        }
    }
}

function DataProcess($mode) {
    $xaccounts_credit_note_id = $_POST ['f_accounts_credit_note_id'];
    $xcredit_note_date = $_POST ['f_creditnote_date'];
    /*
     * $xPurchaseaccounts_credit_note_id= $_POST ['f_purchaseaccounts_credit_note_id'];
     * $xPurchaseInvoiceNo= $_POST ['f_purchaseinvoiceno'];
     */
    $xPartyNo = $_POST ['f_party_no'];
    $xItemNo = $_POST ['f_itemno'];

    $xOldQty = $_POST ['f_oldqty'];
    $xReturnQty = $_POST ['f_returnqty'];
    if($xOldQty>=$xReturnQty){
    $xReturnDetails = $_POST ['f_returndetails'];
    //$xCurrentUser = $GLOBALS ['xCurrentUser'];
    $xCurrentUser = "";
    $xCurrentDate = $GLOBALS ['xCurrentDateTime'];
    $xExpiredDate = $_POST ['f_expdate'];
    $xMrp = $_POST ['f_mrp'];
    if (empty($_POST ['f_batchid'])) {
        $xBatchId = "";
    } else {
        $xBatchId = $_POST ['f_batchid'];
    }
    $xQry = "";
    $xStockUpdateQry = "";
    $xMsg = "";
    if ($mode == 'S') {
        $xQry = "INSERT INTO accounts_credit_note 
		(accounts_credit_note_id,ledger_no,
credit_note_date,
itemno,qty,details,
created_as_on,
updated_as_on,
logged_user,batchid,expdate,mrp) 
			VALUES ($xaccounts_credit_note_id,$xPartyNo,
'$xcredit_note_date',
$xItemNo,
$xReturnQty,
'$xReturnDetails',
'$xCurrentDate','$xCurrentDate',
'$xCurrentUser','$xBatchId','$xExpiredDate',$xMrp)";
        $xStockUpdateQry = "update inv_stockentry set 
		stock=stock+$xReturnQty 
where itemno=$xItemNo 
		and batch='$xBatchId'";
        $xMsg = "Inserted";
    }

    $xQ1 = mysql_query($xQry);
    $xQ2 = mysql_query($xStockUpdateQry);
    if ($xQ1 and $xQ2) {
        mysql_query("COMMIT");
    } else {
        mysql_query("ROLLBACK");
    }

    GetMaxIdNo();
    }
 else {
    echo '<script type="text/javascript">alert("Quantity Exceeds");</script>';
    //  header('Location: inv_hr004_e_salesbycustomer_item.php');
       echo '<H1><a href=inv_hr004_e_salesbycustomer_item.php>GO BACK</a></h1>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SALES-RETURN</title>
        <script type="text/javascript">


            function validateForm()
            {

                var xQty = document.forms["salesreturnform"]["f_returnqty"].value;
                if (xQty == "")
                {
                    alert("Enter Qty");
                    document.salesreturnform.f_returnqty.focus();
                    return false;
                }

            }

        </script>
    </head>

    <body onload='document.credit_note.f_returnqty.focus()'>
        <form class="form" name="credit_note"
              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading  text-center">
                    <h3 class="panel-title">Sales Return</h3>
                </div>
                <div class="panel-body">


                    <div class="col-xs-2">
                        <label>Credit Note No :</label> <input type="text"
                                                               class="form-control" name="f_accounts_credit_note_id"
                                                               value="<?php echo $GLOBALS ['xaccounts_credit_note_id']; ?>"
                                                               readonly>
                    </div>
                    <div class="col-xs-2">
                        <label>Date:</label> <input type="date" class="form-control"
                                                    name="f_creditnote_date"
                                                    value="<?php echo $GLOBALS ['xcredit_note_date']; ?>">
                    </div>
                    <div class="col-xs-4">
                        <label>Party Name:</label> <select class="form-control" readonly
                                                           name="f_party_no">

<?php
$result = mysql_query("SELECT *  FROM account_ledger 
		where ledger_undergroup_no=5 
		order by ledger_name");
echo "<option value=0>Choose</option>";
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
                        <label>Item Name:</label> <select class="form-control" readonly
                                                          name="f_itemno">
<?php
$result = mysql_query("SELECT *  FROM  m_item order by itemname ");
echo "<option value=0>Choose</option>";
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



<?php
if ($GLOBALS ['xConfigPurchase_Batch'] == 'Yes') {
    echo "<div class=col-xs-2>";
    ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                    <?php } ?>
                        <label>BatchId:</label> <input type="text"  readonly
                                                       class="form-control"
                                                       name="f_batchid"  required="required"
                                                       value="<?php echo $GLOBALS ['xBatchId']; ?>">
                    </div>

<?php
if ($GLOBALS ['xConfigPurchase_Expiry'] == 'Yes') {
    echo "<div class=col-xs-2>";
    ?>

                    <?php } else { ?>
                        <div class="col-xs-2" style="display: none;">
                    <?php } ?>
                        <label>Expiry-Date:</label> <input type="date" class="form-control" readonly
                                                           name="f_expdate" required="required"
                                                           value="<?php echo $GLOBALS ['xDateExpired']; ?>">
                    </div>
                    <div class="col-xs-2">
                        <label>Old Qty:</label> <input type="number" class="form-control" 
                                                       name="f_oldqty" value="<?php echo $GLOBALS ['xOldQty']; ?>"
                                                       readonly>
                    </div>	 
                    <div class="col-xs-2">
                        <label>Qty:</label> <input min="0" max="99999" maxlength="5"
                                                   class="form-control" name="f_returnqty" required="required"
                                                   value="<?php echo $GLOBALS ['xReturnQty']; ?>"
                                                   style="text-align: right;">
                    </div>

                    <div class="col-xs-2">
                        <label>MRP:</label> <input  maxlength="5" readonly
                                                    class="form-control" name="f_mrp"
                                                    value="<?php echo $GLOBALS ['xMrp']; ?>"
                                                    style="text-align: right;">
                    </div>
                    <div class="col-xs-4" style=" display: none">
                        <label>Narration:</label>
                        <textarea class="form-control" rows="5" name ="f_returndetails" id="f_returndetails"></textarea>

                    </div>


                </div>

                <div class="panel-footer clearfix">
                    <div class="pull-right">
<?php if ($GLOBALS ['xMode'] == "") { ?> 
                                <input type="submit" name="update" class="btn btn-primary"
                                   value="Update" onclick="return validateForm()"> 
                        <?php } else { ?>
						           <input type="submit" name="save" class="btn btn-primary"
                                   value="Save" id="save" accesskey="s" onclick="return validateForm()"> 
             
                               <?php } ?>
                    </div>
                </div>


            </div>
        </form>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col-xs-3">

						From Date:<input type="date" class="form-control"
							name="f_fromdate"
							value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
					</div>

					<div class="col-xs-3">

						To Date:<input type="date" class="form-control" name="f_todate"
							value="<?php echo $GLOBALS ['xInvToDate']; ?>">
					</div>
					<div class="col-xs-2">
						<input type="submit" name="report_date" class="btn btn-primary"
							value="VIEW">
                                        </div></br></br></br>
				</form>
        <?php
        if (isSet ( $_POST ['report_date'] )) {
            	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
            ?>
        
        <hr>
        <!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
        <div id="divToPrint">
            <div class="container">
                <div class="panel panel-info">
                    <!-- Default panel contents -->

                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th width="5%">S.No</th>
 <th align="right" width="15%">PatientName</th>
<th align="right" width="15%">ItemName</th>
 <th align="right" width="10%">ReturnDate</th>
                                <th align="right" width="10%">ReturnQty</th>
                                <th align="right" width="10%">Rate</th>
								 <th align="right" width="10%">GST(%)</th>
								 		 <th align="right" width="10%">GSTVALUE</th>
                                <th width="10%">Batch</th>
                                <th width="10%">ExpiryDate</th>
                                <th width="10%" >Total</th>
                                <th colspan="2" width="5%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGstValue=0;
$xGst=0;
$xTotalGstValue=0;
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
$xGrandTotal=0;
$xQry = "SELECT *  from accounts_credit_note where "
        . "credit_note_date>='$xFromDate' and "
        . "credit_note_date<='$xToDate'";
$result2 = mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
//echo $xQry;
echo '</br>';
?>
<b><?php echo "Sales Return Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
<?php
while ($row = mysql_fetch_array($result2)) {
    ?>
                                <tr>
                                <?php
                                echo '<td>' . $xSlNo += 1 . '</td>';
                                finditemname($row ['itemno']);
								findcustomername ( $row ['ledger_no'] );
								       	echo '<td align=left>' . $GLOBALS ['xCustomerName'] . '</td>';
                                echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
								echo '<td align=right>' . $row ['credit_note_date'] . '</td>';
                                echo '<td align=right>' . $row ['qty'] . '</td>';
								$xGst=$GLOBALS ['xGst'];
								 $xMrp=$row ['mrp'];
								 $xMrp=$xMrp/(($xGst/100)+1);
								 //$xMrp=$xMrp-($xMrp*$xGst/100);
								         $xQtyIntoMrp = $row ['qty'] * $xMrp;
                                echo '<td align=right>' . round($xMrp,2) . '</td>';
								 
														
														$xGstValue=($xQtyIntoMrp*($xGst/100));
														$xTotalGstValue+=$xGstValue;
														$xGrandTotal += $xQtyIntoMrp;
	
		
		if($xGst==0.00)
		{
			
			$xVatZeroValue+=$xGstValue;
			$xVatItemZeroValue+=$xQtyIntoMrp;
		}
		if($xGst==5.00)
		{
			$xVatFiveValue+=$xGstValue;
				$xVatItemFiveValue+=$xQtyIntoMrp;
		}
		if($xGst==12.00)
		{
			$xVatTwelveValue+=$xGstValue;
							$xVatItemTwelveValue+=$xQtyIntoMrp;
		}
			if($xGst==18.00)
		{
			$xVatEighteenValue+=$xGstValue;
							$xVatItemEighteenValue+=$xQtyIntoMrp;
		}
		
			if($xGst==28.00)
		{
			$xVatTwentyEightValue+=$xGstValue;
							$xVatItemTwentyEightValue+=$xQtyIntoMrp;
		}
								echo '<td align=right>' . $xGst . '</td>';
								echo '<td align=right>' . round($xGstValue,2) . '</td>';
                                echo '<td align=right> ' . $row ['batchid'] . '</td>';
                                echo '<td align=right>' . $row ['expdate'] . '</td>';
                        
                                echo '<td align=right>' . round(($xQtyIntoMrp+$xGstValue),2) . '</td>';
								
								 echo '<td align=right>' . $row ['updated_as_on'] . '</td>';
                                ?>

                                    <!-- 
                                    
                                    Mark Saleem 27/Nov/2015 Edit Option Removed 
                                    Reason While changing the item name Old Qty ,New Qty Problem Arises 
                                    
                                    <td><a href="inv_ht004_a_salesreturn.php<?php echo '?accounts_credit_note_id=' . $row['accounts_credit_note_id'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
                                    <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
                                    </a>
                                    </td>
                                    
                                   
                                    <td><a
                                            href="accounts_credit_note.php<?php
                                echo '?accounts_credit_note_id=' . $row['accounts_credit_note_id'] .
                                '&qty=' . $row['qty'] .
                                '&itemno=' . $row['itemno'] .
                                '&mrp=' . $row['mrp'] .
                                '&batchid=' . $row['batchid'] .
                                '&expdate=' . $row['expdate'] .
                                '&xmode=delete';
                                ?>"
                                            onclick="return confirm_delete()"> <img
                                                src="images/delete.png"
                                                style="width: 30px; height: 30px; border: 0">
                                        </a></td> !-->

    <?php
    echo '</tr>';

}
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
	$xGrandVat=$xVatZeroValue+$xVatFiveValue+$xVatTwelveValue+$xVatEighteenValue+$xVatTwentyEightValue;
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
?>	






                        </tbody>
                    </table>
                </div>
                <!-- /container -->
            </div>
        </div>
        <!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
    </body>