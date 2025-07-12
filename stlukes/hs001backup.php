<?php
include 'config.php';
date_default_timezone_set('Asia/Calcutta');

$xCurrentDate= date('Y-m-d');
$xBackupQry ="SELECT *  FROM backup where date='$xCurrentDate'";
	$result = mysqli_query ( $con, $xBackupQry) or die ( mysqli_error ( $con ) );
	$count = mysqli_num_rows ( $result );
	if ($count == 0) {
		$xQry = "INSERT INTO backup(date)  VALUES('$xCurrentDate')";
		$retval = mysqli_query ( $con, $xQry ) or die ( mysqli_error ($con));
		$GLOBALS ['xDate']=date('Y-m-d-H-i-s');
		backup_tables('localhost','root','','stlukes', $con);
	}

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$con,$tables = '*')
{
	// Use mysqli for connection
	//$link = mysqli_connect($host,$user,$pass,$name);
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($con, 'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($con, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		$return='';
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return."\n\n\n";
	}
	//save file
	$handle = fopen('./backup/stlukes-'.$GLOBALS ['xDate'].'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>