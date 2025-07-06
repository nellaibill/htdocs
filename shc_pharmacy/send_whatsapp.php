<?php
//include 'globalfile.php';
require_once 'Chat-API-master/src/whatsprot.class.php';

$username = "9578795653"; // Username
$password = ""; // Password

$numbers = array("91XXXXX","92XXXXX");

//event handler
/**
 * @param $result SyncResult
*/
function onSyncResult($result)
{
	foreach ($result->existing as $number) {
		echo "$number exists<br />";
	}
		foreach ($result->nonExisting as $number) {
		echo "$number does not exist<br />";
		}
		die(); //to break out of the while(true) loop
}
$wa = new WhatsProt($username, 'WA', false);

// Bind Event onGetMessage
$wa->eventManager()->bind("onGetMessage", "onGetMessage");

try {
$wa->connect();
$wa->loginWithPassword($password);
} catch(Exception $e) {
echo "ERROR : Login Failed";
exit(0);
}

$no=""; // Number
$msg=""; // Message

try {
$wa->sendMessage($no, $msg);
echo 'Text Message Sent';
} catch(Exception $e) {
      echo "ERROR : Text Message Sending Failed";
}

//wait for response from Server
while ($wa->pollMessage());

// onGetMessage Event Handler Function
// Modify it According to your Needs
function onGetMessage($mynumber, $from, $id, $type, $time, $name, $body) {
echo 'Message Received<BR>';
echo "DEBUG : onGetMessage<BR>";
	 echo "mynumber : ".$mynumber."<BR>";
	 echo "from : ".$from."<BR>";
	 echo "id : ".$id."<BR>";
echo "type : ".$type."<BR>";
echo "name : ".$name."<BR>";
echo "body : ".$body."<BR>";
}
?>