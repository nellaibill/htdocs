<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
  $xCreatedAsOn= $_POST ['f_createdason'];
  $xUpdatedAsOn= $_POST ['f_updatedason'];
  $xQry = "
update config_datetime set v_createdason=$xCreatedAsOn,v_updatedason=$xUpdatedAsOn";
mysql_query ( $xQry );
header('Location: index.php'); 
}
?>
<html>
<body>
<title>SETTINGS</title>

<form action="hc003datetime.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">DATE& TIME -CONFIGURATION</h3>
</div>
<div class="panel-body">

<div class="form-group">


<div class="col-xs-2">
<label for="" class="control-label col-xs-3">CREATEDASON</label>
<select class="form-control" name="f_createdason">
	<option value="0" <?php if($GLOBALS ['xViewCreatedAsOn']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewCreatedAsOn']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">UPDATEDASON</label>
<select class="form-control" name="f_updatedason">
	<option value="0" <?php if($GLOBALS ['xViewUpdatedAsOn']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewUpdatedAsOn']=="1") echo 'selected="selected"'; ?>>NO</option>
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