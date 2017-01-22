<?php
/**
 * Example Application
 *
 * @package Example-application
 */

$path = dirname(__FILE__); 

require $path.'/libs/startup.php';
// Change if you want!
$smarty->assign('domaine','http://'.$_SERVER['SERVER_NAME']);

switch (isset($_GET["page"])?$_GET["page"]:""){
 
        case 'upload': 
                # account
                include 'pages/upload.php';
        break; 

        case 'api': 
                # account
                include 'pages/api.php';
        break; 

        case 'license': 
                # account
                include 'pages/license.php';
        break; 
 
        case 'stream': 
                # account
                include 'pages/stream.php';
                $smarty->display('stream.html');
        break; 

        case 'torrents': 
                # account
                include 'pages/torrents.php';
                $smarty->display('torrents.html');
        break; 
 
        default:
        		include 'pages/main.php';
				$smarty->display('index.html');
        break;
}  
 


