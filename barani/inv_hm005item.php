<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['itemno'] ) && ! empty ( $_GET ['itemno'] )) {
	$no = $_GET ['itemno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['itemno'] );
	} else {
		$xQry = "DELETE FROM m_item WHERE itemno= $no";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'This Item is Referring to Some Where Else' );
		}
		header ( 'Location: inv_hm005item.php' );
	}
} else {
	GetMaxIdNo ();
}
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );

if (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$GLOBALS ['xItemNo'] = '';
	$GLOBALS ['xItemName'] = '';
	$GLOBALS ['xAmount'] ='';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(itemno)IS NULL OR max(itemno)= '' 
   THEN '1' 
   ELSE max(itemno)+1 END AS itemno
FROM m_item";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemNo'] = $row ['itemno'];

	}
}
function GetMaxStockEntry() {
	$sql = "SELECT  CASE WHEN max(stockno)IS NULL OR max(stockno)= ''
   THEN '1'
   ELSE max(stockno)+1 END AS stockno
FROM inv_stockentry";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xStockNo'] = $row ['stockno'];
	}
}
function DataFetch($xItemNo) {
	$result = mysql_query ( "SELECT *  FROM m_item where itemno=$xItemNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xItemName'] = $row ['itemname'];
			$GLOBALS ['xAmount'] = $row ['itemamount'];
		}
	}
}
function DataProcess($mode) {
	$xItemNo = $_POST ['f_itemno'];
	$xItemName = strtoupper ( $_POST ['f_itemname'] );
	$xAmount = $_POST ['f_amount'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_item  VALUES ($xItemNo,
		'$xItemName',$xAmount)";
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_item   SET itemname='$xItemName',itemamount=$xAmount WHERE itemno=$xItemNo";
		$xMsg = "Updated";
		header ( 'Location: inv_hm005item.php' );
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
	}
	
	GetMaxIdNo ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Item</title>
</head>
<!--<link rel="stylesheet" href="../css/table.css">!-->

<script type="text/javascript" src="../js/table.js"></script>
<script type="text/javascript">
function validateForm() 
{

var xItemName= document.forms["itemform"]["f_itemname"].value;
if (xItemName== null || xItemName== "") 
{
	alert("Item Name must be filled out");
	document.itemform.f_itemname.focus();
	return false;
}
var xAmount= document.forms["itemform"]["f_amount"].value;
if (xAmount== null || xAmount== "") 
{
	alert("Amount must be filled out");
	document.itemform.f_amount.focus();
	return false;
}
}
</script>
<body onload='document.itemform.f_itemname.focus()'>
	<form class="form" name="itemform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">MASTER -ITEM</h3>
			</div>
			<div class="panel-body">
				<div class="col-xs-2" style="display: none;">
					<input type="text" class="form-control" id="f_itemno"
						name="f_itemno" value="<?php echo $GLOBALS ['xItemNo']; ?>"
						readonly>
				</div>


		


				<div class="col-xs-6">
					<label>ItemName:</label> <input type="text" class="form-control"
						name="f_itemname" value="<?php echo $GLOBALS ['xItemName']; ?>">
				</div>
				
				<div class="col-xs-6">
					<label>Amount/Day:</label> <input type="text" class="form-control"
						name="f_amount" value="<?php echo $GLOBALS ['xAmount']; ?>">
				</div>
				</div>
			</div>
			<!-- PANEL BODY !-->
			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()" accesskey="u"> 
	   <?php }  ?>
	</div>
			</div>

		</div>
		<!-- PANEL !-->
	</form>
	
	
	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
        <h3 class="panel-title">VIEW-ITEM</h3>

  </div>
 <div class="panel-body">

<div id="divToPrint" >
<div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->


<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT *  from m_item where itemname!='' ORDER BY itemname;";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
?>
<table class="table table-striped  table-bordered "  border="1">
      <thead>
<?php
 
    echo '<tr>';
    //echo '<td colspan=6> StockPoint -[' . $GLOBALS ['xStockPointName']. '] Category-[' . $GLOBALS ['xItemCategoryName']. ']Group-[' . $GLOBALS ['xItemGroupName']. ']Items</td>';
    echo '</tr>';
?>
        <tr>
           <th> S.NO</th>
 <th> ITEM NAME</th>
  <th> AMOUNT</th>
           <th colspan="2"> ACTIONS</th>
        </tr>
      </thead>

      <tbody class="searchable">
<?php
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;

   ?>
   <tr>
   <?php 
    echo '<td>' . $xSlNo. '</td>';
       echo '<td>' . $row['itemname']  . '</td>';
       echo '<td>' . $row['itemamount']  . '</td>';

   
?>
<td><a href="inv_hm005item.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_hm005item.php<?php echo '?itemno='.$row['itemno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?php
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>