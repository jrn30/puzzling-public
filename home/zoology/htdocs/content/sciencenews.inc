<h1>Science In The News</h1>

<table>

<tr>

<td width="50%">

<div style="background-color: white; height: 25px">
<a href="http://www.newscientist.com">
	<img src="http://www.newscientist.com/data/images/ns/syndication/logo120_20.gif" border="0" alt="New Scientist" width="120" height="20">
</a>
</div>

<div class="small">

<?php

// Get the RDF feed and read it
clearstatcache();
// $filename = "http://www.newscientist.com/syndication/news.rdf";
$filename = "http://feeds.newscientist.com/science-news";
$f = fopen($filename, "r");
while (!feof ($f)) {
    $rdf_data .= fgets($f, 1024000);
}
fclose ($f);


// Create a parser & set its options - dont convert to uppercase and ignore whitespace
$p = xml_parser_create();
xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, 0);
xml_parser_set_option($p, XML_OPTION_SKIP_WHITE, 1);

// Set the functions to handle opening and closing tags
xml_set_element_handler($p, "startElement", "endElement");
// Set the function to handle blocks of character data
xml_set_character_data_handler($p, "characterData");

// Start scanning an element
// We are only interested in the <item> tag and its subtags

function startElement($parser, $tagName, $attrs) {
  global $insideitem, $tag;
  if ($insideitem) {
    $tag = $tagName;
  }
  else if ($tagName == "item") {
    $insideitem = true;
  }
}

// Look at character data inside an element
function characterData($parser, $data) {
  global $insideitem, $tag, $itemobject;

  // If we're inside an item...
  if ($insideitem) {

    // itemobject is the current item, as an associative array, so itemobject[title] is the title for this item
    // Append the character data to the current item's title/description/link, depending on which element we are inside
    $itemobject[$tag] .= trim($data);

  }
}

// Finish off the current itemobject,
function endElement($parser, $tagName) {
  global $insideitem, $tag, $itemobject, $items;

  // When closing each item tag...
  if ($tagName == "item") {

    // Add current item object to array of item objects
    $items[] = $itemobject;

    // Reset item object
    $itemobject = array();
    $insideitem = false;
  }
}

if (!xml_parse($p, $rdf_data)) {
  echo "Sorry. There has been a technical problem and we are unable to bring you the New Scientist. ";
  echo "Please contact the <a href=\"mailto:revolution@caret.cam.ac.uk\">webmaster</a>";
}
else {
  $n = 0;
  // Go through all the item objects and print them out
  foreach ($items as $item) {
    if ($n < 20) {
      echo "<a href=\"$item[link]\">$item[title]</a><br>\n";
      echo "<span class=\"small\">$item[description]</span><br>\n\n";
      $n++;
    }
  }
}

?>

&nbsp;<br>
(&copy; New Scientist)

</div>

</td>
<td width="50%">
&nbsp;
</td>

</tr>
</table>
