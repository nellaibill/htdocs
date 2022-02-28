
<?php 
      include("globalfile.php");
      if(isset($_POST['submit']))
      {
      $username=$_POST['txtusername'];
      $passwordvalue=$_POST['cur_pwd'];
      $password=$_POST['password'];
      $confirm_pwd=$_POST['confirm_pwd'];   
      $select=mysql_query("select * from receptionlogin where username='$username'"); 
      $fetch=mysql_fetch_array($select);
      $data_pwd=$fetch['password'];
      $data_username=$fetch['username'];

      if($password==$confirm_pwd && $data_pwd==$passwordvalue)
        {
      $xQry="update receptionlogin set password='$confirm_pwd' where username='$data_username'";
      $insert=mysql_query($xQry); 
      $xMsg="password changed";
        }
      else
        {
      $xMsg="password not match plz try again";
        }
ShowAlert($xMsg);

      }
      ?>
<form method="post" name="change" action="changepassword.php">
<?php echo $login1; ?></br></br>
<center> <h1> CHANGE PASSWORD SCREEN</h1>
</br></br></br>
<p>USERNAME :<br />
<input type="text" name="txtusername"  id="username" value="<?php echo $GLOBALS ['xUsername']; ?>" class="ser" /></p>
<p>old password<br />
<input type="password" name="cur_pwd"  id="cur_pwd"  class="ser" /></p>
<p>New password<br />
<input type="password" name="password"  id="password" class="ser" />
</p>
<p>Confirm password<br />
<input type="password" name="confirm_pwd" id="confirm_pwd" class="ser" />
</p>
<p align="center">
<input name="submit" type="submit" value="Save Password" class="submit" />

</p>

</form>