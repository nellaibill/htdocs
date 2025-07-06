<?php
 include_once 'menu.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/homepage_admin.css" />
</head>
<body>
<?php
if(($GLOBALS ['xCurrentUserRole']=='S') || ($GLOBALS ['xCurrentUser']=="admin"))
{
?>
	<div id="bdcontainer">
		<table border="0" cellpadding="0" cellspacing="10" align="center">
<tr>
	
				<td><a href="hrm_hr002employee.php"><input type="button" id="employee" /></a></td>
				<td><a href="hrm_ht003attendence.php"><input type="button" id="attendence" /></a></td>
			<td><a href="hrm_hr005_d_cashsalary.php"><input type="button" id="pf" /></a></td>
				<td><a href="hrm_hr005_e_chequesalary.php"><input type="button" id="esi" /></a></td>
			</tr>
				<tr>
				<td><a href="hrm_hr005_c_salary.php"><input type="button" id="salary" /></a></td>
				<td><a href="hrm_hr005_d_cashsalary.php"><input type="button" id="cash" /></a></td>
				<td><a href="hrm_hr005_e_chequesalary.php"><input type="button" id="cheque" /></a></td>
			</tr>
			
		</table>

	</div>
<?php } ?>


</body>

</html>


