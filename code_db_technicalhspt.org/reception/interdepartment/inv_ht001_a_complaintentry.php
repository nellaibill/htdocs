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
	while ( $row = mysql_fetch_array ( $result ) ) 
         {

	        $GLOBALS ['xComplaintNo'] = $row ['complaintno'];
 		$GLOBALS ['xItemNo'] = $row ['itemno'];
	        $GLOBALS ['xDate'] = $row ['date'];
	        $GLOBALS ['xComplaintDescription'] = $row ['complaintdescription'];
 	        $GLOBALS ['xComplaintBy'] = $row ['complaintby'];
 		$GLOBALS ['xContactPerson'] = $row ['contactperson'];
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
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO t_complaint( complaintno,itemno,stockpointno,itemcategoryno,itemgroupno,itemsubgroupno,date,complaintdescription,complaintby,contactperson,status,createdason,updatedason)values ($xComplaintNo,$xItemNo,$xStockPointNo,$xItemCategoryNo,$xItemGroupNo,$xItemSubGroupNo,'$xDate','$xComplaintDescription','$xComplaintBy','$xContactPerson','Processing','$xCurrentDateTime','$xCurrentDateTime')";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE t_complaint   SET itemno=$xItemNo,stockpointno=$xStockPointNo,itemcategoryno=$xItemCategoryNo,itemgroupno=$xItemGroupNo,itemsubgroupno=$xItemSubGroupNo,date='$xDate',complaintdescription='$xComplaintDescription',complaintby='$xComplaintBy',contactperson='$xContactPerson',status='Processing',updatedason='$xCurrentDateTime' WHERE complaintno=$xComplaintNo";

} 
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}
else
{
    echo "Please Note the Complaint Registration No -".$xComplaintNo;
    GetMaxIdNo();
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>COMPLAINT-ENTRY </title>
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript">
function validateForm() 
 {
 
 var xItemName= document.forms["complaintform"]["f_itemno"].value;
 var xDate= document.forms["complaintform"]["f_date"].value;
 var xComplaintDescription= document.forms["complaintform"]["f_complaintdescription"].value;
 var xComplaintBy= document.forms["complaintform"]["f_complaintby"].value;
 var xContactPerson= document.forms["complaintform"]["f_contactperson"].value;
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
        <h3 class="panel-title text-center">COMPLAINT -ENTRY</h3>
</div>
<div class="panel-body">
<form class="form" name="complaintform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
 <div class="form-group" >
<div class="col-xs-3">
      <label>COMPLAINT-NO</label>

<input type="text" class="form-control" id="f_complaintno" name="f_complaintno" value="<?php echo $GLOBALS ['xComplaintNo']; ?>"readonly>
</div>			
<div class="col-xs-4">
<label>CHOOSE ITEM FOR COMPLAINT</label>
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
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" readonly>
<?php
}
?>
	 </div>
<div class="col-xs-5">
<label>COMPLAINT - DETAILS</label>
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

<!-- Report Started Here !-->
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center"> VIEW COMPLAINT ENTRIES </h3>
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
           <th width="13%"> CONTACTPERSON</th>
<th colspan="3" width="5%">Actions</td>
        </tr>
      </thead>
      <tbody>

<?php

$xQry='';
$xSlNo=0;

$xQry="SELECT *  from t_complaint where date='$xReportDate' order by  complaintno desc "; 
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
    echo '<td>' . $row['complaintno']  . '</td>';
?>
<td><a href="inv_hr001_a_oldcomplaints.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    findstockpointname($row['stockpointno']);
    echo '<td>' . $GLOBALS['xStockPointShortName']  . '</td>';
    echo '<td>' .date('d/m/y',strtotime( $row['date']))  . '</td>';
    echo '<td>' . $row['complaintdescription']  . '</td>';
    echo '<td>' . $row['complaintby']  . '</td>';
    echo '<td>' . $row['contactperson']  . '</td>';

?>
<td><a href="inv_ht001_a_complaintentry.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht001_e_complaintmail.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false">
  <img src="../images/mail.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="ht001_f_complaintsms.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false">
  <img src="../images/sms.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
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