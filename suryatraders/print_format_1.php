<?php
include 'config.php';
include 'functions.php';

$xCopyName=$GLOBALS ['xPrintBillType'];
if (isset ( $_GET ['salesbillno'] ) && ! empty ( $_GET ['salesbillno'] )) {
    	$no = $_GET ['salesbillno'];
      $xQry= "update config_print 
	set 
	salesbillno=$no
	where id=1";
	mysql_query ($xQry) or die ( mysql_error () );
}
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

include 'table.php';

?>	
</div>
		<!-- /container -->
	</div>
</body>
</html>
