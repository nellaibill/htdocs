<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
      </div>
</div>
<div class="panel-body">
<div class="form-group">


<div class="col-xs-3">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $xFromDate; ?>">
</div>

<div class="col-xs-3">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $xToDate; ?>">
</div>

<div class="col-xs-3">
<label>StockPoint:</label>
<select class="form-control"  value="" name="f_stockpointno"  >
<option value="0">All</option>
<?php $result = mysql_query("SELECT *  FROM m_stockpoint where stockpointno!=0 order by stockpointname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['stockpointno']; ?>" 
     <?php
      if ($row['stockpointno']== $GLOBALS ['xStockPointNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['stockpointname']; ?> 
    </option>
    <? } ?>
</select>
</div>


<div class="col-xs-3">
<label>Employee:</label>
<select class="form-control"  value="" name="f_empno"  >
<option value="0">All</option>
<?php $result = mysql_query("SELECT *  FROM employeedetails order by empname");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['txno']; ?>" 
     <?php
      if ($row['txno']== $GLOBALS ['xEmpNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['empname']; ?> 
    </option>
    <? } ?>
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
<label>SalesInvoiceNo:(0-All)</label>
<input type="number" class="form-control"  name="f_salesinvoiceno" value="0">
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
<html>
<title> V-SALES</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
  
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];
   $xStockPointNo=$_POST['f_stockpointno'];
   $xEmpNo=$_POST['f_empno'];
   $xItemNo=$_POST['f_itemno'];
     $xOrderByItemName= $_POST['f_orderbyitemname'];
   if (empty ( $_POST ['f_salesinvoiceno'] )) {
	$xSalesInvoiceNo = 0;
   } else {
	$xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
    }

      mysql_query("update config_inventory set fromdate='$xFromDate',todate='$xToDate',
itemno=$xItemNo,stockpointno=$xStockPointNo,orderbyitemname=$xOrderByItemName") or die ( mysql_error () );
      mysql_query("update config set employeeno=$xEmpNo") or die ( mysql_error () );
      mysql_query("update config_sales set salesinvoiceno=$xSalesInvoiceNo") or die ( mysql_error () );
echo "<meta http-equiv='refresh' content='0'>";
      header('Location: inv_hr004salesentry.php');
    }
else
{
   $xFromDate=$GLOBALS ['xInvFromDate'];
   $xToDate= $GLOBALS ['xInvToDate'];
   $xItemNo= $GLOBALS ['xItemNo'];
   $xStockPointNo=$GLOBALS ['xStockPointNo'];
   $xEmpNo=$GLOBALS ['xEmpNo'];
   $xSalesInvoiceNo=$GLOBALS ['xSalesInvoiceNo'];
}
if($xStockPointNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and usagestockpointno=$xStockPointNo";
}
if($xEmpNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and empno=$xEmpNo";
}
if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and s.itemno=$xItemNo";
}
if($xSalesInvoiceNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and salesinvoiceno=$xSalesInvoiceNo";
}


/* ------------- Area Executes from Home Page  ----------- */
 
if($_GET['form']==home)
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xQry = "update config_inventory set stockpointno=0,itemno=0,fromdate='$xFromDate',todate='$xToDate'";
mysql_query($xQry)or die ( mysql_error () );
mysql_query("update config set employeeno=0") or die ( mysql_error () );
header('Location: inv_hr004salesentry.php');
}

/* ------------- Area Executes from Home Page  ----------- */

if($xOrderByItemName!=0)/*No*/
{
$xQry="SELECT *  from inv_salesentry as s where date>= '$xFromDate' AND date<= '$xToDate' $xQryFilter order by salesinvoiceno;"; 
}
else
{
$xQry="SELECT *  from inv_salesentry as s,m_item as i where i.itemno=s.itemno and s.date>= '$xFromDate' AND s.date<= '$xToDate' $xQryFilter order by i.itemname;"; 
}


//echo $xQry;

$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><h3 class="panel-title text-center"><?php echo "Sales Report From $xFromDate to $xToDate On ". date("d/M/y h:i:sa"); ?></h3></b></div>
<table class="table table-hover" border="1" >
      <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="10%">DATE</th>
           <th width="25%">ITEM NAME</th>
           <th width="15%">QTY</th>
           <th width="15%">USED STOCKPOINT</th>
           <th width="20%">EMPLOYEE</th>
           <th width="15%">USAGE DETAILS</th>
           <th width="5%">SALES-INVOICENO</th>
          </tr>
      </thead>

    <tfoot>
        <tr>
           <th width="5%">S.NO</th>
           <th width="10%">DATE</th>
           <th width="25%">ITEM NAME</th>
           <th width="15%">QTY</th>
           <th width="15%">USED STOCKPOINT</th>
           <th width="20%">EMPLOYEE</th>
           <th width="15%">USAGE DETAILS</th>
           <th width="5%">SALES-INVOICENO</th>
          </tr>
      </tfoot>
      <tbody>

<?php
if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    finditemname($row['itemno']);
    findempname($row['empno']);
    findstockpointname($row['usagestockpointno']);
    echo '<td>' . $xSlNo+=1  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date'])). '</td>';
?>
<td><a href="inv_hr004_a_oldsaleshistory.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    echo '<td>' . $row['qty']  . '</td>';
    echo '<td>' . $GLOBALS ['xStockPointName']  . '</td>';
    echo '<td>' . $GLOBALS ['xEmpName']  . '</td>';
    echo '<td>' . $row['usagestockdetails']  . '</td>';
    echo '<td>' . $row['salesinvoiceno']  . '</td>';
?>
<!--
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
!-->
<?
echo '</tr>'; 
}
}

else 
 {     
    fn_NoDataFound();
 }
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	