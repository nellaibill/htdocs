<?php
include('config.php');
//include('menu.html');
include('menu.php');
date_default_timezone_set('Asia/Calcutta'); 
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from login where username='$user_check'", $con);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysql_close($con); // Closing Connection
header('Location: login.php'); // Redirecting To Home Page
}
?>