<?php
include 'globalfile.php';
DataClear();
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


function DataClear()
{
$GLOBALS ['xTestTypeNo']='';
$GLOBALS ['xTestTypeName']='';
$GLOBALS ['xTestNo']='';
$GLOBALS ['xTestAmount']='';
$GLOBALS ['xFlimType']='';
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
<title>M-TEST TYPE</title>
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
<div class="panel panel-success"  data-bind="nextFieldOnEnter:true">
<div class="panel-heading">
        <h3 class="panel-title  text-center">MASTER - TEST TYPE</h3>
</div>
<div class="panel-body">
<div class="form-group">
<label  class="control-label col-xs-3"> NO</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xTestTypeNo']; ?>" readonly>
</div>
</div>
</br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">TEST TYPE NAME</label>
<div class="col-xs-4">
<input type="text" class="form-control"  name="f_testtypename" value="<?php echo $GLOBALS ['xTestTypeName']; ?>"  maxlength="50">
</div>
</div></br></br>

<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3">TEST NAME & AMOUNT</label>
<div class="col-xs-2">
<select class="form-control"  value="" name="f_testno" id="ebno" >
            <?php
            $result = mysql_query("SELECT *  FROM m_test where testno in(1,2) order by testno");
            while($row = mysql_fetch_array($result))
           {
             ?>

      <option value = "<?php echo $row['testno']; ?>" 
            <?php
                if ($row['testno']== $GLOBALS ['xTestNo']){
                   echo 'selected="selected"';
                } 
            ?> >
            <?php echo $row['testname']; ?> 
            </option>

             <?php
              }
                echo "</select>";
             ?>
					</div>

<div class="col-xs-2">
<input type="text" class="form-control"  name="f_testamount" value="<?php echo $GLOBALS ['xTestAmount']; ?>" onkeypress="return restrictCharacters(this, event, integerOnly);" maxlength="5" >
</div>

<div class="col-xs-2">
	<select class="form-control"  value="" name="f_flimtype">
	  <option value="NONE" <?php if($GLOBALS ['xFlimType']=="NONE") echo 'selected="selected"'; ?>>NONE</option>
	  <option value="12*10" <?php if($GLOBALS ['xFlimType']=="12*10") echo 'selected="selected"'; ?>>12*10</option>
	  <option value="15*12" <?php if( $GLOBALS ['xFlimType']=="15*12") echo 'selected="selected"'; ?>>15*12</option>
	</select>
</div>

</div></br></br>
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
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW TEST TYPE</h3></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>
           <th width="20%"> TEST TYPE NAME</th>
           <th width="5%"> FLIM TYPE</th>
 <th width="10%"> TEST NAME</th>
 <th width="5%"> AMOUNT</th>
<?php
if ($login_session == "admin") {
?>
<th colspan="2" width="5%">ACTIONS</td>
<?php
}
?>

        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xQry="SELECT *  from m_testtype  order by  testtypeno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['testtypeno']  . '</td>';
    echo '<td>' . $row['testtypename']  . '</td>';
    echo '<td>' . $row['flimtype']  . '</td>';
    findtestname( $row['testno'] );
    echo '<td>' .  $GLOBALS ['xTestName']  . '</td>';
    echo '<td>' . $row['testamount']  . '</td>';
                 if ($login_session == "admin") {

?>
<td><a href="ecg_hm001testtype.php<?php echo '?testtypeno='.$row['testtypeno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="ecg_hm001testtype.php<?php echo '?testtypeno='.$row['testtypeno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?php
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

<script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,select,button,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
    </script>
	
</body>
</html>