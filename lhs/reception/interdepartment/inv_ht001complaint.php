<?php
include 'globalfile.php';
$GLOBALS ['xDate']=$GLOBALS ['xCurrentDate'];
$GLOBALS ['xCompletedDate']=$GLOBALS ['xCurrentDate'];
$xReportDate=$GLOBALS ['xCurrentDate'];
if ( isset( $_GET['complaintno'] ) && !empty( $_GET['complaintno'] ) )
{
  $no= $_GET['complaintno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['complaintno']);
   }
   else
   {
      $xQry = "DELETE FROM t_complaint WHERE complaintno= $no";
      mysql_query ( $xQry );
      header('Location: inv_ht001complaint.php'); 	
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


function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(complaintno)IS NULL OR max(complaintno)= '' 
       THEN '1' 
       ELSE max(complaintno)+1 END AS complaintno
FROM t_complaint";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xComplaintNo'] = $row ['complaintno'];
	}
}

function DataFetch($xComplaintNo) {
    $result = mysql_query ( "SELECT *  FROM t_complaint where complaintno=$xComplaintNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xComplaintNo'] = $row ['complaintno'];
 		$GLOBALS ['xItemNo'] = $row ['itemno'];
	        $GLOBALS ['xDate'] = $row ['date'];
	        $GLOBALS ['xComplaintDescription'] = $row ['complaintdescription'];
 	        $GLOBALS ['xComplaintBy'] = $row ['complaintby'];
 		$GLOBALS ['xContactPerson'] = $row ['contactperson'];
		$GLOBALS ['xAmount'] = $row ['amount'];
		$GLOBALS ['xRemarks'] = $row ['remarks'];
		$GLOBALS ['xCompletedDate'] = $row ['completeddate'];
		$GLOBALS ['xPaymentStatus'] = $row ['paymentstatus'];
		$GLOBALS ['xStatus'] = $row ['status'];
	        $GLOBALS ['xBillNo'] = $row ['billno'];
		$GLOBALS ['xBillDetails'] = $row ['billdetails'];
	}
	}
}

function DataProcess($mode) {
$xCurrentDateTime=$GLOBALS ['xCurrentDateTime'];
$xComplaintNo= $_POST ['f_complaintno'];
$xItemNo= $_POST ['f_itemno'];
finditemname($xItemNo);
$xStockPointNo= $GLOBALS['xStockPointNo'];
$xItemCategoryNo= $GLOBALS['xItemCategoryNo'];
$xItemGroupNo= $GLOBALS['xItemGroupNo'];
$xItemSubGroupNo= $GLOBALS['xItemSubGroupNo'];
$xDate= $_POST ['f_date'];
$xComplaintDescription= $_POST ['f_complaintdescription'];
$xComplaintBy= $_POST ['f_complaintby'];
$xContactPerson= $_POST ['f_contactperson'];
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
$xPaymentStatus= $_POST ['f_paymentstatus'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO t_complaint  VALUES ($xComplaintNo,$xItemNo,$xStockPointNo,$xItemCategoryNo,$xItemGroupNo,$xItemSubGroupNo,'$xDate','$xComplaintDescription','$xComplaintBy','$xContactPerson',$xAmount,'$xStatus','$xRemarks','$xCompletedDate','$xBillNo','$xBillDetails','$xPaymentStatus',createdason='$xCurrentDateTime',updatedason='$xCurrentDateTime')";
    echo '<script language="javascript">';
    echo 'alert("Inserted")';
    echo '</script>';
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE t_complaint   SET itemno=$xItemNo,stockpointno=$xStockPointNo,itemcategoryno=$xItemCategoryNo,itemgroupno=$xItemGroupNo,itemsubgroupno=$xItemSubGroupNo,date='$xDate',complaintdescription='$xComplaintDescription',complaintby='$xComplaintBy',contactperson='$xContactPerson',
status='$xStatus',amount=$xAmount,remarks='$xRemarks',completeddate='$xCompletedDate',billno='$xBillNo',billdetails='$xBillDetails',paymentstatus='$xPaymentStatus',updatedason='$xCurrentDateTime' WHERE complaintno=$xComplaintNo";
    echo '<script language="javascript">';
    echo 'alert("Updated")';
    echo '</script>';
      header('Location: inv_hr001complaints.php'); 
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM t_complaint   WHERE complaintno=$xComplaintNo";
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
<title>Complaint Entry</title>
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript">
function validateForm() 
 {
 
 var xItemName= document.forms["complaintform"]["f_itemno"].value;
 var xDate= document.forms["complaintform"]["f_date"].value;
 var xComplaintDescription= document.forms["complaintform"]["f_complaintdescription"].value;
 var xComplaintBy= document.forms["complaintform"]["f_complaintby"].value;
 var xContactPerson= document.forms["complaintform"]["f_contactperson"].value;
 var xAmount= document.forms["complaintform"]["f_amount"].value;

 if (xItemName== null || xItemName== "") 
    {
        alert("Item-Name must be filled out");
        document.complaintform.f_itemno.focus();
        return false;
    }

 if (xDate== null || xDate== "") 
    {
        alert("Date must be filled out");
        document.complaintform.f_date.focus();
        return false;
    }
 if (xComplaintDescription== null || xComplaintDescription== "") 
    {
        alert("ComplaintDescription must be filled out");
        document.complaintform.f_complaintdescription.focus();
        return false;
    }
 if (xComplaintBy== null || xComplaintBy== "") 
    {
        alert("ComplaintBy must be filled out");
        document.complaintform.f_complaintby.focus();
        return false;
    }
 if (xContactPerson== null || xContactPerson== "") 
    {
        alert("ContactPerson must be filled out");
        document.complaintform.f_contactperson.focus();
        return false;
    }

}
</script>
</head>
<body onload='document.complaintform.f_itemname.focus()'>
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">Complaint Entry</h3>
</div>
<div class="panel-body">
<form class="form" name="complaintform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
 <div class="form-group" >
<div class="col-xs-3">
      <label>COMPLAINT-NO</label>

<input type="text" class="form-control" id="f_complaintno" name="f_complaintno" value="<?php echo $GLOBALS ['xComplaintNo']; ?>" readonly>
</div>			
<div class="col-xs-4">
<label>CHOOSE ITEM</label>
	<select class="form-control"  value="" name="f_itemno"  >
            <?php
            $result = mysql_query("SELECT *  FROM m_item where itemno!=0 and stockpointno!=31 order by LENGTH(itemname),itemname");
            while($row = mysql_fetch_array($result))
           {
           findstockpointname($row['stockpointno']);
             ?>

      <option value = "<?php echo $row['itemno']; ?>" 
            <?php
                if ($row['itemno']== $GLOBALS ['xItemNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['itemname']." [" . $GLOBALS ['xStockPointShortName'] ."]" ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
<!--<input type="text" class="search" id="searchid" placeholder="Search for Website" />
<div id="result"></div>!-->
</div>
	<div class="col-xs-3">
<label>DATE(M/D/Y)</label>
<?php
if ($login_session == "admin") {
?>
<input type="date" class="form-control" id="txtDate" name="f_date"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="">
<?php
} else {
?>
<input type="date" class="form-control" id="txtDate" name="f_date"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" >
<?php
}
?>
	 </div>
<div class="col-xs-5">
<label>DESCRIPTION</label>
<input type="text" class="form-control"  name="f_complaintdescription" value="<?php echo $GLOBALS ['xComplaintDescription']; ?>" >
</div>
<div class="col-xs-3">
<label>COMPLAINT BY</label>
<input type="text" class="form-control"  name="f_complaintby" value="<?php echo $GLOBALS ['xComplaintBy']; ?>">
</div>								                 
		
<div class="col-xs-3">
<label>CONTACT PERSON</label>
  <input type="text" class="form-control"  name="f_contactperson" value="<?php echo $GLOBALS ['xContactPerson']; ?>" >
</div>
</div></div>
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">Complaint Success Entry</h3>
</div>
<div class="panel-body">

<div class="col-xs-6">
<label>REMARKS</label>
	<input type="text" class="form-control"  name="f_remarks" value="<?php echo $GLOBALS ['xRemarks']; ?>">
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
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" >
<?php
}
?>
</div>
<div class="col-xs-2">
<label>BILL NO </label>
<input type="text" class="form-control"  name="f_billno" value="<?php echo $GLOBALS ['xBillNo']; ?>">
</div>
<div class="col-xs-6">
<label>BILL DETAILS</label>
<input type="text" class="form-control"  name="f_billdetails" value="<?php echo $GLOBALS ['xBillDetails']; ?>">
</div>
<div class="col-xs-2">
<label>COMPLAINT STATUS</label>
   <select class="form-control"  value="" name="f_status">
	<option value="Processing"<?php if($GLOBALS ['xStatus']=="Processing") echo 'selected="selected"'; ?>>Processing</option>
	<option value="Completed" <?php if( $GLOBALS ['xStatus']=="Completed") echo 'selected="selected"'; ?>>Completed</option>
	<option value="Cancelled" <?php if( $GLOBALS ['xStatus']=="Cancelled") echo 'selected="selected"'; ?>>Cancelled</option>
   </select>
</div>


<div class="col-xs-2">
<label>AMOUNT</label>
	<input type="number" class="form-control"  name="f_amount" value="<?php echo $GLOBALS ['xAmount']; ?>"  min="-999" max="999999"/>
</div>
<div class="col-xs-2">
<label>PAYMENT STATUS</label>
 <select class="form-control"  value="" name="f_paymentstatus">
	<option value="NOT-PAID" <?php if( $GLOBALS ['xPaymentStatus']=="NOTPAID") echo 'selected="selected"'; ?>>NOTPAID</option>
	<option value="PAID"<?php if($GLOBALS ['xPaymentStatus']=="PAID") echo 'selected="selected"'; ?>>PAID</option>
   </select>
</div>
</div>
</div>
<div class="panel-footer clearfix">
   <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE"  > 
           <? }  ?>
        </div>
</div>
		</form>
</div>
</body>
</html>
</body>
</html>

