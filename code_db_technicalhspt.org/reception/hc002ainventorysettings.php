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
  $xRemarks= $_POST ['f_remarks'];
  $xQry = "
update config_inventory set v_stockpoint=$xStockPoint,v_category=$xCategory,v_group=$xGroup,v_subgroup=$xSubGroup,
v_brandno=$xBrandNo,v_modelno=$xModelNo,v_serialno=$xSerialNo,v_remarks=$xRemarks";
  mysql_query ( $xQry );
  echo  "<script type='text/javascript'>";
  echo "window.close();";
  echo "</script>";
}
?>
<html>
<body>
<title>SETTINGS</title>
<!--
<div class="form-group">
<label class="control-label col-xs-2">CATEGORY:</label>
<select class="control-label col-xs-3"  value="" name="f_itemcategoryno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemcategory");
  echo "<option value=''>CHOOSE CATEGORY </option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemcategoryno']; ?>" 
     <?php if ($row['itemcategoryno']== $GLOBALS ['xItemCategoryNo']){echo 'selected="selected"';}  ?> >
     <?php echo $row['itemcategoryname']; ?> 
    </option>
    <? } echo "</select>";
    ?>
</div>


<div class="form-group">
<label class="control-label col-xs-2">GROUP:</label>
<select class="control-label col-xs-3"  value="" name="f_itemgroupno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemgroup");
  echo "<option value=''>CHOOSE GROUP</option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemgroupno']; ?>" 
     <?php if ($row['itemgroupno']== $GLOBALS ['xItemGroupNo']){echo 'selected="selected"';} ?> >
     <?php echo $row['itemgroupname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>

<div class="form-group">
<label class="control-label col-xs-2">SUB GROUP:</label>
<select class="control-label col-xs-3"  value="" name="f_itemsubgroupno"  >
<?php
  $result = mysql_query("SELECT *  FROM m_itemsubgroup");
  echo "<option value=''>CHOOSE SUB-GROUP</option>";
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemsubgroupno']; ?>" 
     <?php if ($row['itemsubgroupno']== $GLOBALS ['xItemSubGroupNo']){echo 'selected="selected"';} ?> >
     <?php echo $row['itemsubgroupname']; ?> 
    </option>
    <? } echo "</select>";
             ?>
</div>
</br> </br></br>

!-->


<form action="hc002ainventorysettings.php" method="post">
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
<label for="" class="control-label col-xs-3">REMARKS</label>
<select class="form-control" name="f_remarks">
	<option value="0" <?php if($GLOBALS ['xViewRemarks']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewRemarks']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
</div></div>

<div class="panel-footer clearfix">
        <div class="pull-right">
            <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
            <input type="cancel"  name="cancel" class="btn btn-primary" value="CANCEL"  onclick="window.close()";>
        </div>
</div>
</div></form>

</body>
</html>