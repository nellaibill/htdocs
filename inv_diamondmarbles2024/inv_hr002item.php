<?php
include 'globalfile.php';
?>
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading text-center">
			FILTER[GROUP]
			<div class="btn-group pull-right">
				<input type="submit" name="save" class="btn btn-primary"
					value="VIEW">
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">

				<div class="col-xs-3">
					<label>StockPoint:</label> <select class="form-control"
						name="f_stockpointno">
<?php
dropDownStockPoint ();
?>
</select>
				</div>

				<div class="col-xs-3">
					<label>Category:</label> <select class="form-control"
						name="f_itemcategoryno">
<?php DropDownCategory(); ?>
</select>
				</div>


				<div class="col-xs-3">
					<label>Group:</label> <select class="form-control"
						name="f_itemgroupno">
<?php DropDownGroup(); ?>
</select>
				</div>

				<div class="col-xs-3">
					<label>Sub-Group:</label> <select class="form-control"
						name="f_itemsubgroupno">
<?php DropDownSubGroup(); ?>
</select>
				</div>

			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->
</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

<div class="panel panel-primary">
	<div class="panel-heading  text-center">
		<h3 class="panel-title">VIEW-ITEM</h3>
		<div class="pull-right">
			<a href="inv_hc002item.php" class="btn btn-default">CONFIG</a>
		</div>
	</div>
	<div class="panel-body">

		<div id="divToPrint">
			<div class="container">
								<input id="filter" type="text" class="col-xs-8"
						placeholder="Search here...">



<?php
$xQry = '';
$xSlNo = 0;
$xQryFilter = '';
if (isSet ( $_POST ['save'] )) {
	$xItemCategoryNo = $_POST ['f_itemcategoryno'];
	$xItemGroupNo = $_POST ['f_itemgroupno'];
	$xItemSubGroupNo = $_POST ['f_itemsubgroupno'];
	$xStockPointNo = $_POST ['f_stockpointno'];
	$xQry = "update config_inventory set categoryno=$xItemCategoryNo,groupno=$xItemGroupNo,subgroupno=$xItemSubGroupNo,stockpointno=$xStockPointNo";
	mysql_query ( $xQry );
	header ( 'Location: inv_hr002item.php' );
} else {
	$xItemCategoryNo = $GLOBALS ['xItemCategoryNo'];
	$xItemGroupNo = $GLOBALS ['xItemGroupNo'];
	$xItemSubGroupNo = $GLOBALS ['xItemSubGroupNo'];
	$xStockPointNo = $GLOBALS ['xStockPointNo'];
}

if ($xItemCategoryNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and itemcategoryno=$xItemCategoryNo";
}

if ($xItemGroupNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and itemgroupno=$xItemGroupNo";
}

if ($xItemSubGroupNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and itemsubgroupno=$xItemSubGroupNo";
}
if ($xStockPointNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and stockpointno=$xStockPointNo";
}

/* View Amc Enable Records Only */

if ($GLOBALS ['xViewAmcOnly'] == 0) {
	$xQryFilter = $xQryFilter . ' ' . " and amcrequired='Yes'";
}

$xQry = "SELECT *  from m_item where itemname!=''";
// $xQry.= $xQryFilter. ' ' . "ORDER BY LENGTH(itemname),itemname;";
$xQry .= $xQryFilter . ' ' . "ORDER BY itemname;";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';
?>
<table class="table table-striped  table-bordered " border="1">
					<thead>
<?php
findstockpointname ( $xStockPointNo );
finditemcategoryname ( $xItemCategoryNo );
finditemgroupname ( $xItemGroupNo );
finditemsubgroupname ( $xItemSubGroupNo );
echo '<tr>';
// echo '<td colspan=6> StockPoint -[' . $GLOBALS ['xStockPointName']. '] Category-[' . $GLOBALS ['xItemCategoryName']. ']Group-[' . $GLOBALS ['xItemGroupName']. ']Items</td>';
echo '</tr>';
?>
        <tr>
							<th>S.NO</th>
							<th>ITEM NAME</th>
							<th>HSNCODE</th>
							<th>PACKING</th>
          <?php if($GLOBALS ['xViewStockPoint']  == 0){ ?>        <th>
								STOCKPOINT</th> <?php } ?>
          <?php if($GLOBALS ['xViewCategory']  == 0){ ?>          <th>
								CATEGORY</th> <?php } ?>
          <?php if($GLOBALS ['xViewGroup']  == 0){ ?>             <th>
								GROUP</th> <?php } ?>
          <?php if($GLOBALS ['xViewSubGroup']  == 0){ ?>          <th>
								SUBGROUP</th> <?php } ?>
           <th colspan="2">ACTIONS</th>
						</tr>
					</thead>

					<tbody class="searchable">
<?php
while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	findstockpointname ( $row ['stockpointno'] );
	finditemcategoryname ( $row ['itemcategoryno'] );
	finditemgroupname ( $row ['itemgroupno'] );
	finditemsubgroupname ( $row ['itemsubgroupno'] );
	?>
   <tr>
   <?php
	echo '<td>' . $xSlNo . '</td>';
	echo '<td>' . $row ['itemname'] . '</td>';
	echo '<td>' . $row ['hsncode'] . '</td>';
	echo '<td>' . $row ['packno'] . '</td>';
	if ($GLOBALS ['xViewStockPoint'] == 0) {
		echo '<td>' . $GLOBALS ['xStockPointShortName'] . '</td>';
	}
	if ($GLOBALS ['xViewCategory'] == 0) {
		echo '<td>' . $GLOBALS ['xItemCategoryShortName'] . '</td>';
	}
	if ($GLOBALS ['xViewGroup'] == 0) {
		echo '<td>' . $GLOBALS ['xItemGroupName'] . '</td>';
	}
	if ($GLOBALS ['xViewSubGroup'] == 0) {
		echo '<td>' . $GLOBALS ['xItemSubGroupName'] . '</td>';
	}
	
	?>
<td><a
								href="inv_hm005item.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="inv_hm005item.php<?php echo '?itemno='.$row['itemno']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

<?php
	echo '</tr>';
}

?>	

					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->