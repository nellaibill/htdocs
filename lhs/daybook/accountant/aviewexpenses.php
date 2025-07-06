<html>
<title>EXPENSES DETAILS</title>
<head>

<script>
function CheckRecords(){
	window.location = "aviewexpenses.php" + "?date=" +
	document.getElementById('date').value;
	}
</script>

</head>
<form action="aexpenses.php" method="post">
<a href="index.php">INSERT INCOME</a></br></br>
		Date :
		<input type="date" name="date" id="date">
		<input type="button" value="Check Records Available" onmousedown="CheckRecords();" />

  <?php 

include('../config.php');
 		
if(isset($_GET['date'])) {
   $xDate = $_GET ['date'];
//echo "select * from expenses where date='$xDate'";
$results = mysql_query("select * from expenses where date='$xDate'"); 
$num_rows = mysql_num_rows($results);
$row = mysql_fetch_assoc($results); 
//echo $num_rows;
} else { 
$num_rows = 2;
}


if ($num_rows==0) {
$salary = $row['salary'];
$salary1 = $row['salary1'];
$salary2 = $row['salary2'];
$esi = $row['esi'];
$esi1 = $row['esi1'];
$esi2 = $row['esi2'];
$pf = $row['pf'];
$pf1 = $row['pf1'];
$pf2 = $row['pf2'];
$ac = $row['ac'];
$ac1 = $row['ac1'];
$ac2 = $row['ac2'];
$eb = $row['eb'];
$eb1 = $row['eb1'];
$eb2 = $row['eb2'];
$telephone = $row['telephone'];
$telephone1 = $row['telephone1'];
$telephone2 = $row['telephone2'];
$hspinstmaint = $row['hspinstmaint'];
$hspinstmaint1 = $row['hspinstmaint1'];
$hspinstmaint2 = $row['hspinstmaint2'];
$interdeptexp = $row['interdeptexp'];
$interdeptexp1 = $row['interdeptexp1'];
$interdeptexp2 = $row['interdeptexp2'];
$hsptservice = $row['hsptservice'];
$hsptservice1 = $row['hsptservice1'];
$hsptservice2 = $row['hsptservice2'];

$ac = $row['ac'];
$ac1 = $row['ac1'];
$ac2 = $row['ac2'];
$plumber = $row['plumber'];
$plumber1 = $row['plumber1'];
$plumber2 = $row['plumber2'];
$petrol = $row['petrol'];
$petrol1 = $row['petrol1'];
$petrol2 = $row['petrol2'];

$medical= $row['medical'];
$medical1= $row['medical1'];
$medical2= $row['medical2'];


$cleaning= $row['cleaning'];
$cleaning1= $row['cleaning1'];
$cleaning2= $row['cleaning2'];

$dobby= $row['dobby'];
$dobby1= $row['dobby1'];
$dobby2= $row['dobby2'];

$pharmacy= $row['pharmacy'];
$pharmacy1= $row['pharmacy1'];
$pharmacy2= $row['pharmacy2'];


$gas= $row['gas'];
$gas1= $row['gas1'];
$gas2= $row['gas2'];

$compservice= $row['compservice'];
$compservice1= $row['compservice1'];
$compservice2= $row['compservice2'];

$incentive= $row['incentive'];
$incentive1= $row['incentive1'];
$incentive2= $row['incentive2'];

$leaveincentive= $row['leaveincentive'];
$leaveincentive1= $row['leaveincentive1'];
$leaveincentive2= $row['leaveincentive2'];

$insurance= $row['insurance'];
$insurance1= $row['insurance1'];
$insurance2= $row['insurance2'];

$civil= $row['civil'];
$civil1= $row['civil1'];
$civil2= $row['civil2'];

$electrical= $row['electrical'];
$electrical1= $row['electrical1'];
$electrical2= $row['electrical2'];


$doctorsalary= $row['doctorsalary'];
$doctorsalary1= $row['doctorsalary1'];
$doctorsalary2= $row['doctorsalary2'];

$lss= $row['lss'];
$lss1= $row['lss1'];
$lss2= $row['lss2'];

$others= $row['others'];
$others1= $row['others1'];
$others2= $row['others2'];
      ?>

<table align="center">
<tr>
<td align="center">NAME </td>
<td align="center">AMOUNT</td>
<td align="center">DETAILS</td>
<td align="center">MORE DETAILS</td>
	</tr>
<tr></tr>
	
	<td>MONTHLY SALARY(STAFF)  :</td>
	<td><input type="text" name="salary" value="<?php echo $salary; ?>"></td>
	<td><input type="text" name="salary1" size="50" value="<?php echo $salary1; ?>"> </td>
	<td><input type="text" name="salary2" size="50" value="<?php echo $salary2; ?>"> </td>
	</tr>
	<tr><td>ESI             : 
	</td><td><input type="text" name="esi" value="<?php echo $esi; ?>">
	</td><td><input type="text" name="esi1" size="50" value="<?php echo $esi1; ?>">
	</td><td><input type="text" name="esi2" size="50" value="<?php echo $esi2; ?>">
	</td></tr>
	
	<tr><td>PF              :    
	</td><td><input type="text" name="pf" value="<?php echo $pf; ?>">
	</td><td><input type="text" name="pf1" size="50" value="<?php echo $pf1; ?>">
	</td><td><input type="text" name="pf2" size="50" value="<?php echo $pf2; ?>">
	</td></tr>

	
	<tr><td>TNEB BILLS      :    
	</td><td><input type="text" name="eb" value="<?php echo $eb; ?>">
	</td><td><input type="text" name="eb1" size="50" value="<?php echo $eb1; ?>">
	</td><td><input type="text" name="eb2" size="50" value="<?php echo $eb2; ?>">
	</td></tr>

	
	<tr><td>AC TELEPHONE     :     
	</td><td><input type="text" name="telephone"value="<?php echo $telephone; ?>">
	</td><td><input type="text" name="telephone1" size="50" value="<?php echo $telephone1; ?>">
	</td><td><input type="text" name="telephone2" size="50" value="<?php echo $telephone2; ?>">
	</td></tr>
	
	<tr><td>HOSPITAL INSTRUMENT     :    
	</td><td><input type="text" name="hspinstmaint" value="<?php echo $hspinstmaint; ?>">
	</td><td><input type="text" name="hspinstmaint1" size="50" value="<?php echo $hspinstmaint1; ?>">
	</td><td><input type="text" name="hspinstmaint2" size="50" value="<?php echo $hspinstmaint2; ?>">
	</td></tr>
	
	
		<tr><td> INTER DEPARTMENT EXPENSES:     
	</td><td><input type="text" name="interdeptexp"value="<?php echo $interdeptexp; ?>">
	</td><td><input type="text" name="interdeptexp1" size="50" value="<?php echo $interdeptexp1; ?>">
	</td><td><input type="text" name="interdeptexp2" size="50" value="<?php echo $interdeptexp2; ?>">
	</td></tr>
	
	<tr><td> HOSPITAL SERVICE  :   
	</td><td><input type="text" name="hsptservice" value="<?php echo $hsptservice; ?>">
	</td><td><input type="text" name="hsptservice1" size="50" value="<?php echo $hsptservice1; ?>">
	</td><td><input type="text" name="hsptservice2" size="50" value="<?php echo $hsptservice2; ?>">
	</td></tr>
	
		<tr><td>AC REGISTER     :      
	</td><td><input type="text" name="ac" value="<?php echo $ac; ?>">
	</td><td><input type="text" name="ac1" size="50" value="<?php echo $ac1; ?>">
	</td><td><input type="text" name="ac2" size="50" value="<?php echo $ac2; ?>">
	</td></tr>
	
	
		<tr><td>PLUMBER REGISTER :    
	</td><td><input type="text" name="plumber"value="<?php echo $plumber; ?>">
	</td><td><input type="text" name="plumber1" size="50" value="<?php echo $plumber1; ?>">
	</td><td><input type="text" name="plumber2" size="50" value="<?php echo $plumber2; ?>">
	</td></tr>
	
	<tr><td>DIESEL/PETROL   :  
	</td><td><input type="text" name="petrol" value="<?php echo $petrol; ?>">
	</td><td><input type="text" name="petrol1" size="50" value="<?php echo $petrol1; ?>">
	</td><td><input type="text" name="petrol2" size="50" value="<?php echo $petrol2; ?>">
	</td></tr>
	
	<tr><td>MEDICAL O2 :    
	</td><td><input type="text" name="medical" value="<?php echo $medical; ?>">
	</td><td><input type="text" name="medical1" size="50" value="<?php echo $medical1; ?>">
	</td><td><input type="text" name="medical2" size="50" value="<?php echo $medical2; ?>">
	</td></tr>
	
	
		<tr><td> CLEANING MATERIALS    
	</td><td><input type="text" name="cleaning" value="<?php echo $cleaning; ?>">
	</td><td><input type="text" name="cleaning1" size="50" value="<?php echo $cleaning1; ?>">
	</td><td><input type="text" name="cleaning2" size="50" value="<?php echo $cleaning2; ?>">
	</td></tr>
	
	<tr><td> COURIER  
	</td><td><input type="text" name="dobby" value="<?php echo $dobby; ?>">
	</td><td><input type="text" name="dobby1" size="50" value="<?php echo $dobby1; ?>">
	</td><td><input type="text" name="dobby2" size="50" value="<?php echo $dobby2; ?>">
	</td></tr>
	
		<tr><td>PHARMACY SALES TAX     
	</td><td><input type="text" name="pharmacy" value="<?php echo $pharmacy; ?>">
	</td><td><input type="text" name="pharmacy1" size="50" value="<?php echo $pharmacy1; ?>">
	</td><td><input type="text" name="pharmacy2" size="50" value="<?php echo $pharmacy2; ?>">
	</td></tr>
	
	
		<tr><td>DOMESTIC GAS  
	</td><td><input type="text" name="gas" value="<?php echo $gas; ?>">
	</td><td><input type="text" name="gas1" size="50" value="<?php echo $gas1; ?>">
	</td><td><input type="text" name="gas2" size="50" value="<?php echo $gas2; ?>">
	</td></tr>
	
	<tr><td>COMPUTEER SERVICE 
	</td><td><input type="text" name="compservice" value="<?php echo $compservice; ?>">
	</td><td><input type="text" name="compservice1" size="50" value="<?php echo $compservice1; ?>">
	</td><td><input type="text" name="compservice2" size="50" value="<?php echo $compservice2; ?>">
	</td></tr>
	
		
	<tr><td> INCENTIVE(C)
	</td><td><input type="text" name="incentive" value="<?php echo $incentive; ?>">
	</td><td><input type="text" name="incentive1" size="50" value="<?php echo $incentive1; ?>">
	</td><td><input type="text" name="incentive2" size="50" value="<?php echo $incentive2; ?>">
	</td></tr>

		
	<tr><td> INCENTIVE(L)
	</td><td><input type="text" name="leaveincentive" value="<?php echo $leaveincentive; ?>">
	</td><td><input type="text" name="leaveincentive1" size="50" value="<?php echo $leaveincentive1; ?>">
	</td><td><input type="text" name="leaveincentive2" size="50" value="<?php echo $leaveincentive2; ?>">
	</td></tr>
	
		<tr><td>INSURANCE     
	</td><td><input type="text" name="insurance" value="<?php echo $insurance; ?>">
	</td><td><input type="text" name="insurance1" size="50" value="<?php echo $insurance1; ?>">
	</td><td><input type="text" name="insurance2" size="50" value="<?php echo $insurance2; ?>">
	</td></tr>
	
	
		<tr><td>CIVIL WORKS  
	</td><td><input type="text" name="civil" value="<?php echo $civil; ?>">
	</td><td><input type="text" name="civil1" size="50" value="<?php echo $civil1; ?>">
	</td><td><input type="text" name="civil2" size="50" value="<?php echo $civil2; ?>">
	</td></tr>
	
	<tr><td>	ELECTRICAL WORKS  
	</td><td><input type="text" name="electrical" value="<?php echo $electrical; ?>">
	</td><td><input type="text" name="electrical1" size="50" value="<?php echo $electrical1; ?>">
	</td><td><input type="text" name="electrical2" size="50" value="<?php echo $electrical2; ?>">
	</td></tr>


	<tr><td>	DOCTOR SALARY 
	</td><td><input type="text" name="doctorsalary" value="<?php echo $doctorsalary; ?>">
	</td><td><input type="text" name="doctorsalary1" size="50" value="<?php echo $doctorsalary1; ?>">
	</td><td><input type="text" name="doctorsalary2" size="50" value="<?php echo $doctorsalary2; ?>">
	</td></tr>

	<tr><td>	LAB STAFF SALARY 
	</td><td><input type="text" name="lss" value="<?php echo $lss; ?>">
	</td><td><input type="text" name="lss1" size="50" value="<?php echo $lss1; ?>">
	</td><td><input type="text" name="lss2" size="50" value="<?php echo $lss2; ?>">
	</td></tr>


<tr><td>	OTHERS  
	</td><td><input type="text" name="others" value="<?php echo $others; ?>">
	</td><td><input type="text" name="others1" size="50" value="<?php echo $others1; ?>">
	</td><td><input type="text" name="others2" size="50" value="<?php echo $others2; ?>">
	</td></tr>
	
	<tr><td></td><td><input type="submit" value="Save" name='sentForm' width="150" height="100" style="background-color:transparent" ><td>

<td><input type="button" value="Print this page" onClick="window.print()" style="background-color:transparent" ></td>
<td><a href="../login.php">LOGOUT<td></tr>
<tr><td>
      <input type="hidden" name="date" value="<?php echo $xDate; ?>"> 
        </td></tr>  

<?php } else { echo "Please Check Date"; }?>

</form>
/* Developer Notes DOBBY chaged to COURIER  13/05/2020 based on admin entry form */ 
