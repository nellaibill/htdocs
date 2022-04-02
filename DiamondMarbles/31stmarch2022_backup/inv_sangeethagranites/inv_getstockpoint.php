<?php 
include '../globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
  $xStockPointNo= $_POST ['f_stockpointno'];
  $xQry = "update config_inventory set stockpointno=$xStockPointNo";
mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.opener.location.href='inv_ht004salesentry.php';";
echo "window.close();";
echo "</script>";
}
?>
<html>

<title>SETTINGS</title>
<body>

<form action="inv_getstockpoint.php" method="post">
<div class="panel panel-primary">
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>Usage Stock Point  Name</label>
<select class="form-control"   name="f_stockpointno">
<?php DropDownStockPoint();

?>
</select>
</div>

</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
<input type="submit"  name="cancel" class="btn btn-primary" value="CLOSE"  onclick="window.close()">        </div>
</div>
</form>
</body>
</html>