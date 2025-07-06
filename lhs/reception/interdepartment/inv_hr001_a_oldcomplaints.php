<?php
include('globalfile.php');
  $xItemNo= $_GET['itemno'];
?>
<form name="inv_hr001complaints" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<body>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "View Complaints  FROM [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3></b>
</div>
<div class="panel-body">
<div id="divToPrint" >
<div class="tables">
	<!--<p>
		<label for="search">
			<strong>Enter keyword to search </strong>
		</label>
		<input type="text" id="search"/>
	</p>!-->
<table class="table table-bordered">
		 <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="5%">COMP.NO</th>
           <th width="10%"> ITEM </th>
           <th width="10%"> STOCKPOINT</th>
           <th width="10%"> DATE</th>
           <th width="20%"> DESCRIPTION</th>
           <th width="13%"> COMPLAINTBY</th>
           <th width="7%"> AMOUNT</th>
           <th width="8%"> STATUS</th>
           <th width="15%"> REMARKS</th>
           <th width="10%"> COMPLETED</th>
           <th width="10%"> BILLNO</th>
        </tr>
      </thead>
      <tbody>

<?php

$xQry='';
$xSlNo=0;
$xQryFilter='';
$xItemCategoryNo=$GLOBALS ['xItemCategoryNo'];
$xItemGroupNo=$GLOBALS ['xItemGroupNo'];
$xItemSubGroupNo=$GLOBALS ['xItemSubGroupNo'];
$xStockPointNo=$GLOBALS ['xStockPointNo'];
$xItemNo=$GLOBALS ['xItemNo'];
$xQry="SELECT *  from t_complaint where itemno=$xItemNo order by  date";

$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    $xSlNo+=1;
    echo '<td>' . $xSlNo  . '</td>';
    finditemname($row['itemno']);
    echo '<td>' . $row['complaintno']  . '</td>';
    findstockpointname($row['stockpointno']);
    echo '<td>' . $GLOBALS['xItemName']  . '</td>';
    echo '<td>' . $GLOBALS['xStockPointName']  . '</td>';
    echo '<td>' .date('d/M/Y',strtotime( $row['date']))  . '</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';
    echo '<td>' . $row['complaintby']  . '</td>';
    echo '<td>' . $row['amount']  .'</td>';
    echo '<td>' . $row['status']  . '</td>';
    echo '<td>' . $row['remarks']  . '</td>';
    echo '<td>' . date('d/M/Y',strtotime( $row['completeddate']))  . '</td>';
    echo '<td>' . $row['billno']  . '</td>';
   
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
	
</div>
</div>
</div>
</body>
</form>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->