<?php

require_once $path.'/libs/class.bdecode.php';
require_once $path.'/libs/class.bencode.php'; // To create info hash of torrent
require_once $path.'/libs/lang_en.php'; 
$data = array();
 
if(isset($_GET['files'])) {	
 
	$files = array();

	$uploaddir = $path.'/uploads/torrents/';
	foreach($_FILES as $file) {

	if(in_array(strrchr($file['name'], '.'), array('.torrent'))) {
	
	$torrent = new BDECODE($file['tmp_name']);
	$resultTorrent = $torrent->result;
	$hash = sha1(BEncode($resultTorrent['info']));
 


			if (is_uploaded_file($file['tmp_name'])) {	
				if(move_uploaded_file($file['tmp_name'], $uploaddir .$hash.'.torrent')) {
					$files[] = $uploaddir.$file['name'];
					$data = array('files' => $files, 'info_hash' => $hash);
				} else
			 		$data = array('error' => $lang["errorMove"]);
		 	} else
		 		$data = array('error' => $lang["errorIsuploaded"]);
 
	} else
		 $data = array('error' => $lang["notTorrent"]);
	
	

} 
echo json_encode($data);
exit;
 
}
if (isset($_GET['form']))
{
	$data = array('success' => $lang["welldone"], 'formData' => $_POST);
	echo json_encode($data);
	exit;
 
}
if (isset($_GET['start']))
{
 
$dataTorrent = exec('webtorrent download '.$path.'/uploads/torrents/'.$_GET['start'].'.torrent -o '.$path.'/uploads/  > /dev/null &');
// echo 'webtorrent download /var/www/uploads/torrents/'.$_GET['start'].'.torrent  > /dev/null &';
 
}
