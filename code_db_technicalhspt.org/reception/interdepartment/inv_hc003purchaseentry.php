<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
$xPurchaseInvoiceNo= $_POST ['f_purchaseinvoiceno'];
$xDate= $_POST ['f_purchaseentrydate'];
$xCompanyInvoiceNo= $_POST ['f_companyinvoiceno'];
$xSupplierNo= $_POST ['f_supplierno'];
$xDateRecieved= $_POST ['f_daterecieved'];
$xExpiredDate= $_POST ['f_dateexpired'];
$xBatchId= $_POST ['f_batchid'];
$xFreeQty= $_POST ['f_freeqty'];
$xSellingPrice= $_POST ['f_sellingprice'];
$xVat= $_POST ['f_vat'];
$xProfit= $_POST ['f_profit'];
$xTotal= $_POST ['f_total'];

$xQry = "UPDATE config_purchase  set v_purchaseinvoiceno=$xPurchaseInvoiceNo,v_date=$xDate,v_companyinvoiceno=$xCompanyInvoiceNo,v_supplierno=$xSupplierNo,v_daterecieved=$xDateRecieved,v_dateexpired=$xExpiredDate,v_batchid=$xBatchId,v_freeqty=$xFreeQty,v_sellingprice=$xSellingPrice,v_vat=$xVat,v_profit=$xProfit,v_total=$xTotal";

  mysql_query ( $xQry );
  header('Location: inv_hr003purchaseentry.php'); 
}
?>
<html>
<body>
<title>SETTINGS</title>

<form action="inv_hc003purchaseentry.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">PURCHASE ENTRY -CONFIGURATION</h3>
</div>
<div class="panel-body">

<div class="form-group">

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">PURCHASEINVOICENO</label>
<select class="form-control" name="f_purchaseinvoiceno">
	<option value="0" <?php if($GLOBALS ['xViewPurInvoiceNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurInvoiceNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">DATE</label>
<select class="form-control" name="f_purchaseentrydate">
	<option value="0" <?php if($GLOBALS ['xViewPurDate']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurDate']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">COMPANYINVOICENO</label>
<select class="form-control" name="f_companyinvoiceno">
	<option value="0" <?php if($GLOBALS ['xViewPurCompanyInvoiceNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurCompanyInvoiceNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">SUPPLIERNO</label>
<select class="form-control" name="f_supplierno">
	<option value="0" <?php if($GLOBALS ['xViewPurSupplierNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurSupplierNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>



<div class="col-xs-2">
<label for="" class="control-label col-xs-3">DATERECIEVED</label>
<select class="form-control" name="f_daterecieved">
	<option value="0" <?php if($GLOBALS ['xViewPurDateRecieved']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurDateRecieved']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">DATEEXPIRED</label>
<select class="form-control" name="f_dateexpired">
	<option value="0" <?php if($GLOBALS ['xViewPurDateExpired']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurDateExpired']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">BATCHID</label>
<select class="form-control" name="f_batchid">
	<option value="0" <?php if($GLOBALS ['xViewPurBatchId']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurBatchId']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">FREEQTY</label>
<select class="form-control" name="f_freeqty">
	<option value="0" <?php if($GLOBALS ['xViewPurFreeQty']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurFreeQty']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">SELLINGPRICE</label>
<select class="form-control" name="f_sellingprice">
	<option value="0" <?php if($GLOBALS ['xViewPurSellingPrice']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurSellingPrice']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">VAT</label>
<select class="form-control" name="f_vat">
	<option value="0" <?php if($GLOBALS ['xViewPurVat']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurVat']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">PROFIT</label>
<select class="form-control" name="f_profit">
	<option value="0" <?php if($GLOBALS ['xViewPurProfit']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurProfit']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">TOTAL</label>
<select class="form-control" name="f_total">
	<option value="0" <?php if($GLOBALS ['xViewPurTotal']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPurTotal']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

</div></div>

<div class="panel-footer clearfix">
        <div class="pull-right">
            <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
        </div>
</div>
</div></form>

</body>
</html>