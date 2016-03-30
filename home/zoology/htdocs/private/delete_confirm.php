<?php

// If we have no entry specified go back to the index

$entry = $_GET[entry];

if (empty($entry)) {
	header("Location: ../index.php");
}

// Give user a choice of deleting this entry, or going back to referring page..

?>

<h1>Confirm Deletion</h1>

Are you sure you want to delete the term <b><?=$entry?></b>?<br>

&nbsp;<br>

<a href="delete_entry.php?entry=<?=$entry?>">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=$HTTP_REFERER?>">No</a>