<?php
session_start ();
include_once 'config.php';

if (isset ( $_SESSION ['user'] ) != "") {
	header ( "Location: homepage_billing.php" );
}

if (isset ( $_POST ['btn-login'] )) {
	$xUserName = mysql_real_escape_string ( $_POST ['f_username'] );
	$xPassword = mysql_real_escape_string ( $_POST ['f_password'] );
	//$xRole = mysql_real_escape_string ( $_POST ['f_role'] );
	$xUserName = trim ( $xUserName );
	$xPassword = trim ( $xPassword );
	$xQry = "select * from m_login where username='$xUserName' and password='$xPassword'";
	$res = mysql_query ( $xQry );
	$row = mysql_fetch_array ( $res );
	//echo md5($xPassword);
	$count = mysql_num_rows ( $res ); // if uname/pass correct it returns must be 1 row
	
	if ($count>0 ) {
		$_SESSION ['user'] = $row ['username'];
		//$_SESSION ['role'] = $row ['role'];
		if ($_SESSION ['role'] == 'BILLING') {
			header ( "Location: homepage_billing.php" );
		} else {
			header ( "Location: homepage_billing.php" );
		}
	}else {
		
echo "Wrong Username Or Password";

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include 'title.php'?>
<link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
</head>
<body>
	<center>
		<div id="login-form">
			<form method="post">
			<h2>LOGIN </h2>
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" name="f_username" value="user"
							 /></td>
					</tr>
					<tr>
						<td><input type="password" name="f_password" value="user"
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