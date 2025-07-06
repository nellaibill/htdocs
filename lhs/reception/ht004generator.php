<?php
include 'globalfile.php';
setControlProperties ();
$GLOBALS ['xCurrentDate']=date('Y-m-d H:i:s');
$GLOBALS ['xCurrentDate1']=date('m/d/Y H:i');
$GLOBALS ['xCurrentUser']=$login_session;
if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
}elseif (isset ( $_POST ['edit'] )) {
	DataFetch ( $_POST ['txtTxNo']);
} elseif (isset ( $_POST ['delete'] )) {
	DataProcess ( "D" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
 elseif (isset ( $_POST ['previous'] )) {

DataFetch ( $_POST ['txtTxNo']-1 );

} elseif (isset ( $_POST ['next'] )) {
	DataFetch ( $_POST ['txtTxNo']+1 );
}
else {
	NewEntry ();
GetMaxIdNo ();
}
function setControlProperties() {
	$xIdno;
	$xDate;
	$xGroupName = "";
	$xComment = "";
	$xAmount = 0;
	$GLOBALS ['xDate'] = "";
$GLOBALS ['xOnTime'] = "";
		$GLOBALS ['xOffTime'] = "";
		$GLOBALS ['xTotalTime'] = "";
$GLOBALS ['xResponsiblePerson'] = "";
}

function NewEntry() {
	DataClear ();
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM generatordetails" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xMaxId'] = $row ['txno'];
	}
}
function DataClear() {
	$GLOBALS ['xDate'] = "";
		$GLOBALS ['xOnTime'] = "";
		$GLOBALS ['xOffTime'] = "";
		$GLOBALS ['xTotalTime'] = "";
$GLOBALS ['xResponsiblePerson'] = "";
}
function DataFetch($xTxno) {
		$result = mysql_query ( "SELECT *  FROM generatordetails where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
if(($row['date'] == date('Y-m-d') or ($GLOBALS ['xCurrentUser']=='admin')))
{
	    $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xOnTime'] = $row ['ontime'];
		$GLOBALS ['xOffTime'] = $row ['offtime'];
		$GLOBALS ['xTotalTime'] = $row ['totaltime'];
$GLOBALS ['xResponsiblePerson'] = $row ['responsibleperson'];
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
        $IdNo = $_POST ['txtTxNo'];
		$Date = $_POST ['date'];
		$OnTime= $_POST ['ontime'];
		$OffTime= $_POST ['offtime'];
		$TotalTime= $_POST ['totaltime'];
                $ResponsiblePerson= $_POST ['responsibleperson'];
$CurrentDate=$GLOBALS ['xCurrentDate'];
	if ($xMode == 'S') {

if($GLOBALS ['xCurrentUser']=='admin')
		{
		 $sql = "INSERT INTO generatordetails 
           VALUES ($IdNo, '$Date','$OnTime','$OffTime','$TotalTime','$ResponsiblePerson')";
		}
		else{
		$sql = "INSERT INTO generatordetails 
           VALUES ($IdNo, '$CurrentDate','$OnTime','$OffTime','$TotalTime','$ResponsiblePerson')";
		}
           $retval = mysql_query ( $sql ) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
echo '<script language="javascript">';
echo 'alert("Inserted Successfully")';
echo '</script>';
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
		 	$sql = "UPDATE generatordetails SET  date='$Date',ontime='$OnTime',offtime='$OffTime',totaltime='$TotalTime',responsibleperson='$ResponsiblePerson' WHERE txno=$IdNo";
		}
		else{
			$sql = "UPDATE generatordetails SET  date='$CurrentDate',ontime='$OnTime',offtime='$OffTime',totaltime='$TotalTime',responsibleperson='$ResponsiblePerson' WHERE txno=$IdNo";
		}
		
	 $retval = mysql_query ( $sql ) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
echo '<script language="javascript">';
echo 'alert("Updated Successfully")';
echo '</script>';
	} elseif ($xMode == 'D') {
		
		$sql = "DELETE FROM generatordetails WHERE txno=$IdNo";
		 $retval = mysql_query ( $sql ) or die ( mysql_error () );
		
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}

			GetMaxIdNo ();
echo '<script language="javascript">';
echo 'alert("Deleted Successfully")';
echo '</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GENERATOR</title>
<style type="text/css">
body {
background-color:lightgray
	
}
</style>

<script type="text/javascript">
   var xUserName = "<?php echo $login_session; ?>";
var currenttime='<?php echo $GLOBALS ['xCurrentDate1'] ;?>';

function setontime() {
 document.getElementById("ontime").value = currenttime;

}
function setofftime() {
 document.getElementById("offtime").value = currenttime;

}
function timedifference()
{
var xOnTime=new Date(document.getElementById('ontime').value);
var xOffTime=new Date(document.getElementById('offtime').value);
var diffMs = (xOffTime- xOnTime); // milliseconds between dates
var xhours = Math.abs(xOffTime- xOnTime) / 36e5;
var diffDays = Math.abs(diffMs / 86400000); // days
var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
var diffMins = Math.abs(((diffMs % 86400000) % 3600000) / 60000); // minutes
var xSetDifference= diffHrs + ":" + diffMins ;
document.getElementById('totaltime').value=xSetDifference;
}

function formatAMPM() {
  var date= new Date(); 
  var year    = date.getFullYear();
    var month   = date.getMonth()+1; 
    var day     = date.getDate();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = month+'/'+day+'/'+year+' '+hours+ ':' + minutes + ' ' + ampm;
  return strTime;
}
 function getDateTime() {
    var now     = new Date(); 
    var year    = now.getFullYear();
    var month   = now.getMonth()+1; 
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }   
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = month+'/'+day+'/'+year+' '+hour+':'+minute;   
     return dateTime;
}

</script>
</head>
<body>
<center><h3 id="headertext">GENERATOR - ENTRY</h3></center>
	<div>

		<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>"
			method="post">

			<fieldset>
				<DIV>
				
					<input type="submit" type="button" id="xPrevious" name="previous"
						class="btn btn-primary" value="PREVIOUS"
						onclick="SetEnableDisable()"> <input type="submit" type="button"
						id="xNext" name="next" class="btn btn-primary" value="NEXT"
						onclick="SetEnableDisable()">

				</div>
				<br> <br>
				<div class="form-group">
					<label for="lbltxno" class="control-label col-xs-2">SL.NO</label>
					<div class="col-xs-1">
						<input type="text" class="form-control" id="xtxtTxNo" style="text-align: right"
							name="txtTxNo" value="<?php echo $GLOBALS ['xIdno']; ?>"
							placeholder="">
		</div>
				
<input type="submit" type="button" name="edit"
						class="btn btn-primary" value="EDIT"></div>
				
				<div class="form-group">
					<label for="lbltxno" class="control-label col-xs-2">CHOOSE DATE</label>
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
<input type="date" class="form-control" id="xdate" name="date" disabled  value="<?php echo date("mm/dd/YY"); ?>" placeholder="">
<?php
}
?>

					</div>
				</div>

			
<br> <br>
<div class="form-group">

					<label for="comment" class="control-label col-xs-2"></label>
				   <div class="col-xs-3">

<?php
if($login_session=="admin")
{
?>
<input type="text" class="form-control" name="ontime" id="ontime" value="<?php echo $GLOBALS ['xOnTime']; ?>">
<?php
}
else
{
?>
<input type="text" class="form-control" name="ontime" id="ontime" readonly value="<?php echo $GLOBALS ['xOnTime']; ?>">
<?php
}
?>

</div>
<button type='button' onclick="setontime()">ON</button></br></br>
					
<label for="comment" class="control-label col-xs-2"></label>
					   <div class="col-xs-3">

<?php
if($login_session=="admin")
{
?>
<input type="text" class="form-control" name="offtime" id="offtime" value="<?php echo $GLOBALS ['xOffTime']; ?>" >
<?php
}
else
{
?>
<input type="text" class="form-control" name="offtime" id="offtime" readonly value="<?php echo $GLOBALS ['xOffTime']; ?>" >
<?php
}
?>
					</div>
<button type='button' onclick="setofftime()">OFF</button></div>
</br>



				<div class=""form-group"">
					<label for="lblAmount" class="control-label col-xs-2">TOTAL TIME(H:M)</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" name="totaltime" 
							id="totaltime" value="<?php echo $GLOBALS ['xTotalTime']; ?>"
							placeholder="" onclick="timedifference()">
					</div><button type='button' onclick="timedifference()">CALCULATE</button>
				</div>
				<br> <br> 
<div class=""form-group"">
					<label for="lblAmount" class="control-label col-xs-2">RESPONISBLE PERSON</label>
					<div class="col-xs-4">
						<select class="form-control" id="responsibleperson" value="" name="responsibleperson"
								>
								<option>CHOOSE RESPONSIBLE PERSON</option>
								<option value="SUGANTHI"
									<?php if($GLOBALS ['xResponsiblePerson']=="SUGANTHI") echo 'selected="selected"'; ?>>SUGANTHI</option>
								<option value="SHIYAMALA"
									<?php if( $GLOBALS ['xResponsiblePerson']=="SHIYAMALA") echo 'selected="selected"'; ?>>SHIYAMALA</option>
								

							</select>
					</div>
				</div>
				<br> <br> <br>
				<div>
					<input type="submit" type="button" name="new"
						class="btn btn-primary" value="NEW" > <input type="submit"
						type="button" name="save" class="btn btn-primary" value="SAVE"> <input
						type="submit" type="button" name="delete" class="btn btn-primary"
						value="DELETE"> <input type="submit" type="button" name="update"
						class="btn btn-primary" value="UPDATE">
                                               
						
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>