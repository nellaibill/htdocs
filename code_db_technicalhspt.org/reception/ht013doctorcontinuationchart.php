<?php
include 'globalfile.php';
if ( isset( $_GET['testtypeno'] ) && !empty( $_GET['testtypeno'] ) )
{
  $no= $_GET['testtypeno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['testtypeno']);
   }
   else
   {
       $xQry = "DELETE FROM m_testtype WHERE testtypeno= $no";
       $result=mysql_query ( $xQry );
       if (!$result) {die('Invalid query: ' . mysql_error()); }
       else{ header('Location: ecg_hm001testtype.php'); 	}
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
$sql="SELECT  CASE WHEN max(testtypeno)IS NULL OR max(testtypeno)= '' 
       THEN '1' 
       ELSE max(testtypeno)+1 END AS testtypeno
FROM m_testtype";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTestTypeNo'] = $row ['testtypeno'];
	}
}

function DataFetch($xTestTypeNo) {
    $result = mysql_query ( "SELECT *  FROM m_testtype where testtypeno=$xTestTypeNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTestTypeNo'] = $row ['testtypeno'];
 		$GLOBALS ['xTestTypeName'] = $row ['testtypename'];
                $GLOBALS ['xTestNo'] = $row ['testno'];
 		$GLOBALS ['xTestAmount'] = $row ['testamount'];
$GLOBALS ['xFlimType']=$row ['flimtype'];
	}
	}
}

function DataProcess($mode) {
$xTestTypeNo= $_POST ['f_txno'];
$xTestTypeName= strtoupper($_POST ['f_testtypename']);
$xTestNo= $_POST ['f_testno'];
$xTestAmount= $_POST ['f_testamount'];
$xFlimType= $_POST ['f_flimtype'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_testtype  VALUES ($xTestTypeNo,'$xTestTypeName',$xTestNo,$xTestAmount,'$xFlimType')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_testtype   SET testtypename='$xTestTypeName',testno=$xTestNo,testamount=$xTestAmount,flimtype='$xFlimType' WHERE testtypeno=$xTestTypeNo";
$xMsg="Updated";
      header('Location: ecg_hm001testtype.php'); 
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_testtype   WHERE testtypeno=$xTestTypeNo";
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
<title>DOCTOR CONTINUATION CHART</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 
 var xTestTypeName= document.forms["testform"]["f_testtypename"].value;
 var xTestTypeAmount= document.forms["testform"]["f_testamount"].value;
 if (xTestTypeName== null || xTestTypeName== "") 
    {
        alert("Test Type-Name must be filled out");
        document.testform.f_testtypename.focus();
        return false;
    }
    if (xTestTypeAmount== null || xTestTypeAmount== "") 
    {
        alert("Test Type-Amount must be filled out");
        document.testform.f_testamount.focus();
        return false;
    }

}

</script>
<body onload='document.testform.f_testtypename.focus()'>
<div>
<form class="form" name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">DOCTOR CONTINUATION CHART</h3>
</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-2"> NO</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xTestTypeNo']; ?>" readonly>
</div>
</div>
</br></br>



<div class="form-group">
<label for="lbltxno" class="control-label col-xs-2">Patient Id</label>
<div class="col-xs-2">
<input type="text" class="form-control"  name="f_testtypename">
</div>
<div class="col-xs-2">
<input type="date" class="form-control"  name="f_testtypename">
</div>
</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-2">CLINICAL FINDINGS</label>
<div class="col-xs-3">
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right"></textarea>
</div>
<label for="lbltxno" class="control-label col-xs-2">ORDERS</label>
<div class="col-xs-3">
<textarea class="form-control" rows="3" cols="15" name="f_address" style="float:right"></textarea>
</div>
</div></br></br>


</div></div>

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
