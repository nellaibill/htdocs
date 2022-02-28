<?php
include 'globalfile.php';
fn_DataClear();
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

function fn_DataClear()
{
	        $GLOBALS ['xstockno'] ='';
			$GLOBALS ['xItemNo'] ='';
			$GLOBALS ['xCurrentStock'] = '';
            $GLOBALS ['xMinStock'] ='';
            $GLOBALS ['xMaxStock'] = '';
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
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xCurrentStock'] = $row ['stock'];
            $GLOBALS ['xMinStock'] = $row ['minstock'];
            $GLOBALS ['xMaxStock'] = $row ['maxstock'];
 		}
	}
}

function DataProcess($mode) {
$xstockno= $_POST ['f_txno'];
$xItemNo= $_POST ['f_itemno'];
finditemname($xItemNo);
$xPackNo=    $GLOBALS['xPackNo'] ;
$xPackDescription= $GLOBALS['xPackDescription'] ;
$xCurrentStock= $_POST ['f_currentstock']*$xPackNo;
$xMinStock= $_POST ['f_minstock'];
$xMaxStock= $_POST ['f_maxstock'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
  {
   $xQry = "INSERT INTO inv_stockentry  VALUES ($xstockno,$xItemNo,$xCurrentStock,$xMinStock,$xMaxStock)";
   $xMsg="Inserted";
  } 
elseif ($mode == 'U')
{
   $xQry = "UPDATE inv_stockentry   SET itemno=$xItemNo,stock=$xCurrentStock,minstock=$xMinStock,maxstock=$xMaxStock WHERE stockno=$xstockno";
   $xMsg="Updated";
   header('Location: inv_ht002stockentry.php'); 
} 
elseif ($mode == 'D') 
  {
   $xQry = "DELETE FROM inv_stockentry   WHERE stockno=$xstockno";
   $xMsg="Deleted";
}

/*$result = mysql_query("SELECT * FROM inv_stockentry   WHERE itemno=$xItemNo");
$num_rows = mysql_num_rows($result);
if ($num_rows) {
echo '<script type="text/javascript">sweetAlert();
</script>'; 
}
else
{*/
  $retval = mysql_query ( $xQry ) or die ( mysql_error () );
  if (! $retval) { die ( 'Could not enter data: ' . mysql_error () ); }
//}
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


$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
function sweetAlert() 
{
	swal({   title: "Auto close alert!",   text: "I will close in 2 seconds.",   timer: 2000,   showConfirmButton: false });
}
function validateForm() 
 {
 
 var xCurrentStock= document.forms["frmstockentry"]["f_currentstock"].value;
 var xMinStock= document.forms["frmstockentry"]["f_minstock"].value;
 var xMaxStock= document.forms["frmstockentry"]["f_maxstock"].value;
 if (xCurrentStock== null || xCurrentStock== "") 
    {
        alert("Currrent-Stock Required");
        document.frmstockentry.f_currentstock.focus();
        return false;
    }
    if (xMinStock== null || xMinStock== "") 
    {
        alert("Minimum Stock Required");
        document.frmstockentry.f_minstock.focus();
        return false;
    }
    if (xMaxStock== null || xMaxStock== "") 
    {
        alert("Maximum  Stock Required");
        document.frmstockentry.f_maxstock.focus();
        return false;
    }

}

</script>
<body>


<form class="form" name="frmstockentry" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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


<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">PRODUCT NAME</label>
<div class="col-xs-4">
<select class="form-control"  name="f_itemno"  >
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

             <?php
              }
   
             ?>
             </select>
					</div>

</div>
</div>
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">CURRENT STOCK AND  MIN STOCK</label>
<div class="col-xs-2">
<input type="text" class="form-control"  name="f_currentstock" value="<?php echo $GLOBALS ['xCurrentStock']; ?>" placeholder="CurrentStock" >
</div>
<div class="col-xs-2">
<input type="text" class="form-control"  name="f_minstock" value="<?php echo $GLOBALS ['xMinStock']; ?>" placeholder="MinStock" >
</div>

<div class="col-xs-2">
<input type="text" class="form-control"  name="f_maxstock" value="<?php echo $GLOBALS ['xMaxStock']; ?>" placeholder="MaxStock" >
</div>

</div><br><br>
<div class="panel-footer clearfix">
        <div class="pull-right">
          <?php if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <?php } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <?php }  ?>
        </div>
</div>
</div>

</form>
<hr>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Stocks As On ". date("d/M/y h:i:sa"); ?></b></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>

           <th width="30%"> ITEMNAME</th>
           <th width="10%"> STOCK</th>
<!--
           <th width="10%"> MINSTOCK</th>
           <th width="10%"> MAXSTOCK</th>
!-->
           <th colspan="2" width="5%">ACTIONS</th>
 </tr>
      </thead>
      <tbody class="searchable">

<?php
$xQry='';
$xSlNo=0;
//$xQry="SELECT *  from inv_stockentry  order by  stockno"; 
$xQry="SELECT *  from inv_stockentry s,m_item i where i.itemno=s.itemno  order by  i.itemname";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
  echo '<tr>';
    echo '<td>' .  $xSlNo+=1 . '</td>';
    finditemname($row['itemno']);
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['stock']  . '</td>';
/*
    echo '<td>' . $row['minstock']  . '</td>';
    echo '<td>' . $row['maxstock']  . '</td>';
*/

?>

<!-- 
<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
!-->
<?php

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