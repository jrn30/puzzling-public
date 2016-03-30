<?php

/* Connection bits 'n bobs */


// Connects to database, quit if the link doesn't work
$link = mysql_connect("please enter database connection details here");
if (!$link) {
	die("Couldn't connect to database on localhost");
}

// Select the database, quit if we can't select it
$b = mysql_select_db("zoology",$link);
if (!$b) {
	die ("Couldn't open database: <br>".mysql_error());
}


/*  mySQL database query function library */


// Function for multi-row queries
// Takes a query $q and returns the mySQL result for it
// Or prints an error message and quits
function DBquery($q) {
  $r = mysql_query($q);
  if ($r) return $r;
  else {
    die("Error in query:<br>&nbsp;<br>".mysql_error());
  }
}

// Function for one-row queries
// Takes query q and returns the first row of the result
function DBonerow($q) {
   $r = DBquery($q);
   return mysql_fetch_object($r);
}

// Function for one-row, one-column queries (e.g. COUNT queries)
// Takes query q and returns the first column of the first row
function DBonevalue($q) {
  $r = DBquery($q);
  $a = mysql_fetch_row($r);
  return $a[0];
}

?>





