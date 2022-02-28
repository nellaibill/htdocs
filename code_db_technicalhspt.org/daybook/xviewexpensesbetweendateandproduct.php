<?php
include('globalfunctions.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> V-IT -EXP B/W D & P </title>
<head>
<link href="bootstrap.css" rel="stylesheet">
</head>
<form action="xviewexpensesbetweendateandproduct.php" method="post">
<div class="col-xs-3">
<select id="sc" name="productname" class="form-control">
    <option value="salary">SALARY</option>
    <option value="esi">ESI</option>
    <option value="pf">PF</option>
    <option value="eb">HOTEL</option>
    <option value="telephone">TELEPHONE</option>
    <option value="hspinstmaint">HOSPITAL INSTRUMENT</option>
    <option value="interdeptexp">INTER-DEPARTMENT EXPENSES</option>
    <option value="hsptservice">HOSPITAL SERVICE</option>
    <option value="ac">AC</option>
    <option value="plumber">PLUMBER</option>
    <option value="petrol">PETROL</option>
    <option value="medical">MEDICAL</option>
    <option value="cleaning">CLEANING</option>
    <option value="dobby">COURIER</option>

 <option value="pharmacy">LEGAL</option><!-- pharmacy sales tax changed to legal !-->
    <option value="gas">GAS</option>
    <option value="compservice">COMPUTER SERVICE</option>
    <option value="incentive">INCENTIVE(C)</option>
    <option value="leaveincentive">INCENTIVE(L)</option>
    <option value="insurance">INSURANCE</option>
    <option value="civil">CIVIL</option>
    <option value="electrical">ELECTRICAL</option>
        <option value="doctorsalary">DOCTORSALARY</option>
    <option value="lss">LAB STAFFS SALARY</option>
<option value="others">OTHERS</option>
</select>
</div>
 <input type="submit"  name="sentForm"   class="btn btn-primary" value="VIEW" id="save"> 
  <div class="container">
<div id="divToPrint" >
<div class="container">
<div class="panel panel-danger">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW IT EXPENSES AS ON  <?php echo date('d/M/Y',strtotime($GLOBALS ['xFromDate'])) ?> TO <?php echo date('d/M/Y',strtotime( $GLOBALS ['xToDate']))?> GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?></h3>
</div>
<table class="table table-hover" border="1">
<thead>
        <tr>
          <th> DATE </th>
          <th>SELECTED NAME</th>
          <th> DETAILS</th>
          <th>MORE DETAILS</th>
</tr>
      </thead>
<tbody>
<?php
$total=0;
if (isSet($_POST['sentForm'])) {
$one="1";
$two="2";
$product=$_POST['productname'];
$product1=$product.$one;
$product2=$product.$two;
require_once('config.php');

$query2="SELECT date , ".$_POST['productname']." as name ,$product1 as name1,$product2 as name2  from xexpenses WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' union all select 'GRAND-TOTAL',sum( ".$_POST['productname']."),'',''  from xexpenses 
		 WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' order by date ; "; 
$result2=mysql_query($query2);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['name']  . '</td>';
    echo '<td>' . $row['name1']  . '</td>';
    echo '<td>' . $row['name2']  . '</td>';
    $total+= $row['name'] ;
	echo '</tr>'; 
	
	 
}
}
?>	

</tbody>


    </table>	
  </div><!-- /Panel-->
  </div><!-- /container -->
  </div><!-- /Print -->
</body></html>	