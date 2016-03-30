<?php


include("../includes/dblib.php");
connectToDB("puzzling");

$r = DBQuery("SELECT * FROM btp_games");

while ($thisRow = mysql_fetch_assoc($r)) {

  $fileName = "../resources/handbook/$thisRow[handbook]";

  if (empty($thisRow[handbook]) || !file_exists($fileName)) {
    $n = 0;
    echo "The document for '$thisRow[ufname]' does not exist! It will have no entry in the database<br>";
  }
  else {
  	$n = ceil(filesize($fileName)/1024);
	  echo "Updating for '$thisRow[ufname]', filesize is <b>$n</b> kB <br>";
	}

  DBQuery("UPDATE btp_games SET booksize='$n' WHERE id='$thisRow[id]'");

}

echo "<hr>";

$r = DBQuery("SELECT * FROM btp_focusdocs");

while ($thisRow = mysql_fetch_assoc($r)) {

  $fileName = "../resources/focusgrouppdf/$thisRow[filename]";

  if (!file_exists($fileName)) {
    $n = 0;
 	  echo "The document for '$thisRow[title]' does not exist! It will have no entry in the database<br>";
  }

  else {
  	$n = ceil(filesize($fileName)/1024);
	  echo "Updating for '$thisRow[title]', filesize is <b>$n</b> kB <br>";
	}

  DBQuery("UPDATE btp_focusdocs SET filesize='$n' WHERE id='$thisRow[id]'");

}




?>