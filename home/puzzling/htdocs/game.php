<?php

include('includes/dblib.php');

// This should be sent on from pregame.php
$game = $_GET['game'];

// Correct legacy bookmark as in pregame.php
if (!is_numeric($game)) {
  $game = DBonevalue("SELECT id FROM btp_games WHERE name='$game'");
}

$gameinfo = DBonerow("SELECT * FROM btp_games WHERE id='$game'");

$width = $gameinfo->width;
$height = $gameinfo->height;

$pagetitle = $gameinfo->ufname;

include("includes/top_no_banner.inc");

// XML version, also specified from pregame.php
$xv = $_GET['age'];
if (empty($xv)) {
  // If for some reason it doesn't exist then set it to 1 as default
	$xv = 1;
}

// Flashvars for the loader - what file to load and what version of the XML to use
$fv = "loadfile=$gameinfo->location&amp;xmlversion=$xv";

// Load the game up
if ($gameinfo != false) {

	include("includes/flashutils.inc");
	flashObjectTags("flash/loaders/loader_".$width."x".$height, "loader", $width, $height, "#".$gameinfo->colour, $fv);

	if ($gameinfo->keyboard != "") {

?>

<p>
<a href="keys.php?game=<?=$game ?>" target="_blank" onclick="openKeys(this.href); return false;">
  Keyboard Shortcuts
</a>
</p>

<?php

  }
}

else {
	echo("The game you have requested does not exist. Please go back to the <a href=\"index.php?section=home\"> puzzles page</a> and choose another.");
}

?>

</body>
</html>