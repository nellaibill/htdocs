<?php
include 'globalfile.php';
fn_DataClear ();

if (isset ( $_GET ['customerno'] ) && ! empty ( $_GET ['customerno'] )) {
	$no = $_GET ['customerno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['customerno'] );
	} else {
		$xQry = "DELETE FROM inv_customer WHERE customerno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: customer.php' );
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
	$GLOBALS ['xCustomerAddress'] = '';
	$GLOBALS ['xCustomerMobileNo'] = '';
	$GLOBALS ['xCustomerEmail'] = '';
	$GLOBALS ['xGstNo']='';
}
function fn_GetMaxIdNo() {
	$xQry = "SELECT  CASE WHEN max(customerno)IS NULL OR max(customerno)= '' THEN '1' ELSE max(customerno)+1 END AS customerno FROM inv_customer";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerid'] = $row ['customerno'];
		$GLOBALS ['xMobileNo'] = 0;
	}
}
function DataFetch($xCustomerid) {
	$result = mysql_query ( "SELECT *  FROM inv_customer where customerno=$xCustomerid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xCustomerid'] = $row ['customerno'];
			$GLOBALS ['xCustomerName'] = $row ['customername'];
			$GLOBALS ['xCustomerAddress'] = $row ['customeraddress'];
			$GLOBALS ['xCustomerMobileNo'] = $row ['customermobileno'];
			$GLOBALS ['xCustomerEmail'] = $row ['customeremail'];
			$GLOBALS ['xGstNo']= $row ['customergstno'];		
		}
	}
}
function DataProcess($mode) {
	$xCustomerid = $_POST ['f_customerno'];
	$xCustomerName = strtoupper ( $_POST ['f_customername'] );
	$xCustomerAddress = $_POST ['f_customeraddress'];
	if (empty ( $_POST ['f_customermobileno'] )) {
		$xCustomerMobileNo = 0;
	} else
		$xCustomerMobileNo = $_POST ['f_customermobileno'];
	$xCustomerEmail = $_POST ['f_customeremail'];
	$xCustomerGstNo = $_POST ['f_gst_no'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO inv_customer  
		VALUES ($xCustomerid,'$xCustomerName','$xCustomerAddress','$xCustomerMobileNo',
		'$xCustomerEmail','$xCustomerGstNo')";
		// echo $xQry;
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_customer  
		 SET customername='$xCustomerName',
		 customeraddress='$xCustomerAddress',customermobileno='$xCustomerMobileNo',
		 customeremail='$xCustomerEmail',customergstno='$xCustomerGstNo'
		 WHERE customerno=$xCustomerid";
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	fn_GetMaxIdNo ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer</title>
</head>
<script type="text/javascript">
        function validateForm() {

            var xCustomerName = document.forms["inventorycustomerform"]["f_customername"].value;
            if (xCustomerName == null || xCustomerName == "") {
                alert("Customer-Name must be filled out");
                document
                    .inventorycustomerform
                    .f_customername
                    .focus();
                return false;
            }

            var txtMobile = document.forms["inventorycustomerform"]["f_customermobileno"].value;
            var length = txtMobile.length;
            if (length < 10 || length > 15) {
                alert( "Please Enter Valid Number:" );
                document.forms["inventorycustomerform"]["f_customermobileno"].value="";
                document
                .inventorycustomerform
                .f_customermobileno
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
				<div class="row">


					<div class="col-xs-2" style="display: none;">
						<label>Customer Id:</label> <input type="text"
							class="form-control" name="f_customerno"
							value="<?php echo $GLOBALS ['xCustomerid']; ?>" readonly>
					</div>
					<div class="col-xs-4">
						<label>Customer Name :</label> <input class="form-control"
							name="f_customername" type="text"
							value="<?php echo $GLOBALS ['xCustomerName']; ?>">
					</div>

					<div class="col-xs-8">
						<label>Address:</label> <input class="form-control"
							name="f_customeraddress" type="text"
							value="<?php echo $GLOBALS ['xCustomerAddress']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-4">
						<label>Mobile No:</label> <input class="form-control"
							maxlength="10" name="f_customermobileno" id="f_customermobileno"
							onkeypress="return restrictCharacters(this, event, integerOnly);"
							type="number" value="<?php echo $GLOBALS ['xCustomerMobileNo']; ?>">
					</div>
					<div class="col-xs-4">
					<label>Email:</label> <input class="form-control"
						name="f_customeremail" type="text"
						value="<?php echo $GLOBALS ['xCustomerEmail']; ?>">
				</div>
					<div class="col-xs-4">
					<label>Gst No:</label> <input class="form-control"
						name="f_gst_no" type="text"
						value="<?php echo $GLOBALS ['xGstNo']; ?>">
				</div>
				</div>

			</div>
			<div class="panel-footer clearfix">
				<div class="pull-right">
                        <?php if ($GLOBALS ['xMode'] == "") {  ?>
                        <input class="btn btn-primary" id="save"
						name="save" onclick="return validateForm()" type="submit"
						value="SAVE" accesskey="s">
                    <?php } else{ ?>
                        <input class="btn btn-primary" name="update"
						onclick="return validateForm()" type="submit" value="UPDATE" accesskey="u">
                        <?php }  ?>
                    </div>

			</div>
		</div>
	</form>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">View Customers</h3>
				</div>
				<table class="table table-striped  table-bordered "  border="1">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="30%">Customer Name</th>
							<th width="20%">Address</th>
							<th width="20%">Mobile No</th>
									<th width="20%">GST No</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from inv_customer  order by  customername";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . $xSlNo . '</td>';
	echo '<td>' . $row ['customername'] . '</td>';
	echo '<td>' . $row ['customeraddress'] . '</td>';
	echo '<td>' . $row ['customermobileno'] . '</td>';
	echo '<td>' . $row ['customergstno'] . '</td>';
	
	?>
<td><a
								href="customer.php<?php echo '?customerno='.$row['customerno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="customer.php<?php echo '?customerno='.$row['customerno']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

<?php
	echo '</tr>';
}

?>	

					
					
					
					
					
					
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>
	<script>
	$("input,select").bind("keydown", function(event) {
	    if (event.which === 13) {
	        event.stopPropagation();
	        event.preventDefault();
	       $(':input:eq(' + ($(':input').index(this) + 1) +')').focus();
	    }
	});
	</script>
	