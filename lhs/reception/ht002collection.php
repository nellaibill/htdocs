<?php
include 'globalfile.php';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
	if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
	{
	  $no= $_GET['txno'];
	  if($_GET['xmode']=='edit')
	   {
		DataFetch ( $_GET['txno']);
	   }
	   else
	   {
		  $xQry = "DELETE FROM collection WHERE txno= $no";
		  mysql_query ( $xQry );
		  header('Location: ht002collection.php'); 	
	   }
	}
	else
	 {
	  GetMaxIdNo ();
	 }
	$GLOBALS ['xCurrentDate']=date('Y-m-d H:i:s');

	if (isset ( $_POST ['save'] ))
	{

		DataProcess ( "S");
	}
	elseif (isset ( $_POST ['update'] )) 
	{
		DataProcess ( "U" );
	}

function setControlProperties() {
	$xIdno;
	$xDate;
	$xGroupName = "";
	$xComment = "";
	$xAmount = 0;
	//$GLOBALS ['xDate'] = "";
	$GLOBALS ['xGroupName'] = "";
	$GLOBALS ['xComment'] = "";
	$GLOBALS ['xAmount'] = "";
}

function NewEntry() {
	DataClear ();
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT MAX(txno)+1 as txno FROM collection" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xMaxId'] = $row ['txno'];
	}
}
function DataClear() {

	$GLOBALS ['xDoctorFees'] = "";
	$GLOBALS ['xPatientReturnAmount'] = "";
	$GLOBALS ['xAdvance'] = "";
        $GLOBALS ['xReceipt'] = "";
	$GLOBALS ['xOthers'] = "";
}
function DataFetch($xTxno) {
		$result = mysql_query ( "SELECT *  FROM collection where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
if(($row['date'] == date('Y-m-d') or ($GLOBALS ['xCurrentUser']=='admin')))
{
	        $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xAdvance'] = $row ['advance'];
                $GLOBALS ['xReceipt'] = $row ['receipt'];
                $GLOBALS ['xExpenses'] = $row ['expenses'];
		$GLOBALS ['xOthers'] = $row ['others'];
$GLOBALS ['xNettotal'] = $row ['nettotal'];
}
else
{
echo '<script language="javascript">';
echo 'alert("Sorry date is Not Matched")';
echo '</script>';
}
	}
	}
	else
	{
	 $GLOBALS ['xIdno'] = "";
		//$GLOBALS ['xDate'] = "";
		$GLOBALS ['xGroupName'] = "";
		$GLOBALS ['xComment'] = "";
		$GLOBALS ['xAmount'] = "";
	}
	
	
}
function DataFetchDate($xTxDate) {
		$result = mysql_query ( "SELECT *  FROM collection where date='$xTxDate'" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
if(($row['date'] == date('Y-m-d') or ($GLOBALS ['xCurrentUser']=='admin')))
{
	        $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xAdvance'] = $row ['advance'];
                $GLOBALS ['xReceipt'] = $row ['receipt'];
                $GLOBALS ['xExpenses'] = $row ['expenses'];
		$GLOBALS ['xOthers'] = $row ['others'];
$GLOBALS ['xNettotal'] = $row ['nettotal'];
}
else
{
echo '<script language="javascript">';
echo 'alert("Sorry date is Not Matched")';
echo '</script>';
}
	}
	}
	else
	{
	 $GLOBALS ['xIdno'] = "";
		//$GLOBALS ['xDate'] = "";
		$GLOBALS ['xGroupName'] = "";
		$GLOBALS ['xComment'] = "";
		$GLOBALS ['xAmount'] = "";
	}
	
	
}
function DataProcess($xMode)
 {
$xTxno = $_POST ['txtTxNo'];
$xDate = $_POST ['date'];
$xAdvance = $_POST ['advance'];
$xReceipt = $_POST ['receipt'];
$xExpenses= $_POST ['expenses'];
$xOthers = $_POST ['others'];
$xOptRadio= $_POST ['optradio'];
$xNettotal = $_POST ['nettotal'];
$CurrentDate=$GLOBALS ['xCurrentDate'];
$xSql="";
$xMsg="";
if ($xMode == 'S') {
if($GLOBALS ['xCurrentUser']=='admin')
{
  $xSql= "INSERT INTO collection VALUES ($xTxno ,'$xDate', $xAdvance,$xReceipt,$xExpenses,$xOthers,'$xOptRadio',$xNettotal)";
}
else
{
 $xSql= "INSERT INTO collection VALUES ($xTxno ,'$CurrentDate',$xAdvance,$xReceipt,$xExpenses,$xOthers,'$xOptRadio',$xNettotal)";
}
$retval = mysql_query ( $xSql) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}
GetMaxIdNo ();
  $xMsg="Inserted";
} 
	elseif ($xMode == 'U') {
	$xDate = $_POST ['date'];
		// sql to update a record
		if($GLOBALS ['xCurrentUser']=='admin')
		{
		 	$xSql= "UPDATE collection SET  advance=$xAdvance,receipt =$xReceipt,expenses=$xExpenses,others =$xOthers,optradio='$xOptRadio',nettotal =$xNettotal WHERE txno=$xTxno";
		}
		else{
			$xSql= "UPDATE collection SET  advance=$xAdvance,receipt =$xReceipt,expenses=$xExpenses,others =$xOthers,optradio='$xOptRadio',nettotal =$xNettotal WHERE txno=$xTxno";
		}
	
                $retval = mysql_query ( $xSql) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
  $xMsg="Updated";
	} elseif ($xMode == 'D') {
		$xSql= "DELETE FROM collection WHERE txno=$xTxno";
		
                $retval = mysql_query ( $xSql) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
  $xMsg="Deleted";
	}
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>RECEPTION</title>
<script>

function CalculateTotal() {
            var advance= document.getElementById('txtAdvance').value;
            var receipt= document.getElementById('txtReceipt').value;
            var expenses= document.getElementById('txtExpenses').value;
            var others= document.getElementById('txtOthers').value; 
var add = document.getElementById("add").checked;
if(add)
  {
  var result =((parseInt(advance) + parseInt(receipt)+parseInt(others))- parseInt(expenses));
            if (!isNaN(result)) 
            {
                document.getElementById('txtNetTotal').value = result;
            }
   }
else
   {
var result =((parseInt(advance) + parseInt(receipt)-parseInt(others))- parseInt(expenses));
            if (!isNaN(result))
            {
                document.getElementById('txtNetTotal').value = result;
            }
    }    
}
     

</script>
</head>
<body>
<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <div class="panel panel-primary">
  <div class="panel-heading">
        <h3 class="panel-title">COLLECTION-ENTRY </h3>
  </div>
 <div class="panel-body">
<?php
if($login_session=="admin")
{
?>

<?
}
?>
<div class="form-group">
	<div class="col-xs-2">
	<input type="number" class="form-control" id="xtxtTxNo" name="txtTxNo" value="<?php echo $GLOBALS ['xIdno']; ?>" readonly>
	</div>
	<div class="col-xs-2">
<?php
if($login_session=="admin")
{
?>
<input type="date" class="form-control" id="xdate" name="date"  value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="">
<?php
}
else
{
?>
<input type="date" class="form-control" id="xdate" name="date" disabled  value="<?php echo $GLOBALS ['xDate']; ?>">
<?php
}
?>
</div>
</div></br></br>
	
<div class="form-group">
	<div class="col-xs-2">
	<input type="number" class="form-control" id="txtAdvance" name="advance" value="<?php echo $GLOBALS ['xAdvance']; ?>" 
placeholder="ADVANCE">
	</div>
	<div class="col-xs-2">
	<input type="number" class="form-control" id="txtReceipt" name="receipt" value="<?php echo $GLOBALS ['xReceipt']; ?>" 
placeholder="RECEIPT">
	</div>
	<div class="col-xs-2">
        <input type="number" class="form-control" id="txtExpenses" name="expenses" value="<?php echo $GLOBALS ['xExpenses']; ?>" 
placeholder="EXPENSES">
	</div>
</div><br></br>
<div class="form-group">
	<div class="col-xs-2">
	<input type="number" class="form-control" id="txtOthers" name="others" value="<?php echo $GLOBALS ['xOthers']; ?>"  
placeholder="OTHERS">
        </div>
        <div class="col-xs-2">
	<label><input type="radio" id="add"      name="optradio"  onclick="CalculateTotal()" value="+">ADD</label>
        <label><input type="radio" id="subtract" name="optradio"  onclick="CalculateTotal()" value="-">SUBTRACT</label>
        </div>
	<div class="col-xs-2">
	<input type="number" class="form-control" name="nettotal" id="txtNetTotal" value="<?php echo $GLOBALS ['xNettotal']; ?>"
placeholder="NET-TOTAL">
	</div>
</div><br> <br> 
</div><!-- PANEL BODY !-->
<div class="panel-footer clearfix">
<div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
<input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()"> 
  </div>
</div>
		</form>
</br>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">COLLECTIONS BY TODAY</h3></div>
<table class="table">
      <thead>
        <tr>
           <th width="10%"> TXNO</th>
           <th width="20%"> DATE </th>
           <th width="20%"> ADVANCE</th>
           <th width="10%">RECEIPT</th>
           <th width="10%">EXPENSES</th>
           <th width="10%"> OTHERS</th>
           <th width="20%">TOTAL</th>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xTotalAmount =0;
$xDate=date('Y-m-d');
$xQry="SELECT *  from collection where date>= '".$xDate."' 
		 AND date<= '".$xDate."'"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
echo '<td width=10%>' . $row['txno']  . '</td>';
echo '<td width=20%>' . $row['date']  . '</td>';
echo '<td width=20%>' . money_format("%!n", $row['advance'])  . '</td>';
echo '<td width=10%>' . money_format("%!n", $row['receipt']) . '</td>';
echo '<td width=10%>' . money_format("%!n", $row['expenses']) . '</td>';
echo '<td width=10%>' . $row['optradio'] . ' ' . money_format("%!n", $row['others']).'</td>';
echo '<td width=20%>' . money_format("%!n", $row['nettotal']) . '</td>';

	?>
	<td><a href="ht002collection.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<td><a href="ht002collection.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<?
	echo '</tr>'; 
	
$xTotalAmount +=$row['nettotal'];
}
echo '<tr>'; 
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td>TOTAL</td>';
    echo '<td></td>';
    echo '<td>' .money_format("%!n", $xTotalAmount ) . '</td>';
    echo '</tr>'; 
  
?>	
</tbody>
    </table>	
</div><!-- /PANEL HEADING -->
</div><!-- /CONTAINER -->
</div><!-- / TO PRINT-->
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

</body>
</html>