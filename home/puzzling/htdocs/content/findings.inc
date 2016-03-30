<h1>Focus Group Findings</h1>

<p>

Please click on a PDF file to view it. You will need <a href="http://www.adobe.com/products/acrobat/readstep2.html">Adobe Acrobat Reader</a> to read the documents.

</p>

<ul class="pdf">

<?php

$r = DBQuery("SELECT * FROM btp_focusdocs ORDER BY title");

while ($thisRow = mysql_fetch_assoc($r)) {

	echo "<li><a href=\"resources/focusgrouppdf/$thisRow[filename]\">$thisRow[title]</a> <small>($thisRow[filesize]k)</small></li>";

}

?>

</ul>

<h1>Small but Important Addendum to Reports</h1>

<p>

As a result of feedback given during the focus groups, a number of the puzzles have been renamed:


</p>

<ul>
  <li>
    <b>Books</b> is now
    <b>Bored Billy</b>
  </li>
  <li>
    <b>Cultures</b> is now

    <b>Know Your Earthlings</b>
  </li>
<li>
    <b>Election</b> is now
    <b>Know Your Elections</b>
  </li>
<li>
    <b>Flags</b> is now
    <b>Around the World in 80 Seconds</b>
  </li>
  <li>
    <b>Foodchain</b> is now
    <b>Sunny Meadows</b>
  </li>
<li>
    <b>France Trip</b> is now
    <b>Tour de France</b>
  </li>
<li>
    <b>Gears</b> is now
    <b>Geared Up!</b>
  </li>
  <li>
    <b>Gravity</b> is now
    <b>Omega Sector</b>
  </li>
<li>
    <b>Heraldry</b> is now
    <b>Shields of Honour</b>
  </li>
<li>
    <b>Oceans</b> is now
    <b>Pirate Challenge</b>
  </li>
  <li>
    <b>Parachute</b> is now
    <b>Ranger Danger Dan The Parachute Man</b>
  </li>
<li>
    <b>Placenames</b> is now
    <b>Invaders</b>
  </li>
  <li>
    <b>Plants</b> is now
    <b>Plant Force</b>
  </li>
  <li>
    <b>Soil</b> is now
    <b>Doyle's Soil</b>
  </li>
  <li>
    <b>Trebuchet</b> is now
    <b>The Battle of Goresdale</b>
  </li>
  <li>
    <b>VD2</b> is now
    <b>Tracker</b>
  </li>
<li>
    <b>Witches</b> is now in two parts:
    <b>Witch Son and Witch Trial</b>
  </li>

</ul>

