<?php
include('globalfile.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> VIEW - O/P </title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<body>
<div class="panel panel-success">
<div class="panel-heading text-center"><b>FILTER [OUT-PATIENT] DATAS </b>
<div class="btn-group pull-right">
          <input type="submit"  class="btn btn-primary" name="save"   class="btn btn-primary" value="VIEW" >
          <input type="submit"  class="btn btn-danger"  name='delete' width="75" height="48" value=".." onclick="return confirm_delete()">
      </div>
</div>
<div class="panel-body">
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-3"> DOCTOR NAME</label>
 <div class="col-xs-3">
 <select class="form-control"  value="" name="f_doctorno" id="doctorno" >
         <?php
          $result = mysql_query("SELECT *  FROM m_doctor where doctorno in(3,11) order by doctorno");
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
  </div>
</div>

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
     $xDoctorNo= $_POST ['f_doctorno'];
     $xQry = "update config 
                  set doctorno=$xDoctorNo";
      mysql_query($xQry);
      header('Location: hr_a_001_outpatient.php');
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
}

$xQryFilter= $xQryFilter. ' ' . "and doctorname='$xDoctorNo'";
$xQry="SELECT txno,tokenno,patientname,fees,casetype,casetype1,date,status,updatedason,noontype,doctorname,0 as orderbit from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate'  "; 
$xQry.= $xQryFilter. ' ' . "order by txno,date,noontype ;";
//echo $xQry;
$result2=mysql_query($xQry);
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

  echo '</tr>'; 
$xTotalAmount+=	$row['fees'] ;
$xCount+=1;	 
}
if (isSet($_POST['delete'])) {
$xDoctorNo= $_POST ['f_doctorno'];
$xQry="delete from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate' and doctorname='$xDoctorNo'"; 
}
//echo $xQry;
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
