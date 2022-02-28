<?php
include 'globalfile.php';
IniSetup();
function IniSetup()
{
 DataClear();
	if ( isset( $_GET['exgrpno'] ) && !empty( $_GET['exgrpno'] ) )
	{
	  $no= $_GET['exgrpno'];
	  if($_GET['xmode']=='edit')
	   {
                $GLOBALS ['xMode']='F';
		DataFetch ( $_GET['exgrpno']);
	   }
	   else
	   {
		  $xQry = "DELETE FROM expenses_group WHERE exgrpno= $no";
		  mysql_query ( $xQry );
		  header('Location: hm003expensesgroup.php'); 	
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

}

function DataClear()
{
$GLOBALS ['xMode']='';
}
function GetMaxIdNo() 
{
$sql="SELECT  CASE WHEN max(exgrpno)IS NULL OR max(exgrpno)= '' THEN '1' ELSE max(exgrpno)+1 END AS exgrpno FROM expenses_group";
$result = mysql_query ( $sql ) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) )
 {
	$GLOBALS ['xtxno'] = $row ['exgrpno'];
 }
}

	function DataFetch($xtxno) {
		$result = mysql_query ( "SELECT *  FROM expenses_group where exgrpno=$xtxno" ) or die ( mysql_error () );
		$count = mysql_num_rows($result);
		if($count>0){
		while ( $row = mysql_fetch_array ( $result ) ) {

				$GLOBALS ['xtxno'] = $row ['exgrpno'];
			$GLOBALS ['xExpGrpName'] = $row ['exgrpname'];
		}
		}
	}

	function DataProcess($mode) {
	$xTxNo= $_POST ['f_txno'];
	$xExpGrpName= strtoupper($_POST ['f_expgrpname']);
	$xQry="";
	$xMsg="";
	if ($mode == 'S') 
	{
	$xQry = "INSERT INTO expenses_group  VALUES ($xTxNo,'$xExpGrpName')";
	$xMsg="Inserted";
	} 
	elseif ($mode == 'U')
	{
	$xQry = "UPDATE expenses_group   SET exgrpname='$xExpGrpName' WHERE exgrpno=$xTxNo";
	$xMsg="Updated";
	} elseif ($mode == 'D') 
	{
	$xQry = "DELETE FROM expenses_group   WHERE exgrpno=$xTxNo";
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
	<title>M-EXPENSES GROUP</title>
	</head>
	<script type="text/javascript">
	function validateForm() 
	 {
	 var xExpGrpName= document.forms["expensesgroup"]["f_expgrpname"].value;
	 if (xExpGrpName== null || xExpGrpName== "") 
		{
			alert("Doctor-Name must be filled out");
			document.expensesgroup.f_expgrpname.focus();
			return false;
		}
	}
	</script>
<body onload='document.expensesgroup.f_expgrpname.focus()'>
<form class="form" name="expensesgroup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
	<h3 class="panel-title">MASTER - EXPENSES GROUP</h3>
</div>
<div class="panel-body">
<div class="form-group" style="display:none">
	<label  class="control-label col-xs-3"> NO</label>
	<div class="col-xs-2">
		<input type="text" class="form-control" id="f_txno" name="f_txno" value="<?php echo $GLOBALS ['xtxno']; ?>" readonly>
	</div>						                 
</div>	
<div class="form-group">
	<label for="lbltxno" class="control-label col-xs-3">GROUP NAME</label>
	<div class="col-xs-4">
	<input type="text" class="form-control"  name="f_expgrpname" value="<?php echo $GLOBALS ['xExpGrpName']; ?>" placeholder="" >
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
</form>
<!--
<style>
 table {
            width: 100%;
        }

        thead, tbody, tr, td, th { display: block; }

        tr:after {
            content: ' ';
            display: block;
            visibility: hidden;
            clear: both;
        }

        thead th {
            height: 50px;

            /*text-align: left;*/
        }

        tbody {
            height: 400px;
            overflow-y: auto;
        }

        thead {
            /* fallback */
        }


        tbody thead th {
            width: 75%;
            float: left;
        }
</style>
!-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW EXPENSES GROUP</h3></div>
	<table class="table">
      <thead>
        <tr>
           <th width="10%">S.NO</th>
           <th width="75%">EXPENSES GROUP NAME</th>
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
	$xQry="SELECT *  from expenses_group where exgrpno!=0 order by exgrpno;"; 
	$result2=mysql_query($xQry);
	while ($row = mysql_fetch_array($result2)) {
		echo '<tr>';
                echo '<td>' .  $xSlNo+=1 . '</td>';
		echo '<td>' . $row['exgrpname']  . '</td>';
	if ($login_session == "admin") {
	?>
	<td width="5%"><a href="hm003expensesgroup.php<?php echo '?exgrpno='.$row['exgrpno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<td width="5%"><a href="hm003expensesgroup.php<?php echo '?exgrpno='.$row['exgrpno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
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
	</body>
	</html>