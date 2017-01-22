<?php


#doc
#	classname:	ClassName
#	scope:		PUBLIC
#
#/doc

class Stream
{
	#	internal variables

	#	Constructor
	function __construct ()
	{
		# code...
		
	}
	###
	function getInfoWebtorrent()
	{
		# code...
	}
	###
	function torrentFulSize($content)
	{
			$numfiles=0;
		 
			if (isset($content["info"]) && $content["info"])
			  {
				$thefile=$content["info"];
				if (isset($thefile["length"]))
				  {
				  $dfiles[$numfiles]["filename"]=htmlspecialchars($thefile["name"]);
				  $dfiles[$numfiles]["size"]=$thefile["length"];
				  $numfiles++;
				  }
				elseif (isset($thefile["files"]))
				 {
				   foreach($thefile["files"] as $singlefile)
				     {
				       $dfiles[$numfiles]["filename"]=htmlspecialchars(implode("/",$singlefile["path"]));
				       $dfiles[$numfiles]["size"]=$singlefile["length"];
				       $numfiles++;
				     }
				 } 
			 }
			 $row["numfiles"]=$numfiles.($numfiles==1?" file":" files");
		  
		 foreach ($dfiles as $key => $value) {
			// $tree .= '- <b>' . $value["filename"].'</b> ';
			foreach ($value as $key => $value) {
				if ($key != 'filename')
				$tree .= $value;
				//$tree .= "File size : $value<br />\n";
			}
		 } 		
		 return $tree;
	}	
	###
	function bytesToSize_human($bytes, $precision = 2) {  
		$kilobyte = 1024;
		$megabyte = $kilobyte * 1024;
		$gigabyte = $megabyte * 1024;
		$terabyte = $gigabyte * 1024;
	   
		if (($bytes >= 0) && ($bytes < $kilobyte)) {
		    return $bytes . ' B';
	 
		} elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
		    return round($bytes / $kilobyte, $precision) . ' KB';
	 
		} elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
		    return round($bytes / $megabyte, $precision) . ' MB';
	 
		} elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
		    return round($bytes / $gigabyte, $precision) . ' GB';
	 
		} elseif ($bytes >= $terabyte) {
		    return round($bytes / $terabyte, $precision) . ' TB';
		} else {
		    return $bytes . ' B';
		}
	}	
	function bytesToSize($bytes, $precision = 2) {  
		$kilobyte = 1024;
		$megabyte = $kilobyte * 1024;
		$gigabyte = $megabyte * 1024;
		$terabyte = $gigabyte * 1024;
	   
		if (($bytes >= 0) && ($bytes < $kilobyte)) {
		    return $bytes;
	 
		} elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
		    return round($bytes / $kilobyte, $precision);
	 
		} elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
		    return round($bytes / $megabyte, $precision);
	 
		} elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
		    return round($bytes / $gigabyte, $precision);
	 
		} elseif ($bytes >= $terabyte) {
		    return round($bytes / $terabyte, $precision);
		} else {
		    return $bytes;
		}
	}
	### 	
	function addTorrent($tid,$hash,$title,$size) {
		global $db,$conf;
		$date = time();
		$query = "INSERT INTO ".$this->prefix_db."torrents (id,tid,info_hash,name,date,size) 
	          VALUES (
			  'NULL',
			  '".$db->escape($tid)."',
			  '".$db->escape($hash)."',
			  '".$db->escape($title)."', 
			  '$date',
			  '".$db->escape($size)."'
			  )";
    		$db->query($query);
    		$db->debug();
    		return $db->insert_id;
 
    		// $paste = $db->get_row("SELECT uniqueid FROM ".$this->prefix_db."torrents WHERE id='$id'");
     		// $this->redirect($conf['baseurl'].'/'.$paste->uniqueid);
	}
}
###

