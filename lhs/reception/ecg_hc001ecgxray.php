<?php 
include 'globalfile.php';
if (isset ( $_POST ['save'] )) 
{
  $xTxNo= $_POST ['f_txno'];
  $xDate= $_POST ['f_date'];
  $xSection= $_POST ['f_section'];
  $xAge= $_POST ['f_age'];
  $xDoctorNo= $_POST ['f_doctorno'];
  $xFilmType= $_POST ['f_filmtype'];

  $xQry = "
update config_ecgxray set v_txno=$xTxNo,v_date=$xDate,v_section=$xSection,v_age=$xAge,v_doctorno=$xDoctorNo,
v_filmtype=$xFilmType";
mysql_query ( $xQry );
header('Location: ecg_hr001billing.php'); 
}
?>
<html>
<body>
<title>SETTINGS</title>

<form action="ecg_hc001ecgxray.php" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">ECG&XRAY -CONFIGURATION</h3>
</div>
<div class="panel-body">

<div class="form-group">

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">TXNO</label>
<select class="form-control" name="f_txno">
	<option value="0" <?php if($GLOBALS ['xViewTxNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewTxNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">DATE</label>
<select class="form-control" name="f_date">
	<option value="0" <?php if($GLOBALS ['xViewDate']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewDate']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">SECTION</label>
<select class="form-control" name="f_section">
	<option value="0" <?php if($GLOBALS ['xViewSection']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewSection']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>
<div class="col-xs-2">
<label for="" class="control-label col-xs-3">AGE</label>
<select class="form-control" name="f_age">
	<option value="0" <?php if($GLOBALS ['xViewAge']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewAge']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>



<div class="col-xs-2">
<label for="" class="control-label col-xs-3">DOCTORNO</label>
<select class="form-control" name="f_doctorno">
	<option value="0" <?php if($GLOBALS ['xViewEcgxRayDoctorNo']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewEcgxRayDoctorNo']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

<div class="col-xs-2">
<label for="" class="control-label col-xs-3">FILMTYPE</label>
<select class="form-control" name="f_filmtype">
	<option value="0" <?php if($GLOBALS ['xViewFilmType']=="0") echo 'selected="selected"'; ?>>YES</option>
	<option value="1" <?php if( $GLOBALS ['xViewFilmType']=="1") echo 'selected="selected"'; ?>>NO</option>
</select>
</div>

</div></div>

<div class="panel-footer clearfix">
        <div class="pull-right">
            <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
        </div>
</div>
</div></form>

</body>
</html>