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
<body onFocus="parent_disable();" onclick="parent_disable()">

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
<li><a href="" onclick="PrintDiv(); return false">PRINT</a></li>
<li><a href="" onclick="RefreshPage(); return false">REFRESH</a></li>
	</ul>
</div>
<!--/.slideout-menu-->
<div class="css_menu_two_line">
<ul class="two_line_menu">
<li><a href='index.php'>Home</a> </li>
<li><a href='fastreport.php'>Fast-Report</a></li>
<li><a href='hr002_full_data.php'>Full-Report</a></li>
<li><a href='hr001_general_details.php'>Report</a></li>
<li><a href='hr003_lr_details.php'>Lr-Report</a></li>
<li><a href='hr005_hospitalno.php'>HospitalNo-Report</a></li>
<li><a href='hr004_patient_status.php'>Patient Status</a></li>

	
<li><a href="#" style="text-decoration:none;"class="slideout-menu-toggle"><i class="fa fa-bars"></i>Tools </a></li>
</ul>
</div>
</body>
</html>
