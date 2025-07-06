<?php
include 'globalfile.php';
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
 $result = mysql_query ( "SELECT EXISTS(SELECT 1 FROM banktransaction WHERE bankacno =50200007575244 LIMIT 1) as result" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) 
         {
	    if( $row ['result']==1)
               {
                  $xQry = "DELETE FROM bankdetails WHERE txno= $no";
                  mysql_query ( $xQry );
                  header('Location: hm009bankdetails.php'); 	
               }

          }
}
}
else
{
GetMaxIdNo ();
 $GLOBALS ['xAcNo']='';
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
elseif (isset ( $_POST ['edit'] )) 
{
	DataFetch ( $_POST ['txno']);
} 
elseif (isset ( $_POST ['delete'] )) 
{
	DataProcess ( "D" );
} 
elseif (isset ( $_POST ['previous'] )) 
{
       DataFetch ( $_POST ['txno']-1 );
} 
elseif (isset ( $_POST ['next'] )) 
{
	DataFetch ( $_POST ['txno']+1 );
}



function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' 
       ELSE max(txno)+1 END AS txno
FROM bankdetails";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
	}
}

function DataFetch($xTxno) {
    $result = mysql_query ( "SELECT *  FROM bankdetails where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	    $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xAcNo'] = $row ['acno'];
		$GLOBALS ['xAcName'] = $row ['acname'];
	}
	}
}

function DataProcess($mode) {
$xTxno = $_POST ['txno'];
$xAcNo= $_POST ['acno'];
$xAcName= $_POST ['acname'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO bankdetails VALUES ($xTxno,$xAcNo,'$xAcName')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xDate = $_POST ['date'];
$xQry = "UPDATE bankdetails  SET  acno=$xAcNo,acname='$xAcName' WHERE txno=$xTxno";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM bankdetails WHERE txno=$xTxno";
$xMsg="Deleted";
}
$retval = mysql_query ( $xQry ) or die ( mysql_error () );
if (! $retval) 
{
die ( 'Could not enter data: ' . mysql_error () );
}
//echo $xQry;
GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BANKDETAILS ENTRY</title>
  <SCRIPT language=Javascript>
   function validateForm() {
var xAccountNo= document.forms["addbankdetails"]["acno"].value;
var xAccountName= document.forms["addbankdetails"]["acname"].value;

if (xAccountNo== null || xAccountNo== "") {
	alert("Account No  must be filled out");
document.addbankdetails.acno.focus();
	return false;
}

if (xAccountName== null || xAccountName== "") {
	alert("Account Name must be filled out");
document.addbankdetails.acname.focus();
	return false;
}


}

      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   
   </SCRIPT>
</head>
<body onload='document.addbankdetails.acno.focus()'>
<form class="form" name="addbankdetails" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">MASTER -BANK DETAILS</h3>
</div>
<div class="panel-body">
<div class="form-group" >
<label  class="control-label col-xs-3">S.NO</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="xIdNo" name="txno" value="<?php echo $GLOBALS ['xIdno']; ?>" readonly>
</div>		                 
</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">ACCOUNT NO</label>
<div class="col-xs-3">
<input type="text" class="form-control"  name="acno"  maxlength="25" value="<?php echo $GLOBALS ['xAcNo']; ?>" onkeypress="return isNumberKey(event)" >
</div>
</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">ACCOUNT NAME</label>
<div class="col-xs-3"><input type="text" class="form-control"  name="acname"  maxlength="25" value="<?php echo $GLOBALS ['xAcName']; ?>"  >
</div></div></br></br>	
<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
		</form>
	</div>
</div>
</br>
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW BANK DETAILS</h3></div>
<table class="table">
      <thead>
        <tr>
          <th width="15%"> S.NO</th>
           <th width="15%">ACCOUNT NO</th>
           <th width="15%"> ACCOUNT NAME</th>
<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xQryFilter='';
$xEdit='edit';
$xDelete='delete';
$xTotalAmount=0;
$xDebit=0;
$xCredit=0;

if($xAcType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and actype='$xAcType'";
}
$xQry="SELECT *  from bankdetails order by  txno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['txno']  . '</td>';
    echo '<td>' . $row['acno']  . '</td>';
    echo '<td>' . $row['acname']  . '</td>';
   
?>
<td><a href="hm009bankdetails.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="hm009bankdetails.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
$xTotalAmount+= $row['amount'];
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body>
</html>
