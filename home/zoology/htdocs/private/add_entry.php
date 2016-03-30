<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body>

<?php

$entry = $_GET[entry];

// Adds a new or edits an existing entry in the dictionary

include ('../includes/dblogin.php');

// If an entry variable has been supplied, then we are editing an existing entry
if (!empty($entry)) {
  echo ("<h2>Edit Existing entry</h2>");

  // Set entry to first letter capitalised
  $entry = ucfirst($entry);

  // Get the one row for thie entry
  $query = "SELECT * FROM dictionary WHERE word LIKE '$entry'";
  $a = DBonerow($query);

  // Get existing definition
  $existing_def = $a[meaning];

  // If it is null, then we haven't actually got an existing entry - we should add a new entry into the dictionary
  if (empty($existing_def)) {
    echo "Sorry, your entry <b>$entry</b> does not exist in the dictionary - please add a new entry below.<br>&nbsp;<br>";
  }
  else {
    echo "Please update the entry for <b>$entry</b> below:<br>&nbsp;<br>";
  }

  // Below in the HTML we insert the $entry and $existing_def variables in the right places
}
else {
  echo("<h2>Add New Entry</h2>");
}

?>



<form action="process_entry.php" method="post" enctype="multipart/form-data">

<table>

<tr>
<td align="right">Password: </td>
<td><input type="password" name="f_pass"></td>
</tr>

<tr>
<td align="right">Word: </td>
<td><input type="text" name="f_word" value="<?=$entry?>"></td>
</tr>

<tr>
<td align="right" valign="top">Definition: </td>
<td><textarea name="f_definition" rows="8" columns="80"><?=$existing_def?></textarea>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
</td>
</tr>



<?php

if (!empty($entry)) {

  $imgs = DBquery("SELECT * FROM vz_images WHERE word_id = '$a[id]' ORDER BY id");

  if (mysql_num_rows($imgs) > 0) {

    echo("<tr>\n<td align=\"right\" valign=\"top\">Existing Images</td>\n<td>\n");

    while ($this_img = mysql_fetch_assoc($imgs)) {
      echo("<img src=\"images/$this_img[image_src]\" width=20 height=20 align=middle>");
      echo("&nbsp;&nbsp;&nbsp;Delete? <input type=\"checkbox\" name=\"f_delete[$this_img[id]]\" ><br>\n");
    }

    echo("</td></tr>");

  }
}
?>

<tr>
<td align="right" valign="top">New Image</td>
<td><input type="file" name="f_newfile">
</td>
</tr>

<tr>
<td colspan=2 align="center">
&nbsp;<br>
<input type="submit" value="Add">
</td>
</tr>

</form>
</body>
</html>