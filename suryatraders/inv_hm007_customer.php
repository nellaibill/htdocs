<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['customerid'] ) && ! empty ( $_GET ['customerid'] )) {
	$no = $_GET ['customerid'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['customerid'] );
	} 
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} else {
	fn_GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xCustomerId'] = '';
	$GLOBALS ['xCustomerName'] = '';
	$GLOBALS ['xCustomerAddress1'] = '';
	$GLOBALS ['xCustomerAddress2'] = '';
	$GLOBALS ['xCustomerAddress3'] = '';
	$GLOBALS ['xCustomerTinNo'] = '';
	$GLOBALS ['xCustomerCstNo'] = '';
	$GLOBALS ['xCustomerCExNo'] = '';
	
}
function fn_GetMaxIdNo() {
	$xQry = "SELECT  CASE WHEN max(customerid)IS NULL OR max(customerid)= '' THEN '1' ELSE max(customerid)+1 END AS customerid FROM inv_customer";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerid'] = $row ['customerid'];
		$GLOBALS ['xMobileNo'] = 0;
	}
}
function DataFetch($xCustomerid) {
	$result = mysql_query ( "SELECT *  FROM inv_customer where customerid=$xCustomerid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xCustomerid'] = $row ['customerid'];
			$GLOBALS ['xCustomerName'] = $row ['customername'];
			$GLOBALS ['xCustomerAddress1'] = $row ['customeraddressline1'];
			$GLOBALS ['xCustomerAddress2'] = $row ['customeraddressline2'];
			$GLOBALS ['xCustomerAddress3'] = $row ['customeraddressline3'];
			$GLOBALS ['xCustomerCstNo'] = $row ['customercstno'];
			$GLOBALS ['xCustomerTinNo'] = $row ['customertinno'];
			$GLOBALS ['xCustomerCexNo'] = $row ['customercexno'];
		}
	}
}
function DataProcess($mode) {
	$xCustomerid = $_POST ['f_customerid'];
	$xCustomerName = strtoupper ( $_POST ['f_customername'] );
	$xCustomerAddress1 = $_POST ['f_customeraddress1'];
	$xCustomerAddress2 = $_POST ['f_customeraddress2'];
	$xCustomerAddress3 = $_POST ['f_customeraddress3'];
	$xCustomerCstNo = $_POST ['f_customercstno'];
	$xCustomerTinNo = $_POST ['f_customertinno'];
	$xCustomerCExNo = $_POST ['f_customercexno'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO inv_customer  VALUES ($xCustomerid,'$xCustomerName',
		'$xCustomerAddress1','$xCustomerAddress2','$xCustomerAddress3',
		'$xCustomerCstNo','$xCustomerTinNo','$xCustomerCExNo')";
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_customer   SET customername='$xCustomerName',
		customeraddressline1='$xCustomerAddress1',customeraddressline2='$xCustomerAddress2',customeraddressline3='$xCustomerAddress3',
		customercstno='$xCustomerCstNo',customertinno='$xCustomerTinNo',customercexno='$xCustomerCExNo' 
		WHERE customerid=$xCustomerid";
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	fn_GetMaxIdNo ();
	ShowAlert ( $xMsg );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>M-customer</title>
</head>
<script type="text/javascript">
        function validateForm() {

            var xCustomerName = document.forms["inventorycustomerform"]["f_customername"].value;
            if (xCustomerName == null || xCustomerName == "") {
                alert("customer-Name must be filled out");
                document
                    .inventorycustomerform
                    .f_customername
                    .focus();
                return false;
            }

        }
    </script>
<body onload='document.inventorycustomerform.f_customername.focus()'>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form"
		method="post" name="inventorycustomerform">
		<div class="panel panel-primary" data-bind="nextFieldOnEnter:true">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">MASTER -CUSTOMER</h3>
			</div>

			<div class="panel-body">

				<div class="col-xs-2" style="display: none;">
					<label>Customer Id:</label> <input type="text" class="form-control"
						name="f_customerid"
						value="<?php echo $GLOBALS ['xCustomerid']; ?>" readonly>
				</div>
				<div class="col-xs-3">
					<label>Customer Name :</label> <input class="form-control"
						name="f_customername" type="text"
						value="<?php echo $GLOBALS ['xCustomerName']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Address 1:</label> <input class="form-control"
						name="f_customeraddress1" type="text"
						value="<?php echo $GLOBALS ['xCustomerAddress1']; ?>">
				</div>
				<div class="col-xs-3">
					<label>Address 2:</label> <input class="form-control"
						name="f_customeraddress2" type="text"
						value="<?php echo $GLOBALS ['xCustomerAddress2']; ?>">
				</div>
				<div class="col-xs-3">
					<label>Address 3:</label> <input class="form-control"
						name="f_customeraddress3" type="text"
						value="<?php echo $GLOBALS ['xCustomerAddress3']; ?>">
				</div>


				<div class="col-xs-3">
					<label>GSTIN No</label> <input class="form-control"
						name="f_customertinno" type="text"
						value="<?php echo $GLOBALS ['xCustomerTinNo']; ?>">
				</div>


				<div class="col-xs-3" style="display: none;">
					<label>Cst No :</label> <input class="form-control"
						name="f_customercstno" type="text"
						value="<?php echo $GLOBALS ['xCustomerCstNo']; ?>">
				</div>
					<div class="col-xs-3" style="display: none;">
					<label>C.Ex No :</label> <input class="form-control"
						name="f_customercexno" type="text"
						value="<?php echo $GLOBALS ['xCustomerCExNo']; ?>">
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
                        <?php if ($GLOBALS ['xMode'] == "") {  ?>
                        <input class="btn btn-primary" id="save"
						name="save" onclick="return validateForm()" type="submit"
						value="SAVE">
                    <?php } else{ ?>
                        <input class="btn btn-primary" name="update"
						onclick="return validateForm()" type="submit" value="UPDATE">
                        <?php }  ?>
                    </div>
			</div>

		</div>
	</form>
	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading clearfix">
					<h3 class="panel-title pull-left" style="padding-top: 7.5px;">VIEW
						CUSTOMER</h3>
					<div class="btn-group pull-right">
						<a class="btn btn-default" href="inv_hc001customer.php">CONFIG</a>
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>S.NO</th>
							<th>CUSTOMER NAME</th>
							<th>ADDRESS-1</th>
							<th>ADDRESS-2</th>
							<th>ADDRESS-3</th>
							<th>GSTIN-NO</th>
			
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>

                                <?php
																																$xSlNo = 0;
																																$xQry = '';
																																$xQry = "SELECT *  from inv_customer order by  customername";
																																$result2 = mysql_query ( $xQry );
																																$rowCount = mysql_num_rows ( $result2 );
																																while ( $row = mysql_fetch_array ( $result2 ) ) {
																																	?><tr>
																																	<?php
																																	echo '<td>' . $xSlNo += 1 . '</td>';
																																	echo '<td>' . $row ['customername'] . '</td>';
																																	echo '<td>' . $row ['customeraddressline1'] . '</td>';										
																																	echo '<td>' . $row ['customeraddressline2'] . '</td>';		
																																	echo '<td>' . $row ['customeraddressline3'] . '</td>';
																																	echo '<td>' . $row ['customertinno'] . '</td>';
																														
																																	
																																	?>
                             <td><a
								href="inv_hm007_customer.php<?php echo '?customerid='.$row['customerid'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img alt="HTML tutorial"
									src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							   <!--
							<td><a
								href="inv_hm007_customer.php<?php echo '?customerid='.$row['customerid']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img alt="HTML tutorial"
									src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
!-->

                                <?php
																																	echo '</tr>';
																																}
																																
																																?>
                            
					
					
					
					</tbody>
				</table>
			</div>
		</div>
		<!-- /container -->
	</div>

</body>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<script src="js/nextfocus.js"></script>