
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<style>

    body {
        background-color: #444;
        background: url(images/white-bg.jpg);
        background-repeat:no-repeat;
        background-size: 100% 100%;
         }
#container { height:70px; width: auto; margin:0 auto; }

#header { box-shadow: -1px 5px 5px -2px #333333;  position:fixed; width:100%; height:60px; border-radius:0px 0px 15px 15px; background-color:#FFF; }

#btnadd { border:1px solid #033; background: #033; border-radius:3px; height:45px; width:125px; color: #FFF; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }

#footer {
	clear: both;
	background: #033;
	height: 40px;
	width: 100%;
	position: fixed;
	left: 0px;
	bottom: 0px;
	text-align: center;
	box-shadow:0px -1px 10px 1px #000;
}

#top_info { float:left; width:40px; height:40px; background: #FFF; margin:10px; border: 1px solid #CCC; }
#navbar { height:100px; clear:both; width:50%; margin:0 auto; margin-left:auto; margin-right:auto; }

</style>
<body  onFocus="parent_disable();" onclick="parent_disable()";>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('.slideout-menu-toggle').on('click', function(event){
    	event.preventDefault();
    	// create menu variables
    	var slideoutMenu = $('.slideout-menu');
    	var slideoutMenuWidth = $('.slideout-menu').width();
    	
    	// toggle open class
    	slideoutMenu.toggleClass("open");
    	
    	// slide menu
    	if (slideoutMenu.hasClass("open")) {
	    	slideoutMenu.animate({
		    	right: "0px"
	    	});	
    	} else {
	    	slideoutMenu.animate({
		    	right: -slideoutMenuWidth
	    	}, 250);	
    	}
    });
});
</script>
	<div id="container">
			<div id="header">
				<table cellspacing="0" width="100%" border="0" cellpadding="20px">
					<tr>
						<td width="56%">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
						
								
							</table>
						</td>
										
				
						<td style="font-size: 14px;">
							<table width="93%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<th scope="col">Welcome: <?php echo strtoupper($GLOBALS ['xCurrentUser'])?></th>
									<th scope="col"><?php
									$Today = date ( 'y:m:d', time () );
									$new = date ( 'l, F d, Y', strtotime ( $Today ) );
									echo $new;
									?></th>
									<th scope="col" width="20px"><a href="../logout.php"> <input
											type="button" id="btnadd" value="வெளியேறு" 
											src="" />
									</a></th>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</div>
			</div>
<div class="slideout-menu">
	<h3>Menu <a href="#" class="slideout-menu-toggle">&times;</a></h3>
	<ul>
<font face="verdana" size="4" color="green">
<li><a href="hc001fromtodate.php"  onclick="basicPopup(this.href);return false">SET DATE <span class="glyphicon glyphicon-calendar" style="color:yellow"></span> </a></li>
<li><a href="hc002settings.php"  onclick="basicPopup(this.href);return false">SETTINGS</a></li>
<li><a href="backup/index.php"    onclick="basicPopup(this.href);return false">BACK UP</a></li>
<li><a href="http://technicalhspt.org/reception/forms/"  >Forms</a></li>
<li><a href="" onclick="PrintDiv(); return false">PRINT <span class="glyphicon glyphicon-print" style="color:yellow" ></span></a></li>
<li><a href="" onclick="RefreshPage(); return false">REFRESH <span class="glyphicon glyphicon-refresh" style="color:yellow"></span></a></li>
<!--
  <li><a href="casesheet/hm001patientregistration.php" style="text-decoration:none;">PATIENT-REG</a></li>
  <li><a href="ht011casesheet.php" style="text-decoration:none;">CASE-SHEET</a></li>
  <li><a href="ht012investigationchart.php" style="text-decoration:none;">INVESTIGATION CHART</a></li>
  <li><a href="ht013doctorcontinuationchart.php" style="text-decoration:none;">DOCTOR-CONTINUATION CHART</a></li>
  <li><a href="ht014nursesdailyrecord.php" style="text-decoration:none;">NURSE-DAILY RECORD</a></li>

!-->
</font>
	</ul>
</div>
<!--/.slideout-menu-->
<!--  <ul class="nav">-->

<div id="xFixedHeader"> 
<div class="css_menu_two_line">
<b>
 <ul class="two_line_menu">
  <li><a href="index.php" style="text-decoration:none;">Home <span class="glyphicon glyphicon-home" style="color:yellow"></span></a></li>
  <li><a href="#" style="text-decoration:none;">Master <span class="glyphicon glyphicon-heart" style="color:yellow"></span></a>
 <ul class="subs">

<li><a href="hm002docordetails.php">Doctor</a></li>
<!--<li><a href="hm006testmaster.php">Test</a></li>!-->
<li><a href="ecg_hm001testtype.php">Test Type</a></li>
<li><a href="hm003expensesgroup.php">Expenses</a></li>
<li><a href="hm004eb.php">Eb</a></li>


</ul></li>
<li><a href="#" style="text-decoration:none;">Transaction <span class="glyphicon glyphicon-resize-small" style="color:yellow"></span></a>
    <ul class="subs">
      <li><a href="ht001outpatient.php">OUT-PATIENT</a></li>
      <li><a href="ecg_ht001billing.php">ECG-XRAY</a></li>
      <li><a href="ht002collection.php">COLLECTION</a></li>
      <li><a href="ht007expenses.php">EXPENSES</a></li>
      <li><a href="ht005ebdetails.php">EB</a></li>
      <li><a href="ht005ebdetails_new.php">EB[NEW]</a></li>
      <li><a href="ht010evententry.php">Event-Registration</a></li>
    <li><a href="birth_report_entry.php">Birth Entry</a></li>

    </ul>
</li>

<li><a href="#" style="text-decoration:none;">Report <span class="glyphicon glyphicon-file" style="color:yellow"></span></a>
    <ul class="subs">
      <li><a href="hr001outpatient.php">OUT-PATIENT</a></li>
<li><a href="hr_a_outpatient.php">O-P SUMMARY </a></li>
      <li><a href="ecg_hr001billing.php">ECG-XRAY</a></li>
      <li><a href="hr003collection.php">COLLECTION</a></li>
     <li><a href="hr002expenses_user.php">EXPENSES_NEW</a></li>
      <li><a href="hr008ebdetails.php">E-B</a></li>
     <li><a href="hr008ebdetails_new.php">E-B[NEW]</a></li>
<li><a href="hr008_a_eb.php">Eb(Srinivasan Sir)</a></li>
 <li><a href="birth_reportview.php">Birth Entry</a></li>

    </ul>
</li>

<li><a href="#" style="text-decoration:none;">Auditor <span class="glyphicon glyphicon-fullscreen" style="color:yellow"></span></a>
    <ul class="subs">
<!--<li><a href="hr_a_collection.php">EXPENSES</a></li>!-->
      <li><a href="hr002expenses.php">EXPENSES</a></li>
<li><a href="hr_a_consolidated.php">O-P</a></li>

<li><a href="hr_a_001_outpatient.php">O-P[1]</a></li>
<li><a href="ecg_hr002auditor.php">ECG-XRAY</a></li>
    </ul>
</li>
<li><a href="http://technicalhspt.org/claim/">CLAIM</a>

<li><a href="#" style="text-decoration:none;">Bank <span class="glyphicon glyphicon-briefcase" style="color:yellow"></span></a>
    <ul class="subs">

    <li><a href="hm009bankdetails.php">ADD BANK DETAILS</a></li>
<li><a href="ht001banktransaction.php">BANK TRANSACTION</a></li>


    </ul>
</li>

<!--
<li><a href="#" style="text-decoration:none;">PHONE-BOOK</a>
    <ul class="subs">
      <li><a href="phonebook/addgroup.php">ADD GROUP</a></li>
      <li><a href="phonebook/addsubgroup.php">ADD SUB GROUP</a></li>
      <li><a href="phonebook/ht001addnumbers.php">ADD NUMBERS</a></li>
      <li><a href="phonebook/showdatas.php">VIEW NUMBERS</a></li>
      <li><a href="phonebook/ht001outgoingentry.php">OUT-GOING CALLS ENTRY</a></li>
      <li><a href="phonebook/hr001outgoingcalls.php">REPORT</a></li>
    </ul>
</li>
!-->
<?php
if(($GLOBALS ['xCurrentUser']=="admin"))
{
?>
<li><a href="#" style="text-decoration:none;">Setup</a>
    <ul class="subs">
     <li><a href="uploads.php">UPLOAD</a></li>
     <li><a href="">USER-PERMISSIONS</a></li>
     <li><a href="hm010userpage.php">USER-CREDENTIALS</a></li>
     <li><a href="hc003datetime.php">DATE&TIME</a></li>
    </ul>
</li>
   
<?
}
?>

<li><a href="#" style="text-decoration:none;"class="slideout-menu-toggle"><i class="fa fa-bars"></i>Tools <span class="glyphicon glyphicon-th-list" style="color:yellow"> </a></li>

</ul>
</div>
	<!--<div id="footer">
		<table border="0" cellpadding="15px" align="center" style="size: 12px; font-family: 'Courier New', Courier, monospace; color: #FFF; font-size: 12px;">
			<tr>
				<td>Designed By:<a href="https://www.mohamedsaleem.co.uk"></a>
				</td>
			</tr>
		</table>
	</div>
!-->
</body>
</html>