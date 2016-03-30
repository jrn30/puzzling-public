<?php

/* index.php does several things. These include:
 *
 * - Importing the requested page
 * - Setting and maintaining the style of the page
 * - Keeping a tracking cookie
 * - Printing the menu
 * - Setting the page title
 *
 * It takes the following query string variables
 *  - style : Sets a new style
 *  - section : Which section to import
 *
 * Most of the coding functionality of the site is in this one page. Other includes with code functionality include:
 *  - home.inc links to lots of puzzles
 *  - sitemap.inc uses the menu data (dependency on this page)
 *  - news.inc takes news data from the databases
 *  - handbook.inc lists puzzle handbooks
 *
 */


/* IMPORTING THE REQUESTED PAGE */

// Get the requested section. This defaults to `home` if none is asked

$section = $_GET['section'];
if (empty($section)) {
	$section="home";
}
// Strip off any slashes for security reasons
$section = basename($section);

// Section checkflash no longer exists, in case we get a misguided request for it we pick `styleselect`, its replacement instead
if ($section == "checkflash" || $section == "ageselect") {
	header("Location: /index.php?section=styleselect");
	exit();
}
else if ($section == "puzzle") {
  header("Location: /index.php?section=home");
  exit();
}

/* SETTING AND MAINTAINING THE STYLE OF THE PAGE */

// Pages that do not need a pre-set style
$noStyleNeeded = array("styleselect","priv","copyright","noforum");

// Set to true if this page doesn need style
$ignoreStyle = in_array($section, $noStyleNeeded);

// Start or maintain the session...
session_start();

/* Style can be set:
 * - In GET (if we are actively setting or changing it)
 * - In SESSION (if it has been used on a previous page)
 * - In COOKIE (if this is the first page of the current session, and we are returning from a previous session)
 *
 * We look at these in order. If none of them have it then this is the first visit to the site and we redirect them to styleselect
 * (unless we are already in styleselect...)
 */



$chosenStyle = $_GET['style'];

if (empty($chosenStyle)) {

	$chosenStyle = $_SESSION['style'];

	if (empty($chosenStyle)) {

		$chosenStyle = $_COOKIE['style'];

		if (empty($chosenStyle) && !$ignoreStyle) {

			header("Location: /index.php?section=styleselect&redirect=$section");
			exit();

		}

		else {
			// If no session but cookie remembers a value then set the session style to the one remembered in the cookie
			$_SESSION['style'] = $chosenStyle;
		}
	}
}
// If the style has been set in GET then set the session (for now) and cookie (for later) variables to this new value
else {
	if (!is_numeric($chosenStyle)) {
		$chosenStyle = 2;
	}
	$_SESSION['style'] = $chosenStyle;
	setcookie("style", $chosenStyle, time()+15552000, "/");
}

// If we have not found a style from the above then display style 2 (the default)
if (empty($chosenStyle)) {
	$displayedStyle = 2;
}
else {
  // Else display the style that the user has chosen (with limits between 1 and 4)
	$displayedStyle = max(1, $chosenStyle);
	$displayedStyle = min(4, $displayedStyle);
}

// Directory where the images for this style are
$imgDir = "images/design".$displayedStyle."/";



/* KEEPING A TRACKING COOKIE */

/* We set some random tracking data - a random hexadecimal string to give the user an anonymous ID */

// If we have no tracking data, then  make some
if (empty($_COOKIE['btp'])) {
	// Give them an anonymous ID -  two large random numbers (each has a value between 0 and 2^31) converted to hex strings and concatenated
	$r1 = dechex(mt_rand());
	$r2 = dechex(mt_rand());
	$cookieval = $r1.$r2;
}
else {
	$cookieval = $_COOKIE['btp'];
}
// Cookie expires in 180 days...
setcookie("btp", $cookieval, time()+15552000, "/");

// Get rid of legacy cookie values
if (isset($_COOKIE['age'])) {
	setcookie ("age", "", time() - 3600);
}
if (isset($_COOKIE['enablejs'])) {
	setcookie ("enablejs", "", time() - 3600);
}
if (isset($_COOKIE['YaBBSE151'])) {
	setcookie ("YaBBSE151", "", time() - 3600);
}

/* PRINTING THE MENU & SETTING THE PAGE TITLE

  Menus consist of four elements -
    0. Menu title
    1. The page the title links to.
    2. Associative array of menu elements

  We also use this to generate page titles.
*/

$pagetitle = "Brainteasers &amp; Puzzles";

$menu_data = array(

		 array("Home",
					 "home",
					 array("home" => "Puzzles",
								 "welcome" => "Welcome")),

		 array("Behind&nbsp;the&nbsp;Scenes",
					 "aboutbtp",
					 array("aboutbtp" => "About Brainteasers &amp; Puzzles",
									"aboutar" => "About Aspiration Raising",
									"theteam" => "The Team",
									"contributors" => "Other Contributors",
									"acknowledgements" => "Acknowledgements")),

		array("Extras",
					"handbook",
					array("handbook" => "Handbook",
								"findings" => "Focus Group Findings",
								"news" => "News Archives",
								"studentlinks" => "Student Links",
								"teacherslinks" => "Teacher Links")),


		array("Site Map",
					"sitemap",
					array()));

// Some pages do not appear on this menu so we add in their titles below
$otherPageTitles = array("priv" => "Privacy Policy",
													"copyright" => "Copyright Notice",
													"sitemap" => "Site Map");

// Work out the pagesubtitle, go through the menu first
foreach ($menu_data as $menu) {
	if (!empty($menu[2][$section])) {
		$pagesubtitle = $menu[2][$section];
	}
}

// Then the other page titles
if (empty($pagesubtitle)) {
	$pagesubtitle = $otherPageTitles[$section];
}

// If we have found one then add it to the end of the page title
if (!empty($pagesubtitle)) {
	$pagetitle .= ": $pagesubtitle";
}

// Automatically load database functions (most pages use them)
include("includes/dblib.php");

?>

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<title><?=$pagetitle ?></title>

<meta name="description" content="A collection of Brainteasers and Puzzles from Cambridge University to raise aspirations and promote thinking skills" />
<meta name="keywords" content="brainteasers, puzzles, brainteaser, puzzle, CARET, aspiration, aspirations, raise, raising, games, game, black box, bomb, parachute, roller coaster, cultures, gravity" />
<meta name="RSSchannelkeywords" content="brainteasers, puzzles, brainteaser, puzzle, CARET, aspiration, aspirations, raise, raising, games, game, black box, bomb, parachute, roller coaster, cultures, gravity" />

<script language="JavaScript" type="text/javascript" src="scripts/scripts.js" ></script>

<link rel="SHORTCUT ICON" href="favicon.ico" />

<link rel="stylesheet" href="css/common.css" />
<link rel="stylesheet" href="css/style<?=$displayedStyle ?>.css" />

<style type="text/css">

<?php

// CSS Hacks, etc.
// A hack to repair the <div> float bug in Mac IE5 (otherwise the bottom three <div>s render across the whole screen)

if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 5") !== false) {

  // A hack to repair the <div> float bug in Mac IE5 (otherwise the bottom three <div>s render across the whole screen)

  if (strpos($_SERVER['HTTP_USER_AGENT'], "Mac") !== false) {
      echo "div#copyright, div#changestyle {	width: 150px;}";
      echo "div#linklogos {	width: 400px; }";

      // In style 4 the arts box does not flow to the right of the science one but goes below it. This forces it back up again.
      // And the random box is a bit too low for or liking so we shove it up as well
      if ($displayedStyle == 4) {
	echo "div#arts { float:none; position: relative; top: -160px; left: 250px;}\n";
	echo "div#random { float: none; position: relative; top: -160px;}";
      }
    }

    else {

      // A hack for style 2, in Win IE5, the width of the div has to include the padding, not exclude it, so we make it 491px overriding the 210px value earlier
      if ($displayedStyle == 2) {
	echo "div#arts, div#science { width: 491px; }";
      }
    }
}

// Add in special backgrounds for the home page if we are the home section, and styles 1 or 3...

if ($section == "home") {
	if ($displayedStyle == 3) {
	  echo "div#content {\n";
		echo "background: #FFFFFF url(images/design3/magazineheader.gif) no-repeat top right;\n";
		echo "padding-top: 110px; }";
	}
	else if ($displayedStyle == 1) {
	  echo "div#content {\n";
    echo "background: url(images/design1/the_gang.jpg) no-repeat 5px 10px;\n";
    echo "height: 475px; }";
	}
}

else if ($section == "news") {
	echo "div#content img { margin: 4px 8px 4px 4px; }";
}

?>

</style>

</head>

<body>

<?php

// Banner logo is either a jpg or gif, depending on the style (awkwardly enough)
// We determine its filename here

$bannerLogoURL = ($displayedStyle == 2) ? "bannerlogo.jpg" : "bannerlogo.gif";

?>

<div id="topimages"><a href="index.php"><img src="<?=$imgDir.$bannerLogoURL ?>" alt="CARET Brainteasers And Puzzles" /></a></div>

<div id="menuwrapper">

<div id="menubar">

<?php

// Produce the menubar

// If we have chosen a style and we are not in styleselect then we are "logged in" to the site
if ($section != "styleselect" && !empty($chosenStyle)) {

	$sectionKey = $section;

  echo "<ul>";

	// First the menu titles
	foreach ($menu_data as $menu) {

		// If this section is part of this menu (either its title or one of its elements) then we are in this menu
		$inThisMenu = ($menu[1] == $sectionKey || array_key_exists($sectionKey,$menu[2]));

		// Set the title
		$menuTitle = $menu[0];

		// Surround title with a link if this is not the menu containing this page
		if (!$inThisMenu) {
			$menuTitle = "<a href=\"index.php?section=$menu[1]\">$menuTitle</a>";
		}

		// Add in the menu title
		echo "<li>$menuTitle</li>";
	}

	echo "</ul></div>\n";

	// Now the menu elements
	foreach ($menu_data as $menu) {

		// If we have menu elements, and we should expand this menu...

		if (count($menu[2]) > 0 && ($menu[1] == $sectionKey || array_key_exists($sectionKey,$menu[2]))) {

			echo "<div id=\"submenubar\"><ul>";

			// For each item, print it off, with a link if it is not the current section
			foreach ($menu[2] as $menulink => $menuitem) {
				echo "<li>";
				if ($menulink==$sectionKey) {
					echo "$menuitem";
				}
				else {
					echo "<a href=\"index.php?section=$menulink\">$menuitem</a>";
				}
				echo "</li>";
			}

			echo "</ul>";

		}
	}
}

// Produce a blank space if no menu is required
else {
	echo "&nbsp;";
}

?>


</div>

</div>

<div id="content">

<?php

// Now add in the content file. Check to see whether it exists first

$contentfile = "content/".$section.".inc";

if (!file_exists($contentfile)) {
	echo "<h2>Error 404: File Not Found</h2><p>Sorry, the section you have requested does not exist. ";
	echo "Please <a href=\"mailto:puzzling@caret.cam.ac.uk\">contact us</a> if you think this is an error, or ";
	echo "go back to the <a href=\"/\">home page</a></p>";

}
else {
	 // If all is OK, include the [section name].inc file as the main body of the page
	include($contentfile);
}

?>

</div>

<?php

// Work out the final digit of the current year for the Copyright notice
$yy = date("y")%10;

?>

<div id="bottomimages">

	<div id="copyright">
		<a href="index.php?section=copyright">&copy; 2003-<?=$yy ?> CARET</a>
	</div>


	<div id="changestyle">
		<a href="index.php?section=styleselect">Change style</a>
	</div>


	<div id="linklogos">

		<a href="http://www.ngfl.gov.uk">
		<img src="<?=$imgDir ?>ngfl_logo.gif" alt="Part of the National Grid for Learning" class="linklogo" width="35" height="20" /></a>

		<a href="http://www.aimhigher.ac.uk/">
		<img src="<?=$imgDir ?>aimhigher_new.gif" alt="Aim Higher" class="linklogo" width="95" height="20" /></a>

		<a href="http://www.cam.ac.uk/aspirations">
		<img src="<?=$imgDir ?>unicam.gif" alt="Cambridge University Aspiration Raising" class="linklogo" width="94" height="20" /></a>

		<a href="http://www.caret.cam.ac.uk">
		<img src="<?=$imgDir ?>caretlogo.gif" alt="CARET" class="linklogo" width="63" height="20" /></a>

	</div>

</div>

<?php // FIXME: Kill the below for production site ?>

<!--

Current style is <?=$chosenStyle ?>
Displayed style is <?=$displayedStyle ?>

-->

<!--

<div>
<br />
<br />

<small>
<a href="http://validator.w3.org/check/referer">Check Valid XHTML</a><br />
<a href="http://jigsaw.w3.org/css-validator/validator?uri=<?=urlencode("http://staranise.caret.cam.ac.uk/mirrors/puzzling/index.php?section=$section&style=$displayedStyle") ?>">Check Valid CSS</a>
</small>
</div>

-->

</body>
</html>