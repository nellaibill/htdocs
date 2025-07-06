<?php
include 'globalfunctions.php';
                     $GLOBALS ['xIp'] = '';
                     $GLOBALS ['xOpl'] = '';
					     $GLOBALS ['xOpm'] = '';
                     $GLOBALS ['xLab'] ='';
                     $GLOBALS ['xScan'] = '';
                     $GLOBALS ['xXray'] = '';
                     $GLOBALS ['xEcg'] = '';
                     $GLOBALS ['xOthers'] = '';
if ( isset( $_GET['date'] ) && !empty( $_GET['date'] ) )
{
  $xDate= $_GET['date'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['date']);
   }
   else
   {
      $xQry = "DELETE FROM income WHERE date='$xDate'";
      mysql_query ( $xQry );
      header('Location: index.php'); 	
   }
}

if (isset ( $_POST ['save'] ))
{
         DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}

function DataFetch($xDate) {
    $result = mysql_query ( "select * from income where date='$xDate'" ) or die ( mysql_error () );
	$count = mysql_num_rows($result);
	if($count>0){
	while ( $row = mysql_fetch_array ( $result ) ) 
             {
                     $GLOBALS ['xDate'] = $row ['date'];
                     $GLOBALS ['xIp'] = $row['ip'];
                     $GLOBALS ['xOpl'] = $row['opl'];
                     $GLOBALS ['xOpm'] = $row['opm'];
                     $GLOBALS ['xLab'] = $row['lab'];
                     $GLOBALS ['xScan'] = $row['scan'];
                     $GLOBALS ['xXray'] = $row['xray'];
                     $GLOBALS ['xEcg'] = $row['ecg'];
                     $GLOBALS ['xOthers'] = $row['others'];
               }
	}
}

function DataProcess($mode) {
require_once('config1.php');
$xDate=$_POST[date];
$xIp= !empty($_POST[ip]) ? "$_POST[ip]" :0;
$xOpl= !empty($_POST[opl]) ? "$_POST[opl]" :0;
$xOpm= !empty($_POST[opm]) ? "$_POST[opm]" :0;
$xLab= !empty($_POST[lab]) ? "$_POST[lab]" :0;
$xScan= !empty($_POST[scan]) ? "$_POST[scan]" :0;
$xXray= !empty($_POST[xray]) ? "$_POST[xray]" :0;
$xEcg= !empty($_POST[ecg]) ? "$_POST[ecg]" :0;
$xOthers= !empty($_POST[others]) ? "$_POST[others]" :0;
$xQry="";
$xMsg="";
if ($mode == 'S') 
{
$insert="INSERT INTO income (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$xDate',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";
$insertforxincome="INSERT INTO xincome (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$xDate',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";
$con->query($insert);
$con->query($insertforxincome);
echo '<script language="javascript">';
echo 'alert("Records Inserted")';
echo '</script>';
} 
elseif ($mode == 'U')
{
$delete ="delete from income where date='$xDate'";
$deleteforxincome ="delete from xincome where date='$xDate'";
$con->query($delete);
$con->query($deleteforxincome);
$insert="INSERT INTO income (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$xDate',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";
$insertforxincome="INSERT INTO xincome (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$xDate',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";
$con->query($insert);
$con->query($insertforxincome);
echo '<script language="javascript">';
echo 'alert("Records Updated")';
echo '</script>';
}

require_once('index.php');
}
?>
<html>
<head>
<title>INSERT INCOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form class="form" name="incomeform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">INSERT INCOME RECORDS  HERE</h3>
</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
  <label>Date:</label>
  <input type="date" name="date" class="form-control" value="<?php echo $GLOBALS ['xDate'];?>">
</div>

<div class="col-xs-3">
  <label>IP-Amount:</label>
  <input type="text" name="ip" class="form-control" value="<?php echo $GLOBALS ['xIp'];?>">
</div>

<div class="col-xs-3">
  <label>OPL-Amount:</label>
  <input type="text" name="opl" class="form-control" value="<?php echo $GLOBALS ['xOpl'];?>">
</div>

<div class="col-xs-3">
  <label>OPM-Amount:</label>
  <input type="text" name="opm" class="form-control" value="<?php echo $GLOBALS ['xOpm'];?>">
</div>

<div class="col-xs-3">
  <label>LAB-Amount:</label>
  <input type="text" name="lab" class="form-control" value="<?php echo $GLOBALS ['xLab'];?>">
</div>

<div class="col-xs-3">
  <label>SCAN-Amount:</label>
  <input type="text" name="scan" class="form-control" value="<?php echo $GLOBALS ['xScan'];?>">
</div>

<div class="col-xs-3">
  <label>X-RAY-Amount:</label>
  <input type="text" name="xray" class="form-control" value="<?php echo $GLOBALS ['xXray'];?>">
</div>

<div class="col-xs-3">
  <label>ECG-Amount:</label>
  <input type="text" name="ecg" class="form-control" value="<?php echo $GLOBALS ['xEcg'];?>">
</div>

<div class="col-xs-3">
  <label>OTHERS-Amount:</label>
  <input type="text" name="others" class="form-control" value="<?php echo $GLOBALS ['xOthers'];?>">
</div>


</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE"> 
           <? } else{ ?>
             <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE"> 
           <? }  ?>
        </div>
</div>
	

</div><!-- Panel Success !-->
</form>


<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW INCOMES(LAST 15 ENTRIES)</h3></div>
<table class="table">
      <thead>
        <tr>
          <th> DATE </th>

          <th>IP</th>
 
          <th>OPL</th>

          <th>OPM</th>
          <th>LAB</th>
 
          <th>SCAN</th>
        
          <th>XRAY</th>
 
          <th>ECG</th>
 
          <th>OTHERS</th>
		  
          <th>TOTAL</th>
           <th colspan="2" width="5%">ACTIONS</td>
          </tr>
      </thead>
      <tbody>

<?php
$result = mysql_query("SELECT *,(ip+opl+opm+lab+scan+xray+ecg+others) as total from income union all select 'GRAND-TOTAL',sum(ip),sum(opl),sum(opm),sum(lab),sum(scan),sum(xray),sum(ecg),sum(others),sum(ip+opl+opm+lab+scan+xray+ecg+others) from income order by date desc limit 16") or die(mysql_error());
$counter = 0;
?>
<?php

while($income_rows=mysql_fetch_array($result)){
?>
<?php
if($income_rows['date']!='GRAND-TOTAL')
{
?>
<tr>
<td  bgcolor="#CC6633"><?php echo  date('d/M/Y',strtotime($income_rows['date']))  ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['ip']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['opl']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['opm']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['lab']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['scan']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['xray']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['ecg']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['others']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['total']) ; ?></td>



<td><a href="index.php<?php echo '?date='.$income_rows['date'] . '&xmode=edit'; ?>" onclick="return confirm_edit()" ><img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td><a href="index.php<?php echo '?date='.$income_rows['date'] . '&xmode=delete'; ?>" onclick="return confirm_delete()" ><img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
</tr>
<tr>
<?php
}
else
{
?>
<tr  bgcolor="#CC66CC">
<td><?php echo  $income_rows['date'] ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['ip']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['opl']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['opm']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['lab']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['scan']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['xray']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['ecg']) ; ?></td>
<td><?php echo fn_RupeeFormat($income_rows['others']) ; ?></td>
<td><b><?php echo fn_RupeeFormat($income_rows['total']) ; ?></b></td>

<?php
}
?>
</tr>

<?php }?>
   <tr  bgcolor="#CC66CC">
          <th> DATE </th>

          <th>IP</th>
 
          <th>OPL</th>

          <th>OPM</th>
          <th>LAB</th>
 
          <th>SCAN</th>
        
          <th>XRAY</th>
 
          <th>ECG</th>
 
          <th>OTHERS</th>
		  
          <th>TOTAL</th>
 

        </tr>
</tbody>
</table>	
  </div><!-- /container -->
</div>
	