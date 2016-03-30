<?php

	// Work out the flashvars string
	// We have an array fv of the different values

	$fv = array();

	// Start movie,if one exists
	if (!empty($_GET[movie])) {
		$fv[startmovie] = $_GET[movie];
	}

	// Whether we are in MSIE on PC or not
	$s = $_SERVER[HTTP_USER_AGENT];
	if (strpos($s, "MSIE") !== false && strpos($s,"Mac") === false) {
		$fv[is_ie] = "yes";
	}
	else {
		$fv[is_ie] = "no";
	}

	// Now convert this to a url-encoded string...
	$flashvars = "";
	foreach ($fv as $key => $value) {
		$flashvars .= urlencode($key);
		$flashvars .= "=";
		$flashvars .= urlencode($value);
		$flashvars .= "&";
	};

	// Take off the last '&' for neatness' sake
	$flashvars = substr($flashvars, 0, -1);

?>

<style type="text/css">
.contentBody {
	padding: 0% 0%;
}
</style>

<div align="center">
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
	    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
	    WIDTH="800" HEIGHT="600" id="arkadev4" ALIGN="">

<PARAM NAME=movie VALUE="flash/arkadev4.swf">
<PARAM NAME=menu VALUE="false">
<PARAM NAME=quality VALUE="high">
<PARAM NAME=scale VALUE="exactfit">
<PARAM NAME=bgcolor VALUE="#0F00A2">
<PARAM NAME=flashvars VALUE="<?=$flashvars ?>">
<EMBED src="flash/arkadev4.swf" menu=false quality=high scale=exactfit bgcolor=#0F00A2  WIDTH="800" HEIGHT="600"
       NAME="arkadev4" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"
       flashvars="<?=$flashvars ?>"></EMBED>
</OBJECT></div>