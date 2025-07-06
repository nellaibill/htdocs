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
$xEbNo=$GLOBALS ['xEbNo'];
$xTotalConsumes=0;
$xTotalLabUnits=0;
$xRsUnits=0;/* Mark Saleem 02/November/2015 Srinivasan Sir -*/ 
?>
<html>
<title> V-EB</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width:3px;
} 
</style>
</head>

<body>
 <hr>
<p><b>LW- LABOUR WARD,W-WARMER,N.F-NEW FIRST FLOOR,N.S-NEW SECOND FLOOR,R.S-SRINIVASAN SIR ,L.S-LAKSHMI HOSPITAL ,M-MOTOR,X-XRAY,P-POST,G.F-GROUND FLOOR,T-THEATRE,O.F-OLD FIRST FLOOR,O.S-OLD SECOND FLOOR,T.F-TOP FLOOR</b></p>
<hr>
<div id="divToPrint" >
</br></br></br>
  <div class="container">
<?php ReportHeader("EB"); 

if ( isset( $_GET['xmode'] ))
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xEbNo=$GLOBALS ['ebno'];
}
?>
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>

           <th width="10%">DATE</th>
           <th>EB</th>
           <th>TIME</th>
           <th>READING</th>
           <th>CONSUMES</th>
           <th>SRINIVASAN SIR</th>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th> CREATEDASON</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th> UPDATEDASON</th> <? } ?>

           <th colspan="2" width="10%">ACTIONS</td>
          </tr>
      </thead>
      <tbody>

<?php
$xQryFilter='';
if($xEbNo!=0)
{
$xQryFilter= $xQryFilter. ' ' . "and ebno=$xEbNo";
}
$xQry="SELECT *  from t_ebdetails where date>='$xFromDate' and date<='$xToDate'"; 
$xQry.= $xQryFilter. ' ' . " order by date,txno ;";
//echo $xQry;
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' .date('d-M-Y',strtotime($row['date']))  . '</td>';
    findebname($row ['ebno']);
    echo '<td>' . $GLOBALS ['xEbShortName']  . '</td>';
    echo '<td>' . strftime('%I:%M %p', strtotime($row['time'])) . '</td>';
    echo '<td>' . $row['newreading']  . '</td>';
    echo '<td>' . round($row['consumption'] ) . '</td>';
    echo '<td>' . $row['rs']  . '</td>';
$xRsUnits+=$row['rs'] ;
      if($GLOBALS ['xViewCreatedAsOn']  == 0){echo '<td>' . $row['createdason']  . '</td>';    }
    if($GLOBALS ['xViewUpdatedAsOn']  == 0){echo '<td>' . $row['updatedason']  . '</td>';    }

$xTotalConsumes+=round($row['consumption']);
?>
<td><a href="ht005ebdetails.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="ht005ebdetails.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}

?>

<tr style='font-weight:bold;'>
<td> </td>
<td colspan="2"> GRAND TOTAL </td>
<?php  echo '<td colspan="2">' . $xTotalConsumes. ' UNITS</td>';
echo '<td colspan="5">' . $xRsUnits. ' R.S UNITS </td>';
?>
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</body></html>	