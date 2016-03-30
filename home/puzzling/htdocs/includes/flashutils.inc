<?php

/* Creates a static HTML placeholder to insert a Flash movie  */

function flashObjectTags($movie, $id, $width, $height, $bgcolor, $flashvars) {

  $id = array_pop(explode("/",$movie));

  // The order in which we supply the parameters (stupidly) can affect the way the movie is displayed
  // We want scale = noscale, stage alignment (salign) = left and top (LT)
  //
  // Mac browsers that aren`t Mozilla, and Netscape 7 prefer scale first, then alignment
  // Mozilla on Mac and Non-IE PC browsers (other than Netscape 7) prefer alignment first, then scale
  // IE on PC does not seem to care
  //
  // So we detect the browser string for the `Mac` bit and echo the parameters accordingly
  //
  // If any problems are reported, saying the games are displayed in the window off-centre, try finding out which
  // order it is being viewed in the browser, and try the other way

	$userAgent = $_SERVER['HTTP_USER_AGENT'];

	// $isMac is true if we are using MSIE or Safari (but NOT Mozilla) for Mac

	// the user agent contains `Mac`, and either
  //  1. It does not contain the word `Gecko` (which makes it IE), or
  //  2. If it does contain `Gecko` then it must also say `Safari` (which makes it Safari)

  $isMac = strpos($userAgent, "Mac") !== false &&
           (strpos($userAgent,"Gecko") === false ||
            strpos($userAgent,"Safari") !== false);

  // $isNetscape7 is true if we are using NS7 on the PC

  $isNetscape7 = strpos($userAgent, "Netscape/7") !== false;
  $isFirefox = strpos($userAgent, "Firefox") !== false;

	echo "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"$width\" height=\"$height\" id=\"$id\">\n\n";

	echo "<param name=\"movie\" value=\"$movie.swf\" />\n";
	echo "<param name=\"menu\" value=\"false\" />\n";
	echo "<param name=\"quality\" value=\"high\" />\n";
	echo "<param name=\"bgcolor\" value=\"$bgcolor\" />\n";

/*
	echo "<param name=\"scale\" value=\"noscale\" />\n";
	echo "<param name=\"salign\" value=\"LT\" />\n";
*/

	echo "<param name=\"flashvars\" value=\"$flashvars\" />\n\n";

	echo "<embed src=\"$movie.swf\" quality=\"high\" menu=\"false\" bgcolor=\"$bgcolor\" width=\"$width\" height=\"$height\"\n";

//	echo "scale=\"noscale\" salign=\"LT\" ";

	echo "type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"\n";
	echo "flashvars=\"$flashvars\">\n";

	echo "</embed></object>";

	echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";

	echo "window.$id.focus(); \n";

	echo "</script>";

}