<?php 
include 'globalfunctions.php';
if (isset ( $_POST ['save'] )) {
$fromdate= $_POST ['fromdate'];
$todate= $_POST ['todate'];
$xQry = "update config set fromdate='$fromdate',todate='$todate'";
mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
	}
?>
<html>
<body>
<title>CHOOSE DATE</title>
<form action="hc001fromtodate.php" method="post">
</br>
</br>
</br>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left" style="padding-top: 7.5px;">SET DATE</h4>
      <div class="btn-group pull-right">
        <a href="#" class="btn btn-default btn-sm" onclick="window.close()";>Close</a>
      </div>
    </div>
   <div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2">FROM DATE</label>
<div class="col-xs-4">
<input type="date" class="form-control"  name="fromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
</div>
</div></br></br>   
  
<div class="form-group">
<label  class="control-label col-xs-2">TO DATE</label>
<div class="col-xs-4">
<input type="date" class="form-control"  name="todate" value="<?php echo $GLOBALS ['xToDate']; ?>">
</div>
</div></br></br>  
</div>
</div>
<div class="panel-footer clearfix">
        <div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
</div>
</div>
</body>
</html>