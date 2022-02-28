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
                <form method="post" action ="login_validation.php">
                    <h2>LOGIN </h2>
                    <table align="center" width="30%" border="0">
                        <tr>
                            <td><input type="text" name="f_username"  value="admin"
                                       /></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="f_password"  value=""
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