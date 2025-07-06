<?php 
include '../globalfunctions.php';
if (isset ( $_POST ['save'] )) 
{
  $DepartmentNo= $_POST ['departmentno'];
  $EmployeeNo= $_POST ['empno'];
  $xStatus= $_POST ['f_status'];
  $xQry = "update config set departmentno=$DepartmentNo,employeeno=$EmployeeNo,status=$xStatus";
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
 
 var url="ajax_filteremployee.php"
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
<form action="hrm_hc001settings.php" method="post">
<div class="panel panel-primary">
<div class="panel-heading text-center">HRM</div>
<div class="panel-body">
<div class="form-group">
<div class="col-xs-3">
<label>DEPARTMENT</label>
<select class="form-control" id="" value="" autofocus="autofocus" onfocus="return onchangeajax(this.value);" onchange="return onchangeajax(this.value);" name="departmentno">
<?php
                                            $result = mysql_query("SELECT *  FROM m_department order by departmentname");
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