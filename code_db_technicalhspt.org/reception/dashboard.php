<style>
html { font-family: "Courier New", Courier, monospace; color: #033; height:100%; margin:0; padding:0; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }
body { margin:0; font-size:16px; height:100%; margin:0; padding:0; background:url(../images/bgimg.jpg) no-repeat center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;}
#container { height:70px; width: auto; margin:0 auto; }

#header { box-shadow: -1px 5px 5px -2px #333333;  position:fixed; width:100%; height:60px; border-radius:0px 0px 15px 15px; background-color:#FFF; }
#top_info { float:left; width:40px; height:40px; background: #FFF; margin:10px; border: 1px solid #CCC; }
#navbar { height:100px; clear:both; width:50%; margin:0 auto; margin-left:auto; margin-right:auto; }
#navbar ul { margin:0; padding:0; list-style-type:none; }
#navbar ul li { padding:50px; float:left; width:0 auto; }
#navbar ul li a { font-size:12px; padding:0px 30px 0px 0px; }

#banner { background: #FFF; height:120px; clear:both; background-image:images/bg.png; }
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

#headnav { box-shadow: -2px 5px 5px -2px #333333; border-top:1px solid #690; padding:0px; clear:both; background: #690; height:60px; width:100%;}

#btnnav { border:1px solid #4AA02C; background: #4AA02C; border-radius:3px; height:40px; width:105px; color:#FFF; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#btnsearch { border:1px solid #333; background: #030; height:35px; width:90px; color: #FFF; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#btnadd { border:1px solid #033; background: #033; border-radius:3px; height:45px; width:125px; color: #FFF; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }

#bdnav1 { border:2px solid #000; background: url(../images/home1.png); background-color:#FFF; text-align: left; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav2 { border:2px solid #000; background: url(../images/registration1.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav3 { border:2px solid #000; background: url(../images/admission1.jpg); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav4 { border:2px solid #000; background: url(../images/outpatient1.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav5 { border:2px solid #000; background: url(../images/ecg2.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav6 { border:2px solid #000; background: url(../images/lab2.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav7 { border:2px solid #000; background: url(../images/salesreport.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav8 { border:2px solid #000; background: url(../images/hr.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav9 { border:2px solid #000; background: url(../images/purchase.jpg); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }
#bdnav10 { border:2px solid #000; background: url(../images/logout.png); background-color:#FFF; background-repeat:no-repeat; background-position:center; border-radius:20px; height:120px; width:250px; color: #333; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }

#txtbox { border:1px solid #CCC; background: #FFF; border-radius:3px; width:180px; font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif; }

.popup-position{ display:none; position:fixed; top:0; left:0; background-color:rgba(0,0,0,0.7); width:100%; height:100%; }
#popup-wrapper{ width:500px; margin:70px auto; text-align:center; }
#popup-container{ background-color:#fff; border-radius:4px; text-align:center; height:400px; }
#popup-head-color1 { width:500px; height:1px; color:#FFF; background:#033; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }
#popup-head-color2 { width:500px; height:1px; color:#FFF; background:#066; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }
#popup-head-color3 { width:500px; height:1px; color:#FFF; background:#4AA02C; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }
#popup-head-color4 { width:500px; height:1px; color:#FFF; background: #999; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }

.popup-position1{ display: block; position:fixed; top:0; left:0; background-color:rgba(0,0,0,0.7); width:100%; height:100%; }
#popup-wrapper1{ width:500px; margin:70px auto; text-align:center; }
#popup-container1{ background-color:#fff; border-radius:4px; text-align:center; height:400px; }
#popup-head-color1 { width:500px; height:1px; color:#FFF; background:#033; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }

.popup-position1{ display: block; position:fixed; top:0; left:0; background-color:rgba(0,0,0,0.7); width:100%; height:100%; }
#popup-wrapper2{ width:600px; margin:60px auto; text-align:center; }
#popup-container2{ background-color:#fff; border-radius:4px; text-align:center; height:520px; }
#popup-head-color5 { width:600px; height:1px; color:#FFF; background: #930; margin-left:auto; margin-right:auto; padding:0px 0px 70px; }

#btncalc { border:1px solid #CCC; color:#333; background:#FFF; height:25px; width:75px; border-radius:4px; }

a:link {
	color:#FFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	color: #030;
	text-decoration: none;
	text-align: left;
}

table {
	border-radius:3px;
	text-align: center;
}

</style>
<div id="bdcontainer">
		<table border="0" cellpadding="0" cellspacing="10" align="center">
			<tr>
				<!-- <td><a href="home.php"><input type="button" id="bdnav1"/></a></td>! -->
				<td><a href="frontoffice_001_a_patientregistration.php"><input
						type="button" id="bdnav2" /></a></td>
				<td><a href="frontoffice_001_b_admission.php"><input type="button"
						id="bdnav3" /></a></td>
				<td><a href="outpatient_003_a_report.php"><input type="button"
						id="bdnav4" /></a></td>
				  <td><a href="ecgxray_003_a_report.php"><input type="button" id="bdnav5"/></a></td>
				    <td rowspan="2"><div align="left"><b><font size="3" color="yellow">
				   Today's OP Count      :26<br/><br/>
				   Today's IP Admissions : 03 <br/><br/>
				   Today's IP Discharges : 01<br/><br/>
				   Today's OP Collection : 4,500.00<br/><br/>
				   Today's IP Collection : 26,500.00<br/><br/>
				   </font></b></div></td>

			</tr>
			<tr>
				<td><a href="supplier.php"><input type="button" id="bdnav6" /></a></td>
				<td><a href="salesreport.php"><input type="button" id="bdnav7" /></a></td>
				<td><a href="logout.php"><input type="button" id="bdnav8" /></a></td>
				<td><a href="logout.php"><input type="button" id="bdnav9" /></a></td>
				<!--<td><a href="logout.php"><input type="button" id="bdnav10" /></a></td>!-->
			</tr>
		</table>
	
	</div>