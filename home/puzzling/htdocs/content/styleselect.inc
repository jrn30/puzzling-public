<?php

if (empty($_GET['redirect'])) {
	$linkSec = "home";
}
else {
	$linkSec = $_GET['redirect'];
}

?>

<h1>Welcome!</h1>

Welcome to the new look of CARET's Brainteasers &amp; Puzzles! Please choose how you want the site to look by clicking one of the graphics below.<br />

&nbsp;

<div id="intrologos">
<a href="index.php?section=<?=$linkSec ?>&amp;style=1"><img src="images/design1/intrologo.jpg" alt="Style 1" class="intrologo" width="300" height="64" /></a><a href="index.php?section=<?=$linkSec ?>&amp;style=2"><img src="images/design2/intrologo.jpg" alt="Style 2" class="intrologo" width="300" height="64" /></a><br /><a href="index.php?section=<?=$linkSec ?>&amp;style=3"><img src="images/design3/intrologo.gif" alt="Style 3" class="intrologo" width="300" height="64" /></a><a href="index.php?section=<?=$linkSec ?>&amp;style=4"><img src="images/design4/intrologo.gif" alt="Style 4" class="intrologo" width="300" height="64" /></a><br />
</div>

<p>

<small>

You will need the Flash plugin to play the games on the site. If you do not have the plugin then you can install it by following <a href="http://www.macromedia.com/go/getflashplayer" title="Install Flash Player">this link</a>

</small>
</p>

<p>
<small>
This site uses cookies for monitoring purposes. For more information please read our <a href="index.php?section=priv">Privacy Statement</a>.
</small>
</p>
