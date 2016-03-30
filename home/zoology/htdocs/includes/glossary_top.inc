<h1>Zoology Glossary</h1>

<div>

<?php

// Get DB login stuff
include('includes/dblogin.php');

// Generic function to print a dictionary entry

function printEntry($entry) {

	// Word itself
	echo "<b>$entry[word]</b><br>\n";

	if ($entry[has_image] == 1) {

	$imgresult = DBquery("SELECT * from vz_images WHERE word_id = '$entry[id]' ORDER BY id");
	while ($this_img = mysql_fetch_assoc($imgresult)) {
	  print("<img src=\"images/glossary/$this_img[image_src]\">&nbsp;");
	}
	echo("<br>");

	}
	// Its meaning
	echo $entry[meaning];
	echo "\n<br>&nbsp;<br>\n\n";

	/*

	// Links to editing/deleting entries
	echo "\n<br><span class=\"small\">&nbsp;<br>";
	echo "[<a href=\"private/add_entry.php?entry=$entry[word]\">edit</a>]&nbsp;";
	echo "[<a href=\"private/delete_confirm.php?entry=$entry[word]\">delete</a>]";
	echo "</span><br>&nbsp;<br>\n\n";

	*/
}

?>