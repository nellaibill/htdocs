
<?php
/*
if(date('G')>=9 && date('G')<=11)
{
    // show your code/site/content.
}
else
{
    // Show the "Come back during opening hours..." sign.
}
*/
include 'globalfile.php';
$GLOBALS ['xCurrentUser'] = $login_session;
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
$GLOBALS ['xMode'] = '';

if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
 {
  $no= $_GET['txno'];
  if($_GET['xmode']=='edit')
  {
  $GLOBALS ['xMode']='F';
  DataFetch ( $no);
  }
  else
   {
     $xQry = "DELETE FROM outpatientdetails  WHERE txno= $no";
     mysql_query ( $xQry );
     header('Location: hr001outpatient.php'); 	
   }
 }
 else if( isset( $_GET['pat_id'] ) && !empty( $_GET['pat_id'] ) )
 {
     
    LoadPatientData($_GET['pat_id'] );
     GetMaxIdNo ();
 }
 
else
{
GetMaxIdNo ();
}

if (isset ( $_POST ['save'] ))
{
DataProcess ( "S" );
}  
elseif (isset ( $_POST ['update'] )) 
{
DataProcess ( "U" );
}
function LoadPatientData($xPatId)
{
    $xQry = "select *  from m_patientregistration where pat_id=".$xPatId;
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
     $GLOBALS ['xPatUniqueId'] =$row ['pat_unique_id'] ;
     $GLOBALS ['xPatientName'] =$row ['pat_name'] ;
     //$GLOBALS ['xAge'] =ageCalculator($row ['pat_dob']);
    $GLOBALS ['xAge'] ='';
     $GLOBALS ['xPlace']=$row ['pat_address'] ;
     $GLOBALS ['xSex']=$row ['pat_gender'] ;
     $GLOBALS ['xDMY']="YEARS";
}
}
function GetMaxIdNo() {
$xQry="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM outpatientdetails_new";
$result = mysql_query ($xQry) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) 
	{
	$GLOBALS ['xIdno'] = $row ['txno'];
	$GLOBALS ['xMaxId'] = $row ['txno'];
}
 }

function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}

function DataClear() {
$GLOBALS ['xIdno'] = "";
$GLOBALS ['xPatientName'] = "";
$GLOBALS ['xSickNote'] = "";
$GLOBALS ['xDoctorNo'] = "";
$GLOBALS ['xCaseType'] = "";
$GLOBALS ['xCaseType1'] = "";
$GLOBALS ['xTokenNo'] = "";
$GLOBALS ['xAge'] = "";
$GLOBALS ['xDMY'] = "";
$GLOBALS ['xSex'] = "";
$GLOBALS ['xPlace'] = "";
$GLOBALS ['xFees'] = "";
$GLOBALS ['xDoctorNote'] = "";
$GLOBALS ['xPaymentStatus'] = "";
$GLOBALS ['xStatus'] = "";
}

function DataFetch($xTxno) {
$GLOBALS ['xMode']='F';
$result = mysql_query ( "SELECT *  FROM outpatientdetails_new where txno=$xTxno" ) or die ( mysql_error () );
$count = mysql_num_rows ( $result );
if ($count > 0)
	   {
	while ( $row = mysql_fetch_array ( $result ) ) 
				{
		if (($row ['date'] == date ( 'Y-m-d' ) or ($GLOBALS ['xCurrentUser'] == 'admin'))) 
		{
	
		$GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xNoonType'] = $row ['noontype'];
		$GLOBALS ['xPatientName'] = $row ['patientname'];
		$GLOBALS ['xSickNote'] = $row ['sicknote'];
		$GLOBALS ['xDoctorNo'] = $row ['doctorname'];
		$GLOBALS ['xCaseType'] = $row ['casetype'];
		$GLOBALS ['xCaseType1'] = $row ['casetype1'];
		$GLOBALS ['xTokenNo'] = $row ['tokenno'];
		$GLOBALS ['xAge'] = $row ['age'];
		$GLOBALS ['xDMY'] = $row ['dmy'];
		$GLOBALS ['xSex'] = $row ['sex'];
		$GLOBALS ['xPlace'] = $row ['place'];
		$GLOBALS ['xFees'] = $row ['fees'];
		$GLOBALS ['xDoctorNote'] = $row ['doctornote'];
		$GLOBALS ['xPaymentStatus'] = $row ['paymentstatus'];
		$GLOBALS ['xStatus'] = $row ['status'];
		$GLOBALS ['xPatUniqueId']=$row ['pat_unique_id'];
		} 
		else {
			GetMaxIdNo ();
			$xMsg="Sorry date is Not Matched";
			ShowAlert($xMsg);
		      }
	  }
} 
}

function DataProcess($xMode) {
$xPrintLink='';
$xTxno = $_POST ['txno'];
$xPatUniqueId = $_POST ['f_pat_unique_id'];
$xDate = $_POST ['date'];
$xNoonType= $_POST ['noontype'];
$xPatientName = strtoupper($_POST ['patientname']);
$xDoctorName = $_POST ['doctorname'];
$xCaseType = $_POST ['casetype'];
$xCaseType1 = $_POST ['casetype1'];
$xTokenNo = $_POST ['tokenno'];
$xDMY= $_POST ['dmy'];
$xCurrentDateTime=$GLOBALS ['xCurrentDateTime'];
$xSex = $_POST ['sex'];

if (empty ( $_POST ['age'] )) {
	$xAge = 0;
} else {
	$xAge = $_POST ['age'];
}
if (empty ( $_POST ['fees'] )) {
	$xFees = 0;
} else {
	$xFees = $_POST ['fees'];
}
if (empty ( $_POST ['doctornote'] )) {
	$xDoctorNote = '';
} else {
	$xDoctorNote = $_POST ['doctornote'];
}

if (empty ( $_POST ['doctornote'] )) 
	{
	$xSickNote = '';
} else {
	$xSickNote = $_POST ['sicknote'];
}

if (empty ( $_POST ['doctornote'] )) {
	$xPlace = '';
} else {
	$xPlace = $_POST ['place'];
}

$xPaymentStatus = $_POST ['paymentstatus'];
$xStatus = $_POST ['status'];
$xCurrentDateOnly=date('Y-m-d');
if ($xMode == 'S') 
{
	$sql = "INSERT INTO outpatientdetails_new VALUES (
			$xTxno ,$xTokenNo,'$xCurrentDateOnly','$xNoonType', '$xPatientName' ,'$xCaseType',
			'$xCaseType1','$xSickNote','$xDoctorName',$xAge,'$xDMY','$xSex','$xPlace',$xFees,
			'$xDoctorNote','$xPaymentStatus','$xStatus','$xCurrentDateTime','$xCurrentDateTime','$xPatUniqueId'
				  )";
	$retval = mysql_query ( $sql ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	GetMaxIdNo ();
        $xMsg="Inserted";
        $xPrintLink= "<script>window.open('hp001outpatient.php?txno=$xTxno')</script>";
} 
elseif ($xMode == 'U') 
{
	       $xDate = $_POST ['date'];
               $sql = "UPDATE outpatientdetails_new SET  
				date='$xDate',noontype='$xNoonType',patientname='$xPatientName' ,
				casetype='$xCaseType',casetype1='$xCaseType1',sicknote='$xSickNote',
				doctorname='$xDoctorName',age=$xAge,dmy='$xDMY',sex='$xSex',
				place='$xPlace',fees=$xFees,doctornote='$xDoctorNote',
				paymentstatus='$xPaymentStatus',status='$xStatus',updatedason='$xCurrentDateTime',pat_unique_id='$xPatUniqueId' WHERE txno=$xTxno";
		$retval = mysql_query ( $sql ) or die ( mysql_error () );
		if (! $retval) {
		die ( 'Tx.No Not Found: ' . mysql_error () );
		 }
	        $GLOBALS ['xIdno'] = $xTxno;
                //GetMaxIdNo ();
                $xPrintLink= "<script>window.open('hp001outpatient.php?txno=$xTxno')</script>";
	        $xMsg="Updated";
} 
elseif ($xMode == 'D') 
{
	$sql = "DELETE FROM outpatientdetails_new  WHERE txno=$xTxno";
	$retval = mysql_query ( $sql ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Tx.No Not Found: ' . mysql_error () );
	}
	$GLOBALS ['xIdno'] = $xTxno;
        $xMsg="Deleted";		
} 
ShowAlert($xMsg);
echo $xPrintLink;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>O/P ENTRY</title>
<script type="text/javascript">

function validateForm() {
var xPatientName= document.forms["outpatientdetails_new"]["patientname"].value;
var xDoctorName= document.forms["outpatientdetails_new"]["doctorname"].value;
var xTokenNo= document.forms["outpatientdetails_new"]["tokenno"].value;

if (xDoctorName== "CHOOSE DOCTOR HERE") {
	alert("Please Choose a Doctor");
document.outpatientdetails_new.doctorname.focus();
	return false;
}

if (xTokenNo== null || xTokenNo== "") {
	alert("Please Generte a Token");
document.outpatientdetails_new.casetype.focus();
	return false;
}

if (xPatientName== null || xPatientName== "") {
	alert("Patient Name must be filled out");
document.outpatientdetails_new.patientname.focus();
	return false;
}


}

function GetMaxTokenNo(str) {
document.getElementById('xTokenNo').value="";
var xDoctorName=document.getElementById("doctorname").value;
var xDate = document.getElementById("txtDate").value;
var xCaseType= document.getElementById("casetype").value;
var xNoonType= document.getElementById("noontype").value;
var xMode = <?php echo json_encode($GLOBALS ['xMode']); ?>;
if(xMode=='F')
{
var strconfirm = confirm("Token No Could Not Change Or Cancelled this Token Make New One ");
if (strconfirm == true)
		{
			return false;
		}
}

if (xDate== null || xDate== "") {
	alert("Date must be filled out");
	return false;
}
if (str=="") {
document.getElementById("xTokenNo").innerHTML="";
return;
} 
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
} else { // code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200) {
document.getElementById('xTokenNo').value=xmlhttp.responseText;
}
}

xmlhttp.open("GET","getmaxtokenno.php?doctorname="+xDoctorName+"&date="+xDate+"&casetype="+xCaseType+"&noontype="+xNoonType+"&mode="+xMode, true);
xmlhttp.send();
}

function PrintDiv() {    
   var divToPrint = document.getElementById('divToPrint');
   var popupWin = window.open('', '_blank', 'width=500,height=500');
   popupWin.document.open();
   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
	popupWin.document.close();
		}
</script>

</head>
<body onload='document.outpatientdetails_new.patientname.focus()'>
<form class="form" name="outpatientdetails_new" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-primary">
<div class="panel-heading text-center">
        <h3 class="panel-title">OUT-PATIENT ENTRY</h3>
</div>
<div class="panel-body">

<div class="form-group" style="display: none;">
<label for="lbltxno" class="control-label col-xs-3">OP-NUMBER</label>
	<div class="col-xs-3">
		<input type="text" class="form-control" id="xIdNo" name="txno" value="<?php echo $GLOBALS ['xIdno']; ?>" readonly>
	</div>
</div>
<center><h1>HOSPITAL ID [ <?php echo   $GLOBALS ['xPatUniqueId']; ?> ] </h1></center>
		<div class="form-group">
		    	<div class="col-xs-3" style="display:none">
					<label>HOSPITAL ID</label>
						<input type="text" class="form-control" id="txtPatient"
							name="f_pat_unique_id" maxlength="50"
							value="<?php echo $GLOBALS ['xPatUniqueId']; ?>" readonly>
					</div>
		    		<div class="col-xs-3">
					<label>PATIENT NAME</label>
						<input type="text" class="form-control" id="txtPatient"
							name="patientname" maxlength="50"
							value="<?php echo $GLOBALS ['xPatientName']; ?>" readonly>
					</div>
					<div class="col-xs-3" style="display:none">
			<label>AGE</label>
						<input type="text" class="form-control" id="xAge" name="age" 
							maxlength="3" value="<?php echo $GLOBALS ['xAge']; ?>" >

					</div>
<div class="col-xs-3" style="display:none">
			<label>DMY</label>
						<select class="form-control" id="sel1" value="" name="dmy" readonly>
							<option value="DAYS"
								<?php if($GLOBALS ['xDMY']=="DAYS") echo 'selected="selected"'; ?>>DAYS</option>
							<option value="MONTHS"
								<?php if( $GLOBALS ['xDMY']=="MONTHS") echo 'selected="selected"'; ?>>MONTHS</option>
						<option value="YEARS"
								<?php if($GLOBALS ['xDMY']=="YEARS") echo 'selected="selected"'; ?>>YEARS</option>
						</select>

					</div>
					<div class="col-xs-3" style="display:none">
								<label>GENDER</label>
						<select class="form-control" id="sel1" value="" name="sex" readonly>
							<option value="MALE"
								<?php if($GLOBALS ['xSex']=="MALE") echo 'selected="selected"'; ?>>MALE</option>
							<option value="FEMALE"
								<?php if( $GLOBALS ['xSex']=="FEMALE") echo 'selected="selected"'; ?>>FEMALE</option>
						</select>

					</div>

				</div>
<div class="form-group">

	<div class="col-xs-3">
<label>DATE</label>

<?php

if ($login_session == "admin") {
?>
<input type="date" class="form-control" id="txtDate" name="date"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="">
<?php
} else {
?>
<input type="date" class="form-control" id="txtDate" name="date"
							value="<?php echo $GLOBALS ['xDate'];?>" placeholder="" readonly>
<?php
}
?>

</div>
<div class="col-xs-3">
<label>TOKEN NO</label>
<input type="text" class="form-control" id="xTokenNo" name="tokenno" value="<?php echo $GLOBALS ['xTokenNo']; ?>"  placeholder="" readonly>
</div>


<div class="form-group">
    
    
			<div class="col-xs-3">
			<label>DOCTOR NAME</label>
		 <select class="form-control" id="doctorname" value="" name="doctorname" onclick="GetMaxTokenNo()">
                 <?php
                 $result = mysql_query("SELECT *  FROM m_doctor where doctorno!=0 order by doctorno");
                 echo "<option value=''>CHOOSE DOCTOR HERE</option>";
                 while($row = mysql_fetch_array($result))
                {
                ?>
               <option value = "<?php echo $row['doctorno']; ?>" 
               <?php
                if ($row['doctorno']== $GLOBALS ['xDoctorNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['doctorname']; ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
</div>
<div class="col-xs-3">
<label>NOON TYPE</label>
		<select class="form-control" id="noontype" value="" name="noontype" onclick="GetMaxTokenNo()">
	          <option value="MORNING" <?php if($GLOBALS ['xNoonType']=="MORNING") echo 'selected="selected"'; ?>>MORNING</option>
	           <option value="EVENING" <?php if( $GLOBALS ['xNoonType']=="EVENING") echo 'selected="selected"'; ?>>EVENING</option>
               </select>
</div>
	
	<div class="col-xs-3">
	<label>CASE TYPE</label>
	
			<select class="form-control" id="casetype" value="" name="casetype" onclick="GetMaxTokenNo()" >
	<option value="GENERAL" <?php if($GLOBALS ['xCaseType']=="GENERAL") echo 'selected="selected"'; ?>>GENERAL</option>
	<option value="EMERGENCY" <?php if( $GLOBALS ['xCaseType']=="EMERGENCY") echo 'selected="selected"'; ?>>EMERGENCY</option>
        <option value="OTHERS" <?php if( $GLOBALS ['xCaseType']=="OTHERS") echo 'selected="selected"'; ?>>OTHERS</option>
                        </select>
		</div>
</div>

				<div class="form-group">

	
					<div class="col-xs-3">
					<label>CASE TYPE-1</label>
						<select class="form-control" id="sel1" value="" name="casetype1">
<option value="NONE"
								<?php if( $GLOBALS ['xCaseType1']=="NONE") echo 'selected="selected"'; ?>>NONE</option>
							<option value="INJECTION"
								<?php if($GLOBALS ['xCaseType1']=="INJECTION") echo 'selected="selected"'; ?>>INJECTION</option>
					
							<option value="URINETEST"
								<?php if( $GLOBALS ['xCaseType1']=="URINETEST") echo 'selected="selected"'; ?>>URINETEST</option>

<option value="WARDCASE"
								<?php if( $GLOBALS ['xCaseType1']=="WARDCASE") echo 'selected="selected"'; ?>>WARDCASE</option>

<option value="ANC"
								<?php if( $GLOBALS ['xCaseType1']=="ANC") echo 'selected="selected"'; ?>>ANC</option>


						</select>
					</div>
				</div>
				<div class="form-group">
						
					
				<!--	<div class="col-xs-6">
								<label>SICK NOTE</label>
						<input type="text" class="form-control" id="txtSickNote"
							name="sicknote" value="<?php echo $GLOBALS ['xSickNote']; ?>"
							placeholder="Headache behind right eye">
					</div>!-->
				</div>

		
									<div class="col-xs-3">
										<label>FEES</label>
<?php

if ($login_session == "admin") {
?>
<input type="text" class="form-control" id="txtFees" name="fees" maxlength="3"
							value="<?php echo $GLOBALS ['xFees']; ?>">
<?php
} else {
?>
<input type="text" class="form-control" id="txtFees" name="fees" maxlength="3"
							value="<?php echo $GLOBALS ['xFees']; ?>">
<?php
}
?>

					
				</div>

				<div class="form-group">
					<div class="col-xs-3" style="display:none">
						<label>PLACE</label>
						<input type="text" class="form-control" id="txtPlace" maxlength="50"
							name="place" value="<?php echo $GLOBALS ['xPlace']; ?>"
							>
					</div>
				</div>
				<div class="form-group">



					<div class="col-xs-3">
	<label>PAYMENT-STATUS</label>
						<select class="form-control" id="xPayment" value=""
							name="paymentstatus">
							<option value="PAID"
								<?php if($GLOBALS ['xPaymentStatus']=="PAID") echo 'selected="selected"'; ?>>PAID</option>
							<option value="NOTPAID"
								<?php if( $GLOBALS ['xPaymentStatus']=="NOTPAID") echo 'selected="selected"'; ?>>NOTPAID</option>
					<option value="NOFEES"
								<?php if( $GLOBALS ['xPaymentStatus']=="NOFEES") echo 'selected="selected"'; ?>>NOFEES</option>
		
						</select>



					</div>

  <div class="col-xs-3">
  					<label> PATIENT-STATUS</label>
   <select class="form-control" id="xStatus" value="" name="status">
    <option value="PROCESSING" <?php if($GLOBALS ['xStatus']=="PROCESSING") echo 'selected="selected"'; ?>>PROCESSING</option>
    <option value="COMPLETED" <?php if( $GLOBALS ['xStatus']=="COMPLETED") echo 'selected="selected"'; ?>>COMPLETED</option>
    <option value="CANCELLED" <?php if( $GLOBALS ['xStatus']=="CANCELLED") echo 'selected="selected"'; ?>>CANCELLED</option>
   </select>
  </div>
</div>
<!--
				<div class="form-group">
					<div class="col-xs-6">
						<label>DOCTOR NOTE</label>
<?php
if ($login_session == "admin") {
?>
<input type="text" class="form-control" id="txtDoctorNote"
							name="doctornote" maxlength="100"
							value="<?php echo $GLOBALS ['xDoctorNote']; ?>" placeholder="">
<?php
} else {
?>
<input type="text" class="form-control" id="txtDoctorNote"
							name="doctornote" maxlength="100"
							value="<?php echo $GLOBALS ['xDoctorNote']; ?>" placeholder="" readonly>
<?php
}
?>
</div>

				</div>
				</br>!-->
</div></div></div>
<div class="panel-footer clearfix">
       <div class="pull-right">
               <input type="submit"  name="new"   class="btn btn-primary" value="NEW" > 
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
</div></br>

</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<?php
$xSlNo=1;
$xTotalAmount=0;
$xQry='';
$xQryFilter='';


$xCaseType=$GLOBALS ['xCaseType'];
$xNoonType=$GLOBALS ['xNoonType'];
$xCaseType1=$GLOBALS ['xCaseType1'];
$xDoctorNo=$GLOBALS ['xDoctorNo'];
$xStatus=$GLOBALS ['xOpStatus'];
if($xDoctorNo!="0")
{
$xQryFilter= $xQryFilter. ' ' . "and doctorname='$xDoctorNo'";
}
if($xNoonType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and noontype='$xNoonType'";
}
if($xCaseType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and casetype='$xCaseType'";
}
if($xCaseType1!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and casetype1='$xCaseType1'";
}
if($xStatus!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and status='$xStatus'";
}
 
$xDate1=$GLOBALS ['xCurrentDate'];
$xQry="SELECT txno,tokenno,patientname,doctorname,fees,casetype,casetype1,noontype,date,status,updatedason,pat_unique_id from outpatientdetails_new where date='$xDate1'"; 
$xQry.= $xQryFilter. ' ' . "order by  txno;";
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
?>
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="panel panel-primary">
<div class="panel-heading text-center"><?php echo "TODAY'S O/P COLLECTION DOCTOR[".$GLOBALS ['xDoctorName'] ."]  CASETYPE[".$GLOBALS ['xCaseType'] ."] CASETYPE1[".$GLOBALS ['xCaseType1'] ."]  NOON [".$GLOBALS ['xNoonType'] ."]STATUS [".$GLOBALS ['xOpStatus'] ."]" ?></div>
<div class="panel-body">
<div class="container">
<table class="table table-hover" border="1" >
      <thead>
      <tr>
			<th width="5%">SL.NO</th>
			<th width="8%">TOKEN NO</th>
			<th width="10%">UNIQUE ID</th>
			<th width="20%">PATIENT NAME</th>
			<th width="5%"> FEES</th>
			<th width="15%">CASE TYPE</th>
			<th width="10%">TIME</th>
                        <th width="5%">EDIT</th>
        </tr>
      </thead>
      <tbody class="searchable">
<?
$xNoonType='';
while ($row = mysql_fetch_array($result2)) {
$date = $row['updatedason'];
   finddoctorname($row['doctorname']);
   echo '<tr bgcolor="' . $GLOBALS['xColor'].  '">';
   if($row['noontype']=='MORNING')
     {
     $xNoonType='MOR';
     }
    else
    {
     $xNoonType='EVE';
    }
    echo '<td>' . $xSlNo  . '</td>';
    $xSlNo+=1;
    echo '<td  width=\"16%\" bgcolor=\"#CCCCCC\">' . $row['tokenno']  ."-".$xNoonType .  '</td>';
        echo '<td>' . $row['pat_unique_id']  . '</td>';
    echo '<td>' . $row['patientname']  . '</td>';
    echo '<td>' . $row['fees']  . '</td>';
$xTotalAmount+=$row['fees'];
    echo '<td>' . $row['casetype'] ."-".$row['casetype1'] . '</td>';
    echo '<td>' . date("h:i:s A",  strtotime($row['updatedason']))  . '</td>';
?>
<td><a href="ht001outpatient_new.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<?
}
  
?>
<tr style='font-weight:bold;'>
<td></td>
<td colspan="2"> GRAND TOTAL </td>
<?php  echo '<td>' . $xTotalAmount . '</td>'; ?>
<td></td>
<td></td>
<td></td>
</tr>		
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
</div>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
	</div>


</body>
</html>