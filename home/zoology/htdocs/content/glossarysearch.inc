<?php

include("includes/glossary_top.inc");

$search = $_GET[search];

// Get rid of white space and % wildcards
$search = trim($search);
$search = str_replace("%", "", $search);

// Tell user they got it wrong if there is no search query
if (empty($search)) {
	echo("<h2>Sorry</h2>Your query '$_GET[search]' was invalid. Please try again");
}

else {

	echo("\n<h2>Search Results for '$search'</h2>");

	$searchterms = explode(" ", $search);

	$query1 = "SELECT * FROM dictionary WHERE ";
	$query2 = "SELECT * FROM dictionary WHERE ";

	$b = $_GET[boolean];

	if ($b != "AND" && $b != "OR") {
		$b = "AND";
	}

	for ($i=0; $i < count($searchterms); $i++) {
		if ($i > 0) {
			$query1 .= "$b ";
			$query2 .= "$b ";
		}

		$query1 .= "word LIKE '%$searchterms[$i]%' ";
		$query2 .= "meaning LIKE '%$searchterms[$i]%' ";
	}
	$query2 .= "ORDER BY word";

	echo("\n\n<!-- $query2 -->\n\n");

	$result1 = DBquery($query1);
	$numrows1 = mysql_num_rows($result1);

	if ($numrows1 > 0) {
		echo "<span class=\"smallbold\">We found ";
		echo $numrows1;
		echo " words matching '$search'<br>&nbsp;<br></span>";

		$n = 0;
		while (($this_row = mysql_fetch_assoc($result1)) && $n++ < 10) {
			printEntry($this_row);
		}
	}

	$result2 = DBquery($query2);
	$numrows2 = mysql_num_rows($result2);

	if ($numrows2 > 0) {
		echo "<span class=\"smallbold\">We found $numrows2 definitions matching '$search'<br>&nbsp;<br></span>";

		$n = 0;
		while (($this_row = mysql_fetch_assoc($result2)) && $n++ < 20) {
			/*for ($i=0; $i < count($searchterms); $i++) {
				$this_row[meaning] = eregi_replace ("($searchterms[$i])", "<span class=\"highlighted\">\\1</span>", $this_row[meaning]);
			}*/
			printEntry($this_row);
		}
	}

	if ($numrows1 > 10 || $numrows2 > 20) {
		echo "<span class=\"smallbold\">There are too many entries to list here - try searching with more specific terms</span>";
	}

	if ($numrows1 + $numrows2 == 0) {
		echo "Sorry, we don't have any entries for your search for <b>$search</b>. Try searching again.";
	}
}

echo "<hr>";

include("includes/glossary_bottom.inc"); ?>