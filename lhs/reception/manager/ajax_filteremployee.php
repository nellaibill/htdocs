<?php
include('../globalfunctions.php');
$xEmployeeId=$_REQUEST['employeeid'];
$xQry="SELECT txno,empname from employeedetails WHERE departmentno= $xEmployeeId and empstatus='ACTIVE'";
$stmt = mysql_query($xQry);
?>
<div class="col-xs-3">
<select class="form-control" name="empno">
<option value="0">All</option>
<?php
while($row = mysql_fetch_array($stmt)) {
echo $row['txno'];
?>

      <option value = "<?php echo $row['txno']; ?>" 
                                              <?php
                                              if ($row['empname']== $GLOBALS['xEmpName']){
                                               echo 'selected="selected"';
                                               } 
                                            ?> >
                                           <?php echo $row['empname']; ?> 
                                          </option>
<?
}
echo '</select>';
echo '</div>';
?>