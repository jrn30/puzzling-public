<html>
<head>
<title>Choose Video</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
<!--
// Check form for complete password value...
function checkForm(form) {
  if (form.video && form.video.selectedIndex === 0) {
    alert("Please choose a video from the list!");
    return false;
  }
  return true;
}
// -->
</script>

</head>
<body>

<?php $video = $_GET[video] ?>

<h2>Choose Video</h2>

<form action="play.php" method="get" onSubmit="return checkForm(this);">

<table width="330">

<tr>
<td>

<h4>Video Title</h4>

<?php

// Get the shared video file (just contains all the titles)...
include("video_shared.inc");

// Get the section...
$videobits = explode("/", $video);
$thissection = $sectionnames[$videobits[1]];

// If the section is an array, we have more than one choice, so print out a select drop-down

if (is_array($thissection)) {

	echo "<select name=\"video\" style=\"width: 320px\">\n";
	echo "<option value=\"NULL\">(Please choose a video!)</option>\n";

	foreach ($thissection as $key => $value) {
		echo "\t<option value=\"$videobits[0]/$key\">$value</option>\n";
	}

	echo "</select>";

}

// Else it is a string, so print out a fixed value and a hidden <input> value
else {
	echo $thissection;
	echo "<input type=\"hidden\" name=\"video\" value=\"$video\">";
}

?>

<input type="hidden" name="referrer" value="<?=$video ?>">

<h4>Video Quality</h4>

<input type="radio" name="quality" value="hi.wmv" checked> High Quality Video (Broadband)<br>
<input type="radio" name="quality" value="lo.wmv"> Low Quality Video (Modem)<br>
<input type="radio" name="quality" value="audio.wma"> Audio only<br>

&nbsp;
</td>
</tr>
<tr>
<td align="center">

<input type="submit" class="button" value="Watch Video">

</td>
</tr>
<tr>
<td>
<span style="font-size: 80%">
&nbsp;
<br>
Note: You will need Windows Media Player 9 in order to watch these videos. <a href="http://www.microsoft.com/windows/windowsmedia/9series/player.aspx" target="_blank">Click here</a> to install it.</span>

</td>
</tr>
</table>

</form>

</body>