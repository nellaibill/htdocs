<?php
include('config.php');
$xTestId=$_REQUEST['testid'];
$xQry="SELECT testtypeno,testtypename from m_testtype WHERE testno= $xTestId";
$stmt = mysql_query($xQry);
?>
<div class="col-xs-2">
<select class="form-control" name="f_testtypeno">
<?php
while($row = mysql_fetch_array($stmt)) {
echo $row['testtypeno'];
?>
<option value = "<?php echo $row['testtypeno']; ?>"><?php echo $row['testtypename']; ?> </option>
<?
}
echo '</select>';
echo '</div>';
?>