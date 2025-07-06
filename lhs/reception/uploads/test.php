<?php
include 'globalfile.php';
if ( isset( $_GET['stockno'] ) && !empty( $_GET['stockno'] ) )
{
  $no= $_GET['stockno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['stockno']);
   }
   else
   {
       $xQry = "DELETE FROM inv_stockentry WHERE stockno= $no";
       $result=mysql_query ( $xQry );
       if (!$result) {die('Invalid query: ' . mysql_error()); }
       else{ header('Location: inv_ht002stockentry.php'); 	}
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
$sql="SELECT  CASE WHEN max(stockno)IS NULL OR max(stockno)= '' 
       THEN '1' 
       ELSE max(stockno)+1 END AS stockno
FROM inv_stockentry";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xstockno'] = $row ['stockno'];
	}
}

function DataFetch($xstockno) {
    $result = mysql_query ( "SELECT *  FROM inv_stockentry where stockno=$xstockno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	        $GLOBALS ['xstockno'] = $row ['stockno'];
                finditemname($row['stockno']);
 		$GLOBALS ['xCurrentStock'] = $row ['stock'];
                $GLOBALS ['xMinStock'] = $row ['minstock'];
 		}
	}
}

function DataProcess($mode) {
$xstockno= $_POST ['f_txno'];
$xItemNo= $_POST ['f_itemno'];
$xCurrentStock= $_POST ['f_currentstock'];
$xMinStock= $_POST ['f_minstock'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO inv_stockentry  VALUES ($xstockno,$xItemNo,$xCurrentStock,$xMinStock)";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xQry = "UPDATE inv_stockentry   SET itemno=$xItemNo,stock=$xCurrentStock,minstock=$xMinStock WHERE stockno=$xstockno";
$xMsg="Updated";
      header('Location: inv_ht002stockentry.php'); 
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM inv_stockentry   WHERE stockno=$xstockno";
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
<title>STOCK-ENTRY</title>
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
        <h3 class="panel-title  text-center">STOCK ENTRY</h3>
</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-3"> NO</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xstockno']; ?>" readonly>
</div>
</div>
</br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">PRODUCT NAME</label>
<div class="col-xs-4">
<select class="form-control"  value="" name="f_itemno"  >
            <?php
            $result = mysql_query("SELECT *  FROM m_item order by itemname");
            while($row = mysql_fetch_array($result))
           {
             ?>

      <option value = "<?php echo $row['itemno']; ?>" 
            <?php
                if ($row['itemno']== $GLOBALS ['xItemNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['itemname']; ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
					</div>

</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">CURRENT STOCK & MIN STOCK</label>
<div class="col-xs-2">
<input type="text" class="form-control"  name="f_currentstock" value="<?php echo $GLOBALS ['xCurrentStock']; ?>" placeholder="" >
</div>
<div class="col-xs-2">
<input type="text" class="form-control"  name="f_minstock" value="<?php echo $GLOBALS ['xMinStock']; ?>" placeholder="" >
</div>

</div></br></br>
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
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW STOCKS</h3></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>
           <th width="10%"> ITEMNAME</th>
           <th width="10%"> STOCK</th>
           <th width="10%"> MINSTOCK</th>
<?php
if ($login_session == "admin") {
?>
<th colspan="2" width="5%">ACTIONS</td>
<?
}
?>

        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT *  from inv_stockentry  order by  stockno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
  echo '<tr>';
    echo '<td>' .  $xSlNo+=1 . '</td>';
    finditemname($row['itemno']);
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['stock']  . '</td>';
    echo '<td>' . $row['minstock']  . '</td>';

                 if ($login_session == "admin") {

?>
<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
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
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>