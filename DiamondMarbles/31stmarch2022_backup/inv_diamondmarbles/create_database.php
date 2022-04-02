<?php
$xHostName="localhost";
$xUserName="root";
$xPassword="nellaisaleem";

$xDbName="inventory";

$filename = 'inventory.sql';
// Create connection
$conn = new mysqli($xHostName, $xUserName, $xPassword);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE if not exists inventory";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Create Password
$sql = "SET PASSWORD FOR root@localhost = PASSWORD('nellaisaleem');";
if ($conn->query($sql) === TRUE) {
	echo "Password created successfully";
} else {
	echo "Error creating Password: " . $conn->error;
}

//Create Tables 

// Connect to MySQL server
mysql_connect($xHostName, $xUserName, $xPassword) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($xDbName) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;

	// Add this line to the current segment
	$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';')
	{
		// Perform the query
		mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
		// Reset temp variable to empty
		$templine = '';
	}
}
echo "Tables imported successfully";



?>