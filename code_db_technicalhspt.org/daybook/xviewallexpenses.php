<?php
include('globalfunctions.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> V-IT-EXPENSES </title>
<head>
<link href="bootstrap.css" rel="stylesheet">
</head>
<script type="text/javascript">
function confirm_edit() {
  return confirm('are you sure?');
}
</script>
<script type="text/javascript">
function confirm_delete() {
  return confirm('are you sure?');
}
</script>
<form action="xviewexpensesbetweendate.php" method="post">
<body>

  <div class="container">
<div id="divToPrint" >
<div class="container">
<div class="panel panel-danger">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW IT EXPENSES AS ON  <?php echo date('d/M/Y',strtotime($GLOBALS ['xFromDate'])) ?> TO <?php echo date('d/M/Y',strtotime( $GLOBALS ['xToDate']))?></h3></div>
<table class="table table-hover" border="1">
  <thead>
        <tr  bgcolor="#CC66CC">
<th ></th>
          <th></th>
          <th >EXPENSESDATE</th>
          <th>SALARY</th>
          <th>ESI</th>
          <th>PF</th>
          <th>HOTEL</th> 
          <th>TELEPHONE</th>
          <th>HOSPINST</th>
          <th>INTERDEPT</th>
          <th>HOSPITALSERVICES</th>
          <th>ACREGISTER</th>
          <th>PLUMBER</th>
          <th>PETROL/DIESEL</th>
          <th>MEDICALO2</th>
          <th>CLEANING</th>
          <th>COURIER</th>
  <th>LEGAL</th><!-- pharmacy sales tax changed to legal !-->
          <th>DGAS</th>
          <th>COMPUTER</th>
          <th>INCENTIVE(C)</th>
          <th>INCENTIVE(L)</th>
          <th>INSURANCE</th>
          <th>CIVIL</th>
          <th>ELECTRICAL</th>
          <th>DOCTORSALARY</th>
          <th>LABSTAFFSSALARY</th>
          <th>OTHERS</th>
	  <th>TOTAL</th>
          <th>EXPENSESDATE</th>
      </thead>
      <tfoot>
        <tr  bgcolor="#CC66CC">
<th ></th>
          <th></th>
          <th >EXPENSESDATE</th>
          <th>SALARY</th>
          <th>ESI</th>
          <th>PF</th>
          <th>TNEB</th> 
          <th>TELEPHONE</th>
          <th>HOSPINST</th>
          <th>INTERDEPT</th>
          <th>HOSPITALSERVICES</th>
          <th>ACREGISTER</th>
          <th>PLUMBER</th>
          <th>PETROL/DIESEL</th>
          <th>MEDICALO2</th>
          <th>CLEANING</th>
          <th>COURIER</th>
<th>LEGAL</th><!-- pharmacy sales tax changed to legal !-->
          <th>DGAS</th>
          <th>COMPUTER</th>
          <th>INCENTIVE(C)</th>
          <th>INCENTIVE(L)</th>
          <th>INSURANCE</th>
          <th>CIVIL</th>
          <th>ELECTRICAL</th>
          <th>DOCTORSALARY</th>
          <th>LABSTAFFSSALARY</th>
          <th>OTHERS</th>
	  <th>TOTAL</th>
          <th>EXPENSESDATE</th>
      </tfoot>
 
 
      <tbody>


<?php
require_once('config.php');
$result = mysql_query("SELECT date, salary, esi, pf, eb, telephone, hspinstmaint, interdeptexp, hsptservice, ac, plumber, petrol,medical,cleaning,dobby,pharmacy,gas,compservice,incentive,leaveincentive,insurance,civil,electrical,doctorsalary,lss,others,(
salary + esi + pf + eb + telephone + hspinstmaint + interdeptexp + hsptservice + ac + plumber + petrol +medical+cleaning+dobby+pharmacy+gas+compservice+incentive+leaveincentive+insurance+civil+electrical+doctorsalary+lss+others
) AS total
FROM xexpenses WHERE date >= '$xFromDate' AND date<= '$xToDate'
UNION ALL SELECT  'GRAND-TOTAL', SUM( salary ) , SUM( esi ) , SUM( pf ) , SUM( eb ) , SUM( telephone ) , SUM( hspinstmaint ) , SUM( interdeptexp ) , SUM( hsptservice ) , SUM( ac ) , SUM( plumber ) , SUM( petrol ), SUM( medical), sum(cleaning),sum(dobby),sum(pharmacy),sum(gas),sum(compservice),sum(incentive),sum(leaveincentive),sum(insurance),sum(civil),sum(electrical),sum(doctorsalary),sum(lss),sum(others),SUM( salary + esi + pf + eb + telephone + hspinstmaint + interdeptexp + interdeptexp + hsptservice + ac + plumber + petrol+medical+cleaning+dobby+pharmacy+gas+compservice+incentive+leaveincentive+insurance+civil+electrical+doctorsalary+lss+others) 
FROM xexpenses WHERE date >= '$xFromDate' AND date<= '$xToDate' order by date") or die(mysql_error());
//$result = mysql_query("SELECT * FROM xexpenses") or die(mysql_error());
while($expense_rows=mysql_fetch_array($result)){
?>
<tr>
<?php
if ($expense_rows['date'] !='GRAND-TOTAL')
{
?>
<td><a href="xeditexpenses.php<?php echo '?date='.$expense_rows['date']; ?>" onclick="return confirm_edit()" ><img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td><a href="xdeleteexpenses.php<?php echo '?date='.$expense_rows['date']; ?>" onclick="return confirm_delete()" ><img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?php
}
else
{
?>

<td></td>
<td></td>
<?php
}

?>


<td><?php echo $expense_rows['date'] ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['salary'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['esi']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['pf'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['eb']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['telephone']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['hspinstmaint']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['interdeptexp']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['hsptservice']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['ac']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['plumber']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['petrol']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['medical']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['cleaning']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['dobby']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['pharmacy']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['gas']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['compservice']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['incentive'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['leaveincentive'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['insurance']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['civil'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['electrical'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['doctorsalary'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['lss'] ); ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['others']) ; ?></td>
<td><?php echo  fn_RupeeFormat( $expense_rows['total']) ; ?></td>
<td><?php echo $expense_rows['date'] ; ?></td>

<?php
if ($expense_rows['date'] !='GRAND-TOTAL')
{
?>
<td><a href="xeditexpenses.php<?php echo '?date='.$expense_rows['date']; ?>" onclick="return confirm_delete()" ><img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td><a href="xdeleteexpenses.php<?php echo '?date='.$expense_rows['date']; ?>" onclick="return confirm_delete()" ><img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?php
}
?>
</tr>

<?php }?>
 
</tbody>
</form>
  </div><!-- /Panel-->
  </div><!-- /container -->
  </div><!-- /Print -->
</body></html>	