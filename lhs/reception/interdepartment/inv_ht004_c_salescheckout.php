<?php 
include '../globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
         $xEmpNo= $_POST ['f_empno'];
         $xStockPointNo= $_POST ['f_stockpointno'];
         fn_GetSalesInvoiceNo();
         $xSalesInvoiceNo=$GLOBALS ['xSalesInvoiceNo'];
         mysql_query ("LOCK TABLES inv_tempsalesentry WRITE, inv_salesentry WRITE")or die ( mysql_error () );
	 mysql_query ("INSERT INTO inv_salesentry
                     (txno,salesinvoiceno,date,itemno,qty,
                     usagestockdetails,createdason,updatedason)                                           
                SELECT *   FROM inv_tempsalesentry")or die ( mysql_error () );
	 mysql_query ("DELETE FROM inv_tempsalesentry")or die ( mysql_error () );
	 mysql_query ("UNLOCK TABLES")or die ( mysql_error () );
         $xQry = "update inv_salesentry set empno=$xEmpNo,usagestockpointno=$xStockPointNo where salesinvoiceno=$xSalesInvoiceNo";
         mysql_query ( $xQry );
	 $xPrintLink= "<script>window.open('inv_hp004salesentry.php?salesinvoiceno=$xSalesInvoiceNo')</script>";
	 echo $xPrintLink;
}

    function fn_GetSalesInvoiceNo() 
       {
	$xQry="SELECT  salesinvoiceno from inv_tempsalesentry";
        $result = mysql_query ( $xQry ) or die ( mysql_error () );
		while ( $row = mysql_fetch_array ( $result ) ) 
                {
			$GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
		}
	}
 
?>
<html>


<body>
<title>SETTINGS</title>
<form action="inv_ht004_c_salescheckout.php" method="post">
<div class="panel panel-primary">
  <div class="panel-heading  text-center">
			<h3 class="panel-title">SALES-CONFIRMATION</h3>
	  </div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>Employee Name</label>
<select class="form-control"   name="f_empno">
<?php DropDownEmployee();
echo "</select>";
?>
</div>

<div class="col-xs-3">
<label>Usage Stock Point  Name</label>
<select class="form-control"   name="f_stockpointno">
<?php DropDownStockPoint();
echo "</select>";
?>
</div>

<div class="col-xs-2">
<label>Amount:</label>
<input type="number" class="form-control"   name="f_recievingamount" placeholder="0" readonly>
</div>

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
<a href="inv_ht004salesentry.php"  class="btn btn-primary">CLOSE</a>
<!--
<input type="cancel"  name="cancel" class="btn btn-primary" value="CLOSE"  onclick="window.close()";>  
!-->      </div>
</div>

  </br> </br>
</body>
</html>