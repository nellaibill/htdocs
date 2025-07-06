<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
include ('../../session.php');
session_start (); // Starting Session
$GLOBALS ['xCurrentUser'] = $_SESSION ['login_user'];
$GLOBALS ['xCurrentUserRole'] = $_SESSION ['login_user_role'];
?>
<link href="../css/menu.css" rel="stylesheet" type="text/css" />
<body>

	<div id="nav">
		<ul>
			<li><a href='index.php'>HOME</a></li>
<?php
if (($GLOBALS ['xCurrentUserRole'] == 'S') || ($GLOBALS ['xCurrentUser'] == "admin")) {
	?>

<li><span tabindex="1">Master</span>
				<ul>
					<li><a href="hrm_hm001department.php">Department-Master</a></li>
								<li><a href="hrm_hm002employee.php">Employee-Master</a></li>
								
				</ul></li>

			<li><span tabindex="2">Transaction</span>
				<ul>
		<li><a href="hrm_ht005_pfesi.php">Pf-Esi Entry</a></li>
					<li><a href="hrm_ht003attendence.php">Mark -Attendence</a></li>
						<li><a href="hrm_ht004fine.php">Fine-Entry</a></li>
									<li><a href="empfinalentry.php">EmployeeFinal -Entry</a></li>
				</ul></li>

	
			<li><span tabindex="3">Report</span>
				<ul>
			<li><a href="hrm_hr002employee.php">Employee-Report</a></li>
			<li><a href="hrm_hr002employee_active.php">Employee-Active</a></li>
			<li><a href="hrm_hr002employee_inactive.php">Employee-INActive</a></li>
			
			
					<li><a href="hrm_hr003attendence.php">Attendence - Report</a></li>
					<!--
							<li><a href="hrm_hr004fine.php">Fine Report</a></li>!-->
							<li><a href="report_pfesi.php">Pf_Esi Report</a></li>
				</ul></li>


<?
}
?>
<li> <span tabindex="4">Contribution</span> 
				<ul>
					<li><a href="hrm_hr005_employer_consolidated.php">EMPLOYER
							CONSOLIDATED</a></li>
					<li><a href="hrm_hr005_a_employercontribution.php">EMPLOYER CONT</a></li>
					<li><a href="hrm_hr005_a_employercontribution_leave.php">EMPLOYER
							CONT(NEW)</a></li>
					<li><a href="hrm_hr005_b_employeecontribution.php">EMPLOYEE CONT</a></li>
					<li><a href="hrm_hr005_b_employeecontribution_leave.php">EMPLOYEE
							CONT(NEW)</a></li>
				</ul></li>


<?php
if (($GLOBALS ['xCurrentUserRole'] == 'S') || ($GLOBALS ['xCurrentUser'] == "admin")) {
	?>
<li><span tabindex="5">Salary</span>
				<ul>
					<li><a href="hrm_hr005_c_salary.php">V-SALARY</a></li>
					<!--<li><a  href="hrm_hr005_c_salary_new.php">V-SALARY_NEW</a></li>!-->
					<li><a href="hrm_hr005_d_cashsalary.php">CASH</a></li>
					<li><a href="hrm_hr005_e_chequesalary.php">CHEQUE</a></li>
				</ul></li>

<?
}
?>

<li> <span tabindex="6">Tools</span> 
			<ul>

			<li><a href="../hc001fromtodate.php"
				onclick="basicPopup(this.href);return false">SET DATE
			</a></li>
<?php
if (($GLOBALS ['xCurrentUserRole'] == 'S') || ($GLOBALS ['xCurrentUser'] == "admin")) {
	?>
<li><a href="hrm_hc001settings.php"
				onclick="basicPopup(this.href);return false">SETTINGS</a></li>
<?
}
?>

<li><a href="" onclick="PrintDiv(); return false">PRINT</a></li>
			<li><a href="" onclick="RefreshPage(); return false">REFRESH </a></li>

		</ul>
		</li>
			<li><a href="../../logout.php">Logout  - <?php echo $GLOBALS ['xCurrentUser']; ?></a></li>
		</ul>
	</div>

</body>
</html>