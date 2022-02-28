<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xCurrentDate'];
$xToDate = $GLOBALS ['xCurrentDate'];
$xUserRole = $GLOBALS ['xUserRole'];
$xQryFilter = '';
if (isset($_GET ['passsupplierno']) && !empty($_GET ['passsupplierno'])) {
    $xSupplierNo = $_GET ['passsupplierno'];
    $xQryFilter = $xQryFilter . ' ' . "and supplierno=$xSupplierNo";
} else {
    // if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
    $xQryFilter = '';
}
?>
<title>Consolidated-Purchase</title>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
    <div class="panel-body">
        <div class="form-group">

            <div class="col-xs-3">
                <label>Report From Date</label>
                <input type="date" class="form-control"  name="reportfromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
            </div>


            <div class="col-xs-3">
                <label>Report To Date</label>
                <input type="date" class="form-control"  name="reporttodate" value="<?php echo $GLOBALS ['xToDate']; ?>">
            </div>

            <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >

        </div></div>

</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
    <div class="panel panel-primary">
        <div class="panel-heading  text-center">
            <b><?php echo "Purchase Details  From[" . date('d/M/y', strtotime($xFromDate)) . "]TO [" . date('d/M/y', strtotime($xToDate)) . "] As On " . date("d/M/y h:i:sa"); ?></b>

        </div>
        <div class="panel-body">

            <div class="container">
                <!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
                <input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
				<table border="1" class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Inv.No</th>
                            <th>Supplier Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                              <th>Company Inv No</th>
                            <th>Frieght</th>
                            <th>Others</th>
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
                        $xNetTotal=0;
                        if (isSet($_POST['save'])) {
                            $xFromDate = $_POST['reportfromdate'];
                            $xToDate = $_POST['reporttodate'];
                        }

                        $xQry = "SELECT p.supplierno as supplierno,purchaseinvoiceno,date,
totalamount,freight,others,p.companyinvoiceno  from inv_purchaseentry1 as p ,
account_ledger as al
      where p.supplierno=al.account_ledger_id
       $xQryFilter
        order by p.purchaseinvoiceno";

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
                                     echo '<td align=right>' . $row ['companyinvoiceno'] . '</td>';
                                    echo '<td align=right>' . $row ['freight'] . '</td>';
                                    echo '<td align=right>' . $row ['others'] . '</td>';
                                    ?>
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

                                echo '<tr>';
                                echo '<td colspan=4>Total</td>';
                                echo '<td align=right>' . fn_RupeeFormat($xGrandTotal) . '</td>';
                                echo '<td ></td>';
                                echo '<td align=right>' . fn_RupeeFormat($xGrandFrieght) . '</td>';
                                echo '<td align=right>' . fn_RupeeFormat($xGrandOthers) . '</td>';
                                echo '</tr>';
                                        echo '<tr>';
                                echo '<td colspan=7>GrandTotal</td>';
                                $xNetTotal=$xGrandTotal+$xGrandFrieght+$xGrandOthers;
                                echo '<td align=right>' . fn_RupeeFormat($xNetTotal) . '</td>';
                                echo '</tr>';
                            } else {
                                fn_NoDataFound();
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
