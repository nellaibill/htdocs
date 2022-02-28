<?php
include_once 'globalfile.php';

?>
<?php
	$xFromDate = $GLOBALS ['xCurrentDate'] ;
	$xToDate   =   $GLOBALS ['xCurrentDate'] ;
	$xTotalAmountForCash=0;
	$xTotalAmountForCard=0;
	$xTotalAmountForSalesReturn=0;
	$xTotalAmount=0;
$xQry = "SELECT * from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'";
        $xQryForTotalAmount = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where date>= '$xFromDate' AND date<= '$xToDate'";
        
        $xQryForCash = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where modeofpayment='Cash' and date>= '$xFromDate' AND date<= '$xToDate'";
        
         $xQryForCard = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where modeofpayment='Card' and date>= '$xFromDate' AND date<= '$xToDate'";
         
                  $xQryForSalesReturn = "SELECT qty,mrp from accounts_credit_note "
                . "where  credit_note_date>= '$xFromDate' AND credit_note_date<= '$xToDate'";
                  
         $xResultForTotalAmount = mysql_query ( $xQryForTotalAmount );
	while ( $row = mysql_fetch_array ( $xResultForTotalAmount ) ) {
            $xTotalAmount=$row ['totalamount'];
        }
        
    
        $xResultForCash = mysql_query ( $xQryForCash );
	while ( $row = mysql_fetch_array ( $xResultForCash ) ) {
            $xTotalAmountForCash=$row ['totalamount'];
        }
        
             $xResultForCard = mysql_query ( $xQryForCard );
	while ( $row = mysql_fetch_array ( $xResultForCard ) ) {
            $xTotalAmountForCard=$row ['totalamount'];
        }
        
             $xResultForSalesReturn = mysql_query ( $xQryForSalesReturn );
	while ( $row = mysql_fetch_array ( $xResultForSalesReturn ) ) {
            $xQty=$row ['qty'];
                 $xMrp=$row ['mrp'];
                   $xTotalAmountForSalesReturn+=$xQty*$xMrp;
        }
$xTotalAmount=$xTotalAmountForCash+$xTotalAmountForCard-$xTotalAmountForSalesReturn;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'title.php'?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css" />

<script type="text/javascript">
// JavaScript popup window function

function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=1300,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
}


</script>
<style >
.table-fixheader {
    position: relative;
    padding-top: 40px;
}
.table-fixheader>div {
    height:150px;
    overflow-y:auto;
}
.table-fixheader thead{
    position: absolute;
    width: 100%;
    top: 0;
}
.table-fixheader thead tr{
    position: absolute;
    width: 100%;
}
.table-fixheader thead tr th{
    display:inline-block;
}
</style>


</head>
<body>

		<div class="row">
            <div class="col-sm-3" >
                <div class="panel panel-success">
                   <h2> <div class="panel-heading">Cash Amount- <?php echo $xTotalAmountForCash; ?></div></h2>
				</div>
			</div>
			<div class="col-sm-3" >
                <div class="panel panel-success">
                   <h2>  <div class="panel-heading">Card Amount- <?php echo $xTotalAmountForCard; ?></div></h2>
				</div>
			</div>
				<div class="col-sm-3" >
                <div class="panel panel-success">
                  <h2>   <div class="panel-heading">Sales Return- <?php echo $xTotalAmountForSalesReturn; ?></div></h2>
				</div>
			</div>
				<div class="col-sm-3" >
                <div class="panel panel-success">
                  <h2>  <div class="panel-heading">Total Amount- <?php echo $xTotalAmount; ?> </div></h2>
				</div>
			</div>
		</div>
            
			<div class="row">
			   
            <div class="col-sm-6" >
                <div class="panel panel-primary">
                    <div class="panel-heading">Last 5 Sales</div>
                    <div class="panel-body">
					<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>
					
							<th>Inv.No</th>
							<th>Customer Name</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Print</th>
							<th>Edit</th>
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

$xQry = "SELECT t1.customerno as customerno,salesinvoiceno,date,totalamount 
from inv_salesentry1 as t1 ,account_ledger as t2
      where  t1.customerno=t2.account_ledger_id 
        order by t1.salesinvoiceno desc limit 5";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findcustomername ( $row ['customerno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr004_e_salesbycustomer_item.php<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>"> <?php echo  $row ['salesinvoiceno']?>'>
<?php
		
		echo '<td align=left>' . $row ['salesinvoiceno'] . '</td>';
		echo '<td align=left>' . $GLOBALS ['xCustomerName'] . '</td>';
		echo '<td align=left>' . date ( 'd/M/y', strtotime ( $row ['date'] ) ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		?>

	<td><a
								href="<?php echo $xPrintTemplate .'?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>">
									PRINT </a></td>
                                                                            <?php if($xUserRole=='A'){?>
							<td><a
								href="inv_ht004salesentry.php
						<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno']  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
                                                        <?php } ?>
<?php
		$xGrandTotal += $row ['totalamount'];
		echo '</tr>';
	}
	

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
           
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Last 5 Purchase</div>
                    <div class="panel-body">
					<table border="1" class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Inv.No</th>
                            <th>Supplier Name</th>
                            <th>Date</th>
                            <th>Amount</th>
     <th>Print</th>
                            <th>Edit</th> 
                        </tr>
                    </thead>


                    <tbody class="searchable">

                        <?php
                        $xQry = '';
                        $xSlNo = 0;
                        $xGrandVat = 0;
                        $xGrandDiscount = 0;
                        $xGrandTotal = 0;
                        $xGrandNetTotal = 0;
                        $xGrandProfit = 0;
                        $xGrandFrieght = 0;
                        $xGrandOthers = 0;
                        if (isSet($_POST['save'])) {
                            $xFromDate = $_POST['reportfromdate'];
                            $xToDate = $_POST['reporttodate'];
                        }

                        $xQry = "SELECT p.supplierno as supplierno,purchaseinvoiceno,date,
totalamount,freight,others  from inv_purchaseentry1 as p ,
account_ledger as al
      where  p.supplierno=al.account_ledger_id
        order by p.purchaseinvoiceno desc limit 5";

                        $result2 = mysql_query($xQry);
                        $rowCount = mysql_num_rows($result2);

                        if (mysql_num_rows($result2)) {
                            $xGrandTotal = 0;
                            while ($row = mysql_fetch_array($result2)) {
                                $xSlNo += 1;
                                findsuppliername($row ['supplierno']);
                                ?>
                                <tr class='clickable-row' data-href='inv_hr003_e_purchasebysupplier_item.php<?php echo '?passpurchaseinvoiceno=' . $row['purchaseinvoiceno'] . '&xmode=report'; ?>"> <?php echo $row ['purchaseinvoiceno'] ?>'>
                                    <?php
                                    echo '<td>' . $xSlNo . '</td>';
                                    echo '<td align=left>' . $row ['purchaseinvoiceno'] . '</td>';
                                    echo '<td align=left>' . $GLOBALS ['xSupplierName'] . '</td>';
                                    echo '<td align=left>' . date('d/M/y', strtotime($row ['date'])) . '</td>';
                                    echo '<td align=right>' . fn_RupeeFormat($row ['totalamount']) . '</td>';
                 $xPrintTemplate="print_purchase.php";
                                    ?>	
									<td><a
								href="<?php echo $xPrintTemplate .'?purchaseinvoiceno='.$row['purchaseinvoiceno'] . '&xmode=report'; ?>">
									PRINT </a></td>
                                    <?php if ($xUserRole == 'A') { ?>
                                        <td><a href="inv_ht003purchaseentry.php<?php echo'?passpurchaseinvoiceno=' . $row['purchaseinvoiceno'] ?>"
                                                onclick="return confirm_edit()"> <img src="images/edit.png"
                                                                                  style="width: 30px; height: 30px; border: 0">
                                            </a></td>
                                    <?php } ?>
                                    <?php
                                    $xGrandTotal += $row ['totalamount'];
                                    $xGrandFrieght += $row ['freight'];
                                    $xGrandOthers += $row ['others'];
                                    echo '</tr>';
                                }

                       
                            } else {
                                fn_NoDataFound();
                            }
                            ?>	




                    </tbody>
                </table>

					</div>
                </div>
            </div>
        </div>
		
	
            
  
	<div id="footer">
		<table>
			<tr>
				<td style="size: 12px; font-family: 'Courier New', Courier, monospace; color: red;">Developed and Maintained By [Nellai Bill] -86 37 41 77 53
				</td>
			</tr>
		</table>
	</div>


</body>

</br>
	<div class="row">
            <div class="col-sm-6" >
                <div class="panel panel-success">
                    <div class="panel-heading">Stock Logs[LAST 5]</div>
					
					<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>

						
							<th>Item Name</th>
                                                        <th>Qty</th>
                                                         <th>Date-Time</th>
                                                         <th>What Happen</th>
			
						</tr>
					</thead>


					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

$xQry = "SELECT * from audit_stock  order by audit_stock_datetime desc limit 5";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		?>
<tr>    
<?php
	finditemname( $row ['audit_stock_itemno'] );

		echo '<td align=left>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td align=right>' .$row ['audit_stock_qty'] . '</td>';
		
                echo '<td align=right>' .$row ['audit_stock_datetime'] . '</td>';
                echo '<td align=right>' .$row ['audit_stock_mode'] . '</td>';


	}
	

} 

else {

}

?>	

					
					
					
					</tbody>
				</table>

				
				</div>
			</div>

		
		
		  <div class="col-sm-6" >
                <div class="panel panel-success">
                    <div class="panel-heading">Sales Return[LAST 5]</div>
		
                    <table class="table">
                        <thead>
                            <tr>
                       

                                <th align="right" width="30%">ItemName</th>
 <th align="right" width="10%">ReturnDate</th>
                                <th align="right" width="10%">ReturnQty</th>
                                <th align="right" width="10%">MRP</th>
   
                                <th width="10%" >Total</th>
                              
                            </tr>
                        </thead>
                        <tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from accounts_credit_note order by accounts_credit_note_id desc limit 5";
$result2 = mysql_query($xQry);
$rowCount = mysql_num_rows($result2);

while ($row = mysql_fetch_array($result2)) {
    ?>
                                <tr>
                                <?php
                                finditemname($row ['itemno']);
                                echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
echo '<td align=right>' . $row ['credit_note_date'] . '</td>';
                                echo '<td align=right>' . $row ['qty'] . '</td>';
                                echo '<td align=right>' . $row ['mrp'] . '</td>';

                                $xQtyIntoMrp = $row ['qty'] * $row ['mrp'];
                                echo '<td align=right>' . $xQtyIntoMrp . '</td>';
   
    echo '</tr>';
}
  
?>	






                        </tbody>
                    </table>
								</div>
			</div>

		</div>
</html>
