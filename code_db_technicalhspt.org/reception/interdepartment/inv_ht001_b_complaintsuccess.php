<?php
include 'globalfile.php';
$GLOBALS ['xDate']=$GLOBALS ['xCurrentDate'];
$GLOBALS ['xCompletedDate']=$GLOBALS ['xCurrentDate'];
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
if ( isset( $_GET['complaintno'] ) && !empty( $_GET['complaintno'] ) )
{
  $no= $_GET['complaintno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['complaintno']);
   }
}

if (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}


function DataFetch($xComplaintNo) {
    $result = mysql_query ( "SELECT *  FROM t_complaint where complaintno=$xComplaintNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xComplaintNo'] = $row ['complaintno'];
		$GLOBALS ['xAmount'] = $row ['amount'];
		$GLOBALS ['xRemarks'] = $row ['remarks'];
		$GLOBALS ['xCompletedDate'] = $row ['completeddate'];
		$GLOBALS ['xStatus'] = $row ['status'];
	        $GLOBALS ['xBillNo'] = $row ['billno'];
		$GLOBALS ['xBillDetails'] = $row ['billdetails'];
	}
	}
}

function DataProcess($mode) {
$xCurrentDateTime=$GLOBALS ['xCurrentDateTime'];
$xComplaintNo= $_POST ['f_complaintno'];
if (empty ( $_POST ['f_amount'] )) 
 {
 	$xAmount= 0;
 } 
else 
 {
  $xAmount= $_POST ['f_amount'];
 }
$xStatus= $_POST ['f_status'];
$xRemarks= $_POST ['f_remarks'];
$xCompletedDate= $_POST ['f_completeddate'];
$xBillNo= $_POST ['f_billno'];
$xBillDetails= $_POST ['f_billdetails'];
$xQry="";
if ($mode == 'U')
{
$xQry = "UPDATE t_complaint   SET 
status='$xStatus',amount=$xAmount,remarks='$xRemarks',completeddate='$xCompletedDate',billno='$xBillNo',billdetails='$xBillDetails',paymentstatus='NOT-PAID',updatedason='$xCurrentDateTime' WHERE complaintno=$xComplaintNo";
} 
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script type="text/javascript">
function validateForm() 
 {
 
 var xComplaintNo= document.forms["complaintform"]["f_complaintno"].value;

 if (xComplaintNo== null || xComplaintNo== "") 
    {
        alert("Complaint To be Edited");
        return false;
    }
}
</script>
</head>
<body onload='document.complaintform.f_remarks.focus()'>
<form class="form" name="complaintform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel-body">
<div class="col-xs-3">
      <label>COMPLAINT-NO</label>

<input type="text" class="form-control" id="f_complaintno" name="f_complaintno" value="<?php echo $GLOBALS ['xComplaintNo']; ?>"readonly>
</div>	
<div class="col-xs-3">
<label>COMPLETED DATE</label>
<?php
if ($login_session == "admin") {
?>
<input type="date" class="form-control" id="txtDate" name="f_completeddate"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="">
<?php
} else {
?>
<input type="date" class="form-control" id="txtDate" name="f_completeddate"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" readonly>
<?php
}
?>
</div>

<div class="col-xs-6">
<label>COMPLETED REMARKS</label>
	<input type="text" class="form-control"  maxlength="250" name="f_remarks" value="<?php echo $GLOBALS ['xRemarks']; ?>">
</div>


<div class="col-xs-2">
<label>BILL NO </label>
<input type="text" class="form-control"  maxlength="25" name="f_billno" value="<?php echo $GLOBALS ['xBillNo']; ?>">
</div>
<div class="col-xs-6">
<label>BILL DETAILS</label>
<input type="text" maxlength="100" class="form-control"  name="f_billdetails" value="<?php echo $GLOBALS ['xBillDetails']; ?>">
</div>
<div class="col-xs-2">
<label>COMPLAINT STATUS</label>
   <select class="form-control"  value="" name="f_status">
	<option value="Completed" <?php if( $GLOBALS ['xStatus']=="Completed") echo 'selected="selected"'; ?>>Completed</option>
	<option value="Cancelled" <?php if( $GLOBALS ['xStatus']=="Cancelled") echo 'selected="selected"'; ?>>Cancelled</option>
   </select>
</div>


<div class="col-xs-2">
<label>AMOUNT</label>
	<input type="text" class="form-control"  maxlength="10" name="f_amount" value="<?php echo $GLOBALS ['xAmount']; ?>"  min="-999" max="9999"/>
</div>
</div>
</div>
<div class="panel-footer clearfix">
   <div class="pull-right">
              <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE"  onclick="return validateForm()" > 
    </div>
</div>
		</form>
</div>
</body>
</html>
</body>
</html>

<div class="panel panel-success">
<div class="panel-heading text-center">VIEW-COMPLAINT SUCCESS ENTRIES</div>
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
           <th width="10%">DATE</th>
           <th width="5%">COMP.NO</th>
           <th width="10%"> ITEM </th>
           <th width="10%"> STOCKPOINT </th>
           <th width="20%"> DESCRIPTION</th>
           <th width="7%"> AMOUNT</th>
           <th width="8%"> STATUS</th>
           <th width="15%"> REMARKS</th>
           <th width="10%"> COMPLETED</th>
           <th width="10%"> BILLNO</th>
<th colspan="2" width="5%">EDIT</td>
        </tr>
      </thead>
      <tbody>

<?php

$xQry='';
$xSlNo=0;

$xQry="SELECT *  from t_complaint where status='Processing' or completeddate>='$xFromDate' and completeddate<='$xToDate'  order by  complaintno desc "; 
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    if($row['paymentstatus']=='NOTPAID')
     {
      echo '<tr bgcolor=yellow>';
     }
else
{
    echo '<tr>';
}
    $xSlNo+=1;
    echo '<td>' . $xSlNo  . '</td>';
    finditemname($row['itemno']);
    findstockpointname($row['stockpointno']);
    echo '<td>' . date(' d/M/y', strtotime($row['date']))  . '</td>';
    echo '<td>' . $row['complaintno']  . '</td>';
?>
<td><a href="inv_hr001_a_oldcomplaints.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    echo '<td>' . $GLOBALS['xStockPointShortName']  . '</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';
    echo '<td align=right> Rs.' . $row['amount']  .'</td>';
    echo '<td>' . $row['status']  . '</td>';
    echo '<td>' . $row['remarks']  . '</td>';
    echo '<td>' . date('d/M/y',strtotime( $row['completeddate']))  . '</td>';
    echo '<td>' . $row['billno']  . '</td>';
   
?>
<td><a href="inv_ht001_b_complaintsuccess.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
	
</div>
</div>
</div>
<!-- Report Ended Here !-->