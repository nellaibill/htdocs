
<?php
/* Error -warning cannot modify header information - headers already sent by (output started at in php */
ob_start ();
ob_flush ();
/* Error Ended */

include ('config.php');
include ('globallinks.html');
include ('globalfunctions.php');
include 'menu.php';
include 'hs001backup.php';

?>

<script type='text/javascript' src='js/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src="js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script type='text/javascript' src="js/bootstrap.min.js"></script>
<script type='text/javascript'>
            $(window).load(function () {
                $('#f_itemno').select2();
            });
            $(window).load(function () {
                $('#f_customerno').select2();
            });
        </script>