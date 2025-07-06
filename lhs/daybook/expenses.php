<?php
include ('session.php');
?>
<!-- DOBBY CHANGED TO COURIER -->
<html>
<title>INSERT EXPENSES</title>
<head>
<script>
function CheckRecords(){
	window.location = "editexpenses.php" + "?date=" +
	document.getElementById('date').value;
	}
</script>
</head>
		
		
<form action="expenses.php" method="post">
	<h1>TO INSERT EXPENSES RECORDS</h1>

		Date :
		<input type="date" name="date" id="date">
		<input type="button" value="Check Records Available" onmousedown="CheckRecords();" />
	<table align="center">
		<tr>
			<td align="center">NAME</td>
			<td align="center">AMOUNT</td>
			<td align="center">DESCRIPTION</td>
			<td align="center">MORE DESCRIPTION</td>
		</tr>

		<tr>
			<td>MONTHLY SALARY(STAFF) :</td>
			<td><input type="text" name="salary"></td>
			<td><input type="text" name="salary1" size="50"></td>
			<td><input type="text" name="salary2" size="50"></td>
		</tr>
		<tr>
			<td>ESI :</td>
			<td><input type="text" name="esi"></td>
			<td><input type="text" name="esi1" size="50"></td>
			<td><input type="text" name="esi2" size="50"></td>
		</tr>

		<tr>
			<td>PF :</td>
			<td><input type="text" name="pf"></td>
			<td><input type="text" name="pf1" size="50"></td>
			<td><input type="text" name="pf2" size="50"></td>
		</tr>

		<tr>
			<td>HOTEL :</td>
			<td><input type="text" name="eb"></td>
			<td><input type="text" name="eb1" size="50"></td>
			<td><input type="text" name="eb2" size="50"></td>
		</tr>


		<tr>
			<td>TELEPHONE :</td>
			<td><input type="text" name="telephone"></td>
			<td><input type="text" name="telephone1" size="50"></td>
			<td><input type="text" name="telephone2" size="50"></td>
		</tr>

		<tr>
			<td>HOSPITAL INSTRUMENT :</td>
			<td><input type="text" name="hspinstmaint"></td>
			<td><input type="text" name="hspinstmaint1" size="50"></td>
			<td><input type="text" name="hspinstmaint2" size="50"></td>
		</tr>


		<tr>
			<td>INTER DEPARTMENT EXPENSES:</td>
			<td><input type="text" name="interdeptexp"></td>
			<td><input type="text" name="interdeptexp1" size="50"></td>
			<td><input type="text" name="interdeptexp2" size="50"></td>
		</tr>

		<tr>
			<td>HOSPITAL SERVICE :</td>
			<td><input type="text" name="hsptservice"></td>
			<td><input type="text" name="hsptservice1" size="50"></td>
			<td><input type="text" name="hsptservice2" size="50"></td>
		</tr>

		<tr>
			<td>AC REGISTER :</td>
			<td><input type="text" name="ac"></td>
			<td><input type="text" name="ac1" size="50"></td>
			<td><input type="text" name="ac2" size="50"></td>
		</tr>


		<tr>
			<td>PLUMBER REGISTER :</td>
			<td><input type="text" name="plumber"></td>
			<td><input type="text" name="plumber1" size="50"></td>
			<td><input type="text" name="plumber2" size="50"></td>
		</tr>

		<tr>
			<td>DIESEL/PETROL :</td>
			<td><input type="text" name="petrol"></td>
			<td><input type="text" name="petrol1" size="50"></td>
			<td><input type="text" name="petrol2" size="50"></td>
		</tr>


		<tr>
			<td>MEDICAL 02 :</td>
			<td><input type="text" name="medical"></td>
			<td><input type="text" name="medical1" size="50"></td>
			<td><input type="text" name="medical2" size="50"></td>
		</tr>


		<tr>
			<td>CLEANING MATERIALS</td>
			<td><input type="text" name="cleaning"></td>
			<td><input type="text" name="cleaning1" size="50"></td>
			<td><input type="text" name="cleaning2" size="50"></td>
		</tr>



		<tr>
			<td>COURIER</td>
			<td><input type="text" name="dobby"></td>
			<td><input type="text" name="dobby1" size="50"></td>
			<td><input type="text" name="dobby2" size="50"></td>
		</tr>

		<tr>
			<td>LEGAL</td><!-- pharmacy sales tax changed to legal !-->
			<td><input type="text" name="pharmacy"></td>
			<td><input type="text" name="pharmacy1" size="50"></td>
			<td><input type="text" name="pharmacy2" size="50"></td>
		</tr>


		<tr>
			<td>DOMESTIC GAS</td>
			<td><input type="text" name="gas"></td>
			<td><input type="text" name="gas1" size="50"></td>
			<td><input type="text" name="gas2" size="50"></td>
		</tr>

		<tr>
			<td>COMPUTER SERVICE</td>
			<td><input type="text" name="compservice"></td>
			<td><input type="text" name="compservice1" size="50"></td>
			<td><input type="text" name="compservice2" size="50"></td>
		</tr>

		<tr>
			<td>INCENTIVE(C)</td>
			<td><input type="text" name="incentive"></td>
			<td><input type="text" name="incentive1" size="50"></td>
			<td><input type="text" name="incentive2" size="50"></td>
		</tr>
	<tr>
			<td>INCENTIVE(L)</td>
			<td><input type="text" name="leaveincentive"></td>
			<td><input type="text" name="leaveincentive1" size="50"></td>
			<td><input type="text" name="leaveincentive2" size="50"></td>
		</tr>
		<tr>
			<td>INSURANCE</td>
			<td><input type="text" name="insurance"></td>
			<td><input type="text" name="insurance1" size="50"></td>
			<td><input type="text" name="insurance2" size="50"></td>
		</tr>


		<tr>
			<td>CIVIL WORKS</td>
			<td><input type="text" name="civil"></td>
			<td><input type="text" name="civil1" size="50"></td>
			<td><input type="text" name="civil2" size="50"></td>
		</tr>

		<tr>
			<td>ELECTRICAL WORKS</td>
			<td><input type="text" name="electrical"></td>
			<td><input type="text" name="electrical1" size="50"></td>
			<td><input type="text" name="electrical2" size="50"></td>
		</tr>

                <tr>
			<td>DOCTOR SALARY</td>
			<td><input type="text" name="doctorsalary"></td>
			<td><input type="text" name="doctorsalary1" size="50"></td>
			<td><input type="text" name="doctorsalary2" size="50"></td>
		</tr>
                <tr>
			<td>LAB STAFFS SALARY</td>
			<td><input type="text" name="lss"></td>
			<td><input type="text" name="lss1" size="50"></td>
			<td><input type="text" name="lss2" size="50"></td>
		</tr>

		<tr>
			<td>OTHERS</td>
			<td><input type="text" name="others"></td>
			<td><input type="text" name="others1" size="50"></td>
			<td><input type="text" name="others2" size="50"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="Save" name='sentForm' width="75"
				height="48">
			
			<td>
		
		</tr>





	</table>
</form>


<br>
<br>


<?php
require_once ('config1.php');

// if (isset($_POST['btndate'])) {
// $selecteddate = "select * from expenses where date='$_POST[date]'";
// $con->query ( $selecteddate );

// /}
if (isSet ( $_POST ['sentForm'] )) {
	$delete = "delete from expenses where date='$_POST[date]'";
	$con->query ( $delete );
	$deleteforxexpenses = "delete from xexpenses where date='$_POST[date]'";
	$con->query ( $deleteforxexpenses );
	
	$salary = $_POST [salary];
	if (empty ( $salary )) {
		$salary = 0;
		$salary1 = "";
		$salary2 = "";
	} else {
		$salary1 = $_POST [salary1];
		$salary2 = $_POST [salary2];
	}
	
	$esi = $_POST [esi];
	if (empty ( $esi )) {
		$esi = 0;
		$esi1 = "";
		$esi2 = "";
	} else {
		$esi1 = $_POST [esi1];
		$esi2 = $_POST [esi2];
	}
	
	$pf = $_POST [pf];
	if (empty ( $pf )) {
		$pf = 0;
		$pf1 = "";
		$pf2 = "";
	} else {
		$pf1 = $_POST [pf1];
		$pf2 = $_POST [pf2];
	}
	
	$eb = $_POST [eb];
	if (empty ( $eb )) {
		$eb = 0;
		$eb1 = "";
		$eb2 = "";
	} 

	else {
		$eb1 = $_POST [eb1];
		$eb2 = $_POST [eb2];
	}
	
	$telephone = $_POST [telephone];
	if (empty ( $telephone )) {
		$telephone = 0;
		$telephone1 = "";
		$telephone2 = "";
	} 

	else {
		$telephone1 = $_POST [telephone1];
		$telephone2 = $_POST [telephone2];
	}
	
	$hspinstmaint = $_POST [hspinstmaint];
	if (empty ( $hspinstmaint )) {
		$hspinstmaint = 0;
		$hspinstmaint1 = "";
		$hspinstmaint2 = "";
	} 

	else {
		$hspinstmaint1 = $_POST [hspinstmaint1];
		$hspinstmaint2 = $_POST [hspinstmaint2];
	}
	
	$interdeptexp = $_POST [interdeptexp];
	if (empty ( $interdeptexp )) {
		$interdeptexp = 0;
		$interdeptexp1 = "";
		$interdeptexp2 = "";
	} else {
		$interdeptexp1 = $_POST [interdeptexp1];
		$interdeptexp2 = $_POST [interdeptexp2];
	}
	
	$hsptservice = $_POST [hsptservice];
	if (empty ( $hsptservice )) {
		$hsptservice = 0;
		$hsptservice1 = "";
		$hsptservice2 = "";
	} 

	else {
		$hsptservice1 = $_POST [hsptservice1];
		$hsptservice2 = $_POST [hsptservice2];
	}
	
	$ac = $_POST [ac];
	if (empty ( $ac )) {
		$ac = 0;
		$ac1 = "";
		$ac2 = "";
	} 

	else {
		$ac1 = $_POST [ac1];
		$ac2 = $_POST [ac2];
	}
	$plumber = $_POST [plumber];
	if (empty ( $plumber )) {
		$plumber = 0;
		$plumber1 = "";
		$plumber2 = "";
	} 

	else {
		$plumber1 = $_POST [plumber1];
		$plumber2 = $_POST [plumber2];
	}
	
	$petrol = $_POST [petrol];
	if (empty ( $petrol )) {
		$petrol = 0;
		$petrol1 = "";
		$petrol2 = "";
	} 

	else {
		$petrol1 = $_POST [petrol1];
		$petrol2 = $_POST [petrol2];
	}
	
	$medical = $_POST [medical];
	if (empty ( $medical )) {
		$medical = 0;
		$medical1 = "";
		$medical2 = "";
	} else {
		$medical1 = $_POST [medical1];
		$medical2 = $_POST [medical2];
	}
	
	$cleaning = $_POST [cleaning];
	if (empty ( $cleaning )) {
		$cleaning = 0;
		$cleaning1 = "";
		$cleaning2 = "";
	} else {
		$cleaning1 = $_POST [cleaning1];
		$cleaning2 = $_POST [cleaning2];
	}
	
	$dobby = $_POST [dobby];
	if (empty ( $dobby )) {
		$dobby = 0;
		$dobby1 = "";
		$dobby2 = "";
	} else {
		$dobby1 = $_POST [dobby1];
		$dobby2 = $_POST [dobby2];
	}
	
	$pharmacy = $_POST [pharmacy];
	if (empty ( $pharmacy )) {
		$pharmacy = 0;
		$pharmacy1 = "";
		$pharmacy2 = "";
	} 

	else {
		$pharmacy1 = $_POST [pharmacy1];
		$pharmacy2 = $_POST [pharmacy2];
	}
	
	$gas = $_POST [gas];
	if (empty ( $gas )) {
		$gas = 0;
		$gas1 = "";
		$gas2 = "";
	} 

	else {
		$gas1 = $_POST [gas1];
		$gas2 = $_POST [gas2];
	}
	$compservice = $_POST [compservice];
	if (empty ( $compservice )) {
		$compservice = 0;
		$compservice1 = "";
		$compservice2 = "";
	} 

	else {
		$compservice1 = $_POST [compservice1];
		$compservice2 = $_POST [compservice2];
	}
	
	$incentive = $_POST [incentive];
	if (empty ( $incentive )) {
		$incentive = 0;
		$incentive1 = "";
		$incentive2 = "";
	} 

	else {
		$incentive1 = $_POST [incentive1];
		$incentive2 = $_POST [incentive2];
	}
	

$leaveincentive = $_POST [leaveincentive];
	if (empty ( $leaveincentive )) {
		$leaveincentive = 0;
		$leaveincentive1 = "";
		$leaveincentive2 = "";
	} 

	else {
		$leaveincentive1 = $_POST [leaveincentive1];
		$leaveincentive2 = $_POST [leaveincentive2];
	}

	$insurance = $_POST [insurance];
	if (empty ( $insurance )) {
		$insurance = 0;
		$insurance1 = "";
		$insurance2 = "";
	} else {
		$insurance1 = $_POST [insurance1];
		$insurance2 = $_POST [insurance2];
	}
	
	$civil = $_POST [civil];
	if (empty ( $civil )) {
		$civil = 0;
		$civil1 = "";
		$civil2 = "";
	} 

	else {
		$civil1 = $_POST [civil1];
		$civil2 = $_POST [civil2];
	}
	
	$electrical = $_POST [electrical];
	if (empty ( $electrical )) {
		$electrical = 0;
		$electrical1 = "";
		$electrical2 = "";
	} 

	else {
		$electrical1 = $_POST [electrical1];
		$electrical2 = $_POST [electrical2];
	}

	$doctorsalary= $_POST [doctorsalary];
	if (empty ( $doctorsalary)) {
		$doctorsalary= 0;
		$doctorsalary1= "";
		$doctorsalary2= "";
	} 

	else {
		$doctorsalary1= $_POST [doctorsalary1];
		$doctorsalary2= $_POST [doctorsalary2];
	}

	
	$lss= $_POST [lss];
	if (empty ( $lss)) {
		$lss= 0;
		$lss1= "";
		$lss2= "";
	} 

	else {
		$lss1= $_POST [lss1];
		$lss2= $_POST [lss2];
	}


	$others = $_POST [others];
	if (empty ( $others )) {
		$others = 0;
		$others1 = "";
		$others2 = "";
	} 

	else {
		$others1 = $_POST [others1];
		$others2 = $_POST [others2];
	}
	$insert = "INSERT INTO expenses
(
date,
salary,salary1,salary2,
esi,esi1,esi2,
pf,pf1,pf2,
eb,eb1,eb2,
telephone,telephone1,telephone2,
hspinstmaint,hspinstmaint1,hspinstmaint2,
interdeptexp,interdeptexp1,interdeptexp2,
hsptservice,hsptservice1,hsptservice2,
ac,ac1,ac2,
plumber,plumber1,plumber2,
petrol,petrol1,petrol2,
medical,medical1,medical2,
cleaning,cleaning1,cleaning2,
dobby,dobby1,dobby2,
pharmacy,pharmacy1,pharmacy2,
gas,gas1,gas2,
compservice,compservice1,compservice2,
incentive,incentive1,incentive2,
leaveincentive,leaveincentive1,leaveincentive2,
insurance,insurance1,insurance2,
civil,civil1,civil2,
electrical,electrical1,electrical2,
doctorsalary,doctorsalary1,doctorsalary2,
lss,lss1,lss2,
others,others1,others2
)
VALUES
(
'$_POST[date]',
$salary,'$salary1','$salary2',
$esi,'$esi1','$esi2',
$pf,'$pf1','$pf2',
$eb,'$eb1','$eb2',
$telephone,'$telephone1','$telephone2',
$hspinstmaint,'$hspinstmaint1','$hspinstmaint2',
$interdeptexp,'$interdeptexp1','$interdeptexp2',
$hsptservice,'$hsptservice1','$hsptservice2',
$ac,'$ac1','$ac2',
$plumber,'$plumber1','$plumber2',
$petrol,'$petrol1','$petrol2',
$medical,'$medical1','$medical2',
$cleaning,'$cleaning1','$cleaning2',
$dobby,'$dobby1','$dobby2',
$pharmacy,'$pharmacy1','$pharmacy2',
$gas,'$gas1','$gas2',
$compservice,'$compservice1','$compservice2',
$incentive,'$incentive1','$incentive2',
$leaveincentive,'$leaveincentive1','$leaveincentive2',
$insurance,'$insurance1','$insurance2',
$civil,'$civil1','$civil2',
$electrical,'$electrical1','$electrical2',
$doctorsalary,'$doctorsalary1','$doctorsalary2',
$lss,'$lss1','$lss2',
$others,'$others1','$others2'
)";
	
	$xinsert = "INSERT INTO xexpenses
(date,
salary,salary1,salary2,
esi,esi1,esi2,
pf,pf1,pf2,
eb,eb1,eb2,
telephone,telephone1,telephone2,
hspinstmaint,hspinstmaint1,hspinstmaint2,
interdeptexp,interdeptexp1,interdeptexp2,
hsptservice,hsptservice1,hsptservice2,
ac,ac1,ac2,
plumber,plumber1,plumber2,
petrol,petrol1,petrol2,
medical,medical1,medical2,
cleaning,cleaning1,cleaning2,
dobby,dobby1,dobby2,
pharmacy,pharmacy1,pharmacy2,
gas,gas1,gas2,
compservice,compservice1,compservice2,
incentive,incentive1,incentive2,
leaveincentive,leaveincentive1,leaveincentive2,
insurance,insurance1,insurance2,
civil,civil1,civil2,
electrical,electrical1,electrical2,
doctorsalary,doctorsalary1,doctorsalary2,
lss,lss1,lss2,
others,others1,others2
)
VALUES
(
'$_POST[date]',
$salary,'$salary1','$salary2',
$esi,'$esi1','$esi2',
$pf,'$pf1','$pf2',
$eb,'$eb1','$eb2',
$telephone,'$telephone1','$telephone2',
$hspinstmaint,'$hspinstmaint1','$hspinstmaint2',
$interdeptexp,'$interdeptexp1','$interdeptexp2',
$hsptservice,'$hsptservice1','$hsptservice2',
$ac,'$ac1','$ac2',
$plumber,'$plumber1','$plumber2',
$petrol,'$petrol1','$petrol2',
$medical,'$medical1','$medical2',
$cleaning,'$cleaning1','$cleaning2',
$dobby,'$dobby1','$dobby2',
$pharmacy,'$pharmacy1','$pharmacy2',
$gas,'$gas1','$gas2',
$compservice,'$compservice1','$compservice2',
$incentive,'$incentive1','$incentive2',
$leaveincentive,'$leaveincentive1','$leaveincentive2',
$insurance,'$insurance1','$insurance2',
$civil,'$civil1','$civil2',
$electrical,'$electrical1','$electrical2',
$doctorsalary,'$doctorsalary1','$doctorsalary2',
$lss,'$lss1','$lss2',
$others,'$others1','$others2'
)";
	
	$insertresult = $con->query ( $insert );
	
	$xinsertresult = $con->query ( $xinsert );
		
header ( 'Location: expenses.php' );
	
}
?>



	