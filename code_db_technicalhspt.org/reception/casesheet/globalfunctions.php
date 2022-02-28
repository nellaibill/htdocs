<html>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/menustyle.css">
<link href="css/reportstyle.css" rel="stylesheet">


<link
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
	rel="stylesheet">
<!--
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
!-->

<!-- Next Control Focus !-->

<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"
	type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js"
	type="text/javascript"></script>

<!-- Next Control Focus Ended !-->


<!-- Sweet Alert !-->

<script src="js/sweetalert-dev.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/sweetalert.css">

<!-- Sweet Alert Ended!-->

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- <script src="js/snowfall.js"></script>  !-->

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
<script type="text/javascript">

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

<script type="text/javascript">
/* code from qodo.co.uk */
// create as many regular expressions here as you need:
var digitsOnly = /[1234567890]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;

function restrictCharacters(myfield, e, restrictionType) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
			return false;
		}
		
	}
}
</script>



<!-- Style is used for alert Messages !-->
<style type="text/css">
.alert {
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
date_default_timezone_set ( 'Asia/Calcutta' );
include 'config.php';
$GLOBALS ['xMode'] = '';
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$GLOBALS ['xCurrentDateTime'] = date ( 'Y-m-d H:i:s' );
$GLOBALS ['xCurrentUser'] = $_SESSION ['login_user'];
$GLOBALS ['xDoctorNo'] = '';

$GLOBALS ['xDepartmentColor'] = "#ffffff"; // Default Color- White
getconfigvalues ();

/* -------------------- Empty Record Message------------------------------ */
function fn_NoDataFound() {
	echo '<tr bgcolor=red>';
	echo '<td colspan=3> NO RESULTS WERE FOUND</td>';
	echo '</tr>';
}

/* -------------------- General Messages ------------------------------ */
function ShowAlert($msg) {
	echo '<div class=alert>';
	echo '<font color=white>';
	echo '<b>';
	echo "Records " . $msg . " Succesfully";
	echo '</b>';
	echo '</font>';
	echo '</div>';
}

/* --------------------- Money Format ------------------------------ */
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}

/* -------------------- Config Table Records ------------------------------ */
function ExecuteFilter() {
	$result = mysql_query ( "SELECT *  FROM config" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xFromDate'] = $row ['fromdate'];
		$GLOBALS ['xToDate'] = $row ['todate'];
		$GLOBALS ['xAcNo'] = $row ['acno'];
		$GLOBALS ['xAcType'] = $row ['actype'];
	}
}
function getconfigvalues() {
	$result = mysql_query ( "SELECT *  FROM config" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xDoctorNo'] = $row ['doctorno'];
		finddoctorname ( $row ['doctorno'] );
		$GLOBALS ['xFromDate'] = $row ['fromdate'];
		$GLOBALS ['xToDate'] = $row ['todate'];
		$GLOBALS ['xEcgXrayType'] = $row ['ecgxraytype'];
		$GLOBALS ['xEcgFlimType'] = $row ['ecgflimtype'];
		$GLOBALS ['xEcgSection'] = $row ['ecgsection'];
		$GLOBALS ['xTestTypeNo'] = $row ['testtypeno'];
		$GLOBALS ['xViewTxNo'] = $row ['v_txno'];
		$GLOBALS ['xViewDate'] = $row ['v_date'];
		$GLOBALS ['xViewSection'] = $row ['v_section'];
		$GLOBALS ['xViewAge'] = $row ['v_age'];
		$GLOBALS ['xViewEcgxRayDoctorNo'] = $row ['v_doctorno'];
		$GLOBALS ['xViewFilmType'] = $row ['v_filmtype'];
		$GLOBALS ['xViewCreatedAsOn'] = $row ['v_createdason'];
		$GLOBALS ['xViewUpdatedAsOn'] = $row ['v_updatedason'];
	}
}


/* -------------------- Get Patient Details ------------------------------ */
function fn_PatientDetails($xPatientId) {
	$result = mysql_query ( "SELECT *  FROM m_patientregistration where patientid=$xPatientId" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTitle'] = $row ['title'];
		$GLOBALS ['xFirstName'] = $row ['firstname'];
		$GLOBALS ['xLastName'] = $row ['lastname'];
		$GLOBALS ['xInitials'] = $row ['initials'];
	}
}
/* -------------------- Get Case Type Details ------------------------------ */
function fn_CaseType($xCaseTypeNo) {
	$result = mysql_query ( "SELECT *  FROM m_casetype where casetypeno=$xCaseTypeNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCaseTypeName'] = $row ['casetypename'];
		
	}
}

/* -------------------- Get Room Type ------------------------------ */
function fn_RoomType($xRoomTypeNo) {
	$result = mysql_query ( "SELECT *  FROM m_roomtype where roomtypeno=$xRoomTypeNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xRoomTypeName'] = $row ['roomtypename'];
		$GLOBALS ['xRoomTypeAmount'] = $row ['roomtypeamount'];
	}
}

/* -------------------- Get Room Name ------------------------------ */
function fn_Room($xRoomNo) {
	$result = mysql_query ( "SELECT *  FROM m_room where roomno=$xRoomNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xRoomName'] = $row ['roomname'];
	}
}


?>