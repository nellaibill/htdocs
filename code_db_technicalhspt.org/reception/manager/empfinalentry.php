<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['id'] ) && ! empty ( $_GET ['id'] )) {
	$xGetid = $_GET ['id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['id'] );
	} else {
		$xQry = "DELETE FROM emp_finalentry WHERE id=$xGetid";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: empfinalentry.php' );
		}
	}
} 

if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xEmpDate']='';
	$GLOBALS ['xEmpBasic'] = '';
	$GLOBALS ['xEmpDa'] = '';
	$GLOBALS ['xEmpAllowance'] ='';
	
	$GLOBALS ['xEmpHra'] = '';
	$GLOBALS ['xEmpIncentive'] = '';
	$GLOBALS ['xEmpDeduction'] ='';
		$GLOBALS ['xEmpPf'] = '';
	$GLOBALS ['xEmpEsi'] ='';
	$GLOBALS ['xEmpNetPay'] ='';
	$GLOBALS ['xEmpTotal']='';
	
	
}

function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(id)IS NULL OR max(id)= '' THEN '1'
					  ELSE max(id)+1 END AS id FROM  emp_finalentry" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xId'] = $row ['id'];
	}
}
function DataFetch($xid) {
	
	$result = mysql_query ( "SELECT *  FROM emp_finalentry WHERE id=".$xid ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
	$GLOBALS ['xEmpDate']= $row ['date'];
	$GLOBALS ['xEmpBasic'] = $row ['basic'];
	$GLOBALS ['xEmpDa']= $row ['da'];
	$GLOBALS ['xEmpAllowance']= $row ['allowance'];
		$GLOBALS ['xEmpTotal']= $row ['total'];
			$GLOBALS ['xEmpPf'] = $row ['pf'];
	$GLOBALS ['xEmpEsi'] = $row ['esi'];
	$GLOBALS ['xEmpNetPay'] = $row ['netpay'];

		}
	}
}
function DataProcess($mode) {
			$id = $_POST ['id'];
	$empdate = $_POST ['empdate'];
	$empbasic = $_POST ['empbasic'];
	$empda = $_POST ['empda'];
	$empallowance = $_POST ['empallowance'];
	$emptotal = $_POST ['emptotal'];
	$emppf = $_POST ['emppf'];
	$empesi = $_POST ['empesi'];
	$empnetpay = $_POST ['empnetpay'];
	
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO emp_finalentry
		(id,date,basic,da,allowance,total,pf,esi,netpay)
		VALUES($id,'$empdate',
		$empbasic,$empda,$empallowance,$emptotal,$emppf,$empesi,$empnetpay)";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry="update emp_finalentry set date='$empdate',
		basic=$empbasic,da=$empda,total=$emptotal,pf=$emppf,esi=$empesi,netpay=$empnetpay
				WHERE id=$id";
		mysql_query ( $xQry ) or die ( mysql_error () );
	}
GetMaxIdNo ();
}
?>
<br/>
<br/>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">


<div class="col-xs-1" style="display:none">
<input type="text" class="form-control"  name="id" value="<?php echo $GLOBALS ['xId'] ; ?>" placeholder="" readonly>
</div>
<div class="col-xs-2" >
<input type="date" class="form-control"  name="empdate" value="<?php echo $GLOBALS ['xEmpDate']; ?>" placeholder="" >
</div>

<div class="col-xs-2" >
<input type="text" class="form-control"  name="empbasic" value="<?php echo $GLOBALS ['xEmpBasic']; ?>" placeholder="BASIC" >
</div>
 <div class="col-xs-2" >
 <input type="text" class="form-control"  name="empda" value="<?php echo $GLOBALS ['xEmpDa']; ?>" placeholder="DA" >
</div>


 <div class="col-xs-2" >
 <input type="text" class="form-control"  name="emptotal" value="<?php echo $GLOBALS ['xEmpTotal']; ?>" placeholder="TOTAL" >
</div>


<!--
<div class="form-group">
<label  class="control-label col-xs-2">ALL & HRA </label>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empallowance" value="<?php echo $GLOBALS ['xEmpAllowance']; ?>" placeholder="ALLOWANCE" >
</div>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="emphra" value="<?php echo $GLOBALS ['xEmpHra']; ?>" placeholder="HRA" >
</div> </div></br></br>

<div class="form-group">
<label  class="control-label col-xs-2">INCENTIVE & DEDUCTION</label>
<div class="col-xs-2" >

<input type="text" class="form-control"  name="empincentive" value="<?php echo $GLOBALS ['xEmpIncentive']; ?>" placeholder="INCENTIVE">
</div>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empdeduction" value="<?php echo $GLOBALS ['xEmpDeduction']; ?>" placeholder="DEDUCTION" >
</div></div></br></br>
!-->

<div class="col-xs-2" >

<input type="text" class="form-control"  name="emppf" value="<?php echo $GLOBALS ['xEmpPf']; ?>" placeholder="PF">
</div>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empesi" value="<?php echo $GLOBALS ['xEmpEsi']; ?>" placeholder="ESI" >
</div></div>


<br/><br/><br/>
<div class="col-xs-2" >
<input type="text" class="form-control"  name="empallowance" value="<?php echo $GLOBALS ['xEmpAllowance']; ?>" placeholder="ALLOWANCE" >
</div>
<div class="col-xs-2" >

<input type="text" class="form-control"  name="empnetpay" value="<?php echo $GLOBALS ['xEmpNetPay']; ?>" placeholder="NetPay">
</div>
</div>


</br></br>

<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" class="btn btn-primary"
						name="save" value="Save" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" class="btn btn-primary"
						name="update" value="Update"
				accesskey="s">
	   <?php }  ?>
	</div>
			</div>
			</br></br>
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">

				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Employer Contribution Consolidated</h3>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Filter</span> <input id="filter"
						type="text" class="form-control">
				</div>
				<table class="table">
					<tr>
						<th>DATE</th>
						<th>BASIC</th>
						<th>DA</th>
			
						<th>TOTAL</th>
						<th>PF</th>
						<th>ESI</th>
									<th>ALL</th>
							<th>NETPAY</th>
					</tr>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from emp_finalentry order by date";
$result2 = mysql_query ( $xQry );
echo '</br>';
while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td width=30%>' . date('F Y', strtotime($row ['date']))  . '</td>';
	echo '<td width=10%>' . $row ['basic'] . '</td>';
		echo '<td width=10%>' . $row ['da'] . '</td>';
		
	echo '<td width=10%>' . $row ['total'] . '</td>';
		echo '<td width=10%>' . $row ['pf'] . '</td>';
	echo '<td width=10%>' . $row ['esi'] . '</td>';
			echo '<td width=10%>' . $row ['allowance'] . '</td>';
	echo '<td width=10%>' . $row ['netpay'] . '</td>';
	$basic+=$row ['basic'] ;
	$da+=$row ['da'] ;
	$total+=$row ['total'] ;
	$pf+=$row ['pf'] ;
	$esi+=$row ['esi'] ;
	$allowance+=$row ['allowance'] ;
	$netpay+=$row ['netpay'] ;

	?>
<td><a
								href="empfinalentry.php<?php echo '?id='.$row['id']. '&xmode=edit';  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="empfinalentry.php<?php echo '?id='.$row['id']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
						</tr>
<?php
}
echo '<tr>';
	echo '<td width=30%>GRAND TOTAL</td>';
	echo '<td width=10%>' . money_format("%!n", $basic) . '</td>';
	echo '<td width=10%>' . money_format("%!n", $da) . '</td>';
	echo '<td width=10%>' . money_format("%!n", $total) . '</td>';
	echo '<td width=10%>' .  money_format("%!n", $pf)   . '</td>';
	echo '<td width=10%>' . money_format("%!n", $esi)  . '</td>';
	echo '<td width=10%>' . money_format("%!n", $allowance)   . '</td>';
	echo '<td width=10%>' . money_format("%!n", $netpay)   . '</td>';
echo '</tr>';
?>			</tbody>
				</table>
			</div>

		</div>
	</div>