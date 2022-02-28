<p style="text-align: justify"><head>
<style>
#headertext  {
        bcolor: #fff;
	text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #ff2d95, 0 0 30px #ff2d95, 0 0 40px #ff2d95, 0 0 50px #ff2d95, 0 0 75px #ff2d95;
	letter-spacing: 5px;
	font: 30px 'MisoRegular';
}

</style>
<link rel="stylesheet" type="text/css" href="css/datatable.css">
<script src="js/jquery.js"></script>
<script src="js/datatables.js"></script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example').DataTable();

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );


</script>
<script type="text/javascript">

function confirm_edit() {
  return confirm('Would you Like to Edit ?');
}
</script>
<script type="text/javascript">
function confirm_delete() {
  return confirm('Would you Like to Delete ?');
}
</script>

<?php
include 'reportmenu.php';
include '../config/config.php';
include '../session.php';
$result = mysql_query("SELECT e.txno,e.empname,(select departmentname from m_department as d where e.departmentno=d.departmentno) as departmentname,e.empstatus,e.empmobileno,e.empdob,e.empbasicsalary from employeedetails as e ");
if (!$result) {
  die("Query to show fields from table failed");
}
$fields_num = mysql_num_fields($result);
?>
<br><br><br><br>
<center><h3 id="headertext">VIEW EMPLOYEE</h3></center>
<div id="divToPrint" >
<table id="example" class="display" cellspacing="0" width="100%">
   <thead>
    <tr align="left">
       <th>NO</th>
       <th>NAME</th>
       <th>DEPARTMENT</th>
       <th>MOBILE NO</th>
       <th>D-O-B</th>
       <th>BASIC SALARY</th>
       <th>STATUS</th>
       <th width="5%">EDIT</th>
       <th width="5%">DELETE</th>

   </tr>
  </thead>

<tbody>
<?php
echo "</tr>\n";
while ($row = mysql_fetch_array($result)) {
  echo "<tr>";
    echo '<td >' .  $row['txno'] . '</td>';
    echo '<td >' .  $row['empname'] . '</td>';
    echo '<td >' .  $row['departmentname'] . '</td>';
    echo '<td >' .  $row['empmobileno'] . '</td>';
    echo '<td >' .  $row['empdob'] . '</td>';
    echo '<td >' .  $row['empbasicsalary'] . '</td>';
    echo '<td >' .  $row['empstatus'] . '</td>';
?>
<td><a href="hm002employee.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="hm002employee.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?php
  echo '</tr>'; 
}
mysql_free_result($result);
?>
</p>
</div>
  </tbody>
  <tfoot>
  <tr  align="left">
      <th>NO</th>
      <th>NAME</th>
      <th>DEPARTMENT</th>
      <th>MOBILE NO</th>
      <th>D-O-B</th>
      <th>BASIC SALARY</th>
       <th>STATUS</th>
       <th>EDIT</th>
       <th>DELETE</th>
 </tr>
 </tfoot>
</table>