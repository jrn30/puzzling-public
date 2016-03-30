<?php

include('includes/dblib.php');
include("includes/flashutils.inc");

/* This takes a GET variable `game` which is the ID of the game in the game table
 *
 *
 */

$game = $_GET['game'];

// If this does not exist then give us a random one
if (empty($game)) {
  if (isset($_GET['random'])) {
		$game = DBonevalue("SELECT id FROM btp_games ORDER BY RAND() LIMIT 0,1");
	}
}

// Games used to be referred to by the string 'name' column, not the numeric 'id' as they are now. This deals with any bookmarks to pages under the old system
else if (!is_numeric($game)) {
  $game = DBonevalue("SELECT id FROM btp_games WHERE name='$game'");
}

// Get the gameinfo
$gameinfo = DBonerow("SELECT * FROM btp_games WHERE id='$game'");
$width = $gameinfo->width;
$height = $gameinfo->height;
$pagetitle = $gameinfo->ufname;

include("includes/top_no_banner.inc");

echo "<div class=\"gamedesc\">";

if ($gameinfo) {

  // If the game is random then we have to resize the window to that of the game, with a liddle bit of JS
	if (isset($_GET['random'])) {
		$ww = $width + 25;
		$wh = $height + 50;

    echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
		echo "window.resizeTo($ww, $wh);\n";
		echo "</script>";

  }

  // Print title and description

  echo "<h1>$gameinfo->ufname</h1>";

  echo "<p>$gameinfo->description</p>";

  // And then print links to the game itself....

	$age1114image = ($gameinfo->age != 2) ? "11-14.gif" : "11-14small.gif";
	$age1518image = ($gameinfo->age != 1) ? "15-18.gif" : "15-18small.gif";

	?>

<p><small>Choose An Age Group</small></p>

<p>

<a href="game.php?game=<?=$game ?>&amp;age=1"><img src="<?=$imgDir.$age1114image ?>" alt="11-14" width="150" height="40" class="agebutton" /></a>

<a href="game.php?game=<?=$game ?>&amp;age=2"><img src="<?=$imgDir.$age1518image ?>" alt="15-18" width="150" height="40" class="agebutton" /></a>

</p>

<?php

}
else {
	echo("The game you have requested does not exist. Please go back to the <a href=\"index.php?section=home\"> puzzles page</a> and choose another.");
}

?>

</div>

</body>
</html>