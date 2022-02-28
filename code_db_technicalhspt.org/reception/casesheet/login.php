<?php
include('config.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) 
{
  if (empty($_POST['username']) || empty($_POST['password']))
   {
   $error = "Username or Password is invalid";
  }
else
 {
  $username=$_POST['username'];
  $password=$_POST['password'];
  $xLoginDepartment=$_POST['f_logindepartment'];
  $xProjectNo=$_POST['f_projectno'];
  $username = stripslashes($username);
  $password = stripslashes($password);
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);
  
  $xQry= mysql_query("select * from m_login where username='$username' and password='$password' " , $con);
  $rows = mysql_num_rows($xQry);
  if ($rows == 1) 
  {
    $_SESSION['login_user']=strtolower($username);
    $_SESSION['login_department']=strtolower($xLoginDepartment);
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
    header("location: index.php");
    mysql_close($con); // Closing Connection
   }
   else
    {
    echo '<script type="text/javascript">alert("Invalid -Please Try Again")</script>';
    header("location: login.php");
    } 
 
  }
}
?>
<html>
<title>
Login
</title>
<head>
<!--    <link rel="stylesheet" href="reception/css/loginstyle.css"> !-->
<style>

    body {
        background-color: #444;
        background: url(images/ecgxray.jpg);
        background-repeat:no-repeat;
        background-size: 100% 100%;
         }
    .form-signin input[type="text"] {
        margin-bottom: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
.form-signin input[type="submit"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .vertical-offset-100 {
        padding-top: 100px;
    }
    .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
    }
    .panel {
    margin-bottom: 20px;
    background-color: rgba(255, 255, 255, 0.75);
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

</style>
</head>


        <body>
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                <form accept-charset="UTF-8" role="form" class="form-signin"action="login.php"  method="post" >
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Username" id="username" type="text" name="username">
                                        <input class="form-control" placeholder="Password" id="password" type="password" name="password">
										<!--
                                        <select class="form-control" name="f_logindepartment">
                                           <option value="1">ECG-XRAY</option>
                                        </select>
										!-->
                                        <button class="form-control" type="submit" name="submit" >
                                           <span class="glyphicon glyphicon-log-in"></span> Login</button>
                                                                                <span><?php echo $error; ?></span>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </body>
            </div>
</html>