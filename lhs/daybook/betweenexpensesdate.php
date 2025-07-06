<html>
<head><link href="bootstrap.css" rel="stylesheet"></head><form action="betweenexpensesdate.php" method="post">
<a href="expenses.php" >Go Back Click Here</a>


<br>
<br>
<body>
  <div class="container">
<table class="table table-hover">
<caption>EXPENSESDETAILS</caption>
      <thead>
        <tr>
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

         <th>PETROL</th>


</tr>
      </thead>
 
 
      <tbody>


<?php
require_once('config.php');
// Retrieve all the data from the "tblstudent" table

$query2="SELECT * FROM expenses WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."'; "; 
$result2=mysql_query($query2); 


// store the record of the "tblstudent" table into $row
 
while ($row = mysql_fetch_array($result2)) {
    // Print out the contents of the entry 
    echo '<tr>';
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
    echo '<td>' . $row['plumber'] . '</td>';
    echo '<td>' . $row['petrol'] . '</td>';
 /* $xsalary+=$row['salary'];
   $xesi+=$row['esi'];
   $xpf+=$row['pf'];
   $xeb+=$row['eb'];
   $xtelephone+=$row['telephone'];
   $xhspinstmaint+=$row['hspinstmaint'];
   $xinterdeptexp+=$row['interdeptexp'];
   $xhsptservice+=$row['hsptservice'];
   $xac+=$row['ac'];
   $xplumber+=$row['plumber'];
   $xpetrol+=$row['petrol'];
*/
}
?>	
</tbody>
<tr>
<tbody>
<td>TOTAL</td>

  <!--<?  echo '<td>' . $xsalary. '</td>';?>
  <?  echo '<td>' . $xesi. '</td>';?>
  <?  echo '<td>' . $xpf. '</td>';?>
  <?  echo '<td>' . $xeb. '</td>';?>
  <?  echo '<td>' . $xtelephone. '</td>';?>
  <?  echo '<td>' . $xhspinstmaint. '</td>';?>
  <?  echo '<td>' . $xinterdeptexp. '</td>';?>
  <?  echo '<td>' . $xhsptservice. '</td>';?>
  <?  echo '<td>' . $xac. '</td>';?>
  <?  echo '<td>' . $xplumber. '</td>';?>
  <?  echo '<td>' . $xpetrol. '</td>';?>
-->
</tbody>
    </table>	
  </div><!-- /container -->
</body></html>	