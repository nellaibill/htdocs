

<?php
include 'globalfile.php';
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <div class="panel-body">
<div class="form-group">

<div class="col-xs-3">
    <label  >FROM DATE</label>
<input type="date" class="form-control"  name="f_fromdate">
</div>

<div class="col-xs-3">
    <label >TO DATE</label>
<input type="date" class="form-control"  name="f_todate">
</div>
<div class="col-xs-3">
 <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
</div>
</div>
</div>
</form>
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
						<th>Remaining Days</th>
						<th width="40%">Description</th>
					</tr>
					</thead>
 					<tbody class="searchable">
						<tr>
<?php
 if (isSet($_POST['save'])) 
    {
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
    }
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "select  *  from reminder_basic where  reminder_date >= '".$xFromDate."' 
		 AND reminder_date<= '".$xToDate."' order by due_date";
$result2 = mysql_query ( $xQry );
//ReportHeader("REMINDER DETAILS");

while ( $row = mysql_fetch_array ( $result2 ) ) {
	        $now = time(); // or your date as well
$your_date = strtotime($row ['due_date']);
$datediff = $your_date-$now;
$xRemainingDays= round($datediff / (60 * 60 * 24));
	echo '<td width=10%>' . $row ['task_name'] . '</td>';
	echo '<td width=10%>' .date("d/M/Y", strtotime($row ['due_date'])) . '</td>';
	echo '<td width=10%>' . $row ['amount'] . '</td>';
	echo '<td width=10%>' . $xRemainingDays. '</td>';
    echo '<td width=10%><textarea rows="10" cols="80" disabled style="border: none" >' . $row ['description'] . '</textarea></td>';
     echo '</tr>';

}

?>			</tbody>
				</table>
