<?php
include_once 'config.php';
if (isset($_POST ['btn-login'])) {
$UserName=$_POST['f_username'];
$Password=$_POST['f_password'];
$result=mysql_query("select * from m_login where username='$UserName' and password='$Password'")or die (mysql_error());//query sang database 	
$count=mysql_num_rows($result);
$row=mysql_fetch_array($result);
		if ($count > 0){
		session_start();
		$_SESSION['member_id']=$row['username'];
                $_SESSION['user_role']=$row['role'];
		header('location:homepage_billing.php');
		}else{
                    echo "Wrong Password";
		//header('location:index.php');
		}
}
?>

