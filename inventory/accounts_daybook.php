<?php
include 'globalfile.php';
$xReportFromDate = $GLOBALS ['xFromDate'];
$xReportToDate = $GLOBALS ['xToDate'];
$xLedgerId = $GLOBALS ['xSupplierNo'];
$xGrandTotalPurHistory = 0;
?>
<title>Consolidated-Purchase</title>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
    <div class="panel-body">
        <div class="form-group">
            <!--
            <div class="col-xs-3">
            <label>Report From Date</label>
            <input type="date" class="form-control"  name="reportfromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
            </div>
            
            
            <div class="col-xs-3">
            <label>Report To Date</label>
            <input type="date" class="form-control"  name="reporttodate" value="<?php echo $GLOBALS ['xToDate']; ?>">
            </div>
            !-->
            <div class="col-xs-4">
                <label>Ledger List:</label> <select
                    class="form-control" name="f_account_ledger_id">
                    <option value="0">All</option>
                        <?php
                        $result = mysql_query("SELECT *  FROM account_ledger where ledger_undergroup_no=4 order by ledger_name");
                        while ($row = mysql_fetch_array($result)) {
                            
                                             ?>
                                <option value="<?php echo $row['account_ledger_id']; ?>"
                                <?php
                                if ($row ['account_ledger_id'] == $GLOBALS ['xSupplierNo']) {
                                    echo 'selected="selected"';
                                }
                                ?>>
                                            <?php echo $row['ledger_name']; ?> 
                                </option>
                                <?php
                            }
                            ?>
                                
                           
                    ?>
                </select>
            </div>

            <input type="submit"  name="view"   class="btn btn-primary" value="VIEW" >
        </div></div>

</form><?php
$xQry = '';
if (isset($_POST ['view'])) {
$xSupplierNo= $_POST ['f_account_ledger_id'];
$xQry = "update config_inventory set supplierno=$xSupplierNo";
mysql_query ( $xQry );
header("Refresh:0");
   
}
if ($xLedgerId==0) {
    $xQry = "select * from (SELECT p.supplierno as supplierno,  date,totalamount as totalamount,companyinvoiceno as remarks,0 as type
from inv_purchaseentry1 as p  where  date>='$xReportFromDate' and date<='$xReportToDate' 
union all SELECT accounts_payment_ledger_id as supplierno,accounts_payment_date as date,"
            . "accounts_payment_amount as totalamount,accounts_payment_remarks as remarks,1 as type from accounts_payment where accounts_payment_date<='$xReportToDate'  and accounts_payment_date>='$xReportFromDate' 
  ) as t order by t.date asc";
}
else
{
     $xQry = "select * from (SELECT p.supplierno as supplierno,  date,totalamount as totalamount,companyinvoiceno as remarks,0 as type
from inv_purchaseentry1 as p  where p.supplierno=$xLedgerId and date>='$xReportFromDate' and date<='$xReportToDate' 
union all SELECT accounts_payment_ledger_id as supplierno,accounts_payment_date as date,"
            . "accounts_payment_amount as totalamount,accounts_payment_remarks as remarks,1 as type from accounts_payment where accounts_payment_date<='$xReportToDate'  and accounts_payment_date>='$xReportFromDate' 
 and accounts_payment_ledger_id=" . $xLedgerId . " ) as t order by t.date asc";
}
?>
    <div id="divToPrint">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading  text-center">
                <b><?php echo "Consolidated  Entries From[" . date('d/M/y', strtotime($xFromDate)) . "]TO [" . date('d/M/y', strtotime($xToDate)) . "] As On " . date("d/M/y h:i:sa"); ?></b>

            </div>
            <div class="panel-body">
                <table class="table table-striped  table-bordered "
                       data-responsive="table" border="1">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //echo $xQry;
                        if ($xQry != "") {
                            $xSlNo = 0;
                            $xGrandTotalCredit = 0;
                            $xGrandTotalDebit = 0;

                            $result2 = mysql_query($xQry);
                            while ($row = mysql_fetch_array($result2)) {
                                $xSlNo += 1;
                                findsuppliername($row ['supplierno']);
                                echo '<tr>';
                                echo '<td>' . $GLOBALS ['xSupplierName'] . '</td>';
                                echo '<td>' . date('d/M/y', strtotime($row ['date'])) . '</td>';
                                if ($row ['type'] == 0) {
                                    echo '<td align=right>' . fn_RupeeFormat($row ['totalamount']) . '</td>';
                                    echo '<td align=right></td>';
                                    $xGrandTotalCredit += $row ['totalamount'];
                                } else {
                                    echo '<td align=right></td>';
                                    echo '<td align=right>' . fn_RupeeFormat($row ['totalamount']) . '</td>';
                                    $xGrandTotalDebit += $row ['totalamount'];
                                }
                                echo '<td> ' . $row ['remarks'] . '</td>';

                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td align=right>' . fn_RupeeFormat($xGrandTotalCredit) . '</td>';
                            echo '<td align=right>' . fn_RupeeFormat($xGrandTotalDebit) . '</td>';
                            echo '<td></td>';
                            echo '</tr>';
                        }
                        ?>	
                    </tbody>
                </table>

            </div>
        </div>
    </div>
  </div>
          </div>