<?php
include 'config.php';
date_default_timezone_set('Asia/Calcutta');

$xCurrentDate= date('Y-m-d');
$xBackupQry ="SELECT *  FROM backup where date='$xCurrentDate'";
	$result = mysql_query ( $xBackupQry) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count == 0) {
		$xQry = "INSERT INTO backup(date)  VALUES('$xCurrentDate')";
		$retval = mysql_query ( $xQry ) or die ( mysql_error ());
		
		$GLOBALS ['xDate']=date('Y-m-d-H-i-s');
		backup_tables('localhost','root','','stlukes');
	}




/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
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
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$return='';
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file

	$handle = fopen('./backup/stlukes-'.$GLOBALS ['xDate'].'.sql','w+');
	//$handle = fopen('./backup/DAYBOOK-BACKUP-'.$GLOBALS ['xDate'].'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>