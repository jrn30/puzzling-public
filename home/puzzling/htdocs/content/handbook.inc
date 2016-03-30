<h1>Teachers' and Parents' Handbook</h1>

<p>

This section contains handbooks for the brainteasers and puzzles found on this site. You will need <a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank">Adobe Acrobat Reader</a> to read the documents.

</p>

<ul class="pdf">

<?php

connectToDB("puzzling");

$result = DBQuery("SELECT * FROM btp_games WHERE handbook != '' ORDER BY ufname");
// $result = DBQuery("SELECT ufname, handbook FROM btp_games WHERE handbook != '' ORDER BY ufname");

// Create a list with all the handbook links

while ($thisrow = mysql_fetch_assoc($result)) {

    echo "<li><a href=\"resources/handbook/$thisrow[handbook]\">\n";
    echo "$thisrow[ufname]</a>";
    echo " <small>($thisrow[booksize]k)</small>";
    echo "</li>";

}

?>

</ul>