
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
<title> VIEW - O/P </title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<body>
<div class="panel panel-success">
<div class="panel-heading text-center"><b>FILTER [OUT-PATIENT] DATAS </b>
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
      </div>
</div>
<div class="panel-body">
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3"> DOCTOR NAME</label>
 <div class="col-xs-3">
 <select class="form-control"  value="" name="f_doctorno" id="doctorno" >
         <?php
          $result = mysql_query("SELECT *  FROM m_doctor order by doctorno");
           while($row = mysql_fetch_array($result))
           {
           ?>
             <option value = "<?php echo $row['doctorno']; ?>" 
             <?php
            if ($row['doctorno']== $GLOBALS ['xDoctorNo'])
               {
                 echo 'selected="selected"';
                } 
             ?> >
            <?php echo $row['doctorname']; ?> 
            </option>
             <?
              }
              echo "</select>";
             ?>
   
  </div></br></br>
<label for="lbltxno" class="control-label col-xs-3"> NOON & CASE TYPE</label>

<div class="col-xs-3">
<select class="form-control" name="f_opnoontype">
<option value="MORNING"                                              
<?php if($GLOBALS ['xNoonType']=="MORNING") echo 'selected="selected"'; ?>>MORNING</option>
<option value="EVENING" <?php if( $GLOBALS ['xNoonType']=="EVENING") echo 'selected="selected"'; ?>>EVENING</option> 
<option value="ALL" <?php if( $GLOBALS ['xNoonType']=="ALL") echo 'selected="selected"'; ?>>ALL</option> 
</select>
</div>
<div class="col-xs-3">
<select  class="form-control" name="f_opcasetype">
<option value="ALL"                                              
<?php if($GLOBALS ['xCaseType']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="GENERAL" <?php if( $GLOBALS ['xCaseType']=="GENERAL") echo 'selected="selected"'; ?>>GENERAL</option> 
<option value="EMERGENCY" <?php if( $GLOBALS ['xCaseType']=="EMERGENCY") echo 'selected="selected"'; ?>>EMERGENCY</option> 
<option value="OTHERS" <?php if( $GLOBALS ['xCaseType']=="OTHERS") echo 'selected="selected"'; ?>>OTHERS</option> 
</select>
</div>
</br></br>
<label for="lbltxno" class="control-label col-xs-3">CASE TYPE1 & STATUS</label>
<div class="col-xs-3">
<select  class="form-control" name="f_opcasetype1">
<option value="ALL"  <?php if($GLOBALS ['xCaseType1']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="NONE" <?php if( $GLOBALS ['xCaseType1']=="NONE") echo 'selected="selected"'; ?>>NONE</option> 
<option value="INJECTION" <?php if( $GLOBALS ['xCaseType1']=="INJECTION") echo 'selected="selected"'; ?>>INJECTION</option> 
<option value="URINETEST" <?php if( $GLOBALS ['xCaseType1']=="URINETEST") echo 'selected="selected"'; ?>>URINETEST</option>
<option value="ANC"
								<?php if( $GLOBALS ['xCaseType1']=="ANC") echo 'selected="selected"'; ?>>ANC</option>
								
								<option value="GREENFILE"
								<?php if( $GLOBALS ['xCaseType1']=="GREENFILE") echo 'selected="selected"'; ?>>GREENFILE</option>
</select>
</div>
<div class="col-xs-3">
<select  class="form-control" name="f_opstatus">
<option value="ALL"  <?php if($GLOBALS ['xOpStatus']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="PROCESSING"  <?php if($GLOBALS ['xOpStatus']=="PROCESSING") echo 'selected="selected"'; ?>>PROCESSING</option>
<option value="COMPLETED"  <?php if($GLOBALS ['xOpStatus']=="COMPLETED") echo 'selected="selected"'; ?>>COMPLETED</option>
<option value="CANCELLED"  <?php if($GLOBALS ['xOpStatus']=="CANCELLED") echo 'selected="selected"'; ?>>CANCELLED</option>
</select>
</div></br></br>

<div class="col-xs-3">
<label>FROM TOKEN</label>
<input type="text" class="form-control" size="3"  name="fromtokenno" value="<?php echo $GLOBALS ['xFromTokenNo'];?>">
</div>
<div class="col-xs-3">
<label>TO TOKEN</label>
<input type="text" class="form-control" size="3"  name="totokenno" value="<?php echo $GLOBALS ['xToTokenNo'];?>">
<?php
if($login_session=="admin")
{
?>
<input type="submit" value="DELETE" class="btn btn-danger"  name='delete' width="75" height="48" onclick="return confirm_delete()">
</div>
<?
}
?>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</br>
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading text-center">
<b>
    
<?php echo "FROM[".date(' d/M/y', strtotime($xFromDate)) ."]TO[".date(' d/M/y', strtotime($xToDate))."] DOCTORNAME[".$GLOBALS ['xDoctorName'] ."] CASETYPE[".$GLOBALS ['xCaseType'] ."] CASETYPE1[".$GLOBALS ['xCaseType1'] ."]  NOON [".$GLOBALS ['xNoonType'] ."]STATUS [".$GLOBALS ['xOpStatus'] ."]" ?>
<?php echo " Reprot Generated As On " . date("d/M/Y h:m:s a") . "<br>"; ?>
</b>
</div>
<div class="panel-body">
<div class="container">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="8%">TOKENNO</th>
           <th width="20%">PATIENT NAME</th>
           <th width="5%"> FEES</th>
           <th width="15%">CASE TYPE</th>
           <th width="5%">STATUS</th>
           <th width="10%">UPDATED</th>
           <th colspan="2"  width="5%">ACTIONS</th>
        </tr>
      </thead>
      <tbody class="searchable">
<?php
  $xSlNo=0;
  $xTotalAmount=0;
  $xFromTokenNo=$GLOBALS ['xFromTokenNo'];

$xToTokenNo=$GLOBALS ['xToTokenNo'];
$xCount=0;
$xQryFilter='';
  if (isSet($_POST['save'])) 
    {
    $xFromTokenNo=$_POST['fromtokenno'];
     $xToTokenNo=$_POST['totokenno'];
     $xDoctorNo= $_POST ['f_doctorno'];
     $xNoonType= $_POST ['f_opnoontype'];
     $xCaseType= $_POST ['f_opcasetype'];
     $xCaseType1= $_POST ['f_opcasetype1'];
     $xOpStatus= $_POST ['f_opstatus'];
     $xQry = "update config 
                  set doctorno=$xDoctorNo,opnoontype='$xNoonType',opcasetype='$xCaseType',opcasetype1='$xCaseType1',opstatus='$xOpStatus',
fromtokenno=$xFromTokenNo,totokenno=$xToTokenNo";
      mysql_query($xQry);
echo "<meta http-equiv='refresh' content='0'>";
      header('Location: hr001outpatient.php');
    }
else if ( isset( $_GET['xmode'] ))
{

$xCaseType=$_GET['casetype'];
$xNoonType=$_GET['noontype'];
$xCaseType1=$_GET['casetype1'];
$xDoctorNo=$_GET['doctorno'];
$xStatus=$_GET['status'];
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}
else
{
$xCaseType=$GLOBALS ['xCaseType'];
$xNoonType=$GLOBALS ['xNoonType'];
$xCaseType1=$GLOBALS ['xCaseType1'];
$xDoctorNo=$GLOBALS ['xDoctorNo'];
$xStatus=$GLOBALS ['xOpStatus'];
$xDoctorNo=$GLOBALS ['xDoctorNo'];
}
if (!empty($xFromTokenNo)) {
$xQryFilter= $xQryFilter. ' ' . "and tokenno>='$xFromTokenNo'";
}
if (!empty($xToTokenNo)) {
$xQryFilter= $xQryFilter. ' ' . "and tokenno<='$xToTokenNo'";
}
if($xDoctorNo!="0")
{
$xQryFilter= $xQryFilter. ' ' . "and doctorname='$xDoctorNo'";
}
if($xNoonType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and noontype='$xNoonType'";
}
if($xCaseType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and casetype='$xCaseType'";
}
if($xCaseType1!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and casetype1='$xCaseType1'";
}
//if($xStatus!="ALL")
//{
//$xQryFilter= $xQryFilter. ' ' . "and status='$xStatus'";
//}
 
$xQry="SELECT txno,tokenno,patientname,fees,casetype,casetype1,date,status,updatedason,noontype,doctorname,0 as orderbit from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate'  "; 
$xQry.= $xQryFilter. ' ' . "order by txno,date,noontype ;";
$result2=mysql_query($xQry);
//echo $xQry;
$xNoonType='';
while ($row = mysql_fetch_array($result2)) {
$date = $row['updatedason'];
//finddoctorname($row['doctorname']);
echo '<tr bgcolor="' . $GLOBALS['xColor'].  '">';
    if($row['noontype']=='MORNING')
     {
     $xNoonType='MOR';
     }
    else
    {
     $xNoonType='EVE';
    }
    echo '<td>' . $xSlNo+=1 . '</td>';
    echo '<td>' . $row['tokenno'] ."-".$xNoonType .'</td>';
    echo '<td>' . $row['patientname']  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['fees'])  . '</td>';
    echo '<td>' . $row['casetype'] ."-".$row['casetype1'] . '</td>';
if($row['status']==PROCESSING)
{
?>
<td><img src="../images/processing.jpg" alt="HTML tutorial" style="width:30px;height:30px;border:0"></td>
<?
}
elseif($row['status']==COMPLETED)
{
?>
<td><img src="../images/tick.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></td>
<?
}
else
{
?>
<td><img src="../images/cancelled.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></td>
<?
}
    echo '<td>' .  date('d/M/Y h:i A', strtotime($date)) . '</td>';
?>

<td><a href="ht001outpatient.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()" id="edit">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<?php
if($login_session=="admin")
{
?>
<td><a href="ht001outpatient.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()" id="delete">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<?
}
  echo '</tr>'; 
$xTotalAmount+=	$row['fees'] ;
$xCount+=1;	 
}
if (isSet($_POST['delete'])) {
$xQry="delete from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate'  "; 
$xQry.= $xQryFilter. ' ' . " ;";
}
$result2=mysql_query($xQry);
?>	

<tr style='font-weight:bold;'>
<td></td>
<td></td>
<td> GRAND TOTAL </td>
 <?php    
 echo  '<td align=right> Rs.' .money_format("%!n", $xTotalAmount) .  '</td>';
 echo '<td> TOTAL  '. $xCount. ' CASES </td>'; 
?>

</tbody>
    </table>	</div>
  
</div></div></div>
</body>
</form></html>	