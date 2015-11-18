<?php
require("header.php");
require_once("common.php");

if (isset($_GET["articleId"]) && $_GET["articleId"] >= 0) {
	$articles = readLines("articles.txt");
	for ($x = 0; $x < 2; $x++) {
		echo $articles[$_GET["articleId"]][$x] . "<br/>";
	}
}
require("footer.php");