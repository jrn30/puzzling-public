<?php

include("includes/glossary_top.inc");

// Sets a letter to the default 'A' is we don`t have one
if (empty($_GET["letter"])) {
   $thisLetter = "A";
}
// Otherwise take the first character of the query variable letter
else $thisLetter = strtoupper(substr($_GET[letter],0,1));

// Get the letters and whether each has any entries for itself
$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

// For each letter
for ($i=0; $i<count($letters); $i++) {
	echo "<a href=\"index.php?section=glossary&amp;letter=$letters[$i]\">$letters[$i]</a>";
	if ($i < count($letters)-1) echo " | \n";
}

// If this letter is alphanumeric...
if (ereg("[A-Z]",$thisLetter)) {

	echo "\n<h2>Entries for ".strtoupper($thisLetter)."</h2>\n\n";

	// Get the entries for that letter
	$query = "SELECT * FROM dictionary WHERE word LIKE '$thisLetter%' ORDER BY word";
	$result = DBquery($query);
}
// If letter is not alphanumeric then tell the user they have made an invalid query
else {
	print "<br>&nbsp;<br>Invalid query - please pick a letter from above.";
}

if ($result) {
  $numrows = mysql_num_rows($result);
  if ($numrows > 0) {
	while ($this_row = mysql_fetch_assoc($result)) {
		printEntry($this_row);
	}
  }
  else {
	  print("Sorry, there are no entries for the letter <b>$thisLetter</b><br>&nbsp;<br>");
  }
}

?>

<hr>

&nbsp;<br>

<?php include("includes/glossary_bottom.inc"); ?>