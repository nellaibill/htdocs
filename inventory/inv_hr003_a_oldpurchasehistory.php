<?php
//include 'session.php';
include 'globalfunctions.php';

  $xItemNo= $_GET['itemno'];
?>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
<b>LAST TEN ENTRIES</b>
        
  </div>
 <div class="panel-body">
<div id="divToPrint" >
  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
           <th>S.No</th>
           <th> ITEMNAME</th>
           <th> QTY</th>
           <th> PRICE</th>
           <?php if($GLOBALS ['xViewPurInvoiceNo']  == 0){ ?>  <th> INV.NO</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurDate']  == 0){ ?>    <th>PUR-DATE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSupplierNo']  == 0){ ?>    <th> SUPPLIERNAME</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSellingPrice']  == 0){ ?>     <th> SELLINGPRICE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurVat']  == 0){ ?>     <th> VAT</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurTotal']  == 0){ ?>    <th> HSR</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurProfit']  == 0){ ?>    <th> PROFIT</th> <?php } ?>
           <th> DISCOUNT</th>
        </tr>
      </thead>

      <tbody>

<?php
$xQry='';
$xGrandQty=0;
$xGrandHsr=0;
$xSlNo=0;
$xVatValue=0;
$xQry="SELECT *  from inv_purchaseentry where itemno=$xItemNo order by date limit 10 ";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    findsuppliername($row['supplierno']);
    echo '<tr>';
    echo '<td>' . $xSlNo . '</td>';
    echo '<td>' . $GLOBALS ['xItemName']   . '</td>';
    echo '<td>' . $row['qty'] . '</td>';
    $xGrandQty+=$row['qty'];
    echo '<td>' . fn_RupeeFormat($row['originalprice']) . '</td>';
    if($GLOBALS ['xViewPurInvoiceNo']  == 0){echo '<td>' . $row['purchaseinvoiceno']  . '</td>';    }
    if($GLOBALS ['xViewPurDate']  == 0){echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';    }
    if($GLOBALS ['xViewPurSupplierNo']  == 0){echo '<td>' . $GLOBALS ['xSupplierName']  . '</td>';    }
    if($GLOBALS ['xViewPurSellingPrice']  == 0){echo '<td align=right>' .  $row['sellingprice']  . '</td>';    }
    if($GLOBALS ['xViewPurVat']  == 0){echo '<td>' . $row['vat']  ." % " . '</td>';    }
    if($GLOBALS ['xViewPurTotal']  == 0){echo '<td align=right>' . fn_RupeeFormat($row['total'])  . '</td>';    }
    $xGrandHsr+=$row['total'];
    if($GLOBALS ['xViewPurProfit']  == 0){echo '<td align=right>' .fn_RupeeFormat($row['profit'])  . '</td>';    }
    $xVatValue+=$row['nettotal']*($row['vat']/100);
    echo '<td>' . $row['discount'] . " % " . '</td>';
    echo '</tr>';   
}
    echo '<tr>';

   echo '<td colspan=2>GRAND TOTAL</td>';
    echo '<td>' . $xGrandQty. '</td>';
    echo '<td colspan=5></td>';
    echo '<td>' . fn_RupeeFormat($xGrandHsr). '</td>';

echo '</tr>';  
 
?>	


</tbody>
    </table>	

  </div><!-- /container -->
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
