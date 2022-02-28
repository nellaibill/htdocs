<?php
include 'globalfile.php';
/*
if ($_POST ['f_purchaseinvoiceno'] !='') {
   header('Location: inv_hp004purchaseentry.php?purchaseinvoiceno='.$_POST ['f_purchaseinvoiceno']);
   exit();
}
*/
if ($_POST ['f_salesinvoiceno'] !='') {
   header('Location: inv_hp004salesentry.php?salesinvoiceno='.$_POST ['f_salesinvoiceno']);
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reprint</title>
</head>
<body>
<div>
<form class="form" name="frmpurchasereprint" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<!--
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">Purchase Reprint</h3>
</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2"> Purchase Invoice No</label>

<div class="col-xs-2">
<input type="text" class="form-control"  name="f_purchaseinvoiceno">
</div>
<div ><input type="submit"  name="print"   class="btn btn-primary" value="PRINT" id="print" > </div>
</div>
</div>
!-->
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">Sales Reprint</h3>
</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2"> Sales Invoice No</label>

<div class="col-xs-2">
<input type="text" class="form-control"  name="f_salesinvoiceno">
</div>
<div ><input type="submit"  name="print"   class="btn btn-primary" value="PRINT" id="print" > </div>
</div>
</div>
</form>