<?php

include('loginvalidation.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">

  <title></title>

    <link rel="stylesheet" href="css/loginstyle.css">

</head>

<body>

  <div class="wrapper">
	<div class="container">
		<h1>DAYBOOK</h1>

		<form class="form" action="" method="post">
			<input type="text" placeholder="Username" name="username">
			<input type="password" placeholder="Password" name="password">
			<button type="submit" name="submit" id="login-button">Login</button></br><span><?php echo $error; ?></span>
		<a href="changepassword.html">CHANGE PASSWORD</a>
		</form>
	</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>


</body>

</html>