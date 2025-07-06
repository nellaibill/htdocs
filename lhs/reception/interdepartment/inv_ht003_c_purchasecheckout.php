<?php 
include '../globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
      $xSupplierNo= $_POST ['f_supplierno'];
      if (empty ( $_POST ['f_companyinvoiceno'] )) {
	$xCompanyInvoiceNo="";
       } else {
	$xCompanyInvoiceNo= $_POST ['f_companyinvoiceno'];
       }

      fn_GetPurchaseInvoiceNo();
      $xPurchaseInvoiceNo=$GLOBALS ['xPurchaseInvoiceNo'];
      mysql_query ("LOCK TABLES inv_temppurchaseentry WRITE, inv_purchaseentry WRITE")or die ( mysql_error () );
      $xInsertQry="INSERT INTO inv_purchaseentry (txno,purchaseinvoiceno,date,companyinvoiceno,itemno,daterecieved,dateexpired,
            batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit)
            SELECT txno,purchaseinvoiceno,date,companyinvoiceno,itemno,daterecieved,dateexpired,
                    batchid,qty,freeqty,originalprice,sellingprice,discount,vat,total,nettotal,profit   
                    FROM inv_temppurchaseentry";
      mysql_query ($xInsertQry)or die ( mysql_error () );
      mysql_query ("DELETE FROM inv_temppurchaseentry ")or die ( mysql_error () );
      mysql_query ("UNLOCK TABLES")or die ( mysql_error () );

      $xQry = "update inv_purchaseentry set supplierno=$xSupplierNo,companyinvoiceno='$xCompanyInvoiceNo'  where  purchaseinvoiceno=$xPurchaseInvoiceNo";
      mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
  
}

    function fn_GetPurchaseInvoiceNo() 
       {
	$xQry="SELECT  purchaseinvoiceno from inv_temppurchaseentry";
        $result = mysql_query ( $xQry ) or die ( mysql_error () );
		while ( $row = mysql_fetch_array ( $result ) ) 
                {
			$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
		}
	}
 
?>
<html>


<body>
<title>P-CheckOut</title>
<form action="inv_ht003_c_purchasecheckout.php" method="post">
<div class="panel panel-primary">
  <div class="panel-heading  text-center">
			<h3 class="panel-title">PURCHASE-CONFIRMATION</h3>
	  </div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>Supplier Name</label>
<select class="form-control"   name="f_supplierno">
<?php DropDownSupplier();
echo "</select>";
?>
</div>

<div class="col-xs-3">
<label>Company Invoice No:</label>
<input type="text" class="form-control" name="f_companyinvoiceno">
</div>

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
<input type="cancel"  name="cancel" class="btn btn-primary" value="CLOSE"  onclick="window.close()";>        </div>
</div>

  </br> </br>
</body>
</html>