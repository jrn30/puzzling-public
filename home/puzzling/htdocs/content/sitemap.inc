<h1>Site Map</h1>

<?php

// Takes $menu_data from the index.php page, and produces a site map from it. Looks through each list of menu items and
// produces a link to every menu data item

foreach ($menu_data as $menu) {

	if (count($menu[2]) > 0) {

		// Header for this menu
  	echo "<h2>$menu[0]</h2>\n";

		// Then a list of each of its items
		echo "<ul>\n";

		foreach ($menu[2] as $page => $title) {
			echo("<li><a href=\"index.php?section=$page\">$title</a></li>\n");
		}

		echo "</ul>";

	}

}

?>

<h2>Other Information</h2>

<ul>

<li><a href="index.php?section=priv">Privacy Policy</a></li>
<li><a href="index.php?section=copyright">Copyright Notice</a></li>

</ul>