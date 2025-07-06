<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
@font-face {
	font-family: 'Tamil'; '
	src: url('fonts/trichy.ttf');
}

.p {
	font-family: Tamil, Helvetica, sans-serif;
}

p.groove {
	border-style: groove;
	margin-left: 50px;
	margin-right: 50px;
}

table {
	margin-left: 50px;
	margin-right: 50px;border: 2px single black;
}
table {
    border-collapse: collapse;
}


</style>


<body>
</br></br>
<?php
include 'config.php';
$row ['mothername']  = 1;
date_default_timezone_set ( 'Asia/Calcutta' );
$xDate=date ('d/M/y h:i:s A');
echo "<table border=0 width=100% >";
echo "<b><tr class=noBorder>";

echo "<td colspan=2 align=center ><H2> <u>LAKSHMI HOSPITAL-TIRUNELVELI</u></H2> </td>";
//echo " <td rowspan=3><img src=images/lhs_logo.jpg width=200px height=120px></td>";
echo "</tr></b>";

echo "<tr class=noBorder>";
echo "<td colspan=2 align=center > <H3><u>BIRTH INFORMATION REPORT</u></h3> </td>";
echo "</tr>";
echo "<tr class=noBorder>";
echo "<td  align=left>&nbsp REF /HBR-417    /2016 : </td>";
echo "<td align=center>&nbsp Date & Time :" .$xDate  . " </td>";
echo "</tr>";
echo "</table>";
echo "</br>";
echo "</br>";
echo "<table border=1 width=90% >";
$xBirthId = $_GET ['birthreportid'];

$xQry = "SELECT * from birth_report where birthreportid=$xBirthId";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
echo "<tr>";
echo "<td  width=50% align=left> MOTHER NAME</td>";
echo "<td  width=50% align=left>" .$row ['mothername'] . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> FATHER NAME</td>";
echo "<td  align=left>" . $row ['fathername']  . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td   align=left> GENDER OF BABY</td>";
echo "<td  align=left>" . $row ['gender']  . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td   align=left> DATE OF BIRTH</td>";
echo "<td  align=left>" .date('d-m-Y', strtotime($row ['date']))     . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> TIME OF BIRTH</td>";
echo "<td  align=left>" . $row ['time']  . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> BABY WEIGHT</td>";
echo "<td  align=left>" . $row ['weight']  . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> KIND OF DELIVERY</td>";
echo "<td  align=left>" . $row ['delivery']  . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td   align=left> ATTENDED BY DR</td>";
echo "<td  align=left>" . $row ['doctorname']  . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> ADDRESS</td>";
echo "<td  align=left>" . $row ['address']  . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td   align=left> PREPARED BY </td>";
echo "<td  align=left>" . $row ['preparedby']  . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td   align=left> COLLECTED BY </td>";
echo "<td  align=left>" . $row ['collectedby']  . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td   align=left> RELATIONSHIP</td>";
echo "<td  align=left>" . $row ['relationship']  . "</td>";
echo "</tr>";

echo "</table>";
}
?>	
</br> </br> </br> </br> </br> </br> 
<p class="groove">
		இக்கடிதத்தை சிந்துபூந்துறை வார்டு அலுவலகத்தில் கொடுத்து பிறப்பு சான்றிதழை பெற்றுக்கொள்ளவும். <br/>இதில் எந்த ஒரு திருத்தமும் செய்யப்படமாட்டாது. </br>
	</p>
	<p class="groove">
		பிறப்பு இறப்பு பதிவு அலுவலக முகவரி: 
</br> 
செல்வி அம்மன் கோவில் எதிரில் ,செல்வி நகர்,சிந்துபூந்துறை.
	</p>
</body>
</html>

