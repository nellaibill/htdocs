<?php
include 'config.php';
include 'globalfile.php';
setControlProperties();
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
$xEmpNo=$GLOBALS ['xEmployeeNo'];
if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
{
  $no= $_GET['txno'];
  if($_GET['xmode']=='edit')
   {
    $GLOBALS ['xMode']='F';
    DataFetch ( $_GET['txno']);
   }
   else
   {
      $xQry = "DELETE FROM t_finedetails WHERE txno= $no";
      mysql_query ( $xQry );
      header('Location: hrm_hr004fine.php'); 	
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
  $GLOBALS['xFineAmount'] = "";
  $GLOBALS['xFineDescription'] = "";
}

function GetMaxIdNo() {
  $result = mysql_query("SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM t_finedetails") or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $GLOBALS['xIdno'] = $row['txno'];
    $GLOBALS['xMaxId'] = $row['txno'];
  }
}

function DataFetch($xTxno) {
  $result = mysql_query("SELECT *  FROM t_finedetails where txno=$xTxno") or die(mysql_error());
  $count = mysql_num_rows($result);
  if ($count > 0) {
    while ($row = mysql_fetch_array($result)) {
      $GLOBALS['xIdno'] = $row['txno'];
      $GLOBALS['xDate'] = $row['date'];
      findempname($row['employeeno']);
      $GLOBALS ['xDepartmentNo']=$row['departmentno'];
      finddepartmentname($row['departmentno']);
      $GLOBALS['xFineAmount'] = $row['fineamount'];
      $GLOBALS['xFineDescription'] = $row['finedescription'];

    }
  }
}
function DataProcess($xMode) {
$xQry="";
$xMsg="";
  $IdNo = $_POST['txtTxNo'];
  $xDate = $_POST['date'];
  $xDepartmentNo = $_POST['departmentno'];
  $xEmpNo = $_POST['empno'];
  $xFineAmount = $_POST['fineamount'];
  $xFineDescription = $_POST['finedescription'];
  $CurrentDate = $GLOBALS['xCurrentDate'];
  if ($xMode == 'S') 
  {
       $xQry = "INSERT INTO t_finedetails VALUES ($IdNo, '$xDate',$xDepartmentNo,$xEmpNo,$xFineAmount,'$xFineDescription')";
  }
  elseif ($xMode == 'U') 
   {
       $xQry = "UPDATE t_finedetails SET  date='$xDate',departmentno=$xDepartmentNo,employeeno=$xEmpNo,
                fineamount=$xFineAmount,finedescription='$xFineDescription' WHERE txno=$IdNo";
   }
  elseif ($xMode == 'D') {
       $xQry = "DELETE FROM t_finedetails WHERE txno=$IdNo";
       $xMsg="Deleted";
   }
  $xErrorValue= mysql_query($xQry) or die(mysql_error());
    if (!$xErrorValue) {
      die('Could not enter data: ' . mysql_error());
    }
    GetMaxIdNo();

//To Check Inserted Succesfully
    echo '<script language="javascript">';
    echo 'alert("Inserted Succesfully")';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MARK-FINE</title>
<script type="text/javascript">
function validateForm() 
 {
 var xDepartmentNo= document.forms["fine"]["departmentno"].value;
 var xEmpNo= document.forms["fine"]["empno"].value;
 var xFineAmount= document.forms["fine"]["fineamount"].value;
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

 if (xFineAmount== null || xFineAmount== "") 
    {
        alert("Fine Amount must be filled out");
        document.fine.fineamount.focus();
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
        <h3 class="panel-title  text-center">MARK-FINE</h3>
</div>
<div class="panel-body">

<div class="form-group" style="display: none;">
<label for="lbltxno" class="control-label col-xs-2">SL.NO</label>
<div class="col-xs-1">
<input type="text" class="form-control" id="xtxtTxNo" style="text-align: right" name="txtTxNo" value="<?php echo $GLOBALS['xIdno'];?>">
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
<label for="lblAmount" class="control-label col-xs-3">DATE</label>
<div class="col-xs-2">
<input type="date" class="form-control" id="xdate" name="date"  value="<?php echo $GLOBALS['xDate'];?>" placeholder="">
</div>
<div class="col-xs-2">
<input type="text" class="form-control"  name="fineamount"  value="<?php echo $GLOBALS['xFineAmount'];?>" placeholder="AMOUNT">
</div>
<div class="col-xs-2">
<input type="text" class="form-control"  name="finedescription"  value="<?php echo $GLOBALS['xFineDescription'];?>" placeholder="DESCRIPTION">
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
	</div>
<!--             ----------------------- REPORT STARTS HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">TODAY'S FINE STATUS</h3></div>
<table class="table">
      <thead>
        <tr>
          <th>DATE</th>
          <th>EMPLOYEE NAME</th>
          <th>DEPARTMENT  NAME</th>
          <th>AMOUNT</th>
          <th>DESCRIPTION</th>
        </tr>
      </thead>
      <tbody>

<?php
$xQry="SELECT a.txno AS txno, date,finedescription,fineamount, e.empname as empname, d.departmentname AS departmentname FROM `t_finedetails` as a , employeedetails AS e ,m_department as d WHERE date >= '$xFromDate' AND date<= '$xToDate' AND e.txno =a.employeeno  and d.departmentno=a.departmentno order by txno";
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
    echo '<td>' . $row['fineamount']  . '</td>';
    echo '<td>' . $row['finedescription']  . '</td>';
?>
<td width="5%"><a href="hrm_ht004fine.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
<td width="5%"><a href="hrm_ht004fine.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
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