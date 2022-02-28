<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
  /*$xItemCategoryNo= $_POST ['f_itemcategoryno'];
  $xItemGroupNo= $_POST ['f_itemgroupno'];
  $xItemSubGroupNo= $_POST ['f_itemsubgroupno'];*/
  
  $xStockPoint= $_POST ['f_stockpoint'];
  $xDate= $_POST ['f_date'];
  $xComplaintBy= $_POST ['f_complaintby'];
  $xContactPerson= $_POST ['f_contactperson'];
  $xStatus= $_POST ['f_status'];
  $xRemarks= $_POST ['f_remarks'];
  $xCompletedDate= $_POST ['f_completeddate'];
  $xBillNo= $_POST ['f_billno'];
  $xBillDetails= $_POST ['f_billdetails'];
  $xPaymentStatus=$_POST ['f_paymentstatus'];
  $xRequiredDateFilter=$_POST ['f_requireddatefilter'];
    $xQry = "
update config_complaint set v_stockpoint=$xStockPoint,v_date=$xDate,v_complaintby=$xComplaintBy,v_contactperson=$xContactPerson,
v_status=$xStatus,v_remarks=$xRemarks,v_completeddate=$xCompletedDate,v_billno=$xBillNo,v_billdetails=$xBillDetails,v_paymentstatus=$xPaymentStatus,v_requireddatefilter=$xRequiredDateFilter";
  mysql_query ( $xQry );
      header('Location: inv_hr001complaints.php'); 
}
?>
<html>
<body>
<title>SETTINGS</title>

<form action="inv_hc001complaints.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">INVENTORY -COMPLAINTS</h3>
</div>
<div class="panel-body">

<div class="form-group">

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">StockPoint</label>
<select class="form-control" name="f_stockpoint">
	<option value="0" <?php if($GLOBALS ['xViewStockPoint']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewStockPoint']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">Date</label>
<select class="form-control" name="f_date">
	<option value="0" <?php if($GLOBALS ['xViewComplaintDate']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewComplaintDate']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">ComplaintBy</label>
<select class="form-control" name="f_complaintby">
	<option value="0" <?php if($GLOBALS ['xViewComplaintBy']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewComplaintBy']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">ContactPerson</label>
<select class="form-control" name="f_contactperson">
	<option value="0" <?php if($GLOBALS ['xViewContactPerson']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewContactPerson']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>



<div class="col-xs-2">
<label for="" class="control-label col-xs-3">Status</label>
<select class="form-control" name="f_status">
	<option value="0" <?php if($GLOBALS ['xViewStatus']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewStatus']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">Remarks</label>
<select class="form-control" name="f_remarks">
	<option value="0" <?php if($GLOBALS ['xViewRemarks']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewRemarks']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">CompletedDate</label>
<select class="form-control" name="f_completeddate">
	<option value="0" <?php if($GLOBALS ['xViewCompletedDate']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewCompletedDate']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">BillNo</label>
<select class="form-control" name="f_billno">
	<option value="0" <?php if($GLOBALS ['xViewBillNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewBillNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">BillDetails</label>
<select class="form-control" name="f_billdetails">
	<option value="0" <?php if($GLOBALS ['xViewBillDetails']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewBillDetails']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">PaymentStatus</label>
<select class="form-control" name="f_paymentstatus">
	<option value="0" <?php if($GLOBALS ['xViewPaymentStatus']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewPaymentStatus']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">RequiredDateFilter</label>
<select class="form-control" name="f_requireddatefilter">
	<option value="0" <?php if($GLOBALS ['xViewRequiredDateFilter']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewRequiredDateFilter']=="1") echo 'selected="selected"'; ?>>NO</option>
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