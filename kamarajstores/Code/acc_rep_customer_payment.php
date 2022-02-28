
<?php
include 'globalfile.php';
$xGrandTotalSalesHistory = 0;
$xGrandTotalPaymentHistory = 0;
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	<div class="panel panel-primary">
		<div class="panel-heading clearfix">
			<h4 class="panel-title pull-left" style="padding-top: 7.5px;">
				Payment Details</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">


				<div class="col-xs-4">
					<label>Ledger List:</label> <select class="form-control"
						name="f_account_ledger_id">
<?php
$result = mysql_query ( "SELECT *  FROM account_ledger where ledger_undergroup_no=5 order by ledger_name" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['account_ledger_id']; ?>">
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
}

?>
</select>
				</div>
				<input type="submit" name="view" class="btn btn-primary"
					value="VIEW">

			</div>
		</div>
	</div>

	
	<?php
	if (isset ( $_POST ['sendsms'] )) {
		$xNumber = $_POST ["f_mobile_no"];
		$xMessageArea = $_POST ["f_message"];
		$request = 'http://login.bulksmsindia.biz/messageapi.asp?username=mdsaleem1804&password=tcssnellai&sender=TCSSTC&mobile=' . $xNumber . '&message=' . urlencode ( $xMessageArea );
		$my_var = file_get_contents ( $request );
		echo $my_var;
	}
	if (isset ( $_POST ['view'] )) {
		$xQryFilter = $_POST ['f_account_ledger_id'];
		?>
	
<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Sales History</h1>
				</div>
				<div class="panel-body">
					<table class="table table-striped  table-bordered "
						data-responsive="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
<?php
		$xQry = '';
		$xSlNo = 0;
		$xQry = "SELECT  customerno,  totalamount,date  
from inv_salesentry1 where customerno=$xQryFilter";
		// echo $xQry;
		$result2 = mysql_query ( $xQry );
		while ( $row = mysql_fetch_array ( $result2 ) ) {
			$xSlNo += 1;
			findcustomername ( $row ['customerno'] );
			$xCustomerName=$GLOBALS ['xCustomerName'];
			$xCustomerName=$GLOBALS ['xCustomerName'];
			$xCustomerMobileNo=$GLOBALS ['xCustomerMobileNo'];
			echo '<td>' . date ( 'd/M/y', strtotime ( $row ['date'] ) ) . '</td>';
			echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
			$xGrandTotalSalesHistory += $row ['totalamount'];
			echo '</tr>';
		}
		echo '<tr>';
		echo '<td colspan=1>Grand Total</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotalSalesHistory ) . '</td>';
		echo '</tr>';
		?>	
</tbody>
					</table>

				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Payment History</h1>
				</div>
				<div class="panel-body">

					<table class="table table-striped  table-bordered "
						data-responsive="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Amount</th>
								<th>Remarks</th>

							</tr>
						</thead>

						<tbody>
							<tr>
<?php
		$xQry = '';
		$xSlNo = 0;
		
		$today = date ( "Y-m-d" );
		$xQry = "SELECT *  from accounts_payment   where accounts_payment_ledger_id= $xQryFilter order by  accounts_payment_date desc";
		// echo $xQry;
		$result2 = mysql_query ( $xQry );
		$rowCount = mysql_num_rows ( $result2 );
		while ( $row = mysql_fetch_array ( $result2 ) ) {
			$xSlNo += 1;
			echo '<td>' . date ( "d/M/Y", strtotime ( $row ['accounts_payment_date'] ) ) . '</td>';
			echo '<td align=right>' . $row ['accounts_payment_amount'] . '</td>';
			echo '<td>' . $row ['accounts_payment_remarks'] . '</td>';
			$xGrandTotalPaymentHistory += $row ['accounts_payment_amount'];
			echo '</tr>';
		}
		echo '<tr>';
		echo '<td colspan=1>Grand Total</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotalPaymentHistory ) . '</td>';
		echo '</tr>';
		?>	
</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Pending</h1>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-sm-12">
							<h1>Rs:
			<?php echo  fn_RupeeFormat ($xGrandTotalSalesHistory - $xGrandTotalPaymentHistory); ?>
			</h1>


						</div>

						<div class="col-sm-12">
							<label>Mobile No</label> <input type="text" name="f_mobile_no"
							class="form-control"readonly value=<?php echo $xCustomerMobileNo?>>
						</div>
						<label>Message Content</label>
						<div class="col-sm-12">
							<textarea rows="3" cols="30" name="f_message"
								class="form-control">Dear <?php echo $xCustomerName?> the pending amount Rs.<?php echo fn_RupeeFormat ($xGrandTotalSalesHistory - $xGrandTotalPaymentHistory);?></textarea>
						</div>
					</div>


					<!--<button class="btn btn-lg btn-success col-xs-12">
     <span class="glyphicon glyphicon-envelope pull-left"></span> Send Sms
    
</button>-->
				</div>
						<div class="panel-footer clearfix">
				<div class="pull-right">
				<input type="submit" name="sendsms" class="btn btn-primary"
								value="SEND SMS"  disabled>
				</div></div>
			</div>
		</div>
	</div>
</form>
<?php 
	}
	?>
	
