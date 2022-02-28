<!--<marquee bgcolor=orange width=100% height=30 direction=right behavior=alternate scrollamount=5> <font size="5" color="GREEN">Note : HRM MODULE  DEPARTMENT WISE FILTERING UPDATED</font></marquee>!-->

<!-- This Form is refers to collect the sum of over all data's !-->
<?php
include 'globalfile.php';

/* Display's today's date  data's only */

$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];

/* Display's today's date  data's only Ended */


/* One Week Before alert will be provided */

$xQry="SELECT *  FROM inv_amcentry where amc_enddate between date_sub('$xFromDate', interval 1 week) and '$xFromDate'";
$result = mysql_query ($xQry) or die ( mysql_error () );
	$count = mysql_num_rows($result);
/*
	if($count>0){echo '<script type="text/javascript">alert("Amc Ending Date is on this Week");</script>';}
*/
 
$xSupplierQry="SELECT count(supplierid) as totalsuppliers from inv_supplier"; 
$result2=mysql_query($xSupplierQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xTotalSupplier']=$row['totalsuppliers'] ;
}

$xItemQry ="SELECT count(itemno) as totalitems from m_item";
$result2=mysql_query($xItemQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xTotalItem']=$row['totalitems'] ;
}


$xPurchaseQry="SELECT count(purchaseinvoiceno) as totalpurchase from inv_purchaseentry where date <='$xFromDate' and date >='$xFromDate'";
$result2=mysql_query($xPurchaseQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xTotalPurchase']=$row['totalpurchase'] ;
}

$xSalesQry="SELECT count(salesinvoiceno) as totalsales from inv_salesentry where date <='$xFromDate' and date >='$xFromDate'";
$result2=mysql_query($xSalesQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xTotalSales']=$row['totalsales'] ;
}


$xLowStockQuery="SELECT count(itemno) as lowstock  from inv_stockentry WHERE stock < minstock";
$result2=mysql_query($xLowStockQuery);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xLowStock']=$row['lowstock'] ;
}

$xHighStockQuery="SELECT count(itemno) as highstock from inv_stockentry WHERE maxstock > stock";
$result2=mysql_query($xHighStockQuery);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xHighStock']=$row['highstock'] ;
}



$xZeroStockQuery="SELECT count(itemno) as zerostock from inv_stockentry WHERE  stock=0";
$result2=mysql_query($xZeroStockQuery);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xZeroStock']=$row['zerostock'] ;
}

$xComplaintsQry="SELECT count(complaintno) as count FROM t_complaint WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xComplaintsQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xComplaintCount']=$row['count'] ;
}

echo '</br>'; 
echo '<table class="table table-striped table-bordered table-hover">'; 
  echo "<tr><td> TOTAL SUPPLIERS</td><td>"; 
  echo    $GLOBALS ['xTotalSupplier'];
  echo "</td><td><a href='inv_hm001supplier.php'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";  
  

  echo "<tr><td> TOTAL ITEMS </td><td>"; 
  echo    $GLOBALS ['xTotalItem'];
  echo "</td><td><a href='inv_hr002item.php'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>"; 

  echo "<tr><td> TODAY'S PURCHASE/ITEM</td><td>"; 
  echo    $GLOBALS ['xTotalPurchase'];
  echo "</td><td><a href='inv_hr003purchaseentry.php?form=home'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>"; 

  echo "<tr><td> TODAY'S SALES/ITEM </td><td>"; 
  echo    $GLOBALS ['xTotalSales'];
  echo "</td><td><a href='inv_hr004salesentry.php?form=home'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>"; 

/*

  echo "<tr><td>LOW-STOCK</td><td>"; 
  echo    $GLOBALS ['xLowStock'];
  echo "</td><td><a href='inv_hr002_a_lowstock.php'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";


  echo "<tr><td> HIGH-STOCK</td><td>"; 
  echo    $GLOBALS ['xHighStock'];
  echo "</td><td><a href='inv_hr002_b_highstock.php'; ><img  src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";

  echo "<tr><td> ZERO-STOCK</td><td>"; 
  echo    $GLOBALS ['xZeroStock'];
  echo "</td></tr>";
  echo "</td></tr>";
*/
  echo "</td></tr>";
  echo "<tr><td> COMPLAINTS</td><td>"; 
  echo  round($GLOBALS ['xComplaintCount']);
  echo "</td><td><a href='inv_ht001_a_complaintentry.php';><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td></tr>";

?>                  

  
<html>
<title>HOME-PAGE</title>


</html>
