<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
  /*$xItemCategoryNo= $_POST ['f_itemcategoryno'];
  $xItemGroupNo= $_POST ['f_itemgroupno'];
  $xItemSubGroupNo= $_POST ['f_itemsubgroupno'];*/
  
  $xStockPoint= $_POST ['f_stockpoint'];
  $xCategory= $_POST ['f_category'];
  $xGroup= $_POST ['f_group'];
  $xSubGroup= $_POST ['f_subgroup'];
  $xBrandNo= $_POST ['f_brandno'];
  $xModelNo= $_POST ['f_modelno'];
  $xSerialNo= $_POST ['f_serialno'];
  $xFunctionOfWorks= $_POST ['f_functionofworks'];
  $xAccessories= $_POST ['f_accessories'];
  $xConditions=$_POST ['f_conditions'];
  $xRemarks= $_POST ['f_remarks'];
  $xViewAmcOnly= $_POST ['f_viewamconly'];
  $xQry = "
update config_inventory set v_stockpoint=$xStockPoint,v_category=$xCategory,v_group=$xGroup,v_subgroup=$xSubGroup,
v_brandno=$xBrandNo,v_modelno=$xModelNo,v_serialno=$xSerialNo,v_functionofworks=$xFunctionOfWorks,v_accessories=$xAccessories,v_conditions=$xConditions,v_remarks=$xRemarks,v_amconly='$xViewAmcOnly'";
  mysql_query ( $xQry );
      header('Location: inv_hr002item.php'); 
}
?>
<html>
<body>
<title>SETTINGS</title>

<form action="inv_hc002item.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">INVENTORY -CONFIGURATION</h3>
</div>
<div class="panel-body">

<div class="form-group">

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">STOCKPOINT</label>
<select class="form-control" name="f_stockpoint">
	<option value="0" <?php if($GLOBALS ['xViewStockPoint']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewStockPoint']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">CATEGORY</label>
<select class="form-control" name="f_category">
	<option value="0" <?php if($GLOBALS ['xViewCategory']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewCategory']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">GROUP</label>
<select class="form-control" name="f_group">
	<option value="0" <?php if($GLOBALS ['xViewGroup']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewGroup']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">SUBGROUP</label>
<select class="form-control" name="f_subgroup">
	<option value="0" <?php if($GLOBALS ['xViewSubGroup']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewSubGroup']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>



<div class="col-xs-2">
<label for="" class="control-label col-xs-3">BRANDNO</label>
<select class="form-control" name="f_brandno">
	<option value="0" <?php if($GLOBALS ['xViewBrandNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewBrandNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">MODELNO</label>
<select class="form-control" name="f_modelno">
	<option value="0" <?php if($GLOBALS ['xViewModelNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewModelNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">SERIALNO</label>
<select class="form-control" name="f_serialno">
	<option value="0" <?php if($GLOBALS ['xViewSerialNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewSerialNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">WORKFUNCTIONS</label>
<select class="form-control" name="f_functionofworks">
	<option value="0" <?php if($GLOBALS ['xViewFunctionOfWorks']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewFunctionOfWorks']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">ACCESSORIES</label>
<select class="form-control" name="f_accessories">
	<option value="0" <?php if($GLOBALS ['xViewAccessories']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewAccessories']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">CONDITIONS</label>
<select class="form-control" name="f_conditions">
	<option value="0" <?php if($GLOBALS ['xViewConditions']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewConditions']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">REMARKS</label>
<select class="form-control" name="f_remarks">
	<option value="0" <?php if($GLOBALS ['xViewRemarks']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewRemarks']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">AMCONLY</label>
<select class="form-control" name="f_viewamconly">
	<option value="0" <?php if($GLOBALS ['xViewAmcOnly']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewAmcOnly']=="1") echo 'selected="selected"'; ?>>NO</option>
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