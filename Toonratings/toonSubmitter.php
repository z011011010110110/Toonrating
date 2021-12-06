<?php	
	session_start(); 
	include_once 'dbh.inc.php';


	//get title, description, and author from url

	// Initialize a CURL session.
	 function file_get_contents_curl($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_URL, $url);   

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}


	$url = $_POST['url'];
	$str = file_get_contents_curl($url);
	$str2 = file_get_contents_curl($url."&page=10000");
	if(strlen($str)>0){
		$str = trim(preg_replace('/\s+/', ' ', $str)); // Remove double spaces and new lines
		$str = str_replace(" | WEBTOON","",$str);
		
		$str2 = trim(preg_replace('/\s+/', ' ', $str2)); // Remove double spaces and new lines
		$str2 = str_replace(" | WEBTOON","",$str2);

		
		//get image
		preg_match("/\<meta name=\"twitter:image\" content=\"(.*?)\"\/\>/i",$str,$image);
		//get title
		preg_match("/\<title\>(.*?)\<\/title\>/i",$str,$title); 
		//get summary
		preg_match("/\<p class=\"summary\"\>(.*?)\<\/p\>/i",$str,$description);
		//get author
		preg_match("/\<meta property=\"com-linewebtoon:webtoon:author\" content=\"(.*?)\" \/\>/i",$str,$author);
		
		
		//get canvas/featured
		if (strpos($_POST['url'], '/challenge/') !== false) {
			$type = 'challenge';
			
			//get genre	
			preg_match("/\<p class=\"genre\"\>(.*?)\<\/p\>/i",$str,$genre);
			$genre = $genre[1];
		}
		else{
			$type = 'featured';
			
			//get genre	
			preg_match("/\<h2 class=\"genre g_(.*?)\<\/h2\>/i",$str,$genre);
			$genre = explode(">",$genre[1])[1];
		}


		//last upload date 
		preg_match_all("/\<span class=\"date\"\>(.*?)\<\/span\>/i",$str2,$epListFirst,PREG_SET_ORDER);


		//first upload date 
		preg_match_all("/\<span class=\"date\"\>(.*?)\<\/span\>/i",$str,$epList,PREG_SET_ORDER);
		
		//get status(ongoing/completed)
		$finalDate = $epList[0][1];
		$date = strtotime($finalDate); 
		$status = 'ongoing';
		if ($date < strtotime('-90 days'))
		{
			$status = 'completed';
		}
		//number of episodes
		//preg_match("/\<a href=\"(.*?)\" class=\"NPI=a:list/i",$strRaw,$episodeUrl);
		//$str3 = file_get_contents(stripslashes($episodeUrl[1]));
		
		//number of episodes
		preg_match("/\<span class=\"tx\"\>#(.*?)\<\/span\>/i",$str,$numEpisodes);		
		
		$newObj->id = (double)0;
		$newObj->image = $image[1];
		$newObj->title = $title[1];
		$newObj->description = $description[1];
		$newObj->author = $author[1];
		$newObj->url = $_POST['url'];
		
		$newObj->userRating = (double)0;
		$newObj->storyRating = (double)0;
		$newObj->artRating = (double)0;
		$newObj->panelRating = (double)0;
		$newObj->overallRating = (double)0;
		
		$newJson->type = $type;
		$newJson->genre = $genre;
		$newJson->firstEpDate = $epListFirst[count($epListFirst)-1][1];
		$newJson->lastEpDate = $finalDate;
		$newJson->status = $status;
		$newJson->numEpisodes = (int)$numEpisodes[1];
	
		$newFilter = json_encode($newJson);
		$newObj->json = $newFilter;
	}
		
	//if toon already exists, return the id.
	$uniqueId = explode("?title_no=", $_POST['url'])[1];
	$newObj-> uniqueId = $uniqueId;
	$toon = mysqli_query($con, "SELECT *FROM toon WHERE uniqueId = '$uniqueId';");	
	
	while($row = mysqli_fetch_assoc($toon))
	{
		
		$id = (int)$row['id'];
		$newObj->id = $id;
		$newObj->userRating = (double)$row['userRating'];
		$newObj->storyRating = (double)$row['storyRating'];
		$newObj->artRating = (double)$row['artRating'];
		$newObj->panelRating = (double)$row['panelRating'];
		$newObj->overallRating = (double)$row['overallRating'];

		
		//Update number of subs================================================================================
		$subMatch = preg_match("/\<em class=\"cnt\"\>(.*?)\<\/em\>/i",$str,$subscribers);//number of subscribers
		$subsJson = $row['subscribers'];
		$subsObj = json_decode($subsJson);

		$date = strval(date("Y/m/d"));
		preg_match("/[a-z]{1}/i",$subscribers[1],$suffix); //Gets suffix: k,m,b,t
		$prefix = preg_replace("/[a-z]{1}/i", '', $subscribers[1]);//Gets just the number
		$numSubsribers = floatval($prefix);
		if($suffix[0] == 'K'){
			$numSubsribers = floatval($prefix)*1000;
		}
		else if($suffix[0] == 'M'){
			$numSubsribers = floatval($prefix)*1000000;
		}
		$subsObj->$date = $numSubsribers;
		
		$subscribersJson = json_encode($subsObj);
		
		//Update number of views================================================================================
		$viewsMatch = preg_match("/view\<\/span\> \<em class=\"cnt\"\>(.*?)\<\/em\>/i",$str,$views);//number of views
		$viewsJson = $row['views'];
		$viewsObj = json_decode($viewsJson);

		preg_match("/[a-z]{1}/i",$views[1],$suffix); //Gets suffix: k,m,b,t
		$prefix = preg_replace("/[a-z]{1}/i", '', $views[1]);//Gets just the number
		$numViews = floatval($prefix);
		if($suffix[0] == 'K'){
			$numViews = floatval($prefix)*1000;
		}
		else if($suffix[0] == 'M'){
			$numViews = floatval($prefix)*1000000;
		}
		$viewsObj->$date = $numViews;
		
		$viewsJson = json_encode($viewsObj);
		
		
		//Put it al together================================================================================
		
			
		if($subMatch){//Update subscribers, json, etc.
		$sql = "UPDATE toon set subscribers = '$subscribersJson' WHERE id = $id;";
		}
		if($viewsMatch){//Update subscribers, json, etc.
			$sql2 = "UPDATE toon set views = '$viewsJson' WHERE id = $id;";
		}
		$jsonFilter = "'".mysqli_real_escape_string($con, $newFilter)."'";
		$sql3 = "UPDATE toon set json = $jsonFilter WHERE id = $id;";
	}

	
	$query = mysqli_query($con,$sql);//Update subscribers
	$query2 = mysqli_query($con,$sql2);//Update views
	$query3 = mysqli_query($con,$sql3);//Update json
	
	
	
	
	//get admin? of the user
	$user = mysqli_query($con, "SELECT *FROM user WHERE id = ".$_SESSION['userID'].";");	
	$admin = 3;
	while($row = mysqli_fetch_assoc($user)) 
	{
		if ($row['admin'] == 1)
		{
			$admin = 2;
		}
	}
	$newObj->admin = (int)$admin;
	
	
	//extractContent($_POST['url']);
	$newJSON = json_encode($newObj);
	
	echo $newJSON;
	//echo $_POST['url'];


?>
