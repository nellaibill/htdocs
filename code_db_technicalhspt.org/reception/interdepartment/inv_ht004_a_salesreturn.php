<?php
 include 'globalfile.php';
 $GLOBALS ['xSalesReturnDate']=$GLOBALS ['xCurrentDate'];
 /* $xPurchaseTxNo=$_GET['passtxno'];
 $xPurchaseInvoiceNo=$_GET['passpurchaseinvoiceno'];
 $xItemNo=$_GET['passitemno'];*/
 if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
 {
  $no= $_GET['txno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['txno']);
   }
   else 
   {
         $xOldQty=$_GET['qty'];
         $xItemNo=$_GET['itemno'];
         $xQry = "DELETE FROM inv_salesreturn WHERE txno= $no";
         $xStockUpdateQry="update inv_stockentry set stock=stock+$xOldQty where itemno=$xItemNo";
         mysql_query ($xQry) or die ( mysql_error () );
         mysql_query ($xStockUpdateQry) or die ( mysql_error () );
         header('Location: inv_ht004_a_salesreturn.php'); 
   }
}
else if (isset ( $_POST ['save'] ))
{ 
   DataProcess ( "S");
}
else if (isset ( $_POST ['update'] ))
{ 
   DataProcess ( "U");
}
else
 {
  GetMaxIdNo ();
 }

function GetMaxIdNo() 
   {
	$result = mysql_query ("SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' 
                          ELSE max(txno)+1 END AS txno FROM  inv_salesreturn") or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) 
            {$GLOBALS ['xTxNo'] = $row ['txno'];}
   }
function DataFetch($xTxNo) {
    $result = mysql_query ( "SELECT *  FROM inv_salesreturn where txno=$xTxNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTxNo'] = $row ['txno'];
                finditemname($row['itemno']);
 		$GLOBALS ['xItemNo'] = $row ['itemno'];
 		/*$GLOBALS ['xPurchaseTxNo'] = $row ['purchasetxno'];
 		$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];*/
                $GLOBALS ['xOldQty'] = $row ['returnqty'];
                $GLOBALS ['xReturnDetails'] = $row ['returndetails'];
 		}
	}
}
function DataProcess($mode) {
$xTxNo= $_POST ['f_txno'];
$xSalesReturnDate= $_POST ['f_salesreturndate'];
/*$xPurchaseTxNo= $_POST ['f_purchasetxno'];
$xPurchaseInvoiceNo= $_POST ['f_purchaseinvoiceno'];*/
$xItemNo= $_POST ['f_itemno'];
$xReturnQty= $_POST ['f_returnqty'];
$xReturnDetails= $_POST ['f_returndetails'];
        $xCurrentUser=$GLOBALS ['xCurrentUser'];
        $xCurrentDate=$GLOBALS ['xCurrentDateTime'];

$xQry="";
$xStockUpdateQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO inv_salesreturn (txno,salesreturndate,itemno,returnqty,returndetails,createdason,updatedason,loggeduser) 
                VALUES ($xTxNo,'$xSalesReturnDate',$xItemNo,$xReturnQty,'$xReturnDetails','$xCurrentDate','$xCurrentDate','$xCurrentUser')";
$xStockUpdateQry="update inv_stockentry set stock=stock-$xReturnQty where itemno=$xItemNo";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
  $xOldQty=$_POST ['f_oldqty'];
$xQry = "UPDATE inv_salesreturn set salesreturndate='$xSalesReturnDate',
         itemno=$xItemNo,returnqty=$xReturnQty,returndetails='$xReturnDetails',updatedason='$xCurrentDate',loggeduser='$xCurrentUser' where txno=$xTxNo";
$xStockUpdateQry="update inv_stockentry set stock=(stock+$xOldQty)-$xReturnQty where itemno=$xItemNo";
$xMsg="Updated";
} 
mysql_query ($xQry) or die ( mysql_error () );
mysql_query ($xStockUpdateQry) or die ( mysql_error () );
//header('Location: inv_ht004_a_salesreturn.php'); 
GetMaxIdNo();
}

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>SALES-RETURN</title>
	<script type="text/javascript">


	function validateForm() 
	 {
	 
	 var xQty= document.forms["salesreturnform"]["f_returnqty"].value;
     	 if (xQty== "") 
	   {
		alert("Enter Qty");
		document.salesreturnform.f_returnqty.focus();
		return false;
	   }

	}

      </script>
	</head>

	<body onload='document.salesreturnform.f_returnqty.focus()'> 
	<form class="form" name="salesreturnform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
	 <div class="panel panel-primary">
	  <div class="panel-heading  text-center">
			<h3 class="panel-title">Sales Return</h3>
	  </div>
	 <div class="panel-body">


<div class="col-xs-1">
<label>Tx.No :</label>
<input type="text" class="form-control"   name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>" readonly>
</div>
<div class="col-xs-2">
<label>Date:</label>
<input type="text" class="form-control"   name="f_salesreturndate" value="<?php echo $GLOBALS ['xSalesReturnDate']; ?>" readonly>
</div>
<!--
<div class="col-xs-1">
<label>Pur-Tx.No :</label>
<input type="text" class="form-control"   name="f_purchasetxno" value="<?php echo $GLOBALS ['xPurchaseTxNo']; ?>" readonly>
</div>

	<div class="col-xs-1">
	<label>InvNo:</label>
	<input type="text" class="form-control" name="f_purchaseinvoiceno" value="<?php echo $GLOBALS ['xPurchaseInvoiceNo']; ?>" readonly>
	</div>
!-->	
	<div class="col-xs-4">
	<label>Item Name:</label>
<select class="form-control"  value="" name="f_itemno"  >
<?php
 $result = mysql_query("SELECT *  FROM inv_stockentry a, m_item b WHERE a.itemno = b.itemno order by b.itemname ");
  while($row = mysql_fetch_array($result))
   {
     ?>
    <option value = "<?php echo $row['itemno']; ?>" 
     <?php
      if ($row['itemno']== $xItemNo ){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemname']. " - " .$row['stock'] ?> 
    </option>
    <? } 
?>
</select>

	</div>
            <? if ($GLOBALS ['xMode'] == "F") {  ?> 
                  <div class="col-xs-2">
	          <label>Old Qty:</label>
	          <input type="number" class="form-control" name="f_oldqty" value="<?php echo $GLOBALS ['xOldQty']; ?>" readonly>
	          </div>	              
	    <? }  ?>

	<div class="col-xs-2">
	<label>Return Qty:</label>
	<input min="0" max="99999" maxlength="5" class="form-control" name="f_returnqty" value="<?php echo $GLOBALS ['xReturnQty']; ?>" style="text-align:right;"  >
	</div>


	<div class="col-xs-4">
	<label>Return Details:</label>
	<input type="text" class="form-control" name="f_returndetails" value="<?php echo $GLOBALS ['xReturnDetails']; ?>" maxlength="250">
	</div>


	</div>

	<div class="panel-footer clearfix">
			<div class="pull-right">
 <? if ($GLOBALS ['xMode'] == "") {  ?> 
				   <input type="submit"  name="save"   class="btn btn-primary" value="Save" id="save" onclick="return validateForm()"> 
			   <? } else{ ?>
				   <input type="submit"  name="update"   class="btn btn-primary" value="Update" onclick="return validateForm()" > 
			   <? }  ?>
			</div>
	</div>
		

</div></div>
</form>

<hr>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><h3 class="panel-title text-center"><?php echo "Sales  Return As On ". date("d/M/y h:i:sa"); ?></h3></b></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">S.No</th>

           <th width="30%"> ItemName</th>
           <th width="10%"> ReturnQty</th>
           <th width="10%"> ReturnDetails</th>
           <th colspan="2" width="5%">ACTIONS</td>
 </tr>
      </thead>
      <tbody class="searchable">

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT *  from inv_salesreturn";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
  echo '<tr>';
    echo '<td>' .  $xSlNo+=1 . '</td>';
    finditemname($row['itemno']);
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['returnqty']  . '</td>';
    echo '<td>' . $row['returndetails']  . '</td>';
?>

<!-- 

 Mark Saleem 27/Nov/2015 Edit Option Removed 
 Reason While changing the item name Old Qty ,New Qty Problem Arises 

<td><a href="inv_ht004_a_salesreturn.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

!-->
<td><a href="inv_ht004_a_salesreturn.php<?php echo '?txno='.$row['txno'].'&qty='.$row['returnqty']. '&itemno='.$row['itemno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?

echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>