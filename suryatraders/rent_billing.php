<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['bill_house_rent_id'] ) && ! empty ( $_GET ['bill_house_rent_id'] )) {
	$xId= $_GET ['bill_house_rent_id'] ;
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ($xId );
	}
	else {
		/*$xQry = "DELETE FROM bill_house_rent 
		WHERE bill_house_rent_id= $xId";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: rent_billing.php' );
	*/} 
}
  
elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
function fn_DataClear() {
			$GLOBALS ['xId']   = ''; 
			$GLOBALS ['xCustomerId']   = ''; 
			$GLOBALS ['xInvoiceNo1']   = ''; 
			$GLOBALS ['xInvDate']      = date ( 'Y-m-d' ); 
			$GLOBALS ['xParticulars']  = ''; 
			$GLOBALS ['xAmount']   = '';
	
}

function DataFetch($xRentId) {
	$result = mysql_query ( "SELECT *  FROM 
	bill_house_rent where bill_house_rent_id=$xRentId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xId']= $row ['bill_house_rent_id'];
			$GLOBALS ['xCustomerId'] = $row ['customer_id'];
			$GLOBALS ['xInvoiceNo1'] = $row ['invoice_no_1'];
			$GLOBALS ['xInvDate'] = $row ['inv_date'];
			$GLOBALS ['xParticulars'] = $row ['particulars'];
			$GLOBALS ['xAmount'] = $row ['amount'];
		}
	}
}

function DataProcess($mode) {
	$xId = $_POST ['f_id'];
	$xCustomerNo = $_POST ['f_customerno'];
    $xInvoiceNo1 = $_POST ['f_invoiceno1'];
	$xDate = $_POST ['f_date'];
	$xHsnCode = $_POST ['f_hsncode'];
	$xGst = $_POST ['f_gst'];
	$CategoryNo = $_POST ['f_itemcategoryno'];
	$xParticulars = $_POST ['f_particulars'];
	$xAmount = $_POST ['f_amount'];
	$xQry = "";
	$xMsg = "";
	if($xCustomerNo=='0')
	{
		echo '<script>alert(customer should not be empty")</script>'; 
		//echo '<script Type="javascript">alert("JavaScript Alert Box by PHP")</script>';
		return;
	}
	if ($mode == 'S') {

        $xQry="INSERT INTO bill_house_rent
	(customer_id,invoice_no_1,inv_date,hsn_code,gst,
	category_id,particulars,amount) 
	VALUES ($xCustomerNo,$xInvoiceNo1,'$xDate',$xHsnCode,$xGst,
	$CategoryNo,'$xParticulars',$xAmount)";

		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE bill_house_rent   
		SET customer_id='$xCustomerNo',
		invoice_no_1='$xInvoiceNo1',
		inv_date='$xDate',
		hsn_code='$xHsnCode',
		gst='$xGst',
		particulars='$xParticulars',
		amount='$xAmount' 
		WHERE bill_house_rent_id=$xId";
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	//ShowAlert ( $xMsg );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>RENT</title>
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
				<h3 class="panel-title">RENT BILLING</h3>
			</div>

			<div class="panel-body">
			<div class="col-xs-2" style="display: none;">
					<label>Id:</label> <input type="text" class="form-control"
						name="f_id"
						value="<?php echo $GLOBALS ['xId']; ?>" readonly>
			</div>
            <div class="col-xs-4">
							<label>Choose Customer</label> <select class="form-control"
								name="f_customerno">
		<?php
		$result = mysql_query ( "SELECT *  FROM inv_customer" );
		echo "<option value='0'>Select Your Option</option>";
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>

  <option value="<?php echo $row['customerid']; ?>"
				>
		<?php echo $row['customername']; ?> 
		</option>

		 <?php
		}
		?>
		 </select>
	</div>
                        <div class="col-xs-2">
							<label>Invoice No1</label> <input type="text"
								class="form-control" name="f_invoiceno1"
								value="<?php echo $GLOBALS ['xInvoiceNo1']; ?>">
						</div>
                        <div class="col-xs-2">
							<label>Date</label> <input type="date" class="form-control"
								name="f_date"
								value="<?php echo $GLOBALS ['xInvDate']; ?>">
						</div>

                        <div class="col-xs-2">
						<label>Hsn Code:</label> <select class="form-control" 
						name="f_hsncode">
						<option  value="997212">997212</option>
                            </select>
					</div>

                    <div class="col-xs-2">
							<label>Gst</label>
							<select class="form-control" name="f_gst">
                          
                            <option  value="18">18</option>
                            </select>
						</div>
						<div class="col-xs-3" style="display: none;">
						<label>Category:</label> <select class="form-control"
							name="f_itemcategoryno">
<?php
$result = mysql_query ( "SELECT *  FROM m_itemcategory  order by itemcategoryname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemcategoryno']; ?>"
								<?php
	if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemcategoryname']; ?> 
</option>
<?php
}
?>
</select>
					</div>
                    <div class="col-xs-6">
							<label>Particulars</label> <input type="text"
								class="form-control" name="f_particulars"
								value="<?php echo $GLOBALS ['xParticulars']; ?>">
						</div>
                        <div class="col-xs-2">
							<label>Amount</label> <input type="number"
								class="form-control" name="f_amount"
								value="<?php echo $GLOBALS ['xAmount']; ?>">
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


	<div id="divToPrint">

			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading clearfix">
					<h3 class="panel-title pull-left" style="padding-top: 7.5px;">
						VIEW RENT BILLS</h3>
			
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>Customer </th>
							<th>InvoiceNo</th>
							<th>Date</th>
							<th>HsnCode</th>
							<th>Particulars</th>
							<th>Amount</th>
							<th>CGST</th>
							<th>SGST</th>
							<th>Total Amount</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
       
             <?php
			$xSlNo = 0;
			$xQry = '';
			$xQry = "SELECT *  from bill_house_rent";
			$result2 = mysql_query ( $xQry );
			$rowCount = mysql_num_rows ( $result2 );
			while ( $row = mysql_fetch_array ( $result2 ) ) {
				?><tr>
				<?php
				$xAmount =$row ['amount'];
				$xGst = $row ['gst'];
				$xGstValue=$xAmount * $xGst/100; 
				$xCGST=$xGstValue/2; 
				$xSGST=$xGstValue/2; 
				$xTotalAmount=$xAmount+$xCGST+$xSGST;
			    findcustomerdata($row ['customer_id']);
				echo '<td>' . $GLOBALS ['xCustomerName']. '</td>';          
				echo '<td>' . $row ['invoice_no_1'] . '</td>';
				echo '<td>' . $row ['inv_date'] . '</td>';										
				echo '<td>' . $row ['hsn_code'] . '</td>';		
				echo '<td>' . $row ['particulars'] . '</td>';
				echo '<td>' . $xAmount . '</td>';
				echo '<td>' . $xCGST . '</td>';
				echo '<td>' . $xSGST . '</td>';
				echo '<td>' . $xTotalAmount . '</td>';
			?>
          <td><a
			href="rent_billing.php<?php 
			echo '?bill_house_rent_id='.$row['bill_house_rent_id'] . '&xmode=edit'; ?>"
			onclick="return confirm_edit()"> <img alt="HTML tutorial"
				src="images/edit.png"
				style="width: 30px; height: 30px; border: 0">
		</a>
	
		<td><a href="print_format_houserent.php<?php echo '?bill_house_rent_id='.$row['bill_house_rent_id'];  ?>"> <img src="images/print.png" style="width: 30px; height: 30px; border: 0"> </a></td>
	
		<?php
			echo '</tr>';
			}
			
			?>
         </tbody>
				</table>
			</div>

	</div>

</table>

</body>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

