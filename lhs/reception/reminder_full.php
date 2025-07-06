<?php
include 'globalfile.php';
?>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<body>
<table class="table table-hover" border="1" id="lastrow">
<thead>
 <tr>
			
                    <th>Task Name</th>
						<th>Due Date</th>
						<th>Amount</th>
						<th>Days</th>
						<th width="40%">Description</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>

					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from reminder_basic order by due_date";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {

	echo '<td width=10%>' . $row ['task_name'] . '</td>';
	echo '<td width=10%>' .date("d/M/Y", strtotime($row ['due_date'])) . '</td>';
	echo '<td width=10%>' . $row ['amount'] . '</td>';
	echo '<td width=10%>' . $row ['days'] . '</td>';
    echo '<td width=10%><textarea rows="10" cols="80" disabled style="border: none" >' . $row ['description'] . '</textarea></td>';
 	?>
 	<?php
if($login_session=="admin")
{
?>
	<td><a
								href="reminder_main.php<?php echo '?task_id='.$row['task_id']. '&xmode=edit';  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
					
							<td><a
								href="reminder_main.php<?php echo '?task_id='.$row['task_id']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
				
	<?php
}		
?>
						</tr>
<?php
}

?>			</tbody>
				</table>
