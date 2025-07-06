<?php
include 'globalfunctions.php';
include 'config.php';
//include 'menu.html';
			$GLOBALS ['xAcNo'] ='';
			$GLOBALS ['xName'] ='';
			$GLOBALS ['xxOpeningdt'] ='';
			$GLOBALS ['xPrincipalamt'] ='';
			$GLOBALS ['$xTds'] ='';
			$GLOBALS ['$xInterest'] ='';
			$GLOBALS ['xMaturityamt'] ='';
			$GLOBALS ['xMaturitydt'] ='';
			$GLOBALS ['xAccountHolderName'] ='';
			

if (isset ( $_GET ['fd_renewal_id'] ) && ! empty ( $_GET ['fd_renewal_id'] )) {
	$xId = $_GET ['fd_renewal_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['fd_renewal_id'] );
	} else {
		$xQry = "DELETE FROM fd_renewal WHERE fd_renewal_id=$xId";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: fd_renewal.php' );
		}
	}
} else {
	fn_DataClear ();
}

function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(fd_renewal_id)IS NULL OR max(fd_renewal_id)= '' 
THEN '1' ELSE max(fd_renewal_id)+1 END AS fd_renewal_id FROM fd_renewal";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xId'] = $row ['fd_renewal_id'];
	}
}
// Post Method Data To be Executed Here

if (isset ( $_POST ['save'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
function DataFetch($xId) {
	$result = mysql_query ( "SELECT *  FROM fd_renewal WHERE fd_renewal_id=$xId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
					$GLOBALS ['xId'] = $row ['fd_renewal_id'];
			$GLOBALS ['xAcNo'] = $row ['accnum'];
			$GLOBALS ['xName'] = $row ['bankname'];
			$GLOBALS ['xxOpeningdt'] = $row ['openingdt'];
			$GLOBALS ['xPrincipalamt'] = $row ['principalamt'];
			$GLOBALS ['$xTds'] = $row ['tds'];
			$GLOBALS ['$xInterest'] = $row ['interest'];
			$GLOBALS ['xMaturityamt'] = $row ['maturityamt'];
			$GLOBALS ['xMaturitydt'] = $row ['maturitydate'];
			$GLOBALS ['xAccountHolderName'] = $row ['account_holder_name'];
		}
	}
}
function DataProcess($mode) {
    	$xId= $_POST['f_id'];
	$xAcNo= $_POST['f_accno'];
	$xName = $_POST['f_name'];
	$xOpeningdt = $_POST['f_Openingdt'];
	$xPrincipalamt =	$_POST['f_Principalamt'];
	$xMaturityamt = $_POST['f_maturityamt'];
	$xMaturitydt=$_POST['f_maturitydt'];
	$xInterest = $xMaturityamt-$xPrincipalamt;
	$xTds = $xInterest*10/100;
	$xAccountHolderName=$_POST['f_account_holder_name'];
	
	if ($mode == 'S') {
		$xQry = "INSERT INTO fd_renewal(fd_renewal_id,bankname,accnum,openingdt,principalamt,tds,interest,maturityamt,maturitydate,account_holder_name) 
		VALUES ($xId,'$xName','$xAcNo','$xOpeningdt','$xPrincipalamt','$xTds',$xInterest,'$xMaturityamt','$xMaturitydt','$xAccountHolderName')";
		$xMsg = "Added";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE fd_renewal   SET bankname='$xName',accnum='$xAcNo',openingdt='$xOpeningdt',principalamt='$xPrincipalamt',tds='$xTds',interest=$xInterest,maturityamt='$xMaturityamt',maturitydate='$xMaturitydt',account_holder_name='$xAccountHolderName' where fd_renewal_id=$xId";
		$xMsg = "Updated";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	//ShowAlert ( $xMsg );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xName'] = '';
		$GLOBALS ['$xTds']=0.00;
		GetMaxIdNo(0);
}

?>



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body onload='document.ht001banktransaction.acno.focus()'>
<form class="form" name="ht001banktransaction" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center">FD - RENEWAL</h3>
</div>
<div class="panel-body">


 <div class="form-group">
     
        <div class="col-xs-3"><label>Id</label> <input type="text" readonly class="form-control" name="f_id" value="<?php echo $GLOBALS ['xId']; ?>">
                        
                        </div>
                        <div class="col-xs-3"><label>Select Bank:</label> 
                        <select class="form-control" name="f_name">
<option value="HDFC BANK" <?php if($GLOBALS ['xName']=="HDFC BANK") echo 'selected="selected"'; ?>>HDFC BANK</option>
                 
<option value="STATE BANK OF INDIA" <?php if($GLOBALS ['xName']=="STATE BANK OF INDIA") echo 'selected="selected"'; ?>>STATE BANK OF INDIA</option>

<option value="INDIAN BANK" <?php if($GLOBALS ['xName']=="INDIAN BANK") echo 'selected="selected"'; ?>>INDIAN BANK</option>
                        
<option value="City Union Bank" <?php if($GLOBALS ['xName']=="City Union Bank") echo 'selected="selected"'; ?>>City Union Bank</option>

<option value="BANDAN BANK" <?php if($GLOBALS ['xName']=="BANDAN BANK") echo 'selected="selected"'; ?>>BANDAN BANK</option>

<option value="POST OFFICE(KVP)" <?php if($GLOBALS ['xName']=="POST OFFICE(KVP)") echo 'selected="selected"'; ?>>POST OFFICE(KVP)</option>


                        </select>
                        
                        </div>

   
         <div class="col-xs-3"><label>A/c No:</label> <input type="text" class="form-control" name="f_accno" value="<?php echo $GLOBALS ['xAcNo']; ?>">
                        
                        </div>
                        
                                 <div class="col-xs-3"><label>Opening Date:</label> <input type="date" class="form-control" name="f_Openingdt" value="<?php echo $GLOBALS ['xxOpeningdt']; ?>">
                        
                        </div>
                                 <div class="col-xs-3"><label>Principal Amount:</label> <input type="number" class="form-control" name="f_Principalamt" value="<?php echo $GLOBALS ['xPrincipalamt']; ?>">
                        
                        </div>
                        
                        
                    
                        
                                 <div class="col-xs-3"><label>TDS:</label> <input type="text" class="form-control"
								  name="f_tds" value="<?php echo $GLOBALS ['$xTds']; ?>" readonly>
                        
                        </div>
                        
                           <div class="col-xs-3"><label>Interest:</label> <input type="text" class="form-control" name="f_interest" value="<?php echo $GLOBALS ['$xInterest']; ?>" readonly>
                        
                        </div>
                         <div class="col-xs-3"><label>Maturity Date:</label> <input type="date" class="form-control" name="f_maturitydt" value="<?php echo $GLOBALS ['xMaturitydt']; ?>">
                        
                        </div>
                                 <div class="col-xs-3"><label>Maturity Amount:</label> <input type="text" class="form-control" name="f_maturityamt" value="<?php echo $GLOBALS ['xMaturityamt']; ?>">
                        
                        </div>
                             <div class="col-xs-3"><label>Select Name:</label> 
                        <select class="form-control" name="f_account_holder_name">
<option value="ML" <?php if($GLOBALS ['xAccountHolderName']=="ML") echo 'selected="selected"'; ?>>ML</option>
<option value="LM" <?php if($GLOBALS ['xAccountHolderName']=="LM") echo 'selected="selected"'; ?>>LM</option>
<option value="MLANDLM" <?php if($GLOBALS ['xAccountHolderName']=="MLANDLM") echo 'selected="selected"'; ?>>MLANDLM</option>
<option value="KRISHNA" <?php if($GLOBALS ['xAccountHolderName']=="KRISHNA") echo 'selected="selected"'; ?>>KRISHNA</option>
<option value="MADHAVI" <?php if($GLOBALS ['xAccountHolderName']=="MADHAVI") echo 'selected="selected"'; ?>>MADHAVI</option>
                        </select>
                        
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



</body>
</html>