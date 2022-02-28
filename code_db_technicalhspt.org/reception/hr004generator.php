<?php
include('globalfile.php');
if($login_session=="admin")
{
 $xFromDate=$GLOBALS ['xFromDate'];
 $xToDate=$GLOBALS ['xToDate'];
}
else
{
 $xFromDate=$GLOBALS ['xCurrentDate'];
 $xToDate=$GLOBALS ['xCurrentDate'];
}
?>
<html>
<title> V-GENERATOR </title>
<head>
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<body>
<div id="divToPrint" >
<div class="container">
<table class="table table-hover" border="1" id="lastrow">
<thead>
<tr>
<th width="10%"> TXNO</th>
         <th width="15%"> DATE </th>
         <th width="25%"> ON-TIME</th>
         <th width="25%">OFF-TIME</th>
         <th style="text-align:center" width="10%">TIME(H:M:S)</th>
         <th width="25%"> RESPONSIBLE </th>
</tr>
</thead>
<tbody>
<?php
$total=0;
$xQry='';
require_once('config.php');
if ( isset( $_GET['xmode'] ))
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}
if($login_session=="admin")
{
$xQry="SELECT *  from generatordetails WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."' order by  txno ;  "; 
$xQryForTotalTime="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(totaltime))) as totaltime FROM generatordetails WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."'  ";
}
else
{
$xQry="SELECT *  from generatordetails WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."' order by  txno; "; 
$xQryForTotalTime="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(totaltime))) as totaltime FROM generatordetails WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."'  ";
}
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
$result3=mysql_query($xQryForTotalTime);
ReportHeader("GENERATOR ON-OFF DETAILS");
if($rowCount>0){
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['txno']  . '</td>';
    echo '<td>' . date('d/M/Y',strtotime( $row['date'])) . '</td>';
    echo '<td>' . date('d/M/Y h:m',strtotime( $row['ontime'])) . '</td>';
    echo '<td>' . date('d/M/Y h:m',strtotime( $row['offtime']))  . '</td>';
    echo '<td style=text-align:center>' . date("H:i:s", strtotime($row['totaltime'] )). '</td>';
    echo '<td>' . $row['responsibleperson'] . '</td>';
    echo '</tr>'; 
}
while ($row = mysql_fetch_array($result3)) {
    echo '<tr>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td> TOTAL TIME</td>';
    echo '<td style=text-align:center>' . $row['totaltime']. '</td>';
    echo '<td>' . $row['responsibleperson'] . '</td>';
echo '</tr>'; 
}
}
?>	
</tbody>
</table>	
</div><!-- /container -->
</div>
</body>
</html>	