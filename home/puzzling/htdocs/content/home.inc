<?php

// This function prints a game icon, using data $thisGame from a row of the btp_games database
// $gameID is a unique ID given to the icon for styling purposes

function printGameIcon($thisGame, $gameID) {
	echo "<a href=\"pregame.php?game=$thisGame[id]\" onclick=\"openGame(this.href, '$thisGame[winWidth]','$thisGame[winHeight]'); return false;\"
	         onmouseover=\"window.status='".addslashes($thisGame[ufname])."'; return true;\"
	         onmouseout=\"window.status=''; return true;\">";
	echo "<img id=\"$gameID\" src=\"images/thumbnails/$thisGame[name].gif\" alt=\"$thisGame[ufname]\"
	            title=\"$thisGame[ufname]\" class=\"gameicon\" width=\"40\" height=\"40\" />";
	echo "</a>";
}

?>

<div id="science">

<img src="<?=$imgDir?>sciencepuzzles.gif" alt="Science Puzzles" /><br /><?php
// Get the science games from the database and print their icons

$r = DBQuery("SELECT id, name, ufname, width + 25 AS winWidth, height + 50 AS winHeight FROM btp_games WHERE gametype=0 ORDER BY ufname");
$n = 0;
while ($t = mysql_fetch_assoc($r)) {
	printGameIcon($t, "sci".$n++);
}


?>

</div>

<div id="arts">

<img src="<?=$imgDir?>artspuzzles.gif" alt="Arts Puzzles" /><br /><?php

// Get the arts games from the database and print their icons

$r = DBQuery("SELECT id, name, ufname, width + 25 AS winWidth, height + 50 AS winHeight FROM btp_games WHERE gametype=1 ORDER BY ufname");
$n = 0;
while ($t = mysql_fetch_assoc($r)) {
	printGameIcon($t, "art".$n++);
}

?></div>

<div id="random">

<a href="pregame.php?random" onclick="openGame(this.href, '725','650'); return false;"
	 onmouseover="window.status='Play a random game'; return true;"
	 onmouseout="window.status=''; return true;"><img src="<?=$imgDir?>randompuzzle.gif" alt="Random Puzzle" /></a>

</div>