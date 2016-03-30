<html>
<head>
<title>Submit Article</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table><tr><td>

<h2>Submit An Article</h2>

<?php

if (count($_POST) > 0) {

	if (crypt($_POST[password],"ca") != "password check string") {
		echo("Password incorrect! Please go back and try again.");
	}
	else {
		echo("<!-- Password OK -->");
		include('../includes/dblib.php');
		connectToDB("puzzling");

		// Some temporary variables
		$fr = $_POST['readers'];
		$fh = $_POST['headline'];
		$fl = $_POST['link'];
		$fa = htmlentities(str_replace("\n","<br>",$_POST['article']));

		// Insert into database
		$query = "INSERT INTO btp_articles (readers, title, link, article) VALUES ('$fr', '$fh', '$fl', '$fa')";
		//echo("<pre>$query</pre>");
		DBquery($query);
		echo("Article submitted successfully.");
	}
}

?>

<form action="<?=$_SERVER['PHP_SELF'] ?>" method="POST">

<table>

<tr>

<td align=right width="150">
<b>Readers:</b>
</td>

<td>
<select name="readers">
	<option value="0">Teachers & Parents</option>
	<option value="1">Students</option>
</select>
</td>
</tr>

<tr>
<td align=right>
<b>Password:</b>
</td>

<td>
<input type="password" name="password" length="50" maxlength="128" style="width: 400px"/>
</td>
</tr>


<tr>
<td align=right>
<b>Headline:</b>
</td>

<td>
<input type="text" name="headline" length="50" maxlength="128" style="width: 400px"/>
</td>
</tr>

<tr>
<td align=right>
<b>Link:</b>
</td>

<td>
<input type="text" name="link" length="50" maxlength="128" style="width: 400px"/>
</td>
</tr>

<tr>

<td align="right" valign="top">
<b>Comment:</b>
</td>

<td>
<textarea name="article" rows="10" columns="80" style="width:400px"></textarea>
</td>
</tr>


<tr>
<td colspan=2 align="center">
&nbsp;<br />
<input type="submit" class="button" value="Send!">
</td>
</tr>
</table>

</form>

<a href="../index.php?section=articles">See Articles</a>

</td></tr></table>
</body>
