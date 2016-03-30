<?php

// Process an entry being added to the database if new, or updated if it currently exists
include('../includes/dblogin.php');


if (crypt($_POST[f_pass],"vz") != "vzCIAO/ZXcSfc") {
	die ("Bad password supplied!");
}


// Directory where images are located
$uploaddir = $_SERVER[DOCUMENT_ROOT]."/zoology/images/glossary";

// Get the word and capitalise the first letter
$f_word = addslashes(ucfirst($_POST[f_word]));

// Get the definition - add slashes and convert new lines to <br> tags...
$f_definition = addslashes(nl2br($_POST[f_definition]));

// Check to see if this already exists
$query = "SELECT * FROM dictionary WHERE word = '$f_word'";
$existing = DBonerow($query);

// If it does exist then send an update entry
if ($existing) {
  echo "Updating existing entry...<br>";
  $query = "UPDATE dictionary SET meaning='$f_definition' WHERE word='$f_word'";
}
// Else insert a brand new entry
else {
  echo "Inserting new entry...<br>";
  $query = "INSERT INTO dictionary (word, meaning) VALUES ('$f_word', '$f_definition')";
}


DBquery($query);


// Get the ID number of the entry - either the existing ID number or the new ID number returned by the AUTO_INCREMENT in the database
$word_id = ($existing) ? $existing[id] : mysql_insert_id();

echo("ID: $word_id<br>");

// If we have files to upload...
if ($_FILES[f_newfile][size] > 0) {

  // And they are images...
  $type = $_FILES[f_newfile][type];
  if ($type == "image/gif" || $type == "image/jpeg" || $type == "image/png") {

    // Get the highest-numbered existing image file
    $lastfile = DBonevalue("SELECT image_src FROM vz_images WHERE word_id = '$word_id' ORDER BY image_src DESC LIMIT 0, 1");

    // Get the number from the end of it and then add one.
    $imgcount = substr($lastfile,strrpos($lastfile, "-")+1) + 1;

    echo("Image of type $type supplied. This is image number $imgcount for this entry<br>");

    // Work out the filename and upload directory
    $filename = $f_word."-image-".$imgcount;

    // Attempt to move the uploaded file into its new place
    if (move_uploaded_file($_FILES[f_newfile][tmp_name], $uploaddir.$filename)) {
      echo("File $uploaddir$filename is valid, and was uploaded.<br>");

      // If successful, record the new image in the vz_images table
      DBquery("INSERT INTO vz_images (word_id, image_src) VALUES ('$word_id', '$filename')");

      // And update the dictionary so that we know this entry has an image for it
      DBquery("UPDATE dictionary SET has_image = '1' WHERE id = '$word_id'");
    }
    else {
      echo("File $uploaddir$filename is valid but could not been uploaded - possible file system error?<br>");
    }
  }
  else {
    echo("File not of the right type - please upload an image (.gif, .jpg, .png)!<br>");
  }
}
else {
  echo("No file supplied.<br>");
}

// Go through any files the user has select for deletion
$deletefiles = $_POST[f_delete];

// If any checkboxes have been ticked then they will be in the array $deletefiles
// $deletefiles only consists of 'on' values, in certain places - the index numbers of these places correspond to the
// image id in the table...

if (count($deletefiles) > 0) {

  // For all deleted files, each identifies by $delid
  foreach ($deletefiles as $delid => $value) {

    // Get the filename from the database
    $deletedfile = DBonevalue("SELECT image_src FROM vz_images WHERE id = '$delid'");

    // Attempt to delete
    if (unlink($uploaddir.$deletedfile)) {
      echo("Deleting image $deletedfile...<br>");
    }
    else {
      echo("Tried to delete file $deletedfile but failed, dropping from database anyway...<br>");
    }

    // Wipe from the database regardless of successful deletion
    DBquery("DELETE FROM vz_images WHERE id='$delid'");
  }
}

// Add a confirmation message
echo ("Entry for <b>$f_word</b> successful<br>");

?>

<a href="../index.php?section=glossary">Index</a><br>
<a href="add_entry.php">Add Another Entry</a>