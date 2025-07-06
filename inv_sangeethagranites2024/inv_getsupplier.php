<?php 
include '../globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
  $xSupplierNo= $_POST ['f_supplierno'];
  $xQry = "update config_inventory set supplierno=$xSupplierNo";
mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.opener.location.href='inv_ht003purchaseentry.php';";
echo "window.close();";
echo "</script>";
}
?>
<html>

<title>SETTINGS</title>
<body onload='document.frm_getsupplier.f_supplierno.focus()'>

<form name="frm_getsupplier" action="inv_getsupplier.php" method="post">
<div class="panel panel-primary">
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>Supplier Name</label>
<select class="form-control"   name="f_supplierno">
<?php DropDownSupplier();

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