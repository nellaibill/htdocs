<?php 

if(isset($_POST['submit'])){ 
    $dbHost     = "localhost";  //Location Of Database usually its localhost 
    $dbUser     = "lakshmih_admin";   //Database User Name 
    $dbPass     = "admin";   //Database Password 
    $dbDatabase = "lakshmih_daybook"; //Database Name 
    //Connect to the databasse 
    $db         = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass); 

    $sql = $db->prepare("SELECT * FROM users_interdepartment 
        WHERE username = ? AND 
        password = ? 
        LIMIT 1"); 

    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    $pas = hash('sha256', $_POST['password']); 
     
    $sql->bindValue(1, $_POST["username"]); 
    $sql->bindValue(2, $pas); 

    $sql->execute(); 

    // Row count is different for different databases 
    // Mysql currently returns the number of rows found 
    // this could change in the future. 
    if($sql->rowCount() == 1){ 
        $row                  = $sql->fetch($sql); 
        session_start(); 
        $_SESSION['username'] = $row['username']; 
        $_SESSION['fname']    = $row['username']; 
        $_SESSION['lname']    = $row['password']; 
        $_SESSION['logged']   = TRUE; 
        header("Location: users_page.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: login_page.php"); 
        exit; 
    } 
}else{ //If the form button wasn't submitted go to the index page, or login page 
    header("Location: index.php"); 
    exit; 
}