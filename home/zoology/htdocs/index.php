<?php

// Sort out template and section

$template = (empty($_GET[template])) ? "hmcf" : $_GET[template];
$section = (empty($_GET[section])) ? "home" : $_GET[section];

// Strips out any path information from $section
$section = basename($section);

// If we have no tracking data, then set it
if (empty($_COOKIE["rev"])) {

  // Give them an anonymous ID - two large random numbers (each has a value between 0 and 2^31) converted to hex strings and concatenated
  $r1 = dechex(mt_rand());
  $r2 = dechex(mt_rand());
  $cookieval = $r1.$r2;
}
else {
	$cookieval = $_COOKIE["rev"];
}

// Set the cookie ID, expires in 180 days...
setcookie("rev", $cookieval, time()+15552000, "/");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?php

  $titles = array("home" => "Home",
  				  "museum" => "Museum",
  				  "news" => "News",
  				  "teachers" => "Information for Teachers",
  				  "glossary" => "Glossary",
  				  "sitemap" => "Site Map",
  				  "info" => "Information");

  $pagetitle = (empty($titles[$section])) ? "rEvolution" : "rEvolution - ".$titles[$section];

?>

<title><?=$pagetitle ?></title>

<meta name="description" content="rEvolution: The zoology website from Cambridge University's Aspiration Raising project">
<meta name="keywords" content="rEvolution, revolution, r-evolution, zoology, geology, botany, science, Cambridge, university, Cambridge University, CARET, game, puzzle">

<link rel="SHORTCUT ICON" href="favicon.ico">

<link rel="stylesheet" href="css/style.css" type="text/css">

<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

function selfName() {
	if (self.name != "museumWin") {
		self.name = "rev_home";
	}
}
//  -->
</script>

</head>

<body onLoad="self.focus(); selfName();">

<table border="0" cellpadding="0" cellspacing="0" width="100%">

<?php

for ($j=0; $j<strlen($template); $j++) {

  $pt = $template{$j};

  switch($pt) {

  	case "h":

			$array=array("leaf","rock","paper","metal");
			$rnd=$array[rand(0,3)];
			$showmenu = $_GET[showmenu]; ?>

<tr>
<td>

<table cellpadding="0" cellspacing="0" width="100%" style="background-image: url(images/layout/scanlines.gif)">

<tr>
<td valign="top">
<img src="images/layout/<?=$rnd ?>banner1.gif" border="0" alt="rEvolution"></td>

<td width="100%">

<?php if ($section != "museum" || $showmenu == "yes") { ?>

<div align="center">
<a href="index.php">Home</a>&nbsp;|
<a href="index.php?section=museum&template=hc"
	 onClick="popUpMuseum(this.href); return false;">Museum</a>&nbsp;|
<a href="index.php?section=museum&template=hc&movie=careers"
	 onClick="popUpMuseum(this.href); return false;">InfoCentre</a>&nbsp;|
<a href="index.php?section=glossary">Glossary</a>&nbsp;|
<a href="index.php?section=sitemap">Site Map</a>&nbsp;|
<a href="index.php?section=help">Help</a>

</div>

<?php }

else echo "&nbsp;" ?>

</td>

<td valign="bottom">

<img src="images/layout/<?=$rnd ?>banner2.gif" border="0" alt="Dodo"></td>

</tr>
</table>


</td>
</tr>

<?php

		  break;

		// For the `menu` (this is now redundant, we just return an empty cell)
		case "m":
			echo "<tr><td>&nbsp;</td></tr>";
			break;

		// Include the content if it exists
		case "c":

			echo "<tr><td class=\"contentBody\">";

			// Check to see if the page exists, if not then return an error

			if (!file_exists("content/$section.inc")) {
				echo "<h2>Section Not Found</h2>";
				echo "We could not find the section <b>$section</b> that you requested. If you think we have given you a bad link";
				echo " then please <a href=\"index.php?section=contact\">let us know</a>. Thank you.";
			}
			else {
				include("content/$section.inc");
			}

			echo "</td></tr>";

			break;

		case "f": ?>


<tr>
<td>

&nbsp;<br>

<table cellpadding="0" cellspacing="0" width="100%">
<tr>

<td width="50%" height="45" valign="middle" style="background-image: url(images/layout/scanlines.gif)">

<div style="float: left">
<a href="index.php?section=contact">

<img src="images/layout/email.gif" border="0" width="160" height="35" alt="Email Us!"></a>

</div>
</td>

<td width="50%" valign="middle" style="background-image: url(images/layout/scanlines.gif)">

<div style="float: right; text-align: right">

<a href="http://www.cam.ac.uk">
	<img src="images/logos/unicambs.gif" border="0" alt="Cambridge University" width="95" height="18"></a>
&nbsp;&nbsp;
<a href="http://www.caret.cam.ac.uk">

<img src="images/logos/caretlogonew.gif" border="0" alt="CARET" width="63" height="20"></a>
</div>

</td>

</tr>
<tr>
<td colspan="2">

<div class="smaller" style="text-align: center">
&nbsp;<br>
    <a href="index.php?section=about">About rEvolution</a> |
    <a href="index.php?section=credits">Acknowledgements</a> |
	<a href="index.php?section=copyright#disclaimer">Disclaimer</a> |
	<a href="index.php?section=copyright#privacy">Privacy Policy</a> |
	<a href="index.php?section=copyright">&copy; CARET 2003-<?=date("y")%10; ?></a>&nbsp;&nbsp;
</div>

</td>
</tr>
</table>

</td>
</tr>

<?php

			break;
  }
}

?>

</table>
</body>
</html>
