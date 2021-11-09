<?php
    session_start();
    include_once 'dbh.inc.php';

    //Submits a new Webtoon
	
    $editId = 0;
    if (isset($_POST['editId']))
    {
        $editId = $_POST['editId'];
    }
    
	//for deleting webtoon
	$active = 0;
    if (isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
	
    $title = "'".'-'."'";
    if (!empty($_POST['title']))
    {
        $title = "'".mysqli_real_escape_string($con, $_POST['title'])."'";
    }

    $image = "'".'/soundabox.png'."'";
    if (!empty($_POST['image']))
    {
        $image = "'".$_POST['image']."'";
    }

	//Webtoon URL
    $url = "'".'-'."'";
    if (!empty($_POST['url']))
    {
        $url = "'".$_POST['url']."'";
    }

	//for linking to webtoon website
    $uniqueId = "'".'-'."'";
    if (!empty($_POST['uniqueId']))
    {
        $uniqueId = "'".$_POST['uniqueId']."'";
    }

    $description = "'".'-'."'";
    if (!empty($_POST['description']))
    {
        $description = "'".mysqli_real_escape_string($con, $_POST['description'])."'";
    }

	
	
	$storyRating = 0;
    if (!empty($_POST['storyRating']))
    {
        $storyRating = $_POST['storyRating'];
    }
		
	$artRating = 0;
    if (!empty($_POST['artRating']))
    {
        $artRating = $_POST['artRating'];
    }
	
	$panelRating = 0;
    if (!empty($_POST['panelRating']))
    {
        $panelRating = $_POST['panelRating'];
    }
	
	$userRating = 0;
    if (!empty($_POST['userRating']))
    {
        $userRating = $_POST['userRating'];
    }
		
//UPDATES USER RATINGS. THIS IS CALCULATED DIFFERENTLY
	$overallRating = 0;
	$total = 0;
	//get reviews for the toon
	$toon = mysqli_query($con, "SELECT *FROM review WHERE toonId = $editId AND userRating > 0 AND active > -1;");	
	//returns toon that matches and adds up total user ratings
	while($row = mysqli_fetch_assoc($toon))
	{
		$overallRating += $row['userRating'];
		$total += 1;
	}
	//get score from admin rating
	$overallRating += ($artRating+$storyRating)/2;
	$total += 1;
	
	$overallRating = (double)$overallRating/$total;
	if ($total == 0)
	{
		$overallRating = 0;
	}
	
	//$overallRating = 0;//THIS IS USELESS NOW
    if (!empty($_POST['overallRating']))
    {
        //$overallRating = $_POST['overallRating'];
    }
	
	$date = 'CURRENT_TIMESTAMP';
    if (isset($_POST['date']))
    {
        $date = "'".$_POST['date']."'";
    }
	
	$author = "'".'-'."'";
    if (!empty($_POST['author']))
    {
        $author = "'".$_POST['author']."'";
    }
	
	$authorId = 0;
    if (!empty($_POST['authorId']))
    {
        $authorId = $_POST['authorId'];
    }
		
	$json = "'".'-'."'";
    if (!empty($_POST['json']))
    {
        $json = "'".mysqli_real_escape_string($con, $_POST['json'])."'";
    }
	
	if ($editId > 0 && $active < 0)
    {
        $sql = "UPDATE toon set active = $active WHERE id = $editId;";
	}
    else if ($editId <= 0)
    {
        $sql = "INSERT INTO toon (title, image, description, uniqueId, url, userRating, storyRating, artRating, panelRating, overallRating, date, json, author, authorId)
        VALUES($title, $image, $description, $uniqueId, $url, $userRating, $storyRating, $artRating, $panelRating, $overallRating, $date, $json, $author, $authorId);";
	}
    else if ($editId > 0)
    {
        $sql = "UPDATE toon set title = $title, image = $image, description = $description, uniqueId = $uniqueId, url = $url, userRating = $userRating, storyRating = $storyRating,
		artRating = $artRating, panelRating = $panelRating, overallRating = $overallRating, date = $date, json = $json, author = $author, authorId = $authorId, active = $active WHERE id = $editId;";
    }
	
    echo "$sql";
    $query = mysqli_query($con,$sql);
	


	
	
?>
