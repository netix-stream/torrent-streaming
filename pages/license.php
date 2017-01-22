<?php

if (isset($_POST['licenceKey'])) {
 
$fileLicence = fopen($path . '/license.supplied.dat', 'r+');
fseek($fileLicence, 0); 
fputs($fileLicence, $_POST['licenceKey']); 
fclose($fileLicence);
}

$padl = new \Padl\License(false, true, false, false);
$server_array = $_SERVER;
$padl->setServerVars($server_array);

$license = file_get_contents($path.'/license.supplied.dat'); 
$results = $padl->validate($license);
	include_once($path.'/libs/messages.php');
 

