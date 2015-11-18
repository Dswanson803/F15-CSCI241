<?php 

//opens file and stores returns the content in an array.
function readLines($filename) {
	$fileResource = fopen($filename, "r");
	if(!is_resource($fileResource)) {
		exit("Could not open the file for reading.");
	}
	$contents = array();
	while($line  = fgets($fileResource)) {
		$contents[] = explode("|",$line);
	}
	fclose($fileResource);
	return $contents;
}