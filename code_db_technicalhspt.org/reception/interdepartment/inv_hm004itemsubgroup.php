<?php
include 'globalfile.php';
if ( isset( $_GET['itemsubgroupno'] ) && !empty( $_GET['itemsubgroupno'] ) )
{
  $no= $_GET['itemsubgroupno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['itemsubgroupno']);
   }
   else
   {
      $xQry = "DELETE FROM m_itemsubgroup WHERE itemsubgroupno= $no";
      mysql_query ( $xQry );
      echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
      header('Location: inv_hm004itemsubgroup.php'); 	
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
$sql="SELECT  CASE WHEN max(itemsubgroupno)IS NULL OR max(itemsubgroupno)= '' 
       THEN '1' 
       ELSE max(itemsubgroupno)+1 END AS itemsubgroupno
FROM m_itemsubgroup";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemSubGroupNo'] = $row ['itemsubgroupno'];
	}
}

function DataFetch($xitemsubgroupno) {
    $result = mysql_query ( "SELECT *  FROM m_itemsubgroup where itemsubgroupno=$xitemsubgroupno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {
                $GLOBALS ['xItemSubGroupNo'] = $row ['itemsubgroupno'];
 		$GLOBALS ['xItemSubGroupName'] = $row ['itemsubgroupname'];
                $GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];
 			}
	}
}

function DataProcess($mode) {
$xItemSubGroupNo= $_POST ['f_itemsubgroupno'];
$xItemSubGroupName= strtoupper($_POST ['f_itemsubgroupname']);
$xItemGroupNo= $_POST ['f_itemgroupno'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO m_itemsubgroup  VALUES ($xItemSubGroupNo,$xItemGroupNo,'$xItemSubGroupName')";
      echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE m_itemsubgroup   SET itemsubgroupname='$xItemSubGroupName',itemgroupno=$xItemGroupNo WHERE itemsubgroupno=$xItemSubGroupNo";
      echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM m_itemsubgroup   WHERE itemsubgroupno=$xItemSubGroupNo";
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
<title>Sub-Group</title>
</head>
<script type="text/javascript">
function validateForm() 
{
var xItemSubGroupName= document.forms["itemsubgroupform"]["f_itemsubgroupname"].value;
if (xItemSubGroupName== null || xItemSubGroupName== "") 
    {
        alert("Doctor-Name must be filled out");
        document.itemsubgroupform.f_itemsubgroupname.focus();
        return false;
    }
 }
</script>
<body onload='document.itemsubgroupform.f_itemsubgroupname.focus()'>
<form class="form" name="itemsubgroupform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
<div class="panel panel-success">
<div class="panel panel-info">
  <div class="panel-heading  text-center"><h3 class="panel-title">Master Item Sub-Group</h3></div>
<div class="panel-body">
<div class="form-group" >

<label  class="control-label col-xs-3"> NO</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" id="f_itemsubgroupno" name="f_itemsubgroupno" value="<?php echo $GLOBALS ['xItemSubGroupNo']; ?>" readonly>
	</div>
</div>
</br></br>
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">ITEM SUB GROUP NAME</label>
	<div class="col-xs-4">
		<input type="text" class="form-control"  name="f_itemsubgroupname" 
							value="<?php echo $GLOBALS ['xItemSubGroupName']; ?>" placeholder="" >
	</div>
</div>
	</br></br>
<div>
     <div class="form-group">
		<label for="lbltxno" class="control-label col-xs-3">CHOOSE GROUP</label>
		<div class="col-xs-4">
			 <select class="form-control"  value="" name="f_itemgroupno"  >
            <?php
            $result = mysql_query("SELECT *  FROM m_itemgroup order by itemgroupname");
            echo "<option value=''>Select Your Option</option>";
            while($row = mysql_fetch_array($result))
           {
             ?>

      <option value = "<?php echo $row['itemgroupno']; ?>" 
            <?php
                if ($row['itemgroupno']== $GLOBALS ['xItemGroupNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['itemgroupname']; ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
					</div>
				</div>
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
<hr>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-success">
<div class="panel-heading  text-center"><h3 class="panel-title">View Item Sub-Group</h3></div>
</div>
<div class="panel-body">
<table class="table table-hover" border="1" >
      <thead>
        <tr>
           <th width="15%">SUB-GROUP NAME</th>
           <th width="15%">GROUP NAME</th>
           <th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xQry="SELECT *  from m_itemsubgroup  where itemsubgroupno!=0 order by  itemsubgroupname"; 
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['itemsubgroupname']  . '</td>';
    finditemgroupname( $row['itemgroupno'] );
    echo '<td>' .  $GLOBALS ['xItemGroupName']  . '</td>';
       
?>
<td><a href="inv_hm004itemsubgroup.php<?php echo '?itemsubgroupno='.$row['itemsubgroupno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_hm004itemsubgroup.php<?php echo '?itemsubgroupno='.$row['itemsubgroupno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
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
</div>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>