<?php

// Either prints all the news headlines with links to the articles, or the individual article itself
// Takes an argument "article" in the query string

$articlenum=$_GET['article'];

// If no article or invalid article given then index all the articles in descending date order

if (empty($articlenum) || !is_numeric($articlenum)) {

  $thenews = DBquery("SELECT * FROM btp_news ORDER BY date DESC");

  echo "<h1>BT&amp;P News Headlines</h1>Please click a headline to view the article<br />&nbsp;<br /><small>(All newspaper cuttings remain the copyright of that publishing newspaper. Permission has been granted for reproduction on this site only. Should you wish to use it or make reference to any of the cuttings, please seek  permission from the newspaper first.)</small><ul>";

  while($row=mysql_fetch_object($thenews)) {

	  // Work out and format the date of this article

		$timestamp = strtotime($row->date);
		$timestring = date("l d F Y",$timestamp);

		// Echo a list item for the article with its date and headline

	  echo "<li>$timestring<br />";
	  echo "<a href=\"index.php?section=news&amp;article=$row->ID\">$row->title</a></li>";
  }

  echo "</ul>";

}

else {

  // Else print the article specified in the GET string

  $thenews = DBquery("SELECT * FROM btp_news WHERE ID='$articlenum'");

  while($row=mysql_fetch_object($thenews)) {

		// Do the date

		$timestamp = strtotime($row->date);
		$timestring = date("l d F Y",$timestamp);

		// Print header, author, date and article

		echo "<h2>$row->title</h2>";
		echo "<i>Written by $row->author on $timestring</i><br />";
	  echo $row->article;

		// Link to news headlines at the bottom

		echo "<p><a href=\"index.php?section=news\">See All News Headlines</a></p>";

  }
}

?>