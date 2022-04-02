<?php
include 'globalfile.php';
$xCurrentDate = $GLOBALS ['xCurrentDate'];
?>

<html>
<title>V-SALES</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
	<div id="divToPrint">
		<div class="container">

<?php
$xSlNo = 0;
$xGrandTotal = 0;
/* ------------- Area Executes from Home Page ----------- */
$xQry = "SELECT i.itemno,i.batchid,i.currentqty FROM `inv_purchaseentry` as i,m_item as m where  m.itemno=i.itemno and i.currentqty>0   order by m.itemname;";
$result2 = mysql_query ( $xQry );
?>
<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<b><?php echo "Batch-Wise Report As On ". date("d/M/y h:i:sa"); ?></b>
				</div>
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="5%">S.NO</th>
							<th width="25%">ITEM NAME</th>
							<th width="10%">BATCH ID</th>
							<th width="10%">STOCK</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th width="5%">S.NO</th>
							<th width="25%">ITEM NAME</th>
							<th width="10%">BATCH ID</th>
							<th width="10%">STOCK</th>
						</tr>
					</tfoot>
					<tbody class="searchable">

<?php
if (mysql_num_rows ( $result2 )) {
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		
		echo '<tr>';
		finditemname ( $row ['itemno'] );
		echo '<td>' . $xSlNo += 1 . '</td>';
		echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td>' . $row ['batchid'] . '</td>';
		echo '<td>' . $row ['currentqty'] . '</td>';
		?>
<?php

		echo '</tr>';
	}

} 

else {
	fn_NoDataFound ();
}

?>	
</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>
</body>
</html>
