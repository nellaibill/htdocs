<?php
include 'functions.php';
include 'config.php';
$xCopyName="SALES RETURN";

?>
<html>
<head>
<link href="css/servicebill.css" rel="stylesheet">
<script type="text/javascript"> 
//window.onload=PrintDiv;     
function PrintDiv() 
 {    
       window.close();
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=600,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
       popupWin.close();
}
</script>
<style>
.noborder {
	border: none;
}
</style>
</head>
<body>
	
	<div id="divToPrint">
		<div class="container">

<?php

include 'sales_return_table.php';

?>	
</div>
		<!-- /container -->
	</div>
</body>
</html>
