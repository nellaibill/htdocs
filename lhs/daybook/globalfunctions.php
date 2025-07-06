<?php

include('session.php');
$GLOBALS ['xDate']=date('Y-m-d');
$GLOBALS ['xCurrentDate']=date('Y-m-d h:i:s');
getfromandtodate();

function getfromandtodate() {
  $result = mysql_query("SELECT *  FROM config") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xFromDate'] = $row['fromdate'];
    $GLOBALS['xToDate'] = $row['todate'];
  }
}
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}
?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script type="text/javascript">     
function RefreshPage() {
    location.reload();
}
function confirm_edit() {
  return confirm('Would you Like to Edit ?');
}
function confirm_confirm() {
  return confirm('Would you Like to Confirm?');
}
function confirm_delete() {
  return confirm('Would you Like to Delete ?');
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
</script>
</head>
</html>