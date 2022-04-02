<?php
//include_once 'header.php';
include_once 'menu.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'title.php'?>
<link rel="stylesheet" type="text/css" href="css/index.css" />

<script type="text/javascript">
// JavaScript popup window function

function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=1300,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
}


</script>
<style >
   #test{
       pointer-events: none;
   cursor: default;
    }
</style>
</head>
<body>
	<div id="bdcontainer">

		<table border="0" cellpadding="0" cellspacing="10" align="center">
		
			<tr>
			
			
				<td><a href="inv_hm007_customer.php"><input type="button" id="customer" /></a></td>
									<td><a href="inv_hm001supplier.php"><input type="button"
						id="supplier" /></a></td>
				<td><a href="inv_hm002itemcategory.php"><input type="button"
						id="category" /></a></td>
					<td><a href="inv_hm003itemgroup.php"><input type="button"
						id="group" /></a></td>
	
								    
			</tr>
			<tr>
			
			
				<td><a href="inv_hm005item.php"><input type="button" id="product" /></a></td>
					<td><a href="inv_ht003purchaseentry.php"
					onclick="basicPopup(this.href);return false"><input type="button"
						id="purchase" accesskey="p" /></a></td>
								<td><a href="inv_ht004salesentry.php">
								<input type="button" accesskey="s" id="sales" /></a></td>
				<td><a href="inv_hr002_e_stock.php"><input type="button"
						id="stocks" /></a></td>


			</tr>


			<tr>
			<td><a href="inv_hr003_b_purchaseconsolidated.php"><input type="button"
						id="purchasereport" /></a></td>
<td><a href="inv_hr004salesentry.php"><input type="button"
						id="salesreport" /></a></td>
				
				<td><a href="config_inventory.php"
					onclick="basicPopup(this.href);return false"><input type="button"
						id="setup" /></a></td>
						<td><a href="logout.php"><input type="button"
						id="logout" /></a></td>
			</tr>


		</table>

	</div>

	<div id="footer">
		<table>
			<tr>
				<td style="size: 12px; font-family: 'Courier New', Courier, monospace; color: red;">Developed and Maintained By [Nellai Bill] -86 37 41 77 53
				</td>
			</tr>
		</table>
	</div>


</body>

</html>
