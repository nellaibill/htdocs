<?php
 include 'globalfile.php';
$xDateFilterBy=$GLOBALS ['xBetweenDateFilterBy'];
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
?>
<title>R-PURCHASE</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
</div>
<div class="btn-group pull-left">
<a href="inv_hr003_b_purchaseconsolidated.php" class="btn btn-info" role="button">CONSOLIDATED</a>
</div>
</div>
<div class="panel-body">
<div class="form-group">


<div class="col-xs-2">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
</div>

<div class="col-xs-2">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $GLOBALS ['xInvToDate']; ?>">
</div>

<div class="col-xs-3">
<label>StockPoint:</label>
<select class="form-control"  value="" name="f_stockpointno">
<option value="0">All</option>
<?php
dropDownStockPoint();
?>
</select>
</div>
<!--
<div class="col-xs-3">
<label>Category:</label>
<select class="form-control"  value="" name="f_itemcategoryno"  >
<?php DropDownCategory(); ?>
</select>
</div>


<div class="col-xs-3">
<label>Group:</label>
<select class="form-control"  value="" name="f_itemgroupno"  >
<?php DropDownGroup(); ?>
</select>
</div>

<div class="col-xs-3">
<label>Sub-Group:</label>
<select class="form-control"  value="" name="f_itemsubgroupno"  >
<?php DropDownSubGroup(); ?>
</select>
</div>
!-->
<div class="col-xs-3">
<label>Supplier Name:</label>
<select class="form-control"  value="" name="f_supplierno" >
<option value="0">All</option>
<?php
DropDownSupplier();
?>
</select>
</div>

<div class="col-xs-2">
<label>Filter Between Date By :</label>
<select class="form-control"  value="" name="f_filterdateby"  >
	<!--<option value="none" <?php if($GLOBALS ['xBetweenDateFilterBy']=="none") echo 'selected="selected"'; ?>>NONE</option> !-->
	<option value="date" <?php if($GLOBALS ['xBetweenDateFilterBy']=="date") echo 'selected="selected"'; ?>>DATE-ENTERED</option>
	<option value="daterecieved" <?php if( $GLOBALS ['xBetweenDateFilterBy']=="daterecieved") echo 'selected="selected"'; ?>>DATE-RECIEVED</option>
	<option value="dateexpired" <?php if( $GLOBALS ['xBetweenDateFilterBy']=="dateexpired") echo 'selected="selected"'; ?>>DATE-EXPIRED</option>
</select>
</div>

<div class="col-xs-3">
<label>ItemName:</label>
<select class="form-control"  value="" name="f_itemno"  >
<option value="0">All</option>
<?php $result = mysql_query("SELECT *  FROM inv_stockentry a, m_item b WHERE a.itemno = b.itemno order by b.itemname ");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemno']; ?>" 
     <?php
      if ($row['itemno']== $GLOBALS ['xItemNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemname']; ?> 
    </option>
    <? } ?>
</select>
</div>
<div class="col-xs-3">
<label>PurchaseInvoiceNo:</label>
<input type="number" class="form-control"  name="f_purchaseinvoiceno" value="0">
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">ITEMNAMEORDER</label>
<select class="form-control" name="f_orderbyitemname">
	<option value="0" <?php if($GLOBALS ['xOrderByItemName']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xOrderByItemName']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
<b><h3 class="panel-title text-center"><?php echo "Purchase Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
        
<div class="pull-right">
                <a href="inv_hc003purchaseentry.php" class="btn btn-default">CONFIG</a>
            </div>
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
           <th> S.No</th>
           <?php if($GLOBALS ['xViewPurInvoiceNo']  == 0){ ?>  <th>INV.NO</th> <? } ?>
           <th> ITEMNAME</th>
           <th> QTY</th>
           <th> PRICE</th>
          <?php if($GLOBALS ['xViewPurDate']  == 0){ ?>    <th> ENTRY-DATE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){ ?>       <th>COM.NO</th> <? } ?>
          <?php if($GLOBALS ['xViewPurSupplierNo']  == 0){ ?>    <th> SUPPLIERNAME</th> <? } ?>
          <?php if($GLOBALS ['xViewPurDateRecieved']  == 0){ ?>     <th> RECIEVED</th> <? } ?>
          <?php if($GLOBALS ['xViewPurDateExpired']  == 0){ ?>     <th> EXPIRED</th> <? } ?>
          <?php if($GLOBALS ['xViewPurBatchId']  == 0){ ?>    <th> BATCHID</th> <? } ?>
          <?php if($GLOBALS ['xViewPurFreeQty']  == 0){ ?>    <th> FREE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurSellingPrice']  == 0){ ?>     <th> SELLINGPRICE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurVat']  == 0){ ?>     <th> VAT</th> <? } ?>
          <?php if($GLOBALS ['xViewPurTotal']  == 0){ ?>    <th> HSR</th> <? } ?>
           <!--<th> MRP</th>!-->
          <?php if($GLOBALS ['xViewPurProfit']  == 0){ ?>    <th> PROFIT</th> <? } ?>
           <th> DISCOUNT</th>
        </tr>
      </thead>


      <tfoot>
        <tr>
           <th> S.No</th>
           <?php if($GLOBALS ['xViewPurInvoiceNo']  == 0){ ?>  <th> INV.NO</th> <? } ?>
           <th> ITEMNAME</th>
           <th> QTY</th>
           <th> PRICE</th>
          <?php if($GLOBALS ['xViewPurDate']  == 0){ ?>    <th> ENTRY-DATE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){ ?>       <th>COM.NO</th> <? } ?>
          <?php if($GLOBALS ['xViewPurSupplierNo']  == 0){ ?>    <th> SUPPLIERNAME</th> <? } ?>
          <?php if($GLOBALS ['xViewPurDateRecieved']  == 0){ ?>     <th>RECIEVED</th> <? } ?>
          <?php if($GLOBALS ['xViewPurDateExpired']  == 0){ ?>     <th>EXPIRED</th> <? } ?>
          <?php if($GLOBALS ['xViewPurBatchId']  == 0){ ?>    <th> BATCHID</th> <? } ?>
          <?php if($GLOBALS ['xViewPurFreeQty']  == 0){ ?>    <th> FREE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurSellingPrice']  == 0){ ?>     <th> SELLINGPRICE</th> <? } ?>
          <?php if($GLOBALS ['xViewPurVat']  == 0){ ?>     <th> VAT</th> <? } ?>
          <?php if($GLOBALS ['xViewPurTotal']  == 0){ ?>    <th> HSR</th> <? } ?>
           <!--<th> MRP</th>!-->
          <?php if($GLOBALS ['xViewPurProfit']  == 0){ ?>    <th> PROFIT</th> <? } ?>
           <th> DISCOUNT</th>
        </tr>
      </tfoot>

      <tbody>

<?php
$xQry='';
$xSlNo=0;
    $xGrandVat=0;
    $xGrandDiscount=0;
    $xGrandTotal=0;
    $xGrandNetTotal=0;
    $xGrandProfit=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xStockPointNo= $_POST['f_stockpointno'];
      $xSupplierNo= $_POST['f_supplierno'];
      $xItemNo= $_POST['f_itemno'];
      $xFilterDateBy= $_POST['f_filterdateby'];
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
      $xItemNo=$_POST['f_itemno'];
      $xPurchaseInvoiceNo=$_POST['f_purchaseinvoiceno'];
      $xOrderByItemName= $_POST['f_orderbyitemname'];
      $xQry = "update config_inventory set stockpointno=$xStockPointNo,  
               supplierno=$xSupplierNo,filterdateby='$xFilterDateBy',
               fromdate='$xFromDate',todate='$xToDate',
               itemno=$xItemNo,purchaseinvoiceno=$xPurchaseInvoiceNo,orderbyitemname=$xOrderByItemName";
               mysql_query($xQry);
echo "<meta http-equiv='refresh' content='0'>";
      header('Location: inv_hr003purchaseentry.php');
    }
else
{
$xStockPointNo=$GLOBALS ['xStockPointNo'];
$xSupplierNo=$GLOBALS ['xSupplierNo'];
$xItemNo=$GLOBALS ['xItemNo'];
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
$xItemNo= $GLOBALS ['xItemNo'];
$xPurchaseInvoiceNo=$GLOBALS ['xPurchaseInvoiceNo'];
$xOrderByItemName=$GLOBALS ['xOrderByItemName'];
}
if($xStockPointNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and stockpointno=$xStockPointNo";
}
if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemno=$xItemNo";
}

if($xPurchaseInvoiceNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and purchaseinvoiceno=$xPurchaseInvoiceNo";
}

if($_GET['passsupplierno'])
{
$xSupplierNo=$_GET['passsupplierno'];
$xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo";
}
else
 {
   if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
 }

/* ------------- Area Executes from Home Page  ----------- */
 
if($_GET['form']==home)
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xQry = "update config_inventory set stockpointno=0,supplierno=0,itemno=0,fromdate='$xFromDate',todate='$xToDate'";
mysql_query($xQry)or die ( mysql_error () );
header('Location: inv_hr003purchaseentry.php');
}

/*SELECT * from inv_purchaseentry as p,m_item as i where i.itemno=p.itemno and p.date>= '2016-01-01' AND p.date<= '2016-01-30' and p.itemno in ( select itemno from m_item where itemno !='' and supplierno=55 ) order by i.itemname*/



if($xOrderByItemName!=0)/*No*/
{
$xQry="SELECT *  from inv_purchaseentry as p,m_item as i where i.itemno=p.itemno and p.daterecieved>= '$xFromDate' AND p.daterecieved<= '$xToDate' and p.itemno in ( select itemno from m_item where itemno !='' $xQryFilter ) order by p.purchaseinvoiceno";
}
else
{
$xQry="SELECT *  from inv_purchaseentry as p,m_item as i where i.itemno=p.itemno and p.daterecieved>= '$xFromDate' AND p.daterecieved<= '$xToDate' and p.itemno in ( select itemno from m_item where itemno !='' $xQryFilter ) order by i.itemname";
}

$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    findsuppliername($row['supplierno']);
    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
    if($GLOBALS ['xViewPurInvoiceNo']  == 0){echo '<td>' . $row['purchaseinvoiceno']  . '</td>';    }
?>
<td><a href="inv_hr003_a_oldpurchasehistory.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    echo '<td>' . $row['qty'] . '</td>';
    echo '<td>' . money_format("%!n", $row['originalprice']) . '</td>';
    if($GLOBALS ['xViewPurDate']  == 0){echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';    }
    if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){echo '<td>' . $row['companyinvoiceno'] . '</td>';    }
    if($GLOBALS ['xViewPurSupplierNo']  == 0){echo '<td>' . $GLOBALS ['xSupplierName']  . '</td>';    }
    if($GLOBALS ['xViewPurDateRecieved']  == 0){echo '<td>' . date('d/M/y', strtotime($row['daterecieved']))   . '</td>';    }
    if($GLOBALS ['xViewPurDateExpired']  == 0){echo '<td>' . date('d/M/y', strtotime($row['dateexpired'])) . '</td>';    }
    if($GLOBALS ['xViewPurBatchId']  == 0){echo '<td>' . $row['batchid']  . '</td>';    }
    if($GLOBALS ['xViewPurFreeQty']  == 0){echo '<td align=right>' . $row['freeqty']  . '</td>';    }
    if($GLOBALS ['xViewPurSellingPrice']  == 0){echo '<td align=right>' . money_format("%!n", $row['sellingprice'])  . '</td>';    }
    if($GLOBALS ['xViewPurVat']  == 0){echo '<td>' . $row['vat']  ." % " . '</td>';    }
    if($GLOBALS ['xViewPurTotal']  == 0){echo '<td align=right>' . money_format("%!n", $row['total'])  . '</td>';    }
   // echo '<td align=right>' . money_format("%!n", $row['nettotal']) . '</td>';
    if($GLOBALS ['xViewPurProfit']  == 0){echo '<td align=right>' . money_format("%!n", $row['profit'])  . '</td>';    }
    $xVatValue+=$row['nettotal']*($row['vat']/100);
    echo '<td>' . $row['discount'] . " % " . '</td>';
    $xGrandTotal=$row['total']+$xGrandTotal;
    $xGrandNetTotal=$row['nettotal']+$xGrandNetTotal;
    $xGrandProfit=$row['profit']+$xGrandProfit;
    $xGrandVat+=($row['qty'] * $row['originalprice'])*($row['vat']/100);
    $xGrandDiscount+=($row['qty'] * $row['originalprice'])*($row['discount']/100);

}
echo '</tr>'; 
   echo '<tr>';
    echo '<td></td>';
    if($GLOBALS ['xViewPurInvoiceNo']  == 0){echo '<td></td>';    }
    echo '<td colspan=4 bgcolor=red> GRAND TOTAL       -Rs .  ' . money_format("%!n", $xGrandTotal) . '</td>';
/*
    echo '<td></td>';
    if($GLOBALS ['xViewPurDate']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurSupplierNo']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurDateRecieved']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurDateExpired']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurBatchId']  == 0){echo '<td></td>';    }
    if($GLOBALS ['xViewPurFreeQty']  == 0){echo '<td align=right></td>';    }
    if($GLOBALS ['xViewPurSellingPrice']  == 0){echo '<td align=right></td>';    }
    echo '<td></td>';
    if($GLOBALS ['xViewPurVat']  == 0){echo '<td align=right>' . $xGrandVat  . '</td>';    }
    echo '<td align=right>' . money_format("%!n", $xGrandNetTotal) . '</td>';
    if($GLOBALS ['xViewPurProfit']  == 0){echo '<td align=right>' . money_format("%!n", $xGrandProfit)  . '</td>';    }
    */

echo '</tr>'; 
}

else 
 {     
    fn_NoDataFound();
 }
  
?>	
</tbody>
    </table>	

  </div><!-- /container -->
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
