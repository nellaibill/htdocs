<?php
require_once("config.php");
if(!empty($_POST["mobileno"])) {
$result = mysql_query("SELECT count(*) FROM phonebook WHERE mobileno=" . $_POST["mobileno"] . "");
$row = mysql_fetch_row($result);
$user_count = $row[0];
echo "<font color='red'>";
if($user_count>0) echo "<span class='status-not-available'> Mobile Number Already Owned by SomeOne</span>";
else echo "<span class='status-available'> Mobile Number Available.</span></font>";
}
?>