<?php
require_once 'config.php';
require_once 'session.php';
$GLOBALS ['xMode']='';
function findcustomername($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_customer where customerno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerName'] = $row ['customername'];
		$GLOBALS ['xCustomerAddress'] = $row ['customeraddress'];
		$GLOBALS ['xCustomerMobileNo'] = $row ['customermobileno'];
		$GLOBALS ['xCustomerEmail'] = $row ['customeremail'];
		$GLOBALS ['xCustomerGstNo'] = $row ['customergstno'];
		
	}
}
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}
?>
<head>
<link rel="stylesheet" type="text/css" href="header.css" />
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

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