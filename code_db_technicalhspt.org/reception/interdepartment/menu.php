<style>
/* CSSTerm.com CSS Horizontal menu with images */

.css_menu_two_line {
	width:100%;
	overflow:hidden;
}

.two_line_menu {
    position: relative;
    margin-bottom: 40px;
    background:#77f url('img_bg.gif') repeat-x;
}

.two_line_menu a {
    display: block;
    color: #000;
    text-decoration: none;
    padding:10px;
}

.two_line_menu li:hover a {
    color: #fff;
    background: #aaf;
}

.two_line_menu li { display: inline-block; }

.two_line_menu li ul { display: none; }

.two_line_menu li:hover ul {
    display: block;
    position: absolute;
    left: 0;
    width: 100%;
    background: #aaf;
    top: 38px;
}

.two_line_menu li ul li:hover a { color: #000; }
/* SIDE MENU */

*      {
		margin: 0;
		padding: 0;
		font-family: 'Oswald', sans-serif;
	}
	
	body {
	    background: url(../images/colosseum.jpg) no-repeat center center fixed; 
	    -webkit-background-size: cover;
	    -moz-background-size: cover;
	    -o-background-size: cover;
	    background-size: cover;
	}
	
	.slideout-menu {
		position: fixed;
		top: 0;
		right: -250px;
		width: 250px;
		height: 100%;
		background:#A9A9A9;
		z-index: 100;
	}
	.slideout-menu h3 {
		position: relative;
		padding: 12px 10px;
		color: #fff;
		font-size: 1.2em;
		font-weight: 400;
	}
	.slideout-menu .slideout-menu-toggle {
		position: absolute;
		top: 12px;
		right: 10px;
		display: inline-block;
		padding: 6px 9px 5px;
		font-family: Arial, sans-serif;
		font-weight: bold;
		line-height: 1;
		background: #222;
		color: #999;
		text-decoration: none;
		vertical-align: top;
	}
	.slideout-menu .slideout-menu-toggle:hover {
		color: #fff;
	}
	.slideout-menu ul {
		list-style: none;
		font-weight: 300;
	
	}
	.slideout-menu ul li {
		
	}
	.slideout-menu ul li a {
		position: relative;
		display: block;
		padding: 10px;
		color: #DC143C;
		text-decoration: none;
	}
	.slideout-menu ul li a:hover {
		background: #000;
		color: #d8d8d8;
	}
	.slideout-menu ul li a i {
		position: absolute;
		top: 15px;
		right: 10px;
		opacity: .5;
	}

	
/* SIDE MENU ENDED */

</style>
<body onFocus="parent_disable();" onclick="parent_disable()";>
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



<div class="slideout-menu">
	<h3>MENU<a href="#" class="slideout-menu-toggle">&times;</a></h3>
	<ul>
<font face="verdana" size="4" color="green">
<li><a href="../hc001fromtodate.php"  onclick="basicPopup(this.href);return false">SET DATE <span class="glyphicon glyphicon-calendar" style="color:yellow"></span> </a></li>
<li><a href="inv_hc001_config_inventory.php"  onclick="basicPopup(this.href);return false">SETTINGS<span class="glyphicon glyphicon-calendar" style="color:yellow"></span> </a></li>
<li><a href="" onclick="PrintDiv(); return false">PRINT <span class="glyphicon glyphicon-print" style="color:yellow" ></span></a></li>
<li><a href="" onclick="RefreshPage(); return false">REFRESH <span class="glyphicon glyphicon-refresh" style="color:yellow"></span></a></li>
</font>
	</ul>
</div>
<!--/.slideout-menu-->
<div class="css_menu_two_line">
<ul class="two_line_menu">
<li><a href='index.php'>Home<span class="glyphicon glyphicon-home" style="color:yellow"></span></a> </li>
<li><a href='#'>Master <span class="glyphicon glyphicon-heart" style="color:yellow"></span></a>
	<ul>
<li><a href="inv_hm001supplier.php">Supplier</a></li>
<li><a href="inv_hm002itemcategory.php">Category</a></li>
<li><a href="inv_hm003itemgroup.php">Group</a></li>
<li><a href="inv_hm004itemsubgroup.php">SubGroup</a></li>
<li><a href="inv_hm005item.php">Item</a></li>
<li><a href="inv_hm006stockpoint.php">StockPoint</a></li>
<li><a href="inv_ht002stockentry.php">Stock</a></li>
	</ul>
</li>

<li><a href='#'>Transaction <span class="glyphicon glyphicon-resize-small" style="color:yellow"></span></a>
	<ul>
<li><a href="inv_ht003purchaseentry.php" onclick="basicPopup(this.href);return false">Purchase</a></li>
<li><a href="inv_ht004salesentry.php" onclick="basicPopup(this.href);return false">Sales</a></li>
<li><a href="inv_ht005_a_amcentry.php">Amc</a></li>
<li><a href="inv_ht007_excess_shortage.php">Excess/Shortage</a></li>
       </ul>
</li>


<li><a href='#'>Return <span class="glyphicon glyphicon-registration-mark" style="color:yellow"></span></a>
<ul>
<!--
<li><a href="inv_ht003_a_purchasereturn.php">Purchase</a></li>
!-->
<li><a href="inv_ht004_a_salesreturn.php">Sales</a></li>
</ul>
</li>


<li><a href='#'>Report <span class="glyphicon glyphicon-file" style="color:yellow"></span></a>
<ul>
  <li><a href="inv_hr002item.php">Item</a></li>
<li><a href="inv_hr003purchaseentry.php">Purchase</a></li>
<li><a href="inv_hr003_b_purchaseconsolidated.php">Purchase-Consolidated</a></li>
<li><a href="inv_hr004salesentry.php">Sales</a></li>
<li><a href="">Amc</a></li>
</ul>
</li>

<li><a href='inv_ht006reprint.php'>Reprint <span class="glyphicon glyphicon-print" style="color:yellow"></span></a>
<ul>

</ul>
</li>


<li><a href='#'>Stock <span class="glyphicon glyphicon-paperclip" style="color:yellow"></span></a>
	<ul>
<li><a href="inv_hr002_a_lowstock.php">Low</a></li>
<li><a href="inv_hr002_b_highstock.php">High</a></li>
<li><a href="inv_hr002_c_betweendates.php">BetweenDates</a></li>
<li><a href="inv_hr002_d_betweendatespurchaseorder.php">BetweenDates(Purchase Order)</a></li>
	</ul>
</li>

<li><a href='#'>Complaint <span class="glyphicon glyphicon-pushpin" style="color:yellow"></span></a>
	<ul>
<?php
if($login_session=="admin")
{
?>
<li><a href="inv_ht001_c_complaintpayment.php">Payment</a></li>
<li><a href="inv_hr001complaints.php">Report</a></li>
<li><a href="inv_ht001complaint.php">Full-Entry</a></li>
<?php 
}
else
{
?>
<li><a href="inv_ht001_a_complaintentry.php">Entry</a></li>
<li><a href="inv_ht001_b_complaintsuccess.php">Success</a></li>
<li><a href="inv_hr004_status_processing.php">Processing-Report</a></li>
<li><a href="inv_hr004_status_completed.php">Completed-Report</a></li>

<?php
}
?>
</ul>
</li>
<li><a href="#" style="text-decoration:none;"class="slideout-menu-toggle"><i class="fa fa-bars"></i>Tools <span class="glyphicon glyphicon-th-list" style="color:yellow"> </a></li>
<li><a href="../../logout.php">Logout<span class="glyphicon glyphicon-log-out" style="color:yellow"></span>  <?php echo $GLOBALS ['xCurrentUser']; ?></a></li> 
</ul>
</div>
</body>
</html>