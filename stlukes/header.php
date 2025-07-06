<?php
//session_start ();
//include_once 'config.php';
//if (! isset ( $_SESSION ['user'] )) {
	//header ( "Location: index.php" );
//}
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
								<td scope="col" style="font-size: 24px;">St.LUKE'S LEPROSARIUM,PEIKULAM<span
									style="font-size: 16px;"> &nbsp;&nbsp;Patient Data V.1.7.5</span></td>
								<td scope="col"><?php
								$Today = date ( 'y:m:d', time () );
								$new = date ( 'l, F d, Y', strtotime ( $Today ) );
								echo $new;
								?></td>
							</tr>
							
						</table>

		</div>
	</div>
</body>
</html>