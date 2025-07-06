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
$xQry = "DELETE FROM banktransaction WHERE txno= $no";
mysql_query ( $xQry );
header('Location: hr002banktransaction.php'); 
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
$sql="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
       THEN '1' 
       ELSE max(txno)+1 END AS txno
FROM banktransaction";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xIdno'] = $row ['txno'];
	}
}

function DataFetch($xTxno) {
    $result = mysql_query ( "SELECT *  FROM banktransaction where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) {

	    $GLOBALS ['xIdno'] = $row ['txno'];
		$GLOBALS ['xDate'] = $row ['date'];
		$GLOBALS ['xBankAcNo'] = $row ['bankacno'];
		$GLOBALS ['xChequeNo'] = $row ['chequeno'];
		$GLOBALS ['xAcType'] = $row ['actype'];
		$GLOBALS ['xAmount'] = $row ['amount'];
	}
	}
}

function DataProcess($mode) {
$xTxno = $_POST ['txno'];
$xDate= $_POST ['date'];
$xBankAcNo= $_POST ['bankacno'];
if($_POST ['chequeno']=='')
{
$xChequeNo=0;
}
else
{
$xChequeNo= $_POST ['chequeno'];
}
$xAcType= $_POST ['actype'];
$xAmount= $_POST ['amount'];
$xDetails= $_POST ['f_details'];

$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$xQry = "INSERT INTO banktransaction VALUES ($xTxno,'$xDate',$xBankAcNo,$xChequeNo,'$xAcType',$xAmount,'$xDetails')";
$xMsg="Inserted";
} 
elseif ($mode == 'U')
{
$xDate = $_POST ['date'];
$xQry = "UPDATE banktransaction  SET  date='$xDate',bankacno=$xBankAcNo,chequeno=$xChequeNo,actype='$xAcType',amount=$xAmount,details='$xDetails' WHERE txno=$xTxno";
$xMsg="Updated";
} elseif ($mode == 'D') 
{
$xQry = "DELETE FROM banktransaction WHERE txno=$xTxno";
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
<title>BANK TRANSACTION ENTRY</title>
</head>
<script type="text/javascript">

$(document).ready(function(){
$('#chequeno').blur(function(){ $('#actype').focus(); });

});

    document.getElementById("save").value="SAVE"; 

function validateForm() {
var xDate= document.forms["ht001banktransaction"]["date"].value;
var xBankAcNo= document.forms["ht001banktransaction"]["bankacno"].value;
var xAmount= document.forms["ht001banktransaction"]["amount"].value;

 if (xDate== null || xDate== "") {
        alert("Please Choose a Date");
document.ht001banktransaction.date.focus();
        return false;
    }

if (xBankAcNo== "Select Your Department") {
        alert("Please Choose An Ac/No");
document.ht001banktransaction.bankacno.focus();
        return false;
    }

 if (xAmount== null || xAmount== "") {
        alert("Please Enter An Amount");
document.ht001banktransaction.amount.focus();
        return false;
    }

}
function changeupdate()
{
    document.getElementById("save").value="UPDATE"; 
}

</script>
<body onload='document.ht001banktransaction.acno.focus()'>
<form class="form" name="ht001banktransaction" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">BANK TRANSACTION</h3>
</div>
<div class="panel-body">
<div class="form-group" >
<label  class="control-label col-xs-2">TX NO & DATE</label>
<div class="col-xs-2">
<input type="text" class="form-control" id="xIdNo" name="txno" value="<?php echo $GLOBALS ['xIdno']; ?>" placeholder="" readonly>
</div>
<div class="col-xs-2">
<input type="date" class="form-control"  name="date" value="<?php echo $GLOBALS ['xDate']; ?>" placeholder="" >
</div></div></br></br>

 <div class="form-group">
					<label for="lbltxno" class="control-label col-xs-2">A/c NAME & CHEQUE NO</label>
					<div class="col-xs-2">
					     <select class="form-control" id="" value="" name="bankacno">
						<?php
                                            $result = mysql_query("SELECT *  FROM bankdetails");
                                            while($row = mysql_fetch_array($result))
                                              {
                                                ?>
                                              <option value = "<?php echo $row['acno']; ?>" 
                                              <?php
                                              if ($row['acno']== $GLOBALS ['xBankAcNo']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['acname']; ?> 
                                          </option>
                                           <?php

                                            }
                                     echo "</select>";
                                   ?>

					</div>
	
					<div class="col-xs-2">
						<input type="text" class="form-control"  name="chequeno" id="chequeno" 
							value="<?php echo $GLOBALS ['xChequeNo']; ?>" placeholder="" >
					</div>
</div></br></br>
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-2">A/c Type &AMOUNT & Details</label>
<div class="col-xs-2">
<select class="form-control" id="actype" value="" name="actype" >
<option value="DEBIT" <?php if($GLOBALS ['xAcType']=="DEBIT") echo 'selected="selected"'; ?>>DEBIT</option>
<option value="LESSDEBIT" <?php if($GLOBALS ['xAcType']=="LESSDEBIT") echo 'selected="selected"'; ?>>LESSDEBIT</option>
<option value="CREDIT" <?php if( $GLOBALS ['xAcType']=="CREDIT") echo 'selected="selected"'; ?>>CREDIT</option>
<option value="LESSCREDIT" <?php if( $GLOBALS ['xAcType']=="LESSCREDIT") echo 'selected="selected"'; ?>>LESSCREDIT</option>
</select></div>

<div class="col-xs-2">
<input type="number" class="form-control"  name="amount" value="<?php echo $GLOBALS ['xAmount']; ?>" placeholder="" >
</div>

<div class="col-xs-4">
<input type="text" class="form-control"  name="f_details" value="<?php echo $GLOBALS ['xDetails']; ?>" placeholder="DETAILS" >
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
		</form>
	</div>
</div>
	</div>
</body>
</html>