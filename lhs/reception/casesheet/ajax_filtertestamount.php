<?php
include('config.php');
$xTestTypeId=$_REQUEST['testtypeid'];
$xQry="SELECT testamount,flimtype from m_testtype WHERE testtypeno= $xTestTypeId";
$stmt = mysql_query($xQry);
while($row = mysql_fetch_array($stmt)) 
 {
?>
<div class="form-group" >
<input type="text" class="form-control"  name="f_testamount" value="<?php echo $row['testamount']; ?>" readonly>
<input type="text" class="form-control"  name="f_flimtype" value="<?php echo $row['flimtype']; ?>" readonly>
</div>
<?php
 }
echo '</select>';
?>