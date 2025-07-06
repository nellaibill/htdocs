 <!DOCTYPE html>
<html>
<title> V-IT -EXP-REPORT</title>
<head>
 <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=800,height=600');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
            }

 </script>
</head>
<form action="xviewconsolidatedbetweendate.php" method="post">
<body>

<?php
include 'globalfunctions.php';
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
$query2="SELECT   SUM( salary ) as salary ,
SUM( esi ) as esi,
SUM( pf ) as pf  , 
SUM( eb )  as eb, 
SUM( telephone ) as telephone, 
SUM( hspinstmaint ) as hspinstmaint,
 SUM( interdeptexp ) as interdeptexp ,
 SUM( hsptservice ) as hsptservice , 
SUM( ac ) as ac , 
SUM( plumber ) as plumber , 
SUM( petrol ) as petrol, 
SUM( medical) as medical, 
sum(cleaning) as cleaning,
sum(dobby) as dobby,
sum(pharmacy) as pharmacy,
sum(gas) as gas ,
sum(compservice) as compservice,
sum(incentive) as incentive,
sum(leaveincentive) as leaveincentive,
sum(insurance) as insurance,
sum(civil) as civil,
sum(electrical)as electrical,
sum(doctorsalary)as doctorsalary,
sum(lss)as lss,
sum(others) as others,
SUM( salary + esi + pf + eb + telephone + hspinstmaint + interdeptexp + hsptservice + ac + plumber + petrol+medical+cleaning+dobby+pharmacy+gas+compservice+incentive+leaveincentive+insurance+civil+electrical+doctorsalary+lss+others) as total
FROM xexpenses WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."' order by date ; "; 
$result2=mysql_query($query2); 

while ($row = mysql_fetch_array($result2)) {
?>
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">CONSOLIDATED EXPENSES AS ON  <?php echo date('d/M/Y',strtotime($GLOBALS ['xFromDate'])) ?> TO <?php echo date('d/M/Y',strtotime( $GLOBALS ['xToDate']))?> GENERATED TIME <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?></h3></div>
<table class="table table-hover" border="1">

  <tr bgcolor="#4169E1">
    <th>NAME</th>
    <th>AMOUNT</th>
  </tr>
  <tr>
    <td>MONTHLY SALARY</td>
 <?php echo '<td align=right>' .   fn_RupeeFormat($row['salary'] ). '</td>';?>
  </tr>
  <tr>
    <td>ESI</td>
<?php echo '<td align=right>' .   fn_RupeeFormat($row['esi']) . '</td>';?>
  </tr>
  <tr>
    <td>PF</td>
<?php echo '<td align=right>' .   fn_RupeeFormat($row['pf']) . '</td>';?>
  </tr>
  <tr>
    <td>TNEB BILLS</td>
 <?php echo '<td align=right>' .  fn_RupeeFormat( $row['eb'] ). '</td>';?>
  </tr>
  <tr>
    <td>TELEPHONE</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['telephone']) . '</td>';?>
  </tr>
  <tr>
    <td>HOSPITAL INSTRUMENT</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['hspinstmaint']) . '</td>';?>
  </tr>
  <tr>
    <td>INTER DEPARTMENT EXPENSES</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['interdeptexp']) . '</td>';?>
  </tr>
  <tr>
    <td>HOSPITAL SERVICE</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['hsptservice']) . '</td>';?>
  </tr>
  <tr>
    <td>AC REGISTER</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['ac']) . '</td>';?>
  </tr>
  <tr>
    <td>PLUMBER REGISTER</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['plumber']) . '</td>';?>
  </tr>
  <tr>
    <td>DIESEL /PETROL</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['petrol']) . '</td>';?>
  </tr>


  <tr>
    <td>MEDICAL O2 </td>
  <?php echo '<td align=right>' .  fn_RupeeFormat( $row['medical']) . '</td>';?>
  </tr>
  <tr>
    <td>CLEANING MATERIALS</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['cleaning']) . '</td>';?>
  </tr>
  <tr>
    <td>COURIER</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['dobby']) . '</td>';?>
  </tr>
  <tr>
<td>LEGAL</td><!-- pharmacy sales tax changed to legal !-->
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['pharmacy']) . '</td>';?>
  </tr>
  <tr>
    <td>DOMESTIC GAS</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['gas']) . '</td>';?>
  </tr>
  <tr>
    <td>COMPUTER SERVICE</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['compservice']) . '</td>';?>
  </tr>
  <tr>
    <td>INCENTIVE(C)</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['incentive']) . '</td>';?>
  </tr>

  <tr>
    <td>INCENTIVE(L)</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['leaveincentive']) . '</td>';?>
  </tr>


  <tr>
    <td>INSURANCE</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['insurance']) . '</td>';?>
  </tr>
  <tr>
    <td>CIVIL WORKS</td>
    <?php echo '<td align=right>' .  fn_RupeeFormat( $row['civil']) . '</td>';?>
  </tr>
  <tr>
    <td>ELECTRICAL WORKS</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['electrical']) . '</td>';?>  </tr>
 <tr>
   <tr>
    <td>DOCTOR SALARY</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['doctorsalary']) . '</td>';?>  </tr>
 <tr>
    <td>LAB STAFFS SALARY</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['lss']) . '</td>';?>
  </tr>
  <tr>
    <td>OTHERS</td>
<?php echo '<td align=right>' .  fn_RupeeFormat( $row['others']) . '</td>';?>
  </tr>
  <tr bgcolor="#4169E1">
    <td>TOTAL</td>
<?php echo '<td align=right> <b> RS. ' .  fn_RupeeFormat( $row['total']) . '</b></td>';?>
  </tr>
<?php
  }
?>
</table>
</div></div></div></div>
</body>
</form>
</html>