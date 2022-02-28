<?php
include 'globalfile.php';
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
if ( isset( $_GET['amc_txno'] ) && !empty( $_GET['amc_txno'] ) )
{
  $no= $_GET['amc_txno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['amc_txno']);
   }
   else
   {
      $xQry = "DELETE FROM inv_amcentry WHERE amc_txno= $no";
      mysql_query ( $xQry ) or die ( mysql_error () );
      header('Location: inv_ht005_a_amcentry.php'); 	
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
$sql="SELECT  CASE WHEN max(amc_txno)IS NULL OR max(amc_txno)= '' 
       THEN '1' 
       ELSE max(amc_txno)+1 END AS amc_txno
FROM inv_amcentry";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xAmcTxNo'] = $row ['amc_txno'];
	}
}

function DataFetch($amctxno) {
    $result = mysql_query ( "SELECT *  FROM inv_amcentry where amc_txno=$amctxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
                $GLOBALS ['xAmcTxNo'] = $row ['amc_txno'];
 		$GLOBALS ['xAmcItemNo'] = $row ['amc_itemno'];
                $GLOBALS ['xAmcApprovalNo'] = $row ['amc_approvalno'];
                $GLOBALS ['xAmcMode'] = $row ['amc_mode'];
 		$GLOBALS ['xAmcStartDate'] = $row ['amc_startdate'];
                $GLOBALS ['xAmcEndDate'] = $row ['amc_enddate'];
                $GLOBALS ['xAmcReplacedSpares'] = $row ['amc_replacedspares'];
 		$GLOBALS ['xAmcEquipmentCurrentStatus'] = $row ['amc_equipmentcurrentstatus'];
                $GLOBALS ['xAmcDoneOn'] = $row ['amc_doneon'];
                $GLOBALS ['xAmcDoneBy'] = $row ['amc_doneby'];
                $GLOBALS ['xAmcNextVisitingDate'] = $row ['amc_nextvisitingdate'];
 		$GLOBALS ['xAmcModeOfPayment'] = $row ['amc_modeofpayment'];
                $GLOBALS ['xAmcAmount'] = $row ['amc_amount'];
 			}
	}
}

function DataProcess($mode) {
$xAmcTxNo= $_POST ['f_amctxno'];
$xAmcItemNo=$_POST ['f_amcitemno'];
$xAmcApprovalNo= $_POST ['f_amcapprovalno'];
$xAmcMode= $_POST ['f_modeofamc'];
$xAmcStartDate=$_POST ['f_amcstartdate'];
$xAmcEndDate= $_POST ['f_amcenddate'];
$xAmcReplaceSpares= $_POST ['f_amcreplacedspares'];
$xAmcEquipmentCurrentStatus=$_POST ['f_amcequipmentcurrentstatus'];
$xAmcDoneOn= $_POST ['f_amcdoneon'];
$xAmcDoneBy= $_POST ['f_amcdoneby'];
$xAmcNextVisitingDate=$_POST ['f_amcnextvisitingdate'];
$xAmcModeOfPayment= $_POST ['f_amcmodeofpayment'];
if (empty ( $_POST ['f_amcamount'] )) {
	$xAmcAmount= 0;
} else {
	$xAmcAmount= $_POST ['f_amcamount'];
}
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO inv_amcentry  VALUES ($xAmcTxNo,$xAmcItemNo,'$xAmcApprovalNo','$xAmcMode','$xAmcStartDate','$xAmcEndDate','$xAmcReplaceSpares','$xAmcEquipmentCurrentStatus','$xAmcDoneOn','$xAmcDoneBy','$xAmcNextVisitingDate','$xAmcModeOfPayment',$xAmcAmount)";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE inv_amcentry set amc_itemno=$xAmcItemNo,amc_approvalno='$xAmcApprovalNo',amc_mode='$xAmcMode',amc_startdate='$xAmcStartDate',amc_enddate='$xAmcEndDate',amc_replacedspares='$xAmcReplaceSpares',amc_equipmentcurrentstatus='$xAmcEquipmentCurrentStatus',amc_doneon='$xAmcDoneOn',amc_doneby='$xAmcDoneBy',amc_nextvisitingdate='$xAmcNextVisitingDate',amc_modeofpayment='$xAmcModeOfPayment',amc_amount=$xAmcAmount where amc_txno =$xAmcTxNo";
$xMsg="Updated";
header('Location: inv_ht005_a_amcentry.php'); 
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


<html>
<title>Amc-Entry</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">Amc-Entry Form</div>
<div class="panel-body">
<div class="form-group">


<div class="col-xs-2">
<label>Amc Tx No:</label>
<input type="text" class="form-control"  name="f_amctxno" value="<?php echo $GLOBALS ['xAmcTxNo']; ?>" readonly >
</div>

<div class="col-xs-3">
<label>Item:</label>
<select class="form-control"  value="" name="f_amcitemno"  >
<option value="0">Choose Item</option>
<?php $result = mysql_query("SELECT *  FROM m_item where amcrequired='Yes' order by itemname ");
  while($row = mysql_fetch_array($result))
   {?>
    <option value = "<?php echo $row['itemno']; ?>" 
     <?php
      //if ($row['itemno']== $GLOBALS ['xItemNo']){echo 'selected="selected"';} 
    ?> >
     <?php echo $row['itemname']; ?> 
    </option>
    <? } ?>
</select>
</div>

<div class="col-xs-3">
<label>Amc Approval No:</label>
<input type="text" class="form-control"  name="f_amcapprovalno" value="<?php echo $GLOBALS ['xAmcApprovalNo']; ?>" >
</div>

<div class="col-xs-3">
<label>Mode of Amc:</label>
               <select class="form-control"  name="f_modeofamc" >
	          <option value="Monthly" <?php if($GLOBALS ['xModeOfAmc']=="Monthly") echo 'selected="selected"'; ?>>Monthly</option>
	          <option value="Quartely" <?php if( $GLOBALS ['xModeOfAmc']=="Quartely") echo 'selected="selected"'; ?>>Quartely</option>
	          <option value="HalfYearly" <?php if($GLOBALS ['xModeOfAmc']=="HalfYearly") echo 'selected="selected"'; ?>>HalfYearly</option>
	          <option value="Yearly" <?php if( $GLOBALS ['xModeOfAmc']=="Yearly") echo 'selected="selected"'; ?>>Yearly</option>
	          <option value="Others" <?php if( $GLOBALS ['xModeOfAmc']=="Others") echo 'selected="selected"'; ?>>Others</option>
               </select>
</div>

<div class="col-xs-3">
<label>Start Date:</label>
<input type="date" class="form-control"  name="f_amcstartdate" value="<?php echo $GLOBALS ['xAmcStartDate']; ?>">
</div>

<div class="col-xs-3">
<label>End Date:</label>
<input type="date" class="form-control"  name="f_amcenddate" value="<?php echo $GLOBALS ['xAmcEndDate']; ?>">
</div>


<div class="col-xs-4">
<label>Replaced Spares:</label>
<input type="text" class="form-control"  name="f_amcreplacedspares" value="<?php echo $GLOBALS ['xAmcReplacedSpares']; ?>">
</div>


<div class="col-xs-4">
<label>Equipment Current Status:</label>
<input type="text" class="form-control"  name="f_amcequipmentcurrentstatus" value="<?php echo $GLOBALS ['xAmcEquipmentCurrentStatus']; ?>">
</div>


<div class="col-xs-3">
<label>Amc Done On</label>
<input type="date" class="form-control"  name="f_amcdoneon" value="<?php echo $GLOBALS ['xAmcDoneOn']; ?>">
</div>

<div class="col-xs-4">
<label>Amc Done By:</label>
<input type="text" class="form-control"  name="f_amcdoneby" value="<?php echo $GLOBALS ['xAmcDoneBy']; ?>">
</div>

<div class="col-xs-3">
<label>Next Visiting Date</label>
<input type="date" class="form-control"  name="f_amcnextvisitingdate" value="<?php echo $GLOBALS ['xAmcNextVisitingDate']; ?>">
</div>

<div class="col-xs-2">
<label>Mode Of Payment:</label>
<select class="form-control"  name="f_amcmodeofpayment" >
	          <option value="Cash" <?php if($GLOBALS ['xAmcModeOfPayment']=="Cash") echo 'selected="selected"'; ?>>Cash</option>
	          <option value="Cheque" <?php if( $GLOBALS ['xAmcModeOfPayment']=="Cheque") echo 'selected="selected"'; ?>>Cheque</option>
	          <option value="Others" <?php if( $GLOBALS ['xAmcModeOfPayment']=="Others") echo 'selected="selected"'; ?>>Others</option>
               </select>

</div>

<div class="col-xs-2">
<label>Amount:</label>
<input type="number" class="form-control"  name="f_amcamount" value="<?php echo $GLOBALS ['xAmcAmount']; ?>">
</div>


</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
</div><!-- Panel !-->
</form>

<hr>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<center><h3 id="headertext"> View- Amc Entries</h3></center>
<div id="divToPrint" >
<div class="container">
<table class="table table-hover" border="1" >
      <thead>
        <tr>
           <th width="5%">S.No</th>
           <th width="10%">Item Name</th>
           <th width="10%">Mode</th>
           <th width="10%">StartDate</th>
           <th width="10%">EndDate</th>
           <th width="10%">NextVis.Date</th>
           <th width="10%">ModeOfPayment</th>
           <th width="10%">Amount</th>
           <th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT *  from inv_amcentry"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $xSlNo+=1 . '</td>';
    finditemname( $row['amc_itemno'] );
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['amc_mode']  . '</td>';
    echo '<td>' . $row['amc_startdate']  . '</td>';
    echo '<td>' . $row['amc_enddate']  . '</td>';
    echo '<td>' . $row['amc_nextvisitingdate']  . '</td>';
    echo '<td>' . $row['amc_modeofpayment']  . '</td>';
    echo '<td>' . $row['amc_amount']  . '</td>';
       
?>
<td><a href="inv_ht005_a_amcentry.php<?php echo '?amc_txno='.$row['amc_txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht005_a_amcentry.php<?php echo '?amc_txno='.$row['amc_txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>

</html>	