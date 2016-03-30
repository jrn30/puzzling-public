<html>
<head>
<title>Video</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

include("video_shared.inc");
include("../includes/dblogin.php");

$videobits = explode("/", $_GET[referrer]);
$thissection = $sectionnames[$videobits[1]];

if (is_array($thissection)) {
	$vidname = substr($_GET[video], strpos($_GET[video], "/") + 1);
	$trans = $vidname;
	$title = $thissection[$vidname];
}
else {
	$trans = $videobits[1];
	$title = $thissection;
}

if (strpos($_GET[video],"careers") !== false) {
	echo("<h4>Careers: $title</h4>");
}
else if (strpos($_GET[video],"museum") !== false) {
	echo("<h4>Zoology Museum: $title</h4>");
}
else {
	echo("<h4>Sedgwick Museum: $title</h4>");
}

$filename = $_GET[video];
$filename .= "-$_GET[quality]";

echo "\n\n<!-- Loading $filename -->\n\n";

if ($_GET[quality] == "lo") {
	$vidwidth = 160;
	$vidheight = 120;
}
else if ($_GET[quality] == "hi") {
	$vidwidth = 320;
	$vidheight = 240;
}

?>

<div align="center" style="height: 330px; width: 345px;">

<OBJECT ID="mediaPlayer"
	CLASSID="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95"
	codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,02,902"
	STANDBY="Loading Microsoft Windows Media Player components..."
	TYPE="application/x-oleobject">

<PARAM NAME="animationatStart" VALUE="false">
<PARAM NAME="transparentatStart" VALUE="true">
<PARAM NAME="autoStart" VALUE="true">
<PARAM NAME="showControls" VALUE="true">
<param NAME="DisplayBackColor" VALUE="0x38575C">
<param NAME="DisplayForeColor" VALUE="0x38575C">
<PARAM NAME="Filename" value="mms://nipbone.caret.cam.ac.uk/downloads/zoology/<?=$filename ?>">

<embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"
        SRC="mms://nipbone.caret.cam.ac.uk/downloads/zoology/<?=$filename ?>" width="<?=$vidwidth ?>" AutoStart="true">

</object>

</center>
<br>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left">
<a href="select_bw.php?video=<?=$_GET[referrer] ?>">Back</a>
</td>
<td align="right">
<?php
$answer = DBonerow("SELECT * FROM transcripts WHERE ref='$trans'");
if(!empty($answer)){
?>
<a href="transcript.php?ref=<?=$trans ?>" target="_blank">View Transcript</a>
<?php
}
?>

</td>
</table>
</body>
