<?php
   include 'reception/config.php';
   date_default_timezone_set('Asia/Calcutta'); 
   session_start();// Starting Session
   $user_check=$_SESSION['login_user'];
   $xQry="select username from m_login where username='$user_check'";
   $ses_sql=mysql_query($xQry, $con);
   $row = mysql_fetch_assoc($ses_sql);
   $login_session =$row['username'];
     if(!isset($login_session))
      {
        mysql_close($con); // Closing Connection
        header('Location: ../login.php'); // Redirecting To Home Page
      }

?>