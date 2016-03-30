<?php

include('includes/dblib.php');

$game = $_GET['game'];
connectToDB("puzzling");

$gameinfo = DBonerow("SELECT * FROM btp_games WHERE id='$game'");

$pagetitle = "Keys for ".$gameinfo->ufname;

include ("includes/top_no_banner.inc");

?>

<h2>
Keyboard shortcuts for '<?php echo($gameinfo->ufname); ?>'
</h2>

<?php

$s = $gameinfo->keyboard;

if (empty($s)) {
	echo("Sorry, no keyboard shortcuts exist for this game.");
}
else {
	echo($s);
}

?>

</body>
</html>