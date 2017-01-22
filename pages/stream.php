<?php
require_once $path.'/libs/class.bdecode.php';
require_once $path.'/libs/class.bencode.php'; // To create info hash of torrent
 
if (isset($_GET['hash']))
{
	# code...
$return = shell_exec('webtorrent info '.$path.'/uploads/torrents/'.$_GET['hash'].'.torrent');
$dataTorrent = json_decode($return);

$fileSize =  filesize($path.'/uploads/'.$dataTorrent->files[0]->path);
$smarty->assign('dataTorrent',$dataTorrent);
$hash = $_GET['hash'];
}
 
if (isset($_GET['stop']))
{
shell_exec('killall WebTorrent');

$return = shell_exec('webtorrent info '.$path.'/uploads/torrents/'.$_GET['stop'].'.torrent');
$dataTorrent = json_decode($return);
$fileSize = filesize($path.'/uploads/'.$dataTorrent->files[0]->path);

 $smarty->assign('dataTorrent',$dataTorrent);
 $hash = $_GET['stop'];
 } 
  
	$torrent = new BDECODE($path.'/uploads/torrents/'.$hash.'.torrent');
	$content = $torrent->result;
 //var_dump($fileSize);
 $smarty->assign('fileSize',$startUp->bytesToSize($fileSize));
 $smarty->assign('torrentFullSize',$startUp->torrentFulSize($content));
 $smarty->assign('fileSizeNotH',$fileSize);
 $smarty->assign('torrentFullSizeNotH',$startUp->torrentFulSize($content));
 $smarty->assign('filePath',$dataTorrent->files[0]->path);
 
 

