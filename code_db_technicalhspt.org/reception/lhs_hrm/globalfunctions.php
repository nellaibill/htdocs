<?php
include 'config.php';
$GLOBALS ['xMode'] = '';
$GLOBALS ['xCurrentDateTime'] = date ( 'Y-m-d H:i:s' );
$GLOBALS ['xFromDate'] = date ( 'Y-m-d' );
$GLOBALS ['xToDate'] = date ( 'Y-m-d' );
?>
<html>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Filter Text Box !-->

<script type="text/javascript">
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>

<!-- Filter Text Box Ended !-->
<script>

// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=900,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
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
<!--
Style is Important !--> <style>.alert {
	-webkit-animation: seconds 1.0s forwards;
	-webkit-animation-iteration-count: 1;
	-webkit-animation-delay: 5s;
	animation: seconds 1.0s forwards;
	animation-iteration-count: 1;
	animation-delay: 5s;
	position: absolute;
	bottom: 0px;
	right: 25px;
	background: blue;
}

@
-webkit-keyframes seconds { 0% {
	opacity: 1;
}

100%
{
opacity


:

 

0;
left


:

 

-9999
px


;
}
}
@
keyframes seconds { 0% {
	opacity: 1;
}
100%
{
opacity


:

 

0;
left


:

 

-9999
px


;
}
}
</style>

<!-- Alert Style to be ended !-->
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


</script>
</html>
<?php
// INCLUDES

findsettings ( 1 );
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}

function findsettings($xNo) {
	$result = mysql_query ( "SELECT *  FROM settings_salary" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xEmployer_Pf_Percentage'] = $row ['employer_pf_percentage'];
		$GLOBALS ['xEmployer_Esi_Percentage'] = $row ['employer_esi_percentage'];
		$GLOBALS ['xEmployee_Pf_Percentage'] = $row ['employee_pf_percentage'];
		$GLOBALS ['xEmployee_Esi_Percentage'] = $row ['employee_esi_percentage'];
		
		$GLOBALS ['xHikePercentage'] = $row ['hikepercentage'];
	}
}

?>
