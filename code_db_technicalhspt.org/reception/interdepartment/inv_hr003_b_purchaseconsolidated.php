<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
?>
<title>Consolidated-Purchase</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
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

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
<b><h3 class="panel-title text-center"><?php echo "Consolidated Purchase Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
        
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
           <th>S.No</th>
           <th>Supplier Name</th>
           <th>Amount</th>
        </tr>
      </thead>
     <tfoot>
            <tr>
           <th>S.No</th>
           <th>Supplier Name</th>
           <th>Amount</th>
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
      $xSupplierNo= $_POST['f_supplierno'];
      $xItemNo= $_POST['f_itemno'];
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
      $xItemNo=$_POST['f_itemno'];
      $xQry = "update config_inventory set stockpointno=$xStockPointNo,supplierno=$xSupplierNo,fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo";
      mysql_query($xQry);
echo "<meta http-equiv='refresh' content='0'>";
      header('Location: inv_hr003_b_purchaseconsolidated.php');
    }
else
{
$xSupplierNo=$GLOBALS ['xSupplierNo'];
$xItemNo=$GLOBALS ['xItemNo'];
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
$xItemNo= $GLOBALS ['xItemNo'];
}

if($xSupplierNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and p.supplierno=$xSupplierNo";
}

if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and p.itemno=$xItemNo";
}

// Date Recieved Query Changed to date (As on 05/01/2016)

     $xQry="SELECT p.supplierno as supplierno, sum(p.total)as total  from inv_purchaseentry as p ,inv_supplier as s where p.daterecieved>= '$xFromDate' and p.daterecieved<= '$xToDate' and p.supplierno=s.supplierid $xQryFilter  group by p.supplierno order by s.suppliername";
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);

if(mysql_num_rows($result2)){
    $xGrandTotal=0;
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    findsuppliername($row['supplierno']);
    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
?>
<td><a href="inv_hr003purchaseentry.php<?php echo '?passsupplierno='.$row['supplierno'] . '&xmode=report'; ?>"> <?php echo  $GLOBALS['xSupplierName'] ?>
</a>  </td>
<?php
    echo '<td align=right>' . money_format("%!n", $row['total']) . '</td>';
    $xGrandTotal+=$row['total'];
    echo '</tr>';
    }

    echo '<tr>';
    echo '<td colspan=2>Grand Total</td>';
    echo '<td align=right>' . money_format("%!n", $xGrandTotal) . '</td>';
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
