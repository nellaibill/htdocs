<?php
include 'globalfile.php';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
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
      $xQry = "DELETE FROM t_ecgxraybilling WHERE txno= $no";
      mysql_query ( $xQry );
      header('Location: lab_billing.php'); 	
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


function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' 
       ELSE max(txno)+1 END AS txno
FROM t_ecgxraybilling";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTxNo'] = $row ['txno'];
	}
}

function DataFetch($xTxNo) {
    $result = mysql_query ( "SELECT *  FROM t_ecgxraybilling where txno=$xTxNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTxNo'] = $row ['txno'];
 		$GLOBALS ['xSaluation'] = $row ['saluation'];
	$GLOBALS ['xDate'] = $row ['date'];
 		$GLOBALS ['xPatientName'] = $row ['patientname'];
 		$GLOBALS ['xAge'] = $row ['age'];
 		$GLOBALS ['xDMY'] = $row ['dmy'];
 		$GLOBALS ['xGender'] = $row ['gender'];
                $GLOBALS ['xDoctorNo'] = $row ['doctorno'];
                $GLOBALS ['xSection']=$row ['section'];
                $GLOBALS ['xTestNo'] = $row ['testno'];
                $GLOBALS ['xTestTypeNo'] = $row ['testtypeno'];
 		$GLOBALS ['xTestAmount'] = $row ['testamount'];
	}
	}
}

function DataProcess($mode) {
$xPrintLink='';
$xTxNo= $_POST ['f_txno'];
$xPatientId=0;
$xDate=$_POST ['f_date'];
$xSection= $_POST ['f_section'];
$xSaluation= $_POST ['f_saluation'];
$xPatientName= strtoupper($_POST ['f_patientname']);
$xAge= $_POST ['f_age'];
$xDmy= $_POST ['f_dmy'];
$xGender= $_POST ['f_gender'];
$xDoctorNo= $_POST ['f_doctorno'];
//$xTestNo= $_POST ['f_testno'];
$xTestNo= 0;
$xFlimType= $_POST ['f_flimtype'];
$xTestTypeNo= $_POST ['f_testtypeno'];
$xTestAmount= $_POST ['f_testamount'];
$xCurrentDate= $GLOBALS ['xCurrentDate'];
$xCurrentDateOnly=date('Y-m-d');

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO t_ecgxraybilling  VALUES ($xTxNo,$xPatientId,'$xCurrentDateOnly','$xSection','$xSaluation','$xPatientName',$xAge,'$xDmy','$xGender',$xDoctorNo,'$xFlimType',$xTestNo,$xTestTypeNo,$xTestAmount,'$xCurrentDate','$xCurrentDate1')";
$xMsg="Inserted";
        $xPrintLink= "<script>window.open('ecg_hp001billing.php?txno=$xTxNo')</script>";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE t_ecgxraybilling   SET date='$xDate',section='$xSection',saluation='$xSaluation',patientname='$xPatientName',age=$xAge,dmy='$xDmy',gender='$xGender',doctorno=$xDoctorNo,updatedason='$xCurrentDate' WHERE txno=$xTxNo";
$xMsg="Updated";
      //header('Location: ecg_ht001billing.php'); 
        $xPrintLink= "<script>window.open('ecg_hp001billing.php?txno=$xTxNo')</script>";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM t_ecgxraybilling   WHERE txno=$xTxNo";
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
echo $xPrintLink;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>LAB[BILLING]</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 
 var xPatientName= document.forms["ecgxraybilling"]["f_patientname"].value;
 var xAge= document.forms["ecgxraybilling"]["f_age"].value;
 var xTestAmount= document.forms["ecgxraybilling"]["f_testamount"].value;
 if (xPatientName== null || xPatientName== "") 
    {
        alert("Patient-Name must be filled out");
        document.ecgxraybilling.f_patientname.focus();
        return false;
    }
 if (xAge== null || xAge== "") 
    {
        alert("Age must be filled out");
        document.ecgxraybilling.f_age.focus();
        return false;
    }
/* if (xTestAmount== null || xTestAmount== "") 
    {
        alert("Amount must be filled out");
        document.ecgxraybilling.f_testtypeno.focus();
        return false;
    }
*/
}

    document.getElementById("save").value="SAVE"; 
function changeupdate()
{
    document.getElementById("save").value="UPDATE"; 
}

/*
function onchangeajax(testid)
 {
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
 
 var url="ajax_filtertesttype.php"
 url=url+"?testid="+testid
 url=url+"&sid="+Math.random()
 if(xmlHttp.onreadystatechange=stateChanged)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }
 
 function stateChanged()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("testtypediv").innerHTML=xmlHttp.responseText
 return true;
 }
 }
 
 function GetXmlHttpObject()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }

*/
function onchangetesttype(testtypeid)
 {
 xmlHttp=GetXmlHttpObject1()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
 
 var url="ajax_filtertestamount.php"
 url=url+"?testtypeid="+testtypeid
 url=url+"&sid="+Math.random()
 if(xmlHttp.onreadystatechange=stateChanged1)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }
 
 function stateChanged1()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("testamountdiv").innerHTML=xmlHttp.responseText
 return true;
 }
 }
 
 function GetXmlHttpObject1()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }


</script>


<body onload='document.ecgxraybilling.f_patientname.focus()'>
<form class="form" name="ecgxraybilling" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <div class="panel panel-primary">
  <div class="panel-heading text-center">
        <h3 class="panel-title">ECG-XRAY[BILLING]</h3>
  </div>
 <div class="panel-body"> 
<div class="form-group">
<label  class="control-label col-xs-3" >  DATE & PATIENT-ID</label>
	<div class="col-xs-2" style="display:none">
            <input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>" readonly>
	</div>
<div class="col-xs-3">
<?php
if($login_session=="admin")
{
?>
<input type="date" class="form-control" id="xdate" name="f_date"  value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="">
<?php
}
else
{
?>
<input type="date" class="form-control" id="xdate" name="f_date" readonly value="<?php echo $GLOBALS ['xDate']; ?>">
<?php
}
?>
</div>

<div class="col-xs-3" style="display:none">
            <input type="text" class="form-control" value="123-456-789" readonly>
</div>

</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">PATIENT NAME</label>
<div class="col-xs-2">
<select class="form-control"  value="" name="f_saluation">
<option value="B/O."   <?php if($GLOBALS ['xSaluation']=="B/O.") echo 'selected="selected"'; ?>>B/O.</option>
<option value="BABY."   <?php if($GLOBALS ['xSaluation']=="BABY.") echo 'selected="selected"'; ?>>BABY.</option>
<option value="MASTER."   <?php if($GLOBALS ['xSaluation']=="MASTER.") echo 'selected="selected"'; ?>>MASTER.</option>
<option value="MR."   <?php if($GLOBALS ['xSaluation']=="MR.") echo 'selected="selected"'; ?>>MR.</option>
<option value="MRS."  <?php if( $GLOBALS ['xSaluation']=="MRS.") echo 'selected="selected"'; ?>>MRS.</option>
<option value="MISS." <?php if($GLOBALS ['xSaluation']=="MISS.") echo 'selected="selected"'; ?>>MISS.</option>
</select>
</div>
<div class="col-xs-4">
<input type="text" class="form-control"  name="f_patientname" maxlength="50" value="<?php echo $GLOBALS ['xPatientName']; ?>">
</div></div></br></br>

<div class="form-group">
<label for="" class="control-label col-xs-3">AGE & GENDER</label>
	<div class="col-xs-2">
          <input type="number" class="form-control" id="xAge" name="f_age"  value="<?php echo $GLOBALS ['xAge']; ?>">
        </div>

<div class="col-xs-2">
<select class="form-control" id="sel1" value="" name="f_dmy">
	<option value="DAYS" <?php if($GLOBALS ['xDMY']=="DAYS") echo 'selected="selected"'; ?>>DAYS</option>
	<option value="MONTHS" <?php if( $GLOBALS ['xDMY']=="MONTHS") echo 'selected="selected"'; ?>>MONTHS</option>
	<option value="YEARS" <?php if($GLOBALS ['xDMY']=="YEARS") echo 'selected="selected"'; ?>>YEARS</option>
</select>
</div>

<div class="col-xs-2">
	<select class="form-control"  value="" name="f_gender">
	  <option value="MALE" <?php if($GLOBALS ['xGender']=="MALE") echo 'selected="selected"'; ?>>MALE</option>
	  <option value="FEMALE" <?php if( $GLOBALS ['xGender']=="FEMALE") echo 'selected="selected"'; ?>>FEMALE</option>
	</select>
</div></div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">DOCTOR NAME & SECTION</label>
   <div class="col-xs-3">
	<select class="form-control"  value="" name="f_doctorno" >
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_doctor");
                                                        echo "<option value=''>CHOOSE DOCTOR</option>";
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
	<select class="form-control"  value="" name="f_section">
	<option value="OP"   <?php if($GLOBALS ['xSection']=="OP") echo 'selected="selected"'; ?>>OP</option>
	<option value="WARD"  <?php if( $GLOBALS ['xSection']=="WARD") echo 'selected="selected"'; ?>>WARD</option>
	<option value="LABOURWARD"  <?php if( $GLOBALS ['xSection']=="LABOURWARD") echo 'selected="selected"'; ?>>LABOURWARD</option>
	<option value="NEWBORN"  <?php if( $GLOBALS ['xSection']=="NEWBORN") echo 'selected="selected"'; ?>>NEWBORN</option>
	<option value="POW"  <?php if( $GLOBALS ['xSection']=="POW") echo 'selected="selected"'; ?>>POW</option>
	<option value="IMCU"  <?php if( $GLOBALS ['xSection']=="IMCU") echo 'selected="selected"'; ?>>IMCU</option>
	<option value="OT"  <?php if( $GLOBALS ['xSection']=="OT") echo 'selected="selected"'; ?>>OT</option>
	</select>
</div>
 </div></br></br>
<div class="form-group" >
<label for="lbltxno" class="control-label col-xs-3">CHOOSE TEST TYPE</label>
<!-- To Lock Test Type !-->
<div class="col-xs-3">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
<select class="form-control"  value="" autofocus="autofocus" name="f_testtypeno" onchange="return onchangetesttype(this.value);" onfocus="return onchangetesttype(this.value);">
           <? } else{ ?>
<select class="form-control"  value="" autofocus="autofocus" name="f_testtypeno" onchange="return onchangetesttype(this.value);" onfocus="return onchangetesttype(this.value);" disabled>
           <? }  ?>
                                                      <?php
                                                        $result = mysql_query("SELECT *  FROM m_testtype where testno in(4)");
                                                        while($row = mysql_fetch_array($result))
                                                        {
                                                      ?>
                                                         <option value = "<?php echo $row['testtypeno']; ?>" 
                                                         <?php
                                                          if ($row['testtypeno']== $GLOBALS ['xTestTypeNo']){
                                                          echo 'selected="selected"';
                                                          } 
                                                          ?> >
                                                         <?php echo $row['testtypename']; ?> 
                                                         </option>
                                                         <?
                                                           }
                                                          echo "</select>";
                                                          ?>
</div>

<div class="col-xs-2" id="testamountdiv" >
<input type="text" class="form-control"  name="f_testamount" readonly>
</div></div></br></br>
</div><!-- PANEL BODY !-->
<div class="panel-footer clearfix">

        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">LAB REPORT AS ON <?php echo date('d/F/Y', strtotime($GLOBALS ['xDate'])); ?></h3></div>
<table class="table">
      <thead>
        <tr>
  <th width="5%">S.NO</th>
  <th width="25%"> PATIENT NAME</th>
  <th width="10%"> AGE</th>
  <th width="10%"> CREATED</th>
 <th width="15%"> SECTION</th>
 <th width="15%"> DOCTOR NAME</th>
 <th width="15%"> TEST NAME</th>
 <th width="10%"> AMOUNT</th>
<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xTotalAmount=0;
$xSlNo=1;
$xQry='';
$xDate=$GLOBALS ['xDate'];
if ( isset( $_GET['ecgtype'] ))
{
  if($_GET['ecgtype']==1)
   {
     $xQry="SELECT *  from t_ecgxraybilling where date='$xDate' and testtypeno=1 order by  txno"; 
   }
   if($_GET['ecgtype']==2)
   {
      $xQry="SELECT *  from t_ecgxraybilling where date='$xDate' and testtypeno!=1 order by  txno"; 
   }
}
else
 {
$xQry="SELECT *  from t_ecgxraybilling where date='$xDate' and testtypeno>=84 order by  txno"; 
 }
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
    $xSlNo+=1;
    echo '<td>' . $row['saluation'] .$row['patientname']  . '</td>';
    echo '<td>' .  $row['age']  . '</td>';
    echo '<td>' .  date('h:i A', strtotime($row['createdason']))  . '</td>';
    findtesttypename( $row['testtypeno'] );
    finddoctorname( $row['doctorno'] );
    echo '<td>' .  $row['section']  . '</td>';
    echo '<td>' .  $GLOBALS ['xDoctorName']  . '</td>';
    echo '<td>' .  $GLOBALS ['xTestTypeName']  . '</td>';
    echo '<td>' . $row['testamount']  . '</td>';
   $xTotalAmount+= $row['testamount'];
?>
<td><a href="lab_billing.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>


<?
echo '</tr>'; 
} 
?>
<tr style='font-weight:bold;'>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td colspan="2"> GRAND TOTAL </td>
<?php  echo '<td>' . $xTotalAmount . '</td>'; ?>
</tr>		
</tbody>
    </table>	
</div><!-- /PANEL -->
</div><!-- / TO PRINT-->
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

</body>
</html>