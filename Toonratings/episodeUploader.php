<?php

	//session_start();
	include_once 'dbh.inc.php';
	
	$creatorIDNum = 13;//$_SESSION['userID'];
	
	if (!empty($_GET['pieceID']))
	{	
		$pieceID = $_GET['pieceID'];
		$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$pieceID';"));
	
		$sourceID = $info['source'];
		$url = $info['vidSource'];
		
		$numEps = explode('-', $url);
			
		$numEnd = end($numEps)+1;
		$numStart = end($numEps);
	}
	else if(!empty($_GET['sourceID']) && !empty($_GET['url']))
	{
		$sourceID = $_GET['sourceID'];
		$url = 'http://vidstreaming.io/videos/'.$_GET['url'];
		
		$numEps = explode('-', $url);
		
		$numEnd = end($numEps);
		$numStart = 1;
		
				
		echo "id: ". $sourceID."\n";
		echo "url: ". $url."\n";
	}
	
	
	function get_episodes($url){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/<iframe src=\"(.*)\"/siU",$str,$title); // ignore case
			return $title[1];
		}
	}
	function get_episodes2($url){
		
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/window.open\( \"(.*)\",/siU",$str,$title); // ignore case
			return $title[1];
		}
	}
	function get_episodes3($url){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/<div class=\"dowload\"><a href=\"(.*)\" download/siU",$str,$title); // ignore case
			return $title[1];
		}
	}
	
	function get_episodesx($url){
		
		$urlx = '';
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/<iframe src=\"(.*)\"/siU",$str,$title); // ignore case
			$urlx = 'https:'.$title[1];
		}
		//echo "<br>".$urlx;
		
		$urlxx = '';
		$strx = file_get_contents($urlx);
		if(strlen($strx) > 0){
			$strx = trim(preg_replace('/\s+/', ' ', $strx)); // supports line breaks inside <title>
			preg_match("/window.open\( \"(.*)\",/siU",$strx,$titlex); // ignore case
			$urlxx = $titlex[1];
		}
		//echo "<br>".$urlxx;
		
		$urlxxx = '';
		$strxx = file_get_contents($urlxx);
		if(strlen($str)>0){
			$strxx = trim(preg_replace('/\s+/', ' ', $strxx)); // supports line breaks inside <title>
			preg_match("/<div class=\"dowload\"><a href=\"(.*)\" download/siU",$strxx,$titlexx); // ignore case
			$urlxxx = $titlexx[1];
		}
		
		return $urlx;
	}
	function get_download($url){
	
		$urlx = '';
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/<iframe src=\"(.*)\"/siU",$str,$title); // ignore case
			$urlx = 'https:'.$title[1];
		}
		//echo "<br>".$urlx;
		
		$urlxx = '';
		$strx = file_get_contents($urlx);
		if(strlen($strx) > 0){
			$strx = trim(preg_replace('/\s+/', ' ', $strx)); // supports line breaks inside <title>
			preg_match("/window.open\( \"(.*)\",/siU",$strx,$titlex); // ignore case
			$urlxx = $titlex[1];
		}
		//echo "<br>".$urlxx;
		
		$urlxxx = '';
		$strxx = file_get_contents($urlxx);
		if(strlen($str)>0){
			$strxx = trim(preg_replace('/\s+/', ' ', $strxx)); // supports line breaks inside <title>
			preg_match("/<div class=\"dowload\"><a href=\"(.*)\" download/siU",$strxx,$titlexx); // ignore case
			$urlxxx = $titlexx[1];
		}
		
		return $urlxxx;
	}
	function get_title($url){
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/- <\/span>(.*)<\/h2>/siU",$str,$title); // ignore case
			return $title[1];
		}
	}
	
	for ($x = $numStart; $x <= $numEnd; $x++) {
		array_pop($numEps);
		array_push($numEps, $x);    
		
		$episodeTitle = 'Episode '.$x;
		$trueURL = implode('-',$numEps);

		
		$sourceInfo = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM source WHERE sourceID = '$sourceID';"));
		$titleDescription = get_title('https://myanimelist.net/anime/'.$sourceInfo['mal']."/anime/episode/".$x);
		

		
		if (strpos($titleDescription, 'span>') !== false && strpos($titleDescription, '<span') !== false )
		{
			$titleDescription = 'Episode '.$x.' from the anime, '.$sourceInfo['sourceName'].'.';
		}
		//echo 'https://myanimelist.net/anime/'.$sourceInfo['mal']."/anime/episode/".$x." : ".$titleDescription;
		$frameLink = get_episodesx($trueURL);
		
		if (!empty($_POST['vidUrl']))
		{
			$url = $_POST['vidUrl'];
			echo get_download($url);
			break;
			return;
		}
		
		
		$result = mysqli_query($con, "SELECT *FROM piece WHERE source = '$sourceID' AND episode = $x;");	
		if (mysqli_num_rows($result) > 0) //episode available
		{		
			$query = mysqli_query($con, "UPDATE piece SET vidFrameLink = '$frameLink' WHERE source = '$sourceID' AND episode = $x;");
			$query2 = mysqli_query($con, "UPDATE piece SET idDescription = '$titleDescription' WHERE source = '$sourceID' AND episode = $x;");
		}
		else //episode empty
		{
			
			$uniqueID =hash('adler32',  uniqid());
			
			while (mysqli_num_rows(mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$uniqueID';")) > 0) //episode available
			{
				$uniqueID =hash('adler32',  uniqid());
				//$resultx = mysqli_query($con, "SELECT *FROM piece WHERE pieceID = '$uniqueID';");
			}
			echo $uniqueID;
			
			
			if (strpos($frameLink, '//vidstreaming.io/streaming.php') !== false)
			{
				$time = 'CURRENT_TIMESTAMP';
				$sql = "INSERT INTO piece (pieceID, PieceName, idDescription, creatorID, time, source, type, vidSource, vidFrameLink, episode) 
				VALUES('$uniqueID','".$episodeTitle."' ,'".$titleDescription."', $creatorIDNum, $time, '$sourceID', 'Episode', '$trueURL', '$frameLink', $x);";
				$query = mysqli_query($con,$sql);
				
				echo "<br>".$frameLink."<br><br>";
			}
		}
	}

?>