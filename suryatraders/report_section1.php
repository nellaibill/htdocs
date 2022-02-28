<?php
include 'globalfile.php';
DataClear();
if (isset ( $_GET ['salesbillno'] ) && ! empty ( $_GET ['salesbillno'] )) {
	$no = $_GET ['salesbillno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['salesbillno'] );
	}
	else if ($_GET ['xmode'] == 'delete'){
		$xQry = "DELETE FROM bill_suryatraders_section1 WHERE salesbillno= $no";
		mysql_query($xQry);
		header('Location: report_section1.php');
	}

}  elseif (isset ( $_POST ['update'] )) {
	$salesbillno=$_POST ['salesbillno'];
	$customerno=$_POST ['customerno'];
	$invoiceno1=$_POST ['invoiceno1'];
	$date=$_POST ['date'];
	$transporter=$_POST ['transporter'];
	$despto=$_POST ['despto'];
	$deliveryat=$_POST ['deliveryat'];
	$eway_bill_no=$_POST ['eway_bill_no'];
	$xQry = "update bill_suryatraders_section1   
			set invoiceno1= $invoiceno1
			,customerno=$customerno
			, date='$date'
			, transporter='$transporter'
			, despto='$despto'
			, deliveryat='$deliveryat'
			, eway_bill_no='$eway_bill_no'
			where salesbillno=$salesbillno";	
			//echo $xQry;
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
}
function DataClear()
{
	$GLOBALS ['salesbillno'] ='';
	$GLOBALS ['customerno'] = '';
	$GLOBALS ['invoiceno1'] = '';
	$GLOBALS ['date'] = '';
	$GLOBALS ['transporter'] = '';
	$GLOBALS ['despto'] = '';
	$GLOBALS ['deliveryat'] = '';
	$GLOBALS ['eway_bill_no'] = '';
}

function DataFetch($xSalesBillNo) {
	$result = mysql_query ( "SELECT *  FROM bill_suryatraders_section1 where salesbillno=$xSalesBillNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {	
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['salesbillno'] = $row ['salesbillno'];
			$GLOBALS ['customerno'] = $row ['customerno'];
			$GLOBALS ['invoiceno1'] = $row ['invoiceno1'];
			$GLOBALS ['date'] = $row ['date'];
			$GLOBALS ['transporter'] = $row ['transporter'];
			$GLOBALS ['despto'] = $row ['despto'];
			$GLOBALS ['deliveryat'] = $row ['deliveryat'];
			$GLOBALS ['eway_bill_no'] = $row ['eway_bill_no'];
		}
	}
}
?>
<body onload='document.sizeform.f_sizename.focus()'>
	<form class="form" name="sizeform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">REPORT -SECTION1</h3>
			</div>
		</div>
		<!-- Panel Body !-->
		<div class="panel-body">
			<div class="form-group">
				<div class="panel panel-primary">
				<div class="panel-body">

				<div class="col-xs-2" style="display:none">
							<label>Sales Bill  No</label> <input type="text" 
								class="form-control" name="salesbillno"
								value="<?php echo $GLOBALS ['salesbillno']; ?>">
						</div>

				<div class="col-xs-4">
							<label>Choose Customer</label> <select class="form-control"
								name="customerno">
		<?php
		$result = mysql_query ( "SELECT *  FROM inv_customer" );
		echo "<option value=''>Select Your Option</option>";
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>
		<option value="<?php echo $row['customerid']; ?>"
							<?php
	if ($row ['customerid'] == $GLOBALS ['customerno']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['customername']?> 
</option>
		 <?php
		}
		?>
		 </select>
						</div>
						<div class="col-xs-2">
							<label>Invoice No1</label> <input type="text"
								class="form-control" name="invoiceno1"
								value="<?php echo $GLOBALS ['invoiceno1']; ?>">
						</div>
						<div class="col-xs-2">
							<label>Date</label> <input type="date" class="form-control"
								name="date"
								value="<?php echo $GLOBALS ['date']; ?>">
						</div>

						<div class="col-xs-2">
							<label>Transporter</label> <input type="text"
								class="form-control" name="transporter" 
								value="<?php echo $GLOBALS ['transporter']; ?>">
						</div>

						<div class="col-xs-2">
							<label>Desp To</label> <input type="text" class="form-control"
								name="despto"
								value="<?php echo $GLOBALS ['despto']; ?>">
						</div>

						<div class="col-xs-2">
							<label>Delivery At</label> <input type="text" 
							class="form-control" name="deliveryat"
							value="<?php echo $GLOBALS ['deliveryat']; ?>">
						</div>
					<div class="col-xs-2">
							<label>Eway Bill No</label> <input type="text" 
							class="form-control" name="eway_bill_no"
							value="<?php echo $GLOBALS ['eway_bill_no']; ?>">
						</div>
					</div>
					<div class="panel-footer clearfix">
						<div class="pull-right">

							<input type="submit" name="update" class="btn btn-primary"
								value="UPDATE" onclick="return validateForm()">

						</div>
					</div>
				</div>
					
			

		</div>
		<!-- Panel -Room Type Number Information Ended !-->


	</form>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
		<div class="panel panel-info">

			<!-- Default panel contents -->
			<div class="panel-heading  text-center">
				<h3 class="panel-title">VIEW SECTION1</h3>
			</div>
			<div class="input-group">
				<span class="input-group-addon">Filter</span> <input id="filter"
					type="text" class="form-control">
			</div>
			<table class="table">
				<thead>
					<tr>
					<th width="10%">Sales Bill No</th>
						<th width="10%">Invoice No1</th>
						<th width="10%">Date</th>
						<th width="20%">Customer Name</th>
						<th width="10%">Transporter</th>
						<th width="10%">DespTo</th>
						<th width="10%">Delivery At</th>
						<th width="10%">EwayBillNo</th>
						<th width="5%" >EDIT</th>
							<th width="5%" >DELETE</th>
                        <th width="2%">P1</th>
                        <th width="2%">P2</th>
<th width="2%">P3</th>
				
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>

<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from bill_suryatraders_section1  where date>='2019-04-01' order by salesbillno desc ";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	findcustomerdata($row ['customerno']);
	echo '<td>' . $row ['salesbillno']. '</td>';
	echo '<td>' . $row ['invoiceno1']. '</td>';
	echo '<td>' . $row ['date']. '</td>';
	echo '<td>' . $GLOBALS ['xCustomerName']. '</td>';
	echo '<td>' . $row ['transporter']. '</td>';
	echo '<td>' . $row ['despto']. '</td>';
	echo '<td>' . $row ['deliveryat']. '</td>';
	echo '<td>' . $row ['eway_bill_no']. '</td>';
	?>
					<td><a
							href="report_section1.php<?php echo '?salesbillno='.$row['salesbillno']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						<td><a
							href="report_section1.php<?php echo '?salesbillno='.$row['salesbillno']. '&xmode=delete';  ?>"
							onclick="return confirm_edit()"> <img src="images/delete.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
       <td><a href="print_format_1.php<?php echo '?salesbillno='.$row['salesbillno'];  ?>"> <img src="images/print.png" style="width: 30px; height: 30px; border: 0"> </a></td>
       <td><a href="print_format_2.php<?php echo '?salesbillno='.$row['salesbillno'];  ?>"> <img src="images/print.png" style="width: 30px; height: 30px; border: 0"> </a></td>
  <td><a href="print_format_3_new.php<?php echo '?salesbillno='.$row['salesbillno'];  ?>"> <img src="images/print.png" style="width: 30px; height: 30px; border: 0"> </a></td>
    <td><a href="print_format_houserent.php<?php echo '?salesbillno='.$row['salesbillno'];  ?>"> <img src="images/print.png" style="width: 30px; height: 30px; border: 0"> </a></td>
						
<?php
	echo '</tr>';
}

?>		</tbody>
			</table>
		</div>
	</div>
</body>
