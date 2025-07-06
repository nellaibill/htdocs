<?php
include('session.php');
?>
<html>
<title> V-EXP-B/W D</title>
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
<form action="" method="post">
<br>
<?php


echo '<p style="color:blue;font-size:30px;font-family:calibri ;">EXPENSES RECORDS SHOWING FROM  ';
echo  "$_POST[fromdate] ";
echo "TO ";
echo  "$_POST[todate] ";
echo '</p>';
?>


<body  bgcolor="pink">
<div class="container">
<table class="table table-hover" border="1">
<caption>EXPENSES DETAILS</caption>
<thead>
<tr>
<th></th>
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
<th>PHARMACYSALESTAX</th>
<th>DOMESTICGAS</th>
<th>COMPUTERSERVICE</th>
<th>INCENTIVE(C)</th>
<th>INCENTIVE(L)</th>
<th>INSURANCE</th>
<th>CIVIL</th>
<th>ELECTRICAL</th>
<th>DOCTORSALARY</th>
<th>LABSTAFFSSALARY</th>
<th>OTHERS</th>
<th>TOTAL</th>
<th >EXPENSESDATE</th>
</tr>
 </thead>
 
 <tfoot>
<tr>
<th></th>
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
<th>PHARMACYSALESTAX</th>
<th>DOMESTICGAS</th>
<th>COMPUTERSERVICE</th>
<th>INCENTIVE(C)</th>
<th>INCENTIVE(L)</th>
<th>INSURANCE</th>
<th>CIVIL</th>
<th>ELECTRICAL</th>
<th>DOCTORSALARY</th>
<th>LABSTAFFSSALARY</th>
<th>OTHERS</th>
<th>TOTAL</th>
<th >EXPENSESDATE</th>
</tr>
 </tfoot>
 
 
      <tbody>


<?php
require_once('config.php');

$query2="SELECT date, salary, esi, pf, eb, telephone, hspinstmaint, interdeptexp, hsptservice, ac, plumber, petrol,medical,cleaning,dobby,pharmacy,gas,compservice,incentive,leaveincentive,insurance,civil,electrical,doctorsalary,lss,others,(
salary + esi + pf + eb + telephone + hspinstmaint + interdeptexp + hsptservice + ac + plumber + petrol +medical+cleaning+dobby+pharmacy+gas+compservice+incentive+leaveincentive+insurance+civil+electrical+doctorsalary+lss+others
) AS total
FROM expenses WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."'
UNION ALL SELECT  'GRAND-TOTAL', SUM( salary ) , SUM( esi ) , SUM( pf ) , SUM( eb ) , SUM( telephone ) , SUM( hspinstmaint ) , SUM( interdeptexp ) , SUM( hsptservice ) , SUM( ac ) , SUM( plumber ) , SUM( petrol ), SUM( medical), sum(cleaning),sum(dobby),sum(pharmacy),sum(gas),sum(compservice),sum(incentive),sum(leaveincentive),sum(insurance),sum(civil),sum(electrical),sum(doctorsalary),sum(lss),sum(others),SUM( salary + esi + pf + eb + telephone + hspinstmaint + interdeptexp + hsptservice + ac + plumber + petrol+medical+cleaning+dobby+pharmacy+gas+compservice+incentive+leaveincentive+insurance+civil+electrical+doctorsalary+lss+others) 
FROM expenses WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."'order by date ; "; 
$result2=mysql_query($query2); 



while ($row = mysql_fetch_array($result2)) {
    // Print out the contents of the entry 
    echo '<tr>';

echo '<td><a href=editexpenses.php?date='.$row['date']. '>EDIT</a></td>';
	 	echo '<td><a href=deleteexpenses.php?date='.$row['date'].'>DELETE</a></td>';
	
    echo '<td style=width:100px>' . $row['date'] . '</td>';
    echo '<td>' . $row['salary'] . '</td>';
    echo '<td>' . $row['esi'] . '</td>';
    echo '<td>' . $row['pf'] . '</td>';
    echo '<td>' . $row['eb'] . '</td>';
    echo '<td>' . $row['telephone'] . '</td>';
    echo '<td>' . $row['hspinstmaint'] . '</td>';
    echo '<td>' . $row['interdeptexp'] . '</td>';
echo '<td>' . $row['hsptservice'] . '</td>';
echo '<td>' . $row['ac'] . '</td>';
echo '<td>' . $row['plumber']  . '</td>';
echo '<td>' . $row['petrol'] . '</td>';
echo '<td>' . $row['medical']  . '</td>';
echo '<td>' . $row['cleaning']  . '</td>';
echo '<td>' . $row['dobby']  . '</td>';
echo '<td>' . $row['pharmacy']  . '</td>';
echo '<td>' . $row['gas']  . '</td>';
echo '<td>' . $row['compservice']  . '</td>';
echo '<td>' . $row['incentive']  . '</td>';
echo '<td>' . $row['leaveincentive']  . '</td>';
echo '<td>' . $row['insurance']  . '</td>';
echo '<td>' . $row['civil']  . '</td>';
echo '<td>' . $row['electrical']  . '</td>';
echo '<td>' . $row['doctorsalary']  . '</td>';
echo '<td>' . $row['lss']  . '</td>';
echo '<td>' . $row['others']  . '</td>';
echo '<td>' . $row['total']  . '</td>';
    echo '<td style=width:100px>' . $row['date'] . '</td>';
	 if($row['date']!='GRAND-TOTAL')
	 {
	 echo '<td><a href=editexpenses.php?date='.$row['date']. '>EDIT</a></td>';
	 	echo '<td><a href=deleteexpenses.php?date='.$row['date'].'>DELETE</a></td>';
	 }
	 echo '</tr>';
}
?>
</tbody>
    </table>	
  </div><!-- /container -->
</body></html>	