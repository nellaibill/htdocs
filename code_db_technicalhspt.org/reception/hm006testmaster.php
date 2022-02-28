<?php
include 'globalfile.php';
if ( isset( $_GET['testno'] ) && !empty( $_GET['testno'] ) )
{
  $no= $_GET['testno'];
  if($_GET['xmode']=='edit')
   {
    DataFetch ( $_GET['testno']);
   }
   else
   {
      $xQry = "DELETE FROM m_test WHERE testno= $no";
      mysql_query ( $xQry );
      header('Location: hm006testmaster.php'); 	
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
$sql="SELECT  CASE WHEN max(testno)IS NULL OR max(testno)= '' 
       THEN '1' 
       ELSE max(testno)+1 END AS testno
FROM m_test";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTestNo'] = $row ['testno'];
	}
}

function DataFetch($xTestNo) {
    $result = mysql_query ( "SELECT *  FROM m_test where testno=$xTestNo" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xTestNo'] = $row ['testno'];
 		$GLOBALS ['xTestName'] = $row ['testname'];
	}
	}
}

function DataProcess($mode) {
$xTestNo= $_POST ['f_txno'];
$xTestName= strtoupper($_POST ['f_testname']);
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_test  VALUES ($xTestNo,'$xTestName')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_test   SET testname='$xTestName' WHERE testno=$xTestNo";
$xMsg="Updated";
      header('Location: hm006testmaster.php'); 
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_test   WHERE testno=$xTestNo";
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
<title>M-DOCTOR</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 
 var xTestName= document.forms["testform"]["f_testname"].value;
 if (xTestName== null || xTestName== "") 
    {
        alert("Doctor-Name must be filled out");
        document.testform.f_testname.focus();
        return false;
    }
   

}

    document.getElementById("save").value="SAVE"; 
function changeupdate()
{
    document.getElementById("save").value="UPDATE"; 
}

</script>
<body onload='document.testform.f_testname.focus()'>
<div>
<center><h3 id="headertext">MASTER -TEST</h3></center>
		<form class="form" name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>"
			method="post">

			<fieldset>
<div>
				
				</div></br>
                 <div class="form-group">

					<label  class="control-label col-xs-3"> NO</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" id="f_txno"
							name="f_txno" value="<?php echo $GLOBALS ['xTestNo']; ?>"
readonly>
							 </div>
								                 
				</div>

</br></br>
				
	

     <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-3">TEST  NAME</label>
					<div class="col-xs-4">
						<input type="text" class="form-control"  name="f_testname" 
							value="<?php echo $GLOBALS ['xTestName']; ?>" placeholder="" >
					</div>
				</div>
	</br></br>
				<div>
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
<input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()"> 
                                               
						
				</div>
			</fieldset>
		</form>
	</div>


<hr>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<center><h3 id="headertext"> VIEW - MASTER TEST</h3></center>
<div id="divToPrint" >
  <div class="container">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
           <th width="15%">TEST NO</th>
           <th width="15%"> TEST NAME</th>
<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xQry="SELECT *  from m_test order by  testno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['testno']  . '</td>';
    echo '<td>' . $row['testname']  . '</td>';
   
?>
<td><a href="hm006testmaster.php<?php echo '?testno='.$row['testno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="hm006testmaster.php<?php echo '?testno='.$row['testno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
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

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>
</body>
</html>