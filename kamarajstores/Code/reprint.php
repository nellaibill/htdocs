<?php
include 'globalfile.php';
$xPrintTemplate=$GLOBALS ['xPrintTemplate'];
if (isset($_POST ['f_salesinvoiceno'])) {
   // Execute code (such as database updates) here.

   // Redirect to this page.
   //$xPrintLink= "<script>window.open('inv_hp004salesentry.php?salesinvoiceno=$_POST ['f_purchaseinvoiceno']')</script>";
   //echo $xPrintLink;
   header('Location: '.$xPrintTemplate .'?salesinvoiceno='.$_POST ['f_salesinvoiceno']);
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Purchase Reprint</title>
</head>
<body>

<form class="form" name="frmpurchasereprint" method="post"> 


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
</div>
</form>