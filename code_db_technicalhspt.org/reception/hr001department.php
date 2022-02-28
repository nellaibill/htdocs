<?php
include('globalfile.php');
include('menu.php');
?>
<html>
<title> V-DEPARTMENTS</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<form action="hr001department.php" method="post" name="hr001department">

<center><h3 id="headertext">VIEW DEPARTMENTS</h3></center>
</form>
<body>
 
<div id="divToPrint" >
  <div class="container">
<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
           <th width="15%">DEPARTMENT NO</th>
           <th width="15%">DEPARTMENT NAME</th>
           <th colspan="2" width="5%">ACTIONS</td>
          </tr>
      </thead>
      <tbody>

<?php
$xQry="SELECT *  from department;"; 
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['departmentno']  . '</td>';
    echo '<td>' . $row['departmentname']  . '</td>';
?>
<td><a href="hm001department.php<?php echo '?departmentno='.$row['departmentno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="hm001department.php<?php echo '?departmentno='.$row['departmentno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
echo '</tr>'; 
}

?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</body></html>	