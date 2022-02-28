<?php
include('globalfile.php');
$xFromDate= date('d/F/Y', strtotime($GLOBALS ['xFromDate']));   
$xToDate= date('d/F/Y ', strtotime($GLOBALS ['xToDate']));   
?>
<html>
<title> View-Employee</title>
<form>
<body>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
       <b> <h3 class="panel-title text-center">NOTE : CHEQUE[GREEN COLOR] VIEW EMPLOYEES[<?php echo $GLOBALS ['xEmpDepartment']?>]</h3></b>
</div>
<div class="panel-body">
<table class="table table-hover" border="1" >
      <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="20%">NAME</th>
           <th width="20%">DEPARTMENT</th>
           <th width="20%">MOBILENO</th>
           <th width="10%">D.O.B</th>
           <th width="15%">BASIC SALARY</th>
           <th width="5%">STATUS</th>
           <th colspan="2" width="10%">ACTIONS</td>
          </tr>
      </thead>
      <tfoot>
        <tr>
          <tr>
           <th width="5%">S.NO</th>
           <th width="20%">NAME</th>
           <th width="20%">DEPARTMENT</th>
           <th width="20%">MOBILENO</th>
           <th width="10%">D.O.B</th>
           <th width="15%">BASIC SALARY</th>
           <th width="5%">STATUS</th>
           <th colspan="2" width="10%">ACTIONS</td>
          </tr>
      </tfoot>
      <tbody>

<?php
$xQryFilter='';
$xDepartmentNo=$GLOBALS ['xDepartmentNo'];
if($xDepartmentNo!="0")
{
$xQryFilter= $xQryFilter. ' ' . "where departmentno='$xDepartmentNo'";
}

/*$xQry="SELECT *  from employeedetails where emppfno!='' "; */
$xQry="SELECT *  from employeedetails";
$xQry.= $xQryFilter. ' ' . "order by departmentno;";
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    $xNetPay=0;
    $xSlNo+=1;
 if($row['emppaymentmode']=='CHEQUE')
 {
    echo '<tr bgcolor=\"#CCCCCC\">';
 }
else
  {
    echo '<tr>';
  }

    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $row['empname']  . '</td>';
    finddepartmentname($row ['departmentno']);
    echo '<td>' . $GLOBALS ['xEmpDepartment']  . '</td>';
    echo '<td>' . $row['empmobileno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['empdob']))  . '</td>';
    echo '<td align=right>' .money_format("%!n", $row['empbasicsalary']) .  '</td>';
    echo '<td>' . $row['empstatus']  . '</td>';
?>
<td><a href="hrm_hm002employee.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<!--
<td><a href="hrm_hm002employee.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
!-->
<?
echo '</tr>'; 
}
?>

</tbody>
    </table>	
</div>
</div>
</div>
</body>
</form></html>	