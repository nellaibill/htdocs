<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = '';
if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
{
$no= $_GET['txno'];
if($_GET['xmode']=='edit')
{
DataFetch ( $_GET['txno']);
}
else
{
     $xQry = "DELETE FROM t_ebdetails WHERE txno= $no";
     mysql_query ( $xQry );
     header('Location: hr008ebdetails.php'); 	
}
}
else
{
GetMaxIdNo ();
 $GLOBALS ['xStockPointNo']='';
}
//$GLOBALS ['xCurrentDate']=date('Y-m-d');
//$GLOBALS ['xTime']=date('H:i:s');

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
FROM t_ebdetails";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTxNo'] = $row ['txno'];
	}
}

function DataFetch($xTxNo) {
 $GLOBALS ['xMode']='F';
    $result = mysql_query ( "SELECT *  FROM t_ebdetails where txno=$xTxNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTxNo'] = $row ['txno'];
 		$GLOBALS ['xEbNo'] = $row ['ebno'];
                findebname($row ['ebno']);
 		$GLOBALS ['xDate'] = $row ['date'];
 		$GLOBALS ['xTime'] = $row ['time'];
 		$GLOBALS ['xOldReading'] = $row ['oldreading'];
 		$GLOBALS ['xNewReading'] = $row ['newreading'];
 		$GLOBALS ['xAcRoom'] = $row ['acroom'];
 		$GLOBALS ['xLabourWard'] = $row ['labourward'];
 		$GLOBALS ['xWarmer'] = $row ['warmer'];
 		$GLOBALS ['xNewFirstFloor'] = $row ['newfirstfloor'];
 		$GLOBALS ['xNewSecondFloor'] = $row ['newsecondfloor'];
 		$GLOBALS ['xLab'] = $row ['lab'];
 		$GLOBALS ['xLift'] = $row ['lift'];
 		$GLOBALS ['xMotor'] = $row ['motor'];
 		$GLOBALS ['xXray'] = $row ['xray'];
 		$GLOBALS ['xPost'] = $row ['post'];
 		$GLOBALS ['xGroundFloor'] = $row ['groundfloor'];
 		$GLOBALS ['xTheatre'] = $row ['theatre'];
 		$GLOBALS ['xOldFirstFloor'] = $row ['oldfirstfloor'];
 		$GLOBALS ['xOldSecondFloor'] = $row ['oldsecondfloor'];
                $GLOBALS ['xTopFloor'] = $row ['topfloor'];
                $GLOBALS ['xRs'] = $row ['rs'];
                $GLOBALS ['xLh'] = $row ['lh'];
	}
	}
}

function DataProcess($mode) {
$xTxNo= $_POST ['f_txno'];
$xCurrentDateTime=date('Y-m-d H:i:s');
if (empty ( $_POST ['f_ebno'] )) 
     {
		$xEbNo= $GLOBALS ['xEbNo'];
     } 
else {
		$xEbNo= $_POST ['f_ebno'];
     }

$xDate= $_POST ['f_date'];
$xTime= $_POST ['f_time'];
$xOldReading= $_POST ['f_oldreading'];
$xNewReading= $_POST ['f_newreading'];
$xConsumption= doubleval($_POST['f_newreading'])-doubleval($_POST['f_oldreading']);
if (empty ( $_POST ['f_acroom'] )) 
     {
		$xAcRoom=0;
     } 
else {
		$xAcRoom= $_POST ['f_acroom'];
     }
if (empty ( $_POST ['f_labourward'] )) 
     {
		$xLabourWard=0;
     } 
else {
		$xLabourWard= $_POST ['f_labourward'];
     }
if (empty ( $_POST ['f_warmer'] )) 
     {
		$xWarmer=0;
     } 
else {
		$xWarmer= $_POST ['f_warmer'];
     }
if (empty ( $_POST ['f_newfirstfloor'] )) 
     {
		$xNewFirstFloor=0;
     } 
else {
		$xNewFirstFloor= $_POST ['f_newfirstfloor'];
     }
if (empty ( $_POST ['f_newsecondfloor'] )) 
     {
		$xNewSecondFloor=0;
     } 
else {
		$xNewSecondFloor= $_POST ['f_newsecondfloor'];
     }
if (empty ( $_POST ['f_lab'] )) 
     {
		$xLab=0;
     } 
else {
		$xLab= $_POST ['f_lab'];
     }
if (empty ( $_POST ['f_lift'] )) 
     {
		$xLift=  0;
     } 
else {
		$xLift= $_POST ['f_lift'];
     }
if (empty ( $_POST ['f_motor'] )) 
     {
		$xMotor=  0;
     } 
else {
		$xMotor= $_POST ['f_motor'];
     }
if (empty ( $_POST ['f_xray'] )) 
     {
		$xXray=  0;
     } 
else {
		$xXray= $_POST ['f_xray'];
     }
if (empty ( $_POST ['f_post'] )) 
     {
		$xPost=  0;
     } 
else {
		$xPost= $_POST ['f_post'];
     }
if (empty ( $_POST ['f_groundfloor'] )) 
     {
		$xGroundFloor=  0;
     } 
else {
		$xGroundFloor= $_POST ['f_groundfloor'];
     }
if (empty ( $_POST ['f_theatre'] )) 
     {
		$xTheatre=  0;
     } 
else {
		$xTheatre= $_POST ['f_theatre'];
     }
if (empty ( $_POST ['f_oldfirstfloor'] )) 
     {
		$xOldFirstFloor= 0;
     } 
else {
		$xOldFirstFloor= $_POST ['f_oldfirstfloor'];
     }
if (empty ( $_POST ['f_oldsecondfloor'] )) 
     {
		$xOldSecondFloor= 0;
     } 
else {
		$xOldSecondFloor= $_POST ['f_oldsecondfloor'];
     }

if (empty ( $_POST ['f_topfloor'] )) 
     {
		$xTopFloor= 0;
     } 
else {
		$xTopFloor= $_POST ['f_topfloor'];
     }

if (empty ( $_POST ['f_rs'] )) 
     {
		$xRs= 0;
     } 
else {
		$xRs= $_POST ['f_rs'];
     }

if (empty ( $_POST ['f_lh'] )) 
     {
		$xLh= 0;
     } 
else {
		$xLh= $_POST ['f_lh'];
     }

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO t_ebdetails VALUES                 
           ($xTxNo,$xEbNo,'$xDate','$xTime','$xOldReading','$xNewReading','$xConsumption',$xAcRoom,$xLabourWard,$xWarmer,
            $xNewFirstFloor,$xNewSecondFloor,$xLab,$xLift,$xMotor,$xXray,$xPost,$xGroundFloor,$xTheatre,$xOldFirstFloor,$xOldSecondFloor,$xTopFloor,$xRs,$xLh,'$xCurrentDateTime','$xCurrentDateTime')";

$xQryUpdated="update m_eb set currentreading='$xNewReading' where txno=$xEbNo";
$retval1 = mysql_query ( $xQryUpdated) or die ( mysql_error () );
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
   $xQry = "UPDATE t_ebdetails SET ebno=$xEbNo,date='$xDate',time='$xTime',oldreading='$xOldReading',newreading='$xNewReading',consumption='$xConsumption',
            acroom=$xAcRoom,labourward=$xLabourWard,warmer=$xWarmer,newfirstfloor=$xNewFirstFloor,newsecondfloor=$xNewSecondFloor,lab=$xLab,lift=$xLift,      motor=$xMotor,xray=$xXray,post='$xPost',groundfloor=$xGroundFloor,theatre=$xTheatre,oldfirstfloor=$xOldFirstFloor,oldsecondfloor=$xOldSecondFloor,topfloor=$xTopFloor ,rs=$xRs,lh=$xLh,updatedason='$xCurrentDateTime' WHERE txno=$xTxNo";
$xMsg="Updated";
$xQryUpdated="update m_eb set currentreading='$xNewReading' where txno=$xEbNo";
//echo $xQryUpdated;
$retval1 = mysql_query ( $xQryUpdated) or die ( mysql_error () );
header('Location: hr008ebdetails.php'); 	
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM t_ebdetails WHERE txno=$xTxNo";
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
<title>EB-ENTRY</title>
</head>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<Script> 

 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

 $(function() {
        $('#ebno').change(function(){
            $('.eb').hide();
            $('#' + $(this).val()).show();
        });
    });


function validateForm()
 {
var xDate= document.forms["ebentryform"]["f_date"].value;
var xTime= document.forms["ebentryform"]["f_time"].value;
var xOldReading= document.forms["ebentryform"]["f_oldreading"].value;
var xNewReading= document.forms["ebentryform"]["f_newreading"].value;

 if (xDate== null || xDate== "") {
        alert("Date must be filled out");
document.ebentryform.f_date.focus();
        return false;
    }
 
 if (xTime== null || xTime== "") {
        alert("Time must be filled out");
document.ebentryform.f_time.focus();
        return false;
    }  

 if (xOldReading== null || xOldReading== "") {
        alert("OldReading must be filled out-Choose an EB");
document.ebentryform.f_ebno.focus();
        return false;
    }  

 if (xNewReading== null || xNewReading== "") {
        alert("NewReading must be filled out");
document.ebentryform.f_newreading.focus();
        return false;
    } 
}
function FindCurrentReading(str) {
var xEbNo=document.getElementById("ebno").value;
var xMode = <?php echo json_encode($GLOBALS ['xMode']); ?>;
if(xMode=='F')
{
var strconfirm = confirm("Could Not Change ");
if (strconfirm == true)
            {
                return false;
            }
}
else
{

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById('oldreading').value=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","findcurrentreading.php?ebno="+xEbNo, true);
  xmlhttp.send();
}
}

</Script>
<body onload='document.ebentryform.f_stockpointno.focus()'>
<div>
<center><h3 id="headertext">EB-ENTRY  </h3></center>
		<form class="form" name="ebentryform" action="<?php echo $_SERVER['PHP_SELF']; ?>"
			method="post">

			<fieldset>
<div>
				
				</div></br>
                 <div class="form-group" >

					<label  class="control-label col-xs-2">TX NO</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" 
							name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>"
							placeholder="" readonly>
							 </div>
								                 
				</div>

</br></br>


<div class="form-group">
	<label for="lbltxno" class="control-label col-xs-2">CHOOSE EB</label>
	 <div class="col-xs-4">
           <select class="form-control"  value="" name="f_ebno" id="ebno" onclick="FindCurrentReading()">
            <?php
            $result = mysql_query("SELECT *  FROM m_eb");
            echo "<option value=''>Select Your Option</option>";
            while($row = mysql_fetch_array($result))
           {
             ?>



           <option value = "<?php echo $row['txno']; ?>" 
            <?php
                if ($row['ebname']== $GLOBALS ['xEbName']){
                   // echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['ebname']; ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
	</div>
     </div>
</br></br>


<div class="form-group" >
<label  class="control-label col-xs-2">DATE & TIME</label>
       <div class="col-xs-2">
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
<input type="date" class="form-control" id="xdate" name="f_date"  readonly value="<?php echo $GLOBALS ['xCurrentDate']; ?>" placeholder="">
<?php
}
?>
        	        </div>								                 
	<div class="col-xs-2">
		<input type="time" class="form-control" name="f_time" value="<?php echo $GLOBALS ['xTime']; ?>">
	</div>
</div>
</br></br>


<div class="form-group">
   <label  class="control-label col-xs-2">READING</label>
	<div class="col-xs-2">
	  <input type="text" class="form-control" id="oldreading" name="f_oldreading" value="<?php echo $GLOBALS ['xOldReading']; ?>" readonly>
        </div>
	<div class="col-xs-2">
	  <input type="text" class="form-control" id="newreading" name="f_newreading" value="<?php echo $GLOBALS ['xNewReading']; ?>"  onkeypress="return isNumberKey(event)" >
	</div>	
	                 
</div>
</br></br>
<div class="form-group" >
   <label  class="control-label col-xs-2">AC-ROOM</label>
	<div class="col-xs-2" >
	  <input type="text" class="form-control" id="oldreading" name="f_acroom" value="<?php echo $GLOBALS ['xAcRoom']; ?>" placeholder="AC-ROOM" onkeypress="return isNumberKey(event)">
        </div>
                 
</div>

</br></br>


<!--<div id="1" class="eb" style="display:none">!-->
<div id="1" class="eb" >
 <fieldset>
  <legend>TKM- BUILDING</legend>
   <label  class="control-label col-xs-2"> L.W & WARMER</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_labourward" value="<?php echo $GLOBALS ['xLabourWard']; ?>"  placeholder="LABOUR WARD" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_warmer" value="<?php echo $GLOBALS ['xWarmer']; ?>" placeholder="WARMER" onkeypress="return isNumberKey(event)">
	</div></br></br>
   <label  class="control-label col-xs-2">NEW I & II </label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_newfirstfloor" value="<?php echo $GLOBALS ['xNewFirstFloor']; ?>" placeholder="NEW-FIRST" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_newsecondfloor" value="<?php echo $GLOBALS ['xNewSecondFloor']; ?>" placeholder="NEW-SECOND" onkeypress="return isNumberKey(event)">
	</div></br></br></br>
   <label  class="control-label col-xs-2">LAB & LIFT</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_lab" value="<?php echo $GLOBALS ['xLab']; ?>" placeholder="LAB" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_lift" value="<?php echo $GLOBALS ['xLift']; ?>" placeholder="LIFT" onkeypress="return isNumberKey(event)">
	</div></br></br>
   <label  class="control-label col-xs-2">MOTOR & X-RAY</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_motor" value="<?php echo $GLOBALS ['xMotor']; ?>" placeholder="MOTOR" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_xray" value="<?php echo $GLOBALS ['xXray']; ?>" placeholder="X-RAY" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_post" value="<?php echo $GLOBALS ['xPost']; ?>" placeholder="POST" onkeypress="return isNumberKey(event)">
	</div>
 </fieldset>
</br></br>
</div>
<div id="2" class="eb" > 
 <fieldset>
  <legend>O-P BUILDING</legend>
   <label  class="control-label col-xs-2">G.FLOOR& THEATRE</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_groundfloor" value="<?php echo $GLOBALS ['xGroundFloor']; ?>" placeholder="GROUND FLOOR" onkeypress="return isNumberKey(event)">
	</div>
<div class="col-xs-2">
		<input type="text" class="form-control" name="f_theatre" value="<?php echo $GLOBALS ['xTheatre']; ?>" placeholder="THEATRE" onkeypress="return isNumberKey(event)">
	</div>
</br></br>
   <label  class="control-label col-xs-2">OLD-I & II</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_oldfirstfloor" value="<?php echo $GLOBALS ['xOldFirstFloor']; ?>" placeholder="OLD-FIRST" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_oldsecondfloor" value="<?php echo $GLOBALS ['xOldSecondFloor']; ?>" placeholder="OLD-SECOND" onkeypress="return isNumberKey(event)">
	</div>
	<div class="col-xs-2">
		<input type="text" class="form-control" name="f_topfloor" value="<?php echo $GLOBALS ['xTopFloor']; ?>" placeholder="TOP-FLOOR" onkeypress="return isNumberKey(event)">
	</div>
</br></br>
<!--  R.S -SRINIVASAN SIR ,L.H LAKSHMI HOSPITAL STAFF    !-->
<div class="form-group" >
   <label  class="control-label col-xs-2">R.S</label>
	<div class="col-xs-2" >
	  <input type="text" class="form-control"  name="f_rs" value="<?php echo $GLOBALS ['xRs']; ?>" placeholder="SRINIVASAN SIR "  onkeypress="return isNumberKey(event)">
        </div>
                 
</div>

</br></br>

<div class="form-group" >
   <label  class="control-label col-xs-2">L.H</label>
	<div class="col-xs-2" >
	  <input type="text" class="form-control"  name="f_lh" value="<?php echo $GLOBALS ['xLh']; ?>" placeholder="LAKSHMI HOSPITAL"  onkeypress="return isNumberKey(event)">
        </div>
                 
</div>

</br></br>
 </fieldset>
</br></br>
</div>

<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
<input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()"> 
                                               
						
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>