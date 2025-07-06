
<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];

function fn_C_S_FindPurchaseBetweenDate($xItemNo, $xFromDate, $xToDate) {
    $xQty = '';
    $xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty,
        CASE WHEN sum(freeqty)IS NULL  THEN '0' else sum(freeqty) END as  freeqty,itemno  
                   from inv_purchaseentry  where  itemno=$xItemNo";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        finditemname ( $xItemNo );
	$xPackNo = $GLOBALS ['xPackNo'];
        $xQty = $row ['qty'];
        $xFreeQty = $row ['freeqty'];
        
        $xTotalQty=$xQty+$xFreeQty;
        $xTotalQtyWithPack=$xTotalQty*$xPackNo;
    }
    return $xTotalQtyWithPack;
}

function fn_C_S_FindPurchaseReturn($xItemNo, $xFromDate, $xToDate) {
    $xPurchaseReturn = 0;
    $xQry = "select qty from accounts_debit_note where   itemno=$xItemNo";

    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $xPurchaseReturn += $row ['qty'];
    }
    return $xPurchaseReturn;
}

function fn_C_S_FindSalesReturn($xItemNo, $xFromDate, $xToDate) {
    $xSalesReturn = 0;
    $xQry = "select qty from accounts_credit_note where itemno=$xItemNo";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $xSalesReturn += $row ['qty'];
    }
    return $xSalesReturn;
}

function fn_C_S_FindSalesBetweenDate($xItemNo, $xFromDate, $xToDate) {
    $xQty = '';
    $xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from inv_salesentry where  itemno=$xItemNo";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $xQty = $row ['qty'];
    }
    return $xQty;
}

function fn_O_S_FindBetweenDate($xItemNo, $xFromDate, $xToDate) {
    $xQty = '';
    $xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from m_openingstock where  itemno=$xItemNo";
    $result = mysql_query($xQry) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $xQty = $row ['qty'];
    }
    return $xQty;
}


function fn_FindCurrentStock($xItemNo) {
	$xCurrentStock = '';
	$xQry = "select sum(stock)as stock from inv_stockentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xCurrentStock = $row ['stock'];
	}
	return $xCurrentStock;
}
?>
<!--
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="panel panel-success">
                <div class="panel-heading text-center">
                        FILTER[GROUP]
                        <div class="btn-group pull-right">
                                <input type="submit" name="save" class="btn btn-primary"
                                        value="VIEW">
                        </div>
                </div>
                <div class="panel-body">
                        <div class="form-group">


                                <div class="col-xs-3">
                                        <label>From Date:</label> <input type="date" class="form-control"
                                                name="f_fromdate" value="<?php echo $xFromDate; ?>">
                                </div>

                                <div class="col-xs-3">
                                        <label>To Date:</label> <input type="date" class="form-control"
                                                name="f_todate" value="<?php echo $xToDate; ?>">
                                </div>



                                <div class="col-xs-3">
                                        <label>Item:</label> <select class="form-control" name="f_itemno">
                                                <option value="0">All</option>
<?php
$result = mysql_query("SELECT *  FROM inv_stockentry a, m_item b WHERE a.itemno = b.itemno order by b.itemname ");
while ($row = mysql_fetch_array($result)) {
    ?>
        <option value="<?php echo $row['itemno']; ?>"
    <?php
    if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
        echo 'selected="selected"';
    }
    ?>>
    <?php echo $row['itemname']; ?> 
        </option>
<?php } ?>
</select>
                                </div>

                        </div>
<!-- Form-Group !-->
</div>
<!-- Panel Body !-->
</div>
<!-- Panel !-->
</form>
<html>
    <title>V-SALES</title>
    <head>
        <link href="bootstrap.css" rel="stylesheet">
        <link href="css/reportstyle.css" rel="stylesheet">
        <script type="text/javascript">


            $(document).ready(function () {

                (function ($) {

                    $('#filter').keyup(function () {

                        var rex = new RegExp($(this).val(), 'i');
                        $('.searchable tr').hide();
                        $('.searchable tr').filter(function () {
                            return rex.test($(this).text());
                        }).show();

                    })

                }(jQuery));

            });
        </script>
    </head>
    <body>

        <div id="divToPrint">
            <div class="panel panel-primary">

                <div class="panel-body">

                    <div class="container">
                        <input id="filter" type="text" class="col-xs-8"
                               placeholder="Search here...">
                               <?php
                               $xSlNo = 0;
                               $xPurOrderValue = 0;
                               $xPurOrder = 0;
                               $xQryFilter = '';
                               if (isSet($_POST ['save'])) {
                                   $xItemNo = $_POST ['f_itemno'];
                                   $xFromDate = $_POST ['f_fromdate'];
                                   $xToDate = $_POST ['f_todate'];
                                   mysql_query("update config_inventory set fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo") or die(mysql_error());
                                   header('Location: inv_hr002_c_betweendates.php');
                               } else {
                                   $xFromDate = $GLOBALS ['xInvFromDate'];
                                   $xToDate = $GLOBALS ['xInvToDate'];
                                   $xItemNo = $GLOBALS ['xItemNo'];
                               }

                               if ($xItemNo != 0) {
                                   $xQryFilter = $xQryFilter . ' ' . "and itemno=$xItemNo";
                               }
                               $xQry = "SELECT  distinct(i.itemno)
FROM   (
            SELECT  itemno
            FROM    inv_purchaseentry  $xQryFilter
            UNION   ALL
            SELECT  itemno
            FROM    inv_salesentry  $xQryFilter
        ) subquery,
m_item as i  order by i.itemname";

                               /*
                                * $xQry="SELECT itemno from
                                * m_item as i where i.stockpointno=31 order by i.itemname";
                                */

//echo $xQry;
                               $xQry1 = "select * from m_item";
                               $result2 = mysql_query($xQry1);
                               ?>
                        <table class="table table-hover" border="1">
                            <thead>
                                <tr>
                                    <th width="5%">S.NO</th>
                                    <th width="15%">ItemName</th>
                                    <th width="10%">OpeningStock</th>
                                    <th width="10%">Purchased</th>
                                    <th width="10%">Sales</th>
                                    <th width="10%">P.R</th>
                                    <th width="10%">S.R</th>
                                    <th width="10%">ClosingStock</th>
                                <!--    <th width="10%">Stock</th>
                                      <th width="10%">Diff</th>!-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                                    <th width="5%">S.NO</th>
                                    <th width="15%">ItemName</th>
                                    <th width="10%">OpeningStock</th>
                                    <th width="10%">Purchased</th>
                                    <th width="10%">Sales</th>
                                    <th width="10%">P.R</th>
                                    <th width="10%">S.R</th>
                                    <th width="10%">ClosingStock</th>
                                <!--    <th width="10%">Stock</th>
                                      <th width="10%">Diff</th>!-->
                                </tr>
                            </tfoot>
                            <tbody class="searchable">
<?php
while ($row = mysql_fetch_array($result2)) {
    $xOpeningStock = 0;
    $xClosingStock = 0;

    $xO_S_Purchased = 0;
    $xO_S_Sales = 0;
    $xO_S_PurchaseReturn = 0;
    $xO_S_SalesReturn = 0;
    $xO_S_Excess = 0;
    $xO_S_Shortage = 0;

    $xC_S_Purchased = 0;
    $xC_S_Sales = 0;
    $xC_S_PurchaseReturn = 0;
    $xC_S_SalesReturn = 0;
    $xC_S_Excess = 0;
    $xC_S_Shortage = 0;


    $xOpeningStock = fn_O_S_FindBetweenDate($row ['itemno'], $xFromDate, $xToDate);

    $xC_S_Purchased = fn_C_S_FindPurchaseBetweenDate($row ['itemno'], $xFromDate, $xToDate);
    $xC_S_Sales = fn_C_S_FindSalesBetweenDate($row ['itemno'], $xFromDate, $xToDate);
    $xC_S_PurchaseReturn = fn_C_S_FindPurchaseReturn($row ['itemno'], $xFromDate, $xToDate);
    $xC_S_SalesReturn = fn_C_S_FindSalesReturn($row['itemno'], $xFromDate, $xToDate);
    $xClosingStock = $xOpeningStock + $xC_S_Purchased - $xC_S_PurchaseReturn - $xC_S_Sales + $xC_S_SalesReturn + $xC_S_Excess - $xC_S_Shortage;
    $xPurOrderValue = (($xC_S_Sales - $xClosingStock) * $xPurOrder / 100) + ($xC_S_Sales - $xClosingStock);
       $xCuurentStock=fn_FindCurrentStock($row ['itemno']) ;
    $xDifference=$xClosingStock-$xCuurentStock;


    echo '<tr>';
    finditemname($row ['itemno']);
    echo '<td align=right>' . $row ['itemno'] . '</td>';
      
    echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
    echo '<td align=right> ' . $xOpeningStock . '</td>';
    echo '<td align=right><a href=inv_hr003_e_purchasebysupplier_item.php?passitemno=' . $row ['itemno'] . '>' . $xC_S_Purchased . '</a></td>';
	echo '<td align=right><a href=inv_hr004_e_salesbycustomer_item.php?passitemno=' . $row ['itemno'] . '>' . $xC_S_Sales . '</a></td>';
    echo '<td align=right>' . $xC_S_PurchaseReturn . '</td>';
    echo '<td align=right>' . $xC_S_SalesReturn . '</td>';
    echo '<td align=right> ' . $xClosingStock . '</td>';
   /* echo '<td align=right> ' .  fn_FindCurrentStock($row ['itemno']) . '</td>';
	if($xDifference<0)
	{ 
echo '<td bgcolor=red align=right> ' .  $xDifference . '</td>';
	}
	else if($xDifference>0)
	{ 
echo '<td bgcolor=green align=right> ' .  $xDifference . '</td>';
	}
	else{
		 echo '<td bgcolor=pink align=right> ' .  $xDifference . '</td>';
	}
   */
}

    ?>
                                    <!--
                                    <td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno=' . $row['salesinvoiceno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
                                      <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
                                    </a>
                                    </td>
                                    <td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno=' . $row['salesinvoiceno'] . '&xmode=delete'; ?>"  onclick="return confirm_delete()">
                                      <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
                                    </a>
                                    </td>
                                    !-->
    <?php
    echo '</tr>';

?>	
                            </tbody>
                        </table>
                    </div>
                    <!-- /container -->
                </div>
            </div>
        </div>
    </body>
</html>
