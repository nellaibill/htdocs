
<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
function fn_FindCurrentStock($xItemNo) {
	$xCurrentStock = '';
	$xQry = "select stock from inv_stockentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xCurrentStock = $row ['stock'];
	}
	return $xCurrentStock;
}

?>


<html>
<head>
<?php include 'title.php'?>
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
</head>
<body>

	<div id="divToPrint">
		<div class="panel panel-primary">
	
			<div class="panel-body">

				<div class="container">

					<input id="filter" type="text" class="col-xs-8"
						placeholder="Search here...">
<?php
$xSlNo = 0;	
$xQry = "select sum(stock)as stock,itemno from inv_stockentry where stock>0 group by itemno";
$result2 = mysql_query ( $xQry );
?>
<table class="table table-hover" border="1">
						<thead>
							<tr>
								<th width="5%">S.NO</th>
								<th width="15%">ItemName</th>
								<th width="10%">Current Stock</th>

							</tr>
						</thead>

						<tbody class="searchable">
<?php
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	finditemname ( $row ['itemno'] );
	echo '<td align=right>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	echo '<td>' . $row ['stock'] . '</td>';
	
	?>

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
</body>
</html>
