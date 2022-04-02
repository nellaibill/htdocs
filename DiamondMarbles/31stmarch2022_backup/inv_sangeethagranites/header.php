<?php
session_start ();
include_once 'config.php';

$xCompanyName="";
if (! isset ( $_SESSION ['user'] )) {
	header ( "Location: index.php" );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
	<div id="container">
		<div id="header">
			<table cellspacing="0" width="100%" border="0" cellpadding="20px">
				<tr>
						<td style="width: 56%">
						<table width="41%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th scope="col" style="font-size: xx-large;"><?php echo $xCompanyName ?></th>
							</tr>
						</table>
					</td>
				

					<td style="font-size: 14px;">
						<table width="93%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th scope="col">Welcome: <?php echo $_SESSION['user']; ?></th>
								<th scope="col"><?php
								$Today = date ( 'y:m:d', time () );
								$new = date ( 'l, F d, Y', strtotime ( $Today ) );
								echo $new;
								?></th>
														
									<th scope="col" ><a href="homepage_billing.php"> <input
										type="button" value="Home" />
								</a></th>
						
										
								
								<th scope="col" ><a href="logout.php"> <input
										type="button" value="Logout" src="" />
								</a></th>
							</tr>
						</table>
					</td>
				</tr>

			</table>
		</div>
	</div>
</body>
</html>