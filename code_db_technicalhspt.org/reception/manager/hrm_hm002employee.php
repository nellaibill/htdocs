<?php
include 'globalfile.php';
if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
}elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}  
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
     $xQry = "DELETE FROM employeedetails  WHERE txno= $no";
     mysql_query ( $xQry );
     header('Location: hrm_hr002employee.php'); 	
}
}
else {
NewEntry ();
GetMaxIdNo ();
}

function setControlProperties() {
	$xIdno;
        $GLOBALS ['xEmpName'] = "";
}

function NewEntry() {
	DataClear ();
}
function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' 
       ELSE max(txno)+1 END AS txno
FROM employeedetails";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
	}
}
function DataClear() {
        $GLOBALS ['xMode']='';
	$GLOBALS ['xEmpName'] = "";
        $GLOBALS ['xEmpDoj'] = "";
        $GLOBALS ['xEmpDol'] = "";
        $GLOBALS ['xEmpStatus'] = "";
        $GLOBALS ['xEmpGender'] = "";
        $GLOBALS ['xEmpMaritalStatus'] = "";
        $GLOBALS ['xEmpDepartment'] = "";
        $GLOBALS ['xEmpMobileNo'] = "";
        $GLOBALS ['xEmpGovernmentId'] = "";
        $GLOBALS ['xEmpDob'] = "";
        $GLOBALS ['xEmpBloodGroup'] = "";
        $GLOBALS ['xEmpFatherName'] = "";
        $GLOBALS ['xEmpAddress'] = "";
        $GLOBALS ['xEmpPaymentMode'] = "";
}
function DataFetch($xTxno) {
	$result = mysql_query ( "SELECT *  FROM employeedetails where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
        $GLOBALS ['xIdno'] = $row ['txno'];
	$GLOBALS ['xEmpName'] = $row ['empname'];
        $GLOBALS ['xEmpDoj'] = $row ['empdoj'];
        $GLOBALS ['xEmpDol'] = $row ['empdol'];
        $GLOBALS ['xEmpStatus'] = $row ['empstatus'];
        $GLOBALS ['xEmpGender'] =$row ['empgender'];
        $GLOBALS ['xEmpMaritalStatus'] =$row ['empmaritalstatus'];
        finddepartmentname($row ['departmentno']);
        $GLOBALS ['xEmpMobileNo'] = $row ['empmobileno'];
        $GLOBALS ['xEmpGovernmentId'] = $row ['empgovernmentid'];
        $GLOBALS ['xEmpGovernmentIdType'] = $row ['empgovernmentidtype'];
        $GLOBALS ['xEmpDob'] = $row ['empdob'];
        $GLOBALS ['xEmpBloodGroup'] = $row ['empbloodgroup'];
        $GLOBALS ['xEmpFatherName'] = $row ['empfathername'];
        $GLOBALS ['xEmpAddress'] = $row ['empaddress'];
        $GLOBALS ['xEmpPaymentMode'] = $row ['emppaymentmode'];
        $GLOBALS ['xEmpBasicSalary'] = $row ['empbasicsalary'];
        $GLOBALS ['xEmpBasic'] = $row ['empbasic'];
        $GLOBALS ['xEmpDa'] = $row ['empda'];
        $GLOBALS ['xEmpAllowance'] = $row ['empallowance'];
        $GLOBALS ['xEmpHra'] = $row ['emphra'];
        $GLOBALS ['xEmpPfNo'] = $row ['emppfno'];
        $GLOBALS ['xEmpEsiNo'] = $row ['empesino'];
        $GLOBALS ['xEmpIncentive'] = $row ['empincentive'];
        $GLOBALS ['xEmpDeduction'] = $row ['empdeduction'];
	}
	}
}


function DataProcess($xMode) {
GetMaxIdNo();
        if (empty ( $_POST ['empno'] )) {
		$xTxno= $GLOBALS ['xIdno'];
	} else {
		$xTxno= $_POST ['empno'];
	}
	$xEmpName = strtoupper($_POST  ['empname']);
        if (empty ( $_POST ['empdoj'] )) {
		$xEmpDoj = '';
	} else {
		$xEmpDoj = $_POST ['empdoj'];
	}
       if (empty ( $_POST ['empdoj'] )) {
		$xEmpDol = '';
	} else {
		$xEmpDol = $_POST ['empdol'];
	}
        $xEmpStatus =$_POST ['empstatus'];
        $xEmpGender =$_POST ['empgender'];
        $xEmpMaritalStatus =$_POST ['empmaritalstatus'];
        if (empty ( $_POST ['departmentno'] )) {
		$xDepartmentNo= '';
	} else {
		$xDepartmentNo= $_POST ['departmentno'];
	}
        if (empty ( $_POST ['empmobileno'] )) {
		$xEmpMobileNo = '0';
	} else {
		$xEmpMobileNo = $_POST ['empmobileno'];
	}
        if (empty ( $_POST ['empgovernmentid'] )) {
		$xEmpGovernmentId = '';
	} else {
		$xEmpGovernmentId = $_POST ['empgovernmentid'];
	}
        if (empty ( $_POST ['empdob'] )) {
		$xEmpDob = '';
	} else {
		$xEmpDob = $_POST ['empdob'];
	}
        $xEmpBloodGroup = $_POST  ['empbloodgroup'];
        if (empty ( $_POST ['empfathername'] )) {
		$xEmpFatherName = '';
	} else {
		$xEmpFatherName = $_POST ['empfathername'];
	}
        if (empty ( $_POST ['empaddress'] )) {
		$xEmpAddress = '';
	} else {
		$xEmpAddress = $_POST ['empaddress'];
	}
  
      $xEmpPaymentMode=$_POST ['emppaymentmode'];
         if (empty ( $_POST ['empbasicsalary'] ))
           {
		$xEmpBasicSalary= '';
	   }
          else 
           {
		$xEmpBasicSalary= $_POST ['empbasicsalary'];
	   }
    
      $xEmpGovernmentIdType=$_POST ['empgovernmentidtype'];
      $xEmpBasic=$_POST ['empbasic'];
      $xEmpDa=$_POST ['empda'];
      $xEmpAllowance=$_POST ['empallowance'];
      $xEmpHra=$_POST ['emphra'];
      $xEmpTotal=$xEmpBasic+$xEmpDa+$xEmpAllowance+$xEmpHra;
      $xEpfPercent=12;
      $xEsiPercent=1.75;
      $xEmpEpf=(($xEmpBasic+$xEmpDa)/100)*$xEpfPercent;
      //$EmpEsi=(($xEmpBasic+$xEmpDa)/100)*$xEsiPercent;/* Updated As on 18th Aug 2015*/
      $EmpEsi=(($xEmpBasic+$xEmpDa+$xEmpAllowance)/100)*$xEsiPercent;/* Updated As on 5th may 2016*/
      /*$EmpEsi=($xEmpTotal/100)*$xEsiPercent;*/
      $xEmpNetPay=$xEmpTotal-$xEmpEpf-$EmpEsi;

  if (empty ( $_POST ['emppfno'] )) {
		$xEmpPfNo= '';
	} else {
		$xEmpPfNo= $_POST ['emppfno'];
	}
  if (empty ( $_POST ['empesino'] )) {
		$xEmpEsiNo= '';
	} else {
		$xEmpEsiNo= $_POST ['empesino'];
	}

  if (empty ( $_POST ['empincentive'] )) {
		$xEmpIncentive= 0;
	} else {
		$xEmpIncentive= $_POST ['empincentive'];
	}

  if (empty ( $_POST ['empdeduction'] )) {
		$xEmpDeduction= 0;
	} else {
		$xEmpDeduction= $_POST ['empdeduction'];
	}

$xQry="";
$xMsg="";
if ($xMode == 'S') 
{
 $xEmpStatus ="ACTIVE";
$xQry = "INSERT INTO employeedetails VALUES ($xTxno,'$xEmpName','$xEmpDoj','$xEmpDol','$xEmpStatus','$xEmpGender','$xEmpMaritalStatus',$xDepartmentNo,$xEmpMobileNo,
'$xEmpGovernmentId','$xEmpGovernmentIdType','$xEmpDob','$xEmpBloodGroup','$xEmpFatherName','$xEmpAddress','$xEmpPaymentMode','$xEmpBasicSalary',$xEmpBasic,$xEmpDa,$xEmpAllowance,$xEmpHra,$xEmpTotal,$xEmpEpf,$EmpEsi,$xEmpNetPay,'$xEmpPfNo','$xEmpEsiNo',$xEmpIncentive,$xEmpDeduction)";
$xMsg="Inserted";
} 
elseif ($xMode == 'U')
{
       if(($GLOBALS ['xCurrentUser']=="admin") || ($GLOBALS ['xCurrentUserRole']=="S" ))
       {
        $xQry = "UPDATE employeedetails  SET                             empname='$xEmpName',empdoj='$xEmpDoj',empdol='$xEmpDol',empstatus='$xEmpStatus',empgender='$xEmpGender',empmaritalstatus='$xEmpMaritalStatus',departmentno=$xDepartmentNo,
 empmobileno=$xEmpMobileNo,empgovernmentid='$xEmpGovernmentId',empgovernmentidtype='$xEmpGovernmentIdType',empdob='$xEmpDob',empbloodgroup='$xEmpBloodGroup',empfathername='$xEmpFatherName',empaddress='$xEmpAddress',emppaymentmode='$xEmpPaymentMode',empbasicsalary='$xEmpBasicSalary',empbasic=$xEmpBasic,empda=$xEmpDa,empallowance=$xEmpAllowance,emphra=$xEmpHra,emptotal=$xEmpTotal,empepf=$xEmpEpf,
empesi=$EmpEsi,empnetpay=$xEmpNetPay,emppfno='$xEmpPfNo',empesino='$xEmpEsiNo',empincentive=$xEmpIncentive,empfinededuction=$xEmpDeduction WHERE txno=$xTxno";
      }
else
{
  $xQry = "UPDATE employeedetails  SET                             empname='$xEmpName',empdoj='$xEmpDoj',empdol='$xEmpDol',empstatus='$xEmpStatus',empgender='$xEmpGender',empmaritalstatus='$xEmpMaritalStatus',departmentno=$xDepartmentNo,
 empmobileno=$xEmpMobileNo,empgovernmentid='$xEmpGovernmentId',empgovernmentidtype='$xEmpGovernmentIdType',empdob='$xEmpDob',empbloodgroup='$xEmpBloodGroup',empfathername='$xEmpFatherName',empaddress='$xEmpAddress',emppaymentmode='$xEmpPaymentMode',empbasic=$xEmpBasic,empda=$xEmpDa,empallowance=$xEmpAllowance,emphra=$xEmpHra,emptotal=$xEmpTotal,empepf=$xEmpEpf,
empesi=$EmpEsi,empnetpay=$xEmpNetPay,emppfno='$xEmpPfNo',empesino='$xEmpEsiNo',empincentive=$xEmpIncentive,empfinededuction=$xEmpDeduction WHERE txno=$xTxno";

}
$xMsg="Updated";
header('Location: hrm_hr002employee.php'); 	
} 

elseif ($xMode == 'D') 
{
$xQry = "DELETE FROM employeedetails WHERE txno=$xTxno";
$xMsg="Deleted";
}
//echo $xQry;
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}
DataClear ();
GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ADD EMPLOYEE</title>

<script type="text/javascript">
function validateForm() {
var xEmpName= document.forms["addemployee"]["empname"].value;
var xMobileNo= document.forms["addemployee"]["empmobileno"].value;
var xEmpDob= document.forms["addemployee"]["empdob"].value;
var xDoj= document.forms["addemployee"]["empdoj"].value;
var xEmpBasic= document.forms["addemployee"]["empbasic"].value;
var xEmpDa= document.forms["addemployee"]["empda"].value;
var xEmpAllowance= document.forms["addemployee"]["empallowance"].value;
var xEmpHra= document.forms["addemployee"]["emphra"].value;
if (xEmpName== null || xEmpName== "") 
{
  alert("Employee Name must be filled out");
  document.addemployee.empname.focus();
   return false;
}

if (xMobileNo== null || xMobileNo== "") 
{
   alert("Mobile No must be filled out");
   document.addemployee.empmobileno.focus();
   return false;
}
if (xEmpDob== null || xEmpDob== "") 
{
   alert("Date OF Birth must be filled out");
   document.addemployee.empdob.focus();
   return false;
}

 if (xDoj== null || xDoj== "") {
        alert("Please Choose Date Of Joining");
        document.addemployee.empdoj.focus();
        return false;
    }


 if (xEmpBasic== null || xEmpBasic== "") 
    {
        alert("Basic Salary must be filled out");
        document.addemployee.empbasic.focus();
        return false;
    }
 if (xEmpDa== null || xEmpDa== "") 
   {
        alert("DA must be filled out");
        document.addemployee.empda.focus();
        return false;
    }

 if (xEmpAllowance== null || xEmpAllowance== "") 
   {
        alert("Allowance must be filled out");
        document.addemployee.empallowance.focus();
        return false;
    }

 if (xEmpHra== null || xEmpHra== "") {
        alert("HRA must be filled out");
        document.addemployee.emphra.focus();
        return false;
    }
}


function DateCheck() 
 {
  var StartDate= document.getElementById('empdoj').value;
  var EndDate= document.getElementById('empdol').value;
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate)
    {
    alert("Please ensure that the  Date of Left  is greater than or equal to the Date of Joining .");
  document.addemployee.empdol.focus();
    return false;

    }
}


</script>
</head>


<div class="panel panel-success">
<div class="panel-heading text-center"><b>ADD EMPLOYEE</b></div>
<div class="panel-body">
<body onload='document.addemployee.empname.focus()'>
<form class="form" name="addemployee" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
if(($GLOBALS ['xCurrentUserRole']=='S') || ($GLOBALS ['xCurrentUser']=="admin"))
{
?>
<div class="form-group">
<label  class="control-label col-xs-2">EMPLOYEE NO</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="xIdNo" name="empno" value="<?php echo $GLOBALS ['xIdno']; ?>" readonly>
</div>
</div></br> </br>
<?
}
?>

<div class="panel panel-default">
<div class="panel-heading">EMPLOYEE DETAILS</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2">EMPLOYEE NAME</label>
<div class="col-xs-3">
<input type="text" class="form-control"  name="empname" value="<?php echo $GLOBALS ['xEmpName']; ?>" placeholder="" >
</div>
<div class="col-xs-3">
<select class="form-control" id="sel1" value="" name="empgender">
<option value="MALE" <?php if($GLOBALS ['xEmpGender']=="MALE") echo 'selected="selected"'; ?>>MALE</option>
<option value="FEMALE" <?php if( $GLOBALS ['xEmpGender']=="FEMALE") echo 'selected="selected"'; ?>>FEMALE</option>                       
</select>
</div> </div>
</br> </br>
              
<?php
if($_GET['xmode']=='edit')
{
?>
<div class="form-group">
<label  class="control-label col-xs-2">DATE OF LEFT</label>
<div class="col-xs-2">
<input type="date" class="form-control"  name="empdol"  id="empdol" value="<?php echo $GLOBALS ['xEmpDol']; ?>" placeholder="" onblur="return DateCheck()">
</div>
<div class="col-xs-2">
<select class="form-control" id="" value="" name="empstatus">
<option value="ACTIVE" <?php if($GLOBALS ['xEmpStatus']=="ACTIVE") echo 'selected="selected"'; ?>>ACTIVE</option>
<option value="INACTIVE" <?php if( $GLOBALS ['xEmpStatus']=="INACTIVE") echo 'selected="selected"'; ?>>INACTIVE</option>
<option value="HOLD" <?php if( $GLOBALS ['xEmpStatus']=="HOLD") echo 'selected="selected"'; ?>>HOLD</option>
</select>
</div> </div>
</br>
<?
}
?>

<div class="form-group">
<label  class="control-label col-xs-2">MARITAL STATUS</label>
<div class="col-xs-3">
<select class="form-control" id="" value="" name="empmaritalstatus">
<option value="MARRIED" <?php if( $GLOBALS ['xEmpMaritalStatus']=="MARRIED") echo 'selected="selected"'; ?>>MARRIED</option>
<option value="UNMARRIED" <?php if( $GLOBALS ['xEmpMaritalStatus']=="UNMARRIED") echo 'selected="selected"'; ?>>UNMARRIED</option>
</select>
</div>
<div class="col-xs-3">
<input type="text" class="form-control"  name="empmobileno" value="<?php echo $GLOBALS ['xEmpMobileNo']; ?>" placeholder="MOBILE NO" >
</div>
</div>
</br></br>
                 
<div class="form-group">
<label  class="control-label col-xs-2">DATE OF BIRTH</label>
<div class="col-xs-2">
<input type="date" class="form-control"  name="empdob" value="<?php echo $GLOBALS ['xEmpDob']; ?>" placeholder="" >
</div>
<div class="col-xs-2">
<select class="form-control" id="" value="" name="empbloodgroup">
<option value="A" <?php if($GLOBALS ['xEmpBloodGroup']=="A") echo 'selected="selected"'; ?>>A</option>
<option value="A+" <?php if( $GLOBALS ['xEmpBloodGroup']=="A+") echo 'selected="selected"'; ?>>A+</option>
<option value="B" <?php if($GLOBALS ['xEmpBloodGroup']=="B") echo 'selected="selected"'; ?>>B</option>
<option value="B+" <?php if($GLOBALS ['xEmpBloodGroup']=="B+") echo 'selected="selected"'; ?>>B+</option>
<option value="AB" <?php if($GLOBALS ['xEmpBloodGroup']=="AB") echo 'selected="selected"'; ?>>AB</option>
<option value="AB+" <?php if($GLOBALS ['xEmpBloodGroup']=="AB+") echo 'selected="selected"'; ?>>AB+</option>
<option value="O" <?php if($GLOBALS ['xEmpBloodGroup']=="O") echo 'selected="selected"'; ?>>O</option>
<option value="O+" <?php if($GLOBALS ['xEmpBloodGroup']=="O+") echo 'selected="selected"'; ?>>O+</option>
</select>
</div>
</div></br></br>

<div class="form-group">
<label  class="control-label col-xs-2">FATHER/HUSBAND NAME</label>
<div class="col-xs-4">
<input type="text" class="form-control"  name="empfathername" value="<?php echo $GLOBALS ['xEmpFatherName']; ?>" placeholder="" >
</div></div></br></br>
<div class="form-group">
<label  class="control-label col-xs-2">ADDRESS</label>
<div class="col-xs-4" style="text-align: left;"><textarea class="form-control" rows="3" cols="15" name="empaddress" style="float:right"><?php echo $GLOBALS ['xEmpAddress']; ?></textarea>
</div></div></br>
</br></br></br>

</div><!-- EMPLOYEE DETAILS Panel Ended!-->
</div><!--  EMPLOYEE DETAILS Panel Ended!-->


<div class="panel panel-default">

<div class="panel-heading">OFFICE DETAILS</div>
  <div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2">JOINING DATE & DEPT</label>
<div class="col-xs-2">
<input type="date" class="form-control"  name="empdoj"  id="empdoj" value="<?php echo $GLOBALS ['xEmpDoj']; ?>" placeholder="" >
</div>
<div class="col-xs-3">
<select class="form-control" id="" value="" name="departmentno">
<?php
$result = mysql_query("SELECT *  FROM m_department where departmentno!=0");
while($row = mysql_fetch_array($result))
{
?>
<option value = "<?php echo $row['departmentno']; ?>" 
<?php
if ($row['departmentname']== $GLOBALS ['xEmpDepartment']){
echo 'selected="selected"';
 } 
?> >
<?php echo $row['departmentname']; ?> 
</option>
<?php
}
echo "</select>";
?>
</div>
</div>
</br>  </br>
              
<div class="form-group">
<label  class="control-label col-xs-2">GOVERNMENT ID & TYPE</label>
<div class="col-xs-3">
<input type="text" class="form-control"  name="empgovernmentid" value="<?php echo $GLOBALS ['xEmpGovernmentId']; ?>" placeholder="" >
</div>
<div class="col-xs-2">
<select class="form-control" id="" value="" name="empgovernmentidtype">
<option value="VOTER" <?php if($GLOBALS ['xEmpGovernmentIdType']=="VOTER") echo 'selected="selected"'; ?>>VOTER</option>
<option value="AADHAR" <?php if( $GLOBALS ['xEmpGovernmentIdType']=="AADHAR") echo 'selected="selected"'; ?>>AADHAR</option>
<option value="OTHERS" <?php if($GLOBALS ['xEmpGovernmentIdType']=="OTHERS") echo 'selected="selected"'; ?>>OTHERS</option>
</select>
</div>
</div></br></br>
   <div class="form-group">
<label  class="control-label col-xs-2">PF & ESI NO</label>
<div class="col-xs-2">
<input type="text" class="form-control"  name="emppfno" 	value="<?php echo $GLOBALS ['xEmpPfNo']; ?>" >
</div>
<div class="col-xs-2">
<input type="text" class="form-control"  name="empesino" 	value="<?php echo $GLOBALS ['xEmpEsiNo']; ?>" >
</div>
</div></br></br>

<div class="form-group">
 <label  class="control-label col-xs-2">PAYMENT MODE </label>
<div class="col-xs-2" >
<select class="form-control" id="" value="" name="emppaymentmode">
<option value="CASH" <?php if($GLOBALS ['xEmpPaymentMode']=="CASH") echo 'selected="selected"'; ?>>CASH</option>
<option value="CHEQUE" <?php if( $GLOBALS ['xEmpPaymentMode']=="CHEQUE") echo 'selected="selected"'; ?>>CHEQUE</option>
<option value="ONLINE" <?php if($GLOBALS ['xEmpPaymentMode']=="ONLINE") echo 'selected="selected"'; ?>>ONLINE</option>
</select>

</div>
</div></br></br>

<?php
if(($GLOBALS ['xCurrentUser']=="admin") || ($GLOBALS ['xCurrentUserRole']=="S" ))
{
?>
<div class="form-group">
<label  class="control-label col-xs-2">BASIC SALARY</label>
<div class="col-xs-2" ><input type="text" class="form-control"  name="empbasicsalary" value="<?php echo $GLOBALS ['xEmpBasicSalary']; ?>" placeholder="" >
</div></div></br></br>
<?
}
?>
<div class="form-group">
 <label  class="control-label col-xs-2">BASIC & DA </label>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empbasic" value="<?php echo $GLOBALS ['xEmpBasic']; ?>" placeholder="BASIC" >
</div>
 <div class="col-xs-2" >
 <input type="text" class="form-control"  name="empda" value="<?php echo $GLOBALS ['xEmpDa']; ?>" placeholder="DA" >
</div></div></br></br>

<div class="form-group">
<label  class="control-label col-xs-2">ALL & HRA </label>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empallowance" value="<?php echo $GLOBALS ['xEmpAllowance']; ?>" placeholder="ALLOWANCE" >
</div>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="emphra" value="<?php echo $GLOBALS ['xEmpHra']; ?>" placeholder="HRA" >
</div> </div></br></br>

<div class="form-group">
<label  class="control-label col-xs-2">INCENTIVE & DEDUCTION</label>
<div class="col-xs-2" >

<input type="text" class="form-control"  name="empincentive" value="<?php echo $GLOBALS ['xEmpIncentive']; ?>" placeholder="INCENTIVE">
</div>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empdeduction" value="<?php echo $GLOBALS ['xEmpDeduction']; ?>" placeholder="DEDUCTION" >
</div></div></br></br>
</div><!-- OFFICE DETAILS Panel Ended!-->
</div><!--  OFFICE DETAILS Panel Ended!-->

<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
</div><!-- Main Panel Ended!-->
</div><!-- Main Panel Ended!-->
</form>
</body>
</html>