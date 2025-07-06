<?php include 'globalfile.php';?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="header.css" />
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">

// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=900,width=1200,left=40,top=4,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
	}

	function minipopup(url) {
		popupWindow = window.open(url,'popUpWindow','height=400,width=1200,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
			}
	function mediumpopup(url) {
		popupWindow = window.open(url,'popUpWindow','height=600,width=1200,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
			}
function parent_disable() {
if(popupWindow && !popupWindow.closed)
popupWindow.focus();
}
function PrintDiv() 
      {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=800,height=600');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
      }


</script>
<style>
table.ex1 {
    border-collapse: separate;
    border-spacing: 10px;
}

table.ex2 {
    border-collapse: separate;
    border-spacing: 10px 50px;
}
</style>
</head>
<body onFocus="parent_disable();" onclick="parent_disable();">
	<div id="bdcontainer">
	<table width="41%" border="0" cellspacing="0" cellpadding="0" id="header">
							<tr>
								<td scope="col"><img src="images/baranilogo.png"></img></td>

							</tr>

						</table>
					
						<br/><br/><br/><br/><br/><br/>
		<table border="0" class="ex1" align="center">

		

				<tr>


				<td><a href="customer.php"
					onclick="mediumpopup(this.href);return false"><input type="button"
						id="customers" accesskey="1" /></a></td>
				<td><a href="inv_hm005item.php" onclick="mediumpopup(this.href);return false"><input
						type="button" id="products" accesskey="2" /></a></td>

				<td><a href="inv_ht004salesentry.php"
					onclick="basicPopup(this.href);return false"><input type="button"
						id="invoice" accesskey="3" /></a></td>



			</tr>
		<tr>




		<td><a href="inv_hr004salesentry.php" 
		onclick="basicPopup(this.href);return false"><input type="button"
						id="salesreport" accesskey="4" /></a></td>
	<td><a href="logout.php"><input type="button"
						id="logout"  accesskey="5"/></a></td>

			</tr>
		</table>

	</div>


	<div id="footer">

		<!--  <table border="0" cellpadding="15px" align="center"
			style="size: 24px; font-family: 'Courier New', Courier, monospace; color: #FFF; font-size: 12px;">
			<tr>
					<td>Developed and Maintained By:TCSS-St.Mark Street PalayamKottai[Opp to S.P-Office] SALEEM-9578795653
				</td>
			</tr>
		</table>
		!-->
	</div>

</body>

</html>
