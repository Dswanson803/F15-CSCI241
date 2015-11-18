<?php
require("header.php");
require_once("common.php");
?>

<h2>Articles</h2>
<?php
$articles = readLines("articles.txt");
$counter = 0;
foreach ($articles as $lineNo => $line) {
	echo "<a href='news.php?articleId=" . $counter . "'>";
	echo $articles[$lineNo][0] . "<br/>";
	echo "</a>";
	$counter++;
}

require("footer.php");