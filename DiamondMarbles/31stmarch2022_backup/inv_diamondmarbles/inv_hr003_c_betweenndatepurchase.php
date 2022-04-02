


<?php
 include 'globalfile.php';
 $xFromDate=$GLOBALS ['xInvFromDate'];
 $xToDate=$GLOBALS ['xInvToDate'];
fn_DataClear();
function fn_DataClear()
{
$_GET['form']='';
}
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




</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>
<html>
<title> V-PURCHASE</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
$xGrandTotal=0;
 $xQryFilter=''; 
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];
   if (empty ( $_POST ['f_salesinvoiceno'] )) {
	$xSalesInvoiceNo = 0;
   } else {
	$xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
    }

      mysql_query("update config_inventory set fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo,stockpointno=$xStockPointNo") or die ( mysql_error () );
      mysql_query("update config_sales set salesinvoiceno=$xSalesInvoiceNo") or die ( mysql_error () );
      header('Location: inv_hr003_c_betweenndatepurchase.php');
    }
else
{
   $xFromDate=$GLOBALS ['xInvFromDate'];
   $xToDate= $GLOBALS ['xInvToDate'];
   $xItemNo= $GLOBALS ['xItemNo'];
   $xStockPointNo=$GLOBALS ['xStockPointNo'];
   $xSalesInvoiceNo=$GLOBALS ['xSalesInvoiceNo'];
}

if($xItemNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and itemno=$xItemNo";
}


/* ------------- Area Executes from Home Page  ----------- */
 
if($_GET['form'])
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xQry = "update config_inventory set itemno=0,fromdate='$xFromDate',todate='$xToDate'";
mysql_query($xQry)or die ( mysql_error () );
mysql_query("update config set employeeno=0") or die ( mysql_error () );
header('Location: inv_hr003_c_betweenndatepurchase.php');
}

/* ------------- Area Executes from Home Page  ----------- */
$xQry="SELECT i.itemno,sum(p.qty) as qty,sum(p.total)as amount from inv_purchaseentry as p ,
m_item as i where p.date>= '$xFromDate' AND p.date<= '$xToDate' 
and  i.itemno=p.itemno  group by p.itemno order by i.itemname;";
//$xQry="SELECT *  from inv_purchaseentry where date>= '$xFromDate' AND date<= '$xToDate' $xQryFilter order by salesinvoiceno;"; 
//echo $xQry;
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Purchase Report From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa");?></b></div>
<table class="table table-hover" border="1" >
     <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
               <th width="10%">AMOUNT</th>
          </tr>
      </thead>

    <tfoot>
        <tr>
           <th width="5%">S.NO</th>
           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
           <th width="10%">AMOUNT</th>
          </tr>
      </tfoot>
      <tbody>

<?php
if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    finditemname($row['itemno']);
    echo '<td>' . $xSlNo+=1  . '</td>';
    echo '<td>' . $GLOBALS['xItemName']  . '</td>';
    echo '<td align=right>' . $row['qty']  . '</td>';
    echo '<td align=right>' . $row['amount']  . '</td>';
    $xGrandTotal+=$row['amount'];
?>
<?php
echo '</tr>'; 

}
echo '<tr>';
echo '<td colspan=3 align=right> GRAND TOTAL</td>';
echo '<td>' . $xGrandTotal . '</td>';
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
</div></div>
</body></html>	