<?php
include 'globalfile.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="panel-body">

			<div class="container">
                                          <input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>
							<th>S.No</th>
						
							<th>Item Name</th>
                                                        <th>Qty</th>
                                                         <th>Date-Time</th>
                                                         <th>What Happen</th>
			
						</tr>
					</thead>


					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

$xQry = "SELECT * from audit_stock ";
//echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		?>
<tr>    
<?php
	finditemname( $row ['audit_stock_itemno'] );
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=left>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td align=right>' .$row ['audit_stock_qty'] . '</td>';
                echo '<td align=right>' .$row ['audit_stock_datetime'] . '</td>';
                echo '<td align=right>' .$row ['audit_stock_mode'] . '</td>';


	}
	

} 

else {

}

?>	

					
					
					
					</tbody>
				</table>

			</div>
			<!-- /container -->
		</div>
	</div>
</div>