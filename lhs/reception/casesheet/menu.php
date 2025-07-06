<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<body>

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
	<div class="slideout-menu">
		<h3>
			Menu <a href="#" class="slideout-menu-toggle">&times;</a>
		</h3>

		<ul>
			<!--  Side Menu Started -->

<?php
if (($GLOBALS ['xCurrentUser'] == "admin")) {
	?>
<li><a href="hc001fromtodate.php"
				onclick="basicPopup(this.href);return false">Set Date<span
					class="glyphicon glyphicon-calendar" style="color: yellow"></span>
			</a></li>
<?php
}
?>
<li><a href="" onclick="PrintDiv(); return false">Print <span
					class="glyphicon glyphicon-print" style="color: yellow"></span></a></li>
			<li><a href="" onclick="RefreshPage(); return false">Refresh <span
					class="glyphicon glyphicon-refresh" style="color: yellow"></span></a></li>
			<li><a href="backup/index.php"
				onclick="basicPopup(this.href);return false">Back Up</a></li>


		</ul>
	</div>
	<!--  Side Menu Ended -->
	<div class="css_menu_two_line">
		<ul class="two_line_menu">
			<li><a href="../../reception/index.php" style="text-decoration: none;">MAIN PROGRAM<span
					class="glyphicon glyphicon-home" style="color: yellow"></span></a></li>
			<!--    --------------------------  Master Sub Menus Started --------------------------------------->
			<li><a href="#">Master <span class="glyphicon glyphicon-heart"
					style="color: yellow"></span></a>
				<ul class="subs">
					<li><a href="hm001patientregistration.php">PATIENT-REG</a></li>
					<li><a href="hm002casetype.php">CASE-TYPE</a></li>
					<li><a href="hm003roomtype.php">ROOM-TYPE</a></li>
					<li><a href="hm004roomno.php">ROOM-NO</a></li>
					<li><a href="hm002docordetails.php">DOCTOR</a></li>
					<li><a href="ecg_hm001testtype.php">TEST TYPE</a></li>
				</ul></li>
			<!--    --------------------------  Transaction Sub Menus Started ----------------------------------->
			<li><a href="#" style="text-decoration: none;">Transaction <span
					class="glyphicon glyphicon-heart" style="color: yellow"></span></a>
				<ul class="subs">
					<li><a href="ht002admission.php">ADMISSION</a></li>
					<li><a href="ht001roomchange.php">ROOM CHANGE</a></li>
				</ul></li>
			<!--    --------------------------  Report Sub Menus Started ---------------------------------------->
			<li><a href="ecg_hr001billing.php" style="text-decoration: none;">Report
					<span class="glyphicon glyphicon-file" style="color: yellow"></span>
			</a></li>


<?php
if (($GLOBALS ['xCurrentUser'] == "admin")) {
	?>
<li><a href="#" style="text-decoration: none;">Setup</a>
				<ul class="subs">
					<li><a href="hm010userpage.php">USER-CREDENTIALS</a></li>
				</ul></li>
   
<?php
}
?>

<li><a href="#" style="text-decoration: none;"
				class="slideout-menu-toggle"><i class="fa fa-bars"></i>Tools <span
					class="glyphicon glyphicon-th-list" style="color: yellow"></span></a></li>
			<li><a href="logout.php" style="text-decoration: none;">Logout <span
					class="glyphicon glyphicon-log-out" style="color: yellow"></span>  <?php echo strtoupper($GLOBALS ['xCurrentUser'])?> <i
					class="fa fa-angle-right"></i></a></li>
		</ul>
	</div>
</body>
</html>