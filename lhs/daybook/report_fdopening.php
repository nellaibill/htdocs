<?php
ob_start ();
include('globalfunctions.php');
include 'config.php';
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$xPrincipalAmount=0;
$xMaturityAmount=0;
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Report</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body onload='document.accounts_payment.f_amount.focus()'>
	<form class="form" name="accounts_payment"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="col-xs-2">
			<label>Opening From Date:</label> <input class="form-control"
				name="f_fromdate" type="date"
				value="<?php echo $GLOBALS ['xFromDate']; ?>">
		</div>

		<div class="col-xs-2">
			<label>Opening To Date:</label> <input class="form-control" name="f_todate"
				type="date" value="<?php echo $GLOBALS ['xToDate']; ?>">
		</div>
		
		
       <div class="col-xs-3"><label>Select Bank:</label> 
                        <select class="form-control" name="f_bankname">
                            
                                    <option value="ALL" <?php if($GLOBALS ['xName']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="HDFC BANK" <?php if($GLOBALS ['xName']=="HDFC BANK") echo 'selected="selected"'; ?>>HDFC BANK</option>
                 
<option value="STATE BANK OF INDIA" <?php if($GLOBALS ['xName']=="STATE BANK OF INDIA") echo 'selected="selected"'; ?>>STATE BANK OF INDIA</option>

<option value="INDIAN BANK" <?php if($GLOBALS ['xName']=="INDIAN BANK") echo 'selected="selected"'; ?>>INDIAN BANK</option>

<option value="City Union Bank" <?php if($GLOBALS ['xName']=="City Union Bank") echo 'selected="selected"'; ?>>City Union Bank</option>
                        
<option value="BANDAN BANK" <?php if($GLOBALS ['xName']=="BANDAN BANK") echo 'selected="selected"'; ?>>BANDAN BANK</option>

<option value="POST OFFICE(KVP)" <?php if($GLOBALS ['xName']=="POST OFFICE(KVP)") echo 'selected="selected"'; ?>>POST OFFICE(KVP)</option>
                        </select>
                        
                        </div>
</BR></BR>
		<div>
			<input type="submit" name="searchdate" class="btn btn-primary"
				value="SEARCH-DATE ONLY">
				
				<input type="submit" name="searchbank" class="btn btn-primary"
				value="SEARCH-BANK ONLY">
				
					<input type="submit" name="searchdateandbank" class="btn btn-primary"
				value="SEARCH-BOTH">
		</div>
		<br/>
	
			<br/>	
		</form>




<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="container">
	<div class="panel panel-info">


			<table class="table">
				<thead>
					<tr>
					    	<th>S.NO</th>	
						<th>BANK</th>			
						<th>A.NO</th>			
						<th>OPENINGDATE</th>			
						<th>PRINCIPALAMT</th>	
						<th>TDS</th>
								<th>INTEREST</th>
							<th>MATURITYDATE</th>
						<th>MATURITYAMT</th>
						<th>NAME</th>
					
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>

<?php
include 'config.php';
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
if (isSet ( $_POST ['searchdateandbank'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
		$xBankName=$_POST ['f_bankname'];
			if($xBankName=="ALL")
	{
	  $xQry = "SELECT *  from fd_opening where openingdt<='$xToDate'  and openingdt>='$xFromDate' order by  openingdt desc";
	}
	else
	{
$xQry = "SELECT *  from fd_opening where openingdt<='$xToDate'  and openingdt>='$xFromDate'  and bankname='$xBankName' order by  openingdt desc";
}
?>
<div class="panel-heading  text-center"><h3 class="panel-title">OPENING REPORT  GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?>
FROM <?php echo $xFromDate?>
TO <?php echo $xToDate?> 
BANK[<?php echo $xBankName?>]
</div>
<?php
}

else if (isSet ( $_POST ['searchdate'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
		
$xQry = "SELECT *  from fd_opening where openingdt<='$xToDate'  and openingdt>='$xFromDate'  order by  openingdt desc";
?>
<div class="panel-heading  text-center"><h3 class="panel-title">OPENING REPORT  GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?>
FROM <?php echo $xFromDate?>
TO <?php echo $xToDate?> 
BANK[<?php echo $xBankName?>]
</div>
<?php
}

else if (isSet ( $_POST ['searchbank'] )) {
    		if($xBankName=="ALL")
	{
	  $xQry = "SELECT *  from fd_opening order by  openingdt desc";
	}
	else
	{
	$xBankName=$_POST ['f_bankname'];	
	$xQry = "SELECT *  from fd_opening where  bankname='$xBankName' order by  openingdt desc";
	}
?>
<div class="panel-heading  text-center"><h3 class="panel-title">OPENING REPORT  GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?>
FROM <?php echo $xFromDate?>
TO <?php echo $xToDate?> 
BANK[<?php echo $xBankName?>]
</div>
<?php
}
else{
$xQry = "SELECT *  from fd_opening";

?>
<div class="panel-heading  text-center"><h3 class="panel-title">OPENING REPORT  GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?>
FROM <?php echo $xFromDate?>
TO <?php echo $xToDate?> 
BANK[<?php echo $xBankName?>]
</div>
<?php
}
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
    $xSlNo+=1;
	echo '<tr>';
		echo '<td>' . $xSlNo. '</td>';
	echo '<td>' . $row ['bankname'] . '</td>';
		echo '<td>' . $row ['accnum'] . '</td>';
			echo '<td>' . date ( 'd/M/Y', strtotime ( $row ['openingdt']  ) ) . '</td>';
			echo '<td align=right>' . $row ['principalamt'] . '</td>';
			
			echo '<td>' . $row ['tds'] . '</td>';
				echo '<td>' . $row ['interest'] . '</td>';
				echo '<td>' .date ( 'd/M/Y', strtotime ( $row ['maturitydate']  ) ) . '</td>';
			echo '<td align=right>' . $row ['maturityamt'] . '</td>';
						echo '<td align=right>' . $row ['account_holder_name'] . '</td>';
		
$xPrincipalAmount+= $row ['principalamt'];
$xMaturityAmount+= $row ['maturityamt'];
$xTds+= $row ['tds'];
$xInterest+= $row ['interest'];
		
	?>
		<td><a
							href="fd_opening_it.php<?php echo '?fd_opening_id='.$row['fd_opening_id']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/it_logo.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						
					<td><a
							href="fd_opening.php<?php echo '?fd_opening_id='.$row['fd_opening_id']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						<td><a
							href="fd_opening.php<?php echo '?fd_opening_id='.$row['fd_opening_id']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
<?php
}
	echo '</tr>';
		echo '<tr>';
	echo '<td></td>';
		echo '<td></td>';
	echo '<td></td>';
		echo '<td></td>';
		
			echo '<td align=right>'.$xPrincipalAmount.'</td>';
			echo '<td align=right><b>'.$xTds.'</td>';
				echo '<td align=right><b>'.$xInterest.'</td>';
					echo '<td></td>';
							echo '<td align=right>'.$xMaturityAmount.'</td>';
								echo '</tr>';



?>		</tbody>
			</table>
		</div>


</body>
</html>