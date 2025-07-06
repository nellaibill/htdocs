<?php
include 'globalfile.php';
IniSetup();
function IniSetup()
{
DataClear();
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
      $xQry = "DELETE FROM m_eb WHERE txno= $no";
      mysql_query ( $xQry );
      header('Location: hm004eb.php'); 	
   }
}
else
 {
        $GLOBALS ['xEbNo'] = '';
 	$GLOBALS ['xEbName'] = '';
 	$GLOBALS ['xEbShortName'] = '';
 	$GLOBALS ['xCurrentReading'] = '';
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
}
function DataClear()
{
$GLOBALS ['xMode']='';
}
function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' 
       ELSE max(txno)+1 END AS txno
FROM m_eb";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTxNo'] = $row ['txno'];
	}
}

function DataFetch($xTxNo) {
    $result = mysql_query ( "SELECT *  FROM m_eb where txno=$xTxNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTxNo'] = $row ['txno'];
 		$GLOBALS ['xEbNo'] = $row ['ebno'];
 		$GLOBALS ['xEbName'] = $row ['ebname'];
 		$GLOBALS ['xEbShortName'] = $row ['shortname'];
 		$GLOBALS ['xCurrentReading'] = $row ['currentreading'];
	}
	}
}

function DataProcess($mode) {
$xTxNo= $_POST ['f_txno'];
$xEbNo= strtoupper($_POST ['f_ebno']);
$xEbName=strtoupper( $_POST ['f_ebname']);
$xEbShortName=strtoupper( $_POST ['f_ebshortname']);
$xCurrentReading=$_POST ['f_currentreading'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_eb VALUES ($xTxNo,'$xEbNo','$xEbName','$xEbShortName','$xCurrentReading')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_eb SET ebno='$xEbNo',ebname='$xEbName',shortname='$xEbShortName',currentreading='$xCurrentReading' WHERE txno=$xTxNo";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_eb WHERE txno=$xTxNo";
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
<title>M-EB</title>
</head>
<script type="text/javascript">

function validateForm() {
var xEbNo= document.forms["ebform"]["f_ebno"].value;
var xEbName= document.forms["ebform"]["f_ebname"].value;

 if (xEbNo== null || xEbNo== "") {
        alert("Please Enter Eb No");
document.ebform.f_ebno.focus();
        return false;
    }

 if (xEbName== null || xEbName== "") {
        alert("Eb-Name must be filled out");
document.ebform.f_ebname.focus();
        return false;
    }
   

}

</script>
<body onload='document.ebform.f_ebno.focus()'>
<form class="form" name="ebform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">MASTER - EB DATA ENTRY</h3>
</div>
    <div class="panel-body">
    <div class="form-group">
                     <label  class="control-label col-xs-3"> NO</label>
		      <div class="col-xs-2">
                         <input type="text" class="form-control" id="txno" name="f_txno" value="<?php echo $GLOBALS ['xTxNo']; ?>"readonly>
		      </div>
     </div></br></br>
    <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-3">EB-NO</label>
					<div class="col-xs-4">
						<input type="text" class="form-control"  name="f_ebno" 
							value="<?php echo $GLOBALS ['xEbNo']; ?>" placeholder="" >
					</div>
     </div></br></br>
     <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-3">EB-NAME</label>
					<div class="col-xs-4">
						<input type="text" class="form-control"  name="f_ebname" 
							value="<?php echo $GLOBALS ['xEbName']; ?>" placeholder="" >
					</div>
     </div></br></br>
     <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-3">EB-SHORT NAME</label>
					<div class="col-xs-4">
						<input type="text" class="form-control"  name="f_ebshortname" 
							value="<?php echo $GLOBALS ['xEbShortName']; ?>" placeholder="" >
					</div>
     </div></br></br>
    <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-3">CURRENT READING</label>
					<div class="col-xs-4">
						<input type="text" class="form-control"  name="f_currentreading" 
							value="<?php echo $GLOBALS ['xCurrentReading']; ?>" placeholder="" >
					</div>
     </div>
</div> 
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


<div id="divToPrint" >


<div class="container">
  <div class="row">
      <div class="panel panel-primary">
      <div class="panel-heading text-center">
           <h4>MASTER EB -DETAILS </h4>
        </div>

        <table class="table table-fixed">
 <thead>
        <tr>
           <th width="15%">EB-NO</th>
           <th width="15%">EB-NAME</th>
           <th width="15%">CURRENT READING</th>
<?php
if ($login_session == "admin") {
?>
           <th colspan="2" width="10%">ACTIONS</td>
<?
}
?>
          </tr>
      </thead>
          <tbody>
            <?php
$xQry="SELECT *  from m_eb order by ebname;"; 
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['ebno']  . '</td>';
    echo '<td>' . $row['ebname']  . '</td>';
    echo '<td>' . $row['currentreading']  . '</td>';
if ($login_session == "admin") {
?>
<td width="5%"><a href="hm004eb.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hm004eb.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
}
echo '</tr>'; 
}

?>
          </tbody>
        </table>
      </div>
  </div>
</div>

</form>
</body>
</html>