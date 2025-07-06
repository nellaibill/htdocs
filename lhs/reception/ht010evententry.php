<?php
include 'globalfile.php';
IniSetup();
function IniSetup()
{
DataClear();
if ( isset( $_GET['eventno'] ) && !empty( $_GET['eventno'] ) )
{
  $no= $_GET['eventno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['eventno']);
   }
   else
   {
      $xQry = "DELETE FROM t_event WHERE eventno= $no";
      mysql_query ( $xQry );
      header('Location: ht010evententry.php'); 	
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

function DataClear()
{
$GLOBALS ['xEventName']='';
$GLOBALS ['xMode']='';
$GLOBALS ['xStartDate']=$GLOBALS ['xCurrentDate'];
$GLOBALS ['xEndDate']=$GLOBALS ['xCurrentDate'];
}
function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(eventno)IS NULL OR max(eventno)= '' 
       THEN '1' 
       ELSE max(eventno)+1 END AS eventno
FROM t_event";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xEventNo'] = $row ['eventno'];
	}
}

function DataFetch($xEventNo) {
    $result = mysql_query ( "SELECT *  FROM t_event where eventno=$xEventNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xEventNo']   = $row ['eventno'];
 		$GLOBALS ['xEventName'] = $row ['eventname'];
 		$GLOBALS ['xStartDate'] = $row ['startdate'];
 		$GLOBALS ['xEndDate']   = $row ['enddate'];
 		$GLOBALS ['xLocation']  = $row ['location'];
 		$GLOBALS ['xAddress']   = $row ['address'];
 		$GLOBALS ['xPriority']  = $row ['priority'];
	}
	}
}

function DataProcess($mode) {
$xEventNo= $_POST ['f_eventno'];
$xEventName= strtoupper($_POST ['f_eventname']);
$xStartDate= strtoupper($_POST ['f_startdate']);
$xEndDate= strtoupper($_POST ['f_enddate']);
$xLocation= strtoupper($_POST ['f_location']);
$xAddress= strtoupper($_POST ['f_address']);
$xPriority= $_POST ['f_priority'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO t_event  VALUES ($xEventNo,'$xEventName','$xStartDate','$xEndDate','$xLocation','$xAddress','$xPriority')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE t_event   SET eventname='$xEventName',startdate='$xStartDate',enddate='$xEndDate',location='$xLocation',address='$xAddress' ,priority='$xPriority' WHERE eventno=$xEventNo";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM t_event   WHERE eventno=$xEventNo";
$xMsg="Deleted";
}
//echo $xQry;
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}

GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Event</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 var xEventName= document.forms["eventform"]["f_eventname"].value;
 if (xEventName== null || xEventName== "") 
    {
        alert("Doctor-Name must be filled out");
        document.eventform.f_eventname.focus();
        return false;
    }
}


</script>

<body background="images/bg.jpg" onload='document.eventform.f_eventname.focus()'>
<form class="form" name="doctorform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success"  data-bind="nextFieldOnEnter:true">
<div class="panel-heading">
        <h3 class="panel-title  text-center">Event Registration</h3>
</div>
<div class="panel-body">
     <div class="form-group">
	<div class="col-xs-2">
<label>Tx.No:</label>
          <input type="text" class="form-control" id="f_eventno" name="f_eventno" value="<?php echo $GLOBALS ['xEventNo']; ?>" readonly>
	</div>						                 
<div class="col-xs-3"> 
<label>Event Name:</label>
<input type="text" class="form-control"  name="f_eventname" value="<?php echo $GLOBALS ['xEventName']; ?>" >
</div>

<div class="col-xs-3">
 <label>Start Date:</label>
<input type="date" class="form-control"  name="f_startdate" value="<?php echo $GLOBALS ['xStartDate']; ?>" >
</div>


<div class="col-xs-3">
 <label>EndDate:</label>
<input type="date" class="form-control"  name="f_enddate" value="<?php echo $GLOBALS ['xEndDate']; ?>"  >
</div>

<div class="col-xs-3">
 <label>Location:</label>
<input type="text" class="form-control"  name="f_location" value="<?php echo $GLOBALS ['xLocation']; ?>" >
</div>

</br></br></br>
<div class="col-xs-4" style="text-align: left;">
 <label>Address </label>
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right"><?php echo $GLOBALS ['xAddress']; ?></textarea>
</div>

<div class="col-xs-2">
 <label>Priority:</label>
<select class="form-control" name="f_priority">
       <option value="Low" <?php if($GLOBALS ['xPriority']=="Low") echo 'selected="selected"'; ?>>Low</option>
	           <option value="Medium" <?php if( $GLOBALS ['xPriority']=="Medium") echo 'selected="selected"'; ?>>Medium</option>
	           <option value="High" <?php if( $GLOBALS ['xPriority']=="High") echo 'selected="selected"'; ?>>High</option>
</select>
</div>

</br></br></br></br></br></br>
<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
</div>
</form>

<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">View Events</h3></div>
   <table class="table table-striped  table-bordered " >  
<thead>
        <tr>
           <th>Event Name</th>
           <th>Starts</th>
           <th>Ends</th>
           <th>Location</th>
           <th>Address</th>
           <th>Priority</th>
           <th colspan="2"> Actions</th>
        </tr>
      </thead>
<tbody>
<?php
$xQry="SELECT *  from t_event where eventno!=0 order by eventname;"; 
$result2=mysql_query($xQry);

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td >' . $row['eventname']  . '</td>';
    echo '<td >' . $row['startdate']  . '</td>';
    echo '<td >' . $row['enddate']  . '</td>';
    echo '<td >' . $row['location']  . '</td>';
    echo '<td >' . $row['address']  . '</td>';
    echo '<td >' . $row['priority']  . '</td>';
?>
<td width="5%"><a href="ht010evententry.php<?php echo '?eventno='.$row['eventno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?php
if ($login_session == "admin") {
?>
<td width="5%"><a href="ht010evententry.php<?php echo '?eventno='.$row['eventno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
}
echo '</tr>'; 
}

?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
	
<script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,select,button,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
    </script>
</body>

</html>
