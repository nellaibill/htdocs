<?php 
      include("config.php");
      if(isset($_POST['submit']))
      {
      $username=$_POST['txtusername'];
      $passwordvalue=$_POST['cur_pwd'];
      $password=$_POST['password'];
      $confirm_pwd=$_POST['confirm_pwd'];   
      $select=mysql_query("select * from login where username='$username'"); 
      $fetch=mysql_fetch_array($select);
      $data_pwd=$fetch['password'];
      $data_username=$fetch['username'];

      if($password==$confirm_pwd && $data_pwd==$passwordvalue)
        {
      $insert=mysql_query("update login set password='$confirm_pwd' where username='$data_username'"); 
      $login1="password changed";
        }
      else
        {
      $login1="password not match plz try again";
        }
echo $login1;

      }
      ?>