<?php
include 'globalfile.php';

    $result = mysql_query("SELECT *  FROM config_quotation where id=1") or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
$GLOBALS ['xLine1']=$row ['line1'];
$GLOBALS ['xLine2']=$row ['line2'];
$GLOBALS ['xLine3']=$row ['line3'];
$GLOBALS ['xLine4']=$row ['line4'];
$GLOBALS ['xLine5']=$row ['line5'];
$GLOBALS ['xLine6']=$row ['line6'];
$GLOBALS ['xLine7']=$row ['line7'];
$GLOBALS ['xLine8']=$row ['line8'];
$GLOBALS ['xLine9']=$row ['line9'];
$GLOBALS ['xLine10']=$row ['line10'];
        }


if (isset($_POST ['save'])) {
    $line1 = $_POST ['line1'];
    $line2 = $_POST ['line2'];
	$line3 = $_POST ['line3'];
	$line4 = $_POST ['line4'];
	$line5 = $_POST ['line5'];
	$line6 = $_POST ['line6'];
	$line7 = $_POST ['line7'];
	$line8 = $_POST ['line8'];
	$line9 = $_POST ['line9'];
	$line10 = $_POST ['line10'];
    $xQry = "update config_quotation set line1='$line1',line2='$line2',line3='$line3',line4='$line4',line5='$line5',line6='$line6',line7='$line7',line8='$line8',line9='$line9',line10='$line10' where id=1";
	        mysql_query($xQry);
			header('Location: config_quotation.php');

	//echo $xQry;
	

        
    echo "<script type='text/javascript'>";
   echo "window.close();";
  //              echo "window.location.reload();";
    echo "</script>";
}
?>
<html>

    <title>CHOOSE DATE</title>
    <body>
        <form action="config_quotation.php" method="post">

            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">QUOTATION CONFIGURATION</h4>
                    <div class="btn-group pull-right">
         
                    </div>
                </div>
                <div class="panel-body">
                    <div class="container">
                        <div class="row" >
                            <div class="col-sm-6">
                                <label>Ref: </label>
                                <input type="text" class="form-control"  name="line1" value="<?php echo $GLOBALS ['xLine1']; ?>">       
                            </div>
                             <div class="col-sm-6">
                                <label>Subject </label>
                                <input type="text" class="form-control"  name="line2" value="<?php echo $GLOBALS ['xLine2']; ?>">       
                            </div>
                        </div>
						<div class="row" >
                            <div class="col-sm-6">
                                <label>Subject Staff Name </label>
                                <input type="text" class="form-control"  name="line3" value="<?php echo $GLOBALS ['xLine3']; ?>">       
                            </div>
                             <div class="col-sm-6">
                                <label>Subject Content </label>
                                <input type="text" class="form-control"  name="line4" value="<?php echo $GLOBALS ['xLine4']; ?>">       
                            </div>
                        </div>
						<div class="row" >
                            <div class="col-sm-6">
                                <label>Validity </label>
                                <input type="text" class="form-control"  name="line5" value="<?php echo $GLOBALS ['xLine5']; ?>">       
                            </div>
                             <div class="col-sm-6">
                                <label>Maintenance </label>
                                <input type="text" class="form-control"  name="line6" value="<?php echo $GLOBALS ['xLine6']; ?>">       
                            </div>
                        </div>
						<div class="row" >
                            <div class="col-sm-6">
							<label>Warranty </label>       
							<input type="text" class="form-control"  name="line7" value="<?php echo $GLOBALS ['xLine7']; ?>">       
                            </div>
                             <div class="col-sm-6">
                                <label>Payment </label>
                                <input type="text" class="form-control"  name="line8" value="<?php echo $GLOBALS ['xLine8']; ?>">       
                            </div>
                        </div>
						<div class="row" >
                            <div class="col-sm-6">
                                <label>Line9 </label>
                                <input type="text" class="form-control"  name="line9" value="<?php echo $GLOBALS ['xLine9']; ?>">       
                            </div>
                             <div class="col-sm-6">
                                <label>Line10 </label>
                                <input type="text" class="form-control"  name="line10" value="<?php echo $GLOBALS ['xLine10']; ?>">       
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <input type="submit"  name="save"   class="btn btn-primary" value="UPDATE" >
                </div>
            </div>
        </form>
    </body>
</html>