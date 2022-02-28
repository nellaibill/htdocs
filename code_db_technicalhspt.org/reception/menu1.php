<?php 
include 'http://technicalhspt.org/reminder/check_reminder.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
</head>
<body>

	<div id="nav">
		<ul>
<li><a href="index.php">Home</a></li>
			<li><span tabindex="1">Master</span>
				<ul>
					<li><a href="hm002docordetails.php">Doctor</a></li>
					<li><a href="hm003expensesgroup.php">Expenses</a></li>
					<li><a href="hm004eb.php">Eb</a></li>
				</ul></li>
				
			<li><span tabindex="1">Transaction</span>
				<ul>
					<li><a href="ht002collection.php">COLLECTION</a></li>
					<li><a href="ht007expenses.php">EXPENSES</a></li>
					<li><a href="ht005ebdetails.php">EB</a></li>
					<li><a href="ht005ebdetails_new.php">EB[NEW]</a></li>
					<li><a href="ht010evententry.php">Event-Registration</a></li>
					<li><a href="birth_report_entry.php">Birth Entry</a></li>
				</ul></li>
			<li><span tabindex="1">Report</span>
				<ul>
					<li><a href="hr003collection.php">COLLECTION</a></li>
					<li><a href="hr002expenses_user.php">EXPENSES_NEW</a></li>
					<li><a href="hr008ebdetails.php">E-B</a></li>
					<li><a href="hr008ebdetails_new.php">E-B[NEW]</a></li>
					<li><a href="hr008_a_eb.php">Eb(Srinivasan Sir)</a></li>
					<li><a href="birth_reportview.php">Birth Entry</a></li>
				</ul></li>
			<li><span tabindex="1">Auditor </span>
				<ul>
					<li><a href="hr002expenses.php">EXPENSES</a></li>

				</ul></li>
				
			<li><span tabindex="1">Bank </span>
				<ul>
				              
					<li><a href="hm009bankdetails.php">ADD BANK DETAILS</a></li>
					<li><a href="ht001banktransaction.php">BANK TRANSACTION</a></li>
					<li><a href="hr002banktransaction.php">VIEW BANK
							TRANSACTIONS</a></li>
							
			
<li><a href="hr002banktransaction_less_credit.php">CREDIT</a></li>
<li><a href="hr002banktransaction_less_debit.php">DEBIT</a></li>
				</ul></li>
				
			
		<!--	<li><a href="http://technicalhspt.org/claim/">Claim</a>

	!-->
			<li><span tabindex="1">Tools</span>
				<ul>
					<li><a href="hc001fromtodate.php"
						onclick="basicPopup(this.href);return false">SET DATE </a></li>
					<li><a href="hc002settings.php"
						onclick="basicPopup(this.href);return false">SETTINGS</a></li>
						
			<li><a href="http://technicalhspt.org/dbbackup/">DB-BACKUP</a></li>
	
					
					<li><a href="" onclick="PrintDiv(); return false">PRINT </a></li>
					<li><a href="" onclick="RefreshPage(); return false">REFRESH
					</a></li>
									<li><a href="" id="btnExport"> Export To Excel</a></li>
				</ul></li>
			<li><span tabindex="1">Reminder </span>
			<ul>
			    <li><a href="reminder_main.php">ReminderEntry</a></li>     
			    	     <li><a href="reminder_full.php">Full Report</a></li> 
			     <li><a href="reminder_today_details.php">Todays Due  Report</a></li> 
			     <li><a href="reminder_datewise_details.php">Date Wise Report</a></li> 
			      <li><a href="reminder_short_due_details.php">Short Due Report(1 Week)</a></li> 
			</ul>

			</li>
				   <li><a href="http://technicalhspt.org/developer_notes.html">Instructions</a></li>	
<li style="float:right;"><a href="../logout.php">Welcome: <?php echo strtoupper($GLOBALS ['xCurrentUser'])?> LOGOUT</a></li>
			
			<img class="close" src="images/spacer.gif" alt="" />
		</ul>
	</div>
<br>
</body>
</html>