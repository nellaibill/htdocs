<?php
include_once 'globalfunctions.php';
include_once 'config.php';
$xTodaysDate=date('Y-m-d');
$xNextDueDate = date('Y-m-d', strtotime("+90 days"));
	if (isset ( $_GET ['fd_opening_id'] ) && ! empty ( $_GET ['fd_opening_id'] )) {
	$xId = $_GET ['fd_opening_id'];
	if ($_GET ['xmode'] == 'change') {
        $xQry = "update fd_opening set status='Completed' WHERE fd_opening_id=$xId";
		$result = mysql_query ( $xQry );
			header ( 'Location: homepage_billing.php' );
	} 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css" />

<script type="text/javascript">
// JavaScript popup window function

function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=600,width=1300,left=25,top=20,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
}


</script>
<style >
.table-fixheader {
    position: relative;
    padding-top: 40px;
}
.table-fixheader>div {
    height:150px;
    overflow-y:auto;
}
.table-fixheader thead{
    position: absolute;
    width: 100%;
    top: 0;
}
.table-fixheader thead tr{
    position: absolute;
    width: 100%;
}
.table-fixheader thead tr th{
    display:inline-block;
}
      
         blink {
           color:red;
           -webkit-animation: blink 1s step-end infinite;
           animation: blink 1s step-end infinite
         }
 
          @-webkit-keyframes blink {
          67% { opacity: 0 }
         }
 
         @keyframes blink {
         67% { opacity: 0 }
        }

</style>


</head>
<body></br></br>
	<form class="form" name="accounts_payment"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			
		
       <div class="col-xs-3"><label>Select Bank:</label> 
                        <select class="form-control" name="f_bankname">
                            
                            <option value="ALL" <?php if($GLOBALS ['xName']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
                            
<option value="HDFC BANK" <?php if($GLOBALS ['xName']=="HDFC BANK") echo 'selected="selected"'; ?>>HDFC BANK</option>
                 
<option value="STATE BANK OF INDIA" <?php if($GLOBALS ['xName']=="STATE BANK OF INDIA") echo 'selected="selected"'; ?>>STATE BANK OF INDIA</option>

<option value="INDIAN BANK" <?php if($GLOBALS ['xName']=="INDIAN BANK") echo 'selected="selected"'; ?>>INDIAN BANK</option>

<option value="City Union Bank" <?php if($GLOBALS ['xName']=="City Union Bank") echo 'selected="selected"'; ?>>City Union Bank</option>

<option value="BANDAN BANK" <?php if($GLOBALS ['xName']=="BANDAN BANK") echo 'selected="selected"'; ?>>BANDAN BANK</option>
                        
                        </select>
                        
                        </div>

		<div>
			<input type="submit" name="search" class="btn btn-primary"
				value="SEARCH" id="search">
		</div>
		<br/>
	
			<br/>	<br/>	<br/>
		</form>
			<div id="divToPrint">
			<div class="row">
	
            <div class="col-sm-12" >
                <div class="panel panel-success">

                    <div class="panel-heading">Notification For FD-Opening Upto <?php echo date ( 'd/M/Y', strtotime ($xNextDueDate) ); ?><?php echo " Report Generated As On " . date("d/M/Y h:m:s a") . "<br>"; ?></div>
                    <div class="panel-body">
					<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>

						<th>BANK</th>			
						<th>A.NO</th>			
						<th>OPENINGDATE</th>			
						<th>PRINCIPAL AMOUNT</th>	
						<th>TDS</th>
							<th>MATURITYDATE</th>
						<th>MATURITY AMOUNT</th>
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

if (isSet ( $_POST ['search'] )) {
		$xBankName=$_POST ['f_bankname'];
	if($xBankName=="ALL")
	{
	    $xQry = "select  * from fd_opening WHERE  maturitydate< '$xNextDueDate' and status!='Completed'";
	}
	else
	{
	    $xQry = "select  * from fd_opening WHERE  maturitydate< '$xNextDueDate' and status!='Completed' and bankname='$xBankName' ";
	}


}
else{

$xQry = "select  * from fd_opening WHERE  maturitydate< '$xNextDueDate' and status!='Completed'";

}
//echo $xBankName;
//$xQry = "select  * from fd_opening WHERE (maturitydate BETWEEN '$xTodaysDate' //and '$xNextDueDate' and status!='Completed')";
//echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
				echo '<tr>';
	echo '<td>' . $row ['bankname'] . '</td>';
		echo '<td>' . $row ['accnum'] . '</td>';
			echo '<td>' . date ( 'd/M/Y', strtotime ( $row ['openingdt']  ) ) . '</td>';
			echo '<td align=right>' . $row ['principalamt'] . '</td>';
			echo '<td>' . $row ['tds'] . '</td>';
				echo '<td>' .date ( 'd/M/Y', strtotime ( $row ['maturitydate']  ) ) . '</td>';
			echo '<td align=right>' . $row ['maturityamt'] . '</td>';
			
			?>
			<!--
			<td><a
							href="homepage_billing.php<?php echo '?fd_opening_id='.$row['fd_opening_id']. '&xmode=change';  ?>"
							onclick="return confirm_edit()"> <img src="images/tick.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						!-->
						<?php
				echo '</tr>';
		
 } 
		$xGrandTotal += $row ['totalamount'];

	}
	


?>	

					
					
					
					
					
					</tbody>
				</table>

			</div>
			<!-- /container -->
					</div>
                </div>  </div>
           </br>
          
	
            
  



</body>


		</div>
</html>
