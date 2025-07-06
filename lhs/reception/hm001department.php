<?php
include 'globalfile.php';
if ( isset( $_GET['departmentno'] ) && !empty( $_GET['departmentno'] ) )
{
  $no= $_GET['departmentno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['departmentno']);
   }
   else
   {
      $xQry = "DELETE FROM m_department  WHERE departmentno= $no";
      mysql_query ( $xQry );
      header('Location: hrm_hr001department.php'); 	
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
$sql="SELECT  CASE WHEN max(departmentno)IS NULL OR max(departmentno)= '' 
       THEN '1' 
       ELSE max(departmentno)+1 END AS departmentno
FROM m_department";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xDepartmentNo'] = $row ['departmentno'];
	}
}

function DataFetch($xtxno) {
    $result = mysql_query ( "select * from m_department where departmentno=$xtxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xDepartmentNo'] = $row ['departmentno'];
 		$GLOBALS ['xDepartmentName'] = $row ['departmentname'];
		$GLOBALS ['xDepartmentColor'] = $row ['departmentcolor'];
	}
	}
}

function DataProcess($mode) {
$xDepartmentNo= $_POST ['f_departmentno'];
$xDepartmentName= strtoupper($_POST ['f_departmentname']);
$xColor= $_POST ['f_color'];
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_department VALUES ($xDepartmentNo,'$xDepartmentName','$xColor')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_department  SET departmentname ='$xDepartmentName',departmentcolor='$xColor' WHERE departmentno=$xDepartmentNo";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_department WHERE departmentno=$xDepartmentNo";
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
<title>M-DEPARTMENT</title>
</head>
<script type="text/javascript">
function validateForm() 
 {
 
 var xDepartmentName= document.forms["departmentform"]["f_departmentname"].value;
 if (xDepartmentName== null || xDepartmentName== "") 
    {
        alert("DepartmentName must be filled out");
        document.departmentform.f_departmentname.focus();
        return false;
    }
   

}
</script>
<body onload='document.departmentform.f_departmentname.focus()'>
<form class="form" name="departmentform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">MASTER -DEPARTMENT NAME</h3>
</div>
<div class="panel-body">
<div class="form-group" style="display: none;">
  <label  class="control-label col-xs-3" > NO</label>
	<div class="col-xs-2">
	<input type="text" class="form-control" name="f_departmentno" value="<?php echo $GLOBALS ['xDepartmentNo']; ?>" readonly>
	</div>
</div>
<div class="form-group">
  <label for="lbltxno" class="control-label col-xs-3">DEPARTMENT NAME</label>
	<div class="col-xs-4">
	<input type="text" class="form-control"  name="f_departmentname" value="<?php echo $GLOBALS ['xDepartmentName']; ?>" placeholder="" >
	</div>
<div class="col-xs-1">
<input type="color" class="form-control" name="f_color" value="<?php echo $GLOBALS ['xDepartmentColor']; ?>">
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
		</form>
	</div>
</div>
</br>


<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW DEPARTMENTS</h3></div>
<table id="myTable" class="table table-striped" >  
      <thead>
        <tr>
           <th width="10%">S.NO</th>
           <th width="10%">DEPT NO</th>
           <th width="65%">DEPARTMENT NAME</th>
<?php
if($login_session=="admin")
{
?>
           <th colspan="2" width="5%">ACTIONS</td>
<?
}
?>
          </tr>
      </thead>
      <tbody>

<?php
$xSlNo=0;
$xQry="SELECT *  from m_department where departmentno!=0 order by departmentname;"; 
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    finddepartmentname($row['departmentno']);
    echo '<tr bgcolor="' . $GLOBALS['xDepartmentColor'].  '">';
    echo '<td>' .  $xSlNo+=1 . '</td>';
    echo '<td>' .  $row['departmentno'] . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
if($login_session=="admin")
{
?>
<td><a href="hrm_hm001department.php<?php echo '?departmentno='.$row['departmentno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="hrm_hm001department.php<?php echo '?departmentno='.$row['departmentno']. '&xmode=delete';  ?>" onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
}
echo '</tr>'; 
}

?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>


</body>
</html>