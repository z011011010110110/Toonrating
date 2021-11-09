<?php
	session_start(); 
	include_once 'dbh.inc.php';
	$toonId = $_GET['toon'];
	
	$page = $_GET['page'];
	$limit = $_POST['limit'];
	$offset = $limit * ($page);
	if(!empty($_POST['limit']))
	{
		$pageString = "LIMIT $limit OFFSET $offset";
	}
	//if toonId is set, return that specific toon. Else, return all toons.
	//webtoon
	if ($toonId > 0){
		$toon = mysqli_query($con, "SELECT *FROM toon WHERE id = $toonId AND active > -1 $pageString;");	
	}
	//Searching on searchbar
	else if(!empty($_POST['search'])){
		$search = mysqli_real_escape_string($con, $_POST['search']);
		//%_____% means you're not looking for exact match. Example: "abc" can find "abcde"
		$toon = mysqli_query($con, "SELECT *FROM toon WHERE title LIKE '%$search%' OR author LIKE '%$search%' AND active > -1 ORDER BY overallRating DESC;");
	}
	//default on toonratings.com/ and toonratings.com/refreshall
	else{
		
		//Ranking and order	
		$ranking = 'overallRating';
		$order = 'DESC';
		if(!empty($_GET['ranking'])){//overallRating, userRating, artRating, storyRating, or panelRating
			$ranking = $_GET['ranking'];
		}
		if(!empty($_GET['order'])){//ASC or DESC
			$order = $_GET['order'];
		}
		
		//Match json filters.
		$genre = $_GET['genre'];
		//echo $genre;
		$status = $_GET['status'];
		$length = $_GET['length'];

		$searchString = "";
		if(!empty($_GET['genre'])){
			$searchString = $searchString."AND json LIKE '%$genre%'";
		}
		if(!empty($_GET['status'])){
			$regStatStr = '\"status\":\"completed\"';
			
			$status = $_GET['status'];
			if ($status == 'ongoing')
			{
				$regStatStr = '\"status\":\"ongoing\"';
			}
			$searchString = $searchString."AND json REGEXP '$regStatStr'";
		}
		if(!empty($_GET['length'])){ //get number of episodes match
			$regLenStr = '';
			if ($_GET['length'] == 'short'){
				$regLenStr = '\"numEpisodes\":[0-1]{0,1}[0-9]{1}[^0-9]';
			}
			else if ($_GET['length'] == 'medium'){
				$regLenStr = '\"numEpisodes\":[2-9]{1}[0-9]{1}[^0-9]';
			}
			else if ($_GET['length'] == 'long'){
				$regLenStr = '\"numEpisodes\":[0-9]{3}[^0-9]';
			}
			$searchString = $searchString."AND json REGEXP '$regLenStr'";
		}
		
		$toon = mysqli_query($con, "SELECT *FROM toon WHERE id > 0 AND active > -1 $searchString ORDER BY $ranking $order $pageString;");
		$toonNum = mysqli_num_rows(mysqli_query($con, "SELECT *FROM toon WHERE id > 0 AND active > -1 $searchString;"));
	}
	
	$title = '';
	
	$newObj = array();
	
	

	//get admin? of the user
	$user = mysqli_query($con, "SELECT *FROM user WHERE id = ".$_SESSION['userID'].";");	
	$admin = 0;
	while($row = mysqli_fetch_assoc($user)) 
	{
		$admin = 1;
		if ($row['admin'] == 1)
		{
			$admin = 2;
		}
	}
	
	
	
	
	//returns toon that matches
	while($row = mysqli_fetch_assoc($toon))
	{
		$newOverallRating = (double)$row['overallRating'];
		$newStoryRating = (double)$row['storyRating'];
		$newArtRating = (double)$row['artRating'];
		
		//REALL REVIEW: If not admin, get average user ratings. 
		if ($admin != 2){
			$newOverallRating = 0;
			$newStoryRating = 0;
			$newArtRating = 0;
			$total = 0;
			//get reviews for the toon
			$review = mysqli_query($con, "SELECT *FROM review WHERE toonId = ".$row['id']." AND userRating > 0 AND active > -1;");	
			//returns toon that matches and adds up total user ratings
			while($row2 = mysqli_fetch_assoc($review))
			{
				$newOverallRating += $row2['userRating'];
				$newStoryRating += $row2['storyRating'];
				$newArtRating += $row2['artRating'];
				$total += 1;
			}
			$newOverallRating = $newOverallRating/$total;
			$newStoryRating = $newStoryRating/$total;
			$newArtRating = $newArtRating/$total;
			if ($total == 0)
			{
				$newOverallRating = 0;
				$newStoryRating = 0;
				$newArtRating = 0;
			}
		}
		
		//if ($inRange){
			$newObj[] = array(
				'id' => (double)$row['id'],
				'count' =>(int)$toonNum,
				'order'=> $order,
				'title' => $row['title'],
				'image' => $row['image'],
				'description' => $row['description'],
				'uniqueId' => $row['uniqueId'],
				'url' => $row['url'],
				'overallRating' => $newOverallRating,
				'userRating' => (double)$row['userRating'],
				'storyRating' => $newStoryRating,
				'artRating' => $newArtRating,
				'panelRating' => (double)$row['panelRating'],
				'date' => $row['date'],
				'json' => $row['json'],
				'subscribers' => $row['subscribers'],
				'views' => $row['views'],
				'author' => $row['author'],
				'authorId' => (double)$row['authorId'],
				'admin'=> (int)$admin,
			);
		//}
	}
	/*
		$newObj->id = (double)$row['id'];
		$newObj->title = $row['title'];
		$newObj->description = $row['description'];
		$newObj->uniqueId = $row['uniqueId'];
		$newObj->userRating = (double)$row['userRating'];
		$newObj->storyRating = (double)$row['storyRating'];
		$newObj->artRating = (double)$row['artRating'];
		$newObj->panelRating = (double)$row['panelRating'];
		$newObj->date = $row['date'];
		$newObj->author = $row['author'];
		$newObj->authorId = (double)$row['authorId'];
		*/
	$newJSON = json_encode($newObj);

	echo $newJSON;
?>