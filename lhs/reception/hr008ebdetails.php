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
           <th>AC</th>


<?
if($xEbNo==0 || $xEbNo==1)
{
?>

           <th>LW</th>
           <th>W</th>
           <th>N.F</th>
           <th>N.S</th>
           <th>LAB(U)</th>

           <th>LIFT</th>
           <th>M</th>
           <th>X</th>
           <th>P</th>

<?
}
if($xEbNo==0 || $xEbNo==2)
{
?>
           <th>G.F</th>
           <th>T</th>
           <th>O.F</th>
           <th>O.S</th>
           <th>T.F</th>
           <th>R.S</th>
           <th>L.H</th>
<?
}
if($login_session=="admin")
{
?>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th> CREATEDASON</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th> UPDATEDASON</th> <? } ?>
   
<?        
}
?>
           <th colspan="2" width="10%">ACTIONS</td>
          </tr>
      </thead>


<tfoot>
        <tr>

           <th width="10%">DATE</th>
           <th>EB</th>
           <th>TIME</th>
           <th>READING</th>
           <th>CONSUMES</th>
           <th>AC</th>


<?
if($xEbNo==0 || $xEbNo==1)
{
?>

           <th>LW</th>
           <th>W</th>
           <th>N.F</th>
           <th>N.S</th>
           <th>LAB(U)</th>

           <th>LIFT</th>
           <th>M</th>
           <th>X</th>
           <th>P</th>

<?
}
if($xEbNo==0 || $xEbNo==2)
{
?>
           <th>G.F</th>
           <th>T</th>
           <th>O.F</th>
           <th>O.S</th>
           <th>T.F</th>
           <th>R.S</th>
           <th>L.H</th>
<?
}
if($login_session=="admin")
{
?>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th> CREATEDASON</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th> UPDATEDASON</th> <? } ?>
   
<?        
}
?>
           <th colspan="2" width="10%">ACTIONS</td>
          </tr>
      </tfoot>

      <tbody>

<?php
$xQryFilter='';
$xGrandConsumes=0;
$xGrandAcRoom=0;
$xGrandLabourWard=0;
$xGrandWarmer=0;
$xGrandNewFirstFloor=0;
$xGrandNewSecondFloor=0;
$xGrandLab=0;
$xGrandLift=0;
$xGrandMotor=0;
$xGrandXray=0;
$xGrandPost=0;

$xGrandGroundFloor=0;
$xGrandTheatre=0;
$xGrandOldFirstFloor=0;
$xGrandOldSecondFloor=0;
$xGrandOldTopFloor=0;
$xGrandGroundFloor=0;
$xGrandRS=0;
$xGrandLH=0;

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
    echo '<td bgcolor=#888888>' . $row['acroom']  . '</td>';
$xGrandConsumes+=$row['consumption'];
$xGrandAcRoom+=$row['acroom'];
if($xEbNo==0 || $xEbNo==1)
{
    echo '<td bgcolor=#888888>' . $row['labourward']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['warmer']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['newfirstfloor']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['newsecondfloor']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['lab']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['lift']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['motor']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['xray']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['post']  . '</td>';
$xGrandLabourWard+=$row['labourward'];
$xGrandWarmer+=$row['warmer'];
$xGrandNewFirstFloor+=$row['newfirstfloor'];
$xGrandNewSecondFloor+=$row['newsecondfloor'];
$xGrandLab+=$row['lab'];
$xGrandLift+=$row['lift'];
$xGrandMotor+=$row['motor'];
$xGrandXray+=$row['xray'];
$xGrandPost+=$row['post'];
}


if($xEbNo==0 || $xEbNo==2)
{
    echo '<td bgcolor=#888888 >' . $row['groundfloor']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['theatre']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['oldfirstfloor']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['oldsecondfloor']  . '</td>';
    echo '<td bgcolor=#888888 >' . $row['topfloor']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['rs']  . '</td>';
    echo '<td bgcolor=#888888>' . $row['lh']  . '</td>';

$xGrandGroundFloor+=$row['groundfloor'];
$xGrandTheatre+=$row['theatre'];
$xGrandOldFirstFloor+=$row['oldfirstfloor'];
$xGrandOldSecondFloor+=$row['oldsecondfloor'];
$xGrandOldTopFloor+=$row['topfloor'];
$xGrandRS+=$row['rs'];
$xGrandLH+=$row['lh'];
}
if($login_session=="admin")
{
    if($GLOBALS ['xViewCreatedAsOn']  == 0){echo '<td>' . $row['createdason']  . '</td>';    }
    if($GLOBALS ['xViewUpdatedAsOn']  == 0){echo '<td>' . $row['updatedason']  . '</td>';    }
}
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

echo '<tr style=font-weight:bold;>';
    echo '<td colspan=3>GRAND TOTAL</td>';
    echo '<td></td>';
    echo '<td>' . round($xGrandConsumes). '</td>';
    echo '<td>' . $xGrandAcRoom. '</td>';
if($xEbNo==0 || $xEbNo==1)
{
    echo '<td>' . $xGrandLabourWard. '</td>';
    echo '<td>' . $xGrandWarmer. '</td>';
    echo '<td>' . $xGrandNewFirstFloor. '</td>';
    echo '<td>' . $xGrandNewSecondFloor. '</td>';
    echo '<td>' . $xGrandLab. '</td>';
    echo '<td>' . $xGrandLift. '</td>';
    echo '<td>' . $xGrandMotor. '</td>';
    echo '<td>' . $xGrandXray. '</td>';
    echo '<td>' . $xGrandPost. '</td>';
}

if($xEbNo==0 || $xEbNo==2)
{
    echo '<td>' . $xGrandGroundFloor. '</td>';
    echo '<td>' . $xGrandTheatre. '</td>';
    echo '<td>' . $xGrandOldFirstFloor. '</td>';
    echo '<td>' . $xGrandOldSecondFloor. '</td>';
    echo '<td>' . $xGrandOldTopFloor. '</td>';
    echo '<td>' . $xGrandRS. '</td>';
    echo '<td>' . $xGrandLH. '</td>';
}

    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
echo '</tr>'; 
?>
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</body></html>	