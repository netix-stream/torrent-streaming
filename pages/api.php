<?php
 
 if ($_GET['api'] === 'true')
 {
 
echo filesize($path.'/uploads/'.$_GET['filePath']);
 
  
 
 }
?>
