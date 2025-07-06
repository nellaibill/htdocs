<html>
<title>Edit Expenses</title>
<head>
<script>
function DataUpdate(slno,columname) {
var answer = confirm("Are you Sure UpDate ?")
	if (answer){
		value= document.getElementsByName("passvalue")[slno].value;
xDate= document.getElementsByName("date")[0].value;
xGetColumnnamename=columname;

  location.href='updateexpenses.php?value=' + value+ '&name=' + xGetColumnnamename + '&date=' + xDate;
		
	}
	

}

function DataDescriptionUpdate(slno,columname) {
var answer = confirm("Are you Sure UpDate ?")
	if (answer){
		value= document.getElementsByName("passdescription")[slno].value;
xDate= document.getElementsByName("date")[0].value;
xGetColumnnamename=columname;

  location.href='updateexpenses.php?value=' + value+ '&name=' + xGetColumnnamename + '&date=' + xDate;
		
	}
	

}


function DataDetailsUpdate(slno,columname) {
var answer = confirm("Are you Sure UpDate ?")
	if (answer){
		value= document.getElementsByName("passdetails")[slno].value;
xDate= document.getElementsByName("date")[0].value;
xGetColumnnamename=columname;

  location.href='updateexpenses.php?value=' + value+ '&name=' + xGetColumnnamename + '&date=' + xDate;
		
	}
	

}


</script>
</head>
<form action="" method="post" name="expenses">

	<h1>TO INSERT EXPENSES RECORDS</H1>

  <?php
		include ('config.php');
		include ('menu.php');
		$xDate = "";
		$xDate = $_GET ['date'];
		$results = mysql_query ( "select * from expenses where date='$xDate'" );
		$row = mysql_fetch_assoc ( $results );
		if ($row) {
			
			$date = $row ['date'];
			$salary = $row ['salary'];
			$salary1 = $row ['salary1'];
			$salary2 = $row ['salary2'];
			$esi = $row ['esi'];
			$esi1 = $row ['esi1'];
			$esi2 = $row ['esi2'];
			$pf = $row ['pf'];
			$pf1 = $row ['pf1'];
			$pf2 = $row ['pf2'];
			$ac = $row ['ac'];
			$ac1 = $row ['ac1'];
			$ac2 = $row ['ac2'];
			$eb = $row ['eb'];
			$eb1 = $row ['eb1'];
			$eb2 = $row ['eb2'];
			$telephone = $row ['telephone'];
			$telephone1 = $row ['telephone1'];
			$telephone2 = $row ['telephone2'];
			$hspinstmaint = $row ['hspinstmaint'];
			$hspinstmaint1 = $row ['hspinstmaint1'];
			$hspinstmaint2 = $row ['hspinstmaint2'];
			$interdeptexp = $row ['interdeptexp'];
			$interdeptexp1 = $row ['interdeptexp1'];
			$interdeptexp2 = $row ['interdeptexp2'];
			$hsptservice = $row ['hsptservice'];
			$hsptservice1 = $row ['hsptservice1'];
			$hsptservice2 = $row ['hsptservice2'];
			
			$ac = $row ['ac'];
			$ac1 = $row ['ac1'];
			$ac2 = $row ['ac2'];
			$plumber = $row ['plumber'];
			$plumber1 = $row ['plumber1'];
			$plumber2 = $row ['plumber2'];
			$petrol = $row ['petrol'];
			$petrol1 = $row ['petrol1'];
			$petrol2 = $row ['petrol2'];
			
			$medical = $row ['medical'];
			$medical1 = $row ['medical1'];
			$medical2 = $row ['medical2'];
			
			$cleaning = $row ['cleaning'];
			$cleaning1 = $row ['cleaning1'];
			$cleaning2 = $row ['cleaning2'];
			
			$dobby = $row ['dobby'];
			$dobby1 = $row ['dobby1'];
			$dobby2 = $row ['dobby2'];
			
			$pharmacy = $row ['pharmacy'];
			$pharmacy1 = $row ['pharmacy1'];
			$pharmacy2 = $row ['pharmacy2'];
			
			$gas = $row ['gas'];
			$gas1 = $row ['gas1'];
			$gas2 = $row ['gas2'];
			
			$compservice = $row ['compservice'];
			$compservice1 = $row ['compservice1'];
			$compservice2 = $row ['compservice2'];
			
			$incentive = $row ['incentive'];
			$incentive1 = $row ['incentive1'];
			$incentive2 = $row ['incentive2'];
			
                        $leaveincentive = $row ['leaveincentive'];
			$leaveincentive1 = $row ['leaveincentive1'];
			$leaveincentive2 = $row ['leaveincentive2'];

			$insurance = $row ['insurance'];
			$insurance1 = $row ['insurance1'];
			$insurance2 = $row ['insurance2'];
			
			$civil = $row ['civil'];
			$civil1 = $row ['civil1'];
			$civil2 = $row ['civil2'];
			
			$electrical = $row ['electrical'];
			$electrical1 = $row ['electrical1'];
			$electrical2 = $row ['electrical2'];

			$doctorsalary= $row ['doctorsalary'];
			$doctorsalary1= $row ['doctorsalary1'];
			$doctorsalary2= $row ['doctorsalary2'];

			$lss= $row ['lss'];
			$lss1= $row ['lss1'];
			$lss2= $row ['lss2'];
			
			$others = $row ['others'];
			$others1 = $row ['others1'];
			$others2 = $row ['others2'];
			
			?>
	  
<table align="center">
		<tr>
			<td align="center">NAME</td>
			<td align="center">AMOUNT</td>
			<td align="center">DETAILS</td>
			<td align="center">DETAILS1</td>
		</tr>
		<tr>

			<td>MONTHLY SALARY(STAFF) :</td>

			<td><input type="text" name="passvalue" value="<?php echo $salary; ?>" onblur="DataUpdate(0,'salary')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $salary1; ?>" onblur="DataDescriptionUpdate(0,'salary1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $salary2; ?>" onblur="DataDetailsUpdate(0,'salary2')"></td>
		</tr>
		<tr>
			<td>ESI :</td>
			<td><input type="text" name="passvalue" value="<?php echo $esi; ?>" onblur="DataUpdate(1,'esi')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $esi1; ?>" onblur="DataDescriptionUpdate(1,'esi1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $esi2; ?>" onblur="DataDetailsUpdate(1,'esi2')"></td>
		</tr>

		<tr>
			<td>PF :</td>
			<td><input type="text" name="passvalue" value="<?php echo $pf; ?>" onblur="DataUpdate(2,'pf')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $pf1; ?>" onblur="DataDescriptionUpdate(2,'pf1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $pf2; ?>" onblur="DataDetailsUpdate(2,'pf2')"></td>
		</tr>


		<tr>
			<td>TNEB BILLS :</td>
			<td><input type="text" name="passvalue" value="<?php echo $eb; ?>" onblur="DataUpdate(3,'eb')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $eb1; ?>" onblur="DataDescriptionUpdate(3,'eb1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $eb2; ?>" onblur="DataDetailsUpdate(3,'eb2')"></td>
		</tr>


		<tr>
			<td>AC TELEPHONE :</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $telephone; ?>" onblur="DataUpdate(4,'telephone')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $telephone1; ?>" onblur="DataDescriptionUpdate(4,'telephone1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $telephone2; ?>" onblur="DataDetailsUpdate(4,'telephone2')"></td>
		</tr>

		<tr>
			<td>HOSPITAL INSTRUMENT :</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $hspinstmaint; ?>" onblur="DataUpdate(5,'hspinstmaint')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $hspinstmaint1; ?>" onblur="DataDescriptionUpdate(5,'hspinstmaint1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $hspinstmaint2; ?>" onblur="DataDetailsUpdate(5,'hspinstmaint2')"></td>
		</tr>


		<tr>
			<td>INTER DEPARTMENT EXPENSES:</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $interdeptexp; ?>" 
				onblur="DataUpdate(6,'interdeptexp')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $interdeptexp1; ?>" onblur="DataDescriptionUpdate(6,'interdeptexp1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $interdeptexp2; ?>" onblur="DataDetailsUpdate(6,'interdeptexp2')"></td>
		</tr>

		<tr>
			<td>HOSPITAL SERVICE :</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $hsptservice; ?>"
				onblur="DataUpdate(7,'hsptservice')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $hsptservice1; ?>" onblur="DataDescriptionUpdate(7,'hsptservice1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $hsptservice2; ?>" onblur="DataDetailsUpdate(7,'hsptservice2')"></td>
		</tr>

		<tr>
			<td>AC REGISTER :</td>
			<td><input type="text" name="passvalue" value="<?php echo $ac; ?>"
			onblur="DataUpdate(8,'ac')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $ac1; ?>" onblur="DataDescriptionUpdate(8,'ac1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $ac2; ?>" onblur="DataDetailsUpdate(8,'ac2')"></td>
		</tr>


		<tr>
			<td>PLUMBER REGISTER :</td>
			<td><input type="text" name="passvalue" value="<?php echo $plumber; ?>" 
			onblur="DataUpdate(9,'plumber')">
			</td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $plumber1; ?>" onblur="DataDescriptionUpdate(9,'plumber1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $plumber2; ?>" onblur="DataDetailsUpdate(9,'plumber2')"></td>
		</tr>

		<tr>
			<td>DIESEL/PETROL :</td>
			<td><input type="text" name="passvalue" value="<?php echo $petrol; ?>" 
			onblur="DataUpdate(10,'petrol')">
			</td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $petrol1; ?>" onblur="DataDescriptionUpdate(10,'petrol1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $petrol2; ?>" onblur="DataDetailsUpdate(10,'petrol2')"></td>
		</tr>

		<tr>
			<td>MEDICAL O2 :</td>
			<td><input type="text" name="passvalue" value="<?php echo $medical; ?>" 
			onblur="DataUpdate(11,'medical')">
			</td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $medical1; ?>" onblur="DataDescriptionUpdate(11,'medical1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $medical2; ?>" onblur="DataDetailsUpdate(11,'medical2')"></td>
		</tr>


		<tr>
			<td>CLEANING MATERIALS</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $cleaning; ?>" 
				onblur="DataUpdate(12,'cleaning')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $cleaning1; ?>" onblur="DataDescriptionUpdate(12,'cleaning1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $cleaning2; ?>" onblur="DataDetailsUpdate(12,'cleaning2')"></td>
		</tr>

		<tr>
			<td>DOBBY</td>
			<td><input type="text" name="passvalue" value="<?php echo $dobby; ?>" 
			onblur="DataUpdate(13,'dobby')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $dobby1; ?>" onblur="DataDescriptionUpdate(13,'dobby1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $dobby2; ?>" onblur="DataDetailsUpdate(13,'dobby2')"></td>
		</tr>

		<tr>
			<td>LEGAL</td><!-- pharmacy sales tax changed to legal !-->
			<td><input type="text" name="passvalue"
				value="<?php echo $pharmacy; ?>" 
				onblur="DataUpdate(14,'pharmacy')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $pharmacy1; ?>" onblur="DataDescriptionUpdate(14,'pharmacy1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $pharmacy2; ?>" onblur="DataDetailsUpdate(14,'pharmacy2')"></td>
		</tr>


		<tr>
			<td>DOMESTIC GAS</td>
			<td><input type="text" name="passvalue" value="<?php echo $gas; ?>"
			onblur="DataUpdate(15,'gas')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $gas1; ?>" onblur="DataDescriptionUpdate(15,'gas1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $gas2; ?>" onblur="DataDetailsUpdate(15,'gas2')"></td>
		</tr>

		<tr>
			<td>COMPUTEER SERVICE</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $compservice; ?>"
				onblur="DataUpdate(16,'compservice')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $compservice1; ?>" onblur="DataDescriptionUpdate(16,'compservice1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $compservice2; ?>" onblur="DataDetailsUpdate(16,'compservice2')"></td>
		</tr>


		<tr>
			<td>INCENTIVE(C)</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $incentive; ?>"
				onblur="DataUpdate(17,'incentive')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $incentive1; ?>" onblur="DataDescriptionUpdate(17,'incentive1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $incentive2; ?>" onblur="DataDetailsUpdate(17,'incentive2')"></td>
		</tr>

<tr>
			<td>INCENTIVE(L)</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $leaveincentive; ?>"
				onblur="DataUpdate(18,'leaveincentive')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $leaveincentive1; ?>" onblur="DataDescriptionUpdate(18,'leaveincentive1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $leaveincentive2; ?>" onblur="DataDetailsUpdate(18,'leaveincentive2')"></td>
		</tr>



		<tr>
			<td>INSURANCE</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $insurance; ?>"
				onblur="DataUpdate(19,'insurance')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $insurance1; ?>" onblur="DataDescriptionUpdate(19,'insurance1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $insurance2; ?>" onblur="DataDetailsUpdate(19,'insurance2')"></td>
		</tr>


		<tr>
			<td>CIVIL WORKS</td>
			<td><input type="text" name="passvalue" value="<?php echo $civil; ?>"
			onblur="DataUpdate(20,'civil')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $civil1; ?>" onblur="DataDescriptionUpdate(20,'civil1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $civil2; ?>" onblur="DataDetailsUpdate(20,'civil2')"></td>
		</tr>

		<tr>
			<td>ELECTRICAL WORKS</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $electrical; ?>"
				onblur="DataUpdate(21,'electrical')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $electrical1; ?>" onblur="DataDescriptionUpdate(21,'electrical1')"></td>
			<td><input type="text" name="passdetails" size="50"
			value="<?php echo $electrical2; ?>" onblur="DataDetailsUpdate(21,'electrical2')"></td>
		</tr>

                 <tr>
			<td>DOCTOR SALARY</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $doctorsalary; ?>"
				onblur="DataUpdate(22,'doctorsalary')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $doctorsalary1; ?>" onblur="DataDescriptionUpdate(22,'doctorsalary1')"></td>
			<td><input type="text" name="passdetails" size="50"
			value="<?php echo $doctorsalary2; ?>" onblur="DataDetailsUpdate(22,'doctorsalary2')"></td>
		</tr>

                <tr>
			<td>LAB STAFFS SALARY</td>
			<td><input type="text" name="passvalue"
				value="<?php echo $lss; ?>"
				onblur="DataUpdate(23,'lss')"></td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $lss1; ?>" onblur="DataDescriptionUpdate(23,'lss1')"></td>
			<td><input type="text" name="passdetails" size="50"
			value="<?php echo $lss2; ?>" onblur="DataDetailsUpdate(23,'lss2')"></td>
		</tr>
		<tr>
			<td>OTHERS</td>
			<td><input type="text" name="passvalue" value="<?php echo $others; ?>"
			onblur="DataUpdate(24,'others')">
			</td>
			<td><input type="text" name="passdescription" size="50"
				value="<?php echo $others1; ?>" onblur="DataDescriptionUpdate(24,'others1')"></td>
			<td><input type="text" name="passdetails" size="50"
				value="<?php echo $others2; ?>" onblur="DataDetailsUpdate(24,'others2')"></td>
		</tr>


		<tr>
			<td></td>
			<td></td>

			
		
		</tr>
	</table>
</form>
<div>
	Date : <input type="date" name="date" value="<?php echo $date; ?>">
</div>
<br>
<br>


<br>
<br>
</html>
<?php
		} else {

			header ( 'Location: expenses.php' );
	echo '<script language="javascript">';
	echo 'alert("No Records Found")';
	echo '</script>';
}
		
		?>
		
		
		<?php
		function CallPhpDataUpdate($value,$xDate,$xGetColumnnamename)
		{
require_once('config1.php');

$sql = "UPDATE expenses SET $xGetColumnnamename=$value WHERE date='$xDate'";
echo $sql;
if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";

} else {
    echo "Error updating record: " . mysqli_error($con);
}
}
?>