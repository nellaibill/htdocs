<?php
// include 'session.php';
include 'globalfile.php';
getconfig_sales ();
if (isset ( $_POST ['save'] )) {
	$xConfigSalesInvoiceNo = $_POST ['f_config_sales_invocieno'];
	$xConfigSalesStock = $_POST ['f_config_sales_stock'];
	$xConfigSalesGst = $_POST ['f_config_sales_gst'];
	$xConfigSalesDiscount = $_POST ['f_config_sales_discount'];
	$xConfigSalesPerson = $_POST ['f_config_salesperson'];
	$xConfigDeliveryTerms = $_POST ['f_config_deliveryterms'];
	$xConfigDespatch = $_POST ['f_config_despatch'];
	$xConfigDestination = $_POST ['f_config_destination'];
	$xConfigVehicleNo = $_POST ['f_config_vehicleno'];
	$xConfigServiceCharges = $_POST ['f_config_servicecharges'];
	
	$xQry = "update config_sales set 
	invoiceno='$xConfigSalesInvoiceNo',
	stock='$xConfigSalesStock',
	gst='$xConfigSalesGst',
	discount='$xConfigSalesDiscount',
	salesperson='$xConfigSalesPerson',
	despatch='$xConfigDespatch',
	destination='$xConfigDestination',
	delivery='$xConfigDeliveryTerms',
	vehicleno='$xConfigVehicleNo',
	service='$xConfigServiceCharges' where config_sales_id=1 
	";
	//echo $xQry;
	mysql_query ( $xQry );
	 echo "<script type='text/javascript'>";
	 echo "window.close();";
	 echo "</script>";
}
?>
<html>

<title>Sales Configuration</title>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

		<div class="panel panel-primary">
			<div class="panel-heading clearfix">
				<h4 class="panel-title pull-left" style="padding-top: 7.5px;">Sales
					Configuration</h4>
				<div class="btn-group pull-right">
					<a href="#" class="btn btn-default btn-sm" onclick="window.close()">Close</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
				
				
					<div class="col-xs-3">
						<label>Invoice No</label> <select class="form-control"
							name="f_config_sales_invocieno">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigSales_InvoiceNo']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigSales_InvoiceNo']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					
								<div class="col-xs-3">
						<label>Stock</label> <select class="form-control"
							name="f_config_sales_stock">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigSales_Stock']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigSales_Stock']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					
							<div class="col-xs-3">
						<label>Gst</label> <select class="form-control"
							name="f_config_sales_gst">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigSales_Gst']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigSales_Gst']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					
							<div class="col-xs-3">
						<label>Discount</label> <select class="form-control"
							name="f_config_sales_discount">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigSales_Discount']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigSales_Discount']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>Sales Person</label> <select class="form-control"
							name="f_config_salesperson">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigSalesPerson']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigSalesPerson']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>Terms of Delivery</label> <select class="form-control"
							name="f_config_deliveryterms">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigDeliveryTerms']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigDeliveryTerms']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>Despatch Through</label> <select class="form-control"
							name="f_config_despatch">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigDespatch']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigDespatch']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>Destination</label> <select class="form-control"
							name="f_config_destination">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigDestination']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigDestination']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>VehicleNo</label> <select class="form-control"
							name="f_config_vehicleno">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigVehicleNo']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigVehicleNo']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
					<div class="col-xs-3">
						<label>Service Charges</label> <select class="form-control"
							name="f_config_servicecharges">
							<option value="Yes"
								<?php if($GLOBALS ['xConfigServiceCharges']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
							<option value="No"
								<?php if( $GLOBALS ['xConfigServiceCharges']=="No") echo 'selected="selected"'; ?>>No</option>

						</select>
					</div>
				
				</div>
			</div>
		</div>
		<div class="panel-footer clearfix">
			<div class="pull-right">
				<input type="submit" name="save" class="btn btn-primary"
					value="SAVE">
			</div>
		</div>
	</form>
</body>
</html>