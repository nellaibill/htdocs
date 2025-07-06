<?php
include 'globalfile.php';
IniSetup();
function IniSetup()
{
DataClear();
if ( isset( $_GET['doctorno'] ) && !empty( $_GET['doctorno'] ) )
{
  $no= $_GET['doctorno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['doctorno']);
   }
   else
   {
      $xQry = "DELETE FROM m_doctor WHERE doctorno= $no";
      mysql_query ( $xQry );
      header('Location: hm002docordetails.php'); 	
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
$GLOBALS ['xDoctorName']='';
$GLOBALS ['xMode']='';
}
function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(doctorno)IS NULL OR max(doctorno)= '' 
       THEN '1' 
       ELSE max(doctorno)+1 END AS doctorno
FROM m_doctor";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xtxno'] = $row ['doctorno'];
	}
}

function DataFetch($xtxno) {
    $result = mysql_query ( "SELECT *  FROM m_doctor where doctorno=$xtxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xtxno'] = $row ['doctorno'];
 		$GLOBALS ['xDoctorName'] = $row ['doctorname'];
 		$GLOBALS ['xSpecialist'] = $row ['specialist'];
 		$GLOBALS ['xStatus'] = $row ['status'];
 		$GLOBALS ['xMobileNo'] = $row ['mobileno'];
 		$GLOBALS ['xAddress'] = $row ['address'];
 		$GLOBALS ['xColor'] = $row ['color'];
	}
	}
}

function DataProcess($mode) {
$xTxNo= $_POST ['f_txno'];
$xDoctorName= strtoupper($_POST ['f_doctorname']);
$xSpecialist= strtoupper($_POST ['f_specialist']);
$xStatus= strtoupper($_POST ['f_status']);
$xMobileNo= strtoupper($_POST ['f_mobileno']);
$xAddress= strtoupper($_POST ['f_address']);
$xColor= $_POST ['f_color'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_doctor  VALUES ($xTxNo,'$xDoctorName','$xSpecialist','$xStatus',$xMobileNo,'$xAddress','$xColor')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_doctor   SET doctorname='$xDoctorName',specialist='$xSpecialist',status='$xStatus',mobileno='$xMobileNo',address='$xAddress' ,color='$xColor' WHERE doctorno=$xTxNo";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_doctor   WHERE doctorno=$xTxNo";
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
<title>CASE SHEET</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 var xDoctorName= document.forms["doctorform"]["f_doctorname"].value;
 if (xDoctorName== null || xDoctorName== "") 
    {
        alert("Doctor-Name must be filled out");
        document.doctorform.f_doctorname.focus();
        return false;
    }
}


</script>

<body background="images/bg.jpg" onload='document.doctorform.f_doctorname.focus()'>
<form class="form" name="doctorform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success"  data-bind="nextFieldOnEnter:true">
<div class="panel-heading">
        <h3 class="panel-title  text-center">CASE SHEET</h3>
</div>
<div class="panel-body">
     <div class="form-group"  style="display: none;">
	<label  class="control-label col-xs-3"> NO</label>
	<div class="col-xs-2">
          <input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xtxno']; ?>" readonly>
	</div>						                 
     </div>
<div class="form-group">
<div class="col-xs-3"> 
<label>Patient Id:</label>
<input type="text" class="form-control"  name="f_doctorname" >
</div>


<div class="col-xs-3"> 
<label>Ip-No:</label>
<input type="text" class="form-control"  name="f_doctorname" >
</div>


<div class="col-xs-2">
 <label>Department:</label>
<select class="form-control" id="" value="" name="f_status">
<option value="OBG">OBG </option>
<option value="DELIVERY">DELIVERY </option>
</select>
</div>

<div class="col-xs-2">
 <label>Room No</label>
<select class="form-control" id="" value="" name="f_status">
<option value="1">1 </option>
<option value="2">2 </option>
</select>
</div>



<div class="col-xs-2">
 <label>Consultant</label>
<select class="form-control" id="" value="" name="f_status">
<option value="Dr.Lakshmanan">Dr.Lakshmanan </option>
<option value="Dr.Meena">Dr.Meena </option>
</select>
</div>

<!--

<div class="col-xs-3">
 <label>Name:</label>
<input type="text" class="form-control"  name="f_specialist"  >
</div>

<div class="col-xs-2">
 <label>Age:</label>
<input type="number" class="form-control"  name="f_mobileno">
</div>


<div class="col-xs-2">
 <label>Gender</label>
<select class="form-control" id="" value="" name="f_status">
<option value="Male">Male </option>
<option value="Female">Female </option>
</select>
</div>

<div class="col-xs-4" style="text-align: left;">
 <label>Address </label>
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right" placeholder="ADDRESS"><?php echo $GLOBALS ['xAddress']; ?></textarea>
</div>


<div class="col-xs-3">
 <label>Mobile No:</label>
<input type="number" class="form-control"  name="f_mobileno">
</div>
!-->

<div class="col-xs-3">
 <label>Occupation:</label>
<input type="text" class="form-control"  name="f_specialist"  >
</div>

<div class="col-xs-3">
 <label>Income:</label>
<input type="number" class="form-control"  name="f_specialist"  >
</div>

<div class="col-xs-3">
 <label>Date Of Admission:</label>
<input type="date" class="form-control"  name="f_specialist"  >
</div>
<div class="col-xs-3">
 <label>Date of Discharge:</label>
<input type="date" class="form-control"  name="f_specialist"  >
</div>

<div class="col-xs-2">
 <label>Payment Mode</label>
<select class="form-control" id="" value="" name="f_status">
<option value="Male">Self </option>
<option value="Female">Corporate </option>
<option value="Male">Insurance</option>
</select>
</div>

<div class="col-xs-4" style="text-align: left;">
 <label>Diagnosis </label>
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right"></textarea>
</div>

<div class="col-xs-4" style="text-align: left;">
 <label>Risk Factor </label>
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right"><?php echo $GLOBALS ['xAddress']; ?></textarea>
</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br>

</br></br>
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



</body>

</html>
