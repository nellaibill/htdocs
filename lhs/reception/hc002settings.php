<?php 
include 'globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
  $xEbno= $_POST ['f_ebno'];
  $xDoctorNo= $_POST ['f_doctorno'];
  $xEcgXrayType= $_POST ['f_ecgxraytype'];
  $xExpGrpNo= $_POST ['f_groupno'];
  $acno= $_POST ['acno'];
  $actype= $_POST ['actype'];
  $DepartmentNo= $_POST ['departmentno'];
  $EmployeeNo= $_POST ['empno'];
  $xStatus= $_POST ['f_status'];
  $xEcgXrayType= $_POST ['f_ecgxraytype'];
  $xEcgFlimType= $_POST ['f_ecgflimtype'];
  $xEcgSection= $_POST ['f_ecgsection'];
  $xNoonType= $_POST ['f_opnoontype'];
  $xCaseType= $_POST ['f_opcasetype'];
  $xCaseType1= $_POST ['f_opcasetype1'];
  $xOpStatus= $_POST ['f_opstatus'];
  $xQry = "update config set ebno=$xEbno,doctorno=$xDoctorNo,ecgxraytype='$xEcgXrayType',ecgflimtype='$xEcgFlimType',ecgsection='$xEcgSection',expgroupno=$xExpGrpNo,acno=$acno,actype='$actype',departmentno=$DepartmentNo,employeeno=$EmployeeNo,status=$xStatus,opnoontype='$xNoonType',opcasetype='$xCaseType',opcasetype1='$xCaseType1',opstatus='$xOpStatus'";
mysql_query ( $xQry );
echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
}
?>
<html>
<script type="text/javascript">
function onchangeajax(employeeid)
 {
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
 
 var url="manager/ajax_filteremployee.php"
 url=url+"?employeeid="+employeeid
 url=url+"&sid="+Math.random()
document.getElementById("employeediv").innerHTML='Please wait..<img border="0" src="../images/load.png">'
 if(xmlHttp.onreadystatechange=stateChanged)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }
 
 function stateChanged()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("employeediv").innerHTML=xmlHttp.responseText
 return true;
 }
 }
 
 function GetXmlHttpObject()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }
</script>

<body>
<title>SETTINGS</title>
<form action="hc002settings.php" method="post">
<div class="panel panel-primary">
<div class="panel-heading text-center">GENERAL</div>
<div class="panel-body">
<div class="form-group">
 <div class="col-xs-3">
<label>DOCTOR</label>
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
<label>EB</label>
     <select class="form-control"  value="" name="f_ebno" id="ebno" >
         <?php
          $result = mysql_query("SELECT *  FROM m_eb");
           echo "<option value='0'>All</option>";
           while($row = mysql_fetch_array($result))
           {
           ?>
             <option value = "<?php echo $row['txno']; ?>" 
             <?php
             if ($row['ebname']== $GLOBALS ['xEbName'])
                {
                 echo 'selected="selected"';
                } 
             ?> >
            <?php echo $row['ebname']; ?> 
            </option>
             <?
              }
              echo "</select>";
             ?>
  </div>
 <div class="col-xs-4">
<label>EXPENSES GROUP</label>
      <select class="form-control"  value="" name="f_groupno" id="groupno" >
         <?php
          $result = mysql_query("SELECT *  FROM expenses_group");
           echo "<option value='0'>All</option>";
           while($row = mysql_fetch_array($result))
           {
           ?>
             <option value = "<?php echo $row['exgrpno']; ?>" 
             <?php
             if ($row['exgrpno']== $GLOBALS ['xExGrpNo'])
                {
                 echo 'selected="selected"';
                } 
             ?> >
            <?php echo $row['exgrpname']; ?> 
            </option>
             <?
              }
              echo "</select>";
             ?>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->

<div class="panel panel-success">
<div class="panel-heading text-center">OUT-PATIENT</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>NOON TYPE</label>
<select class="form-control" name="f_opnoontype">
<option value="MORNING"                                              
<?php if($GLOBALS ['xNoonType']=="MORNING") echo 'selected="selected"'; ?>>MORNING</option>
<option value="EVENING" <?php if( $GLOBALS ['xNoonType']=="EVENING") echo 'selected="selected"'; ?>>EVENING</option> 
<option value="ALL" <?php if( $GLOBALS ['xNoonType']=="ALL") echo 'selected="selected"'; ?>>ALL</option> 
</select>
</div>
<div class="col-xs-3">
<label>CASE TYPE</label>
<select  class="form-control" name="f_opcasetype">
<option value="ALL"                                              
<?php if($GLOBALS ['xCaseType']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="GENERAL" <?php if( $GLOBALS ['xCaseType']=="GENERAL") echo 'selected="selected"'; ?>>GENERAL</option> 
<option value="EMERGENCY" <?php if( $GLOBALS ['xCaseType']=="EMERGENCY") echo 'selected="selected"'; ?>>EMERGENCY</option> 
<option value="OTHERS" <?php if( $GLOBALS ['xCaseType']=="OTHERS") echo 'selected="selected"'; ?>>OTHERS</option> 
</select>
</div>
<div class="col-xs-3">
<label>CASE TYPE1</label>
<select  class="form-control" name="f_opcasetype1">
<option value="ALL"  <?php if($GLOBALS ['xCaseType1']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="NONE" <?php if( $GLOBALS ['xCaseType1']=="NONE") echo 'selected="selected"'; ?>>NONE</option> 
<option value="INJECTION" <?php if( $GLOBALS ['xCaseType1']=="INJECTION") echo 'selected="selected"'; ?>>INJECTION</option> 
<option value="URINETEST" <?php if( $GLOBALS ['xCaseType1']=="URINETEST") echo 'selected="selected"'; ?>>URINETEST</option> 
</select>
</div>
<div class="col-xs-3">
<label>STATUS</label>
<select  class="form-control" name="f_opstatus">
<option value="ALL"  <?php if($GLOBALS ['xOpStatus']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="PROCESSING"  <?php if($GLOBALS ['xOpStatus']=="PROCESSING") echo 'selected="selected"'; ?>>PROCESSING</option>
<option value="COMPLETED"  <?php if($GLOBALS ['xOpStatus']=="COMPLETED") echo 'selected="selected"'; ?>>COMPLETED</option>
<option value="CANCELLED"  <?php if($GLOBALS ['xOpStatus']=="CANCELLED") echo 'selected="selected"'; ?>>CANCELLED</option>
</select>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->

<div class="panel panel-primary">
<div class="panel-heading text-center">ECG-XRAY</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>TYPE</label>
<select class="form-control" name="f_ecgxraytype" >
<option value="0" <?php if($GLOBALS ['xEcgXrayType']=="0") echo 'selected="selected"'; ?>>ALL</option>
<option value="1" <?php if($GLOBALS ['xEcgXrayType']=="1") echo 'selected="selected"'; ?>>ECG</option>
<option value="2" <?php if( $GLOBALS ['xEcgXrayType']=="2") echo 'selected="selected"'; ?>>XRAY</option>
</select>
</div>
<div class="col-xs-2">
<label>FLIM TYPE</label>
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

<div class="panel panel-success">
<div class="panel-heading text-center">BANK</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-4">
<label>ACCOUNT NAME</label>
 <select class="form-control" id="" value="" name="acno">
						<?php
                                            $result = mysql_query("SELECT *  FROM bankdetails");
                                            echo "<option value='Select Your Department'>Select Your A/c No</option>";
                                            while($row = mysql_fetch_array($result))
                                              {
                                                ?>
                                              <option value = "<?php echo $row['acno']; ?>" 
                                              <?php
                                              if ($row['acno']== $GLOBALS ['xAcNo']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['acname']; ?> 
                                          </option>
                                           <?php

                                            }
                                     echo "</select>";
                                   ?>
                                 
                                        </div>

					<div class="col-xs-3">
<label>ACCOUNT TYPE</label>
<select class="form-control" id="actype" value="" name="actype" >
<option value="ALL" <?php if($GLOBALS ['xAcType']=="ALL") echo 'selected="selected"'; ?>>ALL</option>
<option value="DEBIT" <?php if($GLOBALS ['xAcType']=="DEBIT") echo 'selected="selected"'; ?>>DEBIT</option>
<option value="CREDIT" <?php if( $GLOBALS ['xAcType']=="CREDIT") echo 'selected="selected"'; ?>>CREDIT</option>
</select>
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->


<div class="panel panel-primary">
<div class="panel-heading text-center">HRM</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>DEPARTMENT</label>
<select class="form-control" id="" value="" autofocus="autofocus" onfocus="return onchangeajax(this.value);" onchange="return onchangeajax(this.value);" name="departmentno">
<?php
                                            $result = mysql_query("SELECT *  FROM m_department");
                                            echo "<option value='Select Your Department'>Select Your Department</option>";
                                            while($row = mysql_fetch_array($result))
                                              {
                                                ?>
                                              <option value = "<?php echo $row['departmentno']; ?>" 
                                              <?php
                                              if ($row['departmentname']== $GLOBALS ['xEmpDepartment']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['departmentname']; ?> 
                                          </option>
                                           <?php

                                            }
                                     echo "</select>";
?>
</div>
<label>EMPLOYEE</label>
 <div id="employeediv"><input type="text" name="empno"  readonly/></div></BR></BR>
<div class="col-xs-3">
<label>ATTENDENCE STATUS</label>
		<select class="form-control" id="status" value="" name="f_status">
                 <option value="10" <?php if($GLOBALS ['xStatus']=="10") echo 'selected="selected"'; ?>>ALL</option>
                 <option value="0" <?php if($GLOBALS ['xStatus']=="0") echo 'selected="selected"'; ?>>PRESENT</option>
                 <option value="0.5" <?php if( $GLOBALS ['xStatus']=="0.5") echo 'selected="selected"'; ?>>HALFDAY</option>
                 <option value="1" <?php if($GLOBALS ['xStatus']=="1") echo 'selected="selected"'; ?>>LEAVE</option>
                 <option value="2" <?php if( $GLOBALS ['xStatus']=="2") echo 'selected="selected"'; ?>>ABSENT</option>
		</select>  
</div>
</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
<div class="panel-footer clearfix">
        <div class="pull-right">
<input type="submit"  name="save"   class="btn btn-primary" value="SAVE" >
<input type="cancel"  name="cancel" class="btn btn-primary" value="CLOSE"  onclick="window.close()";>        </div>
</div>

  </br> </br>
</body>
</html>