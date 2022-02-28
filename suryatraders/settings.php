<?php
include 'globalfile.php';
if (isset ( $_POST ['save_print_config'] )) {
		GetMaxIdNo ();
	$xPrintType = $_POST ['f_print_type'];
	$xPrintFormat= $_POST ['f_print_format'];
	$xSalesBillNoforSettings= $_POST ['salesbillnoforsettings'];
	$xQry= "update config_print 
	set print_bill_type='$xPrintType', 
	print_format='$xPrintFormat',
	salesbillno=$xSalesBillNoforSettings 
	where id=1";
	mysql_query ($xQry) or die ( mysql_error () );
	header ( 'Location: settings.php' );
}

else {
	GetMaxIdNo ();
}

function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(salesbillno)IS NULL OR max(salesbillno)= '' 
   THEN '1' 
   ELSE max(salesbillno)+1 END AS salesbillno
FROM bill_suryatraders";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSalesBillNo'] = $row ['salesbillno'];
	}
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>BILL</title>
<link type="text/css" rel="stylesheet" href="css/responsive-tabs.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />

</script>
</head>
<body>
</br>
	<form class="form" name="save_print_config"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

				<div class="col-xs-3">
					 <select class="form-control" name="f_print_type">
<option value="ORIGINAL FOR BUYER" <?php if($GLOBALS ['xPrintBillType']=="ORIGINAL FOR BUYER") echo 'selected="selected"'; ?>>ORIGINAL FOR BUYER</option>
<option value="DUPLICATE FOR TRANSPORTER" <?php if($GLOBALS ['xPrintBillType']=="DUPLICATE FOR TRANSPORTER") echo 'selected="selected"'; ?>>DUPLICATE FOR TRANSPORTER</option>
<option value="TRIPLICATE FOR SELLER" <?php if($GLOBALS ['xPrintBillType']=="TRIPLICATE FOR SELLER") echo 'selected="selected"'; ?>>TRIPLICATE FOR SELLER</option>
<option value="EXTRA COPY" <?php if($GLOBALS ['xPrintBillType']=="EXTRA COPY") echo 'selected="selected"'; ?>>EXTRA COPY</option>
						</select>
					</div>
						<div class="col-xs-3" style="display:none">
					 <select class="form-control" name="f_print_format">

<option value="FORMAT_1" <?php if($GLOBALS ['xPrintFormat']=="FORMAT_1") echo 'selected="selected"'; ?>>FORMAT_1</option>
<option value="FORMAT_2" <?php if($GLOBALS ['xPrintFormat']=="FORMAT_2") echo 'selected="selected"'; ?>>FORMAT_2</option>
<option value="FORMAT_3" <?php if($GLOBALS ['xPrintFormat']=="FORMAT_3") echo 'selected="selected"'; ?>>FORMAT_3</option>

							
						</select>
						
					</div>
					<div class="col-xs-2" style="display:none">
							<input type="text" 
								class="form-control" name="salesbillnoforsettings"
								placeholder="billno" value="<?php echo $GLOBALS ['xSalesBillNo']-1; ?>" 
								>
						</div>	
<div class="col-xs-2">
							<input type="submit" name="save_print_config" class="btn btn-primary"
								value="SAVE SETTINGS" onclick="return validateForm()">

						</div>
						<div class="col-xs-2" style="display:none">
							<input type="submit" name="save_print_config" class="btn btn-primary"
								value="CLICK  TO PRINT" onclick="return validateForm()">

						</div>
					</br></br></br>
				
			</form>
		
