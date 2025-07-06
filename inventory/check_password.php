<?php
include_once('config.php');
if(isset($_POST['username']) && !empty($_POST['username'])){
      $username=strtolower(mysql_real_escape_string($_POST['username']));
      $query="select * from m_login where LOWER(password)='$username'";
      $res=mysql_query($query);
      $count=mysql_num_rows($res);
      $HTML='';
      if($count > 0){
        $HTML='Correct';
      }else{
        $HTML='';
      }
      echo $HTML;
}
?>