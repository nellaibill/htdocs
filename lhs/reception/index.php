<?php
include 'globalfile.php';
$xQry = "SELECT *  from reminder_basic where status='Processing' and reminder_date<= DATE(NOW())";

//echo $xQry;
$result2 = mysql_query ( $xQry );
echo '<h3><marquee bgcolor="yellow">';
while ( $row = mysql_fetch_array ( $result2 ) )
  {
      if($row ['due_date']!="0000-00-00")
    {
        $now = time(); // or your date as well
$your_date = strtotime($row ['due_date']);
$datediff = $your_date-$now;
$xRemainingDays= round($datediff / (60 * 60 * 24));
      $xTaskId=$row ['task_id'];
	    echo '<a href=reminder_view.php?task_id='.$xTaskId.'>' . $row ['task_name'].": " . date("d/M/Y", strtotime($row ['due_date'])).": " . $row ['amount']." Remaining Days : " .$xRemainingDays. '</a>';
	    echo " , ";
    }
}
echo '</marquee></h3>';
echo '</br>';
echo '</br>';
/* Display's today's date  data's only */


function checkIsAValidDate($myDateString){
    return (bool)strtotime($myDateString);
}

$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];

/* Display's today's date  data's only Ended */

/* Three Days Before alert will be provided */

$xQry="SELECT *  FROM t_event where enddate between date_sub('$xFromDate', interval 3 day) and '$xFromDate'";
$result = mysql_query ($xQry) or die ( mysql_error () );
           while ($row = mysql_fetch_array($result)) {
?>
<script>
swal("Reminder!", '<?php echo  $row['eventname']; ?>', "success");
</script>
<?php  }

/*Alert Ended  */


$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xOpCollectionQry="SELECT sum(fees) as opcollection,count(txno) as totalcases from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xOpCollectionQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xOpCollection']=$row['opcollection'] ;
 $GLOBALS ['xTotalCases']=$row['totalcases'] ;
}

$xLakshmananCollectionQry="SELECT sum(fees) as lakshmanancollection,count(txno) as lakshmanantotalcases from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate' and doctorname=1";
$result2=mysql_query($xLakshmananCollectionQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xLakshmananOpCollection']=$row['lakshmanancollection'] ;
 $GLOBALS ['xLakshmananTotalCases']=$row['lakshmanantotalcases'] ;
}

$xMeenaCollectionQry="SELECT sum(fees) as meenacollection,count(txno) as meenatotalcases from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate' and doctorname=2";
$result2=mysql_query($xMeenaCollectionQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xMeenaOpCollection']=$row['meenacollection'] ;
 $GLOBALS ['xMeenaTotalCases']=$row['meenatotalcases'] ;
}

$xDailyExpensesQuery="SELECT sum(amount) as amount from dailyexpenses WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xDailyExpensesQuery);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xExpenses']=$row['amount'] ;
}
$xEbQry="SELECT SUM( consumption) as consumption FROM t_ebdetails_new WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xEbQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xConsumption']=$row['consumption'] ;
}

$xComplaintsQry="SELECT count(complaintno) as count FROM t_complaint WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xComplaintsQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xComplaintCount']=$row['count'] ;
}

$xGeneratorQry="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(totaltime))) as generator FROM generatordetails WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xGeneratorQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xGenerator']=$row['generator'] ;
}
$xLeaveCountQry="SELECT sum(empno) as leavecount from attendence WHERE date >= '$xFromDate' AND date<= '$xToDate'"; 
$result2=mysql_query($xGeneratorQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xGenerator']=$row['generator'] ;
}
$xEcgCountQry="SELECT count(txno)as ecgcount,sum(testamount) as ecgtestamount  from t_ecgxraybilling WHERE date >= '$xFromDate' AND date<= '$xToDate' and testtypeno=1"; 
$result2=mysql_query($xEcgCountQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xEcgCount']=$row['ecgcount'] ;
 $GLOBALS ['xEcgTestAmount']=$row['ecgtestamount'] ;
}
$xXrayCount="SELECT count(txno) as xraycount,sum(testamount) as xraytestamount from t_ecgxraybilling WHERE date >= '$xFromDate' AND date<= '$xToDate' and testtypeno!=1";
$result2=mysql_query($xXrayCount);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xXrayCount']=$row['xraycount'] ;
 $GLOBALS ['xXrayTestAmount']=$row['xraytestamount'] ;
}

$xAttendenceQry="SELECT count(txno) as employeecount from attendence WHERE date >= '$xFromDate' AND date<= '$xToDate' and status>0";
$result2=mysql_query($xAttendenceQry);
while ($row = mysql_fetch_array($result2)) {
 $GLOBALS ['xEmployeeLeaveCount']=$row['employeecount'] ;
}
echo '</br>'; 
echo '<table class="table">'; 
  echo "<tr><td> TOTAL O/P COLLECTION</td><td>"; 
  echo   "Rs ".money_format("%!n", $GLOBALS ['xOpCollection'])."[".$GLOBALS ['xTotalCases']."-<span class='glyphicon glyphicon-user' style='color:blue'></span>]";
  echo "</td><td><a href='hr001outpatient.php?doctorno=0&noontype=ALL&casetype=ALL&casetype1=ALL&status=ALL&xmode=report'; ><img      src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";  
  echo "<tr><td> DR.LAKSHMANAN COLLECTION</td><td>"; 
  echo   "Rs ".money_format("%!n", $GLOBALS ['xLakshmananOpCollection'])."[".$GLOBALS ['xLakshmananTotalCases']."-<span class='glyphicon glyphicon-user' style='color:blue'></span>]";
  echo "</td><td><a href='hr001outpatient.php?doctorno=1&noontype=ALL&casetype=ALL&casetype1=ALL&status=ALL&xmode=report'; ><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";  
  echo "<tr><td> DR.MEENA COLLECTION</td><td>"; 
  echo   "Rs ".money_format("%!n", $GLOBALS ['xMeenaOpCollection'])."[".$GLOBALS ['xMeenaTotalCases']."-<span class='glyphicon glyphicon-user' style='color:blue'></span>]";
  echo "</td><td><a href='hr001outpatient.php?doctorno=2&noontype=ALL&casetype=ALL&casetype1=ALL&status=ALL&xmode=report'; ><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";
  echo "<tr><td> EXPENSES</td><td>"; 
  echo   "Rs ". money_format("%!n",$GLOBALS ['xExpenses']) ;
  echo "</td><td><a href='ht007expenses.php'><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td></tr>";
  echo "<tr><td> CONSUMED E-B UNITS</td><td>"; 
  echo  round($GLOBALS ['xConsumption']);
  echo "</td><td><a href='hr008ebdetails_new.php?xmode=report';><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td></tr>";
  echo "</td></tr>"; 
  echo "<tr><td>ECG</td><td>"; 
  echo   "Rs ".money_format("%!n", $GLOBALS ['xEcgTestAmount'])."[".$GLOBALS ['xEcgCount']."-ECG]";
  echo "</td><td><a href='ecg_ht001billing.php?ecgtype=1'; >
         <img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";

  echo "<tr><td>X-RAY <td>"; 
  echo  "Rs ".money_format("%!n", $GLOBALS ['xXrayTestAmount'])."[".$GLOBALS ['xXrayCount']."-XRAY]";
  echo "</td><td><a href='ecg_ht001billing.php?ecgtype=2'; >
          <img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td> </tr>";
  echo "</td></tr>";
if(($GLOBALS ['xCurrentUser']=="admin"))
{
  echo "<tr><td> EMPLOYEES LEAVE COUNT</td><td>"; 
  echo  $xEmployeeLeaveCount;
  echo "</td><td><a href='manager/hrm_ht003attendence.php'><img src='../images/view.png'  style='width:40px;height:30px;border:0'></a></td></tr>";
}

?>                  

  
<html>
<title>HOME-PAGE</title>
<?php
if(($GLOBALS ['xCurrentUser']=="admin"))
{
?>
<?php
}
?>
</html>