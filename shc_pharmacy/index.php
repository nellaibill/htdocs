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
		header('location:homepage_billing.php');
		}else{
                    echo "Wrong Password";
		//header('location:index.php');
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include 'title.php' ?>
        <link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
    </head>
    <body>
        <center>
            <div id="login-form">
                <form method="post">
                    <h2>LOGIN </h2>
                    <table align="center" width="30%" border="0">
                        <tr>
                            <td><input type="text" name="f_username"  value="user"
                                       /></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="f_password"  value="user"
                                       /></td>
                        </tr>

                        <tr>
                            <td><button type="submit" name="btn-login">Sign In</button></td>
                        </tr>


                    </table>
                </form>
            </div>
        </center>
    </body>
</html>