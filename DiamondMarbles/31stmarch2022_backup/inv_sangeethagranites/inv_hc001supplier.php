<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
   
  $xAddress= $_POST ['f_address'];
  $xMobileNo= $_POST ['f_mobileno'];
  $xEmailId= $_POST ['f_emailid'];
  $xTaxNo= $_POST ['f_taxno'];
  $xRegisterNo= $_POST ['f_registerno'];
  $xQry = "
update config_supplier set v_address=$xAddress,v_mobileno=$xMobileNo,v_emailid=$xEmailId,v_taxno=$xTaxNo,v_registerno=$xRegisterNo";
echo $xQry;
  mysql_query ( $xQry );
   header('Location: inv_hm001supplier.php'); 	
}
?>
<html>
<title>SUPPLIER-CONFIG</title>
<body>

<form action="inv_hc001supplier.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">SUPPLIER-CONFIGURATION</h3>
</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">ADDRESS</label>
<select class="form-control" name="f_address">
	<option value="0" <?php if($GLOBALS ['xViewAddress']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewAddress']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">MOBILENO</label>
<select class="form-control" name="f_mobileno">
	<option value="0" <?php if($GLOBALS ['xViewMobileNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewMobileNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">EMAILID</label>
<select class="form-control" name="f_emailid">
	<option value="0" <?php if($GLOBALS ['xViewEmailId']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewEmailId']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">TAXNO</label>
<select class="form-control" name="f_taxno">
	<option value="0" <?php if($GLOBALS ['xViewTaxNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewTaxNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">REGISTERNO</label>
<select class="form-control" name="f_registerno">
	<option value="0" <?php if($GLOBALS ['xViewRegisterNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewRegisterNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
</div></div>

<div class="panel-footer clearfix">
        <div class="pull-right">
            <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
            <input type="submit"  name="cancel" class="btn btn-primary" value="CANCEL"  onclick="inv_hm001supplier.php">
        </div>
</div>
</div></form>

</body>
</html>