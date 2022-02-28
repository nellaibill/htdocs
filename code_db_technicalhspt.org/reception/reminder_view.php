<?php
include 'globalfile.php';
if (isset ( $_GET ['task_id'] ) && ! empty ( $_GET ['task_id'] )) {
	$xGettask_id = $_GET ['task_id'];
?>
	<div id="divToPrint">
	
			<div class="panel panel-info">

				
				<table class="table" border="1">
					<tr>
                    <th>Task Name</th>
						<th>Due Date</th>
						<th>Amount</th>
						<th>Days</th>
						<th width="40%">Description</th>
					</tr>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from reminder_basic where task_id=$xGettask_id";
//echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td width=10%>' . $row ['task_name'] . '</td>';
	echo '<td width=10%>' .date("d/M/Y", strtotime($row ['due_date'])) . '</td>';
	echo '<td width=10%>' . $row ['amount'] . '</td>';
	echo '<td width=10%>' . $row ['days'] . '</td>';
    echo '<td width=10%><textarea rows="10" cols="80" disabled style="border: none" >' . $row ['description'] . '</textarea></td>';
     echo '</tr>';
}
}

?>			</tbody>
				</table>
			</div>
	</div>