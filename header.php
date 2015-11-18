<!doctype html>
<html>
	<head>
		<title>The Times</title>
	</head>
	<body>
		<h1>The Times</h1>
		<?php

		if(isset($_COOKIE["count"])) { //decode and explode into cookieData
			$cookieData = explode(",", base64_decode($_COOKIE["count"]));
		}
		else { //initialize cookieData	
			$cookieData = array(0,0);
		}
		
		//increment approriatley
		if(isset($_GET["articleId"])) {
			if($_GET["articleId"] >= 0 && (!filter_var($_GET["articleId"], FILTER_VALIDATE_INT) === false) || ($_GET["articleId"] == 0)) {
			$cookieData[0]++; //page
			$cookieData[1]++; //article
			var_dump($cookieData);
			} else {
				echo "Article not found.";
			}
		} else {
			$cookieData[0]++; //page
		}
		
		//redirect to sub page
		if($cookieData[1] >= 5){
			header("location:subscriptions.php");
		}
		
		setrawcookie("count", base64_encode(implode(",", $cookieData)), time()+3600);
		
		?>