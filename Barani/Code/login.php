
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
    if($xLoginDepartment=='1')
      {
        header("location: homepage.php");
      }

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
<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 10%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>

<h2>BARANI DATA SOLUTIONS</h2>

<form action="login.php"  method="post">
  <div class="imgcontainer">

  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="password" name="password" required>
           <select  name="f_logindepartment">
                                           <option value="1">BILLING</option>
                   
                                        </select>
										
    <input  type="submit" name="submit" value="Login" >
  </div>


</form>

</body>
</html>
