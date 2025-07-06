<?php
include 'globalfile.php';
setControlProperties ();
IniSetup();
function IniSetup()
{
DataClear();
if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
{
  $no= $_GET['txno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['txno']);
   }
   else
   {
      $xQry = "DELETE FROM dailyexpenses WHERE txno= $no";
      mysql_query ( $xQry );
      header('Location: ht007expenses.php'); 	
   }
}
else
 {
  GetMaxIdNo ();
 }
if (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}
 }

function setControlProperties() {
	$xIdno;
	$xDate;
	$xGroupName = "";
	$xComment = "";
	$xAmount = 0;
	$GLOBALS ['xDate'] = "";
	$GLOBALS ['xGroupName'] = "";
	$GLOBALS ['xComment'] = "";
	$GLOBALS ['xAmount'] = "";
}

function NewEntry() {
	DataClear ();
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT MAX(txno)+1 as txno FROM dailyexpenses" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xMaxId'] = $row ['txno'];
	}
}
function DataClear() {
        $GLOBALS ['xMode']="";
	$GLOBALS ['xDate'] =$GLOBALS ['xCurrentDate'];
	$GLOBALS ['xGroupName'] = "";
	$GLOBALS ['xComment'] = "";
	$GLOBALS ['xAmount'] = "";
}
function DataFetch($xTxno) {
		$result = mysql_query ( "SELECT *  FROM dailyexpenses where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
if(($row['date'] == date('Y-m-d') or ($GLOBALS ['xCurrentUser']=='admin')))
{
	    $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xGroupName'] = $row ['groupname'];
		$GLOBALS ['xComment'] = $row ['details'];
		$GLOBALS ['xAmount'] = $row ['amount'];
}
else
{
echo '<script language="javascript">';
echo 'alert("Sorry date is Not Matched")';
echo '</script>';
GetMaxIdNo ();
}
	}
	}
	else
	{
	       GetMaxIdNo();
		$GLOBALS ['xDate'] = "";
		$GLOBALS ['xGroupName'] = "";
		$GLOBALS ['xComment'] = "";
		$GLOBALS ['xAmount'] = "";
	}
	
	
}
function DataProcess($xMode) {
$xMsg="";
        $IdNo = $_POST ['txtTxNo'];
		$Date = $_POST ['date'];
		$GroupName = $_POST ['groupname'];
		$Details = strtoupper($_POST ['comment']);
		$Amount = $_POST ['amount'];
$xSql="";
$CurrentDate=$GLOBALS ['xCurrentDate'];
	if ($xMode == 'S') {
		if($GLOBALS ['xCurrentUser']=='admin')
		{
		 $xSql= "INSERT INTO dailyexpenses 
           VALUES ($IdNo, '$Date','$GroupName','$Details','$Amount','$CurrentDate')";
		}
		else{
		$xSql= "INSERT INTO dailyexpenses 
           VALUES ($IdNo, '$CurrentDate','$GroupName','$Details','$Amount','$CurrentDate')";
		}
		
                $retval = mysql_query ( $xSql) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
                 $xMsg="Inserted";
	} 
	elseif ($xMode == 'U') {

		$IdNo = $_POST ['txtTxNo'];
		$Date = $_POST ['date'];
		$GroupName = $_POST ['groupname'];
		$Details = $_POST ['comment'];
		$Amount = $_POST ['amount'];
		// sql to update a record
		if($GLOBALS ['xCurrentUser']=='admin')
		{
		 	$xSql= "UPDATE dailyexpenses SET  date='$Date',groupname='$GroupName',details='$Details',amount ='$Amount' WHERE txno=$IdNo";
		}
		else{
			$xSql= "UPDATE dailyexpenses SET  date='$CurrentDate',groupname='$GroupName',details='$Details',amount ='$Amount' WHERE txno=$IdNo";
		}
		
	  $retval = mysql_query ( $xSql) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
                  $xMsg="Updated";
	} elseif ($xMode == 'D') {

		$xSql= "DELETE FROM dailyexpenses WHERE txno=$IdNo";
		
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
<meta charset="UTF-8">
<title>EXPENSES</title>
<script>
function validateForm() {
var xGroupName= document.forms["expenses"]["groupname"].value;
var xAmount= document.forms["expenses"]["amount"].value;
var xComment= document.forms["expenses"]["comment"].value;

if (xGroupName== "Select Your Group") {
        alert("Please Choose a Group");
document.expenses.groupname.focus();
        return false;
    }

 if (xAmount== null || xAmount== "") {
        alert("Please Enter an Amount");
document.expenses.amount.focus();
        return false;
    }

 if (xComment== null || xComment== "") {
        alert("Details must be filled out");
document.expenses.comment.focus();
        return false;
    }
   

}
</script>
</head>
<body>
<form class="form" name="expenses" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">EXPENSES -ENTRY</h3>
</div>
<div class="panel-body">
  <div class="form-group">
	<label for="lbltxno" class="control-label col-xs-2">DATE & AMOUNT</label>
	<div class="col-xs-1" style="display: none;">
	<input type="text" class="form-control" id="xtxtTxNo" style="text-align: right"
		name="txtTxNo" value="<?php echo $GLOBALS ['xIdno']; ?>" readonly >
	</div>

	<div class="col-xs-2">
<?php
if($login_session=="admin")
{
?>
<input type="date" class="form-control" id="xdate" name="date" value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="">
<?php
}
else
{
?>
<input type="date" class="form-control" id="xdate" name="date" readonly value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="">
<?php
}
?>
         </div>
	<div class="col-xs-2">
		<input type="text" class="form-control"  maxlength="8" name="amount"
			id="txtAmount" value="<?php echo $GLOBALS ['xAmount']; ?>" placeholder="AMOUNT">
		</div>
</div><br>
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-2">CHOOSE GROUP</label>
<div class="col-xs-4">
<select class="form-control" value="" name="groupname">
<?php
$result = mysql_query("SELECT *  FROM expenses_group");
while($row = mysql_fetch_array($result))
{
?>
<option value = "<?php echo $row['exgrpname']; ?>" 
<?php
  if ($row['exgrpname']==  $GLOBALS ['xExpGroupName'])
  {
      echo 'selected="selected"';
   } 
    ?> >
 <?php echo $row['exgrpname']; ?> 
  </option>
<?
  }
  echo "</select>";

?>
</div></br></br>


<div class="form-group">
	<label for="lbltxno" class="control-label col-xs-2">DETAILS</label>
		<div class="col-xs-4"  style="text-align: left;">
                        <textarea class="form-control" rows="3" cols="15"  id="comment" name="comment" 
                          style="float:right"  maxlength="200"><?php echo $GLOBALS ['xComment']; ?></textarea>
		</div>
</div></div>
</br></br></br></br>

<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
		</form>
</BR>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">EXPENSES BY TODAY</h3></div>
<table class="table">
      <thead>
        <tr>
          <th> DATE </th>
          <th> GROUP NAME</th>
          <th> DETAILS</th>
          <th >AMOUNT</th>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xTotalAmount =0;
$xDate=date('Y-m-d');
$xQry="SELECT *  from dailyexpenses where date>= '".$xDate."' 
		 AND date<= '".$xDate."'"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
?>
<td><a href="hr002expenses_old.php<?php echo '?name='.$row['groupname'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $row['groupname']?>
</a>  </td>
<?php
  
   // echo '<td>' . $row['groupname']  . '</td>';
    echo '<td>' . $row['details']  . '</td>';
    echo '<td >' .money_format("%!n", $row['amount']) . '</td>';

?>
<td width="5%"><a href="ht007expenses.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="ht007expenses.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
echo '</tr>'; 
$xTotalAmount +=$row['amount'];
}
echo '<tr>'; 
    echo '<td></td>';
    echo '<td>TOTAL</td>';
    echo '<td></td>';
    echo '<td>' .money_format("%!n", $xTotalAmount ) . '</td>';
    echo '</tr>'; 
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
	</div>
</body>
</html>