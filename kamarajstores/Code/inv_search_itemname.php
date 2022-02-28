<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysql_query("select itemno,itemname from m_item where itemname like '%$q%' order by itemname LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
?>
<div> 
<select class="form-control" name="f_itemno">
<option value = "<?php echo $row['itemno']; ?>"><?php echo $row['itemname']; ?></option>
</select>
</div>
<?php
}
}
?>