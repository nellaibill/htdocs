

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'title.php'?>
<link href="css/msofficemenu.css" rel="stylesheet" type="text/css" />
</head>

<body onFocus="parent_disable();" onclick="parent_disable()">
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
// JavaScript popup window function

function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=1300,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
}
</script>


	<div id="nav">
		<ul>
			<li><a href='index.php'>Home</a></li>
			<li><span tabindex="1">Master</span>
				<ul>


					<li><a href="inv_hm001supplier.php">Supplier</a></li>
					<li><a href="inv_hm007_customer.php">Customer</a></li>
					<li><a href="setup_companyinfo.php">Company</a></li>
					<li><a href="inv_hm002itemcategory.php">Category</a></li>
					<li><a href="inv_hm003itemgroup.php">Group</a></li>
					<!-- 					<li><a href="inv_hm004itemsubgroup.php">SubGroup</a></li> -->
					<li><a href="inv_hm005item.php">Item</a></li>
					<li><a href="inv_hm007unit.php">Units</a></li>

					<li><a href="openingstockentry.php">Opening-Stock</a></li>
					<li><a href="account_ledger.php">Ledger Creation</a></li>
					<li><a href="inv_hm010userdetails.php">Login Details</a></li>
					<li><a href="m_salesperson.php">SalesPerson</a></li>
					<li><a href="fmcg_doctordetails.php">FMCG_Doctor</a></li>

				</ul></li>

			<!-- 
<li><a href='#'>Transaction <span class="glyphicon glyphicon-resize-small" style="color:yellow"></span></a>
	<ul>
<li><a href="servicebill.php">Service</a></li>
       </ul>
</li>

 -->



			<li><span tabindex="3">Purchase</span>
				<ul>
					<li><a href='inv_ht003purchaseentry.php'>Purchase Entry </a></li>

					<li><a href="inv_hr003_b_purchaseconsolidated.php">Purchase-Consolidated</a></li>
					<li><a href="inv_hr003_e_purchasebysupplier.php">Purchase-By
							Invoice</a></li>
					<li><a href="inv_hr003_e_purchasebysupplier_item.php">PurchaseByItem</a></li>
					<li><a href="acc_rep_supplier_payment.php">Payment Report</a></li>

					<!-- <li><a href='inv_ht003purchaseentry_full_edit.php'>Purchase-Bill ItemEdit </a></li> 

					<li><a href='inv_ht003purchaseentry_edit.php'>Purchase-Final Edit </a></li>


								<li><a href="purchase_return.php">Purchase-Return</a></li> -->

				</ul></li>
			<li><span tabindex="4">Sales</span>
				<ul>

					<li><a href="inv_ht004salesentry.php">Sales Entry</a></li>
					<li><a href='reprint.php'>Sales Reprint </a></li>
					<li><a href="inv_hr004_e_salesconsolidated.php">Sales Consolidated</a></li>
					<li><a href="inv_hr004_e_salesbycustomer.php">Sales By Customer</a></li>
					<li><a href="inv_hr004_e_salesbycustomer_item.php">Sales By
							Customer-Item</a></li>
					<li><a href="inv_hr004_e_salesconsolidatedbycash.php">Sales By Cash</a></li>
					<li><a href="inv_hr004_e_salesconsolidatedbycheque.php">Sales By
							Cheque</a></li>
					<li><a href="inv_hr004_e_salesconsolidatedbycredit.php">Sales By
							Credit</a></li>
					<li><a href="inv_hr004_a_todaysales_byitem.php">Today's Sales</a></li>
					<li><a href="inv_hr004_b_betweendates_sales.php">Sales Between Date</a></li>
							<li><a href="acc_rep_customer_payment.php">Pending Collection</a></li>
					
					<!-- <li><a href="sales_return.php">Sales-Return</a></li>
			 		 <li><a href="inv_hr004salesentry.php">Sales</a></li> 
					<li><a href='inv_ht004salesentry_edit.php'>Sales-Final Edit </a></li>
					 -->
				</ul></li>



			<li><span tabindex="6">Acc-Voucher</span>
				<ul>
					<li><a href="accounts_payment.php">Payment</a></li>
					<li><a href="accounts_reciept.php">Reciept</a></li>
					<li><a href="accounts_debit_note.php">Debit Note</a></li>
					<li><a href="accounts_credit_note.php">Credit Note</a></li>

				</ul></li>

			<li><span tabindex="5">Templates</span>
				<ul>
					<li><a href="print_format1.php?salesinvoiceno=1">Format1</a></li>
					<li><a href="print_format2.php?salesinvoiceno=1">Format2</a></li>
					<li><a href="print_format3.php?salesinvoiceno=1">Format3</a></li>
					<li><a href="print_format4.php?salesinvoiceno=1">Format4</a></li>
					<li><a href="print_format5.php?salesinvoiceno=1">Format5</a></li>
					<li><a href="print_format6.php?salesinvoiceno=1">Format6</a></li>
					<li><a href="print_format7.php?salesinvoiceno=1">Format7(Tax
							Included)</a></li>
					<li><a href="print_format8.php?salesinvoiceno=1">Format8</a></li>



				</ul></li>
			<li><span tabindex="6">Auditing</span>
				<ul>
					<li><a href="auditor_purchase_details.php">PURCHASE</a></li>
					<li><a href="auditor_sales_details.php">SALES</a></li>
				</ul></li>
			<li><span tabindex="7">Report</span>
				<ul>
					<li><a href="inv_hr002_e_stock.php">Stock</a></li>
					<li><a href="inv_hr002_e_batch_stock.php">Batch Wise Stock</a></li>
					<li><a href="inv_hr002_e_zero_stock.php">Zero Stock</a></li>
					<li><a href="inv_hr002_e_expiry.php">Expiry</a></li>
					<li><a href="acc_rep_payment.php">Payment</a></li>
					<li><a href="acc_rep_reciept.php">Reciept</a></li>
					<!-- <li><span tabindex="7">Statements of Inventory</span>
				<ul>
							<li><a href="">Stock Query</a></li>
							<li><a href="">Statistics</a></li>
				</ul></li> -->
				</ul></li>


			<li><span tabindex="8">Tools</span>
				<ul>

					<li><a href="config_inventory.php"
						onclick="basicPopup(this.href);return false">Settings </a></li>
					<li><a href="" onclick="PrintDiv(); return false">Print</a></li>
					<li><a href="" onclick="RefreshPage(); return false">Refresh </a></li>
					<li><a href="" id="btnExport"> Export To Excel</a></li>
					<li><a href="config_sales.php"
						onclick="basicPopup(this.href);return false">Sales Config </a></li>
				</ul>
			
			<li><a href="logout.php"> Logout</a></li>


		</ul>
	</div>
</body>
</html>
