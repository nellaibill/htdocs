<?php
include 'globalfile.php';
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
<title>Report -Ecg</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[ECG-XRAY]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
          <a href="ecg_hc001ecgxray.php" class="btn btn-default">CONFIG</a>
      </div>
</div>
<div class="panel-body">
<div class="form-group">

 <div class="col-xs-3">
<label>DOCTOR NAME</label>
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
   
  </div>

<div class="col-xs-3">
<label>ECG OR X-RAY</label>
<select class="form-control" name="f_ecgxraytype" >
<option value="0" <?php if($GLOBALS ['xEcgXrayType']=="0") echo 'selected="selected"'; ?>>ALL</option>
<option value="1" <?php if($GLOBALS ['xEcgXrayType']=="1") echo 'selected="selected"'; ?>>ECG</option>
<option value="2" <?php if( $GLOBALS ['xEcgXrayType']=="2") echo 'selected="selected"'; ?>>XRAY</option>
</select>
</div>
 <div class="col-xs-3">
<label>TEST TYPE[XRAY]</label>
 <select class="form-control"  value="" name="f_testtypeno"  >
<option value="0">ALL</option>
         <?php
          $result = mysql_query("SELECT *  FROM m_testtype where testtypeno!=1");
           while($row = mysql_fetch_array($result))
           {
           ?>
             <option value = "<?php echo $row['testtypeno']; ?>"
               <?php
             if ($row['testtypeno']== $GLOBALS ['xTestTypeNo'])
                {
                 echo 'selected="selected"';
                } 
             ?> >
            <?php echo $row['testtypename']; ?> 
            </option>
             <?
              }
              echo "</select>";
             ?>
   
  </div>

<div class="col-xs-3">
<label>ROLL</label>
	<select class="form-control"  value="" name="f_ecgflimtype">
          <option value="0" <?php if($GLOBALS ['xEcgFlimType']=="0") echo 'selected="selected"'; ?>>ALL</option>
	  <option value="NONE" <?php if($GLOBALS ['xEcgFlimType']=="NONE") echo 'selected="selected"'; ?>>NONE</option>
	  <option value="12*10" <?php if($GLOBALS ['xEcgFlimType']=="12*10") echo 'selected="selected"'; ?>>12*10</option>
	  <option value="15*12" <?php if( $GLOBALS ['xEcgFlimType']=="15*12") echo 'selected="selected"'; ?>>15*12</option>
	</select>
</div>
<div class="col-xs-3">
<label>SECTION</label>
	<select class="form-control"  value="" name="f_ecgsection">
          <option value="0" <?php if($GLOBALS ['xEcgSection']=="0") echo 'selected="selected"'; ?>>ALL</option>
	<option value="OP"   <?php if($GLOBALS ['xEcgSection']=="OP") echo 'selected="selected"'; ?>>OP</option>
	<option value="WARD"  <?php if( $GLOBALS ['xEcgSection']=="WARD") echo 'selected="selected"'; ?>>WARD</option>
	<option value="LABOURWARD"  <?php if( $GLOBALS ['xEcgSection']=="LABOURWARD") echo 'selected="selected"'; ?>>LABOURWARD</option>
	<option value="NEWBORN"  <?php if( $GLOBALS ['xEcgSection']=="NEWBORN") echo 'selected="selected"'; ?>>NEWBORN</option>
	<option value="POW"  <?php if( $GLOBALS ['xEcgSection']=="POW") echo 'selected="selected"'; ?>>POW</option>
	<option value="IMCU"  <?php if( $GLOBALS ['xEcgSection']=="IMCU") echo 'selected="selected"'; ?>>IMCU</option>
	<option value="OT"  <?php if( $GLOBALS ['xEcgSection']=="OT") echo 'selected="selected"'; ?>>OT</option>
	</select>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="panel panel-info">
  <!-- Default panel contents -->
<div class="panel-heading text-center"><?php echo "FROM DATE[".date(' d/M/y', strtotime($xFromDate))."]TO DATE[".date(' d/M/y', strtotime($xToDate))."] DOCTORNAME[".$GLOBALS ['xDoctorName'] ."]" ?></div>

<table class="table">
      <thead>
        <tr>
  <th width="5%"> SL.NO</th>
  <th width="25%"> PATIENT NAME</th>
 <th width="25%"> TEST NAME</th>
 <th width="10%"> AMOUNT</th>
          <?php if($GLOBALS ['xViewTxNo']  == 0){ ?>            <th> TXNO</th> <? } ?>
          <?php if($GLOBALS ['xViewDate']  == 0){ ?>            <th width="10%"> DATE</th> <? } ?>
          <?php if($GLOBALS ['xViewSection']  == 0){ ?>         <th width="10%"> SECTION</th> <? } ?>
          <?php if($GLOBALS ['xViewAge']  == 0){ ?>             <th> AGE</th> <? } ?>
          <?php if($GLOBALS ['xViewEcgxRayDoctorNo']  == 0){ ?> <th> DOCTORNAME</th> <? } ?>
          <?php if($GLOBALS ['xViewFilmType']  == 0){ ?>        <th> FILMTYPE</th> <? } ?>
<?php 
if($login_session=="admin")
{
?>
          <?php if($GLOBALS ['xViewCreatedAsOn']  == 0){ ?>     <th> CREATED</th> <? } ?>
          <?php if($GLOBALS ['xViewUpdatedAsOn']  == 0){ ?>     <th> UPDATED</th> <? } ?>
<?
}
?>

<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody class="searchable">

<?php
$xQry='';
$xTotalAmount=0;
$xSlNo=1;
$xQryFilter='';
  if (isSet($_POST['save'])) 
    {
      $xDoctorNo= $_POST ['f_doctorno'];
      $xTestTypeNo= $_POST ['f_testtypeno'];
      $xEcgXrayType= $_POST ['f_ecgxraytype'];
      $xEcgFlimType= $_POST ['f_ecgflimtype'];
      $xEcgSection= $_POST ['f_ecgsection'];
      $xQry = "update config 
                  set doctorno=$xDoctorNo,ecgxraytype='$xEcgXrayType',ecgflimtype='$xEcgFlimType',ecgsection='$xEcgSection',testtypeno=$xTestTypeNo";
      mysql_query($xQry);
echo "<meta http-equiv='refresh' content='0'>";
      header('Location: ecg_hr001billing.php');
    }
else if ( isset( $_GET['xmode'] ))
{
$xDate=$GLOBALS ['xDate'];
$xEcgXrayType=$_GET['ecgtype'];
$xEcgFlimType=$_GET['ecgflimtype'];
$xEcgSection=$_GET['ecgsection'];
$xDoctorNo=$_GET['doctorno'];
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}
else
{
$xDate=$GLOBALS ['xDate'];
$xTestTypeNo=$GLOBALS ['xTestTypeNo'];
$xEcgXrayType=$GLOBALS ['xEcgXrayType'];
$xEcgFlimType=$GLOBALS ['xEcgFlimType'];
$xEcgSection=$GLOBALS ['xEcgSection'];
$xDoctorNo=$GLOBALS ['xDoctorNo'];
}
if($xEcgXrayType==1)
{
$xQryFilter= $xQryFilter. ' ' . "and testtypeno=1";
}
elseif($xEcgXrayType==2)
{
  if($xTestTypeNo!=0)
  {
   $xQryFilter= $xQryFilter. ' ' . "and testtypeno=$xTestTypeNo";
  }
else
  {
   $xQryFilter= $xQryFilter. ' ' . "and testtypeno!=1";
  }

}
if($xEcgFlimType=="0"){}
else
{
$xQryFilter= $xQryFilter. ' ' . "and flimtype='$xEcgFlimType'";
}
if($xEcgSection=="0"){}
else
{
$xQryFilter= $xQryFilter. ' ' . "and section='$xEcgSection'";
}
if($xDoctorNo=="0"){}
else
{
$xQryFilter= $xQryFilter. ' ' . "and doctorno=$xDoctorNo";
}
$xQry="SELECT *  from t_ecgxraybilling where date>='$xFromDate' and date<='$xToDate'"; 
$xQry.= $xQryFilter. ' ' . "order by  txno;";
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    finddoctorname($row['doctorno']);
    echo '<tr bgcolor="' . $GLOBALS['xColor'].  '">';
    echo '<td>' .  $xSlNo . '</td>';
    echo '<td style=font-weight:bold>' . $row['saluation'] .$row['patientname']  . '</td>';
    findtesttypename( $row['testtypeno'] );
    echo '<td>' .  $GLOBALS ['xTestTypeName']  . '</td>';
    echo '<td align=right>' . money_format("%!n", $row['testamount'])  . '</td>';

    if($GLOBALS ['xViewTxNo']  == 0){echo '<td>' . $row['txno']   . '</td>';    }
    if($GLOBALS ['xViewDate']  == 0){echo '<td>' .date(' d/M/y', strtotime($row['createdason']))  . '</td>';    }
    if($GLOBALS ['xViewSection']  == 0){echo '<td>' . $row['section']  . '</td>';    }
    if($GLOBALS ['xViewAge']  == 0){echo '<td>' . $row['age']  . '</td>';    }
    if($GLOBALS ['xViewEcgxRayDoctorNo']  == 0){echo '<td>' . $GLOBALS ['xDoctorName']   . '</td>';    }
    if($GLOBALS ['xViewFilmType']  == 0){echo '<td>' . $row['flimtype']  . '</td>';    }

if($login_session=="admin")
{
    if($GLOBALS ['xViewCreatedAsOn']  == 0){echo '<td>' . date('h:i A', strtotime($row['createdason']))   . '</td>';    }
    if($GLOBALS ['xViewUpdatedAsOn']  == 0){echo '<td>' . date('h:i A', strtotime($row['updatedason'])) . '</td>';    }
}
   
   $xTotalAmount+= $row['testamount'];
$xSlNo+=1;
?>
<td><a href="ecg_ht001billing.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?php
if($login_session=="admin")
{
?>

<td><a href="ecg_ht001billing.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
}
echo '</tr>'; 
} 
?>

<tr style='font-weight:bold;'>

<td></td>
<td COLSPAN="2"> GRAND TOTAL </td>
<?php  echo '<td align=right> Rs.' . money_format("%!n", $xTotalAmount) . '</td>'; ?>
<td></td>
<td></td>
<td></td>
</tr>	

	
</tbody>
    </table>	
</div><!-- /PANEL -->
</div><!-- / TO PRINT-->
</form>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->