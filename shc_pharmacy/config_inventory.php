<?php 
//include 'session.php';
include 'globalfILE.php';
if (isset ( $_POST ['save'] )) {
$fromdate= $_POST ['reportfromdate'];
$todate= $_POST ['reporttodate'];
$xCategoryNo= $_POST ['f_itemcategoryno'];
$xGroupNo =$_POST ['f_itemgroupno'];
$xCustomerNo =5;
$xSupplierNo =4;
$xPrintTemplate= $_POST ['f_print_template'];

$xQry = "update config_inventory set fromdate='$fromdate',todate='$todate',
categoryno=$xCategoryNo,groupno=$xGroupNo,
customerno=$xCustomerNo,supplierno=$xSupplierNo,
print_template='$xPrintTemplate'";
mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
	}
?>
<html>

<title>CHOOSE DATE</title>
<body>
<form action="config_inventory.php" method="post">

<div class="panel panel-primary">
    <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left" style="padding-top: 7.5px;">SET DATE</h4>
      <div class="btn-group pull-right">
        <a href="#" class="btn btn-default btn-sm" onclick="window.close()">Close</a>
      </div>
    </div>
   <div class="panel-body">
<div class="form-group">


<div class="col-xs-3" style="display: none;">
<label>Bill Date</label>
<input type="date" class="form-control"  name="reportdate" value="<?php echo $GLOBALS ['xBillDate']; ?>">
</div>

<div class="col-xs-3">
<label>Report From Date</label>
<input type="date" class="form-control"  name="reportfromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
</div>


<div class="col-xs-3">
<label>Report To Date</label>
<input type="date" class="form-control"  name="reporttodate" value="<?php echo $GLOBALS ['xToDate']; ?>">
</div>

<div class="col-xs-3">
<label>Print Template</label>
		<select
				class="form-control" name="f_print_template">
				<option value="print_format1.php" <?php if($GLOBALS ['xPrintTemplate']=="print_format1.php") echo 'selected="selected"'; ?>>Template1</option>
    <option value="print_format2.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format2.php") echo 'selected="selected"'; ?>>Template2</option>
    <option value="print_format3.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format3.php") echo 'selected="selected"'; ?>>Template3</option>
	
				<option value="print_format4.php" <?php if($GLOBALS ['xPrintTemplate']=="print_format4.php") echo 'selected="selected"'; ?>>Template4</option>
    <option value="print_format5.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format5.php") echo 'selected="selected"'; ?>>Template5</option>
    <option value="print_format6.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format6.php") echo 'selected="selected"'; ?>>Template6</option>
	<option value="print_format7.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format7.php") echo 'selected="selected"'; ?>>Template7</option>
	<option value="print_format8.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format8.php") echo 'selected="selected"'; ?>>Template8</option>
                <option value="print_format9.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format9.php") echo 'selected="selected"'; ?>>Template9</option>
        <option value="print_format10.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format10.php") echo 'selected="selected"'; ?>>Template10</option>
		             <option value="print_format11.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format11.php") echo 'selected="selected"'; ?>>Template11</option>
        <option value="print_format12.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format12.php") echo 'selected="selected"'; ?>>Template12</option>
        <option value="print_format13.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format13.php") echo 'selected="selected"'; ?>>Template13</option>
        <option value="print_format14.php" <?php if( $GLOBALS ['xPrintTemplate']=="print_format14.php") echo 'selected="selected"'; ?>>Template14</option>
	
	</select>

</div>

			<div class="col-xs-4">
							<label>CATEGORY</label> <select class="form-control"
								name="f_itemcategoryno">
		<?php
		$result = mysql_query ( "SELECT *  FROM m_itemcategory  where itemcategoryno!=0 " );
		echo "<option value=''>Select Your Option</option>";
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>

  <option value="<?php echo $row['itemcategoryno']; ?>"
									<?php
			if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
				echo 'selected="selected"';
			}
			?>>
		<?php echo $row['itemcategoryname']; ?> 
		</option>

		 <?php
		}
		?>
		 </select>
						</div>
						
								<div class="col-xs-4">

							<label> GROUP</label> <select class="form-control"
								name="f_itemgroupno">
		<?php
		$result = mysql_query ( "SELECT *  FROM m_itemgroup order by itemgroupname" );
		echo "<option value=''>Select Your Option</option>";
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>

  <option value="<?php echo $row['itemgroupno']; ?>"
									<?php
			if ($row ['itemgroupno'] == $GLOBALS ['xItemGroupNo']) {
				echo 'selected="selected"';
			}
			?>>
		<?php echo $row['itemgroupname']; ?> 
		</option>

		 <?php
		}
		?>
		 </select>
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