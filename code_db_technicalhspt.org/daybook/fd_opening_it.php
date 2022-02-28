
<?php
include 'globalfunctions.php';
include 'config.php';
//include 'menu.html';

$GLOBALS ['xAcNo'] ='';
			$GLOBALS ['xName'] ='';
			$GLOBALS ['xxOpeningdt'] ='';
			$GLOBALS ['xPrincipalamt'] ='';
			$GLOBALS ['$xTds'] ='';
			$GLOBALS ['xMaturityamt'] ='';
			$GLOBALS ['xMaturitydt'] ='';
			$GLOBALS ['xAccountHolderName']='';

if (isset ( $_GET ['fd_opening_id'] ) && ! empty ( $_GET ['fd_opening_id'] )) {
	$xId = $_GET ['fd_opening_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['fd_opening_id'] );
	} else {
		$xQry = "DELETE FROM fd_opening WHERE fd_opening_id=$xId";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: fd_opening.php' );
		}
	}
} else {
	fn_DataClear ();
}

function GetMaxIdNo() {
$sql="SELECT  CASE WHEN max(fd_opening_id)IS NULL OR max(fd_opening_id)= '' 
THEN '1' ELSE max(fd_opening_id)+1 END AS fd_opening_id FROM fd_opening";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xId'] = $row ['fd_opening_id'];
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
	$result = mysql_query ( "SELECT *  FROM fd_opening WHERE fd_opening_id=$xId" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
					$GLOBALS ['xId'] = $row ['fd_opening_id'];
			$GLOBALS ['xInterest'] = $row ['interest'];
				$GLOBALS ['xNewTransaction'] = $row ['interest']/12;

		}
	}
}
function DataProcess($mode) {
    	$xId= $_POST['f_id'];
    //	$xTotal=$_POST['f_it_total'];
    //$xTotal=$_POST['f_it_total'];
    	$xItInterest=$_POST['f_it_interest'];
    	$xItDivideMonth=$_POST['f_it_divide_month'];
    	
    	$xTotal=$xItInterest/$xItDivideMonth;
    	
    	
    	$xMonth=$_POST['f_it_month'];
		$xInterest = $xTotal*$xMonth;
     	$xTds = $xInterest*10/100;
			$xAccountHolderName=$_POST['f_account_holder_name'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO fd_opening(fd_opening_id,bankname,accnum,openingdt,principalamt,tds,interest,maturityamt,maturitydate) 
		VALUES ($xId,'$xName','$xAcNo','$xOpeningdt','$xPrincipalamt','$xTds',$xInterest,'$xMaturityamt','$xMaturitydt')";
		$xMsg = "Added";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE fd_opening   SET it_tds='$xTds',it_interest=$xInterest where fd_opening_id=$xId";
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
		$GLOBALS ['$xTds']=10.00;
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
        <h3 class="panel-title text-center">FD - OPENING INTEREST (IT)</h3>
</div>
<div class="panel-body">


 <div class="form-group">
     
        <div class="col-xs-3"><label>Id</label> <input type="text" readonly class="form-control" name="f_id" value="<?php echo $GLOBALS ['xId']; ?>">
                        
                        </div>
                               
                    <div class="col-xs-2"><label>Interest:</label> <input type="text" class="form-control" name="f_it_interest"
                    readonly value="<?php echo $GLOBALS ['xInterest']; ?>">
                        
                        </div>
                              <div class="col-xs-2" ><label>Divide Month:</label> <input type="text"  
                              name="f_it_divide_month"
                              class="form-control" >
                        
                        </div>
                                 <div class="col-xs-2" style="display:none"><label>Total:</label> <input type="text" readonly class="form-control" name="f_it_total"  >
                        
                        </div>
                                 <div class="col-xs-3"><label>Enter Month:</label> <input type="text" class="form-control" name="f_it_month" >
                        
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