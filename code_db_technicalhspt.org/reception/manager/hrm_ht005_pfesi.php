<?php
include 'config.php';
include 'globalfile.php';
setControlProperties();
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xEmpNo=$GLOBALS ['xEmployeeNo'];

    
if ( isset( $_GET['sno'] ) && !empty( $_GET['sno'] ) )
{
  $no= $_GET['sno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['sno']);
   }
   else
   {
      $xQry = "DELETE FROM t_pfesi WHERE sno= $no";
      mysql_query ( $xQry );
      header('Location: hrm_ht005_pfesi.php'); 	
   }
}
else
 {
  GetMaxIdNo ();
 }
$GLOBALS ['xCurrentDate']=date('Y-m-d H:i:s');
if (isset ( $_POST ['save'] ))
{

	DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
	DataProcess ( "U" );
}

function setControlProperties() {
  $xIdno;
  $xDate;
  $xGroupName = "";
  $xComment = "";
  $xAmount = 0;
  $GLOBALS['xMode'] = "";
  $GLOBALS['xDate']=$GLOBALS['xCurrentDate'];
  $GLOBALS['xEmpName'] = "";
  $GLOBALS['xPf'] = "";
  $GLOBALS['xEsi'] = "";
}

function GetMaxIdNo() {
  $result = mysql_query("SELECT  CASE WHEN max(sno)IS NULL OR max(sno)= '' THEN '1' ELSE max(sno)+1 END AS sno FROM t_pfesi") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xIdno'] = $row['sno'];
    $GLOBALS['xMaxId'] = $row['sno'];
  }
}

function DataFetch($xsno) {
  $result = mysql_query("SELECT *  FROM t_pfesi where sno=$xsno") or die(mysql_error());
  $count = mysql_num_rows($result);
  if ($count > 0) {
    while ($row = mysql_fetch_array($result)) {
      $GLOBALS['xIdno'] = $row['sno'];
      $GLOBALS['xDate'] = $row['date'];
      findempname($row['empno']);
      $GLOBALS ['xDepartmentNo']=$row['departmentno'];
      finddepartmentname($row['departmentno']);
      $GLOBALS['xPf'] = $row['pf'];
      $GLOBALS['xEsi'] = $row['esi'];

    }
  }
}
function fn_FindEmployeeDetails($xNo) {
  $result = mysql_query("SELECT *  FROM employeedetails where txno=$xNo") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
     $GLOBALS['empbasicsalary'] = $row['empbasicsalary'];
   $GLOBALS['empbasic'] = $row['empbasic'];
    $GLOBALS['empda'] = $row['empda'];
    $GLOBALS['empallowance'] = $row['empallowance'];
    $GLOBALS['emphra'] = $row['emphra'];
    
    $GLOBALS['emptotal'] = $row['emptotal'];
    $GLOBALS['empepf'] = $row['empepf'];
    $GLOBALS['empesi'] = $row['empesi'];
    $GLOBALS['empnetpay'] = $row['empnetpay'];
    $GLOBALS['empincentive'] = $row['empincentive'];
    $GLOBALS['empfinededuction'] = $row['empfinededuction'];
         $GLOBALS['empstatus'] = $row['empstatus'];
         

  }
}
function DataProcess($xMode) {
$xQry="";
$xMsg="";
  $IdNo = $_POST['sno'];
  $xDate = $_POST['date'];
  $xDepartmentNo = $_POST['departmentno'];
  $xEmpNo = $_POST['empno'];
  $xPf = $_POST['pf'];
  $xEsi = $_POST['esi'];
  $CurrentDate = $GLOBALS['xCurrentDate'];
  fn_FindEmployeeDetails($xEmpNo);
      $xEmpBasicSalary = $GLOBALS['empbasicsalary'];
   $xEmpBasic = $GLOBALS['empbasic'];
    $xEmpDa = $GLOBALS['empda'];
    $xEmpAllowance = $GLOBALS['empallowance'];
    $xEmpHra = $GLOBALS['emphra'];
    
    $xEmpTotal= $GLOBALS['emptotal'];
    $xEmpEpf=$GLOBALS['empepf'];
    $xEmpEsi=$GLOBALS['empesi'];
    $xEmpNetPay=$GLOBALS['empnetpay'];
    $xEmpIncentive=$GLOBALS['empincentive'];
    $xEmpFineDeduction=$GLOBALS['empfinededuction'];
    $xEmpStatus=$GLOBALS['empstatus'] ;
    
  if ($xMode == 'S') 
  {
      
			$count = 0;
			$xQry1 = "select count(empno) as count from t_pfesi where date='$xDate' and empno=$xEmpNo";
			$result = mysql_query ( $xQry1 ) or die ( mysql_error () );
			while ( $row = mysql_fetch_array ( $result ) ) {
				$GLOBALS ['xCount'] = $row ['count'];
			}
			$count = $GLOBALS ['xCount'];
			if ($count == 0) {
       $xQry = "INSERT INTO t_pfesi VALUES ($IdNo,$xDepartmentNo,$xEmpNo, '$xDate','$xPf','$xEsi', $xEmpBasicSalary, $xEmpBasic,$xEmpDa, $xEmpAllowance, $xEmpHra,$xEmpTotal,$xEmpEpf,$xEmpEsi,$xEmpNetPay,$xEmpIncentive,$xEmpFineDeduction,'$xEmpStatus')";
  }
  else {
				echo '<script language="javascript">';
				echo 'alert("EMPLOYEE ALREADY MARKED")';
				echo '</script>';
			}
  }
  elseif ($xMode == 'U') 
   {
       $xQry = "UPDATE t_pfesi SET  date='$xDate',
       departmentno=$xDepartmentNo,empno=$xEmpNo, pf='$xPf',
       esi='$xEsi',empbasicsalary=$xEmpBasicSalary,empbasic=$xEmpBasic,empda=$xEmpDa, empallowance=$xEmpAllowance,emphra=$xEmpHra,
       emptotal=$xEmpTotal,empepf=$xEmpEpf,empesi=$xEmpEsi,empnetpay=$xEmpNetPay,empincentive=$xEmpIncentive,empfinededuction=$xEmpFineDeduction,empstatus='$xEmpStatus'
       WHERE sno=$IdNo";
   }
  elseif ($xMode == 'D') {
       $xQry = "DELETE FROM t_pfesi WHERE sno=$IdNo";
       $xMsg="Deleted";
   }
  // echo $xQry;
  $xErrorValue= mysql_query($xQry) or die(mysql_error());
    if (!$xErrorValue) {
      die('Could not enter data: ' . mysql_error());
    }
    GetMaxIdNo();

    echo '<script language="javascript">';
    echo 'alert("Recorded Succesfully")';
    echo '</script>';
		header ( 'Location: hrm_ht005_pfesi.php' );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PF-ESI</title>
<script type="text/javascript">
function validateForm() 
 {
 var xDepartmentNo= document.forms["fine"]["departmentno"].value;
 var xEmpNo= document.forms["fine"]["empno"].value;
 var xPf= document.forms["fine"]["pf"].value;
 if (xDepartmentNo==0) 
    {
        alert("DepartmentName must be filled out");
        document.fine.departmentno.focus();
        return false;
    }

 if (xEmpNo==0) 
    {
        alert("Employee Name must be filled out");
        document.fine.empno.focus();
        return false;
    }

 if (xPf== null || xPf== "") 
    {
        alert("Fine Amount must be filled out");
        document.fine.pf.focus();
        return false;
    }
   

}
</script>
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


</head>
<body>
<form class="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="fine">
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title  text-center">PF-ESI</h3>
</div>
<div class="panel-body">

<div class="form-group" style="display: none;">
<label for="lblsno" class="control-label col-xs-2">SL.NO</label>
<div class="col-xs-1">
<input type="text" class="form-control" id="xsno" style="text-align: right" name="sno" value="<?php echo $GLOBALS['xIdno'];?>">
</div>
</div>
<div class=""form-group"">
<label for="lblAmount" class="control-label col-xs-3">DEPARTMENT & EMPLOYEE</label>
<div class="col-xs-3">
             
<select class="form-control" name="departmentno"  autofocus="autofocus" onfocus="return onchangeajax(this.value);" onchange="return onchangeajax(this.value);">
  <?php $result = mysql_query("SELECT departmentno,departmentname FROM m_department ORDER BY departmentno");
       echo "<option value=''>CHOOSE DEPARTMENT HERE</option>";
       while($row = mysql_fetch_array($result))
                {
                ?>
               <option value = "<?php echo $row['departmentno']; ?>" 
               <?php   if ($row['departmentno']== $GLOBALS ['xDepartmentNo']){ echo 'selected="selected"';} ?> >
            <?php echo $row['departmentname']; ?> 
            </option>

             <?
              }
                echo "</select>";
             ?>
</div>
 <div id="employeediv"><input type="text" name="empno"  readonly/></div>
</div><br><br>
<div class=""form-group"">
<label for="lblAmount" class="control-label col-xs-3">DATE-PF-ESI</label>
<div class="col-xs-2">
<input type="date" class="form-control" id="xdate" name="date"  value="<?php echo $GLOBALS['xDate'];?>" placeholder="">
</div>
<div class="col-xs-3">
<select class="form-control"  name="pf">
<option value="Yes" <?php if($GLOBALS ['xPf']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
<option value="No" <?php if( $GLOBALS ['xPf']=="No") echo 'selected="selected"'; ?>>No</option>                       
</select>
</div>
<div class="col-xs-3">
<select class="form-control"  name="esi">
<option value="Yes" <?php if($GLOBALS ['xEsi']=="Yes") echo 'selected="selected"'; ?>>Yes</option>
<option value="No" <?php if( $GLOBALS ['xEsi']=="No") echo 'selected="selected"'; ?>>No</option>                       
</select>
</div>
</div><br> <br>

<br> 

<div class="panel-footer clearfix">
        <div class="pull-right">
          <? if ($GLOBALS ['xMode'] == "") {  ?> 
               <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
           <? } else{ ?>
               <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
           <? }  ?>
        </div>
</div>
			</fieldset>
		</form>
	</div></div>

				<table class="table table-hover" >
      <thead>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>PF</th>
          <th>ESI</th>
          	<th  width="5%">EDIT</th>
								<th  width="5%">DELETE</th>
        </tr>
      </thead>
            <tfoot>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>PF</th>
          <th>ESI</th>
          	<th  width="5%">EDIT</th>
								<th  width="5%">DELETE</th>
        </tr>
      </tfoot>
      <tbody>

<?php
$xToday = date ( 'Y-m-d' );
$xQry="SELECT a.sno AS sno, date,esi,pf, e.empname as empname, d.departmentname AS departmentname FROM `t_pfesi` as a , employeedetails AS e ,m_department as d WHERE  e.txno=a.empno and d.departmentno=a.departmentno 
	and date='$xToday'
order by a.sno
desc";
$result2=mysql_query($xQry);
//echo $xQry;
while ($row = mysql_fetch_array($result2)) {
echo '<tr>';
    echo '<td>' .date('d/M/y', strtotime( $row['date']))   . '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
    echo '<td>' . $row['pf']  . '</td>';
    echo '<td>' . $row['esi']  . '</td>';
?>
<td width="5%"><a href="hrm_ht005_pfesi.php<?php echo '?sno='.$row['sno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hrm_ht005_pfesi.php<?php echo '?sno='.$row['sno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<?
echo '</tr>'; 
}

?>	
</tbody>
 </table>	
  </div><!-- /container -->
</div>
</body>
</html>