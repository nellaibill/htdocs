<?php
 include 'globalfile.php';
$xDateFilterBy=$GLOBALS ['xBetweenDateFilterBy'];
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
$_GET['form']='';
$_GET['passsupplierno']='';
?>
<title>R-PURCHASE</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
</div>
<input type="button" id="btnExport" value=" Export Table data into Excel " />
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
<label>ItemName:</label>
<select class="form-control"   name="f_itemno"  >
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
    <?php } ?>
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
<b><?php echo "Purchase Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
        
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
           <?php if($GLOBALS ['xViewPurInvoiceNo']  == 0){ ?>  <th>INV.NO</th> <?php } ?>
           <th> ITEMNAME</th>
           <th> QTY</th>
           <th> PRICE</th>
          <?php if($GLOBALS ['xViewPurDate']  == 0){ ?>    <th> ENTRY-DATE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){ ?>       <th>COM.NO</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSupplierNo']  == 0){ ?>    <th> SUPPLIERNAME</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurDateRecieved']  == 0){ ?>     <th> RECIEVED</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurBatchId']  == 0){ ?>    <th> BATCHID</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSellingPrice']  == 0){ ?>     <th> SELLINGPRICE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurVat']  == 0){ ?>     <th> GST</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurTotal']  == 0){ ?>    <th>MRP</th> <?php } ?>
           <!--<th> MRP</th>!-->
          <?php if($GLOBALS ['xViewPurProfit']  == 0){ ?>    <th> PROFIT</th> <?php } ?>
           <th> DISCOUNT</th>
        </tr>
      </thead>


      <tfoot>
        <tr>
           <th> S.No</th>
           <?php if($GLOBALS ['xViewPurInvoiceNo']  == 0){ ?>  <th> INV.NO</th> <?php } ?>
           <th> ITEMNAME</th>
           <th> QTY</th>
           <th> PRICE</th>
          <?php if($GLOBALS ['xViewPurDate']  == 0){ ?>    <th> ENTRY-DATE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){ ?>       <th>COM.NO</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSupplierNo']  == 0){ ?>    <th> SUPPLIERNAME</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurDateRecieved']  == 0){ ?>     <th>RECIEVED</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurBatchId']  == 0){ ?>    <th> BATCHID</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurSellingPrice']  == 0){ ?>     <th> SELLINGPRICE</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurVat']  == 0){ ?>     <th> GST</th> <?php } ?>
          <?php if($GLOBALS ['xViewPurTotal']  == 0){ ?>    <th> MRP</th> <?php } ?>
           <!--<th> MRP</th>!-->
          <?php if($GLOBALS ['xViewPurProfit']  == 0){ ?>    <th> PROFIT</th> <?php } ?>
           <th> DISCOUNT</th>
           <th> TrackNo</th>
        </tr>
      </tfoot>

      <tbody>

<?php
$xQty=0;
$xQry='';
$xSlNo=0;
    $xGrandVat=0;
    $xGrandDiscount=0;
    $xGrandTotal=0;
    $xGrandNetTotal=0;
    $xGrandProfit=0;
	$xVatValue=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xSupplierNo= $_POST['f_supplierno'];
      $xItemNo= $_POST['f_itemno'];
      $xFilterDateBy= $_POST['f_filterdateby'];
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
      $xItemNo=$_POST['f_itemno'];
      $xQry = "update config_inventory set stockpointno=$xStockPointNo,supplierno=$xSupplierNo,filterdateby='$xFilterDateBy',fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo,purchaseinvoiceno=$xPurchaseInvoiceNo";
      mysql_query($xQry);
      header('Location: inv_hr003purchaseentry.php');
    }
else
{
/*
$xItemCategoryNo=$GLOBALS ['xItemCategoryNo'];
$xItemGroupNo=$GLOBALS ['xItemGroupNo'];
$xItemSubGroupNo=$GLOBALS ['xItemSubGroupNo'];
*/
$xStockPointNo=$GLOBALS ['xStockPointNo'];
$xSupplierNo=$GLOBALS ['xSupplierNo'];
$xItemNo=$GLOBALS ['xItemNo'];
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
$xItemNo= $GLOBALS ['xItemNo'];
$xPurchaseInvoiceNo=$GLOBALS ['xPurchaseInvoiceNo'];
}

if($xStockPointNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and stockpointno=$xStockPointNo";
}


if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemno=$xItemNo";
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
 
if($_GET['form'])
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xQry = "update config_inventory set stockpointno=0,supplierno=0,itemno=0,fromdate='$xFromDate',todate='$xToDate'";
mysql_query($xQry)or die ( mysql_error () );
header('Location: inv_hr003purchaseentry.php');
}

/* ------------- Area Executes from Home Page  ----------- */

   /*  $xQry="SELECT *  from inv_purchaseentry where $xDateFilterBy >= '$xFromDate' AND $xDateFilterBy <= '$xToDate' and itemno in ( select itemno from m_item where itemno !='' $xQryFilter) order by purchaseinvoiceno";*/

$xQry="SELECT *  from inv_purchaseentry where date>= '$xFromDate' AND date<= '$xToDate' 
and supplierno>0
and itemno in ( select itemno from m_item where itemno !='' $xQryFilter) order by purchaseinvoiceno";
echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    findsuppliername($row['supplierno']);
 ?>
 <tr>
 <?php 
    echo '<td>' . $xSlNo. '</td>';
    if($GLOBALS ['xViewPurInvoiceNo']  == 0){echo '<td>' . $row['purchaseinvoiceno']  . '</td>';    }
?>
<td><a href="inv_hr003_a_oldpurchasehistory.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    echo '<td>' . $row['qty'] . '</td>';
    echo '<td>' . fn_RupeeFormat($row['originalprice']) . '</td>';
    if($GLOBALS ['xViewPurDate']  == 0){echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';    }
    if($GLOBALS ['xViewPurCompanyInvoiceNo']  == 0){echo '<td>' . $row['companyinvoiceno'] . '</td>';    }
    if($GLOBALS ['xViewPurSupplierNo']  == 0){echo '<td>' . $GLOBALS ['xSupplierName']  . '</td>';    }
    if($GLOBALS ['xViewPurDateRecieved']  == 0){echo '<td>' . date('d/M/y', strtotime($row['daterecieved']))   . '</td>';    }
    if($GLOBALS ['xViewPurBatchId']  == 0){echo '<td>' . $row['batchid']  . '</td>';    }
    if($GLOBALS ['xViewPurSellingPrice']  == 0){echo '<td align=right>' . fn_RupeeFormat($row['sellingprice'])  . '</td>';    }
    if($GLOBALS ['xViewPurVat']  == 0){echo '<td>' . $row['vat']  ." % " . '</td>';    }
    if($GLOBALS ['xViewPurTotal']  == 0){echo '<td align=right>' . fn_RupeeFormat($row['total'])  . '</td>';    }
   // echo '<td align=right>' . fn_RupeeFormat( $row['nettotal']) . '</td>';
    if($GLOBALS ['xViewPurProfit']  == 0){echo '<td align=right>' . fn_RupeeFormat($row['profit'])  . '</td>';    }
    $xVatValue+=$row['nettotal']*($row['vat']/100);
    echo '<td>' . $row['discount'] . " % " . '</td>';
    ?>
<td><a href="inv_ht003purchaseentry_adminedit.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $row['txno']  ?>
</a>  </td>
<?php 
    $xGrandTotal=$row['total']+$xGrandTotal;
    $xGrandNetTotal=$row['nettotal']+$xGrandNetTotal;
    $xGrandProfit=$row['profit']+$xGrandProfit;
    $xGrandVat+=($row['qty'] * $row['originalprice'])*($row['vat']/100);
    $xGrandDiscount+=($row['qty'] * $row['originalprice'])*($row['discount']/100);
    $xQty+= $row['qty'] ;
}
echo '</tr>'; 
   echo '<tr>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td ></td>';
    echo '<td>' . $xQty. '</td>';


    if($GLOBALS ['xViewPurInvoiceNo']  == 0){echo '<td></td>';    }
    echo '<td colspan=8 bgcolor=red align=right> GRAND TOTAL       -Rs .  ' . fn_RupeeFormat( $xGrandTotal) . '</td>';

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
