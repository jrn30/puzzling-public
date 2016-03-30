<?php

$entry = $_GET[entry];

// If no entry query then go back to the index
if (empty($entry)) {
        header("Location: ../index.php");
}

// Log in to the database...
include ('../includes/dblogin.php');

// Add slashes for good measure
$entry = addslashes($entry);

$wordid = DBonevalue("SELECT id FROM dictionary WHERE word ='$entry'");

// And delete from the dictionary
DBquery("DELETE FROM dictionary WHERE word='$entry'");


$imgs = DBquery("SELECT * FROM vz_images WHERE word_id='$wordid'");

while ($this_img = mysql_fetch_assoc($imgs)) {
  echo("Deleting image $this_img[image_src]...<br>");
  $uploaddir = $_SERVER[DOCUMENT_ROOT]."/zoology/glossary_images/";
  unlink($uploaddir.$this_img[image_src]);
}

DBquery("DELETE FROM vz_images WHERE word_id='$wordid'");

// Don't care about the result...
echo "Deletion successful";

?>

<br>
&nbsp;<br>

<a href="../index.php?section=glossary">Back to Index</a>