<?php
//include 'session.php';
include 'globalfile.php';
if (isset($_POST ['save'])) {
    $xPrintTemplate = $_POST ['f_print_template'];
    $xCompanyLogo = $_POST ['f_company_logo'];
    $xQry = "update config_print set config_print_template='$xPrintTemplate',config_print_src='$xCompanyLogo'";
    mysql_query($xQry);
    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
}
?>
<html>
    <title>CHOOSE DATE</title>
    <body>
        <form action="config_print.php" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">SET PRINTER SETTINGS</h4>
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-default btn-sm" onclick="window.close()">Close</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">


                        <div class="col-xs-3">
                            <label>Print Template</label>
                            <select
                                class="form-control" name="f_print_template">
                                <option value="print_format1.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format1.php") echo 'selected="selected"'; ?>>Template1</option>
                                <option value="print_format2.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format2.php") echo 'selected="selected"'; ?>>Template2</option>
                                <option value="print_format3.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format3.php") echo 'selected="selected"'; ?>>Template3</option>
                                <option value="print_format4.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format4.php") echo 'selected="selected"'; ?>>Template4</option>
                                <option value="print_format5.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format5.php") echo 'selected="selected"'; ?>>Template5</option>
                                <option value="print_format6.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format6.php") echo 'selected="selected"'; ?>>Template6</option>
                                <option value="print_format7.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format7.php") echo 'selected="selected"'; ?>>Template7</option>
                                <option value="print_format8.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format8.php") echo 'selected="selected"'; ?>>Template8</option>
                                <option value="print_format9.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format9.php") echo 'selected="selected"'; ?>>Template9</option>
                                <option value="print_format10.php" <?php if ($GLOBALS ['xPrintTemplate'] == "print_format10.php") echo 'selected="selected"'; ?>>Template10</option>

                            </select>

                        </div>
                        <div class="col-xs-3">
                            <label>  Select a file:</label> 
                            <input type="file" name="f_company_logo" class="form-control"> 
                        </div>


                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
                </div>
            </div>
        </form>
    </body>
</html>